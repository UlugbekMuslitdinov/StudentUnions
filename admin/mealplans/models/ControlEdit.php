<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ControlEdit extends Control
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'control';

    // Page object name
    public $PageObjName = "ControlEdit";

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

        // Table object (control)
        if (!isset($GLOBALS["control"]) || get_class($GLOBALS["control"]) == PROJECT_NAMESPACE . "control") {
            $GLOBALS["control"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'control');
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
                $tbl = Container("control");
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
                    if ($pageName == "ControlView") {
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
            $key .= @$ar['ID'];
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
            $this->ID->Visible = false;
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

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->ID->setVisibility();
        $this->online->setVisibility();
        $this->online_message->setVisibility();
        $this->signup_bursars->setVisibility();
        $this->signup_bursars_message->setVisibility();
        $this->signup_cc->setVisibility();
        $this->signup_cc_message->setVisibility();
        $this->deposit_bursars->setVisibility();
        $this->deposit_bursars_message->setVisibility();
        $this->deposit_cc->setVisibility();
        $this->deposit_cc_message->setVisibility();
        $this->exporter->setVisibility();
        $this->signup->setVisibility();
        $this->signup_message->setVisibility();
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
        $this->setupLookupOptions($this->online);
        $this->setupLookupOptions($this->signup_bursars);
        $this->setupLookupOptions($this->signup_cc);
        $this->setupLookupOptions($this->deposit_bursars);
        $this->setupLookupOptions($this->deposit_cc);
        $this->setupLookupOptions($this->exporter);
        $this->setupLookupOptions($this->signup);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("ID") ?? Key(0) ?? Route(2)) !== null) {
                $this->ID->setQueryStringValue($keyValue);
                $this->ID->setOldValue($this->ID->QueryStringValue);
            } elseif (Post("ID") !== null) {
                $this->ID->setFormValue(Post("ID"));
                $this->ID->setOldValue($this->ID->FormValue);
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
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("ID") ?? Route("ID")) !== null) {
                    $this->ID->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->ID->CurrentValue = null;
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
                    $this->terminate("ControlList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ControlList") {
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
        if (!$this->ID->IsDetailKey) {
            $this->ID->setFormValue($val);
        }

        // Check field name 'online' first before field var 'x_online'
        $val = $CurrentForm->hasValue("online") ? $CurrentForm->getValue("online") : $CurrentForm->getValue("x_online");
        if (!$this->online->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->online->Visible = false; // Disable update for API request
            } else {
                $this->online->setFormValue($val);
            }
        }

        // Check field name 'online_message' first before field var 'x_online_message'
        $val = $CurrentForm->hasValue("online_message") ? $CurrentForm->getValue("online_message") : $CurrentForm->getValue("x_online_message");
        if (!$this->online_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->online_message->Visible = false; // Disable update for API request
            } else {
                $this->online_message->setFormValue($val);
            }
        }

        // Check field name 'signup_bursars' first before field var 'x_signup_bursars'
        $val = $CurrentForm->hasValue("signup_bursars") ? $CurrentForm->getValue("signup_bursars") : $CurrentForm->getValue("x_signup_bursars");
        if (!$this->signup_bursars->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->signup_bursars->Visible = false; // Disable update for API request
            } else {
                $this->signup_bursars->setFormValue($val);
            }
        }

        // Check field name 'signup_bursars_message' first before field var 'x_signup_bursars_message'
        $val = $CurrentForm->hasValue("signup_bursars_message") ? $CurrentForm->getValue("signup_bursars_message") : $CurrentForm->getValue("x_signup_bursars_message");
        if (!$this->signup_bursars_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->signup_bursars_message->Visible = false; // Disable update for API request
            } else {
                $this->signup_bursars_message->setFormValue($val);
            }
        }

        // Check field name 'signup_cc' first before field var 'x_signup_cc'
        $val = $CurrentForm->hasValue("signup_cc") ? $CurrentForm->getValue("signup_cc") : $CurrentForm->getValue("x_signup_cc");
        if (!$this->signup_cc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->signup_cc->Visible = false; // Disable update for API request
            } else {
                $this->signup_cc->setFormValue($val);
            }
        }

        // Check field name 'signup_cc_message' first before field var 'x_signup_cc_message'
        $val = $CurrentForm->hasValue("signup_cc_message") ? $CurrentForm->getValue("signup_cc_message") : $CurrentForm->getValue("x_signup_cc_message");
        if (!$this->signup_cc_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->signup_cc_message->Visible = false; // Disable update for API request
            } else {
                $this->signup_cc_message->setFormValue($val);
            }
        }

        // Check field name 'deposit_bursars' first before field var 'x_deposit_bursars'
        $val = $CurrentForm->hasValue("deposit_bursars") ? $CurrentForm->getValue("deposit_bursars") : $CurrentForm->getValue("x_deposit_bursars");
        if (!$this->deposit_bursars->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deposit_bursars->Visible = false; // Disable update for API request
            } else {
                $this->deposit_bursars->setFormValue($val);
            }
        }

        // Check field name 'deposit_bursars_message' first before field var 'x_deposit_bursars_message'
        $val = $CurrentForm->hasValue("deposit_bursars_message") ? $CurrentForm->getValue("deposit_bursars_message") : $CurrentForm->getValue("x_deposit_bursars_message");
        if (!$this->deposit_bursars_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deposit_bursars_message->Visible = false; // Disable update for API request
            } else {
                $this->deposit_bursars_message->setFormValue($val);
            }
        }

        // Check field name 'deposit_cc' first before field var 'x_deposit_cc'
        $val = $CurrentForm->hasValue("deposit_cc") ? $CurrentForm->getValue("deposit_cc") : $CurrentForm->getValue("x_deposit_cc");
        if (!$this->deposit_cc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deposit_cc->Visible = false; // Disable update for API request
            } else {
                $this->deposit_cc->setFormValue($val);
            }
        }

        // Check field name 'deposit_cc_message' first before field var 'x_deposit_cc_message'
        $val = $CurrentForm->hasValue("deposit_cc_message") ? $CurrentForm->getValue("deposit_cc_message") : $CurrentForm->getValue("x_deposit_cc_message");
        if (!$this->deposit_cc_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deposit_cc_message->Visible = false; // Disable update for API request
            } else {
                $this->deposit_cc_message->setFormValue($val);
            }
        }

        // Check field name 'exporter' first before field var 'x_exporter'
        $val = $CurrentForm->hasValue("exporter") ? $CurrentForm->getValue("exporter") : $CurrentForm->getValue("x_exporter");
        if (!$this->exporter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->exporter->Visible = false; // Disable update for API request
            } else {
                $this->exporter->setFormValue($val);
            }
        }

        // Check field name 'signup' first before field var 'x_signup'
        $val = $CurrentForm->hasValue("signup") ? $CurrentForm->getValue("signup") : $CurrentForm->getValue("x_signup");
        if (!$this->signup->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->signup->Visible = false; // Disable update for API request
            } else {
                $this->signup->setFormValue($val);
            }
        }

        // Check field name 'signup_message' first before field var 'x_signup_message'
        $val = $CurrentForm->hasValue("signup_message") ? $CurrentForm->getValue("signup_message") : $CurrentForm->getValue("x_signup_message");
        if (!$this->signup_message->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->signup_message->Visible = false; // Disable update for API request
            } else {
                $this->signup_message->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ID->CurrentValue = $this->ID->FormValue;
        $this->online->CurrentValue = $this->online->FormValue;
        $this->online_message->CurrentValue = $this->online_message->FormValue;
        $this->signup_bursars->CurrentValue = $this->signup_bursars->FormValue;
        $this->signup_bursars_message->CurrentValue = $this->signup_bursars_message->FormValue;
        $this->signup_cc->CurrentValue = $this->signup_cc->FormValue;
        $this->signup_cc_message->CurrentValue = $this->signup_cc_message->FormValue;
        $this->deposit_bursars->CurrentValue = $this->deposit_bursars->FormValue;
        $this->deposit_bursars_message->CurrentValue = $this->deposit_bursars_message->FormValue;
        $this->deposit_cc->CurrentValue = $this->deposit_cc->FormValue;
        $this->deposit_cc_message->CurrentValue = $this->deposit_cc_message->FormValue;
        $this->exporter->CurrentValue = $this->exporter->FormValue;
        $this->signup->CurrentValue = $this->signup->FormValue;
        $this->signup_message->CurrentValue = $this->signup_message->FormValue;
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
        $this->ID->setDbValue($row['ID']);
        $this->online->setDbValue($row['online']);
        $this->online_message->setDbValue($row['online_message']);
        $this->signup_bursars->setDbValue($row['signup_bursars']);
        $this->signup_bursars_message->setDbValue($row['signup_bursars_message']);
        $this->signup_cc->setDbValue($row['signup_cc']);
        $this->signup_cc_message->setDbValue($row['signup_cc_message']);
        $this->deposit_bursars->setDbValue($row['deposit_bursars']);
        $this->deposit_bursars_message->setDbValue($row['deposit_bursars_message']);
        $this->deposit_cc->setDbValue($row['deposit_cc']);
        $this->deposit_cc_message->setDbValue($row['deposit_cc_message']);
        $this->exporter->setDbValue($row['exporter']);
        $this->signup->setDbValue($row['signup']);
        $this->signup_message->setDbValue($row['signup_message']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ID'] = null;
        $row['online'] = null;
        $row['online_message'] = null;
        $row['signup_bursars'] = null;
        $row['signup_bursars_message'] = null;
        $row['signup_cc'] = null;
        $row['signup_cc_message'] = null;
        $row['deposit_bursars'] = null;
        $row['deposit_bursars_message'] = null;
        $row['deposit_cc'] = null;
        $row['deposit_cc_message'] = null;
        $row['exporter'] = null;
        $row['signup'] = null;
        $row['signup_message'] = null;
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

        // ID
        $this->ID->RowCssClass = "row";

        // online
        $this->online->RowCssClass = "row";

        // online_message
        $this->online_message->RowCssClass = "row";

        // signup_bursars
        $this->signup_bursars->RowCssClass = "row";

        // signup_bursars_message
        $this->signup_bursars_message->RowCssClass = "row";

        // signup_cc
        $this->signup_cc->RowCssClass = "row";

        // signup_cc_message
        $this->signup_cc_message->RowCssClass = "row";

        // deposit_bursars
        $this->deposit_bursars->RowCssClass = "row";

        // deposit_bursars_message
        $this->deposit_bursars_message->RowCssClass = "row";

        // deposit_cc
        $this->deposit_cc->RowCssClass = "row";

        // deposit_cc_message
        $this->deposit_cc_message->RowCssClass = "row";

        // exporter
        $this->exporter->RowCssClass = "row";

        // signup
        $this->signup->RowCssClass = "row";

        // signup_message
        $this->signup_message->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // online
            if (ConvertToBool($this->online->CurrentValue)) {
                $this->online->ViewValue = $this->online->tagCaption(1) != "" ? $this->online->tagCaption(1) : "Yes";
            } else {
                $this->online->ViewValue = $this->online->tagCaption(2) != "" ? $this->online->tagCaption(2) : "No";
            }
            $this->online->ViewCustomAttributes = "";

            // online_message
            $this->online_message->ViewValue = $this->online_message->CurrentValue;
            $this->online_message->ViewCustomAttributes = "";

            // signup_bursars
            if (ConvertToBool($this->signup_bursars->CurrentValue)) {
                $this->signup_bursars->ViewValue = $this->signup_bursars->tagCaption(1) != "" ? $this->signup_bursars->tagCaption(1) : "Yes";
            } else {
                $this->signup_bursars->ViewValue = $this->signup_bursars->tagCaption(2) != "" ? $this->signup_bursars->tagCaption(2) : "No";
            }
            $this->signup_bursars->ViewCustomAttributes = "";

            // signup_bursars_message
            $this->signup_bursars_message->ViewValue = $this->signup_bursars_message->CurrentValue;
            $this->signup_bursars_message->ViewCustomAttributes = "";

            // signup_cc
            if (ConvertToBool($this->signup_cc->CurrentValue)) {
                $this->signup_cc->ViewValue = $this->signup_cc->tagCaption(1) != "" ? $this->signup_cc->tagCaption(1) : "Yes";
            } else {
                $this->signup_cc->ViewValue = $this->signup_cc->tagCaption(2) != "" ? $this->signup_cc->tagCaption(2) : "No";
            }
            $this->signup_cc->ViewCustomAttributes = "";

            // signup_cc_message
            $this->signup_cc_message->ViewValue = $this->signup_cc_message->CurrentValue;
            $this->signup_cc_message->ViewCustomAttributes = "";

            // deposit_bursars
            if (ConvertToBool($this->deposit_bursars->CurrentValue)) {
                $this->deposit_bursars->ViewValue = $this->deposit_bursars->tagCaption(1) != "" ? $this->deposit_bursars->tagCaption(1) : "Yes";
            } else {
                $this->deposit_bursars->ViewValue = $this->deposit_bursars->tagCaption(2) != "" ? $this->deposit_bursars->tagCaption(2) : "No";
            }
            $this->deposit_bursars->ViewCustomAttributes = "";

            // deposit_bursars_message
            $this->deposit_bursars_message->ViewValue = $this->deposit_bursars_message->CurrentValue;
            $this->deposit_bursars_message->ViewCustomAttributes = "";

            // deposit_cc
            if (ConvertToBool($this->deposit_cc->CurrentValue)) {
                $this->deposit_cc->ViewValue = $this->deposit_cc->tagCaption(1) != "" ? $this->deposit_cc->tagCaption(1) : "Yes";
            } else {
                $this->deposit_cc->ViewValue = $this->deposit_cc->tagCaption(2) != "" ? $this->deposit_cc->tagCaption(2) : "No";
            }
            $this->deposit_cc->ViewCustomAttributes = "";

            // deposit_cc_message
            $this->deposit_cc_message->ViewValue = $this->deposit_cc_message->CurrentValue;
            $this->deposit_cc_message->ViewCustomAttributes = "";

            // exporter
            if (ConvertToBool($this->exporter->CurrentValue)) {
                $this->exporter->ViewValue = $this->exporter->tagCaption(1) != "" ? $this->exporter->tagCaption(1) : "Yes";
            } else {
                $this->exporter->ViewValue = $this->exporter->tagCaption(2) != "" ? $this->exporter->tagCaption(2) : "No";
            }
            $this->exporter->ViewCustomAttributes = "";

            // signup
            if (ConvertToBool($this->signup->CurrentValue)) {
                $this->signup->ViewValue = $this->signup->tagCaption(1) != "" ? $this->signup->tagCaption(1) : "Yes";
            } else {
                $this->signup->ViewValue = $this->signup->tagCaption(2) != "" ? $this->signup->tagCaption(2) : "No";
            }
            $this->signup->ViewCustomAttributes = "";

            // signup_message
            $this->signup_message->ViewValue = $this->signup_message->CurrentValue;
            $this->signup_message->ViewCustomAttributes = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";

            // online
            $this->online->LinkCustomAttributes = "";
            $this->online->HrefValue = "";

            // online_message
            $this->online_message->LinkCustomAttributes = "";
            $this->online_message->HrefValue = "";

            // signup_bursars
            $this->signup_bursars->LinkCustomAttributes = "";
            $this->signup_bursars->HrefValue = "";

            // signup_bursars_message
            $this->signup_bursars_message->LinkCustomAttributes = "";
            $this->signup_bursars_message->HrefValue = "";

            // signup_cc
            $this->signup_cc->LinkCustomAttributes = "";
            $this->signup_cc->HrefValue = "";

            // signup_cc_message
            $this->signup_cc_message->LinkCustomAttributes = "";
            $this->signup_cc_message->HrefValue = "";

            // deposit_bursars
            $this->deposit_bursars->LinkCustomAttributes = "";
            $this->deposit_bursars->HrefValue = "";

            // deposit_bursars_message
            $this->deposit_bursars_message->LinkCustomAttributes = "";
            $this->deposit_bursars_message->HrefValue = "";

            // deposit_cc
            $this->deposit_cc->LinkCustomAttributes = "";
            $this->deposit_cc->HrefValue = "";

            // deposit_cc_message
            $this->deposit_cc_message->LinkCustomAttributes = "";
            $this->deposit_cc_message->HrefValue = "";

            // exporter
            $this->exporter->LinkCustomAttributes = "";
            $this->exporter->HrefValue = "";

            // signup
            $this->signup->LinkCustomAttributes = "";
            $this->signup->HrefValue = "";

            // signup_message
            $this->signup_message->LinkCustomAttributes = "";
            $this->signup_message->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // ID
            $this->ID->setupEditAttributes();
            $this->ID->EditCustomAttributes = "";
            $this->ID->EditValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // online
            $this->online->EditCustomAttributes = "";
            $this->online->EditValue = $this->online->options(false);
            $this->online->PlaceHolder = RemoveHtml($this->online->caption());

            // online_message
            $this->online_message->setupEditAttributes();
            $this->online_message->EditCustomAttributes = "";
            $this->online_message->EditValue = HtmlEncode($this->online_message->CurrentValue);
            $this->online_message->PlaceHolder = RemoveHtml($this->online_message->caption());

            // signup_bursars
            $this->signup_bursars->EditCustomAttributes = "";
            $this->signup_bursars->EditValue = $this->signup_bursars->options(false);
            $this->signup_bursars->PlaceHolder = RemoveHtml($this->signup_bursars->caption());

            // signup_bursars_message
            $this->signup_bursars_message->setupEditAttributes();
            $this->signup_bursars_message->EditCustomAttributes = "";
            $this->signup_bursars_message->EditValue = HtmlEncode($this->signup_bursars_message->CurrentValue);
            $this->signup_bursars_message->PlaceHolder = RemoveHtml($this->signup_bursars_message->caption());

            // signup_cc
            $this->signup_cc->EditCustomAttributes = "";
            $this->signup_cc->EditValue = $this->signup_cc->options(false);
            $this->signup_cc->PlaceHolder = RemoveHtml($this->signup_cc->caption());

            // signup_cc_message
            $this->signup_cc_message->setupEditAttributes();
            $this->signup_cc_message->EditCustomAttributes = "";
            $this->signup_cc_message->EditValue = HtmlEncode($this->signup_cc_message->CurrentValue);
            $this->signup_cc_message->PlaceHolder = RemoveHtml($this->signup_cc_message->caption());

            // deposit_bursars
            $this->deposit_bursars->EditCustomAttributes = "";
            $this->deposit_bursars->EditValue = $this->deposit_bursars->options(false);
            $this->deposit_bursars->PlaceHolder = RemoveHtml($this->deposit_bursars->caption());

            // deposit_bursars_message
            $this->deposit_bursars_message->setupEditAttributes();
            $this->deposit_bursars_message->EditCustomAttributes = "";
            $this->deposit_bursars_message->EditValue = HtmlEncode($this->deposit_bursars_message->CurrentValue);
            $this->deposit_bursars_message->PlaceHolder = RemoveHtml($this->deposit_bursars_message->caption());

            // deposit_cc
            $this->deposit_cc->EditCustomAttributes = "";
            $this->deposit_cc->EditValue = $this->deposit_cc->options(false);
            $this->deposit_cc->PlaceHolder = RemoveHtml($this->deposit_cc->caption());

            // deposit_cc_message
            $this->deposit_cc_message->setupEditAttributes();
            $this->deposit_cc_message->EditCustomAttributes = "";
            $this->deposit_cc_message->EditValue = HtmlEncode($this->deposit_cc_message->CurrentValue);
            $this->deposit_cc_message->PlaceHolder = RemoveHtml($this->deposit_cc_message->caption());

            // exporter
            $this->exporter->EditCustomAttributes = "";
            $this->exporter->EditValue = $this->exporter->options(false);
            $this->exporter->PlaceHolder = RemoveHtml($this->exporter->caption());

            // signup
            $this->signup->EditCustomAttributes = "";
            $this->signup->EditValue = $this->signup->options(false);
            $this->signup->PlaceHolder = RemoveHtml($this->signup->caption());

            // signup_message
            $this->signup_message->setupEditAttributes();
            $this->signup_message->EditCustomAttributes = "";
            $this->signup_message->EditValue = HtmlEncode($this->signup_message->CurrentValue);
            $this->signup_message->PlaceHolder = RemoveHtml($this->signup_message->caption());

            // Edit refer script

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";

            // online
            $this->online->LinkCustomAttributes = "";
            $this->online->HrefValue = "";

            // online_message
            $this->online_message->LinkCustomAttributes = "";
            $this->online_message->HrefValue = "";

            // signup_bursars
            $this->signup_bursars->LinkCustomAttributes = "";
            $this->signup_bursars->HrefValue = "";

            // signup_bursars_message
            $this->signup_bursars_message->LinkCustomAttributes = "";
            $this->signup_bursars_message->HrefValue = "";

            // signup_cc
            $this->signup_cc->LinkCustomAttributes = "";
            $this->signup_cc->HrefValue = "";

            // signup_cc_message
            $this->signup_cc_message->LinkCustomAttributes = "";
            $this->signup_cc_message->HrefValue = "";

            // deposit_bursars
            $this->deposit_bursars->LinkCustomAttributes = "";
            $this->deposit_bursars->HrefValue = "";

            // deposit_bursars_message
            $this->deposit_bursars_message->LinkCustomAttributes = "";
            $this->deposit_bursars_message->HrefValue = "";

            // deposit_cc
            $this->deposit_cc->LinkCustomAttributes = "";
            $this->deposit_cc->HrefValue = "";

            // deposit_cc_message
            $this->deposit_cc_message->LinkCustomAttributes = "";
            $this->deposit_cc_message->HrefValue = "";

            // exporter
            $this->exporter->LinkCustomAttributes = "";
            $this->exporter->HrefValue = "";

            // signup
            $this->signup->LinkCustomAttributes = "";
            $this->signup->HrefValue = "";

            // signup_message
            $this->signup_message->LinkCustomAttributes = "";
            $this->signup_message->HrefValue = "";
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
        if ($this->ID->Required) {
            if (!$this->ID->IsDetailKey && EmptyValue($this->ID->FormValue)) {
                $this->ID->addErrorMessage(str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
            }
        }
        if ($this->online->Required) {
            if ($this->online->FormValue == "") {
                $this->online->addErrorMessage(str_replace("%s", $this->online->caption(), $this->online->RequiredErrorMessage));
            }
        }
        if ($this->online_message->Required) {
            if (!$this->online_message->IsDetailKey && EmptyValue($this->online_message->FormValue)) {
                $this->online_message->addErrorMessage(str_replace("%s", $this->online_message->caption(), $this->online_message->RequiredErrorMessage));
            }
        }
        if ($this->signup_bursars->Required) {
            if ($this->signup_bursars->FormValue == "") {
                $this->signup_bursars->addErrorMessage(str_replace("%s", $this->signup_bursars->caption(), $this->signup_bursars->RequiredErrorMessage));
            }
        }
        if ($this->signup_bursars_message->Required) {
            if (!$this->signup_bursars_message->IsDetailKey && EmptyValue($this->signup_bursars_message->FormValue)) {
                $this->signup_bursars_message->addErrorMessage(str_replace("%s", $this->signup_bursars_message->caption(), $this->signup_bursars_message->RequiredErrorMessage));
            }
        }
        if ($this->signup_cc->Required) {
            if ($this->signup_cc->FormValue == "") {
                $this->signup_cc->addErrorMessage(str_replace("%s", $this->signup_cc->caption(), $this->signup_cc->RequiredErrorMessage));
            }
        }
        if ($this->signup_cc_message->Required) {
            if (!$this->signup_cc_message->IsDetailKey && EmptyValue($this->signup_cc_message->FormValue)) {
                $this->signup_cc_message->addErrorMessage(str_replace("%s", $this->signup_cc_message->caption(), $this->signup_cc_message->RequiredErrorMessage));
            }
        }
        if ($this->deposit_bursars->Required) {
            if ($this->deposit_bursars->FormValue == "") {
                $this->deposit_bursars->addErrorMessage(str_replace("%s", $this->deposit_bursars->caption(), $this->deposit_bursars->RequiredErrorMessage));
            }
        }
        if ($this->deposit_bursars_message->Required) {
            if (!$this->deposit_bursars_message->IsDetailKey && EmptyValue($this->deposit_bursars_message->FormValue)) {
                $this->deposit_bursars_message->addErrorMessage(str_replace("%s", $this->deposit_bursars_message->caption(), $this->deposit_bursars_message->RequiredErrorMessage));
            }
        }
        if ($this->deposit_cc->Required) {
            if ($this->deposit_cc->FormValue == "") {
                $this->deposit_cc->addErrorMessage(str_replace("%s", $this->deposit_cc->caption(), $this->deposit_cc->RequiredErrorMessage));
            }
        }
        if ($this->deposit_cc_message->Required) {
            if (!$this->deposit_cc_message->IsDetailKey && EmptyValue($this->deposit_cc_message->FormValue)) {
                $this->deposit_cc_message->addErrorMessage(str_replace("%s", $this->deposit_cc_message->caption(), $this->deposit_cc_message->RequiredErrorMessage));
            }
        }
        if ($this->exporter->Required) {
            if ($this->exporter->FormValue == "") {
                $this->exporter->addErrorMessage(str_replace("%s", $this->exporter->caption(), $this->exporter->RequiredErrorMessage));
            }
        }
        if ($this->signup->Required) {
            if ($this->signup->FormValue == "") {
                $this->signup->addErrorMessage(str_replace("%s", $this->signup->caption(), $this->signup->RequiredErrorMessage));
            }
        }
        if ($this->signup_message->Required) {
            if (!$this->signup_message->IsDetailKey && EmptyValue($this->signup_message->FormValue)) {
                $this->signup_message->addErrorMessage(str_replace("%s", $this->signup_message->caption(), $this->signup_message->RequiredErrorMessage));
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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // online
            $tmpBool = $this->online->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->online->setDbValueDef($rsnew, $tmpBool, 0, $this->online->ReadOnly);

            // online_message
            $this->online_message->setDbValueDef($rsnew, $this->online_message->CurrentValue, "", $this->online_message->ReadOnly);

            // signup_bursars
            $tmpBool = $this->signup_bursars->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->signup_bursars->setDbValueDef($rsnew, $tmpBool, 0, $this->signup_bursars->ReadOnly);

            // signup_bursars_message
            $this->signup_bursars_message->setDbValueDef($rsnew, $this->signup_bursars_message->CurrentValue, "", $this->signup_bursars_message->ReadOnly);

            // signup_cc
            $tmpBool = $this->signup_cc->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->signup_cc->setDbValueDef($rsnew, $tmpBool, 0, $this->signup_cc->ReadOnly);

            // signup_cc_message
            $this->signup_cc_message->setDbValueDef($rsnew, $this->signup_cc_message->CurrentValue, "", $this->signup_cc_message->ReadOnly);

            // deposit_bursars
            $tmpBool = $this->deposit_bursars->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->deposit_bursars->setDbValueDef($rsnew, $tmpBool, 0, $this->deposit_bursars->ReadOnly);

            // deposit_bursars_message
            $this->deposit_bursars_message->setDbValueDef($rsnew, $this->deposit_bursars_message->CurrentValue, "", $this->deposit_bursars_message->ReadOnly);

            // deposit_cc
            $tmpBool = $this->deposit_cc->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->deposit_cc->setDbValueDef($rsnew, $tmpBool, 0, $this->deposit_cc->ReadOnly);

            // deposit_cc_message
            $this->deposit_cc_message->setDbValueDef($rsnew, $this->deposit_cc_message->CurrentValue, "", $this->deposit_cc_message->ReadOnly);

            // exporter
            $tmpBool = $this->exporter->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->exporter->setDbValueDef($rsnew, $tmpBool, 0, $this->exporter->ReadOnly);

            // signup
            $tmpBool = $this->signup->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->signup->setDbValueDef($rsnew, $tmpBool, 0, $this->signup->ReadOnly);

            // signup_message
            $this->signup_message->setDbValueDef($rsnew, $this->signup_message->CurrentValue, null, $this->signup_message->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ControlList"), "", $this->TableVar, true);
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
                case "x_online":
                    break;
                case "x_signup_bursars":
                    break;
                case "x_signup_cc":
                    break;
                case "x_deposit_bursars":
                    break;
                case "x_deposit_cc":
                    break;
                case "x_exporter":
                    break;
                case "x_signup":
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
                $pageNo = ParseInteger($pageNo);
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
        // Return error message in $customError
        return true;
    }
}
