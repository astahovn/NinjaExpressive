<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Authentication\AuthenticationService;

class LogoutAction implements ServerMiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $auth = new AuthenticationService();

        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
        }
        return new RedirectResponse('/');
    }
}
