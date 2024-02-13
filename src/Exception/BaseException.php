<?php
declare(strict_types=1);

namespace devitti\AzureADB2C\Exception;

abstract class BaseException extends \Exception
{
    public function __construct(string $message = '', $code = 500)
    {
        parent::__construct($message, $code);
    }
}
