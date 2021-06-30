<?php
declare(strict_types = 1);

namespace SharedKernel\ValueObject;

use DomainException;

/**
 * @author Bogusław Trojański
 */
class VatIncorrectTypeException extends DomainException
{
    public static function createFromType(int $vat) : self
    {
        return new self(
            sprintf("The value '%s'is not compatible with the available vat rates", $vat)
        );
    }
}
