<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ChargePaymentEdit extends ChargePayment
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'charge_payment';

    // Page object name
    public $PageObjName = "ChargePaymentEdit";

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

        // Table object (charge_payment)
        if (!isset($GLOBALS["charge_payment"]) || get_class($GLOBALS["charge_payment"]) == PROJECT_NAMESPACE . "charge_payment") {
            $GLOBALS["charge_payment"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'charge_payment');
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
                $tbl = Container("charge_payment");
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
                    if ($pageName == "ChargePaymentView") {
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
            $key .= @$ar['charge_id'];
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
            $this->charge_id->Visible = false;
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
        $this->charge_id->setVisibility();
        $this->ch_first_name->setVisibility();
        $this->ch_last_name->setVisibility();
        $this->address->setVisibility();
        $this->city->setVisibility();
        $this->state->setVisibility();
        $this->zipcode->setVisibility();
        $this->card_type->setVisibility();
        $this->expiration_month->setVisibility();
        $this->expiration_year->setVisibility();
        $this->cv_reply->setVisibility();
        $this->charge_amount->setVisibility();
        $this->order_number->setVisibility();
        $this->account_number->setVisibility();
        $this->decision->setVisibility();
        $this->reason_code->setVisibility();
        $this->transaction_time->setVisibility();
        $this->ch_email->setVisibility();
        $this->ch_phone->setVisibility();
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
            if (($keyValue = Get("charge_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->charge_id->setQueryStringValue($keyValue);
                $this->charge_id->setOldValue($this->charge_id->QueryStringValue);
            } elseif (Post("charge_id") !== null) {
                $this->charge_id->setFormValue(Post("charge_id"));
                $this->charge_id->setOldValue($this->charge_id->FormValue);
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
                if (($keyValue = Get("charge_id") ?? Route("charge_id")) !== null) {
                    $this->charge_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->charge_id->CurrentValue = null;
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
                    $this->terminate("ChargePaymentList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ChargePaymentList") {
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

        // Check field name 'charge_id' first before field var 'x_charge_id'
        $val = $CurrentForm->hasValue("charge_id") ? $CurrentForm->getValue("charge_id") : $CurrentForm->getValue("x_charge_id");
        if (!$this->charge_id->IsDetailKey) {
            $this->charge_id->setFormValue($val);
        }

        // Check field name 'ch_first_name' first before field var 'x_ch_first_name'
        $val = $CurrentForm->hasValue("ch_first_name") ? $CurrentForm->getValue("ch_first_name") : $CurrentForm->getValue("x_ch_first_name");
        if (!$this->ch_first_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ch_first_name->Visible = false; // Disable update for API request
            } else {
                $this->ch_first_name->setFormValue($val);
            }
        }

        // Check field name 'ch_last_name' first before field var 'x_ch_last_name'
        $val = $CurrentForm->hasValue("ch_last_name") ? $CurrentForm->getValue("ch_last_name") : $CurrentForm->getValue("x_ch_last_name");
        if (!$this->ch_last_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ch_last_name->Visible = false; // Disable update for API request
            } else {
                $this->ch_last_name->setFormValue($val);
            }
        }

        // Check field name 'address' first before field var 'x_address'
        $val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
        if (!$this->address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address->Visible = false; // Disable update for API request
            } else {
                $this->address->setFormValue($val);
            }
        }

        // Check field name 'city' first before field var 'x_city'
        $val = $CurrentForm->hasValue("city") ? $CurrentForm->getValue("city") : $CurrentForm->getValue("x_city");
        if (!$this->city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->city->Visible = false; // Disable update for API request
            } else {
                $this->city->setFormValue($val);
            }
        }

        // Check field name 'state' first before field var 'x_state'
        $val = $CurrentForm->hasValue("state") ? $CurrentForm->getValue("state") : $CurrentForm->getValue("x_state");
        if (!$this->state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->state->Visible = false; // Disable update for API request
            } else {
                $this->state->setFormValue($val);
            }
        }

        // Check field name 'zipcode' first before field var 'x_zipcode'
        $val = $CurrentForm->hasValue("zipcode") ? $CurrentForm->getValue("zipcode") : $CurrentForm->getValue("x_zipcode");
        if (!$this->zipcode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->zipcode->Visible = false; // Disable update for API request
            } else {
                $this->zipcode->setFormValue($val);
            }
        }

        // Check field name 'card_type' first before field var 'x_card_type'
        $val = $CurrentForm->hasValue("card_type") ? $CurrentForm->getValue("card_type") : $CurrentForm->getValue("x_card_type");
        if (!$this->card_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->card_type->Visible = false; // Disable update for API request
            } else {
                $this->card_type->setFormValue($val);
            }
        }

        // Check field name 'expiration_month' first before field var 'x_expiration_month'
        $val = $CurrentForm->hasValue("expiration_month") ? $CurrentForm->getValue("expiration_month") : $CurrentForm->getValue("x_expiration_month");
        if (!$this->expiration_month->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->expiration_month->Visible = false; // Disable update for API request
            } else {
                $this->expiration_month->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'expiration_year' first before field var 'x_expiration_year'
        $val = $CurrentForm->hasValue("expiration_year") ? $CurrentForm->getValue("expiration_year") : $CurrentForm->getValue("x_expiration_year");
        if (!$this->expiration_year->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->expiration_year->Visible = false; // Disable update for API request
            } else {
                $this->expiration_year->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'cv_reply' first before field var 'x_cv_reply'
        $val = $CurrentForm->hasValue("cv_reply") ? $CurrentForm->getValue("cv_reply") : $CurrentForm->getValue("x_cv_reply");
        if (!$this->cv_reply->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cv_reply->Visible = false; // Disable update for API request
            } else {
                $this->cv_reply->setFormValue($val);
            }
        }

        // Check field name 'charge_amount' first before field var 'x_charge_amount'
        $val = $CurrentForm->hasValue("charge_amount") ? $CurrentForm->getValue("charge_amount") : $CurrentForm->getValue("x_charge_amount");
        if (!$this->charge_amount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->charge_amount->Visible = false; // Disable update for API request
            } else {
                $this->charge_amount->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'order_number' first before field var 'x_order_number'
        $val = $CurrentForm->hasValue("order_number") ? $CurrentForm->getValue("order_number") : $CurrentForm->getValue("x_order_number");
        if (!$this->order_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->order_number->Visible = false; // Disable update for API request
            } else {
                $this->order_number->setFormValue($val);
            }
        }

        // Check field name 'account_number' first before field var 'x_account_number'
        $val = $CurrentForm->hasValue("account_number") ? $CurrentForm->getValue("account_number") : $CurrentForm->getValue("x_account_number");
        if (!$this->account_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->account_number->Visible = false; // Disable update for API request
            } else {
                $this->account_number->setFormValue($val);
            }
        }

        // Check field name 'decision' first before field var 'x_decision'
        $val = $CurrentForm->hasValue("decision") ? $CurrentForm->getValue("decision") : $CurrentForm->getValue("x_decision");
        if (!$this->decision->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->decision->Visible = false; // Disable update for API request
            } else {
                $this->decision->setFormValue($val);
            }
        }

        // Check field name 'reason_code' first before field var 'x_reason_code'
        $val = $CurrentForm->hasValue("reason_code") ? $CurrentForm->getValue("reason_code") : $CurrentForm->getValue("x_reason_code");
        if (!$this->reason_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->reason_code->Visible = false; // Disable update for API request
            } else {
                $this->reason_code->setFormValue($val, true, $validate);
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

        // Check field name 'ch_email' first before field var 'x_ch_email'
        $val = $CurrentForm->hasValue("ch_email") ? $CurrentForm->getValue("ch_email") : $CurrentForm->getValue("x_ch_email");
        if (!$this->ch_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ch_email->Visible = false; // Disable update for API request
            } else {
                $this->ch_email->setFormValue($val);
            }
        }

        // Check field name 'ch_phone' first before field var 'x_ch_phone'
        $val = $CurrentForm->hasValue("ch_phone") ? $CurrentForm->getValue("ch_phone") : $CurrentForm->getValue("x_ch_phone");
        if (!$this->ch_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ch_phone->Visible = false; // Disable update for API request
            } else {
                $this->ch_phone->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->charge_id->CurrentValue = $this->charge_id->FormValue;
        $this->ch_first_name->CurrentValue = $this->ch_first_name->FormValue;
        $this->ch_last_name->CurrentValue = $this->ch_last_name->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->city->CurrentValue = $this->city->FormValue;
        $this->state->CurrentValue = $this->state->FormValue;
        $this->zipcode->CurrentValue = $this->zipcode->FormValue;
        $this->card_type->CurrentValue = $this->card_type->FormValue;
        $this->expiration_month->CurrentValue = $this->expiration_month->FormValue;
        $this->expiration_year->CurrentValue = $this->expiration_year->FormValue;
        $this->cv_reply->CurrentValue = $this->cv_reply->FormValue;
        $this->charge_amount->CurrentValue = $this->charge_amount->FormValue;
        $this->order_number->CurrentValue = $this->order_number->FormValue;
        $this->account_number->CurrentValue = $this->account_number->FormValue;
        $this->decision->CurrentValue = $this->decision->FormValue;
        $this->reason_code->CurrentValue = $this->reason_code->FormValue;
        $this->transaction_time->CurrentValue = $this->transaction_time->FormValue;
        $this->transaction_time->CurrentValue = UnFormatDateTime($this->transaction_time->CurrentValue, $this->transaction_time->formatPattern());
        $this->ch_email->CurrentValue = $this->ch_email->FormValue;
        $this->ch_phone->CurrentValue = $this->ch_phone->FormValue;
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
        $this->charge_id->setDbValue($row['charge_id']);
        $this->ch_first_name->setDbValue($row['ch_first_name']);
        $this->ch_last_name->setDbValue($row['ch_last_name']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->state->setDbValue($row['state']);
        $this->zipcode->setDbValue($row['zipcode']);
        $this->card_type->setDbValue($row['card_type']);
        $this->expiration_month->setDbValue($row['expiration_month']);
        $this->expiration_year->setDbValue($row['expiration_year']);
        $this->cv_reply->setDbValue($row['cv_reply']);
        $this->charge_amount->setDbValue($row['charge_amount']);
        $this->order_number->setDbValue($row['order_number']);
        $this->account_number->setDbValue($row['account_number']);
        $this->decision->setDbValue($row['decision']);
        $this->reason_code->setDbValue($row['reason_code']);
        $this->transaction_time->setDbValue($row['transaction_time']);
        $this->ch_email->setDbValue($row['ch_email']);
        $this->ch_phone->setDbValue($row['ch_phone']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['charge_id'] = null;
        $row['ch_first_name'] = null;
        $row['ch_last_name'] = null;
        $row['address'] = null;
        $row['city'] = null;
        $row['state'] = null;
        $row['zipcode'] = null;
        $row['card_type'] = null;
        $row['expiration_month'] = null;
        $row['expiration_year'] = null;
        $row['cv_reply'] = null;
        $row['charge_amount'] = null;
        $row['order_number'] = null;
        $row['account_number'] = null;
        $row['decision'] = null;
        $row['reason_code'] = null;
        $row['transaction_time'] = null;
        $row['ch_email'] = null;
        $row['ch_phone'] = null;
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

        // charge_id
        $this->charge_id->RowCssClass = "row";

        // ch_first_name
        $this->ch_first_name->RowCssClass = "row";

        // ch_last_name
        $this->ch_last_name->RowCssClass = "row";

        // address
        $this->address->RowCssClass = "row";

        // city
        $this->city->RowCssClass = "row";

        // state
        $this->state->RowCssClass = "row";

        // zipcode
        $this->zipcode->RowCssClass = "row";

        // card_type
        $this->card_type->RowCssClass = "row";

        // expiration_month
        $this->expiration_month->RowCssClass = "row";

        // expiration_year
        $this->expiration_year->RowCssClass = "row";

        // cv_reply
        $this->cv_reply->RowCssClass = "row";

        // charge_amount
        $this->charge_amount->RowCssClass = "row";

        // order_number
        $this->order_number->RowCssClass = "row";

        // account_number
        $this->account_number->RowCssClass = "row";

        // decision
        $this->decision->RowCssClass = "row";

        // reason_code
        $this->reason_code->RowCssClass = "row";

        // transaction_time
        $this->transaction_time->RowCssClass = "row";

        // ch_email
        $this->ch_email->RowCssClass = "row";

        // ch_phone
        $this->ch_phone->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // charge_id
            $this->charge_id->ViewValue = $this->charge_id->CurrentValue;
            $this->charge_id->ViewCustomAttributes = "";

            // ch_first_name
            $this->ch_first_name->ViewValue = $this->ch_first_name->CurrentValue;
            $this->ch_first_name->ViewCustomAttributes = "";

            // ch_last_name
            $this->ch_last_name->ViewValue = $this->ch_last_name->CurrentValue;
            $this->ch_last_name->ViewCustomAttributes = "";

            // address
            $this->address->ViewValue = $this->address->CurrentValue;
            $this->address->ViewCustomAttributes = "";

            // city
            $this->city->ViewValue = $this->city->CurrentValue;
            $this->city->ViewCustomAttributes = "";

            // state
            $this->state->ViewValue = $this->state->CurrentValue;
            $this->state->ViewCustomAttributes = "";

            // zipcode
            $this->zipcode->ViewValue = $this->zipcode->CurrentValue;
            $this->zipcode->ViewCustomAttributes = "";

            // card_type
            $this->card_type->ViewValue = $this->card_type->CurrentValue;
            $this->card_type->ViewCustomAttributes = "";

            // expiration_month
            $this->expiration_month->ViewValue = $this->expiration_month->CurrentValue;
            $this->expiration_month->ViewValue = FormatNumber($this->expiration_month->ViewValue, "");
            $this->expiration_month->ViewCustomAttributes = "";

            // expiration_year
            $this->expiration_year->ViewValue = $this->expiration_year->CurrentValue;
            $this->expiration_year->ViewValue = FormatNumber($this->expiration_year->ViewValue, "");
            $this->expiration_year->ViewCustomAttributes = "";

            // cv_reply
            $this->cv_reply->ViewValue = $this->cv_reply->CurrentValue;
            $this->cv_reply->ViewCustomAttributes = "";

            // charge_amount
            $this->charge_amount->ViewValue = $this->charge_amount->CurrentValue;
            $this->charge_amount->ViewValue = FormatNumber($this->charge_amount->ViewValue, "");
            $this->charge_amount->ViewCustomAttributes = "";

            // order_number
            $this->order_number->ViewValue = $this->order_number->CurrentValue;
            $this->order_number->ViewCustomAttributes = "";

            // account_number
            $this->account_number->ViewValue = $this->account_number->CurrentValue;
            $this->account_number->ViewCustomAttributes = "";

            // decision
            $this->decision->ViewValue = $this->decision->CurrentValue;
            $this->decision->ViewCustomAttributes = "";

            // reason_code
            $this->reason_code->ViewValue = $this->reason_code->CurrentValue;
            $this->reason_code->ViewValue = FormatNumber($this->reason_code->ViewValue, "");
            $this->reason_code->ViewCustomAttributes = "";

            // transaction_time
            $this->transaction_time->ViewValue = $this->transaction_time->CurrentValue;
            $this->transaction_time->ViewValue = FormatDateTime($this->transaction_time->ViewValue, 0);
            $this->transaction_time->ViewCustomAttributes = "";

            // ch_email
            $this->ch_email->ViewValue = $this->ch_email->CurrentValue;
            $this->ch_email->ViewCustomAttributes = "";

            // ch_phone
            $this->ch_phone->ViewValue = $this->ch_phone->CurrentValue;
            $this->ch_phone->ViewCustomAttributes = "";

            // charge_id
            $this->charge_id->LinkCustomAttributes = "";
            $this->charge_id->HrefValue = "";

            // ch_first_name
            $this->ch_first_name->LinkCustomAttributes = "";
            $this->ch_first_name->HrefValue = "";

            // ch_last_name
            $this->ch_last_name->LinkCustomAttributes = "";
            $this->ch_last_name->HrefValue = "";

            // address
            $this->address->LinkCustomAttributes = "";
            $this->address->HrefValue = "";

            // city
            $this->city->LinkCustomAttributes = "";
            $this->city->HrefValue = "";

            // state
            $this->state->LinkCustomAttributes = "";
            $this->state->HrefValue = "";

            // zipcode
            $this->zipcode->LinkCustomAttributes = "";
            $this->zipcode->HrefValue = "";

            // card_type
            $this->card_type->LinkCustomAttributes = "";
            $this->card_type->HrefValue = "";

            // expiration_month
            $this->expiration_month->LinkCustomAttributes = "";
            $this->expiration_month->HrefValue = "";

            // expiration_year
            $this->expiration_year->LinkCustomAttributes = "";
            $this->expiration_year->HrefValue = "";

            // cv_reply
            $this->cv_reply->LinkCustomAttributes = "";
            $this->cv_reply->HrefValue = "";

            // charge_amount
            $this->charge_amount->LinkCustomAttributes = "";
            $this->charge_amount->HrefValue = "";

            // order_number
            $this->order_number->LinkCustomAttributes = "";
            $this->order_number->HrefValue = "";

            // account_number
            $this->account_number->LinkCustomAttributes = "";
            $this->account_number->HrefValue = "";

            // decision
            $this->decision->LinkCustomAttributes = "";
            $this->decision->HrefValue = "";

            // reason_code
            $this->reason_code->LinkCustomAttributes = "";
            $this->reason_code->HrefValue = "";

            // transaction_time
            $this->transaction_time->LinkCustomAttributes = "";
            $this->transaction_time->HrefValue = "";

            // ch_email
            $this->ch_email->LinkCustomAttributes = "";
            $this->ch_email->HrefValue = "";

            // ch_phone
            $this->ch_phone->LinkCustomAttributes = "";
            $this->ch_phone->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // charge_id
            $this->charge_id->setupEditAttributes();
            $this->charge_id->EditCustomAttributes = "";
            $this->charge_id->EditValue = $this->charge_id->CurrentValue;
            $this->charge_id->ViewCustomAttributes = "";

            // ch_first_name
            $this->ch_first_name->setupEditAttributes();
            $this->ch_first_name->EditCustomAttributes = "";
            if (!$this->ch_first_name->Raw) {
                $this->ch_first_name->CurrentValue = HtmlDecode($this->ch_first_name->CurrentValue);
            }
            $this->ch_first_name->EditValue = HtmlEncode($this->ch_first_name->CurrentValue);
            $this->ch_first_name->PlaceHolder = RemoveHtml($this->ch_first_name->caption());

            // ch_last_name
            $this->ch_last_name->setupEditAttributes();
            $this->ch_last_name->EditCustomAttributes = "";
            if (!$this->ch_last_name->Raw) {
                $this->ch_last_name->CurrentValue = HtmlDecode($this->ch_last_name->CurrentValue);
            }
            $this->ch_last_name->EditValue = HtmlEncode($this->ch_last_name->CurrentValue);
            $this->ch_last_name->PlaceHolder = RemoveHtml($this->ch_last_name->caption());

            // address
            $this->address->setupEditAttributes();
            $this->address->EditCustomAttributes = "";
            if (!$this->address->Raw) {
                $this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
            }
            $this->address->EditValue = HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = RemoveHtml($this->address->caption());

            // city
            $this->city->setupEditAttributes();
            $this->city->EditCustomAttributes = "";
            if (!$this->city->Raw) {
                $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
            }
            $this->city->EditValue = HtmlEncode($this->city->CurrentValue);
            $this->city->PlaceHolder = RemoveHtml($this->city->caption());

            // state
            $this->state->setupEditAttributes();
            $this->state->EditCustomAttributes = "";
            if (!$this->state->Raw) {
                $this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
            }
            $this->state->EditValue = HtmlEncode($this->state->CurrentValue);
            $this->state->PlaceHolder = RemoveHtml($this->state->caption());

            // zipcode
            $this->zipcode->setupEditAttributes();
            $this->zipcode->EditCustomAttributes = "";
            if (!$this->zipcode->Raw) {
                $this->zipcode->CurrentValue = HtmlDecode($this->zipcode->CurrentValue);
            }
            $this->zipcode->EditValue = HtmlEncode($this->zipcode->CurrentValue);
            $this->zipcode->PlaceHolder = RemoveHtml($this->zipcode->caption());

            // card_type
            $this->card_type->setupEditAttributes();
            $this->card_type->EditCustomAttributes = "";
            if (!$this->card_type->Raw) {
                $this->card_type->CurrentValue = HtmlDecode($this->card_type->CurrentValue);
            }
            $this->card_type->EditValue = HtmlEncode($this->card_type->CurrentValue);
            $this->card_type->PlaceHolder = RemoveHtml($this->card_type->caption());

            // expiration_month
            $this->expiration_month->setupEditAttributes();
            $this->expiration_month->EditCustomAttributes = "";
            $this->expiration_month->EditValue = HtmlEncode($this->expiration_month->CurrentValue);
            $this->expiration_month->PlaceHolder = RemoveHtml($this->expiration_month->caption());
            if (strval($this->expiration_month->EditValue) != "" && is_numeric($this->expiration_month->EditValue)) {
                $this->expiration_month->EditValue = FormatNumber($this->expiration_month->EditValue, null);
            }

            // expiration_year
            $this->expiration_year->setupEditAttributes();
            $this->expiration_year->EditCustomAttributes = "";
            $this->expiration_year->EditValue = HtmlEncode($this->expiration_year->CurrentValue);
            $this->expiration_year->PlaceHolder = RemoveHtml($this->expiration_year->caption());
            if (strval($this->expiration_year->EditValue) != "" && is_numeric($this->expiration_year->EditValue)) {
                $this->expiration_year->EditValue = FormatNumber($this->expiration_year->EditValue, null);
            }

            // cv_reply
            $this->cv_reply->setupEditAttributes();
            $this->cv_reply->EditCustomAttributes = "";
            if (!$this->cv_reply->Raw) {
                $this->cv_reply->CurrentValue = HtmlDecode($this->cv_reply->CurrentValue);
            }
            $this->cv_reply->EditValue = HtmlEncode($this->cv_reply->CurrentValue);
            $this->cv_reply->PlaceHolder = RemoveHtml($this->cv_reply->caption());

            // charge_amount
            $this->charge_amount->setupEditAttributes();
            $this->charge_amount->EditCustomAttributes = "";
            $this->charge_amount->EditValue = HtmlEncode($this->charge_amount->CurrentValue);
            $this->charge_amount->PlaceHolder = RemoveHtml($this->charge_amount->caption());
            if (strval($this->charge_amount->EditValue) != "" && is_numeric($this->charge_amount->EditValue)) {
                $this->charge_amount->EditValue = FormatNumber($this->charge_amount->EditValue, null);
            }

            // order_number
            $this->order_number->setupEditAttributes();
            $this->order_number->EditCustomAttributes = "";
            if (!$this->order_number->Raw) {
                $this->order_number->CurrentValue = HtmlDecode($this->order_number->CurrentValue);
            }
            $this->order_number->EditValue = HtmlEncode($this->order_number->CurrentValue);
            $this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

            // account_number
            $this->account_number->setupEditAttributes();
            $this->account_number->EditCustomAttributes = "";
            if (!$this->account_number->Raw) {
                $this->account_number->CurrentValue = HtmlDecode($this->account_number->CurrentValue);
            }
            $this->account_number->EditValue = HtmlEncode($this->account_number->CurrentValue);
            $this->account_number->PlaceHolder = RemoveHtml($this->account_number->caption());

            // decision
            $this->decision->setupEditAttributes();
            $this->decision->EditCustomAttributes = "";
            if (!$this->decision->Raw) {
                $this->decision->CurrentValue = HtmlDecode($this->decision->CurrentValue);
            }
            $this->decision->EditValue = HtmlEncode($this->decision->CurrentValue);
            $this->decision->PlaceHolder = RemoveHtml($this->decision->caption());

            // reason_code
            $this->reason_code->setupEditAttributes();
            $this->reason_code->EditCustomAttributes = "";
            $this->reason_code->EditValue = HtmlEncode($this->reason_code->CurrentValue);
            $this->reason_code->PlaceHolder = RemoveHtml($this->reason_code->caption());
            if (strval($this->reason_code->EditValue) != "" && is_numeric($this->reason_code->EditValue)) {
                $this->reason_code->EditValue = FormatNumber($this->reason_code->EditValue, null);
            }

            // transaction_time
            $this->transaction_time->setupEditAttributes();
            $this->transaction_time->EditCustomAttributes = "";
            $this->transaction_time->EditValue = HtmlEncode(FormatDateTime($this->transaction_time->CurrentValue, 8));
            $this->transaction_time->PlaceHolder = RemoveHtml($this->transaction_time->caption());

            // ch_email
            $this->ch_email->setupEditAttributes();
            $this->ch_email->EditCustomAttributes = "";
            if (!$this->ch_email->Raw) {
                $this->ch_email->CurrentValue = HtmlDecode($this->ch_email->CurrentValue);
            }
            $this->ch_email->EditValue = HtmlEncode($this->ch_email->CurrentValue);
            $this->ch_email->PlaceHolder = RemoveHtml($this->ch_email->caption());

            // ch_phone
            $this->ch_phone->setupEditAttributes();
            $this->ch_phone->EditCustomAttributes = "";
            if (!$this->ch_phone->Raw) {
                $this->ch_phone->CurrentValue = HtmlDecode($this->ch_phone->CurrentValue);
            }
            $this->ch_phone->EditValue = HtmlEncode($this->ch_phone->CurrentValue);
            $this->ch_phone->PlaceHolder = RemoveHtml($this->ch_phone->caption());

            // Edit refer script

            // charge_id
            $this->charge_id->LinkCustomAttributes = "";
            $this->charge_id->HrefValue = "";

            // ch_first_name
            $this->ch_first_name->LinkCustomAttributes = "";
            $this->ch_first_name->HrefValue = "";

            // ch_last_name
            $this->ch_last_name->LinkCustomAttributes = "";
            $this->ch_last_name->HrefValue = "";

            // address
            $this->address->LinkCustomAttributes = "";
            $this->address->HrefValue = "";

            // city
            $this->city->LinkCustomAttributes = "";
            $this->city->HrefValue = "";

            // state
            $this->state->LinkCustomAttributes = "";
            $this->state->HrefValue = "";

            // zipcode
            $this->zipcode->LinkCustomAttributes = "";
            $this->zipcode->HrefValue = "";

            // card_type
            $this->card_type->LinkCustomAttributes = "";
            $this->card_type->HrefValue = "";

            // expiration_month
            $this->expiration_month->LinkCustomAttributes = "";
            $this->expiration_month->HrefValue = "";

            // expiration_year
            $this->expiration_year->LinkCustomAttributes = "";
            $this->expiration_year->HrefValue = "";

            // cv_reply
            $this->cv_reply->LinkCustomAttributes = "";
            $this->cv_reply->HrefValue = "";

            // charge_amount
            $this->charge_amount->LinkCustomAttributes = "";
            $this->charge_amount->HrefValue = "";

            // order_number
            $this->order_number->LinkCustomAttributes = "";
            $this->order_number->HrefValue = "";

            // account_number
            $this->account_number->LinkCustomAttributes = "";
            $this->account_number->HrefValue = "";

            // decision
            $this->decision->LinkCustomAttributes = "";
            $this->decision->HrefValue = "";

            // reason_code
            $this->reason_code->LinkCustomAttributes = "";
            $this->reason_code->HrefValue = "";

            // transaction_time
            $this->transaction_time->LinkCustomAttributes = "";
            $this->transaction_time->HrefValue = "";

            // ch_email
            $this->ch_email->LinkCustomAttributes = "";
            $this->ch_email->HrefValue = "";

            // ch_phone
            $this->ch_phone->LinkCustomAttributes = "";
            $this->ch_phone->HrefValue = "";
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
        if ($this->charge_id->Required) {
            if (!$this->charge_id->IsDetailKey && EmptyValue($this->charge_id->FormValue)) {
                $this->charge_id->addErrorMessage(str_replace("%s", $this->charge_id->caption(), $this->charge_id->RequiredErrorMessage));
            }
        }
        if ($this->ch_first_name->Required) {
            if (!$this->ch_first_name->IsDetailKey && EmptyValue($this->ch_first_name->FormValue)) {
                $this->ch_first_name->addErrorMessage(str_replace("%s", $this->ch_first_name->caption(), $this->ch_first_name->RequiredErrorMessage));
            }
        }
        if ($this->ch_last_name->Required) {
            if (!$this->ch_last_name->IsDetailKey && EmptyValue($this->ch_last_name->FormValue)) {
                $this->ch_last_name->addErrorMessage(str_replace("%s", $this->ch_last_name->caption(), $this->ch_last_name->RequiredErrorMessage));
            }
        }
        if ($this->address->Required) {
            if (!$this->address->IsDetailKey && EmptyValue($this->address->FormValue)) {
                $this->address->addErrorMessage(str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
            }
        }
        if ($this->city->Required) {
            if (!$this->city->IsDetailKey && EmptyValue($this->city->FormValue)) {
                $this->city->addErrorMessage(str_replace("%s", $this->city->caption(), $this->city->RequiredErrorMessage));
            }
        }
        if ($this->state->Required) {
            if (!$this->state->IsDetailKey && EmptyValue($this->state->FormValue)) {
                $this->state->addErrorMessage(str_replace("%s", $this->state->caption(), $this->state->RequiredErrorMessage));
            }
        }
        if ($this->zipcode->Required) {
            if (!$this->zipcode->IsDetailKey && EmptyValue($this->zipcode->FormValue)) {
                $this->zipcode->addErrorMessage(str_replace("%s", $this->zipcode->caption(), $this->zipcode->RequiredErrorMessage));
            }
        }
        if ($this->card_type->Required) {
            if (!$this->card_type->IsDetailKey && EmptyValue($this->card_type->FormValue)) {
                $this->card_type->addErrorMessage(str_replace("%s", $this->card_type->caption(), $this->card_type->RequiredErrorMessage));
            }
        }
        if ($this->expiration_month->Required) {
            if (!$this->expiration_month->IsDetailKey && EmptyValue($this->expiration_month->FormValue)) {
                $this->expiration_month->addErrorMessage(str_replace("%s", $this->expiration_month->caption(), $this->expiration_month->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->expiration_month->FormValue)) {
            $this->expiration_month->addErrorMessage($this->expiration_month->getErrorMessage(false));
        }
        if ($this->expiration_year->Required) {
            if (!$this->expiration_year->IsDetailKey && EmptyValue($this->expiration_year->FormValue)) {
                $this->expiration_year->addErrorMessage(str_replace("%s", $this->expiration_year->caption(), $this->expiration_year->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->expiration_year->FormValue)) {
            $this->expiration_year->addErrorMessage($this->expiration_year->getErrorMessage(false));
        }
        if ($this->cv_reply->Required) {
            if (!$this->cv_reply->IsDetailKey && EmptyValue($this->cv_reply->FormValue)) {
                $this->cv_reply->addErrorMessage(str_replace("%s", $this->cv_reply->caption(), $this->cv_reply->RequiredErrorMessage));
            }
        }
        if ($this->charge_amount->Required) {
            if (!$this->charge_amount->IsDetailKey && EmptyValue($this->charge_amount->FormValue)) {
                $this->charge_amount->addErrorMessage(str_replace("%s", $this->charge_amount->caption(), $this->charge_amount->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->charge_amount->FormValue)) {
            $this->charge_amount->addErrorMessage($this->charge_amount->getErrorMessage(false));
        }
        if ($this->order_number->Required) {
            if (!$this->order_number->IsDetailKey && EmptyValue($this->order_number->FormValue)) {
                $this->order_number->addErrorMessage(str_replace("%s", $this->order_number->caption(), $this->order_number->RequiredErrorMessage));
            }
        }
        if ($this->account_number->Required) {
            if (!$this->account_number->IsDetailKey && EmptyValue($this->account_number->FormValue)) {
                $this->account_number->addErrorMessage(str_replace("%s", $this->account_number->caption(), $this->account_number->RequiredErrorMessage));
            }
        }
        if ($this->decision->Required) {
            if (!$this->decision->IsDetailKey && EmptyValue($this->decision->FormValue)) {
                $this->decision->addErrorMessage(str_replace("%s", $this->decision->caption(), $this->decision->RequiredErrorMessage));
            }
        }
        if ($this->reason_code->Required) {
            if (!$this->reason_code->IsDetailKey && EmptyValue($this->reason_code->FormValue)) {
                $this->reason_code->addErrorMessage(str_replace("%s", $this->reason_code->caption(), $this->reason_code->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->reason_code->FormValue)) {
            $this->reason_code->addErrorMessage($this->reason_code->getErrorMessage(false));
        }
        if ($this->transaction_time->Required) {
            if (!$this->transaction_time->IsDetailKey && EmptyValue($this->transaction_time->FormValue)) {
                $this->transaction_time->addErrorMessage(str_replace("%s", $this->transaction_time->caption(), $this->transaction_time->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->transaction_time->FormValue, $this->transaction_time->formatPattern())) {
            $this->transaction_time->addErrorMessage($this->transaction_time->getErrorMessage(false));
        }
        if ($this->ch_email->Required) {
            if (!$this->ch_email->IsDetailKey && EmptyValue($this->ch_email->FormValue)) {
                $this->ch_email->addErrorMessage(str_replace("%s", $this->ch_email->caption(), $this->ch_email->RequiredErrorMessage));
            }
        }
        if ($this->ch_phone->Required) {
            if (!$this->ch_phone->IsDetailKey && EmptyValue($this->ch_phone->FormValue)) {
                $this->ch_phone->addErrorMessage(str_replace("%s", $this->ch_phone->caption(), $this->ch_phone->RequiredErrorMessage));
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

            // ch_first_name
            $this->ch_first_name->setDbValueDef($rsnew, $this->ch_first_name->CurrentValue, "", $this->ch_first_name->ReadOnly);

            // ch_last_name
            $this->ch_last_name->setDbValueDef($rsnew, $this->ch_last_name->CurrentValue, "", $this->ch_last_name->ReadOnly);

            // address
            $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, "", $this->address->ReadOnly);

            // city
            $this->city->setDbValueDef($rsnew, $this->city->CurrentValue, "", $this->city->ReadOnly);

            // state
            $this->state->setDbValueDef($rsnew, $this->state->CurrentValue, "", $this->state->ReadOnly);

            // zipcode
            $this->zipcode->setDbValueDef($rsnew, $this->zipcode->CurrentValue, "", $this->zipcode->ReadOnly);

            // card_type
            $this->card_type->setDbValueDef($rsnew, $this->card_type->CurrentValue, "", $this->card_type->ReadOnly);

            // expiration_month
            $this->expiration_month->setDbValueDef($rsnew, $this->expiration_month->CurrentValue, 0, $this->expiration_month->ReadOnly);

            // expiration_year
            $this->expiration_year->setDbValueDef($rsnew, $this->expiration_year->CurrentValue, 0, $this->expiration_year->ReadOnly);

            // cv_reply
            $this->cv_reply->setDbValueDef($rsnew, $this->cv_reply->CurrentValue, "", $this->cv_reply->ReadOnly);

            // charge_amount
            $this->charge_amount->setDbValueDef($rsnew, $this->charge_amount->CurrentValue, 0, $this->charge_amount->ReadOnly);

            // order_number
            $this->order_number->setDbValueDef($rsnew, $this->order_number->CurrentValue, "", $this->order_number->ReadOnly);

            // account_number
            $this->account_number->setDbValueDef($rsnew, $this->account_number->CurrentValue, "", $this->account_number->ReadOnly);

            // decision
            $this->decision->setDbValueDef($rsnew, $this->decision->CurrentValue, "", $this->decision->ReadOnly);

            // reason_code
            $this->reason_code->setDbValueDef($rsnew, $this->reason_code->CurrentValue, 0, $this->reason_code->ReadOnly);

            // transaction_time
            $this->transaction_time->setDbValueDef($rsnew, UnFormatDateTime($this->transaction_time->CurrentValue, $this->transaction_time->formatPattern()), null, $this->transaction_time->ReadOnly);

            // ch_email
            $this->ch_email->setDbValueDef($rsnew, $this->ch_email->CurrentValue, "", $this->ch_email->ReadOnly);

            // ch_phone
            $this->ch_phone->setDbValueDef($rsnew, $this->ch_phone->CurrentValue, "", $this->ch_phone->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ChargePaymentList"), "", $this->TableVar, true);
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
