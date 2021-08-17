<?php
declare(strict_types=1);

namespace App\Common\Middleware;

use App\Common\Request\InputFilterSpecEntity;
use ArrayObject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Common\Route\RouteSettingsEntity;

/**
 * Reads the current Route settings and sets it as Requests attribute as RouteSettingsEntity::ATTR [route_settings].
 * The Route settings are matched by route name and read as FIFO from settings array.
 *
 * Class FetchRouteSettingsMiddleware
 * @package App\Common\Middleware
 */
class FetchRouteSettingsMiddleware implements Middleware
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $routesSettings;

    /**
     * DataSourceMiddleware constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $settings = $container->get('settings');
        $this->routesSettings = $settings['routes'];
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $routeName = strtolower($request->getAttribute('route')->getName());
        // @todo: cache get()

        $routes = new ArrayObject($this->routesSettings);
        $routesIterator = $routes->getIterator();

        // Collect input_filters assigned to the current Route.
        while ($routesIterator->valid()) {
            $currentRouteSpec = $routesIterator->current();
            if($currentRouteSpec[RouteSettingsEntity::INDEX_MATCH]===$routeName) {
                $request = $request->withAttribute(RouteSettingsEntity::ATTR, $currentRouteSpec);
                break;
            }
            $routesIterator->next();
        }

        // @todo: cache set()
        return $handler->handle($request);
    }
}
