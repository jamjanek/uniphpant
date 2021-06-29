<?php
declare(strict_types=1);

namespace App\Uniphpant\Route\Middleware;

use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Uri\UriInterface as UriInterface;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Slim\Routing\RouteContext;

/**
 * Attribute: site_route
 */

class RouteDataMiddleware implements Middleware
{
    private $logger;

    const ATTR_NAME = "site_route";

    public function __construct(LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $routeMethods = $request->getAttribute(FetchRouteMiddleware::ATTR_NAME)->getMethods();
        $routeName = $request->getAttribute(FetchRouteMiddleware::ATTR_NAME)->getName();

//var_dump($routeName);die();

        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $request = $request->withAttribute(self::ATTR_NAME, $route);

        return $handler->handle($request);
    }
}
