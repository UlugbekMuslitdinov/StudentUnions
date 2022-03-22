<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for config
 */
class Config2 extends DbTable
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
    public $min_deposit;
    public $max_deposit;
    public $current_term_code;
    public $fall_term_code;
    public $spring_term_code;
    public $full_year_begin;
    public $half_year_begin;
    public $year_end;
    public $plus_signup_full;
    public $plus_signup_half;
    public $bursar_deposit_deadline;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'config2';
        $this->TableName = 'config';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`config`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
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
        $this->id = new DbField(
            'config2',
            'config',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            11,
            -1,
            false,
            '`id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->id->InputTextType = "text";
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Nullable = false; // NOT NULL field
        $this->id->Required = true; // Required field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // min_deposit
        $this->min_deposit = new DbField(
            'config2',
            'config',
            'x_min_deposit',
            'min_deposit',
            '`min_deposit`',
            '`min_deposit`',
            131,
            15,
            -1,
            false,
            '`min_deposit`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->min_deposit->InputTextType = "text";
        $this->min_deposit->Nullable = false; // NOT NULL field
        $this->min_deposit->Required = true; // Required field
        $this->min_deposit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['min_deposit'] = &$this->min_deposit;

        // max_deposit
        $this->max_deposit = new DbField(
            'config2',
            'config',
            'x_max_deposit',
            'max_deposit',
            '`max_deposit`',
            '`max_deposit`',
            131,
            15,
            -1,
            false,
            '`max_deposit`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->max_deposit->InputTextType = "text";
        $this->max_deposit->Nullable = false; // NOT NULL field
        $this->max_deposit->Required = true; // Required field
        $this->max_deposit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['max_deposit'] = &$this->max_deposit;

        // current_term_code
        $this->current_term_code = new DbField(
            'config2',
            'config',
            'x_current_term_code',
            'current_term_code',
            '`current_term_code`',
            '`current_term_code`',
            3,
            11,
            -1,
            false,
            '`current_term_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->current_term_code->InputTextType = "text";
        $this->current_term_code->Nullable = false; // NOT NULL field
        $this->current_term_code->Required = true; // Required field
        $this->current_term_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['current_term_code'] = &$this->current_term_code;

        // fall_term_code
        $this->fall_term_code = new DbField(
            'config2',
            'config',
            'x_fall_term_code',
            'fall_term_code',
            '`fall_term_code`',
            '`fall_term_code`',
            3,
            11,
            -1,
            false,
            '`fall_term_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fall_term_code->InputTextType = "text";
        $this->fall_term_code->Nullable = false; // NOT NULL field
        $this->fall_term_code->Required = true; // Required field
        $this->fall_term_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['fall_term_code'] = &$this->fall_term_code;

        // spring_term_code
        $this->spring_term_code = new DbField(
            'config2',
            'config',
            'x_spring_term_code',
            'spring_term_code',
            '`spring_term_code`',
            '`spring_term_code`',
            3,
            11,
            -1,
            false,
            '`spring_term_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->spring_term_code->InputTextType = "text";
        $this->spring_term_code->Nullable = false; // NOT NULL field
        $this->spring_term_code->Required = true; // Required field
        $this->spring_term_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['spring_term_code'] = &$this->spring_term_code;

        // full_year_begin
        $this->full_year_begin = new DbField(
            'config2',
            'config',
            'x_full_year_begin',
            'full_year_begin',
            '`full_year_begin`',
            CastDateFieldForLike("`full_year_begin`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`full_year_begin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->full_year_begin->InputTextType = "text";
        $this->full_year_begin->Nullable = false; // NOT NULL field
        $this->full_year_begin->Required = true; // Required field
        $this->full_year_begin->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['full_year_begin'] = &$this->full_year_begin;

        // half_year_begin
        $this->half_year_begin = new DbField(
            'config2',
            'config',
            'x_half_year_begin',
            'half_year_begin',
            '`half_year_begin`',
            CastDateFieldForLike("`half_year_begin`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`half_year_begin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->half_year_begin->InputTextType = "text";
        $this->half_year_begin->Nullable = false; // NOT NULL field
        $this->half_year_begin->Required = true; // Required field
        $this->half_year_begin->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['half_year_begin'] = &$this->half_year_begin;

        // year_end
        $this->year_end = new DbField(
            'config2',
            'config',
            'x_year_end',
            'year_end',
            '`year_end`',
            CastDateFieldForLike("`year_end`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`year_end`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->year_end->InputTextType = "text";
        $this->year_end->Nullable = false; // NOT NULL field
        $this->year_end->Required = true; // Required field
        $this->year_end->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['year_end'] = &$this->year_end;

        // plus_signup_full
        $this->plus_signup_full = new DbField(
            'config2',
            'config',
            'x_plus_signup_full',
            'plus_signup_full',
            '`plus_signup_full`',
            '`plus_signup_full`',
            16,
            1,
            -1,
            false,
            '`plus_signup_full`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->plus_signup_full->InputTextType = "text";
        $this->plus_signup_full->Nullable = false; // NOT NULL field
        $this->plus_signup_full->Required = true; // Required field
        $this->plus_signup_full->DataType = DATATYPE_BOOLEAN;
        $this->plus_signup_full->Lookup = new Lookup('plus_signup_full', 'config2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->plus_signup_full->OptionCount = 2;
        $this->plus_signup_full->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['plus_signup_full'] = &$this->plus_signup_full;

        // plus_signup_half
        $this->plus_signup_half = new DbField(
            'config2',
            'config',
            'x_plus_signup_half',
            'plus_signup_half',
            '`plus_signup_half`',
            '`plus_signup_half`',
            16,
            1,
            -1,
            false,
            '`plus_signup_half`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->plus_signup_half->InputTextType = "text";
        $this->plus_signup_half->Nullable = false; // NOT NULL field
        $this->plus_signup_half->Required = true; // Required field
        $this->plus_signup_half->DataType = DATATYPE_BOOLEAN;
        $this->plus_signup_half->Lookup = new Lookup('plus_signup_half', 'config2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->plus_signup_half->OptionCount = 2;
        $this->plus_signup_half->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['plus_signup_half'] = &$this->plus_signup_half;

        // bursar_deposit_deadline
        $this->bursar_deposit_deadline = new DbField(
            'config2',
            'config',
            'x_bursar_deposit_deadline',
            'bursar_deposit_deadline',
            '`bursar_deposit_deadline`',
            CastDateFieldForLike("`bursar_deposit_deadline`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`bursar_deposit_deadline`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->bursar_deposit_deadline->InputTextType = "text";
        $this->bursar_deposit_deadline->Nullable = false; // NOT NULL field
        $this->bursar_deposit_deadline->Required = true; // Required field
        $this->bursar_deposit_deadline->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['bursar_deposit_deadline'] = &$this->bursar_deposit_deadline;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`config`";
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
        if ($sql instanceof QueryBuilder) { // Query builder
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
        $cnt = $conn->fetchOne($sqlwrk);
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
    public function insertSql(&$rs)
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
    public function updateSql(&$rs, $where = "", $curfilter = true)
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
    public function deleteSql(&$rs, $where = "", $curfilter = true)
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
        $this->min_deposit->DbValue = $row['min_deposit'];
        $this->max_deposit->DbValue = $row['max_deposit'];
        $this->current_term_code->DbValue = $row['current_term_code'];
        $this->fall_term_code->DbValue = $row['fall_term_code'];
        $this->spring_term_code->DbValue = $row['spring_term_code'];
        $this->full_year_begin->DbValue = $row['full_year_begin'];
        $this->half_year_begin->DbValue = $row['half_year_begin'];
        $this->year_end->DbValue = $row['year_end'];
        $this->plus_signup_full->DbValue = $row['plus_signup_full'];
        $this->plus_signup_half->DbValue = $row['plus_signup_half'];
        $this->bursar_deposit_deadline->DbValue = $row['bursar_deposit_deadline'];
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
        return $_SESSION[$name] ?? GetUrl("Config2List");
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
        if ($pageName == "Config2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "Config2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "Config2Add") {
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
                return "Config2View";
            case Config("API_ADD_ACTION"):
                return "Config2Add";
            case Config("API_EDIT_ACTION"):
                return "Config2Edit";
            case Config("API_DELETE_ACTION"):
                return "Config2Delete";
            case Config("API_LIST_ACTION"):
                return "Config2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "Config2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("Config2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("Config2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "Config2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "Config2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("Config2Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("Config2Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("Config2Delete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
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
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
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
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
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
        $this->min_deposit->setDbValue($row['min_deposit']);
        $this->max_deposit->setDbValue($row['max_deposit']);
        $this->current_term_code->setDbValue($row['current_term_code']);
        $this->fall_term_code->setDbValue($row['fall_term_code']);
        $this->spring_term_code->setDbValue($row['spring_term_code']);
        $this->full_year_begin->setDbValue($row['full_year_begin']);
        $this->half_year_begin->setDbValue($row['half_year_begin']);
        $this->year_end->setDbValue($row['year_end']);
        $this->plus_signup_full->setDbValue($row['plus_signup_full']);
        $this->plus_signup_half->setDbValue($row['plus_signup_half']);
        $this->bursar_deposit_deadline->setDbValue($row['bursar_deposit_deadline']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // min_deposit

        // max_deposit

        // current_term_code

        // fall_term_code

        // spring_term_code

        // full_year_begin

        // half_year_begin

        // year_end

        // plus_signup_full

        // plus_signup_half

        // bursar_deposit_deadline

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, "");
        $this->id->ViewCustomAttributes = "";

        // min_deposit
        $this->min_deposit->ViewValue = $this->min_deposit->CurrentValue;
        $this->min_deposit->ViewValue = FormatNumber($this->min_deposit->ViewValue, "");
        $this->min_deposit->ViewCustomAttributes = "";

        // max_deposit
        $this->max_deposit->ViewValue = $this->max_deposit->CurrentValue;
        $this->max_deposit->ViewValue = FormatNumber($this->max_deposit->ViewValue, "");
        $this->max_deposit->ViewCustomAttributes = "";

        // current_term_code
        $this->current_term_code->ViewValue = $this->current_term_code->CurrentValue;
        $this->current_term_code->ViewValue = FormatNumber($this->current_term_code->ViewValue, "");
        $this->current_term_code->ViewCustomAttributes = "";

        // fall_term_code
        $this->fall_term_code->ViewValue = $this->fall_term_code->CurrentValue;
        $this->fall_term_code->ViewValue = FormatNumber($this->fall_term_code->ViewValue, "");
        $this->fall_term_code->ViewCustomAttributes = "";

        // spring_term_code
        $this->spring_term_code->ViewValue = $this->spring_term_code->CurrentValue;
        $this->spring_term_code->ViewValue = FormatNumber($this->spring_term_code->ViewValue, "");
        $this->spring_term_code->ViewCustomAttributes = "";

        // full_year_begin
        $this->full_year_begin->ViewValue = $this->full_year_begin->CurrentValue;
        $this->full_year_begin->ViewValue = FormatDateTime($this->full_year_begin->ViewValue, 0);
        $this->full_year_begin->ViewCustomAttributes = "";

        // half_year_begin
        $this->half_year_begin->ViewValue = $this->half_year_begin->CurrentValue;
        $this->half_year_begin->ViewValue = FormatDateTime($this->half_year_begin->ViewValue, 0);
        $this->half_year_begin->ViewCustomAttributes = "";

        // year_end
        $this->year_end->ViewValue = $this->year_end->CurrentValue;
        $this->year_end->ViewValue = FormatDateTime($this->year_end->ViewValue, 0);
        $this->year_end->ViewCustomAttributes = "";

        // plus_signup_full
        if (ConvertToBool($this->plus_signup_full->CurrentValue)) {
            $this->plus_signup_full->ViewValue = $this->plus_signup_full->tagCaption(1) != "" ? $this->plus_signup_full->tagCaption(1) : "Yes";
        } else {
            $this->plus_signup_full->ViewValue = $this->plus_signup_full->tagCaption(2) != "" ? $this->plus_signup_full->tagCaption(2) : "No";
        }
        $this->plus_signup_full->ViewCustomAttributes = "";

        // plus_signup_half
        if (ConvertToBool($this->plus_signup_half->CurrentValue)) {
            $this->plus_signup_half->ViewValue = $this->plus_signup_half->tagCaption(1) != "" ? $this->plus_signup_half->tagCaption(1) : "Yes";
        } else {
            $this->plus_signup_half->ViewValue = $this->plus_signup_half->tagCaption(2) != "" ? $this->plus_signup_half->tagCaption(2) : "No";
        }
        $this->plus_signup_half->ViewCustomAttributes = "";

        // bursar_deposit_deadline
        $this->bursar_deposit_deadline->ViewValue = $this->bursar_deposit_deadline->CurrentValue;
        $this->bursar_deposit_deadline->ViewValue = FormatDateTime($this->bursar_deposit_deadline->ViewValue, 0);
        $this->bursar_deposit_deadline->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // min_deposit
        $this->min_deposit->LinkCustomAttributes = "";
        $this->min_deposit->HrefValue = "";
        $this->min_deposit->TooltipValue = "";

        // max_deposit
        $this->max_deposit->LinkCustomAttributes = "";
        $this->max_deposit->HrefValue = "";
        $this->max_deposit->TooltipValue = "";

        // current_term_code
        $this->current_term_code->LinkCustomAttributes = "";
        $this->current_term_code->HrefValue = "";
        $this->current_term_code->TooltipValue = "";

        // fall_term_code
        $this->fall_term_code->LinkCustomAttributes = "";
        $this->fall_term_code->HrefValue = "";
        $this->fall_term_code->TooltipValue = "";

        // spring_term_code
        $this->spring_term_code->LinkCustomAttributes = "";
        $this->spring_term_code->HrefValue = "";
        $this->spring_term_code->TooltipValue = "";

        // full_year_begin
        $this->full_year_begin->LinkCustomAttributes = "";
        $this->full_year_begin->HrefValue = "";
        $this->full_year_begin->TooltipValue = "";

        // half_year_begin
        $this->half_year_begin->LinkCustomAttributes = "";
        $this->half_year_begin->HrefValue = "";
        $this->half_year_begin->TooltipValue = "";

        // year_end
        $this->year_end->LinkCustomAttributes = "";
        $this->year_end->HrefValue = "";
        $this->year_end->TooltipValue = "";

        // plus_signup_full
        $this->plus_signup_full->LinkCustomAttributes = "";
        $this->plus_signup_full->HrefValue = "";
        $this->plus_signup_full->TooltipValue = "";

        // plus_signup_half
        $this->plus_signup_half->LinkCustomAttributes = "";
        $this->plus_signup_half->HrefValue = "";
        $this->plus_signup_half->TooltipValue = "";

        // bursar_deposit_deadline
        $this->bursar_deposit_deadline->LinkCustomAttributes = "";
        $this->bursar_deposit_deadline->HrefValue = "";
        $this->bursar_deposit_deadline->TooltipValue = "";

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
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());

        // min_deposit
        $this->min_deposit->setupEditAttributes();
        $this->min_deposit->EditCustomAttributes = "";
        $this->min_deposit->EditValue = $this->min_deposit->CurrentValue;
        $this->min_deposit->PlaceHolder = RemoveHtml($this->min_deposit->caption());
        if (strval($this->min_deposit->EditValue) != "" && is_numeric($this->min_deposit->EditValue)) {
            $this->min_deposit->EditValue = FormatNumber($this->min_deposit->EditValue, null);
        }

        // max_deposit
        $this->max_deposit->setupEditAttributes();
        $this->max_deposit->EditCustomAttributes = "";
        $this->max_deposit->EditValue = $this->max_deposit->CurrentValue;
        $this->max_deposit->PlaceHolder = RemoveHtml($this->max_deposit->caption());
        if (strval($this->max_deposit->EditValue) != "" && is_numeric($this->max_deposit->EditValue)) {
            $this->max_deposit->EditValue = FormatNumber($this->max_deposit->EditValue, null);
        }

        // current_term_code
        $this->current_term_code->setupEditAttributes();
        $this->current_term_code->EditCustomAttributes = "";
        $this->current_term_code->EditValue = $this->current_term_code->CurrentValue;
        $this->current_term_code->PlaceHolder = RemoveHtml($this->current_term_code->caption());
        if (strval($this->current_term_code->EditValue) != "" && is_numeric($this->current_term_code->EditValue)) {
            $this->current_term_code->EditValue = FormatNumber($this->current_term_code->EditValue, null);
        }

        // fall_term_code
        $this->fall_term_code->setupEditAttributes();
        $this->fall_term_code->EditCustomAttributes = "";
        $this->fall_term_code->EditValue = $this->fall_term_code->CurrentValue;
        $this->fall_term_code->PlaceHolder = RemoveHtml($this->fall_term_code->caption());
        if (strval($this->fall_term_code->EditValue) != "" && is_numeric($this->fall_term_code->EditValue)) {
            $this->fall_term_code->EditValue = FormatNumber($this->fall_term_code->EditValue, null);
        }

        // spring_term_code
        $this->spring_term_code->setupEditAttributes();
        $this->spring_term_code->EditCustomAttributes = "";
        $this->spring_term_code->EditValue = $this->spring_term_code->CurrentValue;
        $this->spring_term_code->PlaceHolder = RemoveHtml($this->spring_term_code->caption());
        if (strval($this->spring_term_code->EditValue) != "" && is_numeric($this->spring_term_code->EditValue)) {
            $this->spring_term_code->EditValue = FormatNumber($this->spring_term_code->EditValue, null);
        }

        // full_year_begin
        $this->full_year_begin->setupEditAttributes();
        $this->full_year_begin->EditCustomAttributes = "";
        $this->full_year_begin->EditValue = FormatDateTime($this->full_year_begin->CurrentValue, 8);
        $this->full_year_begin->PlaceHolder = RemoveHtml($this->full_year_begin->caption());

        // half_year_begin
        $this->half_year_begin->setupEditAttributes();
        $this->half_year_begin->EditCustomAttributes = "";
        $this->half_year_begin->EditValue = FormatDateTime($this->half_year_begin->CurrentValue, 8);
        $this->half_year_begin->PlaceHolder = RemoveHtml($this->half_year_begin->caption());

        // year_end
        $this->year_end->setupEditAttributes();
        $this->year_end->EditCustomAttributes = "";
        $this->year_end->EditValue = FormatDateTime($this->year_end->CurrentValue, 8);
        $this->year_end->PlaceHolder = RemoveHtml($this->year_end->caption());

        // plus_signup_full
        $this->plus_signup_full->EditCustomAttributes = "";
        $this->plus_signup_full->EditValue = $this->plus_signup_full->options(false);
        $this->plus_signup_full->PlaceHolder = RemoveHtml($this->plus_signup_full->caption());

        // plus_signup_half
        $this->plus_signup_half->EditCustomAttributes = "";
        $this->plus_signup_half->EditValue = $this->plus_signup_half->options(false);
        $this->plus_signup_half->PlaceHolder = RemoveHtml($this->plus_signup_half->caption());

        // bursar_deposit_deadline
        $this->bursar_deposit_deadline->setupEditAttributes();
        $this->bursar_deposit_deadline->EditCustomAttributes = "";
        $this->bursar_deposit_deadline->EditValue = FormatDateTime($this->bursar_deposit_deadline->CurrentValue, 8);
        $this->bursar_deposit_deadline->PlaceHolder = RemoveHtml($this->bursar_deposit_deadline->caption());

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
                    $doc->exportCaption($this->min_deposit);
                    $doc->exportCaption($this->max_deposit);
                    $doc->exportCaption($this->current_term_code);
                    $doc->exportCaption($this->fall_term_code);
                    $doc->exportCaption($this->spring_term_code);
                    $doc->exportCaption($this->full_year_begin);
                    $doc->exportCaption($this->half_year_begin);
                    $doc->exportCaption($this->year_end);
                    $doc->exportCaption($this->plus_signup_full);
                    $doc->exportCaption($this->plus_signup_half);
                    $doc->exportCaption($this->bursar_deposit_deadline);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->min_deposit);
                    $doc->exportCaption($this->max_deposit);
                    $doc->exportCaption($this->current_term_code);
                    $doc->exportCaption($this->fall_term_code);
                    $doc->exportCaption($this->spring_term_code);
                    $doc->exportCaption($this->full_year_begin);
                    $doc->exportCaption($this->half_year_begin);
                    $doc->exportCaption($this->year_end);
                    $doc->exportCaption($this->plus_signup_full);
                    $doc->exportCaption($this->plus_signup_half);
                    $doc->exportCaption($this->bursar_deposit_deadline);
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
                        $doc->exportField($this->min_deposit);
                        $doc->exportField($this->max_deposit);
                        $doc->exportField($this->current_term_code);
                        $doc->exportField($this->fall_term_code);
                        $doc->exportField($this->spring_term_code);
                        $doc->exportField($this->full_year_begin);
                        $doc->exportField($this->half_year_begin);
                        $doc->exportField($this->year_end);
                        $doc->exportField($this->plus_signup_full);
                        $doc->exportField($this->plus_signup_half);
                        $doc->exportField($this->bursar_deposit_deadline);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->min_deposit);
                        $doc->exportField($this->max_deposit);
                        $doc->exportField($this->current_term_code);
                        $doc->exportField($this->fall_term_code);
                        $doc->exportField($this->spring_term_code);
                        $doc->exportField($this->full_year_begin);
                        $doc->exportField($this->half_year_begin);
                        $doc->exportField($this->year_end);
                        $doc->exportField($this->plus_signup_full);
                        $doc->exportField($this->plus_signup_half);
                        $doc->exportField($this->bursar_deposit_deadline);
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
