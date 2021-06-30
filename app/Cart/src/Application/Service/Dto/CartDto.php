<?php
declare(strict_types = 1);

namespace Cart\Application\Service\Dto;

use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class CartDto
{
    private $idCart;
    private $idCustomer;
    private $totalNetto;
    private $details;
    private $currency;
    private $averageBrutto;

    /**
     * constructor.
     */
    public function __construct(
        ?int $idCart,
        int $idCustomer,
        Currency $currency,
        int $totalNetto,
        int $averageBrutto,
        array $details

    ) {
        $this->idCart = $idCart;
        $this->idCustomer = $idCustomer;
        $this->totalNetto = $totalNetto;
        $this->details = $details;
        $this->currency = $currency;
        $this->averageBrutto = $averageBrutto;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->idCart;
    }

    /**
     * @return int
     */
    public function getIdCustomer(): int
    {
        return $this->idCustomer;
    }

    /**
     * @return int
     */
    public function getTotalNetto(): int
    {
        return $this->totalNetto;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getAverageBrutto(): int
    {
        return $this->averageBrutto;
    }
}
