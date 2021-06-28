<?php
declare(strict_types=1);

namespace App\Uniphpant\Request\Middleware;

use Laminas\Uri\UriFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

/**
 * Determine Hostname for the current Request
 * Get Uri from Laminas\Uri\UriFactory and compose `scheme://host[:port]` string and set it as Requests attribute `host_url`.
 * 
 * Attribute: host_url
 */

/**
 * Class HostNameMiddleware
 * @package App\Uniphpant\Request\Middleware
 */
class HostNameMiddleware implements Middleware
{
    const ATTR_NAME = "host_url";

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function process(Request $request, RequestHandler $handler): Response
    {
        if(PHP_SAPI !== 'cli') {
            $uri = UriFactory::factory((string)$request->getUri());

            if (filter_var($uri->getHost(), FILTER_VALIDATE_IP)) {
                $host = sprintf("%s://%s:%s", $uri->getScheme(), $uri->getHost(), $uri->getPort());
            } else {
                $host = sprintf("%s://%s", $uri->getScheme(), $uri->getHost());
            }

            $this->logger->info(self::ATTR_NAME . " is set to " . $host);

            $request = $request->withAttribute(self::ATTR_NAME, $host);
        }

        return $handler->handle($request);
    }
}
