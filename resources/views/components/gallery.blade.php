@props(["gallery" => null])
 <section id="gallery" class="max-w-7xl mx-auto py-16 px-4">
        <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-center">Gallery</h2>

        <div class="grid grid-cols-1  transition sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($gallery as $item)
               <a href="{{ route("home.gallery", $item->uuid) }}">
                <div class="shadow-xl hover:shadow-2xl rounded-md py-1 px-4">
                 @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                    class="h-50 w-full object-cover border   shadow">
                @else
                    <span class="text-gray-400 italic">No Image</span>
                @endif
                <p class="text-md sm:text-lg font-bold mb-6 text-center">{{ $item->name}}</p>
                <span class="text-sm sm:text-md font-light mb-6">{{  Str::limit($item->deskripsi, 15) }}</span>
               </div>
               </a>
            @endforeach

        </div>
         {{-- <div class="mt-4">
            {{ $gallery->links() }}
        </div> --}}
    </section>
