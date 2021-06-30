<?php

namespace App\Http\Controllers;

use App\Cart\src\Application\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;

    /**
     * constructor.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the cart.
     */
    public function index()
    {
        $maxSizePage = 20;
        $carts =  $this->cartService->getCarts($maxSizePage)->items();

        return view('list2', compact('carts'));
    }

    /**
     * Show the form for editing the specified cart.
     */
    public function edit($id)
    {
        $cartDto = $this->cartService->getOneCartById($id);
        $carts = [];
        array_push($carts, $cartDto);
        return view('cart/edit', compact('carts','id'));
    }

}
