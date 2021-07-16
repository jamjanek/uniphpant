<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\Uniphpant\TableGateway\Service\TableGatewayService;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        TableGatewayService::class => \DI\autowire(TableGatewayService::class)
    ]);
};
