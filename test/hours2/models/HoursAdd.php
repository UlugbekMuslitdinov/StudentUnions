<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class HoursAdd extends Hours
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'hours';

    // Page object name
    public $PageObjName = "HoursAdd";

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

        // Table object (hours)
        if (!isset($GLOBALS["hours"]) || get_class($GLOBALS["hours"]) == PROJECT_NAMESPACE . "hours") {
            $GLOBALS["hours"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'hours');
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
                $tbl = Container("hours");
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
                    if ($pageName == "HoursView") {
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
        $this->location_id->setVisibility();
        $this->openm->setVisibility();
        $this->closem->setVisibility();
        $this->opent->setVisibility();
        $this->closet->setVisibility();
        $this->openw->setVisibility();
        $this->closew->setVisibility();
        $this->openr->setVisibility();
        $this->closer->setVisibility();
        $this->openf->setVisibility();
        $this->closef->setVisibility();
        $this->opens->setVisibility();
        $this->closes->setVisibility();
        $this->openu->setVisibility();
        $this->closeu->setVisibility();
        $this->type->setVisibility();
        $this->id->Visible = false;
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
        $this->setupLookupOptions($this->type);

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
                    $this->terminate("HoursList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "HoursList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "HoursView") {
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
        $this->location_id->CurrentValue = null;
        $this->location_id->OldValue = $this->location_id->CurrentValue;
        $this->openm->CurrentValue = "00:00:00";
        $this->closem->CurrentValue = "00:00:00";
        $this->opent->CurrentValue = "00:00:00";
        $this->closet->CurrentValue = "00:00:00";
        $this->openw->CurrentValue = "00:00:00";
        $this->closew->CurrentValue = "00:00:00";
        $this->openr->CurrentValue = "00:00:00";
        $this->closer->CurrentValue = "00:00:00";
        $this->openf->CurrentValue = "00:00:00";
        $this->closef->CurrentValue = "00:00:00";
        $this->opens->CurrentValue = "00:00:00";
        $this->closes->CurrentValue = "00:00:00";
        $this->openu->CurrentValue = "00:00:00";
        $this->closeu->CurrentValue = "00:00:00";
        $this->type->CurrentValue = 1;
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
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

        // Check field name 'openm' first before field var 'x_openm'
        $val = $CurrentForm->hasValue("openm") ? $CurrentForm->getValue("openm") : $CurrentForm->getValue("x_openm");
        if (!$this->openm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->openm->Visible = false; // Disable update for API request
            } else {
                $this->openm->setFormValue($val, true, $validate);
            }
            $this->openm->CurrentValue = UnFormatDateTime($this->openm->CurrentValue, $this->openm->formatPattern());
        }

        // Check field name 'closem' first before field var 'x_closem'
        $val = $CurrentForm->hasValue("closem") ? $CurrentForm->getValue("closem") : $CurrentForm->getValue("x_closem");
        if (!$this->closem->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closem->Visible = false; // Disable update for API request
            } else {
                $this->closem->setFormValue($val, true, $validate);
            }
            $this->closem->CurrentValue = UnFormatDateTime($this->closem->CurrentValue, $this->closem->formatPattern());
        }

        // Check field name 'opent' first before field var 'x_opent'
        $val = $CurrentForm->hasValue("opent") ? $CurrentForm->getValue("opent") : $CurrentForm->getValue("x_opent");
        if (!$this->opent->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->opent->Visible = false; // Disable update for API request
            } else {
                $this->opent->setFormValue($val, true, $validate);
            }
            $this->opent->CurrentValue = UnFormatDateTime($this->opent->CurrentValue, $this->opent->formatPattern());
        }

        // Check field name 'closet' first before field var 'x_closet'
        $val = $CurrentForm->hasValue("closet") ? $CurrentForm->getValue("closet") : $CurrentForm->getValue("x_closet");
        if (!$this->closet->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closet->Visible = false; // Disable update for API request
            } else {
                $this->closet->setFormValue($val, true, $validate);
            }
            $this->closet->CurrentValue = UnFormatDateTime($this->closet->CurrentValue, $this->closet->formatPattern());
        }

        // Check field name 'openw' first before field var 'x_openw'
        $val = $CurrentForm->hasValue("openw") ? $CurrentForm->getValue("openw") : $CurrentForm->getValue("x_openw");
        if (!$this->openw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->openw->Visible = false; // Disable update for API request
            } else {
                $this->openw->setFormValue($val, true, $validate);
            }
            $this->openw->CurrentValue = UnFormatDateTime($this->openw->CurrentValue, $this->openw->formatPattern());
        }

        // Check field name 'closew' first before field var 'x_closew'
        $val = $CurrentForm->hasValue("closew") ? $CurrentForm->getValue("closew") : $CurrentForm->getValue("x_closew");
        if (!$this->closew->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closew->Visible = false; // Disable update for API request
            } else {
                $this->closew->setFormValue($val, true, $validate);
            }
            $this->closew->CurrentValue = UnFormatDateTime($this->closew->CurrentValue, $this->closew->formatPattern());
        }

        // Check field name 'openr' first before field var 'x_openr'
        $val = $CurrentForm->hasValue("openr") ? $CurrentForm->getValue("openr") : $CurrentForm->getValue("x_openr");
        if (!$this->openr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->openr->Visible = false; // Disable update for API request
            } else {
                $this->openr->setFormValue($val, true, $validate);
            }
            $this->openr->CurrentValue = UnFormatDateTime($this->openr->CurrentValue, $this->openr->formatPattern());
        }

        // Check field name 'closer' first before field var 'x_closer'
        $val = $CurrentForm->hasValue("closer") ? $CurrentForm->getValue("closer") : $CurrentForm->getValue("x_closer");
        if (!$this->closer->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closer->Visible = false; // Disable update for API request
            } else {
                $this->closer->setFormValue($val, true, $validate);
            }
            $this->closer->CurrentValue = UnFormatDateTime($this->closer->CurrentValue, $this->closer->formatPattern());
        }

        // Check field name 'openf' first before field var 'x_openf'
        $val = $CurrentForm->hasValue("openf") ? $CurrentForm->getValue("openf") : $CurrentForm->getValue("x_openf");
        if (!$this->openf->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->openf->Visible = false; // Disable update for API request
            } else {
                $this->openf->setFormValue($val, true, $validate);
            }
            $this->openf->CurrentValue = UnFormatDateTime($this->openf->CurrentValue, $this->openf->formatPattern());
        }

        // Check field name 'closef' first before field var 'x_closef'
        $val = $CurrentForm->hasValue("closef") ? $CurrentForm->getValue("closef") : $CurrentForm->getValue("x_closef");
        if (!$this->closef->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closef->Visible = false; // Disable update for API request
            } else {
                $this->closef->setFormValue($val, true, $validate);
            }
            $this->closef->CurrentValue = UnFormatDateTime($this->closef->CurrentValue, $this->closef->formatPattern());
        }

        // Check field name 'opens' first before field var 'x_opens'
        $val = $CurrentForm->hasValue("opens") ? $CurrentForm->getValue("opens") : $CurrentForm->getValue("x_opens");
        if (!$this->opens->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->opens->Visible = false; // Disable update for API request
            } else {
                $this->opens->setFormValue($val, true, $validate);
            }
            $this->opens->CurrentValue = UnFormatDateTime($this->opens->CurrentValue, $this->opens->formatPattern());
        }

        // Check field name 'closes' first before field var 'x_closes'
        $val = $CurrentForm->hasValue("closes") ? $CurrentForm->getValue("closes") : $CurrentForm->getValue("x_closes");
        if (!$this->closes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closes->Visible = false; // Disable update for API request
            } else {
                $this->closes->setFormValue($val, true, $validate);
            }
            $this->closes->CurrentValue = UnFormatDateTime($this->closes->CurrentValue, $this->closes->formatPattern());
        }

        // Check field name 'openu' first before field var 'x_openu'
        $val = $CurrentForm->hasValue("openu") ? $CurrentForm->getValue("openu") : $CurrentForm->getValue("x_openu");
        if (!$this->openu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->openu->Visible = false; // Disable update for API request
            } else {
                $this->openu->setFormValue($val, true, $validate);
            }
            $this->openu->CurrentValue = UnFormatDateTime($this->openu->CurrentValue, $this->openu->formatPattern());
        }

        // Check field name 'closeu' first before field var 'x_closeu'
        $val = $CurrentForm->hasValue("closeu") ? $CurrentForm->getValue("closeu") : $CurrentForm->getValue("x_closeu");
        if (!$this->closeu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closeu->Visible = false; // Disable update for API request
            } else {
                $this->closeu->setFormValue($val, true, $validate);
            }
            $this->closeu->CurrentValue = UnFormatDateTime($this->closeu->CurrentValue, $this->closeu->formatPattern());
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
        $this->location_id->CurrentValue = $this->location_id->FormValue;
        $this->openm->CurrentValue = $this->openm->FormValue;
        $this->openm->CurrentValue = UnFormatDateTime($this->openm->CurrentValue, $this->openm->formatPattern());
        $this->closem->CurrentValue = $this->closem->FormValue;
        $this->closem->CurrentValue = UnFormatDateTime($this->closem->CurrentValue, $this->closem->formatPattern());
        $this->opent->CurrentValue = $this->opent->FormValue;
        $this->opent->CurrentValue = UnFormatDateTime($this->opent->CurrentValue, $this->opent->formatPattern());
        $this->closet->CurrentValue = $this->closet->FormValue;
        $this->closet->CurrentValue = UnFormatDateTime($this->closet->CurrentValue, $this->closet->formatPattern());
        $this->openw->CurrentValue = $this->openw->FormValue;
        $this->openw->CurrentValue = UnFormatDateTime($this->openw->CurrentValue, $this->openw->formatPattern());
        $this->closew->CurrentValue = $this->closew->FormValue;
        $this->closew->CurrentValue = UnFormatDateTime($this->closew->CurrentValue, $this->closew->formatPattern());
        $this->openr->CurrentValue = $this->openr->FormValue;
        $this->openr->CurrentValue = UnFormatDateTime($this->openr->CurrentValue, $this->openr->formatPattern());
        $this->closer->CurrentValue = $this->closer->FormValue;
        $this->closer->CurrentValue = UnFormatDateTime($this->closer->CurrentValue, $this->closer->formatPattern());
        $this->openf->CurrentValue = $this->openf->FormValue;
        $this->openf->CurrentValue = UnFormatDateTime($this->openf->CurrentValue, $this->openf->formatPattern());
        $this->closef->CurrentValue = $this->closef->FormValue;
        $this->closef->CurrentValue = UnFormatDateTime($this->closef->CurrentValue, $this->closef->formatPattern());
        $this->opens->CurrentValue = $this->opens->FormValue;
        $this->opens->CurrentValue = UnFormatDateTime($this->opens->CurrentValue, $this->opens->formatPattern());
        $this->closes->CurrentValue = $this->closes->FormValue;
        $this->closes->CurrentValue = UnFormatDateTime($this->closes->CurrentValue, $this->closes->formatPattern());
        $this->openu->CurrentValue = $this->openu->FormValue;
        $this->openu->CurrentValue = UnFormatDateTime($this->openu->CurrentValue, $this->openu->formatPattern());
        $this->closeu->CurrentValue = $this->closeu->FormValue;
        $this->closeu->CurrentValue = UnFormatDateTime($this->closeu->CurrentValue, $this->closeu->formatPattern());
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
        $this->location_id->setDbValue($row['location_id']);
        $this->openm->setDbValue($row['openm']);
        $this->closem->setDbValue($row['closem']);
        $this->opent->setDbValue($row['opent']);
        $this->closet->setDbValue($row['closet']);
        $this->openw->setDbValue($row['openw']);
        $this->closew->setDbValue($row['closew']);
        $this->openr->setDbValue($row['openr']);
        $this->closer->setDbValue($row['closer']);
        $this->openf->setDbValue($row['openf']);
        $this->closef->setDbValue($row['closef']);
        $this->opens->setDbValue($row['opens']);
        $this->closes->setDbValue($row['closes']);
        $this->openu->setDbValue($row['openu']);
        $this->closeu->setDbValue($row['closeu']);
        $this->type->setDbValue($row['type']);
        $this->id->setDbValue($row['id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['location_id'] = $this->location_id->CurrentValue;
        $row['openm'] = $this->openm->CurrentValue;
        $row['closem'] = $this->closem->CurrentValue;
        $row['opent'] = $this->opent->CurrentValue;
        $row['closet'] = $this->closet->CurrentValue;
        $row['openw'] = $this->openw->CurrentValue;
        $row['closew'] = $this->closew->CurrentValue;
        $row['openr'] = $this->openr->CurrentValue;
        $row['closer'] = $this->closer->CurrentValue;
        $row['openf'] = $this->openf->CurrentValue;
        $row['closef'] = $this->closef->CurrentValue;
        $row['opens'] = $this->opens->CurrentValue;
        $row['closes'] = $this->closes->CurrentValue;
        $row['openu'] = $this->openu->CurrentValue;
        $row['closeu'] = $this->closeu->CurrentValue;
        $row['type'] = $this->type->CurrentValue;
        $row['id'] = $this->id->CurrentValue;
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

        // location_id
        $this->location_id->RowCssClass = "row";

        // openm
        $this->openm->RowCssClass = "row";

        // closem
        $this->closem->RowCssClass = "row";

        // opent
        $this->opent->RowCssClass = "row";

        // closet
        $this->closet->RowCssClass = "row";

        // openw
        $this->openw->RowCssClass = "row";

        // closew
        $this->closew->RowCssClass = "row";

        // openr
        $this->openr->RowCssClass = "row";

        // closer
        $this->closer->RowCssClass = "row";

        // openf
        $this->openf->RowCssClass = "row";

        // closef
        $this->closef->RowCssClass = "row";

        // opens
        $this->opens->RowCssClass = "row";

        // closes
        $this->closes->RowCssClass = "row";

        // openu
        $this->openu->RowCssClass = "row";

        // closeu
        $this->closeu->RowCssClass = "row";

        // type
        $this->type->RowCssClass = "row";

        // id
        $this->id->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // location_id
            $this->location_id->ViewValue = $this->location_id->CurrentValue;
            $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, "");
            $this->location_id->ViewCustomAttributes = "";

            // openm
            $this->openm->ViewValue = $this->openm->CurrentValue;
            $this->openm->ViewValue = FormatDateTime($this->openm->ViewValue, 4);
            $this->openm->ViewCustomAttributes = "";

            // closem
            $this->closem->ViewValue = $this->closem->CurrentValue;
            $this->closem->ViewValue = FormatDateTime($this->closem->ViewValue, 4);
            $this->closem->ViewCustomAttributes = "";

            // opent
            $this->opent->ViewValue = $this->opent->CurrentValue;
            $this->opent->ViewValue = FormatDateTime($this->opent->ViewValue, 4);
            $this->opent->ViewCustomAttributes = "";

            // closet
            $this->closet->ViewValue = $this->closet->CurrentValue;
            $this->closet->ViewValue = FormatDateTime($this->closet->ViewValue, 4);
            $this->closet->ViewCustomAttributes = "";

            // openw
            $this->openw->ViewValue = $this->openw->CurrentValue;
            $this->openw->ViewValue = FormatDateTime($this->openw->ViewValue, 4);
            $this->openw->ViewCustomAttributes = "";

            // closew
            $this->closew->ViewValue = $this->closew->CurrentValue;
            $this->closew->ViewValue = FormatDateTime($this->closew->ViewValue, 4);
            $this->closew->ViewCustomAttributes = "";

            // openr
            $this->openr->ViewValue = $this->openr->CurrentValue;
            $this->openr->ViewValue = FormatDateTime($this->openr->ViewValue, 4);
            $this->openr->ViewCustomAttributes = "";

            // closer
            $this->closer->ViewValue = $this->closer->CurrentValue;
            $this->closer->ViewValue = FormatDateTime($this->closer->ViewValue, 4);
            $this->closer->ViewCustomAttributes = "";

            // openf
            $this->openf->ViewValue = $this->openf->CurrentValue;
            $this->openf->ViewValue = FormatDateTime($this->openf->ViewValue, 4);
            $this->openf->ViewCustomAttributes = "";

            // closef
            $this->closef->ViewValue = $this->closef->CurrentValue;
            $this->closef->ViewValue = FormatDateTime($this->closef->ViewValue, 4);
            $this->closef->ViewCustomAttributes = "";

            // opens
            $this->opens->ViewValue = $this->opens->CurrentValue;
            $this->opens->ViewValue = FormatDateTime($this->opens->ViewValue, 4);
            $this->opens->ViewCustomAttributes = "";

            // closes
            $this->closes->ViewValue = $this->closes->CurrentValue;
            $this->closes->ViewValue = FormatDateTime($this->closes->ViewValue, 4);
            $this->closes->ViewCustomAttributes = "";

            // openu
            $this->openu->ViewValue = $this->openu->CurrentValue;
            $this->openu->ViewValue = FormatDateTime($this->openu->ViewValue, 4);
            $this->openu->ViewCustomAttributes = "";

            // closeu
            $this->closeu->ViewValue = $this->closeu->CurrentValue;
            $this->closeu->ViewValue = FormatDateTime($this->closeu->ViewValue, 4);
            $this->closeu->ViewCustomAttributes = "";

            // type
            if (ConvertToBool($this->type->CurrentValue)) {
                $this->type->ViewValue = $this->type->tagCaption(1) != "" ? $this->type->tagCaption(1) : "Yes";
            } else {
                $this->type->ViewValue = $this->type->tagCaption(2) != "" ? $this->type->tagCaption(2) : "No";
            }
            $this->type->ViewCustomAttributes = "";

            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";

            // openm
            $this->openm->LinkCustomAttributes = "";
            $this->openm->HrefValue = "";

            // closem
            $this->closem->LinkCustomAttributes = "";
            $this->closem->HrefValue = "";

            // opent
            $this->opent->LinkCustomAttributes = "";
            $this->opent->HrefValue = "";

            // closet
            $this->closet->LinkCustomAttributes = "";
            $this->closet->HrefValue = "";

            // openw
            $this->openw->LinkCustomAttributes = "";
            $this->openw->HrefValue = "";

            // closew
            $this->closew->LinkCustomAttributes = "";
            $this->closew->HrefValue = "";

            // openr
            $this->openr->LinkCustomAttributes = "";
            $this->openr->HrefValue = "";

            // closer
            $this->closer->LinkCustomAttributes = "";
            $this->closer->HrefValue = "";

            // openf
            $this->openf->LinkCustomAttributes = "";
            $this->openf->HrefValue = "";

            // closef
            $this->closef->LinkCustomAttributes = "";
            $this->closef->HrefValue = "";

            // opens
            $this->opens->LinkCustomAttributes = "";
            $this->opens->HrefValue = "";

            // closes
            $this->closes->LinkCustomAttributes = "";
            $this->closes->HrefValue = "";

            // openu
            $this->openu->LinkCustomAttributes = "";
            $this->openu->HrefValue = "";

            // closeu
            $this->closeu->LinkCustomAttributes = "";
            $this->closeu->HrefValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // location_id
            $this->location_id->setupEditAttributes();
            $this->location_id->EditCustomAttributes = "";
            $this->location_id->EditValue = HtmlEncode($this->location_id->CurrentValue);
            $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());
            if (strval($this->location_id->EditValue) != "" && is_numeric($this->location_id->EditValue)) {
                $this->location_id->EditValue = FormatNumber($this->location_id->EditValue, null);
            }

            // openm
            $this->openm->setupEditAttributes();
            $this->openm->EditCustomAttributes = "";
            $this->openm->EditValue = HtmlEncode(FormatDateTime($this->openm->CurrentValue, 4));
            $this->openm->PlaceHolder = RemoveHtml($this->openm->caption());

            // closem
            $this->closem->setupEditAttributes();
            $this->closem->EditCustomAttributes = "";
            $this->closem->EditValue = HtmlEncode(FormatDateTime($this->closem->CurrentValue, 4));
            $this->closem->PlaceHolder = RemoveHtml($this->closem->caption());

            // opent
            $this->opent->setupEditAttributes();
            $this->opent->EditCustomAttributes = "";
            $this->opent->EditValue = HtmlEncode(FormatDateTime($this->opent->CurrentValue, 4));
            $this->opent->PlaceHolder = RemoveHtml($this->opent->caption());

            // closet
            $this->closet->setupEditAttributes();
            $this->closet->EditCustomAttributes = "";
            $this->closet->EditValue = HtmlEncode(FormatDateTime($this->closet->CurrentValue, 4));
            $this->closet->PlaceHolder = RemoveHtml($this->closet->caption());

            // openw
            $this->openw->setupEditAttributes();
            $this->openw->EditCustomAttributes = "";
            $this->openw->EditValue = HtmlEncode(FormatDateTime($this->openw->CurrentValue, 4));
            $this->openw->PlaceHolder = RemoveHtml($this->openw->caption());

            // closew
            $this->closew->setupEditAttributes();
            $this->closew->EditCustomAttributes = "";
            $this->closew->EditValue = HtmlEncode(FormatDateTime($this->closew->CurrentValue, 4));
            $this->closew->PlaceHolder = RemoveHtml($this->closew->caption());

            // openr
            $this->openr->setupEditAttributes();
            $this->openr->EditCustomAttributes = "";
            $this->openr->EditValue = HtmlEncode(FormatDateTime($this->openr->CurrentValue, 4));
            $this->openr->PlaceHolder = RemoveHtml($this->openr->caption());

            // closer
            $this->closer->setupEditAttributes();
            $this->closer->EditCustomAttributes = "";
            $this->closer->EditValue = HtmlEncode(FormatDateTime($this->closer->CurrentValue, 4));
            $this->closer->PlaceHolder = RemoveHtml($this->closer->caption());

            // openf
            $this->openf->setupEditAttributes();
            $this->openf->EditCustomAttributes = "";
            $this->openf->EditValue = HtmlEncode(FormatDateTime($this->openf->CurrentValue, 4));
            $this->openf->PlaceHolder = RemoveHtml($this->openf->caption());

            // closef
            $this->closef->setupEditAttributes();
            $this->closef->EditCustomAttributes = "";
            $this->closef->EditValue = HtmlEncode(FormatDateTime($this->closef->CurrentValue, 4));
            $this->closef->PlaceHolder = RemoveHtml($this->closef->caption());

            // opens
            $this->opens->setupEditAttributes();
            $this->opens->EditCustomAttributes = "";
            $this->opens->EditValue = HtmlEncode(FormatDateTime($this->opens->CurrentValue, 4));
            $this->opens->PlaceHolder = RemoveHtml($this->opens->caption());

            // closes
            $this->closes->setupEditAttributes();
            $this->closes->EditCustomAttributes = "";
            $this->closes->EditValue = HtmlEncode(FormatDateTime($this->closes->CurrentValue, 4));
            $this->closes->PlaceHolder = RemoveHtml($this->closes->caption());

            // openu
            $this->openu->setupEditAttributes();
            $this->openu->EditCustomAttributes = "";
            $this->openu->EditValue = HtmlEncode(FormatDateTime($this->openu->CurrentValue, 4));
            $this->openu->PlaceHolder = RemoveHtml($this->openu->caption());

            // closeu
            $this->closeu->setupEditAttributes();
            $this->closeu->EditCustomAttributes = "";
            $this->closeu->EditValue = HtmlEncode(FormatDateTime($this->closeu->CurrentValue, 4));
            $this->closeu->PlaceHolder = RemoveHtml($this->closeu->caption());

            // type
            $this->type->EditCustomAttributes = "";
            $this->type->EditValue = $this->type->options(false);
            $this->type->PlaceHolder = RemoveHtml($this->type->caption());

            // Add refer script

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";

            // openm
            $this->openm->LinkCustomAttributes = "";
            $this->openm->HrefValue = "";

            // closem
            $this->closem->LinkCustomAttributes = "";
            $this->closem->HrefValue = "";

            // opent
            $this->opent->LinkCustomAttributes = "";
            $this->opent->HrefValue = "";

            // closet
            $this->closet->LinkCustomAttributes = "";
            $this->closet->HrefValue = "";

            // openw
            $this->openw->LinkCustomAttributes = "";
            $this->openw->HrefValue = "";

            // closew
            $this->closew->LinkCustomAttributes = "";
            $this->closew->HrefValue = "";

            // openr
            $this->openr->LinkCustomAttributes = "";
            $this->openr->HrefValue = "";

            // closer
            $this->closer->LinkCustomAttributes = "";
            $this->closer->HrefValue = "";

            // openf
            $this->openf->LinkCustomAttributes = "";
            $this->openf->HrefValue = "";

            // closef
            $this->closef->LinkCustomAttributes = "";
            $this->closef->HrefValue = "";

            // opens
            $this->opens->LinkCustomAttributes = "";
            $this->opens->HrefValue = "";

            // closes
            $this->closes->LinkCustomAttributes = "";
            $this->closes->HrefValue = "";

            // openu
            $this->openu->LinkCustomAttributes = "";
            $this->openu->HrefValue = "";

            // closeu
            $this->closeu->LinkCustomAttributes = "";
            $this->closeu->HrefValue = "";

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
        $validateForm = true;
        if ($this->location_id->Required) {
            if (!$this->location_id->IsDetailKey && EmptyValue($this->location_id->FormValue)) {
                $this->location_id->addErrorMessage(str_replace("%s", $this->location_id->caption(), $this->location_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->location_id->FormValue)) {
            $this->location_id->addErrorMessage($this->location_id->getErrorMessage(false));
        }
        if ($this->openm->Required) {
            if (!$this->openm->IsDetailKey && EmptyValue($this->openm->FormValue)) {
                $this->openm->addErrorMessage(str_replace("%s", $this->openm->caption(), $this->openm->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->openm->FormValue, $this->openm->formatPattern())) {
            $this->openm->addErrorMessage($this->openm->getErrorMessage(false));
        }
        if ($this->closem->Required) {
            if (!$this->closem->IsDetailKey && EmptyValue($this->closem->FormValue)) {
                $this->closem->addErrorMessage(str_replace("%s", $this->closem->caption(), $this->closem->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closem->FormValue, $this->closem->formatPattern())) {
            $this->closem->addErrorMessage($this->closem->getErrorMessage(false));
        }
        if ($this->opent->Required) {
            if (!$this->opent->IsDetailKey && EmptyValue($this->opent->FormValue)) {
                $this->opent->addErrorMessage(str_replace("%s", $this->opent->caption(), $this->opent->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->opent->FormValue, $this->opent->formatPattern())) {
            $this->opent->addErrorMessage($this->opent->getErrorMessage(false));
        }
        if ($this->closet->Required) {
            if (!$this->closet->IsDetailKey && EmptyValue($this->closet->FormValue)) {
                $this->closet->addErrorMessage(str_replace("%s", $this->closet->caption(), $this->closet->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closet->FormValue, $this->closet->formatPattern())) {
            $this->closet->addErrorMessage($this->closet->getErrorMessage(false));
        }
        if ($this->openw->Required) {
            if (!$this->openw->IsDetailKey && EmptyValue($this->openw->FormValue)) {
                $this->openw->addErrorMessage(str_replace("%s", $this->openw->caption(), $this->openw->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->openw->FormValue, $this->openw->formatPattern())) {
            $this->openw->addErrorMessage($this->openw->getErrorMessage(false));
        }
        if ($this->closew->Required) {
            if (!$this->closew->IsDetailKey && EmptyValue($this->closew->FormValue)) {
                $this->closew->addErrorMessage(str_replace("%s", $this->closew->caption(), $this->closew->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closew->FormValue, $this->closew->formatPattern())) {
            $this->closew->addErrorMessage($this->closew->getErrorMessage(false));
        }
        if ($this->openr->Required) {
            if (!$this->openr->IsDetailKey && EmptyValue($this->openr->FormValue)) {
                $this->openr->addErrorMessage(str_replace("%s", $this->openr->caption(), $this->openr->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->openr->FormValue, $this->openr->formatPattern())) {
            $this->openr->addErrorMessage($this->openr->getErrorMessage(false));
        }
        if ($this->closer->Required) {
            if (!$this->closer->IsDetailKey && EmptyValue($this->closer->FormValue)) {
                $this->closer->addErrorMessage(str_replace("%s", $this->closer->caption(), $this->closer->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closer->FormValue, $this->closer->formatPattern())) {
            $this->closer->addErrorMessage($this->closer->getErrorMessage(false));
        }
        if ($this->openf->Required) {
            if (!$this->openf->IsDetailKey && EmptyValue($this->openf->FormValue)) {
                $this->openf->addErrorMessage(str_replace("%s", $this->openf->caption(), $this->openf->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->openf->FormValue, $this->openf->formatPattern())) {
            $this->openf->addErrorMessage($this->openf->getErrorMessage(false));
        }
        if ($this->closef->Required) {
            if (!$this->closef->IsDetailKey && EmptyValue($this->closef->FormValue)) {
                $this->closef->addErrorMessage(str_replace("%s", $this->closef->caption(), $this->closef->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closef->FormValue, $this->closef->formatPattern())) {
            $this->closef->addErrorMessage($this->closef->getErrorMessage(false));
        }
        if ($this->opens->Required) {
            if (!$this->opens->IsDetailKey && EmptyValue($this->opens->FormValue)) {
                $this->opens->addErrorMessage(str_replace("%s", $this->opens->caption(), $this->opens->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->opens->FormValue, $this->opens->formatPattern())) {
            $this->opens->addErrorMessage($this->opens->getErrorMessage(false));
        }
        if ($this->closes->Required) {
            if (!$this->closes->IsDetailKey && EmptyValue($this->closes->FormValue)) {
                $this->closes->addErrorMessage(str_replace("%s", $this->closes->caption(), $this->closes->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closes->FormValue, $this->closes->formatPattern())) {
            $this->closes->addErrorMessage($this->closes->getErrorMessage(false));
        }
        if ($this->openu->Required) {
            if (!$this->openu->IsDetailKey && EmptyValue($this->openu->FormValue)) {
                $this->openu->addErrorMessage(str_replace("%s", $this->openu->caption(), $this->openu->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->openu->FormValue, $this->openu->formatPattern())) {
            $this->openu->addErrorMessage($this->openu->getErrorMessage(false));
        }
        if ($this->closeu->Required) {
            if (!$this->closeu->IsDetailKey && EmptyValue($this->closeu->FormValue)) {
                $this->closeu->addErrorMessage(str_replace("%s", $this->closeu->caption(), $this->closeu->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->closeu->FormValue, $this->closeu->formatPattern())) {
            $this->closeu->addErrorMessage($this->closeu->getErrorMessage(false));
        }
        if ($this->type->Required) {
            if ($this->type->FormValue == "") {
                $this->type->addErrorMessage(str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
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

        // location_id
        $this->location_id->setDbValueDef($rsnew, $this->location_id->CurrentValue, null, false);

        // openm
        $this->openm->setDbValueDef($rsnew, UnFormatDateTime($this->openm->CurrentValue, $this->openm->formatPattern()), null, strval($this->openm->CurrentValue) == "");

        // closem
        $this->closem->setDbValueDef($rsnew, UnFormatDateTime($this->closem->CurrentValue, $this->closem->formatPattern()), null, strval($this->closem->CurrentValue) == "");

        // opent
        $this->opent->setDbValueDef($rsnew, UnFormatDateTime($this->opent->CurrentValue, $this->opent->formatPattern()), null, strval($this->opent->CurrentValue) == "");

        // closet
        $this->closet->setDbValueDef($rsnew, UnFormatDateTime($this->closet->CurrentValue, $this->closet->formatPattern()), null, strval($this->closet->CurrentValue) == "");

        // openw
        $this->openw->setDbValueDef($rsnew, UnFormatDateTime($this->openw->CurrentValue, $this->openw->formatPattern()), null, strval($this->openw->CurrentValue) == "");

        // closew
        $this->closew->setDbValueDef($rsnew, UnFormatDateTime($this->closew->CurrentValue, $this->closew->formatPattern()), null, strval($this->closew->CurrentValue) == "");

        // openr
        $this->openr->setDbValueDef($rsnew, UnFormatDateTime($this->openr->CurrentValue, $this->openr->formatPattern()), null, strval($this->openr->CurrentValue) == "");

        // closer
        $this->closer->setDbValueDef($rsnew, UnFormatDateTime($this->closer->CurrentValue, $this->closer->formatPattern()), null, strval($this->closer->CurrentValue) == "");

        // openf
        $this->openf->setDbValueDef($rsnew, UnFormatDateTime($this->openf->CurrentValue, $this->openf->formatPattern()), null, strval($this->openf->CurrentValue) == "");

        // closef
        $this->closef->setDbValueDef($rsnew, UnFormatDateTime($this->closef->CurrentValue, $this->closef->formatPattern()), null, strval($this->closef->CurrentValue) == "");

        // opens
        $this->opens->setDbValueDef($rsnew, UnFormatDateTime($this->opens->CurrentValue, $this->opens->formatPattern()), null, strval($this->opens->CurrentValue) == "");

        // closes
        $this->closes->setDbValueDef($rsnew, UnFormatDateTime($this->closes->CurrentValue, $this->closes->formatPattern()), null, strval($this->closes->CurrentValue) == "");

        // openu
        $this->openu->setDbValueDef($rsnew, UnFormatDateTime($this->openu->CurrentValue, $this->openu->formatPattern()), null, strval($this->openu->CurrentValue) == "");

        // closeu
        $this->closeu->setDbValueDef($rsnew, UnFormatDateTime($this->closeu->CurrentValue, $this->closeu->formatPattern()), null, strval($this->closeu->CurrentValue) == "");

        // type
        $tmpBool = $this->type->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->type->setDbValueDef($rsnew, $tmpBool, null, strval($this->type->CurrentValue) == "");

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("HoursList"), "", $this->TableVar, true);
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
                case "x_type":
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
