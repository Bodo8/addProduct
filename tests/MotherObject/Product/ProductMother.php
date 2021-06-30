<?php
declare(strict_types = 1);

namespace Tests\Unit\Product\MotherObject;

use Product\Domain\Entity\Product;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class ProductMother
{
    public static function getOne() : Product
    {
        return new Product(
            null,
            'product example',
            5,
        new Currency(Currency::USD)
        );
    }

    public static function getProducts() : array
    {
        return [
            new Product(
            null,
            'product example 1',
            5,
            new Currency(Currency::USD)
        ),
            new Product(
                null,
                'product example 2',
                6,
                new Currency(Currency::USD)
            ) ,
            new Product(
                null,
                'product example 3',
                7,
                new Currency(Currency::USD)
            ) ,
            new Product(
                null,
                'product example 4',
                8,
                new Currency(Currency::USD)
            )
            ];
    }

}