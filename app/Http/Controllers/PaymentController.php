<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Payment::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $payments = $query->paginate(10);

        return view('payment.index', [
            'payments' => $payments,
        ]);
    }

    public function confirm(Order $order)
    {
        $order->update(["status" => "dikirim"]);
        return Redirect::route('payment.index')->with('success', 'Data berhasil di konfirmasi');
    }
    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('payment.detail',["payment" => $payment]);
    }
}
