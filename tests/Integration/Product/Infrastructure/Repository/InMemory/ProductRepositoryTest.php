<?php
declare(strict_types = 1);
namespace Product\Infrastructure\Repository\InMemory;

use App\Exceptions\Domain\ProductNotFoundException;
use PHPUnit\Framework\TestCase;
use Product\Domain\Entity\Product;
use Tests\Unit\Product\MotherObject\ProductMother;

/**
 * @author Bogusław Trojański
 */
class ProductRepositoryTest extends TestCase
{
    /** @var ProductRepository */
    private $productInMemoryRepo;

    /** @var Product */
    private $product;

    protected function setUp()
    {
        $this->productInMemoryRepo = new ProductRepository();
        $this->product = ProductMother::getOne();
    }

    public function test_add_and_get_one()
    {
        $this->expectException(ProductNotFoundException::class);
        $this->productInMemoryRepo->getOne(1);

        $createdProduct = $this->productInMemoryRepo->add($this->product);
        $product = $this->productInMemoryRepo->getOne($createdProduct->getId());

        $this->assertEquals(1, $product->getId());
    }

    public function test_remove_product()
    {
        $createdProduct = $this->productInMemoryRepo->add($this->product);
        $product = $this->productInMemoryRepo->getOne($createdProduct->getId());

        $this->assertEquals(1, $product->getId());
        $this->productInMemoryRepo->remove($product);

        $this->expectException(ProductNotFoundException::class);
        $this->productInMemoryRepo->getOne($createdProduct->getId());
    }

    public function test_remove_bad_product()
    {
        $this->expectException(ProductNotFoundException::class);
        $this->productInMemoryRepo->remove($this->product);
    }

    public function test_update()
    {
        $createdProduct = $this->productInMemoryRepo->add($this->product);

        $updateProduct = new Product(
            $createdProduct->getId(),
            'update name',
            $createdProduct->getPrice(),
            $createdProduct->getCurrency()
        );

        $this->productInMemoryRepo->update($updateProduct);
        $product = $this->productInMemoryRepo->getOne($updateProduct->getId());

        $this->assertEquals('update name', $product->getName());
    }
}
