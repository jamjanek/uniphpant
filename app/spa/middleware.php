<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use App\Uniphpant\Config\Middleware\SiteConfigMiddleware;
use App\Uniphpant\Request\Middleware\CurrentHostMiddleware;
use App\Uniphpant\Request\Middleware\HostNameMiddleware;
use App\Uniphpant\Route\Middleware\FetchRouteMiddleware;
use App\Uniphpant\Settings\Middleware\AppSettingsMiddleware;
use App\Uniphpant\Settings\Middleware\SPASettingsMiddleware;
use App\Uniphpant\Settings\Middleware\SiteDeclarationMiddleware;
use App\Uniphpant\Settings\Middleware\SiteSettingsMiddleware;
use App\Uniphpant\Site\Middleware\SiteIdMiddleware;
use App\Uniphpant\TableGateway\Middleware\TableGatewayMiddleware;
use Slim\App;
use App\Uniphpant\Route\Middleware\RouteDataMiddleware;

return function (App $app) {
    $app->add(SessionMiddleware::class);

    // $app->add(\App\Uniphant\Middleware\Form\FormDataMiddleware::class);
    // $app->add(\App\Uniphant\Middleware\Form\FormPreloadMiddleware::class);
    // $app->add(\App\Uniphant\Middleware\Seo\SeoMiddleware::class);
    // $app->add(\App\Uniphant\Template\Middleware\TemplateDataMiddleware::class);
    // $app->add(\App\Uniphant\Page\Middleware\PageDataMiddleware::class);
    // $app->add(\App\Uniphant\Route\Middleware\RouteDataMiddleware::class);
    // $app->add(\App\Site\Middleware\ReadSiteContentMiddleware::class);
    // $app->add(\App\Site\Middleware\ReadSiteContentStructureMiddleware::class);

//    $app->addMiddleware(new FetchInputDataMiddleware($app->getContainer()))
//    $app->addMiddleware(new FetchInputFilterMiddleware($app->getContainer()))
//    $app->addMiddleware(new FetchInputFilterSpecMiddleware($app->getContainer()))
//    $app->addMiddleware(new FetchRouteSettingsMiddleware($app->getContainer()));

//    $app->add(SeoDataMiddleware::class);
//    $app->add(TemplateDataMiddleware::class);
//    $app->add(PageDataMiddleware::class);
    $app->add(RouteDataMiddleware::class);
    $app->add(TableGatewayMiddleware::class);
    $app->add(SiteConfigMiddleware::class);
    $app->add(FetchRouteMiddleware::class);
    $app->add(SiteSettingsMiddleware::class);

    $app->add(SiteDeclarationMiddleware::class);
    $app->add(SPASettingsMiddleware::class);
    $app->add(AppSettingsMiddleware::class);
    $app->add(SiteIdMiddleware::class);$app->add(HostNameMiddleware::class);
    $app->add(CurrentHostMiddleware::class);
};
