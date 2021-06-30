<?php
declare(strict_types = 1);

namespace Cart\Domain\Entity;

use App\Exceptions\Domain\CartDetailNotFoundException;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class Cart
{
    private $idCart;
    private $idCustomer;
    private $totalNetto;
    private $createDate;
    private $updateDate;
    private $details;
    private $currency;
    private $averageBrutto;

    /**
     * constructor.
     */
    public function
    __construct(
        ?int $idCart,
        \DateTime $createDate,
        \DateTime $updateDate,
        int $idCustomer,
        Currency $currency,
        int $totalNetto,
        int $averageBrutto,
        array $details

    ) {
        $this->idCart = $idCart;
        $this->idCustomer = $idCustomer;
        $this->totalNetto = $totalNetto;
        $this->createDate = $createDate;
        $this->updateDate = $updateDate;
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
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
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

    public function getDetail(int $detailId): CartDetail
    {
        foreach ($this->getDetails() as $detail) {
            if ($detail->getId() === $detailId) {
                return $detail;
            }
        }
        throw CartDetailNotFoundException::createFromId($detailId);
    }

    public function addDetails(array $details): bool
    {
        foreach ($details as $detail) {
            if ($this->addDetail($detail)) {
                continue;
            } else {
                return false;
            }
        }

        return true;
    }

    public function addDetail(CartDetail $newDetail): bool
    {
        if ($this->currency->getValue() === $newDetail->getCurrency()->getValue()) {

        /** @var CartDetail $detail */
        foreach ($this->details as $detail) {
                if ($detail->getIdProduct() === $newDetail->getIdProduct()) {
                    $detail->updateQuantity($detail->getQuantity() + $newDetail->getQuantity());
                    $detail->updateNetto($newDetail->getNetto());
                    return true;
                }
            }
            array_push($this->details, $newDetail);
            return true;
        }

        return false;
    }

    public function updateDetail(CartDetail $newDetail): bool
    {
        if ($this->currency->getValue() === $newDetail->getCurrency()->getValue()) {

            /** @var CartDetail $detail */
            foreach ($this->details as $detail) {
                if ($detail->getIdProduct() === $newDetail->getIdProduct()) {
                    $detail->updateQuantity($newDetail->getQuantity());
                    $detail->updateNetto($newDetail->getNetto());
                    return true;
                }
            }
            array_push($this->details, $newDetail);
            return true;
        }

        return false;
    }

    public function removeDetails()
    {
        $this->details = [];
    }

    public function setId(int $insertedId): void
    {
        if ($this->getId() === null) {
            $this->idCart = $insertedId;
        }
    }
}
