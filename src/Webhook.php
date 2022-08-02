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

use Closure;

class Webhook
{
    /**
     * Load webhook using a closure
     *
     * @var \Closure
     */
    protected static $loader;

    /**
     * Raw webhook payload
     *
     * @var string
     */
    protected $raw = '';

    /**
     * Termii client object
     *
     * @var \ManeOlawale\Termii\Client
     */
    protected $client;

    /**
     * Payload to array
     *
     * @var array
     */
    protected $data;

    /**
     * Payload to object
     *
     * @var \stdClass
     */
    protected $object;

    /**
     * Webhook signature string
     *
     * @var string
     */
    protected $signature = '';

    /**
     * Event string
     *
     * @var string
     */
    protected $event;

    /**
     * Array of listeners
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * Instantiate new webook
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Instantiate new webook and load it
     *
     * @param Client $client
     * @return self
     */
    public static function create(Client $client): self
    {
        $evt = new static($client);
        $evt->load();
        return $evt;
    }

    /**
     * Webhook loading using a closure
     *
     * @param Closure $closure
     * @return void
     */
    public static function loader(Closure $closure)
    {
        static::$loader = $closure;
    }

    /**
     * Reset loader
     *
     * @return void
     */
    public static function resetloader()
    {
        unset(static::$loader);
    }

    /**
     * Reset after loading the object
     *
     * @return self
     */
    public function reset()
    {
        unset($this->raw);
        unset($this->object);
        unset($this->event);
        unset($this->data);
        unset($this->signature);

        return $this;
    }

    /**
     * Reset listeners
     *
     * @return self
     */
    public function resetListeners()
    {
        $this->listeners = [];

        return $this;
    }

    /**
     * Load the request content
     *
     * @param Closure|null $loader
     * @return self
     */
    public function load(Closure $loader = null)
    {
        if ($loader) {
            $loader->call($this);
            return $this;
        }

        if (isset(static::$loader)) {
            static::$loader->call($this);
            return $this;
        }

        $this->raw = @file_get_contents('php://input');
        $this->object = @json_decode($this->raw);
        $this->event = $this->object->type;
        $this->data = @json_decode($this->raw, true);
        $this->signature = $_SERVER['HTTP_X_TERMII_SIGNATURE'];

        return $this;
    }

    protected function valid()
    {
        return hash_equals($this->signature, hash_hmac(
            'sha512',
            $this->raw,
            $this->client->getSecretKey()
        ));
    }

    /**
     * Add listener to an event
     *
     * @param string $event
     * @param callable $callable
     * @return self
     */
    public function on(string $event, callable $callable): self
    {
        if (in_array($event, $this->allowedEvents())) {
            $this->listeners[$event][] = $callable;
            return $this;
        }

        throw new \Exception("[$event] is not a supported event");
    }

    /**
     * Listen to webhook events
     *
     * @return self
     */
    public function listen(): self
    {
        if ($this->valid() && ($callables = $this->getListeners())) {
            foreach ($callables as $callable) {
                call_user_func_array($callable, [$this->client, $this->event, $this->object, $this->data]);
            }
        }

        return $this;
    }

    /**
     * Get array of listeners
     *
     * @param string|null $event
     * @return array
     */
    public function getListeners(string $event = null): array
    {
        return $this->listeners[$event ?? $this->event] ?? [];
    }

    /**
     * Get array of allowed events
     *
     * @return array
     */
    protected function allowedEvents(): array
    {
        return [
            'inbound',
            'outbound',
            'device_status',
        ];
    }
}
