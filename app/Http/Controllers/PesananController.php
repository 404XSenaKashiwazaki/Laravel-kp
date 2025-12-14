<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {


        $query = Order::with(['user', 'items.product',"payment"])->where('user_id', $id)->latest();

        if ($request->search) {
            $search = '%' . $request->search . '%';

            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('name', 'like', $search);
                })->orWhereHas('items.product', function ($q3) use ($search) {
                    $q3->where('name', 'like', $search);
                });
            });
        }

        $orders = $query->paginate(10);

        return view("orders.user",["orders" => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($id)
    {

        $order = Order::with(['user', 'items.product'])->find($id);
        return view("orders.show",["order" => $order]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function finish(Request $request, Order $order)
    {
        $order->update(["status" => "selesai"]);
         return redirect()
            ->route('pesanan.detail', $order->id)
            ->with('success', 'Pesanan selesai');
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
    public function destroy(Order $order)
    {

    }
}
