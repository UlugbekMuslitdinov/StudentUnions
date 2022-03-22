<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class DepartmentalAccessRequestsEdit extends DepartmentalAccessRequests
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'departmental_access_requests';

    // Page object name
    public $PageObjName = "DepartmentalAccessRequestsEdit";

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

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (departmental_access_requests)
        if (!isset($GLOBALS["departmental_access_requests"]) || get_class($GLOBALS["departmental_access_requests"]) == PROJECT_NAMESPACE . "departmental_access_requests") {
            $GLOBALS["departmental_access_requests"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'departmental_access_requests');
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
                $doc = new $class(Container("departmental_access_requests"));
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
                    if ($pageName == "DepartmentalAccessRequestsView") {
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

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->supervisor_name->setVisibility();
        $this->supervisor_phone->setVisibility();
        $this->supervisor_email->setVisibility();
        $this->employee_first_name->setVisibility();
        $this->employee_last_name->setVisibility();
        $this->employee_netid->setVisibility();
        $this->new_catwork->setVisibility();
        $this->delete->setVisibility();
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
                    $this->terminate("DepartmentalAccessRequestsList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "DepartmentalAccessRequestsList") {
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
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
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

        // Check field name 'supervisor_name' first before field var 'x_supervisor_name'
        $val = $CurrentForm->hasValue("supervisor_name") ? $CurrentForm->getValue("supervisor_name") : $CurrentForm->getValue("x_supervisor_name");
        if (!$this->supervisor_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supervisor_name->Visible = false; // Disable update for API request
            } else {
                $this->supervisor_name->setFormValue($val);
            }
        }

        // Check field name 'supervisor_phone' first before field var 'x_supervisor_phone'
        $val = $CurrentForm->hasValue("supervisor_phone") ? $CurrentForm->getValue("supervisor_phone") : $CurrentForm->getValue("x_supervisor_phone");
        if (!$this->supervisor_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supervisor_phone->Visible = false; // Disable update for API request
            } else {
                $this->supervisor_phone->setFormValue($val);
            }
        }

        // Check field name 'supervisor_email' first before field var 'x_supervisor_email'
        $val = $CurrentForm->hasValue("supervisor_email") ? $CurrentForm->getValue("supervisor_email") : $CurrentForm->getValue("x_supervisor_email");
        if (!$this->supervisor_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supervisor_email->Visible = false; // Disable update for API request
            } else {
                $this->supervisor_email->setFormValue($val);
            }
        }

        // Check field name 'employee_first_name' first before field var 'x_employee_first_name'
        $val = $CurrentForm->hasValue("employee_first_name") ? $CurrentForm->getValue("employee_first_name") : $CurrentForm->getValue("x_employee_first_name");
        if (!$this->employee_first_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_first_name->Visible = false; // Disable update for API request
            } else {
                $this->employee_first_name->setFormValue($val);
            }
        }

        // Check field name 'employee_last_name' first before field var 'x_employee_last_name'
        $val = $CurrentForm->hasValue("employee_last_name") ? $CurrentForm->getValue("employee_last_name") : $CurrentForm->getValue("x_employee_last_name");
        if (!$this->employee_last_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_last_name->Visible = false; // Disable update for API request
            } else {
                $this->employee_last_name->setFormValue($val);
            }
        }

        // Check field name 'employee_netid' first before field var 'x_employee_netid'
        $val = $CurrentForm->hasValue("employee_netid") ? $CurrentForm->getValue("employee_netid") : $CurrentForm->getValue("x_employee_netid");
        if (!$this->employee_netid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_netid->Visible = false; // Disable update for API request
            } else {
                $this->employee_netid->setFormValue($val);
            }
        }

        // Check field name 'new_catwork' first before field var 'x_new_catwork'
        $val = $CurrentForm->hasValue("new_catwork") ? $CurrentForm->getValue("new_catwork") : $CurrentForm->getValue("x_new_catwork");
        if (!$this->new_catwork->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->new_catwork->Visible = false; // Disable update for API request
            } else {
                $this->new_catwork->setFormValue($val);
            }
        }

        // Check field name 'delete' first before field var 'x_delete'
        $val = $CurrentForm->hasValue("delete") ? $CurrentForm->getValue("delete") : $CurrentForm->getValue("x_delete");
        if (!$this->delete->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->delete->Visible = false; // Disable update for API request
            } else {
                $this->delete->setFormValue($val);
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
        $this->supervisor_name->CurrentValue = $this->supervisor_name->FormValue;
        $this->supervisor_phone->CurrentValue = $this->supervisor_phone->FormValue;
        $this->supervisor_email->CurrentValue = $this->supervisor_email->FormValue;
        $this->employee_first_name->CurrentValue = $this->employee_first_name->FormValue;
        $this->employee_last_name->CurrentValue = $this->employee_last_name->FormValue;
        $this->employee_netid->CurrentValue = $this->employee_netid->FormValue;
        $this->new_catwork->CurrentValue = $this->new_catwork->FormValue;
        $this->delete->CurrentValue = $this->delete->FormValue;
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
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->supervisor_email->setDbValue($row['supervisor_email']);
        $this->employee_first_name->setDbValue($row['employee_first_name']);
        $this->employee_last_name->setDbValue($row['employee_last_name']);
        $this->employee_netid->setDbValue($row['employee_netid']);
        $this->new_catwork->setDbValue($row['new_catwork']);
        $this->delete->setDbValue($row['delete']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['supervisor_name'] = null;
        $row['supervisor_phone'] = null;
        $row['supervisor_email'] = null;
        $row['employee_first_name'] = null;
        $row['employee_last_name'] = null;
        $row['employee_netid'] = null;
        $row['new_catwork'] = null;
        $row['delete'] = null;
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

        // supervisor_name

        // supervisor_phone

        // supervisor_email

        // employee_first_name

        // employee_last_name

        // employee_netid

        // new_catwork

        // delete

        // timestamp
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // supervisor_name
            $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
            $this->supervisor_name->ViewCustomAttributes = "";

            // supervisor_phone
            $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
            $this->supervisor_phone->ViewCustomAttributes = "";

            // supervisor_email
            $this->supervisor_email->ViewValue = $this->supervisor_email->CurrentValue;
            $this->supervisor_email->ViewCustomAttributes = "";

            // employee_first_name
            $this->employee_first_name->ViewValue = $this->employee_first_name->CurrentValue;
            $this->employee_first_name->ViewCustomAttributes = "";

            // employee_last_name
            $this->employee_last_name->ViewValue = $this->employee_last_name->CurrentValue;
            $this->employee_last_name->ViewCustomAttributes = "";

            // employee_netid
            $this->employee_netid->ViewValue = $this->employee_netid->CurrentValue;
            $this->employee_netid->ViewCustomAttributes = "";

            // new_catwork
            if (ConvertToBool($this->new_catwork->CurrentValue)) {
                $this->new_catwork->ViewValue = $this->new_catwork->tagCaption(1) != "" ? $this->new_catwork->tagCaption(1) : "Yes";
            } else {
                $this->new_catwork->ViewValue = $this->new_catwork->tagCaption(2) != "" ? $this->new_catwork->tagCaption(2) : "No";
            }
            $this->new_catwork->ViewCustomAttributes = "";

            // delete
            if (ConvertToBool($this->delete->CurrentValue)) {
                $this->delete->ViewValue = $this->delete->tagCaption(1) != "" ? $this->delete->tagCaption(1) : "Yes";
            } else {
                $this->delete->ViewValue = $this->delete->tagCaption(2) != "" ? $this->delete->tagCaption(2) : "No";
            }
            $this->delete->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";
            $this->supervisor_name->TooltipValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";
            $this->supervisor_phone->TooltipValue = "";

            // supervisor_email
            $this->supervisor_email->LinkCustomAttributes = "";
            $this->supervisor_email->HrefValue = "";
            $this->supervisor_email->TooltipValue = "";

            // employee_first_name
            $this->employee_first_name->LinkCustomAttributes = "";
            $this->employee_first_name->HrefValue = "";
            $this->employee_first_name->TooltipValue = "";

            // employee_last_name
            $this->employee_last_name->LinkCustomAttributes = "";
            $this->employee_last_name->HrefValue = "";
            $this->employee_last_name->TooltipValue = "";

            // employee_netid
            $this->employee_netid->LinkCustomAttributes = "";
            $this->employee_netid->HrefValue = "";
            $this->employee_netid->TooltipValue = "";

            // new_catwork
            $this->new_catwork->LinkCustomAttributes = "";
            $this->new_catwork->HrefValue = "";
            $this->new_catwork->TooltipValue = "";

            // delete
            $this->delete->LinkCustomAttributes = "";
            $this->delete->HrefValue = "";
            $this->delete->TooltipValue = "";

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

            // supervisor_name
            $this->supervisor_name->EditAttrs["class"] = "form-control";
            $this->supervisor_name->EditCustomAttributes = "";
            if (!$this->supervisor_name->Raw) {
                $this->supervisor_name->CurrentValue = HtmlDecode($this->supervisor_name->CurrentValue);
            }
            $this->supervisor_name->EditValue = HtmlEncode($this->supervisor_name->CurrentValue);
            $this->supervisor_name->PlaceHolder = RemoveHtml($this->supervisor_name->caption());

            // supervisor_phone
            $this->supervisor_phone->EditAttrs["class"] = "form-control";
            $this->supervisor_phone->EditCustomAttributes = "";
            if (!$this->supervisor_phone->Raw) {
                $this->supervisor_phone->CurrentValue = HtmlDecode($this->supervisor_phone->CurrentValue);
            }
            $this->supervisor_phone->EditValue = HtmlEncode($this->supervisor_phone->CurrentValue);
            $this->supervisor_phone->PlaceHolder = RemoveHtml($this->supervisor_phone->caption());

            // supervisor_email
            $this->supervisor_email->EditAttrs["class"] = "form-control";
            $this->supervisor_email->EditCustomAttributes = "";
            if (!$this->supervisor_email->Raw) {
                $this->supervisor_email->CurrentValue = HtmlDecode($this->supervisor_email->CurrentValue);
            }
            $this->supervisor_email->EditValue = HtmlEncode($this->supervisor_email->CurrentValue);
            $this->supervisor_email->PlaceHolder = RemoveHtml($this->supervisor_email->caption());

            // employee_first_name
            $this->employee_first_name->EditAttrs["class"] = "form-control";
            $this->employee_first_name->EditCustomAttributes = "";
            if (!$this->employee_first_name->Raw) {
                $this->employee_first_name->CurrentValue = HtmlDecode($this->employee_first_name->CurrentValue);
            }
            $this->employee_first_name->EditValue = HtmlEncode($this->employee_first_name->CurrentValue);
            $this->employee_first_name->PlaceHolder = RemoveHtml($this->employee_first_name->caption());

            // employee_last_name
            $this->employee_last_name->EditAttrs["class"] = "form-control";
            $this->employee_last_name->EditCustomAttributes = "";
            if (!$this->employee_last_name->Raw) {
                $this->employee_last_name->CurrentValue = HtmlDecode($this->employee_last_name->CurrentValue);
            }
            $this->employee_last_name->EditValue = HtmlEncode($this->employee_last_name->CurrentValue);
            $this->employee_last_name->PlaceHolder = RemoveHtml($this->employee_last_name->caption());

            // employee_netid
            $this->employee_netid->EditAttrs["class"] = "form-control";
            $this->employee_netid->EditCustomAttributes = "";
            if (!$this->employee_netid->Raw) {
                $this->employee_netid->CurrentValue = HtmlDecode($this->employee_netid->CurrentValue);
            }
            $this->employee_netid->EditValue = HtmlEncode($this->employee_netid->CurrentValue);
            $this->employee_netid->PlaceHolder = RemoveHtml($this->employee_netid->caption());

            // new_catwork
            $this->new_catwork->EditCustomAttributes = "";
            $this->new_catwork->EditValue = $this->new_catwork->options(false);
            $this->new_catwork->PlaceHolder = RemoveHtml($this->new_catwork->caption());

            // delete
            $this->delete->EditCustomAttributes = "";
            $this->delete->EditValue = $this->delete->options(false);
            $this->delete->PlaceHolder = RemoveHtml($this->delete->caption());

            // timestamp
            $this->timestamp->EditAttrs["class"] = "form-control";
            $this->timestamp->EditCustomAttributes = "";
            $this->timestamp->EditValue = HtmlEncode(FormatDateTime($this->timestamp->CurrentValue, 8));
            $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";

            // supervisor_email
            $this->supervisor_email->LinkCustomAttributes = "";
            $this->supervisor_email->HrefValue = "";

            // employee_first_name
            $this->employee_first_name->LinkCustomAttributes = "";
            $this->employee_first_name->HrefValue = "";

            // employee_last_name
            $this->employee_last_name->LinkCustomAttributes = "";
            $this->employee_last_name->HrefValue = "";

            // employee_netid
            $this->employee_netid->LinkCustomAttributes = "";
            $this->employee_netid->HrefValue = "";

            // new_catwork
            $this->new_catwork->LinkCustomAttributes = "";
            $this->new_catwork->HrefValue = "";

            // delete
            $this->delete->LinkCustomAttributes = "";
            $this->delete->HrefValue = "";

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
        if ($this->supervisor_name->Required) {
            if (!$this->supervisor_name->IsDetailKey && EmptyValue($this->supervisor_name->FormValue)) {
                $this->supervisor_name->addErrorMessage(str_replace("%s", $this->supervisor_name->caption(), $this->supervisor_name->RequiredErrorMessage));
            }
        }
        if ($this->supervisor_phone->Required) {
            if (!$this->supervisor_phone->IsDetailKey && EmptyValue($this->supervisor_phone->FormValue)) {
                $this->supervisor_phone->addErrorMessage(str_replace("%s", $this->supervisor_phone->caption(), $this->supervisor_phone->RequiredErrorMessage));
            }
        }
        if ($this->supervisor_email->Required) {
            if (!$this->supervisor_email->IsDetailKey && EmptyValue($this->supervisor_email->FormValue)) {
                $this->supervisor_email->addErrorMessage(str_replace("%s", $this->supervisor_email->caption(), $this->supervisor_email->RequiredErrorMessage));
            }
        }
        if ($this->employee_first_name->Required) {
            if (!$this->employee_first_name->IsDetailKey && EmptyValue($this->employee_first_name->FormValue)) {
                $this->employee_first_name->addErrorMessage(str_replace("%s", $this->employee_first_name->caption(), $this->employee_first_name->RequiredErrorMessage));
            }
        }
        if ($this->employee_last_name->Required) {
            if (!$this->employee_last_name->IsDetailKey && EmptyValue($this->employee_last_name->FormValue)) {
                $this->employee_last_name->addErrorMessage(str_replace("%s", $this->employee_last_name->caption(), $this->employee_last_name->RequiredErrorMessage));
            }
        }
        if ($this->employee_netid->Required) {
            if (!$this->employee_netid->IsDetailKey && EmptyValue($this->employee_netid->FormValue)) {
                $this->employee_netid->addErrorMessage(str_replace("%s", $this->employee_netid->caption(), $this->employee_netid->RequiredErrorMessage));
            }
        }
        if ($this->new_catwork->Required) {
            if ($this->new_catwork->FormValue == "") {
                $this->new_catwork->addErrorMessage(str_replace("%s", $this->new_catwork->caption(), $this->new_catwork->RequiredErrorMessage));
            }
        }
        if ($this->delete->Required) {
            if ($this->delete->FormValue == "") {
                $this->delete->addErrorMessage(str_replace("%s", $this->delete->caption(), $this->delete->RequiredErrorMessage));
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
        $editRow = false;
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // supervisor_name
            $this->supervisor_name->setDbValueDef($rsnew, $this->supervisor_name->CurrentValue, "", $this->supervisor_name->ReadOnly);

            // supervisor_phone
            $this->supervisor_phone->setDbValueDef($rsnew, $this->supervisor_phone->CurrentValue, "", $this->supervisor_phone->ReadOnly);

            // supervisor_email
            $this->supervisor_email->setDbValueDef($rsnew, $this->supervisor_email->CurrentValue, "", $this->supervisor_email->ReadOnly);

            // employee_first_name
            $this->employee_first_name->setDbValueDef($rsnew, $this->employee_first_name->CurrentValue, "", $this->employee_first_name->ReadOnly);

            // employee_last_name
            $this->employee_last_name->setDbValueDef($rsnew, $this->employee_last_name->CurrentValue, "", $this->employee_last_name->ReadOnly);

            // employee_netid
            $this->employee_netid->setDbValueDef($rsnew, $this->employee_netid->CurrentValue, "", $this->employee_netid->ReadOnly);

            // new_catwork
            $tmpBool = $this->new_catwork->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->new_catwork->setDbValueDef($rsnew, $tmpBool, null, $this->new_catwork->ReadOnly);

            // delete
            $tmpBool = $this->delete->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->delete->setDbValueDef($rsnew, $tmpBool, null, $this->delete->ReadOnly);

            // timestamp
            $this->timestamp->setDbValueDef($rsnew, UnFormatDateTime($this->timestamp->CurrentValue, 0), null, $this->timestamp->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    try {
                        $editRow = $this->update($rsnew, "", $rsold);
                    } catch (\Exception $e) {
                        $this->setFailureMessage($e->getMessage());
                    }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("DepartmentalAccessRequestsList"), "", $this->TableVar, true);
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
                case "x_new_catwork":
                    break;
                case "x_delete":
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
