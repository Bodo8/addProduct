<?php
declare(strict_types = 1);

namespace Cart\Infrastructure\Repository\InMemory;

use App\Exceptions\Domain\CartNotFoundException;
use Cart\Domain\Entity\Cart;
use Cart\Domain\Entity\CartDetail;
use SharedKernel\ValueObject\Currency;
use Tests\MotherObject\Cart\CartDetailMother;
use Tests\MotherObject\Cart\CartMother;

/**
 * @author Bogusław Trojański
 */
class CartRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var CartRepository */
    private $cartInMemoryRepo;

    /** @var Cart */
    private $cart;

    protected function setUp()
    {
        $this->cartInMemoryRepo = new CartRepository();
        $this->cart = CartMother::getOne(1);
    }

    public function test_update_detail()
    {
        $cart = $this->cartInMemoryRepo->add($this->cart);
        $details = CartDetailMother::get_cart_details();
        $cart->addDetails($details);
        $expectQuantity = 5;
        $updateDetail = CartDetailMother::get_update_detail($expectQuantity);
        $this->cartInMemoryRepo->updateDetail($updateDetail);
        $cartAfterUpdate = $this->cartInMemoryRepo->getOne($cart->getId());
        $detailsAfterUpdate = $cartAfterUpdate->getDetails();

        /** @var CartDetail $detail */
        $detail = $detailsAfterUpdate[2];
        $this->assertEquals($expectQuantity, $detail->getQuantity());
    }

    public function test_update_cart()
    {
        $createdProduct = $this->cartInMemoryRepo->add($this->cart);
        $updateNetto = 2500;
        $updateCart = new Cart(
            $createdProduct->getId(),
            $createdProduct->getCreateDate(),
            new \DateTime('now'),
            $createdProduct->getIdCustomer(),
            $createdProduct->getCurrency(),
            $updateNetto,
            75,
            []
        );
        $this->cartInMemoryRepo->update($updateCart);
        $cart = $this->cartInMemoryRepo->getOne($updateCart->getId());

        $this->assertEquals($updateNetto, $cart->getTotalNetto());
    }


    public function test_remove_detail()
    {
        $cart = $this->cartInMemoryRepo->add($this->cart);
        $details = CartDetailMother::get_cart_details();
        $expectSize = (count($details) - 1);
        $cart->addDetails($details);
        $detail = $details[1];
        $this->cartInMemoryRepo->removeDetail($detail);
        $cartAfterRemove = $this->cartInMemoryRepo->getOne($cart->getId());
        $detailsAfterRemove = $cartAfterRemove->getDetails();

        $this->assertEquals($expectSize, count($detailsAfterRemove));
    }

    public function test_add_get_one()
    {
        $this->expectException(CartNotFoundException::class);
        $this->cartInMemoryRepo->getOne(1);

        $cart = CartMother::getCartWithDetails(1);
        $createdCart = $this->cartInMemoryRepo->add($cart);
        $cart = $this->cartInMemoryRepo->getOne($createdCart->getId());
        $this->assertEquals(1, $cart->getId());
    }

    public function test_remove_cart()
    {
        $createdCart = $this->cartInMemoryRepo->add($this->cart);
        $cart = $this->cartInMemoryRepo->getOne($createdCart->getId());
        $this->assertEquals(1, $cart->getId());

        $this->cartInMemoryRepo->remove($cart);
        $this->expectException(CartNotFoundException::class);
        $this->cartInMemoryRepo->getOne($cart->getId());
    }

    public function test_add_detail()
    {
        $cart = $this->cartInMemoryRepo->add($this->cart);
        $details = CartDetailMother::get_cart_details();
        $cart->addDetails($details);
        $expectSize = (count($details) + 1);
        $detail = CartDetailMother::get_one(1);
        $this->cartInMemoryRepo->addDetail($detail);
        $cartExtended = $this->cartInMemoryRepo->getOne($cart->getId());
        $detailsExtended = $cartExtended->getDetails();

        $this->assertEquals($expectSize, count($detailsExtended));
    }

    public function test_remove_bad_cart()
    {
        $this->expectException(CartNotFoundException::class);
        $this->cartInMemoryRepo->remove($this->cart);
    }

    public function test_update_bad_cart()
    {
        $updateCart = new Cart(
            8,
            new \DateTime('now'),
            new \DateTime('now'),
            1,
            new Currency(Currency::PLN),
            1000,
            75,
            []
        );

        $this->expectException(CartNotFoundException::class);
        $this->cartInMemoryRepo->update($updateCart);
    }
}
