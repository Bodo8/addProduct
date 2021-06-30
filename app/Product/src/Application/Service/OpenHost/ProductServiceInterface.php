<?php
declare(strict_types = 1);

namespace Product\Application\Service\OpenHost;

use Illuminate\Contracts\Pagination\Paginator;
use Product\Application\Service\Dto\ProductDto;

/**
 * @author Bogusław Trojański
 */
interface ProductServiceInterface
{
    public function getPageProducts(int $number): Paginator;

    public function getProductById(int $idProduct): ProductDto;
}
