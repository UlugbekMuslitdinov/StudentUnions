<?php

namespace PHPMaker2022\project1;

/**
 * Basic Search class
 */
class BasicSearch
{
    public $TableVar = "";
    public $BasicSearchAnyFields;
    public $Keyword = "";
    public $KeywordDefault = "";
    public $Type = "";
    public $TypeDefault = "";
    protected $Prefix = "";

    // Constructor
    public function __construct($tblvar)
    {
        $this->BasicSearchAnyFields = Config("BASIC_SEARCH_ANY_FIELDS");
        $this->TableVar = $tblvar;
        $this->Prefix = PROJECT_NAME . "_" . $tblvar . "_";
    }

    // Session variable name
    protected function getSessionName($suffix)
    {
        return $this->Prefix . $suffix;
    }

    // Load default
    public function loadDefault()
    {
        $this->Keyword = $this->KeywordDefault;
        $this->Type = $this->TypeDefault;
        if (!isset($_SESSION[$this->getSessionName(Config("TABLE_BASIC_SEARCH_TYPE"))]) && $this->TypeDefault != "") { // Save default to session
            $this->setType($this->TypeDefault);
        }
    }

    // Unset session
    public function unsetSession()
    {
        Session()->delete($this->getSessionName(Config("TABLE_BASIC_SEARCH_TYPE")))
            ->delete($this->getSessionName(Config("TABLE_BASIC_SEARCH")));
    }

    // Isset session
    public function issetSession()
    {
        return isset($_SESSION[$this->getSessionName(Config("TABLE_BASIC_SEARCH"))]);
    }

    // Set keyword
    public function setKeyword($v, $save = true)
    {
        if (Config("REMOVE_XSS")) {
            $v = RemoveXss($v);
        }
        $this->Keyword = $v;
        if ($save) {
            $_SESSION[$this->getSessionName(Config("TABLE_BASIC_SEARCH"))] = $v;
        }
    }

    // Set type
    public function setType($v, $save = true)
    {
        if (Config("REMOVE_XSS")) {
            $v = RemoveXss($v);
        }
        $this->Type = $v;
        if ($save) {
            $_SESSION[$this->getSessionName(Config("TABLE_BASIC_SEARCH_TYPE"))] = $v;
        }
    }

    // Save
    public function save()
    {
        $_SESSION[$this->getSessionName(Config("TABLE_BASIC_SEARCH"))] = $this->Keyword;
        $_SESSION[$this->getSessionName(Config("TABLE_BASIC_SEARCH_TYPE"))] = $this->Type;
    }

    // Get keyword
    public function getKeyword()
    {
        return Session($this->getSessionName(Config("TABLE_BASIC_SEARCH")));
    }

    // Get type
    public function getType()
    {
        return Session($this->getSessionName(Config("TABLE_BASIC_SEARCH_TYPE")));
    }

    // Get type name
    public function getTypeName()
    {
        global $Language;
        $typ = $this->getType();
        switch ($typ) {
            case "=":
                return $Language->phrase("QuickSearchExact");
            case "AND":
                return $Language->phrase("QuickSearchAll");
            case "OR":
                return $Language->phrase("QuickSearchAny");
            default:
                return $Language->phrase("QuickSearchAuto");
        }
    }

    // Get short type name
    public function getTypeNameShort()
    {
        global $Language;
        $typ = $this->getType();
        switch ($typ) {
            case "=":
                $typname = $Language->phrase("QuickSearchExactShort");
                break;
            case "AND":
                $typname = $Language->phrase("QuickSearchAllShort");
                break;
            case "OR":
                $typname = $Language->phrase("QuickSearchAnyShort");
                break;
            default:
                $typname = $Language->phrase("QuickSearchAutoShort");
                break;
        }
        if ($typname != "") {
            $typname .= "&nbsp;";
        }
        return $typname;
    }

    // Get keyword list
    public function keywordList($default = false)
    {
        $searchKeyword = $default ? $this->KeywordDefault : $this->Keyword;
        $searchType = $default ? $this->TypeDefault : $this->Type;
        if ($searchKeyword != "") {
            $search = trim($searchKeyword);
            $ar = GetQuickSearchKeywords($search, $searchType);
            return $ar;
        }
        return [];
    }

    // Load
    public function load()
    {
        $this->Keyword = $this->getKeyword();
        $this->Type = $this->getType();
    }
}
