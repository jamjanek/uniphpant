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
use App\Uniphpant\Settings\Domain\SPASettingsEntity;
use App\Uniphpant\Settings\Service\SiteSettingsService;
use App\Uniphpant\Settings\Service\SPASettingsService;

class SiteSettingsMiddleware implements Middleware
{
    const ATTR_NAME = "site_settings";
    const TYPE="spa";
    const INDEX = "settings";

    private $logger;

    protected $site_settings_service;
    protected $spa_settings_service;

    public function __construct(LoggerInterface $logger, SiteSettingsService $site_settings_service, SPASettingsService $spa_settings_service)
    {
        $this->logger = $logger;
        $this->site_settings_service = $site_settings_service;
        $this->spa_settings_service = $spa_settings_service;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {

        $siteId = $request->getAttribute(SiteIdMiddleware::ATTR_NAME);
        $siteDeclaration = $request->getAttribute(SiteDeclarationMiddleware::ATTR_NAME);
        $spaSettings = $request->getAttribute(SPASettingsEntity::ATTR_NAME);
var_dump($this->site_settings_service);
var_dump($this->spa_settings_service);die();
        $siteSettingsPath = sprintf(
            "%s/../../../../sites/%s/%s",
            __DIR__,
            $siteDeclaration['dir_path'],
            $spaSettings->get(self::INDEX)['glob_paths']
        );
        $cachePath = sprintf(
            "%s/../../../../sites/%s/%s",
            __DIR__,
            $siteDeclaration['dir_path'],
            $spaSettings->get(self::INDEX)['cache_dir']
        );

        $cachedConfigFile = $cachePath . $spaSettings->get(self::INDEX)['cache_key'] .'.php';

        $aggregator = new ConfigAggregator(
            [
                new ArrayProvider([
                    ConfigAggregator::ENABLE_CACHE => $spaSettings->get(self::INDEX)['cache_enabled'],
                    ConfigAggregator::CACHE_FILEMODE => $spaSettings->get(self::INDEX)['cache_perm']
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
