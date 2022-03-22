<?php

namespace PHPMaker2022\mealplans;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for bursar_payment
 */
class BursarPayment extends DbTable
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
    public $bursar_id;
    public $emplid;
    public $subcode;
    public $term;
    public $bursars_amount;
    public $_response;
    public $item_nbr;
    public $line_seq_no;
    public $transaction_time;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'bursar_payment';
        $this->TableName = 'bursar_payment';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`bursar_payment`";
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

        // bursar_id
        $this->bursar_id = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_bursar_id',
            'bursar_id',
            '`bursar_id`',
            '`bursar_id`',
            3,
            11,
            -1,
            false,
            '`bursar_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->bursar_id->InputTextType = "text";
        $this->bursar_id->IsAutoIncrement = true; // Autoincrement field
        $this->bursar_id->IsPrimaryKey = true; // Primary key field
        $this->bursar_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['bursar_id'] = &$this->bursar_id;

        // emplid
        $this->emplid = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_emplid',
            'emplid',
            '`emplid`',
            '`emplid`',
            3,
            11,
            -1,
            false,
            '`emplid`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emplid->InputTextType = "text";
        $this->emplid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['emplid'] = &$this->emplid;

        // subcode
        $this->subcode = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_subcode',
            'subcode',
            '`subcode`',
            '`subcode`',
            200,
            20,
            -1,
            false,
            '`subcode`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->subcode->InputTextType = "text";
        $this->Fields['subcode'] = &$this->subcode;

        // term
        $this->term = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_term',
            'term',
            '`term`',
            '`term`',
            3,
            11,
            -1,
            false,
            '`term`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->term->InputTextType = "text";
        $this->term->Nullable = false; // NOT NULL field
        $this->term->Required = true; // Required field
        $this->term->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['term'] = &$this->term;

        // bursars_amount
        $this->bursars_amount = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_bursars_amount',
            'bursars_amount',
            '`bursars_amount`',
            '`bursars_amount`',
            131,
            15,
            -1,
            false,
            '`bursars_amount`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->bursars_amount->InputTextType = "text";
        $this->bursars_amount->Nullable = false; // NOT NULL field
        $this->bursars_amount->Required = true; // Required field
        $this->bursars_amount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['bursars_amount'] = &$this->bursars_amount;

        // response
        $this->_response = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x__response',
            'response',
            '`response`',
            '`response`',
            201,
            65535,
            -1,
            false,
            '`response`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->_response->InputTextType = "text";
        $this->Fields['response'] = &$this->_response;

        // item_nbr
        $this->item_nbr = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_item_nbr',
            'item_nbr',
            '`item_nbr`',
            '`item_nbr`',
            3,
            11,
            -1,
            false,
            '`item_nbr`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->item_nbr->InputTextType = "text";
        $this->item_nbr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['item_nbr'] = &$this->item_nbr;

        // line_seq_no
        $this->line_seq_no = new DbField(
            'bursar_payment',
            'bursar_payment',
            'x_line_seq_no',
            'line_seq_no',
            '`line_seq_no`',
            '`line_seq_no`',
            3,
            11,
            -1,
            false,
            '`line_seq_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->line_seq_no->InputTextType = "text";
        $this->line_seq_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['line_seq_no'] = &$this->line_seq_no;

        // transaction_time
        $this->transaction_time = new DbField(
            'bursar_payment',
            'bursar_payment',
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`bursar_payment`";
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
            $this->bursar_id->setDbValue($conn->lastInsertId());
            $rs['bursar_id'] = $this->bursar_id->DbValue;
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
            if (array_key_exists('bursar_id', $rs)) {
                AddFilter($where, QuotedName('bursar_id', $this->Dbid) . '=' . QuotedValue($rs['bursar_id'], $this->bursar_id->DataType, $this->Dbid));
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
        $this->bursar_id->DbValue = $row['bursar_id'];
        $this->emplid->DbValue = $row['emplid'];
        $this->subcode->DbValue = $row['subcode'];
        $this->term->DbValue = $row['term'];
        $this->bursars_amount->DbValue = $row['bursars_amount'];
        $this->_response->DbValue = $row['response'];
        $this->item_nbr->DbValue = $row['item_nbr'];
        $this->line_seq_no->DbValue = $row['line_seq_no'];
        $this->transaction_time->DbValue = $row['transaction_time'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`bursar_id` = @bursar_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->bursar_id->CurrentValue : $this->bursar_id->OldValue;
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
                $this->bursar_id->CurrentValue = $keys[0];
            } else {
                $this->bursar_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('bursar_id', $row) ? $row['bursar_id'] : null;
        } else {
            $val = $this->bursar_id->OldValue !== null ? $this->bursar_id->OldValue : $this->bursar_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@bursar_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("BursarPaymentList");
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
        if ($pageName == "BursarPaymentView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BursarPaymentEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BursarPaymentAdd") {
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
                return "BursarPaymentView";
            case Config("API_ADD_ACTION"):
                return "BursarPaymentAdd";
            case Config("API_EDIT_ACTION"):
                return "BursarPaymentEdit";
            case Config("API_DELETE_ACTION"):
                return "BursarPaymentDelete";
            case Config("API_LIST_ACTION"):
                return "BursarPaymentList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BursarPaymentList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BursarPaymentView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BursarPaymentView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BursarPaymentAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BursarPaymentAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BursarPaymentEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BursarPaymentAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BursarPaymentDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"bursar_id\":" . JsonEncode($this->bursar_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->bursar_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->bursar_id->CurrentValue);
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
            if (($keyValue = Param("bursar_id") ?? Route("bursar_id")) !== null) {
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
                $this->bursar_id->CurrentValue = $key;
            } else {
                $this->bursar_id->OldValue = $key;
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
        $this->bursar_id->setDbValue($row['bursar_id']);
        $this->emplid->setDbValue($row['emplid']);
        $this->subcode->setDbValue($row['subcode']);
        $this->term->setDbValue($row['term']);
        $this->bursars_amount->setDbValue($row['bursars_amount']);
        $this->_response->setDbValue($row['response']);
        $this->item_nbr->setDbValue($row['item_nbr']);
        $this->line_seq_no->setDbValue($row['line_seq_no']);
        $this->transaction_time->setDbValue($row['transaction_time']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // bursar_id

        // emplid

        // subcode

        // term

        // bursars_amount

        // response

        // item_nbr

        // line_seq_no

        // transaction_time

        // bursar_id
        $this->bursar_id->ViewValue = $this->bursar_id->CurrentValue;
        $this->bursar_id->ViewCustomAttributes = "";

        // emplid
        $this->emplid->ViewValue = $this->emplid->CurrentValue;
        $this->emplid->ViewValue = FormatNumber($this->emplid->ViewValue, "");
        $this->emplid->ViewCustomAttributes = "";

        // subcode
        $this->subcode->ViewValue = $this->subcode->CurrentValue;
        $this->subcode->ViewCustomAttributes = "";

        // term
        $this->term->ViewValue = $this->term->CurrentValue;
        $this->term->ViewValue = FormatNumber($this->term->ViewValue, "");
        $this->term->ViewCustomAttributes = "";

        // bursars_amount
        $this->bursars_amount->ViewValue = $this->bursars_amount->CurrentValue;
        $this->bursars_amount->ViewValue = FormatNumber($this->bursars_amount->ViewValue, "");
        $this->bursars_amount->ViewCustomAttributes = "";

        // response
        $this->_response->ViewValue = $this->_response->CurrentValue;
        $this->_response->ViewCustomAttributes = "";

        // item_nbr
        $this->item_nbr->ViewValue = $this->item_nbr->CurrentValue;
        $this->item_nbr->ViewValue = FormatNumber($this->item_nbr->ViewValue, "");
        $this->item_nbr->ViewCustomAttributes = "";

        // line_seq_no
        $this->line_seq_no->ViewValue = $this->line_seq_no->CurrentValue;
        $this->line_seq_no->ViewValue = FormatNumber($this->line_seq_no->ViewValue, "");
        $this->line_seq_no->ViewCustomAttributes = "";

        // transaction_time
        $this->transaction_time->ViewValue = $this->transaction_time->CurrentValue;
        $this->transaction_time->ViewValue = FormatDateTime($this->transaction_time->ViewValue, 0);
        $this->transaction_time->ViewCustomAttributes = "";

        // bursar_id
        $this->bursar_id->LinkCustomAttributes = "";
        $this->bursar_id->HrefValue = "";
        $this->bursar_id->TooltipValue = "";

        // emplid
        $this->emplid->LinkCustomAttributes = "";
        $this->emplid->HrefValue = "";
        $this->emplid->TooltipValue = "";

        // subcode
        $this->subcode->LinkCustomAttributes = "";
        $this->subcode->HrefValue = "";
        $this->subcode->TooltipValue = "";

        // term
        $this->term->LinkCustomAttributes = "";
        $this->term->HrefValue = "";
        $this->term->TooltipValue = "";

        // bursars_amount
        $this->bursars_amount->LinkCustomAttributes = "";
        $this->bursars_amount->HrefValue = "";
        $this->bursars_amount->TooltipValue = "";

        // response
        $this->_response->LinkCustomAttributes = "";
        $this->_response->HrefValue = "";
        $this->_response->TooltipValue = "";

        // item_nbr
        $this->item_nbr->LinkCustomAttributes = "";
        $this->item_nbr->HrefValue = "";
        $this->item_nbr->TooltipValue = "";

        // line_seq_no
        $this->line_seq_no->LinkCustomAttributes = "";
        $this->line_seq_no->HrefValue = "";
        $this->line_seq_no->TooltipValue = "";

        // transaction_time
        $this->transaction_time->LinkCustomAttributes = "";
        $this->transaction_time->HrefValue = "";
        $this->transaction_time->TooltipValue = "";

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

        // bursar_id
        $this->bursar_id->setupEditAttributes();
        $this->bursar_id->EditCustomAttributes = "";
        $this->bursar_id->EditValue = $this->bursar_id->CurrentValue;
        $this->bursar_id->ViewCustomAttributes = "";

        // emplid
        $this->emplid->setupEditAttributes();
        $this->emplid->EditCustomAttributes = "";
        $this->emplid->EditValue = $this->emplid->CurrentValue;
        $this->emplid->PlaceHolder = RemoveHtml($this->emplid->caption());
        if (strval($this->emplid->EditValue) != "" && is_numeric($this->emplid->EditValue)) {
            $this->emplid->EditValue = FormatNumber($this->emplid->EditValue, null);
        }

        // subcode
        $this->subcode->setupEditAttributes();
        $this->subcode->EditCustomAttributes = "";
        if (!$this->subcode->Raw) {
            $this->subcode->CurrentValue = HtmlDecode($this->subcode->CurrentValue);
        }
        $this->subcode->EditValue = $this->subcode->CurrentValue;
        $this->subcode->PlaceHolder = RemoveHtml($this->subcode->caption());

        // term
        $this->term->setupEditAttributes();
        $this->term->EditCustomAttributes = "";
        $this->term->EditValue = $this->term->CurrentValue;
        $this->term->PlaceHolder = RemoveHtml($this->term->caption());
        if (strval($this->term->EditValue) != "" && is_numeric($this->term->EditValue)) {
            $this->term->EditValue = FormatNumber($this->term->EditValue, null);
        }

        // bursars_amount
        $this->bursars_amount->setupEditAttributes();
        $this->bursars_amount->EditCustomAttributes = "";
        $this->bursars_amount->EditValue = $this->bursars_amount->CurrentValue;
        $this->bursars_amount->PlaceHolder = RemoveHtml($this->bursars_amount->caption());
        if (strval($this->bursars_amount->EditValue) != "" && is_numeric($this->bursars_amount->EditValue)) {
            $this->bursars_amount->EditValue = FormatNumber($this->bursars_amount->EditValue, null);
        }

        // response
        $this->_response->setupEditAttributes();
        $this->_response->EditCustomAttributes = "";
        $this->_response->EditValue = $this->_response->CurrentValue;
        $this->_response->PlaceHolder = RemoveHtml($this->_response->caption());

        // item_nbr
        $this->item_nbr->setupEditAttributes();
        $this->item_nbr->EditCustomAttributes = "";
        $this->item_nbr->EditValue = $this->item_nbr->CurrentValue;
        $this->item_nbr->PlaceHolder = RemoveHtml($this->item_nbr->caption());
        if (strval($this->item_nbr->EditValue) != "" && is_numeric($this->item_nbr->EditValue)) {
            $this->item_nbr->EditValue = FormatNumber($this->item_nbr->EditValue, null);
        }

        // line_seq_no
        $this->line_seq_no->setupEditAttributes();
        $this->line_seq_no->EditCustomAttributes = "";
        $this->line_seq_no->EditValue = $this->line_seq_no->CurrentValue;
        $this->line_seq_no->PlaceHolder = RemoveHtml($this->line_seq_no->caption());
        if (strval($this->line_seq_no->EditValue) != "" && is_numeric($this->line_seq_no->EditValue)) {
            $this->line_seq_no->EditValue = FormatNumber($this->line_seq_no->EditValue, null);
        }

        // transaction_time
        $this->transaction_time->setupEditAttributes();
        $this->transaction_time->EditCustomAttributes = "";
        $this->transaction_time->EditValue = FormatDateTime($this->transaction_time->CurrentValue, 8);
        $this->transaction_time->PlaceHolder = RemoveHtml($this->transaction_time->caption());

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
                    $doc->exportCaption($this->bursar_id);
                    $doc->exportCaption($this->emplid);
                    $doc->exportCaption($this->subcode);
                    $doc->exportCaption($this->term);
                    $doc->exportCaption($this->bursars_amount);
                    $doc->exportCaption($this->_response);
                    $doc->exportCaption($this->item_nbr);
                    $doc->exportCaption($this->line_seq_no);
                    $doc->exportCaption($this->transaction_time);
                } else {
                    $doc->exportCaption($this->bursar_id);
                    $doc->exportCaption($this->emplid);
                    $doc->exportCaption($this->subcode);
                    $doc->exportCaption($this->term);
                    $doc->exportCaption($this->bursars_amount);
                    $doc->exportCaption($this->item_nbr);
                    $doc->exportCaption($this->line_seq_no);
                    $doc->exportCaption($this->transaction_time);
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
                        $doc->exportField($this->bursar_id);
                        $doc->exportField($this->emplid);
                        $doc->exportField($this->subcode);
                        $doc->exportField($this->term);
                        $doc->exportField($this->bursars_amount);
                        $doc->exportField($this->_response);
                        $doc->exportField($this->item_nbr);
                        $doc->exportField($this->line_seq_no);
                        $doc->exportField($this->transaction_time);
                    } else {
                        $doc->exportField($this->bursar_id);
                        $doc->exportField($this->emplid);
                        $doc->exportField($this->subcode);
                        $doc->exportField($this->term);
                        $doc->exportField($this->bursars_amount);
                        $doc->exportField($this->item_nbr);
                        $doc->exportField($this->line_seq_no);
                        $doc->exportField($this->transaction_time);
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
