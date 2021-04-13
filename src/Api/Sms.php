<?php

namespace ManeOlawale\Termii\Api;

/*
 * This file is part of the Termii Client.
 *
 * (c) Ilesanmi Olawale Adedoun Twitter: @mane_olawale
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Sms extends AbstractApi
{

    public function send( $to, string $text, string $sender_id = null, string $channel = null )
    {
        if (!$this->client->getSenderId() && !$sender_id) throw new \Exception('Termii client doesn`t have a default Sender ID');
        if (!$this->client->getChannel() && !$channel) throw new \Exception('Termii client doesn`t have a default message channel');

        $response = $this->post('sms/send', [
            'to' => $to,
            'from' => $sender_id ?? $this->client->getSenderId(),
            'sms' => $text,
            'type' => 'plain',
            'channel' => $channel ?? $this->client->getChannel(),
        ]);

        return $this->responseArray($response);
    }

    public function number( $to, string $text )
    {
        $response = $this->post('sms/number/send', [
            'to' => $to,
            'sms' => $text,
        ]);

        return $this->responseArray($response);
    }

    public function template( string $phone_number, string $template_id, array $data, string $device_id = null )
    {
        $extra = ($device_id)? [
            'device_id' => $device_id,
        ] : [];
        $response = $this->post('send/template', [
            'phone_number' => $phone_number,
            'template_id' => $template_id,
            'data' => $data
        ] + $extra);

        return $this->responseArray($response);
    }

    public function request(string $id, string $usecase, string $company)
    {
        $response = $this->post('sender-id/request', [
            'id' => $id,
            'usecase' => $usecase,
            'company' => $company,
        ]);

        return $this->responseArray($response);
    }

}
