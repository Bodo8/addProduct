<?php
declare(strict_types = 1);

namespace Tests\MotherObject\Cart;

use Cart\Domain\Entity\CartDetail;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class CartDetailMother
{
    public static function get_one(int $idCart): CartDetail
    {
      return new CartDetail(
          $idCart,
          new Currency(Currency::PLN),
          1,
          null,
          1,
          'product example PLN',
          1000,
          23
      );
    }

    public static function get_one_with_currency_usd(int $idCart): CartDetail
    {
        return new CartDetail(
            $idCart,
            new Currency(Currency::USD),
            1,
            null,
            1,
            'product example USD',
            1000,
            23
        );
    }

    public static function get_cart_details(): array
    {
        return [
            new CartDetail(
                1,
                new Currency(Currency::PLN),
                4,
                null,
                1,
                'product example 4',
                1000,
                23
            ),
            new CartDetail(
                1,
                new Currency(Currency::PLN),
                2,
                null,
                2,
                'product example 2',
                1000,
                8
            ),
            new CartDetail(
                1,
                new Currency(Currency::PLN),
                3,
                null,
                2,
                'product example 3',
                1000,
                0
            ),
        ];
    }

    public static function get_cart_details_mixed_currency(): array
    {
        return [
            new CartDetail(
                1,
                new Currency(Currency::PLN),
                1,
                null,
                1,
                'product example',
                1000,
                23
            ),
            new CartDetail(
                1,
                new Currency(Currency::USD),
                2,
                null,
                2,
                'product example',
                1000,
                8
            ),
            new CartDetail(
                1,
                new Currency(Currency::PLN),
                3,
                null,
                2,
                'product example',
                1000,
                0
            ),
        ];
    }

    public static function get_update_detail(int $expectQuantity): CartDetail
    {
        return new CartDetail(
            1,
            new Currency(Currency::PLN),
            3,
            null,
            $expectQuantity,
            'product example 3',
            1000,
            0
        );
    }
}
