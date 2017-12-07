<?php

namespace App\Action\Chat;

use App\Entity\Conversation;
use App\Entity\ConversationUser;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use Zend\Diactoros\Response\JsonResponse;

class CreateAction extends BaseAction implements ServerMiddlewareInterface
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $method = $request->getMethod();
        $params = $request->getParsedBody();
        if ('POST' === $method) {
            if (empty($params['key']) || empty($params['theme'])) {
                return new JsonResponse(['error' => 'Not enough data for saving']);
            }
            // Create conversation
            $chat = new Conversation();
            $chat->setTheme($params['theme']);
            $this->em->persist($chat);
            $this->em->flush();

            // Create first user
            $chatUser = new ConversationUser();
            $chatUser->setConversationId($chat->getId());
            $chatUser->setUserId($this->activeUser->getId());
            $chatUser->setKey($params['key']);
            $this->em->persist($chatUser);
            $this->em->flush();
            return new JsonResponse(['success' => true]);
        }
        return new HtmlResponse($this->template->render('app-chat::create-page', []));
    }
}
