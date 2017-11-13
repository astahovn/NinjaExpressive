<?php

namespace App;

use Interop\Container\ContainerInterface;

class BaseFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new $requestedName($container);
    }
}
