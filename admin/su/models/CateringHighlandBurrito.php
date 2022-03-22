<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for catering_highland_burrito
 */
class CateringHighlandBurrito extends DbTable
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
    public $catering_id;
    public $pack;
    public $pack_num;
    public $burrito_num;
    public $meat_1;
    public $meat_2;
    public $meat_3;
    public $meat_4;
    public $vege_1;
    public $vege_2;
    public $vege_3;
    public $vege_4;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'catering_highland_burrito';
        $this->TableName = 'catering_highland_burrito';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`catering_highland_burrito`";
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
        $this->id = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // catering_id
        $this->catering_id = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_catering_id', 'catering_id', '`catering_id`', '`catering_id`', 3, 11, -1, false, '`catering_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->catering_id->Sortable = true; // Allow sort
        $this->catering_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['catering_id'] = &$this->catering_id;

        // pack
        $this->pack = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_pack', 'pack', '`pack`', '`pack`', 200, 45, -1, false, '`pack`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pack->Sortable = true; // Allow sort
        $this->Fields['pack'] = &$this->pack;

        // pack_num
        $this->pack_num = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_pack_num', 'pack_num', '`pack_num`', '`pack_num`', 16, 4, -1, false, '`pack_num`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pack_num->Sortable = true; // Allow sort
        $this->pack_num->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pack_num'] = &$this->pack_num;

        // burrito_num
        $this->burrito_num = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_burrito_num', 'burrito_num', '`burrito_num`', '`burrito_num`', 16, 4, -1, false, '`burrito_num`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->burrito_num->Sortable = true; // Allow sort
        $this->burrito_num->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['burrito_num'] = &$this->burrito_num;

        // meat_1
        $this->meat_1 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_meat_1', 'meat_1', '`meat_1`', '`meat_1`', 200, 45, -1, false, '`meat_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->meat_1->Sortable = true; // Allow sort
        $this->Fields['meat_1'] = &$this->meat_1;

        // meat_2
        $this->meat_2 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_meat_2', 'meat_2', '`meat_2`', '`meat_2`', 200, 45, -1, false, '`meat_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->meat_2->Sortable = true; // Allow sort
        $this->Fields['meat_2'] = &$this->meat_2;

        // meat_3
        $this->meat_3 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_meat_3', 'meat_3', '`meat_3`', '`meat_3`', 200, 45, -1, false, '`meat_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->meat_3->Sortable = true; // Allow sort
        $this->Fields['meat_3'] = &$this->meat_3;

        // meat_4
        $this->meat_4 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_meat_4', 'meat_4', '`meat_4`', '`meat_4`', 200, 45, -1, false, '`meat_4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->meat_4->Sortable = true; // Allow sort
        $this->Fields['meat_4'] = &$this->meat_4;

        // vege_1
        $this->vege_1 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_vege_1', 'vege_1', '`vege_1`', '`vege_1`', 200, 45, -1, false, '`vege_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vege_1->Sortable = true; // Allow sort
        $this->Fields['vege_1'] = &$this->vege_1;

        // vege_2
        $this->vege_2 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_vege_2', 'vege_2', '`vege_2`', '`vege_2`', 200, 45, -1, false, '`vege_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vege_2->Sortable = true; // Allow sort
        $this->Fields['vege_2'] = &$this->vege_2;

        // vege_3
        $this->vege_3 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_vege_3', 'vege_3', '`vege_3`', '`vege_3`', 200, 45, -1, false, '`vege_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vege_3->Sortable = true; // Allow sort
        $this->Fields['vege_3'] = &$this->vege_3;

        // vege_4
        $this->vege_4 = new DbField('catering_highland_burrito', 'catering_highland_burrito', 'x_vege_4', 'vege_4', '`vege_4`', '`vege_4`', 200, 45, -1, false, '`vege_4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vege_4->Sortable = true; // Allow sort
        $this->Fields['vege_4'] = &$this->vege_4;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`catering_highland_burrito`";
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
        $this->catering_id->DbValue = $row['catering_id'];
        $this->pack->DbValue = $row['pack'];
        $this->pack_num->DbValue = $row['pack_num'];
        $this->burrito_num->DbValue = $row['burrito_num'];
        $this->meat_1->DbValue = $row['meat_1'];
        $this->meat_2->DbValue = $row['meat_2'];
        $this->meat_3->DbValue = $row['meat_3'];
        $this->meat_4->DbValue = $row['meat_4'];
        $this->vege_1->DbValue = $row['vege_1'];
        $this->vege_2->DbValue = $row['vege_2'];
        $this->vege_3->DbValue = $row['vege_3'];
        $this->vege_4->DbValue = $row['vege_4'];
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
            return GetUrl("CateringHighlandBurritoList");
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
        if ($pageName == "CateringHighlandBurritoView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CateringHighlandBurritoEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CateringHighlandBurritoAdd") {
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
                return "CateringHighlandBurritoView";
            case Config("API_ADD_ACTION"):
                return "CateringHighlandBurritoAdd";
            case Config("API_EDIT_ACTION"):
                return "CateringHighlandBurritoEdit";
            case Config("API_DELETE_ACTION"):
                return "CateringHighlandBurritoDelete";
            case Config("API_LIST_ACTION"):
                return "CateringHighlandBurritoList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CateringHighlandBurritoList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CateringHighlandBurritoView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CateringHighlandBurritoView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CateringHighlandBurritoAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CateringHighlandBurritoAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CateringHighlandBurritoEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CateringHighlandBurritoAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CateringHighlandBurritoDelete", $this->getUrlParm());
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
        $this->catering_id->setDbValue($row['catering_id']);
        $this->pack->setDbValue($row['pack']);
        $this->pack_num->setDbValue($row['pack_num']);
        $this->burrito_num->setDbValue($row['burrito_num']);
        $this->meat_1->setDbValue($row['meat_1']);
        $this->meat_2->setDbValue($row['meat_2']);
        $this->meat_3->setDbValue($row['meat_3']);
        $this->meat_4->setDbValue($row['meat_4']);
        $this->vege_1->setDbValue($row['vege_1']);
        $this->vege_2->setDbValue($row['vege_2']);
        $this->vege_3->setDbValue($row['vege_3']);
        $this->vege_4->setDbValue($row['vege_4']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // catering_id

        // pack

        // pack_num

        // burrito_num

        // meat_1

        // meat_2

        // meat_3

        // meat_4

        // vege_1

        // vege_2

        // vege_3

        // vege_4

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // catering_id
        $this->catering_id->ViewValue = $this->catering_id->CurrentValue;
        $this->catering_id->ViewValue = FormatNumber($this->catering_id->ViewValue, 0, -2, -2, -2);
        $this->catering_id->ViewCustomAttributes = "";

        // pack
        $this->pack->ViewValue = $this->pack->CurrentValue;
        $this->pack->ViewCustomAttributes = "";

        // pack_num
        $this->pack_num->ViewValue = $this->pack_num->CurrentValue;
        $this->pack_num->ViewValue = FormatNumber($this->pack_num->ViewValue, 0, -2, -2, -2);
        $this->pack_num->ViewCustomAttributes = "";

        // burrito_num
        $this->burrito_num->ViewValue = $this->burrito_num->CurrentValue;
        $this->burrito_num->ViewValue = FormatNumber($this->burrito_num->ViewValue, 0, -2, -2, -2);
        $this->burrito_num->ViewCustomAttributes = "";

        // meat_1
        $this->meat_1->ViewValue = $this->meat_1->CurrentValue;
        $this->meat_1->ViewCustomAttributes = "";

        // meat_2
        $this->meat_2->ViewValue = $this->meat_2->CurrentValue;
        $this->meat_2->ViewCustomAttributes = "";

        // meat_3
        $this->meat_3->ViewValue = $this->meat_3->CurrentValue;
        $this->meat_3->ViewCustomAttributes = "";

        // meat_4
        $this->meat_4->ViewValue = $this->meat_4->CurrentValue;
        $this->meat_4->ViewCustomAttributes = "";

        // vege_1
        $this->vege_1->ViewValue = $this->vege_1->CurrentValue;
        $this->vege_1->ViewCustomAttributes = "";

        // vege_2
        $this->vege_2->ViewValue = $this->vege_2->CurrentValue;
        $this->vege_2->ViewCustomAttributes = "";

        // vege_3
        $this->vege_3->ViewValue = $this->vege_3->CurrentValue;
        $this->vege_3->ViewCustomAttributes = "";

        // vege_4
        $this->vege_4->ViewValue = $this->vege_4->CurrentValue;
        $this->vege_4->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // catering_id
        $this->catering_id->LinkCustomAttributes = "";
        $this->catering_id->HrefValue = "";
        $this->catering_id->TooltipValue = "";

        // pack
        $this->pack->LinkCustomAttributes = "";
        $this->pack->HrefValue = "";
        $this->pack->TooltipValue = "";

        // pack_num
        $this->pack_num->LinkCustomAttributes = "";
        $this->pack_num->HrefValue = "";
        $this->pack_num->TooltipValue = "";

        // burrito_num
        $this->burrito_num->LinkCustomAttributes = "";
        $this->burrito_num->HrefValue = "";
        $this->burrito_num->TooltipValue = "";

        // meat_1
        $this->meat_1->LinkCustomAttributes = "";
        $this->meat_1->HrefValue = "";
        $this->meat_1->TooltipValue = "";

        // meat_2
        $this->meat_2->LinkCustomAttributes = "";
        $this->meat_2->HrefValue = "";
        $this->meat_2->TooltipValue = "";

        // meat_3
        $this->meat_3->LinkCustomAttributes = "";
        $this->meat_3->HrefValue = "";
        $this->meat_3->TooltipValue = "";

        // meat_4
        $this->meat_4->LinkCustomAttributes = "";
        $this->meat_4->HrefValue = "";
        $this->meat_4->TooltipValue = "";

        // vege_1
        $this->vege_1->LinkCustomAttributes = "";
        $this->vege_1->HrefValue = "";
        $this->vege_1->TooltipValue = "";

        // vege_2
        $this->vege_2->LinkCustomAttributes = "";
        $this->vege_2->HrefValue = "";
        $this->vege_2->TooltipValue = "";

        // vege_3
        $this->vege_3->LinkCustomAttributes = "";
        $this->vege_3->HrefValue = "";
        $this->vege_3->TooltipValue = "";

        // vege_4
        $this->vege_4->LinkCustomAttributes = "";
        $this->vege_4->HrefValue = "";
        $this->vege_4->TooltipValue = "";

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

        // catering_id
        $this->catering_id->EditAttrs["class"] = "form-control";
        $this->catering_id->EditCustomAttributes = "";
        $this->catering_id->EditValue = $this->catering_id->CurrentValue;
        $this->catering_id->PlaceHolder = RemoveHtml($this->catering_id->caption());

        // pack
        $this->pack->EditAttrs["class"] = "form-control";
        $this->pack->EditCustomAttributes = "";
        if (!$this->pack->Raw) {
            $this->pack->CurrentValue = HtmlDecode($this->pack->CurrentValue);
        }
        $this->pack->EditValue = $this->pack->CurrentValue;
        $this->pack->PlaceHolder = RemoveHtml($this->pack->caption());

        // pack_num
        $this->pack_num->EditAttrs["class"] = "form-control";
        $this->pack_num->EditCustomAttributes = "";
        $this->pack_num->EditValue = $this->pack_num->CurrentValue;
        $this->pack_num->PlaceHolder = RemoveHtml($this->pack_num->caption());

        // burrito_num
        $this->burrito_num->EditAttrs["class"] = "form-control";
        $this->burrito_num->EditCustomAttributes = "";
        $this->burrito_num->EditValue = $this->burrito_num->CurrentValue;
        $this->burrito_num->PlaceHolder = RemoveHtml($this->burrito_num->caption());

        // meat_1
        $this->meat_1->EditAttrs["class"] = "form-control";
        $this->meat_1->EditCustomAttributes = "";
        if (!$this->meat_1->Raw) {
            $this->meat_1->CurrentValue = HtmlDecode($this->meat_1->CurrentValue);
        }
        $this->meat_1->EditValue = $this->meat_1->CurrentValue;
        $this->meat_1->PlaceHolder = RemoveHtml($this->meat_1->caption());

        // meat_2
        $this->meat_2->EditAttrs["class"] = "form-control";
        $this->meat_2->EditCustomAttributes = "";
        if (!$this->meat_2->Raw) {
            $this->meat_2->CurrentValue = HtmlDecode($this->meat_2->CurrentValue);
        }
        $this->meat_2->EditValue = $this->meat_2->CurrentValue;
        $this->meat_2->PlaceHolder = RemoveHtml($this->meat_2->caption());

        // meat_3
        $this->meat_3->EditAttrs["class"] = "form-control";
        $this->meat_3->EditCustomAttributes = "";
        if (!$this->meat_3->Raw) {
            $this->meat_3->CurrentValue = HtmlDecode($this->meat_3->CurrentValue);
        }
        $this->meat_3->EditValue = $this->meat_3->CurrentValue;
        $this->meat_3->PlaceHolder = RemoveHtml($this->meat_3->caption());

        // meat_4
        $this->meat_4->EditAttrs["class"] = "form-control";
        $this->meat_4->EditCustomAttributes = "";
        if (!$this->meat_4->Raw) {
            $this->meat_4->CurrentValue = HtmlDecode($this->meat_4->CurrentValue);
        }
        $this->meat_4->EditValue = $this->meat_4->CurrentValue;
        $this->meat_4->PlaceHolder = RemoveHtml($this->meat_4->caption());

        // vege_1
        $this->vege_1->EditAttrs["class"] = "form-control";
        $this->vege_1->EditCustomAttributes = "";
        if (!$this->vege_1->Raw) {
            $this->vege_1->CurrentValue = HtmlDecode($this->vege_1->CurrentValue);
        }
        $this->vege_1->EditValue = $this->vege_1->CurrentValue;
        $this->vege_1->PlaceHolder = RemoveHtml($this->vege_1->caption());

        // vege_2
        $this->vege_2->EditAttrs["class"] = "form-control";
        $this->vege_2->EditCustomAttributes = "";
        if (!$this->vege_2->Raw) {
            $this->vege_2->CurrentValue = HtmlDecode($this->vege_2->CurrentValue);
        }
        $this->vege_2->EditValue = $this->vege_2->CurrentValue;
        $this->vege_2->PlaceHolder = RemoveHtml($this->vege_2->caption());

        // vege_3
        $this->vege_3->EditAttrs["class"] = "form-control";
        $this->vege_3->EditCustomAttributes = "";
        if (!$this->vege_3->Raw) {
            $this->vege_3->CurrentValue = HtmlDecode($this->vege_3->CurrentValue);
        }
        $this->vege_3->EditValue = $this->vege_3->CurrentValue;
        $this->vege_3->PlaceHolder = RemoveHtml($this->vege_3->caption());

        // vege_4
        $this->vege_4->EditAttrs["class"] = "form-control";
        $this->vege_4->EditCustomAttributes = "";
        if (!$this->vege_4->Raw) {
            $this->vege_4->CurrentValue = HtmlDecode($this->vege_4->CurrentValue);
        }
        $this->vege_4->EditValue = $this->vege_4->CurrentValue;
        $this->vege_4->PlaceHolder = RemoveHtml($this->vege_4->caption());

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
                    $doc->exportCaption($this->catering_id);
                    $doc->exportCaption($this->pack);
                    $doc->exportCaption($this->pack_num);
                    $doc->exportCaption($this->burrito_num);
                    $doc->exportCaption($this->meat_1);
                    $doc->exportCaption($this->meat_2);
                    $doc->exportCaption($this->meat_3);
                    $doc->exportCaption($this->meat_4);
                    $doc->exportCaption($this->vege_1);
                    $doc->exportCaption($this->vege_2);
                    $doc->exportCaption($this->vege_3);
                    $doc->exportCaption($this->vege_4);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->catering_id);
                    $doc->exportCaption($this->pack);
                    $doc->exportCaption($this->pack_num);
                    $doc->exportCaption($this->burrito_num);
                    $doc->exportCaption($this->meat_1);
                    $doc->exportCaption($this->meat_2);
                    $doc->exportCaption($this->meat_3);
                    $doc->exportCaption($this->meat_4);
                    $doc->exportCaption($this->vege_1);
                    $doc->exportCaption($this->vege_2);
                    $doc->exportCaption($this->vege_3);
                    $doc->exportCaption($this->vege_4);
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
                        $doc->exportField($this->catering_id);
                        $doc->exportField($this->pack);
                        $doc->exportField($this->pack_num);
                        $doc->exportField($this->burrito_num);
                        $doc->exportField($this->meat_1);
                        $doc->exportField($this->meat_2);
                        $doc->exportField($this->meat_3);
                        $doc->exportField($this->meat_4);
                        $doc->exportField($this->vege_1);
                        $doc->exportField($this->vege_2);
                        $doc->exportField($this->vege_3);
                        $doc->exportField($this->vege_4);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->catering_id);
                        $doc->exportField($this->pack);
                        $doc->exportField($this->pack_num);
                        $doc->exportField($this->burrito_num);
                        $doc->exportField($this->meat_1);
                        $doc->exportField($this->meat_2);
                        $doc->exportField($this->meat_3);
                        $doc->exportField($this->meat_4);
                        $doc->exportField($this->vege_1);
                        $doc->exportField($this->vege_2);
                        $doc->exportField($this->vege_3);
                        $doc->exportField($this->vege_4);
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
