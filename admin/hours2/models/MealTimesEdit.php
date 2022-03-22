<?php

namespace PHPMaker2021\project2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MealTimesEdit extends MealTimes
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'meal_times';

    // Page object name
    public $PageObjName = "MealTimesEdit";

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

        // Table object (meal_times)
        if (!isset($GLOBALS["meal_times"]) || get_class($GLOBALS["meal_times"]) == PROJECT_NAMESPACE . "meal_times") {
            $GLOBALS["meal_times"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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
                $doc = new $class(Container("meal_times"));
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
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;

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
        $this->id->setVisibility();
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
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName));
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("MealTimesList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "MealTimesList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'location_id' first before field var 'x_location_id'
        $val = $CurrentForm->hasValue("location_id") ? $CurrentForm->getValue("location_id") : $CurrentForm->getValue("x_location_id");
        if (!$this->location_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_id->Visible = false; // Disable update for API request
            } else {
                $this->location_id->setFormValue($val);
            }
        }

        // Check field name 'meal_details_id' first before field var 'x_meal_details_id'
        $val = $CurrentForm->hasValue("meal_details_id") ? $CurrentForm->getValue("meal_details_id") : $CurrentForm->getValue("x_meal_details_id");
        if (!$this->meal_details_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->meal_details_id->Visible = false; // Disable update for API request
            } else {
                $this->meal_details_id->setFormValue($val);
            }
        }

        // Check field name 'startm' first before field var 'x_startm'
        $val = $CurrentForm->hasValue("startm") ? $CurrentForm->getValue("startm") : $CurrentForm->getValue("x_startm");
        if (!$this->startm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startm->Visible = false; // Disable update for API request
            } else {
                $this->startm->setFormValue($val);
            }
            $this->startm->CurrentValue = UnFormatDateTime($this->startm->CurrentValue, 4);
        }

        // Check field name 'endm' first before field var 'x_endm'
        $val = $CurrentForm->hasValue("endm") ? $CurrentForm->getValue("endm") : $CurrentForm->getValue("x_endm");
        if (!$this->endm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endm->Visible = false; // Disable update for API request
            } else {
                $this->endm->setFormValue($val);
            }
            $this->endm->CurrentValue = UnFormatDateTime($this->endm->CurrentValue, 4);
        }

        // Check field name 'startt' first before field var 'x_startt'
        $val = $CurrentForm->hasValue("startt") ? $CurrentForm->getValue("startt") : $CurrentForm->getValue("x_startt");
        if (!$this->startt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startt->Visible = false; // Disable update for API request
            } else {
                $this->startt->setFormValue($val);
            }
            $this->startt->CurrentValue = UnFormatDateTime($this->startt->CurrentValue, 4);
        }

        // Check field name 'endt' first before field var 'x_endt'
        $val = $CurrentForm->hasValue("endt") ? $CurrentForm->getValue("endt") : $CurrentForm->getValue("x_endt");
        if (!$this->endt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endt->Visible = false; // Disable update for API request
            } else {
                $this->endt->setFormValue($val);
            }
            $this->endt->CurrentValue = UnFormatDateTime($this->endt->CurrentValue, 4);
        }

        // Check field name 'startw' first before field var 'x_startw'
        $val = $CurrentForm->hasValue("startw") ? $CurrentForm->getValue("startw") : $CurrentForm->getValue("x_startw");
        if (!$this->startw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startw->Visible = false; // Disable update for API request
            } else {
                $this->startw->setFormValue($val);
            }
            $this->startw->CurrentValue = UnFormatDateTime($this->startw->CurrentValue, 4);
        }

        // Check field name 'endw' first before field var 'x_endw'
        $val = $CurrentForm->hasValue("endw") ? $CurrentForm->getValue("endw") : $CurrentForm->getValue("x_endw");
        if (!$this->endw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endw->Visible = false; // Disable update for API request
            } else {
                $this->endw->setFormValue($val);
            }
            $this->endw->CurrentValue = UnFormatDateTime($this->endw->CurrentValue, 4);
        }

        // Check field name 'startr' first before field var 'x_startr'
        $val = $CurrentForm->hasValue("startr") ? $CurrentForm->getValue("startr") : $CurrentForm->getValue("x_startr");
        if (!$this->startr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startr->Visible = false; // Disable update for API request
            } else {
                $this->startr->setFormValue($val);
            }
            $this->startr->CurrentValue = UnFormatDateTime($this->startr->CurrentValue, 4);
        }

        // Check field name 'endr' first before field var 'x_endr'
        $val = $CurrentForm->hasValue("endr") ? $CurrentForm->getValue("endr") : $CurrentForm->getValue("x_endr");
        if (!$this->endr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endr->Visible = false; // Disable update for API request
            } else {
                $this->endr->setFormValue($val);
            }
            $this->endr->CurrentValue = UnFormatDateTime($this->endr->CurrentValue, 4);
        }

        // Check field name 'startf' first before field var 'x_startf'
        $val = $CurrentForm->hasValue("startf") ? $CurrentForm->getValue("startf") : $CurrentForm->getValue("x_startf");
        if (!$this->startf->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startf->Visible = false; // Disable update for API request
            } else {
                $this->startf->setFormValue($val);
            }
            $this->startf->CurrentValue = UnFormatDateTime($this->startf->CurrentValue, 4);
        }

        // Check field name 'endf' first before field var 'x_endf'
        $val = $CurrentForm->hasValue("endf") ? $CurrentForm->getValue("endf") : $CurrentForm->getValue("x_endf");
        if (!$this->endf->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endf->Visible = false; // Disable update for API request
            } else {
                $this->endf->setFormValue($val);
            }
            $this->endf->CurrentValue = UnFormatDateTime($this->endf->CurrentValue, 4);
        }

        // Check field name 'starts' first before field var 'x_starts'
        $val = $CurrentForm->hasValue("starts") ? $CurrentForm->getValue("starts") : $CurrentForm->getValue("x_starts");
        if (!$this->starts->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->starts->Visible = false; // Disable update for API request
            } else {
                $this->starts->setFormValue($val);
            }
            $this->starts->CurrentValue = UnFormatDateTime($this->starts->CurrentValue, 4);
        }

        // Check field name 'ends' first before field var 'x_ends'
        $val = $CurrentForm->hasValue("ends") ? $CurrentForm->getValue("ends") : $CurrentForm->getValue("x_ends");
        if (!$this->ends->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ends->Visible = false; // Disable update for API request
            } else {
                $this->ends->setFormValue($val);
            }
            $this->ends->CurrentValue = UnFormatDateTime($this->ends->CurrentValue, 4);
        }

        // Check field name 'startu' first before field var 'x_startu'
        $val = $CurrentForm->hasValue("startu") ? $CurrentForm->getValue("startu") : $CurrentForm->getValue("x_startu");
        if (!$this->startu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->startu->Visible = false; // Disable update for API request
            } else {
                $this->startu->setFormValue($val);
            }
            $this->startu->CurrentValue = UnFormatDateTime($this->startu->CurrentValue, 4);
        }

        // Check field name 'endu' first before field var 'x_endu'
        $val = $CurrentForm->hasValue("endu") ? $CurrentForm->getValue("endu") : $CurrentForm->getValue("x_endu");
        if (!$this->endu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->endu->Visible = false; // Disable update for API request
            } else {
                $this->endu->setFormValue($val);
            }
            $this->endu->CurrentValue = UnFormatDateTime($this->endu->CurrentValue, 4);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->location_id->CurrentValue = $this->location_id->FormValue;
        $this->meal_details_id->CurrentValue = $this->meal_details_id->FormValue;
        $this->startm->CurrentValue = $this->startm->FormValue;
        $this->startm->CurrentValue = UnFormatDateTime($this->startm->CurrentValue, 4);
        $this->endm->CurrentValue = $this->endm->FormValue;
        $this->endm->CurrentValue = UnFormatDateTime($this->endm->CurrentValue, 4);
        $this->startt->CurrentValue = $this->startt->FormValue;
        $this->startt->CurrentValue = UnFormatDateTime($this->startt->CurrentValue, 4);
        $this->endt->CurrentValue = $this->endt->FormValue;
        $this->endt->CurrentValue = UnFormatDateTime($this->endt->CurrentValue, 4);
        $this->startw->CurrentValue = $this->startw->FormValue;
        $this->startw->CurrentValue = UnFormatDateTime($this->startw->CurrentValue, 4);
        $this->endw->CurrentValue = $this->endw->FormValue;
        $this->endw->CurrentValue = UnFormatDateTime($this->endw->CurrentValue, 4);
        $this->startr->CurrentValue = $this->startr->FormValue;
        $this->startr->CurrentValue = UnFormatDateTime($this->startr->CurrentValue, 4);
        $this->endr->CurrentValue = $this->endr->FormValue;
        $this->endr->CurrentValue = UnFormatDateTime($this->endr->CurrentValue, 4);
        $this->startf->CurrentValue = $this->startf->FormValue;
        $this->startf->CurrentValue = UnFormatDateTime($this->startf->CurrentValue, 4);
        $this->endf->CurrentValue = $this->endf->FormValue;
        $this->endf->CurrentValue = UnFormatDateTime($this->endf->CurrentValue, 4);
        $this->starts->CurrentValue = $this->starts->FormValue;
        $this->starts->CurrentValue = UnFormatDateTime($this->starts->CurrentValue, 4);
        $this->ends->CurrentValue = $this->ends->FormValue;
        $this->ends->CurrentValue = UnFormatDateTime($this->ends->CurrentValue, 4);
        $this->startu->CurrentValue = $this->startu->FormValue;
        $this->startu->CurrentValue = UnFormatDateTime($this->startu->CurrentValue, 4);
        $this->endu->CurrentValue = $this->endu->FormValue;
        $this->endu->CurrentValue = UnFormatDateTime($this->endu->CurrentValue, 4);
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
        $row = [];
        $row['id'] = null;
        $row['location_id'] = null;
        $row['meal_details_id'] = null;
        $row['startm'] = null;
        $row['endm'] = null;
        $row['startt'] = null;
        $row['endt'] = null;
        $row['startw'] = null;
        $row['endw'] = null;
        $row['startr'] = null;
        $row['endr'] = null;
        $row['startf'] = null;
        $row['endf'] = null;
        $row['starts'] = null;
        $row['ends'] = null;
        $row['startu'] = null;
        $row['endu'] = null;
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

        // meal_details_id

        // startm

        // endm

        // startt

        // endt

        // startw

        // endw

        // startr

        // endr

        // startf

        // endf

        // starts

        // ends

        // startu

        // endu
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location_id
            $this->location_id->ViewValue = $this->location_id->CurrentValue;
            $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, 0, -2, -2, -2);
            $this->location_id->ViewCustomAttributes = "";

            // meal_details_id
            $this->meal_details_id->ViewValue = $this->meal_details_id->CurrentValue;
            $this->meal_details_id->ViewValue = FormatNumber($this->meal_details_id->ViewValue, 0, -2, -2, -2);
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

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";
            $this->location_id->TooltipValue = "";

            // meal_details_id
            $this->meal_details_id->LinkCustomAttributes = "";
            $this->meal_details_id->HrefValue = "";
            $this->meal_details_id->TooltipValue = "";

            // startm
            $this->startm->LinkCustomAttributes = "";
            $this->startm->HrefValue = "";
            $this->startm->TooltipValue = "";

            // endm
            $this->endm->LinkCustomAttributes = "";
            $this->endm->HrefValue = "";
            $this->endm->TooltipValue = "";

            // startt
            $this->startt->LinkCustomAttributes = "";
            $this->startt->HrefValue = "";
            $this->startt->TooltipValue = "";

            // endt
            $this->endt->LinkCustomAttributes = "";
            $this->endt->HrefValue = "";
            $this->endt->TooltipValue = "";

            // startw
            $this->startw->LinkCustomAttributes = "";
            $this->startw->HrefValue = "";
            $this->startw->TooltipValue = "";

            // endw
            $this->endw->LinkCustomAttributes = "";
            $this->endw->HrefValue = "";
            $this->endw->TooltipValue = "";

            // startr
            $this->startr->LinkCustomAttributes = "";
            $this->startr->HrefValue = "";
            $this->startr->TooltipValue = "";

            // endr
            $this->endr->LinkCustomAttributes = "";
            $this->endr->HrefValue = "";
            $this->endr->TooltipValue = "";

            // startf
            $this->startf->LinkCustomAttributes = "";
            $this->startf->HrefValue = "";
            $this->startf->TooltipValue = "";

            // endf
            $this->endf->LinkCustomAttributes = "";
            $this->endf->HrefValue = "";
            $this->endf->TooltipValue = "";

            // starts
            $this->starts->LinkCustomAttributes = "";
            $this->starts->HrefValue = "";
            $this->starts->TooltipValue = "";

            // ends
            $this->ends->LinkCustomAttributes = "";
            $this->ends->HrefValue = "";
            $this->ends->TooltipValue = "";

            // startu
            $this->startu->LinkCustomAttributes = "";
            $this->startu->HrefValue = "";
            $this->startu->TooltipValue = "";

            // endu
            $this->endu->LinkCustomAttributes = "";
            $this->endu->HrefValue = "";
            $this->endu->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location_id
            $this->location_id->EditAttrs["class"] = "form-control";
            $this->location_id->EditCustomAttributes = "";
            $this->location_id->EditValue = HtmlEncode($this->location_id->CurrentValue);
            $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());

            // meal_details_id
            $this->meal_details_id->EditAttrs["class"] = "form-control";
            $this->meal_details_id->EditCustomAttributes = "";
            $this->meal_details_id->EditValue = HtmlEncode($this->meal_details_id->CurrentValue);
            $this->meal_details_id->PlaceHolder = RemoveHtml($this->meal_details_id->caption());

            // startm
            $this->startm->EditAttrs["class"] = "form-control";
            $this->startm->EditCustomAttributes = "";
            $this->startm->EditValue = HtmlEncode($this->startm->CurrentValue);
            $this->startm->PlaceHolder = RemoveHtml($this->startm->caption());

            // endm
            $this->endm->EditAttrs["class"] = "form-control";
            $this->endm->EditCustomAttributes = "";
            $this->endm->EditValue = HtmlEncode($this->endm->CurrentValue);
            $this->endm->PlaceHolder = RemoveHtml($this->endm->caption());

            // startt
            $this->startt->EditAttrs["class"] = "form-control";
            $this->startt->EditCustomAttributes = "";
            $this->startt->EditValue = HtmlEncode($this->startt->CurrentValue);
            $this->startt->PlaceHolder = RemoveHtml($this->startt->caption());

            // endt
            $this->endt->EditAttrs["class"] = "form-control";
            $this->endt->EditCustomAttributes = "";
            $this->endt->EditValue = HtmlEncode($this->endt->CurrentValue);
            $this->endt->PlaceHolder = RemoveHtml($this->endt->caption());

            // startw
            $this->startw->EditAttrs["class"] = "form-control";
            $this->startw->EditCustomAttributes = "";
            $this->startw->EditValue = HtmlEncode($this->startw->CurrentValue);
            $this->startw->PlaceHolder = RemoveHtml($this->startw->caption());

            // endw
            $this->endw->EditAttrs["class"] = "form-control";
            $this->endw->EditCustomAttributes = "";
            $this->endw->EditValue = HtmlEncode($this->endw->CurrentValue);
            $this->endw->PlaceHolder = RemoveHtml($this->endw->caption());

            // startr
            $this->startr->EditAttrs["class"] = "form-control";
            $this->startr->EditCustomAttributes = "";
            $this->startr->EditValue = HtmlEncode($this->startr->CurrentValue);
            $this->startr->PlaceHolder = RemoveHtml($this->startr->caption());

            // endr
            $this->endr->EditAttrs["class"] = "form-control";
            $this->endr->EditCustomAttributes = "";
            $this->endr->EditValue = HtmlEncode($this->endr->CurrentValue);
            $this->endr->PlaceHolder = RemoveHtml($this->endr->caption());

            // startf
            $this->startf->EditAttrs["class"] = "form-control";
            $this->startf->EditCustomAttributes = "";
            $this->startf->EditValue = HtmlEncode($this->startf->CurrentValue);
            $this->startf->PlaceHolder = RemoveHtml($this->startf->caption());

            // endf
            $this->endf->EditAttrs["class"] = "form-control";
            $this->endf->EditCustomAttributes = "";
            $this->endf->EditValue = HtmlEncode($this->endf->CurrentValue);
            $this->endf->PlaceHolder = RemoveHtml($this->endf->caption());

            // starts
            $this->starts->EditAttrs["class"] = "form-control";
            $this->starts->EditCustomAttributes = "";
            $this->starts->EditValue = HtmlEncode($this->starts->CurrentValue);
            $this->starts->PlaceHolder = RemoveHtml($this->starts->caption());

            // ends
            $this->ends->EditAttrs["class"] = "form-control";
            $this->ends->EditCustomAttributes = "";
            $this->ends->EditValue = HtmlEncode($this->ends->CurrentValue);
            $this->ends->PlaceHolder = RemoveHtml($this->ends->caption());

            // startu
            $this->startu->EditAttrs["class"] = "form-control";
            $this->startu->EditCustomAttributes = "";
            $this->startu->EditValue = HtmlEncode($this->startu->CurrentValue);
            $this->startu->PlaceHolder = RemoveHtml($this->startu->caption());

            // endu
            $this->endu->EditAttrs["class"] = "form-control";
            $this->endu->EditCustomAttributes = "";
            $this->endu->EditValue = HtmlEncode($this->endu->CurrentValue);
            $this->endu->PlaceHolder = RemoveHtml($this->endu->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

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
        if ($this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
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
        if (!CheckTime($this->startm->FormValue)) {
            $this->startm->addErrorMessage($this->startm->getErrorMessage(false));
        }
        if ($this->endm->Required) {
            if (!$this->endm->IsDetailKey && EmptyValue($this->endm->FormValue)) {
                $this->endm->addErrorMessage(str_replace("%s", $this->endm->caption(), $this->endm->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endm->FormValue)) {
            $this->endm->addErrorMessage($this->endm->getErrorMessage(false));
        }
        if ($this->startt->Required) {
            if (!$this->startt->IsDetailKey && EmptyValue($this->startt->FormValue)) {
                $this->startt->addErrorMessage(str_replace("%s", $this->startt->caption(), $this->startt->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startt->FormValue)) {
            $this->startt->addErrorMessage($this->startt->getErrorMessage(false));
        }
        if ($this->endt->Required) {
            if (!$this->endt->IsDetailKey && EmptyValue($this->endt->FormValue)) {
                $this->endt->addErrorMessage(str_replace("%s", $this->endt->caption(), $this->endt->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endt->FormValue)) {
            $this->endt->addErrorMessage($this->endt->getErrorMessage(false));
        }
        if ($this->startw->Required) {
            if (!$this->startw->IsDetailKey && EmptyValue($this->startw->FormValue)) {
                $this->startw->addErrorMessage(str_replace("%s", $this->startw->caption(), $this->startw->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startw->FormValue)) {
            $this->startw->addErrorMessage($this->startw->getErrorMessage(false));
        }
        if ($this->endw->Required) {
            if (!$this->endw->IsDetailKey && EmptyValue($this->endw->FormValue)) {
                $this->endw->addErrorMessage(str_replace("%s", $this->endw->caption(), $this->endw->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endw->FormValue)) {
            $this->endw->addErrorMessage($this->endw->getErrorMessage(false));
        }
        if ($this->startr->Required) {
            if (!$this->startr->IsDetailKey && EmptyValue($this->startr->FormValue)) {
                $this->startr->addErrorMessage(str_replace("%s", $this->startr->caption(), $this->startr->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startr->FormValue)) {
            $this->startr->addErrorMessage($this->startr->getErrorMessage(false));
        }
        if ($this->endr->Required) {
            if (!$this->endr->IsDetailKey && EmptyValue($this->endr->FormValue)) {
                $this->endr->addErrorMessage(str_replace("%s", $this->endr->caption(), $this->endr->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endr->FormValue)) {
            $this->endr->addErrorMessage($this->endr->getErrorMessage(false));
        }
        if ($this->startf->Required) {
            if (!$this->startf->IsDetailKey && EmptyValue($this->startf->FormValue)) {
                $this->startf->addErrorMessage(str_replace("%s", $this->startf->caption(), $this->startf->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startf->FormValue)) {
            $this->startf->addErrorMessage($this->startf->getErrorMessage(false));
        }
        if ($this->endf->Required) {
            if (!$this->endf->IsDetailKey && EmptyValue($this->endf->FormValue)) {
                $this->endf->addErrorMessage(str_replace("%s", $this->endf->caption(), $this->endf->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endf->FormValue)) {
            $this->endf->addErrorMessage($this->endf->getErrorMessage(false));
        }
        if ($this->starts->Required) {
            if (!$this->starts->IsDetailKey && EmptyValue($this->starts->FormValue)) {
                $this->starts->addErrorMessage(str_replace("%s", $this->starts->caption(), $this->starts->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->starts->FormValue)) {
            $this->starts->addErrorMessage($this->starts->getErrorMessage(false));
        }
        if ($this->ends->Required) {
            if (!$this->ends->IsDetailKey && EmptyValue($this->ends->FormValue)) {
                $this->ends->addErrorMessage(str_replace("%s", $this->ends->caption(), $this->ends->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->ends->FormValue)) {
            $this->ends->addErrorMessage($this->ends->getErrorMessage(false));
        }
        if ($this->startu->Required) {
            if (!$this->startu->IsDetailKey && EmptyValue($this->startu->FormValue)) {
                $this->startu->addErrorMessage(str_replace("%s", $this->startu->caption(), $this->startu->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->startu->FormValue)) {
            $this->startu->addErrorMessage($this->startu->getErrorMessage(false));
        }
        if ($this->endu->Required) {
            if (!$this->endu->IsDetailKey && EmptyValue($this->endu->FormValue)) {
                $this->endu->addErrorMessage(str_replace("%s", $this->endu->caption(), $this->endu->RequiredErrorMessage));
            }
        }
        if (!CheckTime($this->endu->FormValue)) {
            $this->endu->addErrorMessage($this->endu->getErrorMessage(false));
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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssoc($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // location_id
            $this->location_id->setDbValueDef($rsnew, $this->location_id->CurrentValue, 0, $this->location_id->ReadOnly);

            // meal_details_id
            $this->meal_details_id->setDbValueDef($rsnew, $this->meal_details_id->CurrentValue, 0, $this->meal_details_id->ReadOnly);

            // startm
            $this->startm->setDbValueDef($rsnew, $this->startm->CurrentValue, null, $this->startm->ReadOnly);

            // endm
            $this->endm->setDbValueDef($rsnew, $this->endm->CurrentValue, null, $this->endm->ReadOnly);

            // startt
            $this->startt->setDbValueDef($rsnew, $this->startt->CurrentValue, null, $this->startt->ReadOnly);

            // endt
            $this->endt->setDbValueDef($rsnew, $this->endt->CurrentValue, null, $this->endt->ReadOnly);

            // startw
            $this->startw->setDbValueDef($rsnew, $this->startw->CurrentValue, null, $this->startw->ReadOnly);

            // endw
            $this->endw->setDbValueDef($rsnew, $this->endw->CurrentValue, null, $this->endw->ReadOnly);

            // startr
            $this->startr->setDbValueDef($rsnew, $this->startr->CurrentValue, null, $this->startr->ReadOnly);

            // endr
            $this->endr->setDbValueDef($rsnew, $this->endr->CurrentValue, null, $this->endr->ReadOnly);

            // startf
            $this->startf->setDbValueDef($rsnew, $this->startf->CurrentValue, null, $this->startf->ReadOnly);

            // endf
            $this->endf->setDbValueDef($rsnew, $this->endf->CurrentValue, null, $this->endf->ReadOnly);

            // starts
            $this->starts->setDbValueDef($rsnew, $this->starts->CurrentValue, null, $this->starts->ReadOnly);

            // ends
            $this->ends->setDbValueDef($rsnew, $this->ends->CurrentValue, null, $this->ends->ReadOnly);

            // startu
            $this->startu->setDbValueDef($rsnew, $this->startu->CurrentValue, null, $this->startu->ReadOnly);

            // endu
            $this->endu->setDbValueDef($rsnew, $this->endu->CurrentValue, null, $this->endu->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MealTimesList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
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
