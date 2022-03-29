<?php

namespace ManeOlawale\Termii\Api\Response\Token;

use ManeOlawale\Termii\Api\Response\Response;

class VerifyResponse extends Response
{
    /**
     * Check if the token is verified
     *
     * @return boolean
     */
    public function verified(): bool
    {
        return $this->responseArray['verified'] === true;
    }

    /**
     * Check if the token verification failed
     *
     * @return boolean
     */
    public function failed(): bool
    {
        return $this->responseArray['verified'] === false;
    }

    /**
     * Check if the token verification expired
     *
     * @return boolean
     */
    public function expired(): bool
    {
        return $this->responseArray['verified'] === 'Expired' &&
                $this->status() === 400;
    }

    /**
     * Check if the token verification failed
     *
     * @return boolean
     */
    public function notFound(): bool
    {
        return $this->status() === 422;
    }

    /**
     * Execute the given callback if the token was verified
     *
     * @param  callable  $callback
     * @return self
     */
    public function onVerified(callable $callback)
    {
        if ($this->verified()) {
            $callback($this);
        }

        return $this;
    }

    /**
     * Execute the given callback if the token was failed
     *
     * @param  callable  $callback
     * @return self
     */
    public function onFailed(callable $callback)
    {
        if ($this->failed()) {
            $callback($this);
        }

        return $this;
    }

    /**
     * Execute the given callback if the token was expired
     *
     * @param  callable  $callback
     * @return self
     */
    public function onExpired(callable $callback)
    {
        if ($this->expired()) {
            $callback($this);
        }

        return $this;
    }
}
