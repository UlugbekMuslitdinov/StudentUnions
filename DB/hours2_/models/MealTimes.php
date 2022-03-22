<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for meal_times
 */
class MealTimes extends DbTable
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
    public $location_id;
    public $meal_details_id;
    public $startm;
    public $endm;
    public $startt;
    public $endt;
    public $startw;
    public $endw;
    public $startr;
    public $endr;
    public $startf;
    public $endf;
    public $starts;
    public $ends;
    public $startu;
    public $endu;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'meal_times';
        $this->TableName = 'meal_times';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`meal_times`";
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
            'meal_times',
            'meal_times',
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
            'NO'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // location_id
        $this->location_id = new DbField(
            'meal_times',
            'meal_times',
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
        $this->location_id->Nullable = false; // NOT NULL field
        $this->location_id->Required = true; // Required field
        $this->location_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['location_id'] = &$this->location_id;

        // meal_details_id
        $this->meal_details_id = new DbField(
            'meal_times',
            'meal_times',
            'x_meal_details_id',
            'meal_details_id',
            '`meal_details_id`',
            '`meal_details_id`',
            3,
            11,
            -1,
            false,
            '`meal_details_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->meal_details_id->InputTextType = "text";
        $this->meal_details_id->Nullable = false; // NOT NULL field
        $this->meal_details_id->Required = true; // Required field
        $this->meal_details_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['meal_details_id'] = &$this->meal_details_id;

        // startm
        $this->startm = new DbField(
            'meal_times',
            'meal_times',
            'x_startm',
            'startm',
            '`startm`',
            CastDateFieldForLike("`startm`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`startm`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->startm->InputTextType = "text";
        $this->startm->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['startm'] = &$this->startm;

        // endm
        $this->endm = new DbField(
            'meal_times',
            'meal_times',
            'x_endm',
            'endm',
            '`endm`',
            CastDateFieldForLike("`endm`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`endm`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->endm->InputTextType = "text";
        $this->endm->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['endm'] = &$this->endm;

        // startt
        $this->startt = new DbField(
            'meal_times',
            'meal_times',
            'x_startt',
            'startt',
            '`startt`',
            CastDateFieldForLike("`startt`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`startt`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->startt->InputTextType = "text";
        $this->startt->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['startt'] = &$this->startt;

        // endt
        $this->endt = new DbField(
            'meal_times',
            'meal_times',
            'x_endt',
            'endt',
            '`endt`',
            CastDateFieldForLike("`endt`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`endt`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->endt->InputTextType = "text";
        $this->endt->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['endt'] = &$this->endt;

        // startw
        $this->startw = new DbField(
            'meal_times',
            'meal_times',
            'x_startw',
            'startw',
            '`startw`',
            CastDateFieldForLike("`startw`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`startw`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->startw->InputTextType = "text";
        $this->startw->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['startw'] = &$this->startw;

        // endw
        $this->endw = new DbField(
            'meal_times',
            'meal_times',
            'x_endw',
            'endw',
            '`endw`',
            CastDateFieldForLike("`endw`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`endw`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->endw->InputTextType = "text";
        $this->endw->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['endw'] = &$this->endw;

        // startr
        $this->startr = new DbField(
            'meal_times',
            'meal_times',
            'x_startr',
            'startr',
            '`startr`',
            CastDateFieldForLike("`startr`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`startr`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->startr->InputTextType = "text";
        $this->startr->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['startr'] = &$this->startr;

        // endr
        $this->endr = new DbField(
            'meal_times',
            'meal_times',
            'x_endr',
            'endr',
            '`endr`',
            CastDateFieldForLike("`endr`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`endr`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->endr->InputTextType = "text";
        $this->endr->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['endr'] = &$this->endr;

        // startf
        $this->startf = new DbField(
            'meal_times',
            'meal_times',
            'x_startf',
            'startf',
            '`startf`',
            CastDateFieldForLike("`startf`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`startf`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->startf->InputTextType = "text";
        $this->startf->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['startf'] = &$this->startf;

        // endf
        $this->endf = new DbField(
            'meal_times',
            'meal_times',
            'x_endf',
            'endf',
            '`endf`',
            CastDateFieldForLike("`endf`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`endf`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->endf->InputTextType = "text";
        $this->endf->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['endf'] = &$this->endf;

        // starts
        $this->starts = new DbField(
            'meal_times',
            'meal_times',
            'x_starts',
            'starts',
            '`starts`',
            CastDateFieldForLike("`starts`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`starts`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->starts->InputTextType = "text";
        $this->starts->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['starts'] = &$this->starts;

        // ends
        $this->ends = new DbField(
            'meal_times',
            'meal_times',
            'x_ends',
            'ends',
            '`ends`',
            CastDateFieldForLike("`ends`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`ends`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ends->InputTextType = "text";
        $this->ends->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['ends'] = &$this->ends;

        // startu
        $this->startu = new DbField(
            'meal_times',
            'meal_times',
            'x_startu',
            'startu',
            '`startu`',
            CastDateFieldForLike("`startu`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`startu`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->startu->InputTextType = "text";
        $this->startu->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['startu'] = &$this->startu;

        // endu
        $this->endu = new DbField(
            'meal_times',
            'meal_times',
            'x_endu',
            'endu',
            '`endu`',
            CastDateFieldForLike("`endu`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`endu`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->endu->InputTextType = "text";
        $this->endu->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['endu'] = &$this->endu;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`meal_times`";
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
        $this->location_id->DbValue = $row['location_id'];
        $this->meal_details_id->DbValue = $row['meal_details_id'];
        $this->startm->DbValue = $row['startm'];
        $this->endm->DbValue = $row['endm'];
        $this->startt->DbValue = $row['startt'];
        $this->endt->DbValue = $row['endt'];
        $this->startw->DbValue = $row['startw'];
        $this->endw->DbValue = $row['endw'];
        $this->startr->DbValue = $row['startr'];
        $this->endr->DbValue = $row['endr'];
        $this->startf->DbValue = $row['startf'];
        $this->endf->DbValue = $row['endf'];
        $this->starts->DbValue = $row['starts'];
        $this->ends->DbValue = $row['ends'];
        $this->startu->DbValue = $row['startu'];
        $this->endu->DbValue = $row['endu'];
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
        return $_SESSION[$name] ?? GetUrl("MealTimesList");
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
        if ($pageName == "MealTimesView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MealTimesEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MealTimesAdd") {
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
                return "MealTimesView";
            case Config("API_ADD_ACTION"):
                return "MealTimesAdd";
            case Config("API_EDIT_ACTION"):
                return "MealTimesEdit";
            case Config("API_DELETE_ACTION"):
                return "MealTimesDelete";
            case Config("API_LIST_ACTION"):
                return "MealTimesList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MealTimesList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MealTimesView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MealTimesView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MealTimesAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MealTimesAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MealTimesEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("MealTimesAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("MealTimesDelete", $this->getUrlParm());
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
        $this->location_id->setDbValue($row['location_id']);
        $this->meal_details_id->setDbValue($row['meal_details_id']);
        $this->startm->setDbValue($row['startm']);
        $this->endm->setDbValue($row['endm']);
        $this->startt->setDbValue($row['startt']);
        $this->endt->setDbValue($row['endt']);
        $this->startw->setDbValue($row['startw']);
        $this->endw->setDbValue($row['endw']);
        $this->startr->setDbValue($row['startr']);
        $this->endr->setDbValue($row['endr']);
        $this->startf->setDbValue($row['startf']);
        $this->endf->setDbValue($row['endf']);
        $this->starts->setDbValue($row['starts']);
        $this->ends->setDbValue($row['ends']);
        $this->startu->setDbValue($row['startu']);
        $this->endu->setDbValue($row['endu']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // location_id

        // meal_details_id

        // startm

        // endm

        // startt

        // endt

        // startw

        // endw

        // startr

        // endr

        // startf

        // endf

        // starts

        // ends

        // startu

        // endu

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // location_id
        $this->location_id->ViewValue = $this->location_id->CurrentValue;
        $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, "");
        $this->location_id->ViewCustomAttributes = "";

        // meal_details_id
        $this->meal_details_id->ViewValue = $this->meal_details_id->CurrentValue;
        $this->meal_details_id->ViewValue = FormatNumber($this->meal_details_id->ViewValue, "");
        $this->meal_details_id->ViewCustomAttributes = "";

        // startm
        $this->startm->ViewValue = $this->startm->CurrentValue;
        $this->startm->ViewValue = FormatDateTime($this->startm->ViewValue, 4);
        $this->startm->ViewCustomAttributes = "";

        // endm
        $this->endm->ViewValue = $this->endm->CurrentValue;
        $this->endm->ViewValue = FormatDateTime($this->endm->ViewValue, 4);
        $this->endm->ViewCustomAttributes = "";

        // startt
        $this->startt->ViewValue = $this->startt->CurrentValue;
        $this->startt->ViewValue = FormatDateTime($this->startt->ViewValue, 4);
        $this->startt->ViewCustomAttributes = "";

        // endt
        $this->endt->ViewValue = $this->endt->CurrentValue;
        $this->endt->ViewValue = FormatDateTime($this->endt->ViewValue, 4);
        $this->endt->ViewCustomAttributes = "";

        // startw
        $this->startw->ViewValue = $this->startw->CurrentValue;
        $this->startw->ViewValue = FormatDateTime($this->startw->ViewValue, 4);
        $this->startw->ViewCustomAttributes = "";

        // endw
        $this->endw->ViewValue = $this->endw->CurrentValue;
        $this->endw->ViewValue = FormatDateTime($this->endw->ViewValue, 4);
        $this->endw->ViewCustomAttributes = "";

        // startr
        $this->startr->ViewValue = $this->startr->CurrentValue;
        $this->startr->ViewValue = FormatDateTime($this->startr->ViewValue, 4);
        $this->startr->ViewCustomAttributes = "";

        // endr
        $this->endr->ViewValue = $this->endr->CurrentValue;
        $this->endr->ViewValue = FormatDateTime($this->endr->ViewValue, 4);
        $this->endr->ViewCustomAttributes = "";

        // startf
        $this->startf->ViewValue = $this->startf->CurrentValue;
        $this->startf->ViewValue = FormatDateTime($this->startf->ViewValue, 4);
        $this->startf->ViewCustomAttributes = "";

        // endf
        $this->endf->ViewValue = $this->endf->CurrentValue;
        $this->endf->ViewValue = FormatDateTime($this->endf->ViewValue, 4);
        $this->endf->ViewCustomAttributes = "";

        // starts
        $this->starts->ViewValue = $this->starts->CurrentValue;
        $this->starts->ViewValue = FormatDateTime($this->starts->ViewValue, 4);
        $this->starts->ViewCustomAttributes = "";

        // ends
        $this->ends->ViewValue = $this->ends->CurrentValue;
        $this->ends->ViewValue = FormatDateTime($this->ends->ViewValue, 4);
        $this->ends->ViewCustomAttributes = "";

        // startu
        $this->startu->ViewValue = $this->startu->CurrentValue;
        $this->startu->ViewValue = FormatDateTime($this->startu->ViewValue, 4);
        $this->startu->ViewCustomAttributes = "";

        // endu
        $this->endu->ViewValue = $this->endu->CurrentValue;
        $this->endu->ViewValue = FormatDateTime($this->endu->ViewValue, 4);
        $this->endu->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // location_id
        $this->location_id->LinkCustomAttributes = "";
        $this->location_id->HrefValue = "";
        $this->location_id->TooltipValue = "";

        // meal_details_id
        $this->meal_details_id->LinkCustomAttributes = "";
        $this->meal_details_id->HrefValue = "";
        $this->meal_details_id->TooltipValue = "";

        // startm
        $this->startm->LinkCustomAttributes = "";
        $this->startm->HrefValue = "";
        $this->startm->TooltipValue = "";

        // endm
        $this->endm->LinkCustomAttributes = "";
        $this->endm->HrefValue = "";
        $this->endm->TooltipValue = "";

        // startt
        $this->startt->LinkCustomAttributes = "";
        $this->startt->HrefValue = "";
        $this->startt->TooltipValue = "";

        // endt
        $this->endt->LinkCustomAttributes = "";
        $this->endt->HrefValue = "";
        $this->endt->TooltipValue = "";

        // startw
        $this->startw->LinkCustomAttributes = "";
        $this->startw->HrefValue = "";
        $this->startw->TooltipValue = "";

        // endw
        $this->endw->LinkCustomAttributes = "";
        $this->endw->HrefValue = "";
        $this->endw->TooltipValue = "";

        // startr
        $this->startr->LinkCustomAttributes = "";
        $this->startr->HrefValue = "";
        $this->startr->TooltipValue = "";

        // endr
        $this->endr->LinkCustomAttributes = "";
        $this->endr->HrefValue = "";
        $this->endr->TooltipValue = "";

        // startf
        $this->startf->LinkCustomAttributes = "";
        $this->startf->HrefValue = "";
        $this->startf->TooltipValue = "";

        // endf
        $this->endf->LinkCustomAttributes = "";
        $this->endf->HrefValue = "";
        $this->endf->TooltipValue = "";

        // starts
        $this->starts->LinkCustomAttributes = "";
        $this->starts->HrefValue = "";
        $this->starts->TooltipValue = "";

        // ends
        $this->ends->LinkCustomAttributes = "";
        $this->ends->HrefValue = "";
        $this->ends->TooltipValue = "";

        // startu
        $this->startu->LinkCustomAttributes = "";
        $this->startu->HrefValue = "";
        $this->startu->TooltipValue = "";

        // endu
        $this->endu->LinkCustomAttributes = "";
        $this->endu->HrefValue = "";
        $this->endu->TooltipValue = "";

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
        $this->id->ViewCustomAttributes = "";

        // location_id
        $this->location_id->setupEditAttributes();
        $this->location_id->EditCustomAttributes = "";
        $this->location_id->EditValue = $this->location_id->CurrentValue;
        $this->location_id->PlaceHolder = RemoveHtml($this->location_id->caption());
        if (strval($this->location_id->EditValue) != "" && is_numeric($this->location_id->EditValue)) {
            $this->location_id->EditValue = FormatNumber($this->location_id->EditValue, null);
        }

        // meal_details_id
        $this->meal_details_id->setupEditAttributes();
        $this->meal_details_id->EditCustomAttributes = "";
        $this->meal_details_id->EditValue = $this->meal_details_id->CurrentValue;
        $this->meal_details_id->PlaceHolder = RemoveHtml($this->meal_details_id->caption());
        if (strval($this->meal_details_id->EditValue) != "" && is_numeric($this->meal_details_id->EditValue)) {
            $this->meal_details_id->EditValue = FormatNumber($this->meal_details_id->EditValue, null);
        }

        // startm
        $this->startm->setupEditAttributes();
        $this->startm->EditCustomAttributes = "";
        $this->startm->EditValue = FormatDateTime($this->startm->CurrentValue, 4);
        $this->startm->PlaceHolder = RemoveHtml($this->startm->caption());

        // endm
        $this->endm->setupEditAttributes();
        $this->endm->EditCustomAttributes = "";
        $this->endm->EditValue = FormatDateTime($this->endm->CurrentValue, 4);
        $this->endm->PlaceHolder = RemoveHtml($this->endm->caption());

        // startt
        $this->startt->setupEditAttributes();
        $this->startt->EditCustomAttributes = "";
        $this->startt->EditValue = FormatDateTime($this->startt->CurrentValue, 4);
        $this->startt->PlaceHolder = RemoveHtml($this->startt->caption());

        // endt
        $this->endt->setupEditAttributes();
        $this->endt->EditCustomAttributes = "";
        $this->endt->EditValue = FormatDateTime($this->endt->CurrentValue, 4);
        $this->endt->PlaceHolder = RemoveHtml($this->endt->caption());

        // startw
        $this->startw->setupEditAttributes();
        $this->startw->EditCustomAttributes = "";
        $this->startw->EditValue = FormatDateTime($this->startw->CurrentValue, 4);
        $this->startw->PlaceHolder = RemoveHtml($this->startw->caption());

        // endw
        $this->endw->setupEditAttributes();
        $this->endw->EditCustomAttributes = "";
        $this->endw->EditValue = FormatDateTime($this->endw->CurrentValue, 4);
        $this->endw->PlaceHolder = RemoveHtml($this->endw->caption());

        // startr
        $this->startr->setupEditAttributes();
        $this->startr->EditCustomAttributes = "";
        $this->startr->EditValue = FormatDateTime($this->startr->CurrentValue, 4);
        $this->startr->PlaceHolder = RemoveHtml($this->startr->caption());

        // endr
        $this->endr->setupEditAttributes();
        $this->endr->EditCustomAttributes = "";
        $this->endr->EditValue = FormatDateTime($this->endr->CurrentValue, 4);
        $this->endr->PlaceHolder = RemoveHtml($this->endr->caption());

        // startf
        $this->startf->setupEditAttributes();
        $this->startf->EditCustomAttributes = "";
        $this->startf->EditValue = FormatDateTime($this->startf->CurrentValue, 4);
        $this->startf->PlaceHolder = RemoveHtml($this->startf->caption());

        // endf
        $this->endf->setupEditAttributes();
        $this->endf->EditCustomAttributes = "";
        $this->endf->EditValue = FormatDateTime($this->endf->CurrentValue, 4);
        $this->endf->PlaceHolder = RemoveHtml($this->endf->caption());

        // starts
        $this->starts->setupEditAttributes();
        $this->starts->EditCustomAttributes = "";
        $this->starts->EditValue = FormatDateTime($this->starts->CurrentValue, 4);
        $this->starts->PlaceHolder = RemoveHtml($this->starts->caption());

        // ends
        $this->ends->setupEditAttributes();
        $this->ends->EditCustomAttributes = "";
        $this->ends->EditValue = FormatDateTime($this->ends->CurrentValue, 4);
        $this->ends->PlaceHolder = RemoveHtml($this->ends->caption());

        // startu
        $this->startu->setupEditAttributes();
        $this->startu->EditCustomAttributes = "";
        $this->startu->EditValue = FormatDateTime($this->startu->CurrentValue, 4);
        $this->startu->PlaceHolder = RemoveHtml($this->startu->caption());

        // endu
        $this->endu->setupEditAttributes();
        $this->endu->EditCustomAttributes = "";
        $this->endu->EditValue = FormatDateTime($this->endu->CurrentValue, 4);
        $this->endu->PlaceHolder = RemoveHtml($this->endu->caption());

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
                    $doc->exportCaption($this->location_id);
                    $doc->exportCaption($this->meal_details_id);
                    $doc->exportCaption($this->startm);
                    $doc->exportCaption($this->endm);
                    $doc->exportCaption($this->startt);
                    $doc->exportCaption($this->endt);
                    $doc->exportCaption($this->startw);
                    $doc->exportCaption($this->endw);
                    $doc->exportCaption($this->startr);
                    $doc->exportCaption($this->endr);
                    $doc->exportCaption($this->startf);
                    $doc->exportCaption($this->endf);
                    $doc->exportCaption($this->starts);
                    $doc->exportCaption($this->ends);
                    $doc->exportCaption($this->startu);
                    $doc->exportCaption($this->endu);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->location_id);
                    $doc->exportCaption($this->meal_details_id);
                    $doc->exportCaption($this->startm);
                    $doc->exportCaption($this->endm);
                    $doc->exportCaption($this->startt);
                    $doc->exportCaption($this->endt);
                    $doc->exportCaption($this->startw);
                    $doc->exportCaption($this->endw);
                    $doc->exportCaption($this->startr);
                    $doc->exportCaption($this->endr);
                    $doc->exportCaption($this->startf);
                    $doc->exportCaption($this->endf);
                    $doc->exportCaption($this->starts);
                    $doc->exportCaption($this->ends);
                    $doc->exportCaption($this->startu);
                    $doc->exportCaption($this->endu);
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
                        $doc->exportField($this->location_id);
                        $doc->exportField($this->meal_details_id);
                        $doc->exportField($this->startm);
                        $doc->exportField($this->endm);
                        $doc->exportField($this->startt);
                        $doc->exportField($this->endt);
                        $doc->exportField($this->startw);
                        $doc->exportField($this->endw);
                        $doc->exportField($this->startr);
                        $doc->exportField($this->endr);
                        $doc->exportField($this->startf);
                        $doc->exportField($this->endf);
                        $doc->exportField($this->starts);
                        $doc->exportField($this->ends);
                        $doc->exportField($this->startu);
                        $doc->exportField($this->endu);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->location_id);
                        $doc->exportField($this->meal_details_id);
                        $doc->exportField($this->startm);
                        $doc->exportField($this->endm);
                        $doc->exportField($this->startt);
                        $doc->exportField($this->endt);
                        $doc->exportField($this->startw);
                        $doc->exportField($this->endw);
                        $doc->exportField($this->startr);
                        $doc->exportField($this->endr);
                        $doc->exportField($this->startf);
                        $doc->exportField($this->endf);
                        $doc->exportField($this->starts);
                        $doc->exportField($this->ends);
                        $doc->exportField($this->startu);
                        $doc->exportField($this->endu);
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
