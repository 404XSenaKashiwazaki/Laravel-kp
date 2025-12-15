<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranCotroller extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
         $validated = $request->validate([
            'total'    => 'required|numeric|min:0',
            'note'     => 'nullable|string',
            "bank_id" => "required|string",
            'gambar'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('payment', $filename, 'public');
            $validated["gambar"] = $path;
        }

        Payment::create([
            'uuid'     => (string) Str::uuid(),
            'order_id' => $id,
            "bank_id" => $validated["bank_id"],
            'total'    => $validated['total'],
            'note'     => $validated['note'] ?? null,
            'gambar'   => $validated['gambar'],
        ]);


        return redirect()
            ->route('pesanan.detail', $id)
            ->with('success', 'Pembayaran berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function create(string $id)
    {
         $query = Order::with(['user', 'items.product'])->where('id', $id)->first();
        
         $bank = Bank::all();
        return view("payment.form", ["order" => $query,"bank" => $bank]);
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
