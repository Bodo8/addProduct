<?php

namespace Cart\Domain\Entity;

use App\Exceptions\Domain\VatRateNotExistException;
use SharedKernel\ValueObject\Currency;
use Tests\MotherObject\Cart\CartDetailMother;

/**
 * @author Bogusław Trojański
 */
class CartDetailTest extends \PHPUnit_Framework_TestCase
{

    public function test_get_id_product()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->assertEquals(1, $cartDetail->getIdProduct());
    }

    public function test_get_vat()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->assertEquals(23, $cartDetail->getVatRate());
    }

    public function test_get_quantity()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->assertEquals(1, $cartDetail->getQuantity());
    }

    public function test_get_netto()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->assertEquals(1000, $cartDetail->getNetto());
    }

    public function test_get_currency()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->assertEquals(new Currency('PLN'), $cartDetail->getCurrency());
    }

    public function test_get_name()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->assertEquals('product example PLN', $cartDetail->getName());
    }

    public function test_vat_rate_16_not_exist()
    {
        $this->expectException(VatRateNotExistException::class);
        new CartDetail(
            1,
            new Currency('PLN'),
            1,
            null,
            1,
            'product example',
            1000,
            16
        );
    }
}
