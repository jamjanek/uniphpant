<?php
declare(strict_types=1);

namespace App\Common\Middleware;

use App\Common\Module\CommonModule;
use App\Common\Container\ContainerAwareInterface;
use App\Common\Container\ContainerAwareTrait;
use App\Common\InputFilter\InputFilterAwareInterface;
use App\Common\InputFilter\InputFilterAwareTrait;
use App\Common\Request\InputFilterEntity;
use App\Common\Request\InputFilterSpecEntity;
use App\Common\Route\RouteSettingsEntity;
use ArrayObject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Zend\InputFilter\InputFilter;
use App\Common\Request\InputFilterDataEntity;
use App\Common\Repository\RepositorySpecEntity;

/**
 * Class FetchInputDataMapperMiddleware
 *
 * Collect filtered data with Requests Attribute InputFilterDataEntity::ATTR and then
 *
 * @POC
 *
 * @package App\Common\Middleware
 */
class FetchInputDataMapperMiddleware implements Middleware, ContainerAwareInterface
{
    use ContainerAwareTrait;
    use InputFilterAwareTrait;

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
     * Try to loadFor each module (declared) per current route
     *
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $this->inputFilterData = $request->getAttribute(InputFilterDataEntity::ATTR);

        /** @var array $routeSettings Current route settings */
        $routeSettings = $request->getAttribute(RouteSettingsEntity::ATTR);

        if( ! array_key_exists('modules',$routeSettings)) {
            return $handler->handle($request);
        }

        // iterate every module declared in Route
        foreach($routeSettings['modules'] as $declaredModuleRouteSettings) {
            // for every module found load its (main) settings
            /** @var array $currentModuleSettings module settings. */
            foreach($this->settings['modules'] as $currentModuleSettings) {
                // check if iterated modules main settings matched those declared in in the route settings
                if($declaredModuleRouteSettings[CommonModule::INDEX_MATCH]===$currentModuleSettings[CommonModule::INDEX_MATCH]) {
                    // if currently declared and iterated module have input_filter_spec entry
                    if( array_key_exists(InputFilterSpecEntity::ALIAS,$currentModuleSettings)) {
                        // try to match modules input_filter_spec with any in the InputFilterDataEntity::ATTR
                        foreach($currentModuleSettings[InputFilterSpecEntity::ALIAS] as $currentModuleInputSpecSettings) {
                            // we are in , which; find the main settings for the declared input_filter_spec

                            if($currentModuleInputSpecSettings[InputFilterSpecEntity::INDEX_MATCH]===1) {

                            }
                        }
                        echo 'current modules input_filter_spec';
                        var_dump($currentModuleSettings[InputFilterSpecEntity::ALIAS]);
                    }
                    //
                }
                // check if the currently iterated module is declared in the route settings.
//                if( array_key_exists(InputFilterSpecEntity::ALIAS,$currentModuleSettings)) {
//                    foreach($currentModuleSettings[InputFilterSpecEntity::ALIAS] as $moduleInputFilterSpec) {
//                        var_dump($moduleInputFilterSpec);
////                        if(===$moduleInputFilterSpec[RepositorySpecEntity::INDEX_MATCH]) {
////
////                        }
//                    }
//                }
            }
        }
        echo 'route settings:';
        var_dump($routeSettings);
        echo 'inputFilterData:';
        var_dump($this->inputFilterData);
        die();

        $dataCollection = new ArrayObject();

        if( ! empty($this->inputFilter)) {
            // try to fetch incoming data from get array or postBody
            $incomingRawData = (strtolower($request->getMethod())==="get")
                ?$request->getQueryParams()
                :$request->getParsedBody()
            ;

            $inputFilterCollectionIterator = $this->getInputFilterCollection()->getIterator();
            if($inputFilterCollectionIterator->count()>0) {
                // each InputFilter
                while ($inputFilterCollectionIterator->valid()) {
                    $currentInputFilterSpec = $inputFilterCollectionIterator->current();
                    $currentInputFilterSpec[InputFilterEntity::INDEX_EL]->setData($incomingRawData);

                    if($currentInputFilterSpec[InputFilterEntity::INDEX_EL]->isValid()) {
                        $this->getContainer()->get(LoggerInterface::class)->debug("Input Data seems to be valid.");
                        $dataCollection->offsetSet(
                            $currentInputFilterSpec[InputFilterEntity::INDEX_MATCH],
                            [
                                InputFilterEntity::INDEX_MATCH=>$currentInputFilterSpec[InputFilterEntity::INDEX_MATCH],
                                InputFilterDataEntity::INDEX_EL=>$currentInputFilterSpec[InputFilterEntity::INDEX_EL]->getValues()
                            ]
                        );
                    } else {
                        $this->getContainer()->get(LoggerInterface::class)->debug("Input Data seems to be NOT valid.");
                        foreach ($currentInputFilterSpec[InputFilterEntity::INDEX_EL]->getInvalidInput() as $invalidInput) {
                            foreach ($invalidInput->getMessages() as $errorType => $errorMsg) {
                                $invalidInputMsg = sprintf(
                                    "Validation Error: %s; %s; %s",
                                    $invalidInput->getName(),
                                    $errorType,
                                    $errorMsg
                                );
                                $this->getContainer()->get(LoggerInterface::class)->info($invalidInputMsg);
                            }

                        }
                    }

                    $inputFilterCollectionIterator->next();
                }
            }

            $request = $request->withAttribute(InputFilterDataEntity::ATTR, $dataCollection);
        }

        return $handler->handle($request);
    }
}
