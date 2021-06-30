<?php
declare(strict_types = 1);

namespace Product\Application\Service\OpenHost;

use Illuminate\Contracts\Pagination\Paginator;
use Product\Application\Service\Dto\ProductDto;
use Product\Domain\Entity\Product;
use Product\Domain\Repository\PaginationRepositoryInterface;
use Product\Domain\Repository\ProductRepositoryInterface;

/**
 * @author Bogusław Trojański
 */
class ProductService implements ProductServiceInterface
{
    private $productRepository;
    private $productPaginationRepo;

    /**
     * constructor.
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        PaginationRepositoryInterface $productPaginationRepo)
    {
        $this->productRepository = $productRepository;
        $this->productPaginationRepo = $productPaginationRepo;
    }


    public function getPageProducts(int $number): Paginator
    {
        return $this->productPaginationRepo->getPage($number);
    }

    public function getProductById(int $idProduct): ProductDto
    {
        $product = $this->productRepository->getOne($idProduct);

        return $this->convertProductToDto($product);
    }

    private function convertProductToDto(Product $product): ProductDto
    {
        return new ProductDto(
          $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency()
        );
    }
}
