<?php

namespace App\Action\Profile;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use App\Model\User;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

class EditAction extends BaseAction implements ServerMiddlewareInterface
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
        $method = $request->getMethod();
        $params = $request->getParsedBody();
        $errors = [];
        if ('POST' === $method) {
            if (empty($params['nick'])) {
                $errors[] = 'Nick field is empty';
            }

            if (!count($errors)) {
                $user = $this->modelUser->findById($this->activeUser->getId());
                $user->setNick($params['nick']);
                $user->setOpenKey($params['open_key']);
                $user->setPrivateKeyCheck($params['private_key_check']);
                $this->em->persist($user);
                $this->em->flush();
                return new JsonResponse(['success' => true]);
            }

        } else {
            $params['nick'] = $this->activeUser->getNick();
            $params['open_key'] = $this->activeUser->getOpenKey();
        }

        $tplData = [
            'errors' => $errors,
            'nick' => $params['nick'] ?? '',
            'open_key' => $params['open_key'] ?? '',
        ];

        return new HtmlResponse($this->template->render('app-profile::edit-page', $tplData));
    }
}
