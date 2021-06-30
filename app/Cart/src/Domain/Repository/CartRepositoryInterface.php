<?php
declare(strict_types = 1);

namespace Cart\Domain\Repository;

use Cart\Domain\Entity\Cart;
use Cart\Domain\Entity\CartDetail;

/**
 * @author Bogusław Trojański
 */interface CartRepositoryInterface
{
    /**
     * Pobranie jednego koszyka
     */
    public function getOne(int $idCart) : Cart;

    /**
     * Dodanie koszyka do repozytorium
     */
    public function add(Cart $cart): Cart;

    /**
     * Usunięcie koszyka z repozytorium
     */
    public function remove(Cart $cart): void;

    /**
     * Aktualizacja istniejącego koszyka
     */
    public function update(Cart $cart): void ;

    /**
     * Dodanie elementu do koszyka
     */
    public function addDetail(CartDetail $cartDetail): bool;

    /**
     * Aktualizacja elementu w koszyku
     */
    public function updateDetail(CartDetail $detail): void;

    /**
     * Usunięcie elementu z koszyka
     */
    public function removeDetail(CartDetail $detail): void;
}