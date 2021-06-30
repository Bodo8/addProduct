<?php
declare(strict_types = 1);

namespace Cart\Infrastructure\Repository\InMemory;

use App\Exceptions\Domain\CartNotFoundException;
use Cart\Domain\Entity\Cart;
use Cart\Domain\Entity\CartDetail;
use Cart\Domain\Repository\CartRepositoryInterface;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class CartRepository implements CartRepositoryInterface
{
    private $repository = [];
    private $repositoryId = 0;

    /**
     * Pobranie jednego koszyka
     */
    public function getOne(int $idCart): Cart
    {
        if (isset($this->repository[$idCart])) {
            return $this->repository[$idCart];
        }

        throw CartNotFoundException::createFromId($idCart);
    }

    /**
     * Dodanie koszyka do repozytorium
     */
    public function add(Cart $cart): Cart
    {
        $this->repositoryId++;

        $created = new Cart(
            $this->repositoryId,
            new \DateTime('now'),
            new \DateTime('now'),
            $cart->getIdCustomer(),
            new Currency('PLN'),
            $cart->getTotalNetto(),
            $cart->getAverageBrutto(),
            $cart->getDetails()
        );

        $this->repository[$this->repositoryId] = $created;

       $details = $created->getDetails();

       foreach ($details as $detail) {
           $this->addDetail($detail);
       }
        return $created;
    }

    /**
     * Usunięcie koszyka z repozytorium
     */
    public function remove(Cart $cart): void
    {
        if (isset($this->repository[$cart->getId()])) {
            unset($this->repository[$cart->getId()]);
        } else {
            throw CartNotFoundException::createFromId($cart->getId());
        }
    }

    /**
     * Aktualizacja istniejącego koszyka
     */
    public function update(Cart $cart): void
    {
        if (isset($this->repository[$cart->getId()])) {
            $this->repository[$cart->getId()] = $cart;
        } else {
            throw CartNotFoundException::createFromId($cart->getId());
        }
    }

    /**
     * Dodanie elementu do koszyka
     */
    public function addDetail(CartDetail $cartDetailDetail): bool
    {
        $cart = $this->repository[$cartDetailDetail->getIdCart()];
        $this->repositoryId++;
        $cartDetailDetail->setIdCartDetail($this->repositoryId);
        return $cart->addDetail($cartDetailDetail);
    }

    /**
     * Aktualizacja elementu w koszyku
     */
    public function updateDetail(CartDetail $cartDetail): void
    {
        $cart = $this->repository[$cartDetail->getIdCart()];
        $cart->updateDetail($cartDetail);
    }

    /**
     * Usunięcie elementu z koszyka
     */
    public function removeDetail(CartDetail $cartDetail): void
    {
        /** @var Cart $cart */
        $cart = $this->repository[$cartDetail->getIdCart()];
        $details = $cart->getDetails();

        $result = array_search($cartDetail, $details, true);
        if($result !== false) {
            unset($details[$result]);
        }

        $cart->removeDetails();
        $cart->addDetails($details);
    }
}