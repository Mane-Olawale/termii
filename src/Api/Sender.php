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

class Sender extends AbstractApi
{

    public function list()
    {
        $response = $this->get('sender-id');

        return $this->responseArray($response);
    }

    public function request(string $sender_id, string $usecase, string $company)
    {
        $response = $this->post('sender-id/request', [
            'sender_id' => $sender_id,
            'usecase' => $usecase,
            'company' => $company,
        ]);

        return $this->responseArray($response);
    }

}
