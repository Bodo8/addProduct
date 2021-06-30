<?php

namespace SharedKernel\Pricing\Calculations;


use Tests\MotherObject\Cart\CartDetailMother;

class ProductPriceTest extends \PHPUnit_Framework_TestCase
{

    public function test_calculate_product()
    {
        $cartDetail = CartDetailMother::get_one(1);
        $productPrice = new ProductPrice($cartDetail);

        $this->assertEquals(1000, $productPrice->getNetto());
        $this->assertEquals(230, $productPrice->getVatValue());
        $this->assertEquals(1230, $productPrice->getBrutto());
    }
}
