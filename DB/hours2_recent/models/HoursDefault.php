<?php

namespace PHPMaker2022\project2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for hours_default
 */
class HoursDefault extends DbTable
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
    public $hour_id;
    public $mon_open;
    public $mon_close;
    public $tue_open;
    public $tue_close;
    public $wed_open;
    public $wed_close;
    public $thu_open;
    public $thu_close;
    public $fri_open;
    public $fri_close;
    public $sat_open;
    public $sat_close;
    public $sun_open;
    public $sun_close;
    public $close;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'hours_default';
        $this->TableName = 'hours_default';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`hours_default`";
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

        // hour_id
        $this->hour_id = new DbField(
            'hours_default',
            'hours_default',
            'x_hour_id',
            'hour_id',
            '`hour_id`',
            '`hour_id`',
            3,
            11,
            -1,
            false,
            '`hour_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->hour_id->InputTextType = "text";
        $this->hour_id->IsPrimaryKey = true; // Primary key field
        $this->hour_id->Nullable = false; // NOT NULL field
        $this->hour_id->Required = true; // Required field
        $this->hour_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['hour_id'] = &$this->hour_id;

        // mon_open
        $this->mon_open = new DbField(
            'hours_default',
            'hours_default',
            'x_mon_open',
            'mon_open',
            '`mon_open`',
            CastDateFieldForLike("`mon_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`mon_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mon_open->InputTextType = "text";
        $this->mon_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['mon_open'] = &$this->mon_open;

        // mon_close
        $this->mon_close = new DbField(
            'hours_default',
            'hours_default',
            'x_mon_close',
            'mon_close',
            '`mon_close`',
            CastDateFieldForLike("`mon_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`mon_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mon_close->InputTextType = "text";
        $this->mon_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['mon_close'] = &$this->mon_close;

        // tue_open
        $this->tue_open = new DbField(
            'hours_default',
            'hours_default',
            'x_tue_open',
            'tue_open',
            '`tue_open`',
            CastDateFieldForLike("`tue_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`tue_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tue_open->InputTextType = "text";
        $this->tue_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['tue_open'] = &$this->tue_open;

        // tue_close
        $this->tue_close = new DbField(
            'hours_default',
            'hours_default',
            'x_tue_close',
            'tue_close',
            '`tue_close`',
            CastDateFieldForLike("`tue_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`tue_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tue_close->InputTextType = "text";
        $this->tue_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['tue_close'] = &$this->tue_close;

        // wed_open
        $this->wed_open = new DbField(
            'hours_default',
            'hours_default',
            'x_wed_open',
            'wed_open',
            '`wed_open`',
            CastDateFieldForLike("`wed_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`wed_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->wed_open->InputTextType = "text";
        $this->wed_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['wed_open'] = &$this->wed_open;

        // wed_close
        $this->wed_close = new DbField(
            'hours_default',
            'hours_default',
            'x_wed_close',
            'wed_close',
            '`wed_close`',
            CastDateFieldForLike("`wed_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`wed_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->wed_close->InputTextType = "text";
        $this->wed_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['wed_close'] = &$this->wed_close;

        // thu_open
        $this->thu_open = new DbField(
            'hours_default',
            'hours_default',
            'x_thu_open',
            'thu_open',
            '`thu_open`',
            CastDateFieldForLike("`thu_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`thu_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->thu_open->InputTextType = "text";
        $this->thu_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['thu_open'] = &$this->thu_open;

        // thu_close
        $this->thu_close = new DbField(
            'hours_default',
            'hours_default',
            'x_thu_close',
            'thu_close',
            '`thu_close`',
            CastDateFieldForLike("`thu_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`thu_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->thu_close->InputTextType = "text";
        $this->thu_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['thu_close'] = &$this->thu_close;

        // fri_open
        $this->fri_open = new DbField(
            'hours_default',
            'hours_default',
            'x_fri_open',
            'fri_open',
            '`fri_open`',
            CastDateFieldForLike("`fri_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`fri_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fri_open->InputTextType = "text";
        $this->fri_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['fri_open'] = &$this->fri_open;

        // fri_close
        $this->fri_close = new DbField(
            'hours_default',
            'hours_default',
            'x_fri_close',
            'fri_close',
            '`fri_close`',
            CastDateFieldForLike("`fri_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`fri_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fri_close->InputTextType = "text";
        $this->fri_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['fri_close'] = &$this->fri_close;

        // sat_open
        $this->sat_open = new DbField(
            'hours_default',
            'hours_default',
            'x_sat_open',
            'sat_open',
            '`sat_open`',
            CastDateFieldForLike("`sat_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sat_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sat_open->InputTextType = "text";
        $this->sat_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sat_open'] = &$this->sat_open;

        // sat_close
        $this->sat_close = new DbField(
            'hours_default',
            'hours_default',
            'x_sat_close',
            'sat_close',
            '`sat_close`',
            CastDateFieldForLike("`sat_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sat_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sat_close->InputTextType = "text";
        $this->sat_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sat_close'] = &$this->sat_close;

        // sun_open
        $this->sun_open = new DbField(
            'hours_default',
            'hours_default',
            'x_sun_open',
            'sun_open',
            '`sun_open`',
            CastDateFieldForLike("`sun_open`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sun_open`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sun_open->InputTextType = "text";
        $this->sun_open->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sun_open'] = &$this->sun_open;

        // sun_close
        $this->sun_close = new DbField(
            'hours_default',
            'hours_default',
            'x_sun_close',
            'sun_close',
            '`sun_close`',
            CastDateFieldForLike("`sun_close`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sun_close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sun_close->InputTextType = "text";
        $this->sun_close->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sun_close'] = &$this->sun_close;

        // close
        $this->close = new DbField(
            'hours_default',
            'hours_default',
            'x_close',
            'close',
            '`close`',
            '`close`',
            200,
            6,
            -1,
            false,
            '`close`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->close->InputTextType = "text";
        $this->Fields['close'] = &$this->close;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`hours_default`";
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
            if (array_key_exists('hour_id', $rs)) {
                AddFilter($where, QuotedName('hour_id', $this->Dbid) . '=' . QuotedValue($rs['hour_id'], $this->hour_id->DataType, $this->Dbid));
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
        $this->hour_id->DbValue = $row['hour_id'];
        $this->mon_open->DbValue = $row['mon_open'];
        $this->mon_close->DbValue = $row['mon_close'];
        $this->tue_open->DbValue = $row['tue_open'];
        $this->tue_close->DbValue = $row['tue_close'];
        $this->wed_open->DbValue = $row['wed_open'];
        $this->wed_close->DbValue = $row['wed_close'];
        $this->thu_open->DbValue = $row['thu_open'];
        $this->thu_close->DbValue = $row['thu_close'];
        $this->fri_open->DbValue = $row['fri_open'];
        $this->fri_close->DbValue = $row['fri_close'];
        $this->sat_open->DbValue = $row['sat_open'];
        $this->sat_close->DbValue = $row['sat_close'];
        $this->sun_open->DbValue = $row['sun_open'];
        $this->sun_close->DbValue = $row['sun_close'];
        $this->close->DbValue = $row['close'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`hour_id` = @hour_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->hour_id->CurrentValue : $this->hour_id->OldValue;
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
                $this->hour_id->CurrentValue = $keys[0];
            } else {
                $this->hour_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('hour_id', $row) ? $row['hour_id'] : null;
        } else {
            $val = $this->hour_id->OldValue !== null ? $this->hour_id->OldValue : $this->hour_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@hour_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("HoursDefaultList");
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
        if ($pageName == "HoursDefaultView") {
            return $Language->phrase("View");
        } elseif ($pageName == "HoursDefaultEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "HoursDefaultAdd") {
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
                return "HoursDefaultView";
            case Config("API_ADD_ACTION"):
                return "HoursDefaultAdd";
            case Config("API_EDIT_ACTION"):
                return "HoursDefaultEdit";
            case Config("API_DELETE_ACTION"):
                return "HoursDefaultDelete";
            case Config("API_LIST_ACTION"):
                return "HoursDefaultList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "HoursDefaultList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("HoursDefaultView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("HoursDefaultView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "HoursDefaultAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "HoursDefaultAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("HoursDefaultEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("HoursDefaultAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("HoursDefaultDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"hour_id\":" . JsonEncode($this->hour_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->hour_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->hour_id->CurrentValue);
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
            if (($keyValue = Param("hour_id") ?? Route("hour_id")) !== null) {
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
                $this->hour_id->CurrentValue = $key;
            } else {
                $this->hour_id->OldValue = $key;
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
        $this->hour_id->setDbValue($row['hour_id']);
        $this->mon_open->setDbValue($row['mon_open']);
        $this->mon_close->setDbValue($row['mon_close']);
        $this->tue_open->setDbValue($row['tue_open']);
        $this->tue_close->setDbValue($row['tue_close']);
        $this->wed_open->setDbValue($row['wed_open']);
        $this->wed_close->setDbValue($row['wed_close']);
        $this->thu_open->setDbValue($row['thu_open']);
        $this->thu_close->setDbValue($row['thu_close']);
        $this->fri_open->setDbValue($row['fri_open']);
        $this->fri_close->setDbValue($row['fri_close']);
        $this->sat_open->setDbValue($row['sat_open']);
        $this->sat_close->setDbValue($row['sat_close']);
        $this->sun_open->setDbValue($row['sun_open']);
        $this->sun_close->setDbValue($row['sun_close']);
        $this->close->setDbValue($row['close']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // hour_id

        // mon_open

        // mon_close

        // tue_open

        // tue_close

        // wed_open

        // wed_close

        // thu_open

        // thu_close

        // fri_open

        // fri_close

        // sat_open

        // sat_close

        // sun_open

        // sun_close

        // close

        // hour_id
        $this->hour_id->ViewValue = $this->hour_id->CurrentValue;
        $this->hour_id->ViewValue = FormatNumber($this->hour_id->ViewValue, "");
        $this->hour_id->ViewCustomAttributes = "";

        // mon_open
        $this->mon_open->ViewValue = $this->mon_open->CurrentValue;
        $this->mon_open->ViewValue = FormatDateTime($this->mon_open->ViewValue, 4);
        $this->mon_open->ViewCustomAttributes = "";

        // mon_close
        $this->mon_close->ViewValue = $this->mon_close->CurrentValue;
        $this->mon_close->ViewValue = FormatDateTime($this->mon_close->ViewValue, 4);
        $this->mon_close->ViewCustomAttributes = "";

        // tue_open
        $this->tue_open->ViewValue = $this->tue_open->CurrentValue;
        $this->tue_open->ViewValue = FormatDateTime($this->tue_open->ViewValue, 4);
        $this->tue_open->ViewCustomAttributes = "";

        // tue_close
        $this->tue_close->ViewValue = $this->tue_close->CurrentValue;
        $this->tue_close->ViewValue = FormatDateTime($this->tue_close->ViewValue, 4);
        $this->tue_close->ViewCustomAttributes = "";

        // wed_open
        $this->wed_open->ViewValue = $this->wed_open->CurrentValue;
        $this->wed_open->ViewValue = FormatDateTime($this->wed_open->ViewValue, 4);
        $this->wed_open->ViewCustomAttributes = "";

        // wed_close
        $this->wed_close->ViewValue = $this->wed_close->CurrentValue;
        $this->wed_close->ViewValue = FormatDateTime($this->wed_close->ViewValue, 4);
        $this->wed_close->ViewCustomAttributes = "";

        // thu_open
        $this->thu_open->ViewValue = $this->thu_open->CurrentValue;
        $this->thu_open->ViewValue = FormatDateTime($this->thu_open->ViewValue, 4);
        $this->thu_open->ViewCustomAttributes = "";

        // thu_close
        $this->thu_close->ViewValue = $this->thu_close->CurrentValue;
        $this->thu_close->ViewValue = FormatDateTime($this->thu_close->ViewValue, 4);
        $this->thu_close->ViewCustomAttributes = "";

        // fri_open
        $this->fri_open->ViewValue = $this->fri_open->CurrentValue;
        $this->fri_open->ViewValue = FormatDateTime($this->fri_open->ViewValue, 4);
        $this->fri_open->ViewCustomAttributes = "";

        // fri_close
        $this->fri_close->ViewValue = $this->fri_close->CurrentValue;
        $this->fri_close->ViewValue = FormatDateTime($this->fri_close->ViewValue, 4);
        $this->fri_close->ViewCustomAttributes = "";

        // sat_open
        $this->sat_open->ViewValue = $this->sat_open->CurrentValue;
        $this->sat_open->ViewValue = FormatDateTime($this->sat_open->ViewValue, 4);
        $this->sat_open->ViewCustomAttributes = "";

        // sat_close
        $this->sat_close->ViewValue = $this->sat_close->CurrentValue;
        $this->sat_close->ViewValue = FormatDateTime($this->sat_close->ViewValue, 4);
        $this->sat_close->ViewCustomAttributes = "";

        // sun_open
        $this->sun_open->ViewValue = $this->sun_open->CurrentValue;
        $this->sun_open->ViewValue = FormatDateTime($this->sun_open->ViewValue, 4);
        $this->sun_open->ViewCustomAttributes = "";

        // sun_close
        $this->sun_close->ViewValue = $this->sun_close->CurrentValue;
        $this->sun_close->ViewValue = FormatDateTime($this->sun_close->ViewValue, 4);
        $this->sun_close->ViewCustomAttributes = "";

        // close
        $this->close->ViewValue = $this->close->CurrentValue;
        $this->close->ViewCustomAttributes = "";

        // hour_id
        $this->hour_id->LinkCustomAttributes = "";
        $this->hour_id->HrefValue = "";
        $this->hour_id->TooltipValue = "";

        // mon_open
        $this->mon_open->LinkCustomAttributes = "";
        $this->mon_open->HrefValue = "";
        $this->mon_open->TooltipValue = "";

        // mon_close
        $this->mon_close->LinkCustomAttributes = "";
        $this->mon_close->HrefValue = "";
        $this->mon_close->TooltipValue = "";

        // tue_open
        $this->tue_open->LinkCustomAttributes = "";
        $this->tue_open->HrefValue = "";
        $this->tue_open->TooltipValue = "";

        // tue_close
        $this->tue_close->LinkCustomAttributes = "";
        $this->tue_close->HrefValue = "";
        $this->tue_close->TooltipValue = "";

        // wed_open
        $this->wed_open->LinkCustomAttributes = "";
        $this->wed_open->HrefValue = "";
        $this->wed_open->TooltipValue = "";

        // wed_close
        $this->wed_close->LinkCustomAttributes = "";
        $this->wed_close->HrefValue = "";
        $this->wed_close->TooltipValue = "";

        // thu_open
        $this->thu_open->LinkCustomAttributes = "";
        $this->thu_open->HrefValue = "";
        $this->thu_open->TooltipValue = "";

        // thu_close
        $this->thu_close->LinkCustomAttributes = "";
        $this->thu_close->HrefValue = "";
        $this->thu_close->TooltipValue = "";

        // fri_open
        $this->fri_open->LinkCustomAttributes = "";
        $this->fri_open->HrefValue = "";
        $this->fri_open->TooltipValue = "";

        // fri_close
        $this->fri_close->LinkCustomAttributes = "";
        $this->fri_close->HrefValue = "";
        $this->fri_close->TooltipValue = "";

        // sat_open
        $this->sat_open->LinkCustomAttributes = "";
        $this->sat_open->HrefValue = "";
        $this->sat_open->TooltipValue = "";

        // sat_close
        $this->sat_close->LinkCustomAttributes = "";
        $this->sat_close->HrefValue = "";
        $this->sat_close->TooltipValue = "";

        // sun_open
        $this->sun_open->LinkCustomAttributes = "";
        $this->sun_open->HrefValue = "";
        $this->sun_open->TooltipValue = "";

        // sun_close
        $this->sun_close->LinkCustomAttributes = "";
        $this->sun_close->HrefValue = "";
        $this->sun_close->TooltipValue = "";

        // close
        $this->close->LinkCustomAttributes = "";
        $this->close->HrefValue = "";
        $this->close->TooltipValue = "";

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

        // hour_id
        $this->hour_id->setupEditAttributes();
        $this->hour_id->EditCustomAttributes = "";
        $this->hour_id->EditValue = $this->hour_id->CurrentValue;
        $this->hour_id->PlaceHolder = RemoveHtml($this->hour_id->caption());

        // mon_open
        $this->mon_open->setupEditAttributes();
        $this->mon_open->EditCustomAttributes = "";
        $this->mon_open->EditValue = FormatDateTime($this->mon_open->CurrentValue, 4);
        $this->mon_open->PlaceHolder = RemoveHtml($this->mon_open->caption());

        // mon_close
        $this->mon_close->setupEditAttributes();
        $this->mon_close->EditCustomAttributes = "";
        $this->mon_close->EditValue = FormatDateTime($this->mon_close->CurrentValue, 4);
        $this->mon_close->PlaceHolder = RemoveHtml($this->mon_close->caption());

        // tue_open
        $this->tue_open->setupEditAttributes();
        $this->tue_open->EditCustomAttributes = "";
        $this->tue_open->EditValue = FormatDateTime($this->tue_open->CurrentValue, 4);
        $this->tue_open->PlaceHolder = RemoveHtml($this->tue_open->caption());

        // tue_close
        $this->tue_close->setupEditAttributes();
        $this->tue_close->EditCustomAttributes = "";
        $this->tue_close->EditValue = FormatDateTime($this->tue_close->CurrentValue, 4);
        $this->tue_close->PlaceHolder = RemoveHtml($this->tue_close->caption());

        // wed_open
        $this->wed_open->setupEditAttributes();
        $this->wed_open->EditCustomAttributes = "";
        $this->wed_open->EditValue = FormatDateTime($this->wed_open->CurrentValue, 4);
        $this->wed_open->PlaceHolder = RemoveHtml($this->wed_open->caption());

        // wed_close
        $this->wed_close->setupEditAttributes();
        $this->wed_close->EditCustomAttributes = "";
        $this->wed_close->EditValue = FormatDateTime($this->wed_close->CurrentValue, 4);
        $this->wed_close->PlaceHolder = RemoveHtml($this->wed_close->caption());

        // thu_open
        $this->thu_open->setupEditAttributes();
        $this->thu_open->EditCustomAttributes = "";
        $this->thu_open->EditValue = FormatDateTime($this->thu_open->CurrentValue, 4);
        $this->thu_open->PlaceHolder = RemoveHtml($this->thu_open->caption());

        // thu_close
        $this->thu_close->setupEditAttributes();
        $this->thu_close->EditCustomAttributes = "";
        $this->thu_close->EditValue = FormatDateTime($this->thu_close->CurrentValue, 4);
        $this->thu_close->PlaceHolder = RemoveHtml($this->thu_close->caption());

        // fri_open
        $this->fri_open->setupEditAttributes();
        $this->fri_open->EditCustomAttributes = "";
        $this->fri_open->EditValue = FormatDateTime($this->fri_open->CurrentValue, 4);
        $this->fri_open->PlaceHolder = RemoveHtml($this->fri_open->caption());

        // fri_close
        $this->fri_close->setupEditAttributes();
        $this->fri_close->EditCustomAttributes = "";
        $this->fri_close->EditValue = FormatDateTime($this->fri_close->CurrentValue, 4);
        $this->fri_close->PlaceHolder = RemoveHtml($this->fri_close->caption());

        // sat_open
        $this->sat_open->setupEditAttributes();
        $this->sat_open->EditCustomAttributes = "";
        $this->sat_open->EditValue = FormatDateTime($this->sat_open->CurrentValue, 4);
        $this->sat_open->PlaceHolder = RemoveHtml($this->sat_open->caption());

        // sat_close
        $this->sat_close->setupEditAttributes();
        $this->sat_close->EditCustomAttributes = "";
        $this->sat_close->EditValue = FormatDateTime($this->sat_close->CurrentValue, 4);
        $this->sat_close->PlaceHolder = RemoveHtml($this->sat_close->caption());

        // sun_open
        $this->sun_open->setupEditAttributes();
        $this->sun_open->EditCustomAttributes = "";
        $this->sun_open->EditValue = FormatDateTime($this->sun_open->CurrentValue, 4);
        $this->sun_open->PlaceHolder = RemoveHtml($this->sun_open->caption());

        // sun_close
        $this->sun_close->setupEditAttributes();
        $this->sun_close->EditCustomAttributes = "";
        $this->sun_close->EditValue = FormatDateTime($this->sun_close->CurrentValue, 4);
        $this->sun_close->PlaceHolder = RemoveHtml($this->sun_close->caption());

        // close
        $this->close->setupEditAttributes();
        $this->close->EditCustomAttributes = "";
        if (!$this->close->Raw) {
            $this->close->CurrentValue = HtmlDecode($this->close->CurrentValue);
        }
        $this->close->EditValue = $this->close->CurrentValue;
        $this->close->PlaceHolder = RemoveHtml($this->close->caption());

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
                    $doc->exportCaption($this->hour_id);
                    $doc->exportCaption($this->mon_open);
                    $doc->exportCaption($this->mon_close);
                    $doc->exportCaption($this->tue_open);
                    $doc->exportCaption($this->tue_close);
                    $doc->exportCaption($this->wed_open);
                    $doc->exportCaption($this->wed_close);
                    $doc->exportCaption($this->thu_open);
                    $doc->exportCaption($this->thu_close);
                    $doc->exportCaption($this->fri_open);
                    $doc->exportCaption($this->fri_close);
                    $doc->exportCaption($this->sat_open);
                    $doc->exportCaption($this->sat_close);
                    $doc->exportCaption($this->sun_open);
                    $doc->exportCaption($this->sun_close);
                    $doc->exportCaption($this->close);
                } else {
                    $doc->exportCaption($this->hour_id);
                    $doc->exportCaption($this->mon_open);
                    $doc->exportCaption($this->mon_close);
                    $doc->exportCaption($this->tue_open);
                    $doc->exportCaption($this->tue_close);
                    $doc->exportCaption($this->wed_open);
                    $doc->exportCaption($this->wed_close);
                    $doc->exportCaption($this->thu_open);
                    $doc->exportCaption($this->thu_close);
                    $doc->exportCaption($this->fri_open);
                    $doc->exportCaption($this->fri_close);
                    $doc->exportCaption($this->sat_open);
                    $doc->exportCaption($this->sat_close);
                    $doc->exportCaption($this->sun_open);
                    $doc->exportCaption($this->sun_close);
                    $doc->exportCaption($this->close);
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
                        $doc->exportField($this->hour_id);
                        $doc->exportField($this->mon_open);
                        $doc->exportField($this->mon_close);
                        $doc->exportField($this->tue_open);
                        $doc->exportField($this->tue_close);
                        $doc->exportField($this->wed_open);
                        $doc->exportField($this->wed_close);
                        $doc->exportField($this->thu_open);
                        $doc->exportField($this->thu_close);
                        $doc->exportField($this->fri_open);
                        $doc->exportField($this->fri_close);
                        $doc->exportField($this->sat_open);
                        $doc->exportField($this->sat_close);
                        $doc->exportField($this->sun_open);
                        $doc->exportField($this->sun_close);
                        $doc->exportField($this->close);
                    } else {
                        $doc->exportField($this->hour_id);
                        $doc->exportField($this->mon_open);
                        $doc->exportField($this->mon_close);
                        $doc->exportField($this->tue_open);
                        $doc->exportField($this->tue_close);
                        $doc->exportField($this->wed_open);
                        $doc->exportField($this->wed_close);
                        $doc->exportField($this->thu_open);
                        $doc->exportField($this->thu_close);
                        $doc->exportField($this->fri_open);
                        $doc->exportField($this->fri_close);
                        $doc->exportField($this->sat_open);
                        $doc->exportField($this->sat_close);
                        $doc->exportField($this->sun_open);
                        $doc->exportField($this->sun_close);
                        $doc->exportField($this->close);
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
