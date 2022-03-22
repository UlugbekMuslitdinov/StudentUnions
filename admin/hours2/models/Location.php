<?php

namespace PHPMaker2021\project2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for location
 */
class Location extends DbTable
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
    public $location_id;
    public $location_name;
    public $location_url;
    public $group_id;
    public $active;
    public $group_hours;
    public $phone;
    public $subgroup;
    public $old_id;
    public $short_name;
    public $accept_plus_discount;
    public $lat;
    public $long;
    public $ua_mobile_categories;
    public $breakfast;
    public $lunch;
    public $dinner;
    public $continuous;
    public $hours_message;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'location';
        $this->TableName = 'location';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`location`";
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

        // location_id
        $this->location_id = new DbField('location', 'location', 'x_location_id', 'location_id', '`location_id`', '`location_id`', 3, 11, -1, false, '`location_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->location_id->IsPrimaryKey = true; // Primary key field
        $this->location_id->Nullable = false; // NOT NULL field
        $this->location_id->Required = true; // Required field
        $this->location_id->Sortable = true; // Allow sort
        $this->location_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['location_id'] = &$this->location_id;

        // location_name
        $this->location_name = new DbField('location', 'location', 'x_location_name', 'location_name', '`location_name`', '`location_name`', 201, 65535, -1, false, '`location_name`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->location_name->Sortable = true; // Allow sort
        $this->Fields['location_name'] = &$this->location_name;

        // location_url
        $this->location_url = new DbField('location', 'location', 'x_location_url', 'location_url', '`location_url`', '`location_url`', 201, 65535, -1, false, '`location_url`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->location_url->Sortable = true; // Allow sort
        $this->Fields['location_url'] = &$this->location_url;

        // group_id
        $this->group_id = new DbField('location', 'location', 'x_group_id', 'group_id', '`group_id`', '`group_id`', 3, 11, -1, false, '`group_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->group_id->Sortable = true; // Allow sort
        $this->group_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['group_id'] = &$this->group_id;

        // active
        $this->active = new DbField('location', 'location', 'x_active', 'active', '`active`', '`active`', 201, 65535, -1, false, '`active`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->active->Sortable = true; // Allow sort
        $this->Fields['active'] = &$this->active;

        // group_hours
        $this->group_hours = new DbField('location', 'location', 'x_group_hours', 'group_hours', '`group_hours`', '`group_hours`', 202, 3, -1, false, '`group_hours`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->group_hours->Sortable = true; // Allow sort
        $this->group_hours->Lookup = new Lookup('group_hours', 'location', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->group_hours->OptionCount = 2;
        $this->Fields['group_hours'] = &$this->group_hours;

        // phone
        $this->phone = new DbField('location', 'location', 'x_phone', 'phone', '`phone`', '`phone`', 201, 65535, -1, false, '`phone`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->phone->Sortable = true; // Allow sort
        $this->Fields['phone'] = &$this->phone;

        // subgroup
        $this->subgroup = new DbField('location', 'location', 'x_subgroup', 'subgroup', '`subgroup`', '`subgroup`', 201, 65535, -1, false, '`subgroup`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->subgroup->Sortable = true; // Allow sort
        $this->Fields['subgroup'] = &$this->subgroup;

        // old_id
        $this->old_id = new DbField('location', 'location', 'x_old_id', 'old_id', '`old_id`', '`old_id`', 3, 11, -1, false, '`old_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->old_id->Sortable = true; // Allow sort
        $this->old_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['old_id'] = &$this->old_id;

        // short_name
        $this->short_name = new DbField('location', 'location', 'x_short_name', 'short_name', '`short_name`', '`short_name`', 201, 65535, -1, false, '`short_name`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->short_name->Sortable = true; // Allow sort
        $this->Fields['short_name'] = &$this->short_name;

        // accept_plus_discount
        $this->accept_plus_discount = new DbField('location', 'location', 'x_accept_plus_discount', 'accept_plus_discount', '`accept_plus_discount`', '`accept_plus_discount`', 3, 11, -1, false, '`accept_plus_discount`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->accept_plus_discount->Sortable = true; // Allow sort
        $this->accept_plus_discount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['accept_plus_discount'] = &$this->accept_plus_discount;

        // lat
        $this->lat = new DbField('location', 'location', 'x_lat', 'lat', '`lat`', '`lat`', 201, 65535, -1, false, '`lat`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->lat->Sortable = true; // Allow sort
        $this->Fields['lat'] = &$this->lat;

        // long
        $this->long = new DbField('location', 'location', 'x_long', 'long', '`long`', '`long`', 201, 65535, -1, false, '`long`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->long->Sortable = true; // Allow sort
        $this->Fields['long'] = &$this->long;

        // ua_mobile_categories
        $this->ua_mobile_categories = new DbField('location', 'location', 'x_ua_mobile_categories', 'ua_mobile_categories', '`ua_mobile_categories`', '`ua_mobile_categories`', 201, 65535, -1, false, '`ua_mobile_categories`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ua_mobile_categories->Nullable = false; // NOT NULL field
        $this->ua_mobile_categories->Required = true; // Required field
        $this->ua_mobile_categories->Sortable = true; // Allow sort
        $this->Fields['ua_mobile_categories'] = &$this->ua_mobile_categories;

        // breakfast
        $this->breakfast = new DbField('location', 'location', 'x_breakfast', 'breakfast', '`breakfast`', '`breakfast`', 202, 3, -1, false, '`breakfast`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->breakfast->Nullable = false; // NOT NULL field
        $this->breakfast->Required = true; // Required field
        $this->breakfast->Sortable = true; // Allow sort
        $this->breakfast->Lookup = new Lookup('breakfast', 'location', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->breakfast->OptionCount = 2;
        $this->Fields['breakfast'] = &$this->breakfast;

        // lunch
        $this->lunch = new DbField('location', 'location', 'x_lunch', 'lunch', '`lunch`', '`lunch`', 202, 3, -1, false, '`lunch`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->lunch->Nullable = false; // NOT NULL field
        $this->lunch->Required = true; // Required field
        $this->lunch->Sortable = true; // Allow sort
        $this->lunch->Lookup = new Lookup('lunch', 'location', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->lunch->OptionCount = 2;
        $this->Fields['lunch'] = &$this->lunch;

        // dinner
        $this->dinner = new DbField('location', 'location', 'x_dinner', 'dinner', '`dinner`', '`dinner`', 202, 3, -1, false, '`dinner`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->dinner->Nullable = false; // NOT NULL field
        $this->dinner->Required = true; // Required field
        $this->dinner->Sortable = true; // Allow sort
        $this->dinner->Lookup = new Lookup('dinner', 'location', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->dinner->OptionCount = 2;
        $this->Fields['dinner'] = &$this->dinner;

        // continuous
        $this->continuous = new DbField('location', 'location', 'x_continuous', 'continuous', '`continuous`', '`continuous`', 202, 3, -1, false, '`continuous`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->continuous->Nullable = false; // NOT NULL field
        $this->continuous->Required = true; // Required field
        $this->continuous->Sortable = true; // Allow sort
        $this->continuous->Lookup = new Lookup('continuous', 'location', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->continuous->OptionCount = 2;
        $this->Fields['continuous'] = &$this->continuous;

        // hours_message
        $this->hours_message = new DbField('location', 'location', 'x_hours_message', 'hours_message', '`hours_message`', '`hours_message`', 201, 1000, -1, false, '`hours_message`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->hours_message->Sortable = true; // Allow sort
        $this->Fields['hours_message'] = &$this->hours_message;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`location`";
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
            if (array_key_exists('location_id', $rs)) {
                AddFilter($where, QuotedName('location_id', $this->Dbid) . '=' . QuotedValue($rs['location_id'], $this->location_id->DataType, $this->Dbid));
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
        $this->location_id->DbValue = $row['location_id'];
        $this->location_name->DbValue = $row['location_name'];
        $this->location_url->DbValue = $row['location_url'];
        $this->group_id->DbValue = $row['group_id'];
        $this->active->DbValue = $row['active'];
        $this->group_hours->DbValue = $row['group_hours'];
        $this->phone->DbValue = $row['phone'];
        $this->subgroup->DbValue = $row['subgroup'];
        $this->old_id->DbValue = $row['old_id'];
        $this->short_name->DbValue = $row['short_name'];
        $this->accept_plus_discount->DbValue = $row['accept_plus_discount'];
        $this->lat->DbValue = $row['lat'];
        $this->long->DbValue = $row['long'];
        $this->ua_mobile_categories->DbValue = $row['ua_mobile_categories'];
        $this->breakfast->DbValue = $row['breakfast'];
        $this->lunch->DbValue = $row['lunch'];
        $this->dinner->DbValue = $row['dinner'];
        $this->continuous->DbValue = $row['continuous'];
        $this->hours_message->DbValue = $row['hours_message'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`location_id` = @location_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->location_id->CurrentValue : $this->location_id->OldValue;
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
                $this->location_id->CurrentValue = $keys[0];
            } else {
                $this->location_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('location_id', $row) ? $row['location_id'] : null;
        } else {
            $val = $this->location_id->OldValue !== null ? $this->location_id->OldValue : $this->location_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@location_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("LocationList");
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
        if ($pageName == "LocationView") {
            return $Language->phrase("View");
        } elseif ($pageName == "LocationEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "LocationAdd") {
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
                return "LocationView";
            case Config("API_ADD_ACTION"):
                return "LocationAdd";
            case Config("API_EDIT_ACTION"):
                return "LocationEdit";
            case Config("API_DELETE_ACTION"):
                return "LocationDelete";
            case Config("API_LIST_ACTION"):
                return "LocationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "LocationList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("LocationView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("LocationView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "LocationAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "LocationAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("LocationEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("LocationAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("LocationDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "location_id:" . JsonEncode($this->location_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->location_id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->location_id->CurrentValue);
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
            if (($keyValue = Param("location_id") ?? Route("location_id")) !== null) {
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
                $this->location_id->CurrentValue = $key;
            } else {
                $this->location_id->OldValue = $key;
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
        $this->location_id->setDbValue($row['location_id']);
        $this->location_name->setDbValue($row['location_name']);
        $this->location_url->setDbValue($row['location_url']);
        $this->group_id->setDbValue($row['group_id']);
        $this->active->setDbValue($row['active']);
        $this->group_hours->setDbValue($row['group_hours']);
        $this->phone->setDbValue($row['phone']);
        $this->subgroup->setDbValue($row['subgroup']);
        $this->old_id->setDbValue($row['old_id']);
        $this->short_name->setDbValue($row['short_name']);
        $this->accept_plus_discount->setDbValue($row['accept_plus_discount']);
        $this->lat->setDbValue($row['lat']);
        $this->long->setDbValue($row['long']);
        $this->ua_mobile_categories->setDbValue($row['ua_mobile_categories']);
        $this->breakfast->setDbValue($row['breakfast']);
        $this->lunch->setDbValue($row['lunch']);
        $this->dinner->setDbValue($row['dinner']);
        $this->continuous->setDbValue($row['continuous']);
        $this->hours_message->setDbValue($row['hours_message']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // location_id

        // location_name

        // location_url

        // group_id

        // active

        // group_hours

        // phone

        // subgroup

        // old_id

        // short_name

        // accept_plus_discount

        // lat

        // long

        // ua_mobile_categories

        // breakfast

        // lunch

        // dinner

        // continuous

        // hours_message

        // location_id
        $this->location_id->ViewValue = $this->location_id->CurrentValue;
        $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, 0, -2, -2, -2);
        $this->location_id->ViewCustomAttributes = "";

        // location_name
        $this->location_name->ViewValue = $this->location_name->CurrentValue;
        $this->location_name->ViewCustomAttributes = "";

        // location_url
        $this->location_url->ViewValue = $this->location_url->CurrentValue;
        $this->location_url->ViewCustomAttributes = "";

        // group_id
        $this->group_id->ViewValue = $this->group_id->CurrentValue;
        $this->group_id->ViewValue = FormatNumber($this->group_id->ViewValue, 0, -2, -2, -2);
        $this->group_id->ViewCustomAttributes = "";

        // active
        $this->active->ViewValue = $this->active->CurrentValue;
        $this->active->ViewCustomAttributes = "";

        // group_hours
        if (strval($this->group_hours->CurrentValue) != "") {
            $this->group_hours->ViewValue = $this->group_hours->optionCaption($this->group_hours->CurrentValue);
        } else {
            $this->group_hours->ViewValue = null;
        }
        $this->group_hours->ViewCustomAttributes = "";

        // phone
        $this->phone->ViewValue = $this->phone->CurrentValue;
        $this->phone->ViewCustomAttributes = "";

        // subgroup
        $this->subgroup->ViewValue = $this->subgroup->CurrentValue;
        $this->subgroup->ViewCustomAttributes = "";

        // old_id
        $this->old_id->ViewValue = $this->old_id->CurrentValue;
        $this->old_id->ViewValue = FormatNumber($this->old_id->ViewValue, 0, -2, -2, -2);
        $this->old_id->ViewCustomAttributes = "";

        // short_name
        $this->short_name->ViewValue = $this->short_name->CurrentValue;
        $this->short_name->ViewCustomAttributes = "";

        // accept_plus_discount
        $this->accept_plus_discount->ViewValue = $this->accept_plus_discount->CurrentValue;
        $this->accept_plus_discount->ViewValue = FormatNumber($this->accept_plus_discount->ViewValue, 0, -2, -2, -2);
        $this->accept_plus_discount->ViewCustomAttributes = "";

        // lat
        $this->lat->ViewValue = $this->lat->CurrentValue;
        $this->lat->ViewCustomAttributes = "";

        // long
        $this->long->ViewValue = $this->long->CurrentValue;
        $this->long->ViewCustomAttributes = "";

        // ua_mobile_categories
        $this->ua_mobile_categories->ViewValue = $this->ua_mobile_categories->CurrentValue;
        $this->ua_mobile_categories->ViewCustomAttributes = "";

        // breakfast
        if (strval($this->breakfast->CurrentValue) != "") {
            $this->breakfast->ViewValue = $this->breakfast->optionCaption($this->breakfast->CurrentValue);
        } else {
            $this->breakfast->ViewValue = null;
        }
        $this->breakfast->ViewCustomAttributes = "";

        // lunch
        if (strval($this->lunch->CurrentValue) != "") {
            $this->lunch->ViewValue = $this->lunch->optionCaption($this->lunch->CurrentValue);
        } else {
            $this->lunch->ViewValue = null;
        }
        $this->lunch->ViewCustomAttributes = "";

        // dinner
        if (strval($this->dinner->CurrentValue) != "") {
            $this->dinner->ViewValue = $this->dinner->optionCaption($this->dinner->CurrentValue);
        } else {
            $this->dinner->ViewValue = null;
        }
        $this->dinner->ViewCustomAttributes = "";

        // continuous
        if (strval($this->continuous->CurrentValue) != "") {
            $this->continuous->ViewValue = $this->continuous->optionCaption($this->continuous->CurrentValue);
        } else {
            $this->continuous->ViewValue = null;
        }
        $this->continuous->ViewCustomAttributes = "";

        // hours_message
        $this->hours_message->ViewValue = $this->hours_message->CurrentValue;
        $this->hours_message->ViewCustomAttributes = "";

        // location_id
        $this->location_id->LinkCustomAttributes = "";
        $this->location_id->HrefValue = "";
        $this->location_id->TooltipValue = "";

        // location_name
        $this->location_name->LinkCustomAttributes = "";
        $this->location_name->HrefValue = "";
        $this->location_name->TooltipValue = "";

        // location_url
        $this->location_url->LinkCustomAttributes = "";
        $this->location_url->HrefValue = "";
        $this->location_url->TooltipValue = "";

        // group_id
        $this->group_id->LinkCustomAttributes = "";
        $this->group_id->HrefValue = "";
        $this->group_id->TooltipValue = "";

        // active
        $this->active->LinkCustomAttributes = "";
        $this->active->HrefValue = "";
        $this->active->TooltipValue = "";

        // group_hours
        $this->group_hours->LinkCustomAttributes = "";
        $this->group_hours->HrefValue = "";
        $this->group_hours->TooltipValue = "";

        // phone
        $this->phone->LinkCustomAttributes = "";
        $this->phone->HrefValue = "";
        $this->phone->TooltipValue = "";

        // subgroup
        $this->subgroup->LinkCustomAttributes = "";
        $this->subgroup->HrefValue = "";
        $this->subgroup->TooltipValue = "";

        // old_id
        $this->old_id->LinkCustomAttributes = "";
        $this->old_id->HrefValue = "";
        $this->old_id->TooltipValue = "";

        // short_name
        $this->short_name->LinkCustomAttributes = "";
        $this->short_name->HrefValue = "";
        $this->short_name->TooltipValue = "";

        // accept_plus_discount
        $this->accept_plus_discount->LinkCustomAttributes = "";
        $this->accept_plus_discount->HrefValue = "";
        $this->accept_plus_discount->TooltipValue = "";

        // lat
        $this->lat->LinkCustomAttributes = "";
        $this->lat->HrefValue = "";
        $this->lat->TooltipValue = "";

        // long
        $this->long->LinkCustomAttributes = "";
        $this->long->HrefValue = "";
        $this->long->TooltipValue = "";

        // ua_mobile_categories
        $this->ua_mobile_categories->LinkCustomAttributes = "";
        $this->ua_mobile_categories->HrefValue = "";
        $this->ua_mobile_categories->TooltipValue = "";

        // breakfast
        $this->breakfast->LinkCustomAttributes = "";
        $this->breakfast->HrefValue = "";
        $this->breakfast->TooltipValue = "";

        // lunch
        $this->lunch->LinkCustomAttributes = "";
        $this->lunch->HrefValue = "";
        $this->lunch->TooltipValue = "";

        // dinner
        $this->dinner->LinkCustomAttributes = "";
        $this->dinner->HrefValue = "";
        $this->dinner->TooltipValue = "";

        // continuous
        $this->continuous->LinkCustomAttributes = "";
        $this->continuous->HrefValue = "";
        $this->continuous->TooltipValue = "";

        // hours_message
        $this->hours_message->LinkCustomAttributes = "";
        $this->hours_message->HrefValue = "";
        $this->hours_message->TooltipValue = "";

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

        // location_id
        $this->location_id->EditAttrs["class"] = "form-control";
        $this->location_id->EditCustomAttributes = "";
        $this->location_id->EditValue = $this->location_id->CurrentValue;
        $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());

        // location_name
        $this->location_name->EditAttrs["class"] = "form-control";
        $this->location_name->EditCustomAttributes = "";
        $this->location_name->EditValue = $this->location_name->CurrentValue;
        $this->location_name->PlaceHolder = RemoveHtml($this->location_name->caption());

        // location_url
        $this->location_url->EditAttrs["class"] = "form-control";
        $this->location_url->EditCustomAttributes = "";
        $this->location_url->EditValue = $this->location_url->CurrentValue;
        $this->location_url->PlaceHolder = RemoveHtml($this->location_url->caption());

        // group_id
        $this->group_id->EditAttrs["class"] = "form-control";
        $this->group_id->EditCustomAttributes = "";
        $this->group_id->EditValue = $this->group_id->CurrentValue;
        $this->group_id->PlaceHolder = RemoveHtml($this->group_id->caption());

        // active
        $this->active->EditAttrs["class"] = "form-control";
        $this->active->EditCustomAttributes = "";
        $this->active->EditValue = $this->active->CurrentValue;
        $this->active->PlaceHolder = RemoveHtml($this->active->caption());

        // group_hours
        $this->group_hours->EditCustomAttributes = "";
        $this->group_hours->EditValue = $this->group_hours->options(false);
        $this->group_hours->PlaceHolder = RemoveHtml($this->group_hours->caption());

        // phone
        $this->phone->EditAttrs["class"] = "form-control";
        $this->phone->EditCustomAttributes = "";
        $this->phone->EditValue = $this->phone->CurrentValue;
        $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

        // subgroup
        $this->subgroup->EditAttrs["class"] = "form-control";
        $this->subgroup->EditCustomAttributes = "";
        $this->subgroup->EditValue = $this->subgroup->CurrentValue;
        $this->subgroup->PlaceHolder = RemoveHtml($this->subgroup->caption());

        // old_id
        $this->old_id->EditAttrs["class"] = "form-control";
        $this->old_id->EditCustomAttributes = "";
        $this->old_id->EditValue = $this->old_id->CurrentValue;
        $this->old_id->PlaceHolder = RemoveHtml($this->old_id->caption());

        // short_name
        $this->short_name->EditAttrs["class"] = "form-control";
        $this->short_name->EditCustomAttributes = "";
        $this->short_name->EditValue = $this->short_name->CurrentValue;
        $this->short_name->PlaceHolder = RemoveHtml($this->short_name->caption());

        // accept_plus_discount
        $this->accept_plus_discount->EditAttrs["class"] = "form-control";
        $this->accept_plus_discount->EditCustomAttributes = "";
        $this->accept_plus_discount->EditValue = $this->accept_plus_discount->CurrentValue;
        $this->accept_plus_discount->PlaceHolder = RemoveHtml($this->accept_plus_discount->caption());

        // lat
        $this->lat->EditAttrs["class"] = "form-control";
        $this->lat->EditCustomAttributes = "";
        $this->lat->EditValue = $this->lat->CurrentValue;
        $this->lat->PlaceHolder = RemoveHtml($this->lat->caption());

        // long
        $this->long->EditAttrs["class"] = "form-control";
        $this->long->EditCustomAttributes = "";
        $this->long->EditValue = $this->long->CurrentValue;
        $this->long->PlaceHolder = RemoveHtml($this->long->caption());

        // ua_mobile_categories
        $this->ua_mobile_categories->EditAttrs["class"] = "form-control";
        $this->ua_mobile_categories->EditCustomAttributes = "";
        $this->ua_mobile_categories->EditValue = $this->ua_mobile_categories->CurrentValue;
        $this->ua_mobile_categories->PlaceHolder = RemoveHtml($this->ua_mobile_categories->caption());

        // breakfast
        $this->breakfast->EditCustomAttributes = "";
        $this->breakfast->EditValue = $this->breakfast->options(false);
        $this->breakfast->PlaceHolder = RemoveHtml($this->breakfast->caption());

        // lunch
        $this->lunch->EditCustomAttributes = "";
        $this->lunch->EditValue = $this->lunch->options(false);
        $this->lunch->PlaceHolder = RemoveHtml($this->lunch->caption());

        // dinner
        $this->dinner->EditCustomAttributes = "";
        $this->dinner->EditValue = $this->dinner->options(false);
        $this->dinner->PlaceHolder = RemoveHtml($this->dinner->caption());

        // continuous
        $this->continuous->EditCustomAttributes = "";
        $this->continuous->EditValue = $this->continuous->options(false);
        $this->continuous->PlaceHolder = RemoveHtml($this->continuous->caption());

        // hours_message
        $this->hours_message->EditAttrs["class"] = "form-control";
        $this->hours_message->EditCustomAttributes = "";
        $this->hours_message->EditValue = $this->hours_message->CurrentValue;
        $this->hours_message->PlaceHolder = RemoveHtml($this->hours_message->caption());

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
                    $doc->exportCaption($this->location_id);
                    $doc->exportCaption($this->location_name);
                    $doc->exportCaption($this->location_url);
                    $doc->exportCaption($this->group_id);
                    $doc->exportCaption($this->active);
                    $doc->exportCaption($this->group_hours);
                    $doc->exportCaption($this->phone);
                    $doc->exportCaption($this->subgroup);
                    $doc->exportCaption($this->old_id);
                    $doc->exportCaption($this->short_name);
                    $doc->exportCaption($this->accept_plus_discount);
                    $doc->exportCaption($this->lat);
                    $doc->exportCaption($this->long);
                    $doc->exportCaption($this->ua_mobile_categories);
                    $doc->exportCaption($this->breakfast);
                    $doc->exportCaption($this->lunch);
                    $doc->exportCaption($this->dinner);
                    $doc->exportCaption($this->continuous);
                    $doc->exportCaption($this->hours_message);
                } else {
                    $doc->exportCaption($this->location_id);
                    $doc->exportCaption($this->group_id);
                    $doc->exportCaption($this->group_hours);
                    $doc->exportCaption($this->old_id);
                    $doc->exportCaption($this->accept_plus_discount);
                    $doc->exportCaption($this->breakfast);
                    $doc->exportCaption($this->lunch);
                    $doc->exportCaption($this->dinner);
                    $doc->exportCaption($this->continuous);
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
                        $doc->exportField($this->location_id);
                        $doc->exportField($this->location_name);
                        $doc->exportField($this->location_url);
                        $doc->exportField($this->group_id);
                        $doc->exportField($this->active);
                        $doc->exportField($this->group_hours);
                        $doc->exportField($this->phone);
                        $doc->exportField($this->subgroup);
                        $doc->exportField($this->old_id);
                        $doc->exportField($this->short_name);
                        $doc->exportField($this->accept_plus_discount);
                        $doc->exportField($this->lat);
                        $doc->exportField($this->long);
                        $doc->exportField($this->ua_mobile_categories);
                        $doc->exportField($this->breakfast);
                        $doc->exportField($this->lunch);
                        $doc->exportField($this->dinner);
                        $doc->exportField($this->continuous);
                        $doc->exportField($this->hours_message);
                    } else {
                        $doc->exportField($this->location_id);
                        $doc->exportField($this->group_id);
                        $doc->exportField($this->group_hours);
                        $doc->exportField($this->old_id);
                        $doc->exportField($this->accept_plus_discount);
                        $doc->exportField($this->breakfast);
                        $doc->exportField($this->lunch);
                        $doc->exportField($this->dinner);
                        $doc->exportField($this->continuous);
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
