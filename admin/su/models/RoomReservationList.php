<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RoomReservationList extends RoomReservation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'room_reservation';

    // Page object name
    public $PageObjName = "RoomReservationList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "froom_reservationlist";
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

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

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

        // Table object (room_reservation)
        if (!isset($GLOBALS["room_reservation"]) || get_class($GLOBALS["room_reservation"]) == PROJECT_NAMESPACE . "room_reservation") {
            $GLOBALS["room_reservation"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->AddUrl = "RoomReservationAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "RoomReservationDelete";
        $this->MultiUpdateUrl = "RoomReservationUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'room_reservation');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // List options
        $this->ListOptions = new ListOptions();
        $this->ListOptions->TableVar = $this->TableVar;

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Import options
        $this->ImportOptions = new ListOptions("div");
        $this->ImportOptions->TagClassName = "ew-import-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option froom_reservationlistsrch";

        // List actions
        $this->ListActions = new ListActions();
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
                $doc = new $class(Container("room_reservation"));
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
    public $SearchRowCount = 0; // For extended search
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $RowAction = ""; // Row action
    public $MultiColumnClass = "col-sm";
    public $MultiColumnEditClass = "w-100";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $RestoreSearch = false;
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
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->id->setVisibility();
        $this->contact_org->setVisibility();
        $this->contact_name->setVisibility();
        $this->contact_email->setVisibility();
        $this->contact_phone->setVisibility();
        $this->contact_fax->setVisibility();
        $this->contact_address->setVisibility();
        $this->contact_city->setVisibility();
        $this->contact_state->setVisibility();
        $this->contact_zip->setVisibility();
        $this->contact_advisor->setVisibility();
        $this->contact_advisor_phone->setVisibility();
        $this->contact_advisor_email->setVisibility();
        $this->billing_org->setVisibility();
        $this->billing_name->setVisibility();
        $this->billing_email->setVisibility();
        $this->billing_phone->setVisibility();
        $this->billing_fax->setVisibility();
        $this->billing_address->setVisibility();
        $this->billing_city->setVisibility();
        $this->billing_state->setVisibility();
        $this->billing_zip->setVisibility();
        $this->billing_method->setVisibility();
        $this->billing_frs->setVisibility();
        $this->event_title->setVisibility();
        $this->event_type->setVisibility();
        $this->event_date->setVisibility();
        $this->event_time_start->setVisibility();
        $this->event_time_end->setVisibility();
        $this->event_num_people->setVisibility();
        $this->event_room_preference->setVisibility();
        $this->recurring_jan->setVisibility();
        $this->recurring_feb->setVisibility();
        $this->recurring_mar->setVisibility();
        $this->recurring_apr->setVisibility();
        $this->recurring_may->setVisibility();
        $this->recurring_jun->setVisibility();
        $this->recurring_jul->setVisibility();
        $this->recurring_aug->setVisibility();
        $this->recurring_sep->setVisibility();
        $this->recurring_oct->setVisibility();
        $this->recurring_nov->setVisibility();
        $this->recurring_dec->setVisibility();
        $this->setup_shape->setVisibility();
        $this->certification_name->setVisibility();
        $this->certification_date->setVisibility();
        $this->timestamp->setVisibility();
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

        // Show checkbox column if multiple action
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
                $this->ListOptions["checkbox"]->Visible = true;
                break;
            }
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

        // Search/sort options
        $this->setupSearchSortOptions();

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
        $this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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
        $filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
        $filterList = Concat($filterList, $this->contact_org->AdvancedSearch->toJson(), ","); // Field contact_org
        $filterList = Concat($filterList, $this->contact_name->AdvancedSearch->toJson(), ","); // Field contact_name
        $filterList = Concat($filterList, $this->contact_email->AdvancedSearch->toJson(), ","); // Field contact_email
        $filterList = Concat($filterList, $this->contact_phone->AdvancedSearch->toJson(), ","); // Field contact_phone
        $filterList = Concat($filterList, $this->contact_fax->AdvancedSearch->toJson(), ","); // Field contact_fax
        $filterList = Concat($filterList, $this->contact_address->AdvancedSearch->toJson(), ","); // Field contact_address
        $filterList = Concat($filterList, $this->contact_city->AdvancedSearch->toJson(), ","); // Field contact_city
        $filterList = Concat($filterList, $this->contact_state->AdvancedSearch->toJson(), ","); // Field contact_state
        $filterList = Concat($filterList, $this->contact_zip->AdvancedSearch->toJson(), ","); // Field contact_zip
        $filterList = Concat($filterList, $this->contact_advisor->AdvancedSearch->toJson(), ","); // Field contact_advisor
        $filterList = Concat($filterList, $this->contact_advisor_phone->AdvancedSearch->toJson(), ","); // Field contact_advisor_phone
        $filterList = Concat($filterList, $this->contact_advisor_email->AdvancedSearch->toJson(), ","); // Field contact_advisor_email
        $filterList = Concat($filterList, $this->billing_org->AdvancedSearch->toJson(), ","); // Field billing_org
        $filterList = Concat($filterList, $this->billing_name->AdvancedSearch->toJson(), ","); // Field billing_name
        $filterList = Concat($filterList, $this->billing_email->AdvancedSearch->toJson(), ","); // Field billing_email
        $filterList = Concat($filterList, $this->billing_phone->AdvancedSearch->toJson(), ","); // Field billing_phone
        $filterList = Concat($filterList, $this->billing_fax->AdvancedSearch->toJson(), ","); // Field billing_fax
        $filterList = Concat($filterList, $this->billing_address->AdvancedSearch->toJson(), ","); // Field billing_address
        $filterList = Concat($filterList, $this->billing_city->AdvancedSearch->toJson(), ","); // Field billing_city
        $filterList = Concat($filterList, $this->billing_state->AdvancedSearch->toJson(), ","); // Field billing_state
        $filterList = Concat($filterList, $this->billing_zip->AdvancedSearch->toJson(), ","); // Field billing_zip
        $filterList = Concat($filterList, $this->billing_method->AdvancedSearch->toJson(), ","); // Field billing_method
        $filterList = Concat($filterList, $this->billing_frs->AdvancedSearch->toJson(), ","); // Field billing_frs
        $filterList = Concat($filterList, $this->event_title->AdvancedSearch->toJson(), ","); // Field event_title
        $filterList = Concat($filterList, $this->event_type->AdvancedSearch->toJson(), ","); // Field event_type
        $filterList = Concat($filterList, $this->event_date->AdvancedSearch->toJson(), ","); // Field event_date
        $filterList = Concat($filterList, $this->event_time_start->AdvancedSearch->toJson(), ","); // Field event_time_start
        $filterList = Concat($filterList, $this->event_time_end->AdvancedSearch->toJson(), ","); // Field event_time_end
        $filterList = Concat($filterList, $this->event_num_people->AdvancedSearch->toJson(), ","); // Field event_num_people
        $filterList = Concat($filterList, $this->event_room_preference->AdvancedSearch->toJson(), ","); // Field event_room_preference
        $filterList = Concat($filterList, $this->recurring_jan->AdvancedSearch->toJson(), ","); // Field recurring_jan
        $filterList = Concat($filterList, $this->recurring_feb->AdvancedSearch->toJson(), ","); // Field recurring_feb
        $filterList = Concat($filterList, $this->recurring_mar->AdvancedSearch->toJson(), ","); // Field recurring_mar
        $filterList = Concat($filterList, $this->recurring_apr->AdvancedSearch->toJson(), ","); // Field recurring_apr
        $filterList = Concat($filterList, $this->recurring_may->AdvancedSearch->toJson(), ","); // Field recurring_may
        $filterList = Concat($filterList, $this->recurring_jun->AdvancedSearch->toJson(), ","); // Field recurring_jun
        $filterList = Concat($filterList, $this->recurring_jul->AdvancedSearch->toJson(), ","); // Field recurring_jul
        $filterList = Concat($filterList, $this->recurring_aug->AdvancedSearch->toJson(), ","); // Field recurring_aug
        $filterList = Concat($filterList, $this->recurring_sep->AdvancedSearch->toJson(), ","); // Field recurring_sep
        $filterList = Concat($filterList, $this->recurring_oct->AdvancedSearch->toJson(), ","); // Field recurring_oct
        $filterList = Concat($filterList, $this->recurring_nov->AdvancedSearch->toJson(), ","); // Field recurring_nov
        $filterList = Concat($filterList, $this->recurring_dec->AdvancedSearch->toJson(), ","); // Field recurring_dec
        $filterList = Concat($filterList, $this->setup_shape->AdvancedSearch->toJson(), ","); // Field setup_shape
        $filterList = Concat($filterList, $this->certification_name->AdvancedSearch->toJson(), ","); // Field certification_name
        $filterList = Concat($filterList, $this->certification_date->AdvancedSearch->toJson(), ","); // Field certification_date
        $filterList = Concat($filterList, $this->timestamp->AdvancedSearch->toJson(), ","); // Field timestamp
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
            $UserProfile->setSearchFilters(CurrentUserName(), "froom_reservationlistsrch", $filters);
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

        // Field id
        $this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
        $this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
        $this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
        $this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
        $this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
        $this->id->AdvancedSearch->save();

        // Field contact_org
        $this->contact_org->AdvancedSearch->SearchValue = @$filter["x_contact_org"];
        $this->contact_org->AdvancedSearch->SearchOperator = @$filter["z_contact_org"];
        $this->contact_org->AdvancedSearch->SearchCondition = @$filter["v_contact_org"];
        $this->contact_org->AdvancedSearch->SearchValue2 = @$filter["y_contact_org"];
        $this->contact_org->AdvancedSearch->SearchOperator2 = @$filter["w_contact_org"];
        $this->contact_org->AdvancedSearch->save();

        // Field contact_name
        $this->contact_name->AdvancedSearch->SearchValue = @$filter["x_contact_name"];
        $this->contact_name->AdvancedSearch->SearchOperator = @$filter["z_contact_name"];
        $this->contact_name->AdvancedSearch->SearchCondition = @$filter["v_contact_name"];
        $this->contact_name->AdvancedSearch->SearchValue2 = @$filter["y_contact_name"];
        $this->contact_name->AdvancedSearch->SearchOperator2 = @$filter["w_contact_name"];
        $this->contact_name->AdvancedSearch->save();

        // Field contact_email
        $this->contact_email->AdvancedSearch->SearchValue = @$filter["x_contact_email"];
        $this->contact_email->AdvancedSearch->SearchOperator = @$filter["z_contact_email"];
        $this->contact_email->AdvancedSearch->SearchCondition = @$filter["v_contact_email"];
        $this->contact_email->AdvancedSearch->SearchValue2 = @$filter["y_contact_email"];
        $this->contact_email->AdvancedSearch->SearchOperator2 = @$filter["w_contact_email"];
        $this->contact_email->AdvancedSearch->save();

        // Field contact_phone
        $this->contact_phone->AdvancedSearch->SearchValue = @$filter["x_contact_phone"];
        $this->contact_phone->AdvancedSearch->SearchOperator = @$filter["z_contact_phone"];
        $this->contact_phone->AdvancedSearch->SearchCondition = @$filter["v_contact_phone"];
        $this->contact_phone->AdvancedSearch->SearchValue2 = @$filter["y_contact_phone"];
        $this->contact_phone->AdvancedSearch->SearchOperator2 = @$filter["w_contact_phone"];
        $this->contact_phone->AdvancedSearch->save();

        // Field contact_fax
        $this->contact_fax->AdvancedSearch->SearchValue = @$filter["x_contact_fax"];
        $this->contact_fax->AdvancedSearch->SearchOperator = @$filter["z_contact_fax"];
        $this->contact_fax->AdvancedSearch->SearchCondition = @$filter["v_contact_fax"];
        $this->contact_fax->AdvancedSearch->SearchValue2 = @$filter["y_contact_fax"];
        $this->contact_fax->AdvancedSearch->SearchOperator2 = @$filter["w_contact_fax"];
        $this->contact_fax->AdvancedSearch->save();

        // Field contact_address
        $this->contact_address->AdvancedSearch->SearchValue = @$filter["x_contact_address"];
        $this->contact_address->AdvancedSearch->SearchOperator = @$filter["z_contact_address"];
        $this->contact_address->AdvancedSearch->SearchCondition = @$filter["v_contact_address"];
        $this->contact_address->AdvancedSearch->SearchValue2 = @$filter["y_contact_address"];
        $this->contact_address->AdvancedSearch->SearchOperator2 = @$filter["w_contact_address"];
        $this->contact_address->AdvancedSearch->save();

        // Field contact_city
        $this->contact_city->AdvancedSearch->SearchValue = @$filter["x_contact_city"];
        $this->contact_city->AdvancedSearch->SearchOperator = @$filter["z_contact_city"];
        $this->contact_city->AdvancedSearch->SearchCondition = @$filter["v_contact_city"];
        $this->contact_city->AdvancedSearch->SearchValue2 = @$filter["y_contact_city"];
        $this->contact_city->AdvancedSearch->SearchOperator2 = @$filter["w_contact_city"];
        $this->contact_city->AdvancedSearch->save();

        // Field contact_state
        $this->contact_state->AdvancedSearch->SearchValue = @$filter["x_contact_state"];
        $this->contact_state->AdvancedSearch->SearchOperator = @$filter["z_contact_state"];
        $this->contact_state->AdvancedSearch->SearchCondition = @$filter["v_contact_state"];
        $this->contact_state->AdvancedSearch->SearchValue2 = @$filter["y_contact_state"];
        $this->contact_state->AdvancedSearch->SearchOperator2 = @$filter["w_contact_state"];
        $this->contact_state->AdvancedSearch->save();

        // Field contact_zip
        $this->contact_zip->AdvancedSearch->SearchValue = @$filter["x_contact_zip"];
        $this->contact_zip->AdvancedSearch->SearchOperator = @$filter["z_contact_zip"];
        $this->contact_zip->AdvancedSearch->SearchCondition = @$filter["v_contact_zip"];
        $this->contact_zip->AdvancedSearch->SearchValue2 = @$filter["y_contact_zip"];
        $this->contact_zip->AdvancedSearch->SearchOperator2 = @$filter["w_contact_zip"];
        $this->contact_zip->AdvancedSearch->save();

        // Field contact_advisor
        $this->contact_advisor->AdvancedSearch->SearchValue = @$filter["x_contact_advisor"];
        $this->contact_advisor->AdvancedSearch->SearchOperator = @$filter["z_contact_advisor"];
        $this->contact_advisor->AdvancedSearch->SearchCondition = @$filter["v_contact_advisor"];
        $this->contact_advisor->AdvancedSearch->SearchValue2 = @$filter["y_contact_advisor"];
        $this->contact_advisor->AdvancedSearch->SearchOperator2 = @$filter["w_contact_advisor"];
        $this->contact_advisor->AdvancedSearch->save();

        // Field contact_advisor_phone
        $this->contact_advisor_phone->AdvancedSearch->SearchValue = @$filter["x_contact_advisor_phone"];
        $this->contact_advisor_phone->AdvancedSearch->SearchOperator = @$filter["z_contact_advisor_phone"];
        $this->contact_advisor_phone->AdvancedSearch->SearchCondition = @$filter["v_contact_advisor_phone"];
        $this->contact_advisor_phone->AdvancedSearch->SearchValue2 = @$filter["y_contact_advisor_phone"];
        $this->contact_advisor_phone->AdvancedSearch->SearchOperator2 = @$filter["w_contact_advisor_phone"];
        $this->contact_advisor_phone->AdvancedSearch->save();

        // Field contact_advisor_email
        $this->contact_advisor_email->AdvancedSearch->SearchValue = @$filter["x_contact_advisor_email"];
        $this->contact_advisor_email->AdvancedSearch->SearchOperator = @$filter["z_contact_advisor_email"];
        $this->contact_advisor_email->AdvancedSearch->SearchCondition = @$filter["v_contact_advisor_email"];
        $this->contact_advisor_email->AdvancedSearch->SearchValue2 = @$filter["y_contact_advisor_email"];
        $this->contact_advisor_email->AdvancedSearch->SearchOperator2 = @$filter["w_contact_advisor_email"];
        $this->contact_advisor_email->AdvancedSearch->save();

        // Field billing_org
        $this->billing_org->AdvancedSearch->SearchValue = @$filter["x_billing_org"];
        $this->billing_org->AdvancedSearch->SearchOperator = @$filter["z_billing_org"];
        $this->billing_org->AdvancedSearch->SearchCondition = @$filter["v_billing_org"];
        $this->billing_org->AdvancedSearch->SearchValue2 = @$filter["y_billing_org"];
        $this->billing_org->AdvancedSearch->SearchOperator2 = @$filter["w_billing_org"];
        $this->billing_org->AdvancedSearch->save();

        // Field billing_name
        $this->billing_name->AdvancedSearch->SearchValue = @$filter["x_billing_name"];
        $this->billing_name->AdvancedSearch->SearchOperator = @$filter["z_billing_name"];
        $this->billing_name->AdvancedSearch->SearchCondition = @$filter["v_billing_name"];
        $this->billing_name->AdvancedSearch->SearchValue2 = @$filter["y_billing_name"];
        $this->billing_name->AdvancedSearch->SearchOperator2 = @$filter["w_billing_name"];
        $this->billing_name->AdvancedSearch->save();

        // Field billing_email
        $this->billing_email->AdvancedSearch->SearchValue = @$filter["x_billing_email"];
        $this->billing_email->AdvancedSearch->SearchOperator = @$filter["z_billing_email"];
        $this->billing_email->AdvancedSearch->SearchCondition = @$filter["v_billing_email"];
        $this->billing_email->AdvancedSearch->SearchValue2 = @$filter["y_billing_email"];
        $this->billing_email->AdvancedSearch->SearchOperator2 = @$filter["w_billing_email"];
        $this->billing_email->AdvancedSearch->save();

        // Field billing_phone
        $this->billing_phone->AdvancedSearch->SearchValue = @$filter["x_billing_phone"];
        $this->billing_phone->AdvancedSearch->SearchOperator = @$filter["z_billing_phone"];
        $this->billing_phone->AdvancedSearch->SearchCondition = @$filter["v_billing_phone"];
        $this->billing_phone->AdvancedSearch->SearchValue2 = @$filter["y_billing_phone"];
        $this->billing_phone->AdvancedSearch->SearchOperator2 = @$filter["w_billing_phone"];
        $this->billing_phone->AdvancedSearch->save();

        // Field billing_fax
        $this->billing_fax->AdvancedSearch->SearchValue = @$filter["x_billing_fax"];
        $this->billing_fax->AdvancedSearch->SearchOperator = @$filter["z_billing_fax"];
        $this->billing_fax->AdvancedSearch->SearchCondition = @$filter["v_billing_fax"];
        $this->billing_fax->AdvancedSearch->SearchValue2 = @$filter["y_billing_fax"];
        $this->billing_fax->AdvancedSearch->SearchOperator2 = @$filter["w_billing_fax"];
        $this->billing_fax->AdvancedSearch->save();

        // Field billing_address
        $this->billing_address->AdvancedSearch->SearchValue = @$filter["x_billing_address"];
        $this->billing_address->AdvancedSearch->SearchOperator = @$filter["z_billing_address"];
        $this->billing_address->AdvancedSearch->SearchCondition = @$filter["v_billing_address"];
        $this->billing_address->AdvancedSearch->SearchValue2 = @$filter["y_billing_address"];
        $this->billing_address->AdvancedSearch->SearchOperator2 = @$filter["w_billing_address"];
        $this->billing_address->AdvancedSearch->save();

        // Field billing_city
        $this->billing_city->AdvancedSearch->SearchValue = @$filter["x_billing_city"];
        $this->billing_city->AdvancedSearch->SearchOperator = @$filter["z_billing_city"];
        $this->billing_city->AdvancedSearch->SearchCondition = @$filter["v_billing_city"];
        $this->billing_city->AdvancedSearch->SearchValue2 = @$filter["y_billing_city"];
        $this->billing_city->AdvancedSearch->SearchOperator2 = @$filter["w_billing_city"];
        $this->billing_city->AdvancedSearch->save();

        // Field billing_state
        $this->billing_state->AdvancedSearch->SearchValue = @$filter["x_billing_state"];
        $this->billing_state->AdvancedSearch->SearchOperator = @$filter["z_billing_state"];
        $this->billing_state->AdvancedSearch->SearchCondition = @$filter["v_billing_state"];
        $this->billing_state->AdvancedSearch->SearchValue2 = @$filter["y_billing_state"];
        $this->billing_state->AdvancedSearch->SearchOperator2 = @$filter["w_billing_state"];
        $this->billing_state->AdvancedSearch->save();

        // Field billing_zip
        $this->billing_zip->AdvancedSearch->SearchValue = @$filter["x_billing_zip"];
        $this->billing_zip->AdvancedSearch->SearchOperator = @$filter["z_billing_zip"];
        $this->billing_zip->AdvancedSearch->SearchCondition = @$filter["v_billing_zip"];
        $this->billing_zip->AdvancedSearch->SearchValue2 = @$filter["y_billing_zip"];
        $this->billing_zip->AdvancedSearch->SearchOperator2 = @$filter["w_billing_zip"];
        $this->billing_zip->AdvancedSearch->save();

        // Field billing_method
        $this->billing_method->AdvancedSearch->SearchValue = @$filter["x_billing_method"];
        $this->billing_method->AdvancedSearch->SearchOperator = @$filter["z_billing_method"];
        $this->billing_method->AdvancedSearch->SearchCondition = @$filter["v_billing_method"];
        $this->billing_method->AdvancedSearch->SearchValue2 = @$filter["y_billing_method"];
        $this->billing_method->AdvancedSearch->SearchOperator2 = @$filter["w_billing_method"];
        $this->billing_method->AdvancedSearch->save();

        // Field billing_frs
        $this->billing_frs->AdvancedSearch->SearchValue = @$filter["x_billing_frs"];
        $this->billing_frs->AdvancedSearch->SearchOperator = @$filter["z_billing_frs"];
        $this->billing_frs->AdvancedSearch->SearchCondition = @$filter["v_billing_frs"];
        $this->billing_frs->AdvancedSearch->SearchValue2 = @$filter["y_billing_frs"];
        $this->billing_frs->AdvancedSearch->SearchOperator2 = @$filter["w_billing_frs"];
        $this->billing_frs->AdvancedSearch->save();

        // Field event_title
        $this->event_title->AdvancedSearch->SearchValue = @$filter["x_event_title"];
        $this->event_title->AdvancedSearch->SearchOperator = @$filter["z_event_title"];
        $this->event_title->AdvancedSearch->SearchCondition = @$filter["v_event_title"];
        $this->event_title->AdvancedSearch->SearchValue2 = @$filter["y_event_title"];
        $this->event_title->AdvancedSearch->SearchOperator2 = @$filter["w_event_title"];
        $this->event_title->AdvancedSearch->save();

        // Field event_type
        $this->event_type->AdvancedSearch->SearchValue = @$filter["x_event_type"];
        $this->event_type->AdvancedSearch->SearchOperator = @$filter["z_event_type"];
        $this->event_type->AdvancedSearch->SearchCondition = @$filter["v_event_type"];
        $this->event_type->AdvancedSearch->SearchValue2 = @$filter["y_event_type"];
        $this->event_type->AdvancedSearch->SearchOperator2 = @$filter["w_event_type"];
        $this->event_type->AdvancedSearch->save();

        // Field event_date
        $this->event_date->AdvancedSearch->SearchValue = @$filter["x_event_date"];
        $this->event_date->AdvancedSearch->SearchOperator = @$filter["z_event_date"];
        $this->event_date->AdvancedSearch->SearchCondition = @$filter["v_event_date"];
        $this->event_date->AdvancedSearch->SearchValue2 = @$filter["y_event_date"];
        $this->event_date->AdvancedSearch->SearchOperator2 = @$filter["w_event_date"];
        $this->event_date->AdvancedSearch->save();

        // Field event_time_start
        $this->event_time_start->AdvancedSearch->SearchValue = @$filter["x_event_time_start"];
        $this->event_time_start->AdvancedSearch->SearchOperator = @$filter["z_event_time_start"];
        $this->event_time_start->AdvancedSearch->SearchCondition = @$filter["v_event_time_start"];
        $this->event_time_start->AdvancedSearch->SearchValue2 = @$filter["y_event_time_start"];
        $this->event_time_start->AdvancedSearch->SearchOperator2 = @$filter["w_event_time_start"];
        $this->event_time_start->AdvancedSearch->save();

        // Field event_time_end
        $this->event_time_end->AdvancedSearch->SearchValue = @$filter["x_event_time_end"];
        $this->event_time_end->AdvancedSearch->SearchOperator = @$filter["z_event_time_end"];
        $this->event_time_end->AdvancedSearch->SearchCondition = @$filter["v_event_time_end"];
        $this->event_time_end->AdvancedSearch->SearchValue2 = @$filter["y_event_time_end"];
        $this->event_time_end->AdvancedSearch->SearchOperator2 = @$filter["w_event_time_end"];
        $this->event_time_end->AdvancedSearch->save();

        // Field event_num_people
        $this->event_num_people->AdvancedSearch->SearchValue = @$filter["x_event_num_people"];
        $this->event_num_people->AdvancedSearch->SearchOperator = @$filter["z_event_num_people"];
        $this->event_num_people->AdvancedSearch->SearchCondition = @$filter["v_event_num_people"];
        $this->event_num_people->AdvancedSearch->SearchValue2 = @$filter["y_event_num_people"];
        $this->event_num_people->AdvancedSearch->SearchOperator2 = @$filter["w_event_num_people"];
        $this->event_num_people->AdvancedSearch->save();

        // Field event_room_preference
        $this->event_room_preference->AdvancedSearch->SearchValue = @$filter["x_event_room_preference"];
        $this->event_room_preference->AdvancedSearch->SearchOperator = @$filter["z_event_room_preference"];
        $this->event_room_preference->AdvancedSearch->SearchCondition = @$filter["v_event_room_preference"];
        $this->event_room_preference->AdvancedSearch->SearchValue2 = @$filter["y_event_room_preference"];
        $this->event_room_preference->AdvancedSearch->SearchOperator2 = @$filter["w_event_room_preference"];
        $this->event_room_preference->AdvancedSearch->save();

        // Field recurring_jan
        $this->recurring_jan->AdvancedSearch->SearchValue = @$filter["x_recurring_jan"];
        $this->recurring_jan->AdvancedSearch->SearchOperator = @$filter["z_recurring_jan"];
        $this->recurring_jan->AdvancedSearch->SearchCondition = @$filter["v_recurring_jan"];
        $this->recurring_jan->AdvancedSearch->SearchValue2 = @$filter["y_recurring_jan"];
        $this->recurring_jan->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_jan"];
        $this->recurring_jan->AdvancedSearch->save();

        // Field recurring_feb
        $this->recurring_feb->AdvancedSearch->SearchValue = @$filter["x_recurring_feb"];
        $this->recurring_feb->AdvancedSearch->SearchOperator = @$filter["z_recurring_feb"];
        $this->recurring_feb->AdvancedSearch->SearchCondition = @$filter["v_recurring_feb"];
        $this->recurring_feb->AdvancedSearch->SearchValue2 = @$filter["y_recurring_feb"];
        $this->recurring_feb->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_feb"];
        $this->recurring_feb->AdvancedSearch->save();

        // Field recurring_mar
        $this->recurring_mar->AdvancedSearch->SearchValue = @$filter["x_recurring_mar"];
        $this->recurring_mar->AdvancedSearch->SearchOperator = @$filter["z_recurring_mar"];
        $this->recurring_mar->AdvancedSearch->SearchCondition = @$filter["v_recurring_mar"];
        $this->recurring_mar->AdvancedSearch->SearchValue2 = @$filter["y_recurring_mar"];
        $this->recurring_mar->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_mar"];
        $this->recurring_mar->AdvancedSearch->save();

        // Field recurring_apr
        $this->recurring_apr->AdvancedSearch->SearchValue = @$filter["x_recurring_apr"];
        $this->recurring_apr->AdvancedSearch->SearchOperator = @$filter["z_recurring_apr"];
        $this->recurring_apr->AdvancedSearch->SearchCondition = @$filter["v_recurring_apr"];
        $this->recurring_apr->AdvancedSearch->SearchValue2 = @$filter["y_recurring_apr"];
        $this->recurring_apr->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_apr"];
        $this->recurring_apr->AdvancedSearch->save();

        // Field recurring_may
        $this->recurring_may->AdvancedSearch->SearchValue = @$filter["x_recurring_may"];
        $this->recurring_may->AdvancedSearch->SearchOperator = @$filter["z_recurring_may"];
        $this->recurring_may->AdvancedSearch->SearchCondition = @$filter["v_recurring_may"];
        $this->recurring_may->AdvancedSearch->SearchValue2 = @$filter["y_recurring_may"];
        $this->recurring_may->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_may"];
        $this->recurring_may->AdvancedSearch->save();

        // Field recurring_jun
        $this->recurring_jun->AdvancedSearch->SearchValue = @$filter["x_recurring_jun"];
        $this->recurring_jun->AdvancedSearch->SearchOperator = @$filter["z_recurring_jun"];
        $this->recurring_jun->AdvancedSearch->SearchCondition = @$filter["v_recurring_jun"];
        $this->recurring_jun->AdvancedSearch->SearchValue2 = @$filter["y_recurring_jun"];
        $this->recurring_jun->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_jun"];
        $this->recurring_jun->AdvancedSearch->save();

        // Field recurring_jul
        $this->recurring_jul->AdvancedSearch->SearchValue = @$filter["x_recurring_jul"];
        $this->recurring_jul->AdvancedSearch->SearchOperator = @$filter["z_recurring_jul"];
        $this->recurring_jul->AdvancedSearch->SearchCondition = @$filter["v_recurring_jul"];
        $this->recurring_jul->AdvancedSearch->SearchValue2 = @$filter["y_recurring_jul"];
        $this->recurring_jul->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_jul"];
        $this->recurring_jul->AdvancedSearch->save();

        // Field recurring_aug
        $this->recurring_aug->AdvancedSearch->SearchValue = @$filter["x_recurring_aug"];
        $this->recurring_aug->AdvancedSearch->SearchOperator = @$filter["z_recurring_aug"];
        $this->recurring_aug->AdvancedSearch->SearchCondition = @$filter["v_recurring_aug"];
        $this->recurring_aug->AdvancedSearch->SearchValue2 = @$filter["y_recurring_aug"];
        $this->recurring_aug->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_aug"];
        $this->recurring_aug->AdvancedSearch->save();

        // Field recurring_sep
        $this->recurring_sep->AdvancedSearch->SearchValue = @$filter["x_recurring_sep"];
        $this->recurring_sep->AdvancedSearch->SearchOperator = @$filter["z_recurring_sep"];
        $this->recurring_sep->AdvancedSearch->SearchCondition = @$filter["v_recurring_sep"];
        $this->recurring_sep->AdvancedSearch->SearchValue2 = @$filter["y_recurring_sep"];
        $this->recurring_sep->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_sep"];
        $this->recurring_sep->AdvancedSearch->save();

        // Field recurring_oct
        $this->recurring_oct->AdvancedSearch->SearchValue = @$filter["x_recurring_oct"];
        $this->recurring_oct->AdvancedSearch->SearchOperator = @$filter["z_recurring_oct"];
        $this->recurring_oct->AdvancedSearch->SearchCondition = @$filter["v_recurring_oct"];
        $this->recurring_oct->AdvancedSearch->SearchValue2 = @$filter["y_recurring_oct"];
        $this->recurring_oct->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_oct"];
        $this->recurring_oct->AdvancedSearch->save();

        // Field recurring_nov
        $this->recurring_nov->AdvancedSearch->SearchValue = @$filter["x_recurring_nov"];
        $this->recurring_nov->AdvancedSearch->SearchOperator = @$filter["z_recurring_nov"];
        $this->recurring_nov->AdvancedSearch->SearchCondition = @$filter["v_recurring_nov"];
        $this->recurring_nov->AdvancedSearch->SearchValue2 = @$filter["y_recurring_nov"];
        $this->recurring_nov->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_nov"];
        $this->recurring_nov->AdvancedSearch->save();

        // Field recurring_dec
        $this->recurring_dec->AdvancedSearch->SearchValue = @$filter["x_recurring_dec"];
        $this->recurring_dec->AdvancedSearch->SearchOperator = @$filter["z_recurring_dec"];
        $this->recurring_dec->AdvancedSearch->SearchCondition = @$filter["v_recurring_dec"];
        $this->recurring_dec->AdvancedSearch->SearchValue2 = @$filter["y_recurring_dec"];
        $this->recurring_dec->AdvancedSearch->SearchOperator2 = @$filter["w_recurring_dec"];
        $this->recurring_dec->AdvancedSearch->save();

        // Field setup_shape
        $this->setup_shape->AdvancedSearch->SearchValue = @$filter["x_setup_shape"];
        $this->setup_shape->AdvancedSearch->SearchOperator = @$filter["z_setup_shape"];
        $this->setup_shape->AdvancedSearch->SearchCondition = @$filter["v_setup_shape"];
        $this->setup_shape->AdvancedSearch->SearchValue2 = @$filter["y_setup_shape"];
        $this->setup_shape->AdvancedSearch->SearchOperator2 = @$filter["w_setup_shape"];
        $this->setup_shape->AdvancedSearch->save();

        // Field certification_name
        $this->certification_name->AdvancedSearch->SearchValue = @$filter["x_certification_name"];
        $this->certification_name->AdvancedSearch->SearchOperator = @$filter["z_certification_name"];
        $this->certification_name->AdvancedSearch->SearchCondition = @$filter["v_certification_name"];
        $this->certification_name->AdvancedSearch->SearchValue2 = @$filter["y_certification_name"];
        $this->certification_name->AdvancedSearch->SearchOperator2 = @$filter["w_certification_name"];
        $this->certification_name->AdvancedSearch->save();

        // Field certification_date
        $this->certification_date->AdvancedSearch->SearchValue = @$filter["x_certification_date"];
        $this->certification_date->AdvancedSearch->SearchOperator = @$filter["z_certification_date"];
        $this->certification_date->AdvancedSearch->SearchCondition = @$filter["v_certification_date"];
        $this->certification_date->AdvancedSearch->SearchValue2 = @$filter["y_certification_date"];
        $this->certification_date->AdvancedSearch->SearchOperator2 = @$filter["w_certification_date"];
        $this->certification_date->AdvancedSearch->save();

        // Field timestamp
        $this->timestamp->AdvancedSearch->SearchValue = @$filter["x_timestamp"];
        $this->timestamp->AdvancedSearch->SearchOperator = @$filter["z_timestamp"];
        $this->timestamp->AdvancedSearch->SearchCondition = @$filter["v_timestamp"];
        $this->timestamp->AdvancedSearch->SearchValue2 = @$filter["y_timestamp"];
        $this->timestamp->AdvancedSearch->SearchOperator2 = @$filter["w_timestamp"];
        $this->timestamp->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->contact_org, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_name, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_email, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_phone, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_fax, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_address, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_city, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_state, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_zip, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_advisor, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_advisor_phone, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->contact_advisor_email, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_org, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_name, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_email, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_phone, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_fax, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_address, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_city, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_state, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_zip, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_method, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->billing_frs, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->event_title, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->event_type, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->event_time_start, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->event_time_end, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->event_room_preference, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_jan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_feb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_mar, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_apr, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_may, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_jun, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_jul, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_aug, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_sep, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_oct, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_nov, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->recurring_dec, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->setup_shape, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->certification_name, $arKeywords, $type);
        return $where;
    }

    // Build basic search SQL
    protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
    {
        $defCond = ($type == "OR") ? "OR" : "AND";
        $arSql = []; // Array for SQL parts
        $arCond = []; // Array for search conditions
        $cnt = count($arKeywords);
        $j = 0; // Number of SQL parts
        for ($i = 0; $i < $cnt; $i++) {
            $keyword = $arKeywords[$i];
            $keyword = trim($keyword);
            if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
                $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
                $ar = explode("\\", $keyword);
            } else {
                $ar = [$keyword];
            }
            foreach ($ar as $keyword) {
                if ($keyword != "") {
                    $wrk = "";
                    if ($keyword == "OR" && $type == "") {
                        if ($j > 0) {
                            $arCond[$j - 1] = "OR";
                        }
                    } elseif ($keyword == Config("NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NULL";
                    } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NOT NULL";
                    } elseif ($fld->IsVirtual && $fld->Visible) {
                        $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                        $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    }
                    if ($wrk != "") {
                        $arSql[$j] = $wrk;
                        $arCond[$j] = $defCond;
                        $j += 1;
                    }
                }
            }
        }
        $cnt = count($arSql);
        $quoted = false;
        $sql = "";
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt - 1; $i++) {
                if ($arCond[$i] == "OR") {
                    if (!$quoted) {
                        $sql .= "(";
                    }
                    $quoted = true;
                }
                $sql .= $arSql[$i];
                if ($quoted && $arCond[$i] != "OR") {
                    $sql .= ")";
                    $quoted = false;
                }
                $sql .= " " . $arCond[$i] . " ";
            }
            $sql .= $arSql[$cnt - 1];
            if ($quoted) {
                $sql .= ")";
            }
        }
        if ($sql != "") {
            if ($where != "") {
                $where .= " OR ";
            }
            $where .= "(" . $sql . ")";
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        $searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            // Search keyword in any fields
            if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
                foreach ($ar as $keyword) {
                    if ($keyword != "") {
                        if ($searchStr != "") {
                            $searchStr .= " " . $searchType . " ";
                        }
                        $searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
                    }
                }
            } else {
                $searchStr = $this->basicSearchSql($ar, $searchType);
            }
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
            $this->updateSort($this->id); // id
            $this->updateSort($this->contact_org); // contact_org
            $this->updateSort($this->contact_name); // contact_name
            $this->updateSort($this->contact_email); // contact_email
            $this->updateSort($this->contact_phone); // contact_phone
            $this->updateSort($this->contact_fax); // contact_fax
            $this->updateSort($this->contact_address); // contact_address
            $this->updateSort($this->contact_city); // contact_city
            $this->updateSort($this->contact_state); // contact_state
            $this->updateSort($this->contact_zip); // contact_zip
            $this->updateSort($this->contact_advisor); // contact_advisor
            $this->updateSort($this->contact_advisor_phone); // contact_advisor_phone
            $this->updateSort($this->contact_advisor_email); // contact_advisor_email
            $this->updateSort($this->billing_org); // billing_org
            $this->updateSort($this->billing_name); // billing_name
            $this->updateSort($this->billing_email); // billing_email
            $this->updateSort($this->billing_phone); // billing_phone
            $this->updateSort($this->billing_fax); // billing_fax
            $this->updateSort($this->billing_address); // billing_address
            $this->updateSort($this->billing_city); // billing_city
            $this->updateSort($this->billing_state); // billing_state
            $this->updateSort($this->billing_zip); // billing_zip
            $this->updateSort($this->billing_method); // billing_method
            $this->updateSort($this->billing_frs); // billing_frs
            $this->updateSort($this->event_title); // event_title
            $this->updateSort($this->event_type); // event_type
            $this->updateSort($this->event_date); // event_date
            $this->updateSort($this->event_time_start); // event_time_start
            $this->updateSort($this->event_time_end); // event_time_end
            $this->updateSort($this->event_num_people); // event_num_people
            $this->updateSort($this->event_room_preference); // event_room_preference
            $this->updateSort($this->recurring_jan); // recurring_jan
            $this->updateSort($this->recurring_feb); // recurring_feb
            $this->updateSort($this->recurring_mar); // recurring_mar
            $this->updateSort($this->recurring_apr); // recurring_apr
            $this->updateSort($this->recurring_may); // recurring_may
            $this->updateSort($this->recurring_jun); // recurring_jun
            $this->updateSort($this->recurring_jul); // recurring_jul
            $this->updateSort($this->recurring_aug); // recurring_aug
            $this->updateSort($this->recurring_sep); // recurring_sep
            $this->updateSort($this->recurring_oct); // recurring_oct
            $this->updateSort($this->recurring_nov); // recurring_nov
            $this->updateSort($this->recurring_dec); // recurring_dec
            $this->updateSort($this->setup_shape); // setup_shape
            $this->updateSort($this->certification_name); // certification_name
            $this->updateSort($this->certification_date); // certification_date
            $this->updateSort($this->timestamp); // timestamp
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
                $this->id->setSort("");
                $this->contact_org->setSort("");
                $this->contact_name->setSort("");
                $this->contact_email->setSort("");
                $this->contact_phone->setSort("");
                $this->contact_fax->setSort("");
                $this->contact_address->setSort("");
                $this->contact_city->setSort("");
                $this->contact_state->setSort("");
                $this->contact_zip->setSort("");
                $this->contact_advisor->setSort("");
                $this->contact_advisor_phone->setSort("");
                $this->contact_advisor_email->setSort("");
                $this->billing_org->setSort("");
                $this->billing_name->setSort("");
                $this->billing_email->setSort("");
                $this->billing_phone->setSort("");
                $this->billing_fax->setSort("");
                $this->billing_address->setSort("");
                $this->billing_city->setSort("");
                $this->billing_state->setSort("");
                $this->billing_zip->setSort("");
                $this->billing_method->setSort("");
                $this->billing_frs->setSort("");
                $this->event_title->setSort("");
                $this->event_type->setSort("");
                $this->event_date->setSort("");
                $this->event_time_start->setSort("");
                $this->event_time_end->setSort("");
                $this->event_num_people->setSort("");
                $this->event_room_preference->setSort("");
                $this->recurring_jan->setSort("");
                $this->recurring_feb->setSort("");
                $this->recurring_mar->setSort("");
                $this->recurring_apr->setSort("");
                $this->recurring_may->setSort("");
                $this->recurring_jun->setSort("");
                $this->recurring_jul->setSort("");
                $this->recurring_aug->setSort("");
                $this->recurring_sep->setSort("");
                $this->recurring_oct->setSort("");
                $this->recurring_nov->setSort("");
                $this->recurring_dec->setSort("");
                $this->setup_shape->setSort("");
                $this->certification_name->setSort("");
                $this->certification_date->setSort("");
                $this->timestamp->setSort("");
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

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = false;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = false;

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = false;

        // "delete"
        $item = &$this->ListOptions->add("delete");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = false;

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
        $item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
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

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl();
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if (true) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if (true) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if (true) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "delete"
            $opt = $this->ListOptions["delete"];
            if (true) {
            $opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("DeleteLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
                    $action = $listaction->Action;
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a></li>";
                    if (count($links) == 1) { // Single button
                        $body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a>";
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
                $opt->Visible = true;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "";
        $option = $options["action"];

        // Set up options default
        foreach ($options as $option) {
            $option->UseDropDownButton = false;
            $option->UseButtonGroup = true;
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->add($option->GroupOptionName);
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"froom_reservationlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"froom_reservationlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.froom_reservationlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        global $Language, $Security;
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
            $rs = LoadRecordset($sql, $conn, \PDO::FETCH_ASSOC);
            $this->CurrentAction = $userAction;

            // Call row action event
            if ($rs) {
                $conn->beginTransaction();
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
                    $conn->commit(); // Commit the changes
                    if ($this->getSuccessMessage() == "" && !ob_get_length()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    $conn->rollback(); // Rollback changes

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
            $this->CurrentAction = ""; // Clear action
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

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
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
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
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
        $this->contact_org->setDbValue($row['contact_org']);
        $this->contact_name->setDbValue($row['contact_name']);
        $this->contact_email->setDbValue($row['contact_email']);
        $this->contact_phone->setDbValue($row['contact_phone']);
        $this->contact_fax->setDbValue($row['contact_fax']);
        $this->contact_address->setDbValue($row['contact_address']);
        $this->contact_city->setDbValue($row['contact_city']);
        $this->contact_state->setDbValue($row['contact_state']);
        $this->contact_zip->setDbValue($row['contact_zip']);
        $this->contact_advisor->setDbValue($row['contact_advisor']);
        $this->contact_advisor_phone->setDbValue($row['contact_advisor_phone']);
        $this->contact_advisor_email->setDbValue($row['contact_advisor_email']);
        $this->billing_org->setDbValue($row['billing_org']);
        $this->billing_name->setDbValue($row['billing_name']);
        $this->billing_email->setDbValue($row['billing_email']);
        $this->billing_phone->setDbValue($row['billing_phone']);
        $this->billing_fax->setDbValue($row['billing_fax']);
        $this->billing_address->setDbValue($row['billing_address']);
        $this->billing_city->setDbValue($row['billing_city']);
        $this->billing_state->setDbValue($row['billing_state']);
        $this->billing_zip->setDbValue($row['billing_zip']);
        $this->billing_method->setDbValue($row['billing_method']);
        $this->billing_frs->setDbValue($row['billing_frs']);
        $this->event_title->setDbValue($row['event_title']);
        $this->event_type->setDbValue($row['event_type']);
        $this->event_date->setDbValue($row['event_date']);
        $this->event_time_start->setDbValue($row['event_time_start']);
        $this->event_time_end->setDbValue($row['event_time_end']);
        $this->event_num_people->setDbValue($row['event_num_people']);
        $this->event_room_preference->setDbValue($row['event_room_preference']);
        $this->recurring_jan->setDbValue($row['recurring_jan']);
        $this->recurring_feb->setDbValue($row['recurring_feb']);
        $this->recurring_mar->setDbValue($row['recurring_mar']);
        $this->recurring_apr->setDbValue($row['recurring_apr']);
        $this->recurring_may->setDbValue($row['recurring_may']);
        $this->recurring_jun->setDbValue($row['recurring_jun']);
        $this->recurring_jul->setDbValue($row['recurring_jul']);
        $this->recurring_aug->setDbValue($row['recurring_aug']);
        $this->recurring_sep->setDbValue($row['recurring_sep']);
        $this->recurring_oct->setDbValue($row['recurring_oct']);
        $this->recurring_nov->setDbValue($row['recurring_nov']);
        $this->recurring_dec->setDbValue($row['recurring_dec']);
        $this->setup_shape->setDbValue($row['setup_shape']);
        $this->certification_name->setDbValue($row['certification_name']);
        $this->certification_date->setDbValue($row['certification_date']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['contact_org'] = null;
        $row['contact_name'] = null;
        $row['contact_email'] = null;
        $row['contact_phone'] = null;
        $row['contact_fax'] = null;
        $row['contact_address'] = null;
        $row['contact_city'] = null;
        $row['contact_state'] = null;
        $row['contact_zip'] = null;
        $row['contact_advisor'] = null;
        $row['contact_advisor_phone'] = null;
        $row['contact_advisor_email'] = null;
        $row['billing_org'] = null;
        $row['billing_name'] = null;
        $row['billing_email'] = null;
        $row['billing_phone'] = null;
        $row['billing_fax'] = null;
        $row['billing_address'] = null;
        $row['billing_city'] = null;
        $row['billing_state'] = null;
        $row['billing_zip'] = null;
        $row['billing_method'] = null;
        $row['billing_frs'] = null;
        $row['event_title'] = null;
        $row['event_type'] = null;
        $row['event_date'] = null;
        $row['event_time_start'] = null;
        $row['event_time_end'] = null;
        $row['event_num_people'] = null;
        $row['event_room_preference'] = null;
        $row['recurring_jan'] = null;
        $row['recurring_feb'] = null;
        $row['recurring_mar'] = null;
        $row['recurring_apr'] = null;
        $row['recurring_may'] = null;
        $row['recurring_jun'] = null;
        $row['recurring_jul'] = null;
        $row['recurring_aug'] = null;
        $row['recurring_sep'] = null;
        $row['recurring_oct'] = null;
        $row['recurring_nov'] = null;
        $row['recurring_dec'] = null;
        $row['setup_shape'] = null;
        $row['certification_name'] = null;
        $row['certification_date'] = null;
        $row['timestamp'] = null;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // contact_org

        // contact_name

        // contact_email

        // contact_phone

        // contact_fax

        // contact_address

        // contact_city

        // contact_state

        // contact_zip

        // contact_advisor

        // contact_advisor_phone

        // contact_advisor_email

        // billing_org

        // billing_name

        // billing_email

        // billing_phone

        // billing_fax

        // billing_address

        // billing_city

        // billing_state

        // billing_zip

        // billing_method

        // billing_frs

        // event_title

        // event_type

        // event_date

        // event_time_start

        // event_time_end

        // event_num_people

        // event_room_preference

        // recurring_jan

        // recurring_feb

        // recurring_mar

        // recurring_apr

        // recurring_may

        // recurring_jun

        // recurring_jul

        // recurring_aug

        // recurring_sep

        // recurring_oct

        // recurring_nov

        // recurring_dec

        // setup_shape

        // certification_name

        // certification_date

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // contact_org
            $this->contact_org->ViewValue = $this->contact_org->CurrentValue;
            $this->contact_org->ViewCustomAttributes = "";

            // contact_name
            $this->contact_name->ViewValue = $this->contact_name->CurrentValue;
            $this->contact_name->ViewCustomAttributes = "";

            // contact_email
            $this->contact_email->ViewValue = $this->contact_email->CurrentValue;
            $this->contact_email->ViewCustomAttributes = "";

            // contact_phone
            $this->contact_phone->ViewValue = $this->contact_phone->CurrentValue;
            $this->contact_phone->ViewCustomAttributes = "";

            // contact_fax
            $this->contact_fax->ViewValue = $this->contact_fax->CurrentValue;
            $this->contact_fax->ViewCustomAttributes = "";

            // contact_address
            $this->contact_address->ViewValue = $this->contact_address->CurrentValue;
            $this->contact_address->ViewCustomAttributes = "";

            // contact_city
            $this->contact_city->ViewValue = $this->contact_city->CurrentValue;
            $this->contact_city->ViewCustomAttributes = "";

            // contact_state
            $this->contact_state->ViewValue = $this->contact_state->CurrentValue;
            $this->contact_state->ViewCustomAttributes = "";

            // contact_zip
            $this->contact_zip->ViewValue = $this->contact_zip->CurrentValue;
            $this->contact_zip->ViewCustomAttributes = "";

            // contact_advisor
            $this->contact_advisor->ViewValue = $this->contact_advisor->CurrentValue;
            $this->contact_advisor->ViewCustomAttributes = "";

            // contact_advisor_phone
            $this->contact_advisor_phone->ViewValue = $this->contact_advisor_phone->CurrentValue;
            $this->contact_advisor_phone->ViewCustomAttributes = "";

            // contact_advisor_email
            $this->contact_advisor_email->ViewValue = $this->contact_advisor_email->CurrentValue;
            $this->contact_advisor_email->ViewCustomAttributes = "";

            // billing_org
            $this->billing_org->ViewValue = $this->billing_org->CurrentValue;
            $this->billing_org->ViewCustomAttributes = "";

            // billing_name
            $this->billing_name->ViewValue = $this->billing_name->CurrentValue;
            $this->billing_name->ViewCustomAttributes = "";

            // billing_email
            $this->billing_email->ViewValue = $this->billing_email->CurrentValue;
            $this->billing_email->ViewCustomAttributes = "";

            // billing_phone
            $this->billing_phone->ViewValue = $this->billing_phone->CurrentValue;
            $this->billing_phone->ViewCustomAttributes = "";

            // billing_fax
            $this->billing_fax->ViewValue = $this->billing_fax->CurrentValue;
            $this->billing_fax->ViewCustomAttributes = "";

            // billing_address
            $this->billing_address->ViewValue = $this->billing_address->CurrentValue;
            $this->billing_address->ViewCustomAttributes = "";

            // billing_city
            $this->billing_city->ViewValue = $this->billing_city->CurrentValue;
            $this->billing_city->ViewCustomAttributes = "";

            // billing_state
            $this->billing_state->ViewValue = $this->billing_state->CurrentValue;
            $this->billing_state->ViewCustomAttributes = "";

            // billing_zip
            $this->billing_zip->ViewValue = $this->billing_zip->CurrentValue;
            $this->billing_zip->ViewCustomAttributes = "";

            // billing_method
            $this->billing_method->ViewValue = $this->billing_method->CurrentValue;
            $this->billing_method->ViewCustomAttributes = "";

            // billing_frs
            $this->billing_frs->ViewValue = $this->billing_frs->CurrentValue;
            $this->billing_frs->ViewCustomAttributes = "";

            // event_title
            $this->event_title->ViewValue = $this->event_title->CurrentValue;
            $this->event_title->ViewCustomAttributes = "";

            // event_type
            $this->event_type->ViewValue = $this->event_type->CurrentValue;
            $this->event_type->ViewCustomAttributes = "";

            // event_date
            $this->event_date->ViewValue = $this->event_date->CurrentValue;
            $this->event_date->ViewValue = FormatDateTime($this->event_date->ViewValue, 0);
            $this->event_date->ViewCustomAttributes = "";

            // event_time_start
            $this->event_time_start->ViewValue = $this->event_time_start->CurrentValue;
            $this->event_time_start->ViewCustomAttributes = "";

            // event_time_end
            $this->event_time_end->ViewValue = $this->event_time_end->CurrentValue;
            $this->event_time_end->ViewCustomAttributes = "";

            // event_num_people
            $this->event_num_people->ViewValue = $this->event_num_people->CurrentValue;
            $this->event_num_people->ViewValue = FormatNumber($this->event_num_people->ViewValue, 0, -2, -2, -2);
            $this->event_num_people->ViewCustomAttributes = "";

            // event_room_preference
            $this->event_room_preference->ViewValue = $this->event_room_preference->CurrentValue;
            $this->event_room_preference->ViewCustomAttributes = "";

            // recurring_jan
            $this->recurring_jan->ViewValue = $this->recurring_jan->CurrentValue;
            $this->recurring_jan->ViewCustomAttributes = "";

            // recurring_feb
            $this->recurring_feb->ViewValue = $this->recurring_feb->CurrentValue;
            $this->recurring_feb->ViewCustomAttributes = "";

            // recurring_mar
            $this->recurring_mar->ViewValue = $this->recurring_mar->CurrentValue;
            $this->recurring_mar->ViewCustomAttributes = "";

            // recurring_apr
            $this->recurring_apr->ViewValue = $this->recurring_apr->CurrentValue;
            $this->recurring_apr->ViewCustomAttributes = "";

            // recurring_may
            $this->recurring_may->ViewValue = $this->recurring_may->CurrentValue;
            $this->recurring_may->ViewCustomAttributes = "";

            // recurring_jun
            $this->recurring_jun->ViewValue = $this->recurring_jun->CurrentValue;
            $this->recurring_jun->ViewCustomAttributes = "";

            // recurring_jul
            $this->recurring_jul->ViewValue = $this->recurring_jul->CurrentValue;
            $this->recurring_jul->ViewCustomAttributes = "";

            // recurring_aug
            $this->recurring_aug->ViewValue = $this->recurring_aug->CurrentValue;
            $this->recurring_aug->ViewCustomAttributes = "";

            // recurring_sep
            $this->recurring_sep->ViewValue = $this->recurring_sep->CurrentValue;
            $this->recurring_sep->ViewCustomAttributes = "";

            // recurring_oct
            $this->recurring_oct->ViewValue = $this->recurring_oct->CurrentValue;
            $this->recurring_oct->ViewCustomAttributes = "";

            // recurring_nov
            $this->recurring_nov->ViewValue = $this->recurring_nov->CurrentValue;
            $this->recurring_nov->ViewCustomAttributes = "";

            // recurring_dec
            $this->recurring_dec->ViewValue = $this->recurring_dec->CurrentValue;
            $this->recurring_dec->ViewCustomAttributes = "";

            // setup_shape
            $this->setup_shape->ViewValue = $this->setup_shape->CurrentValue;
            $this->setup_shape->ViewCustomAttributes = "";

            // certification_name
            $this->certification_name->ViewValue = $this->certification_name->CurrentValue;
            $this->certification_name->ViewCustomAttributes = "";

            // certification_date
            $this->certification_date->ViewValue = $this->certification_date->CurrentValue;
            $this->certification_date->ViewValue = FormatDateTime($this->certification_date->ViewValue, 0);
            $this->certification_date->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // contact_org
            $this->contact_org->LinkCustomAttributes = "";
            $this->contact_org->HrefValue = "";
            $this->contact_org->TooltipValue = "";

            // contact_name
            $this->contact_name->LinkCustomAttributes = "";
            $this->contact_name->HrefValue = "";
            $this->contact_name->TooltipValue = "";

            // contact_email
            $this->contact_email->LinkCustomAttributes = "";
            $this->contact_email->HrefValue = "";
            $this->contact_email->TooltipValue = "";

            // contact_phone
            $this->contact_phone->LinkCustomAttributes = "";
            $this->contact_phone->HrefValue = "";
            $this->contact_phone->TooltipValue = "";

            // contact_fax
            $this->contact_fax->LinkCustomAttributes = "";
            $this->contact_fax->HrefValue = "";
            $this->contact_fax->TooltipValue = "";

            // contact_address
            $this->contact_address->LinkCustomAttributes = "";
            $this->contact_address->HrefValue = "";
            $this->contact_address->TooltipValue = "";

            // contact_city
            $this->contact_city->LinkCustomAttributes = "";
            $this->contact_city->HrefValue = "";
            $this->contact_city->TooltipValue = "";

            // contact_state
            $this->contact_state->LinkCustomAttributes = "";
            $this->contact_state->HrefValue = "";
            $this->contact_state->TooltipValue = "";

            // contact_zip
            $this->contact_zip->LinkCustomAttributes = "";
            $this->contact_zip->HrefValue = "";
            $this->contact_zip->TooltipValue = "";

            // contact_advisor
            $this->contact_advisor->LinkCustomAttributes = "";
            $this->contact_advisor->HrefValue = "";
            $this->contact_advisor->TooltipValue = "";

            // contact_advisor_phone
            $this->contact_advisor_phone->LinkCustomAttributes = "";
            $this->contact_advisor_phone->HrefValue = "";
            $this->contact_advisor_phone->TooltipValue = "";

            // contact_advisor_email
            $this->contact_advisor_email->LinkCustomAttributes = "";
            $this->contact_advisor_email->HrefValue = "";
            $this->contact_advisor_email->TooltipValue = "";

            // billing_org
            $this->billing_org->LinkCustomAttributes = "";
            $this->billing_org->HrefValue = "";
            $this->billing_org->TooltipValue = "";

            // billing_name
            $this->billing_name->LinkCustomAttributes = "";
            $this->billing_name->HrefValue = "";
            $this->billing_name->TooltipValue = "";

            // billing_email
            $this->billing_email->LinkCustomAttributes = "";
            $this->billing_email->HrefValue = "";
            $this->billing_email->TooltipValue = "";

            // billing_phone
            $this->billing_phone->LinkCustomAttributes = "";
            $this->billing_phone->HrefValue = "";
            $this->billing_phone->TooltipValue = "";

            // billing_fax
            $this->billing_fax->LinkCustomAttributes = "";
            $this->billing_fax->HrefValue = "";
            $this->billing_fax->TooltipValue = "";

            // billing_address
            $this->billing_address->LinkCustomAttributes = "";
            $this->billing_address->HrefValue = "";
            $this->billing_address->TooltipValue = "";

            // billing_city
            $this->billing_city->LinkCustomAttributes = "";
            $this->billing_city->HrefValue = "";
            $this->billing_city->TooltipValue = "";

            // billing_state
            $this->billing_state->LinkCustomAttributes = "";
            $this->billing_state->HrefValue = "";
            $this->billing_state->TooltipValue = "";

            // billing_zip
            $this->billing_zip->LinkCustomAttributes = "";
            $this->billing_zip->HrefValue = "";
            $this->billing_zip->TooltipValue = "";

            // billing_method
            $this->billing_method->LinkCustomAttributes = "";
            $this->billing_method->HrefValue = "";
            $this->billing_method->TooltipValue = "";

            // billing_frs
            $this->billing_frs->LinkCustomAttributes = "";
            $this->billing_frs->HrefValue = "";
            $this->billing_frs->TooltipValue = "";

            // event_title
            $this->event_title->LinkCustomAttributes = "";
            $this->event_title->HrefValue = "";
            $this->event_title->TooltipValue = "";

            // event_type
            $this->event_type->LinkCustomAttributes = "";
            $this->event_type->HrefValue = "";
            $this->event_type->TooltipValue = "";

            // event_date
            $this->event_date->LinkCustomAttributes = "";
            $this->event_date->HrefValue = "";
            $this->event_date->TooltipValue = "";

            // event_time_start
            $this->event_time_start->LinkCustomAttributes = "";
            $this->event_time_start->HrefValue = "";
            $this->event_time_start->TooltipValue = "";

            // event_time_end
            $this->event_time_end->LinkCustomAttributes = "";
            $this->event_time_end->HrefValue = "";
            $this->event_time_end->TooltipValue = "";

            // event_num_people
            $this->event_num_people->LinkCustomAttributes = "";
            $this->event_num_people->HrefValue = "";
            $this->event_num_people->TooltipValue = "";

            // event_room_preference
            $this->event_room_preference->LinkCustomAttributes = "";
            $this->event_room_preference->HrefValue = "";
            $this->event_room_preference->TooltipValue = "";

            // recurring_jan
            $this->recurring_jan->LinkCustomAttributes = "";
            $this->recurring_jan->HrefValue = "";
            $this->recurring_jan->TooltipValue = "";

            // recurring_feb
            $this->recurring_feb->LinkCustomAttributes = "";
            $this->recurring_feb->HrefValue = "";
            $this->recurring_feb->TooltipValue = "";

            // recurring_mar
            $this->recurring_mar->LinkCustomAttributes = "";
            $this->recurring_mar->HrefValue = "";
            $this->recurring_mar->TooltipValue = "";

            // recurring_apr
            $this->recurring_apr->LinkCustomAttributes = "";
            $this->recurring_apr->HrefValue = "";
            $this->recurring_apr->TooltipValue = "";

            // recurring_may
            $this->recurring_may->LinkCustomAttributes = "";
            $this->recurring_may->HrefValue = "";
            $this->recurring_may->TooltipValue = "";

            // recurring_jun
            $this->recurring_jun->LinkCustomAttributes = "";
            $this->recurring_jun->HrefValue = "";
            $this->recurring_jun->TooltipValue = "";

            // recurring_jul
            $this->recurring_jul->LinkCustomAttributes = "";
            $this->recurring_jul->HrefValue = "";
            $this->recurring_jul->TooltipValue = "";

            // recurring_aug
            $this->recurring_aug->LinkCustomAttributes = "";
            $this->recurring_aug->HrefValue = "";
            $this->recurring_aug->TooltipValue = "";

            // recurring_sep
            $this->recurring_sep->LinkCustomAttributes = "";
            $this->recurring_sep->HrefValue = "";
            $this->recurring_sep->TooltipValue = "";

            // recurring_oct
            $this->recurring_oct->LinkCustomAttributes = "";
            $this->recurring_oct->HrefValue = "";
            $this->recurring_oct->TooltipValue = "";

            // recurring_nov
            $this->recurring_nov->LinkCustomAttributes = "";
            $this->recurring_nov->HrefValue = "";
            $this->recurring_nov->TooltipValue = "";

            // recurring_dec
            $this->recurring_dec->LinkCustomAttributes = "";
            $this->recurring_dec->HrefValue = "";
            $this->recurring_dec->TooltipValue = "";

            // setup_shape
            $this->setup_shape->LinkCustomAttributes = "";
            $this->setup_shape->HrefValue = "";
            $this->setup_shape->TooltipValue = "";

            // certification_name
            $this->certification_name->LinkCustomAttributes = "";
            $this->certification_name->HrefValue = "";
            $this->certification_name->TooltipValue = "";

            // certification_date
            $this->certification_date->LinkCustomAttributes = "";
            $this->certification_date->HrefValue = "";
            $this->certification_date->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up search/sort options
    protected function setupSearchSortOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions("div");
        $this->SearchOptions->TagClassName = "ew-search-option";

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"froom_reservationlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
        $item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
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
