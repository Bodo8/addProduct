<?php
declare(strict_types = 1);

namespace Cart\Domain\Entity;

use SharedKernel\ValueObject\Currency;
use Tests\MotherObject\Cart\CartDetailMother;
use Tests\MotherObject\Cart\CartMother;

/**
 * @author Bogusław Trojański
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /** @var Cart $cart */
    private $cart;

    public function setUp()
    {
        $this->cart = CartMother::getOne(2);
    }

    public function test_get_total_netto()
    {
        $this->assertEquals(1000, $this->cart->getTotalNetto());
    }

    public function test_get_id_customer()
    {
        $this->assertEquals(2, $this->cart->getIdCustomer());
    }

    public function test_get_currency()
    {
        $this->assertEquals(new Currency('PLN'), $this->cart->getCurrency());
    }

    public function test_get_averageNetto()
    {
        $this->assertEquals(75, $this->cart->getAverageBrutto());
    }

    public function test_add_detail_difference_currency()
    {
        $detail = CartDetailMother::get_one_with_currency_usd(1);

        $this->assertTrue(!$this->cart->addDetail($detail));
    }

    public function test_add_detail_the_same_currency()
    {
        $detail = CartDetailMother::get_one(1);

        $this->assertTrue($this->cart->addDetail($detail));
    }

    public function test_add_details_the_same_currency()
    {
        $details = CartDetailMother::get_cart_details();

        $this->assertTrue($this->cart->addDetails($details));
        $this->assertEquals(3, count($this->cart->getDetails()));
    }

    public function test_add_details_difference_currency()
    {
        $details = CartDetailMother::get_cart_details_mixed_currency();

        $this->assertTrue(!$this->cart->addDetails($details));
        $this->assertEquals(1, count($this->cart->getDetails()));
    }
}
