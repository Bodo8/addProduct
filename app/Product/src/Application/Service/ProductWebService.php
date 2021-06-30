<?php


namespace Product\Application\Service;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Product\Domain\Entity\Product;
use Product\Domain\Repository\PaginationRepositoryInterface;
use Product\Domain\Repository\ProductRepositoryInterface;
use Product\Infrastructure\Repository\DAO\ProductDAO;
use SharedKernel\ValueObject\Currency;

class ProductWebService
{
    private $productRepository;
    private $paginationRepository;

    /**
     * constructor.
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        PaginationRepositoryInterface $paginationRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->paginationRepository = $paginationRepository;
    }

    public function getOneProduct(int $idProduct): ProductDAO
    {
        $product = $this->productRepository->getOne($idProduct);
        $productDao = $this->convertToDao($product);

        return $productDao;
    }

    public function saveProduct(string $name, int $price, string $currency): Product
    {
        $product = $this->setDataProduct($name, $price, $currency);
        return $this->productRepository->add($product);
    }

    public function removeProduct(int $idProduct): void
    {
        $product = $this->productRepository->getOne($idProduct);
        $this->productRepository->remove($product);
    }

    public function getPage(int $number): Paginator
    {
        return $this->paginationRepository->getPage($number);
    }

    public function updateProduct(int $idProduct, string $name, int $price, string $currency): void
    {
        $product = $this->setDataProduct($name, $price, $currency, $idProduct);
        $this->productRepository->update($product);
    }

    private function setDataProduct(string $name, int $price, string $currency, int $idProduct = null): Product
    {
        return new Product(
          $idProduct,
          $name,
          $price,
          new Currency($currency)
        );
    }

    private function convertToDao(Product $product): ProductDAO
    {
        $productDAO = new ProductDAO();
        $productDAO->name = $product->getName();
        $productDAO->price = $product->getPrice();
        $productDAO->currency = $product->getCurrency()->getValue();

        return $productDAO;
    }
}