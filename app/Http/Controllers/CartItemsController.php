<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemsRequest;
use App\Models\CartItems;
use App\Repositories\Interfaces\CartItemsRepositoryInterface;
use Illuminate\Http\Request;

class CartItemsController extends Controller
{
    protected $cartItemsRepository;
    public function __construct(CartItemsRepositoryInterface $cartItemsRepository)
    {
        $this->cartItemsRepository = $cartItemsRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('userend.cart-items');
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
    public function store(CartItemsRequest $request)
    {
        $this->cartItemsRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItems $cartItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItems $cartItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItems $cartItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItems $cartItems)
    {
        //
    }
}
