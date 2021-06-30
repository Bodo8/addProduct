<?php
declare(strict_types = 1);

namespace SharedKernel\ValueObject;

/**
 * @author Bogusław Trojański
 */
class VatRates
{
    const VAT_23 = 23;
    const VAT_8 = 8;
    const VAT_ZERO = 0;

    private $vat;

    /**
     * constructor.
     */
    public function __construct(int $vat)
    {
        if (!in_array($vat, array_keys(self::getVatDescription()))) {
            throw VatIncorrectTypeException::createFromType($vat);
        }

        $this->vat = $vat;
    }

    /**
     * @return array
     */
    public static function getVatDescription(): array
    {
        return [
            self::VAT_23    => 23,
            self::VAT_8     => 8,
            self::VAT_ZERO  => 0
        ];
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->vat;
    }
}