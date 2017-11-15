<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Authentication\AuthenticationService as AuthService;
use Zend\Expressive\Plates\PlatesRenderer;
use Doctrine\ORM\EntityManager;
use App\Model\User;

class BaseAction
{
    /** @var PlatesRenderer */
    protected $template;

    /** @var AuthService */
    protected $auth;

    /** @var \App\Entity\User */
    protected $activeUser;

    /** @var EntityManager */
    protected $em;

    public function __construct(ContainerInterface $container)
    {
        $this->auth = $container->get(AuthService::class);
        if ($this->auth->hasIdentity()) {
            /** @var User $userModel */
            $userModel = $container->get(User::class);
            $this->activeUser = $userModel->findById($this->auth->getIdentity());
        } else {
            $this->activeUser = false;
        }
        $this->template = $container->get(TemplateRendererInterface::class);
        $this->template->addDefaultParam(PlatesRenderer::TEMPLATE_ALL, 'activeUser', $this->activeUser);
        $this->em = $container->get('doctrine.entity_manager.orm_default');
    }

}
