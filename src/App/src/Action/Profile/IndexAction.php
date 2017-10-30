<?php

namespace App\Action\Profile;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;

class IndexAction extends BaseAction implements ServerMiddlewareInterface
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $tplData = [
            'profile' => [
                'nick' => $this->auth->getIdentity()
            ]
        ];

        return new HtmlResponse($this->template->render('app-profile::index-page', $tplData));
    }
}
