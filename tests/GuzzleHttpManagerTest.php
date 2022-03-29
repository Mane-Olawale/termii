<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Response;
use ManeOlawale\Termii\Client;
use ManeOlawale\Termii\HttpClient\GuzzleHttpManager;

class GuzzleHttpManagerTest extends TestCase
{
    /**
     * Test for manager request call
     */
    public function testRequestCall()
    {
        /**
         * @var \Mockery\MockInterface|\ManeOlawale\Termii\HttpClient\GuzzleHttpManager
         */
        $mock = \Mockery::mock(GuzzleHttpManager::class);

        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg', null, $mock);

        $mock->shouldReceive([
            'request' => new Response(200, ['Content-Type'     => 'application/json'], json_encode($mockedResponse = [
                "message_id" => "9122821270554876574",
                "message" => "Successfully Sent",
                "balance" => 9,
                "user" => "Peter Mcleish"
            ])),
        ]);

        $this->assertTrue(
            $client->sms->number('2347041945964', 'Lotus give me my phone')->toArray() ==
            $mockedResponse
        );
    }

    /**
     * Test for Guzzle request call
     */
    public function testGuzzleRequestCall()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        /**
         * @var \GuzzleHttp\Client
         */
        $mock = \Mockery::mock(Guzzle::class);

        $client->fillOptions([
            'httpManager' => new GuzzleHttpManager($client, $mock),
        ]);

        $mock->shouldReceive([
            'request' => new Response(200, ['Content-Type'     => 'application/json'], json_encode($mockedResponse = [
                "message_id" => "9122821270554876574",
                "message" => "Successfully Sent",
                "balance" => 9,
                "user" => "Peter Mcleish"
            ])),
        ]);

        $this->assertTrue(
            $client->sms->number('2347041945964', 'Lotus give me my phone')->toArray() ==
            $mockedResponse
        );
    }
}
