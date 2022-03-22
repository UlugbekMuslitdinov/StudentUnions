<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for control
 */
class Control extends DbTable
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
    public $ID;
    public $online;
    public $online_message;
    public $signup_bursars;
    public $signup_bursars_message;
    public $signup_cc;
    public $signup_cc_message;
    public $deposit_bursars;
    public $deposit_bursars_message;
    public $deposit_cc;
    public $deposit_cc_message;
    public $exporter;
    public $signup;
    public $signup_message;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'control';
        $this->TableName = 'control';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`control`";
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

        // ID
        $this->ID = new DbField(
            'control',
            'control',
            'x_ID',
            'ID',
            '`ID`',
            '`ID`',
            3,
            11,
            -1,
            false,
            '`ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->ID->InputTextType = "text";
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['ID'] = &$this->ID;

        // online
        $this->online = new DbField(
            'control',
            'control',
            'x_online',
            'online',
            '`online`',
            '`online`',
            16,
            1,
            -1,
            false,
            '`online`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->online->InputTextType = "text";
        $this->online->Nullable = false; // NOT NULL field
        $this->online->Required = true; // Required field
        $this->online->DataType = DATATYPE_BOOLEAN;
        $this->online->Lookup = new Lookup('online', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->online->OptionCount = 2;
        $this->online->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['online'] = &$this->online;

        // online_message
        $this->online_message = new DbField(
            'control',
            'control',
            'x_online_message',
            'online_message',
            '`online_message`',
            '`online_message`',
            201,
            65535,
            -1,
            false,
            '`online_message`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->online_message->InputTextType = "text";
        $this->online_message->Nullable = false; // NOT NULL field
        $this->online_message->Required = true; // Required field
        $this->Fields['online_message'] = &$this->online_message;

        // signup_bursars
        $this->signup_bursars = new DbField(
            'control',
            'control',
            'x_signup_bursars',
            'signup_bursars',
            '`signup_bursars`',
            '`signup_bursars`',
            16,
            1,
            -1,
            false,
            '`signup_bursars`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->signup_bursars->InputTextType = "text";
        $this->signup_bursars->Nullable = false; // NOT NULL field
        $this->signup_bursars->Required = true; // Required field
        $this->signup_bursars->DataType = DATATYPE_BOOLEAN;
        $this->signup_bursars->Lookup = new Lookup('signup_bursars', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->signup_bursars->OptionCount = 2;
        $this->signup_bursars->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['signup_bursars'] = &$this->signup_bursars;

        // signup_bursars_message
        $this->signup_bursars_message = new DbField(
            'control',
            'control',
            'x_signup_bursars_message',
            'signup_bursars_message',
            '`signup_bursars_message`',
            '`signup_bursars_message`',
            201,
            65535,
            -1,
            false,
            '`signup_bursars_message`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->signup_bursars_message->InputTextType = "text";
        $this->signup_bursars_message->Nullable = false; // NOT NULL field
        $this->signup_bursars_message->Required = true; // Required field
        $this->Fields['signup_bursars_message'] = &$this->signup_bursars_message;

        // signup_cc
        $this->signup_cc = new DbField(
            'control',
            'control',
            'x_signup_cc',
            'signup_cc',
            '`signup_cc`',
            '`signup_cc`',
            16,
            1,
            -1,
            false,
            '`signup_cc`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->signup_cc->InputTextType = "text";
        $this->signup_cc->Nullable = false; // NOT NULL field
        $this->signup_cc->Required = true; // Required field
        $this->signup_cc->DataType = DATATYPE_BOOLEAN;
        $this->signup_cc->Lookup = new Lookup('signup_cc', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->signup_cc->OptionCount = 2;
        $this->signup_cc->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['signup_cc'] = &$this->signup_cc;

        // signup_cc_message
        $this->signup_cc_message = new DbField(
            'control',
            'control',
            'x_signup_cc_message',
            'signup_cc_message',
            '`signup_cc_message`',
            '`signup_cc_message`',
            201,
            65535,
            -1,
            false,
            '`signup_cc_message`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->signup_cc_message->InputTextType = "text";
        $this->signup_cc_message->Nullable = false; // NOT NULL field
        $this->signup_cc_message->Required = true; // Required field
        $this->Fields['signup_cc_message'] = &$this->signup_cc_message;

        // deposit_bursars
        $this->deposit_bursars = new DbField(
            'control',
            'control',
            'x_deposit_bursars',
            'deposit_bursars',
            '`deposit_bursars`',
            '`deposit_bursars`',
            16,
            1,
            -1,
            false,
            '`deposit_bursars`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->deposit_bursars->InputTextType = "text";
        $this->deposit_bursars->Nullable = false; // NOT NULL field
        $this->deposit_bursars->Required = true; // Required field
        $this->deposit_bursars->DataType = DATATYPE_BOOLEAN;
        $this->deposit_bursars->Lookup = new Lookup('deposit_bursars', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->deposit_bursars->OptionCount = 2;
        $this->deposit_bursars->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['deposit_bursars'] = &$this->deposit_bursars;

        // deposit_bursars_message
        $this->deposit_bursars_message = new DbField(
            'control',
            'control',
            'x_deposit_bursars_message',
            'deposit_bursars_message',
            '`deposit_bursars_message`',
            '`deposit_bursars_message`',
            201,
            65535,
            -1,
            false,
            '`deposit_bursars_message`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->deposit_bursars_message->InputTextType = "text";
        $this->deposit_bursars_message->Nullable = false; // NOT NULL field
        $this->deposit_bursars_message->Required = true; // Required field
        $this->Fields['deposit_bursars_message'] = &$this->deposit_bursars_message;

        // deposit_cc
        $this->deposit_cc = new DbField(
            'control',
            'control',
            'x_deposit_cc',
            'deposit_cc',
            '`deposit_cc`',
            '`deposit_cc`',
            16,
            1,
            -1,
            false,
            '`deposit_cc`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->deposit_cc->InputTextType = "text";
        $this->deposit_cc->Nullable = false; // NOT NULL field
        $this->deposit_cc->Required = true; // Required field
        $this->deposit_cc->DataType = DATATYPE_BOOLEAN;
        $this->deposit_cc->Lookup = new Lookup('deposit_cc', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->deposit_cc->OptionCount = 2;
        $this->deposit_cc->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['deposit_cc'] = &$this->deposit_cc;

        // deposit_cc_message
        $this->deposit_cc_message = new DbField(
            'control',
            'control',
            'x_deposit_cc_message',
            'deposit_cc_message',
            '`deposit_cc_message`',
            '`deposit_cc_message`',
            201,
            65535,
            -1,
            false,
            '`deposit_cc_message`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->deposit_cc_message->InputTextType = "text";
        $this->deposit_cc_message->Nullable = false; // NOT NULL field
        $this->deposit_cc_message->Required = true; // Required field
        $this->Fields['deposit_cc_message'] = &$this->deposit_cc_message;

        // exporter
        $this->exporter = new DbField(
            'control',
            'control',
            'x_exporter',
            'exporter',
            '`exporter`',
            '`exporter`',
            16,
            1,
            -1,
            false,
            '`exporter`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->exporter->InputTextType = "text";
        $this->exporter->Nullable = false; // NOT NULL field
        $this->exporter->Required = true; // Required field
        $this->exporter->DataType = DATATYPE_BOOLEAN;
        $this->exporter->Lookup = new Lookup('exporter', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->exporter->OptionCount = 2;
        $this->exporter->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['exporter'] = &$this->exporter;

        // signup
        $this->signup = new DbField(
            'control',
            'control',
            'x_signup',
            'signup',
            '`signup`',
            '`signup`',
            16,
            1,
            -1,
            false,
            '`signup`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->signup->InputTextType = "text";
        $this->signup->Nullable = false; // NOT NULL field
        $this->signup->Required = true; // Required field
        $this->signup->DataType = DATATYPE_BOOLEAN;
        $this->signup->Lookup = new Lookup('signup', 'control', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->signup->OptionCount = 2;
        $this->signup->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['signup'] = &$this->signup;

        // signup_message
        $this->signup_message = new DbField(
            'control',
            'control',
            'x_signup_message',
            'signup_message',
            '`signup_message`',
            '`signup_message`',
            201,
            65535,
            -1,
            false,
            '`signup_message`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->signup_message->InputTextType = "text";
        $this->Fields['signup_message'] = &$this->signup_message;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`control`";
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
            $this->ID->setDbValue($conn->lastInsertId());
            $rs['ID'] = $this->ID->DbValue;
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
            if (array_key_exists('ID', $rs)) {
                AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
        $this->ID->DbValue = $row['ID'];
        $this->online->DbValue = $row['online'];
        $this->online_message->DbValue = $row['online_message'];
        $this->signup_bursars->DbValue = $row['signup_bursars'];
        $this->signup_bursars_message->DbValue = $row['signup_bursars_message'];
        $this->signup_cc->DbValue = $row['signup_cc'];
        $this->signup_cc_message->DbValue = $row['signup_cc_message'];
        $this->deposit_bursars->DbValue = $row['deposit_bursars'];
        $this->deposit_bursars_message->DbValue = $row['deposit_bursars_message'];
        $this->deposit_cc->DbValue = $row['deposit_cc'];
        $this->deposit_cc_message->DbValue = $row['deposit_cc_message'];
        $this->exporter->DbValue = $row['exporter'];
        $this->signup->DbValue = $row['signup'];
        $this->signup_message->DbValue = $row['signup_message'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`ID` = @ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ID->CurrentValue : $this->ID->OldValue;
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
                $this->ID->CurrentValue = $keys[0];
            } else {
                $this->ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ID', $row) ? $row['ID'] : null;
        } else {
            $val = $this->ID->OldValue !== null ? $this->ID->OldValue : $this->ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ControlList");
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
        if ($pageName == "ControlView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ControlEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ControlAdd") {
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
                return "ControlView";
            case Config("API_ADD_ACTION"):
                return "ControlAdd";
            case Config("API_EDIT_ACTION"):
                return "ControlEdit";
            case Config("API_DELETE_ACTION"):
                return "ControlDelete";
            case Config("API_LIST_ACTION"):
                return "ControlList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ControlList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ControlView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ControlView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ControlAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ControlAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ControlEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ControlAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ControlDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"ID\":" . JsonEncode($this->ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ID->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->ID->CurrentValue);
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
            if (($keyValue = Param("ID") ?? Route("ID")) !== null) {
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
                $this->ID->CurrentValue = $key;
            } else {
                $this->ID->OldValue = $key;
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
        $this->ID->setDbValue($row['ID']);
        $this->online->setDbValue($row['online']);
        $this->online_message->setDbValue($row['online_message']);
        $this->signup_bursars->setDbValue($row['signup_bursars']);
        $this->signup_bursars_message->setDbValue($row['signup_bursars_message']);
        $this->signup_cc->setDbValue($row['signup_cc']);
        $this->signup_cc_message->setDbValue($row['signup_cc_message']);
        $this->deposit_bursars->setDbValue($row['deposit_bursars']);
        $this->deposit_bursars_message->setDbValue($row['deposit_bursars_message']);
        $this->deposit_cc->setDbValue($row['deposit_cc']);
        $this->deposit_cc_message->setDbValue($row['deposit_cc_message']);
        $this->exporter->setDbValue($row['exporter']);
        $this->signup->setDbValue($row['signup']);
        $this->signup_message->setDbValue($row['signup_message']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ID

        // online

        // online_message

        // signup_bursars

        // signup_bursars_message

        // signup_cc

        // signup_cc_message

        // deposit_bursars

        // deposit_bursars_message

        // deposit_cc

        // deposit_cc_message

        // exporter

        // signup

        // signup_message

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // online
        if (ConvertToBool($this->online->CurrentValue)) {
            $this->online->ViewValue = $this->online->tagCaption(1) != "" ? $this->online->tagCaption(1) : "Yes";
        } else {
            $this->online->ViewValue = $this->online->tagCaption(2) != "" ? $this->online->tagCaption(2) : "No";
        }
        $this->online->ViewCustomAttributes = "";

        // online_message
        $this->online_message->ViewValue = $this->online_message->CurrentValue;
        $this->online_message->ViewCustomAttributes = "";

        // signup_bursars
        if (ConvertToBool($this->signup_bursars->CurrentValue)) {
            $this->signup_bursars->ViewValue = $this->signup_bursars->tagCaption(1) != "" ? $this->signup_bursars->tagCaption(1) : "Yes";
        } else {
            $this->signup_bursars->ViewValue = $this->signup_bursars->tagCaption(2) != "" ? $this->signup_bursars->tagCaption(2) : "No";
        }
        $this->signup_bursars->ViewCustomAttributes = "";

        // signup_bursars_message
        $this->signup_bursars_message->ViewValue = $this->signup_bursars_message->CurrentValue;
        $this->signup_bursars_message->ViewCustomAttributes = "";

        // signup_cc
        if (ConvertToBool($this->signup_cc->CurrentValue)) {
            $this->signup_cc->ViewValue = $this->signup_cc->tagCaption(1) != "" ? $this->signup_cc->tagCaption(1) : "Yes";
        } else {
            $this->signup_cc->ViewValue = $this->signup_cc->tagCaption(2) != "" ? $this->signup_cc->tagCaption(2) : "No";
        }
        $this->signup_cc->ViewCustomAttributes = "";

        // signup_cc_message
        $this->signup_cc_message->ViewValue = $this->signup_cc_message->CurrentValue;
        $this->signup_cc_message->ViewCustomAttributes = "";

        // deposit_bursars
        if (ConvertToBool($this->deposit_bursars->CurrentValue)) {
            $this->deposit_bursars->ViewValue = $this->deposit_bursars->tagCaption(1) != "" ? $this->deposit_bursars->tagCaption(1) : "Yes";
        } else {
            $this->deposit_bursars->ViewValue = $this->deposit_bursars->tagCaption(2) != "" ? $this->deposit_bursars->tagCaption(2) : "No";
        }
        $this->deposit_bursars->ViewCustomAttributes = "";

        // deposit_bursars_message
        $this->deposit_bursars_message->ViewValue = $this->deposit_bursars_message->CurrentValue;
        $this->deposit_bursars_message->ViewCustomAttributes = "";

        // deposit_cc
        if (ConvertToBool($this->deposit_cc->CurrentValue)) {
            $this->deposit_cc->ViewValue = $this->deposit_cc->tagCaption(1) != "" ? $this->deposit_cc->tagCaption(1) : "Yes";
        } else {
            $this->deposit_cc->ViewValue = $this->deposit_cc->tagCaption(2) != "" ? $this->deposit_cc->tagCaption(2) : "No";
        }
        $this->deposit_cc->ViewCustomAttributes = "";

        // deposit_cc_message
        $this->deposit_cc_message->ViewValue = $this->deposit_cc_message->CurrentValue;
        $this->deposit_cc_message->ViewCustomAttributes = "";

        // exporter
        if (ConvertToBool($this->exporter->CurrentValue)) {
            $this->exporter->ViewValue = $this->exporter->tagCaption(1) != "" ? $this->exporter->tagCaption(1) : "Yes";
        } else {
            $this->exporter->ViewValue = $this->exporter->tagCaption(2) != "" ? $this->exporter->tagCaption(2) : "No";
        }
        $this->exporter->ViewCustomAttributes = "";

        // signup
        if (ConvertToBool($this->signup->CurrentValue)) {
            $this->signup->ViewValue = $this->signup->tagCaption(1) != "" ? $this->signup->tagCaption(1) : "Yes";
        } else {
            $this->signup->ViewValue = $this->signup->tagCaption(2) != "" ? $this->signup->tagCaption(2) : "No";
        }
        $this->signup->ViewCustomAttributes = "";

        // signup_message
        $this->signup_message->ViewValue = $this->signup_message->CurrentValue;
        $this->signup_message->ViewCustomAttributes = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

        // online
        $this->online->LinkCustomAttributes = "";
        $this->online->HrefValue = "";
        $this->online->TooltipValue = "";

        // online_message
        $this->online_message->LinkCustomAttributes = "";
        $this->online_message->HrefValue = "";
        $this->online_message->TooltipValue = "";

        // signup_bursars
        $this->signup_bursars->LinkCustomAttributes = "";
        $this->signup_bursars->HrefValue = "";
        $this->signup_bursars->TooltipValue = "";

        // signup_bursars_message
        $this->signup_bursars_message->LinkCustomAttributes = "";
        $this->signup_bursars_message->HrefValue = "";
        $this->signup_bursars_message->TooltipValue = "";

        // signup_cc
        $this->signup_cc->LinkCustomAttributes = "";
        $this->signup_cc->HrefValue = "";
        $this->signup_cc->TooltipValue = "";

        // signup_cc_message
        $this->signup_cc_message->LinkCustomAttributes = "";
        $this->signup_cc_message->HrefValue = "";
        $this->signup_cc_message->TooltipValue = "";

        // deposit_bursars
        $this->deposit_bursars->LinkCustomAttributes = "";
        $this->deposit_bursars->HrefValue = "";
        $this->deposit_bursars->TooltipValue = "";

        // deposit_bursars_message
        $this->deposit_bursars_message->LinkCustomAttributes = "";
        $this->deposit_bursars_message->HrefValue = "";
        $this->deposit_bursars_message->TooltipValue = "";

        // deposit_cc
        $this->deposit_cc->LinkCustomAttributes = "";
        $this->deposit_cc->HrefValue = "";
        $this->deposit_cc->TooltipValue = "";

        // deposit_cc_message
        $this->deposit_cc_message->LinkCustomAttributes = "";
        $this->deposit_cc_message->HrefValue = "";
        $this->deposit_cc_message->TooltipValue = "";

        // exporter
        $this->exporter->LinkCustomAttributes = "";
        $this->exporter->HrefValue = "";
        $this->exporter->TooltipValue = "";

        // signup
        $this->signup->LinkCustomAttributes = "";
        $this->signup->HrefValue = "";
        $this->signup->TooltipValue = "";

        // signup_message
        $this->signup_message->LinkCustomAttributes = "";
        $this->signup_message->HrefValue = "";
        $this->signup_message->TooltipValue = "";

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

        // ID
        $this->ID->setupEditAttributes();
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // online
        $this->online->EditCustomAttributes = "";
        $this->online->EditValue = $this->online->options(false);
        $this->online->PlaceHolder = RemoveHtml($this->online->caption());

        // online_message
        $this->online_message->setupEditAttributes();
        $this->online_message->EditCustomAttributes = "";
        $this->online_message->EditValue = $this->online_message->CurrentValue;
        $this->online_message->PlaceHolder = RemoveHtml($this->online_message->caption());

        // signup_bursars
        $this->signup_bursars->EditCustomAttributes = "";
        $this->signup_bursars->EditValue = $this->signup_bursars->options(false);
        $this->signup_bursars->PlaceHolder = RemoveHtml($this->signup_bursars->caption());

        // signup_bursars_message
        $this->signup_bursars_message->setupEditAttributes();
        $this->signup_bursars_message->EditCustomAttributes = "";
        $this->signup_bursars_message->EditValue = $this->signup_bursars_message->CurrentValue;
        $this->signup_bursars_message->PlaceHolder = RemoveHtml($this->signup_bursars_message->caption());

        // signup_cc
        $this->signup_cc->EditCustomAttributes = "";
        $this->signup_cc->EditValue = $this->signup_cc->options(false);
        $this->signup_cc->PlaceHolder = RemoveHtml($this->signup_cc->caption());

        // signup_cc_message
        $this->signup_cc_message->setupEditAttributes();
        $this->signup_cc_message->EditCustomAttributes = "";
        $this->signup_cc_message->EditValue = $this->signup_cc_message->CurrentValue;
        $this->signup_cc_message->PlaceHolder = RemoveHtml($this->signup_cc_message->caption());

        // deposit_bursars
        $this->deposit_bursars->EditCustomAttributes = "";
        $this->deposit_bursars->EditValue = $this->deposit_bursars->options(false);
        $this->deposit_bursars->PlaceHolder = RemoveHtml($this->deposit_bursars->caption());

        // deposit_bursars_message
        $this->deposit_bursars_message->setupEditAttributes();
        $this->deposit_bursars_message->EditCustomAttributes = "";
        $this->deposit_bursars_message->EditValue = $this->deposit_bursars_message->CurrentValue;
        $this->deposit_bursars_message->PlaceHolder = RemoveHtml($this->deposit_bursars_message->caption());

        // deposit_cc
        $this->deposit_cc->EditCustomAttributes = "";
        $this->deposit_cc->EditValue = $this->deposit_cc->options(false);
        $this->deposit_cc->PlaceHolder = RemoveHtml($this->deposit_cc->caption());

        // deposit_cc_message
        $this->deposit_cc_message->setupEditAttributes();
        $this->deposit_cc_message->EditCustomAttributes = "";
        $this->deposit_cc_message->EditValue = $this->deposit_cc_message->CurrentValue;
        $this->deposit_cc_message->PlaceHolder = RemoveHtml($this->deposit_cc_message->caption());

        // exporter
        $this->exporter->EditCustomAttributes = "";
        $this->exporter->EditValue = $this->exporter->options(false);
        $this->exporter->PlaceHolder = RemoveHtml($this->exporter->caption());

        // signup
        $this->signup->EditCustomAttributes = "";
        $this->signup->EditValue = $this->signup->options(false);
        $this->signup->PlaceHolder = RemoveHtml($this->signup->caption());

        // signup_message
        $this->signup_message->setupEditAttributes();
        $this->signup_message->EditCustomAttributes = "";
        $this->signup_message->EditValue = $this->signup_message->CurrentValue;
        $this->signup_message->PlaceHolder = RemoveHtml($this->signup_message->caption());

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
                    $doc->exportCaption($this->ID);
                    $doc->exportCaption($this->online);
                    $doc->exportCaption($this->online_message);
                    $doc->exportCaption($this->signup_bursars);
                    $doc->exportCaption($this->signup_bursars_message);
                    $doc->exportCaption($this->signup_cc);
                    $doc->exportCaption($this->signup_cc_message);
                    $doc->exportCaption($this->deposit_bursars);
                    $doc->exportCaption($this->deposit_bursars_message);
                    $doc->exportCaption($this->deposit_cc);
                    $doc->exportCaption($this->deposit_cc_message);
                    $doc->exportCaption($this->exporter);
                    $doc->exportCaption($this->signup);
                    $doc->exportCaption($this->signup_message);
                } else {
                    $doc->exportCaption($this->ID);
                    $doc->exportCaption($this->online);
                    $doc->exportCaption($this->signup_bursars);
                    $doc->exportCaption($this->signup_cc);
                    $doc->exportCaption($this->deposit_bursars);
                    $doc->exportCaption($this->deposit_cc);
                    $doc->exportCaption($this->exporter);
                    $doc->exportCaption($this->signup);
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
                        $doc->exportField($this->ID);
                        $doc->exportField($this->online);
                        $doc->exportField($this->online_message);
                        $doc->exportField($this->signup_bursars);
                        $doc->exportField($this->signup_bursars_message);
                        $doc->exportField($this->signup_cc);
                        $doc->exportField($this->signup_cc_message);
                        $doc->exportField($this->deposit_bursars);
                        $doc->exportField($this->deposit_bursars_message);
                        $doc->exportField($this->deposit_cc);
                        $doc->exportField($this->deposit_cc_message);
                        $doc->exportField($this->exporter);
                        $doc->exportField($this->signup);
                        $doc->exportField($this->signup_message);
                    } else {
                        $doc->exportField($this->ID);
                        $doc->exportField($this->online);
                        $doc->exportField($this->signup_bursars);
                        $doc->exportField($this->signup_cc);
                        $doc->exportField($this->deposit_bursars);
                        $doc->exportField($this->deposit_cc);
                        $doc->exportField($this->exporter);
                        $doc->exportField($this->signup);
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
