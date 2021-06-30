<?php
declare(strict_types = 1);

namespace SharedKernel\Pricing\Calculations;


/**
 * @author Bogusław Trojański
 */
class VatCalculate
{
    private $netto;
    private $vatRates;
    private $vatValue;
    private $quantity;

    /**
     * constructor.
     */
    public function __construct(int $netto, int $vatRates, int $quantity)
    {
        $this->netto = $netto;
        $this->vatRates = $vatRates;
        $this->quantity = $quantity;
    }

    public function getNetto(): int
    {
       return $this->netto;
    }

    public function getVatValue(): int
    {
        $result =  (int) round($this->netto * (($this->vatRates) / 100));
        $this->setVatValue($result);

        return $result;
    }

    public function getBrutto(): int
    {
        return $this->netto + $this->getVatValue();
    }

    public function setVatValue(int $vatValue): void
    {
        $this->vatValue = $vatValue;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}