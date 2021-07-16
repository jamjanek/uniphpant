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
        $tableGatewayConfigCollection = $siteConfig['table_gateway'];
        $dataSourceConfigCollection = $siteConfig['data_source'];
        $tableGatewayCollection = new ArrayObject();

        foreach($tableGatewayConfigCollection as $tableGatewayConfig) {
            foreach($dataSourceConfigCollection as $dataSourceConfig) {

                if($tableGatewayConfig['data_source']===$dataSourceConfig['name']) {
                    $dataAdapter = new dbAdapter($dataSourceConfig);
                    $tableGateway = new TableGateway(
                        $tableGatewayConfig['table_name'],
                        $dataAdapter
                    );

                    $tableGatewayCollection->offsetSet(
                        $tableGatewayConfig['name'],
                        $tableGateway
                    );
                    break;
                }
            }
        }

        $request = $request->withAttribute(self::ATTR_NAME, $tableGatewayCollection);

        return $handler->handle($request);
    }
}
