<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCheckoutRequest;
use App\Repositories\Interfaces\CheckoutRepositoryInterface;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $checkoutRepository;
    public function __construct(CheckoutRepositoryInterface $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ProductCheckoutRequest $request)
    {
        $cheeckoutProducts = $this->checkoutRepository->getCheckoutProducts($request->all());
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
