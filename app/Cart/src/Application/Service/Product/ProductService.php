<?php
declare(strict_types = 1);

namespace Cart\Application\Service\Product;

use Cart\Application\Service\Product\Dto\ProductDto;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * @author Bogusław Trojański
 */
class ProductService implements ProductServiceInterface
{
    private $productService;

    /**
     * constructor.
     */
    public function __construct(\Product\Application\Service\OpenHost\ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }


    public function getPageProducts(int $number): Paginator
    {
        return $this->productService->getPageProducts($number);
    }

    public function getProductById(int $idProduct): ProductDto
    {
        $product = $this->productService->getProductById($idProduct);

        return $this->convertToCartProduct($product);
    }

    private function convertToCartProduct(\Product\Application\Service\Dto\ProductDto $product): ProductDto
    {
        return new ProductDto(
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency()
        );
    }
}
