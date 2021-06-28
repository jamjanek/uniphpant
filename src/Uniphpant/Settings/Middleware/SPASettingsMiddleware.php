<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Settings\SettingsInterface;
use App\Uniphpant\Site\Middleware\SiteIdMiddleware;
use App\Uniphpant\Uri\UriInterface as UriInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

/**
 * Read 'spa' index from the SettingsInterface and store it as Requests Attribute 'spa_settings'.
 * 
 * Attribute: spa_settings
 */

class SPASettingsMiddleware implements Middleware
{
    private $logger;

    const ATTR_NAME = "spa_settings";

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
        $request = $request->withAttribute(self::ATTR_NAME, $this->settings->get('spa'));

        $this->logger->info(self::ATTR_NAME . " is set.");

        return $handler->handle($request);
    }
}
