@props(["site" => null])

    <section class="bg-blue-600 text-white pt-28 pb-24 px-4 text-center max-w-7xl mx-auto py-16 mt-10">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">Selamat Datang di {{ $site->name }}</h1>
        <p class="mt-3 text-base sm:text-lg lg:text-xl">
            {{ $site->deskripsi}}
        </p>
    </section>
