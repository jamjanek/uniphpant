<?php
declare(strict_types=1);

namespace App\Common\Middleware;

use App\Common\Container\ContainerAwareInterface;
use App\Common\Container\ContainerAwareTrait;
use App\Common\InputFilter\InputFilterAwareInterface;
use App\Common\InputFilter\InputFilterAwareTrait;
use App\Common\Request\InputFilterDataEntity;
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

/**
 * Class FetchInputFilterMiddleware
 *
 *
 *
 * @package App\Common\Middleware
 */
class FetchInputFilterMiddleware implements Middleware, ContainerAwareInterface, InputFilterAwareInterface
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
        $this->inputFilter = $this->getContainer()->get(InputFilter::class);
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if(empty($request->getAttribute(InputFilterSpecEntity::ATTR))) {
            // Filter Spec has NOT been set for the current Route
            return $handler->handle($request);
        }

        $inputFilterCollection = new ArrayObject();
        $inputFilterSpec = new ArrayObject($request->getAttribute(InputFilterSpecEntity::ATTR));
        $inputFilterSpecIterator = $inputFilterSpec->getIterator();

        while ($inputFilterSpecIterator->valid()) {
            $currentInputFilter = $this->getContainer()->get(InputFilter::class);
            $currentFilterSpec = $inputFilterSpecIterator->current();

            $currentFilterElements = new ArrayObject($currentFilterSpec[InputFilterSpecEntity::INDEX_EL]);

            $currentFilterElementsIterator = $currentFilterElements->getIterator();
            // add each Element to the current InputFilter
            while ($currentFilterElementsIterator->valid()) {
                $currentInputFilter->add($currentFilterElementsIterator->current());
                $currentFilterElementsIterator->next();
            }
            $currentInputFilterAttr=[
                InputFilterEntity::INDEX_MATCH => $currentFilterSpec[InputFilterSpecEntity::INDEX_MATCH],
                InputFilterEntity::INDEX_EL => $currentInputFilter,
            ];
            $inputFilterCollection->offsetSet($currentFilterSpec[InputFilterSpecEntity::INDEX_MATCH],$currentInputFilterAttr);
            $inputFilterSpecIterator->next();
        }

        $request = $request->withAttribute(InputFilterEntity::ATTR, $inputFilterCollection);

        return $handler->handle($request);

    }
}
