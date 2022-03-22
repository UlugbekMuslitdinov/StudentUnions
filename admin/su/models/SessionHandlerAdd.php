<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class SessionHandlerAdd extends SessionHandler
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'session_handler';

    // Page object name
    public $PageObjName = "SessionHandlerAdd";

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

        // Table object (session_handler)
        if (!isset($GLOBALS["session_handler"]) || get_class($GLOBALS["session_handler"]) == PROJECT_NAMESPACE . "session_handler") {
            $GLOBALS["session_handler"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'session_handler');
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
                $doc = new $class(Container("session_handler"));
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
                    if ($pageName == "SessionHandlerView") {
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
        $this->custnum->setVisibility();
        $this->cust_id->setVisibility();
        $this->netid->setVisibility();
        $this->firstname->setVisibility();
        $this->lastname->setVisibility();
        $this->mp_state->setVisibility();
        $this->deposit_to->setVisibility();
        $this->iso->setVisibility();
        $this->activestudent->setVisibility();
        $this->activeemployee->setVisibility();
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
                    $this->terminate("SessionHandlerList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "SessionHandlerList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "SessionHandlerView") {
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
        $this->custnum->CurrentValue = null;
        $this->custnum->OldValue = $this->custnum->CurrentValue;
        $this->cust_id->CurrentValue = null;
        $this->cust_id->OldValue = $this->cust_id->CurrentValue;
        $this->netid->CurrentValue = null;
        $this->netid->OldValue = $this->netid->CurrentValue;
        $this->firstname->CurrentValue = null;
        $this->firstname->OldValue = $this->firstname->CurrentValue;
        $this->lastname->CurrentValue = null;
        $this->lastname->OldValue = $this->lastname->CurrentValue;
        $this->mp_state->CurrentValue = null;
        $this->mp_state->OldValue = $this->mp_state->CurrentValue;
        $this->deposit_to->CurrentValue = null;
        $this->deposit_to->OldValue = $this->deposit_to->CurrentValue;
        $this->iso->CurrentValue = null;
        $this->iso->OldValue = $this->iso->CurrentValue;
        $this->activestudent->CurrentValue = null;
        $this->activestudent->OldValue = $this->activestudent->CurrentValue;
        $this->activeemployee->CurrentValue = null;
        $this->activeemployee->OldValue = $this->activeemployee->CurrentValue;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'custnum' first before field var 'x_custnum'
        $val = $CurrentForm->hasValue("custnum") ? $CurrentForm->getValue("custnum") : $CurrentForm->getValue("x_custnum");
        if (!$this->custnum->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->custnum->Visible = false; // Disable update for API request
            } else {
                $this->custnum->setFormValue($val);
            }
        }

        // Check field name 'cust_id' first before field var 'x_cust_id'
        $val = $CurrentForm->hasValue("cust_id") ? $CurrentForm->getValue("cust_id") : $CurrentForm->getValue("x_cust_id");
        if (!$this->cust_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cust_id->Visible = false; // Disable update for API request
            } else {
                $this->cust_id->setFormValue($val);
            }
        }

        // Check field name 'netid' first before field var 'x_netid'
        $val = $CurrentForm->hasValue("netid") ? $CurrentForm->getValue("netid") : $CurrentForm->getValue("x_netid");
        if (!$this->netid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->netid->Visible = false; // Disable update for API request
            } else {
                $this->netid->setFormValue($val);
            }
        }

        // Check field name 'firstname' first before field var 'x_firstname'
        $val = $CurrentForm->hasValue("firstname") ? $CurrentForm->getValue("firstname") : $CurrentForm->getValue("x_firstname");
        if (!$this->firstname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->firstname->Visible = false; // Disable update for API request
            } else {
                $this->firstname->setFormValue($val);
            }
        }

        // Check field name 'lastname' first before field var 'x_lastname'
        $val = $CurrentForm->hasValue("lastname") ? $CurrentForm->getValue("lastname") : $CurrentForm->getValue("x_lastname");
        if (!$this->lastname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lastname->Visible = false; // Disable update for API request
            } else {
                $this->lastname->setFormValue($val);
            }
        }

        // Check field name 'mp_state' first before field var 'x_mp_state'
        $val = $CurrentForm->hasValue("mp_state") ? $CurrentForm->getValue("mp_state") : $CurrentForm->getValue("x_mp_state");
        if (!$this->mp_state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mp_state->Visible = false; // Disable update for API request
            } else {
                $this->mp_state->setFormValue($val);
            }
        }

        // Check field name 'deposit_to' first before field var 'x_deposit_to'
        $val = $CurrentForm->hasValue("deposit_to") ? $CurrentForm->getValue("deposit_to") : $CurrentForm->getValue("x_deposit_to");
        if (!$this->deposit_to->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deposit_to->Visible = false; // Disable update for API request
            } else {
                $this->deposit_to->setFormValue($val);
            }
        }

        // Check field name 'iso' first before field var 'x_iso'
        $val = $CurrentForm->hasValue("iso") ? $CurrentForm->getValue("iso") : $CurrentForm->getValue("x_iso");
        if (!$this->iso->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->iso->Visible = false; // Disable update for API request
            } else {
                $this->iso->setFormValue($val);
            }
        }

        // Check field name 'activestudent' first before field var 'x_activestudent'
        $val = $CurrentForm->hasValue("activestudent") ? $CurrentForm->getValue("activestudent") : $CurrentForm->getValue("x_activestudent");
        if (!$this->activestudent->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->activestudent->Visible = false; // Disable update for API request
            } else {
                $this->activestudent->setFormValue($val);
            }
        }

        // Check field name 'activeemployee' first before field var 'x_activeemployee'
        $val = $CurrentForm->hasValue("activeemployee") ? $CurrentForm->getValue("activeemployee") : $CurrentForm->getValue("x_activeemployee");
        if (!$this->activeemployee->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->activeemployee->Visible = false; // Disable update for API request
            } else {
                $this->activeemployee->setFormValue($val);
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

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->custnum->CurrentValue = $this->custnum->FormValue;
        $this->cust_id->CurrentValue = $this->cust_id->FormValue;
        $this->netid->CurrentValue = $this->netid->FormValue;
        $this->firstname->CurrentValue = $this->firstname->FormValue;
        $this->lastname->CurrentValue = $this->lastname->FormValue;
        $this->mp_state->CurrentValue = $this->mp_state->FormValue;
        $this->deposit_to->CurrentValue = $this->deposit_to->FormValue;
        $this->iso->CurrentValue = $this->iso->FormValue;
        $this->activestudent->CurrentValue = $this->activestudent->FormValue;
        $this->activeemployee->CurrentValue = $this->activeemployee->FormValue;
        $this->timestamp->CurrentValue = $this->timestamp->FormValue;
        $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
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
        $this->custnum->setDbValue($row['custnum']);
        $this->cust_id->setDbValue($row['cust_id']);
        $this->netid->setDbValue($row['netid']);
        $this->firstname->setDbValue($row['firstname']);
        $this->lastname->setDbValue($row['lastname']);
        $this->mp_state->setDbValue($row['mp_state']);
        $this->deposit_to->setDbValue($row['deposit_to']);
        $this->iso->setDbValue($row['iso']);
        $this->activestudent->setDbValue($row['activestudent']);
        $this->activeemployee->setDbValue($row['activeemployee']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['custnum'] = $this->custnum->CurrentValue;
        $row['cust_id'] = $this->cust_id->CurrentValue;
        $row['netid'] = $this->netid->CurrentValue;
        $row['firstname'] = $this->firstname->CurrentValue;
        $row['lastname'] = $this->lastname->CurrentValue;
        $row['mp_state'] = $this->mp_state->CurrentValue;
        $row['deposit_to'] = $this->deposit_to->CurrentValue;
        $row['iso'] = $this->iso->CurrentValue;
        $row['activestudent'] = $this->activestudent->CurrentValue;
        $row['activeemployee'] = $this->activeemployee->CurrentValue;
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

        // custnum

        // cust_id

        // netid

        // firstname

        // lastname

        // mp_state

        // deposit_to

        // iso

        // activestudent

        // activeemployee

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // custnum
            $this->custnum->ViewValue = $this->custnum->CurrentValue;
            $this->custnum->ViewValue = FormatNumber($this->custnum->ViewValue, 0, -2, -2, -2);
            $this->custnum->ViewCustomAttributes = "";

            // cust_id
            $this->cust_id->ViewValue = $this->cust_id->CurrentValue;
            $this->cust_id->ViewValue = FormatNumber($this->cust_id->ViewValue, 0, -2, -2, -2);
            $this->cust_id->ViewCustomAttributes = "";

            // netid
            $this->netid->ViewValue = $this->netid->CurrentValue;
            $this->netid->ViewCustomAttributes = "";

            // firstname
            $this->firstname->ViewValue = $this->firstname->CurrentValue;
            $this->firstname->ViewCustomAttributes = "";

            // lastname
            $this->lastname->ViewValue = $this->lastname->CurrentValue;
            $this->lastname->ViewCustomAttributes = "";

            // mp_state
            $this->mp_state->ViewValue = $this->mp_state->CurrentValue;
            $this->mp_state->ViewCustomAttributes = "";

            // deposit_to
            if (ConvertToBool($this->deposit_to->CurrentValue)) {
                $this->deposit_to->ViewValue = $this->deposit_to->tagCaption(1) != "" ? $this->deposit_to->tagCaption(1) : "Yes";
            } else {
                $this->deposit_to->ViewValue = $this->deposit_to->tagCaption(2) != "" ? $this->deposit_to->tagCaption(2) : "No";
            }
            $this->deposit_to->ViewCustomAttributes = "";

            // iso
            $this->iso->ViewValue = $this->iso->CurrentValue;
            $this->iso->ViewCustomAttributes = "";

            // activestudent
            $this->activestudent->ViewValue = $this->activestudent->CurrentValue;
            $this->activestudent->ViewCustomAttributes = "";

            // activeemployee
            $this->activeemployee->ViewValue = $this->activeemployee->CurrentValue;
            $this->activeemployee->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // custnum
            $this->custnum->LinkCustomAttributes = "";
            $this->custnum->HrefValue = "";
            $this->custnum->TooltipValue = "";

            // cust_id
            $this->cust_id->LinkCustomAttributes = "";
            $this->cust_id->HrefValue = "";
            $this->cust_id->TooltipValue = "";

            // netid
            $this->netid->LinkCustomAttributes = "";
            $this->netid->HrefValue = "";
            $this->netid->TooltipValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";
            $this->firstname->TooltipValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";
            $this->lastname->TooltipValue = "";

            // mp_state
            $this->mp_state->LinkCustomAttributes = "";
            $this->mp_state->HrefValue = "";
            $this->mp_state->TooltipValue = "";

            // deposit_to
            $this->deposit_to->LinkCustomAttributes = "";
            $this->deposit_to->HrefValue = "";
            $this->deposit_to->TooltipValue = "";

            // iso
            $this->iso->LinkCustomAttributes = "";
            $this->iso->HrefValue = "";
            $this->iso->TooltipValue = "";

            // activestudent
            $this->activestudent->LinkCustomAttributes = "";
            $this->activestudent->HrefValue = "";
            $this->activestudent->TooltipValue = "";

            // activeemployee
            $this->activeemployee->LinkCustomAttributes = "";
            $this->activeemployee->HrefValue = "";
            $this->activeemployee->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // custnum
            $this->custnum->EditAttrs["class"] = "form-control";
            $this->custnum->EditCustomAttributes = "";
            $this->custnum->EditValue = HtmlEncode($this->custnum->CurrentValue);
            $this->custnum->PlaceHolder = RemoveHtml($this->custnum->caption());

            // cust_id
            $this->cust_id->EditAttrs["class"] = "form-control";
            $this->cust_id->EditCustomAttributes = "";
            $this->cust_id->EditValue = HtmlEncode($this->cust_id->CurrentValue);
            $this->cust_id->PlaceHolder = RemoveHtml($this->cust_id->caption());

            // netid
            $this->netid->EditAttrs["class"] = "form-control";
            $this->netid->EditCustomAttributes = "";
            if (!$this->netid->Raw) {
                $this->netid->CurrentValue = HtmlDecode($this->netid->CurrentValue);
            }
            $this->netid->EditValue = HtmlEncode($this->netid->CurrentValue);
            $this->netid->PlaceHolder = RemoveHtml($this->netid->caption());

            // firstname
            $this->firstname->EditAttrs["class"] = "form-control";
            $this->firstname->EditCustomAttributes = "";
            if (!$this->firstname->Raw) {
                $this->firstname->CurrentValue = HtmlDecode($this->firstname->CurrentValue);
            }
            $this->firstname->EditValue = HtmlEncode($this->firstname->CurrentValue);
            $this->firstname->PlaceHolder = RemoveHtml($this->firstname->caption());

            // lastname
            $this->lastname->EditAttrs["class"] = "form-control";
            $this->lastname->EditCustomAttributes = "";
            if (!$this->lastname->Raw) {
                $this->lastname->CurrentValue = HtmlDecode($this->lastname->CurrentValue);
            }
            $this->lastname->EditValue = HtmlEncode($this->lastname->CurrentValue);
            $this->lastname->PlaceHolder = RemoveHtml($this->lastname->caption());

            // mp_state
            $this->mp_state->EditAttrs["class"] = "form-control";
            $this->mp_state->EditCustomAttributes = "";
            if (!$this->mp_state->Raw) {
                $this->mp_state->CurrentValue = HtmlDecode($this->mp_state->CurrentValue);
            }
            $this->mp_state->EditValue = HtmlEncode($this->mp_state->CurrentValue);
            $this->mp_state->PlaceHolder = RemoveHtml($this->mp_state->caption());

            // deposit_to
            $this->deposit_to->EditCustomAttributes = "";
            $this->deposit_to->EditValue = $this->deposit_to->options(false);
            $this->deposit_to->PlaceHolder = RemoveHtml($this->deposit_to->caption());

            // iso
            $this->iso->EditAttrs["class"] = "form-control";
            $this->iso->EditCustomAttributes = "";
            if (!$this->iso->Raw) {
                $this->iso->CurrentValue = HtmlDecode($this->iso->CurrentValue);
            }
            $this->iso->EditValue = HtmlEncode($this->iso->CurrentValue);
            $this->iso->PlaceHolder = RemoveHtml($this->iso->caption());

            // activestudent
            $this->activestudent->EditAttrs["class"] = "form-control";
            $this->activestudent->EditCustomAttributes = "";
            if (!$this->activestudent->Raw) {
                $this->activestudent->CurrentValue = HtmlDecode($this->activestudent->CurrentValue);
            }
            $this->activestudent->EditValue = HtmlEncode($this->activestudent->CurrentValue);
            $this->activestudent->PlaceHolder = RemoveHtml($this->activestudent->caption());

            // activeemployee
            $this->activeemployee->EditAttrs["class"] = "form-control";
            $this->activeemployee->EditCustomAttributes = "";
            if (!$this->activeemployee->Raw) {
                $this->activeemployee->CurrentValue = HtmlDecode($this->activeemployee->CurrentValue);
            }
            $this->activeemployee->EditValue = HtmlEncode($this->activeemployee->CurrentValue);
            $this->activeemployee->PlaceHolder = RemoveHtml($this->activeemployee->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Add refer script

            // custnum
            $this->custnum->LinkCustomAttributes = "";
            $this->custnum->HrefValue = "";

            // cust_id
            $this->cust_id->LinkCustomAttributes = "";
            $this->cust_id->HrefValue = "";

            // netid
            $this->netid->LinkCustomAttributes = "";
            $this->netid->HrefValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";

            // mp_state
            $this->mp_state->LinkCustomAttributes = "";
            $this->mp_state->HrefValue = "";

            // deposit_to
            $this->deposit_to->LinkCustomAttributes = "";
            $this->deposit_to->HrefValue = "";

            // iso
            $this->iso->LinkCustomAttributes = "";
            $this->iso->HrefValue = "";

            // activestudent
            $this->activestudent->LinkCustomAttributes = "";
            $this->activestudent->HrefValue = "";

            // activeemployee
            $this->activeemployee->LinkCustomAttributes = "";
            $this->activeemployee->HrefValue = "";

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
        if ($this->custnum->Required) {
            if (!$this->custnum->IsDetailKey && EmptyValue($this->custnum->FormValue)) {
                $this->custnum->addErrorMessage(str_replace("%s", $this->custnum->caption(), $this->custnum->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->custnum->FormValue)) {
            $this->custnum->addErrorMessage($this->custnum->getErrorMessage(false));
        }
        if ($this->cust_id->Required) {
            if (!$this->cust_id->IsDetailKey && EmptyValue($this->cust_id->FormValue)) {
                $this->cust_id->addErrorMessage(str_replace("%s", $this->cust_id->caption(), $this->cust_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->cust_id->FormValue)) {
            $this->cust_id->addErrorMessage($this->cust_id->getErrorMessage(false));
        }
        if ($this->netid->Required) {
            if (!$this->netid->IsDetailKey && EmptyValue($this->netid->FormValue)) {
                $this->netid->addErrorMessage(str_replace("%s", $this->netid->caption(), $this->netid->RequiredErrorMessage));
            }
        }
        if ($this->firstname->Required) {
            if (!$this->firstname->IsDetailKey && EmptyValue($this->firstname->FormValue)) {
                $this->firstname->addErrorMessage(str_replace("%s", $this->firstname->caption(), $this->firstname->RequiredErrorMessage));
            }
        }
        if ($this->lastname->Required) {
            if (!$this->lastname->IsDetailKey && EmptyValue($this->lastname->FormValue)) {
                $this->lastname->addErrorMessage(str_replace("%s", $this->lastname->caption(), $this->lastname->RequiredErrorMessage));
            }
        }
        if ($this->mp_state->Required) {
            if (!$this->mp_state->IsDetailKey && EmptyValue($this->mp_state->FormValue)) {
                $this->mp_state->addErrorMessage(str_replace("%s", $this->mp_state->caption(), $this->mp_state->RequiredErrorMessage));
            }
        }
        if ($this->deposit_to->Required) {
            if ($this->deposit_to->FormValue == "") {
                $this->deposit_to->addErrorMessage(str_replace("%s", $this->deposit_to->caption(), $this->deposit_to->RequiredErrorMessage));
            }
        }
        if ($this->iso->Required) {
            if (!$this->iso->IsDetailKey && EmptyValue($this->iso->FormValue)) {
                $this->iso->addErrorMessage(str_replace("%s", $this->iso->caption(), $this->iso->RequiredErrorMessage));
            }
        }
        if ($this->activestudent->Required) {
            if (!$this->activestudent->IsDetailKey && EmptyValue($this->activestudent->FormValue)) {
                $this->activestudent->addErrorMessage(str_replace("%s", $this->activestudent->caption(), $this->activestudent->RequiredErrorMessage));
            }
        }
        if ($this->activeemployee->Required) {
            if (!$this->activeemployee->IsDetailKey && EmptyValue($this->activeemployee->FormValue)) {
                $this->activeemployee->addErrorMessage(str_replace("%s", $this->activeemployee->caption(), $this->activeemployee->RequiredErrorMessage));
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

        // custnum
        $this->custnum->setDbValueDef($rsnew, $this->custnum->CurrentValue, null, false);

        // cust_id
        $this->cust_id->setDbValueDef($rsnew, $this->cust_id->CurrentValue, null, false);

        // netid
        $this->netid->setDbValueDef($rsnew, $this->netid->CurrentValue, null, false);

        // firstname
        $this->firstname->setDbValueDef($rsnew, $this->firstname->CurrentValue, null, false);

        // lastname
        $this->lastname->setDbValueDef($rsnew, $this->lastname->CurrentValue, null, false);

        // mp_state
        $this->mp_state->setDbValueDef($rsnew, $this->mp_state->CurrentValue, null, false);

        // deposit_to
        $tmpBool = $this->deposit_to->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->deposit_to->setDbValueDef($rsnew, $tmpBool, null, false);

        // iso
        $this->iso->setDbValueDef($rsnew, $this->iso->CurrentValue, null, false);

        // activestudent
        $this->activestudent->setDbValueDef($rsnew, $this->activestudent->CurrentValue, null, false);

        // activeemployee
        $this->activeemployee->setDbValueDef($rsnew, $this->activeemployee->CurrentValue, null, false);

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("SessionHandlerList"), "", $this->TableVar, true);
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
                case "x_deposit_to":
                    break;
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
