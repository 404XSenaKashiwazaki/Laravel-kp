<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">
                Daftar Artikel
            </h1>
        </div>

        {{-- Grid Artikel --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($artikels as $artikel)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                    {{-- Gambar --}}
                    @if ($artikel->gambar)
                        <img
                            src="{{ asset('storage/' . $artikel->gambar) }}"
                            alt="{{ $artikel->title }}"
                            loading="lazy"
                            class="h-60 w-full object-cover"
                        >
                    @else
                        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif

                    {{-- Konten --}}
                    <div class="p-4 flex flex-col flex-1">
                        <h2 class="text-sm font-semibold text-gray-800 mb-1 line-clamp-2">
                            {{ $artikel->title }}
                        </h2>

                        <p class="text-xs text-gray-600 mb-3 line-clamp-3">
                            {{ $artikel->deskripsi }}
                        </p>

                        <div class="mt-auto flex items-center justify-between">
                            <a
                                href="{{ route('pekerjaan.detail', $artikel->uuid) }}"
                                class="text-blue-600 text-md font-medium hover:underline"
                            >
                                Baca →
                            </a>

                            @if ($artikel->pdf)
                                <span class="text-md text-gray-500">📄 PDF</span>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <p class="text-gray-500">Belum ada artikel.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $artikels->links() }}
        </div>

    </div>
</x-app-layout>
