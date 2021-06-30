<?php
declare(strict_types = 1);

namespace Cart\Application\Service\Product\Dto;

use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class ProductDto
{
    private $idProduct;
    private $name;
    private $price;
    private $currency;

    /**
     * constructor.
     */
    public function __construct(?int $idProduct, string $name, int $price, Currency $currency)
    {
        $this->idProduct = $idProduct;
        $this->name = $name;
        $this->price = $price;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->idProduct;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}