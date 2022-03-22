<?php

namespace PHPMaker2022\project3;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Lookup class
 */
class Lookup
{
    public $LookupType = "";
    public $Options = null;
    public $Template = "";
    public $CurrentFilter = "";
    public $UserSelect = "";
    public $UserFilter = "";
    public $UserOrderBy = "";
    public $FilterFields = [];
    public $FilterValues = [];
    public $SearchValue = "";
    public $SearchExpression = "";
    public $PageSize = -1;
    public $Offset = -1;
    public $KeepCrLf = false;
    public $LookupFilter = "";
    public $RenderViewFunc = "renderListRow";
    public $RenderEditFunc = "renderEditRow";
    public $LinkTable = "";
    public $Name = "";
    public $Distinct = false;
    public $LinkField = "";
    public $DisplayFields = [];
    public $ParentFields = [];
    public $ChildFields = [];
    public $FilterFieldVars = [];
    public $AutoFillSourceFields = [];
    public $AutoFillTargetFields = [];
    public $Table = null;
    public $FormatAutoFill = false;
    public $UseParentFilter = false;
    private $rendering = false;
    private $cache; // Doctrine cache
    private $cacheProfile; // Doctrine cache profile
    public static $ModalLookupSearchType = "AND";

    /**
     * Constructor for the Lookup class
     *
     * @param string $name
     * @param string $linkTable
     * @param bool $distinct
     * @param string $linkField
     * @param array $displayFields
     * @param array $parentFields
     * @param array $childFields
     * @param array $filterFields
     * @param array $filterFieldVars
     * @param array $autoFillSourceFields
     * @param array $autoFillTargetFields
     * @param string $orderBy
     * @param string $template
     */
    public function __construct(
        $name,
        $linkTable,
        $distinct,
        $linkField,
        $displayFields = [],
        $parentFields = [],
        $childFields = [],
        $filterFields = [],
        $filterFieldVars = [],
        $autoFillSourceFields = [],
        $autoFillTargetFields = [],
        $orderBy = "",
        $template = "",
        $searchExpression = ""
    ) {
        $this->Name = $name;
        $this->LinkTable = $linkTable;
        $this->Distinct = $distinct;
        $this->LinkField = $linkField;
        $this->DisplayFields = $displayFields;
        $this->ParentFields = $parentFields;
        $this->ChildFields = $childFields;
        foreach ($filterFields as $filterField) {
            $this->FilterFields[$filterField] = "="; // Default filter operator
        }
        $this->FilterFieldVars = $filterFieldVars;
        $this->AutoFillSourceFields = $autoFillSourceFields;
        $this->AutoFillTargetFields = $autoFillTargetFields;
        $this->UserOrderBy = $orderBy;
        $this->Template = $template;
        $this->SearchExpression = $searchExpression;
        $this->cache = new ArrayCache();
        $this->cacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $name);
    }

    /**
     * Get lookup SQL based on current filter/lookup filter, call Lookup_Selecting if necessary
     *
     * @param bool $useParentFilter
     * @param string $currentFilter
     * @param string|callable $lookupFilter
     * @param object $page
     * @param bool $skipFilterFields
     * @return QueryBuilder
     */
    public function getSql($useParentFilter = true, $currentFilter = "", $lookupFilter = "", $page = null, $skipFilterFields = false, $clearUserFilter = false)
    {
        $this->UseParentFilter = $useParentFilter; // Save last call
        $this->CurrentFilter = $currentFilter;
        $this->LookupFilter = $lookupFilter; // Save last call
        if ($clearUserFilter) {
            $this->UserFilter = "";
        }
        if ($page !== null) {
            $filter = $this->getUserFilter($useParentFilter);
            $newFilter = $filter;
            $fld = @$page->Fields[$this->Name];
            if ($fld && method_exists($page, "lookupSelecting")) {
                $page->lookupSelecting($fld, $newFilter); // Call Lookup Selecting
            }
            if ($filter != $newFilter) { // Filter changed
                AddFilter($this->UserFilter, $newFilter);
            }
        }
        if ($lookupFilter != "") { // Add lookup filter as part of user filter
            AddFilter($this->UserFilter, $lookupFilter);
        }
        return $this->getSqlPart("", true, $useParentFilter, $skipFilterFields);
    }

    /**
     * Set options
     *
     * @param array $options Input options with formats:
     *  1. Manual input data, e.g.: [ ["lv1", "dv", "dv2", "dv3", "dv4"], ["lv2", "dv", "dv2", "dv3", "dv4"], ...]
     *  2. Data from $rs->getRows(), e.g.: [ ["Field1" => "lv1", "Field2" => "dv2", ...], ["Field1" => "lv2", "Field2" => "dv2", ...], ...]
     * @return bool Output array ["lv1" => ["lf" => "lv1", "df" => "dv", ...], ...]
     */
    public function setOptions($options)
    {
        $opts = $this->formatOptions($options);
        if ($opts === null) {
            return false;
        }
        $this->Options = $opts;
        return true;
    }

    /**
     * Set filter field operator
     *
     * @param string $name Filter field name
     * @param string $opr Filter search operator
     * @return void
     */
    public function setFilterOperator($name, $opr)
    {
        if (array_key_exists($name, $this->FilterFields) && $this->isValidOperator($opr)) {
            $this->FilterFields[$name] = $opr;
        }
    }

    /**
     * Get user parameters hidden tag, if user SELECT/WHERE/ORDER BY clause is not empty
     *
     * @param string $var Variable name
     * @return string
     */
    public function getParamTag($currentPage, $var)
    {
        $this->UserSelect = "";
        $this->UserFilter = "";
        $this->UserOrderBy = "";
        $this->getSql($this->UseParentFilter, $this->CurrentFilter, $this->LookupFilter, $currentPage); // Call Lookup_Selecting again based on last setting
        $ar = [];
        if ($this->UserSelect != "") {
            $ar["s"] = Encrypt($this->UserSelect);
        }
        if ($this->UserFilter != "") {
            $ar["f"] = Encrypt($this->UserFilter);
        }
        if ($this->UserOrderBy != "") {
            $ar["o"] = Encrypt($this->UserOrderBy);
        }
        if (count($ar) > 0) {
            return '<input type="hidden" id="' . $var . '" name="' . $var . '" value="' . http_build_query($ar) . '">';
        }
        return "";
    }

    /**
     * Output client side list
     *
     * @return string
     */
    public function toClientList($currentPage)
    {
        return [
            "page" => $currentPage->PageObjName,
            "field" => $this->Name,
            "linkField" => $this->LinkField,
            "displayFields" => $this->DisplayFields,
            "parentFields" => $currentPage->PageID != "grid" && $this->hasParentTable() ? [] : $this->ParentFields,
            "childFields" => $this->ChildFields,
            "filterFields" => $currentPage->PageID != "grid" && $this->hasParentTable() ? [] : array_keys($this->FilterFields),
            "filterFieldVars" => $currentPage->PageID != "grid" && $this->hasParentTable() ? [] : $this->FilterFieldVars,
            "ajax" => $this->LinkTable != "",
            "autoFillTargetFields" => $this->AutoFillTargetFields,
            "template" => $this->Template
        ];
    }

    /**
     * Execute SQL and write JSON response
     *
     * @return bool
     */
    public function toJson($page = null, $response = true)
    {
        if ($page === null) {
            return false;
        }

        // Get table object
        $tbl = $this->getTable();

        // Check if lookup to report source table
        $isReport = $page->TableType == "REPORT" && in_array($tbl->TableVar, [$page->ReportSourceTable, $page->TableVar]);
        $renderer = $isReport ? $page : $tbl;

        // Update expression for grouping fields (reports)
        if ($isReport) {
            foreach ($this->DisplayFields as $i => $displayField) {
                if (!EmptyValue($displayField)) {
                    $pageDisplayField = @$page->Fields[$displayField];
                    $tblDisplayField = @$tbl->Fields[$displayField];
                    if ($pageDisplayField && $tblDisplayField && !EmptyValue($pageDisplayField->LookupExpression)) {
                        if (!EmptyValue($this->UserOrderBy)) {
                            $this->UserOrderBy = str_replace($tblDisplayField->Expression, $pageDisplayField->LookupExpression, $this->UserOrderBy);
                        }
                        $tblDisplayField->Expression = $pageDisplayField->LookupExpression;
                        $this->Distinct = true; // Use DISTINCT for grouping fields
                    }
                }
            }
        }
        $filterValues = count($this->FilterValues) > 0 ? array_slice($this->FilterValues, 1) : [];
        $useParentFilter = count($filterValues) == count(array_filter($filterValues)) || !$this->hasParentTable() && $this->LookupType != "filter";
        $sql = $this->getSql($useParentFilter, "", "", $page, !$useParentFilter);
        $orderBy = $this->UserOrderBy;
        $pageSize = $this->PageSize;
        $offset = $this->Offset;
        $tableCnt = ($pageSize > 0) ? $tbl->getRecordCount($sql) : 0; // Get table count first
        $stmt = $this->executeQuery($sql, $orderBy, $pageSize, $offset);
        if ($stmt) {
            $rsarr = $stmt->fetchAllAssociative();
            $rowCnt = count($rsarr);
            $totalCnt = ($pageSize > 0) ? $tableCnt : $rowCnt;
            $fldCnt = $stmt->columnCount();

            // Clean output buffer
            if ($response && ob_get_length()) {
                ob_clean();
            }

            // Output
            foreach ($rsarr as &$row) {
                $keys = array_keys($row);
                if ($linkField = @$renderer->Fields[$this->LinkField]) {
                    $linkField->setDbValue($row[$keys[0]]);
                }
                for ($i = 1; $i < count($keys); $i++) {
                    $val = &$row[$keys[$i]];
                    $str = ConvertToUtf8(strval($val));
                    $str = str_replace(["\r", "\n", "\t"], $this->KeepCrLf ? ["\\r", "\\n", "\\t"] : [" ", " ", " "], $str);
                    $val = $str;
                    if (SameText($this->LookupType, "autofill")) {
                        $autoFillSourceField = @$this->AutoFillSourceFields[$i - 1];
                        $autoFillSourceField = @$renderer->Fields[$autoFillSourceField];
                        if ($autoFillSourceField) {
                            $autoFillSourceField->setDbValue($val);
                        }
                    }
                }
                if (SameText($this->LookupType, "autofill")) {
                    if ($this->FormatAutoFill) { // Format auto fill
                        $renderer->RowType = ROWTYPE_EDIT;
                        $fn = $this->RenderEditFunc;
                        $render = method_exists($renderer, $fn);
                        if ($render) {
                            $renderer->$fn();
                        }
                        for ($i = 0; $i < $fldCnt; $i++) {
                            $autoFillSourceField = @$this->AutoFillSourceFields[$i];
                            $autoFillSourceField = @$renderer->Fields[$autoFillSourceField];
                            if ($autoFillSourceField) {
                                $row["af" . $i] = (!$render || $autoFillSourceField->AutoFillOriginalValue) ? $autoFillSourceField->CurrentValue : ((is_array($autoFillSourceField->EditValue) || $autoFillSourceField->EditValue === null) ? $autoFillSourceField->CurrentValue : $autoFillSourceField->EditValue);
                            }
                        }
                    }
                } elseif ($this->LookupType != "unknown") { // Format display fields for known lookup type
                    $row = $this->renderViewRow($row, $renderer);
                }
            }

            // Set up advanced filter (reports)
            if ($isReport) {
                if (in_array($this->LookupType, ["updateoption", "modal", "autosuggest"])) {
                    if (method_exists($page, "pageFilterLoad")) {
                        $page->pageFilterLoad();
                    }
                    $linkField = @$page->Fields[$this->LinkField];
                    if ($linkField && is_array($linkField->AdvancedFilters)) {
                        $ar = [];
                        foreach ($linkField->AdvancedFilters as $filter) {
                            if ($filter->Enabled) {
                                $ar[] = ["lf" => $filter->ID, "df" => $filter->Name];
                            }
                        }
                        $rsarr = array_merge($ar, $rsarr);
                    }
                }
            }
            $result = ["result" => "OK", "records" => $rsarr, "totalRecordCount" => $totalCnt];
            if (Config("DEBUG")) {
                $result["sql"] = is_string($sql) ? $sql : $sql->getSQL();
            }
            if ($response) {
                WriteJson($result);
                return true;
            } else {
                return $result;
            }
        }
        return false;
    }

    /**
     * Render view row
     *
     * @param object $row Input data
     * @param object $renderer Renderer
     * @return object Output data
     */
    public function renderViewRow($row, $renderer = null)
    {
        if ($this->rendering) { // Avoid recursive calls
            return $row;
        }

        // Use table as renderer if not defined
        $sameTable = false;
        $tbl = $this->getTable();
        if ($renderer == null) {
            $renderer = $tbl;
        } elseif ($renderer->TableName == $tbl->TableName) {
            $sameTable = true; // Lookup table same as renderer table
        }

        // Check if render View function exists
        $fn = $this->RenderViewFunc;
        $render = method_exists($renderer, $fn);
        if (!$render) {
            return $row;
        }
        $this->rendering = true;

        // Set up DbValue / CurrentValue
        foreach ($this->DisplayFields as $index => $name) {
            $displayField = @$renderer->Fields[$name];
            if ($displayField) {
                $sfx = $index > 0 ? $index + 1 : "";
                $displayField->setDbValue($row["df" . $sfx]);
            }
        }

        // Render data
        $rowType = $renderer->RowType; // Save RowType
        $renderer->RowType = ROWTYPE_VIEW;
        $renderer->$fn();
        $renderer->RowType = $rowType; // Restore RowType

        // Output data from ViewValue
        foreach ($this->DisplayFields as $index => $name) {
            $displayField = @$renderer->Fields[$name];
            if ($displayField) {
                $sfx = $index > 0 ? $index + 1 : "";
                $viewValue = $displayField->getViewValue();
                if (!EmptyString($viewValue) && !($sameTable && $name == $this->Name)) { // Make sure that ViewValue is not empty and not self lookup field
                    $row["df" . $sfx] = $viewValue;
                }
            }
        }
        $this->rendering = false;
        return $row;
    }

    /**
     * Get table object
     *
     * @return object
     */
    public function getTable()
    {
        if ($this->LinkTable == "") {
            return null;
        }
        $this->Table = $this->Table ?? Container($this->LinkTable);
        return $this->Table;
    }

    public function hasParentTable()
    {
        if (is_array($this->ParentFields)) {
            foreach ($this->ParentFields as $parentField) {
                if (strval($parentField) != "" && ContainsText($parentField, " ")) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Check if filter operator is valid
     *
     * @param string $opr Operator, e.g. '<', '>'
     * @return bool
     */
    protected function isValidOperator($opr)
    {
        return in_array($opr, ['=', '<>', '<', '<=', '>', '>=', 'LIKE', 'NOT LIKE', 'STARTS WITH', 'ENDS WITH']);
    }

    /**
     * Get part of lookup SQL
     *
     * @param string $part Part of the SQL (select|where|orderby|"")
     * @param bool $isUser Whether the CurrentFilter, UserFilter and UserSelect properties should be used
     * @param bool $useParentFilter Use parent filter
     * @param bool $skipFilterFields Skip filter fields
     * @return string|QueryBuilder Part of SQL, or QueryBuilder if $part unspecified
     */
    protected function getSqlPart($part = "", $isUser = true, $useParentFilter = true, $skipFilterFields = false)
    {
        $tbl = $this->getTable();
        if ($tbl === null) {
            return "";
        }

        // Set up SELECT ... FROM ...
        $dbid = $tbl->Dbid;
        $queryBuilder = $tbl->getQueryBuilder();
        if ($this->Distinct) {
            $queryBuilder->distinct();
        }
        // Set up link field
        $linkField = @$tbl->Fields[$this->LinkField];
        if (!$linkField) {
            return "";
        }
        $select = $linkField->Expression;
        if ($this->LookupType != "unknown") { // Known lookup types
            $select .= " AS " . QuotedName("lf", $dbid);
        }
        $queryBuilder->select($select);
        // Set up lookup fields
        $lookupCnt = 0;
        if (SameText($this->LookupType, "autofill")) {
            if (is_array($this->AutoFillSourceFields)) {
                foreach ($this->AutoFillSourceFields as $i => $autoFillSourceField) {
                    $autoFillSourceField = @$tbl->Fields[$autoFillSourceField];
                    if (!$autoFillSourceField) {
                        $select = "'' AS " . QuotedName("af" . $i, $dbid);
                    } else {
                        $select = $autoFillSourceField->Expression . " AS " . QuotedName("af" . $i, $dbid);
                    }
                    $queryBuilder->addSelect($select);
                    if (!$autoFillSourceField->AutoFillOriginalValue) {
                        $this->FormatAutoFill = true;
                    }
                    $lookupCnt++;
                }
            }
        } else {
            if (is_array($this->DisplayFields)) {
                foreach ($this->DisplayFields as $i => $displayField) {
                    $displayField = @$tbl->Fields[$displayField];
                    if (!$displayField) {
                        $select = "'' AS " . QuotedName("df" . (($i == 0) ? "" : $i + 1), $dbid);
                    } else {
                        $select = $displayField->Expression;
                        if ($this->LookupType != "unknown") { // Known lookup types
                            $select .= " AS " . QuotedName("df" . (($i == 0) ? "" : $i + 1), $dbid);
                        }
                    }
                    $queryBuilder->addSelect($select);
                    $lookupCnt++;
                }
            }
            if (is_array($this->FilterFields) && !$useParentFilter && !$skipFilterFields) {
                $i = 0;
                foreach ($this->FilterFields as $filterField => $filterOpr) {
                    $filterField = @$tbl->Fields[$filterField];
                    if (!$filterField) {
                        $select = "'' AS " . QuotedName("ff" . (($i == 0) ? "" : $i + 1), $dbid);
                    } else {
                        $select = $filterField->Expression;
                        if ($this->LookupType != "unknown") { // Known lookup types
                            $select .= " AS " . QuotedName("ff" . (($i == 0) ? "" : $i + 1), $dbid);
                        }
                    }
                    $queryBuilder->addSelect($select);
                    $i++;
                    $lookupCnt++;
                }
            }
        }
        if ($lookupCnt == 0) {
            return "";
        }
        $queryBuilder->from($tbl->getSqlFrom());

        // User SELECT
        $select = "";
        if ($this->UserSelect != "" && $isUser) {
            $select = $this->UserSelect;
        }

        // Set up WHERE
        $where = "";

        // Set up user id filter
        if (method_exists($tbl, "applyUserIDFilters")) {
            $where = $tbl->applyUserIDFilters($where);
        }

        // Set up current filter
        $cnt = count($this->FilterValues);
        if ($cnt > 0) {
            $val = $this->FilterValues[0];
            if ($val != "") {
                $val = strval($val);
                AddFilter($where, $this->getFilter($linkField, "=", $val, $tbl->Dbid));
            }

            // Set up parent filters
            if (is_array($this->FilterFields) && $useParentFilter) {
                $i = 1;
                foreach ($this->FilterFields as $filterField => $filterOpr) {
                    if ($filterField != "") {
                        $filterField = @$tbl->Fields[$filterField];
                        if (!$filterField) {
                            return "";
                        }
                        if ($cnt <= $i) {
                            AddFilter($where, "1=0"); // Disallow
                        } else {
                            $val = strval($this->FilterValues[$i]);
                            AddFilter($where, $this->getFilter($filterField, $filterOpr, $val, $tbl->Dbid));
                        }
                    }
                    $i++;
                }
            }
        }

        // Set up search
        if ($this->SearchValue != "") {
            // Normal autosuggest
            if (SameText($this->LookupType, "autosuggest") && !Config("LOOKUP_ALL_DISPLAY_FIELDS")) {
                AddFilter($where, $this->getAutoSuggestFilter($this->SearchValue));
            } else { // Use quick search logic
                AddFilter($where, $this->getModalSearchFilter($this->SearchValue, $tbl->Dbid));
            }
        }

        // Add filters
        if ($this->CurrentFilter != "" && $isUser) {
            AddFilter($where, $this->CurrentFilter);
        }

        // User Filter
        if ($this->UserFilter != "" && $isUser) {
            AddFilter($where, $this->UserFilter);
        }

        // Set up ORDER BY
        $orderBy = $this->UserOrderBy;

        // Return SQL part
        if ($part == "select") {
            return $select != "" ? $select : $queryBuilder->getSQL();
        } elseif ($part == "where") {
            return $where;
        } elseif ($part == "orderby") {
            return $orderBy;
        } else {
            if ($select != "") {
                $sql = $select;
                $dbType = GetConnectionType($tbl->Dbid);
                if ($where != "") {
                    $sql .= " WHERE " . $where;
                }
                if ($orderBy != "") {
                    if ($dbType == "MSSQL") {
                        $sql .= " /*BeginOrderBy*/ORDER BY " . $orderBy . "/*EndOrderBy*/";
                    } else {
                        $sql .= " ORDER BY " . $orderBy;
                    }
                }
                return $sql;
            } else {
                if ($where != "") {
                    $queryBuilder->where($where);
                }
                $flds = GetSortFields($orderBy);
                if (is_array($flds)) {
                    foreach ($flds as $fld) {
                        $queryBuilder->addOrderBy($fld[0], $fld[1]);
                    }
                }
                return $queryBuilder;
            }
        }
    }

    /**
     * Get filter
     *
     * @param object $fld Field Object
     * @param string $opr Search Operator
     * @param string $val Search Value
     * @param string $dbid Database Id
     * @return string Search Filter (SQL WHERE part)
     */
    protected function getFilter($fld, $opr, $val, $dbid)
    {
        $validValue = $val != "";
        $where = "";
        $arVal = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $val);
        if ($fld->DataType == DATATYPE_NUMBER) { // Validate numeric fields
            foreach ($arVal as $val) {
                if (!is_numeric($val)) {
                    $validValue = false;
                }
            }
        }
        if ($validValue) {
            if ($opr == "=") { // Use the IN operator
                foreach ($arVal as &$val) {
                    $val = QuotedValue($val, $fld->DataType, $dbid);
                }
                $where = $fld->Expression . " IN (" . implode(", ", $arVal) . ")";
            } else { // Custom operator
                foreach ($arVal as $val) {
                    if (in_array($opr, ['LIKE', 'NOT LIKE', 'STARTS WITH', 'ENDS WITH'])) {
                        if ($opr == 'STARTS WITH') {
                            $val .= '%';
                        } elseif ($opr == 'ENDS WITH') {
                            $val = '%' . $val;
                        } else {
                            $val = '%' . $val . '%';
                        }
                        $fldOpr = ($opr == 'NOT LIKE') ? ' NOT LIKE ' : ' LIKE ';
                        $val = QuotedValue($val, DATATYPE_STRING, $dbid);
                    } else {
                        $fldOpr = $opr;
                        $val = QuotedValue($val, $fld->DataType, $dbid);
                    }
                    if ($where != "") {
                        $where .= " OR ";
                    }
                    $where .= $fld->Expression . $fldOpr . $val;
                }
            }
        } else {
            $where = "1=0"; // Disallow
        }
        return $where;
    }

    /**
     * Get user filter
     *
     * @return string
     */
    protected function getUserFilter($useParentFilter = false)
    {
        return $this->getSqlPart("where", false, $useParentFilter);
    }

    /**
     * Execute query
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder of the SQL to be executed
     * @param string $orderBy ORDER BY clause
     * @param int $pageSize
     * @param int $offset
     * @return ResultStatement
     */
    protected function executeQuery($sql, $orderBy, $pageSize, $offset)
    {
        $tbl = $this->getTable();
        if ($tbl === null) {
            return null;
        }
        if ($sql instanceof QueryBuilder) { // Query builder
            if ($offset > -1) {
                $sql->setFirstResult($offset);
            }
            if ($pageSize > 0) {
                $sql->setMaxResults($pageSize);
            }
            $sql = $sql->getSQL();
        }
        $conn = $tbl->getConnection();
        $config = $conn->getConfiguration();
        $config->setResultCacheImpl($this->cache);
        return $conn->executeCacheQuery($sql, [], [], $this->cacheProfile);
    }

    /**
     * Get auto suggest filter
     *
     * @param string $sv Search value
     * @param object $fld Field object
     * @return string
     */
    protected function getAutoSuggestFilter($sv)
    {
        return $this->SearchExpression . Like(QuotedValue($sv . "%", DATATYPE_STRING, $this->Table->Dbid));
    }

    /**
     * Get modal search filter
     *
     * @param string $sv Search value
     * @param array $flds Fields
     * @return string
     */
    protected function getModalSearchFilter($sv, $dbid)
    {
        if (EmptyString($sv)) {
            return "";
        }
        $search = trim($sv);
        $searchType = self::$ModalLookupSearchType;
        $ar = GetQuickSearchKeywords($search, $searchType);
        $filter = "";
        foreach ($ar as $keyword) {
            if ($keyword != "") {
                $thisFilter = $this->SearchExpression . Like(QuotedValue("%$keyword%", DATATYPE_STRING, $dbid));
                AddFilter($filter, $thisFilter, $searchType);
            }
        }
        return $filter;
    }

    /**
     * Format options
     *
     * @param array $options Input options with formats:
     *  1. Manual input data, e.g.: [ ["lv1", "dv", "dv2", "dv3", "dv4"], ["lv2", "dv", "dv2", "dv3", "dv4"], etc...]
     *  2. Data from $rs->getRows(), e.g.: [ ["Field1" => "lv1", "Field2" => "dv2", ...], ["Field1" => "lv2", "Field2" => "dv2", ...], etc...]
     * @return array ["lv1" => ["lf" => "lv1", "df" => "dv", etc...], etc...]
     */
    protected function formatOptions($options)
    {
        if (!is_array($options)) {
            return null;
        }
        $keys = ["lf", "df", "df2", "df3", "df4", "ff", "ff2", "ff3", "ff4"];
        $opts = [];
        $cnt = count($keys);

        // Check values
        foreach ($options as &$ar) {
            if (is_array($ar)) {
                if ($cnt > count($ar)) {
                    $cnt = count($ar);
                }
            }
        }

        // Set up options
        if ($cnt >= 2) {
            $keys = array_splice($keys, 0, $cnt);
            foreach ($options as &$ar) {
                if (is_array($ar)) {
                    $ar = array_splice($ar, 0, $cnt);
                    $ar = array_combine($keys, $ar); // Set keys
                    $lv = $ar["lf"]; // First value as link value
                    $opts[$lv] = $ar;
                }
            }
        } else {
            return null;
        }
        return $opts;
    }
}
