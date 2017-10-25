<?php

namespace App;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter as AuthAdapter;

class AuthAdapterFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $dbAdapter = $container->get(DbAdapter::class);

        $passwordValidation = function ($hash, $password) {
            return password_verify($password, $hash);
        };

        return new AuthAdapter(
            $dbAdapter,
            'users',
            'username',
            'password',
            $passwordValidation
        );
    }
}
