<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PhoneRequestsAdd extends PhoneRequests
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'phone_requests';

    // Page object name
    public $PageObjName = "PhoneRequestsAdd";

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

        // Table object (phone_requests)
        if (!isset($GLOBALS["phone_requests"]) || get_class($GLOBALS["phone_requests"]) == PROJECT_NAMESPACE . "phone_requests") {
            $GLOBALS["phone_requests"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'phone_requests');
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
                $doc = new $class(Container("phone_requests"));
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
                    if ($pageName == "PhoneRequestsView") {
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
            $key .= @$ar['ID'];
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
            $this->ID->Visible = false;
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
        $this->supervisor_name->setVisibility();
        $this->supervisor_phone->setVisibility();
        $this->employee_status->setVisibility();
        $this->building->setVisibility();
        $this->room_number->setVisibility();
        $this->net_id->setVisibility();
        $this->jack->setVisibility();
        $this->jack_id->setVisibility();
        $this->voicemail->setVisibility();
        $this->long_distance->setVisibility();
        $this->need_phone->setVisibility();
        $this->call_appearance->setVisibility();
        $this->kfs_number->setVisibility();
        $this->call_appearance1->setVisibility();
        $this->call_appearance2->setVisibility();
        $this->call_appearance3->setVisibility();
        $this->call_appearance4->setVisibility();
        $this->timestamp->setVisibility();
        $this->ID->Visible = false;
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
            if (($keyValue = Get("ID") ?? Route("ID")) !== null) {
                $this->ID->setQueryStringValue($keyValue);
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
                    $this->terminate("PhoneRequestsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PhoneRequestsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PhoneRequestsView") {
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
        $this->supervisor_name->CurrentValue = null;
        $this->supervisor_name->OldValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_phone->CurrentValue = null;
        $this->supervisor_phone->OldValue = $this->supervisor_phone->CurrentValue;
        $this->employee_status->CurrentValue = null;
        $this->employee_status->OldValue = $this->employee_status->CurrentValue;
        $this->building->CurrentValue = null;
        $this->building->OldValue = $this->building->CurrentValue;
        $this->room_number->CurrentValue = null;
        $this->room_number->OldValue = $this->room_number->CurrentValue;
        $this->net_id->CurrentValue = null;
        $this->net_id->OldValue = $this->net_id->CurrentValue;
        $this->jack->CurrentValue = null;
        $this->jack->OldValue = $this->jack->CurrentValue;
        $this->jack_id->CurrentValue = null;
        $this->jack_id->OldValue = $this->jack_id->CurrentValue;
        $this->voicemail->CurrentValue = null;
        $this->voicemail->OldValue = $this->voicemail->CurrentValue;
        $this->long_distance->CurrentValue = null;
        $this->long_distance->OldValue = $this->long_distance->CurrentValue;
        $this->need_phone->CurrentValue = null;
        $this->need_phone->OldValue = $this->need_phone->CurrentValue;
        $this->call_appearance->CurrentValue = null;
        $this->call_appearance->OldValue = $this->call_appearance->CurrentValue;
        $this->kfs_number->CurrentValue = null;
        $this->kfs_number->OldValue = $this->kfs_number->CurrentValue;
        $this->call_appearance1->CurrentValue = null;
        $this->call_appearance1->OldValue = $this->call_appearance1->CurrentValue;
        $this->call_appearance2->CurrentValue = null;
        $this->call_appearance2->OldValue = $this->call_appearance2->CurrentValue;
        $this->call_appearance3->CurrentValue = null;
        $this->call_appearance3->OldValue = $this->call_appearance3->CurrentValue;
        $this->call_appearance4->CurrentValue = null;
        $this->call_appearance4->OldValue = $this->call_appearance4->CurrentValue;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
        $this->ID->CurrentValue = null;
        $this->ID->OldValue = $this->ID->CurrentValue;
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

        // Check field name 'employee_status' first before field var 'x_employee_status'
        $val = $CurrentForm->hasValue("employee_status") ? $CurrentForm->getValue("employee_status") : $CurrentForm->getValue("x_employee_status");
        if (!$this->employee_status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_status->Visible = false; // Disable update for API request
            } else {
                $this->employee_status->setFormValue($val);
            }
        }

        // Check field name 'building' first before field var 'x_building'
        $val = $CurrentForm->hasValue("building") ? $CurrentForm->getValue("building") : $CurrentForm->getValue("x_building");
        if (!$this->building->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->building->Visible = false; // Disable update for API request
            } else {
                $this->building->setFormValue($val);
            }
        }

        // Check field name 'room_number' first before field var 'x_room_number'
        $val = $CurrentForm->hasValue("room_number") ? $CurrentForm->getValue("room_number") : $CurrentForm->getValue("x_room_number");
        if (!$this->room_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->room_number->Visible = false; // Disable update for API request
            } else {
                $this->room_number->setFormValue($val);
            }
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

        // Check field name 'jack' first before field var 'x_jack'
        $val = $CurrentForm->hasValue("jack") ? $CurrentForm->getValue("jack") : $CurrentForm->getValue("x_jack");
        if (!$this->jack->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jack->Visible = false; // Disable update for API request
            } else {
                $this->jack->setFormValue($val);
            }
        }

        // Check field name 'jack_id' first before field var 'x_jack_id'
        $val = $CurrentForm->hasValue("jack_id") ? $CurrentForm->getValue("jack_id") : $CurrentForm->getValue("x_jack_id");
        if (!$this->jack_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jack_id->Visible = false; // Disable update for API request
            } else {
                $this->jack_id->setFormValue($val);
            }
        }

        // Check field name 'voicemail' first before field var 'x_voicemail'
        $val = $CurrentForm->hasValue("voicemail") ? $CurrentForm->getValue("voicemail") : $CurrentForm->getValue("x_voicemail");
        if (!$this->voicemail->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->voicemail->Visible = false; // Disable update for API request
            } else {
                $this->voicemail->setFormValue($val);
            }
        }

        // Check field name 'long_distance' first before field var 'x_long_distance'
        $val = $CurrentForm->hasValue("long_distance") ? $CurrentForm->getValue("long_distance") : $CurrentForm->getValue("x_long_distance");
        if (!$this->long_distance->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->long_distance->Visible = false; // Disable update for API request
            } else {
                $this->long_distance->setFormValue($val);
            }
        }

        // Check field name 'need_phone' first before field var 'x_need_phone'
        $val = $CurrentForm->hasValue("need_phone") ? $CurrentForm->getValue("need_phone") : $CurrentForm->getValue("x_need_phone");
        if (!$this->need_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->need_phone->Visible = false; // Disable update for API request
            } else {
                $this->need_phone->setFormValue($val);
            }
        }

        // Check field name 'call_appearance' first before field var 'x_call_appearance'
        $val = $CurrentForm->hasValue("call_appearance") ? $CurrentForm->getValue("call_appearance") : $CurrentForm->getValue("x_call_appearance");
        if (!$this->call_appearance->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->call_appearance->Visible = false; // Disable update for API request
            } else {
                $this->call_appearance->setFormValue($val);
            }
        }

        // Check field name 'kfs_number' first before field var 'x_kfs_number'
        $val = $CurrentForm->hasValue("kfs_number") ? $CurrentForm->getValue("kfs_number") : $CurrentForm->getValue("x_kfs_number");
        if (!$this->kfs_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kfs_number->Visible = false; // Disable update for API request
            } else {
                $this->kfs_number->setFormValue($val);
            }
        }

        // Check field name 'call_appearance1' first before field var 'x_call_appearance1'
        $val = $CurrentForm->hasValue("call_appearance1") ? $CurrentForm->getValue("call_appearance1") : $CurrentForm->getValue("x_call_appearance1");
        if (!$this->call_appearance1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->call_appearance1->Visible = false; // Disable update for API request
            } else {
                $this->call_appearance1->setFormValue($val);
            }
        }

        // Check field name 'call_appearance2' first before field var 'x_call_appearance2'
        $val = $CurrentForm->hasValue("call_appearance2") ? $CurrentForm->getValue("call_appearance2") : $CurrentForm->getValue("x_call_appearance2");
        if (!$this->call_appearance2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->call_appearance2->Visible = false; // Disable update for API request
            } else {
                $this->call_appearance2->setFormValue($val);
            }
        }

        // Check field name 'call_appearance3' first before field var 'x_call_appearance3'
        $val = $CurrentForm->hasValue("call_appearance3") ? $CurrentForm->getValue("call_appearance3") : $CurrentForm->getValue("x_call_appearance3");
        if (!$this->call_appearance3->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->call_appearance3->Visible = false; // Disable update for API request
            } else {
                $this->call_appearance3->setFormValue($val);
            }
        }

        // Check field name 'call_appearance4' first before field var 'x_call_appearance4'
        $val = $CurrentForm->hasValue("call_appearance4") ? $CurrentForm->getValue("call_appearance4") : $CurrentForm->getValue("x_call_appearance4");
        if (!$this->call_appearance4->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->call_appearance4->Visible = false; // Disable update for API request
            } else {
                $this->call_appearance4->setFormValue($val);
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

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->supervisor_name->CurrentValue = $this->supervisor_name->FormValue;
        $this->supervisor_phone->CurrentValue = $this->supervisor_phone->FormValue;
        $this->employee_status->CurrentValue = $this->employee_status->FormValue;
        $this->building->CurrentValue = $this->building->FormValue;
        $this->room_number->CurrentValue = $this->room_number->FormValue;
        $this->net_id->CurrentValue = $this->net_id->FormValue;
        $this->jack->CurrentValue = $this->jack->FormValue;
        $this->jack_id->CurrentValue = $this->jack_id->FormValue;
        $this->voicemail->CurrentValue = $this->voicemail->FormValue;
        $this->long_distance->CurrentValue = $this->long_distance->FormValue;
        $this->need_phone->CurrentValue = $this->need_phone->FormValue;
        $this->call_appearance->CurrentValue = $this->call_appearance->FormValue;
        $this->kfs_number->CurrentValue = $this->kfs_number->FormValue;
        $this->call_appearance1->CurrentValue = $this->call_appearance1->FormValue;
        $this->call_appearance2->CurrentValue = $this->call_appearance2->FormValue;
        $this->call_appearance3->CurrentValue = $this->call_appearance3->FormValue;
        $this->call_appearance4->CurrentValue = $this->call_appearance4->FormValue;
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
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_status->setDbValue($row['employee_status']);
        $this->building->setDbValue($row['building']);
        $this->room_number->setDbValue($row['room_number']);
        $this->net_id->setDbValue($row['net_id']);
        $this->jack->setDbValue($row['jack']);
        $this->jack_id->setDbValue($row['jack_id']);
        $this->voicemail->setDbValue($row['voicemail']);
        $this->long_distance->setDbValue($row['long_distance']);
        $this->need_phone->setDbValue($row['need_phone']);
        $this->call_appearance->setDbValue($row['call_appearance']);
        $this->kfs_number->setDbValue($row['kfs_number']);
        $this->call_appearance1->setDbValue($row['call_appearance1']);
        $this->call_appearance2->setDbValue($row['call_appearance2']);
        $this->call_appearance3->setDbValue($row['call_appearance3']);
        $this->call_appearance4->setDbValue($row['call_appearance4']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->ID->setDbValue($row['ID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['supervisor_name'] = $this->supervisor_name->CurrentValue;
        $row['supervisor_phone'] = $this->supervisor_phone->CurrentValue;
        $row['employee_status'] = $this->employee_status->CurrentValue;
        $row['building'] = $this->building->CurrentValue;
        $row['room_number'] = $this->room_number->CurrentValue;
        $row['net_id'] = $this->net_id->CurrentValue;
        $row['jack'] = $this->jack->CurrentValue;
        $row['jack_id'] = $this->jack_id->CurrentValue;
        $row['voicemail'] = $this->voicemail->CurrentValue;
        $row['long_distance'] = $this->long_distance->CurrentValue;
        $row['need_phone'] = $this->need_phone->CurrentValue;
        $row['call_appearance'] = $this->call_appearance->CurrentValue;
        $row['kfs_number'] = $this->kfs_number->CurrentValue;
        $row['call_appearance1'] = $this->call_appearance1->CurrentValue;
        $row['call_appearance2'] = $this->call_appearance2->CurrentValue;
        $row['call_appearance3'] = $this->call_appearance3->CurrentValue;
        $row['call_appearance4'] = $this->call_appearance4->CurrentValue;
        $row['timestamp'] = $this->timestamp->CurrentValue;
        $row['ID'] = $this->ID->CurrentValue;
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

        // supervisor_name

        // supervisor_phone

        // employee_status

        // building

        // room_number

        // net_id

        // jack

        // jack_id

        // voicemail

        // long_distance

        // need_phone

        // call_appearance

        // kfs_number

        // call_appearance1

        // call_appearance2

        // call_appearance3

        // call_appearance4

        // timestamp

        // ID
        if ($this->RowType == ROWTYPE_VIEW) {
            // supervisor_name
            $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
            $this->supervisor_name->ViewCustomAttributes = "";

            // supervisor_phone
            $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
            $this->supervisor_phone->ViewCustomAttributes = "";

            // employee_status
            $this->employee_status->ViewValue = $this->employee_status->CurrentValue;
            $this->employee_status->ViewCustomAttributes = "";

            // building
            $this->building->ViewValue = $this->building->CurrentValue;
            $this->building->ViewCustomAttributes = "";

            // room_number
            $this->room_number->ViewValue = $this->room_number->CurrentValue;
            $this->room_number->ViewCustomAttributes = "";

            // net_id
            $this->net_id->ViewValue = $this->net_id->CurrentValue;
            $this->net_id->ViewCustomAttributes = "";

            // jack
            $this->jack->ViewValue = $this->jack->CurrentValue;
            $this->jack->ViewCustomAttributes = "";

            // jack_id
            $this->jack_id->ViewValue = $this->jack_id->CurrentValue;
            $this->jack_id->ViewCustomAttributes = "";

            // voicemail
            $this->voicemail->ViewValue = $this->voicemail->CurrentValue;
            $this->voicemail->ViewCustomAttributes = "";

            // long_distance
            $this->long_distance->ViewValue = $this->long_distance->CurrentValue;
            $this->long_distance->ViewCustomAttributes = "";

            // need_phone
            $this->need_phone->ViewValue = $this->need_phone->CurrentValue;
            $this->need_phone->ViewCustomAttributes = "";

            // call_appearance
            $this->call_appearance->ViewValue = $this->call_appearance->CurrentValue;
            $this->call_appearance->ViewCustomAttributes = "";

            // kfs_number
            $this->kfs_number->ViewValue = $this->kfs_number->CurrentValue;
            $this->kfs_number->ViewCustomAttributes = "";

            // call_appearance1
            $this->call_appearance1->ViewValue = $this->call_appearance1->CurrentValue;
            $this->call_appearance1->ViewCustomAttributes = "";

            // call_appearance2
            $this->call_appearance2->ViewValue = $this->call_appearance2->CurrentValue;
            $this->call_appearance2->ViewCustomAttributes = "";

            // call_appearance3
            $this->call_appearance3->ViewValue = $this->call_appearance3->CurrentValue;
            $this->call_appearance3->ViewCustomAttributes = "";

            // call_appearance4
            $this->call_appearance4->ViewValue = $this->call_appearance4->CurrentValue;
            $this->call_appearance4->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";
            $this->supervisor_name->TooltipValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";
            $this->supervisor_phone->TooltipValue = "";

            // employee_status
            $this->employee_status->LinkCustomAttributes = "";
            $this->employee_status->HrefValue = "";
            $this->employee_status->TooltipValue = "";

            // building
            $this->building->LinkCustomAttributes = "";
            $this->building->HrefValue = "";
            $this->building->TooltipValue = "";

            // room_number
            $this->room_number->LinkCustomAttributes = "";
            $this->room_number->HrefValue = "";
            $this->room_number->TooltipValue = "";

            // net_id
            $this->net_id->LinkCustomAttributes = "";
            $this->net_id->HrefValue = "";
            $this->net_id->TooltipValue = "";

            // jack
            $this->jack->LinkCustomAttributes = "";
            $this->jack->HrefValue = "";
            $this->jack->TooltipValue = "";

            // jack_id
            $this->jack_id->LinkCustomAttributes = "";
            $this->jack_id->HrefValue = "";
            $this->jack_id->TooltipValue = "";

            // voicemail
            $this->voicemail->LinkCustomAttributes = "";
            $this->voicemail->HrefValue = "";
            $this->voicemail->TooltipValue = "";

            // long_distance
            $this->long_distance->LinkCustomAttributes = "";
            $this->long_distance->HrefValue = "";
            $this->long_distance->TooltipValue = "";

            // need_phone
            $this->need_phone->LinkCustomAttributes = "";
            $this->need_phone->HrefValue = "";
            $this->need_phone->TooltipValue = "";

            // call_appearance
            $this->call_appearance->LinkCustomAttributes = "";
            $this->call_appearance->HrefValue = "";
            $this->call_appearance->TooltipValue = "";

            // kfs_number
            $this->kfs_number->LinkCustomAttributes = "";
            $this->kfs_number->HrefValue = "";
            $this->kfs_number->TooltipValue = "";

            // call_appearance1
            $this->call_appearance1->LinkCustomAttributes = "";
            $this->call_appearance1->HrefValue = "";
            $this->call_appearance1->TooltipValue = "";

            // call_appearance2
            $this->call_appearance2->LinkCustomAttributes = "";
            $this->call_appearance2->HrefValue = "";
            $this->call_appearance2->TooltipValue = "";

            // call_appearance3
            $this->call_appearance3->LinkCustomAttributes = "";
            $this->call_appearance3->HrefValue = "";
            $this->call_appearance3->TooltipValue = "";

            // call_appearance4
            $this->call_appearance4->LinkCustomAttributes = "";
            $this->call_appearance4->HrefValue = "";
            $this->call_appearance4->TooltipValue = "";

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

            // employee_status
            $this->employee_status->EditAttrs["class"] = "form-control";
            $this->employee_status->EditCustomAttributes = "";
            if (!$this->employee_status->Raw) {
                $this->employee_status->CurrentValue = HtmlDecode($this->employee_status->CurrentValue);
            }
            $this->employee_status->EditValue = HtmlEncode($this->employee_status->CurrentValue);
            $this->employee_status->PlaceHolder = RemoveHtml($this->employee_status->caption());

            // building
            $this->building->EditAttrs["class"] = "form-control";
            $this->building->EditCustomAttributes = "";
            if (!$this->building->Raw) {
                $this->building->CurrentValue = HtmlDecode($this->building->CurrentValue);
            }
            $this->building->EditValue = HtmlEncode($this->building->CurrentValue);
            $this->building->PlaceHolder = RemoveHtml($this->building->caption());

            // room_number
            $this->room_number->EditAttrs["class"] = "form-control";
            $this->room_number->EditCustomAttributes = "";
            if (!$this->room_number->Raw) {
                $this->room_number->CurrentValue = HtmlDecode($this->room_number->CurrentValue);
            }
            $this->room_number->EditValue = HtmlEncode($this->room_number->CurrentValue);
            $this->room_number->PlaceHolder = RemoveHtml($this->room_number->caption());

            // net_id
            $this->net_id->EditAttrs["class"] = "form-control";
            $this->net_id->EditCustomAttributes = "";
            if (!$this->net_id->Raw) {
                $this->net_id->CurrentValue = HtmlDecode($this->net_id->CurrentValue);
            }
            $this->net_id->EditValue = HtmlEncode($this->net_id->CurrentValue);
            $this->net_id->PlaceHolder = RemoveHtml($this->net_id->caption());

            // jack
            $this->jack->EditAttrs["class"] = "form-control";
            $this->jack->EditCustomAttributes = "";
            if (!$this->jack->Raw) {
                $this->jack->CurrentValue = HtmlDecode($this->jack->CurrentValue);
            }
            $this->jack->EditValue = HtmlEncode($this->jack->CurrentValue);
            $this->jack->PlaceHolder = RemoveHtml($this->jack->caption());

            // jack_id
            $this->jack_id->EditAttrs["class"] = "form-control";
            $this->jack_id->EditCustomAttributes = "";
            if (!$this->jack_id->Raw) {
                $this->jack_id->CurrentValue = HtmlDecode($this->jack_id->CurrentValue);
            }
            $this->jack_id->EditValue = HtmlEncode($this->jack_id->CurrentValue);
            $this->jack_id->PlaceHolder = RemoveHtml($this->jack_id->caption());

            // voicemail
            $this->voicemail->EditAttrs["class"] = "form-control";
            $this->voicemail->EditCustomAttributes = "";
            if (!$this->voicemail->Raw) {
                $this->voicemail->CurrentValue = HtmlDecode($this->voicemail->CurrentValue);
            }
            $this->voicemail->EditValue = HtmlEncode($this->voicemail->CurrentValue);
            $this->voicemail->PlaceHolder = RemoveHtml($this->voicemail->caption());

            // long_distance
            $this->long_distance->EditAttrs["class"] = "form-control";
            $this->long_distance->EditCustomAttributes = "";
            if (!$this->long_distance->Raw) {
                $this->long_distance->CurrentValue = HtmlDecode($this->long_distance->CurrentValue);
            }
            $this->long_distance->EditValue = HtmlEncode($this->long_distance->CurrentValue);
            $this->long_distance->PlaceHolder = RemoveHtml($this->long_distance->caption());

            // need_phone
            $this->need_phone->EditAttrs["class"] = "form-control";
            $this->need_phone->EditCustomAttributes = "";
            if (!$this->need_phone->Raw) {
                $this->need_phone->CurrentValue = HtmlDecode($this->need_phone->CurrentValue);
            }
            $this->need_phone->EditValue = HtmlEncode($this->need_phone->CurrentValue);
            $this->need_phone->PlaceHolder = RemoveHtml($this->need_phone->caption());

            // call_appearance
            $this->call_appearance->EditAttrs["class"] = "form-control";
            $this->call_appearance->EditCustomAttributes = "";
            if (!$this->call_appearance->Raw) {
                $this->call_appearance->CurrentValue = HtmlDecode($this->call_appearance->CurrentValue);
            }
            $this->call_appearance->EditValue = HtmlEncode($this->call_appearance->CurrentValue);
            $this->call_appearance->PlaceHolder = RemoveHtml($this->call_appearance->caption());

            // kfs_number
            $this->kfs_number->EditAttrs["class"] = "form-control";
            $this->kfs_number->EditCustomAttributes = "";
            if (!$this->kfs_number->Raw) {
                $this->kfs_number->CurrentValue = HtmlDecode($this->kfs_number->CurrentValue);
            }
            $this->kfs_number->EditValue = HtmlEncode($this->kfs_number->CurrentValue);
            $this->kfs_number->PlaceHolder = RemoveHtml($this->kfs_number->caption());

            // call_appearance1
            $this->call_appearance1->EditAttrs["class"] = "form-control";
            $this->call_appearance1->EditCustomAttributes = "";
            if (!$this->call_appearance1->Raw) {
                $this->call_appearance1->CurrentValue = HtmlDecode($this->call_appearance1->CurrentValue);
            }
            $this->call_appearance1->EditValue = HtmlEncode($this->call_appearance1->CurrentValue);
            $this->call_appearance1->PlaceHolder = RemoveHtml($this->call_appearance1->caption());

            // call_appearance2
            $this->call_appearance2->EditAttrs["class"] = "form-control";
            $this->call_appearance2->EditCustomAttributes = "";
            if (!$this->call_appearance2->Raw) {
                $this->call_appearance2->CurrentValue = HtmlDecode($this->call_appearance2->CurrentValue);
            }
            $this->call_appearance2->EditValue = HtmlEncode($this->call_appearance2->CurrentValue);
            $this->call_appearance2->PlaceHolder = RemoveHtml($this->call_appearance2->caption());

            // call_appearance3
            $this->call_appearance3->EditAttrs["class"] = "form-control";
            $this->call_appearance3->EditCustomAttributes = "";
            if (!$this->call_appearance3->Raw) {
                $this->call_appearance3->CurrentValue = HtmlDecode($this->call_appearance3->CurrentValue);
            }
            $this->call_appearance3->EditValue = HtmlEncode($this->call_appearance3->CurrentValue);
            $this->call_appearance3->PlaceHolder = RemoveHtml($this->call_appearance3->caption());

            // call_appearance4
            $this->call_appearance4->EditAttrs["class"] = "form-control";
            $this->call_appearance4->EditCustomAttributes = "";
            if (!$this->call_appearance4->Raw) {
                $this->call_appearance4->CurrentValue = HtmlDecode($this->call_appearance4->CurrentValue);
            }
            $this->call_appearance4->EditValue = HtmlEncode($this->call_appearance4->CurrentValue);
            $this->call_appearance4->PlaceHolder = RemoveHtml($this->call_appearance4->caption());

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

            // employee_status
            $this->employee_status->LinkCustomAttributes = "";
            $this->employee_status->HrefValue = "";

            // building
            $this->building->LinkCustomAttributes = "";
            $this->building->HrefValue = "";

            // room_number
            $this->room_number->LinkCustomAttributes = "";
            $this->room_number->HrefValue = "";

            // net_id
            $this->net_id->LinkCustomAttributes = "";
            $this->net_id->HrefValue = "";

            // jack
            $this->jack->LinkCustomAttributes = "";
            $this->jack->HrefValue = "";

            // jack_id
            $this->jack_id->LinkCustomAttributes = "";
            $this->jack_id->HrefValue = "";

            // voicemail
            $this->voicemail->LinkCustomAttributes = "";
            $this->voicemail->HrefValue = "";

            // long_distance
            $this->long_distance->LinkCustomAttributes = "";
            $this->long_distance->HrefValue = "";

            // need_phone
            $this->need_phone->LinkCustomAttributes = "";
            $this->need_phone->HrefValue = "";

            // call_appearance
            $this->call_appearance->LinkCustomAttributes = "";
            $this->call_appearance->HrefValue = "";

            // kfs_number
            $this->kfs_number->LinkCustomAttributes = "";
            $this->kfs_number->HrefValue = "";

            // call_appearance1
            $this->call_appearance1->LinkCustomAttributes = "";
            $this->call_appearance1->HrefValue = "";

            // call_appearance2
            $this->call_appearance2->LinkCustomAttributes = "";
            $this->call_appearance2->HrefValue = "";

            // call_appearance3
            $this->call_appearance3->LinkCustomAttributes = "";
            $this->call_appearance3->HrefValue = "";

            // call_appearance4
            $this->call_appearance4->LinkCustomAttributes = "";
            $this->call_appearance4->HrefValue = "";

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
        if ($this->employee_status->Required) {
            if (!$this->employee_status->IsDetailKey && EmptyValue($this->employee_status->FormValue)) {
                $this->employee_status->addErrorMessage(str_replace("%s", $this->employee_status->caption(), $this->employee_status->RequiredErrorMessage));
            }
        }
        if ($this->building->Required) {
            if (!$this->building->IsDetailKey && EmptyValue($this->building->FormValue)) {
                $this->building->addErrorMessage(str_replace("%s", $this->building->caption(), $this->building->RequiredErrorMessage));
            }
        }
        if ($this->room_number->Required) {
            if (!$this->room_number->IsDetailKey && EmptyValue($this->room_number->FormValue)) {
                $this->room_number->addErrorMessage(str_replace("%s", $this->room_number->caption(), $this->room_number->RequiredErrorMessage));
            }
        }
        if ($this->net_id->Required) {
            if (!$this->net_id->IsDetailKey && EmptyValue($this->net_id->FormValue)) {
                $this->net_id->addErrorMessage(str_replace("%s", $this->net_id->caption(), $this->net_id->RequiredErrorMessage));
            }
        }
        if ($this->jack->Required) {
            if (!$this->jack->IsDetailKey && EmptyValue($this->jack->FormValue)) {
                $this->jack->addErrorMessage(str_replace("%s", $this->jack->caption(), $this->jack->RequiredErrorMessage));
            }
        }
        if ($this->jack_id->Required) {
            if (!$this->jack_id->IsDetailKey && EmptyValue($this->jack_id->FormValue)) {
                $this->jack_id->addErrorMessage(str_replace("%s", $this->jack_id->caption(), $this->jack_id->RequiredErrorMessage));
            }
        }
        if ($this->voicemail->Required) {
            if (!$this->voicemail->IsDetailKey && EmptyValue($this->voicemail->FormValue)) {
                $this->voicemail->addErrorMessage(str_replace("%s", $this->voicemail->caption(), $this->voicemail->RequiredErrorMessage));
            }
        }
        if ($this->long_distance->Required) {
            if (!$this->long_distance->IsDetailKey && EmptyValue($this->long_distance->FormValue)) {
                $this->long_distance->addErrorMessage(str_replace("%s", $this->long_distance->caption(), $this->long_distance->RequiredErrorMessage));
            }
        }
        if ($this->need_phone->Required) {
            if (!$this->need_phone->IsDetailKey && EmptyValue($this->need_phone->FormValue)) {
                $this->need_phone->addErrorMessage(str_replace("%s", $this->need_phone->caption(), $this->need_phone->RequiredErrorMessage));
            }
        }
        if ($this->call_appearance->Required) {
            if (!$this->call_appearance->IsDetailKey && EmptyValue($this->call_appearance->FormValue)) {
                $this->call_appearance->addErrorMessage(str_replace("%s", $this->call_appearance->caption(), $this->call_appearance->RequiredErrorMessage));
            }
        }
        if ($this->kfs_number->Required) {
            if (!$this->kfs_number->IsDetailKey && EmptyValue($this->kfs_number->FormValue)) {
                $this->kfs_number->addErrorMessage(str_replace("%s", $this->kfs_number->caption(), $this->kfs_number->RequiredErrorMessage));
            }
        }
        if ($this->call_appearance1->Required) {
            if (!$this->call_appearance1->IsDetailKey && EmptyValue($this->call_appearance1->FormValue)) {
                $this->call_appearance1->addErrorMessage(str_replace("%s", $this->call_appearance1->caption(), $this->call_appearance1->RequiredErrorMessage));
            }
        }
        if ($this->call_appearance2->Required) {
            if (!$this->call_appearance2->IsDetailKey && EmptyValue($this->call_appearance2->FormValue)) {
                $this->call_appearance2->addErrorMessage(str_replace("%s", $this->call_appearance2->caption(), $this->call_appearance2->RequiredErrorMessage));
            }
        }
        if ($this->call_appearance3->Required) {
            if (!$this->call_appearance3->IsDetailKey && EmptyValue($this->call_appearance3->FormValue)) {
                $this->call_appearance3->addErrorMessage(str_replace("%s", $this->call_appearance3->caption(), $this->call_appearance3->RequiredErrorMessage));
            }
        }
        if ($this->call_appearance4->Required) {
            if (!$this->call_appearance4->IsDetailKey && EmptyValue($this->call_appearance4->FormValue)) {
                $this->call_appearance4->addErrorMessage(str_replace("%s", $this->call_appearance4->caption(), $this->call_appearance4->RequiredErrorMessage));
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

        // employee_status
        $this->employee_status->setDbValueDef($rsnew, $this->employee_status->CurrentValue, "", false);

        // building
        $this->building->setDbValueDef($rsnew, $this->building->CurrentValue, "", false);

        // room_number
        $this->room_number->setDbValueDef($rsnew, $this->room_number->CurrentValue, "", false);

        // net_id
        $this->net_id->setDbValueDef($rsnew, $this->net_id->CurrentValue, "", false);

        // jack
        $this->jack->setDbValueDef($rsnew, $this->jack->CurrentValue, "", false);

        // jack_id
        $this->jack_id->setDbValueDef($rsnew, $this->jack_id->CurrentValue, "", false);

        // voicemail
        $this->voicemail->setDbValueDef($rsnew, $this->voicemail->CurrentValue, "", false);

        // long_distance
        $this->long_distance->setDbValueDef($rsnew, $this->long_distance->CurrentValue, "", false);

        // need_phone
        $this->need_phone->setDbValueDef($rsnew, $this->need_phone->CurrentValue, "", false);

        // call_appearance
        $this->call_appearance->setDbValueDef($rsnew, $this->call_appearance->CurrentValue, "", false);

        // kfs_number
        $this->kfs_number->setDbValueDef($rsnew, $this->kfs_number->CurrentValue, "", false);

        // call_appearance1
        $this->call_appearance1->setDbValueDef($rsnew, $this->call_appearance1->CurrentValue, "", false);

        // call_appearance2
        $this->call_appearance2->setDbValueDef($rsnew, $this->call_appearance2->CurrentValue, "", false);

        // call_appearance3
        $this->call_appearance3->setDbValueDef($rsnew, $this->call_appearance3->CurrentValue, "", false);

        // call_appearance4
        $this->call_appearance4->setDbValueDef($rsnew, $this->call_appearance4->CurrentValue, "", false);

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), CurrentDate(), false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PhoneRequestsList"), "", $this->TableVar, true);
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
