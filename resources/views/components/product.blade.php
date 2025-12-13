@props(["products" => null])

<section id="produk" class="bg-white py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-bold mb-10 text-center">Produk Kami</h2>
 <div class="mb-4 mx-6">
            <form method="GET" class="flex w-full max-w-xs">
                <input type="text" name="search" placeholder="Cari..."
                    value="{{ request('search') }}"
                    class="w-full border rounded-l px-3 py-1 focus:ring-1 focus:ring-blue-500" />
                <button class="px-4 bg-blue-600 text-white rounded-r hover:bg-blue-700">
                    Cari
                </button>
            </form>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 xl:gap-10">

            @foreach ($products as $item)
                <div class="bg-gray-100 p-6 rounded-xl shadow-xl hover:shadow-2xl transition">

                    {{-- Gambar Produk --}}
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             class="h-60 w-full object-cover border rounded-lg shadow">
                    @else
                        <span class="text-gray-400 italic">Tidak ada gambar</span>
                    @endif

                    {{-- Nama Produk --}}
                    <h3 class="text-lg sm:text-xl font-semibold mt-3">{{ $item->name }}</h3>

                    {{-- Deskripsi Produk --}}
                    <p class="mt-2 text-gray-600 text-sm sm:text-base">
                        {{ Str::limit($item->deskripsi, 20, '...') }}
                    </p>
                    <div class="flex flex-col gap-1">
                        <p class="mt-2 text-gray-600 text-sm sm:text-base">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        {{-- <p class="mt-2 text-gray-500 text-sm sm:text-base">Stok {{ $item->stok }}</p> --}}
                    </div>
                    {{-- Tombol Tambah ke Keranjang --}}
                    <form action="{{ route('cart.add', $item->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit"
                                class="mt-4 bg-blue-600 text-white px-4 py-1 rounded-lg hover:bg-blue-700">
                            Tambah ke Keranjang
                        </button>
                    </form>

                </div>
            @endforeach


        </div>
         <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</section>
