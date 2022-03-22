<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class CateringHighlandBurritoAdd extends CateringHighlandBurrito
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'catering_highland_burrito';

    // Page object name
    public $PageObjName = "CateringHighlandBurritoAdd";

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

        // Table object (catering_highland_burrito)
        if (!isset($GLOBALS["catering_highland_burrito"]) || get_class($GLOBALS["catering_highland_burrito"]) == PROJECT_NAMESPACE . "catering_highland_burrito") {
            $GLOBALS["catering_highland_burrito"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'catering_highland_burrito');
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
                $doc = new $class(Container("catering_highland_burrito"));
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
                    if ($pageName == "CateringHighlandBurritoView") {
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
        $this->catering_id->setVisibility();
        $this->pack->setVisibility();
        $this->pack_num->setVisibility();
        $this->burrito_num->setVisibility();
        $this->meat_1->setVisibility();
        $this->meat_2->setVisibility();
        $this->meat_3->setVisibility();
        $this->meat_4->setVisibility();
        $this->vege_1->setVisibility();
        $this->vege_2->setVisibility();
        $this->vege_3->setVisibility();
        $this->vege_4->setVisibility();
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
                    $this->terminate("CateringHighlandBurritoList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "CateringHighlandBurritoList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "CateringHighlandBurritoView") {
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
        $this->catering_id->CurrentValue = null;
        $this->catering_id->OldValue = $this->catering_id->CurrentValue;
        $this->pack->CurrentValue = null;
        $this->pack->OldValue = $this->pack->CurrentValue;
        $this->pack_num->CurrentValue = null;
        $this->pack_num->OldValue = $this->pack_num->CurrentValue;
        $this->burrito_num->CurrentValue = null;
        $this->burrito_num->OldValue = $this->burrito_num->CurrentValue;
        $this->meat_1->CurrentValue = null;
        $this->meat_1->OldValue = $this->meat_1->CurrentValue;
        $this->meat_2->CurrentValue = null;
        $this->meat_2->OldValue = $this->meat_2->CurrentValue;
        $this->meat_3->CurrentValue = null;
        $this->meat_3->OldValue = $this->meat_3->CurrentValue;
        $this->meat_4->CurrentValue = null;
        $this->meat_4->OldValue = $this->meat_4->CurrentValue;
        $this->vege_1->CurrentValue = null;
        $this->vege_1->OldValue = $this->vege_1->CurrentValue;
        $this->vege_2->CurrentValue = null;
        $this->vege_2->OldValue = $this->vege_2->CurrentValue;
        $this->vege_3->CurrentValue = null;
        $this->vege_3->OldValue = $this->vege_3->CurrentValue;
        $this->vege_4->CurrentValue = null;
        $this->vege_4->OldValue = $this->vege_4->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'catering_id' first before field var 'x_catering_id'
        $val = $CurrentForm->hasValue("catering_id") ? $CurrentForm->getValue("catering_id") : $CurrentForm->getValue("x_catering_id");
        if (!$this->catering_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->catering_id->Visible = false; // Disable update for API request
            } else {
                $this->catering_id->setFormValue($val);
            }
        }

        // Check field name 'pack' first before field var 'x_pack'
        $val = $CurrentForm->hasValue("pack") ? $CurrentForm->getValue("pack") : $CurrentForm->getValue("x_pack");
        if (!$this->pack->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pack->Visible = false; // Disable update for API request
            } else {
                $this->pack->setFormValue($val);
            }
        }

        // Check field name 'pack_num' first before field var 'x_pack_num'
        $val = $CurrentForm->hasValue("pack_num") ? $CurrentForm->getValue("pack_num") : $CurrentForm->getValue("x_pack_num");
        if (!$this->pack_num->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pack_num->Visible = false; // Disable update for API request
            } else {
                $this->pack_num->setFormValue($val);
            }
        }

        // Check field name 'burrito_num' first before field var 'x_burrito_num'
        $val = $CurrentForm->hasValue("burrito_num") ? $CurrentForm->getValue("burrito_num") : $CurrentForm->getValue("x_burrito_num");
        if (!$this->burrito_num->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->burrito_num->Visible = false; // Disable update for API request
            } else {
                $this->burrito_num->setFormValue($val);
            }
        }

        // Check field name 'meat_1' first before field var 'x_meat_1'
        $val = $CurrentForm->hasValue("meat_1") ? $CurrentForm->getValue("meat_1") : $CurrentForm->getValue("x_meat_1");
        if (!$this->meat_1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meat_1->Visible = false; // Disable update for API request
            } else {
                $this->meat_1->setFormValue($val);
            }
        }

        // Check field name 'meat_2' first before field var 'x_meat_2'
        $val = $CurrentForm->hasValue("meat_2") ? $CurrentForm->getValue("meat_2") : $CurrentForm->getValue("x_meat_2");
        if (!$this->meat_2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meat_2->Visible = false; // Disable update for API request
            } else {
                $this->meat_2->setFormValue($val);
            }
        }

        // Check field name 'meat_3' first before field var 'x_meat_3'
        $val = $CurrentForm->hasValue("meat_3") ? $CurrentForm->getValue("meat_3") : $CurrentForm->getValue("x_meat_3");
        if (!$this->meat_3->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meat_3->Visible = false; // Disable update for API request
            } else {
                $this->meat_3->setFormValue($val);
            }
        }

        // Check field name 'meat_4' first before field var 'x_meat_4'
        $val = $CurrentForm->hasValue("meat_4") ? $CurrentForm->getValue("meat_4") : $CurrentForm->getValue("x_meat_4");
        if (!$this->meat_4->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meat_4->Visible = false; // Disable update for API request
            } else {
                $this->meat_4->setFormValue($val);
            }
        }

        // Check field name 'vege_1' first before field var 'x_vege_1'
        $val = $CurrentForm->hasValue("vege_1") ? $CurrentForm->getValue("vege_1") : $CurrentForm->getValue("x_vege_1");
        if (!$this->vege_1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->vege_1->Visible = false; // Disable update for API request
            } else {
                $this->vege_1->setFormValue($val);
            }
        }

        // Check field name 'vege_2' first before field var 'x_vege_2'
        $val = $CurrentForm->hasValue("vege_2") ? $CurrentForm->getValue("vege_2") : $CurrentForm->getValue("x_vege_2");
        if (!$this->vege_2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->vege_2->Visible = false; // Disable update for API request
            } else {
                $this->vege_2->setFormValue($val);
            }
        }

        // Check field name 'vege_3' first before field var 'x_vege_3'
        $val = $CurrentForm->hasValue("vege_3") ? $CurrentForm->getValue("vege_3") : $CurrentForm->getValue("x_vege_3");
        if (!$this->vege_3->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->vege_3->Visible = false; // Disable update for API request
            } else {
                $this->vege_3->setFormValue($val);
            }
        }

        // Check field name 'vege_4' first before field var 'x_vege_4'
        $val = $CurrentForm->hasValue("vege_4") ? $CurrentForm->getValue("vege_4") : $CurrentForm->getValue("x_vege_4");
        if (!$this->vege_4->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->vege_4->Visible = false; // Disable update for API request
            } else {
                $this->vege_4->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->catering_id->CurrentValue = $this->catering_id->FormValue;
        $this->pack->CurrentValue = $this->pack->FormValue;
        $this->pack_num->CurrentValue = $this->pack_num->FormValue;
        $this->burrito_num->CurrentValue = $this->burrito_num->FormValue;
        $this->meat_1->CurrentValue = $this->meat_1->FormValue;
        $this->meat_2->CurrentValue = $this->meat_2->FormValue;
        $this->meat_3->CurrentValue = $this->meat_3->FormValue;
        $this->meat_4->CurrentValue = $this->meat_4->FormValue;
        $this->vege_1->CurrentValue = $this->vege_1->FormValue;
        $this->vege_2->CurrentValue = $this->vege_2->FormValue;
        $this->vege_3->CurrentValue = $this->vege_3->FormValue;
        $this->vege_4->CurrentValue = $this->vege_4->FormValue;
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
        $this->catering_id->setDbValue($row['catering_id']);
        $this->pack->setDbValue($row['pack']);
        $this->pack_num->setDbValue($row['pack_num']);
        $this->burrito_num->setDbValue($row['burrito_num']);
        $this->meat_1->setDbValue($row['meat_1']);
        $this->meat_2->setDbValue($row['meat_2']);
        $this->meat_3->setDbValue($row['meat_3']);
        $this->meat_4->setDbValue($row['meat_4']);
        $this->vege_1->setDbValue($row['vege_1']);
        $this->vege_2->setDbValue($row['vege_2']);
        $this->vege_3->setDbValue($row['vege_3']);
        $this->vege_4->setDbValue($row['vege_4']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['catering_id'] = $this->catering_id->CurrentValue;
        $row['pack'] = $this->pack->CurrentValue;
        $row['pack_num'] = $this->pack_num->CurrentValue;
        $row['burrito_num'] = $this->burrito_num->CurrentValue;
        $row['meat_1'] = $this->meat_1->CurrentValue;
        $row['meat_2'] = $this->meat_2->CurrentValue;
        $row['meat_3'] = $this->meat_3->CurrentValue;
        $row['meat_4'] = $this->meat_4->CurrentValue;
        $row['vege_1'] = $this->vege_1->CurrentValue;
        $row['vege_2'] = $this->vege_2->CurrentValue;
        $row['vege_3'] = $this->vege_3->CurrentValue;
        $row['vege_4'] = $this->vege_4->CurrentValue;
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

        // catering_id

        // pack

        // pack_num

        // burrito_num

        // meat_1

        // meat_2

        // meat_3

        // meat_4

        // vege_1

        // vege_2

        // vege_3

        // vege_4
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // catering_id
            $this->catering_id->ViewValue = $this->catering_id->CurrentValue;
            $this->catering_id->ViewValue = FormatNumber($this->catering_id->ViewValue, 0, -2, -2, -2);
            $this->catering_id->ViewCustomAttributes = "";

            // pack
            $this->pack->ViewValue = $this->pack->CurrentValue;
            $this->pack->ViewCustomAttributes = "";

            // pack_num
            $this->pack_num->ViewValue = $this->pack_num->CurrentValue;
            $this->pack_num->ViewValue = FormatNumber($this->pack_num->ViewValue, 0, -2, -2, -2);
            $this->pack_num->ViewCustomAttributes = "";

            // burrito_num
            $this->burrito_num->ViewValue = $this->burrito_num->CurrentValue;
            $this->burrito_num->ViewValue = FormatNumber($this->burrito_num->ViewValue, 0, -2, -2, -2);
            $this->burrito_num->ViewCustomAttributes = "";

            // meat_1
            $this->meat_1->ViewValue = $this->meat_1->CurrentValue;
            $this->meat_1->ViewCustomAttributes = "";

            // meat_2
            $this->meat_2->ViewValue = $this->meat_2->CurrentValue;
            $this->meat_2->ViewCustomAttributes = "";

            // meat_3
            $this->meat_3->ViewValue = $this->meat_3->CurrentValue;
            $this->meat_3->ViewCustomAttributes = "";

            // meat_4
            $this->meat_4->ViewValue = $this->meat_4->CurrentValue;
            $this->meat_4->ViewCustomAttributes = "";

            // vege_1
            $this->vege_1->ViewValue = $this->vege_1->CurrentValue;
            $this->vege_1->ViewCustomAttributes = "";

            // vege_2
            $this->vege_2->ViewValue = $this->vege_2->CurrentValue;
            $this->vege_2->ViewCustomAttributes = "";

            // vege_3
            $this->vege_3->ViewValue = $this->vege_3->CurrentValue;
            $this->vege_3->ViewCustomAttributes = "";

            // vege_4
            $this->vege_4->ViewValue = $this->vege_4->CurrentValue;
            $this->vege_4->ViewCustomAttributes = "";

            // catering_id
            $this->catering_id->LinkCustomAttributes = "";
            $this->catering_id->HrefValue = "";
            $this->catering_id->TooltipValue = "";

            // pack
            $this->pack->LinkCustomAttributes = "";
            $this->pack->HrefValue = "";
            $this->pack->TooltipValue = "";

            // pack_num
            $this->pack_num->LinkCustomAttributes = "";
            $this->pack_num->HrefValue = "";
            $this->pack_num->TooltipValue = "";

            // burrito_num
            $this->burrito_num->LinkCustomAttributes = "";
            $this->burrito_num->HrefValue = "";
            $this->burrito_num->TooltipValue = "";

            // meat_1
            $this->meat_1->LinkCustomAttributes = "";
            $this->meat_1->HrefValue = "";
            $this->meat_1->TooltipValue = "";

            // meat_2
            $this->meat_2->LinkCustomAttributes = "";
            $this->meat_2->HrefValue = "";
            $this->meat_2->TooltipValue = "";

            // meat_3
            $this->meat_3->LinkCustomAttributes = "";
            $this->meat_3->HrefValue = "";
            $this->meat_3->TooltipValue = "";

            // meat_4
            $this->meat_4->LinkCustomAttributes = "";
            $this->meat_4->HrefValue = "";
            $this->meat_4->TooltipValue = "";

            // vege_1
            $this->vege_1->LinkCustomAttributes = "";
            $this->vege_1->HrefValue = "";
            $this->vege_1->TooltipValue = "";

            // vege_2
            $this->vege_2->LinkCustomAttributes = "";
            $this->vege_2->HrefValue = "";
            $this->vege_2->TooltipValue = "";

            // vege_3
            $this->vege_3->LinkCustomAttributes = "";
            $this->vege_3->HrefValue = "";
            $this->vege_3->TooltipValue = "";

            // vege_4
            $this->vege_4->LinkCustomAttributes = "";
            $this->vege_4->HrefValue = "";
            $this->vege_4->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // catering_id
            $this->catering_id->EditAttrs["class"] = "form-control";
            $this->catering_id->EditCustomAttributes = "";
            $this->catering_id->EditValue = HtmlEncode($this->catering_id->CurrentValue);
            $this->catering_id->PlaceHolder = RemoveHtml($this->catering_id->caption());

            // pack
            $this->pack->EditAttrs["class"] = "form-control";
            $this->pack->EditCustomAttributes = "";
            if (!$this->pack->Raw) {
                $this->pack->CurrentValue = HtmlDecode($this->pack->CurrentValue);
            }
            $this->pack->EditValue = HtmlEncode($this->pack->CurrentValue);
            $this->pack->PlaceHolder = RemoveHtml($this->pack->caption());

            // pack_num
            $this->pack_num->EditAttrs["class"] = "form-control";
            $this->pack_num->EditCustomAttributes = "";
            $this->pack_num->EditValue = HtmlEncode($this->pack_num->CurrentValue);
            $this->pack_num->PlaceHolder = RemoveHtml($this->pack_num->caption());

            // burrito_num
            $this->burrito_num->EditAttrs["class"] = "form-control";
            $this->burrito_num->EditCustomAttributes = "";
            $this->burrito_num->EditValue = HtmlEncode($this->burrito_num->CurrentValue);
            $this->burrito_num->PlaceHolder = RemoveHtml($this->burrito_num->caption());

            // meat_1
            $this->meat_1->EditAttrs["class"] = "form-control";
            $this->meat_1->EditCustomAttributes = "";
            if (!$this->meat_1->Raw) {
                $this->meat_1->CurrentValue = HtmlDecode($this->meat_1->CurrentValue);
            }
            $this->meat_1->EditValue = HtmlEncode($this->meat_1->CurrentValue);
            $this->meat_1->PlaceHolder = RemoveHtml($this->meat_1->caption());

            // meat_2
            $this->meat_2->EditAttrs["class"] = "form-control";
            $this->meat_2->EditCustomAttributes = "";
            if (!$this->meat_2->Raw) {
                $this->meat_2->CurrentValue = HtmlDecode($this->meat_2->CurrentValue);
            }
            $this->meat_2->EditValue = HtmlEncode($this->meat_2->CurrentValue);
            $this->meat_2->PlaceHolder = RemoveHtml($this->meat_2->caption());

            // meat_3
            $this->meat_3->EditAttrs["class"] = "form-control";
            $this->meat_3->EditCustomAttributes = "";
            if (!$this->meat_3->Raw) {
                $this->meat_3->CurrentValue = HtmlDecode($this->meat_3->CurrentValue);
            }
            $this->meat_3->EditValue = HtmlEncode($this->meat_3->CurrentValue);
            $this->meat_3->PlaceHolder = RemoveHtml($this->meat_3->caption());

            // meat_4
            $this->meat_4->EditAttrs["class"] = "form-control";
            $this->meat_4->EditCustomAttributes = "";
            if (!$this->meat_4->Raw) {
                $this->meat_4->CurrentValue = HtmlDecode($this->meat_4->CurrentValue);
            }
            $this->meat_4->EditValue = HtmlEncode($this->meat_4->CurrentValue);
            $this->meat_4->PlaceHolder = RemoveHtml($this->meat_4->caption());

            // vege_1
            $this->vege_1->EditAttrs["class"] = "form-control";
            $this->vege_1->EditCustomAttributes = "";
            if (!$this->vege_1->Raw) {
                $this->vege_1->CurrentValue = HtmlDecode($this->vege_1->CurrentValue);
            }
            $this->vege_1->EditValue = HtmlEncode($this->vege_1->CurrentValue);
            $this->vege_1->PlaceHolder = RemoveHtml($this->vege_1->caption());

            // vege_2
            $this->vege_2->EditAttrs["class"] = "form-control";
            $this->vege_2->EditCustomAttributes = "";
            if (!$this->vege_2->Raw) {
                $this->vege_2->CurrentValue = HtmlDecode($this->vege_2->CurrentValue);
            }
            $this->vege_2->EditValue = HtmlEncode($this->vege_2->CurrentValue);
            $this->vege_2->PlaceHolder = RemoveHtml($this->vege_2->caption());

            // vege_3
            $this->vege_3->EditAttrs["class"] = "form-control";
            $this->vege_3->EditCustomAttributes = "";
            if (!$this->vege_3->Raw) {
                $this->vege_3->CurrentValue = HtmlDecode($this->vege_3->CurrentValue);
            }
            $this->vege_3->EditValue = HtmlEncode($this->vege_3->CurrentValue);
            $this->vege_3->PlaceHolder = RemoveHtml($this->vege_3->caption());

            // vege_4
            $this->vege_4->EditAttrs["class"] = "form-control";
            $this->vege_4->EditCustomAttributes = "";
            if (!$this->vege_4->Raw) {
                $this->vege_4->CurrentValue = HtmlDecode($this->vege_4->CurrentValue);
            }
            $this->vege_4->EditValue = HtmlEncode($this->vege_4->CurrentValue);
            $this->vege_4->PlaceHolder = RemoveHtml($this->vege_4->caption());

            // Add refer script

            // catering_id
            $this->catering_id->LinkCustomAttributes = "";
            $this->catering_id->HrefValue = "";

            // pack
            $this->pack->LinkCustomAttributes = "";
            $this->pack->HrefValue = "";

            // pack_num
            $this->pack_num->LinkCustomAttributes = "";
            $this->pack_num->HrefValue = "";

            // burrito_num
            $this->burrito_num->LinkCustomAttributes = "";
            $this->burrito_num->HrefValue = "";

            // meat_1
            $this->meat_1->LinkCustomAttributes = "";
            $this->meat_1->HrefValue = "";

            // meat_2
            $this->meat_2->LinkCustomAttributes = "";
            $this->meat_2->HrefValue = "";

            // meat_3
            $this->meat_3->LinkCustomAttributes = "";
            $this->meat_3->HrefValue = "";

            // meat_4
            $this->meat_4->LinkCustomAttributes = "";
            $this->meat_4->HrefValue = "";

            // vege_1
            $this->vege_1->LinkCustomAttributes = "";
            $this->vege_1->HrefValue = "";

            // vege_2
            $this->vege_2->LinkCustomAttributes = "";
            $this->vege_2->HrefValue = "";

            // vege_3
            $this->vege_3->LinkCustomAttributes = "";
            $this->vege_3->HrefValue = "";

            // vege_4
            $this->vege_4->LinkCustomAttributes = "";
            $this->vege_4->HrefValue = "";
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
        if ($this->catering_id->Required) {
            if (!$this->catering_id->IsDetailKey && EmptyValue($this->catering_id->FormValue)) {
                $this->catering_id->addErrorMessage(str_replace("%s", $this->catering_id->caption(), $this->catering_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->catering_id->FormValue)) {
            $this->catering_id->addErrorMessage($this->catering_id->getErrorMessage(false));
        }
        if ($this->pack->Required) {
            if (!$this->pack->IsDetailKey && EmptyValue($this->pack->FormValue)) {
                $this->pack->addErrorMessage(str_replace("%s", $this->pack->caption(), $this->pack->RequiredErrorMessage));
            }
        }
        if ($this->pack_num->Required) {
            if (!$this->pack_num->IsDetailKey && EmptyValue($this->pack_num->FormValue)) {
                $this->pack_num->addErrorMessage(str_replace("%s", $this->pack_num->caption(), $this->pack_num->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pack_num->FormValue)) {
            $this->pack_num->addErrorMessage($this->pack_num->getErrorMessage(false));
        }
        if ($this->burrito_num->Required) {
            if (!$this->burrito_num->IsDetailKey && EmptyValue($this->burrito_num->FormValue)) {
                $this->burrito_num->addErrorMessage(str_replace("%s", $this->burrito_num->caption(), $this->burrito_num->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->burrito_num->FormValue)) {
            $this->burrito_num->addErrorMessage($this->burrito_num->getErrorMessage(false));
        }
        if ($this->meat_1->Required) {
            if (!$this->meat_1->IsDetailKey && EmptyValue($this->meat_1->FormValue)) {
                $this->meat_1->addErrorMessage(str_replace("%s", $this->meat_1->caption(), $this->meat_1->RequiredErrorMessage));
            }
        }
        if ($this->meat_2->Required) {
            if (!$this->meat_2->IsDetailKey && EmptyValue($this->meat_2->FormValue)) {
                $this->meat_2->addErrorMessage(str_replace("%s", $this->meat_2->caption(), $this->meat_2->RequiredErrorMessage));
            }
        }
        if ($this->meat_3->Required) {
            if (!$this->meat_3->IsDetailKey && EmptyValue($this->meat_3->FormValue)) {
                $this->meat_3->addErrorMessage(str_replace("%s", $this->meat_3->caption(), $this->meat_3->RequiredErrorMessage));
            }
        }
        if ($this->meat_4->Required) {
            if (!$this->meat_4->IsDetailKey && EmptyValue($this->meat_4->FormValue)) {
                $this->meat_4->addErrorMessage(str_replace("%s", $this->meat_4->caption(), $this->meat_4->RequiredErrorMessage));
            }
        }
        if ($this->vege_1->Required) {
            if (!$this->vege_1->IsDetailKey && EmptyValue($this->vege_1->FormValue)) {
                $this->vege_1->addErrorMessage(str_replace("%s", $this->vege_1->caption(), $this->vege_1->RequiredErrorMessage));
            }
        }
        if ($this->vege_2->Required) {
            if (!$this->vege_2->IsDetailKey && EmptyValue($this->vege_2->FormValue)) {
                $this->vege_2->addErrorMessage(str_replace("%s", $this->vege_2->caption(), $this->vege_2->RequiredErrorMessage));
            }
        }
        if ($this->vege_3->Required) {
            if (!$this->vege_3->IsDetailKey && EmptyValue($this->vege_3->FormValue)) {
                $this->vege_3->addErrorMessage(str_replace("%s", $this->vege_3->caption(), $this->vege_3->RequiredErrorMessage));
            }
        }
        if ($this->vege_4->Required) {
            if (!$this->vege_4->IsDetailKey && EmptyValue($this->vege_4->FormValue)) {
                $this->vege_4->addErrorMessage(str_replace("%s", $this->vege_4->caption(), $this->vege_4->RequiredErrorMessage));
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

        // catering_id
        $this->catering_id->setDbValueDef($rsnew, $this->catering_id->CurrentValue, null, false);

        // pack
        $this->pack->setDbValueDef($rsnew, $this->pack->CurrentValue, null, false);

        // pack_num
        $this->pack_num->setDbValueDef($rsnew, $this->pack_num->CurrentValue, null, false);

        // burrito_num
        $this->burrito_num->setDbValueDef($rsnew, $this->burrito_num->CurrentValue, null, false);

        // meat_1
        $this->meat_1->setDbValueDef($rsnew, $this->meat_1->CurrentValue, null, false);

        // meat_2
        $this->meat_2->setDbValueDef($rsnew, $this->meat_2->CurrentValue, null, false);

        // meat_3
        $this->meat_3->setDbValueDef($rsnew, $this->meat_3->CurrentValue, null, false);

        // meat_4
        $this->meat_4->setDbValueDef($rsnew, $this->meat_4->CurrentValue, null, false);

        // vege_1
        $this->vege_1->setDbValueDef($rsnew, $this->vege_1->CurrentValue, null, false);

        // vege_2
        $this->vege_2->setDbValueDef($rsnew, $this->vege_2->CurrentValue, null, false);

        // vege_3
        $this->vege_3->setDbValueDef($rsnew, $this->vege_3->CurrentValue, null, false);

        // vege_4
        $this->vege_4->setDbValueDef($rsnew, $this->vege_4->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CateringHighlandBurritoList"), "", $this->TableVar, true);
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
