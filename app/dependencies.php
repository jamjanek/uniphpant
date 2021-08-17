<?php
declare(strict_types=1);

use App\Uniphpant\Settings\Reader\Json as JsonReader;
use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Settings\SettingsInterface;
use App\Uniphpant\Settings\Service\SPASettingsService;
use App\Uniphpant\TableGateway\Service\TableGatewayService;
use App\Uniphpant\Uri\Uri;
use App\Uniphpant\Uri\UriInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PhpRenderer::class => function (ContainerInterface $c) {
            return new PhpRenderer();
        },
        UriInterface::class => function (ContainerInterface $c) {
            return new Uri();
        },
        JsonInterface::class => function (ContainerInterface $c) {
            return new JsonReader();
        },
        TableGatewayService::class => \DI\autowire(TableGatewayService::class),
//        SPASettingsService::class => \DI\autowire(SPASettingsService::class)
//        TableGatewayService::class => function(ContainerInterface $c) {
//            // @POC
//            //It collects and initializes all table_gateway found in config
////            $settings = $c->get('settings');
////            $tableGatewaySettings = $settings[TableGatewaySpecEntity::ALIAS];
//            $tableGatewayCollection = new ArrayObject();
//            return new TableGatewayService($tableGatewayCollection);
//        }
    ]);
};
