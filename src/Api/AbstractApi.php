<?php

namespace ManeOlawale\Termii\Api;

use ManeOlawale\Termii\Client;
use Psr\Http\Message\ResponseInterface;

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

    public function responseArray( ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
        }

        return $body;
    }

}
