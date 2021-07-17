<?php
declare(strict_types=1);

namespace App\Uniphpant\Actions;

use App\Application\Actions\Action;
use App\Uniphpant\Domain\PageEntity;
use App\Uniphpant\Domain\TemplateEntity;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;
use App\Uniphpant\Domain\CommonEntity;

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
        $currentPage = new PageEntity($currentPageData);
        #TODO: TemplateModel
        $currentTemplateData = $this->request->getAttribute('table_gateway')
            ->offsetGet('template')
            ->select(['route_uid'=>$currentRouteData[TemplateEntity::IDENTIFIER],'status'=>1])
            ->current();
        $currentTemplate = new TemplateEntity($currentTemplateData);
        #TODO: AreaModel
        $areaCollectionData = $this->request->getAttribute('table_gateway')
            ->offsetGet('area')
            ->select(['template_uid'=>$currentTemplate->getIdentifier(),'status'=>1]);
        var_dump($areaCollectionData->count());die();
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