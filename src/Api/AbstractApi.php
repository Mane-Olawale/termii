<?php

namespace ManeOlawale\Termii\Api;

use ManeOlawale\Termii\Client;
use GuzzleHttp\Psr7\Response;

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class AbstractApi
{

    protected $client;

    public function __construct( Client $client )
    {
        $this->client = $client;
    }

    public function get( string $route, array $parameters = [])
    {
        return $this->client->get($route, $parameters);
    }

    public function post( string $route, array $body)
    {
        return $this->client->post($route, $body);
    }

    public function responseArray( Response $response)
    {
        return json_decode($response->getBody(), true);
    }

}
