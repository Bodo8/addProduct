<?php
declare(strict_types = 1);

namespace SharedKernel\ValueObject;

/**
 * @author Bogusław Trojański
 */
class Currency
{
    const PLN = "PLN";
    const EUR = "EUR";
    const USD = "USD";

    private $currency;

    /**
     * constructor.
     */
    public function __construct(string $currency)
    {
        if (!in_array($currency, array_keys(self::getCurrencyDescription()))) {
            throw CurrencyIncorrectTypeException::createFromType($currency);
        }

        $this->currency = $currency;
    }

    /**
     * @return array
     */
    public static function getCurrencyDescription(): array
    {

        return [
            self::PLN    => ('PLN'),
            self::EUR    => ('EUR'),
            self::USD    => ('USD')
    ];
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->currency;
    }
}