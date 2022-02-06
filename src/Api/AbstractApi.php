<?php

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ManeOlawale\Termii\Api;

use ManeOlawale\Termii\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * @property $client The termii client intance
 */
class AbstractApi
{
    /**
     * The termii client instance
     *
     * @var \ManeOlawale\Termii\Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle GET method
     *
     * @since 1.0
     *
     * @param string $route
     * @param array $parameters
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $route, array $parameters = []): ResponseInterface
    {
        return $this->client->get($route, $parameters);
    }

    /**
     * Handle POST method
     *
     * @since 1.0
     *
     * @param string $route
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $route, array $body): ResponseInterface
    {
        return $this->client->post($route, $body);
    }

    /**
     * Change a response instance to array
     *
     * @since 1.0
     *
     * @param ResponseInterface $response
     * @return array
     */
    public function responseArray(ResponseInterface $response)
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
