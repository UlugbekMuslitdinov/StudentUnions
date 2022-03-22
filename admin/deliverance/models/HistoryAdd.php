<?php

namespace PHPMaker2021\project3;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class HistoryAdd extends History
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'history';

    // Page object name
    public $PageObjName = "HistoryAdd";

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

        // Table object (history)
        if (!isset($GLOBALS["history"]) || get_class($GLOBALS["history"]) == PROJECT_NAMESPACE . "history") {
            $GLOBALS["history"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'history');
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
                $doc = new $class(Container("history"));
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
                    if ($pageName == "HistoryView") {
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
        $this->netID->setVisibility();
        $this->_action->setVisibility();
        $this->server->setVisibility();
        $this->_page->setVisibility();
        $this->resourceName->setVisibility();
        $this->filePath->setVisibility();
        $this->site->setVisibility();
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
                    $this->terminate("HistoryList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "HistoryList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "HistoryView") {
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
        $this->netID->CurrentValue = null;
        $this->netID->OldValue = $this->netID->CurrentValue;
        $this->_action->CurrentValue = null;
        $this->_action->OldValue = $this->_action->CurrentValue;
        $this->server->CurrentValue = null;
        $this->server->OldValue = $this->server->CurrentValue;
        $this->_page->CurrentValue = null;
        $this->_page->OldValue = $this->_page->CurrentValue;
        $this->resourceName->CurrentValue = null;
        $this->resourceName->OldValue = $this->resourceName->CurrentValue;
        $this->filePath->CurrentValue = null;
        $this->filePath->OldValue = $this->filePath->CurrentValue;
        $this->site->CurrentValue = null;
        $this->site->OldValue = $this->site->CurrentValue;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'netID' first before field var 'x_netID'
        $val = $CurrentForm->hasValue("netID") ? $CurrentForm->getValue("netID") : $CurrentForm->getValue("x_netID");
        if (!$this->netID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->netID->Visible = false; // Disable update for API request
            } else {
                $this->netID->setFormValue($val);
            }
        }

        // Check field name '_action' first before field var 'x__action'
        $val = $CurrentForm->hasValue("_action") ? $CurrentForm->getValue("_action") : $CurrentForm->getValue("x__action");
        if (!$this->_action->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_action->Visible = false; // Disable update for API request
            } else {
                $this->_action->setFormValue($val);
            }
        }

        // Check field name 'server' first before field var 'x_server'
        $val = $CurrentForm->hasValue("server") ? $CurrentForm->getValue("server") : $CurrentForm->getValue("x_server");
        if (!$this->server->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->server->Visible = false; // Disable update for API request
            } else {
                $this->server->setFormValue($val);
            }
        }

        // Check field name 'page' first before field var 'x__page'
        $val = $CurrentForm->hasValue("page") ? $CurrentForm->getValue("page") : $CurrentForm->getValue("x__page");
        if (!$this->_page->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_page->Visible = false; // Disable update for API request
            } else {
                $this->_page->setFormValue($val);
            }
        }

        // Check field name 'resourceName' first before field var 'x_resourceName'
        $val = $CurrentForm->hasValue("resourceName") ? $CurrentForm->getValue("resourceName") : $CurrentForm->getValue("x_resourceName");
        if (!$this->resourceName->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resourceName->Visible = false; // Disable update for API request
            } else {
                $this->resourceName->setFormValue($val);
            }
        }

        // Check field name 'filePath' first before field var 'x_filePath'
        $val = $CurrentForm->hasValue("filePath") ? $CurrentForm->getValue("filePath") : $CurrentForm->getValue("x_filePath");
        if (!$this->filePath->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->filePath->Visible = false; // Disable update for API request
            } else {
                $this->filePath->setFormValue($val);
            }
        }

        // Check field name 'site' first before field var 'x_site'
        $val = $CurrentForm->hasValue("site") ? $CurrentForm->getValue("site") : $CurrentForm->getValue("x_site");
        if (!$this->site->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->site->Visible = false; // Disable update for API request
            } else {
                $this->site->setFormValue($val);
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
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->netID->CurrentValue = $this->netID->FormValue;
        $this->_action->CurrentValue = $this->_action->FormValue;
        $this->server->CurrentValue = $this->server->FormValue;
        $this->_page->CurrentValue = $this->_page->FormValue;
        $this->resourceName->CurrentValue = $this->resourceName->FormValue;
        $this->filePath->CurrentValue = $this->filePath->FormValue;
        $this->site->CurrentValue = $this->site->FormValue;
        $this->timestamp->CurrentValue = $this->timestamp->FormValue;
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
        $this->netID->setDbValue($row['netID']);
        $this->_action->setDbValue($row['action']);
        $this->server->setDbValue($row['server']);
        $this->_page->setDbValue($row['page']);
        $this->resourceName->setDbValue($row['resourceName']);
        $this->filePath->setDbValue($row['filePath']);
        $this->site->setDbValue($row['site']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['netID'] = $this->netID->CurrentValue;
        $row['action'] = $this->_action->CurrentValue;
        $row['server'] = $this->server->CurrentValue;
        $row['page'] = $this->_page->CurrentValue;
        $row['resourceName'] = $this->resourceName->CurrentValue;
        $row['filePath'] = $this->filePath->CurrentValue;
        $row['site'] = $this->site->CurrentValue;
        $row['timestamp'] = $this->timestamp->CurrentValue;
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

        // netID

        // action

        // server

        // page

        // resourceName

        // filePath

        // site

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // netID
            $this->netID->ViewValue = $this->netID->CurrentValue;
            $this->netID->ViewCustomAttributes = "";

            // action
            $this->_action->ViewValue = $this->_action->CurrentValue;
            $this->_action->ViewCustomAttributes = "";

            // server
            $this->server->ViewValue = $this->server->CurrentValue;
            $this->server->ViewCustomAttributes = "";

            // page
            $this->_page->ViewValue = $this->_page->CurrentValue;
            $this->_page->ViewCustomAttributes = "";

            // resourceName
            $this->resourceName->ViewValue = $this->resourceName->CurrentValue;
            $this->resourceName->ViewCustomAttributes = "";

            // filePath
            $this->filePath->ViewValue = $this->filePath->CurrentValue;
            $this->filePath->ViewCustomAttributes = "";

            // site
            $this->site->ViewValue = $this->site->CurrentValue;
            $this->site->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatNumber($this->timestamp->ViewValue, 0, -2, -2, -2);
            $this->timestamp->ViewCustomAttributes = "";

            // netID
            $this->netID->LinkCustomAttributes = "";
            $this->netID->HrefValue = "";
            $this->netID->TooltipValue = "";

            // action
            $this->_action->LinkCustomAttributes = "";
            $this->_action->HrefValue = "";
            $this->_action->TooltipValue = "";

            // server
            $this->server->LinkCustomAttributes = "";
            $this->server->HrefValue = "";
            $this->server->TooltipValue = "";

            // page
            $this->_page->LinkCustomAttributes = "";
            $this->_page->HrefValue = "";
            $this->_page->TooltipValue = "";

            // resourceName
            $this->resourceName->LinkCustomAttributes = "";
            $this->resourceName->HrefValue = "";
            $this->resourceName->TooltipValue = "";

            // filePath
            $this->filePath->LinkCustomAttributes = "";
            $this->filePath->HrefValue = "";
            $this->filePath->TooltipValue = "";

            // site
            $this->site->LinkCustomAttributes = "";
            $this->site->HrefValue = "";
            $this->site->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // netID
            $this->netID->EditAttrs["class"] = "form-control";
            $this->netID->EditCustomAttributes = "";
            if (!$this->netID->Raw) {
                $this->netID->CurrentValue = HtmlDecode($this->netID->CurrentValue);
            }
            $this->netID->EditValue = HtmlEncode($this->netID->CurrentValue);
            $this->netID->PlaceHolder = RemoveHtml($this->netID->caption());

            // action
            $this->_action->EditAttrs["class"] = "form-control";
            $this->_action->EditCustomAttributes = "";
            if (!$this->_action->Raw) {
                $this->_action->CurrentValue = HtmlDecode($this->_action->CurrentValue);
            }
            $this->_action->EditValue = HtmlEncode($this->_action->CurrentValue);
            $this->_action->PlaceHolder = RemoveHtml($this->_action->caption());

            // server
            $this->server->EditAttrs["class"] = "form-control";
            $this->server->EditCustomAttributes = "";
            if (!$this->server->Raw) {
                $this->server->CurrentValue = HtmlDecode($this->server->CurrentValue);
            }
            $this->server->EditValue = HtmlEncode($this->server->CurrentValue);
            $this->server->PlaceHolder = RemoveHtml($this->server->caption());

            // page
            $this->_page->EditAttrs["class"] = "form-control";
            $this->_page->EditCustomAttributes = "";
            if (!$this->_page->Raw) {
                $this->_page->CurrentValue = HtmlDecode($this->_page->CurrentValue);
            }
            $this->_page->EditValue = HtmlEncode($this->_page->CurrentValue);
            $this->_page->PlaceHolder = RemoveHtml($this->_page->caption());

            // resourceName
            $this->resourceName->EditAttrs["class"] = "form-control";
            $this->resourceName->EditCustomAttributes = "";
            if (!$this->resourceName->Raw) {
                $this->resourceName->CurrentValue = HtmlDecode($this->resourceName->CurrentValue);
            }
            $this->resourceName->EditValue = HtmlEncode($this->resourceName->CurrentValue);
            $this->resourceName->PlaceHolder = RemoveHtml($this->resourceName->caption());

            // filePath
            $this->filePath->EditAttrs["class"] = "form-control";
            $this->filePath->EditCustomAttributes = "";
            if (!$this->filePath->Raw) {
                $this->filePath->CurrentValue = HtmlDecode($this->filePath->CurrentValue);
            }
            $this->filePath->EditValue = HtmlEncode($this->filePath->CurrentValue);
            $this->filePath->PlaceHolder = RemoveHtml($this->filePath->caption());

            // site
            $this->site->EditAttrs["class"] = "form-control";
            $this->site->EditCustomAttributes = "";
            if (!$this->site->Raw) {
                $this->site->CurrentValue = HtmlDecode($this->site->CurrentValue);
            }
            $this->site->EditValue = HtmlEncode($this->site->CurrentValue);
            $this->site->PlaceHolder = RemoveHtml($this->site->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode($this->timestamp->CurrentValue);
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Add refer script

            // netID
            $this->netID->LinkCustomAttributes = "";
            $this->netID->HrefValue = "";

            // action
            $this->_action->LinkCustomAttributes = "";
            $this->_action->HrefValue = "";

            // server
            $this->server->LinkCustomAttributes = "";
            $this->server->HrefValue = "";

            // page
            $this->_page->LinkCustomAttributes = "";
            $this->_page->HrefValue = "";

            // resourceName
            $this->resourceName->LinkCustomAttributes = "";
            $this->resourceName->HrefValue = "";

            // filePath
            $this->filePath->LinkCustomAttributes = "";
            $this->filePath->HrefValue = "";

            // site
            $this->site->LinkCustomAttributes = "";
            $this->site->HrefValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
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
        if ($this->netID->Required) {
            if (!$this->netID->IsDetailKey && EmptyValue($this->netID->FormValue)) {
                $this->netID->addErrorMessage(str_replace("%s", $this->netID->caption(), $this->netID->RequiredErrorMessage));
            }
        }
        if ($this->_action->Required) {
            if (!$this->_action->IsDetailKey && EmptyValue($this->_action->FormValue)) {
                $this->_action->addErrorMessage(str_replace("%s", $this->_action->caption(), $this->_action->RequiredErrorMessage));
            }
        }
        if ($this->server->Required) {
            if (!$this->server->IsDetailKey && EmptyValue($this->server->FormValue)) {
                $this->server->addErrorMessage(str_replace("%s", $this->server->caption(), $this->server->RequiredErrorMessage));
            }
        }
        if ($this->_page->Required) {
            if (!$this->_page->IsDetailKey && EmptyValue($this->_page->FormValue)) {
                $this->_page->addErrorMessage(str_replace("%s", $this->_page->caption(), $this->_page->RequiredErrorMessage));
            }
        }
        if ($this->resourceName->Required) {
            if (!$this->resourceName->IsDetailKey && EmptyValue($this->resourceName->FormValue)) {
                $this->resourceName->addErrorMessage(str_replace("%s", $this->resourceName->caption(), $this->resourceName->RequiredErrorMessage));
            }
        }
        if ($this->filePath->Required) {
            if (!$this->filePath->IsDetailKey && EmptyValue($this->filePath->FormValue)) {
                $this->filePath->addErrorMessage(str_replace("%s", $this->filePath->caption(), $this->filePath->RequiredErrorMessage));
            }
        }
        if ($this->site->Required) {
            if (!$this->site->IsDetailKey && EmptyValue($this->site->FormValue)) {
                $this->site->addErrorMessage(str_replace("%s", $this->site->caption(), $this->site->RequiredErrorMessage));
            }
        }
        if ($this->timestamp->Required) {
            if (!$this->timestamp->IsDetailKey && EmptyValue($this->timestamp->FormValue)) {
                $this->timestamp->addErrorMessage(str_replace("%s", $this->timestamp->caption(), $this->timestamp->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->timestamp->FormValue)) {
            $this->timestamp->addErrorMessage($this->timestamp->getErrorMessage(false));
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

        // netID
        $this->netID->setDbValueDef($rsnew, $this->netID->CurrentValue, "", false);

        // action
        $this->_action->setDbValueDef($rsnew, $this->_action->CurrentValue, null, false);

        // server
        $this->server->setDbValueDef($rsnew, $this->server->CurrentValue, "", false);

        // page
        $this->_page->setDbValueDef($rsnew, $this->_page->CurrentValue, null, false);

        // resourceName
        $this->resourceName->setDbValueDef($rsnew, $this->resourceName->CurrentValue, null, false);

        // filePath
        $this->filePath->setDbValueDef($rsnew, $this->filePath->CurrentValue, null, false);

        // site
        $this->site->setDbValueDef($rsnew, $this->site->CurrentValue, null, false);

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, $this->timestamp->CurrentValue, 0, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("HistoryList"), "", $this->TableVar, true);
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