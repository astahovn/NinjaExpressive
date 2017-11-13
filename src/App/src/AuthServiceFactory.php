<?php

namespace App;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;

class AuthServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $authStorage = $container->get(AuthStorage::class);
        $authService = new AuthenticationService($authStorage);

        return $authService;
    }
}
