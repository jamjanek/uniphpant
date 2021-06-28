<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use App\Uniphpant\Request\Middleware\HostCurrentMiddleware;
use App\Uniphpant\Settings\Middleware\SiteDeclarationMiddleware;
use App\Uniphpant\Settings\Middleware\SPASettingsMiddleware;
use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Settings\SettingsInterface;
use App\Uniphpant\Site\Middleware\SiteIdMiddleware;
use App\Uniphpant\Uri\UriInterface as UriInterface;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

class SiteSettingsMiddleware implements Middleware
{
    const ATTR_NAME = "site_settings";

    private $logger;

    protected $settings;


    public function __construct(LoggerInterface $logger,
                                SettingsInterface $settings
    )
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $siteId = $request->getAttribute(SiteIdMiddleware::ATTR_NAME);
        $siteDeclaration = $request->getAttribute(SiteDeclarationMiddleware::ATTR_NAME);
        $spaSettings = $request->getAttribute(SPASettingsMiddleware::ATTR_NAME);
        $siteSettingsPath = __DIR__ . '/../../../../sites/' .$siteDeclaration['dir_path'] . '/'. $spaSettings['site_settings_glob_paths'];
        $siteSettingsCachePath = __DIR__ . '/../../../../sites/' .$siteDeclaration['dir_path'] . '/'. $spaSettings['site_settings_cache_dir'];

        $aggregator = new ConfigAggregator(
            [
                new ArrayProvider([
                    ConfigAggregator::ENABLE_CACHE => $spaSettings['site_settings_cache_enabled'],
                    ConfigAggregator::CACHE_FILEMODE => $spaSettings['site_declaration_cache_filemode']
                ]),
                new LaminasConfigProvider($siteSettingsPath),
            ],
            $siteSettingsCachePath . $spaSettings['site_settings_cache_key'] .'.php'
        );

        $mergedConfig = $aggregator->getMergedConfig();

        if(array_key_exists('sites',$mergedConfig)) {
            foreach($mergedConfig['sites'] as $siteSettings) {
                if(strtolower($siteSettings['site-id'])===strtolower($siteId)) {
                    $request = $request->withAttribute(self::ATTR_NAME, $siteSettings['settings']);
                    $this->logger->info(self::ATTR_NAME . " is set.");
                    break;
                }
            }
        }


        return $handler->handle($request);
    }
}
