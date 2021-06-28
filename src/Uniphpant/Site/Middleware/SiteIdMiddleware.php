<?php
declare(strict_types=1);

namespace App\Uniphpant\Site\Middleware;

use App\Uniphpant\Request\Middleware\HostCurrentMiddleware;
use App\Uniphpant\Settings\Middleware\SiteDeclarationMiddleware;
use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Uri\UriInterface;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpSpecializedException;
use Symfony\Component\Console\Input\ArgvInput;

class SiteIdMiddleware implements Middleware
{
    private $uri;

    private $logger;

    const ATTR_NAME = "site_id";

    public function __construct(LoggerInterface $logger, UriInterface $uri)
    {
        $this->logger = $logger;
        $this->uri = $uri;
    }

    /**
     * Read aggregated ./sites/site-*.{json,yaml,php} site declarations
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (php_sapi_name() !== 'cli') {
            $siteDeclaration = $request->getAttribute(SiteDeclarationMiddleware::ATTR_NAME);

            if(array_key_exists('site-id',$siteDeclaration)) {
                $this->logger->info(self::ATTR_NAME . " is set to " . $siteDeclaration['site-id']);
                // finally set the Requests Attribute
                $request = $request->withAttribute(self::ATTR_NAME, $siteDeclaration['site-id']);
            } else {
                $this->logger->debug("Can not determine SiteId.");

                throw new HttpNotFoundException($request, "SiteId not found.");
            }
        } else {
            $siteId = (new ArgvInput())->getParameterOption(['--site', '-s'], 'default');
            $request = $request->withAttribute(self::ATTR_NAME, $siteId);
        }



        return $handler->handle($request);
    }
}
