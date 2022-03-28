<?php

namespace ManeOlawale\Termii\Api\Response\Sender;

use ManeOlawale\RestResponse\AbstractListResponse;

class ListResponse extends AbstractListResponse
{
    protected function getListArray(): array
    {
        return $this->responseArray['data'];
    }
}
