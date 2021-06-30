<?php
declare(strict_types = 1);

namespace App\Exceptions\Domain;

use DomainException;

/**
 * @author Bogusław Trojański
 */
class VatRateNotExistException extends DomainException
{
    public static function createFromRate(?int $vatRate) : self
    {
        return new self(
            sprintf("Vat rate RATE %s not exists", $vatRate)
        );
    }
}