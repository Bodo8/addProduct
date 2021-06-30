<?php
declare(strict_types = 1);

namespace Cart\Infrastructure\Repository\InEloquent;

use App\Cart\src\Infrastructure\Repository\DAO\CartDetailDao;
use Cart\Domain\Entity\Cart;
use Cart\Domain\Entity\CartDetail;
use Cart\Domain\Repository\CartRepositoryInterface;
use Cart\Infrastructure\Repository\DAO\CartDao;

/**
 * @author Bogusław Trojański
 */
class CartRepository implements CartRepositoryInterface
{
    /**
     * Pobranie jednego koszyka
     */
    public function getOne(int $idCart): Cart
    {
        $cartDao = CartDao::findOrFail($idCart);
        $details = CartDao::find($idCart)->details()->getModels();
        $cart = $this->convertDaoToObject($cartDao, $details);

        return $cart;
    }

    /**
     * Dodanie koszyka do repozytorium
     */
    public function add(Cart $cart): Cart
    {
        $cartDao = new CartDao();
        $cartDao->id_customer = $cart->getIdCustomer();
        $cartDao->netto = $cart->getTotalNetto();
        $cartDao->currency = $cart->getCurrency()->getValue();
        $cartDao->average = $cart->getAverageBrutto();
        $cartDao->create_date = new \DateTime('now');
        $cartDao->update_date = new \DateTime('now');

        $cartDao->save();

        $insertedId = $cartDao->id_cart;
        $cart->setId($insertedId);

        $details = $cart->getDetails();

        /** @var CartDetail $detail */
        foreach ($details as $detail) {
            $this->addDetail($detail);
        }

        return $cart;
    }

    /**
     * Usunięcie koszyka z repozytorium
     */
    public function remove(Cart $cart): void
    {
        // TODO: Implement remove() method.
    }

    /**
     * Aktualizacja istniejącego koszyka
     */
    public function update(Cart $cart): void
    {
        // TODO: Implement update() method.
    }

    /**
     * Dodanie elementu do koszyka
     */
    public function addDetail(CartDetail $cartDetail): bool
    {
        $cart = $this->getOne($cartDetail->getIdCart());
        $cartDetailDao = new CartDetailDao();
        $cartDetailDao->name = $cartDetail->getName();
        $cartDetailDao->netto = $cartDetail->getNetto();
        $cartDetailDao->currency = $cartDetail->getCurrency()->getValue();
        $cartDetailDao->vat_rates = $cartDetail->getVatRate();

        $cartDetailDao->save();
        $insertedId = $cartDetail->id_cart_detail;
        /** @var CartDetail  $cartDetail*/
        $cartDetail->setIdCartDetail($insertedId);

        return $cart->addDetail($cartDetail);
    }

    /**
     * Aktualizacja elementu w koszyku
     */
    public function updateDetail(CartDetail $detail): void
    {
        // TODO: Implement updateDetail() method.
    }

    /**
     * Usunięcie elementu z koszyka
     */
    public function removeDetail(CartDetail $detail): void
    {
        // TODO: Implement removeDetail() method.
    }

    private function convertDaoToObject(\Illuminate\Database\Eloquent\Model $cartDao, array $details): Cart
    {
        return new Cart(
            $cartDao->id_cart,
            $cartDao->create_date,
            $cartDao->update_date,
            $cartDao->id_customer,
            $cartDao->currency,
            $cartDao->netto,
            $cartDao->average,
            $details
        );
    }
}
