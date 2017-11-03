<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Authentication\AuthenticationService as AuthService;
use Zend\Expressive\Plates\PlatesRenderer;
use Doctrine\ORM\EntityManager;

class BaseAction
{
    /** @var PlatesRenderer */
    protected $template;

    /** @var AuthService */
    protected $auth;

    /** @var EntityManager */
    protected $em;

    public function __construct(ContainerInterface $container)
    {
        $this->auth = $container->get(AuthService::class);
        $this->template = $container->get(TemplateRendererInterface::class);
        $this->template->addDefaultParam(PlatesRenderer::TEMPLATE_ALL, 'auth', $this->auth);
        $this->em = $container->get('doctrine.entity_manager.orm_default');
    }

}
