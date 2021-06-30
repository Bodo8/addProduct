<?php
declare(strict_types = 1);

namespace Tests\MotherObject\Cart;

use Cart\Domain\Entity\Cart;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class CartMother
{
    public static function getOne(int $idCustomer): Cart
    {
        return new Cart(
            null,
            new \DateTime('now'),
            new \DateTime('now'),
            $idCustomer,
            new Currency('PLN'),
            1000,
            75,
            []
        );
    }

    public static function getCartWithDetails(int $idCustomer): Cart
    {
        return new Cart(
            null,
            new \DateTime('now'),
            new \DateTime('now'),
            $idCustomer,
            new Currency('PLN'),
            1000,
            75,
            CartDetailMother::get_cart_details()
        );
    }
}