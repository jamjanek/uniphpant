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
 * Attribute: site_route
 */

class RouteDataMiddleware implements Middleware
{
    private $logger;
    private $tableGatewayService;

    const ATTR_NAME = "site_route";

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
        $routeMethods = $request->getAttribute(FetchRouteMiddleware::ATTR_NAME)->getMethods();
        $routeName = $request->getAttribute(FetchRouteMiddleware::ATTR_NAME)->getName();
        $siteConfig = $request->getAttribute(SiteConfigMiddleware::ATTR_NAME);

        $siteRouteConfig = $siteConfig['route'];

        $tableGatewayCollection = new ArrayObject();

        if(array_key_exists('table_gateway',$siteRouteConfig)) {
            foreach($siteRouteConfig['table_gateway'] as $tableGatewayName) {
                if(array_key_exists('table_gateway',$siteConfig)) {
                    foreach($siteConfig['table_gateway'] as $tableGatewayConfig) {
                        if($tableGatewayConfig['name']===$tableGatewayName) {
                            // find adapter
                            if (array_key_exists('data_source',$tableGatewayConfig)) {
                                foreach($siteConfig['data_source'] as $dataSourceConfig) {
                                    if($dataSourceConfig['name']===$tableGatewayConfig['data_source']) {
                                        $dataAdapter = new dbAdapter($dataSourceConfig);
                                        $tableGateway = new TableGateway(
                                            $tableGatewayConfig,
                                            $dataAdapter
                                        );
                                        $tableGatewayCollection->offsetSet(
                                            $tableGatewayConfig,
                                            $tableGateway
                                        );
                                    }
                                    break;
                                }
                            }
                            break;
                        }
                    }
                }
            }
        }

var_dump($siteConfig);die();
var_dump($this->tableGatewayService);die();
//var_dump($routeName);die();

        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $request = $request->withAttribute(self::ATTR_NAME, $route);

        return $handler->handle($request);
    }
}
