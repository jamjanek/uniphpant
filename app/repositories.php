<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\Uniphpant\TableGateway\Service\TableGatewayService;
use App\Uniphpant\Domain\Area\Repository\AreaReadRepository;
use App\Uniphpant\TableGateway\Domain\TableGatewayCollection;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([

        AreaReadRepository::class => \DI\autowire(AreaReadRepository::class),
        TableGatewayCollection::class => \DI\autowire(TableGatewayCollection::class),
//        RouteService::class => \DI\autowire(RouteService::class),
//        RouteRepository::class => \DI\autowire(RouteRepository::class),
    ]);
};
