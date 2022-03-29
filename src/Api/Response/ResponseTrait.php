<?php

namespace ManeOlawale\Termii\Api\Response;

use ManeOlawale\Termii\Client;

trait ResponseTrait
{
    /**
     * Termii client instance
     *
     * @var Client
     */
    protected $termiiClient;

    /**
     * Set the client instance
     *
     * @param Client $client
     * @return self
     */
    public function setClient(Client $client): self
    {
        $this->termiiClient = $client;

        return $this;
    }

    /**
     * Set the client instance
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->termiiClient;
    }
}
