<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class CateringEdit extends Catering
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'catering';

    // Page object name
    public $PageObjName = "CateringEdit";

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

        // Table object (catering)
        if (!isset($GLOBALS["catering"]) || get_class($GLOBALS["catering"]) == PROJECT_NAMESPACE . "catering") {
            $GLOBALS["catering"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'catering');
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
                $doc = new $class(Container("catering"));
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
                    if ($pageName == "CateringView") {
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
        $this->location->setVisibility();
        $this->method->setVisibility();
        $this->delivery_date->setVisibility();
        $this->delivery_time->setVisibility();
        $this->delivery_building->setVisibility();
        $this->delivery_room->setVisibility();
        $this->delivery_notes->setVisibility();
        $this->onsite_name->setVisibility();
        $this->onsite_email->setVisibility();
        $this->onsite_phone->setVisibility();
        $this->customer_name->setVisibility();
        $this->customer_phone->setVisibility();
        $this->customer_email->setVisibility();
        $this->payment_method->setVisibility();
        $this->account_num->setVisibility();
        $this->sub_code->setVisibility();
        $this->status->setVisibility();
        $this->order->setVisibility();
        $this->timestamp->setVisibility();
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
                    $this->terminate("CateringList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "CateringList") {
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

        // Check field name 'location' first before field var 'x_location'
        $val = $CurrentForm->hasValue("location") ? $CurrentForm->getValue("location") : $CurrentForm->getValue("x_location");
        if (!$this->location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location->Visible = false; // Disable update for API request
            } else {
                $this->location->setFormValue($val);
            }
        }

        // Check field name 'method' first before field var 'x_method'
        $val = $CurrentForm->hasValue("method") ? $CurrentForm->getValue("method") : $CurrentForm->getValue("x_method");
        if (!$this->method->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->method->Visible = false; // Disable update for API request
            } else {
                $this->method->setFormValue($val);
            }
        }

        // Check field name 'delivery_date' first before field var 'x_delivery_date'
        $val = $CurrentForm->hasValue("delivery_date") ? $CurrentForm->getValue("delivery_date") : $CurrentForm->getValue("x_delivery_date");
        if (!$this->delivery_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delivery_date->Visible = false; // Disable update for API request
            } else {
                $this->delivery_date->setFormValue($val);
            }
            $this->delivery_date->CurrentValue = UnFormatDateTime($this->delivery_date->CurrentValue, 0);
        }

        // Check field name 'delivery_time' first before field var 'x_delivery_time'
        $val = $CurrentForm->hasValue("delivery_time") ? $CurrentForm->getValue("delivery_time") : $CurrentForm->getValue("x_delivery_time");
        if (!$this->delivery_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delivery_time->Visible = false; // Disable update for API request
            } else {
                $this->delivery_time->setFormValue($val);
            }
        }

        // Check field name 'delivery_building' first before field var 'x_delivery_building'
        $val = $CurrentForm->hasValue("delivery_building") ? $CurrentForm->getValue("delivery_building") : $CurrentForm->getValue("x_delivery_building");
        if (!$this->delivery_building->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delivery_building->Visible = false; // Disable update for API request
            } else {
                $this->delivery_building->setFormValue($val);
            }
        }

        // Check field name 'delivery_room' first before field var 'x_delivery_room'
        $val = $CurrentForm->hasValue("delivery_room") ? $CurrentForm->getValue("delivery_room") : $CurrentForm->getValue("x_delivery_room");
        if (!$this->delivery_room->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delivery_room->Visible = false; // Disable update for API request
            } else {
                $this->delivery_room->setFormValue($val);
            }
        }

        // Check field name 'delivery_notes' first before field var 'x_delivery_notes'
        $val = $CurrentForm->hasValue("delivery_notes") ? $CurrentForm->getValue("delivery_notes") : $CurrentForm->getValue("x_delivery_notes");
        if (!$this->delivery_notes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delivery_notes->Visible = false; // Disable update for API request
            } else {
                $this->delivery_notes->setFormValue($val);
            }
        }

        // Check field name 'onsite_name' first before field var 'x_onsite_name'
        $val = $CurrentForm->hasValue("onsite_name") ? $CurrentForm->getValue("onsite_name") : $CurrentForm->getValue("x_onsite_name");
        if (!$this->onsite_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->onsite_name->Visible = false; // Disable update for API request
            } else {
                $this->onsite_name->setFormValue($val);
            }
        }

        // Check field name 'onsite_email' first before field var 'x_onsite_email'
        $val = $CurrentForm->hasValue("onsite_email") ? $CurrentForm->getValue("onsite_email") : $CurrentForm->getValue("x_onsite_email");
        if (!$this->onsite_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->onsite_email->Visible = false; // Disable update for API request
            } else {
                $this->onsite_email->setFormValue($val);
            }
        }

        // Check field name 'onsite_phone' first before field var 'x_onsite_phone'
        $val = $CurrentForm->hasValue("onsite_phone") ? $CurrentForm->getValue("onsite_phone") : $CurrentForm->getValue("x_onsite_phone");
        if (!$this->onsite_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->onsite_phone->Visible = false; // Disable update for API request
            } else {
                $this->onsite_phone->setFormValue($val);
            }
        }

        // Check field name 'customer_name' first before field var 'x_customer_name'
        $val = $CurrentForm->hasValue("customer_name") ? $CurrentForm->getValue("customer_name") : $CurrentForm->getValue("x_customer_name");
        if (!$this->customer_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->customer_name->Visible = false; // Disable update for API request
            } else {
                $this->customer_name->setFormValue($val);
            }
        }

        // Check field name 'customer_phone' first before field var 'x_customer_phone'
        $val = $CurrentForm->hasValue("customer_phone") ? $CurrentForm->getValue("customer_phone") : $CurrentForm->getValue("x_customer_phone");
        if (!$this->customer_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->customer_phone->Visible = false; // Disable update for API request
            } else {
                $this->customer_phone->setFormValue($val);
            }
        }

        // Check field name 'customer_email' first before field var 'x_customer_email'
        $val = $CurrentForm->hasValue("customer_email") ? $CurrentForm->getValue("customer_email") : $CurrentForm->getValue("x_customer_email");
        if (!$this->customer_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->customer_email->Visible = false; // Disable update for API request
            } else {
                $this->customer_email->setFormValue($val);
            }
        }

        // Check field name 'payment_method' first before field var 'x_payment_method'
        $val = $CurrentForm->hasValue("payment_method") ? $CurrentForm->getValue("payment_method") : $CurrentForm->getValue("x_payment_method");
        if (!$this->payment_method->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->payment_method->Visible = false; // Disable update for API request
            } else {
                $this->payment_method->setFormValue($val);
            }
        }

        // Check field name 'account_num' first before field var 'x_account_num'
        $val = $CurrentForm->hasValue("account_num") ? $CurrentForm->getValue("account_num") : $CurrentForm->getValue("x_account_num");
        if (!$this->account_num->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->account_num->Visible = false; // Disable update for API request
            } else {
                $this->account_num->setFormValue($val);
            }
        }

        // Check field name 'sub_code' first before field var 'x_sub_code'
        $val = $CurrentForm->hasValue("sub_code") ? $CurrentForm->getValue("sub_code") : $CurrentForm->getValue("x_sub_code");
        if (!$this->sub_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sub_code->Visible = false; // Disable update for API request
            } else {
                $this->sub_code->setFormValue($val);
            }
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'order' first before field var 'x_order'
        $val = $CurrentForm->hasValue("order") ? $CurrentForm->getValue("order") : $CurrentForm->getValue("x_order");
        if (!$this->order->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->order->Visible = false; // Disable update for API request
            } else {
                $this->order->setFormValue($val);
            }
        }

        // Check field name 'timestamp' first before field var 'x_timestamp'
        $val = $CurrentForm->hasValue("timestamp") ? $CurrentForm->getValue("timestamp") : $CurrentForm->getValue("x_timestamp");
        if (!$this->timestamp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->timestamp->Visible = false; // Disable update for API request
            } else {
                $this->timestamp->setFormValue($val);
            }
            $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->location->CurrentValue = $this->location->FormValue;
        $this->method->CurrentValue = $this->method->FormValue;
        $this->delivery_date->CurrentValue = $this->delivery_date->FormValue;
        $this->delivery_date->CurrentValue = UnFormatDateTime($this->delivery_date->CurrentValue, 0);
        $this->delivery_time->CurrentValue = $this->delivery_time->FormValue;
        $this->delivery_building->CurrentValue = $this->delivery_building->FormValue;
        $this->delivery_room->CurrentValue = $this->delivery_room->FormValue;
        $this->delivery_notes->CurrentValue = $this->delivery_notes->FormValue;
        $this->onsite_name->CurrentValue = $this->onsite_name->FormValue;
        $this->onsite_email->CurrentValue = $this->onsite_email->FormValue;
        $this->onsite_phone->CurrentValue = $this->onsite_phone->FormValue;
        $this->customer_name->CurrentValue = $this->customer_name->FormValue;
        $this->customer_phone->CurrentValue = $this->customer_phone->FormValue;
        $this->customer_email->CurrentValue = $this->customer_email->FormValue;
        $this->payment_method->CurrentValue = $this->payment_method->FormValue;
        $this->account_num->CurrentValue = $this->account_num->FormValue;
        $this->sub_code->CurrentValue = $this->sub_code->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->order->CurrentValue = $this->order->FormValue;
        $this->timestamp->CurrentValue = $this->timestamp->FormValue;
        $this->timestamp->CurrentValue = UnFormatDateTime($this->timestamp->CurrentValue, 0);
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
        $this->location->setDbValue($row['location']);
        $this->method->setDbValue($row['method']);
        $this->delivery_date->setDbValue($row['delivery_date']);
        $this->delivery_time->setDbValue($row['delivery_time']);
        $this->delivery_building->setDbValue($row['delivery_building']);
        $this->delivery_room->setDbValue($row['delivery_room']);
        $this->delivery_notes->setDbValue($row['delivery_notes']);
        $this->onsite_name->setDbValue($row['onsite_name']);
        $this->onsite_email->setDbValue($row['onsite_email']);
        $this->onsite_phone->setDbValue($row['onsite_phone']);
        $this->customer_name->setDbValue($row['customer_name']);
        $this->customer_phone->setDbValue($row['customer_phone']);
        $this->customer_email->setDbValue($row['customer_email']);
        $this->payment_method->setDbValue($row['payment_method']);
        $this->account_num->setDbValue($row['account_num']);
        $this->sub_code->setDbValue($row['sub_code']);
        $this->status->setDbValue($row['status']);
        $this->order->setDbValue($row['order']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['location'] = null;
        $row['method'] = null;
        $row['delivery_date'] = null;
        $row['delivery_time'] = null;
        $row['delivery_building'] = null;
        $row['delivery_room'] = null;
        $row['delivery_notes'] = null;
        $row['onsite_name'] = null;
        $row['onsite_email'] = null;
        $row['onsite_phone'] = null;
        $row['customer_name'] = null;
        $row['customer_phone'] = null;
        $row['customer_email'] = null;
        $row['payment_method'] = null;
        $row['account_num'] = null;
        $row['sub_code'] = null;
        $row['status'] = null;
        $row['order'] = null;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // location

        // method

        // delivery_date

        // delivery_time

        // delivery_building

        // delivery_room

        // delivery_notes

        // onsite_name

        // onsite_email

        // onsite_phone

        // customer_name

        // customer_phone

        // customer_email

        // payment_method

        // account_num

        // sub_code

        // status

        // order

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location
            $this->location->ViewValue = $this->location->CurrentValue;
            $this->location->ViewCustomAttributes = "";

            // method
            $this->method->ViewValue = $this->method->CurrentValue;
            $this->method->ViewCustomAttributes = "";

            // delivery_date
            $this->delivery_date->ViewValue = $this->delivery_date->CurrentValue;
            $this->delivery_date->ViewValue = FormatDateTime($this->delivery_date->ViewValue, 0);
            $this->delivery_date->ViewCustomAttributes = "";

            // delivery_time
            $this->delivery_time->ViewValue = $this->delivery_time->CurrentValue;
            $this->delivery_time->ViewCustomAttributes = "";

            // delivery_building
            $this->delivery_building->ViewValue = $this->delivery_building->CurrentValue;
            $this->delivery_building->ViewCustomAttributes = "";

            // delivery_room
            $this->delivery_room->ViewValue = $this->delivery_room->CurrentValue;
            $this->delivery_room->ViewCustomAttributes = "";

            // delivery_notes
            $this->delivery_notes->ViewValue = $this->delivery_notes->CurrentValue;
            $this->delivery_notes->ViewCustomAttributes = "";

            // onsite_name
            $this->onsite_name->ViewValue = $this->onsite_name->CurrentValue;
            $this->onsite_name->ViewCustomAttributes = "";

            // onsite_email
            $this->onsite_email->ViewValue = $this->onsite_email->CurrentValue;
            $this->onsite_email->ViewCustomAttributes = "";

            // onsite_phone
            $this->onsite_phone->ViewValue = $this->onsite_phone->CurrentValue;
            $this->onsite_phone->ViewCustomAttributes = "";

            // customer_name
            $this->customer_name->ViewValue = $this->customer_name->CurrentValue;
            $this->customer_name->ViewCustomAttributes = "";

            // customer_phone
            $this->customer_phone->ViewValue = $this->customer_phone->CurrentValue;
            $this->customer_phone->ViewCustomAttributes = "";

            // customer_email
            $this->customer_email->ViewValue = $this->customer_email->CurrentValue;
            $this->customer_email->ViewCustomAttributes = "";

            // payment_method
            $this->payment_method->ViewValue = $this->payment_method->CurrentValue;
            $this->payment_method->ViewCustomAttributes = "";

            // account_num
            $this->account_num->ViewValue = $this->account_num->CurrentValue;
            $this->account_num->ViewCustomAttributes = "";

            // sub_code
            $this->sub_code->ViewValue = $this->sub_code->CurrentValue;
            $this->sub_code->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // order
            $this->order->ViewValue = $this->order->CurrentValue;
            $this->order->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";
            $this->location->TooltipValue = "";

            // method
            $this->method->LinkCustomAttributes = "";
            $this->method->HrefValue = "";
            $this->method->TooltipValue = "";

            // delivery_date
            $this->delivery_date->LinkCustomAttributes = "";
            $this->delivery_date->HrefValue = "";
            $this->delivery_date->TooltipValue = "";

            // delivery_time
            $this->delivery_time->LinkCustomAttributes = "";
            $this->delivery_time->HrefValue = "";
            $this->delivery_time->TooltipValue = "";

            // delivery_building
            $this->delivery_building->LinkCustomAttributes = "";
            $this->delivery_building->HrefValue = "";
            $this->delivery_building->TooltipValue = "";

            // delivery_room
            $this->delivery_room->LinkCustomAttributes = "";
            $this->delivery_room->HrefValue = "";
            $this->delivery_room->TooltipValue = "";

            // delivery_notes
            $this->delivery_notes->LinkCustomAttributes = "";
            $this->delivery_notes->HrefValue = "";
            $this->delivery_notes->TooltipValue = "";

            // onsite_name
            $this->onsite_name->LinkCustomAttributes = "";
            $this->onsite_name->HrefValue = "";
            $this->onsite_name->TooltipValue = "";

            // onsite_email
            $this->onsite_email->LinkCustomAttributes = "";
            $this->onsite_email->HrefValue = "";
            $this->onsite_email->TooltipValue = "";

            // onsite_phone
            $this->onsite_phone->LinkCustomAttributes = "";
            $this->onsite_phone->HrefValue = "";
            $this->onsite_phone->TooltipValue = "";

            // customer_name
            $this->customer_name->LinkCustomAttributes = "";
            $this->customer_name->HrefValue = "";
            $this->customer_name->TooltipValue = "";

            // customer_phone
            $this->customer_phone->LinkCustomAttributes = "";
            $this->customer_phone->HrefValue = "";
            $this->customer_phone->TooltipValue = "";

            // customer_email
            $this->customer_email->LinkCustomAttributes = "";
            $this->customer_email->HrefValue = "";
            $this->customer_email->TooltipValue = "";

            // payment_method
            $this->payment_method->LinkCustomAttributes = "";
            $this->payment_method->HrefValue = "";
            $this->payment_method->TooltipValue = "";

            // account_num
            $this->account_num->LinkCustomAttributes = "";
            $this->account_num->HrefValue = "";
            $this->account_num->TooltipValue = "";

            // sub_code
            $this->sub_code->LinkCustomAttributes = "";
            $this->sub_code->HrefValue = "";
            $this->sub_code->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // order
            $this->order->LinkCustomAttributes = "";
            $this->order->HrefValue = "";
            $this->order->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // location
            $this->location->EditAttrs["class"] = "form-control";
            $this->location->EditCustomAttributes = "";
            if (!$this->location->Raw) {
                $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
            }
            $this->location->EditValue = HtmlEncode($this->location->CurrentValue);
            $this->location->PlaceHolder = RemoveHtml($this->location->caption());

            // method
            $this->method->EditAttrs["class"] = "form-control";
            $this->method->EditCustomAttributes = "";
            if (!$this->method->Raw) {
                $this->method->CurrentValue = HtmlDecode($this->method->CurrentValue);
            }
            $this->method->EditValue = HtmlEncode($this->method->CurrentValue);
            $this->method->PlaceHolder = RemoveHtml($this->method->caption());

            // delivery_date
            $this->delivery_date->EditAttrs["class"] = "form-control";
            $this->delivery_date->EditCustomAttributes = "";
            $this->delivery_date->EditValue = HtmlEncode(FormatDateTime($this->delivery_date->CurrentValue, 8));
            $this->delivery_date->PlaceHolder = RemoveHtml($this->delivery_date->caption());

            // delivery_time
            $this->delivery_time->EditAttrs["class"] = "form-control";
            $this->delivery_time->EditCustomAttributes = "";
            if (!$this->delivery_time->Raw) {
                $this->delivery_time->CurrentValue = HtmlDecode($this->delivery_time->CurrentValue);
            }
            $this->delivery_time->EditValue = HtmlEncode($this->delivery_time->CurrentValue);
            $this->delivery_time->PlaceHolder = RemoveHtml($this->delivery_time->caption());

            // delivery_building
            $this->delivery_building->EditAttrs["class"] = "form-control";
            $this->delivery_building->EditCustomAttributes = "";
            if (!$this->delivery_building->Raw) {
                $this->delivery_building->CurrentValue = HtmlDecode($this->delivery_building->CurrentValue);
            }
            $this->delivery_building->EditValue = HtmlEncode($this->delivery_building->CurrentValue);
            $this->delivery_building->PlaceHolder = RemoveHtml($this->delivery_building->caption());

            // delivery_room
            $this->delivery_room->EditAttrs["class"] = "form-control";
            $this->delivery_room->EditCustomAttributes = "";
            if (!$this->delivery_room->Raw) {
                $this->delivery_room->CurrentValue = HtmlDecode($this->delivery_room->CurrentValue);
            }
            $this->delivery_room->EditValue = HtmlEncode($this->delivery_room->CurrentValue);
            $this->delivery_room->PlaceHolder = RemoveHtml($this->delivery_room->caption());

            // delivery_notes
            $this->delivery_notes->EditAttrs["class"] = "form-control";
            $this->delivery_notes->EditCustomAttributes = "";
            $this->delivery_notes->EditValue = HtmlEncode($this->delivery_notes->CurrentValue);
            $this->delivery_notes->PlaceHolder = RemoveHtml($this->delivery_notes->caption());

            // onsite_name
            $this->onsite_name->EditAttrs["class"] = "form-control";
            $this->onsite_name->EditCustomAttributes = "";
            if (!$this->onsite_name->Raw) {
                $this->onsite_name->CurrentValue = HtmlDecode($this->onsite_name->CurrentValue);
            }
            $this->onsite_name->EditValue = HtmlEncode($this->onsite_name->CurrentValue);
            $this->onsite_name->PlaceHolder = RemoveHtml($this->onsite_name->caption());

            // onsite_email
            $this->onsite_email->EditAttrs["class"] = "form-control";
            $this->onsite_email->EditCustomAttributes = "";
            if (!$this->onsite_email->Raw) {
                $this->onsite_email->CurrentValue = HtmlDecode($this->onsite_email->CurrentValue);
            }
            $this->onsite_email->EditValue = HtmlEncode($this->onsite_email->CurrentValue);
            $this->onsite_email->PlaceHolder = RemoveHtml($this->onsite_email->caption());

            // onsite_phone
            $this->onsite_phone->EditAttrs["class"] = "form-control";
            $this->onsite_phone->EditCustomAttributes = "";
            if (!$this->onsite_phone->Raw) {
                $this->onsite_phone->CurrentValue = HtmlDecode($this->onsite_phone->CurrentValue);
            }
            $this->onsite_phone->EditValue = HtmlEncode($this->onsite_phone->CurrentValue);
            $this->onsite_phone->PlaceHolder = RemoveHtml($this->onsite_phone->caption());

            // customer_name
            $this->customer_name->EditAttrs["class"] = "form-control";
            $this->customer_name->EditCustomAttributes = "";
            if (!$this->customer_name->Raw) {
                $this->customer_name->CurrentValue = HtmlDecode($this->customer_name->CurrentValue);
            }
            $this->customer_name->EditValue = HtmlEncode($this->customer_name->CurrentValue);
            $this->customer_name->PlaceHolder = RemoveHtml($this->customer_name->caption());

            // customer_phone
            $this->customer_phone->EditAttrs["class"] = "form-control";
            $this->customer_phone->EditCustomAttributes = "";
            if (!$this->customer_phone->Raw) {
                $this->customer_phone->CurrentValue = HtmlDecode($this->customer_phone->CurrentValue);
            }
            $this->customer_phone->EditValue = HtmlEncode($this->customer_phone->CurrentValue);
            $this->customer_phone->PlaceHolder = RemoveHtml($this->customer_phone->caption());

            // customer_email
            $this->customer_email->EditAttrs["class"] = "form-control";
            $this->customer_email->EditCustomAttributes = "";
            if (!$this->customer_email->Raw) {
                $this->customer_email->CurrentValue = HtmlDecode($this->customer_email->CurrentValue);
            }
            $this->customer_email->EditValue = HtmlEncode($this->customer_email->CurrentValue);
            $this->customer_email->PlaceHolder = RemoveHtml($this->customer_email->caption());

            // payment_method
            $this->payment_method->EditAttrs["class"] = "form-control";
            $this->payment_method->EditCustomAttributes = "";
            if (!$this->payment_method->Raw) {
                $this->payment_method->CurrentValue = HtmlDecode($this->payment_method->CurrentValue);
            }
            $this->payment_method->EditValue = HtmlEncode($this->payment_method->CurrentValue);
            $this->payment_method->PlaceHolder = RemoveHtml($this->payment_method->caption());

            // account_num
            $this->account_num->EditAttrs["class"] = "form-control";
            $this->account_num->EditCustomAttributes = "";
            if (!$this->account_num->Raw) {
                $this->account_num->CurrentValue = HtmlDecode($this->account_num->CurrentValue);
            }
            $this->account_num->EditValue = HtmlEncode($this->account_num->CurrentValue);
            $this->account_num->PlaceHolder = RemoveHtml($this->account_num->caption());

            // sub_code
            $this->sub_code->EditAttrs["class"] = "form-control";
            $this->sub_code->EditCustomAttributes = "";
            if (!$this->sub_code->Raw) {
                $this->sub_code->CurrentValue = HtmlDecode($this->sub_code->CurrentValue);
            }
            $this->sub_code->EditValue = HtmlEncode($this->sub_code->CurrentValue);
            $this->sub_code->PlaceHolder = RemoveHtml($this->sub_code->caption());

            // status
            $this->status->EditAttrs["class"] = "form-control";
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // order
            $this->order->EditAttrs["class"] = "form-control";
            $this->order->EditCustomAttributes = "";
            $this->order->EditValue = HtmlEncode($this->order->CurrentValue);
            $this->order->PlaceHolder = RemoveHtml($this->order->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // method
            $this->method->LinkCustomAttributes = "";
            $this->method->HrefValue = "";

            // delivery_date
            $this->delivery_date->LinkCustomAttributes = "";
            $this->delivery_date->HrefValue = "";

            // delivery_time
            $this->delivery_time->LinkCustomAttributes = "";
            $this->delivery_time->HrefValue = "";

            // delivery_building
            $this->delivery_building->LinkCustomAttributes = "";
            $this->delivery_building->HrefValue = "";

            // delivery_room
            $this->delivery_room->LinkCustomAttributes = "";
            $this->delivery_room->HrefValue = "";

            // delivery_notes
            $this->delivery_notes->LinkCustomAttributes = "";
            $this->delivery_notes->HrefValue = "";

            // onsite_name
            $this->onsite_name->LinkCustomAttributes = "";
            $this->onsite_name->HrefValue = "";

            // onsite_email
            $this->onsite_email->LinkCustomAttributes = "";
            $this->onsite_email->HrefValue = "";

            // onsite_phone
            $this->onsite_phone->LinkCustomAttributes = "";
            $this->onsite_phone->HrefValue = "";

            // customer_name
            $this->customer_name->LinkCustomAttributes = "";
            $this->customer_name->HrefValue = "";

            // customer_phone
            $this->customer_phone->LinkCustomAttributes = "";
            $this->customer_phone->HrefValue = "";

            // customer_email
            $this->customer_email->LinkCustomAttributes = "";
            $this->customer_email->HrefValue = "";

            // payment_method
            $this->payment_method->LinkCustomAttributes = "";
            $this->payment_method->HrefValue = "";

            // account_num
            $this->account_num->LinkCustomAttributes = "";
            $this->account_num->HrefValue = "";

            // sub_code
            $this->sub_code->LinkCustomAttributes = "";
            $this->sub_code->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // order
            $this->order->LinkCustomAttributes = "";
            $this->order->HrefValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
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
        if ($this->location->Required) {
            if (!$this->location->IsDetailKey && EmptyValue($this->location->FormValue)) {
                $this->location->addErrorMessage(str_replace("%s", $this->location->caption(), $this->location->RequiredErrorMessage));
            }
        }
        if ($this->method->Required) {
            if (!$this->method->IsDetailKey && EmptyValue($this->method->FormValue)) {
                $this->method->addErrorMessage(str_replace("%s", $this->method->caption(), $this->method->RequiredErrorMessage));
            }
        }
        if ($this->delivery_date->Required) {
            if (!$this->delivery_date->IsDetailKey && EmptyValue($this->delivery_date->FormValue)) {
                $this->delivery_date->addErrorMessage(str_replace("%s", $this->delivery_date->caption(), $this->delivery_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->delivery_date->FormValue)) {
            $this->delivery_date->addErrorMessage($this->delivery_date->getErrorMessage(false));
        }
        if ($this->delivery_time->Required) {
            if (!$this->delivery_time->IsDetailKey && EmptyValue($this->delivery_time->FormValue)) {
                $this->delivery_time->addErrorMessage(str_replace("%s", $this->delivery_time->caption(), $this->delivery_time->RequiredErrorMessage));
            }
        }
        if ($this->delivery_building->Required) {
            if (!$this->delivery_building->IsDetailKey && EmptyValue($this->delivery_building->FormValue)) {
                $this->delivery_building->addErrorMessage(str_replace("%s", $this->delivery_building->caption(), $this->delivery_building->RequiredErrorMessage));
            }
        }
        if ($this->delivery_room->Required) {
            if (!$this->delivery_room->IsDetailKey && EmptyValue($this->delivery_room->FormValue)) {
                $this->delivery_room->addErrorMessage(str_replace("%s", $this->delivery_room->caption(), $this->delivery_room->RequiredErrorMessage));
            }
        }
        if ($this->delivery_notes->Required) {
            if (!$this->delivery_notes->IsDetailKey && EmptyValue($this->delivery_notes->FormValue)) {
                $this->delivery_notes->addErrorMessage(str_replace("%s", $this->delivery_notes->caption(), $this->delivery_notes->RequiredErrorMessage));
            }
        }
        if ($this->onsite_name->Required) {
            if (!$this->onsite_name->IsDetailKey && EmptyValue($this->onsite_name->FormValue)) {
                $this->onsite_name->addErrorMessage(str_replace("%s", $this->onsite_name->caption(), $this->onsite_name->RequiredErrorMessage));
            }
        }
        if ($this->onsite_email->Required) {
            if (!$this->onsite_email->IsDetailKey && EmptyValue($this->onsite_email->FormValue)) {
                $this->onsite_email->addErrorMessage(str_replace("%s", $this->onsite_email->caption(), $this->onsite_email->RequiredErrorMessage));
            }
        }
        if ($this->onsite_phone->Required) {
            if (!$this->onsite_phone->IsDetailKey && EmptyValue($this->onsite_phone->FormValue)) {
                $this->onsite_phone->addErrorMessage(str_replace("%s", $this->onsite_phone->caption(), $this->onsite_phone->RequiredErrorMessage));
            }
        }
        if ($this->customer_name->Required) {
            if (!$this->customer_name->IsDetailKey && EmptyValue($this->customer_name->FormValue)) {
                $this->customer_name->addErrorMessage(str_replace("%s", $this->customer_name->caption(), $this->customer_name->RequiredErrorMessage));
            }
        }
        if ($this->customer_phone->Required) {
            if (!$this->customer_phone->IsDetailKey && EmptyValue($this->customer_phone->FormValue)) {
                $this->customer_phone->addErrorMessage(str_replace("%s", $this->customer_phone->caption(), $this->customer_phone->RequiredErrorMessage));
            }
        }
        if ($this->customer_email->Required) {
            if (!$this->customer_email->IsDetailKey && EmptyValue($this->customer_email->FormValue)) {
                $this->customer_email->addErrorMessage(str_replace("%s", $this->customer_email->caption(), $this->customer_email->RequiredErrorMessage));
            }
        }
        if ($this->payment_method->Required) {
            if (!$this->payment_method->IsDetailKey && EmptyValue($this->payment_method->FormValue)) {
                $this->payment_method->addErrorMessage(str_replace("%s", $this->payment_method->caption(), $this->payment_method->RequiredErrorMessage));
            }
        }
        if ($this->account_num->Required) {
            if (!$this->account_num->IsDetailKey && EmptyValue($this->account_num->FormValue)) {
                $this->account_num->addErrorMessage(str_replace("%s", $this->account_num->caption(), $this->account_num->RequiredErrorMessage));
            }
        }
        if ($this->sub_code->Required) {
            if (!$this->sub_code->IsDetailKey && EmptyValue($this->sub_code->FormValue)) {
                $this->sub_code->addErrorMessage(str_replace("%s", $this->sub_code->caption(), $this->sub_code->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->order->Required) {
            if (!$this->order->IsDetailKey && EmptyValue($this->order->FormValue)) {
                $this->order->addErrorMessage(str_replace("%s", $this->order->caption(), $this->order->RequiredErrorMessage));
            }
        }
        if ($this->timestamp->Required) {
            if (!$this->timestamp->IsDetailKey && EmptyValue($this->timestamp->FormValue)) {
                $this->timestamp->addErrorMessage(str_replace("%s", $this->timestamp->caption(), $this->timestamp->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->timestamp->FormValue)) {
            $this->timestamp->addErrorMessage($this->timestamp->getErrorMessage(false));
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

            // location
            $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, null, $this->location->ReadOnly);

            // method
            $this->method->setDbValueDef($rsnew, $this->method->CurrentValue, null, $this->method->ReadOnly);

            // delivery_date
            $this->delivery_date->setDbValueDef($rsnew, UnFormatDateTime($this->delivery_date->CurrentValue, 0), null, $this->delivery_date->ReadOnly);

            // delivery_time
            $this->delivery_time->setDbValueDef($rsnew, $this->delivery_time->CurrentValue, null, $this->delivery_time->ReadOnly);

            // delivery_building
            $this->delivery_building->setDbValueDef($rsnew, $this->delivery_building->CurrentValue, null, $this->delivery_building->ReadOnly);

            // delivery_room
            $this->delivery_room->setDbValueDef($rsnew, $this->delivery_room->CurrentValue, null, $this->delivery_room->ReadOnly);

            // delivery_notes
            $this->delivery_notes->setDbValueDef($rsnew, $this->delivery_notes->CurrentValue, null, $this->delivery_notes->ReadOnly);

            // onsite_name
            $this->onsite_name->setDbValueDef($rsnew, $this->onsite_name->CurrentValue, null, $this->onsite_name->ReadOnly);

            // onsite_email
            $this->onsite_email->setDbValueDef($rsnew, $this->onsite_email->CurrentValue, null, $this->onsite_email->ReadOnly);

            // onsite_phone
            $this->onsite_phone->setDbValueDef($rsnew, $this->onsite_phone->CurrentValue, null, $this->onsite_phone->ReadOnly);

            // customer_name
            $this->customer_name->setDbValueDef($rsnew, $this->customer_name->CurrentValue, null, $this->customer_name->ReadOnly);

            // customer_phone
            $this->customer_phone->setDbValueDef($rsnew, $this->customer_phone->CurrentValue, null, $this->customer_phone->ReadOnly);

            // customer_email
            $this->customer_email->setDbValueDef($rsnew, $this->customer_email->CurrentValue, null, $this->customer_email->ReadOnly);

            // payment_method
            $this->payment_method->setDbValueDef($rsnew, $this->payment_method->CurrentValue, null, $this->payment_method->ReadOnly);

            // account_num
            $this->account_num->setDbValueDef($rsnew, $this->account_num->CurrentValue, null, $this->account_num->ReadOnly);

            // sub_code
            $this->sub_code->setDbValueDef($rsnew, $this->sub_code->CurrentValue, null, $this->sub_code->ReadOnly);

            // status
            $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

            // order
            $this->order->setDbValueDef($rsnew, $this->order->CurrentValue, null, $this->order->ReadOnly);

            // timestamp
            $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, $this->timestamp->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CateringList"), "", $this->TableVar, true);
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
