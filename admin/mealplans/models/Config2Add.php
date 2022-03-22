<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class Config2Add extends Config2
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'config';

    // Page object name
    public $PageObjName = "Config2Add";

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

        // Table object (config2)
        if (!isset($GLOBALS["config2"]) || get_class($GLOBALS["config2"]) == PROJECT_NAMESPACE . "config2") {
            $GLOBALS["config2"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'config');
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
                $tbl = Container("config2");
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
                    if ($pageName == "Config2View") {
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
        $this->id->setVisibility();
        $this->min_deposit->setVisibility();
        $this->max_deposit->setVisibility();
        $this->current_term_code->setVisibility();
        $this->fall_term_code->setVisibility();
        $this->spring_term_code->setVisibility();
        $this->full_year_begin->setVisibility();
        $this->half_year_begin->setVisibility();
        $this->year_end->setVisibility();
        $this->plus_signup_full->setVisibility();
        $this->plus_signup_half->setVisibility();
        $this->bursar_deposit_deadline->setVisibility();
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
        $this->setupLookupOptions($this->plus_signup_full);
        $this->setupLookupOptions($this->plus_signup_half);

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
                    $this->terminate("Config2List"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "Config2List") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "Config2View") {
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
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->min_deposit->CurrentValue = null;
        $this->min_deposit->OldValue = $this->min_deposit->CurrentValue;
        $this->max_deposit->CurrentValue = null;
        $this->max_deposit->OldValue = $this->max_deposit->CurrentValue;
        $this->current_term_code->CurrentValue = null;
        $this->current_term_code->OldValue = $this->current_term_code->CurrentValue;
        $this->fall_term_code->CurrentValue = null;
        $this->fall_term_code->OldValue = $this->fall_term_code->CurrentValue;
        $this->spring_term_code->CurrentValue = null;
        $this->spring_term_code->OldValue = $this->spring_term_code->CurrentValue;
        $this->full_year_begin->CurrentValue = null;
        $this->full_year_begin->OldValue = $this->full_year_begin->CurrentValue;
        $this->half_year_begin->CurrentValue = null;
        $this->half_year_begin->OldValue = $this->half_year_begin->CurrentValue;
        $this->year_end->CurrentValue = null;
        $this->year_end->OldValue = $this->year_end->CurrentValue;
        $this->plus_signup_full->CurrentValue = null;
        $this->plus_signup_full->OldValue = $this->plus_signup_full->CurrentValue;
        $this->plus_signup_half->CurrentValue = null;
        $this->plus_signup_half->OldValue = $this->plus_signup_half->CurrentValue;
        $this->bursar_deposit_deadline->CurrentValue = null;
        $this->bursar_deposit_deadline->OldValue = $this->bursar_deposit_deadline->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id->Visible = false; // Disable update for API request
            } else {
                $this->id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'min_deposit' first before field var 'x_min_deposit'
        $val = $CurrentForm->hasValue("min_deposit") ? $CurrentForm->getValue("min_deposit") : $CurrentForm->getValue("x_min_deposit");
        if (!$this->min_deposit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->min_deposit->Visible = false; // Disable update for API request
            } else {
                $this->min_deposit->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'max_deposit' first before field var 'x_max_deposit'
        $val = $CurrentForm->hasValue("max_deposit") ? $CurrentForm->getValue("max_deposit") : $CurrentForm->getValue("x_max_deposit");
        if (!$this->max_deposit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_deposit->Visible = false; // Disable update for API request
            } else {
                $this->max_deposit->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'current_term_code' first before field var 'x_current_term_code'
        $val = $CurrentForm->hasValue("current_term_code") ? $CurrentForm->getValue("current_term_code") : $CurrentForm->getValue("x_current_term_code");
        if (!$this->current_term_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->current_term_code->Visible = false; // Disable update for API request
            } else {
                $this->current_term_code->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'fall_term_code' first before field var 'x_fall_term_code'
        $val = $CurrentForm->hasValue("fall_term_code") ? $CurrentForm->getValue("fall_term_code") : $CurrentForm->getValue("x_fall_term_code");
        if (!$this->fall_term_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fall_term_code->Visible = false; // Disable update for API request
            } else {
                $this->fall_term_code->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'spring_term_code' first before field var 'x_spring_term_code'
        $val = $CurrentForm->hasValue("spring_term_code") ? $CurrentForm->getValue("spring_term_code") : $CurrentForm->getValue("x_spring_term_code");
        if (!$this->spring_term_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->spring_term_code->Visible = false; // Disable update for API request
            } else {
                $this->spring_term_code->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'full_year_begin' first before field var 'x_full_year_begin'
        $val = $CurrentForm->hasValue("full_year_begin") ? $CurrentForm->getValue("full_year_begin") : $CurrentForm->getValue("x_full_year_begin");
        if (!$this->full_year_begin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->full_year_begin->Visible = false; // Disable update for API request
            } else {
                $this->full_year_begin->setFormValue($val, true, $validate);
            }
            $this->full_year_begin->CurrentValue = UnFormatDateTime($this->full_year_begin->CurrentValue, $this->full_year_begin->formatPattern());
        }

        // Check field name 'half_year_begin' first before field var 'x_half_year_begin'
        $val = $CurrentForm->hasValue("half_year_begin") ? $CurrentForm->getValue("half_year_begin") : $CurrentForm->getValue("x_half_year_begin");
        if (!$this->half_year_begin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->half_year_begin->Visible = false; // Disable update for API request
            } else {
                $this->half_year_begin->setFormValue($val, true, $validate);
            }
            $this->half_year_begin->CurrentValue = UnFormatDateTime($this->half_year_begin->CurrentValue, $this->half_year_begin->formatPattern());
        }

        // Check field name 'year_end' first before field var 'x_year_end'
        $val = $CurrentForm->hasValue("year_end") ? $CurrentForm->getValue("year_end") : $CurrentForm->getValue("x_year_end");
        if (!$this->year_end->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->year_end->Visible = false; // Disable update for API request
            } else {
                $this->year_end->setFormValue($val, true, $validate);
            }
            $this->year_end->CurrentValue = UnFormatDateTime($this->year_end->CurrentValue, $this->year_end->formatPattern());
        }

        // Check field name 'plus_signup_full' first before field var 'x_plus_signup_full'
        $val = $CurrentForm->hasValue("plus_signup_full") ? $CurrentForm->getValue("plus_signup_full") : $CurrentForm->getValue("x_plus_signup_full");
        if (!$this->plus_signup_full->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->plus_signup_full->Visible = false; // Disable update for API request
            } else {
                $this->plus_signup_full->setFormValue($val);
            }
        }

        // Check field name 'plus_signup_half' first before field var 'x_plus_signup_half'
        $val = $CurrentForm->hasValue("plus_signup_half") ? $CurrentForm->getValue("plus_signup_half") : $CurrentForm->getValue("x_plus_signup_half");
        if (!$this->plus_signup_half->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->plus_signup_half->Visible = false; // Disable update for API request
            } else {
                $this->plus_signup_half->setFormValue($val);
            }
        }

        // Check field name 'bursar_deposit_deadline' first before field var 'x_bursar_deposit_deadline'
        $val = $CurrentForm->hasValue("bursar_deposit_deadline") ? $CurrentForm->getValue("bursar_deposit_deadline") : $CurrentForm->getValue("x_bursar_deposit_deadline");
        if (!$this->bursar_deposit_deadline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bursar_deposit_deadline->Visible = false; // Disable update for API request
            } else {
                $this->bursar_deposit_deadline->setFormValue($val, true, $validate);
            }
            $this->bursar_deposit_deadline->CurrentValue = UnFormatDateTime($this->bursar_deposit_deadline->CurrentValue, $this->bursar_deposit_deadline->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->min_deposit->CurrentValue = $this->min_deposit->FormValue;
        $this->max_deposit->CurrentValue = $this->max_deposit->FormValue;
        $this->current_term_code->CurrentValue = $this->current_term_code->FormValue;
        $this->fall_term_code->CurrentValue = $this->fall_term_code->FormValue;
        $this->spring_term_code->CurrentValue = $this->spring_term_code->FormValue;
        $this->full_year_begin->CurrentValue = $this->full_year_begin->FormValue;
        $this->full_year_begin->CurrentValue = UnFormatDateTime($this->full_year_begin->CurrentValue, $this->full_year_begin->formatPattern());
        $this->half_year_begin->CurrentValue = $this->half_year_begin->FormValue;
        $this->half_year_begin->CurrentValue = UnFormatDateTime($this->half_year_begin->CurrentValue, $this->half_year_begin->formatPattern());
        $this->year_end->CurrentValue = $this->year_end->FormValue;
        $this->year_end->CurrentValue = UnFormatDateTime($this->year_end->CurrentValue, $this->year_end->formatPattern());
        $this->plus_signup_full->CurrentValue = $this->plus_signup_full->FormValue;
        $this->plus_signup_half->CurrentValue = $this->plus_signup_half->FormValue;
        $this->bursar_deposit_deadline->CurrentValue = $this->bursar_deposit_deadline->FormValue;
        $this->bursar_deposit_deadline->CurrentValue = UnFormatDateTime($this->bursar_deposit_deadline->CurrentValue, $this->bursar_deposit_deadline->formatPattern());
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
        $this->id->setDbValue($row['id']);
        $this->min_deposit->setDbValue($row['min_deposit']);
        $this->max_deposit->setDbValue($row['max_deposit']);
        $this->current_term_code->setDbValue($row['current_term_code']);
        $this->fall_term_code->setDbValue($row['fall_term_code']);
        $this->spring_term_code->setDbValue($row['spring_term_code']);
        $this->full_year_begin->setDbValue($row['full_year_begin']);
        $this->half_year_begin->setDbValue($row['half_year_begin']);
        $this->year_end->setDbValue($row['year_end']);
        $this->plus_signup_full->setDbValue($row['plus_signup_full']);
        $this->plus_signup_half->setDbValue($row['plus_signup_half']);
        $this->bursar_deposit_deadline->setDbValue($row['bursar_deposit_deadline']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['min_deposit'] = $this->min_deposit->CurrentValue;
        $row['max_deposit'] = $this->max_deposit->CurrentValue;
        $row['current_term_code'] = $this->current_term_code->CurrentValue;
        $row['fall_term_code'] = $this->fall_term_code->CurrentValue;
        $row['spring_term_code'] = $this->spring_term_code->CurrentValue;
        $row['full_year_begin'] = $this->full_year_begin->CurrentValue;
        $row['half_year_begin'] = $this->half_year_begin->CurrentValue;
        $row['year_end'] = $this->year_end->CurrentValue;
        $row['plus_signup_full'] = $this->plus_signup_full->CurrentValue;
        $row['plus_signup_half'] = $this->plus_signup_half->CurrentValue;
        $row['bursar_deposit_deadline'] = $this->bursar_deposit_deadline->CurrentValue;
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
        $this->id->RowCssClass = "row";

        // min_deposit
        $this->min_deposit->RowCssClass = "row";

        // max_deposit
        $this->max_deposit->RowCssClass = "row";

        // current_term_code
        $this->current_term_code->RowCssClass = "row";

        // fall_term_code
        $this->fall_term_code->RowCssClass = "row";

        // spring_term_code
        $this->spring_term_code->RowCssClass = "row";

        // full_year_begin
        $this->full_year_begin->RowCssClass = "row";

        // half_year_begin
        $this->half_year_begin->RowCssClass = "row";

        // year_end
        $this->year_end->RowCssClass = "row";

        // plus_signup_full
        $this->plus_signup_full->RowCssClass = "row";

        // plus_signup_half
        $this->plus_signup_half->RowCssClass = "row";

        // bursar_deposit_deadline
        $this->bursar_deposit_deadline->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, "");
            $this->id->ViewCustomAttributes = "";

            // min_deposit
            $this->min_deposit->ViewValue = $this->min_deposit->CurrentValue;
            $this->min_deposit->ViewValue = FormatNumber($this->min_deposit->ViewValue, "");
            $this->min_deposit->ViewCustomAttributes = "";

            // max_deposit
            $this->max_deposit->ViewValue = $this->max_deposit->CurrentValue;
            $this->max_deposit->ViewValue = FormatNumber($this->max_deposit->ViewValue, "");
            $this->max_deposit->ViewCustomAttributes = "";

            // current_term_code
            $this->current_term_code->ViewValue = $this->current_term_code->CurrentValue;
            $this->current_term_code->ViewValue = FormatNumber($this->current_term_code->ViewValue, "");
            $this->current_term_code->ViewCustomAttributes = "";

            // fall_term_code
            $this->fall_term_code->ViewValue = $this->fall_term_code->CurrentValue;
            $this->fall_term_code->ViewValue = FormatNumber($this->fall_term_code->ViewValue, "");
            $this->fall_term_code->ViewCustomAttributes = "";

            // spring_term_code
            $this->spring_term_code->ViewValue = $this->spring_term_code->CurrentValue;
            $this->spring_term_code->ViewValue = FormatNumber($this->spring_term_code->ViewValue, "");
            $this->spring_term_code->ViewCustomAttributes = "";

            // full_year_begin
            $this->full_year_begin->ViewValue = $this->full_year_begin->CurrentValue;
            $this->full_year_begin->ViewValue = FormatDateTime($this->full_year_begin->ViewValue, 0);
            $this->full_year_begin->ViewCustomAttributes = "";

            // half_year_begin
            $this->half_year_begin->ViewValue = $this->half_year_begin->CurrentValue;
            $this->half_year_begin->ViewValue = FormatDateTime($this->half_year_begin->ViewValue, 0);
            $this->half_year_begin->ViewCustomAttributes = "";

            // year_end
            $this->year_end->ViewValue = $this->year_end->CurrentValue;
            $this->year_end->ViewValue = FormatDateTime($this->year_end->ViewValue, 0);
            $this->year_end->ViewCustomAttributes = "";

            // plus_signup_full
            if (ConvertToBool($this->plus_signup_full->CurrentValue)) {
                $this->plus_signup_full->ViewValue = $this->plus_signup_full->tagCaption(1) != "" ? $this->plus_signup_full->tagCaption(1) : "Yes";
            } else {
                $this->plus_signup_full->ViewValue = $this->plus_signup_full->tagCaption(2) != "" ? $this->plus_signup_full->tagCaption(2) : "No";
            }
            $this->plus_signup_full->ViewCustomAttributes = "";

            // plus_signup_half
            if (ConvertToBool($this->plus_signup_half->CurrentValue)) {
                $this->plus_signup_half->ViewValue = $this->plus_signup_half->tagCaption(1) != "" ? $this->plus_signup_half->tagCaption(1) : "Yes";
            } else {
                $this->plus_signup_half->ViewValue = $this->plus_signup_half->tagCaption(2) != "" ? $this->plus_signup_half->tagCaption(2) : "No";
            }
            $this->plus_signup_half->ViewCustomAttributes = "";

            // bursar_deposit_deadline
            $this->bursar_deposit_deadline->ViewValue = $this->bursar_deposit_deadline->CurrentValue;
            $this->bursar_deposit_deadline->ViewValue = FormatDateTime($this->bursar_deposit_deadline->ViewValue, 0);
            $this->bursar_deposit_deadline->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // min_deposit
            $this->min_deposit->LinkCustomAttributes = "";
            $this->min_deposit->HrefValue = "";

            // max_deposit
            $this->max_deposit->LinkCustomAttributes = "";
            $this->max_deposit->HrefValue = "";

            // current_term_code
            $this->current_term_code->LinkCustomAttributes = "";
            $this->current_term_code->HrefValue = "";

            // fall_term_code
            $this->fall_term_code->LinkCustomAttributes = "";
            $this->fall_term_code->HrefValue = "";

            // spring_term_code
            $this->spring_term_code->LinkCustomAttributes = "";
            $this->spring_term_code->HrefValue = "";

            // full_year_begin
            $this->full_year_begin->LinkCustomAttributes = "";
            $this->full_year_begin->HrefValue = "";

            // half_year_begin
            $this->half_year_begin->LinkCustomAttributes = "";
            $this->half_year_begin->HrefValue = "";

            // year_end
            $this->year_end->LinkCustomAttributes = "";
            $this->year_end->HrefValue = "";

            // plus_signup_full
            $this->plus_signup_full->LinkCustomAttributes = "";
            $this->plus_signup_full->HrefValue = "";

            // plus_signup_half
            $this->plus_signup_half->LinkCustomAttributes = "";
            $this->plus_signup_half->HrefValue = "";

            // bursar_deposit_deadline
            $this->bursar_deposit_deadline->LinkCustomAttributes = "";
            $this->bursar_deposit_deadline->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->CurrentValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());
            if (strval($this->id->EditValue) != "" && is_numeric($this->id->EditValue)) {
                $this->id->EditValue = FormatNumber($this->id->EditValue, null);
            }

            // min_deposit
            $this->min_deposit->setupEditAttributes();
            $this->min_deposit->EditCustomAttributes = "";
            $this->min_deposit->EditValue = HtmlEncode($this->min_deposit->CurrentValue);
            $this->min_deposit->PlaceHolder = RemoveHtml($this->min_deposit->caption());
            if (strval($this->min_deposit->EditValue) != "" && is_numeric($this->min_deposit->EditValue)) {
                $this->min_deposit->EditValue = FormatNumber($this->min_deposit->EditValue, null);
            }

            // max_deposit
            $this->max_deposit->setupEditAttributes();
            $this->max_deposit->EditCustomAttributes = "";
            $this->max_deposit->EditValue = HtmlEncode($this->max_deposit->CurrentValue);
            $this->max_deposit->PlaceHolder = RemoveHtml($this->max_deposit->caption());
            if (strval($this->max_deposit->EditValue) != "" && is_numeric($this->max_deposit->EditValue)) {
                $this->max_deposit->EditValue = FormatNumber($this->max_deposit->EditValue, null);
            }

            // current_term_code
            $this->current_term_code->setupEditAttributes();
            $this->current_term_code->EditCustomAttributes = "";
            $this->current_term_code->EditValue = HtmlEncode($this->current_term_code->CurrentValue);
            $this->current_term_code->PlaceHolder = RemoveHtml($this->current_term_code->caption());
            if (strval($this->current_term_code->EditValue) != "" && is_numeric($this->current_term_code->EditValue)) {
                $this->current_term_code->EditValue = FormatNumber($this->current_term_code->EditValue, null);
            }

            // fall_term_code
            $this->fall_term_code->setupEditAttributes();
            $this->fall_term_code->EditCustomAttributes = "";
            $this->fall_term_code->EditValue = HtmlEncode($this->fall_term_code->CurrentValue);
            $this->fall_term_code->PlaceHolder = RemoveHtml($this->fall_term_code->caption());
            if (strval($this->fall_term_code->EditValue) != "" && is_numeric($this->fall_term_code->EditValue)) {
                $this->fall_term_code->EditValue = FormatNumber($this->fall_term_code->EditValue, null);
            }

            // spring_term_code
            $this->spring_term_code->setupEditAttributes();
            $this->spring_term_code->EditCustomAttributes = "";
            $this->spring_term_code->EditValue = HtmlEncode($this->spring_term_code->CurrentValue);
            $this->spring_term_code->PlaceHolder = RemoveHtml($this->spring_term_code->caption());
            if (strval($this->spring_term_code->EditValue) != "" && is_numeric($this->spring_term_code->EditValue)) {
                $this->spring_term_code->EditValue = FormatNumber($this->spring_term_code->EditValue, null);
            }

            // full_year_begin
            $this->full_year_begin->setupEditAttributes();
            $this->full_year_begin->EditCustomAttributes = "";
            $this->full_year_begin->EditValue = HtmlEncode(FormatDateTime($this->full_year_begin->CurrentValue, 8));
            $this->full_year_begin->PlaceHolder = RemoveHtml($this->full_year_begin->caption());

            // half_year_begin
            $this->half_year_begin->setupEditAttributes();
            $this->half_year_begin->EditCustomAttributes = "";
            $this->half_year_begin->EditValue = HtmlEncode(FormatDateTime($this->half_year_begin->CurrentValue, 8));
            $this->half_year_begin->PlaceHolder = RemoveHtml($this->half_year_begin->caption());

            // year_end
            $this->year_end->setupEditAttributes();
            $this->year_end->EditCustomAttributes = "";
            $this->year_end->EditValue = HtmlEncode(FormatDateTime($this->year_end->CurrentValue, 8));
            $this->year_end->PlaceHolder = RemoveHtml($this->year_end->caption());

            // plus_signup_full
            $this->plus_signup_full->EditCustomAttributes = "";
            $this->plus_signup_full->EditValue = $this->plus_signup_full->options(false);
            $this->plus_signup_full->PlaceHolder = RemoveHtml($this->plus_signup_full->caption());

            // plus_signup_half
            $this->plus_signup_half->EditCustomAttributes = "";
            $this->plus_signup_half->EditValue = $this->plus_signup_half->options(false);
            $this->plus_signup_half->PlaceHolder = RemoveHtml($this->plus_signup_half->caption());

            // bursar_deposit_deadline
            $this->bursar_deposit_deadline->setupEditAttributes();
            $this->bursar_deposit_deadline->EditCustomAttributes = "";
            $this->bursar_deposit_deadline->EditValue = HtmlEncode(FormatDateTime($this->bursar_deposit_deadline->CurrentValue, 8));
            $this->bursar_deposit_deadline->PlaceHolder = RemoveHtml($this->bursar_deposit_deadline->caption());

            // Add refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // min_deposit
            $this->min_deposit->LinkCustomAttributes = "";
            $this->min_deposit->HrefValue = "";

            // max_deposit
            $this->max_deposit->LinkCustomAttributes = "";
            $this->max_deposit->HrefValue = "";

            // current_term_code
            $this->current_term_code->LinkCustomAttributes = "";
            $this->current_term_code->HrefValue = "";

            // fall_term_code
            $this->fall_term_code->LinkCustomAttributes = "";
            $this->fall_term_code->HrefValue = "";

            // spring_term_code
            $this->spring_term_code->LinkCustomAttributes = "";
            $this->spring_term_code->HrefValue = "";

            // full_year_begin
            $this->full_year_begin->LinkCustomAttributes = "";
            $this->full_year_begin->HrefValue = "";

            // half_year_begin
            $this->half_year_begin->LinkCustomAttributes = "";
            $this->half_year_begin->HrefValue = "";

            // year_end
            $this->year_end->LinkCustomAttributes = "";
            $this->year_end->HrefValue = "";

            // plus_signup_full
            $this->plus_signup_full->LinkCustomAttributes = "";
            $this->plus_signup_full->HrefValue = "";

            // plus_signup_half
            $this->plus_signup_half->LinkCustomAttributes = "";
            $this->plus_signup_half->HrefValue = "";

            // bursar_deposit_deadline
            $this->bursar_deposit_deadline->LinkCustomAttributes = "";
            $this->bursar_deposit_deadline->HrefValue = "";
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
        if ($this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id->FormValue)) {
            $this->id->addErrorMessage($this->id->getErrorMessage(false));
        }
        if ($this->min_deposit->Required) {
            if (!$this->min_deposit->IsDetailKey && EmptyValue($this->min_deposit->FormValue)) {
                $this->min_deposit->addErrorMessage(str_replace("%s", $this->min_deposit->caption(), $this->min_deposit->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->min_deposit->FormValue)) {
            $this->min_deposit->addErrorMessage($this->min_deposit->getErrorMessage(false));
        }
        if ($this->max_deposit->Required) {
            if (!$this->max_deposit->IsDetailKey && EmptyValue($this->max_deposit->FormValue)) {
                $this->max_deposit->addErrorMessage(str_replace("%s", $this->max_deposit->caption(), $this->max_deposit->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_deposit->FormValue)) {
            $this->max_deposit->addErrorMessage($this->max_deposit->getErrorMessage(false));
        }
        if ($this->current_term_code->Required) {
            if (!$this->current_term_code->IsDetailKey && EmptyValue($this->current_term_code->FormValue)) {
                $this->current_term_code->addErrorMessage(str_replace("%s", $this->current_term_code->caption(), $this->current_term_code->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->current_term_code->FormValue)) {
            $this->current_term_code->addErrorMessage($this->current_term_code->getErrorMessage(false));
        }
        if ($this->fall_term_code->Required) {
            if (!$this->fall_term_code->IsDetailKey && EmptyValue($this->fall_term_code->FormValue)) {
                $this->fall_term_code->addErrorMessage(str_replace("%s", $this->fall_term_code->caption(), $this->fall_term_code->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->fall_term_code->FormValue)) {
            $this->fall_term_code->addErrorMessage($this->fall_term_code->getErrorMessage(false));
        }
        if ($this->spring_term_code->Required) {
            if (!$this->spring_term_code->IsDetailKey && EmptyValue($this->spring_term_code->FormValue)) {
                $this->spring_term_code->addErrorMessage(str_replace("%s", $this->spring_term_code->caption(), $this->spring_term_code->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->spring_term_code->FormValue)) {
            $this->spring_term_code->addErrorMessage($this->spring_term_code->getErrorMessage(false));
        }
        if ($this->full_year_begin->Required) {
            if (!$this->full_year_begin->IsDetailKey && EmptyValue($this->full_year_begin->FormValue)) {
                $this->full_year_begin->addErrorMessage(str_replace("%s", $this->full_year_begin->caption(), $this->full_year_begin->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->full_year_begin->FormValue, $this->full_year_begin->formatPattern())) {
            $this->full_year_begin->addErrorMessage($this->full_year_begin->getErrorMessage(false));
        }
        if ($this->half_year_begin->Required) {
            if (!$this->half_year_begin->IsDetailKey && EmptyValue($this->half_year_begin->FormValue)) {
                $this->half_year_begin->addErrorMessage(str_replace("%s", $this->half_year_begin->caption(), $this->half_year_begin->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->half_year_begin->FormValue, $this->half_year_begin->formatPattern())) {
            $this->half_year_begin->addErrorMessage($this->half_year_begin->getErrorMessage(false));
        }
        if ($this->year_end->Required) {
            if (!$this->year_end->IsDetailKey && EmptyValue($this->year_end->FormValue)) {
                $this->year_end->addErrorMessage(str_replace("%s", $this->year_end->caption(), $this->year_end->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->year_end->FormValue, $this->year_end->formatPattern())) {
            $this->year_end->addErrorMessage($this->year_end->getErrorMessage(false));
        }
        if ($this->plus_signup_full->Required) {
            if ($this->plus_signup_full->FormValue == "") {
                $this->plus_signup_full->addErrorMessage(str_replace("%s", $this->plus_signup_full->caption(), $this->plus_signup_full->RequiredErrorMessage));
            }
        }
        if ($this->plus_signup_half->Required) {
            if ($this->plus_signup_half->FormValue == "") {
                $this->plus_signup_half->addErrorMessage(str_replace("%s", $this->plus_signup_half->caption(), $this->plus_signup_half->RequiredErrorMessage));
            }
        }
        if ($this->bursar_deposit_deadline->Required) {
            if (!$this->bursar_deposit_deadline->IsDetailKey && EmptyValue($this->bursar_deposit_deadline->FormValue)) {
                $this->bursar_deposit_deadline->addErrorMessage(str_replace("%s", $this->bursar_deposit_deadline->caption(), $this->bursar_deposit_deadline->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->bursar_deposit_deadline->FormValue, $this->bursar_deposit_deadline->formatPattern())) {
            $this->bursar_deposit_deadline->addErrorMessage($this->bursar_deposit_deadline->getErrorMessage(false));
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

        // id
        $this->id->setDbValueDef($rsnew, $this->id->CurrentValue, 0, false);

        // min_deposit
        $this->min_deposit->setDbValueDef($rsnew, $this->min_deposit->CurrentValue, 0, false);

        // max_deposit
        $this->max_deposit->setDbValueDef($rsnew, $this->max_deposit->CurrentValue, 0, false);

        // current_term_code
        $this->current_term_code->setDbValueDef($rsnew, $this->current_term_code->CurrentValue, 0, false);

        // fall_term_code
        $this->fall_term_code->setDbValueDef($rsnew, $this->fall_term_code->CurrentValue, 0, false);

        // spring_term_code
        $this->spring_term_code->setDbValueDef($rsnew, $this->spring_term_code->CurrentValue, 0, false);

        // full_year_begin
        $this->full_year_begin->setDbValueDef($rsnew, UnFormatDateTime($this->full_year_begin->CurrentValue, $this->full_year_begin->formatPattern()), CurrentDate(), false);

        // half_year_begin
        $this->half_year_begin->setDbValueDef($rsnew, UnFormatDateTime($this->half_year_begin->CurrentValue, $this->half_year_begin->formatPattern()), CurrentDate(), false);

        // year_end
        $this->year_end->setDbValueDef($rsnew, UnFormatDateTime($this->year_end->CurrentValue, $this->year_end->formatPattern()), CurrentDate(), false);

        // plus_signup_full
        $tmpBool = $this->plus_signup_full->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->plus_signup_full->setDbValueDef($rsnew, $tmpBool, 0, false);

        // plus_signup_half
        $tmpBool = $this->plus_signup_half->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->plus_signup_half->setDbValueDef($rsnew, $tmpBool, 0, false);

        // bursar_deposit_deadline
        $this->bursar_deposit_deadline->setDbValueDef($rsnew, UnFormatDateTime($this->bursar_deposit_deadline->CurrentValue, $this->bursar_deposit_deadline->formatPattern()), CurrentDate(), false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['id']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Config2List"), "", $this->TableVar, true);
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
                case "x_plus_signup_full":
                    break;
                case "x_plus_signup_half":
                    break;
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
