<?php
declare(strict_types=1);

namespace App\Uniphpant\TableGateway\Middleware;

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
 * Attribute: table_gateway
 */

class TableGatewayMiddleware implements Middleware
{
    private $logger;
    private $tableGatewayService;

    const ATTR_NAME = "table_gateway";

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
                                            $tableGatewayConfig['table_name'],
                                            $dataAdapter
                                        );

                                        $tableGatewayCollection->offsetSet(
                                            $tableGatewayConfig['data_source'],
                                            $tableGateway
                                        );
                                        break;
                                    }
                                }
                            }
                            break;
                        }
                    }
                }
            }
        }

        $request = $request->withAttribute(self::ATTR_NAME, $tableGatewayCollection);

        return $handler->handle($request);
    }
}
