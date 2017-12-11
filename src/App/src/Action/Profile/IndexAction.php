<?php

namespace App\Action\Profile;

use App\Model\Conversation;
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

    /** @var Conversation */
    protected $mConversation;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->modelUser = $container->get(User::class);
        $this->mConversation = $container->get(Conversation::class);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $tplData = [
            'profile' => [
                'nick' => $this->activeUser->getNick() ?: 'not filled',
                'has_open_key' => !!$this->activeUser->getOpenKey(),
            ],
            'conversations' => $this->mConversation->fetchList($this->activeUser->getId())
        ];

        return new HtmlResponse($this->template->render('app-profile::index-page', $tplData));
    }
}
