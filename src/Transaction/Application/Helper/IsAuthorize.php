<?php

namespace App\Transaction\Application\Helper;

final class IsAuthorize
{
    public function __invoke(array $authorize): bool
    {
        return $authorize['authorize'] == true;
    }
}