<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RoomReservationView extends RoomReservation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'room_reservation';

    // Page object name
    public $PageObjName = "RoomReservationView";

    // Rendering View
    public $RenderingView = false;

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;

        // Initialize
        $GLOBALS["Page"] = &$this;
        $this->TokenTimeout = SessionTimeoutTime();

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (room_reservation)
        if (!isset($GLOBALS["room_reservation"]) || get_class($GLOBALS["room_reservation"]) == PROJECT_NAMESPACE . "room_reservation") {
            $GLOBALS["room_reservation"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("id") ?? Route("id")) !== null) {
            $this->RecKey["id"] = $keyValue;
        }
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'room_reservation');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("room_reservation"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "RoomReservationView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $ExportOptions; // Export options
    public $OtherOptions; // Other options
    public $DisplayRecords = 1;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecKey = [];
    public $IsModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->contact_org->setVisibility();
        $this->contact_name->setVisibility();
        $this->contact_email->setVisibility();
        $this->contact_phone->setVisibility();
        $this->contact_fax->setVisibility();
        $this->contact_address->setVisibility();
        $this->contact_city->setVisibility();
        $this->contact_state->setVisibility();
        $this->contact_zip->setVisibility();
        $this->contact_advisor->setVisibility();
        $this->contact_advisor_phone->setVisibility();
        $this->contact_advisor_email->setVisibility();
        $this->billing_org->setVisibility();
        $this->billing_name->setVisibility();
        $this->billing_email->setVisibility();
        $this->billing_phone->setVisibility();
        $this->billing_fax->setVisibility();
        $this->billing_address->setVisibility();
        $this->billing_city->setVisibility();
        $this->billing_state->setVisibility();
        $this->billing_zip->setVisibility();
        $this->billing_method->setVisibility();
        $this->billing_frs->setVisibility();
        $this->event_title->setVisibility();
        $this->event_type->setVisibility();
        $this->event_date->setVisibility();
        $this->event_time_start->setVisibility();
        $this->event_time_end->setVisibility();
        $this->event_num_people->setVisibility();
        $this->event_room_preference->setVisibility();
        $this->recurring_jan->setVisibility();
        $this->recurring_feb->setVisibility();
        $this->recurring_mar->setVisibility();
        $this->recurring_apr->setVisibility();
        $this->recurring_may->setVisibility();
        $this->recurring_jun->setVisibility();
        $this->recurring_jul->setVisibility();
        $this->recurring_aug->setVisibility();
        $this->recurring_sep->setVisibility();
        $this->recurring_oct->setVisibility();
        $this->recurring_nov->setVisibility();
        $this->recurring_dec->setVisibility();
        $this->setup_shape->setVisibility();
        $this->certification_name->setVisibility();
        $this->certification_date->setVisibility();
        $this->timestamp->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->RecKey["id"] = $this->id->QueryStringValue;
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->RecKey["id"] = $this->id->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->RecKey["id"] = $this->id->QueryStringValue;
            } else {
                $returnUrl = "RoomReservationList"; // Return to list
            }

            // Get action
            $this->CurrentAction = "show"; // Display
            switch ($this->CurrentAction) {
                case "show": // Get a record to display

                    // Load record based on key
                    if (IsApi()) {
                        $filter = $this->getRecordFilter();
                        $this->CurrentFilter = $filter;
                        $sql = $this->getCurrentSql();
                        $conn = $this->getConnection();
                        $this->Recordset = LoadRecordset($sql, $conn);
                        $res = $this->Recordset && !$this->Recordset->EOF;
                    } else {
                        $res = $this->loadRow();
                    }
                    if (!$res) { // Load record based on key
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $returnUrl = "RoomReservationList"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "RoomReservationList"; // Not page request, return to list
        }
        if ($returnUrl != "") {
            $this->terminate($returnUrl);
            return;
        }

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Render row
        $this->RowType = ROWTYPE_VIEW;
        $this->resetAttributes();
        $this->renderRow();

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset, true); // Get current record only
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows]);
            $this->terminate(true);
            return;
        }

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Required", "IsInvalid", "Raw"]);

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Rendering event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        }
        $item->Visible = ($this->AddUrl != "");

        // Edit
        $item = &$option->add("edit");
        $editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        }
        $item->Visible = ($this->EditUrl != "");

        // Copy
        $item = &$option->add("copy");
        $copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->CopyUrl)) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        }
        $item->Visible = ($this->CopyUrl != "");

        // Delete
        $item = &$option->add("delete");
        if ($this->IsModal) { // Handle as inline delete
            $item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery(GetUrl($this->DeleteUrl), "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        }
        $item->Visible = ($this->DeleteUrl != "");

        // Set up action default
        $option = $options["action"];
        $option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
        $option->UseDropDownButton = false;
        $option->UseButtonGroup = true;
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->id->setDbValue($row['id']);
        $this->contact_org->setDbValue($row['contact_org']);
        $this->contact_name->setDbValue($row['contact_name']);
        $this->contact_email->setDbValue($row['contact_email']);
        $this->contact_phone->setDbValue($row['contact_phone']);
        $this->contact_fax->setDbValue($row['contact_fax']);
        $this->contact_address->setDbValue($row['contact_address']);
        $this->contact_city->setDbValue($row['contact_city']);
        $this->contact_state->setDbValue($row['contact_state']);
        $this->contact_zip->setDbValue($row['contact_zip']);
        $this->contact_advisor->setDbValue($row['contact_advisor']);
        $this->contact_advisor_phone->setDbValue($row['contact_advisor_phone']);
        $this->contact_advisor_email->setDbValue($row['contact_advisor_email']);
        $this->billing_org->setDbValue($row['billing_org']);
        $this->billing_name->setDbValue($row['billing_name']);
        $this->billing_email->setDbValue($row['billing_email']);
        $this->billing_phone->setDbValue($row['billing_phone']);
        $this->billing_fax->setDbValue($row['billing_fax']);
        $this->billing_address->setDbValue($row['billing_address']);
        $this->billing_city->setDbValue($row['billing_city']);
        $this->billing_state->setDbValue($row['billing_state']);
        $this->billing_zip->setDbValue($row['billing_zip']);
        $this->billing_method->setDbValue($row['billing_method']);
        $this->billing_frs->setDbValue($row['billing_frs']);
        $this->event_title->setDbValue($row['event_title']);
        $this->event_type->setDbValue($row['event_type']);
        $this->event_date->setDbValue($row['event_date']);
        $this->event_time_start->setDbValue($row['event_time_start']);
        $this->event_time_end->setDbValue($row['event_time_end']);
        $this->event_num_people->setDbValue($row['event_num_people']);
        $this->event_room_preference->setDbValue($row['event_room_preference']);
        $this->recurring_jan->setDbValue($row['recurring_jan']);
        $this->recurring_feb->setDbValue($row['recurring_feb']);
        $this->recurring_mar->setDbValue($row['recurring_mar']);
        $this->recurring_apr->setDbValue($row['recurring_apr']);
        $this->recurring_may->setDbValue($row['recurring_may']);
        $this->recurring_jun->setDbValue($row['recurring_jun']);
        $this->recurring_jul->setDbValue($row['recurring_jul']);
        $this->recurring_aug->setDbValue($row['recurring_aug']);
        $this->recurring_sep->setDbValue($row['recurring_sep']);
        $this->recurring_oct->setDbValue($row['recurring_oct']);
        $this->recurring_nov->setDbValue($row['recurring_nov']);
        $this->recurring_dec->setDbValue($row['recurring_dec']);
        $this->setup_shape->setDbValue($row['setup_shape']);
        $this->certification_name->setDbValue($row['certification_name']);
        $this->certification_date->setDbValue($row['certification_date']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['contact_org'] = null;
        $row['contact_name'] = null;
        $row['contact_email'] = null;
        $row['contact_phone'] = null;
        $row['contact_fax'] = null;
        $row['contact_address'] = null;
        $row['contact_city'] = null;
        $row['contact_state'] = null;
        $row['contact_zip'] = null;
        $row['contact_advisor'] = null;
        $row['contact_advisor_phone'] = null;
        $row['contact_advisor_email'] = null;
        $row['billing_org'] = null;
        $row['billing_name'] = null;
        $row['billing_email'] = null;
        $row['billing_phone'] = null;
        $row['billing_fax'] = null;
        $row['billing_address'] = null;
        $row['billing_city'] = null;
        $row['billing_state'] = null;
        $row['billing_zip'] = null;
        $row['billing_method'] = null;
        $row['billing_frs'] = null;
        $row['event_title'] = null;
        $row['event_type'] = null;
        $row['event_date'] = null;
        $row['event_time_start'] = null;
        $row['event_time_end'] = null;
        $row['event_num_people'] = null;
        $row['event_room_preference'] = null;
        $row['recurring_jan'] = null;
        $row['recurring_feb'] = null;
        $row['recurring_mar'] = null;
        $row['recurring_apr'] = null;
        $row['recurring_may'] = null;
        $row['recurring_jun'] = null;
        $row['recurring_jul'] = null;
        $row['recurring_aug'] = null;
        $row['recurring_sep'] = null;
        $row['recurring_oct'] = null;
        $row['recurring_nov'] = null;
        $row['recurring_dec'] = null;
        $row['setup_shape'] = null;
        $row['certification_name'] = null;
        $row['certification_date'] = null;
        $row['timestamp'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->AddUrl = $this->getAddUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();
        $this->ListUrl = $this->getListUrl();
        $this->setupOtherOptions();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // contact_org

        // contact_name

        // contact_email

        // contact_phone

        // contact_fax

        // contact_address

        // contact_city

        // contact_state

        // contact_zip

        // contact_advisor

        // contact_advisor_phone

        // contact_advisor_email

        // billing_org

        // billing_name

        // billing_email

        // billing_phone

        // billing_fax

        // billing_address

        // billing_city

        // billing_state

        // billing_zip

        // billing_method

        // billing_frs

        // event_title

        // event_type

        // event_date

        // event_time_start

        // event_time_end

        // event_num_people

        // event_room_preference

        // recurring_jan

        // recurring_feb

        // recurring_mar

        // recurring_apr

        // recurring_may

        // recurring_jun

        // recurring_jul

        // recurring_aug

        // recurring_sep

        // recurring_oct

        // recurring_nov

        // recurring_dec

        // setup_shape

        // certification_name

        // certification_date

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // contact_org
            $this->contact_org->ViewValue = $this->contact_org->CurrentValue;
            $this->contact_org->ViewCustomAttributes = "";

            // contact_name
            $this->contact_name->ViewValue = $this->contact_name->CurrentValue;
            $this->contact_name->ViewCustomAttributes = "";

            // contact_email
            $this->contact_email->ViewValue = $this->contact_email->CurrentValue;
            $this->contact_email->ViewCustomAttributes = "";

            // contact_phone
            $this->contact_phone->ViewValue = $this->contact_phone->CurrentValue;
            $this->contact_phone->ViewCustomAttributes = "";

            // contact_fax
            $this->contact_fax->ViewValue = $this->contact_fax->CurrentValue;
            $this->contact_fax->ViewCustomAttributes = "";

            // contact_address
            $this->contact_address->ViewValue = $this->contact_address->CurrentValue;
            $this->contact_address->ViewCustomAttributes = "";

            // contact_city
            $this->contact_city->ViewValue = $this->contact_city->CurrentValue;
            $this->contact_city->ViewCustomAttributes = "";

            // contact_state
            $this->contact_state->ViewValue = $this->contact_state->CurrentValue;
            $this->contact_state->ViewCustomAttributes = "";

            // contact_zip
            $this->contact_zip->ViewValue = $this->contact_zip->CurrentValue;
            $this->contact_zip->ViewCustomAttributes = "";

            // contact_advisor
            $this->contact_advisor->ViewValue = $this->contact_advisor->CurrentValue;
            $this->contact_advisor->ViewCustomAttributes = "";

            // contact_advisor_phone
            $this->contact_advisor_phone->ViewValue = $this->contact_advisor_phone->CurrentValue;
            $this->contact_advisor_phone->ViewCustomAttributes = "";

            // contact_advisor_email
            $this->contact_advisor_email->ViewValue = $this->contact_advisor_email->CurrentValue;
            $this->contact_advisor_email->ViewCustomAttributes = "";

            // billing_org
            $this->billing_org->ViewValue = $this->billing_org->CurrentValue;
            $this->billing_org->ViewCustomAttributes = "";

            // billing_name
            $this->billing_name->ViewValue = $this->billing_name->CurrentValue;
            $this->billing_name->ViewCustomAttributes = "";

            // billing_email
            $this->billing_email->ViewValue = $this->billing_email->CurrentValue;
            $this->billing_email->ViewCustomAttributes = "";

            // billing_phone
            $this->billing_phone->ViewValue = $this->billing_phone->CurrentValue;
            $this->billing_phone->ViewCustomAttributes = "";

            // billing_fax
            $this->billing_fax->ViewValue = $this->billing_fax->CurrentValue;
            $this->billing_fax->ViewCustomAttributes = "";

            // billing_address
            $this->billing_address->ViewValue = $this->billing_address->CurrentValue;
            $this->billing_address->ViewCustomAttributes = "";

            // billing_city
            $this->billing_city->ViewValue = $this->billing_city->CurrentValue;
            $this->billing_city->ViewCustomAttributes = "";

            // billing_state
            $this->billing_state->ViewValue = $this->billing_state->CurrentValue;
            $this->billing_state->ViewCustomAttributes = "";

            // billing_zip
            $this->billing_zip->ViewValue = $this->billing_zip->CurrentValue;
            $this->billing_zip->ViewCustomAttributes = "";

            // billing_method
            $this->billing_method->ViewValue = $this->billing_method->CurrentValue;
            $this->billing_method->ViewCustomAttributes = "";

            // billing_frs
            $this->billing_frs->ViewValue = $this->billing_frs->CurrentValue;
            $this->billing_frs->ViewCustomAttributes = "";

            // event_title
            $this->event_title->ViewValue = $this->event_title->CurrentValue;
            $this->event_title->ViewCustomAttributes = "";

            // event_type
            $this->event_type->ViewValue = $this->event_type->CurrentValue;
            $this->event_type->ViewCustomAttributes = "";

            // event_date
            $this->event_date->ViewValue = $this->event_date->CurrentValue;
            $this->event_date->ViewValue = FormatDateTime($this->event_date->ViewValue, 0);
            $this->event_date->ViewCustomAttributes = "";

            // event_time_start
            $this->event_time_start->ViewValue = $this->event_time_start->CurrentValue;
            $this->event_time_start->ViewCustomAttributes = "";

            // event_time_end
            $this->event_time_end->ViewValue = $this->event_time_end->CurrentValue;
            $this->event_time_end->ViewCustomAttributes = "";

            // event_num_people
            $this->event_num_people->ViewValue = $this->event_num_people->CurrentValue;
            $this->event_num_people->ViewValue = FormatNumber($this->event_num_people->ViewValue, 0, -2, -2, -2);
            $this->event_num_people->ViewCustomAttributes = "";

            // event_room_preference
            $this->event_room_preference->ViewValue = $this->event_room_preference->CurrentValue;
            $this->event_room_preference->ViewCustomAttributes = "";

            // recurring_jan
            $this->recurring_jan->ViewValue = $this->recurring_jan->CurrentValue;
            $this->recurring_jan->ViewCustomAttributes = "";

            // recurring_feb
            $this->recurring_feb->ViewValue = $this->recurring_feb->CurrentValue;
            $this->recurring_feb->ViewCustomAttributes = "";

            // recurring_mar
            $this->recurring_mar->ViewValue = $this->recurring_mar->CurrentValue;
            $this->recurring_mar->ViewCustomAttributes = "";

            // recurring_apr
            $this->recurring_apr->ViewValue = $this->recurring_apr->CurrentValue;
            $this->recurring_apr->ViewCustomAttributes = "";

            // recurring_may
            $this->recurring_may->ViewValue = $this->recurring_may->CurrentValue;
            $this->recurring_may->ViewCustomAttributes = "";

            // recurring_jun
            $this->recurring_jun->ViewValue = $this->recurring_jun->CurrentValue;
            $this->recurring_jun->ViewCustomAttributes = "";

            // recurring_jul
            $this->recurring_jul->ViewValue = $this->recurring_jul->CurrentValue;
            $this->recurring_jul->ViewCustomAttributes = "";

            // recurring_aug
            $this->recurring_aug->ViewValue = $this->recurring_aug->CurrentValue;
            $this->recurring_aug->ViewCustomAttributes = "";

            // recurring_sep
            $this->recurring_sep->ViewValue = $this->recurring_sep->CurrentValue;
            $this->recurring_sep->ViewCustomAttributes = "";

            // recurring_oct
            $this->recurring_oct->ViewValue = $this->recurring_oct->CurrentValue;
            $this->recurring_oct->ViewCustomAttributes = "";

            // recurring_nov
            $this->recurring_nov->ViewValue = $this->recurring_nov->CurrentValue;
            $this->recurring_nov->ViewCustomAttributes = "";

            // recurring_dec
            $this->recurring_dec->ViewValue = $this->recurring_dec->CurrentValue;
            $this->recurring_dec->ViewCustomAttributes = "";

            // setup_shape
            $this->setup_shape->ViewValue = $this->setup_shape->CurrentValue;
            $this->setup_shape->ViewCustomAttributes = "";

            // certification_name
            $this->certification_name->ViewValue = $this->certification_name->CurrentValue;
            $this->certification_name->ViewCustomAttributes = "";

            // certification_date
            $this->certification_date->ViewValue = $this->certification_date->CurrentValue;
            $this->certification_date->ViewValue = FormatDateTime($this->certification_date->ViewValue, 0);
            $this->certification_date->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // contact_org
            $this->contact_org->LinkCustomAttributes = "";
            $this->contact_org->HrefValue = "";
            $this->contact_org->TooltipValue = "";

            // contact_name
            $this->contact_name->LinkCustomAttributes = "";
            $this->contact_name->HrefValue = "";
            $this->contact_name->TooltipValue = "";

            // contact_email
            $this->contact_email->LinkCustomAttributes = "";
            $this->contact_email->HrefValue = "";
            $this->contact_email->TooltipValue = "";

            // contact_phone
            $this->contact_phone->LinkCustomAttributes = "";
            $this->contact_phone->HrefValue = "";
            $this->contact_phone->TooltipValue = "";

            // contact_fax
            $this->contact_fax->LinkCustomAttributes = "";
            $this->contact_fax->HrefValue = "";
            $this->contact_fax->TooltipValue = "";

            // contact_address
            $this->contact_address->LinkCustomAttributes = "";
            $this->contact_address->HrefValue = "";
            $this->contact_address->TooltipValue = "";

            // contact_city
            $this->contact_city->LinkCustomAttributes = "";
            $this->contact_city->HrefValue = "";
            $this->contact_city->TooltipValue = "";

            // contact_state
            $this->contact_state->LinkCustomAttributes = "";
            $this->contact_state->HrefValue = "";
            $this->contact_state->TooltipValue = "";

            // contact_zip
            $this->contact_zip->LinkCustomAttributes = "";
            $this->contact_zip->HrefValue = "";
            $this->contact_zip->TooltipValue = "";

            // contact_advisor
            $this->contact_advisor->LinkCustomAttributes = "";
            $this->contact_advisor->HrefValue = "";
            $this->contact_advisor->TooltipValue = "";

            // contact_advisor_phone
            $this->contact_advisor_phone->LinkCustomAttributes = "";
            $this->contact_advisor_phone->HrefValue = "";
            $this->contact_advisor_phone->TooltipValue = "";

            // contact_advisor_email
            $this->contact_advisor_email->LinkCustomAttributes = "";
            $this->contact_advisor_email->HrefValue = "";
            $this->contact_advisor_email->TooltipValue = "";

            // billing_org
            $this->billing_org->LinkCustomAttributes = "";
            $this->billing_org->HrefValue = "";
            $this->billing_org->TooltipValue = "";

            // billing_name
            $this->billing_name->LinkCustomAttributes = "";
            $this->billing_name->HrefValue = "";
            $this->billing_name->TooltipValue = "";

            // billing_email
            $this->billing_email->LinkCustomAttributes = "";
            $this->billing_email->HrefValue = "";
            $this->billing_email->TooltipValue = "";

            // billing_phone
            $this->billing_phone->LinkCustomAttributes = "";
            $this->billing_phone->HrefValue = "";
            $this->billing_phone->TooltipValue = "";

            // billing_fax
            $this->billing_fax->LinkCustomAttributes = "";
            $this->billing_fax->HrefValue = "";
            $this->billing_fax->TooltipValue = "";

            // billing_address
            $this->billing_address->LinkCustomAttributes = "";
            $this->billing_address->HrefValue = "";
            $this->billing_address->TooltipValue = "";

            // billing_city
            $this->billing_city->LinkCustomAttributes = "";
            $this->billing_city->HrefValue = "";
            $this->billing_city->TooltipValue = "";

            // billing_state
            $this->billing_state->LinkCustomAttributes = "";
            $this->billing_state->HrefValue = "";
            $this->billing_state->TooltipValue = "";

            // billing_zip
            $this->billing_zip->LinkCustomAttributes = "";
            $this->billing_zip->HrefValue = "";
            $this->billing_zip->TooltipValue = "";

            // billing_method
            $this->billing_method->LinkCustomAttributes = "";
            $this->billing_method->HrefValue = "";
            $this->billing_method->TooltipValue = "";

            // billing_frs
            $this->billing_frs->LinkCustomAttributes = "";
            $this->billing_frs->HrefValue = "";
            $this->billing_frs->TooltipValue = "";

            // event_title
            $this->event_title->LinkCustomAttributes = "";
            $this->event_title->HrefValue = "";
            $this->event_title->TooltipValue = "";

            // event_type
            $this->event_type->LinkCustomAttributes = "";
            $this->event_type->HrefValue = "";
            $this->event_type->TooltipValue = "";

            // event_date
            $this->event_date->LinkCustomAttributes = "";
            $this->event_date->HrefValue = "";
            $this->event_date->TooltipValue = "";

            // event_time_start
            $this->event_time_start->LinkCustomAttributes = "";
            $this->event_time_start->HrefValue = "";
            $this->event_time_start->TooltipValue = "";

            // event_time_end
            $this->event_time_end->LinkCustomAttributes = "";
            $this->event_time_end->HrefValue = "";
            $this->event_time_end->TooltipValue = "";

            // event_num_people
            $this->event_num_people->LinkCustomAttributes = "";
            $this->event_num_people->HrefValue = "";
            $this->event_num_people->TooltipValue = "";

            // event_room_preference
            $this->event_room_preference->LinkCustomAttributes = "";
            $this->event_room_preference->HrefValue = "";
            $this->event_room_preference->TooltipValue = "";

            // recurring_jan
            $this->recurring_jan->LinkCustomAttributes = "";
            $this->recurring_jan->HrefValue = "";
            $this->recurring_jan->TooltipValue = "";

            // recurring_feb
            $this->recurring_feb->LinkCustomAttributes = "";
            $this->recurring_feb->HrefValue = "";
            $this->recurring_feb->TooltipValue = "";

            // recurring_mar
            $this->recurring_mar->LinkCustomAttributes = "";
            $this->recurring_mar->HrefValue = "";
            $this->recurring_mar->TooltipValue = "";

            // recurring_apr
            $this->recurring_apr->LinkCustomAttributes = "";
            $this->recurring_apr->HrefValue = "";
            $this->recurring_apr->TooltipValue = "";

            // recurring_may
            $this->recurring_may->LinkCustomAttributes = "";
            $this->recurring_may->HrefValue = "";
            $this->recurring_may->TooltipValue = "";

            // recurring_jun
            $this->recurring_jun->LinkCustomAttributes = "";
            $this->recurring_jun->HrefValue = "";
            $this->recurring_jun->TooltipValue = "";

            // recurring_jul
            $this->recurring_jul->LinkCustomAttributes = "";
            $this->recurring_jul->HrefValue = "";
            $this->recurring_jul->TooltipValue = "";

            // recurring_aug
            $this->recurring_aug->LinkCustomAttributes = "";
            $this->recurring_aug->HrefValue = "";
            $this->recurring_aug->TooltipValue = "";

            // recurring_sep
            $this->recurring_sep->LinkCustomAttributes = "";
            $this->recurring_sep->HrefValue = "";
            $this->recurring_sep->TooltipValue = "";

            // recurring_oct
            $this->recurring_oct->LinkCustomAttributes = "";
            $this->recurring_oct->HrefValue = "";
            $this->recurring_oct->TooltipValue = "";

            // recurring_nov
            $this->recurring_nov->LinkCustomAttributes = "";
            $this->recurring_nov->HrefValue = "";
            $this->recurring_nov->TooltipValue = "";

            // recurring_dec
            $this->recurring_dec->LinkCustomAttributes = "";
            $this->recurring_dec->HrefValue = "";
            $this->recurring_dec->TooltipValue = "";

            // setup_shape
            $this->setup_shape->LinkCustomAttributes = "";
            $this->setup_shape->HrefValue = "";
            $this->setup_shape->TooltipValue = "";

            // certification_name
            $this->certification_name->LinkCustomAttributes = "";
            $this->certification_name->HrefValue = "";
            $this->certification_name->TooltipValue = "";

            // certification_date
            $this->certification_date->LinkCustomAttributes = "";
            $this->certification_date->HrefValue = "";
            $this->certification_date->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("RoomReservationList"), "", $this->TableVar, true);
        $pageId = "view";
        $Breadcrumb->add("view", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }
}
