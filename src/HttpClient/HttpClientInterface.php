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

interface HttpClientInterface
{
    
    /**
     * Handle GET method
     * 
     * @since 1.0
     * 
     * @param string $route
     * @param array $parameters
     * @return \GuzzleHttp\Response
     */
    public function get(string $route, array $parameters);
    
    /**
     * Handle POST method
     * 
     * @since 1.0
     * 
     * @param string $route
     * @param array $body
     * @return \GuzzleHttp\Response
     */
    public function post(string $route, array $body);

}
