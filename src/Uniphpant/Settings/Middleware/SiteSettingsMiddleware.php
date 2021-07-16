<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use App\Uniphpant\Settings\SettingsInterface;
use App\Uniphpant\Site\Middleware\SiteIdMiddleware;
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
    const TYPE="spa";
    const INDEX = "settings";

    private $logger;

    protected $settings;

    public function __construct(LoggerInterface $logger, SettingsInterface $settings)
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $siteId = $request->getAttribute(SiteIdMiddleware::ATTR_NAME);
        $siteDeclaration = $request->getAttribute(SiteDeclarationMiddleware::ATTR_NAME);
        $spaSettings = $request->getAttribute(SPASettingsMiddleware::ATTR_NAME);

        $siteSettingsPath = sprintf(
            "%s/../../../../sites/%s/%s",
            __DIR__,
            $siteDeclaration['dir_path'],
            $spaSettings[self::INDEX]['glob_paths']
        );
        $cachePath = sprintf(
            "%s/../../../../sites/%s/%s",
            __DIR__,
            $siteDeclaration['dir_path'],
            $spaSettings[self::INDEX]['cache_dir']
        );

        $cachedConfigFile = $cachePath . $spaSettings[self::INDEX]['cache_key'] .'.php';

        $aggregator = new ConfigAggregator(
            [
                new ArrayProvider([
                    ConfigAggregator::ENABLE_CACHE => $spaSettings[self::INDEX]['cache_enabled'],
                    ConfigAggregator::CACHE_FILEMODE => $spaSettings[self::INDEX]['cache_perm']
                ]),
                new LaminasConfigProvider($siteSettingsPath),
            ],
            $cachedConfigFile
        );

        $mergedConfig = $aggregator->getMergedConfig();

        if(array_key_exists('sites',$mergedConfig)) {
            foreach($mergedConfig['sites'] as $siteSettings) {
                if(strtolower($siteSettings['site-id'])===strtolower($siteId)) {
                    $request = $request->withAttribute(self::ATTR_NAME, $siteSettings[self::TYPE]['settings']);
                    $this->logger->info(self::ATTR_NAME . " is set.");
                    break;
                }
            }
        }

        return $handler->handle($request);
    }
}
