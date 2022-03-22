<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for building_access_requests
 */
class BuildingAccessRequests extends DbTable
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
    public $form_type;
    public $supervisor_name;
    public $supervisor_phone;
    public $employee_first_name;
    public $employee_last_name;
    public $catcard;
    public $pin;
    public $employee_unit;
    public $employee_id;
    public $other_areas;
    public $alarm_access;
    public $alarm_area;
    public $alarm_password;
    public $replacement_catcard;
    public $replacement_other;
    public $replacement_problem;
    public $delete;
    public $timestamp;
    public $net_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'building_access_requests';
        $this->TableName = 'building_access_requests';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`building_access_requests`";
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
        $this->id = new DbField('building_access_requests', 'building_access_requests', 'x_id', 'id', '`id`', '`id`', 19, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // form_type
        $this->form_type = new DbField('building_access_requests', 'building_access_requests', 'x_form_type', 'form_type', '`form_type`', '`form_type`', 200, 45, -1, false, '`form_type`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->form_type->Nullable = false; // NOT NULL field
        $this->form_type->Required = true; // Required field
        $this->form_type->Sortable = true; // Allow sort
        $this->form_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->form_type->Param, "CustomMsg");
        $this->Fields['form_type'] = &$this->form_type;

        // supervisor_name
        $this->supervisor_name = new DbField('building_access_requests', 'building_access_requests', 'x_supervisor_name', 'supervisor_name', '`supervisor_name`', '`supervisor_name`', 200, 80, -1, false, '`supervisor_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_name->Nullable = false; // NOT NULL field
        $this->supervisor_name->Required = true; // Required field
        $this->supervisor_name->Sortable = true; // Allow sort
        $this->supervisor_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_name->Param, "CustomMsg");
        $this->Fields['supervisor_name'] = &$this->supervisor_name;

        // supervisor_phone
        $this->supervisor_phone = new DbField('building_access_requests', 'building_access_requests', 'x_supervisor_phone', 'supervisor_phone', '`supervisor_phone`', '`supervisor_phone`', 200, 20, -1, false, '`supervisor_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->supervisor_phone->Nullable = false; // NOT NULL field
        $this->supervisor_phone->Required = true; // Required field
        $this->supervisor_phone->Sortable = true; // Allow sort
        $this->supervisor_phone->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->supervisor_phone->Param, "CustomMsg");
        $this->Fields['supervisor_phone'] = &$this->supervisor_phone;

        // employee_first_name
        $this->employee_first_name = new DbField('building_access_requests', 'building_access_requests', 'x_employee_first_name', 'employee_first_name', '`employee_first_name`', '`employee_first_name`', 200, 45, -1, false, '`employee_first_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_first_name->Nullable = false; // NOT NULL field
        $this->employee_first_name->Required = true; // Required field
        $this->employee_first_name->Sortable = true; // Allow sort
        $this->employee_first_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_first_name->Param, "CustomMsg");
        $this->Fields['employee_first_name'] = &$this->employee_first_name;

        // employee_last_name
        $this->employee_last_name = new DbField('building_access_requests', 'building_access_requests', 'x_employee_last_name', 'employee_last_name', '`employee_last_name`', '`employee_last_name`', 200, 45, -1, false, '`employee_last_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_last_name->Nullable = false; // NOT NULL field
        $this->employee_last_name->Required = true; // Required field
        $this->employee_last_name->Sortable = true; // Allow sort
        $this->employee_last_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_last_name->Param, "CustomMsg");
        $this->Fields['employee_last_name'] = &$this->employee_last_name;

        // catcard
        $this->catcard = new DbField('building_access_requests', 'building_access_requests', 'x_catcard', 'catcard', '`catcard`', '`catcard`', 200, 20, -1, false, '`catcard`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->catcard->Sortable = true; // Allow sort
        $this->catcard->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->catcard->Param, "CustomMsg");
        $this->Fields['catcard'] = &$this->catcard;

        // pin
        $this->pin = new DbField('building_access_requests', 'building_access_requests', 'x_pin', 'pin', '`pin`', '`pin`', 200, 10, -1, false, '`pin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pin->Sortable = true; // Allow sort
        $this->pin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pin->Param, "CustomMsg");
        $this->Fields['pin'] = &$this->pin;

        // employee_unit
        $this->employee_unit = new DbField('building_access_requests', 'building_access_requests', 'x_employee_unit', 'employee_unit', '`employee_unit`', '`employee_unit`', 200, 60, -1, false, '`employee_unit`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_unit->Nullable = false; // NOT NULL field
        $this->employee_unit->Required = true; // Required field
        $this->employee_unit->Sortable = true; // Allow sort
        $this->employee_unit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_unit->Param, "CustomMsg");
        $this->Fields['employee_unit'] = &$this->employee_unit;

        // employee_id
        $this->employee_id = new DbField('building_access_requests', 'building_access_requests', 'x_employee_id', 'employee_id', '`employee_id`', '`employee_id`', 200, 45, -1, false, '`employee_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_id->Sortable = true; // Allow sort
        $this->employee_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_id->Param, "CustomMsg");
        $this->Fields['employee_id'] = &$this->employee_id;

        // other_areas
        $this->other_areas = new DbField('building_access_requests', 'building_access_requests', 'x_other_areas', 'other_areas', '`other_areas`', '`other_areas`', 200, 120, -1, false, '`other_areas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->other_areas->Sortable = true; // Allow sort
        $this->other_areas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->other_areas->Param, "CustomMsg");
        $this->Fields['other_areas'] = &$this->other_areas;

        // alarm_access
        $this->alarm_access = new DbField('building_access_requests', 'building_access_requests', 'x_alarm_access', 'alarm_access', '`alarm_access`', '`alarm_access`', 16, 1, -1, false, '`alarm_access`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->alarm_access->Sortable = true; // Allow sort
        $this->alarm_access->DataType = DATATYPE_BOOLEAN;
        $this->alarm_access->Lookup = new Lookup('alarm_access', 'building_access_requests', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->alarm_access->OptionCount = 2;
        $this->alarm_access->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->alarm_access->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alarm_access->Param, "CustomMsg");
        $this->Fields['alarm_access'] = &$this->alarm_access;

        // alarm_area
        $this->alarm_area = new DbField('building_access_requests', 'building_access_requests', 'x_alarm_area', 'alarm_area', '`alarm_area`', '`alarm_area`', 200, 80, -1, false, '`alarm_area`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alarm_area->Sortable = true; // Allow sort
        $this->alarm_area->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alarm_area->Param, "CustomMsg");
        $this->Fields['alarm_area'] = &$this->alarm_area;

        // alarm_password
        $this->alarm_password = new DbField('building_access_requests', 'building_access_requests', 'x_alarm_password', 'alarm_password', '`alarm_password`', '`alarm_password`', 200, 20, -1, false, '`alarm_password`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alarm_password->Sortable = true; // Allow sort
        $this->alarm_password->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alarm_password->Param, "CustomMsg");
        $this->Fields['alarm_password'] = &$this->alarm_password;

        // replacement_catcard
        $this->replacement_catcard = new DbField('building_access_requests', 'building_access_requests', 'x_replacement_catcard', 'replacement_catcard', '`replacement_catcard`', '`replacement_catcard`', 200, 20, -1, false, '`replacement_catcard`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->replacement_catcard->Sortable = true; // Allow sort
        $this->replacement_catcard->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->replacement_catcard->Param, "CustomMsg");
        $this->Fields['replacement_catcard'] = &$this->replacement_catcard;

        // replacement_other
        $this->replacement_other = new DbField('building_access_requests', 'building_access_requests', 'x_replacement_other', 'replacement_other', '`replacement_other`', '`replacement_other`', 200, 120, -1, false, '`replacement_other`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->replacement_other->Sortable = true; // Allow sort
        $this->replacement_other->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->replacement_other->Param, "CustomMsg");
        $this->Fields['replacement_other'] = &$this->replacement_other;

        // replacement_problem
        $this->replacement_problem = new DbField('building_access_requests', 'building_access_requests', 'x_replacement_problem', 'replacement_problem', '`replacement_problem`', '`replacement_problem`', 200, 255, -1, false, '`replacement_problem`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->replacement_problem->Sortable = true; // Allow sort
        $this->replacement_problem->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->replacement_problem->Param, "CustomMsg");
        $this->Fields['replacement_problem'] = &$this->replacement_problem;

        // delete
        $this->delete = new DbField('building_access_requests', 'building_access_requests', 'x_delete', 'delete', '`delete`', '`delete`', 16, 1, -1, false, '`delete`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->delete->Sortable = true; // Allow sort
        $this->delete->DataType = DATATYPE_BOOLEAN;
        $this->delete->Lookup = new Lookup('delete', 'building_access_requests', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->delete->OptionCount = 2;
        $this->delete->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->delete->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->delete->Param, "CustomMsg");
        $this->Fields['delete'] = &$this->delete;

        // timestamp
        $this->timestamp = new DbField('building_access_requests', 'building_access_requests', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timestamp->Sortable = true; // Allow sort
        $this->timestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->timestamp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->timestamp->Param, "CustomMsg");
        $this->Fields['timestamp'] = &$this->timestamp;

        // net_id
        $this->net_id = new DbField('building_access_requests', 'building_access_requests', 'x_net_id', 'net_id', '`net_id`', '`net_id`', 200, 45, -1, false, '`net_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->net_id->Sortable = true; // Allow sort
        $this->net_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->net_id->Param, "CustomMsg");
        $this->Fields['net_id'] = &$this->net_id;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`building_access_requests`";
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
        $this->form_type->DbValue = $row['form_type'];
        $this->supervisor_name->DbValue = $row['supervisor_name'];
        $this->supervisor_phone->DbValue = $row['supervisor_phone'];
        $this->employee_first_name->DbValue = $row['employee_first_name'];
        $this->employee_last_name->DbValue = $row['employee_last_name'];
        $this->catcard->DbValue = $row['catcard'];
        $this->pin->DbValue = $row['pin'];
        $this->employee_unit->DbValue = $row['employee_unit'];
        $this->employee_id->DbValue = $row['employee_id'];
        $this->other_areas->DbValue = $row['other_areas'];
        $this->alarm_access->DbValue = $row['alarm_access'];
        $this->alarm_area->DbValue = $row['alarm_area'];
        $this->alarm_password->DbValue = $row['alarm_password'];
        $this->replacement_catcard->DbValue = $row['replacement_catcard'];
        $this->replacement_other->DbValue = $row['replacement_other'];
        $this->replacement_problem->DbValue = $row['replacement_problem'];
        $this->delete->DbValue = $row['delete'];
        $this->timestamp->DbValue = $row['timestamp'];
        $this->net_id->DbValue = $row['net_id'];
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
        return $_SESSION[$name] ?? GetUrl("BuildingAccessRequestsList");
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
        if ($pageName == "BuildingAccessRequestsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BuildingAccessRequestsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BuildingAccessRequestsAdd") {
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
                return "BuildingAccessRequestsView";
            case Config("API_ADD_ACTION"):
                return "BuildingAccessRequestsAdd";
            case Config("API_EDIT_ACTION"):
                return "BuildingAccessRequestsEdit";
            case Config("API_DELETE_ACTION"):
                return "BuildingAccessRequestsDelete";
            case Config("API_LIST_ACTION"):
                return "BuildingAccessRequestsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BuildingAccessRequestsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BuildingAccessRequestsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BuildingAccessRequestsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BuildingAccessRequestsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BuildingAccessRequestsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BuildingAccessRequestsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BuildingAccessRequestsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BuildingAccessRequestsDelete", $this->getUrlParm());
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
        $this->form_type->setDbValue($row['form_type']);
        $this->supervisor_name->setDbValue($row['supervisor_name']);
        $this->supervisor_phone->setDbValue($row['supervisor_phone']);
        $this->employee_first_name->setDbValue($row['employee_first_name']);
        $this->employee_last_name->setDbValue($row['employee_last_name']);
        $this->catcard->setDbValue($row['catcard']);
        $this->pin->setDbValue($row['pin']);
        $this->employee_unit->setDbValue($row['employee_unit']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->other_areas->setDbValue($row['other_areas']);
        $this->alarm_access->setDbValue($row['alarm_access']);
        $this->alarm_area->setDbValue($row['alarm_area']);
        $this->alarm_password->setDbValue($row['alarm_password']);
        $this->replacement_catcard->setDbValue($row['replacement_catcard']);
        $this->replacement_other->setDbValue($row['replacement_other']);
        $this->replacement_problem->setDbValue($row['replacement_problem']);
        $this->delete->setDbValue($row['delete']);
        $this->timestamp->setDbValue($row['timestamp']);
        $this->net_id->setDbValue($row['net_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // form_type

        // supervisor_name

        // supervisor_phone

        // employee_first_name

        // employee_last_name

        // catcard

        // pin

        // employee_unit

        // employee_id

        // other_areas

        // alarm_access

        // alarm_area

        // alarm_password

        // replacement_catcard

        // replacement_other

        // replacement_problem

        // delete

        // timestamp

        // net_id

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // form_type
        $this->form_type->ViewValue = $this->form_type->CurrentValue;
        $this->form_type->ViewCustomAttributes = "";

        // supervisor_name
        $this->supervisor_name->ViewValue = $this->supervisor_name->CurrentValue;
        $this->supervisor_name->ViewCustomAttributes = "";

        // supervisor_phone
        $this->supervisor_phone->ViewValue = $this->supervisor_phone->CurrentValue;
        $this->supervisor_phone->ViewCustomAttributes = "";

        // employee_first_name
        $this->employee_first_name->ViewValue = $this->employee_first_name->CurrentValue;
        $this->employee_first_name->ViewCustomAttributes = "";

        // employee_last_name
        $this->employee_last_name->ViewValue = $this->employee_last_name->CurrentValue;
        $this->employee_last_name->ViewCustomAttributes = "";

        // catcard
        $this->catcard->ViewValue = $this->catcard->CurrentValue;
        $this->catcard->ViewCustomAttributes = "";

        // pin
        $this->pin->ViewValue = $this->pin->CurrentValue;
        $this->pin->ViewCustomAttributes = "";

        // employee_unit
        $this->employee_unit->ViewValue = $this->employee_unit->CurrentValue;
        $this->employee_unit->ViewCustomAttributes = "";

        // employee_id
        $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
        $this->employee_id->ViewCustomAttributes = "";

        // other_areas
        $this->other_areas->ViewValue = $this->other_areas->CurrentValue;
        $this->other_areas->ViewCustomAttributes = "";

        // alarm_access
        if (ConvertToBool($this->alarm_access->CurrentValue)) {
            $this->alarm_access->ViewValue = $this->alarm_access->tagCaption(1) != "" ? $this->alarm_access->tagCaption(1) : "Yes";
        } else {
            $this->alarm_access->ViewValue = $this->alarm_access->tagCaption(2) != "" ? $this->alarm_access->tagCaption(2) : "No";
        }
        $this->alarm_access->ViewCustomAttributes = "";

        // alarm_area
        $this->alarm_area->ViewValue = $this->alarm_area->CurrentValue;
        $this->alarm_area->ViewCustomAttributes = "";

        // alarm_password
        $this->alarm_password->ViewValue = $this->alarm_password->CurrentValue;
        $this->alarm_password->ViewCustomAttributes = "";

        // replacement_catcard
        $this->replacement_catcard->ViewValue = $this->replacement_catcard->CurrentValue;
        $this->replacement_catcard->ViewCustomAttributes = "";

        // replacement_other
        $this->replacement_other->ViewValue = $this->replacement_other->CurrentValue;
        $this->replacement_other->ViewCustomAttributes = "";

        // replacement_problem
        $this->replacement_problem->ViewValue = $this->replacement_problem->CurrentValue;
        $this->replacement_problem->ViewCustomAttributes = "";

        // delete
        if (ConvertToBool($this->delete->CurrentValue)) {
            $this->delete->ViewValue = $this->delete->tagCaption(1) != "" ? $this->delete->tagCaption(1) : "Yes";
        } else {
            $this->delete->ViewValue = $this->delete->tagCaption(2) != "" ? $this->delete->tagCaption(2) : "No";
        }
        $this->delete->ViewCustomAttributes = "";

        // timestamp
        $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
        $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
        $this->timestamp->ViewCustomAttributes = "";

        // net_id
        $this->net_id->ViewValue = $this->net_id->CurrentValue;
        $this->net_id->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // form_type
        $this->form_type->LinkCustomAttributes = "";
        $this->form_type->HrefValue = "";
        $this->form_type->TooltipValue = "";

        // supervisor_name
        $this->supervisor_name->LinkCustomAttributes = "";
        $this->supervisor_name->HrefValue = "";
        $this->supervisor_name->TooltipValue = "";

        // supervisor_phone
        $this->supervisor_phone->LinkCustomAttributes = "";
        $this->supervisor_phone->HrefValue = "";
        $this->supervisor_phone->TooltipValue = "";

        // employee_first_name
        $this->employee_first_name->LinkCustomAttributes = "";
        $this->employee_first_name->HrefValue = "";
        $this->employee_first_name->TooltipValue = "";

        // employee_last_name
        $this->employee_last_name->LinkCustomAttributes = "";
        $this->employee_last_name->HrefValue = "";
        $this->employee_last_name->TooltipValue = "";

        // catcard
        $this->catcard->LinkCustomAttributes = "";
        $this->catcard->HrefValue = "";
        $this->catcard->TooltipValue = "";

        // pin
        $this->pin->LinkCustomAttributes = "";
        $this->pin->HrefValue = "";
        $this->pin->TooltipValue = "";

        // employee_unit
        $this->employee_unit->LinkCustomAttributes = "";
        $this->employee_unit->HrefValue = "";
        $this->employee_unit->TooltipValue = "";

        // employee_id
        $this->employee_id->LinkCustomAttributes = "";
        $this->employee_id->HrefValue = "";
        $this->employee_id->TooltipValue = "";

        // other_areas
        $this->other_areas->LinkCustomAttributes = "";
        $this->other_areas->HrefValue = "";
        $this->other_areas->TooltipValue = "";

        // alarm_access
        $this->alarm_access->LinkCustomAttributes = "";
        $this->alarm_access->HrefValue = "";
        $this->alarm_access->TooltipValue = "";

        // alarm_area
        $this->alarm_area->LinkCustomAttributes = "";
        $this->alarm_area->HrefValue = "";
        $this->alarm_area->TooltipValue = "";

        // alarm_password
        $this->alarm_password->LinkCustomAttributes = "";
        $this->alarm_password->HrefValue = "";
        $this->alarm_password->TooltipValue = "";

        // replacement_catcard
        $this->replacement_catcard->LinkCustomAttributes = "";
        $this->replacement_catcard->HrefValue = "";
        $this->replacement_catcard->TooltipValue = "";

        // replacement_other
        $this->replacement_other->LinkCustomAttributes = "";
        $this->replacement_other->HrefValue = "";
        $this->replacement_other->TooltipValue = "";

        // replacement_problem
        $this->replacement_problem->LinkCustomAttributes = "";
        $this->replacement_problem->HrefValue = "";
        $this->replacement_problem->TooltipValue = "";

        // delete
        $this->delete->LinkCustomAttributes = "";
        $this->delete->HrefValue = "";
        $this->delete->TooltipValue = "";

        // timestamp
        $this->timestamp->LinkCustomAttributes = "";
        $this->timestamp->HrefValue = "";
        $this->timestamp->TooltipValue = "";

        // net_id
        $this->net_id->LinkCustomAttributes = "";
        $this->net_id->HrefValue = "";
        $this->net_id->TooltipValue = "";

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

        // form_type
        $this->form_type->EditAttrs["class"] = "form-control";
        $this->form_type->EditCustomAttributes = "";
        if (!$this->form_type->Raw) {
            $this->form_type->CurrentValue = HtmlDecode($this->form_type->CurrentValue);
        }
        $this->form_type->EditValue = $this->form_type->CurrentValue;
        $this->form_type->PlaceHolder = RemoveHtml($this->form_type->caption());

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

        // catcard
        $this->catcard->EditAttrs["class"] = "form-control";
        $this->catcard->EditCustomAttributes = "";
        if (!$this->catcard->Raw) {
            $this->catcard->CurrentValue = HtmlDecode($this->catcard->CurrentValue);
        }
        $this->catcard->EditValue = $this->catcard->CurrentValue;
        $this->catcard->PlaceHolder = RemoveHtml($this->catcard->caption());

        // pin
        $this->pin->EditAttrs["class"] = "form-control";
        $this->pin->EditCustomAttributes = "";
        if (!$this->pin->Raw) {
            $this->pin->CurrentValue = HtmlDecode($this->pin->CurrentValue);
        }
        $this->pin->EditValue = $this->pin->CurrentValue;
        $this->pin->PlaceHolder = RemoveHtml($this->pin->caption());

        // employee_unit
        $this->employee_unit->EditAttrs["class"] = "form-control";
        $this->employee_unit->EditCustomAttributes = "";
        if (!$this->employee_unit->Raw) {
            $this->employee_unit->CurrentValue = HtmlDecode($this->employee_unit->CurrentValue);
        }
        $this->employee_unit->EditValue = $this->employee_unit->CurrentValue;
        $this->employee_unit->PlaceHolder = RemoveHtml($this->employee_unit->caption());

        // employee_id
        $this->employee_id->EditAttrs["class"] = "form-control";
        $this->employee_id->EditCustomAttributes = "";
        if (!$this->employee_id->Raw) {
            $this->employee_id->CurrentValue = HtmlDecode($this->employee_id->CurrentValue);
        }
        $this->employee_id->EditValue = $this->employee_id->CurrentValue;
        $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());

        // other_areas
        $this->other_areas->EditAttrs["class"] = "form-control";
        $this->other_areas->EditCustomAttributes = "";
        if (!$this->other_areas->Raw) {
            $this->other_areas->CurrentValue = HtmlDecode($this->other_areas->CurrentValue);
        }
        $this->other_areas->EditValue = $this->other_areas->CurrentValue;
        $this->other_areas->PlaceHolder = RemoveHtml($this->other_areas->caption());

        // alarm_access
        $this->alarm_access->EditCustomAttributes = "";
        $this->alarm_access->EditValue = $this->alarm_access->options(false);
        $this->alarm_access->PlaceHolder = RemoveHtml($this->alarm_access->caption());

        // alarm_area
        $this->alarm_area->EditAttrs["class"] = "form-control";
        $this->alarm_area->EditCustomAttributes = "";
        if (!$this->alarm_area->Raw) {
            $this->alarm_area->CurrentValue = HtmlDecode($this->alarm_area->CurrentValue);
        }
        $this->alarm_area->EditValue = $this->alarm_area->CurrentValue;
        $this->alarm_area->PlaceHolder = RemoveHtml($this->alarm_area->caption());

        // alarm_password
        $this->alarm_password->EditAttrs["class"] = "form-control";
        $this->alarm_password->EditCustomAttributes = "";
        if (!$this->alarm_password->Raw) {
            $this->alarm_password->CurrentValue = HtmlDecode($this->alarm_password->CurrentValue);
        }
        $this->alarm_password->EditValue = $this->alarm_password->CurrentValue;
        $this->alarm_password->PlaceHolder = RemoveHtml($this->alarm_password->caption());

        // replacement_catcard
        $this->replacement_catcard->EditAttrs["class"] = "form-control";
        $this->replacement_catcard->EditCustomAttributes = "";
        if (!$this->replacement_catcard->Raw) {
            $this->replacement_catcard->CurrentValue = HtmlDecode($this->replacement_catcard->CurrentValue);
        }
        $this->replacement_catcard->EditValue = $this->replacement_catcard->CurrentValue;
        $this->replacement_catcard->PlaceHolder = RemoveHtml($this->replacement_catcard->caption());

        // replacement_other
        $this->replacement_other->EditAttrs["class"] = "form-control";
        $this->replacement_other->EditCustomAttributes = "";
        if (!$this->replacement_other->Raw) {
            $this->replacement_other->CurrentValue = HtmlDecode($this->replacement_other->CurrentValue);
        }
        $this->replacement_other->EditValue = $this->replacement_other->CurrentValue;
        $this->replacement_other->PlaceHolder = RemoveHtml($this->replacement_other->caption());

        // replacement_problem
        $this->replacement_problem->EditAttrs["class"] = "form-control";
        $this->replacement_problem->EditCustomAttributes = "";
        if (!$this->replacement_problem->Raw) {
            $this->replacement_problem->CurrentValue = HtmlDecode($this->replacement_problem->CurrentValue);
        }
        $this->replacement_problem->EditValue = $this->replacement_problem->CurrentValue;
        $this->replacement_problem->PlaceHolder = RemoveHtml($this->replacement_problem->caption());

        // delete
        $this->delete->EditCustomAttributes = "";
        $this->delete->EditValue = $this->delete->options(false);
        $this->delete->PlaceHolder = RemoveHtml($this->delete->caption());

        // timestamp
        $this->timestamp->EditAttrs["class"] = "form-control";
        $this->timestamp->EditCustomAttributes = "";
        $this->timestamp->EditValue = FormatDateTime($this->timestamp->CurrentValue, 8);
        $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

        // net_id
        $this->net_id->EditAttrs["class"] = "form-control";
        $this->net_id->EditCustomAttributes = "";
        if (!$this->net_id->Raw) {
            $this->net_id->CurrentValue = HtmlDecode($this->net_id->CurrentValue);
        }
        $this->net_id->EditValue = $this->net_id->CurrentValue;
        $this->net_id->PlaceHolder = RemoveHtml($this->net_id->caption());

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
                    $doc->exportCaption($this->form_type);
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->employee_first_name);
                    $doc->exportCaption($this->employee_last_name);
                    $doc->exportCaption($this->catcard);
                    $doc->exportCaption($this->pin);
                    $doc->exportCaption($this->employee_unit);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->other_areas);
                    $doc->exportCaption($this->alarm_access);
                    $doc->exportCaption($this->alarm_area);
                    $doc->exportCaption($this->alarm_password);
                    $doc->exportCaption($this->replacement_catcard);
                    $doc->exportCaption($this->replacement_other);
                    $doc->exportCaption($this->replacement_problem);
                    $doc->exportCaption($this->delete);
                    $doc->exportCaption($this->timestamp);
                    $doc->exportCaption($this->net_id);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->form_type);
                    $doc->exportCaption($this->supervisor_name);
                    $doc->exportCaption($this->supervisor_phone);
                    $doc->exportCaption($this->employee_first_name);
                    $doc->exportCaption($this->employee_last_name);
                    $doc->exportCaption($this->catcard);
                    $doc->exportCaption($this->pin);
                    $doc->exportCaption($this->employee_unit);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->other_areas);
                    $doc->exportCaption($this->alarm_access);
                    $doc->exportCaption($this->alarm_area);
                    $doc->exportCaption($this->alarm_password);
                    $doc->exportCaption($this->replacement_catcard);
                    $doc->exportCaption($this->replacement_other);
                    $doc->exportCaption($this->replacement_problem);
                    $doc->exportCaption($this->delete);
                    $doc->exportCaption($this->timestamp);
                    $doc->exportCaption($this->net_id);
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
                        $doc->exportField($this->form_type);
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->employee_first_name);
                        $doc->exportField($this->employee_last_name);
                        $doc->exportField($this->catcard);
                        $doc->exportField($this->pin);
                        $doc->exportField($this->employee_unit);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->other_areas);
                        $doc->exportField($this->alarm_access);
                        $doc->exportField($this->alarm_area);
                        $doc->exportField($this->alarm_password);
                        $doc->exportField($this->replacement_catcard);
                        $doc->exportField($this->replacement_other);
                        $doc->exportField($this->replacement_problem);
                        $doc->exportField($this->delete);
                        $doc->exportField($this->timestamp);
                        $doc->exportField($this->net_id);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->form_type);
                        $doc->exportField($this->supervisor_name);
                        $doc->exportField($this->supervisor_phone);
                        $doc->exportField($this->employee_first_name);
                        $doc->exportField($this->employee_last_name);
                        $doc->exportField($this->catcard);
                        $doc->exportField($this->pin);
                        $doc->exportField($this->employee_unit);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->other_areas);
                        $doc->exportField($this->alarm_access);
                        $doc->exportField($this->alarm_area);
                        $doc->exportField($this->alarm_password);
                        $doc->exportField($this->replacement_catcard);
                        $doc->exportField($this->replacement_other);
                        $doc->exportField($this->replacement_problem);
                        $doc->exportField($this->delete);
                        $doc->exportField($this->timestamp);
                        $doc->exportField($this->net_id);
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
