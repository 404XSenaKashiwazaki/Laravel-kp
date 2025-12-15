<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 mt-10 bg-white rounded-lg shadow">

        {{-- Judul --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
            {{ $data->title }}
        </h1>

        {{-- Deskripsi --}}
        <p class="text-gray-600 mb-6">
            {{ $data->deskripsi }}
        </p>

        {{-- Gambar --}}
        @if ($data->gambar)
            <div class="mb-6">
                <img
                    src="{{ asset('storage/' . $data->gambar) }}"
                    alt="{{ $data->title }}"
                  class="w-full h-96 rounded-lg "
                >
            </div>
        @endif

        {{-- Isi --}}
        <div class="prose max-w-none mb-6">
            {!! nl2br(e($data->isi)) !!}
        </div>

        {{-- PDF --}}
        @if ($data->pdf)
            <div class="mt-6">
                <a
                    href="{{ asset('storage/' . $data->pdf) }}"
                    target="_blank"
                    class="inline-flex items-center px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                >
                    📄 Lihat / Unduh PDF
                </a>
            </div>
        @endif

        {{-- Tombol Kembali --}}
        <div class="mt-8">
            <a
                href="{{ route("profiles.portofolio") }}"
                class="inline-flex items-center rounded-md bg-gray-200 px-4 py-1 text-sm font-semibold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">

                ← Kembali
            </a>
        </div>

    </div>
</x-app-layout>
