<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemsRequest;
use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartRepository;
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $userId)
    {
        $cartItems = $this->cartRepository->showCartItems($userId);
        return view('userend.cart-items', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemsRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($this->cartRepository->store($request->all())){
            return redirect()->back()->with('message', 'Product Added to Cart.');
        }
        return redirect()->back()->with('message', 'Product failed to add!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required'
        ]);
        if ($this->cartRepository->removeFromCart($validated['cart_id'])){
            return redirect()->back()->with('message', 'Removed from cart.');
        }
        return redirect()->back()->with('message', 'Could not remove.');
    }
}
