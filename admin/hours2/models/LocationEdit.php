<?php

namespace PHPMaker2021\project2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class LocationEdit extends Location
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'location';

    // Page object name
    public $PageObjName = "LocationEdit";

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

        // Table object (location)
        if (!isset($GLOBALS["location"]) || get_class($GLOBALS["location"]) == PROJECT_NAMESPACE . "location") {
            $GLOBALS["location"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'location');
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
                $doc = new $class(Container("location"));
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
                    if ($pageName == "LocationView") {
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
            $key .= @$ar['location_id'];
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
        $this->location_id->setVisibility();
        $this->location_name->setVisibility();
        $this->location_url->setVisibility();
        $this->group_id->setVisibility();
        $this->active->setVisibility();
        $this->group_hours->setVisibility();
        $this->phone->setVisibility();
        $this->subgroup->setVisibility();
        $this->old_id->setVisibility();
        $this->short_name->setVisibility();
        $this->accept_plus_discount->setVisibility();
        $this->lat->setVisibility();
        $this->long->setVisibility();
        $this->ua_mobile_categories->setVisibility();
        $this->breakfast->setVisibility();
        $this->lunch->setVisibility();
        $this->dinner->setVisibility();
        $this->continuous->setVisibility();
        $this->hours_message->setVisibility();
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
            if (($keyValue = Get("location_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->location_id->setQueryStringValue($keyValue);
                $this->location_id->setOldValue($this->location_id->QueryStringValue);
            } elseif (Post("location_id") !== null) {
                $this->location_id->setFormValue(Post("location_id"));
                $this->location_id->setOldValue($this->location_id->FormValue);
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
                if (($keyValue = Get("location_id") ?? Route("location_id")) !== null) {
                    $this->location_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->location_id->CurrentValue = null;
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
                    $this->terminate("LocationList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "LocationList") {
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

        // Check field name 'location_id' first before field var 'x_location_id'
        $val = $CurrentForm->hasValue("location_id") ? $CurrentForm->getValue("location_id") : $CurrentForm->getValue("x_location_id");
        if (!$this->location_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_id->Visible = false; // Disable update for API request
            } else {
                $this->location_id->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_location_id")) {
            $this->location_id->setOldValue($CurrentForm->getValue("o_location_id"));
        }

        // Check field name 'location_name' first before field var 'x_location_name'
        $val = $CurrentForm->hasValue("location_name") ? $CurrentForm->getValue("location_name") : $CurrentForm->getValue("x_location_name");
        if (!$this->location_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_name->Visible = false; // Disable update for API request
            } else {
                $this->location_name->setFormValue($val);
            }
        }

        // Check field name 'location_url' first before field var 'x_location_url'
        $val = $CurrentForm->hasValue("location_url") ? $CurrentForm->getValue("location_url") : $CurrentForm->getValue("x_location_url");
        if (!$this->location_url->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location_url->Visible = false; // Disable update for API request
            } else {
                $this->location_url->setFormValue($val);
            }
        }

        // Check field name 'group_id' first before field var 'x_group_id'
        $val = $CurrentForm->hasValue("group_id") ? $CurrentForm->getValue("group_id") : $CurrentForm->getValue("x_group_id");
        if (!$this->group_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->group_id->Visible = false; // Disable update for API request
            } else {
                $this->group_id->setFormValue($val);
            }
        }

        // Check field name 'active' first before field var 'x_active'
        $val = $CurrentForm->hasValue("active") ? $CurrentForm->getValue("active") : $CurrentForm->getValue("x_active");
        if (!$this->active->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->active->Visible = false; // Disable update for API request
            } else {
                $this->active->setFormValue($val);
            }
        }

        // Check field name 'group_hours' first before field var 'x_group_hours'
        $val = $CurrentForm->hasValue("group_hours") ? $CurrentForm->getValue("group_hours") : $CurrentForm->getValue("x_group_hours");
        if (!$this->group_hours->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->group_hours->Visible = false; // Disable update for API request
            } else {
                $this->group_hours->setFormValue($val);
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

        // Check field name 'subgroup' first before field var 'x_subgroup'
        $val = $CurrentForm->hasValue("subgroup") ? $CurrentForm->getValue("subgroup") : $CurrentForm->getValue("x_subgroup");
        if (!$this->subgroup->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subgroup->Visible = false; // Disable update for API request
            } else {
                $this->subgroup->setFormValue($val);
            }
        }

        // Check field name 'old_id' first before field var 'x_old_id'
        $val = $CurrentForm->hasValue("old_id") ? $CurrentForm->getValue("old_id") : $CurrentForm->getValue("x_old_id");
        if (!$this->old_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->old_id->Visible = false; // Disable update for API request
            } else {
                $this->old_id->setFormValue($val);
            }
        }

        // Check field name 'short_name' first before field var 'x_short_name'
        $val = $CurrentForm->hasValue("short_name") ? $CurrentForm->getValue("short_name") : $CurrentForm->getValue("x_short_name");
        if (!$this->short_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->short_name->Visible = false; // Disable update for API request
            } else {
                $this->short_name->setFormValue($val);
            }
        }

        // Check field name 'accept_plus_discount' first before field var 'x_accept_plus_discount'
        $val = $CurrentForm->hasValue("accept_plus_discount") ? $CurrentForm->getValue("accept_plus_discount") : $CurrentForm->getValue("x_accept_plus_discount");
        if (!$this->accept_plus_discount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->accept_plus_discount->Visible = false; // Disable update for API request
            } else {
                $this->accept_plus_discount->setFormValue($val);
            }
        }

        // Check field name 'lat' first before field var 'x_lat'
        $val = $CurrentForm->hasValue("lat") ? $CurrentForm->getValue("lat") : $CurrentForm->getValue("x_lat");
        if (!$this->lat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lat->Visible = false; // Disable update for API request
            } else {
                $this->lat->setFormValue($val);
            }
        }

        // Check field name 'long' first before field var 'x_long'
        $val = $CurrentForm->hasValue("long") ? $CurrentForm->getValue("long") : $CurrentForm->getValue("x_long");
        if (!$this->long->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->long->Visible = false; // Disable update for API request
            } else {
                $this->long->setFormValue($val);
            }
        }

        // Check field name 'ua_mobile_categories' first before field var 'x_ua_mobile_categories'
        $val = $CurrentForm->hasValue("ua_mobile_categories") ? $CurrentForm->getValue("ua_mobile_categories") : $CurrentForm->getValue("x_ua_mobile_categories");
        if (!$this->ua_mobile_categories->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ua_mobile_categories->Visible = false; // Disable update for API request
            } else {
                $this->ua_mobile_categories->setFormValue($val);
            }
        }

        // Check field name 'breakfast' first before field var 'x_breakfast'
        $val = $CurrentForm->hasValue("breakfast") ? $CurrentForm->getValue("breakfast") : $CurrentForm->getValue("x_breakfast");
        if (!$this->breakfast->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->breakfast->Visible = false; // Disable update for API request
            } else {
                $this->breakfast->setFormValue($val);
            }
        }

        // Check field name 'lunch' first before field var 'x_lunch'
        $val = $CurrentForm->hasValue("lunch") ? $CurrentForm->getValue("lunch") : $CurrentForm->getValue("x_lunch");
        if (!$this->lunch->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lunch->Visible = false; // Disable update for API request
            } else {
                $this->lunch->setFormValue($val);
            }
        }

        // Check field name 'dinner' first before field var 'x_dinner'
        $val = $CurrentForm->hasValue("dinner") ? $CurrentForm->getValue("dinner") : $CurrentForm->getValue("x_dinner");
        if (!$this->dinner->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dinner->Visible = false; // Disable update for API request
            } else {
                $this->dinner->setFormValue($val);
            }
        }

        // Check field name 'continuous' first before field var 'x_continuous'
        $val = $CurrentForm->hasValue("continuous") ? $CurrentForm->getValue("continuous") : $CurrentForm->getValue("x_continuous");
        if (!$this->continuous->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->continuous->Visible = false; // Disable update for API request
            } else {
                $this->continuous->setFormValue($val);
            }
        }

        // Check field name 'hours_message' first before field var 'x_hours_message'
        $val = $CurrentForm->hasValue("hours_message") ? $CurrentForm->getValue("hours_message") : $CurrentForm->getValue("x_hours_message");
        if (!$this->hours_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hours_message->Visible = false; // Disable update for API request
            } else {
                $this->hours_message->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->location_id->CurrentValue = $this->location_id->FormValue;
        $this->location_name->CurrentValue = $this->location_name->FormValue;
        $this->location_url->CurrentValue = $this->location_url->FormValue;
        $this->group_id->CurrentValue = $this->group_id->FormValue;
        $this->active->CurrentValue = $this->active->FormValue;
        $this->group_hours->CurrentValue = $this->group_hours->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
        $this->subgroup->CurrentValue = $this->subgroup->FormValue;
        $this->old_id->CurrentValue = $this->old_id->FormValue;
        $this->short_name->CurrentValue = $this->short_name->FormValue;
        $this->accept_plus_discount->CurrentValue = $this->accept_plus_discount->FormValue;
        $this->lat->CurrentValue = $this->lat->FormValue;
        $this->long->CurrentValue = $this->long->FormValue;
        $this->ua_mobile_categories->CurrentValue = $this->ua_mobile_categories->FormValue;
        $this->breakfast->CurrentValue = $this->breakfast->FormValue;
        $this->lunch->CurrentValue = $this->lunch->FormValue;
        $this->dinner->CurrentValue = $this->dinner->FormValue;
        $this->continuous->CurrentValue = $this->continuous->FormValue;
        $this->hours_message->CurrentValue = $this->hours_message->FormValue;
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
        $this->location_id->setDbValue($row['location_id']);
        $this->location_name->setDbValue($row['location_name']);
        $this->location_url->setDbValue($row['location_url']);
        $this->group_id->setDbValue($row['group_id']);
        $this->active->setDbValue($row['active']);
        $this->group_hours->setDbValue($row['group_hours']);
        $this->phone->setDbValue($row['phone']);
        $this->subgroup->setDbValue($row['subgroup']);
        $this->old_id->setDbValue($row['old_id']);
        $this->short_name->setDbValue($row['short_name']);
        $this->accept_plus_discount->setDbValue($row['accept_plus_discount']);
        $this->lat->setDbValue($row['lat']);
        $this->long->setDbValue($row['long']);
        $this->ua_mobile_categories->setDbValue($row['ua_mobile_categories']);
        $this->breakfast->setDbValue($row['breakfast']);
        $this->lunch->setDbValue($row['lunch']);
        $this->dinner->setDbValue($row['dinner']);
        $this->continuous->setDbValue($row['continuous']);
        $this->hours_message->setDbValue($row['hours_message']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['location_id'] = null;
        $row['location_name'] = null;
        $row['location_url'] = null;
        $row['group_id'] = null;
        $row['active'] = null;
        $row['group_hours'] = null;
        $row['phone'] = null;
        $row['subgroup'] = null;
        $row['old_id'] = null;
        $row['short_name'] = null;
        $row['accept_plus_discount'] = null;
        $row['lat'] = null;
        $row['long'] = null;
        $row['ua_mobile_categories'] = null;
        $row['breakfast'] = null;
        $row['lunch'] = null;
        $row['dinner'] = null;
        $row['continuous'] = null;
        $row['hours_message'] = null;
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

        // location_name

        // location_url

        // group_id

        // active

        // group_hours

        // phone

        // subgroup

        // old_id

        // short_name

        // accept_plus_discount

        // lat

        // long

        // ua_mobile_categories

        // breakfast

        // lunch

        // dinner

        // continuous

        // hours_message
        if ($this->RowType == ROWTYPE_VIEW) {
            // location_id
            $this->location_id->ViewValue = $this->location_id->CurrentValue;
            $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, 0, -2, -2, -2);
            $this->location_id->ViewCustomAttributes = "";

            // location_name
            $this->location_name->ViewValue = $this->location_name->CurrentValue;
            $this->location_name->ViewCustomAttributes = "";

            // location_url
            $this->location_url->ViewValue = $this->location_url->CurrentValue;
            $this->location_url->ViewCustomAttributes = "";

            // group_id
            $this->group_id->ViewValue = $this->group_id->CurrentValue;
            $this->group_id->ViewValue = FormatNumber($this->group_id->ViewValue, 0, -2, -2, -2);
            $this->group_id->ViewCustomAttributes = "";

            // active
            $this->active->ViewValue = $this->active->CurrentValue;
            $this->active->ViewCustomAttributes = "";

            // group_hours
            if (strval($this->group_hours->CurrentValue) != "") {
                $this->group_hours->ViewValue = $this->group_hours->optionCaption($this->group_hours->CurrentValue);
            } else {
                $this->group_hours->ViewValue = null;
            }
            $this->group_hours->ViewCustomAttributes = "";

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;
            $this->phone->ViewCustomAttributes = "";

            // subgroup
            $this->subgroup->ViewValue = $this->subgroup->CurrentValue;
            $this->subgroup->ViewCustomAttributes = "";

            // old_id
            $this->old_id->ViewValue = $this->old_id->CurrentValue;
            $this->old_id->ViewValue = FormatNumber($this->old_id->ViewValue, 0, -2, -2, -2);
            $this->old_id->ViewCustomAttributes = "";

            // short_name
            $this->short_name->ViewValue = $this->short_name->CurrentValue;
            $this->short_name->ViewCustomAttributes = "";

            // accept_plus_discount
            $this->accept_plus_discount->ViewValue = $this->accept_plus_discount->CurrentValue;
            $this->accept_plus_discount->ViewValue = FormatNumber($this->accept_plus_discount->ViewValue, 0, -2, -2, -2);
            $this->accept_plus_discount->ViewCustomAttributes = "";

            // lat
            $this->lat->ViewValue = $this->lat->CurrentValue;
            $this->lat->ViewCustomAttributes = "";

            // long
            $this->long->ViewValue = $this->long->CurrentValue;
            $this->long->ViewCustomAttributes = "";

            // ua_mobile_categories
            $this->ua_mobile_categories->ViewValue = $this->ua_mobile_categories->CurrentValue;
            $this->ua_mobile_categories->ViewCustomAttributes = "";

            // breakfast
            if (strval($this->breakfast->CurrentValue) != "") {
                $this->breakfast->ViewValue = $this->breakfast->optionCaption($this->breakfast->CurrentValue);
            } else {
                $this->breakfast->ViewValue = null;
            }
            $this->breakfast->ViewCustomAttributes = "";

            // lunch
            if (strval($this->lunch->CurrentValue) != "") {
                $this->lunch->ViewValue = $this->lunch->optionCaption($this->lunch->CurrentValue);
            } else {
                $this->lunch->ViewValue = null;
            }
            $this->lunch->ViewCustomAttributes = "";

            // dinner
            if (strval($this->dinner->CurrentValue) != "") {
                $this->dinner->ViewValue = $this->dinner->optionCaption($this->dinner->CurrentValue);
            } else {
                $this->dinner->ViewValue = null;
            }
            $this->dinner->ViewCustomAttributes = "";

            // continuous
            if (strval($this->continuous->CurrentValue) != "") {
                $this->continuous->ViewValue = $this->continuous->optionCaption($this->continuous->CurrentValue);
            } else {
                $this->continuous->ViewValue = null;
            }
            $this->continuous->ViewCustomAttributes = "";

            // hours_message
            $this->hours_message->ViewValue = $this->hours_message->CurrentValue;
            $this->hours_message->ViewCustomAttributes = "";

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";
            $this->location_id->TooltipValue = "";

            // location_name
            $this->location_name->LinkCustomAttributes = "";
            $this->location_name->HrefValue = "";
            $this->location_name->TooltipValue = "";

            // location_url
            $this->location_url->LinkCustomAttributes = "";
            $this->location_url->HrefValue = "";
            $this->location_url->TooltipValue = "";

            // group_id
            $this->group_id->LinkCustomAttributes = "";
            $this->group_id->HrefValue = "";
            $this->group_id->TooltipValue = "";

            // active
            $this->active->LinkCustomAttributes = "";
            $this->active->HrefValue = "";
            $this->active->TooltipValue = "";

            // group_hours
            $this->group_hours->LinkCustomAttributes = "";
            $this->group_hours->HrefValue = "";
            $this->group_hours->TooltipValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";
            $this->phone->TooltipValue = "";

            // subgroup
            $this->subgroup->LinkCustomAttributes = "";
            $this->subgroup->HrefValue = "";
            $this->subgroup->TooltipValue = "";

            // old_id
            $this->old_id->LinkCustomAttributes = "";
            $this->old_id->HrefValue = "";
            $this->old_id->TooltipValue = "";

            // short_name
            $this->short_name->LinkCustomAttributes = "";
            $this->short_name->HrefValue = "";
            $this->short_name->TooltipValue = "";

            // accept_plus_discount
            $this->accept_plus_discount->LinkCustomAttributes = "";
            $this->accept_plus_discount->HrefValue = "";
            $this->accept_plus_discount->TooltipValue = "";

            // lat
            $this->lat->LinkCustomAttributes = "";
            $this->lat->HrefValue = "";
            $this->lat->TooltipValue = "";

            // long
            $this->long->LinkCustomAttributes = "";
            $this->long->HrefValue = "";
            $this->long->TooltipValue = "";

            // ua_mobile_categories
            $this->ua_mobile_categories->LinkCustomAttributes = "";
            $this->ua_mobile_categories->HrefValue = "";
            $this->ua_mobile_categories->TooltipValue = "";

            // breakfast
            $this->breakfast->LinkCustomAttributes = "";
            $this->breakfast->HrefValue = "";
            $this->breakfast->TooltipValue = "";

            // lunch
            $this->lunch->LinkCustomAttributes = "";
            $this->lunch->HrefValue = "";
            $this->lunch->TooltipValue = "";

            // dinner
            $this->dinner->LinkCustomAttributes = "";
            $this->dinner->HrefValue = "";
            $this->dinner->TooltipValue = "";

            // continuous
            $this->continuous->LinkCustomAttributes = "";
            $this->continuous->HrefValue = "";
            $this->continuous->TooltipValue = "";

            // hours_message
            $this->hours_message->LinkCustomAttributes = "";
            $this->hours_message->HrefValue = "";
            $this->hours_message->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // location_id
            $this->location_id->EditAttrs["class"] = "form-control";
            $this->location_id->EditCustomAttributes = "";
            $this->location_id->EditValue = HtmlEncode($this->location_id->CurrentValue);
            $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());

            // location_name
            $this->location_name->EditAttrs["class"] = "form-control";
            $this->location_name->EditCustomAttributes = "";
            $this->location_name->EditValue = HtmlEncode($this->location_name->CurrentValue);
            $this->location_name->PlaceHolder = RemoveHtml($this->location_name->caption());

            // location_url
            $this->location_url->EditAttrs["class"] = "form-control";
            $this->location_url->EditCustomAttributes = "";
            $this->location_url->EditValue = HtmlEncode($this->location_url->CurrentValue);
            $this->location_url->PlaceHolder = RemoveHtml($this->location_url->caption());

            // group_id
            $this->group_id->EditAttrs["class"] = "form-control";
            $this->group_id->EditCustomAttributes = "";
            $this->group_id->EditValue = HtmlEncode($this->group_id->CurrentValue);
            $this->group_id->PlaceHolder = RemoveHtml($this->group_id->caption());

            // active
            $this->active->EditAttrs["class"] = "form-control";
            $this->active->EditCustomAttributes = "";
            $this->active->EditValue = HtmlEncode($this->active->CurrentValue);
            $this->active->PlaceHolder = RemoveHtml($this->active->caption());

            // group_hours
            $this->group_hours->EditCustomAttributes = "";
            $this->group_hours->EditValue = $this->group_hours->options(false);
            $this->group_hours->PlaceHolder = RemoveHtml($this->group_hours->caption());

            // phone
            $this->phone->EditAttrs["class"] = "form-control";
            $this->phone->EditCustomAttributes = "";
            $this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

            // subgroup
            $this->subgroup->EditAttrs["class"] = "form-control";
            $this->subgroup->EditCustomAttributes = "";
            $this->subgroup->EditValue = HtmlEncode($this->subgroup->CurrentValue);
            $this->subgroup->PlaceHolder = RemoveHtml($this->subgroup->caption());

            // old_id
            $this->old_id->EditAttrs["class"] = "form-control";
            $this->old_id->EditCustomAttributes = "";
            $this->old_id->EditValue = HtmlEncode($this->old_id->CurrentValue);
            $this->old_id->PlaceHolder = RemoveHtml($this->old_id->caption());

            // short_name
            $this->short_name->EditAttrs["class"] = "form-control";
            $this->short_name->EditCustomAttributes = "";
            $this->short_name->EditValue = HtmlEncode($this->short_name->CurrentValue);
            $this->short_name->PlaceHolder = RemoveHtml($this->short_name->caption());

            // accept_plus_discount
            $this->accept_plus_discount->EditAttrs["class"] = "form-control";
            $this->accept_plus_discount->EditCustomAttributes = "";
            $this->accept_plus_discount->EditValue = HtmlEncode($this->accept_plus_discount->CurrentValue);
            $this->accept_plus_discount->PlaceHolder = RemoveHtml($this->accept_plus_discount->caption());

            // lat
            $this->lat->EditAttrs["class"] = "form-control";
            $this->lat->EditCustomAttributes = "";
            $this->lat->EditValue = HtmlEncode($this->lat->CurrentValue);
            $this->lat->PlaceHolder = RemoveHtml($this->lat->caption());

            // long
            $this->long->EditAttrs["class"] = "form-control";
            $this->long->EditCustomAttributes = "";
            $this->long->EditValue = HtmlEncode($this->long->CurrentValue);
            $this->long->PlaceHolder = RemoveHtml($this->long->caption());

            // ua_mobile_categories
            $this->ua_mobile_categories->EditAttrs["class"] = "form-control";
            $this->ua_mobile_categories->EditCustomAttributes = "";
            $this->ua_mobile_categories->EditValue = HtmlEncode($this->ua_mobile_categories->CurrentValue);
            $this->ua_mobile_categories->PlaceHolder = RemoveHtml($this->ua_mobile_categories->caption());

            // breakfast
            $this->breakfast->EditCustomAttributes = "";
            $this->breakfast->EditValue = $this->breakfast->options(false);
            $this->breakfast->PlaceHolder = RemoveHtml($this->breakfast->caption());

            // lunch
            $this->lunch->EditCustomAttributes = "";
            $this->lunch->EditValue = $this->lunch->options(false);
            $this->lunch->PlaceHolder = RemoveHtml($this->lunch->caption());

            // dinner
            $this->dinner->EditCustomAttributes = "";
            $this->dinner->EditValue = $this->dinner->options(false);
            $this->dinner->PlaceHolder = RemoveHtml($this->dinner->caption());

            // continuous
            $this->continuous->EditCustomAttributes = "";
            $this->continuous->EditValue = $this->continuous->options(false);
            $this->continuous->PlaceHolder = RemoveHtml($this->continuous->caption());

            // hours_message
            $this->hours_message->EditAttrs["class"] = "form-control";
            $this->hours_message->EditCustomAttributes = "";
            $this->hours_message->EditValue = HtmlEncode($this->hours_message->CurrentValue);
            $this->hours_message->PlaceHolder = RemoveHtml($this->hours_message->caption());

            // Edit refer script

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";

            // location_name
            $this->location_name->LinkCustomAttributes = "";
            $this->location_name->HrefValue = "";

            // location_url
            $this->location_url->LinkCustomAttributes = "";
            $this->location_url->HrefValue = "";

            // group_id
            $this->group_id->LinkCustomAttributes = "";
            $this->group_id->HrefValue = "";

            // active
            $this->active->LinkCustomAttributes = "";
            $this->active->HrefValue = "";

            // group_hours
            $this->group_hours->LinkCustomAttributes = "";
            $this->group_hours->HrefValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";

            // subgroup
            $this->subgroup->LinkCustomAttributes = "";
            $this->subgroup->HrefValue = "";

            // old_id
            $this->old_id->LinkCustomAttributes = "";
            $this->old_id->HrefValue = "";

            // short_name
            $this->short_name->LinkCustomAttributes = "";
            $this->short_name->HrefValue = "";

            // accept_plus_discount
            $this->accept_plus_discount->LinkCustomAttributes = "";
            $this->accept_plus_discount->HrefValue = "";

            // lat
            $this->lat->LinkCustomAttributes = "";
            $this->lat->HrefValue = "";

            // long
            $this->long->LinkCustomAttributes = "";
            $this->long->HrefValue = "";

            // ua_mobile_categories
            $this->ua_mobile_categories->LinkCustomAttributes = "";
            $this->ua_mobile_categories->HrefValue = "";

            // breakfast
            $this->breakfast->LinkCustomAttributes = "";
            $this->breakfast->HrefValue = "";

            // lunch
            $this->lunch->LinkCustomAttributes = "";
            $this->lunch->HrefValue = "";

            // dinner
            $this->dinner->LinkCustomAttributes = "";
            $this->dinner->HrefValue = "";

            // continuous
            $this->continuous->LinkCustomAttributes = "";
            $this->continuous->HrefValue = "";

            // hours_message
            $this->hours_message->LinkCustomAttributes = "";
            $this->hours_message->HrefValue = "";
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
        if ($this->location_name->Required) {
            if (!$this->location_name->IsDetailKey && EmptyValue($this->location_name->FormValue)) {
                $this->location_name->addErrorMessage(str_replace("%s", $this->location_name->caption(), $this->location_name->RequiredErrorMessage));
            }
        }
        if ($this->location_url->Required) {
            if (!$this->location_url->IsDetailKey && EmptyValue($this->location_url->FormValue)) {
                $this->location_url->addErrorMessage(str_replace("%s", $this->location_url->caption(), $this->location_url->RequiredErrorMessage));
            }
        }
        if ($this->group_id->Required) {
            if (!$this->group_id->IsDetailKey && EmptyValue($this->group_id->FormValue)) {
                $this->group_id->addErrorMessage(str_replace("%s", $this->group_id->caption(), $this->group_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->group_id->FormValue)) {
            $this->group_id->addErrorMessage($this->group_id->getErrorMessage(false));
        }
        if ($this->active->Required) {
            if (!$this->active->IsDetailKey && EmptyValue($this->active->FormValue)) {
                $this->active->addErrorMessage(str_replace("%s", $this->active->caption(), $this->active->RequiredErrorMessage));
            }
        }
        if ($this->group_hours->Required) {
            if ($this->group_hours->FormValue == "") {
                $this->group_hours->addErrorMessage(str_replace("%s", $this->group_hours->caption(), $this->group_hours->RequiredErrorMessage));
            }
        }
        if ($this->phone->Required) {
            if (!$this->phone->IsDetailKey && EmptyValue($this->phone->FormValue)) {
                $this->phone->addErrorMessage(str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
            }
        }
        if ($this->subgroup->Required) {
            if (!$this->subgroup->IsDetailKey && EmptyValue($this->subgroup->FormValue)) {
                $this->subgroup->addErrorMessage(str_replace("%s", $this->subgroup->caption(), $this->subgroup->RequiredErrorMessage));
            }
        }
        if ($this->old_id->Required) {
            if (!$this->old_id->IsDetailKey && EmptyValue($this->old_id->FormValue)) {
                $this->old_id->addErrorMessage(str_replace("%s", $this->old_id->caption(), $this->old_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->old_id->FormValue)) {
            $this->old_id->addErrorMessage($this->old_id->getErrorMessage(false));
        }
        if ($this->short_name->Required) {
            if (!$this->short_name->IsDetailKey && EmptyValue($this->short_name->FormValue)) {
                $this->short_name->addErrorMessage(str_replace("%s", $this->short_name->caption(), $this->short_name->RequiredErrorMessage));
            }
        }
        if ($this->accept_plus_discount->Required) {
            if (!$this->accept_plus_discount->IsDetailKey && EmptyValue($this->accept_plus_discount->FormValue)) {
                $this->accept_plus_discount->addErrorMessage(str_replace("%s", $this->accept_plus_discount->caption(), $this->accept_plus_discount->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->accept_plus_discount->FormValue)) {
            $this->accept_plus_discount->addErrorMessage($this->accept_plus_discount->getErrorMessage(false));
        }
        if ($this->lat->Required) {
            if (!$this->lat->IsDetailKey && EmptyValue($this->lat->FormValue)) {
                $this->lat->addErrorMessage(str_replace("%s", $this->lat->caption(), $this->lat->RequiredErrorMessage));
            }
        }
        if ($this->long->Required) {
            if (!$this->long->IsDetailKey && EmptyValue($this->long->FormValue)) {
                $this->long->addErrorMessage(str_replace("%s", $this->long->caption(), $this->long->RequiredErrorMessage));
            }
        }
        if ($this->ua_mobile_categories->Required) {
            if (!$this->ua_mobile_categories->IsDetailKey && EmptyValue($this->ua_mobile_categories->FormValue)) {
                $this->ua_mobile_categories->addErrorMessage(str_replace("%s", $this->ua_mobile_categories->caption(), $this->ua_mobile_categories->RequiredErrorMessage));
            }
        }
        if ($this->breakfast->Required) {
            if ($this->breakfast->FormValue == "") {
                $this->breakfast->addErrorMessage(str_replace("%s", $this->breakfast->caption(), $this->breakfast->RequiredErrorMessage));
            }
        }
        if ($this->lunch->Required) {
            if ($this->lunch->FormValue == "") {
                $this->lunch->addErrorMessage(str_replace("%s", $this->lunch->caption(), $this->lunch->RequiredErrorMessage));
            }
        }
        if ($this->dinner->Required) {
            if ($this->dinner->FormValue == "") {
                $this->dinner->addErrorMessage(str_replace("%s", $this->dinner->caption(), $this->dinner->RequiredErrorMessage));
            }
        }
        if ($this->continuous->Required) {
            if ($this->continuous->FormValue == "") {
                $this->continuous->addErrorMessage(str_replace("%s", $this->continuous->caption(), $this->continuous->RequiredErrorMessage));
            }
        }
        if ($this->hours_message->Required) {
            if (!$this->hours_message->IsDetailKey && EmptyValue($this->hours_message->FormValue)) {
                $this->hours_message->addErrorMessage(str_replace("%s", $this->hours_message->caption(), $this->hours_message->RequiredErrorMessage));
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

            // location_name
            $this->location_name->setDbValueDef($rsnew, $this->location_name->CurrentValue, null, $this->location_name->ReadOnly);

            // location_url
            $this->location_url->setDbValueDef($rsnew, $this->location_url->CurrentValue, null, $this->location_url->ReadOnly);

            // group_id
            $this->group_id->setDbValueDef($rsnew, $this->group_id->CurrentValue, null, $this->group_id->ReadOnly);

            // active
            $this->active->setDbValueDef($rsnew, $this->active->CurrentValue, null, $this->active->ReadOnly);

            // group_hours
            $this->group_hours->setDbValueDef($rsnew, $this->group_hours->CurrentValue, null, $this->group_hours->ReadOnly);

            // phone
            $this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, null, $this->phone->ReadOnly);

            // subgroup
            $this->subgroup->setDbValueDef($rsnew, $this->subgroup->CurrentValue, null, $this->subgroup->ReadOnly);

            // old_id
            $this->old_id->setDbValueDef($rsnew, $this->old_id->CurrentValue, null, $this->old_id->ReadOnly);

            // short_name
            $this->short_name->setDbValueDef($rsnew, $this->short_name->CurrentValue, null, $this->short_name->ReadOnly);

            // accept_plus_discount
            $this->accept_plus_discount->setDbValueDef($rsnew, $this->accept_plus_discount->CurrentValue, null, $this->accept_plus_discount->ReadOnly);

            // lat
            $this->lat->setDbValueDef($rsnew, $this->lat->CurrentValue, null, $this->lat->ReadOnly);

            // long
            $this->long->setDbValueDef($rsnew, $this->long->CurrentValue, null, $this->long->ReadOnly);

            // ua_mobile_categories
            $this->ua_mobile_categories->setDbValueDef($rsnew, $this->ua_mobile_categories->CurrentValue, "", $this->ua_mobile_categories->ReadOnly);

            // breakfast
            $this->breakfast->setDbValueDef($rsnew, $this->breakfast->CurrentValue, "", $this->breakfast->ReadOnly);

            // lunch
            $this->lunch->setDbValueDef($rsnew, $this->lunch->CurrentValue, "", $this->lunch->ReadOnly);

            // dinner
            $this->dinner->setDbValueDef($rsnew, $this->dinner->CurrentValue, "", $this->dinner->ReadOnly);

            // continuous
            $this->continuous->setDbValueDef($rsnew, $this->continuous->CurrentValue, "", $this->continuous->ReadOnly);

            // hours_message
            $this->hours_message->setDbValueDef($rsnew, $this->hours_message->CurrentValue, null, $this->hours_message->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("LocationList"), "", $this->TableVar, true);
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
                case "x_group_hours":
                    break;
                case "x_breakfast":
                    break;
                case "x_lunch":
                    break;
                case "x_dinner":
                    break;
                case "x_continuous":
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
