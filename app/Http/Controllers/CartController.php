<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemsRequest;
use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

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
    public function index(string $userId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $cartItems = $this->cartRepository->showCartItems($userId);
        $totalAmount = $cartItems->sum('amount');
        return view('userend.cart-items', compact('cartItems', 'totalAmount'));
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
    public function update(CartItemsRequest $request)
    {
        if ($this->cartRepository->updateQuantity($request->all())){
            return redirect()->back()->with('message', 'Quantity Updated.');
        }

        return redirect()->back()->with('message', 'Quantity Update Failed.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
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
