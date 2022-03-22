<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for charge_payment
 */
class ChargePayment extends DbTable
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
    public $charge_id;
    public $ch_first_name;
    public $ch_last_name;
    public $address;
    public $city;
    public $state;
    public $zipcode;
    public $card_type;
    public $expiration_month;
    public $expiration_year;
    public $cv_reply;
    public $charge_amount;
    public $order_number;
    public $account_number;
    public $decision;
    public $reason_code;
    public $transaction_time;
    public $ch_email;
    public $ch_phone;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'charge_payment';
        $this->TableName = 'charge_payment';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`charge_payment`";
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

        // charge_id
        $this->charge_id = new DbField(
            'charge_payment',
            'charge_payment',
            'x_charge_id',
            'charge_id',
            '`charge_id`',
            '`charge_id`',
            3,
            11,
            -1,
            false,
            '`charge_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->charge_id->InputTextType = "text";
        $this->charge_id->IsAutoIncrement = true; // Autoincrement field
        $this->charge_id->IsPrimaryKey = true; // Primary key field
        $this->charge_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['charge_id'] = &$this->charge_id;

        // ch_first_name
        $this->ch_first_name = new DbField(
            'charge_payment',
            'charge_payment',
            'x_ch_first_name',
            'ch_first_name',
            '`ch_first_name`',
            '`ch_first_name`',
            200,
            60,
            -1,
            false,
            '`ch_first_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ch_first_name->InputTextType = "text";
        $this->ch_first_name->Nullable = false; // NOT NULL field
        $this->ch_first_name->Required = true; // Required field
        $this->Fields['ch_first_name'] = &$this->ch_first_name;

        // ch_last_name
        $this->ch_last_name = new DbField(
            'charge_payment',
            'charge_payment',
            'x_ch_last_name',
            'ch_last_name',
            '`ch_last_name`',
            '`ch_last_name`',
            200,
            60,
            -1,
            false,
            '`ch_last_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ch_last_name->InputTextType = "text";
        $this->ch_last_name->Nullable = false; // NOT NULL field
        $this->ch_last_name->Required = true; // Required field
        $this->Fields['ch_last_name'] = &$this->ch_last_name;

        // address
        $this->address = new DbField(
            'charge_payment',
            'charge_payment',
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
            'charge_payment',
            'charge_payment',
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
            'charge_payment',
            'charge_payment',
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
            'charge_payment',
            'charge_payment',
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
            'charge_payment',
            'charge_payment',
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

        // expiration_month
        $this->expiration_month = new DbField(
            'charge_payment',
            'charge_payment',
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
            'charge_payment',
            'charge_payment',
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

        // cv_reply
        $this->cv_reply = new DbField(
            'charge_payment',
            'charge_payment',
            'x_cv_reply',
            'cv_reply',
            '`cv_reply`',
            '`cv_reply`',
            200,
            1,
            -1,
            false,
            '`cv_reply`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->cv_reply->InputTextType = "text";
        $this->cv_reply->Nullable = false; // NOT NULL field
        $this->cv_reply->Required = true; // Required field
        $this->Fields['cv_reply'] = &$this->cv_reply;

        // charge_amount
        $this->charge_amount = new DbField(
            'charge_payment',
            'charge_payment',
            'x_charge_amount',
            'charge_amount',
            '`charge_amount`',
            '`charge_amount`',
            131,
            15,
            -1,
            false,
            '`charge_amount`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->charge_amount->InputTextType = "text";
        $this->charge_amount->Nullable = false; // NOT NULL field
        $this->charge_amount->Required = true; // Required field
        $this->charge_amount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['charge_amount'] = &$this->charge_amount;

        // order_number
        $this->order_number = new DbField(
            'charge_payment',
            'charge_payment',
            'x_order_number',
            'order_number',
            '`order_number`',
            '`order_number`',
            200,
            50,
            -1,
            false,
            '`order_number`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->order_number->InputTextType = "text";
        $this->order_number->Nullable = false; // NOT NULL field
        $this->order_number->Required = true; // Required field
        $this->Fields['order_number'] = &$this->order_number;

        // account_number
        $this->account_number = new DbField(
            'charge_payment',
            'charge_payment',
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

        // decision
        $this->decision = new DbField(
            'charge_payment',
            'charge_payment',
            'x_decision',
            'decision',
            '`decision`',
            '`decision`',
            200,
            6,
            -1,
            false,
            '`decision`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->decision->InputTextType = "text";
        $this->decision->Nullable = false; // NOT NULL field
        $this->decision->Required = true; // Required field
        $this->Fields['decision'] = &$this->decision;

        // reason_code
        $this->reason_code = new DbField(
            'charge_payment',
            'charge_payment',
            'x_reason_code',
            'reason_code',
            '`reason_code`',
            '`reason_code`',
            3,
            11,
            -1,
            false,
            '`reason_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->reason_code->InputTextType = "text";
        $this->reason_code->Nullable = false; // NOT NULL field
        $this->reason_code->Required = true; // Required field
        $this->reason_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['reason_code'] = &$this->reason_code;

        // transaction_time
        $this->transaction_time = new DbField(
            'charge_payment',
            'charge_payment',
            'x_transaction_time',
            'transaction_time',
            '`transaction_time`',
            CastDateFieldForLike("`transaction_time`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`transaction_time`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->transaction_time->InputTextType = "text";
        $this->transaction_time->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['transaction_time'] = &$this->transaction_time;

        // ch_email
        $this->ch_email = new DbField(
            'charge_payment',
            'charge_payment',
            'x_ch_email',
            'ch_email',
            '`ch_email`',
            '`ch_email`',
            200,
            100,
            -1,
            false,
            '`ch_email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ch_email->InputTextType = "text";
        $this->ch_email->Nullable = false; // NOT NULL field
        $this->ch_email->Required = true; // Required field
        $this->Fields['ch_email'] = &$this->ch_email;

        // ch_phone
        $this->ch_phone = new DbField(
            'charge_payment',
            'charge_payment',
            'x_ch_phone',
            'ch_phone',
            '`ch_phone`',
            '`ch_phone`',
            200,
            15,
            -1,
            false,
            '`ch_phone`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ch_phone->InputTextType = "text";
        $this->ch_phone->Nullable = false; // NOT NULL field
        $this->ch_phone->Required = true; // Required field
        $this->Fields['ch_phone'] = &$this->ch_phone;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`charge_payment`";
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
            $this->charge_id->setDbValue($conn->lastInsertId());
            $rs['charge_id'] = $this->charge_id->DbValue;
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
            if (array_key_exists('charge_id', $rs)) {
                AddFilter($where, QuotedName('charge_id', $this->Dbid) . '=' . QuotedValue($rs['charge_id'], $this->charge_id->DataType, $this->Dbid));
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
        $this->charge_id->DbValue = $row['charge_id'];
        $this->ch_first_name->DbValue = $row['ch_first_name'];
        $this->ch_last_name->DbValue = $row['ch_last_name'];
        $this->address->DbValue = $row['address'];
        $this->city->DbValue = $row['city'];
        $this->state->DbValue = $row['state'];
        $this->zipcode->DbValue = $row['zipcode'];
        $this->card_type->DbValue = $row['card_type'];
        $this->expiration_month->DbValue = $row['expiration_month'];
        $this->expiration_year->DbValue = $row['expiration_year'];
        $this->cv_reply->DbValue = $row['cv_reply'];
        $this->charge_amount->DbValue = $row['charge_amount'];
        $this->order_number->DbValue = $row['order_number'];
        $this->account_number->DbValue = $row['account_number'];
        $this->decision->DbValue = $row['decision'];
        $this->reason_code->DbValue = $row['reason_code'];
        $this->transaction_time->DbValue = $row['transaction_time'];
        $this->ch_email->DbValue = $row['ch_email'];
        $this->ch_phone->DbValue = $row['ch_phone'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`charge_id` = @charge_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->charge_id->CurrentValue : $this->charge_id->OldValue;
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
                $this->charge_id->CurrentValue = $keys[0];
            } else {
                $this->charge_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('charge_id', $row) ? $row['charge_id'] : null;
        } else {
            $val = $this->charge_id->OldValue !== null ? $this->charge_id->OldValue : $this->charge_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@charge_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ChargePaymentList");
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
        if ($pageName == "ChargePaymentView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ChargePaymentEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ChargePaymentAdd") {
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
                return "ChargePaymentView";
            case Config("API_ADD_ACTION"):
                return "ChargePaymentAdd";
            case Config("API_EDIT_ACTION"):
                return "ChargePaymentEdit";
            case Config("API_DELETE_ACTION"):
                return "ChargePaymentDelete";
            case Config("API_LIST_ACTION"):
                return "ChargePaymentList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ChargePaymentList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ChargePaymentView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ChargePaymentView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ChargePaymentAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ChargePaymentAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ChargePaymentEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ChargePaymentAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ChargePaymentDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"charge_id\":" . JsonEncode($this->charge_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->charge_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->charge_id->CurrentValue);
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
            if (($keyValue = Param("charge_id") ?? Route("charge_id")) !== null) {
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
                $this->charge_id->CurrentValue = $key;
            } else {
                $this->charge_id->OldValue = $key;
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
        $this->charge_id->setDbValue($row['charge_id']);
        $this->ch_first_name->setDbValue($row['ch_first_name']);
        $this->ch_last_name->setDbValue($row['ch_last_name']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->state->setDbValue($row['state']);
        $this->zipcode->setDbValue($row['zipcode']);
        $this->card_type->setDbValue($row['card_type']);
        $this->expiration_month->setDbValue($row['expiration_month']);
        $this->expiration_year->setDbValue($row['expiration_year']);
        $this->cv_reply->setDbValue($row['cv_reply']);
        $this->charge_amount->setDbValue($row['charge_amount']);
        $this->order_number->setDbValue($row['order_number']);
        $this->account_number->setDbValue($row['account_number']);
        $this->decision->setDbValue($row['decision']);
        $this->reason_code->setDbValue($row['reason_code']);
        $this->transaction_time->setDbValue($row['transaction_time']);
        $this->ch_email->setDbValue($row['ch_email']);
        $this->ch_phone->setDbValue($row['ch_phone']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // charge_id

        // ch_first_name

        // ch_last_name

        // address

        // city

        // state

        // zipcode

        // card_type

        // expiration_month

        // expiration_year

        // cv_reply

        // charge_amount

        // order_number

        // account_number

        // decision

        // reason_code

        // transaction_time

        // ch_email

        // ch_phone

        // charge_id
        $this->charge_id->ViewValue = $this->charge_id->CurrentValue;
        $this->charge_id->ViewCustomAttributes = "";

        // ch_first_name
        $this->ch_first_name->ViewValue = $this->ch_first_name->CurrentValue;
        $this->ch_first_name->ViewCustomAttributes = "";

        // ch_last_name
        $this->ch_last_name->ViewValue = $this->ch_last_name->CurrentValue;
        $this->ch_last_name->ViewCustomAttributes = "";

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

        // expiration_month
        $this->expiration_month->ViewValue = $this->expiration_month->CurrentValue;
        $this->expiration_month->ViewValue = FormatNumber($this->expiration_month->ViewValue, "");
        $this->expiration_month->ViewCustomAttributes = "";

        // expiration_year
        $this->expiration_year->ViewValue = $this->expiration_year->CurrentValue;
        $this->expiration_year->ViewValue = FormatNumber($this->expiration_year->ViewValue, "");
        $this->expiration_year->ViewCustomAttributes = "";

        // cv_reply
        $this->cv_reply->ViewValue = $this->cv_reply->CurrentValue;
        $this->cv_reply->ViewCustomAttributes = "";

        // charge_amount
        $this->charge_amount->ViewValue = $this->charge_amount->CurrentValue;
        $this->charge_amount->ViewValue = FormatNumber($this->charge_amount->ViewValue, "");
        $this->charge_amount->ViewCustomAttributes = "";

        // order_number
        $this->order_number->ViewValue = $this->order_number->CurrentValue;
        $this->order_number->ViewCustomAttributes = "";

        // account_number
        $this->account_number->ViewValue = $this->account_number->CurrentValue;
        $this->account_number->ViewCustomAttributes = "";

        // decision
        $this->decision->ViewValue = $this->decision->CurrentValue;
        $this->decision->ViewCustomAttributes = "";

        // reason_code
        $this->reason_code->ViewValue = $this->reason_code->CurrentValue;
        $this->reason_code->ViewValue = FormatNumber($this->reason_code->ViewValue, "");
        $this->reason_code->ViewCustomAttributes = "";

        // transaction_time
        $this->transaction_time->ViewValue = $this->transaction_time->CurrentValue;
        $this->transaction_time->ViewValue = FormatDateTime($this->transaction_time->ViewValue, 0);
        $this->transaction_time->ViewCustomAttributes = "";

        // ch_email
        $this->ch_email->ViewValue = $this->ch_email->CurrentValue;
        $this->ch_email->ViewCustomAttributes = "";

        // ch_phone
        $this->ch_phone->ViewValue = $this->ch_phone->CurrentValue;
        $this->ch_phone->ViewCustomAttributes = "";

        // charge_id
        $this->charge_id->LinkCustomAttributes = "";
        $this->charge_id->HrefValue = "";
        $this->charge_id->TooltipValue = "";

        // ch_first_name
        $this->ch_first_name->LinkCustomAttributes = "";
        $this->ch_first_name->HrefValue = "";
        $this->ch_first_name->TooltipValue = "";

        // ch_last_name
        $this->ch_last_name->LinkCustomAttributes = "";
        $this->ch_last_name->HrefValue = "";
        $this->ch_last_name->TooltipValue = "";

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

        // expiration_month
        $this->expiration_month->LinkCustomAttributes = "";
        $this->expiration_month->HrefValue = "";
        $this->expiration_month->TooltipValue = "";

        // expiration_year
        $this->expiration_year->LinkCustomAttributes = "";
        $this->expiration_year->HrefValue = "";
        $this->expiration_year->TooltipValue = "";

        // cv_reply
        $this->cv_reply->LinkCustomAttributes = "";
        $this->cv_reply->HrefValue = "";
        $this->cv_reply->TooltipValue = "";

        // charge_amount
        $this->charge_amount->LinkCustomAttributes = "";
        $this->charge_amount->HrefValue = "";
        $this->charge_amount->TooltipValue = "";

        // order_number
        $this->order_number->LinkCustomAttributes = "";
        $this->order_number->HrefValue = "";
        $this->order_number->TooltipValue = "";

        // account_number
        $this->account_number->LinkCustomAttributes = "";
        $this->account_number->HrefValue = "";
        $this->account_number->TooltipValue = "";

        // decision
        $this->decision->LinkCustomAttributes = "";
        $this->decision->HrefValue = "";
        $this->decision->TooltipValue = "";

        // reason_code
        $this->reason_code->LinkCustomAttributes = "";
        $this->reason_code->HrefValue = "";
        $this->reason_code->TooltipValue = "";

        // transaction_time
        $this->transaction_time->LinkCustomAttributes = "";
        $this->transaction_time->HrefValue = "";
        $this->transaction_time->TooltipValue = "";

        // ch_email
        $this->ch_email->LinkCustomAttributes = "";
        $this->ch_email->HrefValue = "";
        $this->ch_email->TooltipValue = "";

        // ch_phone
        $this->ch_phone->LinkCustomAttributes = "";
        $this->ch_phone->HrefValue = "";
        $this->ch_phone->TooltipValue = "";

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

        // charge_id
        $this->charge_id->setupEditAttributes();
        $this->charge_id->EditCustomAttributes = "";
        $this->charge_id->EditValue = $this->charge_id->CurrentValue;
        $this->charge_id->ViewCustomAttributes = "";

        // ch_first_name
        $this->ch_first_name->setupEditAttributes();
        $this->ch_first_name->EditCustomAttributes = "";
        if (!$this->ch_first_name->Raw) {
            $this->ch_first_name->CurrentValue = HtmlDecode($this->ch_first_name->CurrentValue);
        }
        $this->ch_first_name->EditValue = $this->ch_first_name->CurrentValue;
        $this->ch_first_name->PlaceHolder = RemoveHtml($this->ch_first_name->caption());

        // ch_last_name
        $this->ch_last_name->setupEditAttributes();
        $this->ch_last_name->EditCustomAttributes = "";
        if (!$this->ch_last_name->Raw) {
            $this->ch_last_name->CurrentValue = HtmlDecode($this->ch_last_name->CurrentValue);
        }
        $this->ch_last_name->EditValue = $this->ch_last_name->CurrentValue;
        $this->ch_last_name->PlaceHolder = RemoveHtml($this->ch_last_name->caption());

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

        // cv_reply
        $this->cv_reply->setupEditAttributes();
        $this->cv_reply->EditCustomAttributes = "";
        if (!$this->cv_reply->Raw) {
            $this->cv_reply->CurrentValue = HtmlDecode($this->cv_reply->CurrentValue);
        }
        $this->cv_reply->EditValue = $this->cv_reply->CurrentValue;
        $this->cv_reply->PlaceHolder = RemoveHtml($this->cv_reply->caption());

        // charge_amount
        $this->charge_amount->setupEditAttributes();
        $this->charge_amount->EditCustomAttributes = "";
        $this->charge_amount->EditValue = $this->charge_amount->CurrentValue;
        $this->charge_amount->PlaceHolder = RemoveHtml($this->charge_amount->caption());
        if (strval($this->charge_amount->EditValue) != "" && is_numeric($this->charge_amount->EditValue)) {
            $this->charge_amount->EditValue = FormatNumber($this->charge_amount->EditValue, null);
        }

        // order_number
        $this->order_number->setupEditAttributes();
        $this->order_number->EditCustomAttributes = "";
        if (!$this->order_number->Raw) {
            $this->order_number->CurrentValue = HtmlDecode($this->order_number->CurrentValue);
        }
        $this->order_number->EditValue = $this->order_number->CurrentValue;
        $this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

        // account_number
        $this->account_number->setupEditAttributes();
        $this->account_number->EditCustomAttributes = "";
        if (!$this->account_number->Raw) {
            $this->account_number->CurrentValue = HtmlDecode($this->account_number->CurrentValue);
        }
        $this->account_number->EditValue = $this->account_number->CurrentValue;
        $this->account_number->PlaceHolder = RemoveHtml($this->account_number->caption());

        // decision
        $this->decision->setupEditAttributes();
        $this->decision->EditCustomAttributes = "";
        if (!$this->decision->Raw) {
            $this->decision->CurrentValue = HtmlDecode($this->decision->CurrentValue);
        }
        $this->decision->EditValue = $this->decision->CurrentValue;
        $this->decision->PlaceHolder = RemoveHtml($this->decision->caption());

        // reason_code
        $this->reason_code->setupEditAttributes();
        $this->reason_code->EditCustomAttributes = "";
        $this->reason_code->EditValue = $this->reason_code->CurrentValue;
        $this->reason_code->PlaceHolder = RemoveHtml($this->reason_code->caption());
        if (strval($this->reason_code->EditValue) != "" && is_numeric($this->reason_code->EditValue)) {
            $this->reason_code->EditValue = FormatNumber($this->reason_code->EditValue, null);
        }

        // transaction_time
        $this->transaction_time->setupEditAttributes();
        $this->transaction_time->EditCustomAttributes = "";
        $this->transaction_time->EditValue = FormatDateTime($this->transaction_time->CurrentValue, 8);
        $this->transaction_time->PlaceHolder = RemoveHtml($this->transaction_time->caption());

        // ch_email
        $this->ch_email->setupEditAttributes();
        $this->ch_email->EditCustomAttributes = "";
        if (!$this->ch_email->Raw) {
            $this->ch_email->CurrentValue = HtmlDecode($this->ch_email->CurrentValue);
        }
        $this->ch_email->EditValue = $this->ch_email->CurrentValue;
        $this->ch_email->PlaceHolder = RemoveHtml($this->ch_email->caption());

        // ch_phone
        $this->ch_phone->setupEditAttributes();
        $this->ch_phone->EditCustomAttributes = "";
        if (!$this->ch_phone->Raw) {
            $this->ch_phone->CurrentValue = HtmlDecode($this->ch_phone->CurrentValue);
        }
        $this->ch_phone->EditValue = $this->ch_phone->CurrentValue;
        $this->ch_phone->PlaceHolder = RemoveHtml($this->ch_phone->caption());

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
                    $doc->exportCaption($this->charge_id);
                    $doc->exportCaption($this->ch_first_name);
                    $doc->exportCaption($this->ch_last_name);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->state);
                    $doc->exportCaption($this->zipcode);
                    $doc->exportCaption($this->card_type);
                    $doc->exportCaption($this->expiration_month);
                    $doc->exportCaption($this->expiration_year);
                    $doc->exportCaption($this->cv_reply);
                    $doc->exportCaption($this->charge_amount);
                    $doc->exportCaption($this->order_number);
                    $doc->exportCaption($this->account_number);
                    $doc->exportCaption($this->decision);
                    $doc->exportCaption($this->reason_code);
                    $doc->exportCaption($this->transaction_time);
                    $doc->exportCaption($this->ch_email);
                    $doc->exportCaption($this->ch_phone);
                } else {
                    $doc->exportCaption($this->charge_id);
                    $doc->exportCaption($this->ch_first_name);
                    $doc->exportCaption($this->ch_last_name);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->state);
                    $doc->exportCaption($this->zipcode);
                    $doc->exportCaption($this->card_type);
                    $doc->exportCaption($this->expiration_month);
                    $doc->exportCaption($this->expiration_year);
                    $doc->exportCaption($this->cv_reply);
                    $doc->exportCaption($this->charge_amount);
                    $doc->exportCaption($this->order_number);
                    $doc->exportCaption($this->account_number);
                    $doc->exportCaption($this->decision);
                    $doc->exportCaption($this->reason_code);
                    $doc->exportCaption($this->transaction_time);
                    $doc->exportCaption($this->ch_email);
                    $doc->exportCaption($this->ch_phone);
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
                        $doc->exportField($this->charge_id);
                        $doc->exportField($this->ch_first_name);
                        $doc->exportField($this->ch_last_name);
                        $doc->exportField($this->address);
                        $doc->exportField($this->city);
                        $doc->exportField($this->state);
                        $doc->exportField($this->zipcode);
                        $doc->exportField($this->card_type);
                        $doc->exportField($this->expiration_month);
                        $doc->exportField($this->expiration_year);
                        $doc->exportField($this->cv_reply);
                        $doc->exportField($this->charge_amount);
                        $doc->exportField($this->order_number);
                        $doc->exportField($this->account_number);
                        $doc->exportField($this->decision);
                        $doc->exportField($this->reason_code);
                        $doc->exportField($this->transaction_time);
                        $doc->exportField($this->ch_email);
                        $doc->exportField($this->ch_phone);
                    } else {
                        $doc->exportField($this->charge_id);
                        $doc->exportField($this->ch_first_name);
                        $doc->exportField($this->ch_last_name);
                        $doc->exportField($this->address);
                        $doc->exportField($this->city);
                        $doc->exportField($this->state);
                        $doc->exportField($this->zipcode);
                        $doc->exportField($this->card_type);
                        $doc->exportField($this->expiration_month);
                        $doc->exportField($this->expiration_year);
                        $doc->exportField($this->cv_reply);
                        $doc->exportField($this->charge_amount);
                        $doc->exportField($this->order_number);
                        $doc->exportField($this->account_number);
                        $doc->exportField($this->decision);
                        $doc->exportField($this->reason_code);
                        $doc->exportField($this->transaction_time);
                        $doc->exportField($this->ch_email);
                        $doc->exportField($this->ch_phone);
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
