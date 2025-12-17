@props(["site" => null])

<nav class="bg-white shadow fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <div class="text-2xl font-bold text-blue-600">

                 <a href="{{ url('/') }}"
                   >
                     {{ $site->name }}
                </a>
            </div>


{{-- @dd(request()->routeIs('profiles.*')) --}}
            {{-- Desktop Menu --}}
            <div class="hidden md:flex space-x-8 text-lg">

<a href="{{ url('/') }}"
   id="nav-home"
   class="hover:text-blue-600 {{ request()->is('/') ? 'text-blue-600 font-medium' : '' }}">
    Home
</a>




                {{-- Gallery --}}
              <a href="{{ url('/#gallery') }}" class="nav-link hover:text-blue-600">
    Gallery
</a>

<a href="{{ url('/#produk') }}" class="nav-link hover:text-blue-600">
    Produk
</a>

<a href="{{ url('/#tentang') }}" class="nav-link hover:text-blue-600">
    Tentang
</a>



                  <a href="{{ route('profiles.index') }}"
                       class="{{ request()->routeIs('profiles.*') ? 'text-blue-600 font-medium' : '' }} relative block hover:text-blue-600">
            Profile Kami
                    </a>

                @auth
                    @php
                        $cart = session()->get('cart', []);
                        $cartCount = is_array($cart) ? count($cart) : 0;
                    @endphp

                    {{-- Keranjang --}}
                    <a href="{{ route('cart.index') }}"
                       class="{{ request()->routeIs('cart.*') ? 'text-blue-600 font-medium' : '' }} relative block hover:text-blue-600">
                        Keranjang
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full px-2 py-0.5">
                            {{ $cartCount }}
                        </span>
                    </a>

                    {{-- Pesanan --}}
                    <a href="{{ route('pesanan.index', auth()->user()->id) }}"
                       class="{{ (request()->routeIs('pesanan.*') || request()->routeIs('pembayaran.*')) ? 'text-blue-600 font-medium' : '' }} block hover:text-blue-600">
                        Pesanan
                    </a>

                  <div class="relative group">
    {{-- Trigger --}}
    <button
        type="button"
        class="flex items-center gap-2 hover:text-blue-600 focus:outline-none
               {{ request()->routeIs('profile.*') ? 'text-blue-600 font-medium' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-6 w-6"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.8"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.8"
                  d="M4.5 20.25a8.25 8.25 0 0115 0" />
        </svg>
        <span class="hidden lg:inline">
            {{ auth()->user()->name }}
        </span>
        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                  clip-rule="evenodd" />
        </svg>
    </button>

    {{-- Dropdown --}}
    <div
        class="absolute right-0 mt-2 w-44 rounded-md bg-white shadow-lg border
               opacity-0 invisible group-hover:opacity-100 group-hover:visible
               transition-all duration-150 z-50">

        <a href="{{ route('profile.edit') }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
</div>


                @else
                    <a href="{{ route('login') }}" class="block hover:text-blue-600">Login</a>
                @endauth

            </div>

            {{-- Mobile button --}}
            <div class="md:hidden">
                <button id="menu-btn" class="focus:outline-none">
                    <svg class="w-7 h-7 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2 text-lg">

<a href="{{ url('/') }}"
   id="nav-home"
   class="hover:text-blue-600 {{ request()->is('/') ? 'text-blue-600 font-medium' : '' }}">
    Home
</a>





                {{-- Gallery --}}
              <a href="{{ url('/#gallery') }}" class="nav-link hover:text-blue-600">
    Gallery
</a>

<a href="{{ url('/#produk') }}" class="nav-link hover:text-blue-600">
    Produk
</a>

<a href="{{ url('/#tentang') }}" class="nav-link hover:text-blue-600">
    Tentang
</a>
    <a href="{{ route('profiles.index') }}"
                       class="{{ request()->routeIs('profiles.*') ? 'text-blue-600 font-medium' : '' }} relative block hover:text-blue-600">
            Profile Kami
                    </a>


            @auth
            <a href="{{ route('cart.index') }}"
                       class="{{ request()->routeIs('cart.*') ? 'text-blue-600 font-medium' : '' }} relative block hover:text-blue-600">
                        Keranjang
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs rounded-full px-2 py-0.5">
                            {{ $cartCount }}
                        </span>
                    </a>

                <a href="{{ route('pesanan.index', auth()->user()->id) }}" class="block hover:text-blue-600">
                    Pesanan
                </a>

                <div class="border-t pt-2 mt-2">
    <a href="{{ route('profile.edit') }}"
       class="block px-2 py-2 hover:text-blue-600">
        Profile
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="block w-full text-left px-2 py-2 text-red-600 hover:text-red-700">
            Logout
        </button>
    </form>
</div>

            @else
                <a href="{{ route('login') }}" class="block hover:text-blue-600">Login</a>
            @endauth

        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });



    });


</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const home = document.getElementById('nav-home');
    const links = document.querySelectorAll('.nav-link');

    function resetActive() {
        home.classList.remove('text-blue-600', 'font-medium');
        links.forEach(link => {
            link.classList.remove('text-blue-600', 'font-medium');
        });
    }

    function setActive() {
        const hash = window.location.hash;
        const path = window.location.pathname;

        resetActive();

        if (path !== '/' && !path.endsWith('/')) {
            return;
        }


        if (!hash) {
            home.classList.add('text-blue-600', 'font-medium');
            return;
        }


        links.forEach(link => {
            if (link.getAttribute('href').endsWith(hash)) {
                link.classList.add('text-blue-600', 'font-medium');
            }
        });
    }

    setActive();
    window.addEventListener('hashchange', setActive);
});
</script>

