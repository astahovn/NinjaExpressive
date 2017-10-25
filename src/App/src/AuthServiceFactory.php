<?php

namespace App;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;

class AuthServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $authService = new AuthenticationService();

        return $authService;
    }
}
