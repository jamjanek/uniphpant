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
                'spa' => [
                    'site_declaration_glob_paths' => 'site-*.{json,yaml,php}',
                    'site_declaration_cache_enabled' => true,
                    'site_declaration_cache_filemode' => 665,
                    'site_declaration_cache_dir' => '/var/cache/',
                    'site_declaration_cache_key' => 'sites_cache',
                    
                    'site_settings_glob_paths' => '/site.{json,yaml,php}',
                    'site_settings_cache_enabled' => true,
                    'site_settings_cache_filemode' => 665,
                    'site_settings_cache_dir' => 'var/cache/',
                    'site_settings_cache_key' => 'site_settings_cache',

                    'site_config_cache_enabled' => true,
                    'site_config_glob_paths' => '/config/*.{json,yaml,php}',
                    'site_config_cache_key' => 'site_config_cache',
                    'site_config_cache_dir' => '/var/cache/',
                    'site_config_cache_filename' => 'config.php',
                ]
            ]);
        }
    ]);
};
