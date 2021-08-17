<?php
declare(strict_types=1);

namespace Tests\TestCase\Action;

use App\Application\Actions\ActionPayload;
use App\Domain\User\UserRepository;
use App\Domain\User\User;
use DI\Container;
use \Exception;
use Tests\TestCase;

class HomepageActionTest extends TestCase
{
    public function testException()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/');

//        $this->expectException(Exception::class);
//        $this->expectException(HttpNotFoundException::class);
        // or for PHPUnit < 5.2
        // $this->setExpectedException(InvalidArgumentException::class);

        //...and then add your test code that generates the exception
//        exampleMethod($anInvalidArgument);
    }
//
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $request = $this->createRequest('GET', '/');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();

        var_dump($payload);die();
        $expectedPayload = new ActionPayload(200, [$user]);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
