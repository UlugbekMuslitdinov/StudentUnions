<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class HoursExceptionList extends HoursException
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'hours_exception';

    // Page object name
    public $PageObjName = "HoursExceptionList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fhours_exceptionlist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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

        // Table object (hours_exception)
        if (!isset($GLOBALS["hours_exception"]) || get_class($GLOBALS["hours_exception"]) == PROJECT_NAMESPACE . "hours_exception") {
            $GLOBALS["hours_exception"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "HoursExceptionAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "HoursExceptionDelete";
        $this->MultiUpdateUrl = "HoursExceptionUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'hours_exception');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Import options
        $this->ImportOptions = new ListOptions(["TagClassName" => "ew-import-option"]);

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions([
            "TagClassName" => "ew-add-edit-option",
            "UseDropDownButton" => false,
            "DropDownButtonPhrase" => $Language->phrase("ButtonAddEdit"),
            "UseButtonGroup" => true
        ]);

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(["TagClassName" => "ew-detail-option"]);
        // Actions
        $this->OtherOptions["action"] = new ListOptions(["TagClassName" => "ew-action-option"]);

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions([
            "TableVar" => $this->TableVar,
            "TagClassName" => "ew-column-option",
            "ButtonGroupClass" => "ew-column-dropdown",
            "UseDropDownButton" => true,
            "DropDownButtonPhrase" => $Language->phrase("Columns"),
            "DropDownAutoClose" => "outside",
            "UseButtonGroup" => false
        ]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);

        // List actions
        $this->ListActions = new ListActions();
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
                $tbl = Container("hours_exception");
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
            SaveDebugMessage();
            Redirect(GetUrl($url));
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->location_id->setVisibility();
        $this->start->setVisibility();
        $this->end->setVisibility();
        $this->mon_openx->setVisibility();
        $this->mon_closex->setVisibility();
        $this->tue_openx->setVisibility();
        $this->tue_closex->setVisibility();
        $this->wed_openx->setVisibility();
        $this->wed_closex->setVisibility();
        $this->thu_openx->setVisibility();
        $this->thu_closex->setVisibility();
        $this->fri_openx->setVisibility();
        $this->fri_closex->setVisibility();
        $this->sat_openx->setVisibility();
        $this->sat_closex->setVisibility();
        $this->sun_openx->setVisibility();
        $this->sun_closex->setVisibility();
        $this->closex->setVisibility();
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Set up list action columns
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Allow) {
                if ($listaction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action 
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listaction->Select == ACTION_SINGLE) { // Show list action column
                        $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->TableVar, $this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->location_id->AdvancedSearch->toJson(), ","); // Field location_id
        $filterList = Concat($filterList, $this->start->AdvancedSearch->toJson(), ","); // Field start
        $filterList = Concat($filterList, $this->end->AdvancedSearch->toJson(), ","); // Field end
        $filterList = Concat($filterList, $this->mon_openx->AdvancedSearch->toJson(), ","); // Field mon_openx
        $filterList = Concat($filterList, $this->mon_closex->AdvancedSearch->toJson(), ","); // Field mon_closex
        $filterList = Concat($filterList, $this->tue_openx->AdvancedSearch->toJson(), ","); // Field tue_openx
        $filterList = Concat($filterList, $this->tue_closex->AdvancedSearch->toJson(), ","); // Field tue_closex
        $filterList = Concat($filterList, $this->wed_openx->AdvancedSearch->toJson(), ","); // Field wed_openx
        $filterList = Concat($filterList, $this->wed_closex->AdvancedSearch->toJson(), ","); // Field wed_closex
        $filterList = Concat($filterList, $this->thu_openx->AdvancedSearch->toJson(), ","); // Field thu_openx
        $filterList = Concat($filterList, $this->thu_closex->AdvancedSearch->toJson(), ","); // Field thu_closex
        $filterList = Concat($filterList, $this->fri_openx->AdvancedSearch->toJson(), ","); // Field fri_openx
        $filterList = Concat($filterList, $this->fri_closex->AdvancedSearch->toJson(), ","); // Field fri_closex
        $filterList = Concat($filterList, $this->sat_openx->AdvancedSearch->toJson(), ","); // Field sat_openx
        $filterList = Concat($filterList, $this->sat_closex->AdvancedSearch->toJson(), ","); // Field sat_closex
        $filterList = Concat($filterList, $this->sun_openx->AdvancedSearch->toJson(), ","); // Field sun_openx
        $filterList = Concat($filterList, $this->sun_closex->AdvancedSearch->toJson(), ","); // Field sun_closex
        $filterList = Concat($filterList, $this->closex->AdvancedSearch->toJson(), ","); // Field closex
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fhours_exceptionsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field location_id
        $this->location_id->AdvancedSearch->SearchValue = @$filter["x_location_id"];
        $this->location_id->AdvancedSearch->SearchOperator = @$filter["z_location_id"];
        $this->location_id->AdvancedSearch->SearchCondition = @$filter["v_location_id"];
        $this->location_id->AdvancedSearch->SearchValue2 = @$filter["y_location_id"];
        $this->location_id->AdvancedSearch->SearchOperator2 = @$filter["w_location_id"];
        $this->location_id->AdvancedSearch->save();

        // Field start
        $this->start->AdvancedSearch->SearchValue = @$filter["x_start"];
        $this->start->AdvancedSearch->SearchOperator = @$filter["z_start"];
        $this->start->AdvancedSearch->SearchCondition = @$filter["v_start"];
        $this->start->AdvancedSearch->SearchValue2 = @$filter["y_start"];
        $this->start->AdvancedSearch->SearchOperator2 = @$filter["w_start"];
        $this->start->AdvancedSearch->save();

        // Field end
        $this->end->AdvancedSearch->SearchValue = @$filter["x_end"];
        $this->end->AdvancedSearch->SearchOperator = @$filter["z_end"];
        $this->end->AdvancedSearch->SearchCondition = @$filter["v_end"];
        $this->end->AdvancedSearch->SearchValue2 = @$filter["y_end"];
        $this->end->AdvancedSearch->SearchOperator2 = @$filter["w_end"];
        $this->end->AdvancedSearch->save();

        // Field mon_openx
        $this->mon_openx->AdvancedSearch->SearchValue = @$filter["x_mon_openx"];
        $this->mon_openx->AdvancedSearch->SearchOperator = @$filter["z_mon_openx"];
        $this->mon_openx->AdvancedSearch->SearchCondition = @$filter["v_mon_openx"];
        $this->mon_openx->AdvancedSearch->SearchValue2 = @$filter["y_mon_openx"];
        $this->mon_openx->AdvancedSearch->SearchOperator2 = @$filter["w_mon_openx"];
        $this->mon_openx->AdvancedSearch->save();

        // Field mon_closex
        $this->mon_closex->AdvancedSearch->SearchValue = @$filter["x_mon_closex"];
        $this->mon_closex->AdvancedSearch->SearchOperator = @$filter["z_mon_closex"];
        $this->mon_closex->AdvancedSearch->SearchCondition = @$filter["v_mon_closex"];
        $this->mon_closex->AdvancedSearch->SearchValue2 = @$filter["y_mon_closex"];
        $this->mon_closex->AdvancedSearch->SearchOperator2 = @$filter["w_mon_closex"];
        $this->mon_closex->AdvancedSearch->save();

        // Field tue_openx
        $this->tue_openx->AdvancedSearch->SearchValue = @$filter["x_tue_openx"];
        $this->tue_openx->AdvancedSearch->SearchOperator = @$filter["z_tue_openx"];
        $this->tue_openx->AdvancedSearch->SearchCondition = @$filter["v_tue_openx"];
        $this->tue_openx->AdvancedSearch->SearchValue2 = @$filter["y_tue_openx"];
        $this->tue_openx->AdvancedSearch->SearchOperator2 = @$filter["w_tue_openx"];
        $this->tue_openx->AdvancedSearch->save();

        // Field tue_closex
        $this->tue_closex->AdvancedSearch->SearchValue = @$filter["x_tue_closex"];
        $this->tue_closex->AdvancedSearch->SearchOperator = @$filter["z_tue_closex"];
        $this->tue_closex->AdvancedSearch->SearchCondition = @$filter["v_tue_closex"];
        $this->tue_closex->AdvancedSearch->SearchValue2 = @$filter["y_tue_closex"];
        $this->tue_closex->AdvancedSearch->SearchOperator2 = @$filter["w_tue_closex"];
        $this->tue_closex->AdvancedSearch->save();

        // Field wed_openx
        $this->wed_openx->AdvancedSearch->SearchValue = @$filter["x_wed_openx"];
        $this->wed_openx->AdvancedSearch->SearchOperator = @$filter["z_wed_openx"];
        $this->wed_openx->AdvancedSearch->SearchCondition = @$filter["v_wed_openx"];
        $this->wed_openx->AdvancedSearch->SearchValue2 = @$filter["y_wed_openx"];
        $this->wed_openx->AdvancedSearch->SearchOperator2 = @$filter["w_wed_openx"];
        $this->wed_openx->AdvancedSearch->save();

        // Field wed_closex
        $this->wed_closex->AdvancedSearch->SearchValue = @$filter["x_wed_closex"];
        $this->wed_closex->AdvancedSearch->SearchOperator = @$filter["z_wed_closex"];
        $this->wed_closex->AdvancedSearch->SearchCondition = @$filter["v_wed_closex"];
        $this->wed_closex->AdvancedSearch->SearchValue2 = @$filter["y_wed_closex"];
        $this->wed_closex->AdvancedSearch->SearchOperator2 = @$filter["w_wed_closex"];
        $this->wed_closex->AdvancedSearch->save();

        // Field thu_openx
        $this->thu_openx->AdvancedSearch->SearchValue = @$filter["x_thu_openx"];
        $this->thu_openx->AdvancedSearch->SearchOperator = @$filter["z_thu_openx"];
        $this->thu_openx->AdvancedSearch->SearchCondition = @$filter["v_thu_openx"];
        $this->thu_openx->AdvancedSearch->SearchValue2 = @$filter["y_thu_openx"];
        $this->thu_openx->AdvancedSearch->SearchOperator2 = @$filter["w_thu_openx"];
        $this->thu_openx->AdvancedSearch->save();

        // Field thu_closex
        $this->thu_closex->AdvancedSearch->SearchValue = @$filter["x_thu_closex"];
        $this->thu_closex->AdvancedSearch->SearchOperator = @$filter["z_thu_closex"];
        $this->thu_closex->AdvancedSearch->SearchCondition = @$filter["v_thu_closex"];
        $this->thu_closex->AdvancedSearch->SearchValue2 = @$filter["y_thu_closex"];
        $this->thu_closex->AdvancedSearch->SearchOperator2 = @$filter["w_thu_closex"];
        $this->thu_closex->AdvancedSearch->save();

        // Field fri_openx
        $this->fri_openx->AdvancedSearch->SearchValue = @$filter["x_fri_openx"];
        $this->fri_openx->AdvancedSearch->SearchOperator = @$filter["z_fri_openx"];
        $this->fri_openx->AdvancedSearch->SearchCondition = @$filter["v_fri_openx"];
        $this->fri_openx->AdvancedSearch->SearchValue2 = @$filter["y_fri_openx"];
        $this->fri_openx->AdvancedSearch->SearchOperator2 = @$filter["w_fri_openx"];
        $this->fri_openx->AdvancedSearch->save();

        // Field fri_closex
        $this->fri_closex->AdvancedSearch->SearchValue = @$filter["x_fri_closex"];
        $this->fri_closex->AdvancedSearch->SearchOperator = @$filter["z_fri_closex"];
        $this->fri_closex->AdvancedSearch->SearchCondition = @$filter["v_fri_closex"];
        $this->fri_closex->AdvancedSearch->SearchValue2 = @$filter["y_fri_closex"];
        $this->fri_closex->AdvancedSearch->SearchOperator2 = @$filter["w_fri_closex"];
        $this->fri_closex->AdvancedSearch->save();

        // Field sat_openx
        $this->sat_openx->AdvancedSearch->SearchValue = @$filter["x_sat_openx"];
        $this->sat_openx->AdvancedSearch->SearchOperator = @$filter["z_sat_openx"];
        $this->sat_openx->AdvancedSearch->SearchCondition = @$filter["v_sat_openx"];
        $this->sat_openx->AdvancedSearch->SearchValue2 = @$filter["y_sat_openx"];
        $this->sat_openx->AdvancedSearch->SearchOperator2 = @$filter["w_sat_openx"];
        $this->sat_openx->AdvancedSearch->save();

        // Field sat_closex
        $this->sat_closex->AdvancedSearch->SearchValue = @$filter["x_sat_closex"];
        $this->sat_closex->AdvancedSearch->SearchOperator = @$filter["z_sat_closex"];
        $this->sat_closex->AdvancedSearch->SearchCondition = @$filter["v_sat_closex"];
        $this->sat_closex->AdvancedSearch->SearchValue2 = @$filter["y_sat_closex"];
        $this->sat_closex->AdvancedSearch->SearchOperator2 = @$filter["w_sat_closex"];
        $this->sat_closex->AdvancedSearch->save();

        // Field sun_openx
        $this->sun_openx->AdvancedSearch->SearchValue = @$filter["x_sun_openx"];
        $this->sun_openx->AdvancedSearch->SearchOperator = @$filter["z_sun_openx"];
        $this->sun_openx->AdvancedSearch->SearchCondition = @$filter["v_sun_openx"];
        $this->sun_openx->AdvancedSearch->SearchValue2 = @$filter["y_sun_openx"];
        $this->sun_openx->AdvancedSearch->SearchOperator2 = @$filter["w_sun_openx"];
        $this->sun_openx->AdvancedSearch->save();

        // Field sun_closex
        $this->sun_closex->AdvancedSearch->SearchValue = @$filter["x_sun_closex"];
        $this->sun_closex->AdvancedSearch->SearchOperator = @$filter["z_sun_closex"];
        $this->sun_closex->AdvancedSearch->SearchCondition = @$filter["v_sun_closex"];
        $this->sun_closex->AdvancedSearch->SearchValue2 = @$filter["y_sun_closex"];
        $this->sun_closex->AdvancedSearch->SearchOperator2 = @$filter["w_sun_closex"];
        $this->sun_closex->AdvancedSearch->save();

        // Field closex
        $this->closex->AdvancedSearch->SearchValue = @$filter["x_closex"];
        $this->closex->AdvancedSearch->SearchOperator = @$filter["z_closex"];
        $this->closex->AdvancedSearch->SearchCondition = @$filter["v_closex"];
        $this->closex->AdvancedSearch->SearchValue2 = @$filter["y_closex"];
        $this->closex->AdvancedSearch->SearchOperator2 = @$filter["w_closex"];
        $this->closex->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->closex;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->location_id); // location_id
            $this->updateSort($this->start); // start
            $this->updateSort($this->end); // end
            $this->updateSort($this->mon_openx); // mon_openx
            $this->updateSort($this->mon_closex); // mon_closex
            $this->updateSort($this->tue_openx); // tue_openx
            $this->updateSort($this->tue_closex); // tue_closex
            $this->updateSort($this->wed_openx); // wed_openx
            $this->updateSort($this->wed_closex); // wed_closex
            $this->updateSort($this->thu_openx); // thu_openx
            $this->updateSort($this->thu_closex); // thu_closex
            $this->updateSort($this->fri_openx); // fri_openx
            $this->updateSort($this->fri_closex); // fri_closex
            $this->updateSort($this->sat_openx); // sat_openx
            $this->updateSort($this->sat_closex); // sat_closex
            $this->updateSort($this->sun_openx); // sun_openx
            $this->updateSort($this->sun_closex); // sun_closex
            $this->updateSort($this->closex); // closex
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
            }
        }
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->location_id->setSort("");
                $this->start->setSort("");
                $this->end->setSort("");
                $this->mon_openx->setSort("");
                $this->mon_closex->setSort("");
                $this->tue_openx->setSort("");
                $this->tue_closex->setSort("");
                $this->wed_openx->setSort("");
                $this->wed_closex->setSort("");
                $this->thu_openx->setSort("");
                $this->thu_closex->setSort("");
                $this->fri_openx->setSort("");
                $this->fri_closex->setSort("");
                $this->sat_openx->setSort("");
                $this->sat_closex->setSort("");
                $this->sun_openx->setSort("");
                $this->sun_closex->setSort("");
                $this->closex->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = false;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = false;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
            // Set up list options (to be implemented by extensions)
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm, $UserProfile;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl(false);
        if ($this->CurrentMode == "view") { // Check view mode
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                $action = $listaction->Action;
                $allowed = $listaction->Allow;
                if ($listaction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fhours_exceptionlist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fhours_exceptionlist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("location_id", $this->createColumnOption("location_id"));
            $option->add("start", $this->createColumnOption("start"));
            $option->add("end", $this->createColumnOption("end"));
            $option->add("mon_openx", $this->createColumnOption("mon_openx"));
            $option->add("mon_closex", $this->createColumnOption("mon_closex"));
            $option->add("tue_openx", $this->createColumnOption("tue_openx"));
            $option->add("tue_closex", $this->createColumnOption("tue_closex"));
            $option->add("wed_openx", $this->createColumnOption("wed_openx"));
            $option->add("wed_closex", $this->createColumnOption("wed_closex"));
            $option->add("thu_openx", $this->createColumnOption("thu_openx"));
            $option->add("thu_closex", $this->createColumnOption("thu_closex"));
            $option->add("fri_openx", $this->createColumnOption("fri_openx"));
            $option->add("fri_closex", $this->createColumnOption("fri_closex"));
            $option->add("sat_openx", $this->createColumnOption("sat_openx"));
            $option->add("sat_closex", $this->createColumnOption("sat_closex"));
            $option->add("sun_openx", $this->createColumnOption("sun_openx"));
            $option->add("sun_closex", $this->createColumnOption("sun_closex"));
            $option->add("closex", $this->createColumnOption("closex"));
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = false;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fhours_exceptionsrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fhours_exceptionsrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Create new column option
    public function createColumnOption($name)
    {
        $field = $this->Fields[$name] ?? false;
        if ($field && $field->Visible) {
            $item = new ListOption($field->Name);
            $item->Body = '<button class="dropdown-item">' . 
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
            return $item;
        }
        return null;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fhours_exceptionlist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            $this->UserAction = $userAction;
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($rs) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                    if ($this->getSuccessMessage() == "" && !ob_get_length() && !$Response->getBody()->getSize()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        $rs = new Recordset($result, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    // Load records as associative array
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        return $result->fetchAll(FetchMode::ASSOCIATIVE);
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
        $this->start->setDbValue($row['start']);
        $this->end->setDbValue($row['end']);
        $this->mon_openx->setDbValue($row['mon_openx']);
        $this->mon_closex->setDbValue($row['mon_closex']);
        $this->tue_openx->setDbValue($row['tue_openx']);
        $this->tue_closex->setDbValue($row['tue_closex']);
        $this->wed_openx->setDbValue($row['wed_openx']);
        $this->wed_closex->setDbValue($row['wed_closex']);
        $this->thu_openx->setDbValue($row['thu_openx']);
        $this->thu_closex->setDbValue($row['thu_closex']);
        $this->fri_openx->setDbValue($row['fri_openx']);
        $this->fri_closex->setDbValue($row['fri_closex']);
        $this->sat_openx->setDbValue($row['sat_openx']);
        $this->sat_closex->setDbValue($row['sat_closex']);
        $this->sun_openx->setDbValue($row['sun_openx']);
        $this->sun_closex->setDbValue($row['sun_closex']);
        $this->closex->setDbValue($row['closex']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['location_id'] = null;
        $row['start'] = null;
        $row['end'] = null;
        $row['mon_openx'] = null;
        $row['mon_closex'] = null;
        $row['tue_openx'] = null;
        $row['tue_closex'] = null;
        $row['wed_openx'] = null;
        $row['wed_closex'] = null;
        $row['thu_openx'] = null;
        $row['thu_closex'] = null;
        $row['fri_openx'] = null;
        $row['fri_closex'] = null;
        $row['sat_openx'] = null;
        $row['sat_closex'] = null;
        $row['sun_openx'] = null;
        $row['sun_closex'] = null;
        $row['closex'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        return false;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // location_id

        // start

        // end

        // mon_openx

        // mon_closex

        // tue_openx

        // tue_closex

        // wed_openx

        // wed_closex

        // thu_openx

        // thu_closex

        // fri_openx

        // fri_closex

        // sat_openx

        // sat_closex

        // sun_openx

        // sun_closex

        // closex

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // location_id
            $this->location_id->ViewValue = $this->location_id->CurrentValue;
            $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, "");
            $this->location_id->ViewCustomAttributes = "";

            // start
            $this->start->ViewValue = $this->start->CurrentValue;
            $this->start->ViewValue = FormatDateTime($this->start->ViewValue, 0);
            $this->start->ViewCustomAttributes = "";

            // end
            $this->end->ViewValue = $this->end->CurrentValue;
            $this->end->ViewValue = FormatDateTime($this->end->ViewValue, 0);
            $this->end->ViewCustomAttributes = "";

            // mon_openx
            $this->mon_openx->ViewValue = $this->mon_openx->CurrentValue;
            $this->mon_openx->ViewValue = FormatDateTime($this->mon_openx->ViewValue, 4);
            $this->mon_openx->ViewCustomAttributes = "";

            // mon_closex
            $this->mon_closex->ViewValue = $this->mon_closex->CurrentValue;
            $this->mon_closex->ViewValue = FormatDateTime($this->mon_closex->ViewValue, 4);
            $this->mon_closex->ViewCustomAttributes = "";

            // tue_openx
            $this->tue_openx->ViewValue = $this->tue_openx->CurrentValue;
            $this->tue_openx->ViewValue = FormatDateTime($this->tue_openx->ViewValue, 4);
            $this->tue_openx->ViewCustomAttributes = "";

            // tue_closex
            $this->tue_closex->ViewValue = $this->tue_closex->CurrentValue;
            $this->tue_closex->ViewValue = FormatDateTime($this->tue_closex->ViewValue, 4);
            $this->tue_closex->ViewCustomAttributes = "";

            // wed_openx
            $this->wed_openx->ViewValue = $this->wed_openx->CurrentValue;
            $this->wed_openx->ViewValue = FormatDateTime($this->wed_openx->ViewValue, 4);
            $this->wed_openx->ViewCustomAttributes = "";

            // wed_closex
            $this->wed_closex->ViewValue = $this->wed_closex->CurrentValue;
            $this->wed_closex->ViewValue = FormatDateTime($this->wed_closex->ViewValue, 4);
            $this->wed_closex->ViewCustomAttributes = "";

            // thu_openx
            $this->thu_openx->ViewValue = $this->thu_openx->CurrentValue;
            $this->thu_openx->ViewValue = FormatDateTime($this->thu_openx->ViewValue, 4);
            $this->thu_openx->ViewCustomAttributes = "";

            // thu_closex
            $this->thu_closex->ViewValue = $this->thu_closex->CurrentValue;
            $this->thu_closex->ViewValue = FormatDateTime($this->thu_closex->ViewValue, 4);
            $this->thu_closex->ViewCustomAttributes = "";

            // fri_openx
            $this->fri_openx->ViewValue = $this->fri_openx->CurrentValue;
            $this->fri_openx->ViewValue = FormatDateTime($this->fri_openx->ViewValue, 4);
            $this->fri_openx->ViewCustomAttributes = "";

            // fri_closex
            $this->fri_closex->ViewValue = $this->fri_closex->CurrentValue;
            $this->fri_closex->ViewValue = FormatDateTime($this->fri_closex->ViewValue, 4);
            $this->fri_closex->ViewCustomAttributes = "";

            // sat_openx
            $this->sat_openx->ViewValue = $this->sat_openx->CurrentValue;
            $this->sat_openx->ViewValue = FormatDateTime($this->sat_openx->ViewValue, 4);
            $this->sat_openx->ViewCustomAttributes = "";

            // sat_closex
            $this->sat_closex->ViewValue = $this->sat_closex->CurrentValue;
            $this->sat_closex->ViewValue = FormatDateTime($this->sat_closex->ViewValue, 4);
            $this->sat_closex->ViewCustomAttributes = "";

            // sun_openx
            $this->sun_openx->ViewValue = $this->sun_openx->CurrentValue;
            $this->sun_openx->ViewValue = FormatDateTime($this->sun_openx->ViewValue, 4);
            $this->sun_openx->ViewCustomAttributes = "";

            // sun_closex
            $this->sun_closex->ViewValue = $this->sun_closex->CurrentValue;
            $this->sun_closex->ViewValue = FormatDateTime($this->sun_closex->ViewValue, 4);
            $this->sun_closex->ViewCustomAttributes = "";

            // closex
            $this->closex->ViewValue = $this->closex->CurrentValue;
            $this->closex->ViewCustomAttributes = "";

            // location_id
            $this->location_id->LinkCustomAttributes = "";
            $this->location_id->HrefValue = "";
            $this->location_id->TooltipValue = "";

            // start
            $this->start->LinkCustomAttributes = "";
            $this->start->HrefValue = "";
            $this->start->TooltipValue = "";

            // end
            $this->end->LinkCustomAttributes = "";
            $this->end->HrefValue = "";
            $this->end->TooltipValue = "";

            // mon_openx
            $this->mon_openx->LinkCustomAttributes = "";
            $this->mon_openx->HrefValue = "";
            $this->mon_openx->TooltipValue = "";

            // mon_closex
            $this->mon_closex->LinkCustomAttributes = "";
            $this->mon_closex->HrefValue = "";
            $this->mon_closex->TooltipValue = "";

            // tue_openx
            $this->tue_openx->LinkCustomAttributes = "";
            $this->tue_openx->HrefValue = "";
            $this->tue_openx->TooltipValue = "";

            // tue_closex
            $this->tue_closex->LinkCustomAttributes = "";
            $this->tue_closex->HrefValue = "";
            $this->tue_closex->TooltipValue = "";

            // wed_openx
            $this->wed_openx->LinkCustomAttributes = "";
            $this->wed_openx->HrefValue = "";
            $this->wed_openx->TooltipValue = "";

            // wed_closex
            $this->wed_closex->LinkCustomAttributes = "";
            $this->wed_closex->HrefValue = "";
            $this->wed_closex->TooltipValue = "";

            // thu_openx
            $this->thu_openx->LinkCustomAttributes = "";
            $this->thu_openx->HrefValue = "";
            $this->thu_openx->TooltipValue = "";

            // thu_closex
            $this->thu_closex->LinkCustomAttributes = "";
            $this->thu_closex->HrefValue = "";
            $this->thu_closex->TooltipValue = "";

            // fri_openx
            $this->fri_openx->LinkCustomAttributes = "";
            $this->fri_openx->HrefValue = "";
            $this->fri_openx->TooltipValue = "";

            // fri_closex
            $this->fri_closex->LinkCustomAttributes = "";
            $this->fri_closex->HrefValue = "";
            $this->fri_closex->TooltipValue = "";

            // sat_openx
            $this->sat_openx->LinkCustomAttributes = "";
            $this->sat_openx->HrefValue = "";
            $this->sat_openx->TooltipValue = "";

            // sat_closex
            $this->sat_closex->LinkCustomAttributes = "";
            $this->sat_closex->HrefValue = "";
            $this->sat_closex->TooltipValue = "";

            // sun_openx
            $this->sun_openx->LinkCustomAttributes = "";
            $this->sun_openx->HrefValue = "";
            $this->sun_openx->TooltipValue = "";

            // sun_closex
            $this->sun_closex->LinkCustomAttributes = "";
            $this->sun_closex->HrefValue = "";
            $this->sun_closex->TooltipValue = "";

            // closex
            $this->closex->LinkCustomAttributes = "";
            $this->closex->HrefValue = "";
            $this->closex->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-bs-toggle=\"button\" data-form=\"fhours_exceptionsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
