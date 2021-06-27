<?php
declare(strict_types=1);

namespace App\Uniphpant\Site\Middleware;

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
    /**
     * @var UriInterface
     */
    private $uri;

    /**
     * @var JsonInterface
     */
    private $json_reader;

    /**
     * @var LoggerInterface
     */
    private $logger;

    const ATTR_NAME = "site_id";

    public function __construct(LoggerInterface $logger, UriInterface $uri, JsonInterface $json_reader)
    {
        $this->logger = $logger;
        $this->uri = $uri;
        $this->json_reader = $json_reader;
    }

    /**
     * Read aggregated ./sites/site-*.{json,yaml,php} site declarations
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (php_sapi_name() !== 'cli') {
            $host = $request->getAttribute('current_host');

            $configPath = __DIR__ . '/../../../../sites/site-*.{json,yaml,php}';

            $aggregator = new ConfigAggregator(
                [
                    new ArrayProvider([
                        ConfigAggregator::ENABLE_CACHE => false,
                        ConfigAggregator::CACHE_FILEMODE => 666
                    ]),
                    new LaminasConfigProvider($configPath),
                ],
                __DIR__ . '/../../../../var/cache/sites.php'
            );

            $mergedConfig = $aggregator->getMergedConfig();


            if( array_key_exists('sites',$mergedConfig)) {
                foreach($mergedConfig['sites'] as $instance) {
                    if(in_array($host,$instance['hosts'])) {
                        $request = $request->withAttribute(self::ATTR_NAME, $instance['site-id']);
                        break;
                    }
                }
            }

            if(null===$request->getAttribute(self::ATTR_NAME)||empty($request->getAttribute(self::ATTR_NAME))) {
                $this->logger->debug("Can not determine SiteId.");
                throw new HttpNotFoundException($request, "SiteId not found.");
            }
            $this->logger->debug(get_class($this) . ":: site_id: ".var_export($request->getAttribute(self::ATTR_NAME),true)." for host: " . var_export($host,true));

        } else {
            $siteId = (new ArgvInput())->getParameterOption(['--site', '-s'], 'default');
            $request = $request->withAttribute(self::ATTR_NAME, $siteId);
        }



        return $handler->handle($request);
    }
}
