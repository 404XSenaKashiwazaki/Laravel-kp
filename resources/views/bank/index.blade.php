<x-admin-layout>
    <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg p-6">

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-semibold">Data Kontak</h1>

            <a href="{{ route('bank.create') }}"
                class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Kontak
            </a>
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
        <div class="overflow-x-hidden">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-x-scroll">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border text-left">Nama</th>
                        <th class="px-4 py-2 border text-left">Nomor</th>
                         <th class="px-4 py-2 border text-left">Catatan</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($banks as $index => $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">
                                {{ $banks->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-2 border flex justify-start items-start gap-1">

                                {{ $product->name }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $product->nomor }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $product->note }}
                            </td>
                            <td class="px-4 py-2 border text-center flex justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('bank.edit', $product->uuid) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('bank.destroy', $product->uuid) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                        Hapus
                                    </button>

                                </form>
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
            {{ $banks->links() }}
        </div>

    </div>
</x-admin-layout>
