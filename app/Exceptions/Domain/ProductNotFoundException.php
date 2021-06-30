<?php
declare(strict_types = 1);

namespace App\Exceptions\Domain;

use DomainException;

/**
 * @author Bogusław Trojański
 */
class ProductNotFoundException extends DomainException
{
    public static function createFromId(?int $idProduct) : self
    {
        return new self(
            sprintf("Product with given ID %s not exists", $idProduct)
        );
    }
}