<?php
declare(strict_types = 1);

namespace Product\Domain\Repository;

use Product\Domain\Entity\Product;

/**
 * @author Bogusław Trojański
 */
interface ProductRepositoryInterface
{
    /**
     * Pobranie jednego produktu
     */
    public function getOne(int $idProduct) : Product;

    /**
     * Dodanie produktu do repozytorium
     */
    public function add(Product $product): Product;

    /**
     * Usunięcie produktu z repozytorium
     */
    public function remove(Product $product): void;

    /**
     * Aktualizacja istniejącego produktu
     */
    public function update(Product $product): void ;
}