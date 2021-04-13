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
class Insights extends AbstractApi
{

    public function balance()
    {
        $response = $this->get('get-balance');

        return $this->responseArray($response);
    }

    public function search( string $phone_number )
    {
        $response = $this->get('check/dnd', [
            'phone_number' => $phone_number,
        ]);

        return $this->responseArray($response);
    }

    public function isDnd( string $phone_number )
    {
        $response = $this->search($phone_number);

        return (isset($response['dnd_active']) && $response['dnd_active'] !== false);
    }

    public function isNotDnd( string $phone_number )
    {
        return !$this->isDnd($phone_number);
    }

    public function number( string $phone_number, string $country = 'NG' )
    {
        $response = $this->get('insight/number/query', [
            'phone_number' => $phone_number,
            'country_code' => $country,
        ]);

        return $this->responseArray($response);
    }

    public function inbox(string $id = null)
    {
        $response = $this->get('sms/inbox', $id? [
            'message_id' => $id,
        ] : []);

        return $this->responseArray($response);
    }

}
