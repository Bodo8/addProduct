<?php
declare(strict_types = 1);

namespace Cart\Application\Service\Product;

use Cart\Application\Service\Product\Dto\ProductDto;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * @author Bogusław Trojański
 */
interface ProductServiceInterface
{
    public function getPageProducts(int $number): Paginator;

    public function getProductById(int $idProduct): ProductDto;
}
