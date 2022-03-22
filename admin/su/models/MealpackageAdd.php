<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MealpackageAdd extends Mealpackage
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'mealpackage';

    // Page object name
    public $PageObjName = "MealpackageAdd";

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

        // Table object (mealpackage)
        if (!isset($GLOBALS["mealpackage"]) || get_class($GLOBALS["mealpackage"]) == PROJECT_NAMESPACE . "mealpackage") {
            $GLOBALS["mealpackage"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'mealpackage');
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
                $doc = new $class(Container("mealpackage"));
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
                    if ($pageName == "MealpackageView") {
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
        $this->netid->setVisibility();
        $this->sid->setVisibility();
        $this->_email->setVisibility();
        $this->firstname->setVisibility();
        $this->lastname->setVisibility();
        $this->phone->setVisibility();
        $this->dorm->setVisibility();
        $this->meal->setVisibility();
        $this->refrigerator->setVisibility();
        $this->microwave->setVisibility();
        $this->water->setVisibility();
        $this->requests->setVisibility();
        $this->room_number->setVisibility();
        $this->amount->setVisibility();
        $this->payment->setVisibility();
        $this->status->setVisibility();
        $this->timestamp->setVisibility();
        $this->type->setVisibility();
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
                    $this->terminate("MealpackageList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "MealpackageList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "MealpackageView") {
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
        $this->netid->CurrentValue = null;
        $this->netid->OldValue = $this->netid->CurrentValue;
        $this->sid->CurrentValue = null;
        $this->sid->OldValue = $this->sid->CurrentValue;
        $this->_email->CurrentValue = null;
        $this->_email->OldValue = $this->_email->CurrentValue;
        $this->firstname->CurrentValue = null;
        $this->firstname->OldValue = $this->firstname->CurrentValue;
        $this->lastname->CurrentValue = null;
        $this->lastname->OldValue = $this->lastname->CurrentValue;
        $this->phone->CurrentValue = null;
        $this->phone->OldValue = $this->phone->CurrentValue;
        $this->dorm->CurrentValue = null;
        $this->dorm->OldValue = $this->dorm->CurrentValue;
        $this->meal->CurrentValue = null;
        $this->meal->OldValue = $this->meal->CurrentValue;
        $this->refrigerator->CurrentValue = null;
        $this->refrigerator->OldValue = $this->refrigerator->CurrentValue;
        $this->microwave->CurrentValue = null;
        $this->microwave->OldValue = $this->microwave->CurrentValue;
        $this->water->CurrentValue = null;
        $this->water->OldValue = $this->water->CurrentValue;
        $this->requests->CurrentValue = null;
        $this->requests->OldValue = $this->requests->CurrentValue;
        $this->room_number->CurrentValue = null;
        $this->room_number->OldValue = $this->room_number->CurrentValue;
        $this->amount->CurrentValue = null;
        $this->amount->OldValue = $this->amount->CurrentValue;
        $this->payment->CurrentValue = null;
        $this->payment->OldValue = $this->payment->CurrentValue;
        $this->status->CurrentValue = null;
        $this->status->OldValue = $this->status->CurrentValue;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
        $this->type->CurrentValue = null;
        $this->type->OldValue = $this->type->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'netid' first before field var 'x_netid'
        $val = $CurrentForm->hasValue("netid") ? $CurrentForm->getValue("netid") : $CurrentForm->getValue("x_netid");
        if (!$this->netid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->netid->Visible = false; // Disable update for API request
            } else {
                $this->netid->setFormValue($val);
            }
        }

        // Check field name 'sid' first before field var 'x_sid'
        $val = $CurrentForm->hasValue("sid") ? $CurrentForm->getValue("sid") : $CurrentForm->getValue("x_sid");
        if (!$this->sid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sid->Visible = false; // Disable update for API request
            } else {
                $this->sid->setFormValue($val);
            }
        }

        // Check field name 'email' first before field var 'x__email'
        $val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
        if (!$this->_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_email->Visible = false; // Disable update for API request
            } else {
                $this->_email->setFormValue($val);
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

        // Check field name 'phone' first before field var 'x_phone'
        $val = $CurrentForm->hasValue("phone") ? $CurrentForm->getValue("phone") : $CurrentForm->getValue("x_phone");
        if (!$this->phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->phone->Visible = false; // Disable update for API request
            } else {
                $this->phone->setFormValue($val);
            }
        }

        // Check field name 'dorm' first before field var 'x_dorm'
        $val = $CurrentForm->hasValue("dorm") ? $CurrentForm->getValue("dorm") : $CurrentForm->getValue("x_dorm");
        if (!$this->dorm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dorm->Visible = false; // Disable update for API request
            } else {
                $this->dorm->setFormValue($val);
            }
        }

        // Check field name 'meal' first before field var 'x_meal'
        $val = $CurrentForm->hasValue("meal") ? $CurrentForm->getValue("meal") : $CurrentForm->getValue("x_meal");
        if (!$this->meal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meal->Visible = false; // Disable update for API request
            } else {
                $this->meal->setFormValue($val);
            }
        }

        // Check field name 'refrigerator' first before field var 'x_refrigerator'
        $val = $CurrentForm->hasValue("refrigerator") ? $CurrentForm->getValue("refrigerator") : $CurrentForm->getValue("x_refrigerator");
        if (!$this->refrigerator->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->refrigerator->Visible = false; // Disable update for API request
            } else {
                $this->refrigerator->setFormValue($val);
            }
        }

        // Check field name 'microwave' first before field var 'x_microwave'
        $val = $CurrentForm->hasValue("microwave") ? $CurrentForm->getValue("microwave") : $CurrentForm->getValue("x_microwave");
        if (!$this->microwave->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->microwave->Visible = false; // Disable update for API request
            } else {
                $this->microwave->setFormValue($val);
            }
        }

        // Check field name 'water' first before field var 'x_water'
        $val = $CurrentForm->hasValue("water") ? $CurrentForm->getValue("water") : $CurrentForm->getValue("x_water");
        if (!$this->water->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->water->Visible = false; // Disable update for API request
            } else {
                $this->water->setFormValue($val);
            }
        }

        // Check field name 'requests' first before field var 'x_requests'
        $val = $CurrentForm->hasValue("requests") ? $CurrentForm->getValue("requests") : $CurrentForm->getValue("x_requests");
        if (!$this->requests->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->requests->Visible = false; // Disable update for API request
            } else {
                $this->requests->setFormValue($val);
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

        // Check field name 'amount' first before field var 'x_amount'
        $val = $CurrentForm->hasValue("amount") ? $CurrentForm->getValue("amount") : $CurrentForm->getValue("x_amount");
        if (!$this->amount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->amount->Visible = false; // Disable update for API request
            } else {
                $this->amount->setFormValue($val);
            }
        }

        // Check field name 'payment' first before field var 'x_payment'
        $val = $CurrentForm->hasValue("payment") ? $CurrentForm->getValue("payment") : $CurrentForm->getValue("x_payment");
        if (!$this->payment->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->payment->Visible = false; // Disable update for API request
            } else {
                $this->payment->setFormValue($val);
            }
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
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

        // Check field name 'type' first before field var 'x_type'
        $val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
        if (!$this->type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->type->Visible = false; // Disable update for API request
            } else {
                $this->type->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->netid->CurrentValue = $this->netid->FormValue;
        $this->sid->CurrentValue = $this->sid->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->firstname->CurrentValue = $this->firstname->FormValue;
        $this->lastname->CurrentValue = $this->lastname->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
        $this->dorm->CurrentValue = $this->dorm->FormValue;
        $this->meal->CurrentValue = $this->meal->FormValue;
        $this->refrigerator->CurrentValue = $this->refrigerator->FormValue;
        $this->microwave->CurrentValue = $this->microwave->FormValue;
        $this->water->CurrentValue = $this->water->FormValue;
        $this->requests->CurrentValue = $this->requests->FormValue;
        $this->room_number->CurrentValue = $this->room_number->FormValue;
        $this->amount->CurrentValue = $this->amount->FormValue;
        $this->payment->CurrentValue = $this->payment->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->timestamp->CurrentValue = $this->timestamp->FormValue;
        $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
        $this->type->CurrentValue = $this->type->FormValue;
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
        $this->netid->setDbValue($row['netid']);
        $this->sid->setDbValue($row['sid']);
        $this->_email->setDbValue($row['email']);
        $this->firstname->setDbValue($row['firstname']);
        $this->lastname->setDbValue($row['lastname']);
        $this->phone->setDbValue($row['phone']);
        $this->dorm->setDbValue($row['dorm']);
        $this->meal->setDbValue($row['meal']);
        $this->refrigerator->setDbValue($row['refrigerator']);
        $this->microwave->setDbValue($row['microwave']);
        $this->water->setDbValue($row['water']);
        $this->requests->setDbValue($row['requests']);
        $this->room_number->setDbValue($row['room_number']);
        $this->amount->setDbValue($row['amount']);
        $this->payment->setDbValue($row['payment']);
        $this->status->setDbValue($row['status']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->type->setDbValue($row['type']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['netid'] = $this->netid->CurrentValue;
        $row['sid'] = $this->sid->CurrentValue;
        $row['email'] = $this->_email->CurrentValue;
        $row['firstname'] = $this->firstname->CurrentValue;
        $row['lastname'] = $this->lastname->CurrentValue;
        $row['phone'] = $this->phone->CurrentValue;
        $row['dorm'] = $this->dorm->CurrentValue;
        $row['meal'] = $this->meal->CurrentValue;
        $row['refrigerator'] = $this->refrigerator->CurrentValue;
        $row['microwave'] = $this->microwave->CurrentValue;
        $row['water'] = $this->water->CurrentValue;
        $row['requests'] = $this->requests->CurrentValue;
        $row['room_number'] = $this->room_number->CurrentValue;
        $row['amount'] = $this->amount->CurrentValue;
        $row['payment'] = $this->payment->CurrentValue;
        $row['status'] = $this->status->CurrentValue;
        $row['timestamp'] = $this->timestamp->CurrentValue;
        $row['type'] = $this->type->CurrentValue;
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

        // netid

        // sid

        // email

        // firstname

        // lastname

        // phone

        // dorm

        // meal

        // refrigerator

        // microwave

        // water

        // requests

        // room_number

        // amount

        // payment

        // status

        // timestamp

        // type
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // netid
            $this->netid->ViewValue = $this->netid->CurrentValue;
            $this->netid->ViewCustomAttributes = "";

            // sid
            $this->sid->ViewValue = $this->sid->CurrentValue;
            $this->sid->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // firstname
            $this->firstname->ViewValue = $this->firstname->CurrentValue;
            $this->firstname->ViewCustomAttributes = "";

            // lastname
            $this->lastname->ViewValue = $this->lastname->CurrentValue;
            $this->lastname->ViewCustomAttributes = "";

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;
            $this->phone->ViewCustomAttributes = "";

            // dorm
            $this->dorm->ViewValue = $this->dorm->CurrentValue;
            $this->dorm->ViewCustomAttributes = "";

            // meal
            $this->meal->ViewValue = $this->meal->CurrentValue;
            $this->meal->ViewCustomAttributes = "";

            // refrigerator
            $this->refrigerator->ViewValue = $this->refrigerator->CurrentValue;
            $this->refrigerator->ViewCustomAttributes = "";

            // microwave
            $this->microwave->ViewValue = $this->microwave->CurrentValue;
            $this->microwave->ViewCustomAttributes = "";

            // water
            if (ConvertToBool($this->water->CurrentValue)) {
                $this->water->ViewValue = $this->water->tagCaption(1) != "" ? $this->water->tagCaption(1) : "Yes";
            } else {
                $this->water->ViewValue = $this->water->tagCaption(2) != "" ? $this->water->tagCaption(2) : "No";
            }
            $this->water->ViewCustomAttributes = "";

            // requests
            $this->requests->ViewValue = $this->requests->CurrentValue;
            $this->requests->ViewCustomAttributes = "";

            // room_number
            $this->room_number->ViewValue = $this->room_number->CurrentValue;
            $this->room_number->ViewCustomAttributes = "";

            // amount
            $this->amount->ViewValue = $this->amount->CurrentValue;
            $this->amount->ViewValue = FormatNumber($this->amount->ViewValue, 0, -2, -2, -2);
            $this->amount->ViewCustomAttributes = "";

            // payment
            $this->payment->ViewValue = $this->payment->CurrentValue;
            $this->payment->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // type
            $this->type->ViewValue = $this->type->CurrentValue;
            $this->type->ViewCustomAttributes = "";

            // netid
            $this->netid->LinkCustomAttributes = "";
            $this->netid->HrefValue = "";
            $this->netid->TooltipValue = "";

            // sid
            $this->sid->LinkCustomAttributes = "";
            $this->sid->HrefValue = "";
            $this->sid->TooltipValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";
            $this->_email->TooltipValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";
            $this->firstname->TooltipValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";
            $this->lastname->TooltipValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";
            $this->phone->TooltipValue = "";

            // dorm
            $this->dorm->LinkCustomAttributes = "";
            $this->dorm->HrefValue = "";
            $this->dorm->TooltipValue = "";

            // meal
            $this->meal->LinkCustomAttributes = "";
            $this->meal->HrefValue = "";
            $this->meal->TooltipValue = "";

            // refrigerator
            $this->refrigerator->LinkCustomAttributes = "";
            $this->refrigerator->HrefValue = "";
            $this->refrigerator->TooltipValue = "";

            // microwave
            $this->microwave->LinkCustomAttributes = "";
            $this->microwave->HrefValue = "";
            $this->microwave->TooltipValue = "";

            // water
            $this->water->LinkCustomAttributes = "";
            $this->water->HrefValue = "";
            $this->water->TooltipValue = "";

            // requests
            $this->requests->LinkCustomAttributes = "";
            $this->requests->HrefValue = "";
            $this->requests->TooltipValue = "";

            // room_number
            $this->room_number->LinkCustomAttributes = "";
            $this->room_number->HrefValue = "";
            $this->room_number->TooltipValue = "";

            // amount
            $this->amount->LinkCustomAttributes = "";
            $this->amount->HrefValue = "";
            $this->amount->TooltipValue = "";

            // payment
            $this->payment->LinkCustomAttributes = "";
            $this->payment->HrefValue = "";
            $this->payment->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";
            $this->type->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // netid
            $this->netid->EditAttrs["class"] = "form-control";
            $this->netid->EditCustomAttributes = "";
            if (!$this->netid->Raw) {
                $this->netid->CurrentValue = HtmlDecode($this->netid->CurrentValue);
            }
            $this->netid->EditValue = HtmlEncode($this->netid->CurrentValue);
            $this->netid->PlaceHolder = RemoveHtml($this->netid->caption());

            // sid
            $this->sid->EditAttrs["class"] = "form-control";
            $this->sid->EditCustomAttributes = "";
            if (!$this->sid->Raw) {
                $this->sid->CurrentValue = HtmlDecode($this->sid->CurrentValue);
            }
            $this->sid->EditValue = HtmlEncode($this->sid->CurrentValue);
            $this->sid->PlaceHolder = RemoveHtml($this->sid->caption());

            // email
            $this->_email->EditAttrs["class"] = "form-control";
            $this->_email->EditCustomAttributes = "";
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

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

            // phone
            $this->phone->EditAttrs["class"] = "form-control";
            $this->phone->EditCustomAttributes = "";
            if (!$this->phone->Raw) {
                $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
            }
            $this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

            // dorm
            $this->dorm->EditAttrs["class"] = "form-control";
            $this->dorm->EditCustomAttributes = "";
            if (!$this->dorm->Raw) {
                $this->dorm->CurrentValue = HtmlDecode($this->dorm->CurrentValue);
            }
            $this->dorm->EditValue = HtmlEncode($this->dorm->CurrentValue);
            $this->dorm->PlaceHolder = RemoveHtml($this->dorm->caption());

            // meal
            $this->meal->EditAttrs["class"] = "form-control";
            $this->meal->EditCustomAttributes = "";
            if (!$this->meal->Raw) {
                $this->meal->CurrentValue = HtmlDecode($this->meal->CurrentValue);
            }
            $this->meal->EditValue = HtmlEncode($this->meal->CurrentValue);
            $this->meal->PlaceHolder = RemoveHtml($this->meal->caption());

            // refrigerator
            $this->refrigerator->EditAttrs["class"] = "form-control";
            $this->refrigerator->EditCustomAttributes = "";
            if (!$this->refrigerator->Raw) {
                $this->refrigerator->CurrentValue = HtmlDecode($this->refrigerator->CurrentValue);
            }
            $this->refrigerator->EditValue = HtmlEncode($this->refrigerator->CurrentValue);
            $this->refrigerator->PlaceHolder = RemoveHtml($this->refrigerator->caption());

            // microwave
            $this->microwave->EditAttrs["class"] = "form-control";
            $this->microwave->EditCustomAttributes = "";
            if (!$this->microwave->Raw) {
                $this->microwave->CurrentValue = HtmlDecode($this->microwave->CurrentValue);
            }
            $this->microwave->EditValue = HtmlEncode($this->microwave->CurrentValue);
            $this->microwave->PlaceHolder = RemoveHtml($this->microwave->caption());

            // water
            $this->water->EditCustomAttributes = "";
            $this->water->EditValue = $this->water->options(false);
            $this->water->PlaceHolder = RemoveHtml($this->water->caption());

            // requests
            $this->requests->EditAttrs["class"] = "form-control";
            $this->requests->EditCustomAttributes = "";
            $this->requests->EditValue = HtmlEncode($this->requests->CurrentValue);
            $this->requests->PlaceHolder = RemoveHtml($this->requests->caption());

            // room_number
            $this->room_number->EditAttrs["class"] = "form-control";
            $this->room_number->EditCustomAttributes = "";
            if (!$this->room_number->Raw) {
                $this->room_number->CurrentValue = HtmlDecode($this->room_number->CurrentValue);
            }
            $this->room_number->EditValue = HtmlEncode($this->room_number->CurrentValue);
            $this->room_number->PlaceHolder = RemoveHtml($this->room_number->caption());

            // amount
            $this->amount->EditAttrs["class"] = "form-control";
            $this->amount->EditCustomAttributes = "";
            $this->amount->EditValue = HtmlEncode($this->amount->CurrentValue);
            $this->amount->PlaceHolder = RemoveHtml($this->amount->caption());

            // payment
            $this->payment->EditAttrs["class"] = "form-control";
            $this->payment->EditCustomAttributes = "";
            if (!$this->payment->Raw) {
                $this->payment->CurrentValue = HtmlDecode($this->payment->CurrentValue);
            }
            $this->payment->EditValue = HtmlEncode($this->payment->CurrentValue);
            $this->payment->PlaceHolder = RemoveHtml($this->payment->caption());

            // status
            $this->status->EditAttrs["class"] = "form-control";
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // type
            $this->type->EditAttrs["class"] = "form-control";
            $this->type->EditCustomAttributes = "";
            if (!$this->type->Raw) {
                $this->type->CurrentValue = HtmlDecode($this->type->CurrentValue);
            }
            $this->type->EditValue = HtmlEncode($this->type->CurrentValue);
            $this->type->PlaceHolder = RemoveHtml($this->type->caption());

            // Add refer script

            // netid
            $this->netid->LinkCustomAttributes = "";
            $this->netid->HrefValue = "";

            // sid
            $this->sid->LinkCustomAttributes = "";
            $this->sid->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";

            // dorm
            $this->dorm->LinkCustomAttributes = "";
            $this->dorm->HrefValue = "";

            // meal
            $this->meal->LinkCustomAttributes = "";
            $this->meal->HrefValue = "";

            // refrigerator
            $this->refrigerator->LinkCustomAttributes = "";
            $this->refrigerator->HrefValue = "";

            // microwave
            $this->microwave->LinkCustomAttributes = "";
            $this->microwave->HrefValue = "";

            // water
            $this->water->LinkCustomAttributes = "";
            $this->water->HrefValue = "";

            // requests
            $this->requests->LinkCustomAttributes = "";
            $this->requests->HrefValue = "";

            // room_number
            $this->room_number->LinkCustomAttributes = "";
            $this->room_number->HrefValue = "";

            // amount
            $this->amount->LinkCustomAttributes = "";
            $this->amount->HrefValue = "";

            // payment
            $this->payment->LinkCustomAttributes = "";
            $this->payment->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";
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
        if ($this->netid->Required) {
            if (!$this->netid->IsDetailKey && EmptyValue($this->netid->FormValue)) {
                $this->netid->addErrorMessage(str_replace("%s", $this->netid->caption(), $this->netid->RequiredErrorMessage));
            }
        }
        if ($this->sid->Required) {
            if (!$this->sid->IsDetailKey && EmptyValue($this->sid->FormValue)) {
                $this->sid->addErrorMessage(str_replace("%s", $this->sid->caption(), $this->sid->RequiredErrorMessage));
            }
        }
        if ($this->_email->Required) {
            if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
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
        if ($this->phone->Required) {
            if (!$this->phone->IsDetailKey && EmptyValue($this->phone->FormValue)) {
                $this->phone->addErrorMessage(str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
            }
        }
        if ($this->dorm->Required) {
            if (!$this->dorm->IsDetailKey && EmptyValue($this->dorm->FormValue)) {
                $this->dorm->addErrorMessage(str_replace("%s", $this->dorm->caption(), $this->dorm->RequiredErrorMessage));
            }
        }
        if ($this->meal->Required) {
            if (!$this->meal->IsDetailKey && EmptyValue($this->meal->FormValue)) {
                $this->meal->addErrorMessage(str_replace("%s", $this->meal->caption(), $this->meal->RequiredErrorMessage));
            }
        }
        if ($this->refrigerator->Required) {
            if (!$this->refrigerator->IsDetailKey && EmptyValue($this->refrigerator->FormValue)) {
                $this->refrigerator->addErrorMessage(str_replace("%s", $this->refrigerator->caption(), $this->refrigerator->RequiredErrorMessage));
            }
        }
        if ($this->microwave->Required) {
            if (!$this->microwave->IsDetailKey && EmptyValue($this->microwave->FormValue)) {
                $this->microwave->addErrorMessage(str_replace("%s", $this->microwave->caption(), $this->microwave->RequiredErrorMessage));
            }
        }
        if ($this->water->Required) {
            if ($this->water->FormValue == "") {
                $this->water->addErrorMessage(str_replace("%s", $this->water->caption(), $this->water->RequiredErrorMessage));
            }
        }
        if ($this->requests->Required) {
            if (!$this->requests->IsDetailKey && EmptyValue($this->requests->FormValue)) {
                $this->requests->addErrorMessage(str_replace("%s", $this->requests->caption(), $this->requests->RequiredErrorMessage));
            }
        }
        if ($this->room_number->Required) {
            if (!$this->room_number->IsDetailKey && EmptyValue($this->room_number->FormValue)) {
                $this->room_number->addErrorMessage(str_replace("%s", $this->room_number->caption(), $this->room_number->RequiredErrorMessage));
            }
        }
        if ($this->amount->Required) {
            if (!$this->amount->IsDetailKey && EmptyValue($this->amount->FormValue)) {
                $this->amount->addErrorMessage(str_replace("%s", $this->amount->caption(), $this->amount->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->amount->FormValue)) {
            $this->amount->addErrorMessage($this->amount->getErrorMessage(false));
        }
        if ($this->payment->Required) {
            if (!$this->payment->IsDetailKey && EmptyValue($this->payment->FormValue)) {
                $this->payment->addErrorMessage(str_replace("%s", $this->payment->caption(), $this->payment->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
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
        if ($this->type->Required) {
            if (!$this->type->IsDetailKey && EmptyValue($this->type->FormValue)) {
                $this->type->addErrorMessage(str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
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

        // netid
        $this->netid->setDbValueDef($rsnew, $this->netid->CurrentValue, null, false);

        // sid
        $this->sid->setDbValueDef($rsnew, $this->sid->CurrentValue, null, false);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, null, false);

        // firstname
        $this->firstname->setDbValueDef($rsnew, $this->firstname->CurrentValue, null, false);

        // lastname
        $this->lastname->setDbValueDef($rsnew, $this->lastname->CurrentValue, null, false);

        // phone
        $this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, null, false);

        // dorm
        $this->dorm->setDbValueDef($rsnew, $this->dorm->CurrentValue, null, false);

        // meal
        $this->meal->setDbValueDef($rsnew, $this->meal->CurrentValue, null, false);

        // refrigerator
        $this->refrigerator->setDbValueDef($rsnew, $this->refrigerator->CurrentValue, null, false);

        // microwave
        $this->microwave->setDbValueDef($rsnew, $this->microwave->CurrentValue, null, false);

        // water
        $tmpBool = $this->water->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->water->setDbValueDef($rsnew, $tmpBool, null, false);

        // requests
        $this->requests->setDbValueDef($rsnew, $this->requests->CurrentValue, null, false);

        // room_number
        $this->room_number->setDbValueDef($rsnew, $this->room_number->CurrentValue, null, false);

        // amount
        $this->amount->setDbValueDef($rsnew, $this->amount->CurrentValue, null, false);

        // payment
        $this->payment->setDbValueDef($rsnew, $this->payment->CurrentValue, null, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

        // timestamp
        $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, false);

        // type
        $this->type->setDbValueDef($rsnew, $this->type->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MealpackageList"), "", $this->TableVar, true);
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
                case "x_water":
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
