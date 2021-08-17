<?php
declare(strict_types=1);

namespace App\Uniphpant\Actions;

use App\Application\Actions\Action;
use App\Uniphpant\Domain\AreaEntity;
use App\Uniphpant\Domain\CommonEntity;
use App\Uniphpant\Domain\PageEntity;
use App\Uniphpant\Domain\TemplateEntity;
use DomainException;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

class RequestAction extends Action
{
    protected $renderer;

    public function __construct(
        LoggerInterface $logger,
        PhpRenderer $renderer
    )
    {
        parent::__construct($logger);
        $this->renderer = $renderer;
    }

    protected function action(): Response
    {
        $templatesPath = __DIR__.'/../../../templates';

        $contentData = null;
        $contentStructure = null;

        $currentRouteData = $this->request->getAttribute('site_route_data');
        #TODO: PageModel
        $currentPageData = $this->request->getAttribute('table_gateway')
            ->offsetGet('page')
            ->select(['route_uid'=>$currentRouteData[PageEntity::IDENTIFIER],'status'=>1])
            ->current();
        $pageResultSet = new HydratingResultSet(
            new ReflectionHydrator(),
            new PageEntity($currentPageData->offsetGet('uid'))
        );
        $currentPage = new PageEntity($currentPageData->offsetGet('uid'));
        #TODO: TemplateModel
        $currentTemplateData = $this->request->getAttribute('table_gateway')
            ->offsetGet('template')
            ->select(['route_uid'=>$currentRouteData[TemplateEntity::IDENTIFIER],'status'=>1])
            ->current();
        $currentTemplate = new TemplateEntity($currentTemplateData);
//        $resultSet = new HydratingResultSet(
//            new ReflectionHydrator(),
//            new TemplateEntity($currentTemplateData)
//        );
        #TODO: AreaModel
        /* @var Laminas\Db\ResultSet\ResultSetInterface $areaCollectionResult */
        $areaCollectionResultSet = $this->request->getAttribute('table_gateway')
            ->offsetGet('area')
            ->select(['template_uid'=>$currentTemplate->getIdentifier(),'status'=>1]);
        if ($areaCollectionResultSet->count() === 0) {
            throw new DomainException('User not found', 404);
        } else {

//            foreach() {
//
//            }

            $strategy = new \Laminas\Hydrator\Strategy\CollectionStrategy(
                new \Laminas\Hydrator\ObjectPropertyHydrator(),
                \stdClass::class
            );
//            var_dump($areaCollectionResultSet->toArray());die();
//            $hydrated = $strategy->hydrate([
//                $areaCollectionResultSet->toArray()
//                // …
//            ]);
//            var_dump($hydrated);

//
//            $resultSet = new HydratingResultSet(new ReflectionHydrator, new AreaEntity);
//            $resultSet->initialize($areaCollectionResult);
//var_dumP($resultSet);

            while($areaCollectionResultSet->valid()) {
                $c = $areaCollectionResultSet->current();
                var_dump($c);

//                $hydrated = $strategy->hydrate([$c]);

                echo 7;
                $areaCollectionResultSet->next();
            }
        }

        die();

        $resultSet = new HydratingResultSet(new ReflectionHydrator, new AreaEntity());
        $resultSet->initialize($areaCollectionResult);
        foreach($areaCollectionResult as $result) {


            var_dump($result);
        }

        die();
var_dump($areaCollectionResult instanceof ResultSetInterface);
        if ($areaCollectionResult instanceof ResultSetInterface) {
            $resultSet = new HydratingResultSet(new ReflectionHydrator, new AreaEntity());
            $resultSet->initialize($areaCollectionResult);

            foreach ($resultSet as $user) {
                echo $user->getUid() . ' ' . $user->getSection() . PHP_EOL;
            }
        }

        if($areaCollectionResult->count()>0) {



var_dump($areaCollectionResult);die();



            $pageStrategy = new \Laminas\Hydrator\Strategy\CollectionStrategy(
                new \Laminas\Hydrator\ObjectPropertyHydrator(),
                PageEntity::class
            );
            var_dump($currentPageData->getArrayCopy());
            die();
            $extracted = $pageStrategy->extract($currentPageData->getArrayCopy());

            var_dump($extracted);
            die();





        }
        var_dump($areaCollectionData);die();
        #TODO: AreaBlockModel
        $areaBlockGateway = $this->request->getAttribute('table_gateway')
            ->offsetGet('area_block');
        #TODO: blockContentModel
        $blockContentGateway = $this->request->getAttribute('table_gateway')
            ->offsetGet('block_content');

        if($areaCollection->count()>0) {
            // Iterate areas and find connections with blocks.
            foreach($areaCollection as $areaRowSet) {

                $blockCollection = $areaBlockGateway->select(['area_uid'=>$areaRowSet['uid']]);
                // if there are blocks connected then find content by block
                if($blockCollection->count()>0) {
                    foreach($blockCollection as $blockRowSet) {
                        $contentCollection = $blockContentGateway->select(['block_uid'=>$blockRowSet['block_uid']]);
                        if($contentCollection->count()>0) {
                            foreach($contentCollection as $contentRowSet) {
                                var_dump($contentRowSet);
                            }
                        }
                        var_dump($blockRowSet);
                        echo $blockRowSet->offsetGet('area_uid');
                    }
                }
            }
        }


        die();

        $this->renderer->setTemplatePath($templatesPath);
        return $this->renderer->render(
            $this->response,
            "default.php",
            [
                'current_route' => $currentRouteData,
                'current_page' => $currentPage,
                'current_template' => $currentTemplate,
                'display_text'=>'Hello World!'
            ]
        );
    }
}