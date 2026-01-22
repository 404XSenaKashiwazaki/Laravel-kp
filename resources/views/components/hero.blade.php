@props(["site" => null])

    <section class="bg-[#1ea0ff] text-white pt-28 pb-24 px-4 text-center max-w-7xl mx-auto py-16 mt-10 flex flex-col items-center">
    @if ($site->gambar)
        <img src="{{ asset('storage/' . $site->gambar) }}"
             class="w-auto object-cover rounded border-0 h-56 mx-auto">
    @else
        <span class="text-gray-400 italic">No Image</span>
    @endif

    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4">
        Selamat Datang di {{ $site->name }}
    </h1>
    <p class="mt-3 text-base sm:text-lg lg:text-xl">
        {{ $site->deskripsi}}
    </p>
</section>

