<?php

namespace App\StalkerPay\User\Dto;

class SearchParam
{
    private int $limit = 8;

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
}
