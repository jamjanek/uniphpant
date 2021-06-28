<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use App\Uniphpant\Request\Middleware\CurrentHostMiddleware;
use App\Uniphpant\Request\Middleware\HostNameMiddleware;
use App\Uniphpant\Route\Middleware\FetchRouteMiddleware;
use App\Uniphpant\Settings\Middleware\SiteDeclarationMiddleware;
use App\Uniphpant\Settings\Middleware\SiteSettingsMiddleware;
use App\Uniphpant\Settings\Middleware\SPASettingsMiddleware;
use App\Uniphpant\Site\Middleware\SiteIdMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    //$app->add(FetchRouteMiddleware::class);
    $app->add(SiteSettingsMiddleware::class);
    $app->add(SiteIdMiddleware::class);
    $app->add(SiteDeclarationMiddleware::class);
    $app->add(SPASettingsMiddleware::class);
    $app->add(HostNameMiddleware::class);
    $app->add(CurrentHostMiddleware::class);
};
