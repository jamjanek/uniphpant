<?php
declare(strict_types=1);

namespace App\Uniphpant\Config\Middleware;

use App\Uniphpant\Settings\Reader\JsonInterface;
use App\Uniphpant\Uri\UriInterface as UriInterface;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;

class SiteConfigMiddleware implements Middleware
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    const ATTR_NAME = "site_config";

    /**
     * @var \App\Site\Service\SiteSettingsService 
     */
    protected $siteSettingsService;

    /**
     * @var JsonInterface
     */
    protected $jsonReader;

    public function __construct(LoggerInterface $logger,
                                JsonInterface $jsonReader
    )
    {
        $this->logger = $logger;
        $this->jsonReader = $jsonReader;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $host = $request->getAttribute('host');
        $site_id = $request->getAttribute('site_id');
        $site_settings = $request->getAttribute('site_settings');
        if(null===$host||null===$site_id||null===$site_settings) {

        }

        if($site_settings['config']['config_cache_enabled']===true) {
            $this->logger->debug(get_class($this) . ":: Site Config [pre]; Host: " . $host . " ; Site Id: " . $site_id);

            // read site specific config
            $configPath = __DIR__ . '/../../../sites/'.$site_settings['config']['dir_path'].$site_settings['config']['config_glob_paths'];
            // read the site specific cache dir
            $configCacheDir = __DIR__ . '/../../../sites/'.$site_settings['config']['dir_path'].$site_settings['config']['cache_dir'];


            $aggregator = new ConfigAggregator(
                [
                    new ArrayProvider([
                        ConfigAggregator::ENABLE_CACHE => $site_settings['config']['config_cache_enabled'],
                        ConfigAggregator::CACHE_FILEMODE => $site_settings['config']['config_cache_perm']
                    ]),
                    new LaminasConfigProvider($configPath),
                ],
                $configCacheDir.'/config-cache.php'
            );

            $mergedConfig = $aggregator->getMergedConfig();

            $request = $request->withAttribute(self::ATTR_NAME, $mergedConfig['site'][$site_id]);
        }

        return $handler->handle($request);
    }
}
