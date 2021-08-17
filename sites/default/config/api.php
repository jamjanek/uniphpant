<?php
return [];
//declare(strict_types=1);
//
//use DI\ContainerBuilder;
//use Monolog\Logger;
//
//return function (ContainerBuilder $containerBuilder) {
//    // Global Settings Object
//    $containerBuilder->addDefinitions([
//        'settings' => [
//            'displayErrorDetails' => true, // Should be set to false in production
//            'determineRouteBeforeAppMiddleware' => false, // Should be set to false in production
//            'logger' => [
//                'name' => 'slim-app',
//                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
//                'level' => Logger::DEBUG,
//            ],
//            'renderer' => [
//                'template_path' => __DIR__ . '/../templates/',
//            ],
//            'application_config' => [
//                'api' => [
//                    'client' => [
//                        'github' => [
//                            'host' => [
//                                'url' => 'https://api.github.com',
//                            ],
//                            'headers' => [
//                                'accept' => 'application/vnd.github.v3+json',
//                                'content-type' => 'application/json',
//                            ],
//                            'endpoints' => [
//                                'repo' => [
//                                    'name' => 'repo',
//                                    'uri'=>'/repos/%s',
//                                ],
//                                'issue_open' => [
//                                    'name' => 'issue_open',
//                                    'uri'=>'/search/issues?q=repo:%s+is:issue+is:open',
//                                ],
//                                'issue_closed' => [
//                                    'name' => 'issue_closed',
//                                    'uri'=>'/search/issues?q=repo:%s+is:issue+is:closed',
//                                ],
//                                'pr_opened' => [
//                                    'name' => 'pr_opened',
//                                    'uri' => '/search/issues?q=repo:%s+is:pr+is:open',
//                                ],
//                                'pr_closed' => [
//                                    'name' => 'pr_closed',
//                                    'uri' => '/search/issues?q=repo:%s+is:pr+is:closed',
//                                ],
//                                'pr_merged' => [
//                                    'name' => 'pr_merged',
//                                    'uri' => '/search/issues?q=repo:%s+is:pr+is:merged',
//                                ],
//                                'contributors' => [
//                                    'name' => 'contributors',
//                                    'uri'=>'/repos/%s/contributors',
//                                ],
//                                'contributors_stats' => [
//                                    'name' => 'contributors_stats',
//                                    'uri'=>'/repos/%s/stats/contributors',
//                                ],
//                                'milestones' => [
//                                    'name' => 'milestones',
//                                    'uri'=>'/repos/%s/milestones',
//                                ],
//                                'releases' => [
//                                    'name' => 'releases',
//                                    'uri'=>'/repos/%s/releases',
//                                ],
//                            ],
//                            'extra'=>[
//                                'rate_limit' => [
//                                    'url' => '/rate_limit',
//                                ],
//                            ],
//                        ],
//                    ],
//                ],
//            ],
//        ],
//    ]);
//};
