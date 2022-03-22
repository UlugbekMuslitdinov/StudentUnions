<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for box_menu
 */
class BoxMenu extends DbTable
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
    public $date;
    public $day;
    public $breakfast_1;
    public $breakfast_2;
    public $breakfast_bag;
    public $breakfast_bag2;
    public $breakfast_beverage;
    public $lunch_1;
    public $lunch_2;
    public $lunch_3;
    public $lunch_bag;
    public $lunch_bag2;
    public $lunch_bag3;
    public $lunch_beverage;
    public $dinner_1;
    public $dinner_2;
    public $dinner_3;
    public $dinner_bag;
    public $dinner_bag2;
    public $dinner_bag3;
    public $dinner_beverage;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'box_menu';
        $this->TableName = 'box_menu';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`box_menu`";
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
        $this->id = new DbField('box_menu', 'box_menu', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // date
        $this->date = new DbField('box_menu', 'box_menu', 'x_date', 'date', '`date`', '`date`', 200, 10, -1, false, '`date`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->date->Sortable = true; // Allow sort
        $this->Fields['date'] = &$this->date;

        // day
        $this->day = new DbField('box_menu', 'box_menu', 'x_day', 'day', '`day`', '`day`', 200, 45, -1, false, '`day`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->day->Sortable = true; // Allow sort
        $this->Fields['day'] = &$this->day;

        // breakfast_1
        $this->breakfast_1 = new DbField('box_menu', 'box_menu', 'x_breakfast_1', 'breakfast_1', '`breakfast_1`', '`breakfast_1`', 200, 200, -1, false, '`breakfast_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->breakfast_1->Sortable = true; // Allow sort
        $this->Fields['breakfast_1'] = &$this->breakfast_1;

        // breakfast_2
        $this->breakfast_2 = new DbField('box_menu', 'box_menu', 'x_breakfast_2', 'breakfast_2', '`breakfast_2`', '`breakfast_2`', 200, 200, -1, false, '`breakfast_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->breakfast_2->Sortable = true; // Allow sort
        $this->Fields['breakfast_2'] = &$this->breakfast_2;

        // breakfast_bag
        $this->breakfast_bag = new DbField('box_menu', 'box_menu', 'x_breakfast_bag', 'breakfast_bag', '`breakfast_bag`', '`breakfast_bag`', 200, 200, -1, false, '`breakfast_bag`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->breakfast_bag->Sortable = true; // Allow sort
        $this->Fields['breakfast_bag'] = &$this->breakfast_bag;

        // breakfast_bag2
        $this->breakfast_bag2 = new DbField('box_menu', 'box_menu', 'x_breakfast_bag2', 'breakfast_bag2', '`breakfast_bag2`', '`breakfast_bag2`', 200, 200, -1, false, '`breakfast_bag2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->breakfast_bag2->Sortable = true; // Allow sort
        $this->Fields['breakfast_bag2'] = &$this->breakfast_bag2;

        // breakfast_beverage
        $this->breakfast_beverage = new DbField('box_menu', 'box_menu', 'x_breakfast_beverage', 'breakfast_beverage', '`breakfast_beverage`', '`breakfast_beverage`', 200, 200, -1, false, '`breakfast_beverage`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->breakfast_beverage->Sortable = true; // Allow sort
        $this->Fields['breakfast_beverage'] = &$this->breakfast_beverage;

        // lunch_1
        $this->lunch_1 = new DbField('box_menu', 'box_menu', 'x_lunch_1', 'lunch_1', '`lunch_1`', '`lunch_1`', 200, 200, -1, false, '`lunch_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_1->Sortable = true; // Allow sort
        $this->Fields['lunch_1'] = &$this->lunch_1;

        // lunch_2
        $this->lunch_2 = new DbField('box_menu', 'box_menu', 'x_lunch_2', 'lunch_2', '`lunch_2`', '`lunch_2`', 200, 200, -1, false, '`lunch_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_2->Sortable = true; // Allow sort
        $this->Fields['lunch_2'] = &$this->lunch_2;

        // lunch_3
        $this->lunch_3 = new DbField('box_menu', 'box_menu', 'x_lunch_3', 'lunch_3', '`lunch_3`', '`lunch_3`', 200, 200, -1, false, '`lunch_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_3->Sortable = true; // Allow sort
        $this->Fields['lunch_3'] = &$this->lunch_3;

        // lunch_bag
        $this->lunch_bag = new DbField('box_menu', 'box_menu', 'x_lunch_bag', 'lunch_bag', '`lunch_bag`', '`lunch_bag`', 200, 200, -1, false, '`lunch_bag`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_bag->Sortable = true; // Allow sort
        $this->Fields['lunch_bag'] = &$this->lunch_bag;

        // lunch_bag2
        $this->lunch_bag2 = new DbField('box_menu', 'box_menu', 'x_lunch_bag2', 'lunch_bag2', '`lunch_bag2`', '`lunch_bag2`', 200, 200, -1, false, '`lunch_bag2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_bag2->Sortable = true; // Allow sort
        $this->Fields['lunch_bag2'] = &$this->lunch_bag2;

        // lunch_bag3
        $this->lunch_bag3 = new DbField('box_menu', 'box_menu', 'x_lunch_bag3', 'lunch_bag3', '`lunch_bag3`', '`lunch_bag3`', 200, 200, -1, false, '`lunch_bag3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_bag3->Sortable = true; // Allow sort
        $this->Fields['lunch_bag3'] = &$this->lunch_bag3;

        // lunch_beverage
        $this->lunch_beverage = new DbField('box_menu', 'box_menu', 'x_lunch_beverage', 'lunch_beverage', '`lunch_beverage`', '`lunch_beverage`', 200, 200, -1, false, '`lunch_beverage`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lunch_beverage->Sortable = true; // Allow sort
        $this->Fields['lunch_beverage'] = &$this->lunch_beverage;

        // dinner_1
        $this->dinner_1 = new DbField('box_menu', 'box_menu', 'x_dinner_1', 'dinner_1', '`dinner_1`', '`dinner_1`', 200, 200, -1, false, '`dinner_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_1->Sortable = true; // Allow sort
        $this->Fields['dinner_1'] = &$this->dinner_1;

        // dinner_2
        $this->dinner_2 = new DbField('box_menu', 'box_menu', 'x_dinner_2', 'dinner_2', '`dinner_2`', '`dinner_2`', 200, 200, -1, false, '`dinner_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_2->Sortable = true; // Allow sort
        $this->Fields['dinner_2'] = &$this->dinner_2;

        // dinner_3
        $this->dinner_3 = new DbField('box_menu', 'box_menu', 'x_dinner_3', 'dinner_3', '`dinner_3`', '`dinner_3`', 200, 200, -1, false, '`dinner_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_3->Sortable = true; // Allow sort
        $this->Fields['dinner_3'] = &$this->dinner_3;

        // dinner_bag
        $this->dinner_bag = new DbField('box_menu', 'box_menu', 'x_dinner_bag', 'dinner_bag', '`dinner_bag`', '`dinner_bag`', 200, 200, -1, false, '`dinner_bag`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_bag->Sortable = true; // Allow sort
        $this->Fields['dinner_bag'] = &$this->dinner_bag;

        // dinner_bag2
        $this->dinner_bag2 = new DbField('box_menu', 'box_menu', 'x_dinner_bag2', 'dinner_bag2', '`dinner_bag2`', '`dinner_bag2`', 200, 200, -1, false, '`dinner_bag2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_bag2->Sortable = true; // Allow sort
        $this->Fields['dinner_bag2'] = &$this->dinner_bag2;

        // dinner_bag3
        $this->dinner_bag3 = new DbField('box_menu', 'box_menu', 'x_dinner_bag3', 'dinner_bag3', '`dinner_bag3`', '`dinner_bag3`', 200, 200, -1, false, '`dinner_bag3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_bag3->Sortable = true; // Allow sort
        $this->Fields['dinner_bag3'] = &$this->dinner_bag3;

        // dinner_beverage
        $this->dinner_beverage = new DbField('box_menu', 'box_menu', 'x_dinner_beverage', 'dinner_beverage', '`dinner_beverage`', '`dinner_beverage`', 200, 200, -1, false, '`dinner_beverage`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dinner_beverage->Sortable = true; // Allow sort
        $this->Fields['dinner_beverage'] = &$this->dinner_beverage;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`box_menu`";
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
        $this->date->DbValue = $row['date'];
        $this->day->DbValue = $row['day'];
        $this->breakfast_1->DbValue = $row['breakfast_1'];
        $this->breakfast_2->DbValue = $row['breakfast_2'];
        $this->breakfast_bag->DbValue = $row['breakfast_bag'];
        $this->breakfast_bag2->DbValue = $row['breakfast_bag2'];
        $this->breakfast_beverage->DbValue = $row['breakfast_beverage'];
        $this->lunch_1->DbValue = $row['lunch_1'];
        $this->lunch_2->DbValue = $row['lunch_2'];
        $this->lunch_3->DbValue = $row['lunch_3'];
        $this->lunch_bag->DbValue = $row['lunch_bag'];
        $this->lunch_bag2->DbValue = $row['lunch_bag2'];
        $this->lunch_bag3->DbValue = $row['lunch_bag3'];
        $this->lunch_beverage->DbValue = $row['lunch_beverage'];
        $this->dinner_1->DbValue = $row['dinner_1'];
        $this->dinner_2->DbValue = $row['dinner_2'];
        $this->dinner_3->DbValue = $row['dinner_3'];
        $this->dinner_bag->DbValue = $row['dinner_bag'];
        $this->dinner_bag2->DbValue = $row['dinner_bag2'];
        $this->dinner_bag3->DbValue = $row['dinner_bag3'];
        $this->dinner_beverage->DbValue = $row['dinner_beverage'];
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
            return GetUrl("BoxMenuList");
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
        if ($pageName == "BoxMenuView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BoxMenuEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BoxMenuAdd") {
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
                return "BoxMenuView";
            case Config("API_ADD_ACTION"):
                return "BoxMenuAdd";
            case Config("API_EDIT_ACTION"):
                return "BoxMenuEdit";
            case Config("API_DELETE_ACTION"):
                return "BoxMenuDelete";
            case Config("API_LIST_ACTION"):
                return "BoxMenuList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BoxMenuList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BoxMenuView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BoxMenuView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BoxMenuAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BoxMenuAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BoxMenuEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BoxMenuAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BoxMenuDelete", $this->getUrlParm());
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // date
        $this->date->EditAttrs["class"] = "form-control";
        $this->date->EditCustomAttributes = "";
        if (!$this->date->Raw) {
            $this->date->CurrentValue = HtmlDecode($this->date->CurrentValue);
        }
        $this->date->EditValue = $this->date->CurrentValue;
        $this->date->PlaceHolder = RemoveHtml($this->date->caption());

        // day
        $this->day->EditAttrs["class"] = "form-control";
        $this->day->EditCustomAttributes = "";
        if (!$this->day->Raw) {
            $this->day->CurrentValue = HtmlDecode($this->day->CurrentValue);
        }
        $this->day->EditValue = $this->day->CurrentValue;
        $this->day->PlaceHolder = RemoveHtml($this->day->caption());

        // breakfast_1
        $this->breakfast_1->EditAttrs["class"] = "form-control";
        $this->breakfast_1->EditCustomAttributes = "";
        if (!$this->breakfast_1->Raw) {
            $this->breakfast_1->CurrentValue = HtmlDecode($this->breakfast_1->CurrentValue);
        }
        $this->breakfast_1->EditValue = $this->breakfast_1->CurrentValue;
        $this->breakfast_1->PlaceHolder = RemoveHtml($this->breakfast_1->caption());

        // breakfast_2
        $this->breakfast_2->EditAttrs["class"] = "form-control";
        $this->breakfast_2->EditCustomAttributes = "";
        if (!$this->breakfast_2->Raw) {
            $this->breakfast_2->CurrentValue = HtmlDecode($this->breakfast_2->CurrentValue);
        }
        $this->breakfast_2->EditValue = $this->breakfast_2->CurrentValue;
        $this->breakfast_2->PlaceHolder = RemoveHtml($this->breakfast_2->caption());

        // breakfast_bag
        $this->breakfast_bag->EditAttrs["class"] = "form-control";
        $this->breakfast_bag->EditCustomAttributes = "";
        if (!$this->breakfast_bag->Raw) {
            $this->breakfast_bag->CurrentValue = HtmlDecode($this->breakfast_bag->CurrentValue);
        }
        $this->breakfast_bag->EditValue = $this->breakfast_bag->CurrentValue;
        $this->breakfast_bag->PlaceHolder = RemoveHtml($this->breakfast_bag->caption());

        // breakfast_bag2
        $this->breakfast_bag2->EditAttrs["class"] = "form-control";
        $this->breakfast_bag2->EditCustomAttributes = "";
        if (!$this->breakfast_bag2->Raw) {
            $this->breakfast_bag2->CurrentValue = HtmlDecode($this->breakfast_bag2->CurrentValue);
        }
        $this->breakfast_bag2->EditValue = $this->breakfast_bag2->CurrentValue;
        $this->breakfast_bag2->PlaceHolder = RemoveHtml($this->breakfast_bag2->caption());

        // breakfast_beverage
        $this->breakfast_beverage->EditAttrs["class"] = "form-control";
        $this->breakfast_beverage->EditCustomAttributes = "";
        if (!$this->breakfast_beverage->Raw) {
            $this->breakfast_beverage->CurrentValue = HtmlDecode($this->breakfast_beverage->CurrentValue);
        }
        $this->breakfast_beverage->EditValue = $this->breakfast_beverage->CurrentValue;
        $this->breakfast_beverage->PlaceHolder = RemoveHtml($this->breakfast_beverage->caption());

        // lunch_1
        $this->lunch_1->EditAttrs["class"] = "form-control";
        $this->lunch_1->EditCustomAttributes = "";
        if (!$this->lunch_1->Raw) {
            $this->lunch_1->CurrentValue = HtmlDecode($this->lunch_1->CurrentValue);
        }
        $this->lunch_1->EditValue = $this->lunch_1->CurrentValue;
        $this->lunch_1->PlaceHolder = RemoveHtml($this->lunch_1->caption());

        // lunch_2
        $this->lunch_2->EditAttrs["class"] = "form-control";
        $this->lunch_2->EditCustomAttributes = "";
        if (!$this->lunch_2->Raw) {
            $this->lunch_2->CurrentValue = HtmlDecode($this->lunch_2->CurrentValue);
        }
        $this->lunch_2->EditValue = $this->lunch_2->CurrentValue;
        $this->lunch_2->PlaceHolder = RemoveHtml($this->lunch_2->caption());

        // lunch_3
        $this->lunch_3->EditAttrs["class"] = "form-control";
        $this->lunch_3->EditCustomAttributes = "";
        if (!$this->lunch_3->Raw) {
            $this->lunch_3->CurrentValue = HtmlDecode($this->lunch_3->CurrentValue);
        }
        $this->lunch_3->EditValue = $this->lunch_3->CurrentValue;
        $this->lunch_3->PlaceHolder = RemoveHtml($this->lunch_3->caption());

        // lunch_bag
        $this->lunch_bag->EditAttrs["class"] = "form-control";
        $this->lunch_bag->EditCustomAttributes = "";
        if (!$this->lunch_bag->Raw) {
            $this->lunch_bag->CurrentValue = HtmlDecode($this->lunch_bag->CurrentValue);
        }
        $this->lunch_bag->EditValue = $this->lunch_bag->CurrentValue;
        $this->lunch_bag->PlaceHolder = RemoveHtml($this->lunch_bag->caption());

        // lunch_bag2
        $this->lunch_bag2->EditAttrs["class"] = "form-control";
        $this->lunch_bag2->EditCustomAttributes = "";
        if (!$this->lunch_bag2->Raw) {
            $this->lunch_bag2->CurrentValue = HtmlDecode($this->lunch_bag2->CurrentValue);
        }
        $this->lunch_bag2->EditValue = $this->lunch_bag2->CurrentValue;
        $this->lunch_bag2->PlaceHolder = RemoveHtml($this->lunch_bag2->caption());

        // lunch_bag3
        $this->lunch_bag3->EditAttrs["class"] = "form-control";
        $this->lunch_bag3->EditCustomAttributes = "";
        if (!$this->lunch_bag3->Raw) {
            $this->lunch_bag3->CurrentValue = HtmlDecode($this->lunch_bag3->CurrentValue);
        }
        $this->lunch_bag3->EditValue = $this->lunch_bag3->CurrentValue;
        $this->lunch_bag3->PlaceHolder = RemoveHtml($this->lunch_bag3->caption());

        // lunch_beverage
        $this->lunch_beverage->EditAttrs["class"] = "form-control";
        $this->lunch_beverage->EditCustomAttributes = "";
        if (!$this->lunch_beverage->Raw) {
            $this->lunch_beverage->CurrentValue = HtmlDecode($this->lunch_beverage->CurrentValue);
        }
        $this->lunch_beverage->EditValue = $this->lunch_beverage->CurrentValue;
        $this->lunch_beverage->PlaceHolder = RemoveHtml($this->lunch_beverage->caption());

        // dinner_1
        $this->dinner_1->EditAttrs["class"] = "form-control";
        $this->dinner_1->EditCustomAttributes = "";
        if (!$this->dinner_1->Raw) {
            $this->dinner_1->CurrentValue = HtmlDecode($this->dinner_1->CurrentValue);
        }
        $this->dinner_1->EditValue = $this->dinner_1->CurrentValue;
        $this->dinner_1->PlaceHolder = RemoveHtml($this->dinner_1->caption());

        // dinner_2
        $this->dinner_2->EditAttrs["class"] = "form-control";
        $this->dinner_2->EditCustomAttributes = "";
        if (!$this->dinner_2->Raw) {
            $this->dinner_2->CurrentValue = HtmlDecode($this->dinner_2->CurrentValue);
        }
        $this->dinner_2->EditValue = $this->dinner_2->CurrentValue;
        $this->dinner_2->PlaceHolder = RemoveHtml($this->dinner_2->caption());

        // dinner_3
        $this->dinner_3->EditAttrs["class"] = "form-control";
        $this->dinner_3->EditCustomAttributes = "";
        if (!$this->dinner_3->Raw) {
            $this->dinner_3->CurrentValue = HtmlDecode($this->dinner_3->CurrentValue);
        }
        $this->dinner_3->EditValue = $this->dinner_3->CurrentValue;
        $this->dinner_3->PlaceHolder = RemoveHtml($this->dinner_3->caption());

        // dinner_bag
        $this->dinner_bag->EditAttrs["class"] = "form-control";
        $this->dinner_bag->EditCustomAttributes = "";
        if (!$this->dinner_bag->Raw) {
            $this->dinner_bag->CurrentValue = HtmlDecode($this->dinner_bag->CurrentValue);
        }
        $this->dinner_bag->EditValue = $this->dinner_bag->CurrentValue;
        $this->dinner_bag->PlaceHolder = RemoveHtml($this->dinner_bag->caption());

        // dinner_bag2
        $this->dinner_bag2->EditAttrs["class"] = "form-control";
        $this->dinner_bag2->EditCustomAttributes = "";
        if (!$this->dinner_bag2->Raw) {
            $this->dinner_bag2->CurrentValue = HtmlDecode($this->dinner_bag2->CurrentValue);
        }
        $this->dinner_bag2->EditValue = $this->dinner_bag2->CurrentValue;
        $this->dinner_bag2->PlaceHolder = RemoveHtml($this->dinner_bag2->caption());

        // dinner_bag3
        $this->dinner_bag3->EditAttrs["class"] = "form-control";
        $this->dinner_bag3->EditCustomAttributes = "";
        if (!$this->dinner_bag3->Raw) {
            $this->dinner_bag3->CurrentValue = HtmlDecode($this->dinner_bag3->CurrentValue);
        }
        $this->dinner_bag3->EditValue = $this->dinner_bag3->CurrentValue;
        $this->dinner_bag3->PlaceHolder = RemoveHtml($this->dinner_bag3->caption());

        // dinner_beverage
        $this->dinner_beverage->EditAttrs["class"] = "form-control";
        $this->dinner_beverage->EditCustomAttributes = "";
        if (!$this->dinner_beverage->Raw) {
            $this->dinner_beverage->CurrentValue = HtmlDecode($this->dinner_beverage->CurrentValue);
        }
        $this->dinner_beverage->EditValue = $this->dinner_beverage->CurrentValue;
        $this->dinner_beverage->PlaceHolder = RemoveHtml($this->dinner_beverage->caption());

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
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->day);
                    $doc->exportCaption($this->breakfast_1);
                    $doc->exportCaption($this->breakfast_2);
                    $doc->exportCaption($this->breakfast_bag);
                    $doc->exportCaption($this->breakfast_bag2);
                    $doc->exportCaption($this->breakfast_beverage);
                    $doc->exportCaption($this->lunch_1);
                    $doc->exportCaption($this->lunch_2);
                    $doc->exportCaption($this->lunch_3);
                    $doc->exportCaption($this->lunch_bag);
                    $doc->exportCaption($this->lunch_bag2);
                    $doc->exportCaption($this->lunch_bag3);
                    $doc->exportCaption($this->lunch_beverage);
                    $doc->exportCaption($this->dinner_1);
                    $doc->exportCaption($this->dinner_2);
                    $doc->exportCaption($this->dinner_3);
                    $doc->exportCaption($this->dinner_bag);
                    $doc->exportCaption($this->dinner_bag2);
                    $doc->exportCaption($this->dinner_bag3);
                    $doc->exportCaption($this->dinner_beverage);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->day);
                    $doc->exportCaption($this->breakfast_1);
                    $doc->exportCaption($this->breakfast_2);
                    $doc->exportCaption($this->breakfast_bag);
                    $doc->exportCaption($this->breakfast_bag2);
                    $doc->exportCaption($this->breakfast_beverage);
                    $doc->exportCaption($this->lunch_1);
                    $doc->exportCaption($this->lunch_2);
                    $doc->exportCaption($this->lunch_3);
                    $doc->exportCaption($this->lunch_bag);
                    $doc->exportCaption($this->lunch_bag2);
                    $doc->exportCaption($this->lunch_bag3);
                    $doc->exportCaption($this->lunch_beverage);
                    $doc->exportCaption($this->dinner_1);
                    $doc->exportCaption($this->dinner_2);
                    $doc->exportCaption($this->dinner_3);
                    $doc->exportCaption($this->dinner_bag);
                    $doc->exportCaption($this->dinner_bag2);
                    $doc->exportCaption($this->dinner_bag3);
                    $doc->exportCaption($this->dinner_beverage);
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
                        $doc->exportField($this->date);
                        $doc->exportField($this->day);
                        $doc->exportField($this->breakfast_1);
                        $doc->exportField($this->breakfast_2);
                        $doc->exportField($this->breakfast_bag);
                        $doc->exportField($this->breakfast_bag2);
                        $doc->exportField($this->breakfast_beverage);
                        $doc->exportField($this->lunch_1);
                        $doc->exportField($this->lunch_2);
                        $doc->exportField($this->lunch_3);
                        $doc->exportField($this->lunch_bag);
                        $doc->exportField($this->lunch_bag2);
                        $doc->exportField($this->lunch_bag3);
                        $doc->exportField($this->lunch_beverage);
                        $doc->exportField($this->dinner_1);
                        $doc->exportField($this->dinner_2);
                        $doc->exportField($this->dinner_3);
                        $doc->exportField($this->dinner_bag);
                        $doc->exportField($this->dinner_bag2);
                        $doc->exportField($this->dinner_bag3);
                        $doc->exportField($this->dinner_beverage);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->date);
                        $doc->exportField($this->day);
                        $doc->exportField($this->breakfast_1);
                        $doc->exportField($this->breakfast_2);
                        $doc->exportField($this->breakfast_bag);
                        $doc->exportField($this->breakfast_bag2);
                        $doc->exportField($this->breakfast_beverage);
                        $doc->exportField($this->lunch_1);
                        $doc->exportField($this->lunch_2);
                        $doc->exportField($this->lunch_3);
                        $doc->exportField($this->lunch_bag);
                        $doc->exportField($this->lunch_bag2);
                        $doc->exportField($this->lunch_bag3);
                        $doc->exportField($this->lunch_beverage);
                        $doc->exportField($this->dinner_1);
                        $doc->exportField($this->dinner_2);
                        $doc->exportField($this->dinner_3);
                        $doc->exportField($this->dinner_bag);
                        $doc->exportField($this->dinner_bag2);
                        $doc->exportField($this->dinner_bag3);
                        $doc->exportField($this->dinner_beverage);
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
