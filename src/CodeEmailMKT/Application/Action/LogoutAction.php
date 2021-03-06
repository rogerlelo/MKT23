<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;

class LogoutAction
{
    private $router;

    private $authService;

    public function __construct(
        Router\RouterInterface $router,
        AuthInterface $authService
    ){
        $this->router   = $router;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->authService->destroy();
        $uri = $this->router->generateUri('auth.login');/////////redireciona
        return new RedirectResponse($uri);
    }
}
