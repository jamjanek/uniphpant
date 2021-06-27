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


class HostCurrentMiddleware implements Middleware
{

    const ATTR_NAME = "current_host";

    /**
     * @var UriInterface
     */
    private $uri;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger, UriInterface $uri)
    {
        $this->logger = $logger;
        $this->uri = $uri;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (php_sapi_name() !== 'cli') {
            $uri = $this->uri::factory((string)$request->getUri());

            $this->logger->debug(get_class($this) . ":: Determine ".self::ATTR_NAME);


            if ( ! is_null($uri->getPort())) {
                $host = sprintf("%s:%s", $uri->getHost(), $uri->getPort());
            } else {
                $host = sprintf("%s", $uri->getHost());
            }

            $this->logger->debug(get_class($this) . ":: Current Host is " . var_export($host,true));

            $request = $request->withAttribute(self::ATTR_NAME, $host);
        } else {
            $this->logger->debug(get_class($this) . ":: CLI as no HOST.");
        }

        return $handler->handle($request);
    }
}
