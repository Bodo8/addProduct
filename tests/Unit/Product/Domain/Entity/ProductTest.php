<?php
declare(strict_types = 1);

namespace Product\Domain\Entity;

use SharedKernel\ValueObject\Currency;
use Tests\Unit\Product\MotherObject\ProductMother;

/**
 * @author Bogusław Trojański
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_price()
    {
        $product = ProductMother::getOne();

        $this->assertEquals(5, $product->getPrice());
    }

    public function test_get_name()
    {
        $product = ProductMother::getOne();

        $this->assertEquals('product example', $product->getName());
    }

    public function test_get_currency()
    {
        $product = ProductMother::getOne();

        $this->assertEquals(new Currency('USD'), $product->getCurrency());
    }
}
