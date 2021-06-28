<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use App\Uniphpant\Request\Middleware\CurrentHostMiddleware;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpNotFoundException;

/**
 * Find the correct site declaration by current_hostname attribute
 * 
 * Attribute: site_declaration
 */
class SiteDeclarationMiddleware implements Middleware
{
    const ATTR_NAME = "site_declaration";

    const TYPE="app";
    const INDEX = "declaration";

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
    	$spaSettings = $request->getAttribute(SPASettingsMiddleware::ATTR_NAME);
    	$appSettings = $request->getAttribute(AppSettingsMiddleware::ATTR_NAME);
        $currentHost = $request->getAttribute(CurrentHostMiddleware::ATTR_NAME);

        $declarationsPath = sprintf(
            "%s/../../../../%s/%s",
            __DIR__,
            $_ENV['SITES_DIRPATH'],
            $appSettings[self::INDEX]['glob_paths']
        );
        $cachePath = sprintf(
            "%s/../../../../%s",
            __DIR__,
            $appSettings[self::INDEX]['cache_dir']
        );
        $cachedConfigFile = $cachePath . $appSettings[self::INDEX]['cache_key'] .'.php';

        $aggregator = new ConfigAggregator(
            [
                new ArrayProvider([
                    ConfigAggregator::ENABLE_CACHE => $appSettings[self::INDEX]['cache_enabled'],
                    ConfigAggregator::CACHE_FILEMODE => $appSettings[self::INDEX]['cache_perm']
                ]),
                new LaminasConfigProvider($declarationsPath),
            ],
            $cachedConfigFile
        );

        $mergedDeclarations = $aggregator->getMergedConfig();

        if( ! array_key_exists("sites", $mergedDeclarations)) {
                $this->logger->debug("Can not determine site_declaration.");
                throw new HttpNotFoundException($request, "Site declaration not found.");
        } else {
            $mergedSitesDeclarations = $mergedDeclarations['sites'];
            // Find the correct declaration by matching current_host attribute
            foreach($mergedSitesDeclarations as $siteDeclaration) {

                if(array_key_exists('hosts',$siteDeclaration)) {
                    if(in_array($currentHost,$siteDeclaration['hosts'])) {
                        $request = $request->withAttribute(self::ATTR_NAME, $siteDeclaration);

                        $this->logger->info(self::ATTR_NAME . " is set.");
                        break;
                    }
                }
            }
        }
        return $handler->handle($request);
    }
}
