<?php
declare(strict_types=1);

namespace App\Uniphpant\Request\Middleware;

use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Uri\UriInterface as UriInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

/**
 * Determine the current host for the ongoing Request.
 * 
 * Get Uri from Laminas\Uri\UriFactory and compose `host[:port]` string and set it as Requests attribute `current_host`.
 * 
 * Attribute: current_host
 */

class CurrentHostMiddleware implements Middleware
{

    const ATTR_NAME = "current_host";

    private $uri;

    private $logger;

    public function __construct(LoggerInterface $logger, UriInterface $uri)
    {
        $this->logger = $logger;
        $this->uri = $uri;
    }
    
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (php_sapi_name() !== 'cli') {
            $uri = $this->uri::factory((string)$request->getUri());

            $currentHost = (is_null($uri->getPort()))
                ? sprintf("%s:%s", $uri->getHost(), $uri->getPort())
                : sprintf("%s", $uri->getHost())
            ;   

            $this->logger->info(self::ATTR_NAME . " is set to " . $currentHost);

            $request = $request->withAttribute(self::ATTR_NAME, strtolower($currentHost));

        } else {
            $this->logger->debug( php_sapi_name() . " has no HOST.");
        }

        return $handler->handle($request);
    }
}
