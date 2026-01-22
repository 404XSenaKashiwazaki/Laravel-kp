<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
  use Barryvdh\DomPDF\Facade\Pdf;
class CetakPdfController extends Controller
{


public function pdf($id)
{
    $order = Order::with('items', 'user')->findOrFail($id);

    $pdf = Pdf::loadView('orders.pdf', compact('order'))
              ->setPaper('A4', 'portrait');

    return $pdf->stream('Pesanan-'.$order->code.'.pdf');
}

}
