<?php

namespace App\GraphQL;

use Exception;
use GraphQL\Error\ClientAware;
use GraphQL\Error\ProvidesExtensions;
class CustomException extends Exception implements ClientAware,ProvidesExtensions
{

    public function isClientSafe(): bool
    {
        return true;
    }


    public function getExtensions(): ?array
    {
        return [
            'reason' => $this->getMessage(),
            "code" => $this->getCode()
        ];
    }

    /**
     * @return mixed
     */

}
