<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for card_info
 */
class CardInfo extends DbTable
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
    public $card_id;
    public $cust_id;
    public $guest_id;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $state;
    public $zipcode;
    public $card_type;
    public $account_number;
    public $expiration_month;
    public $expiration_year;
    public $_email;
    public $phone;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'card_info';
        $this->TableName = 'card_info';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`card_info`";
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

        // card_id
        $this->card_id = new DbField(
            'card_info',
            'card_info',
            'x_card_id',
            'card_id',
            '`card_id`',
            '`card_id`',
            3,
            11,
            -1,
            false,
            '`card_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->card_id->InputTextType = "text";
        $this->card_id->IsAutoIncrement = true; // Autoincrement field
        $this->card_id->IsPrimaryKey = true; // Primary key field
        $this->card_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['card_id'] = &$this->card_id;

        // cust_id
        $this->cust_id = new DbField(
            'card_info',
            'card_info',
            'x_cust_id',
            'cust_id',
            '`cust_id`',
            '`cust_id`',
            3,
            11,
            -1,
            false,
            '`cust_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->cust_id->InputTextType = "text";
        $this->cust_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['cust_id'] = &$this->cust_id;

        // guest_id
        $this->guest_id = new DbField(
            'card_info',
            'card_info',
            'x_guest_id',
            'guest_id',
            '`guest_id`',
            '`guest_id`',
            3,
            11,
            -1,
            false,
            '`guest_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->guest_id->InputTextType = "text";
        $this->guest_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['guest_id'] = &$this->guest_id;

        // first_name
        $this->first_name = new DbField(
            'card_info',
            'card_info',
            'x_first_name',
            'first_name',
            '`first_name`',
            '`first_name`',
            200,
            60,
            -1,
            false,
            '`first_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->first_name->InputTextType = "text";
        $this->first_name->Nullable = false; // NOT NULL field
        $this->first_name->Required = true; // Required field
        $this->Fields['first_name'] = &$this->first_name;

        // last_name
        $this->last_name = new DbField(
            'card_info',
            'card_info',
            'x_last_name',
            'last_name',
            '`last_name`',
            '`last_name`',
            200,
            60,
            -1,
            false,
            '`last_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->last_name->InputTextType = "text";
        $this->last_name->Nullable = false; // NOT NULL field
        $this->last_name->Required = true; // Required field
        $this->Fields['last_name'] = &$this->last_name;

        // address
        $this->address = new DbField(
            'card_info',
            'card_info',
            'x_address',
            'address',
            '`address`',
            '`address`',
            200,
            60,
            -1,
            false,
            '`address`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->address->InputTextType = "text";
        $this->address->Nullable = false; // NOT NULL field
        $this->address->Required = true; // Required field
        $this->Fields['address'] = &$this->address;

        // city
        $this->city = new DbField(
            'card_info',
            'card_info',
            'x_city',
            'city',
            '`city`',
            '`city`',
            200,
            50,
            -1,
            false,
            '`city`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->city->InputTextType = "text";
        $this->city->Nullable = false; // NOT NULL field
        $this->city->Required = true; // Required field
        $this->Fields['city'] = &$this->city;

        // state
        $this->state = new DbField(
            'card_info',
            'card_info',
            'x_state',
            'state',
            '`state`',
            '`state`',
            200,
            2,
            -1,
            false,
            '`state`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->state->InputTextType = "text";
        $this->state->Nullable = false; // NOT NULL field
        $this->state->Required = true; // Required field
        $this->Fields['state'] = &$this->state;

        // zipcode
        $this->zipcode = new DbField(
            'card_info',
            'card_info',
            'x_zipcode',
            'zipcode',
            '`zipcode`',
            '`zipcode`',
            200,
            10,
            -1,
            false,
            '`zipcode`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->zipcode->InputTextType = "text";
        $this->zipcode->Nullable = false; // NOT NULL field
        $this->zipcode->Required = true; // Required field
        $this->Fields['zipcode'] = &$this->zipcode;

        // card_type
        $this->card_type = new DbField(
            'card_info',
            'card_info',
            'x_card_type',
            'card_type',
            '`card_type`',
            '`card_type`',
            200,
            3,
            -1,
            false,
            '`card_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->card_type->InputTextType = "text";
        $this->card_type->Nullable = false; // NOT NULL field
        $this->card_type->Required = true; // Required field
        $this->Fields['card_type'] = &$this->card_type;

        // account_number
        $this->account_number = new DbField(
            'card_info',
            'card_info',
            'x_account_number',
            'account_number',
            '`account_number`',
            '`account_number`',
            200,
            4,
            -1,
            false,
            '`account_number`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->account_number->InputTextType = "text";
        $this->account_number->Nullable = false; // NOT NULL field
        $this->account_number->Required = true; // Required field
        $this->Fields['account_number'] = &$this->account_number;

        // expiration_month
        $this->expiration_month = new DbField(
            'card_info',
            'card_info',
            'x_expiration_month',
            'expiration_month',
            '`expiration_month`',
            '`expiration_month`',
            3,
            11,
            -1,
            false,
            '`expiration_month`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->expiration_month->InputTextType = "text";
        $this->expiration_month->Nullable = false; // NOT NULL field
        $this->expiration_month->Required = true; // Required field
        $this->expiration_month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['expiration_month'] = &$this->expiration_month;

        // expiration_year
        $this->expiration_year = new DbField(
            'card_info',
            'card_info',
            'x_expiration_year',
            'expiration_year',
            '`expiration_year`',
            '`expiration_year`',
            3,
            11,
            -1,
            false,
            '`expiration_year`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->expiration_year->InputTextType = "text";
        $this->expiration_year->Nullable = false; // NOT NULL field
        $this->expiration_year->Required = true; // Required field
        $this->expiration_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['expiration_year'] = &$this->expiration_year;

        // email
        $this->_email = new DbField(
            'card_info',
            'card_info',
            'x__email',
            'email',
            '`email`',
            '`email`',
            200,
            100,
            -1,
            false,
            '`email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_email->InputTextType = "text";
        $this->Fields['email'] = &$this->_email;

        // phone
        $this->phone = new DbField(
            'card_info',
            'card_info',
            'x_phone',
            'phone',
            '`phone`',
            '`phone`',
            200,
            15,
            -1,
            false,
            '`phone`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->phone->InputTextType = "text";
        $this->Fields['phone'] = &$this->phone;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`card_info`";
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
            $this->card_id->setDbValue($conn->lastInsertId());
            $rs['card_id'] = $this->card_id->DbValue;
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
            if (array_key_exists('card_id', $rs)) {
                AddFilter($where, QuotedName('card_id', $this->Dbid) . '=' . QuotedValue($rs['card_id'], $this->card_id->DataType, $this->Dbid));
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
        $this->card_id->DbValue = $row['card_id'];
        $this->cust_id->DbValue = $row['cust_id'];
        $this->guest_id->DbValue = $row['guest_id'];
        $this->first_name->DbValue = $row['first_name'];
        $this->last_name->DbValue = $row['last_name'];
        $this->address->DbValue = $row['address'];
        $this->city->DbValue = $row['city'];
        $this->state->DbValue = $row['state'];
        $this->zipcode->DbValue = $row['zipcode'];
        $this->card_type->DbValue = $row['card_type'];
        $this->account_number->DbValue = $row['account_number'];
        $this->expiration_month->DbValue = $row['expiration_month'];
        $this->expiration_year->DbValue = $row['expiration_year'];
        $this->_email->DbValue = $row['email'];
        $this->phone->DbValue = $row['phone'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`card_id` = @card_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->card_id->CurrentValue : $this->card_id->OldValue;
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
                $this->card_id->CurrentValue = $keys[0];
            } else {
                $this->card_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('card_id', $row) ? $row['card_id'] : null;
        } else {
            $val = $this->card_id->OldValue !== null ? $this->card_id->OldValue : $this->card_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@card_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("CardInfoList");
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
        if ($pageName == "CardInfoView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CardInfoEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CardInfoAdd") {
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
                return "CardInfoView";
            case Config("API_ADD_ACTION"):
                return "CardInfoAdd";
            case Config("API_EDIT_ACTION"):
                return "CardInfoEdit";
            case Config("API_DELETE_ACTION"):
                return "CardInfoDelete";
            case Config("API_LIST_ACTION"):
                return "CardInfoList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CardInfoList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CardInfoView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CardInfoView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CardInfoAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CardInfoAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CardInfoEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CardInfoAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CardInfoDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"card_id\":" . JsonEncode($this->card_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->card_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->card_id->CurrentValue);
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
            if (($keyValue = Param("card_id") ?? Route("card_id")) !== null) {
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
                $this->card_id->CurrentValue = $key;
            } else {
                $this->card_id->OldValue = $key;
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
        $this->card_id->setDbValue($row['card_id']);
        $this->cust_id->setDbValue($row['cust_id']);
        $this->guest_id->setDbValue($row['guest_id']);
        $this->first_name->setDbValue($row['first_name']);
        $this->last_name->setDbValue($row['last_name']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->state->setDbValue($row['state']);
        $this->zipcode->setDbValue($row['zipcode']);
        $this->card_type->setDbValue($row['card_type']);
        $this->account_number->setDbValue($row['account_number']);
        $this->expiration_month->setDbValue($row['expiration_month']);
        $this->expiration_year->setDbValue($row['expiration_year']);
        $this->_email->setDbValue($row['email']);
        $this->phone->setDbValue($row['phone']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // card_id

        // cust_id

        // guest_id

        // first_name

        // last_name

        // address

        // city

        // state

        // zipcode

        // card_type

        // account_number

        // expiration_month

        // expiration_year

        // email

        // phone

        // card_id
        $this->card_id->ViewValue = $this->card_id->CurrentValue;
        $this->card_id->ViewCustomAttributes = "";

        // cust_id
        $this->cust_id->ViewValue = $this->cust_id->CurrentValue;
        $this->cust_id->ViewValue = FormatNumber($this->cust_id->ViewValue, "");
        $this->cust_id->ViewCustomAttributes = "";

        // guest_id
        $this->guest_id->ViewValue = $this->guest_id->CurrentValue;
        $this->guest_id->ViewValue = FormatNumber($this->guest_id->ViewValue, "");
        $this->guest_id->ViewCustomAttributes = "";

        // first_name
        $this->first_name->ViewValue = $this->first_name->CurrentValue;
        $this->first_name->ViewCustomAttributes = "";

        // last_name
        $this->last_name->ViewValue = $this->last_name->CurrentValue;
        $this->last_name->ViewCustomAttributes = "";

        // address
        $this->address->ViewValue = $this->address->CurrentValue;
        $this->address->ViewCustomAttributes = "";

        // city
        $this->city->ViewValue = $this->city->CurrentValue;
        $this->city->ViewCustomAttributes = "";

        // state
        $this->state->ViewValue = $this->state->CurrentValue;
        $this->state->ViewCustomAttributes = "";

        // zipcode
        $this->zipcode->ViewValue = $this->zipcode->CurrentValue;
        $this->zipcode->ViewCustomAttributes = "";

        // card_type
        $this->card_type->ViewValue = $this->card_type->CurrentValue;
        $this->card_type->ViewCustomAttributes = "";

        // account_number
        $this->account_number->ViewValue = $this->account_number->CurrentValue;
        $this->account_number->ViewCustomAttributes = "";

        // expiration_month
        $this->expiration_month->ViewValue = $this->expiration_month->CurrentValue;
        $this->expiration_month->ViewValue = FormatNumber($this->expiration_month->ViewValue, "");
        $this->expiration_month->ViewCustomAttributes = "";

        // expiration_year
        $this->expiration_year->ViewValue = $this->expiration_year->CurrentValue;
        $this->expiration_year->ViewValue = FormatNumber($this->expiration_year->ViewValue, "");
        $this->expiration_year->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // phone
        $this->phone->ViewValue = $this->phone->CurrentValue;
        $this->phone->ViewCustomAttributes = "";

        // card_id
        $this->card_id->LinkCustomAttributes = "";
        $this->card_id->HrefValue = "";
        $this->card_id->TooltipValue = "";

        // cust_id
        $this->cust_id->LinkCustomAttributes = "";
        $this->cust_id->HrefValue = "";
        $this->cust_id->TooltipValue = "";

        // guest_id
        $this->guest_id->LinkCustomAttributes = "";
        $this->guest_id->HrefValue = "";
        $this->guest_id->TooltipValue = "";

        // first_name
        $this->first_name->LinkCustomAttributes = "";
        $this->first_name->HrefValue = "";
        $this->first_name->TooltipValue = "";

        // last_name
        $this->last_name->LinkCustomAttributes = "";
        $this->last_name->HrefValue = "";
        $this->last_name->TooltipValue = "";

        // address
        $this->address->LinkCustomAttributes = "";
        $this->address->HrefValue = "";
        $this->address->TooltipValue = "";

        // city
        $this->city->LinkCustomAttributes = "";
        $this->city->HrefValue = "";
        $this->city->TooltipValue = "";

        // state
        $this->state->LinkCustomAttributes = "";
        $this->state->HrefValue = "";
        $this->state->TooltipValue = "";

        // zipcode
        $this->zipcode->LinkCustomAttributes = "";
        $this->zipcode->HrefValue = "";
        $this->zipcode->TooltipValue = "";

        // card_type
        $this->card_type->LinkCustomAttributes = "";
        $this->card_type->HrefValue = "";
        $this->card_type->TooltipValue = "";

        // account_number
        $this->account_number->LinkCustomAttributes = "";
        $this->account_number->HrefValue = "";
        $this->account_number->TooltipValue = "";

        // expiration_month
        $this->expiration_month->LinkCustomAttributes = "";
        $this->expiration_month->HrefValue = "";
        $this->expiration_month->TooltipValue = "";

        // expiration_year
        $this->expiration_year->LinkCustomAttributes = "";
        $this->expiration_year->HrefValue = "";
        $this->expiration_year->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // phone
        $this->phone->LinkCustomAttributes = "";
        $this->phone->HrefValue = "";
        $this->phone->TooltipValue = "";

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

        // card_id
        $this->card_id->setupEditAttributes();
        $this->card_id->EditCustomAttributes = "";
        $this->card_id->EditValue = $this->card_id->CurrentValue;
        $this->card_id->ViewCustomAttributes = "";

        // cust_id
        $this->cust_id->setupEditAttributes();
        $this->cust_id->EditCustomAttributes = "";
        $this->cust_id->EditValue = $this->cust_id->CurrentValue;
        $this->cust_id->PlaceHolder = RemoveHtml($this->cust_id->caption());
        if (strval($this->cust_id->EditValue) != "" && is_numeric($this->cust_id->EditValue)) {
            $this->cust_id->EditValue = FormatNumber($this->cust_id->EditValue, null);
        }

        // guest_id
        $this->guest_id->setupEditAttributes();
        $this->guest_id->EditCustomAttributes = "";
        $this->guest_id->EditValue = $this->guest_id->CurrentValue;
        $this->guest_id->PlaceHolder = RemoveHtml($this->guest_id->caption());
        if (strval($this->guest_id->EditValue) != "" && is_numeric($this->guest_id->EditValue)) {
            $this->guest_id->EditValue = FormatNumber($this->guest_id->EditValue, null);
        }

        // first_name
        $this->first_name->setupEditAttributes();
        $this->first_name->EditCustomAttributes = "";
        if (!$this->first_name->Raw) {
            $this->first_name->CurrentValue = HtmlDecode($this->first_name->CurrentValue);
        }
        $this->first_name->EditValue = $this->first_name->CurrentValue;
        $this->first_name->PlaceHolder = RemoveHtml($this->first_name->caption());

        // last_name
        $this->last_name->setupEditAttributes();
        $this->last_name->EditCustomAttributes = "";
        if (!$this->last_name->Raw) {
            $this->last_name->CurrentValue = HtmlDecode($this->last_name->CurrentValue);
        }
        $this->last_name->EditValue = $this->last_name->CurrentValue;
        $this->last_name->PlaceHolder = RemoveHtml($this->last_name->caption());

        // address
        $this->address->setupEditAttributes();
        $this->address->EditCustomAttributes = "";
        if (!$this->address->Raw) {
            $this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
        }
        $this->address->EditValue = $this->address->CurrentValue;
        $this->address->PlaceHolder = RemoveHtml($this->address->caption());

        // city
        $this->city->setupEditAttributes();
        $this->city->EditCustomAttributes = "";
        if (!$this->city->Raw) {
            $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
        }
        $this->city->EditValue = $this->city->CurrentValue;
        $this->city->PlaceHolder = RemoveHtml($this->city->caption());

        // state
        $this->state->setupEditAttributes();
        $this->state->EditCustomAttributes = "";
        if (!$this->state->Raw) {
            $this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
        }
        $this->state->EditValue = $this->state->CurrentValue;
        $this->state->PlaceHolder = RemoveHtml($this->state->caption());

        // zipcode
        $this->zipcode->setupEditAttributes();
        $this->zipcode->EditCustomAttributes = "";
        if (!$this->zipcode->Raw) {
            $this->zipcode->CurrentValue = HtmlDecode($this->zipcode->CurrentValue);
        }
        $this->zipcode->EditValue = $this->zipcode->CurrentValue;
        $this->zipcode->PlaceHolder = RemoveHtml($this->zipcode->caption());

        // card_type
        $this->card_type->setupEditAttributes();
        $this->card_type->EditCustomAttributes = "";
        if (!$this->card_type->Raw) {
            $this->card_type->CurrentValue = HtmlDecode($this->card_type->CurrentValue);
        }
        $this->card_type->EditValue = $this->card_type->CurrentValue;
        $this->card_type->PlaceHolder = RemoveHtml($this->card_type->caption());

        // account_number
        $this->account_number->setupEditAttributes();
        $this->account_number->EditCustomAttributes = "";
        if (!$this->account_number->Raw) {
            $this->account_number->CurrentValue = HtmlDecode($this->account_number->CurrentValue);
        }
        $this->account_number->EditValue = $this->account_number->CurrentValue;
        $this->account_number->PlaceHolder = RemoveHtml($this->account_number->caption());

        // expiration_month
        $this->expiration_month->setupEditAttributes();
        $this->expiration_month->EditCustomAttributes = "";
        $this->expiration_month->EditValue = $this->expiration_month->CurrentValue;
        $this->expiration_month->PlaceHolder = RemoveHtml($this->expiration_month->caption());
        if (strval($this->expiration_month->EditValue) != "" && is_numeric($this->expiration_month->EditValue)) {
            $this->expiration_month->EditValue = FormatNumber($this->expiration_month->EditValue, null);
        }

        // expiration_year
        $this->expiration_year->setupEditAttributes();
        $this->expiration_year->EditCustomAttributes = "";
        $this->expiration_year->EditValue = $this->expiration_year->CurrentValue;
        $this->expiration_year->PlaceHolder = RemoveHtml($this->expiration_year->caption());
        if (strval($this->expiration_year->EditValue) != "" && is_numeric($this->expiration_year->EditValue)) {
            $this->expiration_year->EditValue = FormatNumber($this->expiration_year->EditValue, null);
        }

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // phone
        $this->phone->setupEditAttributes();
        $this->phone->EditCustomAttributes = "";
        if (!$this->phone->Raw) {
            $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
        }
        $this->phone->EditValue = $this->phone->CurrentValue;
        $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

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
                    $doc->exportCaption($this->card_id);
                    $doc->exportCaption($this->cust_id);
                    $doc->exportCaption($this->guest_id);
                    $doc->exportCaption($this->first_name);
                    $doc->exportCaption($this->last_name);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->state);
                    $doc->exportCaption($this->zipcode);
                    $doc->exportCaption($this->card_type);
                    $doc->exportCaption($this->account_number);
                    $doc->exportCaption($this->expiration_month);
                    $doc->exportCaption($this->expiration_year);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->phone);
                } else {
                    $doc->exportCaption($this->card_id);
                    $doc->exportCaption($this->cust_id);
                    $doc->exportCaption($this->guest_id);
                    $doc->exportCaption($this->first_name);
                    $doc->exportCaption($this->last_name);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->state);
                    $doc->exportCaption($this->zipcode);
                    $doc->exportCaption($this->card_type);
                    $doc->exportCaption($this->account_number);
                    $doc->exportCaption($this->expiration_month);
                    $doc->exportCaption($this->expiration_year);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->phone);
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
                        $doc->exportField($this->card_id);
                        $doc->exportField($this->cust_id);
                        $doc->exportField($this->guest_id);
                        $doc->exportField($this->first_name);
                        $doc->exportField($this->last_name);
                        $doc->exportField($this->address);
                        $doc->exportField($this->city);
                        $doc->exportField($this->state);
                        $doc->exportField($this->zipcode);
                        $doc->exportField($this->card_type);
                        $doc->exportField($this->account_number);
                        $doc->exportField($this->expiration_month);
                        $doc->exportField($this->expiration_year);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->phone);
                    } else {
                        $doc->exportField($this->card_id);
                        $doc->exportField($this->cust_id);
                        $doc->exportField($this->guest_id);
                        $doc->exportField($this->first_name);
                        $doc->exportField($this->last_name);
                        $doc->exportField($this->address);
                        $doc->exportField($this->city);
                        $doc->exportField($this->state);
                        $doc->exportField($this->zipcode);
                        $doc->exportField($this->card_type);
                        $doc->exportField($this->account_number);
                        $doc->exportField($this->expiration_month);
                        $doc->exportField($this->expiration_year);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->phone);
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
