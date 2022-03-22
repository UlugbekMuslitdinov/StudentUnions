<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RoomReservationEdit extends RoomReservation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'room_reservation';

    // Page object name
    public $PageObjName = "RoomReservationEdit";

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

        // Table object (room_reservation)
        if (!isset($GLOBALS["room_reservation"]) || get_class($GLOBALS["room_reservation"]) == PROJECT_NAMESPACE . "room_reservation") {
            $GLOBALS["room_reservation"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "RoomReservationView") {
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
                    $this->terminate("RoomReservationList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "RoomReservationList") {
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

        // Check field name 'contact_org' first before field var 'x_contact_org'
        $val = $CurrentForm->hasValue("contact_org") ? $CurrentForm->getValue("contact_org") : $CurrentForm->getValue("x_contact_org");
        if (!$this->contact_org->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_org->Visible = false; // Disable update for API request
            } else {
                $this->contact_org->setFormValue($val);
            }
        }

        // Check field name 'contact_name' first before field var 'x_contact_name'
        $val = $CurrentForm->hasValue("contact_name") ? $CurrentForm->getValue("contact_name") : $CurrentForm->getValue("x_contact_name");
        if (!$this->contact_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_name->Visible = false; // Disable update for API request
            } else {
                $this->contact_name->setFormValue($val);
            }
        }

        // Check field name 'contact_email' first before field var 'x_contact_email'
        $val = $CurrentForm->hasValue("contact_email") ? $CurrentForm->getValue("contact_email") : $CurrentForm->getValue("x_contact_email");
        if (!$this->contact_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_email->Visible = false; // Disable update for API request
            } else {
                $this->contact_email->setFormValue($val);
            }
        }

        // Check field name 'contact_phone' first before field var 'x_contact_phone'
        $val = $CurrentForm->hasValue("contact_phone") ? $CurrentForm->getValue("contact_phone") : $CurrentForm->getValue("x_contact_phone");
        if (!$this->contact_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_phone->Visible = false; // Disable update for API request
            } else {
                $this->contact_phone->setFormValue($val);
            }
        }

        // Check field name 'contact_fax' first before field var 'x_contact_fax'
        $val = $CurrentForm->hasValue("contact_fax") ? $CurrentForm->getValue("contact_fax") : $CurrentForm->getValue("x_contact_fax");
        if (!$this->contact_fax->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_fax->Visible = false; // Disable update for API request
            } else {
                $this->contact_fax->setFormValue($val);
            }
        }

        // Check field name 'contact_address' first before field var 'x_contact_address'
        $val = $CurrentForm->hasValue("contact_address") ? $CurrentForm->getValue("contact_address") : $CurrentForm->getValue("x_contact_address");
        if (!$this->contact_address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_address->Visible = false; // Disable update for API request
            } else {
                $this->contact_address->setFormValue($val);
            }
        }

        // Check field name 'contact_city' first before field var 'x_contact_city'
        $val = $CurrentForm->hasValue("contact_city") ? $CurrentForm->getValue("contact_city") : $CurrentForm->getValue("x_contact_city");
        if (!$this->contact_city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_city->Visible = false; // Disable update for API request
            } else {
                $this->contact_city->setFormValue($val);
            }
        }

        // Check field name 'contact_state' first before field var 'x_contact_state'
        $val = $CurrentForm->hasValue("contact_state") ? $CurrentForm->getValue("contact_state") : $CurrentForm->getValue("x_contact_state");
        if (!$this->contact_state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_state->Visible = false; // Disable update for API request
            } else {
                $this->contact_state->setFormValue($val);
            }
        }

        // Check field name 'contact_zip' first before field var 'x_contact_zip'
        $val = $CurrentForm->hasValue("contact_zip") ? $CurrentForm->getValue("contact_zip") : $CurrentForm->getValue("x_contact_zip");
        if (!$this->contact_zip->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_zip->Visible = false; // Disable update for API request
            } else {
                $this->contact_zip->setFormValue($val);
            }
        }

        // Check field name 'contact_advisor' first before field var 'x_contact_advisor'
        $val = $CurrentForm->hasValue("contact_advisor") ? $CurrentForm->getValue("contact_advisor") : $CurrentForm->getValue("x_contact_advisor");
        if (!$this->contact_advisor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_advisor->Visible = false; // Disable update for API request
            } else {
                $this->contact_advisor->setFormValue($val);
            }
        }

        // Check field name 'contact_advisor_phone' first before field var 'x_contact_advisor_phone'
        $val = $CurrentForm->hasValue("contact_advisor_phone") ? $CurrentForm->getValue("contact_advisor_phone") : $CurrentForm->getValue("x_contact_advisor_phone");
        if (!$this->contact_advisor_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_advisor_phone->Visible = false; // Disable update for API request
            } else {
                $this->contact_advisor_phone->setFormValue($val);
            }
        }

        // Check field name 'contact_advisor_email' first before field var 'x_contact_advisor_email'
        $val = $CurrentForm->hasValue("contact_advisor_email") ? $CurrentForm->getValue("contact_advisor_email") : $CurrentForm->getValue("x_contact_advisor_email");
        if (!$this->contact_advisor_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_advisor_email->Visible = false; // Disable update for API request
            } else {
                $this->contact_advisor_email->setFormValue($val);
            }
        }

        // Check field name 'billing_org' first before field var 'x_billing_org'
        $val = $CurrentForm->hasValue("billing_org") ? $CurrentForm->getValue("billing_org") : $CurrentForm->getValue("x_billing_org");
        if (!$this->billing_org->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_org->Visible = false; // Disable update for API request
            } else {
                $this->billing_org->setFormValue($val);
            }
        }

        // Check field name 'billing_name' first before field var 'x_billing_name'
        $val = $CurrentForm->hasValue("billing_name") ? $CurrentForm->getValue("billing_name") : $CurrentForm->getValue("x_billing_name");
        if (!$this->billing_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_name->Visible = false; // Disable update for API request
            } else {
                $this->billing_name->setFormValue($val);
            }
        }

        // Check field name 'billing_email' first before field var 'x_billing_email'
        $val = $CurrentForm->hasValue("billing_email") ? $CurrentForm->getValue("billing_email") : $CurrentForm->getValue("x_billing_email");
        if (!$this->billing_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_email->Visible = false; // Disable update for API request
            } else {
                $this->billing_email->setFormValue($val);
            }
        }

        // Check field name 'billing_phone' first before field var 'x_billing_phone'
        $val = $CurrentForm->hasValue("billing_phone") ? $CurrentForm->getValue("billing_phone") : $CurrentForm->getValue("x_billing_phone");
        if (!$this->billing_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_phone->Visible = false; // Disable update for API request
            } else {
                $this->billing_phone->setFormValue($val);
            }
        }

        // Check field name 'billing_fax' first before field var 'x_billing_fax'
        $val = $CurrentForm->hasValue("billing_fax") ? $CurrentForm->getValue("billing_fax") : $CurrentForm->getValue("x_billing_fax");
        if (!$this->billing_fax->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_fax->Visible = false; // Disable update for API request
            } else {
                $this->billing_fax->setFormValue($val);
            }
        }

        // Check field name 'billing_address' first before field var 'x_billing_address'
        $val = $CurrentForm->hasValue("billing_address") ? $CurrentForm->getValue("billing_address") : $CurrentForm->getValue("x_billing_address");
        if (!$this->billing_address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_address->Visible = false; // Disable update for API request
            } else {
                $this->billing_address->setFormValue($val);
            }
        }

        // Check field name 'billing_city' first before field var 'x_billing_city'
        $val = $CurrentForm->hasValue("billing_city") ? $CurrentForm->getValue("billing_city") : $CurrentForm->getValue("x_billing_city");
        if (!$this->billing_city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_city->Visible = false; // Disable update for API request
            } else {
                $this->billing_city->setFormValue($val);
            }
        }

        // Check field name 'billing_state' first before field var 'x_billing_state'
        $val = $CurrentForm->hasValue("billing_state") ? $CurrentForm->getValue("billing_state") : $CurrentForm->getValue("x_billing_state");
        if (!$this->billing_state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_state->Visible = false; // Disable update for API request
            } else {
                $this->billing_state->setFormValue($val);
            }
        }

        // Check field name 'billing_zip' first before field var 'x_billing_zip'
        $val = $CurrentForm->hasValue("billing_zip") ? $CurrentForm->getValue("billing_zip") : $CurrentForm->getValue("x_billing_zip");
        if (!$this->billing_zip->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_zip->Visible = false; // Disable update for API request
            } else {
                $this->billing_zip->setFormValue($val);
            }
        }

        // Check field name 'billing_method' first before field var 'x_billing_method'
        $val = $CurrentForm->hasValue("billing_method") ? $CurrentForm->getValue("billing_method") : $CurrentForm->getValue("x_billing_method");
        if (!$this->billing_method->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_method->Visible = false; // Disable update for API request
            } else {
                $this->billing_method->setFormValue($val);
            }
        }

        // Check field name 'billing_frs' first before field var 'x_billing_frs'
        $val = $CurrentForm->hasValue("billing_frs") ? $CurrentForm->getValue("billing_frs") : $CurrentForm->getValue("x_billing_frs");
        if (!$this->billing_frs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->billing_frs->Visible = false; // Disable update for API request
            } else {
                $this->billing_frs->setFormValue($val);
            }
        }

        // Check field name 'event_title' first before field var 'x_event_title'
        $val = $CurrentForm->hasValue("event_title") ? $CurrentForm->getValue("event_title") : $CurrentForm->getValue("x_event_title");
        if (!$this->event_title->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_title->Visible = false; // Disable update for API request
            } else {
                $this->event_title->setFormValue($val);
            }
        }

        // Check field name 'event_type' first before field var 'x_event_type'
        $val = $CurrentForm->hasValue("event_type") ? $CurrentForm->getValue("event_type") : $CurrentForm->getValue("x_event_type");
        if (!$this->event_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_type->Visible = false; // Disable update for API request
            } else {
                $this->event_type->setFormValue($val);
            }
        }

        // Check field name 'event_date' first before field var 'x_event_date'
        $val = $CurrentForm->hasValue("event_date") ? $CurrentForm->getValue("event_date") : $CurrentForm->getValue("x_event_date");
        if (!$this->event_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_date->Visible = false; // Disable update for API request
            } else {
                $this->event_date->setFormValue($val);
            }
            $this->event_date->CurrentValue = UnFormatDateTime($this->event_date->CurrentValue, 0);
        }

        // Check field name 'event_time_start' first before field var 'x_event_time_start'
        $val = $CurrentForm->hasValue("event_time_start") ? $CurrentForm->getValue("event_time_start") : $CurrentForm->getValue("x_event_time_start");
        if (!$this->event_time_start->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_time_start->Visible = false; // Disable update for API request
            } else {
                $this->event_time_start->setFormValue($val);
            }
        }

        // Check field name 'event_time_end' first before field var 'x_event_time_end'
        $val = $CurrentForm->hasValue("event_time_end") ? $CurrentForm->getValue("event_time_end") : $CurrentForm->getValue("x_event_time_end");
        if (!$this->event_time_end->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_time_end->Visible = false; // Disable update for API request
            } else {
                $this->event_time_end->setFormValue($val);
            }
        }

        // Check field name 'event_num_people' first before field var 'x_event_num_people'
        $val = $CurrentForm->hasValue("event_num_people") ? $CurrentForm->getValue("event_num_people") : $CurrentForm->getValue("x_event_num_people");
        if (!$this->event_num_people->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_num_people->Visible = false; // Disable update for API request
            } else {
                $this->event_num_people->setFormValue($val);
            }
        }

        // Check field name 'event_room_preference' first before field var 'x_event_room_preference'
        $val = $CurrentForm->hasValue("event_room_preference") ? $CurrentForm->getValue("event_room_preference") : $CurrentForm->getValue("x_event_room_preference");
        if (!$this->event_room_preference->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->event_room_preference->Visible = false; // Disable update for API request
            } else {
                $this->event_room_preference->setFormValue($val);
            }
        }

        // Check field name 'recurring_jan' first before field var 'x_recurring_jan'
        $val = $CurrentForm->hasValue("recurring_jan") ? $CurrentForm->getValue("recurring_jan") : $CurrentForm->getValue("x_recurring_jan");
        if (!$this->recurring_jan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_jan->Visible = false; // Disable update for API request
            } else {
                $this->recurring_jan->setFormValue($val);
            }
        }

        // Check field name 'recurring_feb' first before field var 'x_recurring_feb'
        $val = $CurrentForm->hasValue("recurring_feb") ? $CurrentForm->getValue("recurring_feb") : $CurrentForm->getValue("x_recurring_feb");
        if (!$this->recurring_feb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_feb->Visible = false; // Disable update for API request
            } else {
                $this->recurring_feb->setFormValue($val);
            }
        }

        // Check field name 'recurring_mar' first before field var 'x_recurring_mar'
        $val = $CurrentForm->hasValue("recurring_mar") ? $CurrentForm->getValue("recurring_mar") : $CurrentForm->getValue("x_recurring_mar");
        if (!$this->recurring_mar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_mar->Visible = false; // Disable update for API request
            } else {
                $this->recurring_mar->setFormValue($val);
            }
        }

        // Check field name 'recurring_apr' first before field var 'x_recurring_apr'
        $val = $CurrentForm->hasValue("recurring_apr") ? $CurrentForm->getValue("recurring_apr") : $CurrentForm->getValue("x_recurring_apr");
        if (!$this->recurring_apr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_apr->Visible = false; // Disable update for API request
            } else {
                $this->recurring_apr->setFormValue($val);
            }
        }

        // Check field name 'recurring_may' first before field var 'x_recurring_may'
        $val = $CurrentForm->hasValue("recurring_may") ? $CurrentForm->getValue("recurring_may") : $CurrentForm->getValue("x_recurring_may");
        if (!$this->recurring_may->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_may->Visible = false; // Disable update for API request
            } else {
                $this->recurring_may->setFormValue($val);
            }
        }

        // Check field name 'recurring_jun' first before field var 'x_recurring_jun'
        $val = $CurrentForm->hasValue("recurring_jun") ? $CurrentForm->getValue("recurring_jun") : $CurrentForm->getValue("x_recurring_jun");
        if (!$this->recurring_jun->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_jun->Visible = false; // Disable update for API request
            } else {
                $this->recurring_jun->setFormValue($val);
            }
        }

        // Check field name 'recurring_jul' first before field var 'x_recurring_jul'
        $val = $CurrentForm->hasValue("recurring_jul") ? $CurrentForm->getValue("recurring_jul") : $CurrentForm->getValue("x_recurring_jul");
        if (!$this->recurring_jul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_jul->Visible = false; // Disable update for API request
            } else {
                $this->recurring_jul->setFormValue($val);
            }
        }

        // Check field name 'recurring_aug' first before field var 'x_recurring_aug'
        $val = $CurrentForm->hasValue("recurring_aug") ? $CurrentForm->getValue("recurring_aug") : $CurrentForm->getValue("x_recurring_aug");
        if (!$this->recurring_aug->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_aug->Visible = false; // Disable update for API request
            } else {
                $this->recurring_aug->setFormValue($val);
            }
        }

        // Check field name 'recurring_sep' first before field var 'x_recurring_sep'
        $val = $CurrentForm->hasValue("recurring_sep") ? $CurrentForm->getValue("recurring_sep") : $CurrentForm->getValue("x_recurring_sep");
        if (!$this->recurring_sep->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_sep->Visible = false; // Disable update for API request
            } else {
                $this->recurring_sep->setFormValue($val);
            }
        }

        // Check field name 'recurring_oct' first before field var 'x_recurring_oct'
        $val = $CurrentForm->hasValue("recurring_oct") ? $CurrentForm->getValue("recurring_oct") : $CurrentForm->getValue("x_recurring_oct");
        if (!$this->recurring_oct->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_oct->Visible = false; // Disable update for API request
            } else {
                $this->recurring_oct->setFormValue($val);
            }
        }

        // Check field name 'recurring_nov' first before field var 'x_recurring_nov'
        $val = $CurrentForm->hasValue("recurring_nov") ? $CurrentForm->getValue("recurring_nov") : $CurrentForm->getValue("x_recurring_nov");
        if (!$this->recurring_nov->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_nov->Visible = false; // Disable update for API request
            } else {
                $this->recurring_nov->setFormValue($val);
            }
        }

        // Check field name 'recurring_dec' first before field var 'x_recurring_dec'
        $val = $CurrentForm->hasValue("recurring_dec") ? $CurrentForm->getValue("recurring_dec") : $CurrentForm->getValue("x_recurring_dec");
        if (!$this->recurring_dec->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->recurring_dec->Visible = false; // Disable update for API request
            } else {
                $this->recurring_dec->setFormValue($val);
            }
        }

        // Check field name 'setup_shape' first before field var 'x_setup_shape'
        $val = $CurrentForm->hasValue("setup_shape") ? $CurrentForm->getValue("setup_shape") : $CurrentForm->getValue("x_setup_shape");
        if (!$this->setup_shape->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->setup_shape->Visible = false; // Disable update for API request
            } else {
                $this->setup_shape->setFormValue($val);
            }
        }

        // Check field name 'certification_name' first before field var 'x_certification_name'
        $val = $CurrentForm->hasValue("certification_name") ? $CurrentForm->getValue("certification_name") : $CurrentForm->getValue("x_certification_name");
        if (!$this->certification_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->certification_name->Visible = false; // Disable update for API request
            } else {
                $this->certification_name->setFormValue($val);
            }
        }

        // Check field name 'certification_date' first before field var 'x_certification_date'
        $val = $CurrentForm->hasValue("certification_date") ? $CurrentForm->getValue("certification_date") : $CurrentForm->getValue("x_certification_date");
        if (!$this->certification_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->certification_date->Visible = false; // Disable update for API request
            } else {
                $this->certification_date->setFormValue($val);
            }
            $this->certification_date->CurrentValue = UnFormatDateTime($this->certification_date->CurrentValue, 0);
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
        $this->contact_org->CurrentValue = $this->contact_org->FormValue;
        $this->contact_name->CurrentValue = $this->contact_name->FormValue;
        $this->contact_email->CurrentValue = $this->contact_email->FormValue;
        $this->contact_phone->CurrentValue = $this->contact_phone->FormValue;
        $this->contact_fax->CurrentValue = $this->contact_fax->FormValue;
        $this->contact_address->CurrentValue = $this->contact_address->FormValue;
        $this->contact_city->CurrentValue = $this->contact_city->FormValue;
        $this->contact_state->CurrentValue = $this->contact_state->FormValue;
        $this->contact_zip->CurrentValue = $this->contact_zip->FormValue;
        $this->contact_advisor->CurrentValue = $this->contact_advisor->FormValue;
        $this->contact_advisor_phone->CurrentValue = $this->contact_advisor_phone->FormValue;
        $this->contact_advisor_email->CurrentValue = $this->contact_advisor_email->FormValue;
        $this->billing_org->CurrentValue = $this->billing_org->FormValue;
        $this->billing_name->CurrentValue = $this->billing_name->FormValue;
        $this->billing_email->CurrentValue = $this->billing_email->FormValue;
        $this->billing_phone->CurrentValue = $this->billing_phone->FormValue;
        $this->billing_fax->CurrentValue = $this->billing_fax->FormValue;
        $this->billing_address->CurrentValue = $this->billing_address->FormValue;
        $this->billing_city->CurrentValue = $this->billing_city->FormValue;
        $this->billing_state->CurrentValue = $this->billing_state->FormValue;
        $this->billing_zip->CurrentValue = $this->billing_zip->FormValue;
        $this->billing_method->CurrentValue = $this->billing_method->FormValue;
        $this->billing_frs->CurrentValue = $this->billing_frs->FormValue;
        $this->event_title->CurrentValue = $this->event_title->FormValue;
        $this->event_type->CurrentValue = $this->event_type->FormValue;
        $this->event_date->CurrentValue = $this->event_date->FormValue;
        $this->event_date->CurrentValue = UnFormatDateTime($this->event_date->CurrentValue, 0);
        $this->event_time_start->CurrentValue = $this->event_time_start->FormValue;
        $this->event_time_end->CurrentValue = $this->event_time_end->FormValue;
        $this->event_num_people->CurrentValue = $this->event_num_people->FormValue;
        $this->event_room_preference->CurrentValue = $this->event_room_preference->FormValue;
        $this->recurring_jan->CurrentValue = $this->recurring_jan->FormValue;
        $this->recurring_feb->CurrentValue = $this->recurring_feb->FormValue;
        $this->recurring_mar->CurrentValue = $this->recurring_mar->FormValue;
        $this->recurring_apr->CurrentValue = $this->recurring_apr->FormValue;
        $this->recurring_may->CurrentValue = $this->recurring_may->FormValue;
        $this->recurring_jun->CurrentValue = $this->recurring_jun->FormValue;
        $this->recurring_jul->CurrentValue = $this->recurring_jul->FormValue;
        $this->recurring_aug->CurrentValue = $this->recurring_aug->FormValue;
        $this->recurring_sep->CurrentValue = $this->recurring_sep->FormValue;
        $this->recurring_oct->CurrentValue = $this->recurring_oct->FormValue;
        $this->recurring_nov->CurrentValue = $this->recurring_nov->FormValue;
        $this->recurring_dec->CurrentValue = $this->recurring_dec->FormValue;
        $this->setup_shape->CurrentValue = $this->setup_shape->FormValue;
        $this->certification_name->CurrentValue = $this->certification_name->FormValue;
        $this->certification_date->CurrentValue = $this->certification_date->FormValue;
        $this->certification_date->CurrentValue = UnFormatDateTime($this->certification_date->CurrentValue, 0);
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // contact_org
            $this->contact_org->EditAttrs["class"] = "form-control";
            $this->contact_org->EditCustomAttributes = "";
            if (!$this->contact_org->Raw) {
                $this->contact_org->CurrentValue = HtmlDecode($this->contact_org->CurrentValue);
            }
            $this->contact_org->EditValue = HtmlEncode($this->contact_org->CurrentValue);
            $this->contact_org->PlaceHolder = RemoveHtml($this->contact_org->caption());

            // contact_name
            $this->contact_name->EditAttrs["class"] = "form-control";
            $this->contact_name->EditCustomAttributes = "";
            if (!$this->contact_name->Raw) {
                $this->contact_name->CurrentValue = HtmlDecode($this->contact_name->CurrentValue);
            }
            $this->contact_name->EditValue = HtmlEncode($this->contact_name->CurrentValue);
            $this->contact_name->PlaceHolder = RemoveHtml($this->contact_name->caption());

            // contact_email
            $this->contact_email->EditAttrs["class"] = "form-control";
            $this->contact_email->EditCustomAttributes = "";
            if (!$this->contact_email->Raw) {
                $this->contact_email->CurrentValue = HtmlDecode($this->contact_email->CurrentValue);
            }
            $this->contact_email->EditValue = HtmlEncode($this->contact_email->CurrentValue);
            $this->contact_email->PlaceHolder = RemoveHtml($this->contact_email->caption());

            // contact_phone
            $this->contact_phone->EditAttrs["class"] = "form-control";
            $this->contact_phone->EditCustomAttributes = "";
            if (!$this->contact_phone->Raw) {
                $this->contact_phone->CurrentValue = HtmlDecode($this->contact_phone->CurrentValue);
            }
            $this->contact_phone->EditValue = HtmlEncode($this->contact_phone->CurrentValue);
            $this->contact_phone->PlaceHolder = RemoveHtml($this->contact_phone->caption());

            // contact_fax
            $this->contact_fax->EditAttrs["class"] = "form-control";
            $this->contact_fax->EditCustomAttributes = "";
            if (!$this->contact_fax->Raw) {
                $this->contact_fax->CurrentValue = HtmlDecode($this->contact_fax->CurrentValue);
            }
            $this->contact_fax->EditValue = HtmlEncode($this->contact_fax->CurrentValue);
            $this->contact_fax->PlaceHolder = RemoveHtml($this->contact_fax->caption());

            // contact_address
            $this->contact_address->EditAttrs["class"] = "form-control";
            $this->contact_address->EditCustomAttributes = "";
            if (!$this->contact_address->Raw) {
                $this->contact_address->CurrentValue = HtmlDecode($this->contact_address->CurrentValue);
            }
            $this->contact_address->EditValue = HtmlEncode($this->contact_address->CurrentValue);
            $this->contact_address->PlaceHolder = RemoveHtml($this->contact_address->caption());

            // contact_city
            $this->contact_city->EditAttrs["class"] = "form-control";
            $this->contact_city->EditCustomAttributes = "";
            if (!$this->contact_city->Raw) {
                $this->contact_city->CurrentValue = HtmlDecode($this->contact_city->CurrentValue);
            }
            $this->contact_city->EditValue = HtmlEncode($this->contact_city->CurrentValue);
            $this->contact_city->PlaceHolder = RemoveHtml($this->contact_city->caption());

            // contact_state
            $this->contact_state->EditAttrs["class"] = "form-control";
            $this->contact_state->EditCustomAttributes = "";
            if (!$this->contact_state->Raw) {
                $this->contact_state->CurrentValue = HtmlDecode($this->contact_state->CurrentValue);
            }
            $this->contact_state->EditValue = HtmlEncode($this->contact_state->CurrentValue);
            $this->contact_state->PlaceHolder = RemoveHtml($this->contact_state->caption());

            // contact_zip
            $this->contact_zip->EditAttrs["class"] = "form-control";
            $this->contact_zip->EditCustomAttributes = "";
            if (!$this->contact_zip->Raw) {
                $this->contact_zip->CurrentValue = HtmlDecode($this->contact_zip->CurrentValue);
            }
            $this->contact_zip->EditValue = HtmlEncode($this->contact_zip->CurrentValue);
            $this->contact_zip->PlaceHolder = RemoveHtml($this->contact_zip->caption());

            // contact_advisor
            $this->contact_advisor->EditAttrs["class"] = "form-control";
            $this->contact_advisor->EditCustomAttributes = "";
            if (!$this->contact_advisor->Raw) {
                $this->contact_advisor->CurrentValue = HtmlDecode($this->contact_advisor->CurrentValue);
            }
            $this->contact_advisor->EditValue = HtmlEncode($this->contact_advisor->CurrentValue);
            $this->contact_advisor->PlaceHolder = RemoveHtml($this->contact_advisor->caption());

            // contact_advisor_phone
            $this->contact_advisor_phone->EditAttrs["class"] = "form-control";
            $this->contact_advisor_phone->EditCustomAttributes = "";
            if (!$this->contact_advisor_phone->Raw) {
                $this->contact_advisor_phone->CurrentValue = HtmlDecode($this->contact_advisor_phone->CurrentValue);
            }
            $this->contact_advisor_phone->EditValue = HtmlEncode($this->contact_advisor_phone->CurrentValue);
            $this->contact_advisor_phone->PlaceHolder = RemoveHtml($this->contact_advisor_phone->caption());

            // contact_advisor_email
            $this->contact_advisor_email->EditAttrs["class"] = "form-control";
            $this->contact_advisor_email->EditCustomAttributes = "";
            if (!$this->contact_advisor_email->Raw) {
                $this->contact_advisor_email->CurrentValue = HtmlDecode($this->contact_advisor_email->CurrentValue);
            }
            $this->contact_advisor_email->EditValue = HtmlEncode($this->contact_advisor_email->CurrentValue);
            $this->contact_advisor_email->PlaceHolder = RemoveHtml($this->contact_advisor_email->caption());

            // billing_org
            $this->billing_org->EditAttrs["class"] = "form-control";
            $this->billing_org->EditCustomAttributes = "";
            if (!$this->billing_org->Raw) {
                $this->billing_org->CurrentValue = HtmlDecode($this->billing_org->CurrentValue);
            }
            $this->billing_org->EditValue = HtmlEncode($this->billing_org->CurrentValue);
            $this->billing_org->PlaceHolder = RemoveHtml($this->billing_org->caption());

            // billing_name
            $this->billing_name->EditAttrs["class"] = "form-control";
            $this->billing_name->EditCustomAttributes = "";
            if (!$this->billing_name->Raw) {
                $this->billing_name->CurrentValue = HtmlDecode($this->billing_name->CurrentValue);
            }
            $this->billing_name->EditValue = HtmlEncode($this->billing_name->CurrentValue);
            $this->billing_name->PlaceHolder = RemoveHtml($this->billing_name->caption());

            // billing_email
            $this->billing_email->EditAttrs["class"] = "form-control";
            $this->billing_email->EditCustomAttributes = "";
            if (!$this->billing_email->Raw) {
                $this->billing_email->CurrentValue = HtmlDecode($this->billing_email->CurrentValue);
            }
            $this->billing_email->EditValue = HtmlEncode($this->billing_email->CurrentValue);
            $this->billing_email->PlaceHolder = RemoveHtml($this->billing_email->caption());

            // billing_phone
            $this->billing_phone->EditAttrs["class"] = "form-control";
            $this->billing_phone->EditCustomAttributes = "";
            if (!$this->billing_phone->Raw) {
                $this->billing_phone->CurrentValue = HtmlDecode($this->billing_phone->CurrentValue);
            }
            $this->billing_phone->EditValue = HtmlEncode($this->billing_phone->CurrentValue);
            $this->billing_phone->PlaceHolder = RemoveHtml($this->billing_phone->caption());

            // billing_fax
            $this->billing_fax->EditAttrs["class"] = "form-control";
            $this->billing_fax->EditCustomAttributes = "";
            if (!$this->billing_fax->Raw) {
                $this->billing_fax->CurrentValue = HtmlDecode($this->billing_fax->CurrentValue);
            }
            $this->billing_fax->EditValue = HtmlEncode($this->billing_fax->CurrentValue);
            $this->billing_fax->PlaceHolder = RemoveHtml($this->billing_fax->caption());

            // billing_address
            $this->billing_address->EditAttrs["class"] = "form-control";
            $this->billing_address->EditCustomAttributes = "";
            if (!$this->billing_address->Raw) {
                $this->billing_address->CurrentValue = HtmlDecode($this->billing_address->CurrentValue);
            }
            $this->billing_address->EditValue = HtmlEncode($this->billing_address->CurrentValue);
            $this->billing_address->PlaceHolder = RemoveHtml($this->billing_address->caption());

            // billing_city
            $this->billing_city->EditAttrs["class"] = "form-control";
            $this->billing_city->EditCustomAttributes = "";
            if (!$this->billing_city->Raw) {
                $this->billing_city->CurrentValue = HtmlDecode($this->billing_city->CurrentValue);
            }
            $this->billing_city->EditValue = HtmlEncode($this->billing_city->CurrentValue);
            $this->billing_city->PlaceHolder = RemoveHtml($this->billing_city->caption());

            // billing_state
            $this->billing_state->EditAttrs["class"] = "form-control";
            $this->billing_state->EditCustomAttributes = "";
            if (!$this->billing_state->Raw) {
                $this->billing_state->CurrentValue = HtmlDecode($this->billing_state->CurrentValue);
            }
            $this->billing_state->EditValue = HtmlEncode($this->billing_state->CurrentValue);
            $this->billing_state->PlaceHolder = RemoveHtml($this->billing_state->caption());

            // billing_zip
            $this->billing_zip->EditAttrs["class"] = "form-control";
            $this->billing_zip->EditCustomAttributes = "";
            if (!$this->billing_zip->Raw) {
                $this->billing_zip->CurrentValue = HtmlDecode($this->billing_zip->CurrentValue);
            }
            $this->billing_zip->EditValue = HtmlEncode($this->billing_zip->CurrentValue);
            $this->billing_zip->PlaceHolder = RemoveHtml($this->billing_zip->caption());

            // billing_method
            $this->billing_method->EditAttrs["class"] = "form-control";
            $this->billing_method->EditCustomAttributes = "";
            if (!$this->billing_method->Raw) {
                $this->billing_method->CurrentValue = HtmlDecode($this->billing_method->CurrentValue);
            }
            $this->billing_method->EditValue = HtmlEncode($this->billing_method->CurrentValue);
            $this->billing_method->PlaceHolder = RemoveHtml($this->billing_method->caption());

            // billing_frs
            $this->billing_frs->EditAttrs["class"] = "form-control";
            $this->billing_frs->EditCustomAttributes = "";
            if (!$this->billing_frs->Raw) {
                $this->billing_frs->CurrentValue = HtmlDecode($this->billing_frs->CurrentValue);
            }
            $this->billing_frs->EditValue = HtmlEncode($this->billing_frs->CurrentValue);
            $this->billing_frs->PlaceHolder = RemoveHtml($this->billing_frs->caption());

            // event_title
            $this->event_title->EditAttrs["class"] = "form-control";
            $this->event_title->EditCustomAttributes = "";
            if (!$this->event_title->Raw) {
                $this->event_title->CurrentValue = HtmlDecode($this->event_title->CurrentValue);
            }
            $this->event_title->EditValue = HtmlEncode($this->event_title->CurrentValue);
            $this->event_title->PlaceHolder = RemoveHtml($this->event_title->caption());

            // event_type
            $this->event_type->EditAttrs["class"] = "form-control";
            $this->event_type->EditCustomAttributes = "";
            if (!$this->event_type->Raw) {
                $this->event_type->CurrentValue = HtmlDecode($this->event_type->CurrentValue);
            }
            $this->event_type->EditValue = HtmlEncode($this->event_type->CurrentValue);
            $this->event_type->PlaceHolder = RemoveHtml($this->event_type->caption());

            // event_date
            $this->event_date->EditAttrs["class"] = "form-control";
            $this->event_date->EditCustomAttributes = "";
            $this->event_date->EditValue = HtmlEncode(FormatDateTime($this->event_date->CurrentValue, 8));
            $this->event_date->PlaceHolder = RemoveHtml($this->event_date->caption());

            // event_time_start
            $this->event_time_start->EditAttrs["class"] = "form-control";
            $this->event_time_start->EditCustomAttributes = "";
            if (!$this->event_time_start->Raw) {
                $this->event_time_start->CurrentValue = HtmlDecode($this->event_time_start->CurrentValue);
            }
            $this->event_time_start->EditValue = HtmlEncode($this->event_time_start->CurrentValue);
            $this->event_time_start->PlaceHolder = RemoveHtml($this->event_time_start->caption());

            // event_time_end
            $this->event_time_end->EditAttrs["class"] = "form-control";
            $this->event_time_end->EditCustomAttributes = "";
            if (!$this->event_time_end->Raw) {
                $this->event_time_end->CurrentValue = HtmlDecode($this->event_time_end->CurrentValue);
            }
            $this->event_time_end->EditValue = HtmlEncode($this->event_time_end->CurrentValue);
            $this->event_time_end->PlaceHolder = RemoveHtml($this->event_time_end->caption());

            // event_num_people
            $this->event_num_people->EditAttrs["class"] = "form-control";
            $this->event_num_people->EditCustomAttributes = "";
            $this->event_num_people->EditValue = HtmlEncode($this->event_num_people->CurrentValue);
            $this->event_num_people->PlaceHolder = RemoveHtml($this->event_num_people->caption());

            // event_room_preference
            $this->event_room_preference->EditAttrs["class"] = "form-control";
            $this->event_room_preference->EditCustomAttributes = "";
            if (!$this->event_room_preference->Raw) {
                $this->event_room_preference->CurrentValue = HtmlDecode($this->event_room_preference->CurrentValue);
            }
            $this->event_room_preference->EditValue = HtmlEncode($this->event_room_preference->CurrentValue);
            $this->event_room_preference->PlaceHolder = RemoveHtml($this->event_room_preference->caption());

            // recurring_jan
            $this->recurring_jan->EditAttrs["class"] = "form-control";
            $this->recurring_jan->EditCustomAttributes = "";
            if (!$this->recurring_jan->Raw) {
                $this->recurring_jan->CurrentValue = HtmlDecode($this->recurring_jan->CurrentValue);
            }
            $this->recurring_jan->EditValue = HtmlEncode($this->recurring_jan->CurrentValue);
            $this->recurring_jan->PlaceHolder = RemoveHtml($this->recurring_jan->caption());

            // recurring_feb
            $this->recurring_feb->EditAttrs["class"] = "form-control";
            $this->recurring_feb->EditCustomAttributes = "";
            if (!$this->recurring_feb->Raw) {
                $this->recurring_feb->CurrentValue = HtmlDecode($this->recurring_feb->CurrentValue);
            }
            $this->recurring_feb->EditValue = HtmlEncode($this->recurring_feb->CurrentValue);
            $this->recurring_feb->PlaceHolder = RemoveHtml($this->recurring_feb->caption());

            // recurring_mar
            $this->recurring_mar->EditAttrs["class"] = "form-control";
            $this->recurring_mar->EditCustomAttributes = "";
            if (!$this->recurring_mar->Raw) {
                $this->recurring_mar->CurrentValue = HtmlDecode($this->recurring_mar->CurrentValue);
            }
            $this->recurring_mar->EditValue = HtmlEncode($this->recurring_mar->CurrentValue);
            $this->recurring_mar->PlaceHolder = RemoveHtml($this->recurring_mar->caption());

            // recurring_apr
            $this->recurring_apr->EditAttrs["class"] = "form-control";
            $this->recurring_apr->EditCustomAttributes = "";
            if (!$this->recurring_apr->Raw) {
                $this->recurring_apr->CurrentValue = HtmlDecode($this->recurring_apr->CurrentValue);
            }
            $this->recurring_apr->EditValue = HtmlEncode($this->recurring_apr->CurrentValue);
            $this->recurring_apr->PlaceHolder = RemoveHtml($this->recurring_apr->caption());

            // recurring_may
            $this->recurring_may->EditAttrs["class"] = "form-control";
            $this->recurring_may->EditCustomAttributes = "";
            if (!$this->recurring_may->Raw) {
                $this->recurring_may->CurrentValue = HtmlDecode($this->recurring_may->CurrentValue);
            }
            $this->recurring_may->EditValue = HtmlEncode($this->recurring_may->CurrentValue);
            $this->recurring_may->PlaceHolder = RemoveHtml($this->recurring_may->caption());

            // recurring_jun
            $this->recurring_jun->EditAttrs["class"] = "form-control";
            $this->recurring_jun->EditCustomAttributes = "";
            if (!$this->recurring_jun->Raw) {
                $this->recurring_jun->CurrentValue = HtmlDecode($this->recurring_jun->CurrentValue);
            }
            $this->recurring_jun->EditValue = HtmlEncode($this->recurring_jun->CurrentValue);
            $this->recurring_jun->PlaceHolder = RemoveHtml($this->recurring_jun->caption());

            // recurring_jul
            $this->recurring_jul->EditAttrs["class"] = "form-control";
            $this->recurring_jul->EditCustomAttributes = "";
            if (!$this->recurring_jul->Raw) {
                $this->recurring_jul->CurrentValue = HtmlDecode($this->recurring_jul->CurrentValue);
            }
            $this->recurring_jul->EditValue = HtmlEncode($this->recurring_jul->CurrentValue);
            $this->recurring_jul->PlaceHolder = RemoveHtml($this->recurring_jul->caption());

            // recurring_aug
            $this->recurring_aug->EditAttrs["class"] = "form-control";
            $this->recurring_aug->EditCustomAttributes = "";
            if (!$this->recurring_aug->Raw) {
                $this->recurring_aug->CurrentValue = HtmlDecode($this->recurring_aug->CurrentValue);
            }
            $this->recurring_aug->EditValue = HtmlEncode($this->recurring_aug->CurrentValue);
            $this->recurring_aug->PlaceHolder = RemoveHtml($this->recurring_aug->caption());

            // recurring_sep
            $this->recurring_sep->EditAttrs["class"] = "form-control";
            $this->recurring_sep->EditCustomAttributes = "";
            if (!$this->recurring_sep->Raw) {
                $this->recurring_sep->CurrentValue = HtmlDecode($this->recurring_sep->CurrentValue);
            }
            $this->recurring_sep->EditValue = HtmlEncode($this->recurring_sep->CurrentValue);
            $this->recurring_sep->PlaceHolder = RemoveHtml($this->recurring_sep->caption());

            // recurring_oct
            $this->recurring_oct->EditAttrs["class"] = "form-control";
            $this->recurring_oct->EditCustomAttributes = "";
            if (!$this->recurring_oct->Raw) {
                $this->recurring_oct->CurrentValue = HtmlDecode($this->recurring_oct->CurrentValue);
            }
            $this->recurring_oct->EditValue = HtmlEncode($this->recurring_oct->CurrentValue);
            $this->recurring_oct->PlaceHolder = RemoveHtml($this->recurring_oct->caption());

            // recurring_nov
            $this->recurring_nov->EditAttrs["class"] = "form-control";
            $this->recurring_nov->EditCustomAttributes = "";
            if (!$this->recurring_nov->Raw) {
                $this->recurring_nov->CurrentValue = HtmlDecode($this->recurring_nov->CurrentValue);
            }
            $this->recurring_nov->EditValue = HtmlEncode($this->recurring_nov->CurrentValue);
            $this->recurring_nov->PlaceHolder = RemoveHtml($this->recurring_nov->caption());

            // recurring_dec
            $this->recurring_dec->EditAttrs["class"] = "form-control";
            $this->recurring_dec->EditCustomAttributes = "";
            if (!$this->recurring_dec->Raw) {
                $this->recurring_dec->CurrentValue = HtmlDecode($this->recurring_dec->CurrentValue);
            }
            $this->recurring_dec->EditValue = HtmlEncode($this->recurring_dec->CurrentValue);
            $this->recurring_dec->PlaceHolder = RemoveHtml($this->recurring_dec->caption());

            // setup_shape
            $this->setup_shape->EditAttrs["class"] = "form-control";
            $this->setup_shape->EditCustomAttributes = "";
            if (!$this->setup_shape->Raw) {
                $this->setup_shape->CurrentValue = HtmlDecode($this->setup_shape->CurrentValue);
            }
            $this->setup_shape->EditValue = HtmlEncode($this->setup_shape->CurrentValue);
            $this->setup_shape->PlaceHolder = RemoveHtml($this->setup_shape->caption());

            // certification_name
            $this->certification_name->EditAttrs["class"] = "form-control";
            $this->certification_name->EditCustomAttributes = "";
            if (!$this->certification_name->Raw) {
                $this->certification_name->CurrentValue = HtmlDecode($this->certification_name->CurrentValue);
            }
            $this->certification_name->EditValue = HtmlEncode($this->certification_name->CurrentValue);
            $this->certification_name->PlaceHolder = RemoveHtml($this->certification_name->caption());

            // certification_date
            $this->certification_date->EditAttrs["class"] = "form-control";
            $this->certification_date->EditCustomAttributes = "";
            $this->certification_date->EditValue = HtmlEncode(FormatDateTime($this->certification_date->CurrentValue, 8));
            $this->certification_date->PlaceHolder = RemoveHtml($this->certification_date->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // contact_org
            $this->contact_org->LinkCustomAttributes = "";
            $this->contact_org->HrefValue = "";

            // contact_name
            $this->contact_name->LinkCustomAttributes = "";
            $this->contact_name->HrefValue = "";

            // contact_email
            $this->contact_email->LinkCustomAttributes = "";
            $this->contact_email->HrefValue = "";

            // contact_phone
            $this->contact_phone->LinkCustomAttributes = "";
            $this->contact_phone->HrefValue = "";

            // contact_fax
            $this->contact_fax->LinkCustomAttributes = "";
            $this->contact_fax->HrefValue = "";

            // contact_address
            $this->contact_address->LinkCustomAttributes = "";
            $this->contact_address->HrefValue = "";

            // contact_city
            $this->contact_city->LinkCustomAttributes = "";
            $this->contact_city->HrefValue = "";

            // contact_state
            $this->contact_state->LinkCustomAttributes = "";
            $this->contact_state->HrefValue = "";

            // contact_zip
            $this->contact_zip->LinkCustomAttributes = "";
            $this->contact_zip->HrefValue = "";

            // contact_advisor
            $this->contact_advisor->LinkCustomAttributes = "";
            $this->contact_advisor->HrefValue = "";

            // contact_advisor_phone
            $this->contact_advisor_phone->LinkCustomAttributes = "";
            $this->contact_advisor_phone->HrefValue = "";

            // contact_advisor_email
            $this->contact_advisor_email->LinkCustomAttributes = "";
            $this->contact_advisor_email->HrefValue = "";

            // billing_org
            $this->billing_org->LinkCustomAttributes = "";
            $this->billing_org->HrefValue = "";

            // billing_name
            $this->billing_name->LinkCustomAttributes = "";
            $this->billing_name->HrefValue = "";

            // billing_email
            $this->billing_email->LinkCustomAttributes = "";
            $this->billing_email->HrefValue = "";

            // billing_phone
            $this->billing_phone->LinkCustomAttributes = "";
            $this->billing_phone->HrefValue = "";

            // billing_fax
            $this->billing_fax->LinkCustomAttributes = "";
            $this->billing_fax->HrefValue = "";

            // billing_address
            $this->billing_address->LinkCustomAttributes = "";
            $this->billing_address->HrefValue = "";

            // billing_city
            $this->billing_city->LinkCustomAttributes = "";
            $this->billing_city->HrefValue = "";

            // billing_state
            $this->billing_state->LinkCustomAttributes = "";
            $this->billing_state->HrefValue = "";

            // billing_zip
            $this->billing_zip->LinkCustomAttributes = "";
            $this->billing_zip->HrefValue = "";

            // billing_method
            $this->billing_method->LinkCustomAttributes = "";
            $this->billing_method->HrefValue = "";

            // billing_frs
            $this->billing_frs->LinkCustomAttributes = "";
            $this->billing_frs->HrefValue = "";

            // event_title
            $this->event_title->LinkCustomAttributes = "";
            $this->event_title->HrefValue = "";

            // event_type
            $this->event_type->LinkCustomAttributes = "";
            $this->event_type->HrefValue = "";

            // event_date
            $this->event_date->LinkCustomAttributes = "";
            $this->event_date->HrefValue = "";

            // event_time_start
            $this->event_time_start->LinkCustomAttributes = "";
            $this->event_time_start->HrefValue = "";

            // event_time_end
            $this->event_time_end->LinkCustomAttributes = "";
            $this->event_time_end->HrefValue = "";

            // event_num_people
            $this->event_num_people->LinkCustomAttributes = "";
            $this->event_num_people->HrefValue = "";

            // event_room_preference
            $this->event_room_preference->LinkCustomAttributes = "";
            $this->event_room_preference->HrefValue = "";

            // recurring_jan
            $this->recurring_jan->LinkCustomAttributes = "";
            $this->recurring_jan->HrefValue = "";

            // recurring_feb
            $this->recurring_feb->LinkCustomAttributes = "";
            $this->recurring_feb->HrefValue = "";

            // recurring_mar
            $this->recurring_mar->LinkCustomAttributes = "";
            $this->recurring_mar->HrefValue = "";

            // recurring_apr
            $this->recurring_apr->LinkCustomAttributes = "";
            $this->recurring_apr->HrefValue = "";

            // recurring_may
            $this->recurring_may->LinkCustomAttributes = "";
            $this->recurring_may->HrefValue = "";

            // recurring_jun
            $this->recurring_jun->LinkCustomAttributes = "";
            $this->recurring_jun->HrefValue = "";

            // recurring_jul
            $this->recurring_jul->LinkCustomAttributes = "";
            $this->recurring_jul->HrefValue = "";

            // recurring_aug
            $this->recurring_aug->LinkCustomAttributes = "";
            $this->recurring_aug->HrefValue = "";

            // recurring_sep
            $this->recurring_sep->LinkCustomAttributes = "";
            $this->recurring_sep->HrefValue = "";

            // recurring_oct
            $this->recurring_oct->LinkCustomAttributes = "";
            $this->recurring_oct->HrefValue = "";

            // recurring_nov
            $this->recurring_nov->LinkCustomAttributes = "";
            $this->recurring_nov->HrefValue = "";

            // recurring_dec
            $this->recurring_dec->LinkCustomAttributes = "";
            $this->recurring_dec->HrefValue = "";

            // setup_shape
            $this->setup_shape->LinkCustomAttributes = "";
            $this->setup_shape->HrefValue = "";

            // certification_name
            $this->certification_name->LinkCustomAttributes = "";
            $this->certification_name->HrefValue = "";

            // certification_date
            $this->certification_date->LinkCustomAttributes = "";
            $this->certification_date->HrefValue = "";

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
        if ($this->contact_org->Required) {
            if (!$this->contact_org->IsDetailKey && EmptyValue($this->contact_org->FormValue)) {
                $this->contact_org->addErrorMessage(str_replace("%s", $this->contact_org->caption(), $this->contact_org->RequiredErrorMessage));
            }
        }
        if ($this->contact_name->Required) {
            if (!$this->contact_name->IsDetailKey && EmptyValue($this->contact_name->FormValue)) {
                $this->contact_name->addErrorMessage(str_replace("%s", $this->contact_name->caption(), $this->contact_name->RequiredErrorMessage));
            }
        }
        if ($this->contact_email->Required) {
            if (!$this->contact_email->IsDetailKey && EmptyValue($this->contact_email->FormValue)) {
                $this->contact_email->addErrorMessage(str_replace("%s", $this->contact_email->caption(), $this->contact_email->RequiredErrorMessage));
            }
        }
        if ($this->contact_phone->Required) {
            if (!$this->contact_phone->IsDetailKey && EmptyValue($this->contact_phone->FormValue)) {
                $this->contact_phone->addErrorMessage(str_replace("%s", $this->contact_phone->caption(), $this->contact_phone->RequiredErrorMessage));
            }
        }
        if ($this->contact_fax->Required) {
            if (!$this->contact_fax->IsDetailKey && EmptyValue($this->contact_fax->FormValue)) {
                $this->contact_fax->addErrorMessage(str_replace("%s", $this->contact_fax->caption(), $this->contact_fax->RequiredErrorMessage));
            }
        }
        if ($this->contact_address->Required) {
            if (!$this->contact_address->IsDetailKey && EmptyValue($this->contact_address->FormValue)) {
                $this->contact_address->addErrorMessage(str_replace("%s", $this->contact_address->caption(), $this->contact_address->RequiredErrorMessage));
            }
        }
        if ($this->contact_city->Required) {
            if (!$this->contact_city->IsDetailKey && EmptyValue($this->contact_city->FormValue)) {
                $this->contact_city->addErrorMessage(str_replace("%s", $this->contact_city->caption(), $this->contact_city->RequiredErrorMessage));
            }
        }
        if ($this->contact_state->Required) {
            if (!$this->contact_state->IsDetailKey && EmptyValue($this->contact_state->FormValue)) {
                $this->contact_state->addErrorMessage(str_replace("%s", $this->contact_state->caption(), $this->contact_state->RequiredErrorMessage));
            }
        }
        if ($this->contact_zip->Required) {
            if (!$this->contact_zip->IsDetailKey && EmptyValue($this->contact_zip->FormValue)) {
                $this->contact_zip->addErrorMessage(str_replace("%s", $this->contact_zip->caption(), $this->contact_zip->RequiredErrorMessage));
            }
        }
        if ($this->contact_advisor->Required) {
            if (!$this->contact_advisor->IsDetailKey && EmptyValue($this->contact_advisor->FormValue)) {
                $this->contact_advisor->addErrorMessage(str_replace("%s", $this->contact_advisor->caption(), $this->contact_advisor->RequiredErrorMessage));
            }
        }
        if ($this->contact_advisor_phone->Required) {
            if (!$this->contact_advisor_phone->IsDetailKey && EmptyValue($this->contact_advisor_phone->FormValue)) {
                $this->contact_advisor_phone->addErrorMessage(str_replace("%s", $this->contact_advisor_phone->caption(), $this->contact_advisor_phone->RequiredErrorMessage));
            }
        }
        if ($this->contact_advisor_email->Required) {
            if (!$this->contact_advisor_email->IsDetailKey && EmptyValue($this->contact_advisor_email->FormValue)) {
                $this->contact_advisor_email->addErrorMessage(str_replace("%s", $this->contact_advisor_email->caption(), $this->contact_advisor_email->RequiredErrorMessage));
            }
        }
        if ($this->billing_org->Required) {
            if (!$this->billing_org->IsDetailKey && EmptyValue($this->billing_org->FormValue)) {
                $this->billing_org->addErrorMessage(str_replace("%s", $this->billing_org->caption(), $this->billing_org->RequiredErrorMessage));
            }
        }
        if ($this->billing_name->Required) {
            if (!$this->billing_name->IsDetailKey && EmptyValue($this->billing_name->FormValue)) {
                $this->billing_name->addErrorMessage(str_replace("%s", $this->billing_name->caption(), $this->billing_name->RequiredErrorMessage));
            }
        }
        if ($this->billing_email->Required) {
            if (!$this->billing_email->IsDetailKey && EmptyValue($this->billing_email->FormValue)) {
                $this->billing_email->addErrorMessage(str_replace("%s", $this->billing_email->caption(), $this->billing_email->RequiredErrorMessage));
            }
        }
        if ($this->billing_phone->Required) {
            if (!$this->billing_phone->IsDetailKey && EmptyValue($this->billing_phone->FormValue)) {
                $this->billing_phone->addErrorMessage(str_replace("%s", $this->billing_phone->caption(), $this->billing_phone->RequiredErrorMessage));
            }
        }
        if ($this->billing_fax->Required) {
            if (!$this->billing_fax->IsDetailKey && EmptyValue($this->billing_fax->FormValue)) {
                $this->billing_fax->addErrorMessage(str_replace("%s", $this->billing_fax->caption(), $this->billing_fax->RequiredErrorMessage));
            }
        }
        if ($this->billing_address->Required) {
            if (!$this->billing_address->IsDetailKey && EmptyValue($this->billing_address->FormValue)) {
                $this->billing_address->addErrorMessage(str_replace("%s", $this->billing_address->caption(), $this->billing_address->RequiredErrorMessage));
            }
        }
        if ($this->billing_city->Required) {
            if (!$this->billing_city->IsDetailKey && EmptyValue($this->billing_city->FormValue)) {
                $this->billing_city->addErrorMessage(str_replace("%s", $this->billing_city->caption(), $this->billing_city->RequiredErrorMessage));
            }
        }
        if ($this->billing_state->Required) {
            if (!$this->billing_state->IsDetailKey && EmptyValue($this->billing_state->FormValue)) {
                $this->billing_state->addErrorMessage(str_replace("%s", $this->billing_state->caption(), $this->billing_state->RequiredErrorMessage));
            }
        }
        if ($this->billing_zip->Required) {
            if (!$this->billing_zip->IsDetailKey && EmptyValue($this->billing_zip->FormValue)) {
                $this->billing_zip->addErrorMessage(str_replace("%s", $this->billing_zip->caption(), $this->billing_zip->RequiredErrorMessage));
            }
        }
        if ($this->billing_method->Required) {
            if (!$this->billing_method->IsDetailKey && EmptyValue($this->billing_method->FormValue)) {
                $this->billing_method->addErrorMessage(str_replace("%s", $this->billing_method->caption(), $this->billing_method->RequiredErrorMessage));
            }
        }
        if ($this->billing_frs->Required) {
            if (!$this->billing_frs->IsDetailKey && EmptyValue($this->billing_frs->FormValue)) {
                $this->billing_frs->addErrorMessage(str_replace("%s", $this->billing_frs->caption(), $this->billing_frs->RequiredErrorMessage));
            }
        }
        if ($this->event_title->Required) {
            if (!$this->event_title->IsDetailKey && EmptyValue($this->event_title->FormValue)) {
                $this->event_title->addErrorMessage(str_replace("%s", $this->event_title->caption(), $this->event_title->RequiredErrorMessage));
            }
        }
        if ($this->event_type->Required) {
            if (!$this->event_type->IsDetailKey && EmptyValue($this->event_type->FormValue)) {
                $this->event_type->addErrorMessage(str_replace("%s", $this->event_type->caption(), $this->event_type->RequiredErrorMessage));
            }
        }
        if ($this->event_date->Required) {
            if (!$this->event_date->IsDetailKey && EmptyValue($this->event_date->FormValue)) {
                $this->event_date->addErrorMessage(str_replace("%s", $this->event_date->caption(), $this->event_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->event_date->FormValue)) {
            $this->event_date->addErrorMessage($this->event_date->getErrorMessage(false));
        }
        if ($this->event_time_start->Required) {
            if (!$this->event_time_start->IsDetailKey && EmptyValue($this->event_time_start->FormValue)) {
                $this->event_time_start->addErrorMessage(str_replace("%s", $this->event_time_start->caption(), $this->event_time_start->RequiredErrorMessage));
            }
        }
        if ($this->event_time_end->Required) {
            if (!$this->event_time_end->IsDetailKey && EmptyValue($this->event_time_end->FormValue)) {
                $this->event_time_end->addErrorMessage(str_replace("%s", $this->event_time_end->caption(), $this->event_time_end->RequiredErrorMessage));
            }
        }
        if ($this->event_num_people->Required) {
            if (!$this->event_num_people->IsDetailKey && EmptyValue($this->event_num_people->FormValue)) {
                $this->event_num_people->addErrorMessage(str_replace("%s", $this->event_num_people->caption(), $this->event_num_people->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->event_num_people->FormValue)) {
            $this->event_num_people->addErrorMessage($this->event_num_people->getErrorMessage(false));
        }
        if ($this->event_room_preference->Required) {
            if (!$this->event_room_preference->IsDetailKey && EmptyValue($this->event_room_preference->FormValue)) {
                $this->event_room_preference->addErrorMessage(str_replace("%s", $this->event_room_preference->caption(), $this->event_room_preference->RequiredErrorMessage));
            }
        }
        if ($this->recurring_jan->Required) {
            if (!$this->recurring_jan->IsDetailKey && EmptyValue($this->recurring_jan->FormValue)) {
                $this->recurring_jan->addErrorMessage(str_replace("%s", $this->recurring_jan->caption(), $this->recurring_jan->RequiredErrorMessage));
            }
        }
        if ($this->recurring_feb->Required) {
            if (!$this->recurring_feb->IsDetailKey && EmptyValue($this->recurring_feb->FormValue)) {
                $this->recurring_feb->addErrorMessage(str_replace("%s", $this->recurring_feb->caption(), $this->recurring_feb->RequiredErrorMessage));
            }
        }
        if ($this->recurring_mar->Required) {
            if (!$this->recurring_mar->IsDetailKey && EmptyValue($this->recurring_mar->FormValue)) {
                $this->recurring_mar->addErrorMessage(str_replace("%s", $this->recurring_mar->caption(), $this->recurring_mar->RequiredErrorMessage));
            }
        }
        if ($this->recurring_apr->Required) {
            if (!$this->recurring_apr->IsDetailKey && EmptyValue($this->recurring_apr->FormValue)) {
                $this->recurring_apr->addErrorMessage(str_replace("%s", $this->recurring_apr->caption(), $this->recurring_apr->RequiredErrorMessage));
            }
        }
        if ($this->recurring_may->Required) {
            if (!$this->recurring_may->IsDetailKey && EmptyValue($this->recurring_may->FormValue)) {
                $this->recurring_may->addErrorMessage(str_replace("%s", $this->recurring_may->caption(), $this->recurring_may->RequiredErrorMessage));
            }
        }
        if ($this->recurring_jun->Required) {
            if (!$this->recurring_jun->IsDetailKey && EmptyValue($this->recurring_jun->FormValue)) {
                $this->recurring_jun->addErrorMessage(str_replace("%s", $this->recurring_jun->caption(), $this->recurring_jun->RequiredErrorMessage));
            }
        }
        if ($this->recurring_jul->Required) {
            if (!$this->recurring_jul->IsDetailKey && EmptyValue($this->recurring_jul->FormValue)) {
                $this->recurring_jul->addErrorMessage(str_replace("%s", $this->recurring_jul->caption(), $this->recurring_jul->RequiredErrorMessage));
            }
        }
        if ($this->recurring_aug->Required) {
            if (!$this->recurring_aug->IsDetailKey && EmptyValue($this->recurring_aug->FormValue)) {
                $this->recurring_aug->addErrorMessage(str_replace("%s", $this->recurring_aug->caption(), $this->recurring_aug->RequiredErrorMessage));
            }
        }
        if ($this->recurring_sep->Required) {
            if (!$this->recurring_sep->IsDetailKey && EmptyValue($this->recurring_sep->FormValue)) {
                $this->recurring_sep->addErrorMessage(str_replace("%s", $this->recurring_sep->caption(), $this->recurring_sep->RequiredErrorMessage));
            }
        }
        if ($this->recurring_oct->Required) {
            if (!$this->recurring_oct->IsDetailKey && EmptyValue($this->recurring_oct->FormValue)) {
                $this->recurring_oct->addErrorMessage(str_replace("%s", $this->recurring_oct->caption(), $this->recurring_oct->RequiredErrorMessage));
            }
        }
        if ($this->recurring_nov->Required) {
            if (!$this->recurring_nov->IsDetailKey && EmptyValue($this->recurring_nov->FormValue)) {
                $this->recurring_nov->addErrorMessage(str_replace("%s", $this->recurring_nov->caption(), $this->recurring_nov->RequiredErrorMessage));
            }
        }
        if ($this->recurring_dec->Required) {
            if (!$this->recurring_dec->IsDetailKey && EmptyValue($this->recurring_dec->FormValue)) {
                $this->recurring_dec->addErrorMessage(str_replace("%s", $this->recurring_dec->caption(), $this->recurring_dec->RequiredErrorMessage));
            }
        }
        if ($this->setup_shape->Required) {
            if (!$this->setup_shape->IsDetailKey && EmptyValue($this->setup_shape->FormValue)) {
                $this->setup_shape->addErrorMessage(str_replace("%s", $this->setup_shape->caption(), $this->setup_shape->RequiredErrorMessage));
            }
        }
        if ($this->certification_name->Required) {
            if (!$this->certification_name->IsDetailKey && EmptyValue($this->certification_name->FormValue)) {
                $this->certification_name->addErrorMessage(str_replace("%s", $this->certification_name->caption(), $this->certification_name->RequiredErrorMessage));
            }
        }
        if ($this->certification_date->Required) {
            if (!$this->certification_date->IsDetailKey && EmptyValue($this->certification_date->FormValue)) {
                $this->certification_date->addErrorMessage(str_replace("%s", $this->certification_date->caption(), $this->certification_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->certification_date->FormValue)) {
            $this->certification_date->addErrorMessage($this->certification_date->getErrorMessage(false));
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

            // contact_org
            $this->contact_org->setDbValueDef($rsnew, $this->contact_org->CurrentValue, null, $this->contact_org->ReadOnly);

            // contact_name
            $this->contact_name->setDbValueDef($rsnew, $this->contact_name->CurrentValue, "", $this->contact_name->ReadOnly);

            // contact_email
            $this->contact_email->setDbValueDef($rsnew, $this->contact_email->CurrentValue, "", $this->contact_email->ReadOnly);

            // contact_phone
            $this->contact_phone->setDbValueDef($rsnew, $this->contact_phone->CurrentValue, "", $this->contact_phone->ReadOnly);

            // contact_fax
            $this->contact_fax->setDbValueDef($rsnew, $this->contact_fax->CurrentValue, null, $this->contact_fax->ReadOnly);

            // contact_address
            $this->contact_address->setDbValueDef($rsnew, $this->contact_address->CurrentValue, null, $this->contact_address->ReadOnly);

            // contact_city
            $this->contact_city->setDbValueDef($rsnew, $this->contact_city->CurrentValue, null, $this->contact_city->ReadOnly);

            // contact_state
            $this->contact_state->setDbValueDef($rsnew, $this->contact_state->CurrentValue, null, $this->contact_state->ReadOnly);

            // contact_zip
            $this->contact_zip->setDbValueDef($rsnew, $this->contact_zip->CurrentValue, null, $this->contact_zip->ReadOnly);

            // contact_advisor
            $this->contact_advisor->setDbValueDef($rsnew, $this->contact_advisor->CurrentValue, null, $this->contact_advisor->ReadOnly);

            // contact_advisor_phone
            $this->contact_advisor_phone->setDbValueDef($rsnew, $this->contact_advisor_phone->CurrentValue, null, $this->contact_advisor_phone->ReadOnly);

            // contact_advisor_email
            $this->contact_advisor_email->setDbValueDef($rsnew, $this->contact_advisor_email->CurrentValue, null, $this->contact_advisor_email->ReadOnly);

            // billing_org
            $this->billing_org->setDbValueDef($rsnew, $this->billing_org->CurrentValue, null, $this->billing_org->ReadOnly);

            // billing_name
            $this->billing_name->setDbValueDef($rsnew, $this->billing_name->CurrentValue, "", $this->billing_name->ReadOnly);

            // billing_email
            $this->billing_email->setDbValueDef($rsnew, $this->billing_email->CurrentValue, "", $this->billing_email->ReadOnly);

            // billing_phone
            $this->billing_phone->setDbValueDef($rsnew, $this->billing_phone->CurrentValue, "", $this->billing_phone->ReadOnly);

            // billing_fax
            $this->billing_fax->setDbValueDef($rsnew, $this->billing_fax->CurrentValue, null, $this->billing_fax->ReadOnly);

            // billing_address
            $this->billing_address->setDbValueDef($rsnew, $this->billing_address->CurrentValue, null, $this->billing_address->ReadOnly);

            // billing_city
            $this->billing_city->setDbValueDef($rsnew, $this->billing_city->CurrentValue, null, $this->billing_city->ReadOnly);

            // billing_state
            $this->billing_state->setDbValueDef($rsnew, $this->billing_state->CurrentValue, null, $this->billing_state->ReadOnly);

            // billing_zip
            $this->billing_zip->setDbValueDef($rsnew, $this->billing_zip->CurrentValue, null, $this->billing_zip->ReadOnly);

            // billing_method
            $this->billing_method->setDbValueDef($rsnew, $this->billing_method->CurrentValue, "", $this->billing_method->ReadOnly);

            // billing_frs
            $this->billing_frs->setDbValueDef($rsnew, $this->billing_frs->CurrentValue, null, $this->billing_frs->ReadOnly);

            // event_title
            $this->event_title->setDbValueDef($rsnew, $this->event_title->CurrentValue, null, $this->event_title->ReadOnly);

            // event_type
            $this->event_type->setDbValueDef($rsnew, $this->event_type->CurrentValue, null, $this->event_type->ReadOnly);

            // event_date
            $this->event_date->setDbValueDef($rsnew, UnFormatDateTime($this->event_date->CurrentValue, 0), CurrentDate(), $this->event_date->ReadOnly);

            // event_time_start
            $this->event_time_start->setDbValueDef($rsnew, $this->event_time_start->CurrentValue, "", $this->event_time_start->ReadOnly);

            // event_time_end
            $this->event_time_end->setDbValueDef($rsnew, $this->event_time_end->CurrentValue, "", $this->event_time_end->ReadOnly);

            // event_num_people
            $this->event_num_people->setDbValueDef($rsnew, $this->event_num_people->CurrentValue, 0, $this->event_num_people->ReadOnly);

            // event_room_preference
            $this->event_room_preference->setDbValueDef($rsnew, $this->event_room_preference->CurrentValue, null, $this->event_room_preference->ReadOnly);

            // recurring_jan
            $this->recurring_jan->setDbValueDef($rsnew, $this->recurring_jan->CurrentValue, null, $this->recurring_jan->ReadOnly);

            // recurring_feb
            $this->recurring_feb->setDbValueDef($rsnew, $this->recurring_feb->CurrentValue, null, $this->recurring_feb->ReadOnly);

            // recurring_mar
            $this->recurring_mar->setDbValueDef($rsnew, $this->recurring_mar->CurrentValue, null, $this->recurring_mar->ReadOnly);

            // recurring_apr
            $this->recurring_apr->setDbValueDef($rsnew, $this->recurring_apr->CurrentValue, null, $this->recurring_apr->ReadOnly);

            // recurring_may
            $this->recurring_may->setDbValueDef($rsnew, $this->recurring_may->CurrentValue, null, $this->recurring_may->ReadOnly);

            // recurring_jun
            $this->recurring_jun->setDbValueDef($rsnew, $this->recurring_jun->CurrentValue, null, $this->recurring_jun->ReadOnly);

            // recurring_jul
            $this->recurring_jul->setDbValueDef($rsnew, $this->recurring_jul->CurrentValue, null, $this->recurring_jul->ReadOnly);

            // recurring_aug
            $this->recurring_aug->setDbValueDef($rsnew, $this->recurring_aug->CurrentValue, null, $this->recurring_aug->ReadOnly);

            // recurring_sep
            $this->recurring_sep->setDbValueDef($rsnew, $this->recurring_sep->CurrentValue, null, $this->recurring_sep->ReadOnly);

            // recurring_oct
            $this->recurring_oct->setDbValueDef($rsnew, $this->recurring_oct->CurrentValue, null, $this->recurring_oct->ReadOnly);

            // recurring_nov
            $this->recurring_nov->setDbValueDef($rsnew, $this->recurring_nov->CurrentValue, null, $this->recurring_nov->ReadOnly);

            // recurring_dec
            $this->recurring_dec->setDbValueDef($rsnew, $this->recurring_dec->CurrentValue, null, $this->recurring_dec->ReadOnly);

            // setup_shape
            $this->setup_shape->setDbValueDef($rsnew, $this->setup_shape->CurrentValue, null, $this->setup_shape->ReadOnly);

            // certification_name
            $this->certification_name->setDbValueDef($rsnew, $this->certification_name->CurrentValue, "", $this->certification_name->ReadOnly);

            // certification_date
            $this->certification_date->setDbValueDef($rsnew, UnFormatDateTime($this->certification_date->CurrentValue, 0), CurrentDate(), $this->certification_date->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("RoomReservationList"), "", $this->TableVar, true);
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
