<?php

namespace PHPMaker2022\project2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MealTimesAdd extends MealTimes
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'meal_times';

    // Page object name
    public $PageObjName = "MealTimesAdd";

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

        // Table object (meal_times)
        if (!isset($GLOBALS["meal_times"]) || get_class($GLOBALS["meal_times"]) == PROJECT_NAMESPACE . "meal_times") {
            $GLOBALS["meal_times"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'meal_times');
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
                $tbl = Container("meal_times");
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
                    if ($pageName == "MealTimesView") {
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
        $this->id->Visible = false;
        $this->location_id->setVisibility();
        $this->meal_details_id->setVisibility();
        $this->startm->setVisibility();
        $this->endm->setVisibility();
        $this->startt->setVisibility();
        $this->endt->setVisibility();
        $this->startw->setVisibility();
        $this->endw->setVisibility();
        $this->startr->setVisibility();
        $this->endr->setVisibility();
        $this->startf->setVisibility();
        $this->endf->setVisibility();
        $this->starts->setVisibility();
        $this->ends->setVisibility();
        $this->startu->setVisibility();
        $this->endu->setVisibility();
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
                    $this->terminate("MealTimesList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "MealTimesList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "MealTimesView") {
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
        $this->location_id->CurrentValue = null;
        $this->location_id->OldValue = $this->location_id->CurrentValue;
        $this->meal_details_id->CurrentValue = null;
        $this->meal_details_id->OldValue = $this->meal_details_id->CurrentValue;
        $this->startm->CurrentValue = null;
        $this->startm->OldValue = $this->startm->CurrentValue;
        $this->endm->CurrentValue = null;
        $this->endm->OldValue = $this->endm->CurrentValue;
        $this->startt->CurrentValue = null;
        $this->startt->OldValue = $this->startt->CurrentValue;
        $this->endt->CurrentValue = null;
        $this->endt->OldValue = $this->endt->CurrentValue;
        $this->startw->CurrentValue = null;
        $this->startw->OldValue = $this->startw->CurrentValue;
        $this->endw->CurrentValue = null;
        $this->endw->OldValue = $this->endw->CurrentValue;
        $this->startr->CurrentValue = null;
        $this->startr->OldValue = $this->startr->CurrentValue;
        $this->endr->CurrentValue = null;
        $this->endr->OldValue = $this->endr->CurrentValue;
        $this->startf->CurrentValue = null;
        $this->startf->OldValue = $this->startf->CurrentValue;
        $this->endf->CurrentValue = null;
        $this->endf->OldValue = $this->endf->CurrentValue;
        $this->starts->CurrentValue = null;
        $this->starts->OldValue = $this->starts->CurrentValue;
        $this->ends->CurrentValue = null;
        $this->ends->OldValue = $this->ends->CurrentValue;
        $this->startu->CurrentValue = null;
        $this->startu->OldValue = $this->startu->CurrentValue;
        $this->endu->CurrentValue = null;
        $this->endu->OldValue = $this->endu->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'location_id' first before field var 'x_location_id'
        $val = $CurrentForm->hasValue("location_id") ? $CurrentForm->getValue("location_id") : $CurrentForm->getValue("x_location_id");
        if (!$this->location_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_id->Visible = false; // Disable update for API request
            } else {
                $this->location_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'meal_details_id' first before field var 'x_meal_details_id'
        $val = $CurrentForm->hasValue("meal_details_id") ? $CurrentForm->getValue("meal_details_id") : $CurrentForm->getValue("x_meal_details_id");
        if (!$this->meal_details_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meal_details_id->Visible = false; // Disable update for API request
            } else {
                $this->meal_details_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'startm' first before field var 'x_startm'
        $val = $CurrentForm->hasValue("startm") ? $CurrentForm->getValue("startm") : $CurrentForm->getValue("x_startm");
        if (!$this->startm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startm->Visible = false; // Disable update for API request
            } else {
                $this->startm->setFormValue($val, true, $validate);
            }
            $this->startm->CurrentValue = UnFormatDateTime($this->startm->CurrentValue, $this->startm->formatPattern());
        }

        // Check field name 'endm' first before field var 'x_endm'
        $val = $CurrentForm->hasValue("endm") ? $CurrentForm->getValue("endm") : $CurrentForm->getValue("x_endm");
        if (!$this->endm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endm->Visible = false; // Disable update for API request
            } else {
                $this->endm->setFormValue($val, true, $validate);
            }
            $this->endm->CurrentValue = UnFormatDateTime($this->endm->CurrentValue, $this->endm->formatPattern());
        }

        // Check field name 'startt' first before field var 'x_startt'
        $val = $CurrentForm->hasValue("startt") ? $CurrentForm->getValue("startt") : $CurrentForm->getValue("x_startt");
        if (!$this->startt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startt->Visible = false; // Disable update for API request
            } else {
                $this->startt->setFormValue($val, true, $validate);
            }
            $this->startt->CurrentValue = UnFormatDateTime($this->startt->CurrentValue, $this->startt->formatPattern());
        }

        // Check field name 'endt' first before field var 'x_endt'
        $val = $CurrentForm->hasValue("endt") ? $CurrentForm->getValue("endt") : $CurrentForm->getValue("x_endt");
        if (!$this->endt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endt->Visible = false; // Disable update for API request
            } else {
                $this->endt->setFormValue($val, true, $validate);
            }
            $this->endt->CurrentValue = UnFormatDateTime($this->endt->CurrentValue, $this->endt->formatPattern());
        }

        // Check field name 'startw' first before field var 'x_startw'
        $val = $CurrentForm->hasValue("startw") ? $CurrentForm->getValue("startw") : $CurrentForm->getValue("x_startw");
        if (!$this->startw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startw->Visible = false; // Disable update for API request
            } else {
                $this->startw->setFormValue($val, true, $validate);
            }
            $this->startw->CurrentValue = UnFormatDateTime($this->startw->CurrentValue, $this->startw->formatPattern());
        }

        // Check field name 'endw' first before field var 'x_endw'
        $val = $CurrentForm->hasValue("endw") ? $CurrentForm->getValue("endw") : $CurrentForm->getValue("x_endw");
        if (!$this->endw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endw->Visible = false; // Disable update for API request
            } else {
                $this->endw->setFormValue($val, true, $validate);
            }
            $this->endw->CurrentValue = UnFormatDateTime($this->endw->CurrentValue, $this->endw->formatPattern());
        }

        // Check field name 'startr' first before field var 'x_startr'
        $val = $CurrentForm->hasValue("startr") ? $CurrentForm->getValue("startr") : $CurrentForm->getValue("x_startr");
        if (!$this->startr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startr->Visible = false; // Disable update for API request
            } else {
                $this->startr->setFormValue($val, true, $validate);
            }
            $this->startr->CurrentValue = UnFormatDateTime($this->startr->CurrentValue, $this->startr->formatPattern());
        }

        // Check field name 'endr' first before field var 'x_endr'
        $val = $CurrentForm->hasValue("endr") ? $CurrentForm->getValue("endr") : $CurrentForm->getValue("x_endr");
        if (!$this->endr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endr->Visible = false; // Disable update for API request
            } else {
                $this->endr->setFormValue($val, true, $validate);
            }
            $this->endr->CurrentValue = UnFormatDateTime($this->endr->CurrentValue, $this->endr->formatPattern());
        }

        // Check field name 'startf' first before field var 'x_startf'
        $val = $CurrentForm->hasValue("startf") ? $CurrentForm->getValue("startf") : $CurrentForm->getValue("x_startf");
        if (!$this->startf->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startf->Visible = false; // Disable update for API request
            } else {
                $this->startf->setFormValue($val, true, $validate);
            }
            $this->startf->CurrentValue = UnFormatDateTime($this->startf->CurrentValue, $this->startf->formatPattern());
        }

        // Check field name 'endf' first before field var 'x_endf'
        $val = $CurrentForm->hasValue("endf") ? $CurrentForm->getValue("endf") : $CurrentForm->getValue("x_endf");
        if (!$this->endf->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endf->Visible = false; // Disable update for API request
            } else {
                $this->endf->setFormValue($val, true, $validate);
            }
            $this->endf->CurrentValue = UnFormatDateTime($this->endf->CurrentValue, $this->endf->formatPattern());
        }

        // Check field name 'starts' first before field var 'x_starts'
        $val = $CurrentForm->hasValue("starts") ? $CurrentForm->getValue("starts") : $CurrentForm->getValue("x_starts");
        if (!$this->starts->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->starts->Visible = false; // Disable update for API request
            } else {
                $this->starts->setFormValue($val, true, $validate);
            }
            $this->starts->CurrentValue = UnFormatDateTime($this->starts->CurrentValue, $this->starts->formatPattern());
        }

        // Check field name 'ends' first before field var 'x_ends'
        $val = $CurrentForm->hasValue("ends") ? $CurrentForm->getValue("ends") : $CurrentForm->getValue("x_ends");
        if (!$this->ends->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ends->Visible = false; // Disable update for API request
            } else {
                $this->ends->setFormValue($val, true, $validate);
            }
            $this->ends->CurrentValue = UnFormatDateTime($this->ends->CurrentValue, $this->ends->formatPattern());
        }

        // Check field name 'startu' first before field var 'x_startu'
        $val = $CurrentForm->hasValue("startu") ? $CurrentForm->getValue("startu") : $CurrentForm->getValue("x_startu");
        if (!$this->startu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startu->Visible = false; // Disable update for API request
            } else {
                $this->startu->setFormValue($val, true, $validate);
            }
            $this->startu->CurrentValue = UnFormatDateTime($this->startu->CurrentValue, $this->startu->formatPattern());
        }

        // Check field name 'endu' first before field var 'x_endu'
        $val = $CurrentForm->hasValue("endu") ? $CurrentForm->getValue("endu") : $CurrentForm->getValue("x_endu");
        if (!$this->endu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endu->Visible = false; // Disable update for API request
            } else {
                $this->endu->setFormValue($val, true, $validate);
            }
            $this->endu->CurrentValue = UnFormatDateTime($this->endu->CurrentValue, $this->endu->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->location_id->CurrentValue = $this->location_id->FormValue;
        $this->meal_details_id->CurrentValue = $this->meal_details_id->FormValue;
        $this->startm->CurrentValue = $this->startm->FormValue;
        $this->startm->CurrentValue = UnFormatDateTime($this->startm->CurrentValue, $this->startm->formatPattern());
        $this->endm->CurrentValue = $this->endm->FormValue;
        $this->endm->CurrentValue = UnFormatDateTime($this->endm->CurrentValue, $this->endm->formatPattern());
        $this->startt->CurrentValue = $this->startt->FormValue;
        $this->startt->CurrentValue = UnFormatDateTime($this->startt->CurrentValue, $this->startt->formatPattern());
        $this->endt->CurrentValue = $this->endt->FormValue;
        $this->endt->CurrentValue = UnFormatDateTime($this->endt->CurrentValue, $this->endt->formatPattern());
        $this->startw->CurrentValue = $this->startw->FormValue;
        $this->startw->CurrentValue = UnFormatDateTime($this->startw->CurrentValue, $this->startw->formatPattern());
        $this->endw->CurrentValue = $this->endw->FormValue;
        $this->endw->CurrentValue = UnFormatDateTime($this->endw->CurrentValue, $this->endw->formatPattern());
        $this->startr->CurrentValue = $this->startr->FormValue;
        $this->startr->CurrentValue = UnFormatDateTime($this->startr->CurrentValue, $this->startr->formatPattern());
        $this->endr->CurrentValue = $this->endr->FormValue;
        $this->endr->CurrentValue = UnFormatDateTime($this->endr->CurrentValue, $this->endr->formatPattern());
        $this->startf->CurrentValue = $this->startf->FormValue;
        $this->startf->CurrentValue = UnFormatDateTime($this->startf->CurrentValue, $this->startf->formatPattern());
        $this->endf->CurrentValue = $this->endf->FormValue;
        $this->endf->CurrentValue = UnFormatDateTime($this->endf->CurrentValue, $this->endf->formatPattern());
        $this->starts->CurrentValue = $this->starts->FormValue;
        $this->starts->CurrentValue = UnFormatDateTime($this->starts->CurrentValue, $this->starts->formatPattern());
        $this->ends->CurrentValue = $this->ends->FormValue;
        $this->ends->CurrentValue = UnFormatDateTime($this->ends->CurrentValue, $this->ends->formatPattern());
        $this->startu->CurrentValue = $this->startu->FormValue;
        $this->startu->CurrentValue = UnFormatDateTime($this->startu->CurrentValue, $this->startu->formatPattern());
        $this->endu->CurrentValue = $this->endu->FormValue;
        $this->endu->CurrentValue = UnFormatDateTime($this->endu->CurrentValue, $this->endu->formatPattern());
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
        $this->location_id->setDbValue($row['location_id']);
        $this->meal_details_id->setDbValue($row['meal_details_id']);
        $this->startm->setDbValue($row['startm']);
        $this->endm->setDbValue($row['endm']);
        $this->startt->setDbValue($row['startt']);
        $this->endt->setDbValue($row['endt']);
        $this->startw->setDbValue($row['startw']);
        $this->endw->setDbValue($row['endw']);
        $this->startr->setDbValue($row['startr']);
        $this->endr->setDbValue($row['endr']);
        $this->startf->setDbValue($row['startf']);
        $this->endf->setDbValue($row['endf']);
        $this->starts->setDbValue($row['starts']);
        $this->ends->setDbValue($row['ends']);
        $this->startu->setDbValue($row['startu']);
        $this->endu->setDbValue($row['endu']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['location_id'] = $this->location_id->CurrentValue;
        $row['meal_details_id'] = $this->meal_details_id->CurrentValue;
        $row['startm'] = $this->startm->CurrentValue;
        $row['endm'] = $this->endm->CurrentValue;
        $row['startt'] = $this->startt->CurrentValue;
        $row['endt'] = $this->endt->CurrentValue;
        $row['startw'] = $this->startw->CurrentValue;
        $row['endw'] = $this->endw->CurrentValue;
        $row['startr'] = $this->startr->CurrentValue;
        $row['endr'] = $this->endr->CurrentValue;
        $row['startf'] = $this->startf->CurrentValue;
        $row['endf'] = $this->endf->CurrentValue;
        $row['starts'] = $this->starts->CurrentValue;
        $row['ends'] = $this->ends->CurrentValue;
        $row['startu'] = $this->startu->CurrentValue;
        $row['endu'] = $this->endu->CurrentValue;
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

        // location_id
        $this->location_id->RowCssClass = "row";

        // meal_details_id
        $this->meal_details_id->RowCssClass = "row";

        // startm
        $this->startm->RowCssClass = "row";

        // endm
        $this->endm->RowCssClass = "row";

        // startt
        $this->startt->RowCssClass = "row";

        // endt
        $this->endt->RowCssClass = "row";

        // startw
        $this->startw->RowCssClass = "row";

        // endw
        $this->endw->RowCssClass = "row";

        // startr
        $this->startr->RowCssClass = "row";

        // endr
        $this->endr->RowCssClass = "row";

        // startf
        $this->startf->RowCssClass = "row";

        // endf
        $this->endf->RowCssClass = "row";

        // starts
        $this->starts->RowCssClass = "row";

        // ends
        $this->ends->RowCssClass = "row";

        // startu
        $this->startu->RowCssClass = "row";

        // endu
        $this->endu->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location_id
            $this->location_id->ViewValue = $this->location_id->CurrentValue;
            $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, "");
            $this->location_id->ViewCustomAttributes = "";

            // meal_details_id
            $this->meal_details_id->ViewValue = $this->meal_details_id->CurrentValue;
            $this->meal_details_id->ViewValue = FormatNumber($this->meal_details_id->ViewValue, "");
            $this->meal_details_id->ViewCustomAttributes = "";

            // startm
            $this->startm->ViewValue = $this->startm->CurrentValue;
            $this->startm->ViewValue = FormatDateTime($this->startm->ViewValue, 4);
            $this->startm->ViewCustomAttributes = "";

            // endm
            $this->endm->ViewValue = $this->endm->CurrentValue;
            $this->endm->ViewValue = FormatDateTime($this->endm->ViewValue, 4);
            $this->endm->ViewCustomAttributes = "";

            // startt
            $this->startt->ViewValue = $this->startt->CurrentValue;
            $this->startt->ViewValue = FormatDateTime($this->startt->ViewValue, 4);
            $this->startt->ViewCustomAttributes = "";

            // endt
            $this->endt->ViewValue = $this->endt->CurrentValue;
            $this->endt->ViewValue = FormatDateTime($this->endt->ViewValue, 4);
            $this->endt->ViewCustomAttributes = "";

            // startw
            $this->startw->ViewValue = $this->startw->CurrentValue;
            $this->startw->ViewValue = FormatDateTime($this->startw->ViewValue, 4);
            $this->startw->ViewCustomAttributes = "";

            // endw
            $this->endw->ViewValue = $this->endw->CurrentValue;
            $this->endw->ViewValue = FormatDateTime($this->endw->ViewValue, 4);
            $this->endw->ViewCustomAttributes = "";

            // startr
            $this->startr->ViewValue = $this->startr->CurrentValue;
            $this->startr->ViewValue = FormatDateTime($this->startr->ViewValue, 4);
            $this->startr->ViewCustomAttributes = "";

            // endr
            $this->endr->ViewValue = $this->endr->CurrentValue;
            $this->endr->ViewValue = FormatDateTime($this->endr->ViewValue, 4);
            $this->endr->ViewCustomAttributes = "";

            // startf
            $this->startf->ViewValue = $this->startf->CurrentValue;
            $this->startf->ViewValue = FormatDateTime($this->startf->ViewValue, 4);
            $this->startf->ViewCustomAttributes = "";

            // endf
            $this->endf->ViewValue = $this->endf->CurrentValue;
            $this->endf->ViewValue = FormatDateTime($this->endf->ViewValue, 4);
            $this->endf->ViewCustomAttributes = "";

            // starts
            $this->starts->ViewValue = $this->starts->CurrentValue;
            $this->starts->ViewValue = FormatDateTime($this->starts->ViewValue, 4);
            $this->starts->ViewCustomAttributes = "";

            // ends
            $this->ends->ViewValue = $this->ends->CurrentValue;
            $this->ends->ViewValue = FormatDateTime($this->ends->ViewValue, 4);
            $this->ends->ViewCustomAttributes = "";

            // startu
            $this->startu->ViewValue = $this->startu->CurrentValue;
            $this->startu->ViewValue = FormatDateTime($this->startu->ViewValue, 4);
            $this->startu->ViewCustomAttributes = "";

            // endu
            $this->endu->ViewValue = $this->endu->CurrentValue;
            $this->endu->ViewValue = FormatDateTime($this->endu->ViewValue, 4);
            $this->endu->ViewCustomAttributes = "";

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";

            // meal_details_id
            $this->meal_details_id->LinkCustomAttributes = "";
            $this->meal_details_id->HrefValue = "";

            // startm
            $this->startm->LinkCustomAttributes = "";
            $this->startm->HrefValue = "";

            // endm
            $this->endm->LinkCustomAttributes = "";
            $this->endm->HrefValue = "";

            // startt
            $this->startt->LinkCustomAttributes = "";
            $this->startt->HrefValue = "";

            // endt
            $this->endt->LinkCustomAttributes = "";
            $this->endt->HrefValue = "";

            // startw
            $this->startw->LinkCustomAttributes = "";
            $this->startw->HrefValue = "";

            // endw
            $this->endw->LinkCustomAttributes = "";
            $this->endw->HrefValue = "";

            // startr
            $this->startr->LinkCustomAttributes = "";
            $this->startr->HrefValue = "";

            // endr
            $this->endr->LinkCustomAttributes = "";
            $this->endr->HrefValue = "";

            // startf
            $this->startf->LinkCustomAttributes = "";
            $this->startf->HrefValue = "";

            // endf
            $this->endf->LinkCustomAttributes = "";
            $this->endf->HrefValue = "";

            // starts
            $this->starts->LinkCustomAttributes = "";
            $this->starts->HrefValue = "";

            // ends
            $this->ends->LinkCustomAttributes = "";
            $this->ends->HrefValue = "";

            // startu
            $this->startu->LinkCustomAttributes = "";
            $this->startu->HrefValue = "";

            // endu
            $this->endu->LinkCustomAttributes = "";
            $this->endu->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // location_id
            $this->location_id->setupEditAttributes();
            $this->location_id->EditCustomAttributes = "";
            $this->location_id->EditValue = HtmlEncode($this->location_id->CurrentValue);
            $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());
            if (strval($this->location_id->EditValue) != "" && is_numeric($this->location_id->EditValue)) {
                $this->location_id->EditValue = FormatNumber($this->location_id->EditValue, null);
            }

            // meal_details_id
            $this->meal_details_id->setupEditAttributes();
            $this->meal_details_id->EditCustomAttributes = "";
            $this->meal_details_id->EditValue = HtmlEncode($this->meal_details_id->CurrentValue);
            $this->meal_details_id->PlaceHolder = RemoveHtml($this->meal_details_id->caption());
            if (strval($this->meal_details_id->EditValue) != "" && is_numeric($this->meal_details_id->EditValue)) {
                $this->meal_details_id->EditValue = FormatNumber($this->meal_details_id->EditValue, null);
            }

            // startm
            $this->startm->setupEditAttributes();
            $this->startm->EditCustomAttributes = "";
            $this->startm->EditValue = HtmlEncode(FormatDateTime($this->startm->CurrentValue, 4));
            $this->startm->PlaceHolder = RemoveHtml($this->startm->caption());

            // endm
            $this->endm->setupEditAttributes();
            $this->endm->EditCustomAttributes = "";
            $this->endm->EditValue = HtmlEncode(FormatDateTime($this->endm->CurrentValue, 4));
            $this->endm->PlaceHolder = RemoveHtml($this->endm->caption());

            // startt
            $this->startt->setupEditAttributes();
            $this->startt->EditCustomAttributes = "";
            $this->startt->EditValue = HtmlEncode(FormatDateTime($this->startt->CurrentValue, 4));
            $this->startt->PlaceHolder = RemoveHtml($this->startt->caption());

            // endt
            $this->endt->setupEditAttributes();
            $this->endt->EditCustomAttributes = "";
            $this->endt->EditValue = HtmlEncode(FormatDateTime($this->endt->CurrentValue, 4));
            $this->endt->PlaceHolder = RemoveHtml($this->endt->caption());

            // startw
            $this->startw->setupEditAttributes();
            $this->startw->EditCustomAttributes = "";
            $this->startw->EditValue = HtmlEncode(FormatDateTime($this->startw->CurrentValue, 4));
            $this->startw->PlaceHolder = RemoveHtml($this->startw->caption());

            // endw
            $this->endw->setupEditAttributes();
            $this->endw->EditCustomAttributes = "";
            $this->endw->EditValue = HtmlEncode(FormatDateTime($this->endw->CurrentValue, 4));
            $this->endw->PlaceHolder = RemoveHtml($this->endw->caption());

            // startr
            $this->startr->setupEditAttributes();
            $this->startr->EditCustomAttributes = "";
            $this->startr->EditValue = HtmlEncode(FormatDateTime($this->startr->CurrentValue, 4));
            $this->startr->PlaceHolder = RemoveHtml($this->startr->caption());

            // endr
            $this->endr->setupEditAttributes();
            $this->endr->EditCustomAttributes = "";
            $this->endr->EditValue = HtmlEncode(FormatDateTime($this->endr->CurrentValue, 4));
            $this->endr->PlaceHolder = RemoveHtml($this->endr->caption());

            // startf
            $this->startf->setupEditAttributes();
            $this->startf->EditCustomAttributes = "";
            $this->startf->EditValue = HtmlEncode(FormatDateTime($this->startf->CurrentValue, 4));
            $this->startf->PlaceHolder = RemoveHtml($this->startf->caption());

            // endf
            $this->endf->setupEditAttributes();
            $this->endf->EditCustomAttributes = "";
            $this->endf->EditValue = HtmlEncode(FormatDateTime($this->endf->CurrentValue, 4));
            $this->endf->PlaceHolder = RemoveHtml($this->endf->caption());

            // starts
            $this->starts->setupEditAttributes();
            $this->starts->EditCustomAttributes = "";
            $this->starts->EditValue = HtmlEncode(FormatDateTime($this->starts->CurrentValue, 4));
            $this->starts->PlaceHolder = RemoveHtml($this->starts->caption());

            // ends
            $this->ends->setupEditAttributes();
            $this->ends->EditCustomAttributes = "";
            $this->ends->EditValue = HtmlEncode(FormatDateTime($this->ends->CurrentValue, 4));
            $this->ends->PlaceHolder = RemoveHtml($this->ends->caption());

            // startu
            $this->startu->setupEditAttributes();
            $this->startu->EditCustomAttributes = "";
            $this->startu->EditValue = HtmlEncode(FormatDateTime($this->startu->CurrentValue, 4));
            $this->startu->PlaceHolder = RemoveHtml($this->startu->caption());

            // endu
            $this->endu->setupEditAttributes();
            $this->endu->EditCustomAttributes = "";
            $this->endu->EditValue = HtmlEncode(FormatDateTime($this->endu->CurrentValue, 4));
            $this->endu->PlaceHolder = RemoveHtml($this->endu->caption());

            // Add refer script

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";

            // meal_details_id
            $this->meal_details_id->LinkCustomAttributes = "";
            $this->meal_details_id->HrefValue = "";

            // startm
            $this->startm->LinkCustomAttributes = "";
            $this->startm->HrefValue = "";

            // endm
            $this->endm->LinkCustomAttributes = "";
            $this->endm->HrefValue = "";

            // startt
            $this->startt->LinkCustomAttributes = "";
            $this->startt->HrefValue = "";

            // endt
            $this->endt->LinkCustomAttributes = "";
            $this->endt->HrefValue = "";

            // startw
            $this->startw->LinkCustomAttributes = "";
            $this->startw->HrefValue = "";

            // endw
            $this->endw->LinkCustomAttributes = "";
            $this->endw->HrefValue = "";

            // startr
            $this->startr->LinkCustomAttributes = "";
            $this->startr->HrefValue = "";

            // endr
            $this->endr->LinkCustomAttributes = "";
            $this->endr->HrefValue = "";

            // startf
            $this->startf->LinkCustomAttributes = "";
            $this->startf->HrefValue = "";

            // endf
            $this->endf->LinkCustomAttributes = "";
            $this->endf->HrefValue = "";

            // starts
            $this->starts->LinkCustomAttributes = "";
            $this->starts->HrefValue = "";

            // ends
            $this->ends->LinkCustomAttributes = "";
            $this->ends->HrefValue = "";

            // startu
            $this->startu->LinkCustomAttributes = "";
            $this->startu->HrefValue = "";

            // endu
            $this->endu->LinkCustomAttributes = "";
            $this->endu->HrefValue = "";
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
        if ($this->location_id->Required) {
            if (!$this->location_id->IsDetailKey && EmptyValue($this->location_id->FormValue)) {
                $this->location_id->addErrorMessage(str_replace("%s", $this->location_id->caption(), $this->location_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->location_id->FormValue)) {
            $this->location_id->addErrorMessage($this->location_id->getErrorMessage(false));
        }
        if ($this->meal_details_id->Required) {
            if (!$this->meal_details_id->IsDetailKey && EmptyValue($this->meal_details_id->FormValue)) {
                $this->meal_details_id->addErrorMessage(str_replace("%s", $this->meal_details_id->caption(), $this->meal_details_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->meal_details_id->FormValue)) {
            $this->meal_details_id->addErrorMessage($this->meal_details_id->getErrorMessage(false));
        }
        if ($this->startm->Required) {
            if (!$this->startm->IsDetailKey && EmptyValue($this->startm->FormValue)) {
                $this->startm->addErrorMessage(str_replace("%s", $this->startm->caption(), $this->startm->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startm->FormValue, $this->startm->formatPattern())) {
            $this->startm->addErrorMessage($this->startm->getErrorMessage(false));
        }
        if ($this->endm->Required) {
            if (!$this->endm->IsDetailKey && EmptyValue($this->endm->FormValue)) {
                $this->endm->addErrorMessage(str_replace("%s", $this->endm->caption(), $this->endm->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endm->FormValue, $this->endm->formatPattern())) {
            $this->endm->addErrorMessage($this->endm->getErrorMessage(false));
        }
        if ($this->startt->Required) {
            if (!$this->startt->IsDetailKey && EmptyValue($this->startt->FormValue)) {
                $this->startt->addErrorMessage(str_replace("%s", $this->startt->caption(), $this->startt->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startt->FormValue, $this->startt->formatPattern())) {
            $this->startt->addErrorMessage($this->startt->getErrorMessage(false));
        }
        if ($this->endt->Required) {
            if (!$this->endt->IsDetailKey && EmptyValue($this->endt->FormValue)) {
                $this->endt->addErrorMessage(str_replace("%s", $this->endt->caption(), $this->endt->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endt->FormValue, $this->endt->formatPattern())) {
            $this->endt->addErrorMessage($this->endt->getErrorMessage(false));
        }
        if ($this->startw->Required) {
            if (!$this->startw->IsDetailKey && EmptyValue($this->startw->FormValue)) {
                $this->startw->addErrorMessage(str_replace("%s", $this->startw->caption(), $this->startw->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startw->FormValue, $this->startw->formatPattern())) {
            $this->startw->addErrorMessage($this->startw->getErrorMessage(false));
        }
        if ($this->endw->Required) {
            if (!$this->endw->IsDetailKey && EmptyValue($this->endw->FormValue)) {
                $this->endw->addErrorMessage(str_replace("%s", $this->endw->caption(), $this->endw->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endw->FormValue, $this->endw->formatPattern())) {
            $this->endw->addErrorMessage($this->endw->getErrorMessage(false));
        }
        if ($this->startr->Required) {
            if (!$this->startr->IsDetailKey && EmptyValue($this->startr->FormValue)) {
                $this->startr->addErrorMessage(str_replace("%s", $this->startr->caption(), $this->startr->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startr->FormValue, $this->startr->formatPattern())) {
            $this->startr->addErrorMessage($this->startr->getErrorMessage(false));
        }
        if ($this->endr->Required) {
            if (!$this->endr->IsDetailKey && EmptyValue($this->endr->FormValue)) {
                $this->endr->addErrorMessage(str_replace("%s", $this->endr->caption(), $this->endr->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endr->FormValue, $this->endr->formatPattern())) {
            $this->endr->addErrorMessage($this->endr->getErrorMessage(false));
        }
        if ($this->startf->Required) {
            if (!$this->startf->IsDetailKey && EmptyValue($this->startf->FormValue)) {
                $this->startf->addErrorMessage(str_replace("%s", $this->startf->caption(), $this->startf->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startf->FormValue, $this->startf->formatPattern())) {
            $this->startf->addErrorMessage($this->startf->getErrorMessage(false));
        }
        if ($this->endf->Required) {
            if (!$this->endf->IsDetailKey && EmptyValue($this->endf->FormValue)) {
                $this->endf->addErrorMessage(str_replace("%s", $this->endf->caption(), $this->endf->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endf->FormValue, $this->endf->formatPattern())) {
            $this->endf->addErrorMessage($this->endf->getErrorMessage(false));
        }
        if ($this->starts->Required) {
            if (!$this->starts->IsDetailKey && EmptyValue($this->starts->FormValue)) {
                $this->starts->addErrorMessage(str_replace("%s", $this->starts->caption(), $this->starts->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->starts->FormValue, $this->starts->formatPattern())) {
            $this->starts->addErrorMessage($this->starts->getErrorMessage(false));
        }
        if ($this->ends->Required) {
            if (!$this->ends->IsDetailKey && EmptyValue($this->ends->FormValue)) {
                $this->ends->addErrorMessage(str_replace("%s", $this->ends->caption(), $this->ends->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->ends->FormValue, $this->ends->formatPattern())) {
            $this->ends->addErrorMessage($this->ends->getErrorMessage(false));
        }
        if ($this->startu->Required) {
            if (!$this->startu->IsDetailKey && EmptyValue($this->startu->FormValue)) {
                $this->startu->addErrorMessage(str_replace("%s", $this->startu->caption(), $this->startu->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startu->FormValue, $this->startu->formatPattern())) {
            $this->startu->addErrorMessage($this->startu->getErrorMessage(false));
        }
        if ($this->endu->Required) {
            if (!$this->endu->IsDetailKey && EmptyValue($this->endu->FormValue)) {
                $this->endu->addErrorMessage(str_replace("%s", $this->endu->caption(), $this->endu->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endu->FormValue, $this->endu->formatPattern())) {
            $this->endu->addErrorMessage($this->endu->getErrorMessage(false));
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

        // location_id
        $this->location_id->setDbValueDef($rsnew, $this->location_id->CurrentValue, 0, false);

        // meal_details_id
        $this->meal_details_id->setDbValueDef($rsnew, $this->meal_details_id->CurrentValue, 0, false);

        // startm
        $this->startm->setDbValueDef($rsnew, UnFormatDateTime($this->startm->CurrentValue, $this->startm->formatPattern()), null, false);

        // endm
        $this->endm->setDbValueDef($rsnew, UnFormatDateTime($this->endm->CurrentValue, $this->endm->formatPattern()), null, false);

        // startt
        $this->startt->setDbValueDef($rsnew, UnFormatDateTime($this->startt->CurrentValue, $this->startt->formatPattern()), null, false);

        // endt
        $this->endt->setDbValueDef($rsnew, UnFormatDateTime($this->endt->CurrentValue, $this->endt->formatPattern()), null, false);

        // startw
        $this->startw->setDbValueDef($rsnew, UnFormatDateTime($this->startw->CurrentValue, $this->startw->formatPattern()), null, false);

        // endw
        $this->endw->setDbValueDef($rsnew, UnFormatDateTime($this->endw->CurrentValue, $this->endw->formatPattern()), null, false);

        // startr
        $this->startr->setDbValueDef($rsnew, UnFormatDateTime($this->startr->CurrentValue, $this->startr->formatPattern()), null, false);

        // endr
        $this->endr->setDbValueDef($rsnew, UnFormatDateTime($this->endr->CurrentValue, $this->endr->formatPattern()), null, false);

        // startf
        $this->startf->setDbValueDef($rsnew, UnFormatDateTime($this->startf->CurrentValue, $this->startf->formatPattern()), null, false);

        // endf
        $this->endf->setDbValueDef($rsnew, UnFormatDateTime($this->endf->CurrentValue, $this->endf->formatPattern()), null, false);

        // starts
        $this->starts->setDbValueDef($rsnew, UnFormatDateTime($this->starts->CurrentValue, $this->starts->formatPattern()), null, false);

        // ends
        $this->ends->setDbValueDef($rsnew, UnFormatDateTime($this->ends->CurrentValue, $this->ends->formatPattern()), null, false);

        // startu
        $this->startu->setDbValueDef($rsnew, UnFormatDateTime($this->startu->CurrentValue, $this->startu->formatPattern()), null, false);

        // endu
        $this->endu->setDbValueDef($rsnew, UnFormatDateTime($this->endu->CurrentValue, $this->endu->formatPattern()), null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MealTimesList"), "", $this->TableVar, true);
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
