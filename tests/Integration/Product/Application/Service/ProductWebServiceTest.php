<?php
declare(strict_types = 1);

namespace Product\Application\Service;

use Product\Domain\Entity\Product;
use Product\Domain\Repository\PaginationRepositoryInterface;
use Product\Domain\Repository\ProductRepositoryInterface;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class ProductWebServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var ProductWebService $productWebService */
    private $productWebService;

    public function setUp()
    {
        Parent::__construct();
        $this->productWebService = new ProductWebService(
            $this->mockProductRepository(),
            $this->mockPaginationRepository());
    }

    public function testSaveProduct()
    {
        $product = $this->productWebService->saveProduct(
            'test product',
            200,
            Currency::PLN
        );

        $this->assertInstanceOf(Product::class, $product);
    }

    private function mockProductRepository() : ProductRepositoryInterface
    {
        $repository = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $repository;
    }

    private function mockPaginationRepository() : PaginationRepositoryInterface
    {
        $pagination = $this->getMockBuilder(PaginationRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $pagination;
    }
}
