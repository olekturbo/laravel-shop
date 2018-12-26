<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $id)
    {
        $product = Product::find($id);
        if($product) {
            $similar_products = Product::where('category_id', $product->category->id)->where('id', '!=', $id)->orderBy('created_at', 'desc')->take(4)->get();
            return view('product', compact('product', 'similar_products'));
        }

        return redirect()->route('welcome');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $price = $product->discount_price ?? $product->price;
        $quantity = $request->quantity ?? 0;
        $size = $request->size;
        $cart = new Cart($oldCart);
        $cart->add($product, $price, $quantity, $size);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.showCart')->with(['cart_status' => 'success', 'cart_message' => 'Produkt został pomyślnie dodany do koszyka.']);
    }

    public function updateCart(Request $request, $id, $size) {

        if(is_numeric($request->value)) {
            $product = Product::find($id);
            $oldCart = session()->has('cart') ? session()->get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->edit($product, $request->value, $size);
            $request->session()->put('cart', $cart);
            $products = $request->session()->get('cart');
            $totalPrice = $products->totalPrice;
            $totalQty = $products->totalQty;
            $price = $products->items[$id][$size]['price'];
            $qty = $products->items[$id][$size]['qty'];
            return response()->json([
                'totalPrice' => $totalPrice,
                'totalQty' => $totalQty,
                'price' => $price,
                'qty' => $qty,
                'id' => $id,
                'size' => $size,
            ]);
        }
        else {
            return response()->json(['error' => 'To nie jest prawidłowa liczba!'], 400);
        }
    }

    public function deleteFromCart(Request $request, $id, $size) {
        $product = Product::find($id);
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $size);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.showCart')->with(['cart_status' => 'delete', 'cart_message' => 'Produkt został pomyślnie usunięty z koszyka.']);
    }

    public function showCart(Request $request) {
        $products = $request->session()->get('cart');

        return view('cart', compact('products'));
    }

    public function order(Request $request) {
        $products = $request->session()->get('cart');

        // Validate
        foreach($products->items as $sizes) {
            foreach($sizes as $item) {
                if($item['qty'] > $item['item']->quantity) {
                    return back()->with('error', 'Próbowano zamówić większą ilość produktów, niż jest to możliwe!');
                }
            }
        }

        return view('order', compact('products'));
    }
}
