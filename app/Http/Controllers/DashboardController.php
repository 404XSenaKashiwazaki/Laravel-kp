<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Portofolio;
use App\Models\Product;
use App\Models\User;
class DashboardController extends Controller
{
 public function index()
    {
        return view('dashboard', [
            'totalUser' => User::count(),
            'totalProduk' => Product::count(),
            'totalPesanan' => Order::count(),
            'totalPembayaran' => Payment::count(),
            'totalKonten' => Cms::count(),
             'totalPortofolio' => Portofolio::count(),
        ]);
    }
}
