<?php

namespace PHPMaker2021\project4;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for print_logs
 */
class PrintLogs extends DbTable
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
    public $Time;
    public $User;
    public $Pages;
    public $Copies;
    public $Printer;
    public $DocumentName;
    public $Client;
    public $PaperSize;
    public $_Language;
    public $Height;
    public $Width;
    public $Duplex;
    public $Grayscale;
    public $Size;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'print_logs';
        $this->TableName = 'print_logs';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`print_logs`";
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

        // Time
        $this->Time = new DbField('print_logs', 'print_logs', 'x_Time', 'Time', '`Time`', '`Time`', 200, 19, -1, false, '`Time`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Time->Sortable = true; // Allow sort
        $this->Time->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Time->Param, "CustomMsg");
        $this->Fields['Time'] = &$this->Time;

        // User
        $this->User = new DbField('print_logs', 'print_logs', 'x_User', 'User', '`User`', '`User`', 200, 13, -1, false, '`User`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->User->Sortable = true; // Allow sort
        $this->User->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->User->Param, "CustomMsg");
        $this->Fields['User'] = &$this->User;

        // Pages
        $this->Pages = new DbField('print_logs', 'print_logs', 'x_Pages', 'Pages', '`Pages`', '`Pages`', 3, 2, -1, false, '`Pages`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Pages->Sortable = true; // Allow sort
        $this->Pages->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Pages->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pages->Param, "CustomMsg");
        $this->Fields['Pages'] = &$this->Pages;

        // Copies
        $this->Copies = new DbField('print_logs', 'print_logs', 'x_Copies', 'Copies', '`Copies`', '`Copies`', 3, 1, -1, false, '`Copies`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Copies->Sortable = true; // Allow sort
        $this->Copies->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Copies->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Copies->Param, "CustomMsg");
        $this->Fields['Copies'] = &$this->Copies;

        // Printer
        $this->Printer = new DbField('print_logs', 'print_logs', 'x_Printer', 'Printer', '`Printer`', '`Printer`', 200, 27, -1, false, '`Printer`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Printer->Sortable = true; // Allow sort
        $this->Printer->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Printer->Param, "CustomMsg");
        $this->Fields['Printer'] = &$this->Printer;

        // Document Name
        $this->DocumentName = new DbField('print_logs', 'print_logs', 'x_DocumentName', 'Document Name', '`Document Name`', '`Document Name`', 200, 71, -1, false, '`Document Name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DocumentName->Sortable = true; // Allow sort
        $this->DocumentName->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DocumentName->Param, "CustomMsg");
        $this->Fields['Document Name'] = &$this->DocumentName;

        // Client
        $this->Client = new DbField('print_logs', 'print_logs', 'x_Client', 'Client', '`Client`', '`Client`', 200, 15, -1, false, '`Client`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Client->Sortable = true; // Allow sort
        $this->Client->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Client->Param, "CustomMsg");
        $this->Fields['Client'] = &$this->Client;

        // Paper Size
        $this->PaperSize = new DbField('print_logs', 'print_logs', 'x_PaperSize', 'Paper Size', '`Paper Size`', '`Paper Size`', 200, 6, -1, false, '`Paper Size`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PaperSize->Sortable = true; // Allow sort
        $this->PaperSize->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PaperSize->Param, "CustomMsg");
        $this->Fields['Paper Size'] = &$this->PaperSize;

        // Language
        $this->_Language = new DbField('print_logs', 'print_logs', 'x__Language', 'Language', '`Language`', '`Language`', 200, 4, -1, false, '`Language`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_Language->Sortable = true; // Allow sort
        $this->_Language->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_Language->Param, "CustomMsg");
        $this->Fields['Language'] = &$this->_Language;

        // Height
        $this->Height = new DbField('print_logs', 'print_logs', 'x_Height', 'Height', '`Height`', '`Height`', 200, 10, -1, false, '`Height`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Height->Sortable = true; // Allow sort
        $this->Height->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Height->Param, "CustomMsg");
        $this->Fields['Height'] = &$this->Height;

        // Width
        $this->Width = new DbField('print_logs', 'print_logs', 'x_Width', 'Width', '`Width`', '`Width`', 200, 10, -1, false, '`Width`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Width->Sortable = true; // Allow sort
        $this->Width->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Width->Param, "CustomMsg");
        $this->Fields['Width'] = &$this->Width;

        // Duplex
        $this->Duplex = new DbField('print_logs', 'print_logs', 'x_Duplex', 'Duplex', '`Duplex`', '`Duplex`', 200, 10, -1, false, '`Duplex`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Duplex->Sortable = true; // Allow sort
        $this->Duplex->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Duplex->Param, "CustomMsg");
        $this->Fields['Duplex'] = &$this->Duplex;

        // Grayscale
        $this->Grayscale = new DbField('print_logs', 'print_logs', 'x_Grayscale', 'Grayscale', '`Grayscale`', '`Grayscale`', 200, 13, -1, false, '`Grayscale`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grayscale->Sortable = true; // Allow sort
        $this->Grayscale->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Grayscale->Param, "CustomMsg");
        $this->Fields['Grayscale'] = &$this->Grayscale;

        // Size
        $this->Size = new DbField('print_logs', 'print_logs', 'x_Size', 'Size', '`Size`', '`Size`', 200, 7, -1, false, '`Size`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Size->Sortable = true; // Allow sort
        $this->Size->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Size->Param, "CustomMsg");
        $this->Fields['Size'] = &$this->Size;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`print_logs`";
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
        $this->Time->DbValue = $row['Time'];
        $this->User->DbValue = $row['User'];
        $this->Pages->DbValue = $row['Pages'];
        $this->Copies->DbValue = $row['Copies'];
        $this->Printer->DbValue = $row['Printer'];
        $this->DocumentName->DbValue = $row['Document Name'];
        $this->Client->DbValue = $row['Client'];
        $this->PaperSize->DbValue = $row['Paper Size'];
        $this->_Language->DbValue = $row['Language'];
        $this->Height->DbValue = $row['Height'];
        $this->Width->DbValue = $row['Width'];
        $this->Duplex->DbValue = $row['Duplex'];
        $this->Grayscale->DbValue = $row['Grayscale'];
        $this->Size->DbValue = $row['Size'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("PrintLogsList");
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
        if ($pageName == "PrintLogsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PrintLogsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PrintLogsAdd") {
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
                return "PrintLogsView";
            case Config("API_ADD_ACTION"):
                return "PrintLogsAdd";
            case Config("API_EDIT_ACTION"):
                return "PrintLogsEdit";
            case Config("API_DELETE_ACTION"):
                return "PrintLogsDelete";
            case Config("API_LIST_ACTION"):
                return "PrintLogsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PrintLogsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PrintLogsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PrintLogsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PrintLogsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PrintLogsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PrintLogsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PrintLogsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PrintLogsDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
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
        $this->Time->setDbValue($row['Time']);
        $this->User->setDbValue($row['User']);
        $this->Pages->setDbValue($row['Pages']);
        $this->Copies->setDbValue($row['Copies']);
        $this->Printer->setDbValue($row['Printer']);
        $this->DocumentName->setDbValue($row['Document Name']);
        $this->Client->setDbValue($row['Client']);
        $this->PaperSize->setDbValue($row['Paper Size']);
        $this->_Language->setDbValue($row['Language']);
        $this->Height->setDbValue($row['Height']);
        $this->Width->setDbValue($row['Width']);
        $this->Duplex->setDbValue($row['Duplex']);
        $this->Grayscale->setDbValue($row['Grayscale']);
        $this->Size->setDbValue($row['Size']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Time

        // User

        // Pages

        // Copies

        // Printer

        // Document Name

        // Client

        // Paper Size

        // Language

        // Height

        // Width

        // Duplex

        // Grayscale

        // Size

        // Time
        $this->Time->ViewValue = $this->Time->CurrentValue;
        $this->Time->ViewCustomAttributes = "";

        // User
        $this->User->ViewValue = $this->User->CurrentValue;
        $this->User->ViewCustomAttributes = "";

        // Pages
        $this->Pages->ViewValue = $this->Pages->CurrentValue;
        $this->Pages->ViewValue = FormatNumber($this->Pages->ViewValue, 0, -2, -2, -2);
        $this->Pages->ViewCustomAttributes = "";

        // Copies
        $this->Copies->ViewValue = $this->Copies->CurrentValue;
        $this->Copies->ViewValue = FormatNumber($this->Copies->ViewValue, 0, -2, -2, -2);
        $this->Copies->ViewCustomAttributes = "";

        // Printer
        $this->Printer->ViewValue = $this->Printer->CurrentValue;
        $this->Printer->ViewCustomAttributes = "";

        // Document Name
        $this->DocumentName->ViewValue = $this->DocumentName->CurrentValue;
        $this->DocumentName->ViewCustomAttributes = "";

        // Client
        $this->Client->ViewValue = $this->Client->CurrentValue;
        $this->Client->ViewCustomAttributes = "";

        // Paper Size
        $this->PaperSize->ViewValue = $this->PaperSize->CurrentValue;
        $this->PaperSize->ViewCustomAttributes = "";

        // Language
        $this->_Language->ViewValue = $this->_Language->CurrentValue;
        $this->_Language->ViewCustomAttributes = "";

        // Height
        $this->Height->ViewValue = $this->Height->CurrentValue;
        $this->Height->ViewCustomAttributes = "";

        // Width
        $this->Width->ViewValue = $this->Width->CurrentValue;
        $this->Width->ViewCustomAttributes = "";

        // Duplex
        $this->Duplex->ViewValue = $this->Duplex->CurrentValue;
        $this->Duplex->ViewCustomAttributes = "";

        // Grayscale
        $this->Grayscale->ViewValue = $this->Grayscale->CurrentValue;
        $this->Grayscale->ViewCustomAttributes = "";

        // Size
        $this->Size->ViewValue = $this->Size->CurrentValue;
        $this->Size->ViewCustomAttributes = "";

        // Time
        $this->Time->LinkCustomAttributes = "";
        $this->Time->HrefValue = "";
        $this->Time->TooltipValue = "";

        // User
        $this->User->LinkCustomAttributes = "";
        $this->User->HrefValue = "";
        $this->User->TooltipValue = "";

        // Pages
        $this->Pages->LinkCustomAttributes = "";
        $this->Pages->HrefValue = "";
        $this->Pages->TooltipValue = "";

        // Copies
        $this->Copies->LinkCustomAttributes = "";
        $this->Copies->HrefValue = "";
        $this->Copies->TooltipValue = "";

        // Printer
        $this->Printer->LinkCustomAttributes = "";
        $this->Printer->HrefValue = "";
        $this->Printer->TooltipValue = "";

        // Document Name
        $this->DocumentName->LinkCustomAttributes = "";
        $this->DocumentName->HrefValue = "";
        $this->DocumentName->TooltipValue = "";

        // Client
        $this->Client->LinkCustomAttributes = "";
        $this->Client->HrefValue = "";
        $this->Client->TooltipValue = "";

        // Paper Size
        $this->PaperSize->LinkCustomAttributes = "";
        $this->PaperSize->HrefValue = "";
        $this->PaperSize->TooltipValue = "";

        // Language
        $this->_Language->LinkCustomAttributes = "";
        $this->_Language->HrefValue = "";
        $this->_Language->TooltipValue = "";

        // Height
        $this->Height->LinkCustomAttributes = "";
        $this->Height->HrefValue = "";
        $this->Height->TooltipValue = "";

        // Width
        $this->Width->LinkCustomAttributes = "";
        $this->Width->HrefValue = "";
        $this->Width->TooltipValue = "";

        // Duplex
        $this->Duplex->LinkCustomAttributes = "";
        $this->Duplex->HrefValue = "";
        $this->Duplex->TooltipValue = "";

        // Grayscale
        $this->Grayscale->LinkCustomAttributes = "";
        $this->Grayscale->HrefValue = "";
        $this->Grayscale->TooltipValue = "";

        // Size
        $this->Size->LinkCustomAttributes = "";
        $this->Size->HrefValue = "";
        $this->Size->TooltipValue = "";

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

        // Time
        $this->Time->EditAttrs["class"] = "form-control";
        $this->Time->EditCustomAttributes = "";
        if (!$this->Time->Raw) {
            $this->Time->CurrentValue = HtmlDecode($this->Time->CurrentValue);
        }
        $this->Time->EditValue = $this->Time->CurrentValue;
        $this->Time->PlaceHolder = RemoveHtml($this->Time->caption());

        // User
        $this->User->EditAttrs["class"] = "form-control";
        $this->User->EditCustomAttributes = "";
        if (!$this->User->Raw) {
            $this->User->CurrentValue = HtmlDecode($this->User->CurrentValue);
        }
        $this->User->EditValue = $this->User->CurrentValue;
        $this->User->PlaceHolder = RemoveHtml($this->User->caption());

        // Pages
        $this->Pages->EditAttrs["class"] = "form-control";
        $this->Pages->EditCustomAttributes = "";
        $this->Pages->EditValue = $this->Pages->CurrentValue;
        $this->Pages->PlaceHolder = RemoveHtml($this->Pages->caption());

        // Copies
        $this->Copies->EditAttrs["class"] = "form-control";
        $this->Copies->EditCustomAttributes = "";
        $this->Copies->EditValue = $this->Copies->CurrentValue;
        $this->Copies->PlaceHolder = RemoveHtml($this->Copies->caption());

        // Printer
        $this->Printer->EditAttrs["class"] = "form-control";
        $this->Printer->EditCustomAttributes = "";
        if (!$this->Printer->Raw) {
            $this->Printer->CurrentValue = HtmlDecode($this->Printer->CurrentValue);
        }
        $this->Printer->EditValue = $this->Printer->CurrentValue;
        $this->Printer->PlaceHolder = RemoveHtml($this->Printer->caption());

        // Document Name
        $this->DocumentName->EditAttrs["class"] = "form-control";
        $this->DocumentName->EditCustomAttributes = "";
        if (!$this->DocumentName->Raw) {
            $this->DocumentName->CurrentValue = HtmlDecode($this->DocumentName->CurrentValue);
        }
        $this->DocumentName->EditValue = $this->DocumentName->CurrentValue;
        $this->DocumentName->PlaceHolder = RemoveHtml($this->DocumentName->caption());

        // Client
        $this->Client->EditAttrs["class"] = "form-control";
        $this->Client->EditCustomAttributes = "";
        if (!$this->Client->Raw) {
            $this->Client->CurrentValue = HtmlDecode($this->Client->CurrentValue);
        }
        $this->Client->EditValue = $this->Client->CurrentValue;
        $this->Client->PlaceHolder = RemoveHtml($this->Client->caption());

        // Paper Size
        $this->PaperSize->EditAttrs["class"] = "form-control";
        $this->PaperSize->EditCustomAttributes = "";
        if (!$this->PaperSize->Raw) {
            $this->PaperSize->CurrentValue = HtmlDecode($this->PaperSize->CurrentValue);
        }
        $this->PaperSize->EditValue = $this->PaperSize->CurrentValue;
        $this->PaperSize->PlaceHolder = RemoveHtml($this->PaperSize->caption());

        // Language
        $this->_Language->EditAttrs["class"] = "form-control";
        $this->_Language->EditCustomAttributes = "";
        if (!$this->_Language->Raw) {
            $this->_Language->CurrentValue = HtmlDecode($this->_Language->CurrentValue);
        }
        $this->_Language->EditValue = $this->_Language->CurrentValue;
        $this->_Language->PlaceHolder = RemoveHtml($this->_Language->caption());

        // Height
        $this->Height->EditAttrs["class"] = "form-control";
        $this->Height->EditCustomAttributes = "";
        if (!$this->Height->Raw) {
            $this->Height->CurrentValue = HtmlDecode($this->Height->CurrentValue);
        }
        $this->Height->EditValue = $this->Height->CurrentValue;
        $this->Height->PlaceHolder = RemoveHtml($this->Height->caption());

        // Width
        $this->Width->EditAttrs["class"] = "form-control";
        $this->Width->EditCustomAttributes = "";
        if (!$this->Width->Raw) {
            $this->Width->CurrentValue = HtmlDecode($this->Width->CurrentValue);
        }
        $this->Width->EditValue = $this->Width->CurrentValue;
        $this->Width->PlaceHolder = RemoveHtml($this->Width->caption());

        // Duplex
        $this->Duplex->EditAttrs["class"] = "form-control";
        $this->Duplex->EditCustomAttributes = "";
        if (!$this->Duplex->Raw) {
            $this->Duplex->CurrentValue = HtmlDecode($this->Duplex->CurrentValue);
        }
        $this->Duplex->EditValue = $this->Duplex->CurrentValue;
        $this->Duplex->PlaceHolder = RemoveHtml($this->Duplex->caption());

        // Grayscale
        $this->Grayscale->EditAttrs["class"] = "form-control";
        $this->Grayscale->EditCustomAttributes = "";
        if (!$this->Grayscale->Raw) {
            $this->Grayscale->CurrentValue = HtmlDecode($this->Grayscale->CurrentValue);
        }
        $this->Grayscale->EditValue = $this->Grayscale->CurrentValue;
        $this->Grayscale->PlaceHolder = RemoveHtml($this->Grayscale->caption());

        // Size
        $this->Size->EditAttrs["class"] = "form-control";
        $this->Size->EditCustomAttributes = "";
        if (!$this->Size->Raw) {
            $this->Size->CurrentValue = HtmlDecode($this->Size->CurrentValue);
        }
        $this->Size->EditValue = $this->Size->CurrentValue;
        $this->Size->PlaceHolder = RemoveHtml($this->Size->caption());

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
                    $doc->exportCaption($this->Time);
                    $doc->exportCaption($this->User);
                    $doc->exportCaption($this->Pages);
                    $doc->exportCaption($this->Copies);
                    $doc->exportCaption($this->Printer);
                    $doc->exportCaption($this->DocumentName);
                    $doc->exportCaption($this->Client);
                    $doc->exportCaption($this->PaperSize);
                    $doc->exportCaption($this->_Language);
                    $doc->exportCaption($this->Height);
                    $doc->exportCaption($this->Width);
                    $doc->exportCaption($this->Duplex);
                    $doc->exportCaption($this->Grayscale);
                    $doc->exportCaption($this->Size);
                } else {
                    $doc->exportCaption($this->Time);
                    $doc->exportCaption($this->User);
                    $doc->exportCaption($this->Pages);
                    $doc->exportCaption($this->Copies);
                    $doc->exportCaption($this->Printer);
                    $doc->exportCaption($this->DocumentName);
                    $doc->exportCaption($this->Client);
                    $doc->exportCaption($this->PaperSize);
                    $doc->exportCaption($this->_Language);
                    $doc->exportCaption($this->Height);
                    $doc->exportCaption($this->Width);
                    $doc->exportCaption($this->Duplex);
                    $doc->exportCaption($this->Grayscale);
                    $doc->exportCaption($this->Size);
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
                        $doc->exportField($this->Time);
                        $doc->exportField($this->User);
                        $doc->exportField($this->Pages);
                        $doc->exportField($this->Copies);
                        $doc->exportField($this->Printer);
                        $doc->exportField($this->DocumentName);
                        $doc->exportField($this->Client);
                        $doc->exportField($this->PaperSize);
                        $doc->exportField($this->_Language);
                        $doc->exportField($this->Height);
                        $doc->exportField($this->Width);
                        $doc->exportField($this->Duplex);
                        $doc->exportField($this->Grayscale);
                        $doc->exportField($this->Size);
                    } else {
                        $doc->exportField($this->Time);
                        $doc->exportField($this->User);
                        $doc->exportField($this->Pages);
                        $doc->exportField($this->Copies);
                        $doc->exportField($this->Printer);
                        $doc->exportField($this->DocumentName);
                        $doc->exportField($this->Client);
                        $doc->exportField($this->PaperSize);
                        $doc->exportField($this->_Language);
                        $doc->exportField($this->Height);
                        $doc->exportField($this->Width);
                        $doc->exportField($this->Duplex);
                        $doc->exportField($this->Grayscale);
                        $doc->exportField($this->Size);
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
