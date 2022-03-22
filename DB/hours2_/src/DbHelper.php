<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\FetchMode;

/**
 * Class DbHelper
 */
class DbHelper
{
    // Connection
    public $Connection;

    // Constructor
    public function __construct($dbid = 0)
    {
        $this->Connection = GetConnection($dbid); // Open connection
    }

    // Connection ID
    public function connectionId()
    {
        return GetConnectionId($dbid);
    }

    // Load recordset
    public function &loadRecordset($sql)
    {
        return LoadRecordset($sql, $this->Connection);
    }

    // Execute UPDATE, INSERT, or DELETE statements
    public function execute($sql, $fn = null)
    {
        return Execute($sql, $fn, $this->Connection);
    }

    // Executes the query, and returns as HTML
    public function executeHtml($sql, $options = null)
    {
        return ExecuteHtml($sql, $options, $this->Connection);
    }

    // Executes the query, and returns the row(s) as JSON
    public function executeJson($sql, $options = null)
    {
        return ExecuteJson($sql, $options, $this->Connection);
    }

    /**
     * Prepares and executes an SQL query and returns the result as an associative array with the keys
     * mapped to the first column and the values mapped to the second column.
     *
     * @param string                                                               $query  SQL query
     * @param list<mixed>|array<string, mixed>                                     $params Query parameters
     * @param array<int, int|string|Type|null>|array<string, int|string|Type|null> $types  Parameter types
     *
     * @return array<mixed,mixed>
     */
    public function fetchAllKeyValue(string $query, array $params = [], array $types = []): array
    {
        return $this->Connection->fetchAllKeyValue($query, $params, $types);
    }

    /**
     * Prepares and executes an SQL query and returns the result as an associative array with the keys mapped
     * to the first column and the values being an associative array representing the rest of the columns
     * and their values.
     *
     * @param string                                                               $query  SQL query
     * @param list<mixed>|array<string, mixed>                                     $params Query parameters
     * @param array<int, int|string|Type|null>|array<string, int|string|Type|null> $types  Parameter types
     *
     * @return array<mixed,array<string,mixed>>
     */
    public function fetchAllAssociativeIndexed(string $query, array $params = [], array $types = []): array
    {
        return $this->Connection->fetchAllAssociativeIndexed($query, $params, $types);
    }

    /**
     * Executes an SQL statement with the given parameters and returns the number of affected rows.
     *
     * Could be used for:
     *  - DML statements: INSERT, UPDATE, DELETE, etc.
     *  - DDL statements: CREATE, DROP, ALTER, etc.
     *  - DCL statements: GRANT, REVOKE, etc.
     *  - Session control statements: ALTER SESSION, SET, DECLARE, etc.
     *  - Other statements that don't yield a row set.
     *
     * This method supports PDO binding types as well as DBAL mapping types.
     *
     * @param string                                                               $sql    SQL statement
     * @param list<mixed>|array<string, mixed>                                     $params Statement parameters
     * @param array<int, int|string|Type|null>|array<string, int|string|Type|null> $types  Parameter types
     *
     * @return int The number of affected rows.
     */
    public function executeStatement($sql, array $params = [], array $types = [])
    {
        return $this->Connection->executeQuery($sql, $params, $types);
    }

    // Executes the query, and returns the first column of the first row
    public function executeScalar(string $sql)
    {
        return $this->Connection->fetchOne($sql);
    }

    // Executes the query, and returns the first row
    public function executeRow($sql, $mode = FetchMode::ASSOCIATIVE)
    {
        switch ($mode) {
            case FetchMode::ASSOCIATIVE:
                return $this->Connection->fetchAssociative($sql);
            case FetchMode::NUMERIC:
                return $this->Connection->fetchNumeric($sql);
            case FetchMode::COLUMN:
                return $this->Connection->fetchOne($sql);
        }
        throw new LogicException('Only fetch modes declared on Doctrine\DBAL\FetchMode are supported.');
    }

    // Executes the query, and returns all rows
    public function executeRows($sql, $mode = FetchMode::ASSOCIATIVE)
    {
        switch ($mode) {
            case FetchMode::ASSOCIATIVE:
                return $this->Connection->fetchAllAssociative($sql);
            case FetchMode::NUMERIC:
                return $this->Connection->fetchAllNumeric($sql);
            case FetchMode::COLUMN:
                return $this->Connection->fetchFirstColumn($sql);
        }
        throw new LogicException('Only fetch modes declared on Doctrine\DBAL\FetchMode are supported.');
    }
}
