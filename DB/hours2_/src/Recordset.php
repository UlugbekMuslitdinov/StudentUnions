<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\FetchMode;

/**
 * Recordset class
 */
class Recordset
{
    public $Result;
    public $fields; // Note: Use lowercase for backward compatibility
    public $EOF = true;
    private $RowCount = -1;
    private $Sql;
    private $Connection;

    /**
     * Constructor
     *
     * @param Result $result Result
     * @param QueryBuilder|string $sql QueryBuilder or SQL
     * @param Connection $c Connection (required if $sql is string)
     * @return void
     */
    public function __construct($result, $sql = null, $c = null)
    {
        if ($result) {
            $this->Result =& $result;
        }
        $this->Sql = $sql;
        $this->Connection = $c;
        $this->RowCount = $this->Result->rowCount();
        $this->fields = $this->fetch();
    }

    // Record count
    public function recordCount()
    {
        if ($this->RowCount <= 0 && $this->Sql) {
            $this->RowCount = ExecuteRecordCount($this->Sql, $this->Connection);
        }
        return $this->RowCount;
    }

    // Move next
    public function moveNext()
    {
        $this->fields = $this->fetch();
    }

    // Move
    public function move($cnt)
    {
        for ($i = 0; $i < $cnt; $i++) {
            $this->fields = $this->fetch();
        }
    }

    // Get rows
    public function getRows(int $mode = FetchMode::ASSOCIATIVE)
    {
        return $this->Result->fetchAll($mode);
    }

    // Field count
    public function fieldCount()
    {
        return $this->Result->columnCount();
    }

    // Fetch
    public function fetch(int $mode = FetchMode::ASSOCIATIVE)
    {
        if ($this->Result) {
            $res = $this->Result->fetch($mode);
            $this->EOF = $res === false;
            return $res;
        }
        return false;
    }

    // Close
    public function close()
    {
        if ($this->Result) {
            $this->Result->free();
        }
    }
}
