<?php

namespace App\Model;

use Interop\Container\ContainerInterface;

class ModelFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new $requestedName($container->get('Zend\Db\Adapter\Adapter'));
    }
}
