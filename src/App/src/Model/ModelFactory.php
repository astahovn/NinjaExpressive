<?php

namespace App\Model;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;

class ModelFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new $requestedName($container->get(DbAdapter::class));
    }
}
