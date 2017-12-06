<?php

namespace App\Action\Chat;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;

class CreateAction extends BaseAction implements ServerMiddlewareInterface
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
       return new HtmlResponse($this->template->render('app-chat::create-page', []));
    }
}
