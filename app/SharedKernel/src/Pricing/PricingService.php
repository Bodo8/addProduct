<?php
declare(strict_types = 1);

namespace SharedKernel\Pricing;

use App\SharedKernel\src\Pricing\Calculations\TotalCalculation;
use SharedKernel\Pricing\Calculations\ProductPrice;
use SharedKernel\Pricing\Calculations\VatCalculate;
use SharedKernel\ValueObject\VatRates;

/**
 * @author Bogusław Trojański
 */
class PricingService
{
    private $products = [];

    public function addProduct(PricePermittedInterface $detail): void
    {
        array_push($this->products, new ProductPrice($detail));
    }

    private function getSummaryByVatRates(): array
    {
        $summaryByVatRates = $this->getEmptyVatRates();

        /** @var PricePermittedInterface $product */
        foreach ($this->products as $product) {
            $quantity = $product->getQuantity();
            $vatCalculation = new VatCalculate($product->getNetto(), $product->getVatRate(), $quantity);
            $summaryByVatRates[$product->getVatRate()]['netto'] += ($vatCalculation->getNetto() * $quantity);
            $summaryByVatRates[$product->getVatRate()]['vat']   += ($vatCalculation->getVatValue() * $quantity);
            $summaryByVatRates[$product->getVatRate()]['quantity'] += $quantity;
        }

        $result = [];

        foreach ($summaryByVatRates as $vatRate => $sum) {
            $result[$vatRate] = new VatCalculate(
                $sum['netto'],
                $vatRate,
                $sum['quantity']
            );
        }

        return $result;
    }

    public function getTotalCalculation(): TotalCalculation
    {
        $summaryByVatRates = $this->getSummaryByVatRates();
        $totalVat = 0;
        $totalNetto = 0;
        $totalBrutto = 0;
        $totalQuantity = 0;
        $averagePrice = 0;

        /** @var VatCalculate $summary */
        foreach ($summaryByVatRates as $summary) {

            $totalVat += $summary->getVatValue();
            $totalNetto += $summary->getNetto();
            $totalBrutto += $summary->getBrutto();
            $totalQuantity += $summary->getQuantity();
        }

        if ($totalQuantity !== 0) {
            $averagePrice = (int)round($totalBrutto / $totalQuantity);
        }

        return new TotalCalculation($totalNetto, $totalVat, $totalBrutto, $averagePrice);
    }

    private function getEmptyVatRates(): array
    {
        $vatRates = VatRates::getVatDescription();
        $summaryByVatRates = [];

        foreach (array_keys($vatRates) as $rate) {
            $summaryByVatRates[$rate]['netto'] = 0;
            $summaryByVatRates[$rate]['vat'] = 0;
            $summaryByVatRates[$rate]['quantity'] = 0;
        }

        return $summaryByVatRates;
    }
}
