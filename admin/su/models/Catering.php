<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for catering
 */
class Catering extends DbTable
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
    public $location;
    public $method;
    public $delivery_date;
    public $delivery_time;
    public $delivery_building;
    public $delivery_room;
    public $delivery_notes;
    public $onsite_name;
    public $onsite_email;
    public $onsite_phone;
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $payment_method;
    public $account_num;
    public $sub_code;
    public $status;
    public $order;
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
        $this->TableVar = 'catering';
        $this->TableName = 'catering';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`catering`";
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
        $this->id = new DbField('catering', 'catering', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // location
        $this->location = new DbField('catering', 'catering', 'x_location', 'location', '`location`', '`location`', 200, 45, -1, false, '`location`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->location->Sortable = true; // Allow sort
        $this->Fields['location'] = &$this->location;

        // method
        $this->method = new DbField('catering', 'catering', 'x_method', 'method', '`method`', '`method`', 200, 45, -1, false, '`method`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->method->Sortable = true; // Allow sort
        $this->Fields['method'] = &$this->method;

        // delivery_date
        $this->delivery_date = new DbField('catering', 'catering', 'x_delivery_date', 'delivery_date', '`delivery_date`', CastDateFieldForLike("`delivery_date`", 0, "DB"), 133, 10, 0, false, '`delivery_date`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->delivery_date->Sortable = true; // Allow sort
        $this->delivery_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['delivery_date'] = &$this->delivery_date;

        // delivery_time
        $this->delivery_time = new DbField('catering', 'catering', 'x_delivery_time', 'delivery_time', '`delivery_time`', '`delivery_time`', 200, 45, -1, false, '`delivery_time`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->delivery_time->Sortable = true; // Allow sort
        $this->Fields['delivery_time'] = &$this->delivery_time;

        // delivery_building
        $this->delivery_building = new DbField('catering', 'catering', 'x_delivery_building', 'delivery_building', '`delivery_building`', '`delivery_building`', 200, 45, -1, false, '`delivery_building`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->delivery_building->Sortable = true; // Allow sort
        $this->Fields['delivery_building'] = &$this->delivery_building;

        // delivery_room
        $this->delivery_room = new DbField('catering', 'catering', 'x_delivery_room', 'delivery_room', '`delivery_room`', '`delivery_room`', 200, 45, -1, false, '`delivery_room`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->delivery_room->Sortable = true; // Allow sort
        $this->Fields['delivery_room'] = &$this->delivery_room;

        // delivery_notes
        $this->delivery_notes = new DbField('catering', 'catering', 'x_delivery_notes', 'delivery_notes', '`delivery_notes`', '`delivery_notes`', 201, 65535, -1, false, '`delivery_notes`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->delivery_notes->Sortable = true; // Allow sort
        $this->Fields['delivery_notes'] = &$this->delivery_notes;

        // onsite_name
        $this->onsite_name = new DbField('catering', 'catering', 'x_onsite_name', 'onsite_name', '`onsite_name`', '`onsite_name`', 200, 45, -1, false, '`onsite_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->onsite_name->Sortable = true; // Allow sort
        $this->Fields['onsite_name'] = &$this->onsite_name;

        // onsite_email
        $this->onsite_email = new DbField('catering', 'catering', 'x_onsite_email', 'onsite_email', '`onsite_email`', '`onsite_email`', 200, 70, -1, false, '`onsite_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->onsite_email->Sortable = true; // Allow sort
        $this->Fields['onsite_email'] = &$this->onsite_email;

        // onsite_phone
        $this->onsite_phone = new DbField('catering', 'catering', 'x_onsite_phone', 'onsite_phone', '`onsite_phone`', '`onsite_phone`', 200, 45, -1, false, '`onsite_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->onsite_phone->Sortable = true; // Allow sort
        $this->Fields['onsite_phone'] = &$this->onsite_phone;

        // customer_name
        $this->customer_name = new DbField('catering', 'catering', 'x_customer_name', 'customer_name', '`customer_name`', '`customer_name`', 200, 45, -1, false, '`customer_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->customer_name->Sortable = true; // Allow sort
        $this->Fields['customer_name'] = &$this->customer_name;

        // customer_phone
        $this->customer_phone = new DbField('catering', 'catering', 'x_customer_phone', 'customer_phone', '`customer_phone`', '`customer_phone`', 200, 45, -1, false, '`customer_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->customer_phone->Sortable = true; // Allow sort
        $this->Fields['customer_phone'] = &$this->customer_phone;

        // customer_email
        $this->customer_email = new DbField('catering', 'catering', 'x_customer_email', 'customer_email', '`customer_email`', '`customer_email`', 200, 45, -1, false, '`customer_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->customer_email->Sortable = true; // Allow sort
        $this->Fields['customer_email'] = &$this->customer_email;

        // payment_method
        $this->payment_method = new DbField('catering', 'catering', 'x_payment_method', 'payment_method', '`payment_method`', '`payment_method`', 200, 45, -1, false, '`payment_method`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->payment_method->Sortable = true; // Allow sort
        $this->Fields['payment_method'] = &$this->payment_method;

        // account_num
        $this->account_num = new DbField('catering', 'catering', 'x_account_num', 'account_num', '`account_num`', '`account_num`', 200, 45, -1, false, '`account_num`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->account_num->Sortable = true; // Allow sort
        $this->Fields['account_num'] = &$this->account_num;

        // sub_code
        $this->sub_code = new DbField('catering', 'catering', 'x_sub_code', 'sub_code', '`sub_code`', '`sub_code`', 200, 45, -1, false, '`sub_code`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sub_code->Sortable = true; // Allow sort
        $this->Fields['sub_code'] = &$this->sub_code;

        // status
        $this->status = new DbField('catering', 'catering', 'x_status', 'status', '`status`', '`status`', 200, 45, -1, false, '`status`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status->Sortable = true; // Allow sort
        $this->Fields['status'] = &$this->status;

        // order
        $this->order = new DbField('catering', 'catering', 'x_order', 'order', '`order`', '`order`', 201, -1, -1, false, '`order`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->order->Sortable = true; // Allow sort
        $this->Fields['order'] = &$this->order;

        // timestamp
        $this->timestamp = new DbField('catering', 'catering', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timestamp->Sortable = true; // Allow sort
        $this->timestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`catering`";
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
        $this->location->DbValue = $row['location'];
        $this->method->DbValue = $row['method'];
        $this->delivery_date->DbValue = $row['delivery_date'];
        $this->delivery_time->DbValue = $row['delivery_time'];
        $this->delivery_building->DbValue = $row['delivery_building'];
        $this->delivery_room->DbValue = $row['delivery_room'];
        $this->delivery_notes->DbValue = $row['delivery_notes'];
        $this->onsite_name->DbValue = $row['onsite_name'];
        $this->onsite_email->DbValue = $row['onsite_email'];
        $this->onsite_phone->DbValue = $row['onsite_phone'];
        $this->customer_name->DbValue = $row['customer_name'];
        $this->customer_phone->DbValue = $row['customer_phone'];
        $this->customer_email->DbValue = $row['customer_email'];
        $this->payment_method->DbValue = $row['payment_method'];
        $this->account_num->DbValue = $row['account_num'];
        $this->sub_code->DbValue = $row['sub_code'];
        $this->status->DbValue = $row['status'];
        $this->order->DbValue = $row['order'];
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
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if (ReferUrl() != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login") { // Referer not same page or login page
            $_SESSION[$name] = ReferUrl(); // Save to Session
        }
        if (@$_SESSION[$name] != "") {
            return $_SESSION[$name];
        } else {
            return GetUrl("CateringList");
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
        if ($pageName == "CateringView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CateringEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CateringAdd") {
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
                return "CateringView";
            case Config("API_ADD_ACTION"):
                return "CateringAdd";
            case Config("API_EDIT_ACTION"):
                return "CateringEdit";
            case Config("API_DELETE_ACTION"):
                return "CateringDelete";
            case Config("API_LIST_ACTION"):
                return "CateringList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CateringList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CateringView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CateringView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CateringAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CateringAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CateringEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CateringAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CateringDelete", $this->getUrlParm());
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
        $this->location->setDbValue($row['location']);
        $this->method->setDbValue($row['method']);
        $this->delivery_date->setDbValue($row['delivery_date']);
        $this->delivery_time->setDbValue($row['delivery_time']);
        $this->delivery_building->setDbValue($row['delivery_building']);
        $this->delivery_room->setDbValue($row['delivery_room']);
        $this->delivery_notes->setDbValue($row['delivery_notes']);
        $this->onsite_name->setDbValue($row['onsite_name']);
        $this->onsite_email->setDbValue($row['onsite_email']);
        $this->onsite_phone->setDbValue($row['onsite_phone']);
        $this->customer_name->setDbValue($row['customer_name']);
        $this->customer_phone->setDbValue($row['customer_phone']);
        $this->customer_email->setDbValue($row['customer_email']);
        $this->payment_method->setDbValue($row['payment_method']);
        $this->account_num->setDbValue($row['account_num']);
        $this->sub_code->setDbValue($row['sub_code']);
        $this->status->setDbValue($row['status']);
        $this->order->setDbValue($row['order']);
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

        // location

        // method

        // delivery_date

        // delivery_time

        // delivery_building

        // delivery_room

        // delivery_notes

        // onsite_name

        // onsite_email

        // onsite_phone

        // customer_name

        // customer_phone

        // customer_email

        // payment_method

        // account_num

        // sub_code

        // status

        // order

        // timestamp

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // location
        $this->location->ViewValue = $this->location->CurrentValue;
        $this->location->ViewCustomAttributes = "";

        // method
        $this->method->ViewValue = $this->method->CurrentValue;
        $this->method->ViewCustomAttributes = "";

        // delivery_date
        $this->delivery_date->ViewValue = $this->delivery_date->CurrentValue;
        $this->delivery_date->ViewValue = FormatDateTime($this->delivery_date->ViewValue, 0);
        $this->delivery_date->ViewCustomAttributes = "";

        // delivery_time
        $this->delivery_time->ViewValue = $this->delivery_time->CurrentValue;
        $this->delivery_time->ViewCustomAttributes = "";

        // delivery_building
        $this->delivery_building->ViewValue = $this->delivery_building->CurrentValue;
        $this->delivery_building->ViewCustomAttributes = "";

        // delivery_room
        $this->delivery_room->ViewValue = $this->delivery_room->CurrentValue;
        $this->delivery_room->ViewCustomAttributes = "";

        // delivery_notes
        $this->delivery_notes->ViewValue = $this->delivery_notes->CurrentValue;
        $this->delivery_notes->ViewCustomAttributes = "";

        // onsite_name
        $this->onsite_name->ViewValue = $this->onsite_name->CurrentValue;
        $this->onsite_name->ViewCustomAttributes = "";

        // onsite_email
        $this->onsite_email->ViewValue = $this->onsite_email->CurrentValue;
        $this->onsite_email->ViewCustomAttributes = "";

        // onsite_phone
        $this->onsite_phone->ViewValue = $this->onsite_phone->CurrentValue;
        $this->onsite_phone->ViewCustomAttributes = "";

        // customer_name
        $this->customer_name->ViewValue = $this->customer_name->CurrentValue;
        $this->customer_name->ViewCustomAttributes = "";

        // customer_phone
        $this->customer_phone->ViewValue = $this->customer_phone->CurrentValue;
        $this->customer_phone->ViewCustomAttributes = "";

        // customer_email
        $this->customer_email->ViewValue = $this->customer_email->CurrentValue;
        $this->customer_email->ViewCustomAttributes = "";

        // payment_method
        $this->payment_method->ViewValue = $this->payment_method->CurrentValue;
        $this->payment_method->ViewCustomAttributes = "";

        // account_num
        $this->account_num->ViewValue = $this->account_num->CurrentValue;
        $this->account_num->ViewCustomAttributes = "";

        // sub_code
        $this->sub_code->ViewValue = $this->sub_code->CurrentValue;
        $this->sub_code->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // order
        $this->order->ViewValue = $this->order->CurrentValue;
        $this->order->ViewCustomAttributes = "";

        // timestamp
        $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
        $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
        $this->timestamp->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // location
        $this->location->LinkCustomAttributes = "";
        $this->location->HrefValue = "";
        $this->location->TooltipValue = "";

        // method
        $this->method->LinkCustomAttributes = "";
        $this->method->HrefValue = "";
        $this->method->TooltipValue = "";

        // delivery_date
        $this->delivery_date->LinkCustomAttributes = "";
        $this->delivery_date->HrefValue = "";
        $this->delivery_date->TooltipValue = "";

        // delivery_time
        $this->delivery_time->LinkCustomAttributes = "";
        $this->delivery_time->HrefValue = "";
        $this->delivery_time->TooltipValue = "";

        // delivery_building
        $this->delivery_building->LinkCustomAttributes = "";
        $this->delivery_building->HrefValue = "";
        $this->delivery_building->TooltipValue = "";

        // delivery_room
        $this->delivery_room->LinkCustomAttributes = "";
        $this->delivery_room->HrefValue = "";
        $this->delivery_room->TooltipValue = "";

        // delivery_notes
        $this->delivery_notes->LinkCustomAttributes = "";
        $this->delivery_notes->HrefValue = "";
        $this->delivery_notes->TooltipValue = "";

        // onsite_name
        $this->onsite_name->LinkCustomAttributes = "";
        $this->onsite_name->HrefValue = "";
        $this->onsite_name->TooltipValue = "";

        // onsite_email
        $this->onsite_email->LinkCustomAttributes = "";
        $this->onsite_email->HrefValue = "";
        $this->onsite_email->TooltipValue = "";

        // onsite_phone
        $this->onsite_phone->LinkCustomAttributes = "";
        $this->onsite_phone->HrefValue = "";
        $this->onsite_phone->TooltipValue = "";

        // customer_name
        $this->customer_name->LinkCustomAttributes = "";
        $this->customer_name->HrefValue = "";
        $this->customer_name->TooltipValue = "";

        // customer_phone
        $this->customer_phone->LinkCustomAttributes = "";
        $this->customer_phone->HrefValue = "";
        $this->customer_phone->TooltipValue = "";

        // customer_email
        $this->customer_email->LinkCustomAttributes = "";
        $this->customer_email->HrefValue = "";
        $this->customer_email->TooltipValue = "";

        // payment_method
        $this->payment_method->LinkCustomAttributes = "";
        $this->payment_method->HrefValue = "";
        $this->payment_method->TooltipValue = "";

        // account_num
        $this->account_num->LinkCustomAttributes = "";
        $this->account_num->HrefValue = "";
        $this->account_num->TooltipValue = "";

        // sub_code
        $this->sub_code->LinkCustomAttributes = "";
        $this->sub_code->HrefValue = "";
        $this->sub_code->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // order
        $this->order->LinkCustomAttributes = "";
        $this->order->HrefValue = "";
        $this->order->TooltipValue = "";

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

        // location
        $this->location->EditAttrs["class"] = "form-control";
        $this->location->EditCustomAttributes = "";
        if (!$this->location->Raw) {
            $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
        }
        $this->location->EditValue = $this->location->CurrentValue;
        $this->location->PlaceHolder = RemoveHtml($this->location->caption());

        // method
        $this->method->EditAttrs["class"] = "form-control";
        $this->method->EditCustomAttributes = "";
        if (!$this->method->Raw) {
            $this->method->CurrentValue = HtmlDecode($this->method->CurrentValue);
        }
        $this->method->EditValue = $this->method->CurrentValue;
        $this->method->PlaceHolder = RemoveHtml($this->method->caption());

        // delivery_date
        $this->delivery_date->EditAttrs["class"] = "form-control";
        $this->delivery_date->EditCustomAttributes = "";
        $this->delivery_date->EditValue = FormatDateTime($this->delivery_date->CurrentValue, 8);
        $this->delivery_date->PlaceHolder = RemoveHtml($this->delivery_date->caption());

        // delivery_time
        $this->delivery_time->EditAttrs["class"] = "form-control";
        $this->delivery_time->EditCustomAttributes = "";
        if (!$this->delivery_time->Raw) {
            $this->delivery_time->CurrentValue = HtmlDecode($this->delivery_time->CurrentValue);
        }
        $this->delivery_time->EditValue = $this->delivery_time->CurrentValue;
        $this->delivery_time->PlaceHolder = RemoveHtml($this->delivery_time->caption());

        // delivery_building
        $this->delivery_building->EditAttrs["class"] = "form-control";
        $this->delivery_building->EditCustomAttributes = "";
        if (!$this->delivery_building->Raw) {
            $this->delivery_building->CurrentValue = HtmlDecode($this->delivery_building->CurrentValue);
        }
        $this->delivery_building->EditValue = $this->delivery_building->CurrentValue;
        $this->delivery_building->PlaceHolder = RemoveHtml($this->delivery_building->caption());

        // delivery_room
        $this->delivery_room->EditAttrs["class"] = "form-control";
        $this->delivery_room->EditCustomAttributes = "";
        if (!$this->delivery_room->Raw) {
            $this->delivery_room->CurrentValue = HtmlDecode($this->delivery_room->CurrentValue);
        }
        $this->delivery_room->EditValue = $this->delivery_room->CurrentValue;
        $this->delivery_room->PlaceHolder = RemoveHtml($this->delivery_room->caption());

        // delivery_notes
        $this->delivery_notes->EditAttrs["class"] = "form-control";
        $this->delivery_notes->EditCustomAttributes = "";
        $this->delivery_notes->EditValue = $this->delivery_notes->CurrentValue;
        $this->delivery_notes->PlaceHolder = RemoveHtml($this->delivery_notes->caption());

        // onsite_name
        $this->onsite_name->EditAttrs["class"] = "form-control";
        $this->onsite_name->EditCustomAttributes = "";
        if (!$this->onsite_name->Raw) {
            $this->onsite_name->CurrentValue = HtmlDecode($this->onsite_name->CurrentValue);
        }
        $this->onsite_name->EditValue = $this->onsite_name->CurrentValue;
        $this->onsite_name->PlaceHolder = RemoveHtml($this->onsite_name->caption());

        // onsite_email
        $this->onsite_email->EditAttrs["class"] = "form-control";
        $this->onsite_email->EditCustomAttributes = "";
        if (!$this->onsite_email->Raw) {
            $this->onsite_email->CurrentValue = HtmlDecode($this->onsite_email->CurrentValue);
        }
        $this->onsite_email->EditValue = $this->onsite_email->CurrentValue;
        $this->onsite_email->PlaceHolder = RemoveHtml($this->onsite_email->caption());

        // onsite_phone
        $this->onsite_phone->EditAttrs["class"] = "form-control";
        $this->onsite_phone->EditCustomAttributes = "";
        if (!$this->onsite_phone->Raw) {
            $this->onsite_phone->CurrentValue = HtmlDecode($this->onsite_phone->CurrentValue);
        }
        $this->onsite_phone->EditValue = $this->onsite_phone->CurrentValue;
        $this->onsite_phone->PlaceHolder = RemoveHtml($this->onsite_phone->caption());

        // customer_name
        $this->customer_name->EditAttrs["class"] = "form-control";
        $this->customer_name->EditCustomAttributes = "";
        if (!$this->customer_name->Raw) {
            $this->customer_name->CurrentValue = HtmlDecode($this->customer_name->CurrentValue);
        }
        $this->customer_name->EditValue = $this->customer_name->CurrentValue;
        $this->customer_name->PlaceHolder = RemoveHtml($this->customer_name->caption());

        // customer_phone
        $this->customer_phone->EditAttrs["class"] = "form-control";
        $this->customer_phone->EditCustomAttributes = "";
        if (!$this->customer_phone->Raw) {
            $this->customer_phone->CurrentValue = HtmlDecode($this->customer_phone->CurrentValue);
        }
        $this->customer_phone->EditValue = $this->customer_phone->CurrentValue;
        $this->customer_phone->PlaceHolder = RemoveHtml($this->customer_phone->caption());

        // customer_email
        $this->customer_email->EditAttrs["class"] = "form-control";
        $this->customer_email->EditCustomAttributes = "";
        if (!$this->customer_email->Raw) {
            $this->customer_email->CurrentValue = HtmlDecode($this->customer_email->CurrentValue);
        }
        $this->customer_email->EditValue = $this->customer_email->CurrentValue;
        $this->customer_email->PlaceHolder = RemoveHtml($this->customer_email->caption());

        // payment_method
        $this->payment_method->EditAttrs["class"] = "form-control";
        $this->payment_method->EditCustomAttributes = "";
        if (!$this->payment_method->Raw) {
            $this->payment_method->CurrentValue = HtmlDecode($this->payment_method->CurrentValue);
        }
        $this->payment_method->EditValue = $this->payment_method->CurrentValue;
        $this->payment_method->PlaceHolder = RemoveHtml($this->payment_method->caption());

        // account_num
        $this->account_num->EditAttrs["class"] = "form-control";
        $this->account_num->EditCustomAttributes = "";
        if (!$this->account_num->Raw) {
            $this->account_num->CurrentValue = HtmlDecode($this->account_num->CurrentValue);
        }
        $this->account_num->EditValue = $this->account_num->CurrentValue;
        $this->account_num->PlaceHolder = RemoveHtml($this->account_num->caption());

        // sub_code
        $this->sub_code->EditAttrs["class"] = "form-control";
        $this->sub_code->EditCustomAttributes = "";
        if (!$this->sub_code->Raw) {
            $this->sub_code->CurrentValue = HtmlDecode($this->sub_code->CurrentValue);
        }
        $this->sub_code->EditValue = $this->sub_code->CurrentValue;
        $this->sub_code->PlaceHolder = RemoveHtml($this->sub_code->caption());

        // status
        $this->status->EditAttrs["class"] = "form-control";
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // order
        $this->order->EditAttrs["class"] = "form-control";
        $this->order->EditCustomAttributes = "";
        $this->order->EditValue = $this->order->CurrentValue;
        $this->order->PlaceHolder = RemoveHtml($this->order->caption());

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
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->method);
                    $doc->exportCaption($this->delivery_date);
                    $doc->exportCaption($this->delivery_time);
                    $doc->exportCaption($this->delivery_building);
                    $doc->exportCaption($this->delivery_room);
                    $doc->exportCaption($this->delivery_notes);
                    $doc->exportCaption($this->onsite_name);
                    $doc->exportCaption($this->onsite_email);
                    $doc->exportCaption($this->onsite_phone);
                    $doc->exportCaption($this->customer_name);
                    $doc->exportCaption($this->customer_phone);
                    $doc->exportCaption($this->customer_email);
                    $doc->exportCaption($this->payment_method);
                    $doc->exportCaption($this->account_num);
                    $doc->exportCaption($this->sub_code);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->order);
                    $doc->exportCaption($this->timestamp);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->method);
                    $doc->exportCaption($this->delivery_date);
                    $doc->exportCaption($this->delivery_time);
                    $doc->exportCaption($this->delivery_building);
                    $doc->exportCaption($this->delivery_room);
                    $doc->exportCaption($this->onsite_name);
                    $doc->exportCaption($this->onsite_email);
                    $doc->exportCaption($this->onsite_phone);
                    $doc->exportCaption($this->customer_name);
                    $doc->exportCaption($this->customer_phone);
                    $doc->exportCaption($this->customer_email);
                    $doc->exportCaption($this->payment_method);
                    $doc->exportCaption($this->account_num);
                    $doc->exportCaption($this->sub_code);
                    $doc->exportCaption($this->status);
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
                        $doc->exportField($this->location);
                        $doc->exportField($this->method);
                        $doc->exportField($this->delivery_date);
                        $doc->exportField($this->delivery_time);
                        $doc->exportField($this->delivery_building);
                        $doc->exportField($this->delivery_room);
                        $doc->exportField($this->delivery_notes);
                        $doc->exportField($this->onsite_name);
                        $doc->exportField($this->onsite_email);
                        $doc->exportField($this->onsite_phone);
                        $doc->exportField($this->customer_name);
                        $doc->exportField($this->customer_phone);
                        $doc->exportField($this->customer_email);
                        $doc->exportField($this->payment_method);
                        $doc->exportField($this->account_num);
                        $doc->exportField($this->sub_code);
                        $doc->exportField($this->status);
                        $doc->exportField($this->order);
                        $doc->exportField($this->timestamp);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->location);
                        $doc->exportField($this->method);
                        $doc->exportField($this->delivery_date);
                        $doc->exportField($this->delivery_time);
                        $doc->exportField($this->delivery_building);
                        $doc->exportField($this->delivery_room);
                        $doc->exportField($this->onsite_name);
                        $doc->exportField($this->onsite_email);
                        $doc->exportField($this->onsite_phone);
                        $doc->exportField($this->customer_name);
                        $doc->exportField($this->customer_phone);
                        $doc->exportField($this->customer_email);
                        $doc->exportField($this->payment_method);
                        $doc->exportField($this->account_num);
                        $doc->exportField($this->sub_code);
                        $doc->exportField($this->status);
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
