<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RestaurantsAdd extends Restaurants
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'restaurants';

    // Page object name
    public $PageObjName = "RestaurantsAdd";

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

        // Table object (restaurants)
        if (!isset($GLOBALS["restaurants"]) || get_class($GLOBALS["restaurants"]) == PROJECT_NAMESPACE . "restaurants") {
            $GLOBALS["restaurants"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'restaurants');
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
                $doc = new $class(Container("restaurants"));
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
                    if ($pageName == "RestaurantsView") {
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
        $this->location_id->setVisibility();
        $this->banner->setVisibility();
        $this->button_menu->setVisibility();
        $this->button_pdf->setVisibility();
        $this->button_catering->setVisibility();
        $this->button_form->setVisibility();
        $this->slides->setVisibility();
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
                    $this->terminate("RestaurantsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "RestaurantsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "RestaurantsView") {
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
        $this->location_id->CurrentValue = null;
        $this->location_id->OldValue = $this->location_id->CurrentValue;
        $this->banner->CurrentValue = null;
        $this->banner->OldValue = $this->banner->CurrentValue;
        $this->button_menu->CurrentValue = null;
        $this->button_menu->OldValue = $this->button_menu->CurrentValue;
        $this->button_pdf->CurrentValue = null;
        $this->button_pdf->OldValue = $this->button_pdf->CurrentValue;
        $this->button_catering->CurrentValue = null;
        $this->button_catering->OldValue = $this->button_catering->CurrentValue;
        $this->button_form->CurrentValue = null;
        $this->button_form->OldValue = $this->button_form->CurrentValue;
        $this->slides->CurrentValue = 0;
        $this->timestamp->CurrentValue = null;
        $this->timestamp->OldValue = $this->timestamp->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'location_id' first before field var 'x_location_id'
        $val = $CurrentForm->hasValue("location_id") ? $CurrentForm->getValue("location_id") : $CurrentForm->getValue("x_location_id");
        if (!$this->location_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_id->Visible = false; // Disable update for API request
            } else {
                $this->location_id->setFormValue($val);
            }
        }

        // Check field name 'banner' first before field var 'x_banner'
        $val = $CurrentForm->hasValue("banner") ? $CurrentForm->getValue("banner") : $CurrentForm->getValue("x_banner");
        if (!$this->banner->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->banner->Visible = false; // Disable update for API request
            } else {
                $this->banner->setFormValue($val);
            }
        }

        // Check field name 'button_menu' first before field var 'x_button_menu'
        $val = $CurrentForm->hasValue("button_menu") ? $CurrentForm->getValue("button_menu") : $CurrentForm->getValue("x_button_menu");
        if (!$this->button_menu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->button_menu->Visible = false; // Disable update for API request
            } else {
                $this->button_menu->setFormValue($val);
            }
        }

        // Check field name 'button_pdf' first before field var 'x_button_pdf'
        $val = $CurrentForm->hasValue("button_pdf") ? $CurrentForm->getValue("button_pdf") : $CurrentForm->getValue("x_button_pdf");
        if (!$this->button_pdf->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->button_pdf->Visible = false; // Disable update for API request
            } else {
                $this->button_pdf->setFormValue($val);
            }
        }

        // Check field name 'button_catering' first before field var 'x_button_catering'
        $val = $CurrentForm->hasValue("button_catering") ? $CurrentForm->getValue("button_catering") : $CurrentForm->getValue("x_button_catering");
        if (!$this->button_catering->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->button_catering->Visible = false; // Disable update for API request
            } else {
                $this->button_catering->setFormValue($val);
            }
        }

        // Check field name 'button_form' first before field var 'x_button_form'
        $val = $CurrentForm->hasValue("button_form") ? $CurrentForm->getValue("button_form") : $CurrentForm->getValue("x_button_form");
        if (!$this->button_form->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->button_form->Visible = false; // Disable update for API request
            } else {
                $this->button_form->setFormValue($val);
            }
        }

        // Check field name 'slides' first before field var 'x_slides'
        $val = $CurrentForm->hasValue("slides") ? $CurrentForm->getValue("slides") : $CurrentForm->getValue("x_slides");
        if (!$this->slides->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->slides->Visible = false; // Disable update for API request
            } else {
                $this->slides->setFormValue($val);
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
        $this->location_id->CurrentValue = $this->location_id->FormValue;
        $this->banner->CurrentValue = $this->banner->FormValue;
        $this->button_menu->CurrentValue = $this->button_menu->FormValue;
        $this->button_pdf->CurrentValue = $this->button_pdf->FormValue;
        $this->button_catering->CurrentValue = $this->button_catering->FormValue;
        $this->button_form->CurrentValue = $this->button_form->FormValue;
        $this->slides->CurrentValue = $this->slides->FormValue;
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
        $this->location_id->setDbValue($row['location_id']);
        $this->banner->setDbValue($row['banner']);
        $this->button_menu->setDbValue($row['button_menu']);
        $this->button_pdf->setDbValue($row['button_pdf']);
        $this->button_catering->setDbValue($row['button_catering']);
        $this->button_form->setDbValue($row['button_form']);
        $this->slides->setDbValue($row['slides']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['location_id'] = $this->location_id->CurrentValue;
        $row['banner'] = $this->banner->CurrentValue;
        $row['button_menu'] = $this->button_menu->CurrentValue;
        $row['button_pdf'] = $this->button_pdf->CurrentValue;
        $row['button_catering'] = $this->button_catering->CurrentValue;
        $row['button_form'] = $this->button_form->CurrentValue;
        $row['slides'] = $this->slides->CurrentValue;
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

        // location_id

        // banner

        // button_menu

        // button_pdf

        // button_catering

        // button_form

        // slides

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location_id
            $this->location_id->ViewValue = $this->location_id->CurrentValue;
            $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, 0, -2, -2, -2);
            $this->location_id->ViewCustomAttributes = "";

            // banner
            $this->banner->ViewValue = $this->banner->CurrentValue;
            $this->banner->ViewCustomAttributes = "";

            // button_menu
            $this->button_menu->ViewValue = $this->button_menu->CurrentValue;
            $this->button_menu->ViewCustomAttributes = "";

            // button_pdf
            $this->button_pdf->ViewValue = $this->button_pdf->CurrentValue;
            $this->button_pdf->ViewCustomAttributes = "";

            // button_catering
            $this->button_catering->ViewValue = $this->button_catering->CurrentValue;
            $this->button_catering->ViewCustomAttributes = "";

            // button_form
            $this->button_form->ViewValue = $this->button_form->CurrentValue;
            $this->button_form->ViewCustomAttributes = "";

            // slides
            $this->slides->ViewValue = $this->slides->CurrentValue;
            $this->slides->ViewValue = FormatNumber($this->slides->ViewValue, 0, -2, -2, -2);
            $this->slides->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";
            $this->location_id->TooltipValue = "";

            // banner
            $this->banner->LinkCustomAttributes = "";
            $this->banner->HrefValue = "";
            $this->banner->TooltipValue = "";

            // button_menu
            $this->button_menu->LinkCustomAttributes = "";
            $this->button_menu->HrefValue = "";
            $this->button_menu->TooltipValue = "";

            // button_pdf
            $this->button_pdf->LinkCustomAttributes = "";
            $this->button_pdf->HrefValue = "";
            $this->button_pdf->TooltipValue = "";

            // button_catering
            $this->button_catering->LinkCustomAttributes = "";
            $this->button_catering->HrefValue = "";
            $this->button_catering->TooltipValue = "";

            // button_form
            $this->button_form->LinkCustomAttributes = "";
            $this->button_form->HrefValue = "";
            $this->button_form->TooltipValue = "";

            // slides
            $this->slides->LinkCustomAttributes = "";
            $this->slides->HrefValue = "";
            $this->slides->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // location_id
            $this->location_id->EditAttrs["class"] = "form-control";
            $this->location_id->EditCustomAttributes = "";
            $this->location_id->EditValue = HtmlEncode($this->location_id->CurrentValue);
            $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());

            // banner
            $this->banner->EditAttrs["class"] = "form-control";
            $this->banner->EditCustomAttributes = "";
            if (!$this->banner->Raw) {
                $this->banner->CurrentValue = HtmlDecode($this->banner->CurrentValue);
            }
            $this->banner->EditValue = HtmlEncode($this->banner->CurrentValue);
            $this->banner->PlaceHolder = RemoveHtml($this->banner->caption());

            // button_menu
            $this->button_menu->EditAttrs["class"] = "form-control";
            $this->button_menu->EditCustomAttributes = "";
            if (!$this->button_menu->Raw) {
                $this->button_menu->CurrentValue = HtmlDecode($this->button_menu->CurrentValue);
            }
            $this->button_menu->EditValue = HtmlEncode($this->button_menu->CurrentValue);
            $this->button_menu->PlaceHolder = RemoveHtml($this->button_menu->caption());

            // button_pdf
            $this->button_pdf->EditAttrs["class"] = "form-control";
            $this->button_pdf->EditCustomAttributes = "";
            if (!$this->button_pdf->Raw) {
                $this->button_pdf->CurrentValue = HtmlDecode($this->button_pdf->CurrentValue);
            }
            $this->button_pdf->EditValue = HtmlEncode($this->button_pdf->CurrentValue);
            $this->button_pdf->PlaceHolder = RemoveHtml($this->button_pdf->caption());

            // button_catering
            $this->button_catering->EditAttrs["class"] = "form-control";
            $this->button_catering->EditCustomAttributes = "";
            if (!$this->button_catering->Raw) {
                $this->button_catering->CurrentValue = HtmlDecode($this->button_catering->CurrentValue);
            }
            $this->button_catering->EditValue = HtmlEncode($this->button_catering->CurrentValue);
            $this->button_catering->PlaceHolder = RemoveHtml($this->button_catering->caption());

            // button_form
            $this->button_form->EditAttrs["class"] = "form-control";
            $this->button_form->EditCustomAttributes = "";
            if (!$this->button_form->Raw) {
                $this->button_form->CurrentValue = HtmlDecode($this->button_form->CurrentValue);
            }
            $this->button_form->EditValue = HtmlEncode($this->button_form->CurrentValue);
            $this->button_form->PlaceHolder = RemoveHtml($this->button_form->caption());

            // slides
            $this->slides->EditAttrs["class"] = "form-control";
            $this->slides->EditCustomAttributes = "";
            $this->slides->EditValue = HtmlEncode($this->slides->CurrentValue);
            $this->slides->PlaceHolder = RemoveHtml($this->slides->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Add refer script

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";

            // banner
            $this->banner->LinkCustomAttributes = "";
            $this->banner->HrefValue = "";

            // button_menu
            $this->button_menu->LinkCustomAttributes = "";
            $this->button_menu->HrefValue = "";

            // button_pdf
            $this->button_pdf->LinkCustomAttributes = "";
            $this->button_pdf->HrefValue = "";

            // button_catering
            $this->button_catering->LinkCustomAttributes = "";
            $this->button_catering->HrefValue = "";

            // button_form
            $this->button_form->LinkCustomAttributes = "";
            $this->button_form->HrefValue = "";

            // slides
            $this->slides->LinkCustomAttributes = "";
            $this->slides->HrefValue = "";

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
        if ($this->location_id->Required) {
            if (!$this->location_id->IsDetailKey && EmptyValue($this->location_id->FormValue)) {
                $this->location_id->addErrorMessage(str_replace("%s", $this->location_id->caption(), $this->location_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->location_id->FormValue)) {
            $this->location_id->addErrorMessage($this->location_id->getErrorMessage(false));
        }
        if ($this->banner->Required) {
            if (!$this->banner->IsDetailKey && EmptyValue($this->banner->FormValue)) {
                $this->banner->addErrorMessage(str_replace("%s", $this->banner->caption(), $this->banner->RequiredErrorMessage));
            }
        }
        if ($this->button_menu->Required) {
            if (!$this->button_menu->IsDetailKey && EmptyValue($this->button_menu->FormValue)) {
                $this->button_menu->addErrorMessage(str_replace("%s", $this->button_menu->caption(), $this->button_menu->RequiredErrorMessage));
            }
        }
        if ($this->button_pdf->Required) {
            if (!$this->button_pdf->IsDetailKey && EmptyValue($this->button_pdf->FormValue)) {
                $this->button_pdf->addErrorMessage(str_replace("%s", $this->button_pdf->caption(), $this->button_pdf->RequiredErrorMessage));
            }
        }
        if ($this->button_catering->Required) {
            if (!$this->button_catering->IsDetailKey && EmptyValue($this->button_catering->FormValue)) {
                $this->button_catering->addErrorMessage(str_replace("%s", $this->button_catering->caption(), $this->button_catering->RequiredErrorMessage));
            }
        }
        if ($this->button_form->Required) {
            if (!$this->button_form->IsDetailKey && EmptyValue($this->button_form->FormValue)) {
                $this->button_form->addErrorMessage(str_replace("%s", $this->button_form->caption(), $this->button_form->RequiredErrorMessage));
            }
        }
        if ($this->slides->Required) {
            if (!$this->slides->IsDetailKey && EmptyValue($this->slides->FormValue)) {
                $this->slides->addErrorMessage(str_replace("%s", $this->slides->caption(), $this->slides->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->slides->FormValue)) {
            $this->slides->addErrorMessage($this->slides->getErrorMessage(false));
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

        // location_id
        $this->location_id->setDbValueDef($rsnew, $this->location_id->CurrentValue, null, false);

        // banner
        $this->banner->setDbValueDef($rsnew, $this->banner->CurrentValue, null, false);

        // button_menu
        $this->button_menu->setDbValueDef($rsnew, $this->button_menu->CurrentValue, null, false);

        // button_pdf
        $this->button_pdf->setDbValueDef($rsnew, $this->button_pdf->CurrentValue, null, false);

        // button_catering
        $this->button_catering->setDbValueDef($rsnew, $this->button_catering->CurrentValue, null, false);

        // button_form
        $this->button_form->setDbValueDef($rsnew, $this->button_form->CurrentValue, null, false);

        // slides
        $this->slides->setDbValueDef($rsnew, $this->slides->CurrentValue, null, strval($this->slides->CurrentValue) == "");

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("RestaurantsList"), "", $this->TableVar, true);
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
