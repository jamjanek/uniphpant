<?php
declare(strict_types=1);

namespace App\Uniphpant\Route\Middleware;

use App\Uniphpant\TableGateway\Service\TableGatewayService;
use App\Uniphpant\Config\Middleware\SiteConfigMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Slim\Routing\RouteContext;
use ArrayObject;
use Laminas\Db\Adapter\Adapter as dbAdapter;
use Laminas\Db\TableGateway\TableGateway;

/**
 * Attribute: site_route_data
 */

class RouteDataMiddleware implements Middleware
{
    private $logger;
    private $tableGatewayService;

    const ATTR_NAME = "site_route_data";

    public function __construct(LoggerInterface $logger, TableGatewayService $tableGatewayService)
    {
        $this->logger = $logger;
        $this->tableGatewayService = $tableGatewayService;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $routeName = $request->getAttribute(FetchRouteMiddleware::ATTR_NAME)->getName();
        var_dump($routeName);die();
        $routeGateway = $request->getAttribute("table_gateway")->offsetGet('route');

        $result = $routeGateway->select(['route_name'=>$routeName])->current();

        $request = $request->withAttribute(self::ATTR_NAME, $result);

        return $handler->handle($request);
    }
}
