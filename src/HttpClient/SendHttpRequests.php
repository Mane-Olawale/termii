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

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

trait SendHttpRequests
{
    protected $httpManager;

    /**
     * Return the default header data
     *
     * @since 1.0
     *
     * @return array
     */
    public function headers()
    {
        return [
            'User-Agent' => $this->getUserAgent(),
            'Content-Type'     => 'application/json',
            'Accept'     => 'application/json',
        ];
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
        return $this->request('GET', $route, [
            'headers' => $this->headers(),
            'query' => $parameters + $this->keyParameter(),
        ]);
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
        return $this->request('POST', $route, [
            'headers' => $this->headers(),
            'body' => json_encode($this->keyParameter() + $body),
        ]);
    }

    /**
     * Handle GET method
     *
     * @since 1.0
     *
     * @param string $method
     * @param string $route
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, string $route, array $data): ResponseInterface
    {
        try {
            return $this->httpManager->request($method, $this->baseUri() . $route, $data);
        } catch (BadResponseException $th) {
            if ($th->hasResponse()) {
                return $th->getResponse();
            } else {
                throw $th;
            }
        }
    }

    /**
     * Return the api key array data
     *
     * @since 1.0
     *
     * @return array
     */
    public function keyParameter()
    {
        return [
            'api_key' => $this->getKey(),
        ];
    }
}
