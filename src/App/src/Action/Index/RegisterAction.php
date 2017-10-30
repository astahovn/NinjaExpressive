<?php

namespace App\Action\Index;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Action\BaseAction;
use App\Model\User;

class RegisterAction extends BaseAction implements ServerMiddlewareInterface
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
        $error = false;
        $success = false;
        if ('POST' === $method) {
            $error = (empty($params['login']) || empty($params['password']));

            if (!$error) {
                $this->modelUser->register($params['login'], $params['password']);
                $success = true;
            }
        }

        $tplData = [
            'error' => $error,
            'success' => $success,
            'login' => $params['login'] ?? ''
        ];

        return new HtmlResponse($this->template->render('app-index::register-page', $tplData));
    }
}
