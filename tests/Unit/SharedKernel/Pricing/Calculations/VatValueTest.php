<?php
declare(strict_types = 1);

namespace SharedKernel\Pricing\Calculations;

/**
 * @author Bogusław Trojański
 */
class VatValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_value_vat()
    {
        $vatValue = new VatCalculate(1000,  23, 1);

        $this->assertEquals(1000, $vatValue->getNetto());
        $this->assertEquals(230, $vatValue->getVatValue());
        $this->assertEquals(1230, $vatValue->getBrutto());
    }
}
