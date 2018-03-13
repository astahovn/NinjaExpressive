<?php

namespace App\Action\Conversation;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use App\Model\Conversation;

class ChatAction extends BaseAction implements ServerMiddlewareInterface
{
    /** @var Conversation */
    protected $mConversation;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->mConversation = $container->get(Conversation::class);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $conversationId = $request->getAttribute('id');
        $conversation = $this->mConversation->findById($conversationId);
        $tplData = [
            'theme' => $conversation->getTheme(),
        ];
        return new HtmlResponse($this->template->render('app-conversation::view-page', $tplData));
    }
}
