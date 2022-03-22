<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class EventOrdersAdd extends EventOrders
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'event_orders';

    // Page object name
    public $PageObjName = "EventOrdersAdd";

    // Rendering View
    public $RenderingView = false;

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

        // Table object (event_orders)
        if (!isset($GLOBALS["event_orders"]) || get_class($GLOBALS["event_orders"]) == PROJECT_NAMESPACE . "event_orders") {
            $GLOBALS["event_orders"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'event_orders');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();
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
                $doc = new $class(Container("event_orders"));
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
                    if ($pageName == "EventOrdersView") {
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->Visible = false;
        $this->event_id->setVisibility();
        $this->event_time->setVisibility();
        $this->event_type->setVisibility();
        $this->pdf_link->setVisibility();
        $this->uploader->setVisibility();
        $this->timestamp->setVisibility();
        $this->data->setVisibility();
        $this->progress->setVisibility();
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
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("EventOrdersList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "EventOrdersList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "EventOrdersView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->event_id->CurrentValue = null;
        $this->event_id->OldValue = $this->event_id->CurrentValue;
        $this->event_time->CurrentValue = null;
        $this->event_time->OldValue = $this->event_time->CurrentValue;
        $this->event_type->CurrentValue = "Regular";
        $this->pdf_link->CurrentValue = null;
        $this->pdf_link->OldValue = $this->pdf_link->CurrentValue;
        $this->uploader->CurrentValue = null;
        $this->uploader->OldValue = $this->uploader->CurrentValue;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
        $this->data->CurrentValue = null;
        $this->data->OldValue = $this->data->CurrentValue;
        $this->progress->CurrentValue = "Received";
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'event_id' first before field var 'x_event_id'
        $val = $CurrentForm->hasValue("event_id") ? $CurrentForm->getValue("event_id") : $CurrentForm->getValue("x_event_id");
        if (!$this->event_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_id->Visible = false; // Disable update for API request
            } else {
                $this->event_id->setFormValue($val);
            }
        }

        // Check field name 'event_time' first before field var 'x_event_time'
        $val = $CurrentForm->hasValue("event_time") ? $CurrentForm->getValue("event_time") : $CurrentForm->getValue("x_event_time");
        if (!$this->event_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_time->Visible = false; // Disable update for API request
            } else {
                $this->event_time->setFormValue($val);
            }
            $this->event_time->CurrentValue = UnFormatDateTime($this->event_time->CurrentValue, 0);
        }

        // Check field name 'event_type' first before field var 'x_event_type'
        $val = $CurrentForm->hasValue("event_type") ? $CurrentForm->getValue("event_type") : $CurrentForm->getValue("x_event_type");
        if (!$this->event_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_type->Visible = false; // Disable update for API request
            } else {
                $this->event_type->setFormValue($val);
            }
        }

        // Check field name 'pdf_link' first before field var 'x_pdf_link'
        $val = $CurrentForm->hasValue("pdf_link") ? $CurrentForm->getValue("pdf_link") : $CurrentForm->getValue("x_pdf_link");
        if (!$this->pdf_link->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pdf_link->Visible = false; // Disable update for API request
            } else {
                $this->pdf_link->setFormValue($val);
            }
        }

        // Check field name 'uploader' first before field var 'x_uploader'
        $val = $CurrentForm->hasValue("uploader") ? $CurrentForm->getValue("uploader") : $CurrentForm->getValue("x_uploader");
        if (!$this->uploader->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->uploader->Visible = false; // Disable update for API request
            } else {
                $this->uploader->setFormValue($val);
            }
        }

        // Check field name 'timestamp' first before field var 'x_timestamp'
        $val = $CurrentForm->hasValue("timestamp") ? $CurrentForm->getValue("timestamp") : $CurrentForm->getValue("x_timestamp");
        if (!$this->timestamp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->timestamp->Visible = false; // Disable update for API request
            } else {
                $this->timestamp->setFormValue($val);
            }
            $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
        }

        // Check field name 'data' first before field var 'x_data'
        $val = $CurrentForm->hasValue("data") ? $CurrentForm->getValue("data") : $CurrentForm->getValue("x_data");
        if (!$this->data->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->data->Visible = false; // Disable update for API request
            } else {
                $this->data->setFormValue($val);
            }
        }

        // Check field name 'progress' first before field var 'x_progress'
        $val = $CurrentForm->hasValue("progress") ? $CurrentForm->getValue("progress") : $CurrentForm->getValue("x_progress");
        if (!$this->progress->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->progress->Visible = false; // Disable update for API request
            } else {
                $this->progress->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->event_id->CurrentValue = $this->event_id->FormValue;
        $this->event_time->CurrentValue = $this->event_time->FormValue;
        $this->event_time->CurrentValue = UnFormatDateTime($this->event_time->CurrentValue, 0);
        $this->event_type->CurrentValue = $this->event_type->FormValue;
        $this->pdf_link->CurrentValue = $this->pdf_link->FormValue;
        $this->uploader->CurrentValue = $this->uploader->FormValue;
        $this->timestamp->CurrentValue = $this->timestamp->FormValue;
        $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
        $this->data->CurrentValue = $this->data->FormValue;
        $this->progress->CurrentValue = $this->progress->FormValue;
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
        $this->event_id->setDbValue($row['event_id']);
        $this->event_time->setDbValue($row['event_time']);
        $this->event_type->setDbValue($row['event_type']);
        $this->pdf_link->setDbValue($row['pdf_link']);
        $this->uploader->setDbValue($row['uploader']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->data->setDbValue($row['data']);
        $this->progress->setDbValue($row['progress']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['event_id'] = $this->event_id->CurrentValue;
        $row['event_time'] = $this->event_time->CurrentValue;
        $row['event_type'] = $this->event_type->CurrentValue;
        $row['pdf_link'] = $this->pdf_link->CurrentValue;
        $row['uploader'] = $this->uploader->CurrentValue;
        $row['timestamp'] = $this->timestamp->CurrentValue;
        $row['data'] = $this->data->CurrentValue;
        $row['progress'] = $this->progress->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // event_id

        // event_time

        // event_type

        // pdf_link

        // uploader

        // timestamp

        // data

        // progress
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // event_id
            $this->event_id->ViewValue = $this->event_id->CurrentValue;
            $this->event_id->ViewValue = FormatNumber($this->event_id->ViewValue, 0, -2, -2, -2);
            $this->event_id->ViewCustomAttributes = "";

            // event_time
            $this->event_time->ViewValue = $this->event_time->CurrentValue;
            $this->event_time->ViewValue = FormatDateTime($this->event_time->ViewValue, 0);
            $this->event_time->ViewCustomAttributes = "";

            // event_type
            $this->event_type->ViewValue = $this->event_type->CurrentValue;
            $this->event_type->ViewCustomAttributes = "";

            // pdf_link
            $this->pdf_link->ViewValue = $this->pdf_link->CurrentValue;
            $this->pdf_link->ViewCustomAttributes = "";

            // uploader
            $this->uploader->ViewValue = $this->uploader->CurrentValue;
            $this->uploader->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // data
            $this->data->ViewValue = $this->data->CurrentValue;
            $this->data->ViewCustomAttributes = "";

            // progress
            $this->progress->ViewValue = $this->progress->CurrentValue;
            $this->progress->ViewCustomAttributes = "";

            // event_id
            $this->event_id->LinkCustomAttributes = "";
            $this->event_id->HrefValue = "";
            $this->event_id->TooltipValue = "";

            // event_time
            $this->event_time->LinkCustomAttributes = "";
            $this->event_time->HrefValue = "";
            $this->event_time->TooltipValue = "";

            // event_type
            $this->event_type->LinkCustomAttributes = "";
            $this->event_type->HrefValue = "";
            $this->event_type->TooltipValue = "";

            // pdf_link
            $this->pdf_link->LinkCustomAttributes = "";
            $this->pdf_link->HrefValue = "";
            $this->pdf_link->TooltipValue = "";

            // uploader
            $this->uploader->LinkCustomAttributes = "";
            $this->uploader->HrefValue = "";
            $this->uploader->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";

            // data
            $this->data->LinkCustomAttributes = "";
            $this->data->HrefValue = "";
            $this->data->TooltipValue = "";

            // progress
            $this->progress->LinkCustomAttributes = "";
            $this->progress->HrefValue = "";
            $this->progress->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // event_id
            $this->event_id->EditAttrs["class"] = "form-control";
            $this->event_id->EditCustomAttributes = "";
            $this->event_id->EditValue = HtmlEncode($this->event_id->CurrentValue);
            $this->event_id->PlaceHolder = RemoveHtml($this->event_id->caption());

            // event_time
            $this->event_time->EditAttrs["class"] = "form-control";
            $this->event_time->EditCustomAttributes = "";
            $this->event_time->EditValue = HtmlEncode(FormatDateTime($this->event_time->CurrentValue, 8));
            $this->event_time->PlaceHolder = RemoveHtml($this->event_time->caption());

            // event_type
            $this->event_type->EditAttrs["class"] = "form-control";
            $this->event_type->EditCustomAttributes = "";
            if (!$this->event_type->Raw) {
                $this->event_type->CurrentValue = HtmlDecode($this->event_type->CurrentValue);
            }
            $this->event_type->EditValue = HtmlEncode($this->event_type->CurrentValue);
            $this->event_type->PlaceHolder = RemoveHtml($this->event_type->caption());

            // pdf_link
            $this->pdf_link->EditAttrs["class"] = "form-control";
            $this->pdf_link->EditCustomAttributes = "";
            if (!$this->pdf_link->Raw) {
                $this->pdf_link->CurrentValue = HtmlDecode($this->pdf_link->CurrentValue);
            }
            $this->pdf_link->EditValue = HtmlEncode($this->pdf_link->CurrentValue);
            $this->pdf_link->PlaceHolder = RemoveHtml($this->pdf_link->caption());

            // uploader
            $this->uploader->EditAttrs["class"] = "form-control";
            $this->uploader->EditCustomAttributes = "";
            if (!$this->uploader->Raw) {
                $this->uploader->CurrentValue = HtmlDecode($this->uploader->CurrentValue);
            }
            $this->uploader->EditValue = HtmlEncode($this->uploader->CurrentValue);
            $this->uploader->PlaceHolder = RemoveHtml($this->uploader->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // data
            $this->data->EditAttrs["class"] = "form-control";
            $this->data->EditCustomAttributes = "";
            $this->data->EditValue = HtmlEncode($this->data->CurrentValue);
            $this->data->PlaceHolder = RemoveHtml($this->data->caption());

            // progress
            $this->progress->EditAttrs["class"] = "form-control";
            $this->progress->EditCustomAttributes = "";
            if (!$this->progress->Raw) {
                $this->progress->CurrentValue = HtmlDecode($this->progress->CurrentValue);
            }
            $this->progress->EditValue = HtmlEncode($this->progress->CurrentValue);
            $this->progress->PlaceHolder = RemoveHtml($this->progress->caption());

            // Add refer script

            // event_id
            $this->event_id->LinkCustomAttributes = "";
            $this->event_id->HrefValue = "";

            // event_time
            $this->event_time->LinkCustomAttributes = "";
            $this->event_time->HrefValue = "";

            // event_type
            $this->event_type->LinkCustomAttributes = "";
            $this->event_type->HrefValue = "";

            // pdf_link
            $this->pdf_link->LinkCustomAttributes = "";
            $this->pdf_link->HrefValue = "";

            // uploader
            $this->uploader->LinkCustomAttributes = "";
            $this->uploader->HrefValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";

            // data
            $this->data->LinkCustomAttributes = "";
            $this->data->HrefValue = "";

            // progress
            $this->progress->LinkCustomAttributes = "";
            $this->progress->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->event_id->Required) {
            if (!$this->event_id->IsDetailKey && EmptyValue($this->event_id->FormValue)) {
                $this->event_id->addErrorMessage(str_replace("%s", $this->event_id->caption(), $this->event_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->event_id->FormValue)) {
            $this->event_id->addErrorMessage($this->event_id->getErrorMessage(false));
        }
        if ($this->event_time->Required) {
            if (!$this->event_time->IsDetailKey && EmptyValue($this->event_time->FormValue)) {
                $this->event_time->addErrorMessage(str_replace("%s", $this->event_time->caption(), $this->event_time->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->event_time->FormValue)) {
            $this->event_time->addErrorMessage($this->event_time->getErrorMessage(false));
        }
        if ($this->event_type->Required) {
            if (!$this->event_type->IsDetailKey && EmptyValue($this->event_type->FormValue)) {
                $this->event_type->addErrorMessage(str_replace("%s", $this->event_type->caption(), $this->event_type->RequiredErrorMessage));
            }
        }
        if ($this->pdf_link->Required) {
            if (!$this->pdf_link->IsDetailKey && EmptyValue($this->pdf_link->FormValue)) {
                $this->pdf_link->addErrorMessage(str_replace("%s", $this->pdf_link->caption(), $this->pdf_link->RequiredErrorMessage));
            }
        }
        if ($this->uploader->Required) {
            if (!$this->uploader->IsDetailKey && EmptyValue($this->uploader->FormValue)) {
                $this->uploader->addErrorMessage(str_replace("%s", $this->uploader->caption(), $this->uploader->RequiredErrorMessage));
            }
        }
        if ($this->timestamp->Required) {
            if (!$this->timestamp->IsDetailKey && EmptyValue($this->timestamp->FormValue)) {
                $this->timestamp->addErrorMessage(str_replace("%s", $this->timestamp->caption(), $this->timestamp->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->timestamp->FormValue)) {
            $this->timestamp->addErrorMessage($this->timestamp->getErrorMessage(false));
        }
        if ($this->data->Required) {
            if (!$this->data->IsDetailKey && EmptyValue($this->data->FormValue)) {
                $this->data->addErrorMessage(str_replace("%s", $this->data->caption(), $this->data->RequiredErrorMessage));
            }
        }
        if ($this->progress->Required) {
            if (!$this->progress->IsDetailKey && EmptyValue($this->progress->FormValue)) {
                $this->progress->addErrorMessage(str_replace("%s", $this->progress->caption(), $this->progress->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // event_id
        $this->event_id->setDbValueDef($rsnew, $this->event_id->CurrentValue, 0, false);

        // event_time
        $this->event_time->setDbValueDef($rsnew, UnFormatDateTime($this->event_time->CurrentValue, 0), CurrentDate(), false);

        // event_type
        $this->event_type->setDbValueDef($rsnew, $this->event_type->CurrentValue, null, strval($this->event_type->CurrentValue) == "");

        // pdf_link
        $this->pdf_link->setDbValueDef($rsnew, $this->pdf_link->CurrentValue, "", false);

        // uploader
        $this->uploader->setDbValueDef($rsnew, $this->uploader->CurrentValue, null, false);

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, false);

        // data
        $this->data->setDbValueDef($rsnew, $this->data->CurrentValue, null, false);

        // progress
        $this->progress->setDbValueDef($rsnew, $this->progress->CurrentValue, null, strval($this->progress->CurrentValue) == "");

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("EventOrdersList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
