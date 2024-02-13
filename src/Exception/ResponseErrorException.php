<?php
declare(strict_types=1);

namespace devitti\AzureADB2C\Exception;

class ResponseErrorException extends BaseException
{
    public function __construct(string $message = '', $code = 500)
    {
        parent::__construct($message, $code);
    }
}