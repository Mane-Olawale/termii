<?php

namespace ManeOlawale\Termii\Api\Response\Insights;

use ManeOlawale\RestResponse\AbstractListResponse;

class InboxResponse extends AbstractListResponse
{
    /**
     * @inheritDoc
     */
    public function getListArray(): array
    {
        return $this->responseArray['data']['data'];
    }
}
