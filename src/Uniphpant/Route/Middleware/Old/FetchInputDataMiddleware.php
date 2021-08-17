<?php
declare(strict_types=1);

namespace App\Common\Middleware;

use App\Common\Container\ContainerAwareInterface;
use App\Common\Container\ContainerAwareTrait;
use App\Common\InputFilter\InputFilterAwareInterface;
use App\Common\InputFilter\InputFilterAwareTrait;
use App\Common\Request\InputFilterEntity;
use App\Common\Request\InputFilterSpecEntity;
use ArrayObject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Zend\InputFilter\InputFilter;
use App\Common\Request\InputFilterDataEntity;

/**
 * Class FetchInputDataMiddleware
 * @package App\Common\Middleware
 */
class FetchInputDataMiddleware implements Middleware, ContainerAwareInterface
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
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $this->inputFilter = $request->getAttribute(InputFilterEntity::ATTR);
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
