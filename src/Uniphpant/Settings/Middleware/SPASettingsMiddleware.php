<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use App\Uniphpant\Settings\Domain\SPASettingsEntity;
use App\Uniphpant\Settings\Service\SPASettingsService;

class SPASettingsMiddleware implements Middleware
{
    private $logger;

    protected SPASettingsService $settings;

    public function __construct(LoggerInterface $logger, SPASettingsService $settings)
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $request = $request->withAttribute(SPASettingsEntity::ATTR_NAME, $this->settings);

        $this->logger->info(SPASettingsEntity::ATTR_NAME . " is set.");

        return $handler->handle($request);
    }
}
