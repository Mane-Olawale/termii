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
use ManeOlawale\Termii\Api\Response\Sender\ListResponse;

class Sender extends AbstractApi
{
    /**
     * Get list of sender id
     *
     * @since 1.0
     *
     * @return ListResponse
     */
    public function list(): ListResponse
    {
        $response = $this->get('sender-id');
        return $this->mapResponse($response, __FUNCTION__);
    }

    /**
     * Request a sender id
     *
     * @since 1.0
     *
     * @param string $sender_id
     * @param string $usecase
     * @param string $company
     * @return Response
     */
    public function request(string $sender_id, string $usecase, string $company): Response
    {
        $response = $this->post('sender-id/request', [
            'sender_id' => $sender_id,
            'usecase' => $usecase,
            'company' => $company,
        ]);

        return $this->response($response);
    }
}
