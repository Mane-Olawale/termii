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

use ManeOlawale\Termii\Api\Response\Response;
use ManeOlawale\Termii\Api\Response\Sms\SendResponse;

class Sms extends AbstractApi
{
    /**
     * Send message to a number or array of numbers
     *
     * @since 1.0
     *
     * @param string|array $to
     * @param string $text
     * @param string $sender_id
     * @param string $channel
     * @return SendResponse
     * @throws \Exception
     */
    public function send($to, string $text, string $sender_id = null, string $channel = null): SendResponse
    {
        if (!$this->client->getSenderId() && !$sender_id) {
            throw new \Exception('Termii client doesn`t have a default Sender ID');
        }

        if (!$this->client->getChannel() && !$channel) {
            throw new \Exception('Termii client doesn`t have a default message channel');
        }

        $response = $this->post('sms/send', [
            'to' => $to,
            'from' => $sender_id ?? $this->client->getSenderId(),
            'sms' => $text,
            'type' => $this->client->getType(),
            'channel' => $channel ?? $this->client->getChannel(),
        ]);

        return $this->mapResponse($response, __FUNCTION__);
    }

    /**
     * Send message to a number or array of numbers termii's auto-generated messaging numbers
     *
     * @since 1.0
     *
     * @param string|array $to
     * @param string $text
     * @return Response
     */
    public function number($to, string $text): Response
    {
        $response = $this->post('sms/number/send', [
            'to' => $to,
            'sms' => $text,
        ]);

        return $this->response($response);
    }

    /**
     * Template
     *
     * @since 1.0
     *
     * @param string $phone_number
     * @param string $template_id
     * @param array $data
     * @param string $device_id
     * @return Response
     */
    public function template(string $phone_number, string $template_id, array $data, string $device_id = null): Response
    {
        $extra = ($device_id) ? [
            'device_id' => $device_id,
        ] : [];

        $response = $this->post('send/template', [
            'phone_number' => $phone_number,
            'template_id' => $template_id,
            'data' => $data
        ] + $extra);

        return $this->response($response);
    }
}
