<?php
declare(strict_types = 1);

namespace App\Exceptions\Domain;

use DomainException;

/**
 * @author Bogusław Trojański
 */
class CartNotFoundException extends DomainException
{
    public static function createFromId(?int $idCart) : self
    {
        return new self(
            sprintf("Cart with given ID %s not exists", $idCart)
        );
    }
}