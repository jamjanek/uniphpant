<?php
declare(strict_types=1);

use App\Uniphpant\Settings\Settings;
use App\Uniphpant\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../var/logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'app' => [
                    'declaration' => [
                        'glob_paths' => 'site-*.{json,yaml,php}',
                        'cache_enabled' => $_ENV['APP_CACHE_ENABLED'],
                        'cache_perm' => 665,
                        'cache_dir' => 'var/cache/',
                        'cache_key' => 'site_declaration_cache',
                    ]
                ],
                'spa' => [
                    'settings' => [
                        'glob_paths' => '/site.{json,yaml,php}',
                        'cache_enabled' => $_ENV['SITE_CACHE_ENABLED'],
                        'cache_perm' => 665,
                        'cache_dir' => 'var/cache/',
                        'cache_key' => 'site_settings_cache',
                    ],
                    'config' => [
                        'glob_paths' => 'config/*.{json,yaml,php}',
                        'cache_enabled' => $_ENV['SITE_CACHE_ENABLED'],
                        'cache_perm' => 665,
                        'cache_dir' => 'var/cache/',
                        'cache_key' => 'site_config_cache',
                    ],
                ]
            ]);
        }
    ]);
};
