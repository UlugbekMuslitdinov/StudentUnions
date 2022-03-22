<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class ComputerAccessRequestsAdd extends ComputerAccessRequests
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'computer_access_requests';

    // Page object name
    public $PageObjName = "ComputerAccessRequestsAdd";

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

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (computer_access_requests)
        if (!isset($GLOBALS["computer_access_requests"]) || get_class($GLOBALS["computer_access_requests"]) == PROJECT_NAMESPACE . "computer_access_requests") {
            $GLOBALS["computer_access_requests"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'computer_access_requests');
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
                $doc = new $class(Container("computer_access_requests"));
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
                    if ($pageName == "ComputerAccessRequestsView") {
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
        $this->supervisor_name->setVisibility();
        $this->supervisor_phone->setVisibility();
        $this->employee_type->setVisibility();
        $this->employee_position->setVisibility();
        $this->employee_first_name->setVisibility();
        $this->employee_last_name->setVisibility();
        $this->employee_title->setVisibility();
        $this->employee_email->setVisibility();
        $this->employee_phone->setVisibility();
        $this->employee_unit->setVisibility();
        $this->employee_netid->setVisibility();
        $this->employee_id->setVisibility();
        $this->location->setVisibility();
        $this->access->setVisibility();
        $this->foodpro_location->setVisibility();
        $this->catcard->setVisibility();
        $this->register_pin->setVisibility();
        $this->other->setVisibility();
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
                    $this->terminate("ComputerAccessRequestsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "ComputerAccessRequestsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ComputerAccessRequestsView") {
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
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
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
        $this->supervisor_name->CurrentValue = null;
        $this->supervisor_name->OldValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_phone->CurrentValue = null;
        $this->supervisor_phone->OldValue = $this->supervisor_phone->CurrentValue;
        $this->employee_type->CurrentValue = null;
        $this->employee_type->OldValue = $this->employee_type->CurrentValue;
        $this->employee_position->CurrentValue = null;
        $this->employee_position->OldValue = $this->employee_position->CurrentValue;
        $this->employee_first_name->CurrentValue = null;
        $this->employee_first_name->OldValue = $this->employee_first_name->CurrentValue;
        $this->employee_last_name->CurrentValue = null;
        $this->employee_last_name->OldValue = $this->employee_last_name->CurrentValue;
        $this->employee_title->CurrentValue = null;
        $this->employee_title->OldValue = $this->employee_title->CurrentValue;
        $this->employee_email->CurrentValue = null;
        $this->employee_email->OldValue = $this->employee_email->CurrentValue;
        $this->employee_phone->CurrentValue = null;
        $this->employee_phone->OldValue = $this->employee_phone->CurrentValue;
        $this->employee_unit->CurrentValue = null;
        $this->employee_unit->OldValue = $this->employee_unit->CurrentValue;
        $this->employee_netid->CurrentValue = null;
        $this->employee_netid->OldValue = $this->employee_netid->CurrentValue;
        $this->employee_id->CurrentValue = null;
        $this->employee_id->OldValue = $this->employee_id->CurrentValue;
        $this->location->CurrentValue = null;
        $this->location->OldValue = $this->location->CurrentValue;
        $this->access->CurrentValue = null;
        $this->access->OldValue = $this->access->CurrentValue;
        $this->foodpro_location->CurrentValue = null;
        $this->foodpro_location->OldValue = $this->foodpro_location->CurrentValue;
        $this->catcard->CurrentValue = null;
        $this->catcard->OldValue = $this->catcard->CurrentValue;
        $this->register_pin->CurrentValue = null;
        $this->register_pin->OldValue = $this->register_pin->CurrentValue;
        $this->other->CurrentValue = null;
        $this->other->OldValue = $this->other->CurrentValue;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'supervisor_name' first before field var 'x_supervisor_name'
        $val = $CurrentForm->hasValue("supervisor_name") ? $CurrentForm->getValue("supervisor_name") : $CurrentForm->getValue("x_supervisor_name");
        if (!$this->supervisor_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supervisor_name->Visible = false; // Disable update for API request
            } else {
                $this->supervisor_name->setFormValue($val);
            }
        }

        // Check field name 'supervisor_phone' first before field var 'x_supervisor_phone'
        $val = $CurrentForm->hasValue("supervisor_phone") ? $CurrentForm->getValue("supervisor_phone") : $CurrentForm->getValue("x_supervisor_phone");
        if (!$this->supervisor_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supervisor_phone->Visible = false; // Disable update for API request
            } else {
                $this->supervisor_phone->setFormValue($val);
            }
        }

        // Check field name 'employee_type' first before field var 'x_employee_type'
        $val = $CurrentForm->hasValue("employee_type") ? $CurrentForm->getValue("employee_type") : $CurrentForm->getValue("x_employee_type");
        if (!$this->employee_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_type->Visible = false; // Disable update for API request
            } else {
                $this->employee_type->setFormValue($val);
            }
        }

        // Check field name 'employee_position' first before field var 'x_employee_position'
        $val = $CurrentForm->hasValue("employee_position") ? $CurrentForm->getValue("employee_position") : $CurrentForm->getValue("x_employee_position");
        if (!$this->employee_position->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_position->Visible = false; // Disable update for API request
            } else {
                $this->employee_position->setFormValue($val);
            }
        }

        // Check field name 'employee_first_name' first before field var 'x_employee_first_name'
        $val = $CurrentForm->hasValue("employee_first_name") ? $CurrentForm->getValue("employee_first_name") : $CurrentForm->getValue("x_employee_first_name");
        if (!$this->employee_first_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_first_name->Visible = false; // Disable update for API request
            } else {
                $this->employee_first_name->setFormValue($val);
            }
        }

        // Check field name 'employee_last_name' first before field var 'x_employee_last_name'
        $val = $CurrentForm->hasValue("employee_last_name") ? $CurrentForm->getValue("employee_last_name") : $CurrentForm->getValue("x_employee_last_name");
        if (!$this->employee_last_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_last_name->Visible = false; // Disable update for API request
            } else {
                $this->employee_last_name->setFormValue($val);
            }
        }

        // Check field name 'employee_title' first before field var 'x_employee_title'
        $val = $CurrentForm->hasValue("employee_title") ? $CurrentForm->getValue("employee_title") : $CurrentForm->getValue("x_employee_title");
        if (!$this->employee_title->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_title->Visible = false; // Disable update for API request
            } else {
                $this->employee_title->setFormValue($val);
            }
        }

        // Check field name 'employee_email' first before field var 'x_employee_email'
        $val = $CurrentForm->hasValue("employee_email") ? $CurrentForm->getValue("employee_email") : $CurrentForm->getValue("x_employee_email");
        if (!$this->employee_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_email->Visible = false; // Disable update for API request
            } else {
                $this->employee_email->setFormValue($val);
            }
        }

        // Check field name 'employee_phone' first before field var 'x_employee_phone'
        $val = $CurrentForm->hasValue("employee_phone") ? $CurrentForm->getValue("employee_phone") : $CurrentForm->getValue("x_employee_phone");
        if (!$this->employee_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_phone->Visible = false; // Disable update for API request
            } else {
                $this->employee_phone->setFormValue($val);
            }
        }

        // Check field name 'employee_unit' first before field var 'x_employee_unit'
        $val = $CurrentForm->hasValue("employee_unit") ? $CurrentForm->getValue("employee_unit") : $CurrentForm->getValue("x_employee_unit");
        if (!$this->employee_unit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_unit->Visible = false; // Disable update for API request
            } else {
                $this->employee_unit->setFormValue($val);
            }
        }

        // Check field name 'employee_netid' first before field var 'x_employee_netid'
        $val = $CurrentForm->hasValue("employee_netid") ? $CurrentForm->getValue("employee_netid") : $CurrentForm->getValue("x_employee_netid");
        if (!$this->employee_netid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_netid->Visible = false; // Disable update for API request
            } else {
                $this->employee_netid->setFormValue($val);
            }
        }

        // Check field name 'employee_id' first before field var 'x_employee_id'
        $val = $CurrentForm->hasValue("employee_id") ? $CurrentForm->getValue("employee_id") : $CurrentForm->getValue("x_employee_id");
        if (!$this->employee_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_id->Visible = false; // Disable update for API request
            } else {
                $this->employee_id->setFormValue($val);
            }
        }

        // Check field name 'location' first before field var 'x_location'
        $val = $CurrentForm->hasValue("location") ? $CurrentForm->getValue("location") : $CurrentForm->getValue("x_location");
        if (!$this->location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location->Visible = false; // Disable update for API request
            } else {
                $this->location->setFormValue($val);
            }
        }

        // Check field name 'access' first before field var 'x_access'
        $val = $CurrentForm->hasValue("access") ? $CurrentForm->getValue("access") : $CurrentForm->getValue("x_access");
        if (!$this->access->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->access->Visible = false; // Disable update for API request
            } else {
                $this->access->setFormValue($val);
            }
        }

        // Check field name 'foodpro_location' first before field var 'x_foodpro_location'
        $val = $CurrentForm->hasValue("foodpro_location") ? $CurrentForm->getValue("foodpro_location") : $CurrentForm->getValue("x_foodpro_location");
        if (!$this->foodpro_location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->foodpro_location->Visible = false; // Disable update for API request
            } else {
                $this->foodpro_location->setFormValue($val);
            }
        }

        // Check field name 'catcard' first before field var 'x_catcard'
        $val = $CurrentForm->hasValue("catcard") ? $CurrentForm->getValue("catcard") : $CurrentForm->getValue("x_catcard");
        if (!$this->catcard->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->catcard->Visible = false; // Disable update for API request
            } else {
                $this->catcard->setFormValue($val);
            }
        }

        // Check field name 'register_pin' first before field var 'x_register_pin'
        $val = $CurrentForm->hasValue("register_pin") ? $CurrentForm->getValue("register_pin") : $CurrentForm->getValue("x_register_pin");
        if (!$this->register_pin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->register_pin->Visible = false; // Disable update for API request
            } else {
                $this->register_pin->setFormValue($val);
            }
        }

        // Check field name 'other' first before field var 'x_other'
        $val = $CurrentForm->hasValue("other") ? $CurrentForm->getValue("other") : $CurrentForm->getValue("x_other");
        if (!$this->other->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->other->Visible = false; // Disable update for API request
            } else {
                $this->other->setFormValue($val);
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
        $this->supervisor_name->CurrentValue = $this->supervisor_name->FormValue;
        $this->supervisor_phone->CurrentValue = $this->supervisor_phone->FormValue;
        $this->employee_type->CurrentValue = $this->employee_type->FormValue;
        $this->employee_position->CurrentValue = $this->employee_position->FormValue;
        $this->employee_first_name->CurrentValue = $this->employee_first_name->FormValue;
        $this->employee_last_name->CurrentValue = $this->employee_last_name->FormValue;
        $this->employee_title->CurrentValue = $this->employee_title->FormValue;
        $this->employee_email->CurrentValue = $this->employee_email->FormValue;
        $this->employee_phone->CurrentValue = $this->employee_phone->FormValue;
        $this->employee_unit->CurrentValue = $this->employee_unit->FormValue;
        $this->employee_netid->CurrentValue = $this->employee_netid->FormValue;
        $this->employee_id->CurrentValue = $this->employee_id->FormValue;
        $this->location->CurrentValue = $this->location->FormValue;
        $this->access->CurrentValue = $this->access->FormValue;
        $this->foodpro_location->CurrentValue = $this->foodpro_location->FormValue;
        $this->catcard->CurrentValue = $this->catcard->FormValue;
        $this->register_pin->CurrentValue = $this->register_pin->FormValue;
        $this->other->CurrentValue = $this->other->FormValue;
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
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_type->setDbValue($row['employee_type']);
        $this->employee_position->setDbValue($row['employee_position']);
        $this->employee_first_name->setDbValue($row['employee_first_name']);
        $this->employee_last_name->setDbValue($row['employee_last_name']);
        $this->employee_title->setDbValue($row['employee_title']);
        $this->employee_email->setDbValue($row['employee_email']);
        $this->employee_phone->setDbValue($row['employee_phone']);
        $this->employee_unit->setDbValue($row['employee_unit']);
        $this->employee_netid->setDbValue($row['employee_netid']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->location->setDbValue($row['location']);
        $this->access->setDbValue($row['access']);
        $this->foodpro_location->setDbValue($row['foodpro_location']);
        $this->catcard->setDbValue($row['catcard']);
        $this->register_pin->setDbValue($row['register_pin']);
        $this->other->setDbValue($row['other']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['supervisor_name'] = $this->supervisor_name->CurrentValue;
        $row['supervisor_phone'] = $this->supervisor_phone->CurrentValue;
        $row['employee_type'] = $this->employee_type->CurrentValue;
        $row['employee_position'] = $this->employee_position->CurrentValue;
        $row['employee_first_name'] = $this->employee_first_name->CurrentValue;
        $row['employee_last_name'] = $this->employee_last_name->CurrentValue;
        $row['employee_title'] = $this->employee_title->CurrentValue;
        $row['employee_email'] = $this->employee_email->CurrentValue;
        $row['employee_phone'] = $this->employee_phone->CurrentValue;
        $row['employee_unit'] = $this->employee_unit->CurrentValue;
        $row['employee_netid'] = $this->employee_netid->CurrentValue;
        $row['employee_id'] = $this->employee_id->CurrentValue;
        $row['location'] = $this->location->CurrentValue;
        $row['access'] = $this->access->CurrentValue;
        $row['foodpro_location'] = $this->foodpro_location->CurrentValue;
        $row['catcard'] = $this->catcard->CurrentValue;
        $row['register_pin'] = $this->register_pin->CurrentValue;
        $row['other'] = $this->other->CurrentValue;
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

        // supervisor_name

        // supervisor_phone

        // employee_type

        // employee_position

        // employee_first_name

        // employee_last_name

        // employee_title

        // employee_email

        // employee_phone

        // employee_unit

        // employee_netid

        // employee_id

        // location

        // access

        // foodpro_location

        // catcard

        // register_pin

        // other

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // supervisor_name
            $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
            $this->supervisor_name->ViewCustomAttributes = "";

            // supervisor_phone
            $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
            $this->supervisor_phone->ViewCustomAttributes = "";

            // employee_type
            $this->employee_type->ViewValue = $this->employee_type->CurrentValue;
            $this->employee_type->ViewCustomAttributes = "";

            // employee_position
            $this->employee_position->ViewValue = $this->employee_position->CurrentValue;
            $this->employee_position->ViewCustomAttributes = "";

            // employee_first_name
            $this->employee_first_name->ViewValue = $this->employee_first_name->CurrentValue;
            $this->employee_first_name->ViewCustomAttributes = "";

            // employee_last_name
            $this->employee_last_name->ViewValue = $this->employee_last_name->CurrentValue;
            $this->employee_last_name->ViewCustomAttributes = "";

            // employee_title
            $this->employee_title->ViewValue = $this->employee_title->CurrentValue;
            $this->employee_title->ViewCustomAttributes = "";

            // employee_email
            $this->employee_email->ViewValue = $this->employee_email->CurrentValue;
            $this->employee_email->ViewCustomAttributes = "";

            // employee_phone
            $this->employee_phone->ViewValue = $this->employee_phone->CurrentValue;
            $this->employee_phone->ViewCustomAttributes = "";

            // employee_unit
            $this->employee_unit->ViewValue = $this->employee_unit->CurrentValue;
            $this->employee_unit->ViewCustomAttributes = "";

            // employee_netid
            $this->employee_netid->ViewValue = $this->employee_netid->CurrentValue;
            $this->employee_netid->ViewCustomAttributes = "";

            // employee_id
            $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
            $this->employee_id->ViewCustomAttributes = "";

            // location
            $this->location->ViewValue = $this->location->CurrentValue;
            $this->location->ViewCustomAttributes = "";

            // access
            $this->access->ViewValue = $this->access->CurrentValue;
            $this->access->ViewValue = FormatNumber($this->access->ViewValue, 0, -2, -2, -2);
            $this->access->ViewCustomAttributes = "";

            // foodpro_location
            $this->foodpro_location->ViewValue = $this->foodpro_location->CurrentValue;
            $this->foodpro_location->ViewCustomAttributes = "";

            // catcard
            $this->catcard->ViewValue = $this->catcard->CurrentValue;
            $this->catcard->ViewCustomAttributes = "";

            // register_pin
            $this->register_pin->ViewValue = $this->register_pin->CurrentValue;
            $this->register_pin->ViewCustomAttributes = "";

            // other
            $this->other->ViewValue = $this->other->CurrentValue;
            $this->other->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";
            $this->supervisor_name->TooltipValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";
            $this->supervisor_phone->TooltipValue = "";

            // employee_type
            $this->employee_type->LinkCustomAttributes = "";
            $this->employee_type->HrefValue = "";
            $this->employee_type->TooltipValue = "";

            // employee_position
            $this->employee_position->LinkCustomAttributes = "";
            $this->employee_position->HrefValue = "";
            $this->employee_position->TooltipValue = "";

            // employee_first_name
            $this->employee_first_name->LinkCustomAttributes = "";
            $this->employee_first_name->HrefValue = "";
            $this->employee_first_name->TooltipValue = "";

            // employee_last_name
            $this->employee_last_name->LinkCustomAttributes = "";
            $this->employee_last_name->HrefValue = "";
            $this->employee_last_name->TooltipValue = "";

            // employee_title
            $this->employee_title->LinkCustomAttributes = "";
            $this->employee_title->HrefValue = "";
            $this->employee_title->TooltipValue = "";

            // employee_email
            $this->employee_email->LinkCustomAttributes = "";
            $this->employee_email->HrefValue = "";
            $this->employee_email->TooltipValue = "";

            // employee_phone
            $this->employee_phone->LinkCustomAttributes = "";
            $this->employee_phone->HrefValue = "";
            $this->employee_phone->TooltipValue = "";

            // employee_unit
            $this->employee_unit->LinkCustomAttributes = "";
            $this->employee_unit->HrefValue = "";
            $this->employee_unit->TooltipValue = "";

            // employee_netid
            $this->employee_netid->LinkCustomAttributes = "";
            $this->employee_netid->HrefValue = "";
            $this->employee_netid->TooltipValue = "";

            // employee_id
            $this->employee_id->LinkCustomAttributes = "";
            $this->employee_id->HrefValue = "";
            $this->employee_id->TooltipValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";
            $this->location->TooltipValue = "";

            // access
            $this->access->LinkCustomAttributes = "";
            $this->access->HrefValue = "";
            $this->access->TooltipValue = "";

            // foodpro_location
            $this->foodpro_location->LinkCustomAttributes = "";
            $this->foodpro_location->HrefValue = "";
            $this->foodpro_location->TooltipValue = "";

            // catcard
            $this->catcard->LinkCustomAttributes = "";
            $this->catcard->HrefValue = "";
            $this->catcard->TooltipValue = "";

            // register_pin
            $this->register_pin->LinkCustomAttributes = "";
            $this->register_pin->HrefValue = "";
            $this->register_pin->TooltipValue = "";

            // other
            $this->other->LinkCustomAttributes = "";
            $this->other->HrefValue = "";
            $this->other->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // supervisor_name
            $this->supervisor_name->EditAttrs["class"] = "form-control";
            $this->supervisor_name->EditCustomAttributes = "";
            if (!$this->supervisor_name->Raw) {
                $this->supervisor_name->CurrentValue = HtmlDecode($this->supervisor_name->CurrentValue);
            }
            $this->supervisor_name->EditValue = HtmlEncode($this->supervisor_name->CurrentValue);
            $this->supervisor_name->PlaceHolder = RemoveHtml($this->supervisor_name->caption());

            // supervisor_phone
            $this->supervisor_phone->EditAttrs["class"] = "form-control";
            $this->supervisor_phone->EditCustomAttributes = "";
            if (!$this->supervisor_phone->Raw) {
                $this->supervisor_phone->CurrentValue = HtmlDecode($this->supervisor_phone->CurrentValue);
            }
            $this->supervisor_phone->EditValue = HtmlEncode($this->supervisor_phone->CurrentValue);
            $this->supervisor_phone->PlaceHolder = RemoveHtml($this->supervisor_phone->caption());

            // employee_type
            $this->employee_type->EditAttrs["class"] = "form-control";
            $this->employee_type->EditCustomAttributes = "";
            if (!$this->employee_type->Raw) {
                $this->employee_type->CurrentValue = HtmlDecode($this->employee_type->CurrentValue);
            }
            $this->employee_type->EditValue = HtmlEncode($this->employee_type->CurrentValue);
            $this->employee_type->PlaceHolder = RemoveHtml($this->employee_type->caption());

            // employee_position
            $this->employee_position->EditAttrs["class"] = "form-control";
            $this->employee_position->EditCustomAttributes = "";
            if (!$this->employee_position->Raw) {
                $this->employee_position->CurrentValue = HtmlDecode($this->employee_position->CurrentValue);
            }
            $this->employee_position->EditValue = HtmlEncode($this->employee_position->CurrentValue);
            $this->employee_position->PlaceHolder = RemoveHtml($this->employee_position->caption());

            // employee_first_name
            $this->employee_first_name->EditAttrs["class"] = "form-control";
            $this->employee_first_name->EditCustomAttributes = "";
            if (!$this->employee_first_name->Raw) {
                $this->employee_first_name->CurrentValue = HtmlDecode($this->employee_first_name->CurrentValue);
            }
            $this->employee_first_name->EditValue = HtmlEncode($this->employee_first_name->CurrentValue);
            $this->employee_first_name->PlaceHolder = RemoveHtml($this->employee_first_name->caption());

            // employee_last_name
            $this->employee_last_name->EditAttrs["class"] = "form-control";
            $this->employee_last_name->EditCustomAttributes = "";
            if (!$this->employee_last_name->Raw) {
                $this->employee_last_name->CurrentValue = HtmlDecode($this->employee_last_name->CurrentValue);
            }
            $this->employee_last_name->EditValue = HtmlEncode($this->employee_last_name->CurrentValue);
            $this->employee_last_name->PlaceHolder = RemoveHtml($this->employee_last_name->caption());

            // employee_title
            $this->employee_title->EditAttrs["class"] = "form-control";
            $this->employee_title->EditCustomAttributes = "";
            if (!$this->employee_title->Raw) {
                $this->employee_title->CurrentValue = HtmlDecode($this->employee_title->CurrentValue);
            }
            $this->employee_title->EditValue = HtmlEncode($this->employee_title->CurrentValue);
            $this->employee_title->PlaceHolder = RemoveHtml($this->employee_title->caption());

            // employee_email
            $this->employee_email->EditAttrs["class"] = "form-control";
            $this->employee_email->EditCustomAttributes = "";
            if (!$this->employee_email->Raw) {
                $this->employee_email->CurrentValue = HtmlDecode($this->employee_email->CurrentValue);
            }
            $this->employee_email->EditValue = HtmlEncode($this->employee_email->CurrentValue);
            $this->employee_email->PlaceHolder = RemoveHtml($this->employee_email->caption());

            // employee_phone
            $this->employee_phone->EditAttrs["class"] = "form-control";
            $this->employee_phone->EditCustomAttributes = "";
            if (!$this->employee_phone->Raw) {
                $this->employee_phone->CurrentValue = HtmlDecode($this->employee_phone->CurrentValue);
            }
            $this->employee_phone->EditValue = HtmlEncode($this->employee_phone->CurrentValue);
            $this->employee_phone->PlaceHolder = RemoveHtml($this->employee_phone->caption());

            // employee_unit
            $this->employee_unit->EditAttrs["class"] = "form-control";
            $this->employee_unit->EditCustomAttributes = "";
            if (!$this->employee_unit->Raw) {
                $this->employee_unit->CurrentValue = HtmlDecode($this->employee_unit->CurrentValue);
            }
            $this->employee_unit->EditValue = HtmlEncode($this->employee_unit->CurrentValue);
            $this->employee_unit->PlaceHolder = RemoveHtml($this->employee_unit->caption());

            // employee_netid
            $this->employee_netid->EditAttrs["class"] = "form-control";
            $this->employee_netid->EditCustomAttributes = "";
            if (!$this->employee_netid->Raw) {
                $this->employee_netid->CurrentValue = HtmlDecode($this->employee_netid->CurrentValue);
            }
            $this->employee_netid->EditValue = HtmlEncode($this->employee_netid->CurrentValue);
            $this->employee_netid->PlaceHolder = RemoveHtml($this->employee_netid->caption());

            // employee_id
            $this->employee_id->EditAttrs["class"] = "form-control";
            $this->employee_id->EditCustomAttributes = "";
            if (!$this->employee_id->Raw) {
                $this->employee_id->CurrentValue = HtmlDecode($this->employee_id->CurrentValue);
            }
            $this->employee_id->EditValue = HtmlEncode($this->employee_id->CurrentValue);
            $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());

            // location
            $this->location->EditAttrs["class"] = "form-control";
            $this->location->EditCustomAttributes = "";
            if (!$this->location->Raw) {
                $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
            }
            $this->location->EditValue = HtmlEncode($this->location->CurrentValue);
            $this->location->PlaceHolder = RemoveHtml($this->location->caption());

            // access
            $this->access->EditAttrs["class"] = "form-control";
            $this->access->EditCustomAttributes = "";
            $this->access->EditValue = HtmlEncode($this->access->CurrentValue);
            $this->access->PlaceHolder = RemoveHtml($this->access->caption());

            // foodpro_location
            $this->foodpro_location->EditAttrs["class"] = "form-control";
            $this->foodpro_location->EditCustomAttributes = "";
            if (!$this->foodpro_location->Raw) {
                $this->foodpro_location->CurrentValue = HtmlDecode($this->foodpro_location->CurrentValue);
            }
            $this->foodpro_location->EditValue = HtmlEncode($this->foodpro_location->CurrentValue);
            $this->foodpro_location->PlaceHolder = RemoveHtml($this->foodpro_location->caption());

            // catcard
            $this->catcard->EditAttrs["class"] = "form-control";
            $this->catcard->EditCustomAttributes = "";
            if (!$this->catcard->Raw) {
                $this->catcard->CurrentValue = HtmlDecode($this->catcard->CurrentValue);
            }
            $this->catcard->EditValue = HtmlEncode($this->catcard->CurrentValue);
            $this->catcard->PlaceHolder = RemoveHtml($this->catcard->caption());

            // register_pin
            $this->register_pin->EditAttrs["class"] = "form-control";
            $this->register_pin->EditCustomAttributes = "";
            if (!$this->register_pin->Raw) {
                $this->register_pin->CurrentValue = HtmlDecode($this->register_pin->CurrentValue);
            }
            $this->register_pin->EditValue = HtmlEncode($this->register_pin->CurrentValue);
            $this->register_pin->PlaceHolder = RemoveHtml($this->register_pin->caption());

            // other
            $this->other->EditAttrs["class"] = "form-control";
            $this->other->EditCustomAttributes = "";
            if (!$this->other->Raw) {
                $this->other->CurrentValue = HtmlDecode($this->other->CurrentValue);
            }
            $this->other->EditValue = HtmlEncode($this->other->CurrentValue);
            $this->other->PlaceHolder = RemoveHtml($this->other->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Add refer script

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";

            // employee_type
            $this->employee_type->LinkCustomAttributes = "";
            $this->employee_type->HrefValue = "";

            // employee_position
            $this->employee_position->LinkCustomAttributes = "";
            $this->employee_position->HrefValue = "";

            // employee_first_name
            $this->employee_first_name->LinkCustomAttributes = "";
            $this->employee_first_name->HrefValue = "";

            // employee_last_name
            $this->employee_last_name->LinkCustomAttributes = "";
            $this->employee_last_name->HrefValue = "";

            // employee_title
            $this->employee_title->LinkCustomAttributes = "";
            $this->employee_title->HrefValue = "";

            // employee_email
            $this->employee_email->LinkCustomAttributes = "";
            $this->employee_email->HrefValue = "";

            // employee_phone
            $this->employee_phone->LinkCustomAttributes = "";
            $this->employee_phone->HrefValue = "";

            // employee_unit
            $this->employee_unit->LinkCustomAttributes = "";
            $this->employee_unit->HrefValue = "";

            // employee_netid
            $this->employee_netid->LinkCustomAttributes = "";
            $this->employee_netid->HrefValue = "";

            // employee_id
            $this->employee_id->LinkCustomAttributes = "";
            $this->employee_id->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // access
            $this->access->LinkCustomAttributes = "";
            $this->access->HrefValue = "";

            // foodpro_location
            $this->foodpro_location->LinkCustomAttributes = "";
            $this->foodpro_location->HrefValue = "";

            // catcard
            $this->catcard->LinkCustomAttributes = "";
            $this->catcard->HrefValue = "";

            // register_pin
            $this->register_pin->LinkCustomAttributes = "";
            $this->register_pin->HrefValue = "";

            // other
            $this->other->LinkCustomAttributes = "";
            $this->other->HrefValue = "";

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
        if ($this->supervisor_name->Required) {
            if (!$this->supervisor_name->IsDetailKey && EmptyValue($this->supervisor_name->FormValue)) {
                $this->supervisor_name->addErrorMessage(str_replace("%s", $this->supervisor_name->caption(), $this->supervisor_name->RequiredErrorMessage));
            }
        }
        if ($this->supervisor_phone->Required) {
            if (!$this->supervisor_phone->IsDetailKey && EmptyValue($this->supervisor_phone->FormValue)) {
                $this->supervisor_phone->addErrorMessage(str_replace("%s", $this->supervisor_phone->caption(), $this->supervisor_phone->RequiredErrorMessage));
            }
        }
        if ($this->employee_type->Required) {
            if (!$this->employee_type->IsDetailKey && EmptyValue($this->employee_type->FormValue)) {
                $this->employee_type->addErrorMessage(str_replace("%s", $this->employee_type->caption(), $this->employee_type->RequiredErrorMessage));
            }
        }
        if ($this->employee_position->Required) {
            if (!$this->employee_position->IsDetailKey && EmptyValue($this->employee_position->FormValue)) {
                $this->employee_position->addErrorMessage(str_replace("%s", $this->employee_position->caption(), $this->employee_position->RequiredErrorMessage));
            }
        }
        if ($this->employee_first_name->Required) {
            if (!$this->employee_first_name->IsDetailKey && EmptyValue($this->employee_first_name->FormValue)) {
                $this->employee_first_name->addErrorMessage(str_replace("%s", $this->employee_first_name->caption(), $this->employee_first_name->RequiredErrorMessage));
            }
        }
        if ($this->employee_last_name->Required) {
            if (!$this->employee_last_name->IsDetailKey && EmptyValue($this->employee_last_name->FormValue)) {
                $this->employee_last_name->addErrorMessage(str_replace("%s", $this->employee_last_name->caption(), $this->employee_last_name->RequiredErrorMessage));
            }
        }
        if ($this->employee_title->Required) {
            if (!$this->employee_title->IsDetailKey && EmptyValue($this->employee_title->FormValue)) {
                $this->employee_title->addErrorMessage(str_replace("%s", $this->employee_title->caption(), $this->employee_title->RequiredErrorMessage));
            }
        }
        if ($this->employee_email->Required) {
            if (!$this->employee_email->IsDetailKey && EmptyValue($this->employee_email->FormValue)) {
                $this->employee_email->addErrorMessage(str_replace("%s", $this->employee_email->caption(), $this->employee_email->RequiredErrorMessage));
            }
        }
        if ($this->employee_phone->Required) {
            if (!$this->employee_phone->IsDetailKey && EmptyValue($this->employee_phone->FormValue)) {
                $this->employee_phone->addErrorMessage(str_replace("%s", $this->employee_phone->caption(), $this->employee_phone->RequiredErrorMessage));
            }
        }
        if ($this->employee_unit->Required) {
            if (!$this->employee_unit->IsDetailKey && EmptyValue($this->employee_unit->FormValue)) {
                $this->employee_unit->addErrorMessage(str_replace("%s", $this->employee_unit->caption(), $this->employee_unit->RequiredErrorMessage));
            }
        }
        if ($this->employee_netid->Required) {
            if (!$this->employee_netid->IsDetailKey && EmptyValue($this->employee_netid->FormValue)) {
                $this->employee_netid->addErrorMessage(str_replace("%s", $this->employee_netid->caption(), $this->employee_netid->RequiredErrorMessage));
            }
        }
        if ($this->employee_id->Required) {
            if (!$this->employee_id->IsDetailKey && EmptyValue($this->employee_id->FormValue)) {
                $this->employee_id->addErrorMessage(str_replace("%s", $this->employee_id->caption(), $this->employee_id->RequiredErrorMessage));
            }
        }
        if ($this->location->Required) {
            if (!$this->location->IsDetailKey && EmptyValue($this->location->FormValue)) {
                $this->location->addErrorMessage(str_replace("%s", $this->location->caption(), $this->location->RequiredErrorMessage));
            }
        }
        if ($this->access->Required) {
            if (!$this->access->IsDetailKey && EmptyValue($this->access->FormValue)) {
                $this->access->addErrorMessage(str_replace("%s", $this->access->caption(), $this->access->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->access->FormValue)) {
            $this->access->addErrorMessage($this->access->getErrorMessage(false));
        }
        if ($this->foodpro_location->Required) {
            if (!$this->foodpro_location->IsDetailKey && EmptyValue($this->foodpro_location->FormValue)) {
                $this->foodpro_location->addErrorMessage(str_replace("%s", $this->foodpro_location->caption(), $this->foodpro_location->RequiredErrorMessage));
            }
        }
        if ($this->catcard->Required) {
            if (!$this->catcard->IsDetailKey && EmptyValue($this->catcard->FormValue)) {
                $this->catcard->addErrorMessage(str_replace("%s", $this->catcard->caption(), $this->catcard->RequiredErrorMessage));
            }
        }
        if ($this->register_pin->Required) {
            if (!$this->register_pin->IsDetailKey && EmptyValue($this->register_pin->FormValue)) {
                $this->register_pin->addErrorMessage(str_replace("%s", $this->register_pin->caption(), $this->register_pin->RequiredErrorMessage));
            }
        }
        if ($this->other->Required) {
            if (!$this->other->IsDetailKey && EmptyValue($this->other->FormValue)) {
                $this->other->addErrorMessage(str_replace("%s", $this->other->caption(), $this->other->RequiredErrorMessage));
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

        // supervisor_name
        $this->supervisor_name->setDbValueDef($rsnew, $this->supervisor_name->CurrentValue, "", false);

        // supervisor_phone
        $this->supervisor_phone->setDbValueDef($rsnew, $this->supervisor_phone->CurrentValue, "", false);

        // employee_type
        $this->employee_type->setDbValueDef($rsnew, $this->employee_type->CurrentValue, "", false);

        // employee_position
        $this->employee_position->setDbValueDef($rsnew, $this->employee_position->CurrentValue, "", false);

        // employee_first_name
        $this->employee_first_name->setDbValueDef($rsnew, $this->employee_first_name->CurrentValue, "", false);

        // employee_last_name
        $this->employee_last_name->setDbValueDef($rsnew, $this->employee_last_name->CurrentValue, "", false);

        // employee_title
        $this->employee_title->setDbValueDef($rsnew, $this->employee_title->CurrentValue, "", false);

        // employee_email
        $this->employee_email->setDbValueDef($rsnew, $this->employee_email->CurrentValue, "", false);

        // employee_phone
        $this->employee_phone->setDbValueDef($rsnew, $this->employee_phone->CurrentValue, "", false);

        // employee_unit
        $this->employee_unit->setDbValueDef($rsnew, $this->employee_unit->CurrentValue, "", false);

        // employee_netid
        $this->employee_netid->setDbValueDef($rsnew, $this->employee_netid->CurrentValue, "", false);

        // employee_id
        $this->employee_id->setDbValueDef($rsnew, $this->employee_id->CurrentValue, "", false);

        // location
        $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, "", false);

        // access
        $this->access->setDbValueDef($rsnew, $this->access->CurrentValue, 0, false);

        // foodpro_location
        $this->foodpro_location->setDbValueDef($rsnew, $this->foodpro_location->CurrentValue, null, false);

        // catcard
        $this->catcard->setDbValueDef($rsnew, $this->catcard->CurrentValue, null, false);

        // register_pin
        $this->register_pin->setDbValueDef($rsnew, $this->register_pin->CurrentValue, null, false);

        // other
        $this->other->setDbValueDef($rsnew, $this->other->CurrentValue, null, false);

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ComputerAccessRequestsList"), "", $this->TableVar, true);
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
