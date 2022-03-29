<?php

namespace ManeOlawale\Termii\Api\Response\Insights;

use ManeOlawale\Termii\Api\Response\ListResponse;

class InboxResponse extends ListResponse
{
    /**
     * @inheritDoc
     */
    public function getListArray(): array
    {
        return $this->responseArray['data']['data'];
    }
}
