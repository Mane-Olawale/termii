<?php

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ManeOlawale\Termii;

use GuzzleHttp\Client as Guzzle;
use ManeOlawale\Termii\HttpClient\GuzzleHttpManager;
use ManeOlawale\Termii\HttpClient\HttpClientInterface;
use ManeOlawale\Termii\HttpClient\HttpManagerInterface;
use ManeOlawale\Termii\HttpClient\SendHttpRequests;

/**
 *
 * @since 1.0
 *
 * @property-read \ManeOlawale\Termii\Api\Sender $sender
 * @property-read \ManeOlawale\Termii\Api\Sms $sms
 * @property-read \ManeOlawale\Termii\Api\Token $token
 * @property-read \ManeOlawale\Termii\Api\Insights $insights
 *
 * @method \ManeOlawale\Termii\Api\AbstractApi api( string $tag )
 * @method string getEndpointHandler( string $tag)
 * @method Client fillOptions(array $options)
 * @method string baseUri()
 * @method string getKey()
 * @method string getSenderId()
 * @method string getChannel()
 * @method string getUserAgent()
 * @method int getAttempts()
 * @method string getMessageType()
 * @method int getTimeToLive()
 * @method int getLength()
 * @method string getPlaceholder()
 * @method string getPinType()
 * @method string getType()
 * @method string apiMap()
 */
class Client implements HttpClientInterface
{
    use SendHttpRequests;

    /**
     * Base url of termii api
     * @var string
     */
    public $url = 'https://api.ng.termii.com/api/';

    /**
     * User agent for the HTTP client
     * @var string
     */
    protected $userAgent = 'Termii Library: mane-olawale/termii';

    /**
     * Secret Key for Termii api
     * @var string
     */
    protected $key;

    /**
     * The default sender id used by the Termii Client
     * @var string
     */
    protected $sender_id;

    /**
     * The default channel used by the Termii Client
     * @var string
     */
    protected $channel;

    /**
     * The default attempts for OTP sent by the Termii Client
     * @var string
     */
    protected $attempts;

    /**
     * The default time to live for OTP sent by the Termii Client
     * @var string
     */
    protected $time_to_live;

    /**
     * The default length for OTP sent by the Termii Client
     * @var string
     */
    protected $length;

    /**
     * The default placeholder for OTP string sent by the Termii Client
     * @var string
     */
    protected $placeholder;

    /**
     * The default type used by the Termii Client
     * @var string
     */
    protected $type = 'plain';

    /**
     * The default type for OTP sent by the Termii Client
     * @var string
     */
    protected $pin_type = 'NUMERIC';

    /**
     * The default message type sent by the Termii Client
     * @var string
     */
    protected $message_type = 'ALPHANUMERIC';

    /**
     * Array of instantiated Api handlers
     * @var string
     */
    protected $apis = [
        //
    ];

    public function __construct(string $key, array $options = null, HttpManagerInterface $httpManager = null)
    {
        $this->key = $key;

        if (isset($options)) {
            $this->fillOptions($options);
        }

        $this->httpManager = $httpManager ?? new GuzzleHttpManager($this, new Guzzle([
            'timeout'  => 10.0,
        ]));
    }

    /**
     * Mass fill the client option
     *
     * @since 1.0
     *
     * @param array $options Associate Array contating the options
     * @return static $this Return the client object for method chaining
     */
    public function fillOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (is_string($key) && property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }

    /**
     * Dynamic property to get the api handlers
     *
     * @since 1.0
     *
     * @param string $tag Endpoint Tag Name
     */
    public function __get(string $tag)
    {
        return $this->api($tag);
    }

    /**
     * Get the endpoint handler through tag name
     *
     * @since 1.0
     *
     * @param string $tag Endpoint Tag Name
     */
    public function api(string $tag)
    {
        if (isset($this->apis[$tag])) {
            return $this->apis[$tag];
        }

        $class = $this->getEndpointHandler($tag);
        return $this->apis[$tag] = new $class($this);
    }

    /**
     * Get the endpoint handler class name through tag name
     *
     * @since 1.0
     *
     * @param string $tag Endpoint Tag Name
     */
    protected function getEndpointHandler(string $tag)
    {
        $map = $this->apiMap();

        if (isset($map[$tag])) {
            return $map[$tag];
        }

        throw new \Exception("The [$tag] is not a valid Endpoint tag.");
    }

    /**
     * Get the base URI of the client
     *
     * @since 1.0
     *
     * @return string
     */
    public function baseUri()
    {
        return $this->url;
    }

    /**
     * Get the Secret key of the client
     *
     * @since 1.0
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the http client
     *
     * @since 1.2
     *
     * @return \ManeOlawale\Termii\HttpClient\HttpManagerInterface
     */
    public function getHttpManager()
    {
        return $this->httpManager;
    }

    /**
     * Get the default sender ID
     *
     * @since 1.0
     *
     * @return string
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * Get the default channel
     *
     * @since 1.0
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Get the user agent for the http client
     * @since 1.0
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Get the number of attempts for OTP
     *
     * @since 1.0
     *
     * @return string
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * Get the default message type
     *
     * @since 1.0
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->message_type;
    }

    /**
     * Get the duration for OTP
     *
     * @since 1.0
     *
     * @return string
     */
    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    /**
     * Get the default length of out going OTP
     *
     * @since 1.0
     *
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Get the placeholder for OTP string
     *
     * @since 1.0
     *
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Get the default pin type for OTP
     *
     * @since 1.0
     *
     * @return string
     */
    public function getPinType()
    {
        return $this->pin_type;
    }

    /**
     * Get default type
     *
     * @since 1.0
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the httpManager instance
     *
     * @since 1.2
     *
     * @param \ManeOlawale\Termii\HttpClient\HttpManagerInterface $httpManager
     *
     * @return self
     */
    public function setHttpManager(HttpManagerInterface $httpManager)
    {
        $this->httpManager = $httpManager;

        return $this;
    }

    /**
     * Get the endpoint handler tag map
     *
     * @since 1.0
     *
     * @return string
     */
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
