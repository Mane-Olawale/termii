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

class Insights extends AbstractApi
{
    /**
     * Get the balance
     *
     * @since 1.0
     *
     * @return array
     */
    public function balance()
    {
        $response = $this->get('get-balance');
        return $this->responseArray($response);
    }

    /**
     * Search the phone number status in the DND database
     *
     * @since 1.0
     *
     * @return array
     */
    public function search(string $phone_number)
    {
        $response = $this->get('check/dnd', [
            'phone_number' => $phone_number,
        ]);

        return $this->responseArray($response);
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
     * @return array
     */
    public function number(string $phone_number, string $country = 'NG')
    {
        $response = $this->get('insight/number/query', [
            'phone_number' => $phone_number,
            'country_code' => $country,
        ]);

        return $this->responseArray($response);
    }

    /**
     * Fetch inbox history,
     *
     * @since 1.0
     *
     * @param string|null $id
     * @return array
     */
    public function inbox(string $id = null)
    {
        $response = $this->get('sms/inbox', $id ? [
            'message_id' => $id,
        ] : []);

        return $this->responseArray($response);
    }
}
