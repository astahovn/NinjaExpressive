<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Interop\Container\ContainerInterface;
use App\Model\Post;

class HomePageAction extends BaseAction implements ServerMiddlewareInterface
{
    private $posts;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->posts = $container->get(Post::class)->fetchLast();
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data = [
          'posts' => $this->posts
        ];

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
