<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PhoneRequestsDelete extends PhoneRequests
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'phone_requests';

    // Page object name
    public $PageObjName = "PhoneRequestsDelete";

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

        // Table object (phone_requests)
        if (!isset($GLOBALS["phone_requests"]) || get_class($GLOBALS["phone_requests"]) == PROJECT_NAMESPACE . "phone_requests") {
            $GLOBALS["phone_requests"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'phone_requests');
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
                $doc = new $class(Container("phone_requests"));
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
            $key .= @$ar['ID'];
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
            $this->ID->Visible = false;
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
        $this->supervisor_name->setVisibility();
        $this->supervisor_phone->setVisibility();
        $this->employee_status->setVisibility();
        $this->building->setVisibility();
        $this->room_number->setVisibility();
        $this->net_id->setVisibility();
        $this->jack->setVisibility();
        $this->jack_id->setVisibility();
        $this->voicemail->setVisibility();
        $this->long_distance->setVisibility();
        $this->need_phone->setVisibility();
        $this->call_appearance->setVisibility();
        $this->kfs_number->setVisibility();
        $this->call_appearance1->setVisibility();
        $this->call_appearance2->setVisibility();
        $this->call_appearance3->setVisibility();
        $this->call_appearance4->setVisibility();
        $this->timestamp->setVisibility();
        $this->ID->setVisibility();
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
            $this->terminate("PhoneRequestsList"); // Prevent SQL injection, return to list
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
                $this->terminate("PhoneRequestsList"); // Return to list
                return;
            }
        }

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
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_status->setDbValue($row['employee_status']);
        $this->building->setDbValue($row['building']);
        $this->room_number->setDbValue($row['room_number']);
        $this->net_id->setDbValue($row['net_id']);
        $this->jack->setDbValue($row['jack']);
        $this->jack_id->setDbValue($row['jack_id']);
        $this->voicemail->setDbValue($row['voicemail']);
        $this->long_distance->setDbValue($row['long_distance']);
        $this->need_phone->setDbValue($row['need_phone']);
        $this->call_appearance->setDbValue($row['call_appearance']);
        $this->kfs_number->setDbValue($row['kfs_number']);
        $this->call_appearance1->setDbValue($row['call_appearance1']);
        $this->call_appearance2->setDbValue($row['call_appearance2']);
        $this->call_appearance3->setDbValue($row['call_appearance3']);
        $this->call_appearance4->setDbValue($row['call_appearance4']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->ID->setDbValue($row['ID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['supervisor_name'] = null;
        $row['supervisor_phone'] = null;
        $row['employee_status'] = null;
        $row['building'] = null;
        $row['room_number'] = null;
        $row['net_id'] = null;
        $row['jack'] = null;
        $row['jack_id'] = null;
        $row['voicemail'] = null;
        $row['long_distance'] = null;
        $row['need_phone'] = null;
        $row['call_appearance'] = null;
        $row['kfs_number'] = null;
        $row['call_appearance1'] = null;
        $row['call_appearance2'] = null;
        $row['call_appearance3'] = null;
        $row['call_appearance4'] = null;
        $row['timestamp'] = null;
        $row['ID'] = null;
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

        // supervisor_name

        // supervisor_phone

        // employee_status

        // building

        // room_number

        // net_id

        // jack

        // jack_id

        // voicemail

        // long_distance

        // need_phone

        // call_appearance

        // kfs_number

        // call_appearance1

        // call_appearance2

        // call_appearance3

        // call_appearance4

        // timestamp

        // ID
        if ($this->RowType == ROWTYPE_VIEW) {
            // supervisor_name
            $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
            $this->supervisor_name->ViewCustomAttributes = "";

            // supervisor_phone
            $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
            $this->supervisor_phone->ViewCustomAttributes = "";

            // employee_status
            $this->employee_status->ViewValue = $this->employee_status->CurrentValue;
            $this->employee_status->ViewCustomAttributes = "";

            // building
            $this->building->ViewValue = $this->building->CurrentValue;
            $this->building->ViewCustomAttributes = "";

            // room_number
            $this->room_number->ViewValue = $this->room_number->CurrentValue;
            $this->room_number->ViewCustomAttributes = "";

            // net_id
            $this->net_id->ViewValue = $this->net_id->CurrentValue;
            $this->net_id->ViewCustomAttributes = "";

            // jack
            $this->jack->ViewValue = $this->jack->CurrentValue;
            $this->jack->ViewCustomAttributes = "";

            // jack_id
            $this->jack_id->ViewValue = $this->jack_id->CurrentValue;
            $this->jack_id->ViewCustomAttributes = "";

            // voicemail
            $this->voicemail->ViewValue = $this->voicemail->CurrentValue;
            $this->voicemail->ViewCustomAttributes = "";

            // long_distance
            $this->long_distance->ViewValue = $this->long_distance->CurrentValue;
            $this->long_distance->ViewCustomAttributes = "";

            // need_phone
            $this->need_phone->ViewValue = $this->need_phone->CurrentValue;
            $this->need_phone->ViewCustomAttributes = "";

            // call_appearance
            $this->call_appearance->ViewValue = $this->call_appearance->CurrentValue;
            $this->call_appearance->ViewCustomAttributes = "";

            // kfs_number
            $this->kfs_number->ViewValue = $this->kfs_number->CurrentValue;
            $this->kfs_number->ViewCustomAttributes = "";

            // call_appearance1
            $this->call_appearance1->ViewValue = $this->call_appearance1->CurrentValue;
            $this->call_appearance1->ViewCustomAttributes = "";

            // call_appearance2
            $this->call_appearance2->ViewValue = $this->call_appearance2->CurrentValue;
            $this->call_appearance2->ViewCustomAttributes = "";

            // call_appearance3
            $this->call_appearance3->ViewValue = $this->call_appearance3->CurrentValue;
            $this->call_appearance3->ViewCustomAttributes = "";

            // call_appearance4
            $this->call_appearance4->ViewValue = $this->call_appearance4->CurrentValue;
            $this->call_appearance4->ViewCustomAttributes = "";

            // timestamp
            $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
            $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
            $this->timestamp->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // supervisor_name
            $this->supervisor_name->LinkCustomAttributes = "";
            $this->supervisor_name->HrefValue = "";
            $this->supervisor_name->TooltipValue = "";

            // supervisor_phone
            $this->supervisor_phone->LinkCustomAttributes = "";
            $this->supervisor_phone->HrefValue = "";
            $this->supervisor_phone->TooltipValue = "";

            // employee_status
            $this->employee_status->LinkCustomAttributes = "";
            $this->employee_status->HrefValue = "";
            $this->employee_status->TooltipValue = "";

            // building
            $this->building->LinkCustomAttributes = "";
            $this->building->HrefValue = "";
            $this->building->TooltipValue = "";

            // room_number
            $this->room_number->LinkCustomAttributes = "";
            $this->room_number->HrefValue = "";
            $this->room_number->TooltipValue = "";

            // net_id
            $this->net_id->LinkCustomAttributes = "";
            $this->net_id->HrefValue = "";
            $this->net_id->TooltipValue = "";

            // jack
            $this->jack->LinkCustomAttributes = "";
            $this->jack->HrefValue = "";
            $this->jack->TooltipValue = "";

            // jack_id
            $this->jack_id->LinkCustomAttributes = "";
            $this->jack_id->HrefValue = "";
            $this->jack_id->TooltipValue = "";

            // voicemail
            $this->voicemail->LinkCustomAttributes = "";
            $this->voicemail->HrefValue = "";
            $this->voicemail->TooltipValue = "";

            // long_distance
            $this->long_distance->LinkCustomAttributes = "";
            $this->long_distance->HrefValue = "";
            $this->long_distance->TooltipValue = "";

            // need_phone
            $this->need_phone->LinkCustomAttributes = "";
            $this->need_phone->HrefValue = "";
            $this->need_phone->TooltipValue = "";

            // call_appearance
            $this->call_appearance->LinkCustomAttributes = "";
            $this->call_appearance->HrefValue = "";
            $this->call_appearance->TooltipValue = "";

            // kfs_number
            $this->kfs_number->LinkCustomAttributes = "";
            $this->kfs_number->HrefValue = "";
            $this->kfs_number->TooltipValue = "";

            // call_appearance1
            $this->call_appearance1->LinkCustomAttributes = "";
            $this->call_appearance1->HrefValue = "";
            $this->call_appearance1->TooltipValue = "";

            // call_appearance2
            $this->call_appearance2->LinkCustomAttributes = "";
            $this->call_appearance2->HrefValue = "";
            $this->call_appearance2->TooltipValue = "";

            // call_appearance3
            $this->call_appearance3->LinkCustomAttributes = "";
            $this->call_appearance3->HrefValue = "";
            $this->call_appearance3->TooltipValue = "";

            // call_appearance4
            $this->call_appearance4->LinkCustomAttributes = "";
            $this->call_appearance4->HrefValue = "";
            $this->call_appearance4->TooltipValue = "";

            // timestamp
            $this->timestamp->LinkCustomAttributes = "";
            $this->timestamp->HrefValue = "";
            $this->timestamp->TooltipValue = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
            $this->ID->TooltipValue = "";
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
                $thisKey .= $row['ID'];
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PhoneRequestsList"), "", $this->TableVar, true);
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
