<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use App\Uniphpant\TableGateway\Service\TableGatewayService;
use App\Uniphpant\Settings\Service\SPASettingsService;
use App\Uniphpant\Settings\Service\SiteSettingsService;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        TableGatewayService::class => \DI\autowire(TableGatewayService::class),
        SPASettingsService::class => \DI\autowire(SPASettingsService::class),
        SiteSettingsService::class => \DI\autowire(SiteSettingsService::class)
    ]);
};
