<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class BoxMenuDelete extends BoxMenu
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'box_menu';

    // Page object name
    public $PageObjName = "BoxMenuDelete";

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

        // Table object (box_menu)
        if (!isset($GLOBALS["box_menu"]) || get_class($GLOBALS["box_menu"]) == PROJECT_NAMESPACE . "box_menu") {
            $GLOBALS["box_menu"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'box_menu');
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
                $doc = new $class(Container("box_menu"));
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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->date->setVisibility();
        $this->day->setVisibility();
        $this->breakfast_1->setVisibility();
        $this->breakfast_2->setVisibility();
        $this->breakfast_bag->setVisibility();
        $this->breakfast_bag2->setVisibility();
        $this->breakfast_beverage->setVisibility();
        $this->lunch_1->setVisibility();
        $this->lunch_2->setVisibility();
        $this->lunch_3->setVisibility();
        $this->lunch_bag->setVisibility();
        $this->lunch_bag2->setVisibility();
        $this->lunch_bag3->setVisibility();
        $this->lunch_beverage->setVisibility();
        $this->dinner_1->setVisibility();
        $this->dinner_2->setVisibility();
        $this->dinner_3->setVisibility();
        $this->dinner_bag->setVisibility();
        $this->dinner_bag2->setVisibility();
        $this->dinner_bag3->setVisibility();
        $this->dinner_beverage->setVisibility();
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("BoxMenuList"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("BoxMenuList"); // Return to list
                return;
            }
        }

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
        $this->date->setDbValue($row['date']);
        $this->day->setDbValue($row['day']);
        $this->breakfast_1->setDbValue($row['breakfast_1']);
        $this->breakfast_2->setDbValue($row['breakfast_2']);
        $this->breakfast_bag->setDbValue($row['breakfast_bag']);
        $this->breakfast_bag2->setDbValue($row['breakfast_bag2']);
        $this->breakfast_beverage->setDbValue($row['breakfast_beverage']);
        $this->lunch_1->setDbValue($row['lunch_1']);
        $this->lunch_2->setDbValue($row['lunch_2']);
        $this->lunch_3->setDbValue($row['lunch_3']);
        $this->lunch_bag->setDbValue($row['lunch_bag']);
        $this->lunch_bag2->setDbValue($row['lunch_bag2']);
        $this->lunch_bag3->setDbValue($row['lunch_bag3']);
        $this->lunch_beverage->setDbValue($row['lunch_beverage']);
        $this->dinner_1->setDbValue($row['dinner_1']);
        $this->dinner_2->setDbValue($row['dinner_2']);
        $this->dinner_3->setDbValue($row['dinner_3']);
        $this->dinner_bag->setDbValue($row['dinner_bag']);
        $this->dinner_bag2->setDbValue($row['dinner_bag2']);
        $this->dinner_bag3->setDbValue($row['dinner_bag3']);
        $this->dinner_beverage->setDbValue($row['dinner_beverage']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['date'] = null;
        $row['day'] = null;
        $row['breakfast_1'] = null;
        $row['breakfast_2'] = null;
        $row['breakfast_bag'] = null;
        $row['breakfast_bag2'] = null;
        $row['breakfast_beverage'] = null;
        $row['lunch_1'] = null;
        $row['lunch_2'] = null;
        $row['lunch_3'] = null;
        $row['lunch_bag'] = null;
        $row['lunch_bag2'] = null;
        $row['lunch_bag3'] = null;
        $row['lunch_beverage'] = null;
        $row['dinner_1'] = null;
        $row['dinner_2'] = null;
        $row['dinner_3'] = null;
        $row['dinner_bag'] = null;
        $row['dinner_bag2'] = null;
        $row['dinner_bag3'] = null;
        $row['dinner_beverage'] = null;
        return $row;
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

        // date

        // day

        // breakfast_1

        // breakfast_2

        // breakfast_bag

        // breakfast_bag2

        // breakfast_beverage

        // lunch_1

        // lunch_2

        // lunch_3

        // lunch_bag

        // lunch_bag2

        // lunch_bag3

        // lunch_beverage

        // dinner_1

        // dinner_2

        // dinner_3

        // dinner_bag

        // dinner_bag2

        // dinner_bag3

        // dinner_beverage
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // date
            $this->date->ViewValue = $this->date->CurrentValue;
            $this->date->ViewCustomAttributes = "";

            // day
            $this->day->ViewValue = $this->day->CurrentValue;
            $this->day->ViewCustomAttributes = "";

            // breakfast_1
            $this->breakfast_1->ViewValue = $this->breakfast_1->CurrentValue;
            $this->breakfast_1->ViewCustomAttributes = "";

            // breakfast_2
            $this->breakfast_2->ViewValue = $this->breakfast_2->CurrentValue;
            $this->breakfast_2->ViewCustomAttributes = "";

            // breakfast_bag
            $this->breakfast_bag->ViewValue = $this->breakfast_bag->CurrentValue;
            $this->breakfast_bag->ViewCustomAttributes = "";

            // breakfast_bag2
            $this->breakfast_bag2->ViewValue = $this->breakfast_bag2->CurrentValue;
            $this->breakfast_bag2->ViewCustomAttributes = "";

            // breakfast_beverage
            $this->breakfast_beverage->ViewValue = $this->breakfast_beverage->CurrentValue;
            $this->breakfast_beverage->ViewCustomAttributes = "";

            // lunch_1
            $this->lunch_1->ViewValue = $this->lunch_1->CurrentValue;
            $this->lunch_1->ViewCustomAttributes = "";

            // lunch_2
            $this->lunch_2->ViewValue = $this->lunch_2->CurrentValue;
            $this->lunch_2->ViewCustomAttributes = "";

            // lunch_3
            $this->lunch_3->ViewValue = $this->lunch_3->CurrentValue;
            $this->lunch_3->ViewCustomAttributes = "";

            // lunch_bag
            $this->lunch_bag->ViewValue = $this->lunch_bag->CurrentValue;
            $this->lunch_bag->ViewCustomAttributes = "";

            // lunch_bag2
            $this->lunch_bag2->ViewValue = $this->lunch_bag2->CurrentValue;
            $this->lunch_bag2->ViewCustomAttributes = "";

            // lunch_bag3
            $this->lunch_bag3->ViewValue = $this->lunch_bag3->CurrentValue;
            $this->lunch_bag3->ViewCustomAttributes = "";

            // lunch_beverage
            $this->lunch_beverage->ViewValue = $this->lunch_beverage->CurrentValue;
            $this->lunch_beverage->ViewCustomAttributes = "";

            // dinner_1
            $this->dinner_1->ViewValue = $this->dinner_1->CurrentValue;
            $this->dinner_1->ViewCustomAttributes = "";

            // dinner_2
            $this->dinner_2->ViewValue = $this->dinner_2->CurrentValue;
            $this->dinner_2->ViewCustomAttributes = "";

            // dinner_3
            $this->dinner_3->ViewValue = $this->dinner_3->CurrentValue;
            $this->dinner_3->ViewCustomAttributes = "";

            // dinner_bag
            $this->dinner_bag->ViewValue = $this->dinner_bag->CurrentValue;
            $this->dinner_bag->ViewCustomAttributes = "";

            // dinner_bag2
            $this->dinner_bag2->ViewValue = $this->dinner_bag2->CurrentValue;
            $this->dinner_bag2->ViewCustomAttributes = "";

            // dinner_bag3
            $this->dinner_bag3->ViewValue = $this->dinner_bag3->CurrentValue;
            $this->dinner_bag3->ViewCustomAttributes = "";

            // dinner_beverage
            $this->dinner_beverage->ViewValue = $this->dinner_beverage->CurrentValue;
            $this->dinner_beverage->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // date
            $this->date->LinkCustomAttributes = "";
            $this->date->HrefValue = "";
            $this->date->TooltipValue = "";

            // day
            $this->day->LinkCustomAttributes = "";
            $this->day->HrefValue = "";
            $this->day->TooltipValue = "";

            // breakfast_1
            $this->breakfast_1->LinkCustomAttributes = "";
            $this->breakfast_1->HrefValue = "";
            $this->breakfast_1->TooltipValue = "";

            // breakfast_2
            $this->breakfast_2->LinkCustomAttributes = "";
            $this->breakfast_2->HrefValue = "";
            $this->breakfast_2->TooltipValue = "";

            // breakfast_bag
            $this->breakfast_bag->LinkCustomAttributes = "";
            $this->breakfast_bag->HrefValue = "";
            $this->breakfast_bag->TooltipValue = "";

            // breakfast_bag2
            $this->breakfast_bag2->LinkCustomAttributes = "";
            $this->breakfast_bag2->HrefValue = "";
            $this->breakfast_bag2->TooltipValue = "";

            // breakfast_beverage
            $this->breakfast_beverage->LinkCustomAttributes = "";
            $this->breakfast_beverage->HrefValue = "";
            $this->breakfast_beverage->TooltipValue = "";

            // lunch_1
            $this->lunch_1->LinkCustomAttributes = "";
            $this->lunch_1->HrefValue = "";
            $this->lunch_1->TooltipValue = "";

            // lunch_2
            $this->lunch_2->LinkCustomAttributes = "";
            $this->lunch_2->HrefValue = "";
            $this->lunch_2->TooltipValue = "";

            // lunch_3
            $this->lunch_3->LinkCustomAttributes = "";
            $this->lunch_3->HrefValue = "";
            $this->lunch_3->TooltipValue = "";

            // lunch_bag
            $this->lunch_bag->LinkCustomAttributes = "";
            $this->lunch_bag->HrefValue = "";
            $this->lunch_bag->TooltipValue = "";

            // lunch_bag2
            $this->lunch_bag2->LinkCustomAttributes = "";
            $this->lunch_bag2->HrefValue = "";
            $this->lunch_bag2->TooltipValue = "";

            // lunch_bag3
            $this->lunch_bag3->LinkCustomAttributes = "";
            $this->lunch_bag3->HrefValue = "";
            $this->lunch_bag3->TooltipValue = "";

            // lunch_beverage
            $this->lunch_beverage->LinkCustomAttributes = "";
            $this->lunch_beverage->HrefValue = "";
            $this->lunch_beverage->TooltipValue = "";

            // dinner_1
            $this->dinner_1->LinkCustomAttributes = "";
            $this->dinner_1->HrefValue = "";
            $this->dinner_1->TooltipValue = "";

            // dinner_2
            $this->dinner_2->LinkCustomAttributes = "";
            $this->dinner_2->HrefValue = "";
            $this->dinner_2->TooltipValue = "";

            // dinner_3
            $this->dinner_3->LinkCustomAttributes = "";
            $this->dinner_3->HrefValue = "";
            $this->dinner_3->TooltipValue = "";

            // dinner_bag
            $this->dinner_bag->LinkCustomAttributes = "";
            $this->dinner_bag->HrefValue = "";
            $this->dinner_bag->TooltipValue = "";

            // dinner_bag2
            $this->dinner_bag2->LinkCustomAttributes = "";
            $this->dinner_bag2->HrefValue = "";
            $this->dinner_bag2->TooltipValue = "";

            // dinner_bag3
            $this->dinner_bag3->LinkCustomAttributes = "";
            $this->dinner_bag3->HrefValue = "";
            $this->dinner_bag3->TooltipValue = "";

            // dinner_beverage
            $this->dinner_beverage->LinkCustomAttributes = "";
            $this->dinner_beverage->HrefValue = "";
            $this->dinner_beverage->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        $conn->beginTransaction();

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['id'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }
        if ($deleteRows) {
            $conn->commit(); // Commit the changes
        } else {
            $conn->rollback(); // Rollback changes
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("BoxMenuList"), "", $this->TableVar, true);
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}
