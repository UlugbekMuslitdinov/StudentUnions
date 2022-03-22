<?php

namespace PHPMaker2022\project3;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MenuSpecialsEdit extends MenuSpecials
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'menu_specials';

    // Page object name
    public $PageObjName = "MenuSpecialsEdit";

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

        // Table object (menu_specials)
        if (!isset($GLOBALS["menu_specials"]) || get_class($GLOBALS["menu_specials"]) == PROJECT_NAMESPACE . "menu_specials") {
            $GLOBALS["menu_specials"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'menu_specials');
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
                $tbl = Container("menu_specials");
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
                    if ($pageName == "MenuSpecialsView") {
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
        $this->id->setVisibility();
        $this->menu_special->setVisibility();
        $this->menu_special_price->setVisibility();
        $this->menu_restaurant->setVisibility();
        $this->menu_category->setVisibility();
        $this->menu_special_comments->setVisibility();
        $this->menu_special_startdate->setVisibility();
        $this->menu_special_enddate->setVisibility();
        $this->menu_special_replace_item->setVisibility();
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
        $this->FormClassName = "ew-form ew-edit-form";
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
                $this->setKey(Post($this->OldKeyName), $this->isShow());
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
                    $this->terminate("MenuSpecialsList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "MenuSpecialsList") {
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
            // Setup login status
            SetupLoginStatus();

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

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'menu_special' first before field var 'x_menu_special'
        $val = $CurrentForm->hasValue("menu_special") ? $CurrentForm->getValue("menu_special") : $CurrentForm->getValue("x_menu_special");
        if (!$this->menu_special->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_special->Visible = false; // Disable update for API request
            } else {
                $this->menu_special->setFormValue($val);
            }
        }

        // Check field name 'menu_special_price' first before field var 'x_menu_special_price'
        $val = $CurrentForm->hasValue("menu_special_price") ? $CurrentForm->getValue("menu_special_price") : $CurrentForm->getValue("x_menu_special_price");
        if (!$this->menu_special_price->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_special_price->Visible = false; // Disable update for API request
            } else {
                $this->menu_special_price->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'menu_restaurant' first before field var 'x_menu_restaurant'
        $val = $CurrentForm->hasValue("menu_restaurant") ? $CurrentForm->getValue("menu_restaurant") : $CurrentForm->getValue("x_menu_restaurant");
        if (!$this->menu_restaurant->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_restaurant->Visible = false; // Disable update for API request
            } else {
                $this->menu_restaurant->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'menu_category' first before field var 'x_menu_category'
        $val = $CurrentForm->hasValue("menu_category") ? $CurrentForm->getValue("menu_category") : $CurrentForm->getValue("x_menu_category");
        if (!$this->menu_category->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_category->Visible = false; // Disable update for API request
            } else {
                $this->menu_category->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'menu_special_comments' first before field var 'x_menu_special_comments'
        $val = $CurrentForm->hasValue("menu_special_comments") ? $CurrentForm->getValue("menu_special_comments") : $CurrentForm->getValue("x_menu_special_comments");
        if (!$this->menu_special_comments->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_special_comments->Visible = false; // Disable update for API request
            } else {
                $this->menu_special_comments->setFormValue($val);
            }
        }

        // Check field name 'menu_special_startdate' first before field var 'x_menu_special_startdate'
        $val = $CurrentForm->hasValue("menu_special_startdate") ? $CurrentForm->getValue("menu_special_startdate") : $CurrentForm->getValue("x_menu_special_startdate");
        if (!$this->menu_special_startdate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_special_startdate->Visible = false; // Disable update for API request
            } else {
                $this->menu_special_startdate->setFormValue($val, true, $validate);
            }
            $this->menu_special_startdate->CurrentValue = UnFormatDateTime($this->menu_special_startdate->CurrentValue, $this->menu_special_startdate->formatPattern());
        }

        // Check field name 'menu_special_enddate' first before field var 'x_menu_special_enddate'
        $val = $CurrentForm->hasValue("menu_special_enddate") ? $CurrentForm->getValue("menu_special_enddate") : $CurrentForm->getValue("x_menu_special_enddate");
        if (!$this->menu_special_enddate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_special_enddate->Visible = false; // Disable update for API request
            } else {
                $this->menu_special_enddate->setFormValue($val, true, $validate);
            }
            $this->menu_special_enddate->CurrentValue = UnFormatDateTime($this->menu_special_enddate->CurrentValue, $this->menu_special_enddate->formatPattern());
        }

        // Check field name 'menu_special_replace_item' first before field var 'x_menu_special_replace_item'
        $val = $CurrentForm->hasValue("menu_special_replace_item") ? $CurrentForm->getValue("menu_special_replace_item") : $CurrentForm->getValue("x_menu_special_replace_item");
        if (!$this->menu_special_replace_item->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menu_special_replace_item->Visible = false; // Disable update for API request
            } else {
                $this->menu_special_replace_item->setFormValue($val, true, $validate);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->menu_special->CurrentValue = $this->menu_special->FormValue;
        $this->menu_special_price->CurrentValue = $this->menu_special_price->FormValue;
        $this->menu_restaurant->CurrentValue = $this->menu_restaurant->FormValue;
        $this->menu_category->CurrentValue = $this->menu_category->FormValue;
        $this->menu_special_comments->CurrentValue = $this->menu_special_comments->FormValue;
        $this->menu_special_startdate->CurrentValue = $this->menu_special_startdate->FormValue;
        $this->menu_special_startdate->CurrentValue = UnFormatDateTime($this->menu_special_startdate->CurrentValue, $this->menu_special_startdate->formatPattern());
        $this->menu_special_enddate->CurrentValue = $this->menu_special_enddate->FormValue;
        $this->menu_special_enddate->CurrentValue = UnFormatDateTime($this->menu_special_enddate->CurrentValue, $this->menu_special_enddate->formatPattern());
        $this->menu_special_replace_item->CurrentValue = $this->menu_special_replace_item->FormValue;
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
        $this->menu_special->setDbValue($row['menu_special']);
        $this->menu_special_price->setDbValue($row['menu_special_price']);
        $this->menu_restaurant->setDbValue($row['menu_restaurant']);
        $this->menu_category->setDbValue($row['menu_category']);
        $this->menu_special_comments->setDbValue($row['menu_special_comments']);
        $this->menu_special_startdate->setDbValue($row['menu_special_startdate']);
        $this->menu_special_enddate->setDbValue($row['menu_special_enddate']);
        $this->menu_special_replace_item->setDbValue($row['menu_special_replace_item']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['menu_special'] = null;
        $row['menu_special_price'] = null;
        $row['menu_restaurant'] = null;
        $row['menu_category'] = null;
        $row['menu_special_comments'] = null;
        $row['menu_special_startdate'] = null;
        $row['menu_special_enddate'] = null;
        $row['menu_special_replace_item'] = null;
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

        // menu_special
        $this->menu_special->RowCssClass = "row";

        // menu_special_price
        $this->menu_special_price->RowCssClass = "row";

        // menu_restaurant
        $this->menu_restaurant->RowCssClass = "row";

        // menu_category
        $this->menu_category->RowCssClass = "row";

        // menu_special_comments
        $this->menu_special_comments->RowCssClass = "row";

        // menu_special_startdate
        $this->menu_special_startdate->RowCssClass = "row";

        // menu_special_enddate
        $this->menu_special_enddate->RowCssClass = "row";

        // menu_special_replace_item
        $this->menu_special_replace_item->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // menu_special
            $this->menu_special->ViewValue = $this->menu_special->CurrentValue;
            $this->menu_special->ViewCustomAttributes = "";

            // menu_special_price
            $this->menu_special_price->ViewValue = $this->menu_special_price->CurrentValue;
            $this->menu_special_price->ViewValue = FormatNumber($this->menu_special_price->ViewValue, "");
            $this->menu_special_price->ViewCustomAttributes = "";

            // menu_restaurant
            $this->menu_restaurant->ViewValue = $this->menu_restaurant->CurrentValue;
            $this->menu_restaurant->ViewValue = FormatNumber($this->menu_restaurant->ViewValue, "");
            $this->menu_restaurant->ViewCustomAttributes = "";

            // menu_category
            $this->menu_category->ViewValue = $this->menu_category->CurrentValue;
            $this->menu_category->ViewValue = FormatNumber($this->menu_category->ViewValue, "");
            $this->menu_category->ViewCustomAttributes = "";

            // menu_special_comments
            $this->menu_special_comments->ViewValue = $this->menu_special_comments->CurrentValue;
            $this->menu_special_comments->ViewCustomAttributes = "";

            // menu_special_startdate
            $this->menu_special_startdate->ViewValue = $this->menu_special_startdate->CurrentValue;
            $this->menu_special_startdate->ViewValue = FormatDateTime($this->menu_special_startdate->ViewValue, 0);
            $this->menu_special_startdate->ViewCustomAttributes = "";

            // menu_special_enddate
            $this->menu_special_enddate->ViewValue = $this->menu_special_enddate->CurrentValue;
            $this->menu_special_enddate->ViewValue = FormatDateTime($this->menu_special_enddate->ViewValue, 0);
            $this->menu_special_enddate->ViewCustomAttributes = "";

            // menu_special_replace_item
            $this->menu_special_replace_item->ViewValue = $this->menu_special_replace_item->CurrentValue;
            $this->menu_special_replace_item->ViewValue = FormatNumber($this->menu_special_replace_item->ViewValue, "");
            $this->menu_special_replace_item->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // menu_special
            $this->menu_special->LinkCustomAttributes = "";
            $this->menu_special->HrefValue = "";

            // menu_special_price
            $this->menu_special_price->LinkCustomAttributes = "";
            $this->menu_special_price->HrefValue = "";

            // menu_restaurant
            $this->menu_restaurant->LinkCustomAttributes = "";
            $this->menu_restaurant->HrefValue = "";

            // menu_category
            $this->menu_category->LinkCustomAttributes = "";
            $this->menu_category->HrefValue = "";

            // menu_special_comments
            $this->menu_special_comments->LinkCustomAttributes = "";
            $this->menu_special_comments->HrefValue = "";

            // menu_special_startdate
            $this->menu_special_startdate->LinkCustomAttributes = "";
            $this->menu_special_startdate->HrefValue = "";

            // menu_special_enddate
            $this->menu_special_enddate->LinkCustomAttributes = "";
            $this->menu_special_enddate->HrefValue = "";

            // menu_special_replace_item
            $this->menu_special_replace_item->LinkCustomAttributes = "";
            $this->menu_special_replace_item->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // menu_special
            $this->menu_special->setupEditAttributes();
            $this->menu_special->EditCustomAttributes = "";
            $this->menu_special->EditValue = HtmlEncode($this->menu_special->CurrentValue);
            $this->menu_special->PlaceHolder = RemoveHtml($this->menu_special->caption());

            // menu_special_price
            $this->menu_special_price->setupEditAttributes();
            $this->menu_special_price->EditCustomAttributes = "";
            $this->menu_special_price->EditValue = HtmlEncode($this->menu_special_price->CurrentValue);
            $this->menu_special_price->PlaceHolder = RemoveHtml($this->menu_special_price->caption());
            if (strval($this->menu_special_price->EditValue) != "" && is_numeric($this->menu_special_price->EditValue)) {
                $this->menu_special_price->EditValue = FormatNumber($this->menu_special_price->EditValue, null);
            }

            // menu_restaurant
            $this->menu_restaurant->setupEditAttributes();
            $this->menu_restaurant->EditCustomAttributes = "";
            $this->menu_restaurant->EditValue = HtmlEncode($this->menu_restaurant->CurrentValue);
            $this->menu_restaurant->PlaceHolder = RemoveHtml($this->menu_restaurant->caption());
            if (strval($this->menu_restaurant->EditValue) != "" && is_numeric($this->menu_restaurant->EditValue)) {
                $this->menu_restaurant->EditValue = FormatNumber($this->menu_restaurant->EditValue, null);
            }

            // menu_category
            $this->menu_category->setupEditAttributes();
            $this->menu_category->EditCustomAttributes = "";
            $this->menu_category->EditValue = HtmlEncode($this->menu_category->CurrentValue);
            $this->menu_category->PlaceHolder = RemoveHtml($this->menu_category->caption());
            if (strval($this->menu_category->EditValue) != "" && is_numeric($this->menu_category->EditValue)) {
                $this->menu_category->EditValue = FormatNumber($this->menu_category->EditValue, null);
            }

            // menu_special_comments
            $this->menu_special_comments->setupEditAttributes();
            $this->menu_special_comments->EditCustomAttributes = "";
            $this->menu_special_comments->EditValue = HtmlEncode($this->menu_special_comments->CurrentValue);
            $this->menu_special_comments->PlaceHolder = RemoveHtml($this->menu_special_comments->caption());

            // menu_special_startdate
            $this->menu_special_startdate->setupEditAttributes();
            $this->menu_special_startdate->EditCustomAttributes = "";
            $this->menu_special_startdate->EditValue = HtmlEncode(FormatDateTime($this->menu_special_startdate->CurrentValue, 8));
            $this->menu_special_startdate->PlaceHolder = RemoveHtml($this->menu_special_startdate->caption());

            // menu_special_enddate
            $this->menu_special_enddate->setupEditAttributes();
            $this->menu_special_enddate->EditCustomAttributes = "";
            $this->menu_special_enddate->EditValue = HtmlEncode(FormatDateTime($this->menu_special_enddate->CurrentValue, 8));
            $this->menu_special_enddate->PlaceHolder = RemoveHtml($this->menu_special_enddate->caption());

            // menu_special_replace_item
            $this->menu_special_replace_item->setupEditAttributes();
            $this->menu_special_replace_item->EditCustomAttributes = "";
            $this->menu_special_replace_item->EditValue = HtmlEncode($this->menu_special_replace_item->CurrentValue);
            $this->menu_special_replace_item->PlaceHolder = RemoveHtml($this->menu_special_replace_item->caption());
            if (strval($this->menu_special_replace_item->EditValue) != "" && is_numeric($this->menu_special_replace_item->EditValue)) {
                $this->menu_special_replace_item->EditValue = FormatNumber($this->menu_special_replace_item->EditValue, null);
            }

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // menu_special
            $this->menu_special->LinkCustomAttributes = "";
            $this->menu_special->HrefValue = "";

            // menu_special_price
            $this->menu_special_price->LinkCustomAttributes = "";
            $this->menu_special_price->HrefValue = "";

            // menu_restaurant
            $this->menu_restaurant->LinkCustomAttributes = "";
            $this->menu_restaurant->HrefValue = "";

            // menu_category
            $this->menu_category->LinkCustomAttributes = "";
            $this->menu_category->HrefValue = "";

            // menu_special_comments
            $this->menu_special_comments->LinkCustomAttributes = "";
            $this->menu_special_comments->HrefValue = "";

            // menu_special_startdate
            $this->menu_special_startdate->LinkCustomAttributes = "";
            $this->menu_special_startdate->HrefValue = "";

            // menu_special_enddate
            $this->menu_special_enddate->LinkCustomAttributes = "";
            $this->menu_special_enddate->HrefValue = "";

            // menu_special_replace_item
            $this->menu_special_replace_item->LinkCustomAttributes = "";
            $this->menu_special_replace_item->HrefValue = "";
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
        if ($this->menu_special->Required) {
            if (!$this->menu_special->IsDetailKey && EmptyValue($this->menu_special->FormValue)) {
                $this->menu_special->addErrorMessage(str_replace("%s", $this->menu_special->caption(), $this->menu_special->RequiredErrorMessage));
            }
        }
        if ($this->menu_special_price->Required) {
            if (!$this->menu_special_price->IsDetailKey && EmptyValue($this->menu_special_price->FormValue)) {
                $this->menu_special_price->addErrorMessage(str_replace("%s", $this->menu_special_price->caption(), $this->menu_special_price->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->menu_special_price->FormValue)) {
            $this->menu_special_price->addErrorMessage($this->menu_special_price->getErrorMessage(false));
        }
        if ($this->menu_restaurant->Required) {
            if (!$this->menu_restaurant->IsDetailKey && EmptyValue($this->menu_restaurant->FormValue)) {
                $this->menu_restaurant->addErrorMessage(str_replace("%s", $this->menu_restaurant->caption(), $this->menu_restaurant->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->menu_restaurant->FormValue)) {
            $this->menu_restaurant->addErrorMessage($this->menu_restaurant->getErrorMessage(false));
        }
        if ($this->menu_category->Required) {
            if (!$this->menu_category->IsDetailKey && EmptyValue($this->menu_category->FormValue)) {
                $this->menu_category->addErrorMessage(str_replace("%s", $this->menu_category->caption(), $this->menu_category->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->menu_category->FormValue)) {
            $this->menu_category->addErrorMessage($this->menu_category->getErrorMessage(false));
        }
        if ($this->menu_special_comments->Required) {
            if (!$this->menu_special_comments->IsDetailKey && EmptyValue($this->menu_special_comments->FormValue)) {
                $this->menu_special_comments->addErrorMessage(str_replace("%s", $this->menu_special_comments->caption(), $this->menu_special_comments->RequiredErrorMessage));
            }
        }
        if ($this->menu_special_startdate->Required) {
            if (!$this->menu_special_startdate->IsDetailKey && EmptyValue($this->menu_special_startdate->FormValue)) {
                $this->menu_special_startdate->addErrorMessage(str_replace("%s", $this->menu_special_startdate->caption(), $this->menu_special_startdate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->menu_special_startdate->FormValue, $this->menu_special_startdate->formatPattern())) {
            $this->menu_special_startdate->addErrorMessage($this->menu_special_startdate->getErrorMessage(false));
        }
        if ($this->menu_special_enddate->Required) {
            if (!$this->menu_special_enddate->IsDetailKey && EmptyValue($this->menu_special_enddate->FormValue)) {
                $this->menu_special_enddate->addErrorMessage(str_replace("%s", $this->menu_special_enddate->caption(), $this->menu_special_enddate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->menu_special_enddate->FormValue, $this->menu_special_enddate->formatPattern())) {
            $this->menu_special_enddate->addErrorMessage($this->menu_special_enddate->getErrorMessage(false));
        }
        if ($this->menu_special_replace_item->Required) {
            if (!$this->menu_special_replace_item->IsDetailKey && EmptyValue($this->menu_special_replace_item->FormValue)) {
                $this->menu_special_replace_item->addErrorMessage(str_replace("%s", $this->menu_special_replace_item->caption(), $this->menu_special_replace_item->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->menu_special_replace_item->FormValue)) {
            $this->menu_special_replace_item->addErrorMessage($this->menu_special_replace_item->getErrorMessage(false));
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

            // menu_special
            $this->menu_special->setDbValueDef($rsnew, $this->menu_special->CurrentValue, null, $this->menu_special->ReadOnly);

            // menu_special_price
            $this->menu_special_price->setDbValueDef($rsnew, $this->menu_special_price->CurrentValue, null, $this->menu_special_price->ReadOnly);

            // menu_restaurant
            $this->menu_restaurant->setDbValueDef($rsnew, $this->menu_restaurant->CurrentValue, null, $this->menu_restaurant->ReadOnly);

            // menu_category
            $this->menu_category->setDbValueDef($rsnew, $this->menu_category->CurrentValue, null, $this->menu_category->ReadOnly);

            // menu_special_comments
            $this->menu_special_comments->setDbValueDef($rsnew, $this->menu_special_comments->CurrentValue, null, $this->menu_special_comments->ReadOnly);

            // menu_special_startdate
            $this->menu_special_startdate->setDbValueDef($rsnew, UnFormatDateTime($this->menu_special_startdate->CurrentValue, $this->menu_special_startdate->formatPattern()), null, $this->menu_special_startdate->ReadOnly);

            // menu_special_enddate
            $this->menu_special_enddate->setDbValueDef($rsnew, UnFormatDateTime($this->menu_special_enddate->CurrentValue, $this->menu_special_enddate->formatPattern()), null, $this->menu_special_enddate->ReadOnly);

            // menu_special_replace_item
            $this->menu_special_replace_item->setDbValueDef($rsnew, $this->menu_special_replace_item->CurrentValue, null, $this->menu_special_replace_item->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MenuSpecialsList"), "", $this->TableVar, true);
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
