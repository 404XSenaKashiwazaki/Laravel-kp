<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function checkout(Request $request)
{

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')
            ->with('error', 'Cart is empty');
    }

    // Hitung total
    $totalAmount   = 0;
    $totalQuantity = 0;

    foreach ($cart as $item) {
        $subtotal      = $item['price'] * $item['quantity'];
        $totalAmount  += $subtotal;
        $totalQuantity += $item['quantity'];
    }

    // Buat order
    $order = Order::create([
        'user_id'        => Auth::id(),
        'code'           => 'ORD-' . strtoupper(Str::random(8)),
        'total_quantity' => $totalQuantity,
        'total_amount'   => $totalAmount,
        'status'         => 'pending',
        'note'           => $request->note ?? null,
    ]);

    // Simpan items
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $item['id'],
            'product_name' => $item['name'],
            'price'        => $item['price'],
            'quantity'     => $item['quantity'],
            'subtotal'     => $item['price'] * $item['quantity'],
        ]);
    }

    // Kosongkan cart
    session()->forget('cart');
$userId = Auth::id();
    return redirect()->route('pesanan.index', $userId)
        ->with('success', 'Order created successfully!');
}

    /**
     * Store a newly created resource in storage.
     */
    public function add($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($product->stok < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {

            // Cek stok tersisa
            if ($cart[$id]['quantity'] + 1 > $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }

            $cart[$id]['quantity'] += 1;

        } else {

            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->harga,
                'quantity' => 1,
            ];
        }

        // Kurangi stok di database
        $product->stok -= 1;
        $product->save();

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }



    public function cart()
    {

        return view('carts.show', ["cart" => session()->get('cart', [])]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak valid.');
        }

        $oldQty = $cart[$id]['quantity'];
        $newQty = max(1, (int) $request->quantity);


        if ($newQty > $oldQty) {
            $diff = $newQty - $oldQty;


            if ($diff > $product->stok) {
                return redirect()->route('cart.index')->with('error', 'Jumlah melebihi stok yang tersedia.');
            }

            $product->stok -= $diff; // kurangi stok
        }


        if ($newQty < $oldQty) {
            $diff = $oldQty - $newQty;
            $product->stok += $diff; // kembalikan stok
        }


        $product->save();


        $cart[$id]['quantity'] = $newQty;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Jumlah berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {


            $qty = $cart[$id]['quantity'];


            $product = Product::find($id);
            if ($product) {
                $product->stok += $qty;
                $product->save();
            }


            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item dihapus & stok dikembalikan.');
    }



    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }
}
