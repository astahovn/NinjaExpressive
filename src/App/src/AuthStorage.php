<?php

namespace App;

use Interop\Container\ContainerInterface;
use Zend\Authentication\Storage;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Sql\Sql;
use App\Model\User;

class AuthStorage implements Storage\StorageInterface
{
    protected $sql;

    /** @var User */
    protected $modelUser;

    protected $identity;

    public function __construct(ContainerInterface $container)
    {
        $dbAdapter = $container->get(DbAdapter::class);
        $this->sql = new Sql($dbAdapter);

        $this->modelUser = $container->get(User::class);
    }

    /**
     * Returns true if and only if storage is empty
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface If it is impossible to determine whether storage is empty
     * @return bool
     */
    public function isEmpty()
    {
        if (null !== $this->identity) {
            return false;
        }
        if (empty($_COOKIE['PHPSESSID'])) {
            if (!session_id()) {
                session_start();
            }
            return true;
        }
        $select = $this->sql->select('sessions');
        $select->where(['auth_token' => $_COOKIE['PHPSESSID']]);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if ($results->count()) {
            $session = $results->current();
            $user = $this->modelUser->findById($session['user_id']);
            $this->identity = $user->getUsername();
        }
        return is_null($this->identity);
    }

    /**
     * Returns the contents of storage
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface If reading contents from storage is impossible
     * @return mixed
     */
    public function read()
    {
        return $this->identity;
    }

    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * @throws \Zend\Authentication\Exception\ExceptionInterface If writing $contents to storage is impossible
     * @return void
     */
    public function write($contents)
    {
        $user = $this->modelUser->findByUsername($contents);
        $insert = $this->sql->insert('sessions');
        $insert->values([
            'user_id' => $user->getId(),
            'auth_token' => $_COOKIE['PHPSESSID']
        ]);
        $statement = $this->sql->prepareStatementForSqlObject($insert);
        $statement->execute();

        $this->identity = $contents;
    }

    /**
     * Clears contents from storage
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface If clearing contents from storage is impossible
     * @return void
     */
    public function clear()
    {
        $delete = $this->sql->delete('sessions');
        $delete->where(['auth_token' => $_COOKIE['PHPSESSID']]);
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        $statement->execute();

        $this->identity = null;
    }
}