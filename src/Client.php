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

    protected $userAgent = 'Termii Library: mane-olawale/monnify';

    protected $key;

    protected $sender_id;

    protected $channel;

    protected $attempts;

    protected $time_to_live;

    protected $length;

    protected $placeholder;

    protected $type = 'plain';

    protected $pin_type = 'NUMERIC';

    protected $message_type = 'ALPHANUMERIC';

    public function __construct(string $key, array $options = null )
    {
        $this->key = $key;

        if (isset($options)) $this->fillOptions($options);

        $this->httpClient = new Guzzle([
            // Base URI is used with relative requests
            'base_uri' => $this->baseUri(),
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);
    }

    public function fillOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (is_string($key) && property_exists($this, $key)) $this->{$key} = $value;
        }
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

    public function getAttempts()
    {
        return $this->attempts;
    }

    public function getMessageType()
    {
        return $this->message_type;
    }

    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function getPinType()
    {
        return $this->pin_type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function apiMap()
    {
        return [
            'sender' => \ManeOlawale\Termii\Api\Sender::class,
            'sms' => \ManeOlawale\Termii\Api\Sms::class,
            'token' => \ManeOlawale\Termii\Api\Token::class,
            'insights' => \ManeOlawale\Termii\Api\Insights::class,
        ];
    }
    
}
