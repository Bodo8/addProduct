<?php
declare(strict_types = 1);

namespace App\Exceptions\Domain;

use DomainException;

/**
 * @author Bogusław Trojański
 */
class CartDetailNotFoundException extends DomainException
{

    public static function createFromId(int $idDetail)
    {
        return new self(
            sprintf("Detail with given ID %s not exists", $idDetail)
        );
    }
}