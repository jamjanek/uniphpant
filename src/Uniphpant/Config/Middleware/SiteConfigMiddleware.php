<?php
declare(strict_types=1);

namespace App\Uniphpant\Config\Middleware;

use App\Uniphpant\Settings\Middleware\SPASettingsMiddleware;
use App\Uniphpant\Settings\Middleware\SiteDeclarationMiddleware;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

class SiteConfigMiddleware implements Middleware
{
    
    const ATTR_NAME = "site_config";
    const TYPE="spa";
    const INDEX = "config";

    private $logger;

    public function __construct(LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $spaSettings = $request->getAttribute(SPASettingsMiddleware::ATTR_NAME);
        $siteDeclaration = $request->getAttribute(SiteDeclarationMiddleware::ATTR_NAME);

        $siteConfigPath = sprintf(
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
                new LaminasConfigProvider($siteConfigPath),
            ],
            $cachedConfigFile
        );

        $mergedConfig = $aggregator->getMergedConfig();

        $request = $request->withAttribute(self::ATTR_NAME, $mergedConfig['site']['config']);

        $this->logger->info(self::ATTR_NAME . " is set.");

        return $handler->handle($request);
    }
}
