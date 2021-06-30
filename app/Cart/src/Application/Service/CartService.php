<?php
declare(strict_types = 1);

namespace App\Cart\src\Application\Service;

use App\SharedKernel\src\Pricing\Calculations\TotalCalculation;
use Cart\Application\Service\Dto\CartDto;
use Cart\Application\Service\Product\ProductServiceInterface;
use Cart\Domain\Entity\Cart;
use Cart\Domain\Entity\CartDetail;
use Cart\Domain\Repository\CartRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use SharedKernel\Pricing\PricingService;
use SharedKernel\ValueObject\Currency;

/**
 * @author Bogusław Trojański
 */
class CartService
{
    private $cartRepository;
    private $productService;

    /**
     * constructor.
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductServiceInterface $productService
    ) {
        $this->cartRepository = $cartRepository;
        $this->productService = $productService;
    }

    public function getOneCartById(int $idCart): CartDto
    {
        $cart = $this->cartRepository->getOne($idCart);

        return $this->objectToDto($cart);
    }

    public function addProductToCart(
        ?int $idCart,
        int $idCustomer,
        string $currency,
        int $idProduct,
        int $quantity,
        string $name,
        int $price,
        int $vatRates
    ): Cart {
        $cart = null;
        $details = [];

        if ($idCart == null) {
         $cart = $this->addCart($idCustomer, $currency, $details);
         $cartDetail = $this->createCartDetail($cart->getId(), $name, $idProduct, $price , $quantity, $currency ,$vatRates);

         $cart->addDetail($cartDetail);

     } else {
         $cartDto = $this->getOneCartById($idCart);
         $cart = $this->convertCartDtoToCart($cartDto);
         $cartDetail = $this->createCartDetail($cart->getId(), $name, $idProduct, $price , $quantity, $currency ,$vatRates);

         $cart->addDetail($cartDetail);
     }

     return $cart;
    }

    public function addCart(int $idCustomer, string $currency, array $details): Cart
    {
        $totalCalculations = $this->getTotalCalculations($details);

        $cart = new Cart(
          null,
          new \DateTime('now'),
            new \DateTime('now'),
            $idCustomer,
            new Currency($currency),
            $totalCalculations->getTotalNetto(),
            $totalCalculations->getAverageValue(),
            $details
        );

        return $this->cartRepository->add($cart);
    }

    public function getProducts(int $number): Paginator
    {
        return $this->productService->getPageProducts($number);
    }

    private function getTotalCalculations(array $details): TotalCalculation
    {
        $pricingService = new PricingService();

        foreach ($details as $detail) {
            $pricingService->addProduct($detail);
        }

        return $pricingService->getTotalCalculation();
    }

    private function objectToDto(Cart $cart): CartDto
    {
        return new CartDto(
            $cart->getId(),
            $cart->getIdCustomer(),
            $cart->getCurrency(),
            $cart->getTotalNetto(),
            $cart->getAverageBrutto(),
            $cart->getDetails()
        );
    }

    private function createCartDetail(
        int $idCart,
        string $name,
        int $idProduct,
        int $price,
        int $quantity,
        string $currency,
        int $vatRates
    ): CartDetail {
        $cartDetail = new CartDetail(
            $idCart,
            new Currency($currency),
            $idProduct,
            null,
            $quantity,
            $name,
            $price,
            $vatRates
        );
         $totalCalculation = $this->calculatePrice($cartDetail);
        $totalNetto = $totalCalculation->getTotalNetto();
        $cartDetail->setTotalNetto($totalNetto);

        return $cartDetail;
    }

    private function convertCartDtoToCart(CartDto $cartDto): Cart
    {
        return new Cart(
            $cartDto->getId(),
            new \DateTime('now'),
            new \DateTime('now'),
            $cartDto->getIdCustomer(),
            $cartDto->getCurrency(),
            $cartDto->getTotalNetto(),
            $cartDto->getAverageBrutto(),
            $cartDto->getDetails()
        );
    }

    public function getCarts(int $maxSizePage)
    {
        return $this->cartRepository->getPageCarts($maxSizePage);
    }

    private function calculatePrice(CartDetail $cartDetail): TotalCalculation
    {
        $pricingService = new PricingService();
        $pricingService->addProduct($cartDetail);

        return $pricingService->getTotalCalculation();
    }
}
