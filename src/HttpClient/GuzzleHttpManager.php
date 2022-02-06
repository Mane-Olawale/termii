<?php

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ManeOlawale\Termii\HttpClient;

use GuzzleHttp\Client as GuzzleClient;
use ManeOlawale\Termii\Client;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpManager implements HttpManagerInterface
{
    /**
     * Termii client
     * @var \ManeOlawale\Termii\Client
     */
    protected $client;

    /**
     * Guzzle HTTP client
     * @var \GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * Contructor
     *
     * @since 1.2
     *
     * @param \GuzzleHttp\Client $guzzle
     */
    public function __construct(Client $client, GuzzleClient $guzzle)
    {
        $this->client = $client;
        $this->guzzle = $guzzle;
    }

    /**
     * Handle GET method
     *
     * @since 1.2
     *
     * @param string $method
     * @param string $route
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, string $route, array $data): ResponseInterface
    {
        return $this->guzzle->request($method, $route, $data);
    }
}
