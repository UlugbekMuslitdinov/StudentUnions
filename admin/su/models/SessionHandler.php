<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for session_handler
 */
class SessionHandler extends DbTable
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
    public $custnum;
    public $cust_id;
    public $netid;
    public $firstname;
    public $lastname;
    public $mp_state;
    public $deposit_to;
    public $iso;
    public $activestudent;
    public $activeemployee;
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
        $this->TableVar = 'session_handler';
        $this->TableName = 'session_handler';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`session_handler`";
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
        $this->id = new DbField('session_handler', 'session_handler', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // custnum
        $this->custnum = new DbField('session_handler', 'session_handler', 'x_custnum', 'custnum', '`custnum`', '`custnum`', 3, 11, -1, false, '`custnum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->custnum->Sortable = true; // Allow sort
        $this->custnum->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['custnum'] = &$this->custnum;

        // cust_id
        $this->cust_id = new DbField('session_handler', 'session_handler', 'x_cust_id', 'cust_id', '`cust_id`', '`cust_id`', 3, 11, -1, false, '`cust_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->cust_id->Sortable = true; // Allow sort
        $this->cust_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['cust_id'] = &$this->cust_id;

        // netid
        $this->netid = new DbField('session_handler', 'session_handler', 'x_netid', 'netid', '`netid`', '`netid`', 200, 45, -1, false, '`netid`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->netid->Sortable = true; // Allow sort
        $this->Fields['netid'] = &$this->netid;

        // firstname
        $this->firstname = new DbField('session_handler', 'session_handler', 'x_firstname', 'firstname', '`firstname`', '`firstname`', 200, 45, -1, false, '`firstname`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->firstname->Sortable = true; // Allow sort
        $this->Fields['firstname'] = &$this->firstname;

        // lastname
        $this->lastname = new DbField('session_handler', 'session_handler', 'x_lastname', 'lastname', '`lastname`', '`lastname`', 200, 45, -1, false, '`lastname`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lastname->Sortable = true; // Allow sort
        $this->Fields['lastname'] = &$this->lastname;

        // mp_state
        $this->mp_state = new DbField('session_handler', 'session_handler', 'x_mp_state', 'mp_state', '`mp_state`', '`mp_state`', 200, 45, -1, false, '`mp_state`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->mp_state->Sortable = true; // Allow sort
        $this->Fields['mp_state'] = &$this->mp_state;

        // deposit_to
        $this->deposit_to = new DbField('session_handler', 'session_handler', 'x_deposit_to', 'deposit_to', '`deposit_to`', '`deposit_to`', 16, 1, -1, false, '`deposit_to`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->deposit_to->Sortable = true; // Allow sort
        $this->deposit_to->DataType = DATATYPE_BOOLEAN;
        $this->deposit_to->Lookup = new Lookup('deposit_to', 'session_handler', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->deposit_to->OptionCount = 2;
        $this->deposit_to->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['deposit_to'] = &$this->deposit_to;

        // iso
        $this->iso = new DbField('session_handler', 'session_handler', 'x_iso', 'iso', '`iso`', '`iso`', 200, 45, -1, false, '`iso`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->iso->Sortable = true; // Allow sort
        $this->Fields['iso'] = &$this->iso;

        // activestudent
        $this->activestudent = new DbField('session_handler', 'session_handler', 'x_activestudent', 'activestudent', '`activestudent`', '`activestudent`', 200, 10, -1, false, '`activestudent`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->activestudent->Sortable = true; // Allow sort
        $this->Fields['activestudent'] = &$this->activestudent;

        // activeemployee
        $this->activeemployee = new DbField('session_handler', 'session_handler', 'x_activeemployee', 'activeemployee', '`activeemployee`', '`activeemployee`', 200, 10, -1, false, '`activeemployee`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->activeemployee->Sortable = true; // Allow sort
        $this->Fields['activeemployee'] = &$this->activeemployee;

        // timestamp
        $this->timestamp = new DbField('session_handler', 'session_handler', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`session_handler`";
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
        $this->custnum->DbValue = $row['custnum'];
        $this->cust_id->DbValue = $row['cust_id'];
        $this->netid->DbValue = $row['netid'];
        $this->firstname->DbValue = $row['firstname'];
        $this->lastname->DbValue = $row['lastname'];
        $this->mp_state->DbValue = $row['mp_state'];
        $this->deposit_to->DbValue = $row['deposit_to'];
        $this->iso->DbValue = $row['iso'];
        $this->activestudent->DbValue = $row['activestudent'];
        $this->activeemployee->DbValue = $row['activeemployee'];
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
            return GetUrl("SessionHandlerList");
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
        if ($pageName == "SessionHandlerView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SessionHandlerEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SessionHandlerAdd") {
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
                return "SessionHandlerView";
            case Config("API_ADD_ACTION"):
                return "SessionHandlerAdd";
            case Config("API_EDIT_ACTION"):
                return "SessionHandlerEdit";
            case Config("API_DELETE_ACTION"):
                return "SessionHandlerDelete";
            case Config("API_LIST_ACTION"):
                return "SessionHandlerList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SessionHandlerList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SessionHandlerView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SessionHandlerView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SessionHandlerAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SessionHandlerAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SessionHandlerEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SessionHandlerAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("SessionHandlerDelete", $this->getUrlParm());
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
        $this->custnum->setDbValue($row['custnum']);
        $this->cust_id->setDbValue($row['cust_id']);
        $this->netid->setDbValue($row['netid']);
        $this->firstname->setDbValue($row['firstname']);
        $this->lastname->setDbValue($row['lastname']);
        $this->mp_state->setDbValue($row['mp_state']);
        $this->deposit_to->setDbValue($row['deposit_to']);
        $this->iso->setDbValue($row['iso']);
        $this->activestudent->setDbValue($row['activestudent']);
        $this->activeemployee->setDbValue($row['activeemployee']);
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

        // custnum

        // cust_id

        // netid

        // firstname

        // lastname

        // mp_state

        // deposit_to

        // iso

        // activestudent

        // activeemployee

        // timestamp

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // custnum
        $this->custnum->ViewValue = $this->custnum->CurrentValue;
        $this->custnum->ViewValue = FormatNumber($this->custnum->ViewValue, 0, -2, -2, -2);
        $this->custnum->ViewCustomAttributes = "";

        // cust_id
        $this->cust_id->ViewValue = $this->cust_id->CurrentValue;
        $this->cust_id->ViewValue = FormatNumber($this->cust_id->ViewValue, 0, -2, -2, -2);
        $this->cust_id->ViewCustomAttributes = "";

        // netid
        $this->netid->ViewValue = $this->netid->CurrentValue;
        $this->netid->ViewCustomAttributes = "";

        // firstname
        $this->firstname->ViewValue = $this->firstname->CurrentValue;
        $this->firstname->ViewCustomAttributes = "";

        // lastname
        $this->lastname->ViewValue = $this->lastname->CurrentValue;
        $this->lastname->ViewCustomAttributes = "";

        // mp_state
        $this->mp_state->ViewValue = $this->mp_state->CurrentValue;
        $this->mp_state->ViewCustomAttributes = "";

        // deposit_to
        if (ConvertToBool($this->deposit_to->CurrentValue)) {
            $this->deposit_to->ViewValue = $this->deposit_to->tagCaption(1) != "" ? $this->deposit_to->tagCaption(1) : "Yes";
        } else {
            $this->deposit_to->ViewValue = $this->deposit_to->tagCaption(2) != "" ? $this->deposit_to->tagCaption(2) : "No";
        }
        $this->deposit_to->ViewCustomAttributes = "";

        // iso
        $this->iso->ViewValue = $this->iso->CurrentValue;
        $this->iso->ViewCustomAttributes = "";

        // activestudent
        $this->activestudent->ViewValue = $this->activestudent->CurrentValue;
        $this->activestudent->ViewCustomAttributes = "";

        // activeemployee
        $this->activeemployee->ViewValue = $this->activeemployee->CurrentValue;
        $this->activeemployee->ViewCustomAttributes = "";

        // timestamp
        $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
        $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
        $this->timestamp->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // custnum
        $this->custnum->LinkCustomAttributes = "";
        $this->custnum->HrefValue = "";
        $this->custnum->TooltipValue = "";

        // cust_id
        $this->cust_id->LinkCustomAttributes = "";
        $this->cust_id->HrefValue = "";
        $this->cust_id->TooltipValue = "";

        // netid
        $this->netid->LinkCustomAttributes = "";
        $this->netid->HrefValue = "";
        $this->netid->TooltipValue = "";

        // firstname
        $this->firstname->LinkCustomAttributes = "";
        $this->firstname->HrefValue = "";
        $this->firstname->TooltipValue = "";

        // lastname
        $this->lastname->LinkCustomAttributes = "";
        $this->lastname->HrefValue = "";
        $this->lastname->TooltipValue = "";

        // mp_state
        $this->mp_state->LinkCustomAttributes = "";
        $this->mp_state->HrefValue = "";
        $this->mp_state->TooltipValue = "";

        // deposit_to
        $this->deposit_to->LinkCustomAttributes = "";
        $this->deposit_to->HrefValue = "";
        $this->deposit_to->TooltipValue = "";

        // iso
        $this->iso->LinkCustomAttributes = "";
        $this->iso->HrefValue = "";
        $this->iso->TooltipValue = "";

        // activestudent
        $this->activestudent->LinkCustomAttributes = "";
        $this->activestudent->HrefValue = "";
        $this->activestudent->TooltipValue = "";

        // activeemployee
        $this->activeemployee->LinkCustomAttributes = "";
        $this->activeemployee->HrefValue = "";
        $this->activeemployee->TooltipValue = "";

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

        // custnum
        $this->custnum->EditAttrs["class"] = "form-control";
        $this->custnum->EditCustomAttributes = "";
        $this->custnum->EditValue = $this->custnum->CurrentValue;
        $this->custnum->PlaceHolder = RemoveHtml($this->custnum->caption());

        // cust_id
        $this->cust_id->EditAttrs["class"] = "form-control";
        $this->cust_id->EditCustomAttributes = "";
        $this->cust_id->EditValue = $this->cust_id->CurrentValue;
        $this->cust_id->PlaceHolder = RemoveHtml($this->cust_id->caption());

        // netid
        $this->netid->EditAttrs["class"] = "form-control";
        $this->netid->EditCustomAttributes = "";
        if (!$this->netid->Raw) {
            $this->netid->CurrentValue = HtmlDecode($this->netid->CurrentValue);
        }
        $this->netid->EditValue = $this->netid->CurrentValue;
        $this->netid->PlaceHolder = RemoveHtml($this->netid->caption());

        // firstname
        $this->firstname->EditAttrs["class"] = "form-control";
        $this->firstname->EditCustomAttributes = "";
        if (!$this->firstname->Raw) {
            $this->firstname->CurrentValue = HtmlDecode($this->firstname->CurrentValue);
        }
        $this->firstname->EditValue = $this->firstname->CurrentValue;
        $this->firstname->PlaceHolder = RemoveHtml($this->firstname->caption());

        // lastname
        $this->lastname->EditAttrs["class"] = "form-control";
        $this->lastname->EditCustomAttributes = "";
        if (!$this->lastname->Raw) {
            $this->lastname->CurrentValue = HtmlDecode($this->lastname->CurrentValue);
        }
        $this->lastname->EditValue = $this->lastname->CurrentValue;
        $this->lastname->PlaceHolder = RemoveHtml($this->lastname->caption());

        // mp_state
        $this->mp_state->EditAttrs["class"] = "form-control";
        $this->mp_state->EditCustomAttributes = "";
        if (!$this->mp_state->Raw) {
            $this->mp_state->CurrentValue = HtmlDecode($this->mp_state->CurrentValue);
        }
        $this->mp_state->EditValue = $this->mp_state->CurrentValue;
        $this->mp_state->PlaceHolder = RemoveHtml($this->mp_state->caption());

        // deposit_to
        $this->deposit_to->EditCustomAttributes = "";
        $this->deposit_to->EditValue = $this->deposit_to->options(false);
        $this->deposit_to->PlaceHolder = RemoveHtml($this->deposit_to->caption());

        // iso
        $this->iso->EditAttrs["class"] = "form-control";
        $this->iso->EditCustomAttributes = "";
        if (!$this->iso->Raw) {
            $this->iso->CurrentValue = HtmlDecode($this->iso->CurrentValue);
        }
        $this->iso->EditValue = $this->iso->CurrentValue;
        $this->iso->PlaceHolder = RemoveHtml($this->iso->caption());

        // activestudent
        $this->activestudent->EditAttrs["class"] = "form-control";
        $this->activestudent->EditCustomAttributes = "";
        if (!$this->activestudent->Raw) {
            $this->activestudent->CurrentValue = HtmlDecode($this->activestudent->CurrentValue);
        }
        $this->activestudent->EditValue = $this->activestudent->CurrentValue;
        $this->activestudent->PlaceHolder = RemoveHtml($this->activestudent->caption());

        // activeemployee
        $this->activeemployee->EditAttrs["class"] = "form-control";
        $this->activeemployee->EditCustomAttributes = "";
        if (!$this->activeemployee->Raw) {
            $this->activeemployee->CurrentValue = HtmlDecode($this->activeemployee->CurrentValue);
        }
        $this->activeemployee->EditValue = $this->activeemployee->CurrentValue;
        $this->activeemployee->PlaceHolder = RemoveHtml($this->activeemployee->caption());

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
                    $doc->exportCaption($this->custnum);
                    $doc->exportCaption($this->cust_id);
                    $doc->exportCaption($this->netid);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->mp_state);
                    $doc->exportCaption($this->deposit_to);
                    $doc->exportCaption($this->iso);
                    $doc->exportCaption($this->activestudent);
                    $doc->exportCaption($this->activeemployee);
                    $doc->exportCaption($this->timestamp);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->custnum);
                    $doc->exportCaption($this->cust_id);
                    $doc->exportCaption($this->netid);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->mp_state);
                    $doc->exportCaption($this->deposit_to);
                    $doc->exportCaption($this->iso);
                    $doc->exportCaption($this->activestudent);
                    $doc->exportCaption($this->activeemployee);
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
                        $doc->exportField($this->custnum);
                        $doc->exportField($this->cust_id);
                        $doc->exportField($this->netid);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->mp_state);
                        $doc->exportField($this->deposit_to);
                        $doc->exportField($this->iso);
                        $doc->exportField($this->activestudent);
                        $doc->exportField($this->activeemployee);
                        $doc->exportField($this->timestamp);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->custnum);
                        $doc->exportField($this->cust_id);
                        $doc->exportField($this->netid);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->mp_state);
                        $doc->exportField($this->deposit_to);
                        $doc->exportField($this->iso);
                        $doc->exportField($this->activestudent);
                        $doc->exportField($this->activeemployee);
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
