<?php
declare(strict_types = 1);

namespace SharedKernel\Pricing\Calculations;

use JsonSerializable;
use SharedKernel\Pricing\PricePermittedInterface;

/**
 * @author Bogusław Trojański
 */
class ProductPrice implements JsonSerializable
{
    private $idProduct;
    private $detail;


    /**
     * constructor.
     */
    public function __construct(PricePermittedInterface $detail, $idProduct = null)
    {
        $this->idProduct = $idProduct;
        $this->detail = $detail;

    }

    public function getNetto(): int
    {
        return $this->detail->getNetto();
    }

    public function getVatValue(): int
    {
        return (int) round($this->getNetto() * ($this->getVatRate() / 100));
    }

    public function getBrutto(): int
    {
        return $this->getNetto() + $this->getVatValue();
    }

    public function getVatRate(): int
    {
        return $this->detail->getVatRate();
    }

    public function getQuantity(): int
    {
        return $this->detail->getQuantity();
    }

    public function jsonSerialize()
    {
        return [
            'netto'   => $this->getNetto(),
            'vatValue'   => $this->getVatValue(),
            'brutto'   => $this->getBrutto(),
            'quantity' => $this->getQuantity()
        ];
    }
}
