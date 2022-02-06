<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as Guzzle;
use ManeOlawale\Termii\Client;
use ManeOlawale\Termii\HttpClient\GuzzleHttpManager;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Mockery;

class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function getClientWithMockedResponse(Response $response)
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        /**
         * @var \GuzzleHttp\Client
         */
        $mock = Mockery::mock(Guzzle::class);

        $client->fillOptions([
            'httpManager' => new GuzzleHttpManager($client, $mock),
        ]);

        $mock->shouldReceive([
            'request' => $response,
        ]);

        return $client;
    }
}
