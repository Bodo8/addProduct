<?php
declare(strict_types = 1);

namespace Product\Application\Service\OpenHost;

use Illuminate\Contracts\Pagination\Paginator;
use Product\Application\Service\Dto\ProductDto;
use Product\Domain\Repository\PaginationRepositoryInterface;
use Product\Domain\Repository\ProductRepositoryInterface;
use Tests\TestCase;

/**
 * @author Bogusław Trojański
 */
class ProductServiceTest extends TestCase
{
    private $productRepository;
    private $productPageRepository;
    private $productService;

    public function setUp(): void {
        parent::setUp();

        $this->productRepository = $this->mockProductRepository();
        $this->productPageRepository = $this->mockPageRepository();
        $this->productService = new ProductService(
            $this->productRepository,
            $this->productPageRepository
        );
    }

    public function testGetPageProducts()
    {
        $page = $this->productService->getPageProducts(15);

        $this->assertInstanceOf(Paginator::class, $page);
    }

    public function testGetProductById()
    {
        $product = $this->productService->getProductById(1);

        $this->assertInstanceOf(ProductDto::class, $product);
    }

    private function mockPageRepository() : PaginationRepositoryInterface
    {
        $repository = $this->getMockBuilder(PaginationRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $repository;
    }

    private function mockProductRepository() : ProductRepositoryInterface
    {
        $repository = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $repository;
    }
}
