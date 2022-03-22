<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class BursarPaymentEdit extends BursarPayment
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'bursar_payment';

    // Page object name
    public $PageObjName = "BursarPaymentEdit";

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

        // Table object (bursar_payment)
        if (!isset($GLOBALS["bursar_payment"]) || get_class($GLOBALS["bursar_payment"]) == PROJECT_NAMESPACE . "bursar_payment") {
            $GLOBALS["bursar_payment"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'bursar_payment');
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
                $tbl = Container("bursar_payment");
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
                    if ($pageName == "BursarPaymentView") {
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
            $key .= @$ar['bursar_id'];
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
            $this->bursar_id->Visible = false;
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
        $this->bursar_id->setVisibility();
        $this->emplid->setVisibility();
        $this->subcode->setVisibility();
        $this->term->setVisibility();
        $this->bursars_amount->setVisibility();
        $this->_response->setVisibility();
        $this->item_nbr->setVisibility();
        $this->line_seq_no->setVisibility();
        $this->transaction_time->setVisibility();
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
            if (($keyValue = Get("bursar_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->bursar_id->setQueryStringValue($keyValue);
                $this->bursar_id->setOldValue($this->bursar_id->QueryStringValue);
            } elseif (Post("bursar_id") !== null) {
                $this->bursar_id->setFormValue(Post("bursar_id"));
                $this->bursar_id->setOldValue($this->bursar_id->FormValue);
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
                if (($keyValue = Get("bursar_id") ?? Route("bursar_id")) !== null) {
                    $this->bursar_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->bursar_id->CurrentValue = null;
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
                    $this->terminate("BursarPaymentList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "BursarPaymentList") {
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

        // Check field name 'bursar_id' first before field var 'x_bursar_id'
        $val = $CurrentForm->hasValue("bursar_id") ? $CurrentForm->getValue("bursar_id") : $CurrentForm->getValue("x_bursar_id");
        if (!$this->bursar_id->IsDetailKey) {
            $this->bursar_id->setFormValue($val);
        }

        // Check field name 'emplid' first before field var 'x_emplid'
        $val = $CurrentForm->hasValue("emplid") ? $CurrentForm->getValue("emplid") : $CurrentForm->getValue("x_emplid");
        if (!$this->emplid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->emplid->Visible = false; // Disable update for API request
            } else {
                $this->emplid->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'subcode' first before field var 'x_subcode'
        $val = $CurrentForm->hasValue("subcode") ? $CurrentForm->getValue("subcode") : $CurrentForm->getValue("x_subcode");
        if (!$this->subcode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subcode->Visible = false; // Disable update for API request
            } else {
                $this->subcode->setFormValue($val);
            }
        }

        // Check field name 'term' first before field var 'x_term'
        $val = $CurrentForm->hasValue("term") ? $CurrentForm->getValue("term") : $CurrentForm->getValue("x_term");
        if (!$this->term->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->term->Visible = false; // Disable update for API request
            } else {
                $this->term->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'bursars_amount' first before field var 'x_bursars_amount'
        $val = $CurrentForm->hasValue("bursars_amount") ? $CurrentForm->getValue("bursars_amount") : $CurrentForm->getValue("x_bursars_amount");
        if (!$this->bursars_amount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bursars_amount->Visible = false; // Disable update for API request
            } else {
                $this->bursars_amount->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'response' first before field var 'x__response'
        $val = $CurrentForm->hasValue("response") ? $CurrentForm->getValue("response") : $CurrentForm->getValue("x__response");
        if (!$this->_response->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_response->Visible = false; // Disable update for API request
            } else {
                $this->_response->setFormValue($val);
            }
        }

        // Check field name 'item_nbr' first before field var 'x_item_nbr'
        $val = $CurrentForm->hasValue("item_nbr") ? $CurrentForm->getValue("item_nbr") : $CurrentForm->getValue("x_item_nbr");
        if (!$this->item_nbr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->item_nbr->Visible = false; // Disable update for API request
            } else {
                $this->item_nbr->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'line_seq_no' first before field var 'x_line_seq_no'
        $val = $CurrentForm->hasValue("line_seq_no") ? $CurrentForm->getValue("line_seq_no") : $CurrentForm->getValue("x_line_seq_no");
        if (!$this->line_seq_no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->line_seq_no->Visible = false; // Disable update for API request
            } else {
                $this->line_seq_no->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'transaction_time' first before field var 'x_transaction_time'
        $val = $CurrentForm->hasValue("transaction_time") ? $CurrentForm->getValue("transaction_time") : $CurrentForm->getValue("x_transaction_time");
        if (!$this->transaction_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->transaction_time->Visible = false; // Disable update for API request
            } else {
                $this->transaction_time->setFormValue($val, true, $validate);
            }
            $this->transaction_time->CurrentValue = UnFormatDateTime($this->transaction_time->CurrentValue, $this->transaction_time->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->bursar_id->CurrentValue = $this->bursar_id->FormValue;
        $this->emplid->CurrentValue = $this->emplid->FormValue;
        $this->subcode->CurrentValue = $this->subcode->FormValue;
        $this->term->CurrentValue = $this->term->FormValue;
        $this->bursars_amount->CurrentValue = $this->bursars_amount->FormValue;
        $this->_response->CurrentValue = $this->_response->FormValue;
        $this->item_nbr->CurrentValue = $this->item_nbr->FormValue;
        $this->line_seq_no->CurrentValue = $this->line_seq_no->FormValue;
        $this->transaction_time->CurrentValue = $this->transaction_time->FormValue;
        $this->transaction_time->CurrentValue = UnFormatDateTime($this->transaction_time->CurrentValue, $this->transaction_time->formatPattern());
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
        $this->bursar_id->setDbValue($row['bursar_id']);
        $this->emplid->setDbValue($row['emplid']);
        $this->subcode->setDbValue($row['subcode']);
        $this->term->setDbValue($row['term']);
        $this->bursars_amount->setDbValue($row['bursars_amount']);
        $this->_response->setDbValue($row['response']);
        $this->item_nbr->setDbValue($row['item_nbr']);
        $this->line_seq_no->setDbValue($row['line_seq_no']);
        $this->transaction_time->setDbValue($row['transaction_time']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['bursar_id'] = null;
        $row['emplid'] = null;
        $row['subcode'] = null;
        $row['term'] = null;
        $row['bursars_amount'] = null;
        $row['response'] = null;
        $row['item_nbr'] = null;
        $row['line_seq_no'] = null;
        $row['transaction_time'] = null;
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

        // bursar_id
        $this->bursar_id->RowCssClass = "row";

        // emplid
        $this->emplid->RowCssClass = "row";

        // subcode
        $this->subcode->RowCssClass = "row";

        // term
        $this->term->RowCssClass = "row";

        // bursars_amount
        $this->bursars_amount->RowCssClass = "row";

        // response
        $this->_response->RowCssClass = "row";

        // item_nbr
        $this->item_nbr->RowCssClass = "row";

        // line_seq_no
        $this->line_seq_no->RowCssClass = "row";

        // transaction_time
        $this->transaction_time->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // bursar_id
            $this->bursar_id->ViewValue = $this->bursar_id->CurrentValue;
            $this->bursar_id->ViewCustomAttributes = "";

            // emplid
            $this->emplid->ViewValue = $this->emplid->CurrentValue;
            $this->emplid->ViewValue = FormatNumber($this->emplid->ViewValue, "");
            $this->emplid->ViewCustomAttributes = "";

            // subcode
            $this->subcode->ViewValue = $this->subcode->CurrentValue;
            $this->subcode->ViewCustomAttributes = "";

            // term
            $this->term->ViewValue = $this->term->CurrentValue;
            $this->term->ViewValue = FormatNumber($this->term->ViewValue, "");
            $this->term->ViewCustomAttributes = "";

            // bursars_amount
            $this->bursars_amount->ViewValue = $this->bursars_amount->CurrentValue;
            $this->bursars_amount->ViewValue = FormatNumber($this->bursars_amount->ViewValue, "");
            $this->bursars_amount->ViewCustomAttributes = "";

            // response
            $this->_response->ViewValue = $this->_response->CurrentValue;
            $this->_response->ViewCustomAttributes = "";

            // item_nbr
            $this->item_nbr->ViewValue = $this->item_nbr->CurrentValue;
            $this->item_nbr->ViewValue = FormatNumber($this->item_nbr->ViewValue, "");
            $this->item_nbr->ViewCustomAttributes = "";

            // line_seq_no
            $this->line_seq_no->ViewValue = $this->line_seq_no->CurrentValue;
            $this->line_seq_no->ViewValue = FormatNumber($this->line_seq_no->ViewValue, "");
            $this->line_seq_no->ViewCustomAttributes = "";

            // transaction_time
            $this->transaction_time->ViewValue = $this->transaction_time->CurrentValue;
            $this->transaction_time->ViewValue = FormatDateTime($this->transaction_time->ViewValue, 0);
            $this->transaction_time->ViewCustomAttributes = "";

            // bursar_id
            $this->bursar_id->LinkCustomAttributes = "";
            $this->bursar_id->HrefValue = "";

            // emplid
            $this->emplid->LinkCustomAttributes = "";
            $this->emplid->HrefValue = "";

            // subcode
            $this->subcode->LinkCustomAttributes = "";
            $this->subcode->HrefValue = "";

            // term
            $this->term->LinkCustomAttributes = "";
            $this->term->HrefValue = "";

            // bursars_amount
            $this->bursars_amount->LinkCustomAttributes = "";
            $this->bursars_amount->HrefValue = "";

            // response
            $this->_response->LinkCustomAttributes = "";
            $this->_response->HrefValue = "";

            // item_nbr
            $this->item_nbr->LinkCustomAttributes = "";
            $this->item_nbr->HrefValue = "";

            // line_seq_no
            $this->line_seq_no->LinkCustomAttributes = "";
            $this->line_seq_no->HrefValue = "";

            // transaction_time
            $this->transaction_time->LinkCustomAttributes = "";
            $this->transaction_time->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // bursar_id
            $this->bursar_id->setupEditAttributes();
            $this->bursar_id->EditCustomAttributes = "";
            $this->bursar_id->EditValue = $this->bursar_id->CurrentValue;
            $this->bursar_id->ViewCustomAttributes = "";

            // emplid
            $this->emplid->setupEditAttributes();
            $this->emplid->EditCustomAttributes = "";
            $this->emplid->EditValue = HtmlEncode($this->emplid->CurrentValue);
            $this->emplid->PlaceHolder = RemoveHtml($this->emplid->caption());
            if (strval($this->emplid->EditValue) != "" && is_numeric($this->emplid->EditValue)) {
                $this->emplid->EditValue = FormatNumber($this->emplid->EditValue, null);
            }

            // subcode
            $this->subcode->setupEditAttributes();
            $this->subcode->EditCustomAttributes = "";
            if (!$this->subcode->Raw) {
                $this->subcode->CurrentValue = HtmlDecode($this->subcode->CurrentValue);
            }
            $this->subcode->EditValue = HtmlEncode($this->subcode->CurrentValue);
            $this->subcode->PlaceHolder = RemoveHtml($this->subcode->caption());

            // term
            $this->term->setupEditAttributes();
            $this->term->EditCustomAttributes = "";
            $this->term->EditValue = HtmlEncode($this->term->CurrentValue);
            $this->term->PlaceHolder = RemoveHtml($this->term->caption());
            if (strval($this->term->EditValue) != "" && is_numeric($this->term->EditValue)) {
                $this->term->EditValue = FormatNumber($this->term->EditValue, null);
            }

            // bursars_amount
            $this->bursars_amount->setupEditAttributes();
            $this->bursars_amount->EditCustomAttributes = "";
            $this->bursars_amount->EditValue = HtmlEncode($this->bursars_amount->CurrentValue);
            $this->bursars_amount->PlaceHolder = RemoveHtml($this->bursars_amount->caption());
            if (strval($this->bursars_amount->EditValue) != "" && is_numeric($this->bursars_amount->EditValue)) {
                $this->bursars_amount->EditValue = FormatNumber($this->bursars_amount->EditValue, null);
            }

            // response
            $this->_response->setupEditAttributes();
            $this->_response->EditCustomAttributes = "";
            $this->_response->EditValue = HtmlEncode($this->_response->CurrentValue);
            $this->_response->PlaceHolder = RemoveHtml($this->_response->caption());

            // item_nbr
            $this->item_nbr->setupEditAttributes();
            $this->item_nbr->EditCustomAttributes = "";
            $this->item_nbr->EditValue = HtmlEncode($this->item_nbr->CurrentValue);
            $this->item_nbr->PlaceHolder = RemoveHtml($this->item_nbr->caption());
            if (strval($this->item_nbr->EditValue) != "" && is_numeric($this->item_nbr->EditValue)) {
                $this->item_nbr->EditValue = FormatNumber($this->item_nbr->EditValue, null);
            }

            // line_seq_no
            $this->line_seq_no->setupEditAttributes();
            $this->line_seq_no->EditCustomAttributes = "";
            $this->line_seq_no->EditValue = HtmlEncode($this->line_seq_no->CurrentValue);
            $this->line_seq_no->PlaceHolder = RemoveHtml($this->line_seq_no->caption());
            if (strval($this->line_seq_no->EditValue) != "" && is_numeric($this->line_seq_no->EditValue)) {
                $this->line_seq_no->EditValue = FormatNumber($this->line_seq_no->EditValue, null);
            }

            // transaction_time
            $this->transaction_time->setupEditAttributes();
            $this->transaction_time->EditCustomAttributes = "";
            $this->transaction_time->EditValue = HtmlEncode(FormatDateTime($this->transaction_time->CurrentValue, 8));
            $this->transaction_time->PlaceHolder = RemoveHtml($this->transaction_time->caption());

            // Edit refer script

            // bursar_id
            $this->bursar_id->LinkCustomAttributes = "";
            $this->bursar_id->HrefValue = "";

            // emplid
            $this->emplid->LinkCustomAttributes = "";
            $this->emplid->HrefValue = "";

            // subcode
            $this->subcode->LinkCustomAttributes = "";
            $this->subcode->HrefValue = "";

            // term
            $this->term->LinkCustomAttributes = "";
            $this->term->HrefValue = "";

            // bursars_amount
            $this->bursars_amount->LinkCustomAttributes = "";
            $this->bursars_amount->HrefValue = "";

            // response
            $this->_response->LinkCustomAttributes = "";
            $this->_response->HrefValue = "";

            // item_nbr
            $this->item_nbr->LinkCustomAttributes = "";
            $this->item_nbr->HrefValue = "";

            // line_seq_no
            $this->line_seq_no->LinkCustomAttributes = "";
            $this->line_seq_no->HrefValue = "";

            // transaction_time
            $this->transaction_time->LinkCustomAttributes = "";
            $this->transaction_time->HrefValue = "";
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
        if ($this->bursar_id->Required) {
            if (!$this->bursar_id->IsDetailKey && EmptyValue($this->bursar_id->FormValue)) {
                $this->bursar_id->addErrorMessage(str_replace("%s", $this->bursar_id->caption(), $this->bursar_id->RequiredErrorMessage));
            }
        }
        if ($this->emplid->Required) {
            if (!$this->emplid->IsDetailKey && EmptyValue($this->emplid->FormValue)) {
                $this->emplid->addErrorMessage(str_replace("%s", $this->emplid->caption(), $this->emplid->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->emplid->FormValue)) {
            $this->emplid->addErrorMessage($this->emplid->getErrorMessage(false));
        }
        if ($this->subcode->Required) {
            if (!$this->subcode->IsDetailKey && EmptyValue($this->subcode->FormValue)) {
                $this->subcode->addErrorMessage(str_replace("%s", $this->subcode->caption(), $this->subcode->RequiredErrorMessage));
            }
        }
        if ($this->term->Required) {
            if (!$this->term->IsDetailKey && EmptyValue($this->term->FormValue)) {
                $this->term->addErrorMessage(str_replace("%s", $this->term->caption(), $this->term->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->term->FormValue)) {
            $this->term->addErrorMessage($this->term->getErrorMessage(false));
        }
        if ($this->bursars_amount->Required) {
            if (!$this->bursars_amount->IsDetailKey && EmptyValue($this->bursars_amount->FormValue)) {
                $this->bursars_amount->addErrorMessage(str_replace("%s", $this->bursars_amount->caption(), $this->bursars_amount->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->bursars_amount->FormValue)) {
            $this->bursars_amount->addErrorMessage($this->bursars_amount->getErrorMessage(false));
        }
        if ($this->_response->Required) {
            if (!$this->_response->IsDetailKey && EmptyValue($this->_response->FormValue)) {
                $this->_response->addErrorMessage(str_replace("%s", $this->_response->caption(), $this->_response->RequiredErrorMessage));
            }
        }
        if ($this->item_nbr->Required) {
            if (!$this->item_nbr->IsDetailKey && EmptyValue($this->item_nbr->FormValue)) {
                $this->item_nbr->addErrorMessage(str_replace("%s", $this->item_nbr->caption(), $this->item_nbr->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->item_nbr->FormValue)) {
            $this->item_nbr->addErrorMessage($this->item_nbr->getErrorMessage(false));
        }
        if ($this->line_seq_no->Required) {
            if (!$this->line_seq_no->IsDetailKey && EmptyValue($this->line_seq_no->FormValue)) {
                $this->line_seq_no->addErrorMessage(str_replace("%s", $this->line_seq_no->caption(), $this->line_seq_no->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->line_seq_no->FormValue)) {
            $this->line_seq_no->addErrorMessage($this->line_seq_no->getErrorMessage(false));
        }
        if ($this->transaction_time->Required) {
            if (!$this->transaction_time->IsDetailKey && EmptyValue($this->transaction_time->FormValue)) {
                $this->transaction_time->addErrorMessage(str_replace("%s", $this->transaction_time->caption(), $this->transaction_time->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->transaction_time->FormValue, $this->transaction_time->formatPattern())) {
            $this->transaction_time->addErrorMessage($this->transaction_time->getErrorMessage(false));
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

            // emplid
            $this->emplid->setDbValueDef($rsnew, $this->emplid->CurrentValue, null, $this->emplid->ReadOnly);

            // subcode
            $this->subcode->setDbValueDef($rsnew, $this->subcode->CurrentValue, null, $this->subcode->ReadOnly);

            // term
            $this->term->setDbValueDef($rsnew, $this->term->CurrentValue, 0, $this->term->ReadOnly);

            // bursars_amount
            $this->bursars_amount->setDbValueDef($rsnew, $this->bursars_amount->CurrentValue, 0, $this->bursars_amount->ReadOnly);

            // response
            $this->_response->setDbValueDef($rsnew, $this->_response->CurrentValue, null, $this->_response->ReadOnly);

            // item_nbr
            $this->item_nbr->setDbValueDef($rsnew, $this->item_nbr->CurrentValue, null, $this->item_nbr->ReadOnly);

            // line_seq_no
            $this->line_seq_no->setDbValueDef($rsnew, $this->line_seq_no->CurrentValue, null, $this->line_seq_no->ReadOnly);

            // transaction_time
            $this->transaction_time->setDbValueDef($rsnew, UnFormatDateTime($this->transaction_time->CurrentValue, $this->transaction_time->formatPattern()), null, $this->transaction_time->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("BursarPaymentList"), "", $this->TableVar, true);
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
