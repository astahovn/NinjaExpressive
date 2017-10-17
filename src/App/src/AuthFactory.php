<?php

namespace App;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;

class AuthFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $dbAdapter = $container->get(DbAdapter::class);

        return new AuthAdapter(
            $dbAdapter,
            'users',
            'username',
            'password'
        );
    }
}
