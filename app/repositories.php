<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\Uniphpant\TableGateway\Service\TableGatewayService;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        TableGatewayService::class => \DI\autowire(TableGatewayService::class),
        RouteService::class => \DI\autowire(RouteService::class),
        RouteRepository::class => \DI\autowire(RouteRepository::class),
    ]);
};
