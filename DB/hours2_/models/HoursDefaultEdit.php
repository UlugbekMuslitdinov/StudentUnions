<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class HoursDefaultEdit extends HoursDefault
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'hours_default';

    // Page object name
    public $PageObjName = "HoursDefaultEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

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
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
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
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
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

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (hours_default)
        if (!isset($GLOBALS["hours_default"]) || get_class($GLOBALS["hours_default"]) == PROJECT_NAMESPACE . "hours_default") {
            $GLOBALS["hours_default"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'hours_default');
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

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
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
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

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
                $tbl = Container("hours_default");
                $doc = new $class($tbl);
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
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
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
                    if ($pageName == "HoursDefaultView") {
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
            $key .= @$ar['hour_id'];
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
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
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
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->hour_id->setVisibility();
        $this->mon_open->setVisibility();
        $this->mon_close->setVisibility();
        $this->tue_open->setVisibility();
        $this->tue_close->setVisibility();
        $this->wed_open->setVisibility();
        $this->wed_close->setVisibility();
        $this->thu_open->setVisibility();
        $this->thu_close->setVisibility();
        $this->fri_open->setVisibility();
        $this->fri_close->setVisibility();
        $this->sat_open->setVisibility();
        $this->sat_close->setVisibility();
        $this->sun_open->setVisibility();
        $this->sun_close->setVisibility();
        $this->close->setVisibility();
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
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("hour_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->hour_id->setQueryStringValue($keyValue);
                $this->hour_id->setOldValue($this->hour_id->QueryStringValue);
            } elseif (Post("hour_id") !== null) {
                $this->hour_id->setFormValue(Post("hour_id"));
                $this->hour_id->setOldValue($this->hour_id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("hour_id") ?? Route("hour_id")) !== null) {
                    $this->hour_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->hour_id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("HoursDefaultList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "HoursDefaultList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'hour_id' first before field var 'x_hour_id'
        $val = $CurrentForm->hasValue("hour_id") ? $CurrentForm->getValue("hour_id") : $CurrentForm->getValue("x_hour_id");
        if (!$this->hour_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hour_id->Visible = false; // Disable update for API request
            } else {
                $this->hour_id->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_hour_id")) {
            $this->hour_id->setOldValue($CurrentForm->getValue("o_hour_id"));
        }

        // Check field name 'mon_open' first before field var 'x_mon_open'
        $val = $CurrentForm->hasValue("mon_open") ? $CurrentForm->getValue("mon_open") : $CurrentForm->getValue("x_mon_open");
        if (!$this->mon_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mon_open->Visible = false; // Disable update for API request
            } else {
                $this->mon_open->setFormValue($val, true, $validate);
            }
            $this->mon_open->CurrentValue = UnFormatDateTime($this->mon_open->CurrentValue, $this->mon_open->formatPattern());
        }

        // Check field name 'mon_close' first before field var 'x_mon_close'
        $val = $CurrentForm->hasValue("mon_close") ? $CurrentForm->getValue("mon_close") : $CurrentForm->getValue("x_mon_close");
        if (!$this->mon_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mon_close->Visible = false; // Disable update for API request
            } else {
                $this->mon_close->setFormValue($val, true, $validate);
            }
            $this->mon_close->CurrentValue = UnFormatDateTime($this->mon_close->CurrentValue, $this->mon_close->formatPattern());
        }

        // Check field name 'tue_open' first before field var 'x_tue_open'
        $val = $CurrentForm->hasValue("tue_open") ? $CurrentForm->getValue("tue_open") : $CurrentForm->getValue("x_tue_open");
        if (!$this->tue_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tue_open->Visible = false; // Disable update for API request
            } else {
                $this->tue_open->setFormValue($val, true, $validate);
            }
            $this->tue_open->CurrentValue = UnFormatDateTime($this->tue_open->CurrentValue, $this->tue_open->formatPattern());
        }

        // Check field name 'tue_close' first before field var 'x_tue_close'
        $val = $CurrentForm->hasValue("tue_close") ? $CurrentForm->getValue("tue_close") : $CurrentForm->getValue("x_tue_close");
        if (!$this->tue_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tue_close->Visible = false; // Disable update for API request
            } else {
                $this->tue_close->setFormValue($val, true, $validate);
            }
            $this->tue_close->CurrentValue = UnFormatDateTime($this->tue_close->CurrentValue, $this->tue_close->formatPattern());
        }

        // Check field name 'wed_open' first before field var 'x_wed_open'
        $val = $CurrentForm->hasValue("wed_open") ? $CurrentForm->getValue("wed_open") : $CurrentForm->getValue("x_wed_open");
        if (!$this->wed_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->wed_open->Visible = false; // Disable update for API request
            } else {
                $this->wed_open->setFormValue($val, true, $validate);
            }
            $this->wed_open->CurrentValue = UnFormatDateTime($this->wed_open->CurrentValue, $this->wed_open->formatPattern());
        }

        // Check field name 'wed_close' first before field var 'x_wed_close'
        $val = $CurrentForm->hasValue("wed_close") ? $CurrentForm->getValue("wed_close") : $CurrentForm->getValue("x_wed_close");
        if (!$this->wed_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->wed_close->Visible = false; // Disable update for API request
            } else {
                $this->wed_close->setFormValue($val, true, $validate);
            }
            $this->wed_close->CurrentValue = UnFormatDateTime($this->wed_close->CurrentValue, $this->wed_close->formatPattern());
        }

        // Check field name 'thu_open' first before field var 'x_thu_open'
        $val = $CurrentForm->hasValue("thu_open") ? $CurrentForm->getValue("thu_open") : $CurrentForm->getValue("x_thu_open");
        if (!$this->thu_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->thu_open->Visible = false; // Disable update for API request
            } else {
                $this->thu_open->setFormValue($val, true, $validate);
            }
            $this->thu_open->CurrentValue = UnFormatDateTime($this->thu_open->CurrentValue, $this->thu_open->formatPattern());
        }

        // Check field name 'thu_close' first before field var 'x_thu_close'
        $val = $CurrentForm->hasValue("thu_close") ? $CurrentForm->getValue("thu_close") : $CurrentForm->getValue("x_thu_close");
        if (!$this->thu_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->thu_close->Visible = false; // Disable update for API request
            } else {
                $this->thu_close->setFormValue($val, true, $validate);
            }
            $this->thu_close->CurrentValue = UnFormatDateTime($this->thu_close->CurrentValue, $this->thu_close->formatPattern());
        }

        // Check field name 'fri_open' first before field var 'x_fri_open'
        $val = $CurrentForm->hasValue("fri_open") ? $CurrentForm->getValue("fri_open") : $CurrentForm->getValue("x_fri_open");
        if (!$this->fri_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fri_open->Visible = false; // Disable update for API request
            } else {
                $this->fri_open->setFormValue($val, true, $validate);
            }
            $this->fri_open->CurrentValue = UnFormatDateTime($this->fri_open->CurrentValue, $this->fri_open->formatPattern());
        }

        // Check field name 'fri_close' first before field var 'x_fri_close'
        $val = $CurrentForm->hasValue("fri_close") ? $CurrentForm->getValue("fri_close") : $CurrentForm->getValue("x_fri_close");
        if (!$this->fri_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fri_close->Visible = false; // Disable update for API request
            } else {
                $this->fri_close->setFormValue($val, true, $validate);
            }
            $this->fri_close->CurrentValue = UnFormatDateTime($this->fri_close->CurrentValue, $this->fri_close->formatPattern());
        }

        // Check field name 'sat_open' first before field var 'x_sat_open'
        $val = $CurrentForm->hasValue("sat_open") ? $CurrentForm->getValue("sat_open") : $CurrentForm->getValue("x_sat_open");
        if (!$this->sat_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sat_open->Visible = false; // Disable update for API request
            } else {
                $this->sat_open->setFormValue($val, true, $validate);
            }
            $this->sat_open->CurrentValue = UnFormatDateTime($this->sat_open->CurrentValue, $this->sat_open->formatPattern());
        }

        // Check field name 'sat_close' first before field var 'x_sat_close'
        $val = $CurrentForm->hasValue("sat_close") ? $CurrentForm->getValue("sat_close") : $CurrentForm->getValue("x_sat_close");
        if (!$this->sat_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sat_close->Visible = false; // Disable update for API request
            } else {
                $this->sat_close->setFormValue($val, true, $validate);
            }
            $this->sat_close->CurrentValue = UnFormatDateTime($this->sat_close->CurrentValue, $this->sat_close->formatPattern());
        }

        // Check field name 'sun_open' first before field var 'x_sun_open'
        $val = $CurrentForm->hasValue("sun_open") ? $CurrentForm->getValue("sun_open") : $CurrentForm->getValue("x_sun_open");
        if (!$this->sun_open->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sun_open->Visible = false; // Disable update for API request
            } else {
                $this->sun_open->setFormValue($val, true, $validate);
            }
            $this->sun_open->CurrentValue = UnFormatDateTime($this->sun_open->CurrentValue, $this->sun_open->formatPattern());
        }

        // Check field name 'sun_close' first before field var 'x_sun_close'
        $val = $CurrentForm->hasValue("sun_close") ? $CurrentForm->getValue("sun_close") : $CurrentForm->getValue("x_sun_close");
        if (!$this->sun_close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sun_close->Visible = false; // Disable update for API request
            } else {
                $this->sun_close->setFormValue($val, true, $validate);
            }
            $this->sun_close->CurrentValue = UnFormatDateTime($this->sun_close->CurrentValue, $this->sun_close->formatPattern());
        }

        // Check field name 'close' first before field var 'x_close'
        $val = $CurrentForm->hasValue("close") ? $CurrentForm->getValue("close") : $CurrentForm->getValue("x_close");
        if (!$this->close->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->close->Visible = false; // Disable update for API request
            } else {
                $this->close->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->hour_id->CurrentValue = $this->hour_id->FormValue;
        $this->mon_open->CurrentValue = $this->mon_open->FormValue;
        $this->mon_open->CurrentValue = UnFormatDateTime($this->mon_open->CurrentValue, $this->mon_open->formatPattern());
        $this->mon_close->CurrentValue = $this->mon_close->FormValue;
        $this->mon_close->CurrentValue = UnFormatDateTime($this->mon_close->CurrentValue, $this->mon_close->formatPattern());
        $this->tue_open->CurrentValue = $this->tue_open->FormValue;
        $this->tue_open->CurrentValue = UnFormatDateTime($this->tue_open->CurrentValue, $this->tue_open->formatPattern());
        $this->tue_close->CurrentValue = $this->tue_close->FormValue;
        $this->tue_close->CurrentValue = UnFormatDateTime($this->tue_close->CurrentValue, $this->tue_close->formatPattern());
        $this->wed_open->CurrentValue = $this->wed_open->FormValue;
        $this->wed_open->CurrentValue = UnFormatDateTime($this->wed_open->CurrentValue, $this->wed_open->formatPattern());
        $this->wed_close->CurrentValue = $this->wed_close->FormValue;
        $this->wed_close->CurrentValue = UnFormatDateTime($this->wed_close->CurrentValue, $this->wed_close->formatPattern());
        $this->thu_open->CurrentValue = $this->thu_open->FormValue;
        $this->thu_open->CurrentValue = UnFormatDateTime($this->thu_open->CurrentValue, $this->thu_open->formatPattern());
        $this->thu_close->CurrentValue = $this->thu_close->FormValue;
        $this->thu_close->CurrentValue = UnFormatDateTime($this->thu_close->CurrentValue, $this->thu_close->formatPattern());
        $this->fri_open->CurrentValue = $this->fri_open->FormValue;
        $this->fri_open->CurrentValue = UnFormatDateTime($this->fri_open->CurrentValue, $this->fri_open->formatPattern());
        $this->fri_close->CurrentValue = $this->fri_close->FormValue;
        $this->fri_close->CurrentValue = UnFormatDateTime($this->fri_close->CurrentValue, $this->fri_close->formatPattern());
        $this->sat_open->CurrentValue = $this->sat_open->FormValue;
        $this->sat_open->CurrentValue = UnFormatDateTime($this->sat_open->CurrentValue, $this->sat_open->formatPattern());
        $this->sat_close->CurrentValue = $this->sat_close->FormValue;
        $this->sat_close->CurrentValue = UnFormatDateTime($this->sat_close->CurrentValue, $this->sat_close->formatPattern());
        $this->sun_open->CurrentValue = $this->sun_open->FormValue;
        $this->sun_open->CurrentValue = UnFormatDateTime($this->sun_open->CurrentValue, $this->sun_open->formatPattern());
        $this->sun_close->CurrentValue = $this->sun_close->FormValue;
        $this->sun_close->CurrentValue = UnFormatDateTime($this->sun_close->CurrentValue, $this->sun_close->formatPattern());
        $this->close->CurrentValue = $this->close->FormValue;
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
        $row = $conn->fetchAssociative($sql);
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
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->hour_id->setDbValue($row['hour_id']);
        $this->mon_open->setDbValue($row['mon_open']);
        $this->mon_close->setDbValue($row['mon_close']);
        $this->tue_open->setDbValue($row['tue_open']);
        $this->tue_close->setDbValue($row['tue_close']);
        $this->wed_open->setDbValue($row['wed_open']);
        $this->wed_close->setDbValue($row['wed_close']);
        $this->thu_open->setDbValue($row['thu_open']);
        $this->thu_close->setDbValue($row['thu_close']);
        $this->fri_open->setDbValue($row['fri_open']);
        $this->fri_close->setDbValue($row['fri_close']);
        $this->sat_open->setDbValue($row['sat_open']);
        $this->sat_close->setDbValue($row['sat_close']);
        $this->sun_open->setDbValue($row['sun_open']);
        $this->sun_close->setDbValue($row['sun_close']);
        $this->close->setDbValue($row['close']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['hour_id'] = null;
        $row['mon_open'] = null;
        $row['mon_close'] = null;
        $row['tue_open'] = null;
        $row['tue_close'] = null;
        $row['wed_open'] = null;
        $row['wed_close'] = null;
        $row['thu_open'] = null;
        $row['thu_close'] = null;
        $row['fri_open'] = null;
        $row['fri_close'] = null;
        $row['sat_open'] = null;
        $row['sat_close'] = null;
        $row['sun_open'] = null;
        $row['sun_close'] = null;
        $row['close'] = null;
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

        // hour_id
        $this->hour_id->RowCssClass = "row";

        // mon_open
        $this->mon_open->RowCssClass = "row";

        // mon_close
        $this->mon_close->RowCssClass = "row";

        // tue_open
        $this->tue_open->RowCssClass = "row";

        // tue_close
        $this->tue_close->RowCssClass = "row";

        // wed_open
        $this->wed_open->RowCssClass = "row";

        // wed_close
        $this->wed_close->RowCssClass = "row";

        // thu_open
        $this->thu_open->RowCssClass = "row";

        // thu_close
        $this->thu_close->RowCssClass = "row";

        // fri_open
        $this->fri_open->RowCssClass = "row";

        // fri_close
        $this->fri_close->RowCssClass = "row";

        // sat_open
        $this->sat_open->RowCssClass = "row";

        // sat_close
        $this->sat_close->RowCssClass = "row";

        // sun_open
        $this->sun_open->RowCssClass = "row";

        // sun_close
        $this->sun_close->RowCssClass = "row";

        // close
        $this->close->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // hour_id
            $this->hour_id->ViewValue = $this->hour_id->CurrentValue;
            $this->hour_id->ViewValue = FormatNumber($this->hour_id->ViewValue, "");
            $this->hour_id->ViewCustomAttributes = "";

            // mon_open
            $this->mon_open->ViewValue = $this->mon_open->CurrentValue;
            $this->mon_open->ViewValue = FormatDateTime($this->mon_open->ViewValue, 4);
            $this->mon_open->ViewCustomAttributes = "";

            // mon_close
            $this->mon_close->ViewValue = $this->mon_close->CurrentValue;
            $this->mon_close->ViewValue = FormatDateTime($this->mon_close->ViewValue, 4);
            $this->mon_close->ViewCustomAttributes = "";

            // tue_open
            $this->tue_open->ViewValue = $this->tue_open->CurrentValue;
            $this->tue_open->ViewValue = FormatDateTime($this->tue_open->ViewValue, 4);
            $this->tue_open->ViewCustomAttributes = "";

            // tue_close
            $this->tue_close->ViewValue = $this->tue_close->CurrentValue;
            $this->tue_close->ViewValue = FormatDateTime($this->tue_close->ViewValue, 4);
            $this->tue_close->ViewCustomAttributes = "";

            // wed_open
            $this->wed_open->ViewValue = $this->wed_open->CurrentValue;
            $this->wed_open->ViewValue = FormatDateTime($this->wed_open->ViewValue, 4);
            $this->wed_open->ViewCustomAttributes = "";

            // wed_close
            $this->wed_close->ViewValue = $this->wed_close->CurrentValue;
            $this->wed_close->ViewValue = FormatDateTime($this->wed_close->ViewValue, 4);
            $this->wed_close->ViewCustomAttributes = "";

            // thu_open
            $this->thu_open->ViewValue = $this->thu_open->CurrentValue;
            $this->thu_open->ViewValue = FormatDateTime($this->thu_open->ViewValue, 4);
            $this->thu_open->ViewCustomAttributes = "";

            // thu_close
            $this->thu_close->ViewValue = $this->thu_close->CurrentValue;
            $this->thu_close->ViewValue = FormatDateTime($this->thu_close->ViewValue, 4);
            $this->thu_close->ViewCustomAttributes = "";

            // fri_open
            $this->fri_open->ViewValue = $this->fri_open->CurrentValue;
            $this->fri_open->ViewValue = FormatDateTime($this->fri_open->ViewValue, 4);
            $this->fri_open->ViewCustomAttributes = "";

            // fri_close
            $this->fri_close->ViewValue = $this->fri_close->CurrentValue;
            $this->fri_close->ViewValue = FormatDateTime($this->fri_close->ViewValue, 4);
            $this->fri_close->ViewCustomAttributes = "";

            // sat_open
            $this->sat_open->ViewValue = $this->sat_open->CurrentValue;
            $this->sat_open->ViewValue = FormatDateTime($this->sat_open->ViewValue, 4);
            $this->sat_open->ViewCustomAttributes = "";

            // sat_close
            $this->sat_close->ViewValue = $this->sat_close->CurrentValue;
            $this->sat_close->ViewValue = FormatDateTime($this->sat_close->ViewValue, 4);
            $this->sat_close->ViewCustomAttributes = "";

            // sun_open
            $this->sun_open->ViewValue = $this->sun_open->CurrentValue;
            $this->sun_open->ViewValue = FormatDateTime($this->sun_open->ViewValue, 4);
            $this->sun_open->ViewCustomAttributes = "";

            // sun_close
            $this->sun_close->ViewValue = $this->sun_close->CurrentValue;
            $this->sun_close->ViewValue = FormatDateTime($this->sun_close->ViewValue, 4);
            $this->sun_close->ViewCustomAttributes = "";

            // close
            $this->close->ViewValue = $this->close->CurrentValue;
            $this->close->ViewCustomAttributes = "";

            // hour_id
            $this->hour_id->LinkCustomAttributes = "";
            $this->hour_id->HrefValue = "";

            // mon_open
            $this->mon_open->LinkCustomAttributes = "";
            $this->mon_open->HrefValue = "";

            // mon_close
            $this->mon_close->LinkCustomAttributes = "";
            $this->mon_close->HrefValue = "";

            // tue_open
            $this->tue_open->LinkCustomAttributes = "";
            $this->tue_open->HrefValue = "";

            // tue_close
            $this->tue_close->LinkCustomAttributes = "";
            $this->tue_close->HrefValue = "";

            // wed_open
            $this->wed_open->LinkCustomAttributes = "";
            $this->wed_open->HrefValue = "";

            // wed_close
            $this->wed_close->LinkCustomAttributes = "";
            $this->wed_close->HrefValue = "";

            // thu_open
            $this->thu_open->LinkCustomAttributes = "";
            $this->thu_open->HrefValue = "";

            // thu_close
            $this->thu_close->LinkCustomAttributes = "";
            $this->thu_close->HrefValue = "";

            // fri_open
            $this->fri_open->LinkCustomAttributes = "";
            $this->fri_open->HrefValue = "";

            // fri_close
            $this->fri_close->LinkCustomAttributes = "";
            $this->fri_close->HrefValue = "";

            // sat_open
            $this->sat_open->LinkCustomAttributes = "";
            $this->sat_open->HrefValue = "";

            // sat_close
            $this->sat_close->LinkCustomAttributes = "";
            $this->sat_close->HrefValue = "";

            // sun_open
            $this->sun_open->LinkCustomAttributes = "";
            $this->sun_open->HrefValue = "";

            // sun_close
            $this->sun_close->LinkCustomAttributes = "";
            $this->sun_close->HrefValue = "";

            // close
            $this->close->LinkCustomAttributes = "";
            $this->close->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // hour_id
            $this->hour_id->setupEditAttributes();
            $this->hour_id->EditCustomAttributes = "";
            $this->hour_id->EditValue = HtmlEncode($this->hour_id->CurrentValue);
            $this->hour_id->PlaceHolder = RemoveHtml($this->hour_id->caption());

            // mon_open
            $this->mon_open->setupEditAttributes();
            $this->mon_open->EditCustomAttributes = "";
            $this->mon_open->EditValue = HtmlEncode(FormatDateTime($this->mon_open->CurrentValue, 4));
            $this->mon_open->PlaceHolder = RemoveHtml($this->mon_open->caption());

            // mon_close
            $this->mon_close->setupEditAttributes();
            $this->mon_close->EditCustomAttributes = "";
            $this->mon_close->EditValue = HtmlEncode(FormatDateTime($this->mon_close->CurrentValue, 4));
            $this->mon_close->PlaceHolder = RemoveHtml($this->mon_close->caption());

            // tue_open
            $this->tue_open->setupEditAttributes();
            $this->tue_open->EditCustomAttributes = "";
            $this->tue_open->EditValue = HtmlEncode(FormatDateTime($this->tue_open->CurrentValue, 4));
            $this->tue_open->PlaceHolder = RemoveHtml($this->tue_open->caption());

            // tue_close
            $this->tue_close->setupEditAttributes();
            $this->tue_close->EditCustomAttributes = "";
            $this->tue_close->EditValue = HtmlEncode(FormatDateTime($this->tue_close->CurrentValue, 4));
            $this->tue_close->PlaceHolder = RemoveHtml($this->tue_close->caption());

            // wed_open
            $this->wed_open->setupEditAttributes();
            $this->wed_open->EditCustomAttributes = "";
            $this->wed_open->EditValue = HtmlEncode(FormatDateTime($this->wed_open->CurrentValue, 4));
            $this->wed_open->PlaceHolder = RemoveHtml($this->wed_open->caption());

            // wed_close
            $this->wed_close->setupEditAttributes();
            $this->wed_close->EditCustomAttributes = "";
            $this->wed_close->EditValue = HtmlEncode(FormatDateTime($this->wed_close->CurrentValue, 4));
            $this->wed_close->PlaceHolder = RemoveHtml($this->wed_close->caption());

            // thu_open
            $this->thu_open->setupEditAttributes();
            $this->thu_open->EditCustomAttributes = "";
            $this->thu_open->EditValue = HtmlEncode(FormatDateTime($this->thu_open->CurrentValue, 4));
            $this->thu_open->PlaceHolder = RemoveHtml($this->thu_open->caption());

            // thu_close
            $this->thu_close->setupEditAttributes();
            $this->thu_close->EditCustomAttributes = "";
            $this->thu_close->EditValue = HtmlEncode(FormatDateTime($this->thu_close->CurrentValue, 4));
            $this->thu_close->PlaceHolder = RemoveHtml($this->thu_close->caption());

            // fri_open
            $this->fri_open->setupEditAttributes();
            $this->fri_open->EditCustomAttributes = "";
            $this->fri_open->EditValue = HtmlEncode(FormatDateTime($this->fri_open->CurrentValue, 4));
            $this->fri_open->PlaceHolder = RemoveHtml($this->fri_open->caption());

            // fri_close
            $this->fri_close->setupEditAttributes();
            $this->fri_close->EditCustomAttributes = "";
            $this->fri_close->EditValue = HtmlEncode(FormatDateTime($this->fri_close->CurrentValue, 4));
            $this->fri_close->PlaceHolder = RemoveHtml($this->fri_close->caption());

            // sat_open
            $this->sat_open->setupEditAttributes();
            $this->sat_open->EditCustomAttributes = "";
            $this->sat_open->EditValue = HtmlEncode(FormatDateTime($this->sat_open->CurrentValue, 4));
            $this->sat_open->PlaceHolder = RemoveHtml($this->sat_open->caption());

            // sat_close
            $this->sat_close->setupEditAttributes();
            $this->sat_close->EditCustomAttributes = "";
            $this->sat_close->EditValue = HtmlEncode(FormatDateTime($this->sat_close->CurrentValue, 4));
            $this->sat_close->PlaceHolder = RemoveHtml($this->sat_close->caption());

            // sun_open
            $this->sun_open->setupEditAttributes();
            $this->sun_open->EditCustomAttributes = "";
            $this->sun_open->EditValue = HtmlEncode(FormatDateTime($this->sun_open->CurrentValue, 4));
            $this->sun_open->PlaceHolder = RemoveHtml($this->sun_open->caption());

            // sun_close
            $this->sun_close->setupEditAttributes();
            $this->sun_close->EditCustomAttributes = "";
            $this->sun_close->EditValue = HtmlEncode(FormatDateTime($this->sun_close->CurrentValue, 4));
            $this->sun_close->PlaceHolder = RemoveHtml($this->sun_close->caption());

            // close
            $this->close->setupEditAttributes();
            $this->close->EditCustomAttributes = "";
            if (!$this->close->Raw) {
                $this->close->CurrentValue = HtmlDecode($this->close->CurrentValue);
            }
            $this->close->EditValue = HtmlEncode($this->close->CurrentValue);
            $this->close->PlaceHolder = RemoveHtml($this->close->caption());

            // Edit refer script

            // hour_id
            $this->hour_id->LinkCustomAttributes = "";
            $this->hour_id->HrefValue = "";

            // mon_open
            $this->mon_open->LinkCustomAttributes = "";
            $this->mon_open->HrefValue = "";

            // mon_close
            $this->mon_close->LinkCustomAttributes = "";
            $this->mon_close->HrefValue = "";

            // tue_open
            $this->tue_open->LinkCustomAttributes = "";
            $this->tue_open->HrefValue = "";

            // tue_close
            $this->tue_close->LinkCustomAttributes = "";
            $this->tue_close->HrefValue = "";

            // wed_open
            $this->wed_open->LinkCustomAttributes = "";
            $this->wed_open->HrefValue = "";

            // wed_close
            $this->wed_close->LinkCustomAttributes = "";
            $this->wed_close->HrefValue = "";

            // thu_open
            $this->thu_open->LinkCustomAttributes = "";
            $this->thu_open->HrefValue = "";

            // thu_close
            $this->thu_close->LinkCustomAttributes = "";
            $this->thu_close->HrefValue = "";

            // fri_open
            $this->fri_open->LinkCustomAttributes = "";
            $this->fri_open->HrefValue = "";

            // fri_close
            $this->fri_close->LinkCustomAttributes = "";
            $this->fri_close->HrefValue = "";

            // sat_open
            $this->sat_open->LinkCustomAttributes = "";
            $this->sat_open->HrefValue = "";

            // sat_close
            $this->sat_close->LinkCustomAttributes = "";
            $this->sat_close->HrefValue = "";

            // sun_open
            $this->sun_open->LinkCustomAttributes = "";
            $this->sun_open->HrefValue = "";

            // sun_close
            $this->sun_close->LinkCustomAttributes = "";
            $this->sun_close->HrefValue = "";

            // close
            $this->close->LinkCustomAttributes = "";
            $this->close->HrefValue = "";
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
        $validateForm = true;
        if ($this->hour_id->Required) {
            if (!$this->hour_id->IsDetailKey && EmptyValue($this->hour_id->FormValue)) {
                $this->hour_id->addErrorMessage(str_replace("%s", $this->hour_id->caption(), $this->hour_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->hour_id->FormValue)) {
            $this->hour_id->addErrorMessage($this->hour_id->getErrorMessage(false));
        }
        if ($this->mon_open->Required) {
            if (!$this->mon_open->IsDetailKey && EmptyValue($this->mon_open->FormValue)) {
                $this->mon_open->addErrorMessage(str_replace("%s", $this->mon_open->caption(), $this->mon_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->mon_open->FormValue, $this->mon_open->formatPattern())) {
            $this->mon_open->addErrorMessage($this->mon_open->getErrorMessage(false));
        }
        if ($this->mon_close->Required) {
            if (!$this->mon_close->IsDetailKey && EmptyValue($this->mon_close->FormValue)) {
                $this->mon_close->addErrorMessage(str_replace("%s", $this->mon_close->caption(), $this->mon_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->mon_close->FormValue, $this->mon_close->formatPattern())) {
            $this->mon_close->addErrorMessage($this->mon_close->getErrorMessage(false));
        }
        if ($this->tue_open->Required) {
            if (!$this->tue_open->IsDetailKey && EmptyValue($this->tue_open->FormValue)) {
                $this->tue_open->addErrorMessage(str_replace("%s", $this->tue_open->caption(), $this->tue_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->tue_open->FormValue, $this->tue_open->formatPattern())) {
            $this->tue_open->addErrorMessage($this->tue_open->getErrorMessage(false));
        }
        if ($this->tue_close->Required) {
            if (!$this->tue_close->IsDetailKey && EmptyValue($this->tue_close->FormValue)) {
                $this->tue_close->addErrorMessage(str_replace("%s", $this->tue_close->caption(), $this->tue_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->tue_close->FormValue, $this->tue_close->formatPattern())) {
            $this->tue_close->addErrorMessage($this->tue_close->getErrorMessage(false));
        }
        if ($this->wed_open->Required) {
            if (!$this->wed_open->IsDetailKey && EmptyValue($this->wed_open->FormValue)) {
                $this->wed_open->addErrorMessage(str_replace("%s", $this->wed_open->caption(), $this->wed_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->wed_open->FormValue, $this->wed_open->formatPattern())) {
            $this->wed_open->addErrorMessage($this->wed_open->getErrorMessage(false));
        }
        if ($this->wed_close->Required) {
            if (!$this->wed_close->IsDetailKey && EmptyValue($this->wed_close->FormValue)) {
                $this->wed_close->addErrorMessage(str_replace("%s", $this->wed_close->caption(), $this->wed_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->wed_close->FormValue, $this->wed_close->formatPattern())) {
            $this->wed_close->addErrorMessage($this->wed_close->getErrorMessage(false));
        }
        if ($this->thu_open->Required) {
            if (!$this->thu_open->IsDetailKey && EmptyValue($this->thu_open->FormValue)) {
                $this->thu_open->addErrorMessage(str_replace("%s", $this->thu_open->caption(), $this->thu_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->thu_open->FormValue, $this->thu_open->formatPattern())) {
            $this->thu_open->addErrorMessage($this->thu_open->getErrorMessage(false));
        }
        if ($this->thu_close->Required) {
            if (!$this->thu_close->IsDetailKey && EmptyValue($this->thu_close->FormValue)) {
                $this->thu_close->addErrorMessage(str_replace("%s", $this->thu_close->caption(), $this->thu_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->thu_close->FormValue, $this->thu_close->formatPattern())) {
            $this->thu_close->addErrorMessage($this->thu_close->getErrorMessage(false));
        }
        if ($this->fri_open->Required) {
            if (!$this->fri_open->IsDetailKey && EmptyValue($this->fri_open->FormValue)) {
                $this->fri_open->addErrorMessage(str_replace("%s", $this->fri_open->caption(), $this->fri_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->fri_open->FormValue, $this->fri_open->formatPattern())) {
            $this->fri_open->addErrorMessage($this->fri_open->getErrorMessage(false));
        }
        if ($this->fri_close->Required) {
            if (!$this->fri_close->IsDetailKey && EmptyValue($this->fri_close->FormValue)) {
                $this->fri_close->addErrorMessage(str_replace("%s", $this->fri_close->caption(), $this->fri_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->fri_close->FormValue, $this->fri_close->formatPattern())) {
            $this->fri_close->addErrorMessage($this->fri_close->getErrorMessage(false));
        }
        if ($this->sat_open->Required) {
            if (!$this->sat_open->IsDetailKey && EmptyValue($this->sat_open->FormValue)) {
                $this->sat_open->addErrorMessage(str_replace("%s", $this->sat_open->caption(), $this->sat_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->sat_open->FormValue, $this->sat_open->formatPattern())) {
            $this->sat_open->addErrorMessage($this->sat_open->getErrorMessage(false));
        }
        if ($this->sat_close->Required) {
            if (!$this->sat_close->IsDetailKey && EmptyValue($this->sat_close->FormValue)) {
                $this->sat_close->addErrorMessage(str_replace("%s", $this->sat_close->caption(), $this->sat_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->sat_close->FormValue, $this->sat_close->formatPattern())) {
            $this->sat_close->addErrorMessage($this->sat_close->getErrorMessage(false));
        }
        if ($this->sun_open->Required) {
            if (!$this->sun_open->IsDetailKey && EmptyValue($this->sun_open->FormValue)) {
                $this->sun_open->addErrorMessage(str_replace("%s", $this->sun_open->caption(), $this->sun_open->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->sun_open->FormValue, $this->sun_open->formatPattern())) {
            $this->sun_open->addErrorMessage($this->sun_open->getErrorMessage(false));
        }
        if ($this->sun_close->Required) {
            if (!$this->sun_close->IsDetailKey && EmptyValue($this->sun_close->FormValue)) {
                $this->sun_close->addErrorMessage(str_replace("%s", $this->sun_close->caption(), $this->sun_close->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->sun_close->FormValue, $this->sun_close->formatPattern())) {
            $this->sun_close->addErrorMessage($this->sun_close->getErrorMessage(false));
        }
        if ($this->close->Required) {
            if (!$this->close->IsDetailKey && EmptyValue($this->close->FormValue)) {
                $this->close->addErrorMessage(str_replace("%s", $this->close->caption(), $this->close->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // hour_id
            $this->hour_id->setDbValueDef($rsnew, $this->hour_id->CurrentValue, 0, $this->hour_id->ReadOnly);

            // mon_open
            $this->mon_open->setDbValueDef($rsnew, UnFormatDateTime($this->mon_open->CurrentValue, $this->mon_open->formatPattern()), null, $this->mon_open->ReadOnly);

            // mon_close
            $this->mon_close->setDbValueDef($rsnew, UnFormatDateTime($this->mon_close->CurrentValue, $this->mon_close->formatPattern()), null, $this->mon_close->ReadOnly);

            // tue_open
            $this->tue_open->setDbValueDef($rsnew, UnFormatDateTime($this->tue_open->CurrentValue, $this->tue_open->formatPattern()), null, $this->tue_open->ReadOnly);

            // tue_close
            $this->tue_close->setDbValueDef($rsnew, UnFormatDateTime($this->tue_close->CurrentValue, $this->tue_close->formatPattern()), null, $this->tue_close->ReadOnly);

            // wed_open
            $this->wed_open->setDbValueDef($rsnew, UnFormatDateTime($this->wed_open->CurrentValue, $this->wed_open->formatPattern()), null, $this->wed_open->ReadOnly);

            // wed_close
            $this->wed_close->setDbValueDef($rsnew, UnFormatDateTime($this->wed_close->CurrentValue, $this->wed_close->formatPattern()), null, $this->wed_close->ReadOnly);

            // thu_open
            $this->thu_open->setDbValueDef($rsnew, UnFormatDateTime($this->thu_open->CurrentValue, $this->thu_open->formatPattern()), null, $this->thu_open->ReadOnly);

            // thu_close
            $this->thu_close->setDbValueDef($rsnew, UnFormatDateTime($this->thu_close->CurrentValue, $this->thu_close->formatPattern()), null, $this->thu_close->ReadOnly);

            // fri_open
            $this->fri_open->setDbValueDef($rsnew, UnFormatDateTime($this->fri_open->CurrentValue, $this->fri_open->formatPattern()), null, $this->fri_open->ReadOnly);

            // fri_close
            $this->fri_close->setDbValueDef($rsnew, UnFormatDateTime($this->fri_close->CurrentValue, $this->fri_close->formatPattern()), null, $this->fri_close->ReadOnly);

            // sat_open
            $this->sat_open->setDbValueDef($rsnew, UnFormatDateTime($this->sat_open->CurrentValue, $this->sat_open->formatPattern()), null, $this->sat_open->ReadOnly);

            // sat_close
            $this->sat_close->setDbValueDef($rsnew, UnFormatDateTime($this->sat_close->CurrentValue, $this->sat_close->formatPattern()), null, $this->sat_close->ReadOnly);

            // sun_open
            $this->sun_open->setDbValueDef($rsnew, UnFormatDateTime($this->sun_open->CurrentValue, $this->sun_open->formatPattern()), null, $this->sun_open->ReadOnly);

            // sun_close
            $this->sun_close->setDbValueDef($rsnew, UnFormatDateTime($this->sun_close->CurrentValue, $this->sun_close->formatPattern()), null, $this->sun_close->ReadOnly);

            // close
            $this->close->setDbValueDef($rsnew, $this->close->CurrentValue, null, $this->close->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("HoursDefaultList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
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
                $pageNo = ParseInteger($pageNo);
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

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
