<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="w-full">

                            <h1 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                Keranjang Belanja
                            </h1>

                            @if(empty($cart))
                                <div class="mb-4 rounded-md bg-blue-50 p-4 text-sm text-blue-800 dark:bg-blue-900/40 dark:text-blue-100">
                                    Keranjang Anda masih kosong.
                                </div>

                                <a href="{{ route('home') }}"
                                   class="inline-flex items-center rounded-md bg-gray-200 px-4 py-1 text-sm font-semibold text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-gray-500">
                                    Kembali ke Produk
                                </a>
                            @else
                                <div class="mb-4 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-900/40">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                Produk
                                            </th>
                                            <th class="w-32 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                Harga
                                            </th>
                                            <th class="w-32 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                Jumlah
                                            </th>
                                            <th class="w-40 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                Subtotal
                                            </th>
                                            <th class="w-20 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                Aksi
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                        @php $total = 0; @endphp
                                        @foreach($cart as $item)
                                            @php
                                                $subtotal = $item['price'] * $item['quantity'];
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $item['name'] }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    <form action="{{ route('cart.update', $item['id']) }}"
                                                          method="POST"
                                                          class="flex items-center gap-2">
                                                        @csrf
                                                        <input
                                                            type="number"
                                                            name="quantity"
                                                            value="{{ $item['quantity'] }}"
                                                            min="1"


                                                            class="w-20 rounded-md border-gray-300 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                                        >
                                                        <button type="submit"
                                                                class="inline-flex items-center rounded-md border border-indigo-600 bg-white px-3 py-1 text-xs font-medium text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-indigo-400 dark:bg-gray-800 dark:text-indigo-300 dark:hover:bg-gray-700">
                                                            Perbarui
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">
                                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    <form action="{{ route('cart.destroy', $item['id']) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="inline-flex items-center rounded-md bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot class="bg-gray-50 dark:bg-gray-900/40">
                                        <tr>
                                            <th colspan="3"
                                                class="px-4 py-3 text-right text-sm font-semibold text-gray-800 dark:text-gray-100">
                                                Total:
                                            </th>
                                            <th colspan="2"
                                                class="px-4 py-3 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                Rp {{ number_format($total, 0, ',', '.') }}
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="mt-4 flex flex-col items-start justify-between gap-3 border-t border-gray-200 pt-4 text-sm sm:flex-row sm:items-center dark:border-gray-700">
                                    <a href="{{ route('home') }}"
                                       class="inline-flex items-center rounded-md bg-gray-200 px-4 py-1 text-sm font-semibold text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-gray-500">
                                        Lanjut Belanja
                                    </a>

                                    <div class="flex gap-2">
                                        <form action="{{ route('cart.clear') }}"
                                              method="POST"
                                              onsubmit="return confirm('Kosongkan seluruh keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center rounded-md border border-red-600 bg-white px-4 py-1 text-sm font-semibold text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:border-red-400 dark:bg-gray-800 dark:text-red-300 dark:hover:bg-gray-700">
                                                Kosongkan Keranjang
                                            </button>
                                        </form>
                                        <form action="{{ route('cart.checkout') }}"
                                              method="POST"
                                              >
                                            @csrf

                                           <button type="submit"
                                                class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-1 text-sm font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                            Checkout
                                        </button>
                                        </form>

                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
