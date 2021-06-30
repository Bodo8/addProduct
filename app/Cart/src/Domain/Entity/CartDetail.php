<?php
declare(strict_types = 1);

namespace Cart\Domain\Entity;

use App\Exceptions\Domain\VatRateNotExistException;
use Illuminate\Database\Eloquent\Model;
use SharedKernel\Pricing\PricePermittedInterface;
use SharedKernel\ValueObject\Currency;
use SharedKernel\ValueObject\VatRates;

/**
 * @author Bogusław Trojański
 */
class CartDetail extends Model implements PricePermittedInterface
{
    private $idCart;
    private $currency;
    private $idProduct;
    private $idCartDetail;
    private $quantity;
    private $name;
    private $netto;
    private $vatRate;

    /**
     * constructor.
     */
    public function __construct(
        int $idCart,
        Currency $currency,
        int $idProduct,
        ?int $idCartDetail,
        int $quantity,
        string $name,
        ?int $netto,
        int $vatRates

    ) {
        if (!array_key_exists($vatRates, VatRates::getVatDescription())) {
            throw VatRateNotExistException::createFromRate($vatRates);
        }
        $this->idCart = $idCart;
        $this->currency = $currency;
        $this->idProduct = $idProduct;
        $this->quantity = $quantity;
        $this->name = $name;
        $this->netto = $netto;
        $this->vatRate = $vatRates;
        $this->idCartDetail = $idCartDetail;

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getIdCart(): int
    {
        return $this->idCart;
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
    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    /**
     * @return int|null
     */
    public function getIdCartDetail(): ?int
    {
        return $this->idCartDetail;
    }

    /**
     * @param int|null $idCartDetail
     */
    public function setIdCartDetail(int $idCartDetail): void
    {
        $this->idCartDetail = $idCartDetail;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
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
    public function getNetto(): int
    {
        return $this->netto;
    }

    /**
     * @return int
     */
    public function getVatRate(): int
    {
        return $this->vatRate;
    }

    public function updateQuantity(int $quantity): void
    {
        if ($quantity < 1) {
            $this->quantity = 1 ;
        } else {
            $this->quantity = $quantity;
        }
    }

    public function updateNetto(int $netto): void
    {
        if ($netto < 0) {
            $this->netto = 0 ;
        } else {
            $this->netto = $netto;
        }
    }

    public function setTotalNetto(int $totalNetto)
    {
        $this->netto = $totalNetto;
    }
}
