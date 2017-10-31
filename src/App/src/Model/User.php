<?php

namespace App\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class User extends Model
{

    public function __construct(Adapter $db)
    {
        parent::__construct($db);

        $this->tableName = 'users';
    }

    /**
     * New user registration
     * @param string $username
     * @param string $password
     * @return \Zend\Db\Adapter\Driver\ResultInterface|string
     */
    public function register($username, $password)
    {
        if ($this->isExists($username)) {
            return 'Login is busy';
        }

        return $this->create([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    /**
     * Check if user exists
     * @param string $username
     * @return bool
     */
    public function isExists($username)
    {
        $sql = new Sql($this->db);
        $select = $sql->select($this->tableName);
        $select->columns(['id'])->where(['username' => $username]);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return ($result->count() > 0);
    }

}