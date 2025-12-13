
@props(["site" => null])

 <section id="tentang" class="max-w-6xl mx-auto py-20 px-4 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold mb-6">Tentang Kami</h2>
        <p class="text-gray-700 leading-relaxed text-base sm:text-lg lg:text-xl">
         {{ $site->tentang }}
        </p>
    </section>
