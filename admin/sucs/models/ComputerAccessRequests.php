<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for computer_access_requests
 */
class ComputerAccessRequests extends DbTable
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
    public $supervisor_name;
    public $supervisor_phone;
    public $employee_type;
    public $employee_position;
    public $employee_first_name;
    public $employee_last_name;
    public $employee_title;
    public $employee_email;
    public $employee_phone;
    public $employee_unit;
    public $employee_netid;
    public $employee_id;
    public $location;
    public $access;
    public $foodpro_location;
    public $catcard;
    public $register_pin;
    public $other;
    public $timestamp;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'computer_access_requests';
        $this->TableName = 'computer_access_requests';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`computer_access_requests`";
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
        $this->id = new DbField('computer_access_requests', 'computer_access_requests', 'x_id', 'id', '`id`', '`id`', 19, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // supervisor_name
        $this->supervisor_name = new DbField('computer_access_requests', 'computer_access_requests', 'x_supervisor_name', 'supervisor_name', '`supervisor_name`', '`supervisor_name`', 200, 80, -1, false, '`supervisor_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_name->Nullable = false; // NOT NULL field
        $this->supervisor_name->Required = true; // Required field
        $this->supervisor_name->Sortable = true; // Allow sort
        $this->supervisor_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_name->Param, "CustomMsg");
        $this->Fields['supervisor_name'] = &$this->supervisor_name;

        // supervisor_phone
        $this->supervisor_phone = new DbField('computer_access_requests', 'computer_access_requests', 'x_supervisor_phone', 'supervisor_phone', '`supervisor_phone`', '`supervisor_phone`', 200, 20, -1, false, '`supervisor_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_phone->Nullable = false; // NOT NULL field
        $this->supervisor_phone->Required = true; // Required field
        $this->supervisor_phone->Sortable = true; // Allow sort
        $this->supervisor_phone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_phone->Param, "CustomMsg");
        $this->Fields['supervisor_phone'] = &$this->supervisor_phone;

        // employee_type
        $this->employee_type = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_type', 'employee_type', '`employee_type`', '`employee_type`', 200, 20, -1, false, '`employee_type`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_type->Nullable = false; // NOT NULL field
        $this->employee_type->Required = true; // Required field
        $this->employee_type->Sortable = true; // Allow sort
        $this->employee_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_type->Param, "CustomMsg");
        $this->Fields['employee_type'] = &$this->employee_type;

        // employee_position
        $this->employee_position = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_position', 'employee_position', '`employee_position`', '`employee_position`', 200, 20, -1, false, '`employee_position`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_position->Nullable = false; // NOT NULL field
        $this->employee_position->Required = true; // Required field
        $this->employee_position->Sortable = true; // Allow sort
        $this->employee_position->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_position->Param, "CustomMsg");
        $this->Fields['employee_position'] = &$this->employee_position;

        // employee_first_name
        $this->employee_first_name = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_first_name', 'employee_first_name', '`employee_first_name`', '`employee_first_name`', 200, 45, -1, false, '`employee_first_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_first_name->Nullable = false; // NOT NULL field
        $this->employee_first_name->Required = true; // Required field
        $this->employee_first_name->Sortable = true; // Allow sort
        $this->employee_first_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_first_name->Param, "CustomMsg");
        $this->Fields['employee_first_name'] = &$this->employee_first_name;

        // employee_last_name
        $this->employee_last_name = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_last_name', 'employee_last_name', '`employee_last_name`', '`employee_last_name`', 200, 45, -1, false, '`employee_last_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_last_name->Nullable = false; // NOT NULL field
        $this->employee_last_name->Required = true; // Required field
        $this->employee_last_name->Sortable = true; // Allow sort
        $this->employee_last_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_last_name->Param, "CustomMsg");
        $this->Fields['employee_last_name'] = &$this->employee_last_name;

        // employee_title
        $this->employee_title = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_title', 'employee_title', '`employee_title`', '`employee_title`', 200, 80, -1, false, '`employee_title`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_title->Nullable = false; // NOT NULL field
        $this->employee_title->Required = true; // Required field
        $this->employee_title->Sortable = true; // Allow sort
        $this->employee_title->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_title->Param, "CustomMsg");
        $this->Fields['employee_title'] = &$this->employee_title;

        // employee_email
        $this->employee_email = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_email', 'employee_email', '`employee_email`', '`employee_email`', 200, 80, -1, false, '`employee_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_email->Nullable = false; // NOT NULL field
        $this->employee_email->Required = true; // Required field
        $this->employee_email->Sortable = true; // Allow sort
        $this->employee_email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_email->Param, "CustomMsg");
        $this->Fields['employee_email'] = &$this->employee_email;

        // employee_phone
        $this->employee_phone = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_phone', 'employee_phone', '`employee_phone`', '`employee_phone`', 200, 20, -1, false, '`employee_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_phone->Nullable = false; // NOT NULL field
        $this->employee_phone->Required = true; // Required field
        $this->employee_phone->Sortable = true; // Allow sort
        $this->employee_phone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_phone->Param, "CustomMsg");
        $this->Fields['employee_phone'] = &$this->employee_phone;

        // employee_unit
        $this->employee_unit = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_unit', 'employee_unit', '`employee_unit`', '`employee_unit`', 200, 60, -1, false, '`employee_unit`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_unit->Nullable = false; // NOT NULL field
        $this->employee_unit->Required = true; // Required field
        $this->employee_unit->Sortable = true; // Allow sort
        $this->employee_unit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_unit->Param, "CustomMsg");
        $this->Fields['employee_unit'] = &$this->employee_unit;

        // employee_netid
        $this->employee_netid = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_netid', 'employee_netid', '`employee_netid`', '`employee_netid`', 200, 60, -1, false, '`employee_netid`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_netid->Nullable = false; // NOT NULL field
        $this->employee_netid->Required = true; // Required field
        $this->employee_netid->Sortable = true; // Allow sort
        $this->employee_netid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_netid->Param, "CustomMsg");
        $this->Fields['employee_netid'] = &$this->employee_netid;

        // employee_id
        $this->employee_id = new DbField('computer_access_requests', 'computer_access_requests', 'x_employee_id', 'employee_id', '`employee_id`', '`employee_id`', 200, 30, -1, false, '`employee_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_id->Nullable = false; // NOT NULL field
        $this->employee_id->Required = true; // Required field
        $this->employee_id->Sortable = true; // Allow sort
        $this->employee_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_id->Param, "CustomMsg");
        $this->Fields['employee_id'] = &$this->employee_id;

        // location
        $this->location = new DbField('computer_access_requests', 'computer_access_requests', 'x_location', 'location', '`location`', '`location`', 200, 140, -1, false, '`location`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->location->Nullable = false; // NOT NULL field
        $this->location->Required = true; // Required field
        $this->location->Sortable = true; // Allow sort
        $this->location->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->location->Param, "CustomMsg");
        $this->Fields['location'] = &$this->location;

        // access
        $this->access = new DbField('computer_access_requests', 'computer_access_requests', 'x_access', 'access', '`access`', '`access`', 3, 8, -1, false, '`access`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->access->Nullable = false; // NOT NULL field
        $this->access->Required = true; // Required field
        $this->access->Sortable = true; // Allow sort
        $this->access->DataType = DATATYPE_BIT;
        $this->access->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->access->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->access->Param, "CustomMsg");
        $this->Fields['access'] = &$this->access;

        // foodpro_location
        $this->foodpro_location = new DbField('computer_access_requests', 'computer_access_requests', 'x_foodpro_location', 'foodpro_location', '`foodpro_location`', '`foodpro_location`', 200, 45, -1, false, '`foodpro_location`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->foodpro_location->Sortable = true; // Allow sort
        $this->foodpro_location->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->foodpro_location->Param, "CustomMsg");
        $this->Fields['foodpro_location'] = &$this->foodpro_location;

        // catcard
        $this->catcard = new DbField('computer_access_requests', 'computer_access_requests', 'x_catcard', 'catcard', '`catcard`', '`catcard`', 200, 20, -1, false, '`catcard`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->catcard->Sortable = true; // Allow sort
        $this->catcard->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->catcard->Param, "CustomMsg");
        $this->Fields['catcard'] = &$this->catcard;

        // register_pin
        $this->register_pin = new DbField('computer_access_requests', 'computer_access_requests', 'x_register_pin', 'register_pin', '`register_pin`', '`register_pin`', 200, 20, -1, false, '`register_pin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->register_pin->Sortable = true; // Allow sort
        $this->register_pin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->register_pin->Param, "CustomMsg");
        $this->Fields['register_pin'] = &$this->register_pin;

        // other
        $this->other = new DbField('computer_access_requests', 'computer_access_requests', 'x_other', 'other', '`other`', '`other`', 200, 250, -1, false, '`other`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->other->Sortable = true; // Allow sort
        $this->other->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->other->Param, "CustomMsg");
        $this->Fields['other'] = &$this->other;

        // timestamp
        $this->timestamp = new DbField('computer_access_requests', 'computer_access_requests', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timestamp->Sortable = true; // Allow sort
        $this->timestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->timestamp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->timestamp->Param, "CustomMsg");
        $this->Fields['timestamp'] = &$this->timestamp;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`computer_access_requests`";
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
        $this->supervisor_name->DbValue = $row['supervisor_name'];
        $this->supervisor_phone->DbValue = $row['supervisor_phone'];
        $this->employee_type->DbValue = $row['employee_type'];
        $this->employee_position->DbValue = $row['employee_position'];
        $this->employee_first_name->DbValue = $row['employee_first_name'];
        $this->employee_last_name->DbValue = $row['employee_last_name'];
        $this->employee_title->DbValue = $row['employee_title'];
        $this->employee_email->DbValue = $row['employee_email'];
        $this->employee_phone->DbValue = $row['employee_phone'];
        $this->employee_unit->DbValue = $row['employee_unit'];
        $this->employee_netid->DbValue = $row['employee_netid'];
        $this->employee_id->DbValue = $row['employee_id'];
        $this->location->DbValue = $row['location'];
        $this->access->DbValue = $row['access'];
        $this->foodpro_location->DbValue = $row['foodpro_location'];
        $this->catcard->DbValue = $row['catcard'];
        $this->register_pin->DbValue = $row['register_pin'];
        $this->other->DbValue = $row['other'];
        $this->timestamp->DbValue = $row['timestamp'];
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
        return $_SESSION[$name] ?? GetUrl("ComputerAccessRequestsList");
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
        if ($pageName == "ComputerAccessRequestsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ComputerAccessRequestsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ComputerAccessRequestsAdd") {
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
                return "ComputerAccessRequestsView";
            case Config("API_ADD_ACTION"):
                return "ComputerAccessRequestsAdd";
            case Config("API_EDIT_ACTION"):
                return "ComputerAccessRequestsEdit";
            case Config("API_DELETE_ACTION"):
                return "ComputerAccessRequestsDelete";
            case Config("API_LIST_ACTION"):
                return "ComputerAccessRequestsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ComputerAccessRequestsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ComputerAccessRequestsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ComputerAccessRequestsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ComputerAccessRequestsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ComputerAccessRequestsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ComputerAccessRequestsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ComputerAccessRequestsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ComputerAccessRequestsDelete", $this->getUrlParm());
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
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_type->setDbValue($row['employee_type']);
        $this->employee_position->setDbValue($row['employee_position']);
        $this->employee_first_name->setDbValue($row['employee_first_name']);
        $this->employee_last_name->setDbValue($row['employee_last_name']);
        $this->employee_title->setDbValue($row['employee_title']);
        $this->employee_email->setDbValue($row['employee_email']);
        $this->employee_phone->setDbValue($row['employee_phone']);
        $this->employee_unit->setDbValue($row['employee_unit']);
        $this->employee_netid->setDbValue($row['employee_netid']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->location->setDbValue($row['location']);
        $this->access->setDbValue($row['access']);
        $this->foodpro_location->setDbValue($row['foodpro_location']);
        $this->catcard->setDbValue($row['catcard']);
        $this->register_pin->setDbValue($row['register_pin']);
        $this->other->setDbValue($row['other']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // supervisor_name

        // supervisor_phone

        // employee_type

        // employee_position

        // employee_first_name

        // employee_last_name

        // employee_title

        // employee_email

        // employee_phone

        // employee_unit

        // employee_netid

        // employee_id

        // location

        // access

        // foodpro_location

        // catcard

        // register_pin

        // other

        // timestamp

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // supervisor_name
        $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_name->ViewCustomAttributes = "";

        // supervisor_phone
        $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
        $this->supervisor_phone->ViewCustomAttributes = "";

        // employee_type
        $this->employee_type->ViewValue = $this->employee_type->CurrentValue;
        $this->employee_type->ViewCustomAttributes = "";

        // employee_position
        $this->employee_position->ViewValue = $this->employee_position->CurrentValue;
        $this->employee_position->ViewCustomAttributes = "";

        // employee_first_name
        $this->employee_first_name->ViewValue = $this->employee_first_name->CurrentValue;
        $this->employee_first_name->ViewCustomAttributes = "";

        // employee_last_name
        $this->employee_last_name->ViewValue = $this->employee_last_name->CurrentValue;
        $this->employee_last_name->ViewCustomAttributes = "";

        // employee_title
        $this->employee_title->ViewValue = $this->employee_title->CurrentValue;
        $this->employee_title->ViewCustomAttributes = "";

        // employee_email
        $this->employee_email->ViewValue = $this->employee_email->CurrentValue;
        $this->employee_email->ViewCustomAttributes = "";

        // employee_phone
        $this->employee_phone->ViewValue = $this->employee_phone->CurrentValue;
        $this->employee_phone->ViewCustomAttributes = "";

        // employee_unit
        $this->employee_unit->ViewValue = $this->employee_unit->CurrentValue;
        $this->employee_unit->ViewCustomAttributes = "";

        // employee_netid
        $this->employee_netid->ViewValue = $this->employee_netid->CurrentValue;
        $this->employee_netid->ViewCustomAttributes = "";

        // employee_id
        $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
        $this->employee_id->ViewCustomAttributes = "";

        // location
        $this->location->ViewValue = $this->location->CurrentValue;
        $this->location->ViewCustomAttributes = "";

        // access
        $this->access->ViewValue = $this->access->CurrentValue;
        $this->access->ViewValue = FormatNumber($this->access->ViewValue, 0, -2, -2, -2);
        $this->access->ViewCustomAttributes = "";

        // foodpro_location
        $this->foodpro_location->ViewValue = $this->foodpro_location->CurrentValue;
        $this->foodpro_location->ViewCustomAttributes = "";

        // catcard
        $this->catcard->ViewValue = $this->catcard->CurrentValue;
        $this->catcard->ViewCustomAttributes = "";

        // register_pin
        $this->register_pin->ViewValue = $this->register_pin->CurrentValue;
        $this->register_pin->ViewCustomAttributes = "";

        // other
        $this->other->ViewValue = $this->other->CurrentValue;
        $this->other->ViewCustomAttributes = "";

        // timestamp
        $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
        $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
        $this->timestamp->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // supervisor_name
        $this->supervisor_name->LinkCustomAttributes = "";
        $this->supervisor_name->HrefValue = "";
        $this->supervisor_name->TooltipValue = "";

        // supervisor_phone
        $this->supervisor_phone->LinkCustomAttributes = "";
        $this->supervisor_phone->HrefValue = "";
        $this->supervisor_phone->TooltipValue = "";

        // employee_type
        $this->employee_type->LinkCustomAttributes = "";
        $this->employee_type->HrefValue = "";
        $this->employee_type->TooltipValue = "";

        // employee_position
        $this->employee_position->LinkCustomAttributes = "";
        $this->employee_position->HrefValue = "";
        $this->employee_position->TooltipValue = "";

        // employee_first_name
        $this->employee_first_name->LinkCustomAttributes = "";
        $this->employee_first_name->HrefValue = "";
        $this->employee_first_name->TooltipValue = "";

        // employee_last_name
        $this->employee_last_name->LinkCustomAttributes = "";
        $this->employee_last_name->HrefValue = "";
        $this->employee_last_name->TooltipValue = "";

        // employee_title
        $this->employee_title->LinkCustomAttributes = "";
        $this->employee_title->HrefValue = "";
        $this->employee_title->TooltipValue = "";

        // employee_email
        $this->employee_email->LinkCustomAttributes = "";
        $this->employee_email->HrefValue = "";
        $this->employee_email->TooltipValue = "";

        // employee_phone
        $this->employee_phone->LinkCustomAttributes = "";
        $this->employee_phone->HrefValue = "";
        $this->employee_phone->TooltipValue = "";

        // employee_unit
        $this->employee_unit->LinkCustomAttributes = "";
        $this->employee_unit->HrefValue = "";
        $this->employee_unit->TooltipValue = "";

        // employee_netid
        $this->employee_netid->LinkCustomAttributes = "";
        $this->employee_netid->HrefValue = "";
        $this->employee_netid->TooltipValue = "";

        // employee_id
        $this->employee_id->LinkCustomAttributes = "";
        $this->employee_id->HrefValue = "";
        $this->employee_id->TooltipValue = "";

        // location
        $this->location->LinkCustomAttributes = "";
        $this->location->HrefValue = "";
        $this->location->TooltipValue = "";

        // access
        $this->access->LinkCustomAttributes = "";
        $this->access->HrefValue = "";
        $this->access->TooltipValue = "";

        // foodpro_location
        $this->foodpro_location->LinkCustomAttributes = "";
        $this->foodpro_location->HrefValue = "";
        $this->foodpro_location->TooltipValue = "";

        // catcard
        $this->catcard->LinkCustomAttributes = "";
        $this->catcard->HrefValue = "";
        $this->catcard->TooltipValue = "";

        // register_pin
        $this->register_pin->LinkCustomAttributes = "";
        $this->register_pin->HrefValue = "";
        $this->register_pin->TooltipValue = "";

        // other
        $this->other->LinkCustomAttributes = "";
        $this->other->HrefValue = "";
        $this->other->TooltipValue = "";

        // timestamp
        $this->timestamp->LinkCustomAttributes = "";
        $this->timestamp->HrefValue = "";
        $this->timestamp->TooltipValue = "";

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

        // supervisor_name
        $this->supervisor_name->EditAttrs["class"] = "form-control";
        $this->supervisor_name->EditCustomAttributes = "";
        if (!$this->supervisor_name->Raw) {
            $this->supervisor_name->CurrentValue = HtmlDecode($this->supervisor_name->CurrentValue);
        }
        $this->supervisor_name->EditValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_name->PlaceHolder = RemoveHtml($this->supervisor_name->caption());

        // supervisor_phone
        $this->supervisor_phone->EditAttrs["class"] = "form-control";
        $this->supervisor_phone->EditCustomAttributes = "";
        if (!$this->supervisor_phone->Raw) {
            $this->supervisor_phone->CurrentValue = HtmlDecode($this->supervisor_phone->CurrentValue);
        }
        $this->supervisor_phone->EditValue = $this->supervisor_phone->CurrentValue;
        $this->supervisor_phone->PlaceHolder = RemoveHtml($this->supervisor_phone->caption());

        // employee_type
        $this->employee_type->EditAttrs["class"] = "form-control";
        $this->employee_type->EditCustomAttributes = "";
        if (!$this->employee_type->Raw) {
            $this->employee_type->CurrentValue = HtmlDecode($this->employee_type->CurrentValue);
        }
        $this->employee_type->EditValue = $this->employee_type->CurrentValue;
        $this->employee_type->PlaceHolder = RemoveHtml($this->employee_type->caption());

        // employee_position
        $this->employee_position->EditAttrs["class"] = "form-control";
        $this->employee_position->EditCustomAttributes = "";
        if (!$this->employee_position->Raw) {
            $this->employee_position->CurrentValue = HtmlDecode($this->employee_position->CurrentValue);
        }
        $this->employee_position->EditValue = $this->employee_position->CurrentValue;
        $this->employee_position->PlaceHolder = RemoveHtml($this->employee_position->caption());

        // employee_first_name
        $this->employee_first_name->EditAttrs["class"] = "form-control";
        $this->employee_first_name->EditCustomAttributes = "";
        if (!$this->employee_first_name->Raw) {
            $this->employee_first_name->CurrentValue = HtmlDecode($this->employee_first_name->CurrentValue);
        }
        $this->employee_first_name->EditValue = $this->employee_first_name->CurrentValue;
        $this->employee_first_name->PlaceHolder = RemoveHtml($this->employee_first_name->caption());

        // employee_last_name
        $this->employee_last_name->EditAttrs["class"] = "form-control";
        $this->employee_last_name->EditCustomAttributes = "";
        if (!$this->employee_last_name->Raw) {
            $this->employee_last_name->CurrentValue = HtmlDecode($this->employee_last_name->CurrentValue);
        }
        $this->employee_last_name->EditValue = $this->employee_last_name->CurrentValue;
        $this->employee_last_name->PlaceHolder = RemoveHtml($this->employee_last_name->caption());

        // employee_title
        $this->employee_title->EditAttrs["class"] = "form-control";
        $this->employee_title->EditCustomAttributes = "";
        if (!$this->employee_title->Raw) {
            $this->employee_title->CurrentValue = HtmlDecode($this->employee_title->CurrentValue);
        }
        $this->employee_title->EditValue = $this->employee_title->CurrentValue;
        $this->employee_title->PlaceHolder = RemoveHtml($this->employee_title->caption());

        // employee_email
        $this->employee_email->EditAttrs["class"] = "form-control";
        $this->employee_email->EditCustomAttributes = "";
        if (!$this->employee_email->Raw) {
            $this->employee_email->CurrentValue = HtmlDecode($this->employee_email->CurrentValue);
        }
        $this->employee_email->EditValue = $this->employee_email->CurrentValue;
        $this->employee_email->PlaceHolder = RemoveHtml($this->employee_email->caption());

        // employee_phone
        $this->employee_phone->EditAttrs["class"] = "form-control";
        $this->employee_phone->EditCustomAttributes = "";
        if (!$this->employee_phone->Raw) {
            $this->employee_phone->CurrentValue = HtmlDecode($this->employee_phone->CurrentValue);
        }
        $this->employee_phone->EditValue = $this->employee_phone->CurrentValue;
        $this->employee_phone->PlaceHolder = RemoveHtml($this->employee_phone->caption());

        // employee_unit
        $this->employee_unit->EditAttrs["class"] = "form-control";
        $this->employee_unit->EditCustomAttributes = "";
        if (!$this->employee_unit->Raw) {
            $this->employee_unit->CurrentValue = HtmlDecode($this->employee_unit->CurrentValue);
        }
        $this->employee_unit->EditValue = $this->employee_unit->CurrentValue;
        $this->employee_unit->PlaceHolder = RemoveHtml($this->employee_unit->caption());

        // employee_netid
        $this->employee_netid->EditAttrs["class"] = "form-control";
        $this->employee_netid->EditCustomAttributes = "";
        if (!$this->employee_netid->Raw) {
            $this->employee_netid->CurrentValue = HtmlDecode($this->employee_netid->CurrentValue);
        }
        $this->employee_netid->EditValue = $this->employee_netid->CurrentValue;
        $this->employee_netid->PlaceHolder = RemoveHtml($this->employee_netid->caption());

        // employee_id
        $this->employee_id->EditAttrs["class"] = "form-control";
        $this->employee_id->EditCustomAttributes = "";
        if (!$this->employee_id->Raw) {
            $this->employee_id->CurrentValue = HtmlDecode($this->employee_id->CurrentValue);
        }
        $this->employee_id->EditValue = $this->employee_id->CurrentValue;
        $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());

        // location
        $this->location->EditAttrs["class"] = "form-control";
        $this->location->EditCustomAttributes = "";
        if (!$this->location->Raw) {
            $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
        }
        $this->location->EditValue = $this->location->CurrentValue;
        $this->location->PlaceHolder = RemoveHtml($this->location->caption());

        // access
        $this->access->EditAttrs["class"] = "form-control";
        $this->access->EditCustomAttributes = "";
        $this->access->EditValue = $this->access->CurrentValue;
        $this->access->PlaceHolder = RemoveHtml($this->access->caption());

        // foodpro_location
        $this->foodpro_location->EditAttrs["class"] = "form-control";
        $this->foodpro_location->EditCustomAttributes = "";
        if (!$this->foodpro_location->Raw) {
            $this->foodpro_location->CurrentValue = HtmlDecode($this->foodpro_location->CurrentValue);
        }
        $this->foodpro_location->EditValue = $this->foodpro_location->CurrentValue;
        $this->foodpro_location->PlaceHolder = RemoveHtml($this->foodpro_location->caption());

        // catcard
        $this->catcard->EditAttrs["class"] = "form-control";
        $this->catcard->EditCustomAttributes = "";
        if (!$this->catcard->Raw) {
            $this->catcard->CurrentValue = HtmlDecode($this->catcard->CurrentValue);
        }
        $this->catcard->EditValue = $this->catcard->CurrentValue;
        $this->catcard->PlaceHolder = RemoveHtml($this->catcard->caption());

        // register_pin
        $this->register_pin->EditAttrs["class"] = "form-control";
        $this->register_pin->EditCustomAttributes = "";
        if (!$this->register_pin->Raw) {
            $this->register_pin->CurrentValue = HtmlDecode($this->register_pin->CurrentValue);
        }
        $this->register_pin->EditValue = $this->register_pin->CurrentValue;
        $this->register_pin->PlaceHolder = RemoveHtml($this->register_pin->caption());

        // other
        $this->other->EditAttrs["class"] = "form-control";
        $this->other->EditCustomAttributes = "";
        if (!$this->other->Raw) {
            $this->other->CurrentValue = HtmlDecode($this->other->CurrentValue);
        }
        $this->other->EditValue = $this->other->CurrentValue;
        $this->other->PlaceHolder = RemoveHtml($this->other->caption());

        // timestamp
        $this->timestamp->EditAttrs["class"] = "form-control";
        $this->timestamp->EditCustomAttributes = "";
        $this->timestamp->EditValue = FormatDateTime($this->timestamp->CurrentValue, 8);
        $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

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
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->employee_type);
                    $doc->exportCaption($this->employee_position);
                    $doc->exportCaption($this->employee_first_name);
                    $doc->exportCaption($this->employee_last_name);
                    $doc->exportCaption($this->employee_title);
                    $doc->exportCaption($this->employee_email);
                    $doc->exportCaption($this->employee_phone);
                    $doc->exportCaption($this->employee_unit);
                    $doc->exportCaption($this->employee_netid);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->access);
                    $doc->exportCaption($this->foodpro_location);
                    $doc->exportCaption($this->catcard);
                    $doc->exportCaption($this->register_pin);
                    $doc->exportCaption($this->other);
                    $doc->exportCaption($this->timestamp);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->employee_type);
                    $doc->exportCaption($this->employee_position);
                    $doc->exportCaption($this->employee_first_name);
                    $doc->exportCaption($this->employee_last_name);
                    $doc->exportCaption($this->employee_title);
                    $doc->exportCaption($this->employee_email);
                    $doc->exportCaption($this->employee_phone);
                    $doc->exportCaption($this->employee_unit);
                    $doc->exportCaption($this->employee_netid);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->access);
                    $doc->exportCaption($this->foodpro_location);
                    $doc->exportCaption($this->catcard);
                    $doc->exportCaption($this->register_pin);
                    $doc->exportCaption($this->other);
                    $doc->exportCaption($this->timestamp);
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
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->employee_type);
                        $doc->exportField($this->employee_position);
                        $doc->exportField($this->employee_first_name);
                        $doc->exportField($this->employee_last_name);
                        $doc->exportField($this->employee_title);
                        $doc->exportField($this->employee_email);
                        $doc->exportField($this->employee_phone);
                        $doc->exportField($this->employee_unit);
                        $doc->exportField($this->employee_netid);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->location);
                        $doc->exportField($this->access);
                        $doc->exportField($this->foodpro_location);
                        $doc->exportField($this->catcard);
                        $doc->exportField($this->register_pin);
                        $doc->exportField($this->other);
                        $doc->exportField($this->timestamp);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->employee_type);
                        $doc->exportField($this->employee_position);
                        $doc->exportField($this->employee_first_name);
                        $doc->exportField($this->employee_last_name);
                        $doc->exportField($this->employee_title);
                        $doc->exportField($this->employee_email);
                        $doc->exportField($this->employee_phone);
                        $doc->exportField($this->employee_unit);
                        $doc->exportField($this->employee_netid);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->location);
                        $doc->exportField($this->access);
                        $doc->exportField($this->foodpro_location);
                        $doc->exportField($this->catcard);
                        $doc->exportField($this->register_pin);
                        $doc->exportField($this->other);
                        $doc->exportField($this->timestamp);
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
