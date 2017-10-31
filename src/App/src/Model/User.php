<?php

namespace App\Model;

use Zend\Db\Sql\Sql;

class User extends Model
{
    const TABLE_NAME = 'users';

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

        $sql = new Sql($this->db);
        $insert = $sql->insert(self::TABLE_NAME);
        $insert->values([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        return $statement->execute();
    }

    /**
     * Check if user exists
     * @param string $username
     * @return bool
     */
    public function isExists($username)
    {
        $sql = new Sql($this->db);
        $select = $sql->select(self::TABLE_NAME);
        $select->columns(['id'])->where(['username' => $username]);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return ($result->count() > 0);
    }

}