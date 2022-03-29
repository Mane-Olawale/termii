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

use ManeOlawale\Termii\Api\Response\Insights\InboxResponse;
use ManeOlawale\Termii\Api\Response\Insights\SearchResponse;
use ManeOlawale\Termii\Api\Response\Response;

class Insights extends AbstractApi
{
    /**
     * Get the balance
     *
     * @since 1.0
     *
     * @return Response
     */
    public function balance(): Response
    {
        $response = $this->get('get-balance');
        return $this->response($response);
    }

    /**
     * Search the phone number status in the DND database
     *
     * @since 1.0
     *
     * @return SearchResponse
     */
    public function search(string $phone_number): SearchResponse
    {
        $response = $this->get('check/dnd', [
            'phone_number' => $phone_number,
        ]);

        return $this->mapResponse($response, __FUNCTION__);
    }

    /**
     * Verify if phone number is DND active
     *
     * @since 1.0
     * @deprecated 1.3 this functions will not be available in the next version 2.0 and => 1.6
     *
     * @param string $phone_number
     * @return boolean
     */
    public function isDnd(string $phone_number)
    {
        $response = $this->search($phone_number);
        return (isset($response['dnd_active']) && $response['dnd_active'] !== false);
    }

    /**
     * Verify if phone number is not DND active
     *
     * @since 1.0
     * @deprecated 1.3 this functions will not be available in the next version 2.0 and => 1.6
     *
     * @param string $phone_number
     * @return boolean
     */
    public function isNotDnd(string $phone_number)
    {
        return !$this->isDnd($phone_number);
    }

    /**
     * Get the details of a number
     *
     * @since 1.0
     *
     * @param string $phone_number
     * @param string $country
     * @return Response
     */
    public function number(string $phone_number, string $country = 'NG'): Response
    {
        $response = $this->get('insight/number/query', [
            'phone_number' => $phone_number,
            'country_code' => $country,
        ]);

        return $this->response($response);
    }

    /**
     * Fetch inbox history,
     *
     * @since 1.0
     *
     * @param string|null $id
     * @return InboxResponse
     */
    public function inbox(string $id = null): InboxResponse
    {
        $response = $this->get('sms/inbox', $id ? [
            'message_id' => $id,
        ] : []);

        return $this->mapResponse($response, __FUNCTION__);
    }
}
