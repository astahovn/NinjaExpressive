<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;

class LoginAction implements ServerMiddlewareInterface
{
    private $template;

    private $authAdapter;

    public function __construct(Template\TemplateRendererInterface $template = null, AuthAdapter $authAdapter)
    {
        $this->template = $template;
        $this->authAdapter = $authAdapter;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $auth = new AuthenticationService();
        if ($auth->hasIdentity()) {
            return new RedirectResponse('/');
        }

        $method = $request->getMethod();
        if ('POST' === $method) {
            $params = $request->getParsedBody();

            $this->authAdapter
                ->setIdentity($params['login'])
                ->setCredential($params['password']);

            $result = $auth->authenticate($this->authAdapter);
            if ($result->isValid()) {
                return new RedirectResponse('/');
            }
        }

        return new HtmlResponse($this->template->render('app::login-page'));
    }
}
