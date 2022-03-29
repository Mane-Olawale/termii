<?php

namespace ManeOlawale\Termii\Api\Response\Insights;

use ManeOlawale\Termii\Api\Response\Response;

class SearchResponse extends Response
{
    /**
     * Check is the number is DND active
     *
     * @return boolean
     */
    public function dnd(): bool
    {
        return $this->responseArray['dnd_active'];
    }
}
