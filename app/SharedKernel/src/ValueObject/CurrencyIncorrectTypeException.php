<?php
declare(strict_types = 1);

namespace SharedKernel\ValueObject;

use DomainException;

/**
 * @author Bogusław Trojański
 */
class CurrencyIncorrectTypeException extends DomainException
{
    public static function createFromType(string $type) : self
    {
        return new self(
            sprintf("The type '%s'is not compatible with the available currency", $type)
        );
    }

}