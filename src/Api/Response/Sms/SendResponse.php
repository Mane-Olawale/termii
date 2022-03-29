<?php

namespace ManeOlawale\Termii\Api\Response\Sms;

use ManeOlawale\Termii\Api\Response\Insights\InboxResponse;
use ManeOlawale\Termii\Api\Response\Response;

class SendResponse extends Response
{
    public function message(): ?InboxResponse
    {
        if ($this->successful()) {
            return $this->getClient()->insights->inbox($this['message_id']);
        }
    }
}
