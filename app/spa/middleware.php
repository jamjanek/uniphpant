<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use App\Uniphpant\Request\Middleware\HostCurrentMiddleware;
use App\Uniphpant\Request\Middleware\HostNameMiddleware;
use App\Uniphpant\Route\Middleware\FetchRouteMiddleware;
use App\Uniphpant\Site\Middleware\SiteIdMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add(FetchRouteMiddleware::class);
    $app->add(SiteIdMiddleware::class);
    $app->add(HostNameMiddleware::class);
    $app->add(HostCurrentMiddleware::class);
};
