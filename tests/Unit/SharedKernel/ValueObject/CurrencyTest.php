<?php
declare( strict_types = 1);

namespace SharedKernel\ValueObject;

/**
 * @author Bogusław Trojański
 */
class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_currency_description()
    {
        $data = Currency::getCurrencyDescription();

        $this->assertEquals(3, count($data));
    }

    public function test_get_currency()
    {
        $currency = new Currency('PLN');

        $this->assertEquals("PLN", $currency->getValue());
    }

    public function test_get_currency_incorrect_type()
    {
        $this->expectException(CurrencyIncorrectTypeException::class);
        new Currency('ZŁ');
    }
}
