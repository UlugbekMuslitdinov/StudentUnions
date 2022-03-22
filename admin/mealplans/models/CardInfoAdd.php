<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class CardInfoAdd extends CardInfo
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'card_info';

    // Page object name
    public $PageObjName = "CardInfoAdd";

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

        // Table object (card_info)
        if (!isset($GLOBALS["card_info"]) || get_class($GLOBALS["card_info"]) == PROJECT_NAMESPACE . "card_info") {
            $GLOBALS["card_info"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'card_info');
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
                $tbl = Container("card_info");
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
                    if ($pageName == "CardInfoView") {
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
            $key .= @$ar['card_id'];
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
            $this->card_id->Visible = false;
        }
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
    public $FormClassName = "ew-form ew-add-form";
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
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->card_id->Visible = false;
        $this->cust_id->setVisibility();
        $this->guest_id->setVisibility();
        $this->first_name->setVisibility();
        $this->last_name->setVisibility();
        $this->address->setVisibility();
        $this->city->setVisibility();
        $this->state->setVisibility();
        $this->zipcode->setVisibility();
        $this->card_type->setVisibility();
        $this->account_number->setVisibility();
        $this->expiration_month->setVisibility();
        $this->expiration_year->setVisibility();
        $this->_email->setVisibility();
        $this->phone->setVisibility();
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
        $this->FormClassName = "ew-form ew-add-form";
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
            if (($keyValue = Get("card_id") ?? Route("card_id")) !== null) {
                $this->card_id->setQueryStringValue($keyValue);
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
                    $this->terminate("CardInfoList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "CardInfoList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "CardInfoView") {
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->card_id->CurrentValue = null;
        $this->card_id->OldValue = $this->card_id->CurrentValue;
        $this->cust_id->CurrentValue = null;
        $this->cust_id->OldValue = $this->cust_id->CurrentValue;
        $this->guest_id->CurrentValue = null;
        $this->guest_id->OldValue = $this->guest_id->CurrentValue;
        $this->first_name->CurrentValue = null;
        $this->first_name->OldValue = $this->first_name->CurrentValue;
        $this->last_name->CurrentValue = null;
        $this->last_name->OldValue = $this->last_name->CurrentValue;
        $this->address->CurrentValue = null;
        $this->address->OldValue = $this->address->CurrentValue;
        $this->city->CurrentValue = null;
        $this->city->OldValue = $this->city->CurrentValue;
        $this->state->CurrentValue = null;
        $this->state->OldValue = $this->state->CurrentValue;
        $this->zipcode->CurrentValue = null;
        $this->zipcode->OldValue = $this->zipcode->CurrentValue;
        $this->card_type->CurrentValue = null;
        $this->card_type->OldValue = $this->card_type->CurrentValue;
        $this->account_number->CurrentValue = null;
        $this->account_number->OldValue = $this->account_number->CurrentValue;
        $this->expiration_month->CurrentValue = null;
        $this->expiration_month->OldValue = $this->expiration_month->CurrentValue;
        $this->expiration_year->CurrentValue = null;
        $this->expiration_year->OldValue = $this->expiration_year->CurrentValue;
        $this->_email->CurrentValue = null;
        $this->_email->OldValue = $this->_email->CurrentValue;
        $this->phone->CurrentValue = null;
        $this->phone->OldValue = $this->phone->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'cust_id' first before field var 'x_cust_id'
        $val = $CurrentForm->hasValue("cust_id") ? $CurrentForm->getValue("cust_id") : $CurrentForm->getValue("x_cust_id");
        if (!$this->cust_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cust_id->Visible = false; // Disable update for API request
            } else {
                $this->cust_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'guest_id' first before field var 'x_guest_id'
        $val = $CurrentForm->hasValue("guest_id") ? $CurrentForm->getValue("guest_id") : $CurrentForm->getValue("x_guest_id");
        if (!$this->guest_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->guest_id->Visible = false; // Disable update for API request
            } else {
                $this->guest_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'first_name' first before field var 'x_first_name'
        $val = $CurrentForm->hasValue("first_name") ? $CurrentForm->getValue("first_name") : $CurrentForm->getValue("x_first_name");
        if (!$this->first_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->first_name->Visible = false; // Disable update for API request
            } else {
                $this->first_name->setFormValue($val);
            }
        }

        // Check field name 'last_name' first before field var 'x_last_name'
        $val = $CurrentForm->hasValue("last_name") ? $CurrentForm->getValue("last_name") : $CurrentForm->getValue("x_last_name");
        if (!$this->last_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->last_name->Visible = false; // Disable update for API request
            } else {
                $this->last_name->setFormValue($val);
            }
        }

        // Check field name 'address' first before field var 'x_address'
        $val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
        if (!$this->address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address->Visible = false; // Disable update for API request
            } else {
                $this->address->setFormValue($val);
            }
        }

        // Check field name 'city' first before field var 'x_city'
        $val = $CurrentForm->hasValue("city") ? $CurrentForm->getValue("city") : $CurrentForm->getValue("x_city");
        if (!$this->city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->city->Visible = false; // Disable update for API request
            } else {
                $this->city->setFormValue($val);
            }
        }

        // Check field name 'state' first before field var 'x_state'
        $val = $CurrentForm->hasValue("state") ? $CurrentForm->getValue("state") : $CurrentForm->getValue("x_state");
        if (!$this->state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->state->Visible = false; // Disable update for API request
            } else {
                $this->state->setFormValue($val);
            }
        }

        // Check field name 'zipcode' first before field var 'x_zipcode'
        $val = $CurrentForm->hasValue("zipcode") ? $CurrentForm->getValue("zipcode") : $CurrentForm->getValue("x_zipcode");
        if (!$this->zipcode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->zipcode->Visible = false; // Disable update for API request
            } else {
                $this->zipcode->setFormValue($val);
            }
        }

        // Check field name 'card_type' first before field var 'x_card_type'
        $val = $CurrentForm->hasValue("card_type") ? $CurrentForm->getValue("card_type") : $CurrentForm->getValue("x_card_type");
        if (!$this->card_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->card_type->Visible = false; // Disable update for API request
            } else {
                $this->card_type->setFormValue($val);
            }
        }

        // Check field name 'account_number' first before field var 'x_account_number'
        $val = $CurrentForm->hasValue("account_number") ? $CurrentForm->getValue("account_number") : $CurrentForm->getValue("x_account_number");
        if (!$this->account_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->account_number->Visible = false; // Disable update for API request
            } else {
                $this->account_number->setFormValue($val);
            }
        }

        // Check field name 'expiration_month' first before field var 'x_expiration_month'
        $val = $CurrentForm->hasValue("expiration_month") ? $CurrentForm->getValue("expiration_month") : $CurrentForm->getValue("x_expiration_month");
        if (!$this->expiration_month->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->expiration_month->Visible = false; // Disable update for API request
            } else {
                $this->expiration_month->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'expiration_year' first before field var 'x_expiration_year'
        $val = $CurrentForm->hasValue("expiration_year") ? $CurrentForm->getValue("expiration_year") : $CurrentForm->getValue("x_expiration_year");
        if (!$this->expiration_year->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->expiration_year->Visible = false; // Disable update for API request
            } else {
                $this->expiration_year->setFormValue($val, true, $validate);
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

        // Check field name 'phone' first before field var 'x_phone'
        $val = $CurrentForm->hasValue("phone") ? $CurrentForm->getValue("phone") : $CurrentForm->getValue("x_phone");
        if (!$this->phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->phone->Visible = false; // Disable update for API request
            } else {
                $this->phone->setFormValue($val);
            }
        }

        // Check field name 'card_id' first before field var 'x_card_id'
        $val = $CurrentForm->hasValue("card_id") ? $CurrentForm->getValue("card_id") : $CurrentForm->getValue("x_card_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->cust_id->CurrentValue = $this->cust_id->FormValue;
        $this->guest_id->CurrentValue = $this->guest_id->FormValue;
        $this->first_name->CurrentValue = $this->first_name->FormValue;
        $this->last_name->CurrentValue = $this->last_name->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->city->CurrentValue = $this->city->FormValue;
        $this->state->CurrentValue = $this->state->FormValue;
        $this->zipcode->CurrentValue = $this->zipcode->FormValue;
        $this->card_type->CurrentValue = $this->card_type->FormValue;
        $this->account_number->CurrentValue = $this->account_number->FormValue;
        $this->expiration_month->CurrentValue = $this->expiration_month->FormValue;
        $this->expiration_year->CurrentValue = $this->expiration_year->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
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
        $this->card_id->setDbValue($row['card_id']);
        $this->cust_id->setDbValue($row['cust_id']);
        $this->guest_id->setDbValue($row['guest_id']);
        $this->first_name->setDbValue($row['first_name']);
        $this->last_name->setDbValue($row['last_name']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->state->setDbValue($row['state']);
        $this->zipcode->setDbValue($row['zipcode']);
        $this->card_type->setDbValue($row['card_type']);
        $this->account_number->setDbValue($row['account_number']);
        $this->expiration_month->setDbValue($row['expiration_month']);
        $this->expiration_year->setDbValue($row['expiration_year']);
        $this->_email->setDbValue($row['email']);
        $this->phone->setDbValue($row['phone']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['card_id'] = $this->card_id->CurrentValue;
        $row['cust_id'] = $this->cust_id->CurrentValue;
        $row['guest_id'] = $this->guest_id->CurrentValue;
        $row['first_name'] = $this->first_name->CurrentValue;
        $row['last_name'] = $this->last_name->CurrentValue;
        $row['address'] = $this->address->CurrentValue;
        $row['city'] = $this->city->CurrentValue;
        $row['state'] = $this->state->CurrentValue;
        $row['zipcode'] = $this->zipcode->CurrentValue;
        $row['card_type'] = $this->card_type->CurrentValue;
        $row['account_number'] = $this->account_number->CurrentValue;
        $row['expiration_month'] = $this->expiration_month->CurrentValue;
        $row['expiration_year'] = $this->expiration_year->CurrentValue;
        $row['email'] = $this->_email->CurrentValue;
        $row['phone'] = $this->phone->CurrentValue;
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

        // card_id
        $this->card_id->RowCssClass = "row";

        // cust_id
        $this->cust_id->RowCssClass = "row";

        // guest_id
        $this->guest_id->RowCssClass = "row";

        // first_name
        $this->first_name->RowCssClass = "row";

        // last_name
        $this->last_name->RowCssClass = "row";

        // address
        $this->address->RowCssClass = "row";

        // city
        $this->city->RowCssClass = "row";

        // state
        $this->state->RowCssClass = "row";

        // zipcode
        $this->zipcode->RowCssClass = "row";

        // card_type
        $this->card_type->RowCssClass = "row";

        // account_number
        $this->account_number->RowCssClass = "row";

        // expiration_month
        $this->expiration_month->RowCssClass = "row";

        // expiration_year
        $this->expiration_year->RowCssClass = "row";

        // email
        $this->_email->RowCssClass = "row";

        // phone
        $this->phone->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // card_id
            $this->card_id->ViewValue = $this->card_id->CurrentValue;
            $this->card_id->ViewCustomAttributes = "";

            // cust_id
            $this->cust_id->ViewValue = $this->cust_id->CurrentValue;
            $this->cust_id->ViewValue = FormatNumber($this->cust_id->ViewValue, "");
            $this->cust_id->ViewCustomAttributes = "";

            // guest_id
            $this->guest_id->ViewValue = $this->guest_id->CurrentValue;
            $this->guest_id->ViewValue = FormatNumber($this->guest_id->ViewValue, "");
            $this->guest_id->ViewCustomAttributes = "";

            // first_name
            $this->first_name->ViewValue = $this->first_name->CurrentValue;
            $this->first_name->ViewCustomAttributes = "";

            // last_name
            $this->last_name->ViewValue = $this->last_name->CurrentValue;
            $this->last_name->ViewCustomAttributes = "";

            // address
            $this->address->ViewValue = $this->address->CurrentValue;
            $this->address->ViewCustomAttributes = "";

            // city
            $this->city->ViewValue = $this->city->CurrentValue;
            $this->city->ViewCustomAttributes = "";

            // state
            $this->state->ViewValue = $this->state->CurrentValue;
            $this->state->ViewCustomAttributes = "";

            // zipcode
            $this->zipcode->ViewValue = $this->zipcode->CurrentValue;
            $this->zipcode->ViewCustomAttributes = "";

            // card_type
            $this->card_type->ViewValue = $this->card_type->CurrentValue;
            $this->card_type->ViewCustomAttributes = "";

            // account_number
            $this->account_number->ViewValue = $this->account_number->CurrentValue;
            $this->account_number->ViewCustomAttributes = "";

            // expiration_month
            $this->expiration_month->ViewValue = $this->expiration_month->CurrentValue;
            $this->expiration_month->ViewValue = FormatNumber($this->expiration_month->ViewValue, "");
            $this->expiration_month->ViewCustomAttributes = "";

            // expiration_year
            $this->expiration_year->ViewValue = $this->expiration_year->CurrentValue;
            $this->expiration_year->ViewValue = FormatNumber($this->expiration_year->ViewValue, "");
            $this->expiration_year->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;
            $this->phone->ViewCustomAttributes = "";

            // cust_id
            $this->cust_id->LinkCustomAttributes = "";
            $this->cust_id->HrefValue = "";

            // guest_id
            $this->guest_id->LinkCustomAttributes = "";
            $this->guest_id->HrefValue = "";

            // first_name
            $this->first_name->LinkCustomAttributes = "";
            $this->first_name->HrefValue = "";

            // last_name
            $this->last_name->LinkCustomAttributes = "";
            $this->last_name->HrefValue = "";

            // address
            $this->address->LinkCustomAttributes = "";
            $this->address->HrefValue = "";

            // city
            $this->city->LinkCustomAttributes = "";
            $this->city->HrefValue = "";

            // state
            $this->state->LinkCustomAttributes = "";
            $this->state->HrefValue = "";

            // zipcode
            $this->zipcode->LinkCustomAttributes = "";
            $this->zipcode->HrefValue = "";

            // card_type
            $this->card_type->LinkCustomAttributes = "";
            $this->card_type->HrefValue = "";

            // account_number
            $this->account_number->LinkCustomAttributes = "";
            $this->account_number->HrefValue = "";

            // expiration_month
            $this->expiration_month->LinkCustomAttributes = "";
            $this->expiration_month->HrefValue = "";

            // expiration_year
            $this->expiration_year->LinkCustomAttributes = "";
            $this->expiration_year->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // cust_id
            $this->cust_id->setupEditAttributes();
            $this->cust_id->EditCustomAttributes = "";
            $this->cust_id->EditValue = HtmlEncode($this->cust_id->CurrentValue);
            $this->cust_id->PlaceHolder = RemoveHtml($this->cust_id->caption());
            if (strval($this->cust_id->EditValue) != "" && is_numeric($this->cust_id->EditValue)) {
                $this->cust_id->EditValue = FormatNumber($this->cust_id->EditValue, null);
            }

            // guest_id
            $this->guest_id->setupEditAttributes();
            $this->guest_id->EditCustomAttributes = "";
            $this->guest_id->EditValue = HtmlEncode($this->guest_id->CurrentValue);
            $this->guest_id->PlaceHolder = RemoveHtml($this->guest_id->caption());
            if (strval($this->guest_id->EditValue) != "" && is_numeric($this->guest_id->EditValue)) {
                $this->guest_id->EditValue = FormatNumber($this->guest_id->EditValue, null);
            }

            // first_name
            $this->first_name->setupEditAttributes();
            $this->first_name->EditCustomAttributes = "";
            if (!$this->first_name->Raw) {
                $this->first_name->CurrentValue = HtmlDecode($this->first_name->CurrentValue);
            }
            $this->first_name->EditValue = HtmlEncode($this->first_name->CurrentValue);
            $this->first_name->PlaceHolder = RemoveHtml($this->first_name->caption());

            // last_name
            $this->last_name->setupEditAttributes();
            $this->last_name->EditCustomAttributes = "";
            if (!$this->last_name->Raw) {
                $this->last_name->CurrentValue = HtmlDecode($this->last_name->CurrentValue);
            }
            $this->last_name->EditValue = HtmlEncode($this->last_name->CurrentValue);
            $this->last_name->PlaceHolder = RemoveHtml($this->last_name->caption());

            // address
            $this->address->setupEditAttributes();
            $this->address->EditCustomAttributes = "";
            if (!$this->address->Raw) {
                $this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
            }
            $this->address->EditValue = HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = RemoveHtml($this->address->caption());

            // city
            $this->city->setupEditAttributes();
            $this->city->EditCustomAttributes = "";
            if (!$this->city->Raw) {
                $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
            }
            $this->city->EditValue = HtmlEncode($this->city->CurrentValue);
            $this->city->PlaceHolder = RemoveHtml($this->city->caption());

            // state
            $this->state->setupEditAttributes();
            $this->state->EditCustomAttributes = "";
            if (!$this->state->Raw) {
                $this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
            }
            $this->state->EditValue = HtmlEncode($this->state->CurrentValue);
            $this->state->PlaceHolder = RemoveHtml($this->state->caption());

            // zipcode
            $this->zipcode->setupEditAttributes();
            $this->zipcode->EditCustomAttributes = "";
            if (!$this->zipcode->Raw) {
                $this->zipcode->CurrentValue = HtmlDecode($this->zipcode->CurrentValue);
            }
            $this->zipcode->EditValue = HtmlEncode($this->zipcode->CurrentValue);
            $this->zipcode->PlaceHolder = RemoveHtml($this->zipcode->caption());

            // card_type
            $this->card_type->setupEditAttributes();
            $this->card_type->EditCustomAttributes = "";
            if (!$this->card_type->Raw) {
                $this->card_type->CurrentValue = HtmlDecode($this->card_type->CurrentValue);
            }
            $this->card_type->EditValue = HtmlEncode($this->card_type->CurrentValue);
            $this->card_type->PlaceHolder = RemoveHtml($this->card_type->caption());

            // account_number
            $this->account_number->setupEditAttributes();
            $this->account_number->EditCustomAttributes = "";
            if (!$this->account_number->Raw) {
                $this->account_number->CurrentValue = HtmlDecode($this->account_number->CurrentValue);
            }
            $this->account_number->EditValue = HtmlEncode($this->account_number->CurrentValue);
            $this->account_number->PlaceHolder = RemoveHtml($this->account_number->caption());

            // expiration_month
            $this->expiration_month->setupEditAttributes();
            $this->expiration_month->EditCustomAttributes = "";
            $this->expiration_month->EditValue = HtmlEncode($this->expiration_month->CurrentValue);
            $this->expiration_month->PlaceHolder = RemoveHtml($this->expiration_month->caption());
            if (strval($this->expiration_month->EditValue) != "" && is_numeric($this->expiration_month->EditValue)) {
                $this->expiration_month->EditValue = FormatNumber($this->expiration_month->EditValue, null);
            }

            // expiration_year
            $this->expiration_year->setupEditAttributes();
            $this->expiration_year->EditCustomAttributes = "";
            $this->expiration_year->EditValue = HtmlEncode($this->expiration_year->CurrentValue);
            $this->expiration_year->PlaceHolder = RemoveHtml($this->expiration_year->caption());
            if (strval($this->expiration_year->EditValue) != "" && is_numeric($this->expiration_year->EditValue)) {
                $this->expiration_year->EditValue = FormatNumber($this->expiration_year->EditValue, null);
            }

            // email
            $this->_email->setupEditAttributes();
            $this->_email->EditCustomAttributes = "";
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

            // phone
            $this->phone->setupEditAttributes();
            $this->phone->EditCustomAttributes = "";
            if (!$this->phone->Raw) {
                $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
            }
            $this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

            // Add refer script

            // cust_id
            $this->cust_id->LinkCustomAttributes = "";
            $this->cust_id->HrefValue = "";

            // guest_id
            $this->guest_id->LinkCustomAttributes = "";
            $this->guest_id->HrefValue = "";

            // first_name
            $this->first_name->LinkCustomAttributes = "";
            $this->first_name->HrefValue = "";

            // last_name
            $this->last_name->LinkCustomAttributes = "";
            $this->last_name->HrefValue = "";

            // address
            $this->address->LinkCustomAttributes = "";
            $this->address->HrefValue = "";

            // city
            $this->city->LinkCustomAttributes = "";
            $this->city->HrefValue = "";

            // state
            $this->state->LinkCustomAttributes = "";
            $this->state->HrefValue = "";

            // zipcode
            $this->zipcode->LinkCustomAttributes = "";
            $this->zipcode->HrefValue = "";

            // card_type
            $this->card_type->LinkCustomAttributes = "";
            $this->card_type->HrefValue = "";

            // account_number
            $this->account_number->LinkCustomAttributes = "";
            $this->account_number->HrefValue = "";

            // expiration_month
            $this->expiration_month->LinkCustomAttributes = "";
            $this->expiration_month->HrefValue = "";

            // expiration_year
            $this->expiration_year->LinkCustomAttributes = "";
            $this->expiration_year->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";
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
        if ($this->cust_id->Required) {
            if (!$this->cust_id->IsDetailKey && EmptyValue($this->cust_id->FormValue)) {
                $this->cust_id->addErrorMessage(str_replace("%s", $this->cust_id->caption(), $this->cust_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->cust_id->FormValue)) {
            $this->cust_id->addErrorMessage($this->cust_id->getErrorMessage(false));
        }
        if ($this->guest_id->Required) {
            if (!$this->guest_id->IsDetailKey && EmptyValue($this->guest_id->FormValue)) {
                $this->guest_id->addErrorMessage(str_replace("%s", $this->guest_id->caption(), $this->guest_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->guest_id->FormValue)) {
            $this->guest_id->addErrorMessage($this->guest_id->getErrorMessage(false));
        }
        if ($this->first_name->Required) {
            if (!$this->first_name->IsDetailKey && EmptyValue($this->first_name->FormValue)) {
                $this->first_name->addErrorMessage(str_replace("%s", $this->first_name->caption(), $this->first_name->RequiredErrorMessage));
            }
        }
        if ($this->last_name->Required) {
            if (!$this->last_name->IsDetailKey && EmptyValue($this->last_name->FormValue)) {
                $this->last_name->addErrorMessage(str_replace("%s", $this->last_name->caption(), $this->last_name->RequiredErrorMessage));
            }
        }
        if ($this->address->Required) {
            if (!$this->address->IsDetailKey && EmptyValue($this->address->FormValue)) {
                $this->address->addErrorMessage(str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
            }
        }
        if ($this->city->Required) {
            if (!$this->city->IsDetailKey && EmptyValue($this->city->FormValue)) {
                $this->city->addErrorMessage(str_replace("%s", $this->city->caption(), $this->city->RequiredErrorMessage));
            }
        }
        if ($this->state->Required) {
            if (!$this->state->IsDetailKey && EmptyValue($this->state->FormValue)) {
                $this->state->addErrorMessage(str_replace("%s", $this->state->caption(), $this->state->RequiredErrorMessage));
            }
        }
        if ($this->zipcode->Required) {
            if (!$this->zipcode->IsDetailKey && EmptyValue($this->zipcode->FormValue)) {
                $this->zipcode->addErrorMessage(str_replace("%s", $this->zipcode->caption(), $this->zipcode->RequiredErrorMessage));
            }
        }
        if ($this->card_type->Required) {
            if (!$this->card_type->IsDetailKey && EmptyValue($this->card_type->FormValue)) {
                $this->card_type->addErrorMessage(str_replace("%s", $this->card_type->caption(), $this->card_type->RequiredErrorMessage));
            }
        }
        if ($this->account_number->Required) {
            if (!$this->account_number->IsDetailKey && EmptyValue($this->account_number->FormValue)) {
                $this->account_number->addErrorMessage(str_replace("%s", $this->account_number->caption(), $this->account_number->RequiredErrorMessage));
            }
        }
        if ($this->expiration_month->Required) {
            if (!$this->expiration_month->IsDetailKey && EmptyValue($this->expiration_month->FormValue)) {
                $this->expiration_month->addErrorMessage(str_replace("%s", $this->expiration_month->caption(), $this->expiration_month->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->expiration_month->FormValue)) {
            $this->expiration_month->addErrorMessage($this->expiration_month->getErrorMessage(false));
        }
        if ($this->expiration_year->Required) {
            if (!$this->expiration_year->IsDetailKey && EmptyValue($this->expiration_year->FormValue)) {
                $this->expiration_year->addErrorMessage(str_replace("%s", $this->expiration_year->caption(), $this->expiration_year->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->expiration_year->FormValue)) {
            $this->expiration_year->addErrorMessage($this->expiration_year->getErrorMessage(false));
        }
        if ($this->_email->Required) {
            if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
            }
        }
        if ($this->phone->Required) {
            if (!$this->phone->IsDetailKey && EmptyValue($this->phone->FormValue)) {
                $this->phone->addErrorMessage(str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
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

        // cust_id
        $this->cust_id->setDbValueDef($rsnew, $this->cust_id->CurrentValue, null, false);

        // guest_id
        $this->guest_id->setDbValueDef($rsnew, $this->guest_id->CurrentValue, null, false);

        // first_name
        $this->first_name->setDbValueDef($rsnew, $this->first_name->CurrentValue, "", false);

        // last_name
        $this->last_name->setDbValueDef($rsnew, $this->last_name->CurrentValue, "", false);

        // address
        $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, "", false);

        // city
        $this->city->setDbValueDef($rsnew, $this->city->CurrentValue, "", false);

        // state
        $this->state->setDbValueDef($rsnew, $this->state->CurrentValue, "", false);

        // zipcode
        $this->zipcode->setDbValueDef($rsnew, $this->zipcode->CurrentValue, "", false);

        // card_type
        $this->card_type->setDbValueDef($rsnew, $this->card_type->CurrentValue, "", false);

        // account_number
        $this->account_number->setDbValueDef($rsnew, $this->account_number->CurrentValue, "", false);

        // expiration_month
        $this->expiration_month->setDbValueDef($rsnew, $this->expiration_month->CurrentValue, 0, false);

        // expiration_year
        $this->expiration_year->setDbValueDef($rsnew, $this->expiration_year->CurrentValue, 0, false);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, null, false);

        // phone
        $this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CardInfoList"), "", $this->TableVar, true);
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
