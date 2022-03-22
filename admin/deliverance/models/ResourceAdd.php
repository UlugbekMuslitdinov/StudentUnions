<?php

namespace PHPMaker2021\project3;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class ResourceAdd extends Resource
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'resource';

    // Page object name
    public $PageObjName = "ResourceAdd";

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

        // Table object (resource)
        if (!isset($GLOBALS["resource"]) || get_class($GLOBALS["resource"]) == PROJECT_NAMESPACE . "resource") {
            $GLOBALS["resource"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'resource');
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
                $doc = new $class(Container("resource"));
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
                    if ($pageName == "ResourceView") {
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->id->Visible = false;
        $this->filePath->setVisibility();
        $this->fileSize->setVisibility();
        $this->dimensionsID->setVisibility();
        $this->type->setVisibility();
        $this->resourceName->setVisibility();
        $this->resourceLink->setVisibility();
        $this->headline->setVisibility();
        $this->subtext->setVisibility();
        $this->site->setVisibility();
        $this->altTxt->setVisibility();
        $this->description->setVisibility();
        $this->uploadDate->setVisibility();
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
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("ResourceList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "ResourceList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ResourceView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->filePath->CurrentValue = null;
        $this->filePath->OldValue = $this->filePath->CurrentValue;
        $this->fileSize->CurrentValue = null;
        $this->fileSize->OldValue = $this->fileSize->CurrentValue;
        $this->dimensionsID->CurrentValue = null;
        $this->dimensionsID->OldValue = $this->dimensionsID->CurrentValue;
        $this->type->CurrentValue = null;
        $this->type->OldValue = $this->type->CurrentValue;
        $this->resourceName->CurrentValue = null;
        $this->resourceName->OldValue = $this->resourceName->CurrentValue;
        $this->resourceLink->CurrentValue = null;
        $this->resourceLink->OldValue = $this->resourceLink->CurrentValue;
        $this->headline->CurrentValue = null;
        $this->headline->OldValue = $this->headline->CurrentValue;
        $this->subtext->CurrentValue = null;
        $this->subtext->OldValue = $this->subtext->CurrentValue;
        $this->site->CurrentValue = null;
        $this->site->OldValue = $this->site->CurrentValue;
        $this->altTxt->CurrentValue = null;
        $this->altTxt->OldValue = $this->altTxt->CurrentValue;
        $this->description->CurrentValue = null;
        $this->description->OldValue = $this->description->CurrentValue;
        $this->uploadDate->CurrentValue = null;
        $this->uploadDate->OldValue = $this->uploadDate->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'filePath' first before field var 'x_filePath'
        $val = $CurrentForm->hasValue("filePath") ? $CurrentForm->getValue("filePath") : $CurrentForm->getValue("x_filePath");
        if (!$this->filePath->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->filePath->Visible = false; // Disable update for API request
            } else {
                $this->filePath->setFormValue($val);
            }
        }

        // Check field name 'fileSize' first before field var 'x_fileSize'
        $val = $CurrentForm->hasValue("fileSize") ? $CurrentForm->getValue("fileSize") : $CurrentForm->getValue("x_fileSize");
        if (!$this->fileSize->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fileSize->Visible = false; // Disable update for API request
            } else {
                $this->fileSize->setFormValue($val);
            }
        }

        // Check field name 'dimensionsID' first before field var 'x_dimensionsID'
        $val = $CurrentForm->hasValue("dimensionsID") ? $CurrentForm->getValue("dimensionsID") : $CurrentForm->getValue("x_dimensionsID");
        if (!$this->dimensionsID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dimensionsID->Visible = false; // Disable update for API request
            } else {
                $this->dimensionsID->setFormValue($val);
            }
        }

        // Check field name 'type' first before field var 'x_type'
        $val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
        if (!$this->type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->type->Visible = false; // Disable update for API request
            } else {
                $this->type->setFormValue($val);
            }
        }

        // Check field name 'resourceName' first before field var 'x_resourceName'
        $val = $CurrentForm->hasValue("resourceName") ? $CurrentForm->getValue("resourceName") : $CurrentForm->getValue("x_resourceName");
        if (!$this->resourceName->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resourceName->Visible = false; // Disable update for API request
            } else {
                $this->resourceName->setFormValue($val);
            }
        }

        // Check field name 'resourceLink' first before field var 'x_resourceLink'
        $val = $CurrentForm->hasValue("resourceLink") ? $CurrentForm->getValue("resourceLink") : $CurrentForm->getValue("x_resourceLink");
        if (!$this->resourceLink->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resourceLink->Visible = false; // Disable update for API request
            } else {
                $this->resourceLink->setFormValue($val);
            }
        }

        // Check field name 'headline' first before field var 'x_headline'
        $val = $CurrentForm->hasValue("headline") ? $CurrentForm->getValue("headline") : $CurrentForm->getValue("x_headline");
        if (!$this->headline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->headline->Visible = false; // Disable update for API request
            } else {
                $this->headline->setFormValue($val);
            }
        }

        // Check field name 'subtext' first before field var 'x_subtext'
        $val = $CurrentForm->hasValue("subtext") ? $CurrentForm->getValue("subtext") : $CurrentForm->getValue("x_subtext");
        if (!$this->subtext->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subtext->Visible = false; // Disable update for API request
            } else {
                $this->subtext->setFormValue($val);
            }
        }

        // Check field name 'site' first before field var 'x_site'
        $val = $CurrentForm->hasValue("site") ? $CurrentForm->getValue("site") : $CurrentForm->getValue("x_site");
        if (!$this->site->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->site->Visible = false; // Disable update for API request
            } else {
                $this->site->setFormValue($val);
            }
        }

        // Check field name 'altTxt' first before field var 'x_altTxt'
        $val = $CurrentForm->hasValue("altTxt") ? $CurrentForm->getValue("altTxt") : $CurrentForm->getValue("x_altTxt");
        if (!$this->altTxt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->altTxt->Visible = false; // Disable update for API request
            } else {
                $this->altTxt->setFormValue($val);
            }
        }

        // Check field name 'description' first before field var 'x_description'
        $val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
        if (!$this->description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->description->Visible = false; // Disable update for API request
            } else {
                $this->description->setFormValue($val);
            }
        }

        // Check field name 'uploadDate' first before field var 'x_uploadDate'
        $val = $CurrentForm->hasValue("uploadDate") ? $CurrentForm->getValue("uploadDate") : $CurrentForm->getValue("x_uploadDate");
        if (!$this->uploadDate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->uploadDate->Visible = false; // Disable update for API request
            } else {
                $this->uploadDate->setFormValue($val);
            }
            $this->uploadDate->CurrentValue = UnFormatDateTime($this->uploadDate->CurrentValue, 0);
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->filePath->CurrentValue = $this->filePath->FormValue;
        $this->fileSize->CurrentValue = $this->fileSize->FormValue;
        $this->dimensionsID->CurrentValue = $this->dimensionsID->FormValue;
        $this->type->CurrentValue = $this->type->FormValue;
        $this->resourceName->CurrentValue = $this->resourceName->FormValue;
        $this->resourceLink->CurrentValue = $this->resourceLink->FormValue;
        $this->headline->CurrentValue = $this->headline->FormValue;
        $this->subtext->CurrentValue = $this->subtext->FormValue;
        $this->site->CurrentValue = $this->site->FormValue;
        $this->altTxt->CurrentValue = $this->altTxt->FormValue;
        $this->description->CurrentValue = $this->description->FormValue;
        $this->uploadDate->CurrentValue = $this->uploadDate->FormValue;
        $this->uploadDate->CurrentValue = UnFormatDateTime($this->uploadDate->CurrentValue, 0);
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
        $this->filePath->setDbValue($row['filePath']);
        $this->fileSize->setDbValue($row['fileSize']);
        $this->dimensionsID->setDbValue($row['dimensionsID']);
        $this->type->setDbValue($row['type']);
        $this->resourceName->setDbValue($row['resourceName']);
        $this->resourceLink->setDbValue($row['resourceLink']);
        $this->headline->setDbValue($row['headline']);
        $this->subtext->setDbValue($row['subtext']);
        $this->site->setDbValue($row['site']);
        $this->altTxt->setDbValue($row['altTxt']);
        $this->description->setDbValue($row['description']);
        $this->uploadDate->setDbValue($row['uploadDate']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['filePath'] = $this->filePath->CurrentValue;
        $row['fileSize'] = $this->fileSize->CurrentValue;
        $row['dimensionsID'] = $this->dimensionsID->CurrentValue;
        $row['type'] = $this->type->CurrentValue;
        $row['resourceName'] = $this->resourceName->CurrentValue;
        $row['resourceLink'] = $this->resourceLink->CurrentValue;
        $row['headline'] = $this->headline->CurrentValue;
        $row['subtext'] = $this->subtext->CurrentValue;
        $row['site'] = $this->site->CurrentValue;
        $row['altTxt'] = $this->altTxt->CurrentValue;
        $row['description'] = $this->description->CurrentValue;
        $row['uploadDate'] = $this->uploadDate->CurrentValue;
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

        // filePath

        // fileSize

        // dimensionsID

        // type

        // resourceName

        // resourceLink

        // headline

        // subtext

        // site

        // altTxt

        // description

        // uploadDate
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // filePath
            $this->filePath->ViewValue = $this->filePath->CurrentValue;
            $this->filePath->ViewCustomAttributes = "";

            // fileSize
            $this->fileSize->ViewValue = $this->fileSize->CurrentValue;
            $this->fileSize->ViewValue = FormatNumber($this->fileSize->ViewValue, 0, -2, -2, -2);
            $this->fileSize->ViewCustomAttributes = "";

            // dimensionsID
            $this->dimensionsID->ViewValue = $this->dimensionsID->CurrentValue;
            $this->dimensionsID->ViewValue = FormatNumber($this->dimensionsID->ViewValue, 0, -2, -2, -2);
            $this->dimensionsID->ViewCustomAttributes = "";

            // type
            if (strval($this->type->CurrentValue) != "") {
                $this->type->ViewValue = $this->type->optionCaption($this->type->CurrentValue);
            } else {
                $this->type->ViewValue = null;
            }
            $this->type->ViewCustomAttributes = "";

            // resourceName
            $this->resourceName->ViewValue = $this->resourceName->CurrentValue;
            $this->resourceName->ViewCustomAttributes = "";

            // resourceLink
            $this->resourceLink->ViewValue = $this->resourceLink->CurrentValue;
            $this->resourceLink->ViewCustomAttributes = "";

            // headline
            $this->headline->ViewValue = $this->headline->CurrentValue;
            $this->headline->ViewCustomAttributes = "";

            // subtext
            $this->subtext->ViewValue = $this->subtext->CurrentValue;
            $this->subtext->ViewCustomAttributes = "";

            // site
            if (strval($this->site->CurrentValue) != "") {
                $this->site->ViewValue = $this->site->optionCaption($this->site->CurrentValue);
            } else {
                $this->site->ViewValue = null;
            }
            $this->site->ViewCustomAttributes = "";

            // altTxt
            $this->altTxt->ViewValue = $this->altTxt->CurrentValue;
            $this->altTxt->ViewCustomAttributes = "";

            // description
            $this->description->ViewValue = $this->description->CurrentValue;
            $this->description->ViewCustomAttributes = "";

            // uploadDate
            $this->uploadDate->ViewValue = $this->uploadDate->CurrentValue;
            $this->uploadDate->ViewValue = FormatDateTime($this->uploadDate->ViewValue, 0);
            $this->uploadDate->ViewCustomAttributes = "";

            // filePath
            $this->filePath->LinkCustomAttributes = "";
            $this->filePath->HrefValue = "";
            $this->filePath->TooltipValue = "";

            // fileSize
            $this->fileSize->LinkCustomAttributes = "";
            $this->fileSize->HrefValue = "";
            $this->fileSize->TooltipValue = "";

            // dimensionsID
            $this->dimensionsID->LinkCustomAttributes = "";
            $this->dimensionsID->HrefValue = "";
            $this->dimensionsID->TooltipValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";
            $this->type->TooltipValue = "";

            // resourceName
            $this->resourceName->LinkCustomAttributes = "";
            $this->resourceName->HrefValue = "";
            $this->resourceName->TooltipValue = "";

            // resourceLink
            $this->resourceLink->LinkCustomAttributes = "";
            $this->resourceLink->HrefValue = "";
            $this->resourceLink->TooltipValue = "";

            // headline
            $this->headline->LinkCustomAttributes = "";
            $this->headline->HrefValue = "";
            $this->headline->TooltipValue = "";

            // subtext
            $this->subtext->LinkCustomAttributes = "";
            $this->subtext->HrefValue = "";
            $this->subtext->TooltipValue = "";

            // site
            $this->site->LinkCustomAttributes = "";
            $this->site->HrefValue = "";
            $this->site->TooltipValue = "";

            // altTxt
            $this->altTxt->LinkCustomAttributes = "";
            $this->altTxt->HrefValue = "";
            $this->altTxt->TooltipValue = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";
            $this->description->TooltipValue = "";

            // uploadDate
            $this->uploadDate->LinkCustomAttributes = "";
            $this->uploadDate->HrefValue = "";
            $this->uploadDate->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // filePath
            $this->filePath->EditAttrs["class"] = "form-control";
            $this->filePath->EditCustomAttributes = "";
            if (!$this->filePath->Raw) {
                $this->filePath->CurrentValue = HtmlDecode($this->filePath->CurrentValue);
            }
            $this->filePath->EditValue = HtmlEncode($this->filePath->CurrentValue);
            $this->filePath->PlaceHolder = RemoveHtml($this->filePath->caption());

            // fileSize
            $this->fileSize->EditAttrs["class"] = "form-control";
            $this->fileSize->EditCustomAttributes = "";
            $this->fileSize->EditValue = HtmlEncode($this->fileSize->CurrentValue);
            $this->fileSize->PlaceHolder = RemoveHtml($this->fileSize->caption());

            // dimensionsID
            $this->dimensionsID->EditAttrs["class"] = "form-control";
            $this->dimensionsID->EditCustomAttributes = "";
            $this->dimensionsID->EditValue = HtmlEncode($this->dimensionsID->CurrentValue);
            $this->dimensionsID->PlaceHolder = RemoveHtml($this->dimensionsID->caption());

            // type
            $this->type->EditCustomAttributes = "";
            $this->type->EditValue = $this->type->options(false);
            $this->type->PlaceHolder = RemoveHtml($this->type->caption());

            // resourceName
            $this->resourceName->EditAttrs["class"] = "form-control";
            $this->resourceName->EditCustomAttributes = "";
            if (!$this->resourceName->Raw) {
                $this->resourceName->CurrentValue = HtmlDecode($this->resourceName->CurrentValue);
            }
            $this->resourceName->EditValue = HtmlEncode($this->resourceName->CurrentValue);
            $this->resourceName->PlaceHolder = RemoveHtml($this->resourceName->caption());

            // resourceLink
            $this->resourceLink->EditAttrs["class"] = "form-control";
            $this->resourceLink->EditCustomAttributes = "";
            if (!$this->resourceLink->Raw) {
                $this->resourceLink->CurrentValue = HtmlDecode($this->resourceLink->CurrentValue);
            }
            $this->resourceLink->EditValue = HtmlEncode($this->resourceLink->CurrentValue);
            $this->resourceLink->PlaceHolder = RemoveHtml($this->resourceLink->caption());

            // headline
            $this->headline->EditAttrs["class"] = "form-control";
            $this->headline->EditCustomAttributes = "";
            if (!$this->headline->Raw) {
                $this->headline->CurrentValue = HtmlDecode($this->headline->CurrentValue);
            }
            $this->headline->EditValue = HtmlEncode($this->headline->CurrentValue);
            $this->headline->PlaceHolder = RemoveHtml($this->headline->caption());

            // subtext
            $this->subtext->EditAttrs["class"] = "form-control";
            $this->subtext->EditCustomAttributes = "";
            if (!$this->subtext->Raw) {
                $this->subtext->CurrentValue = HtmlDecode($this->subtext->CurrentValue);
            }
            $this->subtext->EditValue = HtmlEncode($this->subtext->CurrentValue);
            $this->subtext->PlaceHolder = RemoveHtml($this->subtext->caption());

            // site
            $this->site->EditCustomAttributes = "";
            $this->site->EditValue = $this->site->options(false);
            $this->site->PlaceHolder = RemoveHtml($this->site->caption());

            // altTxt
            $this->altTxt->EditAttrs["class"] = "form-control";
            $this->altTxt->EditCustomAttributes = "";
            if (!$this->altTxt->Raw) {
                $this->altTxt->CurrentValue = HtmlDecode($this->altTxt->CurrentValue);
            }
            $this->altTxt->EditValue = HtmlEncode($this->altTxt->CurrentValue);
            $this->altTxt->PlaceHolder = RemoveHtml($this->altTxt->caption());

            // description
            $this->description->EditAttrs["class"] = "form-control";
            $this->description->EditCustomAttributes = "";
            $this->description->EditValue = HtmlEncode($this->description->CurrentValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // uploadDate
            $this->uploadDate->EditAttrs["class"] = "form-control";
            $this->uploadDate->EditCustomAttributes = "";
            $this->uploadDate->EditValue = HtmlEncode(FormatDateTime($this->uploadDate->CurrentValue, 8));
            $this->uploadDate->PlaceHolder = RemoveHtml($this->uploadDate->caption());

            // Add refer script

            // filePath
            $this->filePath->LinkCustomAttributes = "";
            $this->filePath->HrefValue = "";

            // fileSize
            $this->fileSize->LinkCustomAttributes = "";
            $this->fileSize->HrefValue = "";

            // dimensionsID
            $this->dimensionsID->LinkCustomAttributes = "";
            $this->dimensionsID->HrefValue = "";

            // type
            $this->type->LinkCustomAttributes = "";
            $this->type->HrefValue = "";

            // resourceName
            $this->resourceName->LinkCustomAttributes = "";
            $this->resourceName->HrefValue = "";

            // resourceLink
            $this->resourceLink->LinkCustomAttributes = "";
            $this->resourceLink->HrefValue = "";

            // headline
            $this->headline->LinkCustomAttributes = "";
            $this->headline->HrefValue = "";

            // subtext
            $this->subtext->LinkCustomAttributes = "";
            $this->subtext->HrefValue = "";

            // site
            $this->site->LinkCustomAttributes = "";
            $this->site->HrefValue = "";

            // altTxt
            $this->altTxt->LinkCustomAttributes = "";
            $this->altTxt->HrefValue = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";

            // uploadDate
            $this->uploadDate->LinkCustomAttributes = "";
            $this->uploadDate->HrefValue = "";
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
        if ($this->filePath->Required) {
            if (!$this->filePath->IsDetailKey && EmptyValue($this->filePath->FormValue)) {
                $this->filePath->addErrorMessage(str_replace("%s", $this->filePath->caption(), $this->filePath->RequiredErrorMessage));
            }
        }
        if ($this->fileSize->Required) {
            if (!$this->fileSize->IsDetailKey && EmptyValue($this->fileSize->FormValue)) {
                $this->fileSize->addErrorMessage(str_replace("%s", $this->fileSize->caption(), $this->fileSize->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->fileSize->FormValue)) {
            $this->fileSize->addErrorMessage($this->fileSize->getErrorMessage(false));
        }
        if ($this->dimensionsID->Required) {
            if (!$this->dimensionsID->IsDetailKey && EmptyValue($this->dimensionsID->FormValue)) {
                $this->dimensionsID->addErrorMessage(str_replace("%s", $this->dimensionsID->caption(), $this->dimensionsID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->dimensionsID->FormValue)) {
            $this->dimensionsID->addErrorMessage($this->dimensionsID->getErrorMessage(false));
        }
        if ($this->type->Required) {
            if ($this->type->FormValue == "") {
                $this->type->addErrorMessage(str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
            }
        }
        if ($this->resourceName->Required) {
            if (!$this->resourceName->IsDetailKey && EmptyValue($this->resourceName->FormValue)) {
                $this->resourceName->addErrorMessage(str_replace("%s", $this->resourceName->caption(), $this->resourceName->RequiredErrorMessage));
            }
        }
        if ($this->resourceLink->Required) {
            if (!$this->resourceLink->IsDetailKey && EmptyValue($this->resourceLink->FormValue)) {
                $this->resourceLink->addErrorMessage(str_replace("%s", $this->resourceLink->caption(), $this->resourceLink->RequiredErrorMessage));
            }
        }
        if ($this->headline->Required) {
            if (!$this->headline->IsDetailKey && EmptyValue($this->headline->FormValue)) {
                $this->headline->addErrorMessage(str_replace("%s", $this->headline->caption(), $this->headline->RequiredErrorMessage));
            }
        }
        if ($this->subtext->Required) {
            if (!$this->subtext->IsDetailKey && EmptyValue($this->subtext->FormValue)) {
                $this->subtext->addErrorMessage(str_replace("%s", $this->subtext->caption(), $this->subtext->RequiredErrorMessage));
            }
        }
        if ($this->site->Required) {
            if ($this->site->FormValue == "") {
                $this->site->addErrorMessage(str_replace("%s", $this->site->caption(), $this->site->RequiredErrorMessage));
            }
        }
        if ($this->altTxt->Required) {
            if (!$this->altTxt->IsDetailKey && EmptyValue($this->altTxt->FormValue)) {
                $this->altTxt->addErrorMessage(str_replace("%s", $this->altTxt->caption(), $this->altTxt->RequiredErrorMessage));
            }
        }
        if ($this->description->Required) {
            if (!$this->description->IsDetailKey && EmptyValue($this->description->FormValue)) {
                $this->description->addErrorMessage(str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
            }
        }
        if ($this->uploadDate->Required) {
            if (!$this->uploadDate->IsDetailKey && EmptyValue($this->uploadDate->FormValue)) {
                $this->uploadDate->addErrorMessage(str_replace("%s", $this->uploadDate->caption(), $this->uploadDate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->uploadDate->FormValue)) {
            $this->uploadDate->addErrorMessage($this->uploadDate->getErrorMessage(false));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // filePath
        $this->filePath->setDbValueDef($rsnew, $this->filePath->CurrentValue, "", false);

        // fileSize
        $this->fileSize->setDbValueDef($rsnew, $this->fileSize->CurrentValue, 0, false);

        // dimensionsID
        $this->dimensionsID->setDbValueDef($rsnew, $this->dimensionsID->CurrentValue, 0, false);

        // type
        $this->type->setDbValueDef($rsnew, $this->type->CurrentValue, "", false);

        // resourceName
        $this->resourceName->setDbValueDef($rsnew, $this->resourceName->CurrentValue, "", false);

        // resourceLink
        $this->resourceLink->setDbValueDef($rsnew, $this->resourceLink->CurrentValue, null, false);

        // headline
        $this->headline->setDbValueDef($rsnew, $this->headline->CurrentValue, null, false);

        // subtext
        $this->subtext->setDbValueDef($rsnew, $this->subtext->CurrentValue, null, false);

        // site
        $this->site->setDbValueDef($rsnew, $this->site->CurrentValue, "", false);

        // altTxt
        $this->altTxt->setDbValueDef($rsnew, $this->altTxt->CurrentValue, "", false);

        // description
        $this->description->setDbValueDef($rsnew, $this->description->CurrentValue, null, false);

        // uploadDate
        $this->uploadDate->setDbValueDef($rsnew, UnFormatDateTime($this->uploadDate->CurrentValue, 0), CurrentDate(), false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ResourceList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_type":
                    break;
                case "x_site":
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
