<?php

namespace PHPMaker2021\project3;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for resource
 */
class Resource extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $filePath;
    public $fileSize;
    public $dimensionsID;
    public $type;
    public $resourceName;
    public $resourceLink;
    public $headline;
    public $subtext;
    public $site;
    public $altTxt;
    public $description;
    public $uploadDate;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'resource';
        $this->TableName = 'resource';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`resource`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField('resource', 'resource', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // filePath
        $this->filePath = new DbField('resource', 'resource', 'x_filePath', 'filePath', '`filePath`', '`filePath`', 200, 255, -1, false, '`filePath`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->filePath->Nullable = false; // NOT NULL field
        $this->filePath->Required = true; // Required field
        $this->filePath->Sortable = true; // Allow sort
        $this->Fields['filePath'] = &$this->filePath;

        // fileSize
        $this->fileSize = new DbField('resource', 'resource', 'x_fileSize', 'fileSize', '`fileSize`', '`fileSize`', 3, 11, -1, false, '`fileSize`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->fileSize->Nullable = false; // NOT NULL field
        $this->fileSize->Required = true; // Required field
        $this->fileSize->Sortable = true; // Allow sort
        $this->fileSize->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['fileSize'] = &$this->fileSize;

        // dimensionsID
        $this->dimensionsID = new DbField('resource', 'resource', 'x_dimensionsID', 'dimensionsID', '`dimensionsID`', '`dimensionsID`', 3, 11, -1, false, '`dimensionsID`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dimensionsID->Nullable = false; // NOT NULL field
        $this->dimensionsID->Required = true; // Required field
        $this->dimensionsID->Sortable = true; // Allow sort
        $this->dimensionsID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['dimensionsID'] = &$this->dimensionsID;

        // type
        $this->type = new DbField('resource', 'resource', 'x_type', 'type', '`type`', '`type`', 202, 3, -1, false, '`type`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->type->Nullable = false; // NOT NULL field
        $this->type->Required = true; // Required field
        $this->type->Sortable = true; // Allow sort
        $this->type->Lookup = new Lookup('type', 'resource', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->type->OptionCount = 7;
        $this->Fields['type'] = &$this->type;

        // resourceName
        $this->resourceName = new DbField('resource', 'resource', 'x_resourceName', 'resourceName', '`resourceName`', '`resourceName`', 200, 100, -1, false, '`resourceName`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->resourceName->Nullable = false; // NOT NULL field
        $this->resourceName->Required = true; // Required field
        $this->resourceName->Sortable = true; // Allow sort
        $this->Fields['resourceName'] = &$this->resourceName;

        // resourceLink
        $this->resourceLink = new DbField('resource', 'resource', 'x_resourceLink', 'resourceLink', '`resourceLink`', '`resourceLink`', 200, 100, -1, false, '`resourceLink`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->resourceLink->Sortable = true; // Allow sort
        $this->Fields['resourceLink'] = &$this->resourceLink;

        // headline
        $this->headline = new DbField('resource', 'resource', 'x_headline', 'headline', '`headline`', '`headline`', 200, 100, -1, false, '`headline`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->headline->Sortable = true; // Allow sort
        $this->Fields['headline'] = &$this->headline;

        // subtext
        $this->subtext = new DbField('resource', 'resource', 'x_subtext', 'subtext', '`subtext`', '`subtext`', 200, 100, -1, false, '`subtext`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->subtext->Sortable = true; // Allow sort
        $this->Fields['subtext'] = &$this->subtext;

        // site
        $this->site = new DbField('resource', 'resource', 'x_site', 'site', '`site`', '`site`', 202, 9, -1, false, '`site`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->site->Nullable = false; // NOT NULL field
        $this->site->Required = true; // Required field
        $this->site->Sortable = true; // Allow sort
        $this->site->Lookup = new Lookup('site', 'resource', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->site->OptionCount = 3;
        $this->Fields['site'] = &$this->site;

        // altTxt
        $this->altTxt = new DbField('resource', 'resource', 'x_altTxt', 'altTxt', '`altTxt`', '`altTxt`', 200, 100, -1, false, '`altTxt`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->altTxt->Nullable = false; // NOT NULL field
        $this->altTxt->Required = true; // Required field
        $this->altTxt->Sortable = true; // Allow sort
        $this->Fields['altTxt'] = &$this->altTxt;

        // description
        $this->description = new DbField('resource', 'resource', 'x_description', 'description', '`description`', '`description`', 201, 65535, -1, false, '`description`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->description->Sortable = true; // Allow sort
        $this->Fields['description'] = &$this->description;

        // uploadDate
        $this->uploadDate = new DbField('resource', 'resource', 'x_uploadDate', 'uploadDate', '`uploadDate`', CastDateFieldForLike("`uploadDate`", 0, "DB"), 133, 10, 0, false, '`uploadDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->uploadDate->Nullable = false; // NOT NULL field
        $this->uploadDate->Required = true; // Required field
        $this->uploadDate->Sortable = true; // Allow sort
        $this->uploadDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['uploadDate'] = &$this->uploadDate;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`resource`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sql = $sql->resetQueryPart("orderBy")->getSQL();
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->filePath->DbValue = $row['filePath'];
        $this->fileSize->DbValue = $row['fileSize'];
        $this->dimensionsID->DbValue = $row['dimensionsID'];
        $this->type->DbValue = $row['type'];
        $this->resourceName->DbValue = $row['resourceName'];
        $this->resourceLink->DbValue = $row['resourceLink'];
        $this->headline->DbValue = $row['headline'];
        $this->subtext->DbValue = $row['subtext'];
        $this->site->DbValue = $row['site'];
        $this->altTxt->DbValue = $row['altTxt'];
        $this->description->DbValue = $row['description'];
        $this->uploadDate->DbValue = $row['uploadDate'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if (ReferUrl() != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login") { // Referer not same page or login page
            $_SESSION[$name] = ReferUrl(); // Save to Session
        }
        if (@$_SESSION[$name] != "") {
            return $_SESSION[$name];
        } else {
            return GetUrl("ResourceList");
        }
    }

    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "ResourceView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ResourceEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ResourceAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "ResourceView";
            case Config("API_ADD_ACTION"):
                return "ResourceAdd";
            case Config("API_EDIT_ACTION"):
                return "ResourceEdit";
            case Config("API_DELETE_ACTION"):
                return "ResourceDelete";
            case Config("API_LIST_ACTION"):
                return "ResourceList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ResourceList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ResourceView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ResourceView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ResourceAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ResourceAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ResourceEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("ResourceAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("ResourceDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

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

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // filePath
        $this->filePath->EditAttrs["class"] = "form-control";
        $this->filePath->EditCustomAttributes = "";
        if (!$this->filePath->Raw) {
            $this->filePath->CurrentValue = HtmlDecode($this->filePath->CurrentValue);
        }
        $this->filePath->EditValue = $this->filePath->CurrentValue;
        $this->filePath->PlaceHolder = RemoveHtml($this->filePath->caption());

        // fileSize
        $this->fileSize->EditAttrs["class"] = "form-control";
        $this->fileSize->EditCustomAttributes = "";
        $this->fileSize->EditValue = $this->fileSize->CurrentValue;
        $this->fileSize->PlaceHolder = RemoveHtml($this->fileSize->caption());

        // dimensionsID
        $this->dimensionsID->EditAttrs["class"] = "form-control";
        $this->dimensionsID->EditCustomAttributes = "";
        $this->dimensionsID->EditValue = $this->dimensionsID->CurrentValue;
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
        $this->resourceName->EditValue = $this->resourceName->CurrentValue;
        $this->resourceName->PlaceHolder = RemoveHtml($this->resourceName->caption());

        // resourceLink
        $this->resourceLink->EditAttrs["class"] = "form-control";
        $this->resourceLink->EditCustomAttributes = "";
        if (!$this->resourceLink->Raw) {
            $this->resourceLink->CurrentValue = HtmlDecode($this->resourceLink->CurrentValue);
        }
        $this->resourceLink->EditValue = $this->resourceLink->CurrentValue;
        $this->resourceLink->PlaceHolder = RemoveHtml($this->resourceLink->caption());

        // headline
        $this->headline->EditAttrs["class"] = "form-control";
        $this->headline->EditCustomAttributes = "";
        if (!$this->headline->Raw) {
            $this->headline->CurrentValue = HtmlDecode($this->headline->CurrentValue);
        }
        $this->headline->EditValue = $this->headline->CurrentValue;
        $this->headline->PlaceHolder = RemoveHtml($this->headline->caption());

        // subtext
        $this->subtext->EditAttrs["class"] = "form-control";
        $this->subtext->EditCustomAttributes = "";
        if (!$this->subtext->Raw) {
            $this->subtext->CurrentValue = HtmlDecode($this->subtext->CurrentValue);
        }
        $this->subtext->EditValue = $this->subtext->CurrentValue;
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
        $this->altTxt->EditValue = $this->altTxt->CurrentValue;
        $this->altTxt->PlaceHolder = RemoveHtml($this->altTxt->caption());

        // description
        $this->description->EditAttrs["class"] = "form-control";
        $this->description->EditCustomAttributes = "";
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // uploadDate
        $this->uploadDate->EditAttrs["class"] = "form-control";
        $this->uploadDate->EditCustomAttributes = "";
        $this->uploadDate->EditValue = FormatDateTime($this->uploadDate->CurrentValue, 8);
        $this->uploadDate->PlaceHolder = RemoveHtml($this->uploadDate->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->filePath);
                    $doc->exportCaption($this->fileSize);
                    $doc->exportCaption($this->dimensionsID);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->resourceName);
                    $doc->exportCaption($this->resourceLink);
                    $doc->exportCaption($this->headline);
                    $doc->exportCaption($this->subtext);
                    $doc->exportCaption($this->site);
                    $doc->exportCaption($this->altTxt);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->uploadDate);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->filePath);
                    $doc->exportCaption($this->fileSize);
                    $doc->exportCaption($this->dimensionsID);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->resourceName);
                    $doc->exportCaption($this->resourceLink);
                    $doc->exportCaption($this->headline);
                    $doc->exportCaption($this->subtext);
                    $doc->exportCaption($this->site);
                    $doc->exportCaption($this->altTxt);
                    $doc->exportCaption($this->uploadDate);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->filePath);
                        $doc->exportField($this->fileSize);
                        $doc->exportField($this->dimensionsID);
                        $doc->exportField($this->type);
                        $doc->exportField($this->resourceName);
                        $doc->exportField($this->resourceLink);
                        $doc->exportField($this->headline);
                        $doc->exportField($this->subtext);
                        $doc->exportField($this->site);
                        $doc->exportField($this->altTxt);
                        $doc->exportField($this->description);
                        $doc->exportField($this->uploadDate);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->filePath);
                        $doc->exportField($this->fileSize);
                        $doc->exportField($this->dimensionsID);
                        $doc->exportField($this->type);
                        $doc->exportField($this->resourceName);
                        $doc->exportField($this->resourceLink);
                        $doc->exportField($this->headline);
                        $doc->exportField($this->subtext);
                        $doc->exportField($this->site);
                        $doc->exportField($this->altTxt);
                        $doc->exportField($this->uploadDate);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
