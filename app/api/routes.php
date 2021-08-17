<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;
use App\Uniphpant\Actions\RequestAction;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

//    $app->group('/', function (Group $group) {
//        $group->get('', RequestAction::class)
//            ->setName("request");
////        $group->post('', ProcessAction::class)->setName('process');
////        $group->get('{uid}', ResponseAction::class)->setName('response');
//    });




    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    })
//        ->addMiddleware(new FetchInputDataMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchInputFilterMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchInputFilterSpecMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchRouteSettingsMiddleware($app->getContainer()))
        ->setName('homepage');
//
//    $app->get('/api/authenticate', AuthenticateUserAction::class)
//        ->addMiddleware(new RepositorySpecMiddleware($app->getContainer()))
////        ->addMiddleware(new FetchInputDataMapperMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchInputDataMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchInputFilterMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchInputFilterSpecMiddleware($app->getContainer()))
//        ->addMiddleware(new FetchRouteSettingsMiddleware($app->getContainer()))
//        ->setName('authenticate');
//
//    $app->group('/users', function (Group $group) {
//        $group->get('', ListUsersAction::class);
//        $group->get('/{id}', ViewUserAction::class);
//    });




};
