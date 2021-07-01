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

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    /**
     * Handle GET method
     *
     * @since 1.0
     *
     * @param string $route
     * @param array $parameters
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $route, array $parameters): ResponseInterface;

    /**
     * Handle POST method
     *
     * @since 1.0
     *
     * @param string $route
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $route, array $body): ResponseInterface;
}
