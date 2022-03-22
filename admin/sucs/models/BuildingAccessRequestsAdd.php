<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class BuildingAccessRequestsAdd extends BuildingAccessRequests
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'building_access_requests';

    // Page object name
    public $PageObjName = "BuildingAccessRequestsAdd";

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

        // Table object (building_access_requests)
        if (!isset($GLOBALS["building_access_requests"]) || get_class($GLOBALS["building_access_requests"]) == PROJECT_NAMESPACE . "building_access_requests") {
            $GLOBALS["building_access_requests"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'building_access_requests');
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
                $doc = new $class(Container("building_access_requests"));
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
                    if ($pageName == "BuildingAccessRequestsView") {
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
        $this->form_type->setVisibility();
        $this->supervisor_name->setVisibility();
        $this->supervisor_phone->setVisibility();
        $this->employee_first_name->setVisibility();
        $this->employee_last_name->setVisibility();
        $this->catcard->setVisibility();
        $this->pin->setVisibility();
        $this->employee_unit->setVisibility();
        $this->employee_id->setVisibility();
        $this->other_areas->setVisibility();
        $this->alarm_access->setVisibility();
        $this->alarm_area->setVisibility();
        $this->alarm_password->setVisibility();
        $this->replacement_catcard->setVisibility();
        $this->replacement_other->setVisibility();
        $this->replacement_problem->setVisibility();
        $this->delete->setVisibility();
        $this->timestamp->setVisibility();
        $this->net_id->setVisibility();
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
                    $this->terminate("BuildingAccessRequestsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "BuildingAccessRequestsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "BuildingAccessRequestsView") {
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
        $this->form_type->CurrentValue = null;
        $this->form_type->OldValue = $this->form_type->CurrentValue;
        $this->supervisor_name->CurrentValue = null;
        $this->supervisor_name->OldValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_phone->CurrentValue = null;
        $this->supervisor_phone->OldValue = $this->supervisor_phone->CurrentValue;
        $this->employee_first_name->CurrentValue = null;
        $this->employee_first_name->OldValue = $this->employee_first_name->CurrentValue;
        $this->employee_last_name->CurrentValue = null;
        $this->employee_last_name->OldValue = $this->employee_last_name->CurrentValue;
        $this->catcard->CurrentValue = null;
        $this->catcard->OldValue = $this->catcard->CurrentValue;
        $this->pin->CurrentValue = null;
        $this->pin->OldValue = $this->pin->CurrentValue;
        $this->employee_unit->CurrentValue = null;
        $this->employee_unit->OldValue = $this->employee_unit->CurrentValue;
        $this->employee_id->CurrentValue = null;
        $this->employee_id->OldValue = $this->employee_id->CurrentValue;
        $this->other_areas->CurrentValue = null;
        $this->other_areas->OldValue = $this->other_areas->CurrentValue;
        $this->alarm_access->CurrentValue = 0;
        $this->alarm_area->CurrentValue = null;
        $this->alarm_area->OldValue = $this->alarm_area->CurrentValue;
        $this->alarm_password->CurrentValue = null;
        $this->alarm_password->OldValue = $this->alarm_password->CurrentValue;
        $this->replacement_catcard->CurrentValue = null;
        $this->replacement_catcard->OldValue = $this->replacement_catcard->CurrentValue;
        $this->replacement_other->CurrentValue = null;
        $this->replacement_other->OldValue = $this->replacement_other->CurrentValue;
        $this->replacement_problem->CurrentValue = null;
        $this->replacement_problem->OldValue = $this->replacement_problem->CurrentValue;
        $this->delete->CurrentValue = 0;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
        $this->net_id->CurrentValue = null;
        $this->net_id->OldValue = $this->net_id->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'form_type' first before field var 'x_form_type'
        $val = $CurrentForm->hasValue("form_type") ? $CurrentForm->getValue("form_type") : $CurrentForm->getValue("x_form_type");
        if (!$this->form_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->form_type->Visible = false; // Disable update for API request
            } else {
                $this->form_type->setFormValue($val);
            }
        }

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

        // Check field name 'catcard' first before field var 'x_catcard'
        $val = $CurrentForm->hasValue("catcard") ? $CurrentForm->getValue("catcard") : $CurrentForm->getValue("x_catcard");
        if (!$this->catcard->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->catcard->Visible = false; // Disable update for API request
            } else {
                $this->catcard->setFormValue($val);
            }
        }

        // Check field name 'pin' first before field var 'x_pin'
        $val = $CurrentForm->hasValue("pin") ? $CurrentForm->getValue("pin") : $CurrentForm->getValue("x_pin");
        if (!$this->pin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pin->Visible = false; // Disable update for API request
            } else {
                $this->pin->setFormValue($val);
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

        // Check field name 'employee_id' first before field var 'x_employee_id'
        $val = $CurrentForm->hasValue("employee_id") ? $CurrentForm->getValue("employee_id") : $CurrentForm->getValue("x_employee_id");
        if (!$this->employee_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_id->Visible = false; // Disable update for API request
            } else {
                $this->employee_id->setFormValue($val);
            }
        }

        // Check field name 'other_areas' first before field var 'x_other_areas'
        $val = $CurrentForm->hasValue("other_areas") ? $CurrentForm->getValue("other_areas") : $CurrentForm->getValue("x_other_areas");
        if (!$this->other_areas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->other_areas->Visible = false; // Disable update for API request
            } else {
                $this->other_areas->setFormValue($val);
            }
        }

        // Check field name 'alarm_access' first before field var 'x_alarm_access'
        $val = $CurrentForm->hasValue("alarm_access") ? $CurrentForm->getValue("alarm_access") : $CurrentForm->getValue("x_alarm_access");
        if (!$this->alarm_access->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alarm_access->Visible = false; // Disable update for API request
            } else {
                $this->alarm_access->setFormValue($val);
            }
        }

        // Check field name 'alarm_area' first before field var 'x_alarm_area'
        $val = $CurrentForm->hasValue("alarm_area") ? $CurrentForm->getValue("alarm_area") : $CurrentForm->getValue("x_alarm_area");
        if (!$this->alarm_area->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alarm_area->Visible = false; // Disable update for API request
            } else {
                $this->alarm_area->setFormValue($val);
            }
        }

        // Check field name 'alarm_password' first before field var 'x_alarm_password'
        $val = $CurrentForm->hasValue("alarm_password") ? $CurrentForm->getValue("alarm_password") : $CurrentForm->getValue("x_alarm_password");
        if (!$this->alarm_password->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alarm_password->Visible = false; // Disable update for API request
            } else {
                $this->alarm_password->setFormValue($val);
            }
        }

        // Check field name 'replacement_catcard' first before field var 'x_replacement_catcard'
        $val = $CurrentForm->hasValue("replacement_catcard") ? $CurrentForm->getValue("replacement_catcard") : $CurrentForm->getValue("x_replacement_catcard");
        if (!$this->replacement_catcard->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->replacement_catcard->Visible = false; // Disable update for API request
            } else {
                $this->replacement_catcard->setFormValue($val);
            }
        }

        // Check field name 'replacement_other' first before field var 'x_replacement_other'
        $val = $CurrentForm->hasValue("replacement_other") ? $CurrentForm->getValue("replacement_other") : $CurrentForm->getValue("x_replacement_other");
        if (!$this->replacement_other->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->replacement_other->Visible = false; // Disable update for API request
            } else {
                $this->replacement_other->setFormValue($val);
            }
        }

        // Check field name 'replacement_problem' first before field var 'x_replacement_problem'
        $val = $CurrentForm->hasValue("replacement_problem") ? $CurrentForm->getValue("replacement_problem") : $CurrentForm->getValue("x_replacement_problem");
        if (!$this->replacement_problem->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->replacement_problem->Visible = false; // Disable update for API request
            } else {
                $this->replacement_problem->setFormValue($val);
            }
        }

        // Check field name 'delete' first before field var 'x_delete'
        $val = $CurrentForm->hasValue("delete") ? $CurrentForm->getValue("delete") : $CurrentForm->getValue("x_delete");
        if (!$this->delete->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delete->Visible = false; // Disable update for API request
            } else {
                $this->delete->setFormValue($val);
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

        // Check field name 'net_id' first before field var 'x_net_id'
        $val = $CurrentForm->hasValue("net_id") ? $CurrentForm->getValue("net_id") : $CurrentForm->getValue("x_net_id");
        if (!$this->net_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->net_id->Visible = false; // Disable update for API request
            } else {
                $this->net_id->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->form_type->CurrentValue = $this->form_type->FormValue;
        $this->supervisor_name->CurrentValue = $this->supervisor_name->FormValue;
        $this->supervisor_phone->CurrentValue = $this->supervisor_phone->FormValue;
        $this->employee_first_name->CurrentValue = $this->employee_first_name->FormValue;
        $this->employee_last_name->CurrentValue = $this->employee_last_name->FormValue;
        $this->catcard->CurrentValue = $this->catcard->FormValue;
        $this->pin->CurrentValue = $this->pin->FormValue;
        $this->employee_unit->CurrentValue = $this->employee_unit->FormValue;
        $this->employee_id->CurrentValue = $this->employee_id->FormValue;
        $this->other_areas->CurrentValue = $this->other_areas->FormValue;
        $this->alarm_access->CurrentValue = $this->alarm_access->FormValue;
        $this->alarm_area->CurrentValue = $this->alarm_area->FormValue;
        $this->alarm_password->CurrentValue = $this->alarm_password->FormValue;
        $this->replacement_catcard->CurrentValue = $this->replacement_catcard->FormValue;
        $this->replacement_other->CurrentValue = $this->replacement_other->FormValue;
        $this->replacement_problem->CurrentValue = $this->replacement_problem->FormValue;
        $this->delete->CurrentValue = $this->delete->FormValue;
        $this->timestamp->CurrentValue = $this->timestamp->FormValue;
        $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
        $this->net_id->CurrentValue = $this->net_id->FormValue;
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
        $this->form_type->setDbValue($row['form_type']);
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_first_name->setDbValue($row['employee_first_name']);
        $this->employee_last_name->setDbValue($row['employee_last_name']);
        $this->catcard->setDbValue($row['catcard']);
        $this->pin->setDbValue($row['pin']);
        $this->employee_unit->setDbValue($row['employee_unit']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->other_areas->setDbValue($row['other_areas']);
        $this->alarm_access->setDbValue($row['alarm_access']);
        $this->alarm_area->setDbValue($row['alarm_area']);
        $this->alarm_password->setDbValue($row['alarm_password']);
        $this->replacement_catcard->setDbValue($row['replacement_catcard']);
        $this->replacement_other->setDbValue($row['replacement_other']);
        $this->replacement_problem->setDbValue($row['replacement_problem']);
        $this->delete->setDbValue($row['delete']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->net_id->setDbValue($row['net_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['form_type'] = $this->form_type->CurrentValue;
        $row['supervisor_name'] = $this->supervisor_name->CurrentValue;
        $row['supervisor_phone'] = $this->supervisor_phone->CurrentValue;
        $row['employee_first_name'] = $this->employee_first_name->CurrentValue;
        $row['employee_last_name'] = $this->employee_last_name->CurrentValue;
        $row['catcard'] = $this->catcard->CurrentValue;
        $row['pin'] = $this->pin->CurrentValue;
        $row['employee_unit'] = $this->employee_unit->CurrentValue;
        $row['employee_id'] = $this->employee_id->CurrentValue;
        $row['other_areas'] = $this->other_areas->CurrentValue;
        $row['alarm_access'] = $this->alarm_access->CurrentValue;
        $row['alarm_area'] = $this->alarm_area->CurrentValue;
        $row['alarm_password'] = $this->alarm_password->CurrentValue;
        $row['replacement_catcard'] = $this->replacement_catcard->CurrentValue;
        $row['replacement_other'] = $this->replacement_other->CurrentValue;
        $row['replacement_problem'] = $this->replacement_problem->CurrentValue;
        $row['delete'] = $this->delete->CurrentValue;
        $row['timestamp'] = $this->timestamp->CurrentValue;
        $row['net_id'] = $this->net_id->CurrentValue;
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

        // form_type

        // supervisor_name

        // supervisor_phone

        // employee_first_name

        // employee_last_name

        // catcard

        // pin

        // employee_unit

        // employee_id

        // other_areas

        // alarm_access

        // alarm_area

        // alarm_password

        // replacement_catcard

        // replacement_other

        // replacement_problem

        // delete

        // timestamp

        // net_id
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // form_type
            $this->form_type->ViewValue = $this->form_type->CurrentValue;
            $this->form_type->ViewCustomAttributes = "";

            // supervisor_name
            $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
            $this->supervisor_name->ViewCustomAttributes = "";

            // supervisor_phone
            $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
            $this->supervisor_phone->ViewCustomAttributes = "";

            // employee_first_name
            $this->employee_first_name->ViewValue = $this->employee_first_name->CurrentValue;
            $this->employee_first_name->ViewCustomAttributes = "";

            // employee_last_name
            $this->employee_last_name->ViewValue = $this->employee_last_name->CurrentValue;
            $this->employee_last_name->ViewCustomAttributes = "";

            // catcard
            $this->catcard->ViewValue = $this->catcard->CurrentValue;
            $this->catcard->ViewCustomAttributes = "";

            // pin
            $this->pin->ViewValue = $this->pin->CurrentValue;
            $this->pin->ViewCustomAttributes = "";

            // employee_unit
            $this->employee_unit->ViewValue = $this->employee_unit->CurrentValue;
            $this->employee_unit->ViewCustomAttributes = "";

            // employee_id
            $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
            $this->employee_id->ViewCustomAttributes = "";

            // other_areas
            $this->other_areas->ViewValue = $this->other_areas->CurrentValue;
            $this->other_areas->ViewCustomAttributes = "";

            // alarm_access
            if (ConvertToBool($this->alarm_access->CurrentValue)) {
                $this->alarm_access->ViewValue = $this->alarm_access->tagCaption(1) != "" ? $this->alarm_access->tagCaption(1) : "Yes";
            } else {
                $this->alarm_access->ViewValue = $this->alarm_access->tagCaption(2) != "" ? $this->alarm_access->tagCaption(2) : "No";
            }
            $this->alarm_access->ViewCustomAttributes = "";

            // alarm_area
            $this->alarm_area->ViewValue = $this->alarm_area->CurrentValue;
            $this->alarm_area->ViewCustomAttributes = "";

            // alarm_password
            $this->alarm_password->ViewValue = $this->alarm_password->CurrentValue;
            $this->alarm_password->ViewCustomAttributes = "";

            // replacement_catcard
            $this->replacement_catcard->ViewValue = $this->replacement_catcard->CurrentValue;
            $this->replacement_catcard->ViewCustomAttributes = "";

            // replacement_other
            $this->replacement_other->ViewValue = $this->replacement_other->CurrentValue;
            $this->replacement_other->ViewCustomAttributes = "";

            // replacement_problem
            $this->replacement_problem->ViewValue = $this->replacement_problem->CurrentValue;
            $this->replacement_problem->ViewCustomAttributes = "";

            // delete
            if (ConvertToBool($this->delete->CurrentValue)) {
                $this->delete->ViewValue = $this->delete->tagCaption(1) != "" ? $this->delete->tagCaption(1) : "Yes";
            } else {
                $this->delete->ViewValue = $this->delete->tagCaption(2) != "" ? $this->delete->tagCaption(2) : "No";
            }
            $this->delete->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // net_id
            $this->net_id->ViewValue = $this->net_id->CurrentValue;
            $this->net_id->ViewCustomAttributes = "";

            // form_type
            $this->form_type->LinkCustomAttributes = "";
            $this->form_type->HrefValue = "";
            $this->form_type->TooltipValue = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";
            $this->supervisor_name->TooltipValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";
            $this->supervisor_phone->TooltipValue = "";

            // employee_first_name
            $this->employee_first_name->LinkCustomAttributes = "";
            $this->employee_first_name->HrefValue = "";
            $this->employee_first_name->TooltipValue = "";

            // employee_last_name
            $this->employee_last_name->LinkCustomAttributes = "";
            $this->employee_last_name->HrefValue = "";
            $this->employee_last_name->TooltipValue = "";

            // catcard
            $this->catcard->LinkCustomAttributes = "";
            $this->catcard->HrefValue = "";
            $this->catcard->TooltipValue = "";

            // pin
            $this->pin->LinkCustomAttributes = "";
            $this->pin->HrefValue = "";
            $this->pin->TooltipValue = "";

            // employee_unit
            $this->employee_unit->LinkCustomAttributes = "";
            $this->employee_unit->HrefValue = "";
            $this->employee_unit->TooltipValue = "";

            // employee_id
            $this->employee_id->LinkCustomAttributes = "";
            $this->employee_id->HrefValue = "";
            $this->employee_id->TooltipValue = "";

            // other_areas
            $this->other_areas->LinkCustomAttributes = "";
            $this->other_areas->HrefValue = "";
            $this->other_areas->TooltipValue = "";

            // alarm_access
            $this->alarm_access->LinkCustomAttributes = "";
            $this->alarm_access->HrefValue = "";
            $this->alarm_access->TooltipValue = "";

            // alarm_area
            $this->alarm_area->LinkCustomAttributes = "";
            $this->alarm_area->HrefValue = "";
            $this->alarm_area->TooltipValue = "";

            // alarm_password
            $this->alarm_password->LinkCustomAttributes = "";
            $this->alarm_password->HrefValue = "";
            $this->alarm_password->TooltipValue = "";

            // replacement_catcard
            $this->replacement_catcard->LinkCustomAttributes = "";
            $this->replacement_catcard->HrefValue = "";
            $this->replacement_catcard->TooltipValue = "";

            // replacement_other
            $this->replacement_other->LinkCustomAttributes = "";
            $this->replacement_other->HrefValue = "";
            $this->replacement_other->TooltipValue = "";

            // replacement_problem
            $this->replacement_problem->LinkCustomAttributes = "";
            $this->replacement_problem->HrefValue = "";
            $this->replacement_problem->TooltipValue = "";

            // delete
            $this->delete->LinkCustomAttributes = "";
            $this->delete->HrefValue = "";
            $this->delete->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";

            // net_id
            $this->net_id->LinkCustomAttributes = "";
            $this->net_id->HrefValue = "";
            $this->net_id->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // form_type
            $this->form_type->EditAttrs["class"] = "form-control";
            $this->form_type->EditCustomAttributes = "";
            if (!$this->form_type->Raw) {
                $this->form_type->CurrentValue = HtmlDecode($this->form_type->CurrentValue);
            }
            $this->form_type->EditValue = HtmlEncode($this->form_type->CurrentValue);
            $this->form_type->PlaceHolder = RemoveHtml($this->form_type->caption());

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

            // catcard
            $this->catcard->EditAttrs["class"] = "form-control";
            $this->catcard->EditCustomAttributes = "";
            if (!$this->catcard->Raw) {
                $this->catcard->CurrentValue = HtmlDecode($this->catcard->CurrentValue);
            }
            $this->catcard->EditValue = HtmlEncode($this->catcard->CurrentValue);
            $this->catcard->PlaceHolder = RemoveHtml($this->catcard->caption());

            // pin
            $this->pin->EditAttrs["class"] = "form-control";
            $this->pin->EditCustomAttributes = "";
            if (!$this->pin->Raw) {
                $this->pin->CurrentValue = HtmlDecode($this->pin->CurrentValue);
            }
            $this->pin->EditValue = HtmlEncode($this->pin->CurrentValue);
            $this->pin->PlaceHolder = RemoveHtml($this->pin->caption());

            // employee_unit
            $this->employee_unit->EditAttrs["class"] = "form-control";
            $this->employee_unit->EditCustomAttributes = "";
            if (!$this->employee_unit->Raw) {
                $this->employee_unit->CurrentValue = HtmlDecode($this->employee_unit->CurrentValue);
            }
            $this->employee_unit->EditValue = HtmlEncode($this->employee_unit->CurrentValue);
            $this->employee_unit->PlaceHolder = RemoveHtml($this->employee_unit->caption());

            // employee_id
            $this->employee_id->EditAttrs["class"] = "form-control";
            $this->employee_id->EditCustomAttributes = "";
            if (!$this->employee_id->Raw) {
                $this->employee_id->CurrentValue = HtmlDecode($this->employee_id->CurrentValue);
            }
            $this->employee_id->EditValue = HtmlEncode($this->employee_id->CurrentValue);
            $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());

            // other_areas
            $this->other_areas->EditAttrs["class"] = "form-control";
            $this->other_areas->EditCustomAttributes = "";
            if (!$this->other_areas->Raw) {
                $this->other_areas->CurrentValue = HtmlDecode($this->other_areas->CurrentValue);
            }
            $this->other_areas->EditValue = HtmlEncode($this->other_areas->CurrentValue);
            $this->other_areas->PlaceHolder = RemoveHtml($this->other_areas->caption());

            // alarm_access
            $this->alarm_access->EditCustomAttributes = "";
            $this->alarm_access->EditValue = $this->alarm_access->options(false);
            $this->alarm_access->PlaceHolder = RemoveHtml($this->alarm_access->caption());

            // alarm_area
            $this->alarm_area->EditAttrs["class"] = "form-control";
            $this->alarm_area->EditCustomAttributes = "";
            if (!$this->alarm_area->Raw) {
                $this->alarm_area->CurrentValue = HtmlDecode($this->alarm_area->CurrentValue);
            }
            $this->alarm_area->EditValue = HtmlEncode($this->alarm_area->CurrentValue);
            $this->alarm_area->PlaceHolder = RemoveHtml($this->alarm_area->caption());

            // alarm_password
            $this->alarm_password->EditAttrs["class"] = "form-control";
            $this->alarm_password->EditCustomAttributes = "";
            if (!$this->alarm_password->Raw) {
                $this->alarm_password->CurrentValue = HtmlDecode($this->alarm_password->CurrentValue);
            }
            $this->alarm_password->EditValue = HtmlEncode($this->alarm_password->CurrentValue);
            $this->alarm_password->PlaceHolder = RemoveHtml($this->alarm_password->caption());

            // replacement_catcard
            $this->replacement_catcard->EditAttrs["class"] = "form-control";
            $this->replacement_catcard->EditCustomAttributes = "";
            if (!$this->replacement_catcard->Raw) {
                $this->replacement_catcard->CurrentValue = HtmlDecode($this->replacement_catcard->CurrentValue);
            }
            $this->replacement_catcard->EditValue = HtmlEncode($this->replacement_catcard->CurrentValue);
            $this->replacement_catcard->PlaceHolder = RemoveHtml($this->replacement_catcard->caption());

            // replacement_other
            $this->replacement_other->EditAttrs["class"] = "form-control";
            $this->replacement_other->EditCustomAttributes = "";
            if (!$this->replacement_other->Raw) {
                $this->replacement_other->CurrentValue = HtmlDecode($this->replacement_other->CurrentValue);
            }
            $this->replacement_other->EditValue = HtmlEncode($this->replacement_other->CurrentValue);
            $this->replacement_other->PlaceHolder = RemoveHtml($this->replacement_other->caption());

            // replacement_problem
            $this->replacement_problem->EditAttrs["class"] = "form-control";
            $this->replacement_problem->EditCustomAttributes = "";
            if (!$this->replacement_problem->Raw) {
                $this->replacement_problem->CurrentValue = HtmlDecode($this->replacement_problem->CurrentValue);
            }
            $this->replacement_problem->EditValue = HtmlEncode($this->replacement_problem->CurrentValue);
            $this->replacement_problem->PlaceHolder = RemoveHtml($this->replacement_problem->caption());

            // delete
            $this->delete->EditCustomAttributes = "";
            $this->delete->EditValue = $this->delete->options(false);
            $this->delete->PlaceHolder = RemoveHtml($this->delete->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // net_id
            $this->net_id->EditAttrs["class"] = "form-control";
            $this->net_id->EditCustomAttributes = "";
            if (!$this->net_id->Raw) {
                $this->net_id->CurrentValue = HtmlDecode($this->net_id->CurrentValue);
            }
            $this->net_id->EditValue = HtmlEncode($this->net_id->CurrentValue);
            $this->net_id->PlaceHolder = RemoveHtml($this->net_id->caption());

            // Add refer script

            // form_type
            $this->form_type->LinkCustomAttributes = "";
            $this->form_type->HrefValue = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";

            // employee_first_name
            $this->employee_first_name->LinkCustomAttributes = "";
            $this->employee_first_name->HrefValue = "";

            // employee_last_name
            $this->employee_last_name->LinkCustomAttributes = "";
            $this->employee_last_name->HrefValue = "";

            // catcard
            $this->catcard->LinkCustomAttributes = "";
            $this->catcard->HrefValue = "";

            // pin
            $this->pin->LinkCustomAttributes = "";
            $this->pin->HrefValue = "";

            // employee_unit
            $this->employee_unit->LinkCustomAttributes = "";
            $this->employee_unit->HrefValue = "";

            // employee_id
            $this->employee_id->LinkCustomAttributes = "";
            $this->employee_id->HrefValue = "";

            // other_areas
            $this->other_areas->LinkCustomAttributes = "";
            $this->other_areas->HrefValue = "";

            // alarm_access
            $this->alarm_access->LinkCustomAttributes = "";
            $this->alarm_access->HrefValue = "";

            // alarm_area
            $this->alarm_area->LinkCustomAttributes = "";
            $this->alarm_area->HrefValue = "";

            // alarm_password
            $this->alarm_password->LinkCustomAttributes = "";
            $this->alarm_password->HrefValue = "";

            // replacement_catcard
            $this->replacement_catcard->LinkCustomAttributes = "";
            $this->replacement_catcard->HrefValue = "";

            // replacement_other
            $this->replacement_other->LinkCustomAttributes = "";
            $this->replacement_other->HrefValue = "";

            // replacement_problem
            $this->replacement_problem->LinkCustomAttributes = "";
            $this->replacement_problem->HrefValue = "";

            // delete
            $this->delete->LinkCustomAttributes = "";
            $this->delete->HrefValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";

            // net_id
            $this->net_id->LinkCustomAttributes = "";
            $this->net_id->HrefValue = "";
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
        if ($this->form_type->Required) {
            if (!$this->form_type->IsDetailKey && EmptyValue($this->form_type->FormValue)) {
                $this->form_type->addErrorMessage(str_replace("%s", $this->form_type->caption(), $this->form_type->RequiredErrorMessage));
            }
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
        if ($this->catcard->Required) {
            if (!$this->catcard->IsDetailKey && EmptyValue($this->catcard->FormValue)) {
                $this->catcard->addErrorMessage(str_replace("%s", $this->catcard->caption(), $this->catcard->RequiredErrorMessage));
            }
        }
        if ($this->pin->Required) {
            if (!$this->pin->IsDetailKey && EmptyValue($this->pin->FormValue)) {
                $this->pin->addErrorMessage(str_replace("%s", $this->pin->caption(), $this->pin->RequiredErrorMessage));
            }
        }
        if ($this->employee_unit->Required) {
            if (!$this->employee_unit->IsDetailKey && EmptyValue($this->employee_unit->FormValue)) {
                $this->employee_unit->addErrorMessage(str_replace("%s", $this->employee_unit->caption(), $this->employee_unit->RequiredErrorMessage));
            }
        }
        if ($this->employee_id->Required) {
            if (!$this->employee_id->IsDetailKey && EmptyValue($this->employee_id->FormValue)) {
                $this->employee_id->addErrorMessage(str_replace("%s", $this->employee_id->caption(), $this->employee_id->RequiredErrorMessage));
            }
        }
        if ($this->other_areas->Required) {
            if (!$this->other_areas->IsDetailKey && EmptyValue($this->other_areas->FormValue)) {
                $this->other_areas->addErrorMessage(str_replace("%s", $this->other_areas->caption(), $this->other_areas->RequiredErrorMessage));
            }
        }
        if ($this->alarm_access->Required) {
            if ($this->alarm_access->FormValue == "") {
                $this->alarm_access->addErrorMessage(str_replace("%s", $this->alarm_access->caption(), $this->alarm_access->RequiredErrorMessage));
            }
        }
        if ($this->alarm_area->Required) {
            if (!$this->alarm_area->IsDetailKey && EmptyValue($this->alarm_area->FormValue)) {
                $this->alarm_area->addErrorMessage(str_replace("%s", $this->alarm_area->caption(), $this->alarm_area->RequiredErrorMessage));
            }
        }
        if ($this->alarm_password->Required) {
            if (!$this->alarm_password->IsDetailKey && EmptyValue($this->alarm_password->FormValue)) {
                $this->alarm_password->addErrorMessage(str_replace("%s", $this->alarm_password->caption(), $this->alarm_password->RequiredErrorMessage));
            }
        }
        if ($this->replacement_catcard->Required) {
            if (!$this->replacement_catcard->IsDetailKey && EmptyValue($this->replacement_catcard->FormValue)) {
                $this->replacement_catcard->addErrorMessage(str_replace("%s", $this->replacement_catcard->caption(), $this->replacement_catcard->RequiredErrorMessage));
            }
        }
        if ($this->replacement_other->Required) {
            if (!$this->replacement_other->IsDetailKey && EmptyValue($this->replacement_other->FormValue)) {
                $this->replacement_other->addErrorMessage(str_replace("%s", $this->replacement_other->caption(), $this->replacement_other->RequiredErrorMessage));
            }
        }
        if ($this->replacement_problem->Required) {
            if (!$this->replacement_problem->IsDetailKey && EmptyValue($this->replacement_problem->FormValue)) {
                $this->replacement_problem->addErrorMessage(str_replace("%s", $this->replacement_problem->caption(), $this->replacement_problem->RequiredErrorMessage));
            }
        }
        if ($this->delete->Required) {
            if ($this->delete->FormValue == "") {
                $this->delete->addErrorMessage(str_replace("%s", $this->delete->caption(), $this->delete->RequiredErrorMessage));
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
        if ($this->net_id->Required) {
            if (!$this->net_id->IsDetailKey && EmptyValue($this->net_id->FormValue)) {
                $this->net_id->addErrorMessage(str_replace("%s", $this->net_id->caption(), $this->net_id->RequiredErrorMessage));
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

        // form_type
        $this->form_type->setDbValueDef($rsnew, $this->form_type->CurrentValue, "", false);

        // supervisor_name
        $this->supervisor_name->setDbValueDef($rsnew, $this->supervisor_name->CurrentValue, "", false);

        // supervisor_phone
        $this->supervisor_phone->setDbValueDef($rsnew, $this->supervisor_phone->CurrentValue, "", false);

        // employee_first_name
        $this->employee_first_name->setDbValueDef($rsnew, $this->employee_first_name->CurrentValue, "", false);

        // employee_last_name
        $this->employee_last_name->setDbValueDef($rsnew, $this->employee_last_name->CurrentValue, "", false);

        // catcard
        $this->catcard->setDbValueDef($rsnew, $this->catcard->CurrentValue, null, false);

        // pin
        $this->pin->setDbValueDef($rsnew, $this->pin->CurrentValue, null, false);

        // employee_unit
        $this->employee_unit->setDbValueDef($rsnew, $this->employee_unit->CurrentValue, "", false);

        // employee_id
        $this->employee_id->setDbValueDef($rsnew, $this->employee_id->CurrentValue, null, false);

        // other_areas
        $this->other_areas->setDbValueDef($rsnew, $this->other_areas->CurrentValue, null, false);

        // alarm_access
        $tmpBool = $this->alarm_access->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->alarm_access->setDbValueDef($rsnew, $tmpBool, null, strval($this->alarm_access->CurrentValue) == "");

        // alarm_area
        $this->alarm_area->setDbValueDef($rsnew, $this->alarm_area->CurrentValue, null, false);

        // alarm_password
        $this->alarm_password->setDbValueDef($rsnew, $this->alarm_password->CurrentValue, null, false);

        // replacement_catcard
        $this->replacement_catcard->setDbValueDef($rsnew, $this->replacement_catcard->CurrentValue, null, false);

        // replacement_other
        $this->replacement_other->setDbValueDef($rsnew, $this->replacement_other->CurrentValue, null, false);

        // replacement_problem
        $this->replacement_problem->setDbValueDef($rsnew, $this->replacement_problem->CurrentValue, null, false);

        // delete
        $tmpBool = $this->delete->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->delete->setDbValueDef($rsnew, $tmpBool, null, strval($this->delete->CurrentValue) == "");

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, false);

        // net_id
        $this->net_id->setDbValueDef($rsnew, $this->net_id->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("BuildingAccessRequestsList"), "", $this->TableVar, true);
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
                case "x_alarm_access":
                    break;
                case "x_delete":
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
