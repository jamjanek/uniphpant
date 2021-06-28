<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use App\Uniphpant\Request\Middleware\CurrentHostMiddleware;
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

/**
 * Find the correct site declaration by current_hostname attribute
 * 
 * Attribute: site_declaration
 */
class SiteDeclarationMiddleware implements Middleware
{
    const ATTR_NAME = "site_declaration";

    private $logger;

    protected $settings;


    public function __construct(LoggerInterface $logger,
                                SettingsInterface $settings
    )
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
    	$spaSettings = $request->getAttribute(SPASettingsMiddleware::ATTR_NAME);
        $currentHost = $request->getAttribute(CurrentHostMiddleware::ATTR_NAME);
        // by default glob_path is set to 'site-*.{json,yaml,php}'
        $configPath = __DIR__ . '/../../../../sites/' . $spaSettings['site_declaration_glob_paths'];

        $aggregator = new ConfigAggregator(
            [
                new ArrayProvider([
                    ConfigAggregator::ENABLE_CACHE => $spaSettings['site_declaration_cache_enabled'],
                    ConfigAggregator::CACHE_FILEMODE => $spaSettings['site_declaration_cache_filemode']
                ]),
                new LaminasConfigProvider($configPath),
            ],
            __DIR__ . '/../../../../var/cache/'.$spaSettings['site_declaration_cache_key'].'.php'
        );

        $mergedDeclarations = $aggregator->getMergedConfig();
        $sitesDeclarations = $mergedDeclarations["sites"];

        foreach($sitesDeclarations as $siteDeclaration) {
            if(array_key_exists('hosts',$siteDeclaration)) {
                if(in_array($currentHost,$siteDeclaration['hosts'])) {
                    $request = $request->withAttribute(self::ATTR_NAME, $siteDeclaration);
                    $this->logger->info(self::ATTR_NAME . " is set.");
                    break;
                }
            }
        }
    

        return $handler->handle($request);
    }
}
