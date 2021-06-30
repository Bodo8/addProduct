<?php
declare(strict_types = 1);

namespace App\SharedKernel\src\Pricing\Calculations;

/**
 * @author Bogusław Trojański
 */
class TotalCalculation
{
    private $totalNetto;
    private $totalVatValue;
    private $totalBrutto;
    private $averagePrice;

    /**
     * constructor.
     */
    public function __construct(int $netto, int $vatValue, int $brutto, int $averagePrice)
    {
        $this->totalNetto = $netto;
        $this->totalVatValue = $vatValue;
        $this->totalBrutto = $brutto;
        $this->averagePrice = $averagePrice;
    }

    public function getTotalNetto(): int
    {
        return $this->totalNetto;
    }

    public function getTotalVatValue(): int
    {
        return $this->totalVatValue;
    }

    public function getTotalBrutto(): int
    {
        return $this->totalBrutto;
    }

    public function getAverageValue(): int
    {
        return $this->averagePrice;
    }
}