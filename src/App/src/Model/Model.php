<?php

namespace App\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Model
{

    protected $db;

    /** @var string */
    protected $tableName;

    public function __construct(Adapter $db)
    {
        $this->db = $db;
    }

    /**
     * Create row
     * @param array $values
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function create($values)
    {
        $sql = new Sql($this->db);
        $insert = $sql->insert($this->tableName);
        $insert->values($values);
        $statement = $sql->prepareStatementForSqlObject($insert);
        return $statement->execute();
    }

    /**
     * Update data
     * @param array $fields
     * @param string $where
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function update($fields, $where)
    {
        $sql = new Sql($this->db);
        $update = $sql->update($this->tableName);
        $update->set($fields)->where($where);
        $statement = $sql->prepareStatementForSqlObject($update);
        return $statement->execute();
    }

    /**
     * Fetch data
     * @param string $where
     * @return bool
     */
    public function fetchRow($where)
    {
        $sql = new Sql($this->db);
        $select = $sql->select($this->tableName);
        $select->where($where)->limit(1);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result->current();
    }
}