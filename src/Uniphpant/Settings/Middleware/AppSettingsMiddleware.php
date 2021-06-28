<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use App\Uniphpant\Settings\SettingsInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

/**
 * Read 'app' index from the SettingsInterface and store it as Requests Attribute 'app_settings'.
 * 
 * Attribute: app_settings
 */

class AppSettingsMiddleware implements Middleware
{
    private $logger;

    const ATTR_NAME = "app_settings";
    const TYPE="app";
    const INDEX = "settings";

    protected $settings;


    public function __construct(LoggerInterface $logger, SettingsInterface $settings)
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $request = $request->withAttribute(self::ATTR_NAME, $this->settings->get(self::TYPE));

        $this->logger->info(self::ATTR_NAME . " is set.");

        return $handler->handle($request);
    }
}
