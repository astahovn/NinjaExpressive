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
        $errors = [];
        $success = false;
        if ('POST' === $method) {
            if (empty($params['login'])) {
                $errors[] = 'Login field is empty';
            }
            if (empty($params['password'])) {
                $errors[] = 'Password field is empty';
            }

            if (!count($errors)) {
                $result = $this->modelUser->register($params['login'], $params['password']);
                if (is_string($result)) {
                    $errors[] = $result;
                } else {
                    $success = true;
                }
            }
        }

        $tplData = [
            'errors' => $errors,
            'success' => $success,
            'login' => $params['login'] ?? ''
        ];

        return new HtmlResponse($this->template->render('app-index::register-page', $tplData));
    }
}
