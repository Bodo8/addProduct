<?php
declare(strict_types = 1);

namespace SharedKernel\Pricing;

use SharedKernel\Pricing\Calculations\ProductPrice;
use Tests\MotherObject\Cart\CartDetailMother;
use Tests\TestCase;

/**
 * @author Bogusław Trojański
 */
class PricingServiceTest extends TestCase
{
    /** @var PricingService $pricingService */
    private $pricingService;

    protected function setUp()
    {
        $this->pricingService = new PricingService();
    }

    public function test_add_product()
    {
        $cartDetail = CartDetailMother::get_one(1);

        $this->pricingService->addProduct($cartDetail);
        $productPrice = new ProductPrice($cartDetail);

        $this->assertEquals(1000, $productPrice->getNetto());
        $this->assertEquals(230, $productPrice->getVatValue());
        $this->assertEquals(1230, $productPrice->getBrutto());
        $this->assertEquals(1,$productPrice->getQuantity());
    }

    public function test_get_total_calculation()
    {
        $details = [];
        for ($i = 1; $i < 4; $i++) {
            array_push($details,  CartDetailMother::get_one($i));
        }

        foreach ($details as $detail) {
            $this->pricingService->addProduct($detail);
        }

        $totalCalculation = $this->pricingService->getTotalCalculation();

        $this->assertEquals(3000, $totalCalculation->getTotalNetto());
        $this->assertEquals(690, $totalCalculation->getTotalVatValue());
        $this->assertEquals(3690, $totalCalculation->getTotalBrutto());
        $this->assertEquals(1230, $totalCalculation->getAverageValue());
    }

    public function test_get_total_calculation_with_different_vat_rate()
    {
        $details = CartDetailMother::get_cart_details();

        foreach ($details as $detail) {
            $this->pricingService->addProduct($detail);
        }

        $totalCalculation = $this->pricingService->getTotalCalculation();

        $this->assertEquals(5000, $totalCalculation->getTotalNetto());
        $this->assertEquals(390, $totalCalculation->getTotalVatValue());
        $this->assertEquals(5390, $totalCalculation->getTotalBrutto());
        $this->assertEquals(1078, $totalCalculation->getAverageValue());
    }

    public function test_get_total_calculation_with_empty_details()
    {
        $details = [];

        foreach ($details as $detail) {
            $this->pricingService->addProduct($detail);
        }

        $totalCalculation = $this->pricingService->getTotalCalculation();

        $this->assertEquals(0, $totalCalculation->getTotalNetto());
        $this->assertEquals(0, $totalCalculation->getTotalVatValue());
        $this->assertEquals(0, $totalCalculation->getTotalBrutto());
        $this->assertEquals(0, $totalCalculation->getAverageValue());
    }
}
