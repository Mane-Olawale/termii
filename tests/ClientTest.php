<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Client as Guzzle;
use ManeOlawale\Termii\Client;
use ManeOlawale\Termii\Api\Sender;
use ManeOlawale\Termii\Api\Sms;
use ManeOlawale\Termii\Api\Token;
use ManeOlawale\Termii\Api\Insights;

class ClientTest extends TestCase
{
    /**
     * Test for handler caching in the client oject
     */
    public function test_handler_caching()
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
    public function test_handler_class()
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
    public function test_mass_fill()
    {
        $client = new Client('rtyuikjbvdrtyujhbvdrtyujnhbvcftyhbvcdrtg');

        $client->fillOptions([
            'httpClient' => new Guzzle([
                // Base URI is used with relative requests
                'base_uri' => $client->baseUri(),
                // You can set any number of default request options.
                'timeout'  => 10.0,
            ]),
        ]);

        $this->assertTrue($client->getHttpClient() instanceof Guzzle);

    }
    
}
