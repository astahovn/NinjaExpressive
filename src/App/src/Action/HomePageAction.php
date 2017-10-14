<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class HomePageAction implements ServerMiddlewareInterface
{
    private $template;

    private $posts;

    public function __construct(Template\TemplateRendererInterface $template = null, $posts)
    {
        $this->template = $template;
        $this->posts = $posts;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data = [
          'posts' => $this->posts
        ];

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
