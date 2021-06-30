<?php
declare(strict_types = 1);

namespace SharedKernel\ValueObject;

/**
 * @author Bogusław Trojański
 */
class VatRatesTest extends \PHPUnit_Framework_TestCase
{

    public function test_get_vat()
    {
        $vat = new VatRates(23);

        $this->assertEquals(23, $vat->getRate());
    }

    public function test_get_vat_description()
    {
        $data = VatRates::getVatDescription();

        $this->assertEquals(3, count($data));
    }

    public function test_get_vat_incorrect_value()
    {
        $this->expectException(VatIncorrectTypeException::class);
        new VatRates(6);
    }
}
