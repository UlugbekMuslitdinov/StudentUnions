<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class CateringHighlandEdit extends CateringHighland
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'catering_highland';

    // Page object name
    public $PageObjName = "CateringHighlandEdit";

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

        // Table object (catering_highland)
        if (!isset($GLOBALS["catering_highland"]) || get_class($GLOBALS["catering_highland"]) == PROJECT_NAMESPACE . "catering_highland") {
            $GLOBALS["catering_highland"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'catering_highland');
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
                $doc = new $class(Container("catering_highland"));
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
                    if ($pageName == "CateringHighlandView") {
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
        $this->catering_id->setVisibility();
        $this->burrito_12->setVisibility();
        $this->burrito_8->setVisibility();
        $this->extra_chips->setVisibility();
        $this->extra_salsa->setVisibility();
        $this->extra_sourcream->setVisibility();
        $this->extra_guacamole->setVisibility();
        $this->upgrade->setVisibility();
        $this->coke->setVisibility();
        $this->diet_coke->setVisibility();
        $this->sprite->setVisibility();
        $this->fanta->setVisibility();
        $this->water->setVisibility();
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
                    $this->terminate("CateringHighlandList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "CateringHighlandList") {
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

        // Check field name 'catering_id' first before field var 'x_catering_id'
        $val = $CurrentForm->hasValue("catering_id") ? $CurrentForm->getValue("catering_id") : $CurrentForm->getValue("x_catering_id");
        if (!$this->catering_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->catering_id->Visible = false; // Disable update for API request
            } else {
                $this->catering_id->setFormValue($val);
            }
        }

        // Check field name 'burrito_12' first before field var 'x_burrito_12'
        $val = $CurrentForm->hasValue("burrito_12") ? $CurrentForm->getValue("burrito_12") : $CurrentForm->getValue("x_burrito_12");
        if (!$this->burrito_12->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->burrito_12->Visible = false; // Disable update for API request
            } else {
                $this->burrito_12->setFormValue($val);
            }
        }

        // Check field name 'burrito_8' first before field var 'x_burrito_8'
        $val = $CurrentForm->hasValue("burrito_8") ? $CurrentForm->getValue("burrito_8") : $CurrentForm->getValue("x_burrito_8");
        if (!$this->burrito_8->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->burrito_8->Visible = false; // Disable update for API request
            } else {
                $this->burrito_8->setFormValue($val);
            }
        }

        // Check field name 'extra_chips' first before field var 'x_extra_chips'
        $val = $CurrentForm->hasValue("extra_chips") ? $CurrentForm->getValue("extra_chips") : $CurrentForm->getValue("x_extra_chips");
        if (!$this->extra_chips->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->extra_chips->Visible = false; // Disable update for API request
            } else {
                $this->extra_chips->setFormValue($val);
            }
        }

        // Check field name 'extra_salsa' first before field var 'x_extra_salsa'
        $val = $CurrentForm->hasValue("extra_salsa") ? $CurrentForm->getValue("extra_salsa") : $CurrentForm->getValue("x_extra_salsa");
        if (!$this->extra_salsa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->extra_salsa->Visible = false; // Disable update for API request
            } else {
                $this->extra_salsa->setFormValue($val);
            }
        }

        // Check field name 'extra_sourcream' first before field var 'x_extra_sourcream'
        $val = $CurrentForm->hasValue("extra_sourcream") ? $CurrentForm->getValue("extra_sourcream") : $CurrentForm->getValue("x_extra_sourcream");
        if (!$this->extra_sourcream->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->extra_sourcream->Visible = false; // Disable update for API request
            } else {
                $this->extra_sourcream->setFormValue($val);
            }
        }

        // Check field name 'extra_guacamole' first before field var 'x_extra_guacamole'
        $val = $CurrentForm->hasValue("extra_guacamole") ? $CurrentForm->getValue("extra_guacamole") : $CurrentForm->getValue("x_extra_guacamole");
        if (!$this->extra_guacamole->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->extra_guacamole->Visible = false; // Disable update for API request
            } else {
                $this->extra_guacamole->setFormValue($val);
            }
        }

        // Check field name 'upgrade' first before field var 'x_upgrade'
        $val = $CurrentForm->hasValue("upgrade") ? $CurrentForm->getValue("upgrade") : $CurrentForm->getValue("x_upgrade");
        if (!$this->upgrade->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->upgrade->Visible = false; // Disable update for API request
            } else {
                $this->upgrade->setFormValue($val);
            }
        }

        // Check field name 'coke' first before field var 'x_coke'
        $val = $CurrentForm->hasValue("coke") ? $CurrentForm->getValue("coke") : $CurrentForm->getValue("x_coke");
        if (!$this->coke->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->coke->Visible = false; // Disable update for API request
            } else {
                $this->coke->setFormValue($val);
            }
        }

        // Check field name 'diet_coke' first before field var 'x_diet_coke'
        $val = $CurrentForm->hasValue("diet_coke") ? $CurrentForm->getValue("diet_coke") : $CurrentForm->getValue("x_diet_coke");
        if (!$this->diet_coke->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->diet_coke->Visible = false; // Disable update for API request
            } else {
                $this->diet_coke->setFormValue($val);
            }
        }

        // Check field name 'sprite' first before field var 'x_sprite'
        $val = $CurrentForm->hasValue("sprite") ? $CurrentForm->getValue("sprite") : $CurrentForm->getValue("x_sprite");
        if (!$this->sprite->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sprite->Visible = false; // Disable update for API request
            } else {
                $this->sprite->setFormValue($val);
            }
        }

        // Check field name 'fanta' first before field var 'x_fanta'
        $val = $CurrentForm->hasValue("fanta") ? $CurrentForm->getValue("fanta") : $CurrentForm->getValue("x_fanta");
        if (!$this->fanta->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fanta->Visible = false; // Disable update for API request
            } else {
                $this->fanta->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->catering_id->CurrentValue = $this->catering_id->FormValue;
        $this->burrito_12->CurrentValue = $this->burrito_12->FormValue;
        $this->burrito_8->CurrentValue = $this->burrito_8->FormValue;
        $this->extra_chips->CurrentValue = $this->extra_chips->FormValue;
        $this->extra_salsa->CurrentValue = $this->extra_salsa->FormValue;
        $this->extra_sourcream->CurrentValue = $this->extra_sourcream->FormValue;
        $this->extra_guacamole->CurrentValue = $this->extra_guacamole->FormValue;
        $this->upgrade->CurrentValue = $this->upgrade->FormValue;
        $this->coke->CurrentValue = $this->coke->FormValue;
        $this->diet_coke->CurrentValue = $this->diet_coke->FormValue;
        $this->sprite->CurrentValue = $this->sprite->FormValue;
        $this->fanta->CurrentValue = $this->fanta->FormValue;
        $this->water->CurrentValue = $this->water->FormValue;
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
        $this->burrito_12->setDbValue($row['burrito_12']);
        $this->burrito_8->setDbValue($row['burrito_8']);
        $this->extra_chips->setDbValue($row['extra_chips']);
        $this->extra_salsa->setDbValue($row['extra_salsa']);
        $this->extra_sourcream->setDbValue($row['extra_sourcream']);
        $this->extra_guacamole->setDbValue($row['extra_guacamole']);
        $this->upgrade->setDbValue($row['upgrade']);
        $this->coke->setDbValue($row['coke']);
        $this->diet_coke->setDbValue($row['diet_coke']);
        $this->sprite->setDbValue($row['sprite']);
        $this->fanta->setDbValue($row['fanta']);
        $this->water->setDbValue($row['water']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['catering_id'] = null;
        $row['burrito_12'] = null;
        $row['burrito_8'] = null;
        $row['extra_chips'] = null;
        $row['extra_salsa'] = null;
        $row['extra_sourcream'] = null;
        $row['extra_guacamole'] = null;
        $row['upgrade'] = null;
        $row['coke'] = null;
        $row['diet_coke'] = null;
        $row['sprite'] = null;
        $row['fanta'] = null;
        $row['water'] = null;
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

        // burrito_12

        // burrito_8

        // extra_chips

        // extra_salsa

        // extra_sourcream

        // extra_guacamole

        // upgrade

        // coke

        // diet_coke

        // sprite

        // fanta

        // water
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // catering_id
            $this->catering_id->ViewValue = $this->catering_id->CurrentValue;
            $this->catering_id->ViewValue = FormatNumber($this->catering_id->ViewValue, 0, -2, -2, -2);
            $this->catering_id->ViewCustomAttributes = "";

            // burrito_12
            $this->burrito_12->ViewValue = $this->burrito_12->CurrentValue;
            $this->burrito_12->ViewValue = FormatNumber($this->burrito_12->ViewValue, 0, -2, -2, -2);
            $this->burrito_12->ViewCustomAttributes = "";

            // burrito_8
            $this->burrito_8->ViewValue = $this->burrito_8->CurrentValue;
            $this->burrito_8->ViewValue = FormatNumber($this->burrito_8->ViewValue, 0, -2, -2, -2);
            $this->burrito_8->ViewCustomAttributes = "";

            // extra_chips
            $this->extra_chips->ViewValue = $this->extra_chips->CurrentValue;
            $this->extra_chips->ViewValue = FormatNumber($this->extra_chips->ViewValue, 0, -2, -2, -2);
            $this->extra_chips->ViewCustomAttributes = "";

            // extra_salsa
            $this->extra_salsa->ViewValue = $this->extra_salsa->CurrentValue;
            $this->extra_salsa->ViewValue = FormatNumber($this->extra_salsa->ViewValue, 0, -2, -2, -2);
            $this->extra_salsa->ViewCustomAttributes = "";

            // extra_sourcream
            $this->extra_sourcream->ViewValue = $this->extra_sourcream->CurrentValue;
            $this->extra_sourcream->ViewValue = FormatNumber($this->extra_sourcream->ViewValue, 0, -2, -2, -2);
            $this->extra_sourcream->ViewCustomAttributes = "";

            // extra_guacamole
            $this->extra_guacamole->ViewValue = $this->extra_guacamole->CurrentValue;
            $this->extra_guacamole->ViewValue = FormatNumber($this->extra_guacamole->ViewValue, 0, -2, -2, -2);
            $this->extra_guacamole->ViewCustomAttributes = "";

            // upgrade
            $this->upgrade->ViewValue = $this->upgrade->CurrentValue;
            $this->upgrade->ViewValue = FormatNumber($this->upgrade->ViewValue, 0, -2, -2, -2);
            $this->upgrade->ViewCustomAttributes = "";

            // coke
            $this->coke->ViewValue = $this->coke->CurrentValue;
            $this->coke->ViewValue = FormatNumber($this->coke->ViewValue, 0, -2, -2, -2);
            $this->coke->ViewCustomAttributes = "";

            // diet_coke
            $this->diet_coke->ViewValue = $this->diet_coke->CurrentValue;
            $this->diet_coke->ViewValue = FormatNumber($this->diet_coke->ViewValue, 0, -2, -2, -2);
            $this->diet_coke->ViewCustomAttributes = "";

            // sprite
            $this->sprite->ViewValue = $this->sprite->CurrentValue;
            $this->sprite->ViewValue = FormatNumber($this->sprite->ViewValue, 0, -2, -2, -2);
            $this->sprite->ViewCustomAttributes = "";

            // fanta
            $this->fanta->ViewValue = $this->fanta->CurrentValue;
            $this->fanta->ViewValue = FormatNumber($this->fanta->ViewValue, 0, -2, -2, -2);
            $this->fanta->ViewCustomAttributes = "";

            // water
            $this->water->ViewValue = $this->water->CurrentValue;
            $this->water->ViewValue = FormatNumber($this->water->ViewValue, 0, -2, -2, -2);
            $this->water->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // catering_id
            $this->catering_id->LinkCustomAttributes = "";
            $this->catering_id->HrefValue = "";
            $this->catering_id->TooltipValue = "";

            // burrito_12
            $this->burrito_12->LinkCustomAttributes = "";
            $this->burrito_12->HrefValue = "";
            $this->burrito_12->TooltipValue = "";

            // burrito_8
            $this->burrito_8->LinkCustomAttributes = "";
            $this->burrito_8->HrefValue = "";
            $this->burrito_8->TooltipValue = "";

            // extra_chips
            $this->extra_chips->LinkCustomAttributes = "";
            $this->extra_chips->HrefValue = "";
            $this->extra_chips->TooltipValue = "";

            // extra_salsa
            $this->extra_salsa->LinkCustomAttributes = "";
            $this->extra_salsa->HrefValue = "";
            $this->extra_salsa->TooltipValue = "";

            // extra_sourcream
            $this->extra_sourcream->LinkCustomAttributes = "";
            $this->extra_sourcream->HrefValue = "";
            $this->extra_sourcream->TooltipValue = "";

            // extra_guacamole
            $this->extra_guacamole->LinkCustomAttributes = "";
            $this->extra_guacamole->HrefValue = "";
            $this->extra_guacamole->TooltipValue = "";

            // upgrade
            $this->upgrade->LinkCustomAttributes = "";
            $this->upgrade->HrefValue = "";
            $this->upgrade->TooltipValue = "";

            // coke
            $this->coke->LinkCustomAttributes = "";
            $this->coke->HrefValue = "";
            $this->coke->TooltipValue = "";

            // diet_coke
            $this->diet_coke->LinkCustomAttributes = "";
            $this->diet_coke->HrefValue = "";
            $this->diet_coke->TooltipValue = "";

            // sprite
            $this->sprite->LinkCustomAttributes = "";
            $this->sprite->HrefValue = "";
            $this->sprite->TooltipValue = "";

            // fanta
            $this->fanta->LinkCustomAttributes = "";
            $this->fanta->HrefValue = "";
            $this->fanta->TooltipValue = "";

            // water
            $this->water->LinkCustomAttributes = "";
            $this->water->HrefValue = "";
            $this->water->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // catering_id
            $this->catering_id->EditAttrs["class"] = "form-control";
            $this->catering_id->EditCustomAttributes = "";
            $this->catering_id->EditValue = HtmlEncode($this->catering_id->CurrentValue);
            $this->catering_id->PlaceHolder = RemoveHtml($this->catering_id->caption());

            // burrito_12
            $this->burrito_12->EditAttrs["class"] = "form-control";
            $this->burrito_12->EditCustomAttributes = "";
            $this->burrito_12->EditValue = HtmlEncode($this->burrito_12->CurrentValue);
            $this->burrito_12->PlaceHolder = RemoveHtml($this->burrito_12->caption());

            // burrito_8
            $this->burrito_8->EditAttrs["class"] = "form-control";
            $this->burrito_8->EditCustomAttributes = "";
            $this->burrito_8->EditValue = HtmlEncode($this->burrito_8->CurrentValue);
            $this->burrito_8->PlaceHolder = RemoveHtml($this->burrito_8->caption());

            // extra_chips
            $this->extra_chips->EditAttrs["class"] = "form-control";
            $this->extra_chips->EditCustomAttributes = "";
            $this->extra_chips->EditValue = HtmlEncode($this->extra_chips->CurrentValue);
            $this->extra_chips->PlaceHolder = RemoveHtml($this->extra_chips->caption());

            // extra_salsa
            $this->extra_salsa->EditAttrs["class"] = "form-control";
            $this->extra_salsa->EditCustomAttributes = "";
            $this->extra_salsa->EditValue = HtmlEncode($this->extra_salsa->CurrentValue);
            $this->extra_salsa->PlaceHolder = RemoveHtml($this->extra_salsa->caption());

            // extra_sourcream
            $this->extra_sourcream->EditAttrs["class"] = "form-control";
            $this->extra_sourcream->EditCustomAttributes = "";
            $this->extra_sourcream->EditValue = HtmlEncode($this->extra_sourcream->CurrentValue);
            $this->extra_sourcream->PlaceHolder = RemoveHtml($this->extra_sourcream->caption());

            // extra_guacamole
            $this->extra_guacamole->EditAttrs["class"] = "form-control";
            $this->extra_guacamole->EditCustomAttributes = "";
            $this->extra_guacamole->EditValue = HtmlEncode($this->extra_guacamole->CurrentValue);
            $this->extra_guacamole->PlaceHolder = RemoveHtml($this->extra_guacamole->caption());

            // upgrade
            $this->upgrade->EditAttrs["class"] = "form-control";
            $this->upgrade->EditCustomAttributes = "";
            $this->upgrade->EditValue = HtmlEncode($this->upgrade->CurrentValue);
            $this->upgrade->PlaceHolder = RemoveHtml($this->upgrade->caption());

            // coke
            $this->coke->EditAttrs["class"] = "form-control";
            $this->coke->EditCustomAttributes = "";
            $this->coke->EditValue = HtmlEncode($this->coke->CurrentValue);
            $this->coke->PlaceHolder = RemoveHtml($this->coke->caption());

            // diet_coke
            $this->diet_coke->EditAttrs["class"] = "form-control";
            $this->diet_coke->EditCustomAttributes = "";
            $this->diet_coke->EditValue = HtmlEncode($this->diet_coke->CurrentValue);
            $this->diet_coke->PlaceHolder = RemoveHtml($this->diet_coke->caption());

            // sprite
            $this->sprite->EditAttrs["class"] = "form-control";
            $this->sprite->EditCustomAttributes = "";
            $this->sprite->EditValue = HtmlEncode($this->sprite->CurrentValue);
            $this->sprite->PlaceHolder = RemoveHtml($this->sprite->caption());

            // fanta
            $this->fanta->EditAttrs["class"] = "form-control";
            $this->fanta->EditCustomAttributes = "";
            $this->fanta->EditValue = HtmlEncode($this->fanta->CurrentValue);
            $this->fanta->PlaceHolder = RemoveHtml($this->fanta->caption());

            // water
            $this->water->EditAttrs["class"] = "form-control";
            $this->water->EditCustomAttributes = "";
            $this->water->EditValue = HtmlEncode($this->water->CurrentValue);
            $this->water->PlaceHolder = RemoveHtml($this->water->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // catering_id
            $this->catering_id->LinkCustomAttributes = "";
            $this->catering_id->HrefValue = "";

            // burrito_12
            $this->burrito_12->LinkCustomAttributes = "";
            $this->burrito_12->HrefValue = "";

            // burrito_8
            $this->burrito_8->LinkCustomAttributes = "";
            $this->burrito_8->HrefValue = "";

            // extra_chips
            $this->extra_chips->LinkCustomAttributes = "";
            $this->extra_chips->HrefValue = "";

            // extra_salsa
            $this->extra_salsa->LinkCustomAttributes = "";
            $this->extra_salsa->HrefValue = "";

            // extra_sourcream
            $this->extra_sourcream->LinkCustomAttributes = "";
            $this->extra_sourcream->HrefValue = "";

            // extra_guacamole
            $this->extra_guacamole->LinkCustomAttributes = "";
            $this->extra_guacamole->HrefValue = "";

            // upgrade
            $this->upgrade->LinkCustomAttributes = "";
            $this->upgrade->HrefValue = "";

            // coke
            $this->coke->LinkCustomAttributes = "";
            $this->coke->HrefValue = "";

            // diet_coke
            $this->diet_coke->LinkCustomAttributes = "";
            $this->diet_coke->HrefValue = "";

            // sprite
            $this->sprite->LinkCustomAttributes = "";
            $this->sprite->HrefValue = "";

            // fanta
            $this->fanta->LinkCustomAttributes = "";
            $this->fanta->HrefValue = "";

            // water
            $this->water->LinkCustomAttributes = "";
            $this->water->HrefValue = "";
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
        if ($this->catering_id->Required) {
            if (!$this->catering_id->IsDetailKey && EmptyValue($this->catering_id->FormValue)) {
                $this->catering_id->addErrorMessage(str_replace("%s", $this->catering_id->caption(), $this->catering_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->catering_id->FormValue)) {
            $this->catering_id->addErrorMessage($this->catering_id->getErrorMessage(false));
        }
        if ($this->burrito_12->Required) {
            if (!$this->burrito_12->IsDetailKey && EmptyValue($this->burrito_12->FormValue)) {
                $this->burrito_12->addErrorMessage(str_replace("%s", $this->burrito_12->caption(), $this->burrito_12->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->burrito_12->FormValue)) {
            $this->burrito_12->addErrorMessage($this->burrito_12->getErrorMessage(false));
        }
        if ($this->burrito_8->Required) {
            if (!$this->burrito_8->IsDetailKey && EmptyValue($this->burrito_8->FormValue)) {
                $this->burrito_8->addErrorMessage(str_replace("%s", $this->burrito_8->caption(), $this->burrito_8->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->burrito_8->FormValue)) {
            $this->burrito_8->addErrorMessage($this->burrito_8->getErrorMessage(false));
        }
        if ($this->extra_chips->Required) {
            if (!$this->extra_chips->IsDetailKey && EmptyValue($this->extra_chips->FormValue)) {
                $this->extra_chips->addErrorMessage(str_replace("%s", $this->extra_chips->caption(), $this->extra_chips->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->extra_chips->FormValue)) {
            $this->extra_chips->addErrorMessage($this->extra_chips->getErrorMessage(false));
        }
        if ($this->extra_salsa->Required) {
            if (!$this->extra_salsa->IsDetailKey && EmptyValue($this->extra_salsa->FormValue)) {
                $this->extra_salsa->addErrorMessage(str_replace("%s", $this->extra_salsa->caption(), $this->extra_salsa->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->extra_salsa->FormValue)) {
            $this->extra_salsa->addErrorMessage($this->extra_salsa->getErrorMessage(false));
        }
        if ($this->extra_sourcream->Required) {
            if (!$this->extra_sourcream->IsDetailKey && EmptyValue($this->extra_sourcream->FormValue)) {
                $this->extra_sourcream->addErrorMessage(str_replace("%s", $this->extra_sourcream->caption(), $this->extra_sourcream->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->extra_sourcream->FormValue)) {
            $this->extra_sourcream->addErrorMessage($this->extra_sourcream->getErrorMessage(false));
        }
        if ($this->extra_guacamole->Required) {
            if (!$this->extra_guacamole->IsDetailKey && EmptyValue($this->extra_guacamole->FormValue)) {
                $this->extra_guacamole->addErrorMessage(str_replace("%s", $this->extra_guacamole->caption(), $this->extra_guacamole->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->extra_guacamole->FormValue)) {
            $this->extra_guacamole->addErrorMessage($this->extra_guacamole->getErrorMessage(false));
        }
        if ($this->upgrade->Required) {
            if (!$this->upgrade->IsDetailKey && EmptyValue($this->upgrade->FormValue)) {
                $this->upgrade->addErrorMessage(str_replace("%s", $this->upgrade->caption(), $this->upgrade->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->upgrade->FormValue)) {
            $this->upgrade->addErrorMessage($this->upgrade->getErrorMessage(false));
        }
        if ($this->coke->Required) {
            if (!$this->coke->IsDetailKey && EmptyValue($this->coke->FormValue)) {
                $this->coke->addErrorMessage(str_replace("%s", $this->coke->caption(), $this->coke->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->coke->FormValue)) {
            $this->coke->addErrorMessage($this->coke->getErrorMessage(false));
        }
        if ($this->diet_coke->Required) {
            if (!$this->diet_coke->IsDetailKey && EmptyValue($this->diet_coke->FormValue)) {
                $this->diet_coke->addErrorMessage(str_replace("%s", $this->diet_coke->caption(), $this->diet_coke->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->diet_coke->FormValue)) {
            $this->diet_coke->addErrorMessage($this->diet_coke->getErrorMessage(false));
        }
        if ($this->sprite->Required) {
            if (!$this->sprite->IsDetailKey && EmptyValue($this->sprite->FormValue)) {
                $this->sprite->addErrorMessage(str_replace("%s", $this->sprite->caption(), $this->sprite->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sprite->FormValue)) {
            $this->sprite->addErrorMessage($this->sprite->getErrorMessage(false));
        }
        if ($this->fanta->Required) {
            if (!$this->fanta->IsDetailKey && EmptyValue($this->fanta->FormValue)) {
                $this->fanta->addErrorMessage(str_replace("%s", $this->fanta->caption(), $this->fanta->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->fanta->FormValue)) {
            $this->fanta->addErrorMessage($this->fanta->getErrorMessage(false));
        }
        if ($this->water->Required) {
            if (!$this->water->IsDetailKey && EmptyValue($this->water->FormValue)) {
                $this->water->addErrorMessage(str_replace("%s", $this->water->caption(), $this->water->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->water->FormValue)) {
            $this->water->addErrorMessage($this->water->getErrorMessage(false));
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

            // catering_id
            $this->catering_id->setDbValueDef($rsnew, $this->catering_id->CurrentValue, null, $this->catering_id->ReadOnly);

            // burrito_12
            $this->burrito_12->setDbValueDef($rsnew, $this->burrito_12->CurrentValue, null, $this->burrito_12->ReadOnly);

            // burrito_8
            $this->burrito_8->setDbValueDef($rsnew, $this->burrito_8->CurrentValue, null, $this->burrito_8->ReadOnly);

            // extra_chips
            $this->extra_chips->setDbValueDef($rsnew, $this->extra_chips->CurrentValue, null, $this->extra_chips->ReadOnly);

            // extra_salsa
            $this->extra_salsa->setDbValueDef($rsnew, $this->extra_salsa->CurrentValue, null, $this->extra_salsa->ReadOnly);

            // extra_sourcream
            $this->extra_sourcream->setDbValueDef($rsnew, $this->extra_sourcream->CurrentValue, null, $this->extra_sourcream->ReadOnly);

            // extra_guacamole
            $this->extra_guacamole->setDbValueDef($rsnew, $this->extra_guacamole->CurrentValue, null, $this->extra_guacamole->ReadOnly);

            // upgrade
            $this->upgrade->setDbValueDef($rsnew, $this->upgrade->CurrentValue, null, $this->upgrade->ReadOnly);

            // coke
            $this->coke->setDbValueDef($rsnew, $this->coke->CurrentValue, null, $this->coke->ReadOnly);

            // diet_coke
            $this->diet_coke->setDbValueDef($rsnew, $this->diet_coke->CurrentValue, null, $this->diet_coke->ReadOnly);

            // sprite
            $this->sprite->setDbValueDef($rsnew, $this->sprite->CurrentValue, null, $this->sprite->ReadOnly);

            // fanta
            $this->fanta->setDbValueDef($rsnew, $this->fanta->CurrentValue, null, $this->fanta->ReadOnly);

            // water
            $this->water->setDbValueDef($rsnew, $this->water->CurrentValue, null, $this->water->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CateringHighlandList"), "", $this->TableVar, true);
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
