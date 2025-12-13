<x-app-layout>
    <div class="bg-white max-w-5xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg p-6">

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-semibold">Data Pesanan</h1>


        </div>

        {{-- Search --}}
        <div class="mb-4">
            <form method="GET" class="flex w-full max-w-xs">
                <input type="text" name="search" placeholder="Cari..."
                    value="{{ request('search') }}"
                    class="w-full border rounded-l px-3 py-1 focus:ring-1 focus:ring-blue-500" />
                <button class="px-4 bg-blue-600 text-white rounded-r hover:bg-blue-700">
                    Cari
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-x-scroll">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border text-left">Nama</th>
                        <th class="px-4 py-2 border text-left">Produk</th>
                         <th class="px-4 py-2 border text-left">Total</th>
                          <th class="px-4 py-2 border text-left">Tanggal</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $index => $product)

                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">
                                {{ $orders->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-2 border ">
                                {{ $product->user->name }}
                            </td>
                             <td class="px-4 py-2 border flex flex-col justify-start items-start gap-1">
                              @foreach ($product->items as $item)

                                @if ($item->product->gambar)
                                    <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                    class="h-14 w-14 object-cover rounded border">
                                @else
                                    <span class="text-gray-400 italic">No Image</span>
                                @endif
                                {{ $item->product->name }}
                              @endforeach
                            </td>
                             <td class="px-4 py-2 border">
                                Rp {{ number_format($product->total_amount, 0, ',', '.') }}
                            </td>
                             <td class="px-4 py-2 border">
                               {{ $product->created_at->translatedFormat('d F Y H:i') }}
                            </td>
                            <td class="px-4 py-2 border text-center flex justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('pesanan.detail', $product->id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">
                                    Detail
                                </a>

                                {{-- Delete --}}

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $orders->links() }}
        </div>

    </div>
</x-app-layout>
