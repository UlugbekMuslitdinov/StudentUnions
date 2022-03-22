<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for hours_exception
 */
class HoursException extends DbTable
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
    public $start;
    public $end;
    public $mon_openx;
    public $mon_closex;
    public $tue_openx;
    public $tue_closex;
    public $wed_openx;
    public $wed_closex;
    public $thu_openx;
    public $thu_closex;
    public $fri_openx;
    public $fri_closex;
    public $sat_openx;
    public $sat_closex;
    public $sun_openx;
    public $sun_closex;
    public $closex;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'hours_exception';
        $this->TableName = 'hours_exception';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`hours_exception`";
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

        // location_id
        $this->location_id = new DbField(
            'hours_exception',
            'hours_exception',
            'x_location_id',
            'location_id',
            '`location_id`',
            '`location_id`',
            3,
            11,
            -1,
            false,
            '`location_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->location_id->InputTextType = "text";
        $this->location_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['location_id'] = &$this->location_id;

        // start
        $this->start = new DbField(
            'hours_exception',
            'hours_exception',
            'x_start',
            'start',
            '`start`',
            CastDateFieldForLike("`start`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`start`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->start->InputTextType = "text";
        $this->start->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['start'] = &$this->start;

        // end
        $this->end = new DbField(
            'hours_exception',
            'hours_exception',
            'x_end',
            'end',
            '`end`',
            CastDateFieldForLike("`end`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`end`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->end->InputTextType = "text";
        $this->end->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['end'] = &$this->end;

        // mon_openx
        $this->mon_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_mon_openx',
            'mon_openx',
            '`mon_openx`',
            CastDateFieldForLike("`mon_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`mon_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mon_openx->InputTextType = "text";
        $this->mon_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['mon_openx'] = &$this->mon_openx;

        // mon_closex
        $this->mon_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_mon_closex',
            'mon_closex',
            '`mon_closex`',
            CastDateFieldForLike("`mon_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`mon_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mon_closex->InputTextType = "text";
        $this->mon_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['mon_closex'] = &$this->mon_closex;

        // tue_openx
        $this->tue_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_tue_openx',
            'tue_openx',
            '`tue_openx`',
            CastDateFieldForLike("`tue_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`tue_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tue_openx->InputTextType = "text";
        $this->tue_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['tue_openx'] = &$this->tue_openx;

        // tue_closex
        $this->tue_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_tue_closex',
            'tue_closex',
            '`tue_closex`',
            CastDateFieldForLike("`tue_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`tue_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tue_closex->InputTextType = "text";
        $this->tue_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['tue_closex'] = &$this->tue_closex;

        // wed_openx
        $this->wed_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_wed_openx',
            'wed_openx',
            '`wed_openx`',
            CastDateFieldForLike("`wed_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`wed_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->wed_openx->InputTextType = "text";
        $this->wed_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['wed_openx'] = &$this->wed_openx;

        // wed_closex
        $this->wed_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_wed_closex',
            'wed_closex',
            '`wed_closex`',
            CastDateFieldForLike("`wed_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`wed_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->wed_closex->InputTextType = "text";
        $this->wed_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['wed_closex'] = &$this->wed_closex;

        // thu_openx
        $this->thu_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_thu_openx',
            'thu_openx',
            '`thu_openx`',
            CastDateFieldForLike("`thu_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`thu_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->thu_openx->InputTextType = "text";
        $this->thu_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['thu_openx'] = &$this->thu_openx;

        // thu_closex
        $this->thu_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_thu_closex',
            'thu_closex',
            '`thu_closex`',
            CastDateFieldForLike("`thu_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`thu_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->thu_closex->InputTextType = "text";
        $this->thu_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['thu_closex'] = &$this->thu_closex;

        // fri_openx
        $this->fri_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_fri_openx',
            'fri_openx',
            '`fri_openx`',
            CastDateFieldForLike("`fri_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`fri_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fri_openx->InputTextType = "text";
        $this->fri_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['fri_openx'] = &$this->fri_openx;

        // fri_closex
        $this->fri_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_fri_closex',
            'fri_closex',
            '`fri_closex`',
            CastDateFieldForLike("`fri_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`fri_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fri_closex->InputTextType = "text";
        $this->fri_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['fri_closex'] = &$this->fri_closex;

        // sat_openx
        $this->sat_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_sat_openx',
            'sat_openx',
            '`sat_openx`',
            CastDateFieldForLike("`sat_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sat_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sat_openx->InputTextType = "text";
        $this->sat_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sat_openx'] = &$this->sat_openx;

        // sat_closex
        $this->sat_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_sat_closex',
            'sat_closex',
            '`sat_closex`',
            CastDateFieldForLike("`sat_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sat_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sat_closex->InputTextType = "text";
        $this->sat_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sat_closex'] = &$this->sat_closex;

        // sun_openx
        $this->sun_openx = new DbField(
            'hours_exception',
            'hours_exception',
            'x_sun_openx',
            'sun_openx',
            '`sun_openx`',
            CastDateFieldForLike("`sun_openx`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sun_openx`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sun_openx->InputTextType = "text";
        $this->sun_openx->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sun_openx'] = &$this->sun_openx;

        // sun_closex
        $this->sun_closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_sun_closex',
            'sun_closex',
            '`sun_closex`',
            CastDateFieldForLike("`sun_closex`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`sun_closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sun_closex->InputTextType = "text";
        $this->sun_closex->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['sun_closex'] = &$this->sun_closex;

        // closex
        $this->closex = new DbField(
            'hours_exception',
            'hours_exception',
            'x_closex',
            'closex',
            '`closex`',
            '`closex`',
            200,
            6,
            -1,
            false,
            '`closex`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closex->InputTextType = "text";
        $this->Fields['closex'] = &$this->closex;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`hours_exception`";
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
        $this->start->DbValue = $row['start'];
        $this->end->DbValue = $row['end'];
        $this->mon_openx->DbValue = $row['mon_openx'];
        $this->mon_closex->DbValue = $row['mon_closex'];
        $this->tue_openx->DbValue = $row['tue_openx'];
        $this->tue_closex->DbValue = $row['tue_closex'];
        $this->wed_openx->DbValue = $row['wed_openx'];
        $this->wed_closex->DbValue = $row['wed_closex'];
        $this->thu_openx->DbValue = $row['thu_openx'];
        $this->thu_closex->DbValue = $row['thu_closex'];
        $this->fri_openx->DbValue = $row['fri_openx'];
        $this->fri_closex->DbValue = $row['fri_closex'];
        $this->sat_openx->DbValue = $row['sat_openx'];
        $this->sat_closex->DbValue = $row['sat_closex'];
        $this->sun_openx->DbValue = $row['sun_openx'];
        $this->sun_closex->DbValue = $row['sun_closex'];
        $this->closex->DbValue = $row['closex'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("HoursExceptionList");
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
        if ($pageName == "HoursExceptionView") {
            return $Language->phrase("View");
        } elseif ($pageName == "HoursExceptionEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "HoursExceptionAdd") {
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
                return "HoursExceptionView";
            case Config("API_ADD_ACTION"):
                return "HoursExceptionAdd";
            case Config("API_EDIT_ACTION"):
                return "HoursExceptionEdit";
            case Config("API_DELETE_ACTION"):
                return "HoursExceptionDelete";
            case Config("API_LIST_ACTION"):
                return "HoursExceptionList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "HoursExceptionList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("HoursExceptionView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("HoursExceptionView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "HoursExceptionAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "HoursExceptionAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("HoursExceptionEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("HoursExceptionAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("HoursExceptionDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
        if ($fld->UseFilter && $Security->canSearch()) {
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
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
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
        $this->location_id->setDbValue($row['location_id']);
        $this->start->setDbValue($row['start']);
        $this->end->setDbValue($row['end']);
        $this->mon_openx->setDbValue($row['mon_openx']);
        $this->mon_closex->setDbValue($row['mon_closex']);
        $this->tue_openx->setDbValue($row['tue_openx']);
        $this->tue_closex->setDbValue($row['tue_closex']);
        $this->wed_openx->setDbValue($row['wed_openx']);
        $this->wed_closex->setDbValue($row['wed_closex']);
        $this->thu_openx->setDbValue($row['thu_openx']);
        $this->thu_closex->setDbValue($row['thu_closex']);
        $this->fri_openx->setDbValue($row['fri_openx']);
        $this->fri_closex->setDbValue($row['fri_closex']);
        $this->sat_openx->setDbValue($row['sat_openx']);
        $this->sat_closex->setDbValue($row['sat_closex']);
        $this->sun_openx->setDbValue($row['sun_openx']);
        $this->sun_closex->setDbValue($row['sun_closex']);
        $this->closex->setDbValue($row['closex']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // location_id

        // start

        // end

        // mon_openx

        // mon_closex

        // tue_openx

        // tue_closex

        // wed_openx

        // wed_closex

        // thu_openx

        // thu_closex

        // fri_openx

        // fri_closex

        // sat_openx

        // sat_closex

        // sun_openx

        // sun_closex

        // closex

        // location_id
        $this->location_id->ViewValue = $this->location_id->CurrentValue;
        $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, "");
        $this->location_id->ViewCustomAttributes = "";

        // start
        $this->start->ViewValue = $this->start->CurrentValue;
        $this->start->ViewValue = FormatDateTime($this->start->ViewValue, 0);
        $this->start->ViewCustomAttributes = "";

        // end
        $this->end->ViewValue = $this->end->CurrentValue;
        $this->end->ViewValue = FormatDateTime($this->end->ViewValue, 0);
        $this->end->ViewCustomAttributes = "";

        // mon_openx
        $this->mon_openx->ViewValue = $this->mon_openx->CurrentValue;
        $this->mon_openx->ViewValue = FormatDateTime($this->mon_openx->ViewValue, 4);
        $this->mon_openx->ViewCustomAttributes = "";

        // mon_closex
        $this->mon_closex->ViewValue = $this->mon_closex->CurrentValue;
        $this->mon_closex->ViewValue = FormatDateTime($this->mon_closex->ViewValue, 4);
        $this->mon_closex->ViewCustomAttributes = "";

        // tue_openx
        $this->tue_openx->ViewValue = $this->tue_openx->CurrentValue;
        $this->tue_openx->ViewValue = FormatDateTime($this->tue_openx->ViewValue, 4);
        $this->tue_openx->ViewCustomAttributes = "";

        // tue_closex
        $this->tue_closex->ViewValue = $this->tue_closex->CurrentValue;
        $this->tue_closex->ViewValue = FormatDateTime($this->tue_closex->ViewValue, 4);
        $this->tue_closex->ViewCustomAttributes = "";

        // wed_openx
        $this->wed_openx->ViewValue = $this->wed_openx->CurrentValue;
        $this->wed_openx->ViewValue = FormatDateTime($this->wed_openx->ViewValue, 4);
        $this->wed_openx->ViewCustomAttributes = "";

        // wed_closex
        $this->wed_closex->ViewValue = $this->wed_closex->CurrentValue;
        $this->wed_closex->ViewValue = FormatDateTime($this->wed_closex->ViewValue, 4);
        $this->wed_closex->ViewCustomAttributes = "";

        // thu_openx
        $this->thu_openx->ViewValue = $this->thu_openx->CurrentValue;
        $this->thu_openx->ViewValue = FormatDateTime($this->thu_openx->ViewValue, 4);
        $this->thu_openx->ViewCustomAttributes = "";

        // thu_closex
        $this->thu_closex->ViewValue = $this->thu_closex->CurrentValue;
        $this->thu_closex->ViewValue = FormatDateTime($this->thu_closex->ViewValue, 4);
        $this->thu_closex->ViewCustomAttributes = "";

        // fri_openx
        $this->fri_openx->ViewValue = $this->fri_openx->CurrentValue;
        $this->fri_openx->ViewValue = FormatDateTime($this->fri_openx->ViewValue, 4);
        $this->fri_openx->ViewCustomAttributes = "";

        // fri_closex
        $this->fri_closex->ViewValue = $this->fri_closex->CurrentValue;
        $this->fri_closex->ViewValue = FormatDateTime($this->fri_closex->ViewValue, 4);
        $this->fri_closex->ViewCustomAttributes = "";

        // sat_openx
        $this->sat_openx->ViewValue = $this->sat_openx->CurrentValue;
        $this->sat_openx->ViewValue = FormatDateTime($this->sat_openx->ViewValue, 4);
        $this->sat_openx->ViewCustomAttributes = "";

        // sat_closex
        $this->sat_closex->ViewValue = $this->sat_closex->CurrentValue;
        $this->sat_closex->ViewValue = FormatDateTime($this->sat_closex->ViewValue, 4);
        $this->sat_closex->ViewCustomAttributes = "";

        // sun_openx
        $this->sun_openx->ViewValue = $this->sun_openx->CurrentValue;
        $this->sun_openx->ViewValue = FormatDateTime($this->sun_openx->ViewValue, 4);
        $this->sun_openx->ViewCustomAttributes = "";

        // sun_closex
        $this->sun_closex->ViewValue = $this->sun_closex->CurrentValue;
        $this->sun_closex->ViewValue = FormatDateTime($this->sun_closex->ViewValue, 4);
        $this->sun_closex->ViewCustomAttributes = "";

        // closex
        $this->closex->ViewValue = $this->closex->CurrentValue;
        $this->closex->ViewCustomAttributes = "";

        // location_id
        $this->location_id->LinkCustomAttributes = "";
        $this->location_id->HrefValue = "";
        $this->location_id->TooltipValue = "";

        // start
        $this->start->LinkCustomAttributes = "";
        $this->start->HrefValue = "";
        $this->start->TooltipValue = "";

        // end
        $this->end->LinkCustomAttributes = "";
        $this->end->HrefValue = "";
        $this->end->TooltipValue = "";

        // mon_openx
        $this->mon_openx->LinkCustomAttributes = "";
        $this->mon_openx->HrefValue = "";
        $this->mon_openx->TooltipValue = "";

        // mon_closex
        $this->mon_closex->LinkCustomAttributes = "";
        $this->mon_closex->HrefValue = "";
        $this->mon_closex->TooltipValue = "";

        // tue_openx
        $this->tue_openx->LinkCustomAttributes = "";
        $this->tue_openx->HrefValue = "";
        $this->tue_openx->TooltipValue = "";

        // tue_closex
        $this->tue_closex->LinkCustomAttributes = "";
        $this->tue_closex->HrefValue = "";
        $this->tue_closex->TooltipValue = "";

        // wed_openx
        $this->wed_openx->LinkCustomAttributes = "";
        $this->wed_openx->HrefValue = "";
        $this->wed_openx->TooltipValue = "";

        // wed_closex
        $this->wed_closex->LinkCustomAttributes = "";
        $this->wed_closex->HrefValue = "";
        $this->wed_closex->TooltipValue = "";

        // thu_openx
        $this->thu_openx->LinkCustomAttributes = "";
        $this->thu_openx->HrefValue = "";
        $this->thu_openx->TooltipValue = "";

        // thu_closex
        $this->thu_closex->LinkCustomAttributes = "";
        $this->thu_closex->HrefValue = "";
        $this->thu_closex->TooltipValue = "";

        // fri_openx
        $this->fri_openx->LinkCustomAttributes = "";
        $this->fri_openx->HrefValue = "";
        $this->fri_openx->TooltipValue = "";

        // fri_closex
        $this->fri_closex->LinkCustomAttributes = "";
        $this->fri_closex->HrefValue = "";
        $this->fri_closex->TooltipValue = "";

        // sat_openx
        $this->sat_openx->LinkCustomAttributes = "";
        $this->sat_openx->HrefValue = "";
        $this->sat_openx->TooltipValue = "";

        // sat_closex
        $this->sat_closex->LinkCustomAttributes = "";
        $this->sat_closex->HrefValue = "";
        $this->sat_closex->TooltipValue = "";

        // sun_openx
        $this->sun_openx->LinkCustomAttributes = "";
        $this->sun_openx->HrefValue = "";
        $this->sun_openx->TooltipValue = "";

        // sun_closex
        $this->sun_closex->LinkCustomAttributes = "";
        $this->sun_closex->HrefValue = "";
        $this->sun_closex->TooltipValue = "";

        // closex
        $this->closex->LinkCustomAttributes = "";
        $this->closex->HrefValue = "";
        $this->closex->TooltipValue = "";

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
        $this->location_id->setupEditAttributes();
        $this->location_id->EditCustomAttributes = "";
        $this->location_id->EditValue = $this->location_id->CurrentValue;
        $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());
        if (strval($this->location_id->EditValue) != "" && is_numeric($this->location_id->EditValue)) {
            $this->location_id->EditValue = FormatNumber($this->location_id->EditValue, null);
        }

        // start
        $this->start->setupEditAttributes();
        $this->start->EditCustomAttributes = "";
        $this->start->EditValue = FormatDateTime($this->start->CurrentValue, 8);
        $this->start->PlaceHolder = RemoveHtml($this->start->caption());

        // end
        $this->end->setupEditAttributes();
        $this->end->EditCustomAttributes = "";
        $this->end->EditValue = FormatDateTime($this->end->CurrentValue, 8);
        $this->end->PlaceHolder = RemoveHtml($this->end->caption());

        // mon_openx
        $this->mon_openx->setupEditAttributes();
        $this->mon_openx->EditCustomAttributes = "";
        $this->mon_openx->EditValue = FormatDateTime($this->mon_openx->CurrentValue, 4);
        $this->mon_openx->PlaceHolder = RemoveHtml($this->mon_openx->caption());

        // mon_closex
        $this->mon_closex->setupEditAttributes();
        $this->mon_closex->EditCustomAttributes = "";
        $this->mon_closex->EditValue = FormatDateTime($this->mon_closex->CurrentValue, 4);
        $this->mon_closex->PlaceHolder = RemoveHtml($this->mon_closex->caption());

        // tue_openx
        $this->tue_openx->setupEditAttributes();
        $this->tue_openx->EditCustomAttributes = "";
        $this->tue_openx->EditValue = FormatDateTime($this->tue_openx->CurrentValue, 4);
        $this->tue_openx->PlaceHolder = RemoveHtml($this->tue_openx->caption());

        // tue_closex
        $this->tue_closex->setupEditAttributes();
        $this->tue_closex->EditCustomAttributes = "";
        $this->tue_closex->EditValue = FormatDateTime($this->tue_closex->CurrentValue, 4);
        $this->tue_closex->PlaceHolder = RemoveHtml($this->tue_closex->caption());

        // wed_openx
        $this->wed_openx->setupEditAttributes();
        $this->wed_openx->EditCustomAttributes = "";
        $this->wed_openx->EditValue = FormatDateTime($this->wed_openx->CurrentValue, 4);
        $this->wed_openx->PlaceHolder = RemoveHtml($this->wed_openx->caption());

        // wed_closex
        $this->wed_closex->setupEditAttributes();
        $this->wed_closex->EditCustomAttributes = "";
        $this->wed_closex->EditValue = FormatDateTime($this->wed_closex->CurrentValue, 4);
        $this->wed_closex->PlaceHolder = RemoveHtml($this->wed_closex->caption());

        // thu_openx
        $this->thu_openx->setupEditAttributes();
        $this->thu_openx->EditCustomAttributes = "";
        $this->thu_openx->EditValue = FormatDateTime($this->thu_openx->CurrentValue, 4);
        $this->thu_openx->PlaceHolder = RemoveHtml($this->thu_openx->caption());

        // thu_closex
        $this->thu_closex->setupEditAttributes();
        $this->thu_closex->EditCustomAttributes = "";
        $this->thu_closex->EditValue = FormatDateTime($this->thu_closex->CurrentValue, 4);
        $this->thu_closex->PlaceHolder = RemoveHtml($this->thu_closex->caption());

        // fri_openx
        $this->fri_openx->setupEditAttributes();
        $this->fri_openx->EditCustomAttributes = "";
        $this->fri_openx->EditValue = FormatDateTime($this->fri_openx->CurrentValue, 4);
        $this->fri_openx->PlaceHolder = RemoveHtml($this->fri_openx->caption());

        // fri_closex
        $this->fri_closex->setupEditAttributes();
        $this->fri_closex->EditCustomAttributes = "";
        $this->fri_closex->EditValue = FormatDateTime($this->fri_closex->CurrentValue, 4);
        $this->fri_closex->PlaceHolder = RemoveHtml($this->fri_closex->caption());

        // sat_openx
        $this->sat_openx->setupEditAttributes();
        $this->sat_openx->EditCustomAttributes = "";
        $this->sat_openx->EditValue = FormatDateTime($this->sat_openx->CurrentValue, 4);
        $this->sat_openx->PlaceHolder = RemoveHtml($this->sat_openx->caption());

        // sat_closex
        $this->sat_closex->setupEditAttributes();
        $this->sat_closex->EditCustomAttributes = "";
        $this->sat_closex->EditValue = FormatDateTime($this->sat_closex->CurrentValue, 4);
        $this->sat_closex->PlaceHolder = RemoveHtml($this->sat_closex->caption());

        // sun_openx
        $this->sun_openx->setupEditAttributes();
        $this->sun_openx->EditCustomAttributes = "";
        $this->sun_openx->EditValue = FormatDateTime($this->sun_openx->CurrentValue, 4);
        $this->sun_openx->PlaceHolder = RemoveHtml($this->sun_openx->caption());

        // sun_closex
        $this->sun_closex->setupEditAttributes();
        $this->sun_closex->EditCustomAttributes = "";
        $this->sun_closex->EditValue = FormatDateTime($this->sun_closex->CurrentValue, 4);
        $this->sun_closex->PlaceHolder = RemoveHtml($this->sun_closex->caption());

        // closex
        $this->closex->setupEditAttributes();
        $this->closex->EditCustomAttributes = "";
        if (!$this->closex->Raw) {
            $this->closex->CurrentValue = HtmlDecode($this->closex->CurrentValue);
        }
        $this->closex->EditValue = $this->closex->CurrentValue;
        $this->closex->PlaceHolder = RemoveHtml($this->closex->caption());

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
                    $doc->exportCaption($this->start);
                    $doc->exportCaption($this->end);
                    $doc->exportCaption($this->mon_openx);
                    $doc->exportCaption($this->mon_closex);
                    $doc->exportCaption($this->tue_openx);
                    $doc->exportCaption($this->tue_closex);
                    $doc->exportCaption($this->wed_openx);
                    $doc->exportCaption($this->wed_closex);
                    $doc->exportCaption($this->thu_openx);
                    $doc->exportCaption($this->thu_closex);
                    $doc->exportCaption($this->fri_openx);
                    $doc->exportCaption($this->fri_closex);
                    $doc->exportCaption($this->sat_openx);
                    $doc->exportCaption($this->sat_closex);
                    $doc->exportCaption($this->sun_openx);
                    $doc->exportCaption($this->sun_closex);
                    $doc->exportCaption($this->closex);
                } else {
                    $doc->exportCaption($this->location_id);
                    $doc->exportCaption($this->start);
                    $doc->exportCaption($this->end);
                    $doc->exportCaption($this->mon_openx);
                    $doc->exportCaption($this->mon_closex);
                    $doc->exportCaption($this->tue_openx);
                    $doc->exportCaption($this->tue_closex);
                    $doc->exportCaption($this->wed_openx);
                    $doc->exportCaption($this->wed_closex);
                    $doc->exportCaption($this->thu_openx);
                    $doc->exportCaption($this->thu_closex);
                    $doc->exportCaption($this->fri_openx);
                    $doc->exportCaption($this->fri_closex);
                    $doc->exportCaption($this->sat_openx);
                    $doc->exportCaption($this->sat_closex);
                    $doc->exportCaption($this->sun_openx);
                    $doc->exportCaption($this->sun_closex);
                    $doc->exportCaption($this->closex);
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
                        $doc->exportField($this->start);
                        $doc->exportField($this->end);
                        $doc->exportField($this->mon_openx);
                        $doc->exportField($this->mon_closex);
                        $doc->exportField($this->tue_openx);
                        $doc->exportField($this->tue_closex);
                        $doc->exportField($this->wed_openx);
                        $doc->exportField($this->wed_closex);
                        $doc->exportField($this->thu_openx);
                        $doc->exportField($this->thu_closex);
                        $doc->exportField($this->fri_openx);
                        $doc->exportField($this->fri_closex);
                        $doc->exportField($this->sat_openx);
                        $doc->exportField($this->sat_closex);
                        $doc->exportField($this->sun_openx);
                        $doc->exportField($this->sun_closex);
                        $doc->exportField($this->closex);
                    } else {
                        $doc->exportField($this->location_id);
                        $doc->exportField($this->start);
                        $doc->exportField($this->end);
                        $doc->exportField($this->mon_openx);
                        $doc->exportField($this->mon_closex);
                        $doc->exportField($this->tue_openx);
                        $doc->exportField($this->tue_closex);
                        $doc->exportField($this->wed_openx);
                        $doc->exportField($this->wed_closex);
                        $doc->exportField($this->thu_openx);
                        $doc->exportField($this->thu_closex);
                        $doc->exportField($this->fri_openx);
                        $doc->exportField($this->fri_closex);
                        $doc->exportField($this->sat_openx);
                        $doc->exportField($this->sat_closex);
                        $doc->exportField($this->sun_openx);
                        $doc->exportField($this->sun_closex);
                        $doc->exportField($this->closex);
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
