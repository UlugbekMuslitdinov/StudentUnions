<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for places
 */
class Places extends DbTable
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
    public $name;
    public $category;
    public $url;
    public $_email;
    public $building;
    public $building_id;
    public $mailing_address;
    public $main_phone;
    public $other_phone;
    public $FAX;
    public $Monday;
    public $Tuesday;
    public $Wednesday;
    public $Thursday;
    public $Friday;
    public $Saturday;
    public $Sunday;
    public $hours;
    public $lat;
    public $long;
    public $notes;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'places';
        $this->TableName = 'places';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`places`";
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

        // name
        $this->name = new DbField(
            'places',
            'places',
            'x_name',
            'name',
            '`name`',
            '`name`',
            201,
            65535,
            -1,
            false,
            '`name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->name->InputTextType = "text";
        $this->Fields['name'] = &$this->name;

        // category
        $this->category = new DbField(
            'places',
            'places',
            'x_category',
            'category',
            '`category`',
            '`category`',
            201,
            65535,
            -1,
            false,
            '`category`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->category->InputTextType = "text";
        $this->Fields['category'] = &$this->category;

        // url
        $this->url = new DbField(
            'places',
            'places',
            'x_url',
            'url',
            '`url`',
            '`url`',
            201,
            65535,
            -1,
            false,
            '`url`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->url->InputTextType = "text";
        $this->Fields['url'] = &$this->url;

        // email
        $this->_email = new DbField(
            'places',
            'places',
            'x__email',
            'email',
            '`email`',
            '`email`',
            201,
            65535,
            -1,
            false,
            '`email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->_email->InputTextType = "text";
        $this->Fields['email'] = &$this->_email;

        // building
        $this->building = new DbField(
            'places',
            'places',
            'x_building',
            'building',
            '`building`',
            '`building`',
            201,
            65535,
            -1,
            false,
            '`building`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->building->InputTextType = "text";
        $this->Fields['building'] = &$this->building;

        // building_id
        $this->building_id = new DbField(
            'places',
            'places',
            'x_building_id',
            'building_id',
            '`building_id`',
            '`building_id`',
            201,
            65535,
            -1,
            false,
            '`building_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->building_id->InputTextType = "text";
        $this->Fields['building_id'] = &$this->building_id;

        // mailing_address
        $this->mailing_address = new DbField(
            'places',
            'places',
            'x_mailing_address',
            'mailing_address',
            '`mailing_address`',
            '`mailing_address`',
            201,
            65535,
            -1,
            false,
            '`mailing_address`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->mailing_address->InputTextType = "text";
        $this->Fields['mailing_address'] = &$this->mailing_address;

        // main_phone
        $this->main_phone = new DbField(
            'places',
            'places',
            'x_main_phone',
            'main_phone',
            '`main_phone`',
            '`main_phone`',
            201,
            65535,
            -1,
            false,
            '`main_phone`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->main_phone->InputTextType = "text";
        $this->Fields['main_phone'] = &$this->main_phone;

        // other_phone
        $this->other_phone = new DbField(
            'places',
            'places',
            'x_other_phone',
            'other_phone',
            '`other_phone`',
            '`other_phone`',
            201,
            65535,
            -1,
            false,
            '`other_phone`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->other_phone->InputTextType = "text";
        $this->Fields['other_phone'] = &$this->other_phone;

        // FAX
        $this->FAX = new DbField(
            'places',
            'places',
            'x_FAX',
            'FAX',
            '`FAX`',
            '`FAX`',
            201,
            65535,
            -1,
            false,
            '`FAX`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->FAX->InputTextType = "text";
        $this->Fields['FAX'] = &$this->FAX;

        // Monday
        $this->Monday = new DbField(
            'places',
            'places',
            'x_Monday',
            'Monday',
            '`Monday`',
            '`Monday`',
            201,
            65535,
            -1,
            false,
            '`Monday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Monday->InputTextType = "text";
        $this->Fields['Monday'] = &$this->Monday;

        // Tuesday
        $this->Tuesday = new DbField(
            'places',
            'places',
            'x_Tuesday',
            'Tuesday',
            '`Tuesday`',
            '`Tuesday`',
            201,
            65535,
            -1,
            false,
            '`Tuesday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Tuesday->InputTextType = "text";
        $this->Fields['Tuesday'] = &$this->Tuesday;

        // Wednesday
        $this->Wednesday = new DbField(
            'places',
            'places',
            'x_Wednesday',
            'Wednesday',
            '`Wednesday`',
            '`Wednesday`',
            201,
            65535,
            -1,
            false,
            '`Wednesday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Wednesday->InputTextType = "text";
        $this->Fields['Wednesday'] = &$this->Wednesday;

        // Thursday
        $this->Thursday = new DbField(
            'places',
            'places',
            'x_Thursday',
            'Thursday',
            '`Thursday`',
            '`Thursday`',
            201,
            65535,
            -1,
            false,
            '`Thursday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Thursday->InputTextType = "text";
        $this->Fields['Thursday'] = &$this->Thursday;

        // Friday
        $this->Friday = new DbField(
            'places',
            'places',
            'x_Friday',
            'Friday',
            '`Friday`',
            '`Friday`',
            201,
            65535,
            -1,
            false,
            '`Friday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Friday->InputTextType = "text";
        $this->Fields['Friday'] = &$this->Friday;

        // Saturday
        $this->Saturday = new DbField(
            'places',
            'places',
            'x_Saturday',
            'Saturday',
            '`Saturday`',
            '`Saturday`',
            201,
            65535,
            -1,
            false,
            '`Saturday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Saturday->InputTextType = "text";
        $this->Fields['Saturday'] = &$this->Saturday;

        // Sunday
        $this->Sunday = new DbField(
            'places',
            'places',
            'x_Sunday',
            'Sunday',
            '`Sunday`',
            '`Sunday`',
            201,
            65535,
            -1,
            false,
            '`Sunday`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->Sunday->InputTextType = "text";
        $this->Fields['Sunday'] = &$this->Sunday;

        // hours
        $this->hours = new DbField(
            'places',
            'places',
            'x_hours',
            'hours',
            '`hours`',
            '`hours`',
            201,
            65535,
            -1,
            false,
            '`hours`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->hours->InputTextType = "text";
        $this->Fields['hours'] = &$this->hours;

        // lat
        $this->lat = new DbField(
            'places',
            'places',
            'x_lat',
            'lat',
            '`lat`',
            '`lat`',
            201,
            65535,
            -1,
            false,
            '`lat`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->lat->InputTextType = "text";
        $this->Fields['lat'] = &$this->lat;

        // long
        $this->long = new DbField(
            'places',
            'places',
            'x_long',
            'long',
            '`long`',
            '`long`',
            201,
            65535,
            -1,
            false,
            '`long`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->long->InputTextType = "text";
        $this->long->Nullable = false; // NOT NULL field
        $this->long->Required = true; // Required field
        $this->Fields['long'] = &$this->long;

        // notes
        $this->notes = new DbField(
            'places',
            'places',
            'x_notes',
            'notes',
            '`notes`',
            '`notes`',
            201,
            65535,
            -1,
            false,
            '`notes`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->notes->InputTextType = "text";
        $this->Fields['notes'] = &$this->notes;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`places`";
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
        $this->name->DbValue = $row['name'];
        $this->category->DbValue = $row['category'];
        $this->url->DbValue = $row['url'];
        $this->_email->DbValue = $row['email'];
        $this->building->DbValue = $row['building'];
        $this->building_id->DbValue = $row['building_id'];
        $this->mailing_address->DbValue = $row['mailing_address'];
        $this->main_phone->DbValue = $row['main_phone'];
        $this->other_phone->DbValue = $row['other_phone'];
        $this->FAX->DbValue = $row['FAX'];
        $this->Monday->DbValue = $row['Monday'];
        $this->Tuesday->DbValue = $row['Tuesday'];
        $this->Wednesday->DbValue = $row['Wednesday'];
        $this->Thursday->DbValue = $row['Thursday'];
        $this->Friday->DbValue = $row['Friday'];
        $this->Saturday->DbValue = $row['Saturday'];
        $this->Sunday->DbValue = $row['Sunday'];
        $this->hours->DbValue = $row['hours'];
        $this->lat->DbValue = $row['lat'];
        $this->long->DbValue = $row['long'];
        $this->notes->DbValue = $row['notes'];
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
        return $_SESSION[$name] ?? GetUrl("PlacesList");
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
        if ($pageName == "PlacesView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PlacesEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PlacesAdd") {
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
                return "PlacesView";
            case Config("API_ADD_ACTION"):
                return "PlacesAdd";
            case Config("API_EDIT_ACTION"):
                return "PlacesEdit";
            case Config("API_DELETE_ACTION"):
                return "PlacesDelete";
            case Config("API_LIST_ACTION"):
                return "PlacesList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PlacesList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PlacesView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PlacesView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PlacesAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PlacesAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PlacesEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PlacesAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PlacesDelete", $this->getUrlParm());
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
        if ($fld->UseFilter && $Security->canSearch()) {
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
        $this->name->setDbValue($row['name']);
        $this->category->setDbValue($row['category']);
        $this->url->setDbValue($row['url']);
        $this->_email->setDbValue($row['email']);
        $this->building->setDbValue($row['building']);
        $this->building_id->setDbValue($row['building_id']);
        $this->mailing_address->setDbValue($row['mailing_address']);
        $this->main_phone->setDbValue($row['main_phone']);
        $this->other_phone->setDbValue($row['other_phone']);
        $this->FAX->setDbValue($row['FAX']);
        $this->Monday->setDbValue($row['Monday']);
        $this->Tuesday->setDbValue($row['Tuesday']);
        $this->Wednesday->setDbValue($row['Wednesday']);
        $this->Thursday->setDbValue($row['Thursday']);
        $this->Friday->setDbValue($row['Friday']);
        $this->Saturday->setDbValue($row['Saturday']);
        $this->Sunday->setDbValue($row['Sunday']);
        $this->hours->setDbValue($row['hours']);
        $this->lat->setDbValue($row['lat']);
        $this->long->setDbValue($row['long']);
        $this->notes->setDbValue($row['notes']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // name

        // category

        // url

        // email

        // building

        // building_id

        // mailing_address

        // main_phone

        // other_phone

        // FAX

        // Monday

        // Tuesday

        // Wednesday

        // Thursday

        // Friday

        // Saturday

        // Sunday

        // hours

        // lat

        // long

        // notes

        // name
        $this->name->ViewValue = $this->name->CurrentValue;
        $this->name->ViewCustomAttributes = "";

        // category
        $this->category->ViewValue = $this->category->CurrentValue;
        $this->category->ViewCustomAttributes = "";

        // url
        $this->url->ViewValue = $this->url->CurrentValue;
        $this->url->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // building
        $this->building->ViewValue = $this->building->CurrentValue;
        $this->building->ViewCustomAttributes = "";

        // building_id
        $this->building_id->ViewValue = $this->building_id->CurrentValue;
        $this->building_id->ViewCustomAttributes = "";

        // mailing_address
        $this->mailing_address->ViewValue = $this->mailing_address->CurrentValue;
        $this->mailing_address->ViewCustomAttributes = "";

        // main_phone
        $this->main_phone->ViewValue = $this->main_phone->CurrentValue;
        $this->main_phone->ViewCustomAttributes = "";

        // other_phone
        $this->other_phone->ViewValue = $this->other_phone->CurrentValue;
        $this->other_phone->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // Monday
        $this->Monday->ViewValue = $this->Monday->CurrentValue;
        $this->Monday->ViewCustomAttributes = "";

        // Tuesday
        $this->Tuesday->ViewValue = $this->Tuesday->CurrentValue;
        $this->Tuesday->ViewCustomAttributes = "";

        // Wednesday
        $this->Wednesday->ViewValue = $this->Wednesday->CurrentValue;
        $this->Wednesday->ViewCustomAttributes = "";

        // Thursday
        $this->Thursday->ViewValue = $this->Thursday->CurrentValue;
        $this->Thursday->ViewCustomAttributes = "";

        // Friday
        $this->Friday->ViewValue = $this->Friday->CurrentValue;
        $this->Friday->ViewCustomAttributes = "";

        // Saturday
        $this->Saturday->ViewValue = $this->Saturday->CurrentValue;
        $this->Saturday->ViewCustomAttributes = "";

        // Sunday
        $this->Sunday->ViewValue = $this->Sunday->CurrentValue;
        $this->Sunday->ViewCustomAttributes = "";

        // hours
        $this->hours->ViewValue = $this->hours->CurrentValue;
        $this->hours->ViewCustomAttributes = "";

        // lat
        $this->lat->ViewValue = $this->lat->CurrentValue;
        $this->lat->ViewCustomAttributes = "";

        // long
        $this->long->ViewValue = $this->long->CurrentValue;
        $this->long->ViewCustomAttributes = "";

        // notes
        $this->notes->ViewValue = $this->notes->CurrentValue;
        $this->notes->ViewCustomAttributes = "";

        // name
        $this->name->LinkCustomAttributes = "";
        $this->name->HrefValue = "";
        $this->name->TooltipValue = "";

        // category
        $this->category->LinkCustomAttributes = "";
        $this->category->HrefValue = "";
        $this->category->TooltipValue = "";

        // url
        $this->url->LinkCustomAttributes = "";
        $this->url->HrefValue = "";
        $this->url->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // building
        $this->building->LinkCustomAttributes = "";
        $this->building->HrefValue = "";
        $this->building->TooltipValue = "";

        // building_id
        $this->building_id->LinkCustomAttributes = "";
        $this->building_id->HrefValue = "";
        $this->building_id->TooltipValue = "";

        // mailing_address
        $this->mailing_address->LinkCustomAttributes = "";
        $this->mailing_address->HrefValue = "";
        $this->mailing_address->TooltipValue = "";

        // main_phone
        $this->main_phone->LinkCustomAttributes = "";
        $this->main_phone->HrefValue = "";
        $this->main_phone->TooltipValue = "";

        // other_phone
        $this->other_phone->LinkCustomAttributes = "";
        $this->other_phone->HrefValue = "";
        $this->other_phone->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

        // Monday
        $this->Monday->LinkCustomAttributes = "";
        $this->Monday->HrefValue = "";
        $this->Monday->TooltipValue = "";

        // Tuesday
        $this->Tuesday->LinkCustomAttributes = "";
        $this->Tuesday->HrefValue = "";
        $this->Tuesday->TooltipValue = "";

        // Wednesday
        $this->Wednesday->LinkCustomAttributes = "";
        $this->Wednesday->HrefValue = "";
        $this->Wednesday->TooltipValue = "";

        // Thursday
        $this->Thursday->LinkCustomAttributes = "";
        $this->Thursday->HrefValue = "";
        $this->Thursday->TooltipValue = "";

        // Friday
        $this->Friday->LinkCustomAttributes = "";
        $this->Friday->HrefValue = "";
        $this->Friday->TooltipValue = "";

        // Saturday
        $this->Saturday->LinkCustomAttributes = "";
        $this->Saturday->HrefValue = "";
        $this->Saturday->TooltipValue = "";

        // Sunday
        $this->Sunday->LinkCustomAttributes = "";
        $this->Sunday->HrefValue = "";
        $this->Sunday->TooltipValue = "";

        // hours
        $this->hours->LinkCustomAttributes = "";
        $this->hours->HrefValue = "";
        $this->hours->TooltipValue = "";

        // lat
        $this->lat->LinkCustomAttributes = "";
        $this->lat->HrefValue = "";
        $this->lat->TooltipValue = "";

        // long
        $this->long->LinkCustomAttributes = "";
        $this->long->HrefValue = "";
        $this->long->TooltipValue = "";

        // notes
        $this->notes->LinkCustomAttributes = "";
        $this->notes->HrefValue = "";
        $this->notes->TooltipValue = "";

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

        // name
        $this->name->setupEditAttributes();
        $this->name->EditCustomAttributes = "";
        $this->name->EditValue = $this->name->CurrentValue;
        $this->name->PlaceHolder = RemoveHtml($this->name->caption());

        // category
        $this->category->setupEditAttributes();
        $this->category->EditCustomAttributes = "";
        $this->category->EditValue = $this->category->CurrentValue;
        $this->category->PlaceHolder = RemoveHtml($this->category->caption());

        // url
        $this->url->setupEditAttributes();
        $this->url->EditCustomAttributes = "";
        $this->url->EditValue = $this->url->CurrentValue;
        $this->url->PlaceHolder = RemoveHtml($this->url->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // building
        $this->building->setupEditAttributes();
        $this->building->EditCustomAttributes = "";
        $this->building->EditValue = $this->building->CurrentValue;
        $this->building->PlaceHolder = RemoveHtml($this->building->caption());

        // building_id
        $this->building_id->setupEditAttributes();
        $this->building_id->EditCustomAttributes = "";
        $this->building_id->EditValue = $this->building_id->CurrentValue;
        $this->building_id->PlaceHolder = RemoveHtml($this->building_id->caption());

        // mailing_address
        $this->mailing_address->setupEditAttributes();
        $this->mailing_address->EditCustomAttributes = "";
        $this->mailing_address->EditValue = $this->mailing_address->CurrentValue;
        $this->mailing_address->PlaceHolder = RemoveHtml($this->mailing_address->caption());

        // main_phone
        $this->main_phone->setupEditAttributes();
        $this->main_phone->EditCustomAttributes = "";
        $this->main_phone->EditValue = $this->main_phone->CurrentValue;
        $this->main_phone->PlaceHolder = RemoveHtml($this->main_phone->caption());

        // other_phone
        $this->other_phone->setupEditAttributes();
        $this->other_phone->EditCustomAttributes = "";
        $this->other_phone->EditValue = $this->other_phone->CurrentValue;
        $this->other_phone->PlaceHolder = RemoveHtml($this->other_phone->caption());

        // FAX
        $this->FAX->setupEditAttributes();
        $this->FAX->EditCustomAttributes = "";
        $this->FAX->EditValue = $this->FAX->CurrentValue;
        $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

        // Monday
        $this->Monday->setupEditAttributes();
        $this->Monday->EditCustomAttributes = "";
        $this->Monday->EditValue = $this->Monday->CurrentValue;
        $this->Monday->PlaceHolder = RemoveHtml($this->Monday->caption());

        // Tuesday
        $this->Tuesday->setupEditAttributes();
        $this->Tuesday->EditCustomAttributes = "";
        $this->Tuesday->EditValue = $this->Tuesday->CurrentValue;
        $this->Tuesday->PlaceHolder = RemoveHtml($this->Tuesday->caption());

        // Wednesday
        $this->Wednesday->setupEditAttributes();
        $this->Wednesday->EditCustomAttributes = "";
        $this->Wednesday->EditValue = $this->Wednesday->CurrentValue;
        $this->Wednesday->PlaceHolder = RemoveHtml($this->Wednesday->caption());

        // Thursday
        $this->Thursday->setupEditAttributes();
        $this->Thursday->EditCustomAttributes = "";
        $this->Thursday->EditValue = $this->Thursday->CurrentValue;
        $this->Thursday->PlaceHolder = RemoveHtml($this->Thursday->caption());

        // Friday
        $this->Friday->setupEditAttributes();
        $this->Friday->EditCustomAttributes = "";
        $this->Friday->EditValue = $this->Friday->CurrentValue;
        $this->Friday->PlaceHolder = RemoveHtml($this->Friday->caption());

        // Saturday
        $this->Saturday->setupEditAttributes();
        $this->Saturday->EditCustomAttributes = "";
        $this->Saturday->EditValue = $this->Saturday->CurrentValue;
        $this->Saturday->PlaceHolder = RemoveHtml($this->Saturday->caption());

        // Sunday
        $this->Sunday->setupEditAttributes();
        $this->Sunday->EditCustomAttributes = "";
        $this->Sunday->EditValue = $this->Sunday->CurrentValue;
        $this->Sunday->PlaceHolder = RemoveHtml($this->Sunday->caption());

        // hours
        $this->hours->setupEditAttributes();
        $this->hours->EditCustomAttributes = "";
        $this->hours->EditValue = $this->hours->CurrentValue;
        $this->hours->PlaceHolder = RemoveHtml($this->hours->caption());

        // lat
        $this->lat->setupEditAttributes();
        $this->lat->EditCustomAttributes = "";
        $this->lat->EditValue = $this->lat->CurrentValue;
        $this->lat->PlaceHolder = RemoveHtml($this->lat->caption());

        // long
        $this->long->setupEditAttributes();
        $this->long->EditCustomAttributes = "";
        $this->long->EditValue = $this->long->CurrentValue;
        $this->long->PlaceHolder = RemoveHtml($this->long->caption());

        // notes
        $this->notes->setupEditAttributes();
        $this->notes->EditCustomAttributes = "";
        $this->notes->EditValue = $this->notes->CurrentValue;
        $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

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
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->category);
                    $doc->exportCaption($this->url);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->building);
                    $doc->exportCaption($this->building_id);
                    $doc->exportCaption($this->mailing_address);
                    $doc->exportCaption($this->main_phone);
                    $doc->exportCaption($this->other_phone);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->Monday);
                    $doc->exportCaption($this->Tuesday);
                    $doc->exportCaption($this->Wednesday);
                    $doc->exportCaption($this->Thursday);
                    $doc->exportCaption($this->Friday);
                    $doc->exportCaption($this->Saturday);
                    $doc->exportCaption($this->Sunday);
                    $doc->exportCaption($this->hours);
                    $doc->exportCaption($this->lat);
                    $doc->exportCaption($this->long);
                    $doc->exportCaption($this->notes);
                } else {
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
                        $doc->exportField($this->name);
                        $doc->exportField($this->category);
                        $doc->exportField($this->url);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->building);
                        $doc->exportField($this->building_id);
                        $doc->exportField($this->mailing_address);
                        $doc->exportField($this->main_phone);
                        $doc->exportField($this->other_phone);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->Monday);
                        $doc->exportField($this->Tuesday);
                        $doc->exportField($this->Wednesday);
                        $doc->exportField($this->Thursday);
                        $doc->exportField($this->Friday);
                        $doc->exportField($this->Saturday);
                        $doc->exportField($this->Sunday);
                        $doc->exportField($this->hours);
                        $doc->exportField($this->lat);
                        $doc->exportField($this->long);
                        $doc->exportField($this->notes);
                    } else {
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
