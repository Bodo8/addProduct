<?php
declare(strict_types = 1);

namespace Product\Infrastructure\Repository\InMemory;

use App\Exceptions\Domain\ProductNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Product\Domain\Entity\Product;
use Product\Domain\Repository\ProductRepositoryInterface;

/**
 * @author Bogusław Trojański
 */
class ProductRepository implements ProductRepositoryInterface
{
    private $repository = [];
    private $repositoryId = 0;

    /**
     * Pobranie jednego produktu
     */
    public function getOne(int $idProduct): Product
    {
        if (isset($this->repository[$idProduct])) {
            return $this->repository[$idProduct];
        }

        throw ProductNotFoundException::createFromId($idProduct);
    }

    /**
     * Dodanie produktu do repozytorium
     */
    public function add(Product $product): Product
    {
        $this->repositoryId++;

        $created = new Product(
            $this->repositoryId,
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency()
        );

        $this->repository[$this->repositoryId] = $created;
        return $created;
    }

    /**
     * Usunięcie produktu z repozytorium
     */
    public function remove(Product $product): void
    {
        if (isset($this->repository[$product->getId()])) {
            unset($this->repository[$product->getId()]);
        } else {
            throw ProductNotFoundException::createFromId($product->getId());
        }
    }

    /**
     * Aktualizacja istniejącego produktu
     */
    public function update(Product $product): void
    {
        if (isset($this->repository[$product->getId()])) {
            $this->repository[$product->getId()] = $product;
        } else {
            throw ProductNotFoundException::createFromId($product->getId());
        }
    }
}