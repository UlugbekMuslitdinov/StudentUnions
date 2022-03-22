<?php

namespace PHPMaker2022\project2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for hours
 */
class Hours extends DbTable
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
    public $openm;
    public $closem;
    public $opent;
    public $closet;
    public $openw;
    public $closew;
    public $openr;
    public $closer;
    public $openf;
    public $closef;
    public $opens;
    public $closes;
    public $openu;
    public $closeu;
    public $type;
    public $id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'hours';
        $this->TableName = 'hours';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`hours`";
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
            'hours',
            'hours',
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

        // openm
        $this->openm = new DbField(
            'hours',
            'hours',
            'x_openm',
            'openm',
            '`openm`',
            CastDateFieldForLike("`openm`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`openm`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->openm->InputTextType = "text";
        $this->openm->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['openm'] = &$this->openm;

        // closem
        $this->closem = new DbField(
            'hours',
            'hours',
            'x_closem',
            'closem',
            '`closem`',
            CastDateFieldForLike("`closem`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closem`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closem->InputTextType = "text";
        $this->closem->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closem'] = &$this->closem;

        // opent
        $this->opent = new DbField(
            'hours',
            'hours',
            'x_opent',
            'opent',
            '`opent`',
            CastDateFieldForLike("`opent`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`opent`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->opent->InputTextType = "text";
        $this->opent->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['opent'] = &$this->opent;

        // closet
        $this->closet = new DbField(
            'hours',
            'hours',
            'x_closet',
            'closet',
            '`closet`',
            CastDateFieldForLike("`closet`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closet`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closet->InputTextType = "text";
        $this->closet->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closet'] = &$this->closet;

        // openw
        $this->openw = new DbField(
            'hours',
            'hours',
            'x_openw',
            'openw',
            '`openw`',
            CastDateFieldForLike("`openw`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`openw`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->openw->InputTextType = "text";
        $this->openw->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['openw'] = &$this->openw;

        // closew
        $this->closew = new DbField(
            'hours',
            'hours',
            'x_closew',
            'closew',
            '`closew`',
            CastDateFieldForLike("`closew`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closew`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closew->InputTextType = "text";
        $this->closew->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closew'] = &$this->closew;

        // openr
        $this->openr = new DbField(
            'hours',
            'hours',
            'x_openr',
            'openr',
            '`openr`',
            CastDateFieldForLike("`openr`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`openr`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->openr->InputTextType = "text";
        $this->openr->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['openr'] = &$this->openr;

        // closer
        $this->closer = new DbField(
            'hours',
            'hours',
            'x_closer',
            'closer',
            '`closer`',
            CastDateFieldForLike("`closer`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closer`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closer->InputTextType = "text";
        $this->closer->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closer'] = &$this->closer;

        // openf
        $this->openf = new DbField(
            'hours',
            'hours',
            'x_openf',
            'openf',
            '`openf`',
            CastDateFieldForLike("`openf`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`openf`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->openf->InputTextType = "text";
        $this->openf->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['openf'] = &$this->openf;

        // closef
        $this->closef = new DbField(
            'hours',
            'hours',
            'x_closef',
            'closef',
            '`closef`',
            CastDateFieldForLike("`closef`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closef`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closef->InputTextType = "text";
        $this->closef->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closef'] = &$this->closef;

        // opens
        $this->opens = new DbField(
            'hours',
            'hours',
            'x_opens',
            'opens',
            '`opens`',
            CastDateFieldForLike("`opens`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`opens`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->opens->InputTextType = "text";
        $this->opens->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['opens'] = &$this->opens;

        // closes
        $this->closes = new DbField(
            'hours',
            'hours',
            'x_closes',
            'closes',
            '`closes`',
            CastDateFieldForLike("`closes`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closes`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closes->InputTextType = "text";
        $this->closes->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closes'] = &$this->closes;

        // openu
        $this->openu = new DbField(
            'hours',
            'hours',
            'x_openu',
            'openu',
            '`openu`',
            CastDateFieldForLike("`openu`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`openu`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->openu->InputTextType = "text";
        $this->openu->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['openu'] = &$this->openu;

        // closeu
        $this->closeu = new DbField(
            'hours',
            'hours',
            'x_closeu',
            'closeu',
            '`closeu`',
            CastDateFieldForLike("`closeu`", 4, "DB"),
            134,
            10,
            4,
            false,
            '`closeu`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->closeu->InputTextType = "text";
        $this->closeu->DefaultErrorMessage = str_replace("%s", DateFormat(4), $Language->phrase("IncorrectTime"));
        $this->Fields['closeu'] = &$this->closeu;

        // type
        $this->type = new DbField(
            'hours',
            'hours',
            'x_type',
            'type',
            '`type`',
            '`type`',
            16,
            1,
            -1,
            false,
            '`type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->type->InputTextType = "text";
        $this->type->DataType = DATATYPE_BOOLEAN;
        $this->type->Lookup = new Lookup('type', 'hours', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->type->OptionCount = 2;
        $this->type->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['type'] = &$this->type;

        // id
        $this->id = new DbField(
            'hours',
            'hours',
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`hours`";
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
        $this->location_id->DbValue = $row['location_id'];
        $this->openm->DbValue = $row['openm'];
        $this->closem->DbValue = $row['closem'];
        $this->opent->DbValue = $row['opent'];
        $this->closet->DbValue = $row['closet'];
        $this->openw->DbValue = $row['openw'];
        $this->closew->DbValue = $row['closew'];
        $this->openr->DbValue = $row['openr'];
        $this->closer->DbValue = $row['closer'];
        $this->openf->DbValue = $row['openf'];
        $this->closef->DbValue = $row['closef'];
        $this->opens->DbValue = $row['opens'];
        $this->closes->DbValue = $row['closes'];
        $this->openu->DbValue = $row['openu'];
        $this->closeu->DbValue = $row['closeu'];
        $this->type->DbValue = $row['type'];
        $this->id->DbValue = $row['id'];
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
        return $_SESSION[$name] ?? GetUrl("HoursList");
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
        if ($pageName == "HoursView") {
            return $Language->phrase("View");
        } elseif ($pageName == "HoursEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "HoursAdd") {
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
                return "HoursView";
            case Config("API_ADD_ACTION"):
                return "HoursAdd";
            case Config("API_EDIT_ACTION"):
                return "HoursEdit";
            case Config("API_DELETE_ACTION"):
                return "HoursDelete";
            case Config("API_LIST_ACTION"):
                return "HoursList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "HoursList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("HoursView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("HoursView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "HoursAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "HoursAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("HoursEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("HoursAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("HoursDelete", $this->getUrlParm());
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
        $this->location_id->setDbValue($row['location_id']);
        $this->openm->setDbValue($row['openm']);
        $this->closem->setDbValue($row['closem']);
        $this->opent->setDbValue($row['opent']);
        $this->closet->setDbValue($row['closet']);
        $this->openw->setDbValue($row['openw']);
        $this->closew->setDbValue($row['closew']);
        $this->openr->setDbValue($row['openr']);
        $this->closer->setDbValue($row['closer']);
        $this->openf->setDbValue($row['openf']);
        $this->closef->setDbValue($row['closef']);
        $this->opens->setDbValue($row['opens']);
        $this->closes->setDbValue($row['closes']);
        $this->openu->setDbValue($row['openu']);
        $this->closeu->setDbValue($row['closeu']);
        $this->type->setDbValue($row['type']);
        $this->id->setDbValue($row['id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // location_id

        // openm

        // closem

        // opent

        // closet

        // openw

        // closew

        // openr

        // closer

        // openf

        // closef

        // opens

        // closes

        // openu

        // closeu

        // type

        // id

        // location_id
        $this->location_id->ViewValue = $this->location_id->CurrentValue;
        $this->location_id->ViewValue = FormatNumber($this->location_id->ViewValue, "");
        $this->location_id->ViewCustomAttributes = "";

        // openm
        $this->openm->ViewValue = $this->openm->CurrentValue;
        $this->openm->ViewValue = FormatDateTime($this->openm->ViewValue, 4);
        $this->openm->ViewCustomAttributes = "";

        // closem
        $this->closem->ViewValue = $this->closem->CurrentValue;
        $this->closem->ViewValue = FormatDateTime($this->closem->ViewValue, 4);
        $this->closem->ViewCustomAttributes = "";

        // opent
        $this->opent->ViewValue = $this->opent->CurrentValue;
        $this->opent->ViewValue = FormatDateTime($this->opent->ViewValue, 4);
        $this->opent->ViewCustomAttributes = "";

        // closet
        $this->closet->ViewValue = $this->closet->CurrentValue;
        $this->closet->ViewValue = FormatDateTime($this->closet->ViewValue, 4);
        $this->closet->ViewCustomAttributes = "";

        // openw
        $this->openw->ViewValue = $this->openw->CurrentValue;
        $this->openw->ViewValue = FormatDateTime($this->openw->ViewValue, 4);
        $this->openw->ViewCustomAttributes = "";

        // closew
        $this->closew->ViewValue = $this->closew->CurrentValue;
        $this->closew->ViewValue = FormatDateTime($this->closew->ViewValue, 4);
        $this->closew->ViewCustomAttributes = "";

        // openr
        $this->openr->ViewValue = $this->openr->CurrentValue;
        $this->openr->ViewValue = FormatDateTime($this->openr->ViewValue, 4);
        $this->openr->ViewCustomAttributes = "";

        // closer
        $this->closer->ViewValue = $this->closer->CurrentValue;
        $this->closer->ViewValue = FormatDateTime($this->closer->ViewValue, 4);
        $this->closer->ViewCustomAttributes = "";

        // openf
        $this->openf->ViewValue = $this->openf->CurrentValue;
        $this->openf->ViewValue = FormatDateTime($this->openf->ViewValue, 4);
        $this->openf->ViewCustomAttributes = "";

        // closef
        $this->closef->ViewValue = $this->closef->CurrentValue;
        $this->closef->ViewValue = FormatDateTime($this->closef->ViewValue, 4);
        $this->closef->ViewCustomAttributes = "";

        // opens
        $this->opens->ViewValue = $this->opens->CurrentValue;
        $this->opens->ViewValue = FormatDateTime($this->opens->ViewValue, 4);
        $this->opens->ViewCustomAttributes = "";

        // closes
        $this->closes->ViewValue = $this->closes->CurrentValue;
        $this->closes->ViewValue = FormatDateTime($this->closes->ViewValue, 4);
        $this->closes->ViewCustomAttributes = "";

        // openu
        $this->openu->ViewValue = $this->openu->CurrentValue;
        $this->openu->ViewValue = FormatDateTime($this->openu->ViewValue, 4);
        $this->openu->ViewCustomAttributes = "";

        // closeu
        $this->closeu->ViewValue = $this->closeu->CurrentValue;
        $this->closeu->ViewValue = FormatDateTime($this->closeu->ViewValue, 4);
        $this->closeu->ViewCustomAttributes = "";

        // type
        if (ConvertToBool($this->type->CurrentValue)) {
            $this->type->ViewValue = $this->type->tagCaption(1) != "" ? $this->type->tagCaption(1) : "Yes";
        } else {
            $this->type->ViewValue = $this->type->tagCaption(2) != "" ? $this->type->tagCaption(2) : "No";
        }
        $this->type->ViewCustomAttributes = "";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // location_id
        $this->location_id->LinkCustomAttributes = "";
        $this->location_id->HrefValue = "";
        $this->location_id->TooltipValue = "";

        // openm
        $this->openm->LinkCustomAttributes = "";
        $this->openm->HrefValue = "";
        $this->openm->TooltipValue = "";

        // closem
        $this->closem->LinkCustomAttributes = "";
        $this->closem->HrefValue = "";
        $this->closem->TooltipValue = "";

        // opent
        $this->opent->LinkCustomAttributes = "";
        $this->opent->HrefValue = "";
        $this->opent->TooltipValue = "";

        // closet
        $this->closet->LinkCustomAttributes = "";
        $this->closet->HrefValue = "";
        $this->closet->TooltipValue = "";

        // openw
        $this->openw->LinkCustomAttributes = "";
        $this->openw->HrefValue = "";
        $this->openw->TooltipValue = "";

        // closew
        $this->closew->LinkCustomAttributes = "";
        $this->closew->HrefValue = "";
        $this->closew->TooltipValue = "";

        // openr
        $this->openr->LinkCustomAttributes = "";
        $this->openr->HrefValue = "";
        $this->openr->TooltipValue = "";

        // closer
        $this->closer->LinkCustomAttributes = "";
        $this->closer->HrefValue = "";
        $this->closer->TooltipValue = "";

        // openf
        $this->openf->LinkCustomAttributes = "";
        $this->openf->HrefValue = "";
        $this->openf->TooltipValue = "";

        // closef
        $this->closef->LinkCustomAttributes = "";
        $this->closef->HrefValue = "";
        $this->closef->TooltipValue = "";

        // opens
        $this->opens->LinkCustomAttributes = "";
        $this->opens->HrefValue = "";
        $this->opens->TooltipValue = "";

        // closes
        $this->closes->LinkCustomAttributes = "";
        $this->closes->HrefValue = "";
        $this->closes->TooltipValue = "";

        // openu
        $this->openu->LinkCustomAttributes = "";
        $this->openu->HrefValue = "";
        $this->openu->TooltipValue = "";

        // closeu
        $this->closeu->LinkCustomAttributes = "";
        $this->closeu->HrefValue = "";
        $this->closeu->TooltipValue = "";

        // type
        $this->type->LinkCustomAttributes = "";
        $this->type->HrefValue = "";
        $this->type->TooltipValue = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

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

        // openm
        $this->openm->setupEditAttributes();
        $this->openm->EditCustomAttributes = "";
        $this->openm->EditValue = FormatDateTime($this->openm->CurrentValue, 4);
        $this->openm->PlaceHolder = RemoveHtml($this->openm->caption());

        // closem
        $this->closem->setupEditAttributes();
        $this->closem->EditCustomAttributes = "";
        $this->closem->EditValue = FormatDateTime($this->closem->CurrentValue, 4);
        $this->closem->PlaceHolder = RemoveHtml($this->closem->caption());

        // opent
        $this->opent->setupEditAttributes();
        $this->opent->EditCustomAttributes = "";
        $this->opent->EditValue = FormatDateTime($this->opent->CurrentValue, 4);
        $this->opent->PlaceHolder = RemoveHtml($this->opent->caption());

        // closet
        $this->closet->setupEditAttributes();
        $this->closet->EditCustomAttributes = "";
        $this->closet->EditValue = FormatDateTime($this->closet->CurrentValue, 4);
        $this->closet->PlaceHolder = RemoveHtml($this->closet->caption());

        // openw
        $this->openw->setupEditAttributes();
        $this->openw->EditCustomAttributes = "";
        $this->openw->EditValue = FormatDateTime($this->openw->CurrentValue, 4);
        $this->openw->PlaceHolder = RemoveHtml($this->openw->caption());

        // closew
        $this->closew->setupEditAttributes();
        $this->closew->EditCustomAttributes = "";
        $this->closew->EditValue = FormatDateTime($this->closew->CurrentValue, 4);
        $this->closew->PlaceHolder = RemoveHtml($this->closew->caption());

        // openr
        $this->openr->setupEditAttributes();
        $this->openr->EditCustomAttributes = "";
        $this->openr->EditValue = FormatDateTime($this->openr->CurrentValue, 4);
        $this->openr->PlaceHolder = RemoveHtml($this->openr->caption());

        // closer
        $this->closer->setupEditAttributes();
        $this->closer->EditCustomAttributes = "";
        $this->closer->EditValue = FormatDateTime($this->closer->CurrentValue, 4);
        $this->closer->PlaceHolder = RemoveHtml($this->closer->caption());

        // openf
        $this->openf->setupEditAttributes();
        $this->openf->EditCustomAttributes = "";
        $this->openf->EditValue = FormatDateTime($this->openf->CurrentValue, 4);
        $this->openf->PlaceHolder = RemoveHtml($this->openf->caption());

        // closef
        $this->closef->setupEditAttributes();
        $this->closef->EditCustomAttributes = "";
        $this->closef->EditValue = FormatDateTime($this->closef->CurrentValue, 4);
        $this->closef->PlaceHolder = RemoveHtml($this->closef->caption());

        // opens
        $this->opens->setupEditAttributes();
        $this->opens->EditCustomAttributes = "";
        $this->opens->EditValue = FormatDateTime($this->opens->CurrentValue, 4);
        $this->opens->PlaceHolder = RemoveHtml($this->opens->caption());

        // closes
        $this->closes->setupEditAttributes();
        $this->closes->EditCustomAttributes = "";
        $this->closes->EditValue = FormatDateTime($this->closes->CurrentValue, 4);
        $this->closes->PlaceHolder = RemoveHtml($this->closes->caption());

        // openu
        $this->openu->setupEditAttributes();
        $this->openu->EditCustomAttributes = "";
        $this->openu->EditValue = FormatDateTime($this->openu->CurrentValue, 4);
        $this->openu->PlaceHolder = RemoveHtml($this->openu->caption());

        // closeu
        $this->closeu->setupEditAttributes();
        $this->closeu->EditCustomAttributes = "";
        $this->closeu->EditValue = FormatDateTime($this->closeu->CurrentValue, 4);
        $this->closeu->PlaceHolder = RemoveHtml($this->closeu->caption());

        // type
        $this->type->EditCustomAttributes = "";
        $this->type->EditValue = $this->type->options(false);
        $this->type->PlaceHolder = RemoveHtml($this->type->caption());

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->openm);
                    $doc->exportCaption($this->closem);
                    $doc->exportCaption($this->opent);
                    $doc->exportCaption($this->closet);
                    $doc->exportCaption($this->openw);
                    $doc->exportCaption($this->closew);
                    $doc->exportCaption($this->openr);
                    $doc->exportCaption($this->closer);
                    $doc->exportCaption($this->openf);
                    $doc->exportCaption($this->closef);
                    $doc->exportCaption($this->opens);
                    $doc->exportCaption($this->closes);
                    $doc->exportCaption($this->openu);
                    $doc->exportCaption($this->closeu);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->id);
                } else {
                    $doc->exportCaption($this->location_id);
                    $doc->exportCaption($this->openm);
                    $doc->exportCaption($this->closem);
                    $doc->exportCaption($this->opent);
                    $doc->exportCaption($this->closet);
                    $doc->exportCaption($this->openw);
                    $doc->exportCaption($this->closew);
                    $doc->exportCaption($this->openr);
                    $doc->exportCaption($this->closer);
                    $doc->exportCaption($this->openf);
                    $doc->exportCaption($this->closef);
                    $doc->exportCaption($this->opens);
                    $doc->exportCaption($this->closes);
                    $doc->exportCaption($this->openu);
                    $doc->exportCaption($this->closeu);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->id);
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
                        $doc->exportField($this->openm);
                        $doc->exportField($this->closem);
                        $doc->exportField($this->opent);
                        $doc->exportField($this->closet);
                        $doc->exportField($this->openw);
                        $doc->exportField($this->closew);
                        $doc->exportField($this->openr);
                        $doc->exportField($this->closer);
                        $doc->exportField($this->openf);
                        $doc->exportField($this->closef);
                        $doc->exportField($this->opens);
                        $doc->exportField($this->closes);
                        $doc->exportField($this->openu);
                        $doc->exportField($this->closeu);
                        $doc->exportField($this->type);
                        $doc->exportField($this->id);
                    } else {
                        $doc->exportField($this->location_id);
                        $doc->exportField($this->openm);
                        $doc->exportField($this->closem);
                        $doc->exportField($this->opent);
                        $doc->exportField($this->closet);
                        $doc->exportField($this->openw);
                        $doc->exportField($this->closew);
                        $doc->exportField($this->openr);
                        $doc->exportField($this->closer);
                        $doc->exportField($this->openf);
                        $doc->exportField($this->closef);
                        $doc->exportField($this->opens);
                        $doc->exportField($this->closes);
                        $doc->exportField($this->openu);
                        $doc->exportField($this->closeu);
                        $doc->exportField($this->type);
                        $doc->exportField($this->id);
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
