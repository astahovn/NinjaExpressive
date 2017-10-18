<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

class LoginFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $authAdapter = $container->get(CallbackCheckAdapter::class);

        return new LoginAction($template, $authAdapter);
    }
}
