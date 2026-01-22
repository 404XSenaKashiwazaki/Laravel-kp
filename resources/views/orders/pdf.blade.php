<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px; }
        th { background: #f3f3f3; }
    </style>
</head>
<body>

<h2>Detail Pesanan</h2>
<p>Kode: {{ $order->code }}</p>
<p>Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
<p>Status: {{ ucfirst($order->status) }}</p>

<table>
    <thead>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product_name }}</td>
            <td>Rp {{ number_format($item->price,0,',','.') }}</td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="right">Rp {{ number_format($item->subtotal,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 style="text-align:right">
    Total: Rp {{ number_format($order->total_amount,0,',','.') }}
</h3>

</body>
</html>
