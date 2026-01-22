
<x-app-layout>
    {{-- HERO --}}
    <x-hero :site=$site></x-hero>
    {{-- GALLERY SECTION --}}
    <x-gallery :gallery=$gallery></x-gallery>

    {{-- PRODUK SECTION --}}
    <x-product :products=$products></x-product>

    {{-- TENTANG --}}
    <x-about :site=$site></x-about>

    {{-- FOOTER --}}
    <footer class="bg-gray-800 text-white py-6 mt-12 mb-0">
        <div class="max-w-7xl mx-auto text-center text-sm sm:text-base">
            <p>&copy; {{ date('Y') }} {{$site->name}}. All Rights Reserved.</p>
        </div>
    </footer>
</x-app-layout>
