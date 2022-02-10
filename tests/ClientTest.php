<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Client as Guzzle;
use ManeOlawale\Termii\Client;
use ManeOlawale\Termii\Api\Sender;
use ManeOlawale\Termii\Api\Sms;
use ManeOlawale\Termii\Api\Token;
use ManeOlawale\Termii\Api\Insights;
use ManeOlawale\Termii\HttpClient\GuzzleHttpManager;

class ClientTest extends TestCase
{
    /**
     * Test for handler caching in the client oject
     */
    public function testHandlerCaching()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        $sms = $client->sms;
        $token = $client->token;
        $sender = $client->sender;
        $insights = $client->insights;

        $this->assertTrue($sms === $client->sms);
        $this->assertTrue($token === $client->token);
        $this->assertTrue($sender === $client->sender);
        $this->assertTrue($insights === $client->insights);
    }

    /**
     * Test for handler caching in the client oject
     */
    public function testHandlerClass()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        $this->assertTrue($client->sms instanceof Sms);
        $this->assertTrue($client->token instanceof Token);
        $this->assertTrue($client->sender instanceof  Sender);
        $this->assertTrue($client->insights instanceof Insights);
    }

    /**
     * Test for handler caching in the client oject
     */
    public function testMassFill()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        $client->fillOptions([
            'httpManager' => new GuzzleHttpManager($client, new Guzzle([
                // Base URI is used with relative requests
                'base_uri' => $client->baseUri(),
                // You can set any number of default request options.
                'timeout'  => 10.0,
            ])),
        ]);

        $this->assertTrue($client->getHttpManager() instanceof GuzzleHttpManager);
    }

    /**
     * Test for handler caching in the client oject
     */
    public function testSetHttpMannager()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        $httpManager = $client->getHttpManager();

        $client->fillOptions([
            'httpManager' => new GuzzleHttpManager($client, new Guzzle([
                // Base URI is used with relative requests
                'base_uri' => $client->baseUri(),
                // You can set any number of default request options.
                'timeout'  => 10.0,
            ])),
        ]);

        $this->assertTrue($client->getHttpManager() instanceof GuzzleHttpManager);
        $this->assertNotTrue($httpManager === $client->getHttpManager());
    }

    /**
     * Test for handler caching in the client oject
     */
    public function testSetHttpMannagerMethod()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        $oldHttpManager = $client->getHttpManager();

        $client->setHttpManager($httpManager = new GuzzleHttpManager($client, new Guzzle([
                // Base URI is used with relative requests
                'base_uri' => $client->baseUri(),
                // You can set any number of default request options.
                'timeout'  => 10.0,
            ])));

        $this->assertTrue($client->getHttpManager() instanceof GuzzleHttpManager);
        $this->assertNotTrue($oldHttpManager === $client->getHttpManager());
        $this->assertTrue($httpManager === $client->getHttpManager());
    }
}
