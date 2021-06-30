<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Product\Application\Service\ProductWebService;

/**
 * @author Bogusław Trojański
 */
class ProductController extends Controller
{
    private $productService;

    /**
     *  constructor.
     */
    public function __construct(ProductWebService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the product.
     */
    public function index()
    {
        $maxSizePage = 20;
        $products =  $this->productService->getPage($maxSizePage)->items();

        return view('list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->productService->saveProduct(
                $request->get('name'),
                $request->get('price'),
                $request->get('currency')
            );

        return redirect('/product/create');
    }


    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $productDao = $this->productService->getOneProduct($id);
        $products = [];
        array_push($products, $productDao);
        return view('edit', compact('products','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->productService->updateProduct(
            $id,
            $request->get('name'),
            $request->get('price'),
            $request->get('currency')
        );

        return redirect('/list');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy($id)
    {
        $this->productService->removeProduct($id);

        return redirect('/list');
    }
}
