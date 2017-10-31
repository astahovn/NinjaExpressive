<?php

namespace App\Action\Profile;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use App\Model\User;

class IndexAction extends BaseAction implements ServerMiddlewareInterface
{
    /** @var User */
    protected $modelUser;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->modelUser = $container->get(User::class);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $userData = $this->modelUser->fetch($this->auth->getIdentity());

        $tplData = [
            'profile' => [
                'nick' => $userData['nick'] ?: 'not filled'
            ]
        ];

        return new HtmlResponse($this->template->render('app-profile::index-page', $tplData));
    }
}
