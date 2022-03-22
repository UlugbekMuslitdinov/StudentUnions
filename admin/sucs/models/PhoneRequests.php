<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for phone_requests
 */
class PhoneRequests extends DbTable
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
    public $supervisor_name;
    public $supervisor_phone;
    public $employee_status;
    public $building;
    public $room_number;
    public $net_id;
    public $jack;
    public $jack_id;
    public $voicemail;
    public $long_distance;
    public $need_phone;
    public $call_appearance;
    public $kfs_number;
    public $call_appearance1;
    public $call_appearance2;
    public $call_appearance3;
    public $call_appearance4;
    public $timestamp;
    public $ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'phone_requests';
        $this->TableName = 'phone_requests';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`phone_requests`";
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

        // supervisor_name
        $this->supervisor_name = new DbField('phone_requests', 'phone_requests', 'x_supervisor_name', 'supervisor_name', '`supervisor_name`', '`supervisor_name`', 200, 50, -1, false, '`supervisor_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_name->Nullable = false; // NOT NULL field
        $this->supervisor_name->Required = true; // Required field
        $this->supervisor_name->Sortable = true; // Allow sort
        $this->supervisor_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_name->Param, "CustomMsg");
        $this->Fields['supervisor_name'] = &$this->supervisor_name;

        // supervisor_phone
        $this->supervisor_phone = new DbField('phone_requests', 'phone_requests', 'x_supervisor_phone', 'supervisor_phone', '`supervisor_phone`', '`supervisor_phone`', 200, 20, -1, false, '`supervisor_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_phone->Nullable = false; // NOT NULL field
        $this->supervisor_phone->Required = true; // Required field
        $this->supervisor_phone->Sortable = true; // Allow sort
        $this->supervisor_phone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_phone->Param, "CustomMsg");
        $this->Fields['supervisor_phone'] = &$this->supervisor_phone;

        // employee_status
        $this->employee_status = new DbField('phone_requests', 'phone_requests', 'x_employee_status', 'employee_status', '`employee_status`', '`employee_status`', 200, 20, -1, false, '`employee_status`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_status->Nullable = false; // NOT NULL field
        $this->employee_status->Required = true; // Required field
        $this->employee_status->Sortable = true; // Allow sort
        $this->employee_status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_status->Param, "CustomMsg");
        $this->Fields['employee_status'] = &$this->employee_status;

        // building
        $this->building = new DbField('phone_requests', 'phone_requests', 'x_building', 'building', '`building`', '`building`', 200, 100, -1, false, '`building`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->building->Nullable = false; // NOT NULL field
        $this->building->Required = true; // Required field
        $this->building->Sortable = true; // Allow sort
        $this->building->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->building->Param, "CustomMsg");
        $this->Fields['building'] = &$this->building;

        // room_number
        $this->room_number = new DbField('phone_requests', 'phone_requests', 'x_room_number', 'room_number', '`room_number`', '`room_number`', 200, 46, -1, false, '`room_number`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->room_number->Nullable = false; // NOT NULL field
        $this->room_number->Required = true; // Required field
        $this->room_number->Sortable = true; // Allow sort
        $this->room_number->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->room_number->Param, "CustomMsg");
        $this->Fields['room_number'] = &$this->room_number;

        // net_id
        $this->net_id = new DbField('phone_requests', 'phone_requests', 'x_net_id', 'net_id', '`net_id`', '`net_id`', 200, 50, -1, false, '`net_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->net_id->Nullable = false; // NOT NULL field
        $this->net_id->Required = true; // Required field
        $this->net_id->Sortable = true; // Allow sort
        $this->net_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->net_id->Param, "CustomMsg");
        $this->Fields['net_id'] = &$this->net_id;

        // jack
        $this->jack = new DbField('phone_requests', 'phone_requests', 'x_jack', 'jack', '`jack`', '`jack`', 200, 3, -1, false, '`jack`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jack->Nullable = false; // NOT NULL field
        $this->jack->Required = true; // Required field
        $this->jack->Sortable = true; // Allow sort
        $this->jack->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jack->Param, "CustomMsg");
        $this->Fields['jack'] = &$this->jack;

        // jack_id
        $this->jack_id = new DbField('phone_requests', 'phone_requests', 'x_jack_id', 'jack_id', '`jack_id`', '`jack_id`', 200, 46, -1, false, '`jack_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jack_id->Nullable = false; // NOT NULL field
        $this->jack_id->Required = true; // Required field
        $this->jack_id->Sortable = true; // Allow sort
        $this->jack_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jack_id->Param, "CustomMsg");
        $this->Fields['jack_id'] = &$this->jack_id;

        // voicemail
        $this->voicemail = new DbField('phone_requests', 'phone_requests', 'x_voicemail', 'voicemail', '`voicemail`', '`voicemail`', 200, 3, -1, false, '`voicemail`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->voicemail->Nullable = false; // NOT NULL field
        $this->voicemail->Required = true; // Required field
        $this->voicemail->Sortable = true; // Allow sort
        $this->voicemail->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->voicemail->Param, "CustomMsg");
        $this->Fields['voicemail'] = &$this->voicemail;

        // long_distance
        $this->long_distance = new DbField('phone_requests', 'phone_requests', 'x_long_distance', 'long_distance', '`long_distance`', '`long_distance`', 200, 3, -1, false, '`long_distance`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->long_distance->Nullable = false; // NOT NULL field
        $this->long_distance->Required = true; // Required field
        $this->long_distance->Sortable = true; // Allow sort
        $this->long_distance->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->long_distance->Param, "CustomMsg");
        $this->Fields['long_distance'] = &$this->long_distance;

        // need_phone
        $this->need_phone = new DbField('phone_requests', 'phone_requests', 'x_need_phone', 'need_phone', '`need_phone`', '`need_phone`', 200, 3, -1, false, '`need_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->need_phone->Nullable = false; // NOT NULL field
        $this->need_phone->Required = true; // Required field
        $this->need_phone->Sortable = true; // Allow sort
        $this->need_phone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->need_phone->Param, "CustomMsg");
        $this->Fields['need_phone'] = &$this->need_phone;

        // call_appearance
        $this->call_appearance = new DbField('phone_requests', 'phone_requests', 'x_call_appearance', 'call_appearance', '`call_appearance`', '`call_appearance`', 200, 3, -1, false, '`call_appearance`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->call_appearance->Nullable = false; // NOT NULL field
        $this->call_appearance->Required = true; // Required field
        $this->call_appearance->Sortable = true; // Allow sort
        $this->call_appearance->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->call_appearance->Param, "CustomMsg");
        $this->Fields['call_appearance'] = &$this->call_appearance;

        // kfs_number
        $this->kfs_number = new DbField('phone_requests', 'phone_requests', 'x_kfs_number', 'kfs_number', '`kfs_number`', '`kfs_number`', 200, 50, -1, false, '`kfs_number`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kfs_number->Nullable = false; // NOT NULL field
        $this->kfs_number->Required = true; // Required field
        $this->kfs_number->Sortable = true; // Allow sort
        $this->kfs_number->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kfs_number->Param, "CustomMsg");
        $this->Fields['kfs_number'] = &$this->kfs_number;

        // call_appearance1
        $this->call_appearance1 = new DbField('phone_requests', 'phone_requests', 'x_call_appearance1', 'call_appearance1', '`call_appearance1`', '`call_appearance1`', 200, 46, -1, false, '`call_appearance1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->call_appearance1->Nullable = false; // NOT NULL field
        $this->call_appearance1->Required = true; // Required field
        $this->call_appearance1->Sortable = true; // Allow sort
        $this->call_appearance1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->call_appearance1->Param, "CustomMsg");
        $this->Fields['call_appearance1'] = &$this->call_appearance1;

        // call_appearance2
        $this->call_appearance2 = new DbField('phone_requests', 'phone_requests', 'x_call_appearance2', 'call_appearance2', '`call_appearance2`', '`call_appearance2`', 200, 46, -1, false, '`call_appearance2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->call_appearance2->Nullable = false; // NOT NULL field
        $this->call_appearance2->Required = true; // Required field
        $this->call_appearance2->Sortable = true; // Allow sort
        $this->call_appearance2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->call_appearance2->Param, "CustomMsg");
        $this->Fields['call_appearance2'] = &$this->call_appearance2;

        // call_appearance3
        $this->call_appearance3 = new DbField('phone_requests', 'phone_requests', 'x_call_appearance3', 'call_appearance3', '`call_appearance3`', '`call_appearance3`', 200, 46, -1, false, '`call_appearance3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->call_appearance3->Nullable = false; // NOT NULL field
        $this->call_appearance3->Required = true; // Required field
        $this->call_appearance3->Sortable = true; // Allow sort
        $this->call_appearance3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->call_appearance3->Param, "CustomMsg");
        $this->Fields['call_appearance3'] = &$this->call_appearance3;

        // call_appearance4
        $this->call_appearance4 = new DbField('phone_requests', 'phone_requests', 'x_call_appearance4', 'call_appearance4', '`call_appearance4`', '`call_appearance4`', 200, 46, -1, false, '`call_appearance4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->call_appearance4->Nullable = false; // NOT NULL field
        $this->call_appearance4->Required = true; // Required field
        $this->call_appearance4->Sortable = true; // Allow sort
        $this->call_appearance4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->call_appearance4->Param, "CustomMsg");
        $this->Fields['call_appearance4'] = &$this->call_appearance4;

        // timestamp
        $this->timestamp = new DbField('phone_requests', 'phone_requests', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timestamp->Nullable = false; // NOT NULL field
        $this->timestamp->Required = true; // Required field
        $this->timestamp->Sortable = true; // Allow sort
        $this->timestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->timestamp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->timestamp->Param, "CustomMsg");
        $this->Fields['timestamp'] = &$this->timestamp;

        // ID
        $this->ID = new DbField('phone_requests', 'phone_requests', 'x_ID', 'ID', '`ID`', '`ID`', 3, 11, -1, false, '`ID`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Sortable = true; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`phone_requests`";
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
        $this->supervisor_name->DbValue = $row['supervisor_name'];
        $this->supervisor_phone->DbValue = $row['supervisor_phone'];
        $this->employee_status->DbValue = $row['employee_status'];
        $this->building->DbValue = $row['building'];
        $this->room_number->DbValue = $row['room_number'];
        $this->net_id->DbValue = $row['net_id'];
        $this->jack->DbValue = $row['jack'];
        $this->jack_id->DbValue = $row['jack_id'];
        $this->voicemail->DbValue = $row['voicemail'];
        $this->long_distance->DbValue = $row['long_distance'];
        $this->need_phone->DbValue = $row['need_phone'];
        $this->call_appearance->DbValue = $row['call_appearance'];
        $this->kfs_number->DbValue = $row['kfs_number'];
        $this->call_appearance1->DbValue = $row['call_appearance1'];
        $this->call_appearance2->DbValue = $row['call_appearance2'];
        $this->call_appearance3->DbValue = $row['call_appearance3'];
        $this->call_appearance4->DbValue = $row['call_appearance4'];
        $this->timestamp->DbValue = $row['timestamp'];
        $this->ID->DbValue = $row['ID'];
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
        return $_SESSION[$name] ?? GetUrl("PhoneRequestsList");
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
        if ($pageName == "PhoneRequestsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PhoneRequestsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PhoneRequestsAdd") {
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
                return "PhoneRequestsView";
            case Config("API_ADD_ACTION"):
                return "PhoneRequestsAdd";
            case Config("API_EDIT_ACTION"):
                return "PhoneRequestsEdit";
            case Config("API_DELETE_ACTION"):
                return "PhoneRequestsDelete";
            case Config("API_LIST_ACTION"):
                return "PhoneRequestsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PhoneRequestsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PhoneRequestsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PhoneRequestsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PhoneRequestsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PhoneRequestsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PhoneRequestsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PhoneRequestsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PhoneRequestsDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
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
            $url .= "/" . rawurlencode($this->ID->CurrentValue);
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
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_status->setDbValue($row['employee_status']);
        $this->building->setDbValue($row['building']);
        $this->room_number->setDbValue($row['room_number']);
        $this->net_id->setDbValue($row['net_id']);
        $this->jack->setDbValue($row['jack']);
        $this->jack_id->setDbValue($row['jack_id']);
        $this->voicemail->setDbValue($row['voicemail']);
        $this->long_distance->setDbValue($row['long_distance']);
        $this->need_phone->setDbValue($row['need_phone']);
        $this->call_appearance->setDbValue($row['call_appearance']);
        $this->kfs_number->setDbValue($row['kfs_number']);
        $this->call_appearance1->setDbValue($row['call_appearance1']);
        $this->call_appearance2->setDbValue($row['call_appearance2']);
        $this->call_appearance3->setDbValue($row['call_appearance3']);
        $this->call_appearance4->setDbValue($row['call_appearance4']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->ID->setDbValue($row['ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // supervisor_name

        // supervisor_phone

        // employee_status

        // building

        // room_number

        // net_id

        // jack

        // jack_id

        // voicemail

        // long_distance

        // need_phone

        // call_appearance

        // kfs_number

        // call_appearance1

        // call_appearance2

        // call_appearance3

        // call_appearance4

        // timestamp

        // ID

        // supervisor_name
        $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_name->ViewCustomAttributes = "";

        // supervisor_phone
        $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
        $this->supervisor_phone->ViewCustomAttributes = "";

        // employee_status
        $this->employee_status->ViewValue = $this->employee_status->CurrentValue;
        $this->employee_status->ViewCustomAttributes = "";

        // building
        $this->building->ViewValue = $this->building->CurrentValue;
        $this->building->ViewCustomAttributes = "";

        // room_number
        $this->room_number->ViewValue = $this->room_number->CurrentValue;
        $this->room_number->ViewCustomAttributes = "";

        // net_id
        $this->net_id->ViewValue = $this->net_id->CurrentValue;
        $this->net_id->ViewCustomAttributes = "";

        // jack
        $this->jack->ViewValue = $this->jack->CurrentValue;
        $this->jack->ViewCustomAttributes = "";

        // jack_id
        $this->jack_id->ViewValue = $this->jack_id->CurrentValue;
        $this->jack_id->ViewCustomAttributes = "";

        // voicemail
        $this->voicemail->ViewValue = $this->voicemail->CurrentValue;
        $this->voicemail->ViewCustomAttributes = "";

        // long_distance
        $this->long_distance->ViewValue = $this->long_distance->CurrentValue;
        $this->long_distance->ViewCustomAttributes = "";

        // need_phone
        $this->need_phone->ViewValue = $this->need_phone->CurrentValue;
        $this->need_phone->ViewCustomAttributes = "";

        // call_appearance
        $this->call_appearance->ViewValue = $this->call_appearance->CurrentValue;
        $this->call_appearance->ViewCustomAttributes = "";

        // kfs_number
        $this->kfs_number->ViewValue = $this->kfs_number->CurrentValue;
        $this->kfs_number->ViewCustomAttributes = "";

        // call_appearance1
        $this->call_appearance1->ViewValue = $this->call_appearance1->CurrentValue;
        $this->call_appearance1->ViewCustomAttributes = "";

        // call_appearance2
        $this->call_appearance2->ViewValue = $this->call_appearance2->CurrentValue;
        $this->call_appearance2->ViewCustomAttributes = "";

        // call_appearance3
        $this->call_appearance3->ViewValue = $this->call_appearance3->CurrentValue;
        $this->call_appearance3->ViewCustomAttributes = "";

        // call_appearance4
        $this->call_appearance4->ViewValue = $this->call_appearance4->CurrentValue;
        $this->call_appearance4->ViewCustomAttributes = "";

        // timestamp
        $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
        $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
        $this->timestamp->ViewCustomAttributes = "";

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // supervisor_name
        $this->supervisor_name->LinkCustomAttributes = "";
        $this->supervisor_name->HrefValue = "";
        $this->supervisor_name->TooltipValue = "";

        // supervisor_phone
        $this->supervisor_phone->LinkCustomAttributes = "";
        $this->supervisor_phone->HrefValue = "";
        $this->supervisor_phone->TooltipValue = "";

        // employee_status
        $this->employee_status->LinkCustomAttributes = "";
        $this->employee_status->HrefValue = "";
        $this->employee_status->TooltipValue = "";

        // building
        $this->building->LinkCustomAttributes = "";
        $this->building->HrefValue = "";
        $this->building->TooltipValue = "";

        // room_number
        $this->room_number->LinkCustomAttributes = "";
        $this->room_number->HrefValue = "";
        $this->room_number->TooltipValue = "";

        // net_id
        $this->net_id->LinkCustomAttributes = "";
        $this->net_id->HrefValue = "";
        $this->net_id->TooltipValue = "";

        // jack
        $this->jack->LinkCustomAttributes = "";
        $this->jack->HrefValue = "";
        $this->jack->TooltipValue = "";

        // jack_id
        $this->jack_id->LinkCustomAttributes = "";
        $this->jack_id->HrefValue = "";
        $this->jack_id->TooltipValue = "";

        // voicemail
        $this->voicemail->LinkCustomAttributes = "";
        $this->voicemail->HrefValue = "";
        $this->voicemail->TooltipValue = "";

        // long_distance
        $this->long_distance->LinkCustomAttributes = "";
        $this->long_distance->HrefValue = "";
        $this->long_distance->TooltipValue = "";

        // need_phone
        $this->need_phone->LinkCustomAttributes = "";
        $this->need_phone->HrefValue = "";
        $this->need_phone->TooltipValue = "";

        // call_appearance
        $this->call_appearance->LinkCustomAttributes = "";
        $this->call_appearance->HrefValue = "";
        $this->call_appearance->TooltipValue = "";

        // kfs_number
        $this->kfs_number->LinkCustomAttributes = "";
        $this->kfs_number->HrefValue = "";
        $this->kfs_number->TooltipValue = "";

        // call_appearance1
        $this->call_appearance1->LinkCustomAttributes = "";
        $this->call_appearance1->HrefValue = "";
        $this->call_appearance1->TooltipValue = "";

        // call_appearance2
        $this->call_appearance2->LinkCustomAttributes = "";
        $this->call_appearance2->HrefValue = "";
        $this->call_appearance2->TooltipValue = "";

        // call_appearance3
        $this->call_appearance3->LinkCustomAttributes = "";
        $this->call_appearance3->HrefValue = "";
        $this->call_appearance3->TooltipValue = "";

        // call_appearance4
        $this->call_appearance4->LinkCustomAttributes = "";
        $this->call_appearance4->HrefValue = "";
        $this->call_appearance4->TooltipValue = "";

        // timestamp
        $this->timestamp->LinkCustomAttributes = "";
        $this->timestamp->HrefValue = "";
        $this->timestamp->TooltipValue = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

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

        // employee_status
        $this->employee_status->EditAttrs["class"] = "form-control";
        $this->employee_status->EditCustomAttributes = "";
        if (!$this->employee_status->Raw) {
            $this->employee_status->CurrentValue = HtmlDecode($this->employee_status->CurrentValue);
        }
        $this->employee_status->EditValue = $this->employee_status->CurrentValue;
        $this->employee_status->PlaceHolder = RemoveHtml($this->employee_status->caption());

        // building
        $this->building->EditAttrs["class"] = "form-control";
        $this->building->EditCustomAttributes = "";
        if (!$this->building->Raw) {
            $this->building->CurrentValue = HtmlDecode($this->building->CurrentValue);
        }
        $this->building->EditValue = $this->building->CurrentValue;
        $this->building->PlaceHolder = RemoveHtml($this->building->caption());

        // room_number
        $this->room_number->EditAttrs["class"] = "form-control";
        $this->room_number->EditCustomAttributes = "";
        if (!$this->room_number->Raw) {
            $this->room_number->CurrentValue = HtmlDecode($this->room_number->CurrentValue);
        }
        $this->room_number->EditValue = $this->room_number->CurrentValue;
        $this->room_number->PlaceHolder = RemoveHtml($this->room_number->caption());

        // net_id
        $this->net_id->EditAttrs["class"] = "form-control";
        $this->net_id->EditCustomAttributes = "";
        if (!$this->net_id->Raw) {
            $this->net_id->CurrentValue = HtmlDecode($this->net_id->CurrentValue);
        }
        $this->net_id->EditValue = $this->net_id->CurrentValue;
        $this->net_id->PlaceHolder = RemoveHtml($this->net_id->caption());

        // jack
        $this->jack->EditAttrs["class"] = "form-control";
        $this->jack->EditCustomAttributes = "";
        if (!$this->jack->Raw) {
            $this->jack->CurrentValue = HtmlDecode($this->jack->CurrentValue);
        }
        $this->jack->EditValue = $this->jack->CurrentValue;
        $this->jack->PlaceHolder = RemoveHtml($this->jack->caption());

        // jack_id
        $this->jack_id->EditAttrs["class"] = "form-control";
        $this->jack_id->EditCustomAttributes = "";
        if (!$this->jack_id->Raw) {
            $this->jack_id->CurrentValue = HtmlDecode($this->jack_id->CurrentValue);
        }
        $this->jack_id->EditValue = $this->jack_id->CurrentValue;
        $this->jack_id->PlaceHolder = RemoveHtml($this->jack_id->caption());

        // voicemail
        $this->voicemail->EditAttrs["class"] = "form-control";
        $this->voicemail->EditCustomAttributes = "";
        if (!$this->voicemail->Raw) {
            $this->voicemail->CurrentValue = HtmlDecode($this->voicemail->CurrentValue);
        }
        $this->voicemail->EditValue = $this->voicemail->CurrentValue;
        $this->voicemail->PlaceHolder = RemoveHtml($this->voicemail->caption());

        // long_distance
        $this->long_distance->EditAttrs["class"] = "form-control";
        $this->long_distance->EditCustomAttributes = "";
        if (!$this->long_distance->Raw) {
            $this->long_distance->CurrentValue = HtmlDecode($this->long_distance->CurrentValue);
        }
        $this->long_distance->EditValue = $this->long_distance->CurrentValue;
        $this->long_distance->PlaceHolder = RemoveHtml($this->long_distance->caption());

        // need_phone
        $this->need_phone->EditAttrs["class"] = "form-control";
        $this->need_phone->EditCustomAttributes = "";
        if (!$this->need_phone->Raw) {
            $this->need_phone->CurrentValue = HtmlDecode($this->need_phone->CurrentValue);
        }
        $this->need_phone->EditValue = $this->need_phone->CurrentValue;
        $this->need_phone->PlaceHolder = RemoveHtml($this->need_phone->caption());

        // call_appearance
        $this->call_appearance->EditAttrs["class"] = "form-control";
        $this->call_appearance->EditCustomAttributes = "";
        if (!$this->call_appearance->Raw) {
            $this->call_appearance->CurrentValue = HtmlDecode($this->call_appearance->CurrentValue);
        }
        $this->call_appearance->EditValue = $this->call_appearance->CurrentValue;
        $this->call_appearance->PlaceHolder = RemoveHtml($this->call_appearance->caption());

        // kfs_number
        $this->kfs_number->EditAttrs["class"] = "form-control";
        $this->kfs_number->EditCustomAttributes = "";
        if (!$this->kfs_number->Raw) {
            $this->kfs_number->CurrentValue = HtmlDecode($this->kfs_number->CurrentValue);
        }
        $this->kfs_number->EditValue = $this->kfs_number->CurrentValue;
        $this->kfs_number->PlaceHolder = RemoveHtml($this->kfs_number->caption());

        // call_appearance1
        $this->call_appearance1->EditAttrs["class"] = "form-control";
        $this->call_appearance1->EditCustomAttributes = "";
        if (!$this->call_appearance1->Raw) {
            $this->call_appearance1->CurrentValue = HtmlDecode($this->call_appearance1->CurrentValue);
        }
        $this->call_appearance1->EditValue = $this->call_appearance1->CurrentValue;
        $this->call_appearance1->PlaceHolder = RemoveHtml($this->call_appearance1->caption());

        // call_appearance2
        $this->call_appearance2->EditAttrs["class"] = "form-control";
        $this->call_appearance2->EditCustomAttributes = "";
        if (!$this->call_appearance2->Raw) {
            $this->call_appearance2->CurrentValue = HtmlDecode($this->call_appearance2->CurrentValue);
        }
        $this->call_appearance2->EditValue = $this->call_appearance2->CurrentValue;
        $this->call_appearance2->PlaceHolder = RemoveHtml($this->call_appearance2->caption());

        // call_appearance3
        $this->call_appearance3->EditAttrs["class"] = "form-control";
        $this->call_appearance3->EditCustomAttributes = "";
        if (!$this->call_appearance3->Raw) {
            $this->call_appearance3->CurrentValue = HtmlDecode($this->call_appearance3->CurrentValue);
        }
        $this->call_appearance3->EditValue = $this->call_appearance3->CurrentValue;
        $this->call_appearance3->PlaceHolder = RemoveHtml($this->call_appearance3->caption());

        // call_appearance4
        $this->call_appearance4->EditAttrs["class"] = "form-control";
        $this->call_appearance4->EditCustomAttributes = "";
        if (!$this->call_appearance4->Raw) {
            $this->call_appearance4->CurrentValue = HtmlDecode($this->call_appearance4->CurrentValue);
        }
        $this->call_appearance4->EditValue = $this->call_appearance4->CurrentValue;
        $this->call_appearance4->PlaceHolder = RemoveHtml($this->call_appearance4->caption());

        // timestamp
        $this->timestamp->EditAttrs["class"] = "form-control";
        $this->timestamp->EditCustomAttributes = "";
        $this->timestamp->EditValue = FormatDateTime($this->timestamp->CurrentValue, 8);
        $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

        // ID
        $this->ID->EditAttrs["class"] = "form-control";
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->employee_status);
                    $doc->exportCaption($this->building);
                    $doc->exportCaption($this->room_number);
                    $doc->exportCaption($this->net_id);
                    $doc->exportCaption($this->jack);
                    $doc->exportCaption($this->jack_id);
                    $doc->exportCaption($this->voicemail);
                    $doc->exportCaption($this->long_distance);
                    $doc->exportCaption($this->need_phone);
                    $doc->exportCaption($this->call_appearance);
                    $doc->exportCaption($this->kfs_number);
                    $doc->exportCaption($this->call_appearance1);
                    $doc->exportCaption($this->call_appearance2);
                    $doc->exportCaption($this->call_appearance3);
                    $doc->exportCaption($this->call_appearance4);
                    $doc->exportCaption($this->timestamp);
                    $doc->exportCaption($this->ID);
                } else {
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->employee_status);
                    $doc->exportCaption($this->building);
                    $doc->exportCaption($this->room_number);
                    $doc->exportCaption($this->net_id);
                    $doc->exportCaption($this->jack);
                    $doc->exportCaption($this->jack_id);
                    $doc->exportCaption($this->voicemail);
                    $doc->exportCaption($this->long_distance);
                    $doc->exportCaption($this->need_phone);
                    $doc->exportCaption($this->call_appearance);
                    $doc->exportCaption($this->kfs_number);
                    $doc->exportCaption($this->call_appearance1);
                    $doc->exportCaption($this->call_appearance2);
                    $doc->exportCaption($this->call_appearance3);
                    $doc->exportCaption($this->call_appearance4);
                    $doc->exportCaption($this->timestamp);
                    $doc->exportCaption($this->ID);
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
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->employee_status);
                        $doc->exportField($this->building);
                        $doc->exportField($this->room_number);
                        $doc->exportField($this->net_id);
                        $doc->exportField($this->jack);
                        $doc->exportField($this->jack_id);
                        $doc->exportField($this->voicemail);
                        $doc->exportField($this->long_distance);
                        $doc->exportField($this->need_phone);
                        $doc->exportField($this->call_appearance);
                        $doc->exportField($this->kfs_number);
                        $doc->exportField($this->call_appearance1);
                        $doc->exportField($this->call_appearance2);
                        $doc->exportField($this->call_appearance3);
                        $doc->exportField($this->call_appearance4);
                        $doc->exportField($this->timestamp);
                        $doc->exportField($this->ID);
                    } else {
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->employee_status);
                        $doc->exportField($this->building);
                        $doc->exportField($this->room_number);
                        $doc->exportField($this->net_id);
                        $doc->exportField($this->jack);
                        $doc->exportField($this->jack_id);
                        $doc->exportField($this->voicemail);
                        $doc->exportField($this->long_distance);
                        $doc->exportField($this->need_phone);
                        $doc->exportField($this->call_appearance);
                        $doc->exportField($this->kfs_number);
                        $doc->exportField($this->call_appearance1);
                        $doc->exportField($this->call_appearance2);
                        $doc->exportField($this->call_appearance3);
                        $doc->exportField($this->call_appearance4);
                        $doc->exportField($this->timestamp);
                        $doc->exportField($this->ID);
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
