<?php

namespace App\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use Zend\Diactoros\Response\RedirectResponse;

class RouteAuth extends BaseAction implements ServerMiddlewareInterface
{

    protected $guestPages = [
        '/',
        '/register',
    ];

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if (!$this->auth->hasIdentity() && !in_array($request->getUri()->getPath(), $this->guestPages)) {
            return new RedirectResponse('/');
        }
        if ($this->auth->hasIdentity() && in_array($request->getUri()->getPath(), $this->guestPages)) {
            return new RedirectResponse('/profile');
        }

        return $delegate->process($request);
    }
}
