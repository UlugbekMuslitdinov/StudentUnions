<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for catering_highland
 */
class CateringHighland extends DbTable
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
    public $burrito_12;
    public $burrito_8;
    public $extra_chips;
    public $extra_salsa;
    public $extra_sourcream;
    public $extra_guacamole;
    public $upgrade;
    public $coke;
    public $diet_coke;
    public $sprite;
    public $fanta;
    public $water;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'catering_highland';
        $this->TableName = 'catering_highland';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`catering_highland`";
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
        $this->id = new DbField('catering_highland', 'catering_highland', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // catering_id
        $this->catering_id = new DbField('catering_highland', 'catering_highland', 'x_catering_id', 'catering_id', '`catering_id`', '`catering_id`', 3, 11, -1, false, '`catering_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->catering_id->Sortable = true; // Allow sort
        $this->catering_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['catering_id'] = &$this->catering_id;

        // burrito_12
        $this->burrito_12 = new DbField('catering_highland', 'catering_highland', 'x_burrito_12', 'burrito_12', '`burrito_12`', '`burrito_12`', 16, 4, -1, false, '`burrito_12`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->burrito_12->Sortable = true; // Allow sort
        $this->burrito_12->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['burrito_12'] = &$this->burrito_12;

        // burrito_8
        $this->burrito_8 = new DbField('catering_highland', 'catering_highland', 'x_burrito_8', 'burrito_8', '`burrito_8`', '`burrito_8`', 16, 4, -1, false, '`burrito_8`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->burrito_8->Sortable = true; // Allow sort
        $this->burrito_8->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['burrito_8'] = &$this->burrito_8;

        // extra_chips
        $this->extra_chips = new DbField('catering_highland', 'catering_highland', 'x_extra_chips', 'extra_chips', '`extra_chips`', '`extra_chips`', 16, 4, -1, false, '`extra_chips`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->extra_chips->Sortable = true; // Allow sort
        $this->extra_chips->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['extra_chips'] = &$this->extra_chips;

        // extra_salsa
        $this->extra_salsa = new DbField('catering_highland', 'catering_highland', 'x_extra_salsa', 'extra_salsa', '`extra_salsa`', '`extra_salsa`', 16, 4, -1, false, '`extra_salsa`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->extra_salsa->Sortable = true; // Allow sort
        $this->extra_salsa->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['extra_salsa'] = &$this->extra_salsa;

        // extra_sourcream
        $this->extra_sourcream = new DbField('catering_highland', 'catering_highland', 'x_extra_sourcream', 'extra_sourcream', '`extra_sourcream`', '`extra_sourcream`', 16, 4, -1, false, '`extra_sourcream`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->extra_sourcream->Sortable = true; // Allow sort
        $this->extra_sourcream->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['extra_sourcream'] = &$this->extra_sourcream;

        // extra_guacamole
        $this->extra_guacamole = new DbField('catering_highland', 'catering_highland', 'x_extra_guacamole', 'extra_guacamole', '`extra_guacamole`', '`extra_guacamole`', 16, 4, -1, false, '`extra_guacamole`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->extra_guacamole->Sortable = true; // Allow sort
        $this->extra_guacamole->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['extra_guacamole'] = &$this->extra_guacamole;

        // upgrade
        $this->upgrade = new DbField('catering_highland', 'catering_highland', 'x_upgrade', 'upgrade', '`upgrade`', '`upgrade`', 16, 4, -1, false, '`upgrade`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->upgrade->Sortable = true; // Allow sort
        $this->upgrade->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['upgrade'] = &$this->upgrade;

        // coke
        $this->coke = new DbField('catering_highland', 'catering_highland', 'x_coke', 'coke', '`coke`', '`coke`', 3, 100, -1, false, '`coke`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->coke->Sortable = true; // Allow sort
        $this->coke->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['coke'] = &$this->coke;

        // diet_coke
        $this->diet_coke = new DbField('catering_highland', 'catering_highland', 'x_diet_coke', 'diet_coke', '`diet_coke`', '`diet_coke`', 3, 100, -1, false, '`diet_coke`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->diet_coke->Sortable = true; // Allow sort
        $this->diet_coke->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['diet_coke'] = &$this->diet_coke;

        // sprite
        $this->sprite = new DbField('catering_highland', 'catering_highland', 'x_sprite', 'sprite', '`sprite`', '`sprite`', 3, 100, -1, false, '`sprite`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sprite->Sortable = true; // Allow sort
        $this->sprite->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sprite'] = &$this->sprite;

        // fanta
        $this->fanta = new DbField('catering_highland', 'catering_highland', 'x_fanta', 'fanta', '`fanta`', '`fanta`', 3, 100, -1, false, '`fanta`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->fanta->Sortable = true; // Allow sort
        $this->fanta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['fanta'] = &$this->fanta;

        // water
        $this->water = new DbField('catering_highland', 'catering_highland', 'x_water', 'water', '`water`', '`water`', 3, 100, -1, false, '`water`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->water->Sortable = true; // Allow sort
        $this->water->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['water'] = &$this->water;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`catering_highland`";
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
        $this->burrito_12->DbValue = $row['burrito_12'];
        $this->burrito_8->DbValue = $row['burrito_8'];
        $this->extra_chips->DbValue = $row['extra_chips'];
        $this->extra_salsa->DbValue = $row['extra_salsa'];
        $this->extra_sourcream->DbValue = $row['extra_sourcream'];
        $this->extra_guacamole->DbValue = $row['extra_guacamole'];
        $this->upgrade->DbValue = $row['upgrade'];
        $this->coke->DbValue = $row['coke'];
        $this->diet_coke->DbValue = $row['diet_coke'];
        $this->sprite->DbValue = $row['sprite'];
        $this->fanta->DbValue = $row['fanta'];
        $this->water->DbValue = $row['water'];
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
            return GetUrl("CateringHighlandList");
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
        if ($pageName == "CateringHighlandView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CateringHighlandEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CateringHighlandAdd") {
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
                return "CateringHighlandView";
            case Config("API_ADD_ACTION"):
                return "CateringHighlandAdd";
            case Config("API_EDIT_ACTION"):
                return "CateringHighlandEdit";
            case Config("API_DELETE_ACTION"):
                return "CateringHighlandDelete";
            case Config("API_LIST_ACTION"):
                return "CateringHighlandList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CateringHighlandList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CateringHighlandView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CateringHighlandView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CateringHighlandAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CateringHighlandAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CateringHighlandEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CateringHighlandAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CateringHighlandDelete", $this->getUrlParm());
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
        $this->burrito_12->setDbValue($row['burrito_12']);
        $this->burrito_8->setDbValue($row['burrito_8']);
        $this->extra_chips->setDbValue($row['extra_chips']);
        $this->extra_salsa->setDbValue($row['extra_salsa']);
        $this->extra_sourcream->setDbValue($row['extra_sourcream']);
        $this->extra_guacamole->setDbValue($row['extra_guacamole']);
        $this->upgrade->setDbValue($row['upgrade']);
        $this->coke->setDbValue($row['coke']);
        $this->diet_coke->setDbValue($row['diet_coke']);
        $this->sprite->setDbValue($row['sprite']);
        $this->fanta->setDbValue($row['fanta']);
        $this->water->setDbValue($row['water']);
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

        // burrito_12

        // burrito_8

        // extra_chips

        // extra_salsa

        // extra_sourcream

        // extra_guacamole

        // upgrade

        // coke

        // diet_coke

        // sprite

        // fanta

        // water

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // catering_id
        $this->catering_id->ViewValue = $this->catering_id->CurrentValue;
        $this->catering_id->ViewValue = FormatNumber($this->catering_id->ViewValue, 0, -2, -2, -2);
        $this->catering_id->ViewCustomAttributes = "";

        // burrito_12
        $this->burrito_12->ViewValue = $this->burrito_12->CurrentValue;
        $this->burrito_12->ViewValue = FormatNumber($this->burrito_12->ViewValue, 0, -2, -2, -2);
        $this->burrito_12->ViewCustomAttributes = "";

        // burrito_8
        $this->burrito_8->ViewValue = $this->burrito_8->CurrentValue;
        $this->burrito_8->ViewValue = FormatNumber($this->burrito_8->ViewValue, 0, -2, -2, -2);
        $this->burrito_8->ViewCustomAttributes = "";

        // extra_chips
        $this->extra_chips->ViewValue = $this->extra_chips->CurrentValue;
        $this->extra_chips->ViewValue = FormatNumber($this->extra_chips->ViewValue, 0, -2, -2, -2);
        $this->extra_chips->ViewCustomAttributes = "";

        // extra_salsa
        $this->extra_salsa->ViewValue = $this->extra_salsa->CurrentValue;
        $this->extra_salsa->ViewValue = FormatNumber($this->extra_salsa->ViewValue, 0, -2, -2, -2);
        $this->extra_salsa->ViewCustomAttributes = "";

        // extra_sourcream
        $this->extra_sourcream->ViewValue = $this->extra_sourcream->CurrentValue;
        $this->extra_sourcream->ViewValue = FormatNumber($this->extra_sourcream->ViewValue, 0, -2, -2, -2);
        $this->extra_sourcream->ViewCustomAttributes = "";

        // extra_guacamole
        $this->extra_guacamole->ViewValue = $this->extra_guacamole->CurrentValue;
        $this->extra_guacamole->ViewValue = FormatNumber($this->extra_guacamole->ViewValue, 0, -2, -2, -2);
        $this->extra_guacamole->ViewCustomAttributes = "";

        // upgrade
        $this->upgrade->ViewValue = $this->upgrade->CurrentValue;
        $this->upgrade->ViewValue = FormatNumber($this->upgrade->ViewValue, 0, -2, -2, -2);
        $this->upgrade->ViewCustomAttributes = "";

        // coke
        $this->coke->ViewValue = $this->coke->CurrentValue;
        $this->coke->ViewValue = FormatNumber($this->coke->ViewValue, 0, -2, -2, -2);
        $this->coke->ViewCustomAttributes = "";

        // diet_coke
        $this->diet_coke->ViewValue = $this->diet_coke->CurrentValue;
        $this->diet_coke->ViewValue = FormatNumber($this->diet_coke->ViewValue, 0, -2, -2, -2);
        $this->diet_coke->ViewCustomAttributes = "";

        // sprite
        $this->sprite->ViewValue = $this->sprite->CurrentValue;
        $this->sprite->ViewValue = FormatNumber($this->sprite->ViewValue, 0, -2, -2, -2);
        $this->sprite->ViewCustomAttributes = "";

        // fanta
        $this->fanta->ViewValue = $this->fanta->CurrentValue;
        $this->fanta->ViewValue = FormatNumber($this->fanta->ViewValue, 0, -2, -2, -2);
        $this->fanta->ViewCustomAttributes = "";

        // water
        $this->water->ViewValue = $this->water->CurrentValue;
        $this->water->ViewValue = FormatNumber($this->water->ViewValue, 0, -2, -2, -2);
        $this->water->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // catering_id
        $this->catering_id->LinkCustomAttributes = "";
        $this->catering_id->HrefValue = "";
        $this->catering_id->TooltipValue = "";

        // burrito_12
        $this->burrito_12->LinkCustomAttributes = "";
        $this->burrito_12->HrefValue = "";
        $this->burrito_12->TooltipValue = "";

        // burrito_8
        $this->burrito_8->LinkCustomAttributes = "";
        $this->burrito_8->HrefValue = "";
        $this->burrito_8->TooltipValue = "";

        // extra_chips
        $this->extra_chips->LinkCustomAttributes = "";
        $this->extra_chips->HrefValue = "";
        $this->extra_chips->TooltipValue = "";

        // extra_salsa
        $this->extra_salsa->LinkCustomAttributes = "";
        $this->extra_salsa->HrefValue = "";
        $this->extra_salsa->TooltipValue = "";

        // extra_sourcream
        $this->extra_sourcream->LinkCustomAttributes = "";
        $this->extra_sourcream->HrefValue = "";
        $this->extra_sourcream->TooltipValue = "";

        // extra_guacamole
        $this->extra_guacamole->LinkCustomAttributes = "";
        $this->extra_guacamole->HrefValue = "";
        $this->extra_guacamole->TooltipValue = "";

        // upgrade
        $this->upgrade->LinkCustomAttributes = "";
        $this->upgrade->HrefValue = "";
        $this->upgrade->TooltipValue = "";

        // coke
        $this->coke->LinkCustomAttributes = "";
        $this->coke->HrefValue = "";
        $this->coke->TooltipValue = "";

        // diet_coke
        $this->diet_coke->LinkCustomAttributes = "";
        $this->diet_coke->HrefValue = "";
        $this->diet_coke->TooltipValue = "";

        // sprite
        $this->sprite->LinkCustomAttributes = "";
        $this->sprite->HrefValue = "";
        $this->sprite->TooltipValue = "";

        // fanta
        $this->fanta->LinkCustomAttributes = "";
        $this->fanta->HrefValue = "";
        $this->fanta->TooltipValue = "";

        // water
        $this->water->LinkCustomAttributes = "";
        $this->water->HrefValue = "";
        $this->water->TooltipValue = "";

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

        // burrito_12
        $this->burrito_12->EditAttrs["class"] = "form-control";
        $this->burrito_12->EditCustomAttributes = "";
        $this->burrito_12->EditValue = $this->burrito_12->CurrentValue;
        $this->burrito_12->PlaceHolder = RemoveHtml($this->burrito_12->caption());

        // burrito_8
        $this->burrito_8->EditAttrs["class"] = "form-control";
        $this->burrito_8->EditCustomAttributes = "";
        $this->burrito_8->EditValue = $this->burrito_8->CurrentValue;
        $this->burrito_8->PlaceHolder = RemoveHtml($this->burrito_8->caption());

        // extra_chips
        $this->extra_chips->EditAttrs["class"] = "form-control";
        $this->extra_chips->EditCustomAttributes = "";
        $this->extra_chips->EditValue = $this->extra_chips->CurrentValue;
        $this->extra_chips->PlaceHolder = RemoveHtml($this->extra_chips->caption());

        // extra_salsa
        $this->extra_salsa->EditAttrs["class"] = "form-control";
        $this->extra_salsa->EditCustomAttributes = "";
        $this->extra_salsa->EditValue = $this->extra_salsa->CurrentValue;
        $this->extra_salsa->PlaceHolder = RemoveHtml($this->extra_salsa->caption());

        // extra_sourcream
        $this->extra_sourcream->EditAttrs["class"] = "form-control";
        $this->extra_sourcream->EditCustomAttributes = "";
        $this->extra_sourcream->EditValue = $this->extra_sourcream->CurrentValue;
        $this->extra_sourcream->PlaceHolder = RemoveHtml($this->extra_sourcream->caption());

        // extra_guacamole
        $this->extra_guacamole->EditAttrs["class"] = "form-control";
        $this->extra_guacamole->EditCustomAttributes = "";
        $this->extra_guacamole->EditValue = $this->extra_guacamole->CurrentValue;
        $this->extra_guacamole->PlaceHolder = RemoveHtml($this->extra_guacamole->caption());

        // upgrade
        $this->upgrade->EditAttrs["class"] = "form-control";
        $this->upgrade->EditCustomAttributes = "";
        $this->upgrade->EditValue = $this->upgrade->CurrentValue;
        $this->upgrade->PlaceHolder = RemoveHtml($this->upgrade->caption());

        // coke
        $this->coke->EditAttrs["class"] = "form-control";
        $this->coke->EditCustomAttributes = "";
        $this->coke->EditValue = $this->coke->CurrentValue;
        $this->coke->PlaceHolder = RemoveHtml($this->coke->caption());

        // diet_coke
        $this->diet_coke->EditAttrs["class"] = "form-control";
        $this->diet_coke->EditCustomAttributes = "";
        $this->diet_coke->EditValue = $this->diet_coke->CurrentValue;
        $this->diet_coke->PlaceHolder = RemoveHtml($this->diet_coke->caption());

        // sprite
        $this->sprite->EditAttrs["class"] = "form-control";
        $this->sprite->EditCustomAttributes = "";
        $this->sprite->EditValue = $this->sprite->CurrentValue;
        $this->sprite->PlaceHolder = RemoveHtml($this->sprite->caption());

        // fanta
        $this->fanta->EditAttrs["class"] = "form-control";
        $this->fanta->EditCustomAttributes = "";
        $this->fanta->EditValue = $this->fanta->CurrentValue;
        $this->fanta->PlaceHolder = RemoveHtml($this->fanta->caption());

        // water
        $this->water->EditAttrs["class"] = "form-control";
        $this->water->EditCustomAttributes = "";
        $this->water->EditValue = $this->water->CurrentValue;
        $this->water->PlaceHolder = RemoveHtml($this->water->caption());

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
                    $doc->exportCaption($this->burrito_12);
                    $doc->exportCaption($this->burrito_8);
                    $doc->exportCaption($this->extra_chips);
                    $doc->exportCaption($this->extra_salsa);
                    $doc->exportCaption($this->extra_sourcream);
                    $doc->exportCaption($this->extra_guacamole);
                    $doc->exportCaption($this->upgrade);
                    $doc->exportCaption($this->coke);
                    $doc->exportCaption($this->diet_coke);
                    $doc->exportCaption($this->sprite);
                    $doc->exportCaption($this->fanta);
                    $doc->exportCaption($this->water);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->catering_id);
                    $doc->exportCaption($this->burrito_12);
                    $doc->exportCaption($this->burrito_8);
                    $doc->exportCaption($this->extra_chips);
                    $doc->exportCaption($this->extra_salsa);
                    $doc->exportCaption($this->extra_sourcream);
                    $doc->exportCaption($this->extra_guacamole);
                    $doc->exportCaption($this->upgrade);
                    $doc->exportCaption($this->coke);
                    $doc->exportCaption($this->diet_coke);
                    $doc->exportCaption($this->sprite);
                    $doc->exportCaption($this->fanta);
                    $doc->exportCaption($this->water);
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
                        $doc->exportField($this->burrito_12);
                        $doc->exportField($this->burrito_8);
                        $doc->exportField($this->extra_chips);
                        $doc->exportField($this->extra_salsa);
                        $doc->exportField($this->extra_sourcream);
                        $doc->exportField($this->extra_guacamole);
                        $doc->exportField($this->upgrade);
                        $doc->exportField($this->coke);
                        $doc->exportField($this->diet_coke);
                        $doc->exportField($this->sprite);
                        $doc->exportField($this->fanta);
                        $doc->exportField($this->water);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->catering_id);
                        $doc->exportField($this->burrito_12);
                        $doc->exportField($this->burrito_8);
                        $doc->exportField($this->extra_chips);
                        $doc->exportField($this->extra_salsa);
                        $doc->exportField($this->extra_sourcream);
                        $doc->exportField($this->extra_guacamole);
                        $doc->exportField($this->upgrade);
                        $doc->exportField($this->coke);
                        $doc->exportField($this->diet_coke);
                        $doc->exportField($this->sprite);
                        $doc->exportField($this->fanta);
                        $doc->exportField($this->water);
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
