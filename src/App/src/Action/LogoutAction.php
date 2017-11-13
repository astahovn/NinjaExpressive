<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService as AuthService;

class LogoutAction implements ServerMiddlewareInterface
{
    protected $auth;

    public function __construct(ContainerInterface $container)
    {
        $this->auth = $container->get(AuthService::class);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if ($this->auth->hasIdentity()) {
            $this->auth->clearIdentity();
        }
        return new RedirectResponse('/');
    }
}
