<?php

namespace ManeOlawale\Termii;

use GuzzleHttp\Client as Guzzle;
use ManeOlawale\Termii\HttpClient\HttpClientInterface;
use ManeOlawale\Termii\HttpClient\SendHttpRequests;

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Client implements HttpClientInterface
{

    use SendHttpRequests;

    public $url = 'https://termii.com/api/';

    private $userAgent = 'Termii Library: mane-olawale/monnify';

    private $key;

    private $sender_id;

    private $channel;

    public function __construct(string $key, string $sender_id = null, string $channel = null )
    {
        $this->key = $key;

        $this->sender_id = $sender_id;

        $this->channel = $channel;

        $this->httpClient = new Guzzle([
            // Base URI is used with relative requests
            'base_uri' => $this->baseUri(),
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);
    }

    public function api( string $tag )
    {
        $class = $this->getEndpointHandler($tag);

        return new $class($this);
    }

    public function getEndpointHandler(string $tag)
    {
        $map = $this->apiMap();

        if (isset($map[$tag])) {
            return $map[$tag];
        }

        throw new \Exception("The [$tag] is not a valid Endpoint tag.");
    }

    public function baseUri()
    {
        return $this->url;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getSenderId()
    {
        return $this->sender_id;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function apiMap()
    {
        return [
            'sender' => \ManeOlawale\Termii\Api\Sender::class,
            'sms' => \ManeOlawale\Termii\Api\Sms::class,
            'token' => \ManeOlawale\Termii\Api\Token::class,
        ];
    }
    
}
