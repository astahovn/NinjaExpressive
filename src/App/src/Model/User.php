<?php

namespace App\Model;

use Zend\Db\Sql\Sql;

class User extends Model
{

    /**
     * New user registration
     * @param string $username
     * @param string $password
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function register($username, $password)
    {
        $sql = new Sql($this->db);
        $insert = $sql->insert('users');
        $insert->values([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        return $statement->execute();
    }

}