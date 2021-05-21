<?php

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ManeOlawale\Termii\Api;

class Token extends AbstractApi
{

    /**
     * Send OTP token to a number
     * 
     * @since 1.0
     * 
     * @param string|array $to
     * @param string $text
     * @param array $pin
     * @param string $from
     * @param string $channel
     * @param string $message_type
     * @return array
     */
    public function sendToken( string $to, string $text, array $pin, string $from = null, string $channel = null, string $message_type = null )
    {
        if (!$this->client->getSenderId() && !$from) throw new \Exception('Termii client doesn`t have a default Sender ID');
        if (!$this->client->getChannel() && !$channel) throw new \Exception('Termii client doesn`t have a default message channel');

        $response = $this->post('sms/otp/send', [
            'to' => $to,
            'message_text' => $text,
            'message_type' => $message_type ?? $this->client->getPinType(),
            'pin_attempts' => $pin['attempts'] ?? $this->client->getAttempts(),
            'pin_time_to_live' => $pin['time_to_live'] ?? $this->client->getTimeToLive(),
            'pin_length' => $pin['length'] ?? $this->client->getLength(),
            'pin_placeholder' => $pin['placeholder'] ?? $this->client->getPlaceholder(),
            'from' => $from ?? $this->client->getSenderId(),
            'channel' => $channel ?? $this->client->getChannel(),
        ]);

        return $this->responseArray($response);
    }

    /**
     * Verify an OTP against a pin id
     * 
     * @since 1.0
     * 
     * @param string $pin_id
     * @param string $pin
     * @return array
     */
    public function verify( string $pin_id, string $pin )
    {
        $response = $this->post('sms/otp/verify', [
            'pin_id' => $pin_id,
            'pin' => $pin,
        ]);

        return $this->responseArray($response);
    }

    /**
     * Verify an OTP against a pin id
     * 
     * @since 1.0
     * 
     * @param string $pin_id
     * @param string $pin
     * @return boolean
     */
    public function verified( string $pin_id, string $pin )
    {
        $array = $this->verify($pin_id, $pin);

        return (isset($array['verified']) && $array['verified'] === true);
    }

    /**
     * Verify an OTP against a pin id if expired
     * 
     * @since 1.0
     * 
     * @param string $pin_id
     * @param string $pin
     * @return boolean
     */
    public function expired( string $pin_id, string $pin )
    {
        $array = $this->verify($pin_id, $pin);

        return (isset($array['verified']) && $array['verified'] === 'Expired');
    }

    /**
     * Verify an OTP against a pin id if failed
     * 
     * @since 1.0
     * 
     * @param string $pin_id
     * @param string $pin
     * @return boolean
     */
    public function failed( string $pin_id, string $pin )
    {
        $array = $this->verify($pin_id, $pin);

        return (!isset($array['verified']) && isset($array['pinId']));
    }

    /**
     * Send in-app OTP token to a number
     * 
     * @since 1.0
     * 
     * @param string|array $phone_number
     * @param array $pin
     * @return array
     */
    public function sendInAppToken( string $phone_number, array $pin )
    {
        $response = $this->post('sms/otp/generate', [
            'phone_number' => $phone_number,
            'pin_attempts' => $pin['attempts'] ?? $this->client->getAttempts(),
            'pin_time_to_live' => $pin['time_to_live'] ?? $this->client->getTimeToLive(),
            'pin_length' => $pin['length'] ?? $this->client->getLength(),
            'pin_type' => $pin['type'] ?? $this->client->getPinType(),
        ]);

        return $this->responseArray($response);
    }

}
