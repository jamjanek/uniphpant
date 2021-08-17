<?php
declare(strict_types=1);

namespace App\Common\Middleware;

use App\Common\Request\InputFilterSpecEntity;
use App\Common\Route\RouteSettingsEntity;
use ArrayObject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

/**
 * Sets set of declared input_filter_spec per Route.
 *
 * Class FetchInputFilterSpecMiddleware
 *
 * @package App\Common\Middleware
 */
class FetchInputFilterSpecMiddleware implements Middleware
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $settings;

    /**
     * DataSourceMiddleware constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->settings = $container->get('settings');
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        // Find the matches between current [route]=>input_filter_spec=>[name] and input_filter_spec=>[name]

        $inputFilterSpecCollection = new ArrayObject();
        $inputFilterSpec = null;
        // @todo: cache get()

        $routeSpec = $request->getAttribute(RouteSettingsEntity::ATTR);

        if( ! empty($routeSpec)
            && array_key_exists(InputFilterSpecEntity::ALIAS,$routeSpec)
            &&!empty($routeSpec[InputFilterSpecEntity::ALIAS])
            && array_key_exists(InputFilterSpecEntity::ALIAS,$this->settings)
            &&!empty($this->settings[InputFilterSpecEntity::ALIAS])
        ) {
                // for each input_filter declaration from route
                foreach($routeSpec[InputFilterSpecEntity::ALIAS] as $routeFilterSpec) {
                    // try to find the matching ones from settings=>input_filter_spec
                    foreach($this->settings[InputFilterSpecEntity::ALIAS] as $settingsFilterSpec) {
                        if($routeFilterSpec[InputFilterSpecEntity::INDEX_MATCH]===$settingsFilterSpec[InputFilterSpecEntity::INDEX_MATCH]) {
                            $inputFilterSpecCollection->offsetSet(
                                $routeFilterSpec[InputFilterSpecEntity::INDEX_MATCH],
                                [
                                    InputFilterSpecEntity::INDEX_MATCH => $routeFilterSpec[InputFilterSpecEntity::INDEX_MATCH], // name
                                    InputFilterSpecEntity::INDEX_EL => $settingsFilterSpec[InputFilterSpecEntity::INDEX_EL], // elements
                                ]
                            );
                        }
                    }
                }
        }

        // @todo: cache set()
        $request = $request->withAttribute(InputFilterSpecEntity::ATTR, $inputFilterSpecCollection);

        return $handler->handle($request);
    }
}
