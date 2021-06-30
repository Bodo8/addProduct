<?php
declare(strict_types = 1);
namespace Product\Infrastructure\Repository\InEloquent;

use App\Exceptions\Domain\ProductNotFoundException;
use PHPUnit\Framework\TestCase;
use Product\Domain\Entity\Product;
use Tests\Unit\Product\MotherObject\ProductMother;

/**
 * @author Bogusław Trojański
 */
class ProductRepositoryTest //extends TestCase
{

    //TODO: run the second database for testing.

//    /** @var ProductRepository */
//    private $productRepository;
//
//    /** @var Product */
//    private $product;
//
//    protected function setUp()
//    {
//        parent::setUp();
//        $this->productRepository = new ProductRepository();
//        $this->product = ProductMother::getOne();
//    }

//    public function testGetOne()
//    {
//        $this->productRepository->add($this->product);
//        $product = $this->productRepository->getOne(1);
//        $this->assertEquals('product example', $product->getName());
//        $this->assertEquals(5, $product->getPrice());
//    }
//
//    public function test_add()
//    {
//        $this->productRepository->add($this->product);
//        $this->assertEquals('product example', $this->product->getName());
//        $this->assertEquals(5, $this->product->getPrice());
//    }
//
//    public function test_remove()
//    {
//        $createdProduct = $this->productRepository->add($this->product);
//        $product = $this->productRepository->getOne($createdProduct->getId());
//
//        $this->assertEquals(1, $product->getId());
//        $this->productRepository->remove($product);
//
//        $this->expectException(ProductNotFoundException::class);
//        $this->productRepository->getOne($createdProduct->getId());
//    }
//
//    public function test_get_page()
//    {
//        $products = ProductMother::getProducts();
//
//        foreach ($products as $product) {
//            $this->productRepository->add($product);
//        }
//
//        $expectedAmount = 3;
//        $page = $this->productRepository->getPage($expectedAmount);
//
//        $this->assertEquals($expectedAmount, count($page->items()));
//    }
//
//    public function test_update()
//    {
//        $createdProduct = $this->productRepository->add($this->product);
//
//        $updateProduct = new Product(
//            $createdProduct->getId(),
//            'update name',
//            $createdProduct->getPrice(),
//            $createdProduct->getCurrency()
//        );
//
//        $this->productRepository->update($updateProduct);
//        $product = $this->productRepository->getOne($updateProduct->getId());
//
//        $this->assertEquals('update name', $product->getName());
//    }
}
