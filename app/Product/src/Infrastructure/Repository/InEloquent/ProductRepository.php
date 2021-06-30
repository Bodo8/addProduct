<?php
declare(strict_types = 1);

namespace Product\Infrastructure\Repository\InEloquent;

use Illuminate\Contracts\Pagination\Paginator;
use Product\Domain\Entity\Product;
use Product\Domain\Repository\PaginationRepositoryInterface;
use Product\Domain\Repository\ProductRepositoryInterface;
use Product\Infrastructure\Repository\DAO\ProductDAO;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class ProductRepository implements ProductRepositoryInterface, PaginationRepositoryInterface
{

    /**
     * Pobranie jednego produktu
     */
    public function getOne(int $idProduct): Product
    {
        $productDao =  ProductDAO::findOrFail($idProduct);
        $product = $this->convertDaoToObject($productDao);

        return $product;
    }

    /**
     * Dodanie produktu do repozytorium
     */
    public function add(Product $product): Product
    {
        $productDAO = new ProductDAO();
        $productDAO->name = $product->getName();
        $productDAO->price = $product->getPrice();
        $productDAO->currency = $product->getCurrency()->getValue();

        $productDAO->save();
        $insertedId = $productDAO->id_product;
        $product->setIdProduct($insertedId);

        return $product;
    }

    /**
     * Usunięcie produktu z repozytorium
     */
    public function remove(Product $product): void
    {
        $productDAO = ProductDAO::findOrFail($product->getId());
        $productDAO->delete();
    }

    /**
     * Aktualizacja istniejącego produktu
     */
    public function update(Product $product): void
    {
        $productDAO = ProductDAO::findOrFail($product->getId());
        $productDAO->name = $product->getName();
        $productDAO->price = $product->getPrice();
        $productDAO->currency = $product->getCurrency()->getValue();
        $productDAO->save();
    }

    /**
     * Pobranie paginacji produktu
     */
    public function getPage(int $number): Paginator
    {
        return ProductDAO::orderBy('id_product')->paginate($number);
    }

    private function convertDaoToObject(\Illuminate\Database\Eloquent\Model $productDao): Product
    {
        return new Product(
            $productDao->id_product,
            $productDao->name,
            $productDao->price,
            new Currency($productDao->currency)
        );
    }
}