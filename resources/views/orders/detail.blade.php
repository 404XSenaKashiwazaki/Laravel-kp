<x-admin-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Detail Pesanan
                    </h1>

                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Kode Pesanan:
                        <span class="font-semibold">{{ $order->code }}</span>
                    </p>

                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Status:
                        <span
                            class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium
                            @if($order->status == 'pending') bg-yellow-200 text-yellow-900
                            @elseif($order->status == 'paid') bg-green-200 text-green-900
                            @else bg-gray-200 text-gray-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>

                {{-- Ringkasan --}}
                <div class="px-6 py-5 space-y-2">
                    <p class="text-gray-800 dark:text-gray-200 text-sm">
                        Tanggal Pesanan: <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong>
                    </p>

                    <p class="text-gray-800 dark:text-gray-200 text-sm">
                        Qty: <strong>{{ $order->total_quantity }}</strong>
                    </p>

                    <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        Total Pembayaran:
                        <span class="text-emerald-600 dark:text-emerald-400">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </p>

                    @if($order->note)
                        <div class="mt-4 bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                            <label class="block text-xs text-gray-500 dark:text-gray-300 mb-1">Catatan</label>
                            <p class="text-sm text-gray-800 dark:text-gray-200">{{ $order->note }}</p>
                        </div>
                    @endif
                </div>

                {{-- Tabel Item --}}
                <div class="px-6 py-5 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Pemesan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Produk</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Harga</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-300">Jumlah</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-600 dark:text-gray-300">Subtotal</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 dark:text-gray-100 flex flex-col gap-2">
                                    <span>{{ $order->user->name }}</span>
                                    <span>{{ $order->user->email }}</span>
                                </td>

                                <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $item->product_name }}</td>

                                <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-100">
                                    {{ $item->quantity }}
                                </td>

                                <td class="px-4 py-3 text-right text-gray-900 dark:text-gray-100">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <a href="{{ route('orders.index') }}"
                       class="inline-flex items-center rounded-md bg-gray-200 px-4 py-1 text-sm font-semibold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
