<?php

namespace App\Action\Conversation;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use Zend\Diactoros\Response\JsonResponse;
use App\Model\Conversation;

class CreateAction extends BaseAction implements ServerMiddlewareInterface
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
        $method = $request->getMethod();
        $params = $request->getParsedBody();
        if ('POST' === $method) {
            if (empty($params['key']) || empty($params['theme'])) {
                return new JsonResponse(['error' => 'Not enough data for saving']);
            }
            $this->mConversation->create($params['theme'], $params['key'], $this->activeUser->getId());
            return new JsonResponse(['success' => true]);
        }
        return new HtmlResponse($this->template->render('app-conversation::create-page', []));
    }
}
