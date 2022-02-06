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

interface HttpManagerInterface
{
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
    public function request(string $method, string $route, array $data): ResponseInterface;
}
