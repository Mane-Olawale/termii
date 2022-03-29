<?php

namespace ManeOlawale\Termii\Api\Response\Sender;

use ManeOlawale\Termii\Api\Response\ListResponse as BaseListResponse;

class ListResponse extends BaseListResponse
{
    /**
     * @inheritDoc
     */
    protected function getListArray(): array
    {
        return $this->responseArray['data'];
    }
}
