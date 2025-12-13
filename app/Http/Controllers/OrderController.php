<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

   public function show (Request $request) {

        $query = Order::with(['user', 'items.product']);

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
        return view("orders.index",["orders" => $orders]);
    }

     public function detail (Order $order) {
        return view("orders.detail",["order" => $order]);
    }

    public function index(Request $request)
    {
       $query = Order::with(['user', 'items.product']);

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


        return view("orders.index",["orders" => $orders]);
    }

}
