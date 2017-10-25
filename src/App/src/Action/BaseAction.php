<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class BaseAction
{
    protected $template;

    public function __construct(ContainerInterface $container)
    {
        $this->template = $container->get(TemplateRendererInterface::class);
    }

}
