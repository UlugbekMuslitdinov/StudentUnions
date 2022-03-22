<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for departmental_access_requests
 */
class DepartmentalAccessRequests extends DbTable
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
    public $supervisor_name;
    public $supervisor_phone;
    public $supervisor_email;
    public $employee_first_name;
    public $employee_last_name;
    public $employee_netid;
    public $new_catwork;
    public $delete;
    public $timestamp;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'departmental_access_requests';
        $this->TableName = 'departmental_access_requests';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`departmental_access_requests`";
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
        $this->id = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_id', 'id', '`id`', '`id`', 19, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // supervisor_name
        $this->supervisor_name = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_supervisor_name', 'supervisor_name', '`supervisor_name`', '`supervisor_name`', 200, 80, -1, false, '`supervisor_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_name->Nullable = false; // NOT NULL field
        $this->supervisor_name->Required = true; // Required field
        $this->supervisor_name->Sortable = true; // Allow sort
        $this->supervisor_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_name->Param, "CustomMsg");
        $this->Fields['supervisor_name'] = &$this->supervisor_name;

        // supervisor_phone
        $this->supervisor_phone = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_supervisor_phone', 'supervisor_phone', '`supervisor_phone`', '`supervisor_phone`', 200, 20, -1, false, '`supervisor_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_phone->Nullable = false; // NOT NULL field
        $this->supervisor_phone->Required = true; // Required field
        $this->supervisor_phone->Sortable = true; // Allow sort
        $this->supervisor_phone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_phone->Param, "CustomMsg");
        $this->Fields['supervisor_phone'] = &$this->supervisor_phone;

        // supervisor_email
        $this->supervisor_email = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_supervisor_email', 'supervisor_email', '`supervisor_email`', '`supervisor_email`', 200, 80, -1, false, '`supervisor_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_email->Nullable = false; // NOT NULL field
        $this->supervisor_email->Required = true; // Required field
        $this->supervisor_email->Sortable = true; // Allow sort
        $this->supervisor_email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_email->Param, "CustomMsg");
        $this->Fields['supervisor_email'] = &$this->supervisor_email;

        // employee_first_name
        $this->employee_first_name = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_employee_first_name', 'employee_first_name', '`employee_first_name`', '`employee_first_name`', 200, 45, -1, false, '`employee_first_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_first_name->Nullable = false; // NOT NULL field
        $this->employee_first_name->Required = true; // Required field
        $this->employee_first_name->Sortable = true; // Allow sort
        $this->employee_first_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_first_name->Param, "CustomMsg");
        $this->Fields['employee_first_name'] = &$this->employee_first_name;

        // employee_last_name
        $this->employee_last_name = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_employee_last_name', 'employee_last_name', '`employee_last_name`', '`employee_last_name`', 200, 45, -1, false, '`employee_last_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_last_name->Nullable = false; // NOT NULL field
        $this->employee_last_name->Required = true; // Required field
        $this->employee_last_name->Sortable = true; // Allow sort
        $this->employee_last_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_last_name->Param, "CustomMsg");
        $this->Fields['employee_last_name'] = &$this->employee_last_name;

        // employee_netid
        $this->employee_netid = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_employee_netid', 'employee_netid', '`employee_netid`', '`employee_netid`', 200, 60, -1, false, '`employee_netid`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_netid->Nullable = false; // NOT NULL field
        $this->employee_netid->Required = true; // Required field
        $this->employee_netid->Sortable = true; // Allow sort
        $this->employee_netid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_netid->Param, "CustomMsg");
        $this->Fields['employee_netid'] = &$this->employee_netid;

        // new_catwork
        $this->new_catwork = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_new_catwork', 'new_catwork', '`new_catwork`', '`new_catwork`', 16, 1, -1, false, '`new_catwork`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->new_catwork->Sortable = true; // Allow sort
        $this->new_catwork->DataType = DATATYPE_BOOLEAN;
        $this->new_catwork->Lookup = new Lookup('new_catwork', 'departmental_access_requests', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->new_catwork->OptionCount = 2;
        $this->new_catwork->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->new_catwork->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->new_catwork->Param, "CustomMsg");
        $this->Fields['new_catwork'] = &$this->new_catwork;

        // delete
        $this->delete = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_delete', 'delete', '`delete`', '`delete`', 16, 1, -1, false, '`delete`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->delete->Sortable = true; // Allow sort
        $this->delete->DataType = DATATYPE_BOOLEAN;
        $this->delete->Lookup = new Lookup('delete', 'departmental_access_requests', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->delete->OptionCount = 2;
        $this->delete->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->delete->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->delete->Param, "CustomMsg");
        $this->Fields['delete'] = &$this->delete;

        // timestamp
        $this->timestamp = new DbField('departmental_access_requests', 'departmental_access_requests', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timestamp->Sortable = true; // Allow sort
        $this->timestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->timestamp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->timestamp->Param, "CustomMsg");
        $this->Fields['timestamp'] = &$this->timestamp;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`departmental_access_requests`";
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
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
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
        $this->supervisor_name->DbValue = $row['supervisor_name'];
        $this->supervisor_phone->DbValue = $row['supervisor_phone'];
        $this->supervisor_email->DbValue = $row['supervisor_email'];
        $this->employee_first_name->DbValue = $row['employee_first_name'];
        $this->employee_last_name->DbValue = $row['employee_last_name'];
        $this->employee_netid->DbValue = $row['employee_netid'];
        $this->new_catwork->DbValue = $row['new_catwork'];
        $this->delete->DbValue = $row['delete'];
        $this->timestamp->DbValue = $row['timestamp'];
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
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("DepartmentalAccessRequestsList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "DepartmentalAccessRequestsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "DepartmentalAccessRequestsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "DepartmentalAccessRequestsAdd") {
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
                return "DepartmentalAccessRequestsView";
            case Config("API_ADD_ACTION"):
                return "DepartmentalAccessRequestsAdd";
            case Config("API_EDIT_ACTION"):
                return "DepartmentalAccessRequestsEdit";
            case Config("API_DELETE_ACTION"):
                return "DepartmentalAccessRequestsDelete";
            case Config("API_LIST_ACTION"):
                return "DepartmentalAccessRequestsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "DepartmentalAccessRequestsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("DepartmentalAccessRequestsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("DepartmentalAccessRequestsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "DepartmentalAccessRequestsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "DepartmentalAccessRequestsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("DepartmentalAccessRequestsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("DepartmentalAccessRequestsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("DepartmentalAccessRequestsDelete", $this->getUrlParm());
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // supervisor_name
        $this->supervisor_name->EditAttrs["class"] = "form-control";
        $this->supervisor_name->EditCustomAttributes = "";
        if (!$this->supervisor_name->Raw) {
            $this->supervisor_name->CurrentValue = HtmlDecode($this->supervisor_name->CurrentValue);
        }
        $this->supervisor_name->EditValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_name->PlaceHolder = RemoveHtml($this->supervisor_name->caption());

        // supervisor_phone
        $this->supervisor_phone->EditAttrs["class"] = "form-control";
        $this->supervisor_phone->EditCustomAttributes = "";
        if (!$this->supervisor_phone->Raw) {
            $this->supervisor_phone->CurrentValue = HtmlDecode($this->supervisor_phone->CurrentValue);
        }
        $this->supervisor_phone->EditValue = $this->supervisor_phone->CurrentValue;
        $this->supervisor_phone->PlaceHolder = RemoveHtml($this->supervisor_phone->caption());

        // supervisor_email
        $this->supervisor_email->EditAttrs["class"] = "form-control";
        $this->supervisor_email->EditCustomAttributes = "";
        if (!$this->supervisor_email->Raw) {
            $this->supervisor_email->CurrentValue = HtmlDecode($this->supervisor_email->CurrentValue);
        }
        $this->supervisor_email->EditValue = $this->supervisor_email->CurrentValue;
        $this->supervisor_email->PlaceHolder = RemoveHtml($this->supervisor_email->caption());

        // employee_first_name
        $this->employee_first_name->EditAttrs["class"] = "form-control";
        $this->employee_first_name->EditCustomAttributes = "";
        if (!$this->employee_first_name->Raw) {
            $this->employee_first_name->CurrentValue = HtmlDecode($this->employee_first_name->CurrentValue);
        }
        $this->employee_first_name->EditValue = $this->employee_first_name->CurrentValue;
        $this->employee_first_name->PlaceHolder = RemoveHtml($this->employee_first_name->caption());

        // employee_last_name
        $this->employee_last_name->EditAttrs["class"] = "form-control";
        $this->employee_last_name->EditCustomAttributes = "";
        if (!$this->employee_last_name->Raw) {
            $this->employee_last_name->CurrentValue = HtmlDecode($this->employee_last_name->CurrentValue);
        }
        $this->employee_last_name->EditValue = $this->employee_last_name->CurrentValue;
        $this->employee_last_name->PlaceHolder = RemoveHtml($this->employee_last_name->caption());

        // employee_netid
        $this->employee_netid->EditAttrs["class"] = "form-control";
        $this->employee_netid->EditCustomAttributes = "";
        if (!$this->employee_netid->Raw) {
            $this->employee_netid->CurrentValue = HtmlDecode($this->employee_netid->CurrentValue);
        }
        $this->employee_netid->EditValue = $this->employee_netid->CurrentValue;
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
        $this->timestamp->EditValue = FormatDateTime($this->timestamp->CurrentValue, 8);
        $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

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
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->supervisor_email);
                    $doc->exportCaption($this->employee_first_name);
                    $doc->exportCaption($this->employee_last_name);
                    $doc->exportCaption($this->employee_netid);
                    $doc->exportCaption($this->new_catwork);
                    $doc->exportCaption($this->delete);
                    $doc->exportCaption($this->timestamp);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->supervisor_email);
                    $doc->exportCaption($this->employee_first_name);
                    $doc->exportCaption($this->employee_last_name);
                    $doc->exportCaption($this->employee_netid);
                    $doc->exportCaption($this->new_catwork);
                    $doc->exportCaption($this->delete);
                    $doc->exportCaption($this->timestamp);
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
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->supervisor_email);
                        $doc->exportField($this->employee_first_name);
                        $doc->exportField($this->employee_last_name);
                        $doc->exportField($this->employee_netid);
                        $doc->exportField($this->new_catwork);
                        $doc->exportField($this->delete);
                        $doc->exportField($this->timestamp);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->supervisor_email);
                        $doc->exportField($this->employee_first_name);
                        $doc->exportField($this->employee_last_name);
                        $doc->exportField($this->employee_netid);
                        $doc->exportField($this->new_catwork);
                        $doc->exportField($this->delete);
                        $doc->exportField($this->timestamp);
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
