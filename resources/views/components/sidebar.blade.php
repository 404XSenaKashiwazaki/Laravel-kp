
@props(['open' => false, "site" => null])

<div
    x-data="{
        sidebarOpen: true,   // ← selalu true agar tidak hilang di mobile
        collapsed: false
    }"
    class="h-screen flex"
>

    <!-- Backdrop (DISABLED) -->
    <div class="hidden"></div>

    <!-- Sidebar -->
    <aside
        :class="'translate-x-0'"
        class="fixed inset-y-0 left-0 z-30
               transition-all duration-200
               bg-white border-r shadow-lg overflow-hidden
               lg:static
               lg:w-64"
        :style="collapsed ? 'width:70px' : 'width:256px'"
        x-cloak
    >
        <!-- Header Sidebar -->
        <div class="flex items-center justify-between py-2 px-1 border-b">
            <div class="shrink-0 flex items-center">

                <a href="{{ route('dashboard') }}">
                     @if ($site->gambar)
                                    <img src="{{ asset('storage/' . $site->gambar) }}"
                                    class="w-9 object-cover rounded border block h-9  fill-current text-gray-800 dark:text-gray-200">
                                @else
                                    <span class="text-gray-400 italic">No Image</span>
                                @endif

                </a>
            </div>

            <span class="font-semibold text-lg " x-show="!collapsed">

                {{ $site->name }}</span>

            <!-- Collapse/Expand Button (desktop only) -->
           <button
    class="flex items-center justify-center p-2 rounded hover:bg-gray-200"
    @click="collapsed = !collapsed"
>

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 transition-transform"
                     :class="collapsed ? 'rotate-180' : ''"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Close button (mobile disabled) -->
            <button class="hidden">✕</button>
        </div>

        <!-- Menu -->
        <nav class="p-4">
            <ul class="space-y-1">

                <!-- Dashboard -->
               <li>
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- HOME ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10" />
        </svg>
        <span x-show="!collapsed">Dashboard</span>
    </a>
</li>

<li>
    <a href="{{ route('cms.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('cms.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- DOCUMENT ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 8h10M7 12h6m-6 4h10M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z" />
        </svg>
        <span x-show="!collapsed">Legalitas</span>
    </a>
</li>
<li>
    <a href="{{ route('portofolio.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('portofolio.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- DOCUMENT ICON -->
      <svg xmlns="http://www.w3.org/2000/svg"
     class="h-5 w-5"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor">
    <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M3 7a2 2 0 012-2h4l2 2h8
             a2 2 0 012 2v8a2 2 0 01-2 2H5
             a2 2 0 01-2-2V7z" />
</svg>

        <span x-show="!collapsed">Portofolio</span>
    </a>
</li>
<!-- Product -->
<li>
    <a href="{{ route('product.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('product.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- BOX / CUBE ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 12l-8 4-8-4m16 0l-8-4m8 4v6a1 1 0 01-.553.894l-7.447 3.724L4.553 18.894A1 1 0 014 18v-6m16-4L12 2 4 8" />
        </svg>
        <span x-show="!collapsed">Produk</span>
    </a>
</li>

<li>
    <a href="{{ route('gallery.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('gallery.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- PHOTO ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-width="2" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4.5-4.5a1 1 0 011.4 0L14 16m-2-2l2-2a1 1 0 011.4 0L20 14m-8-8a2 2 0 110 4 2 2 0 010-4z" />
        </svg>
        <span x-show="!collapsed">Gallery</span>
    </a>
</li>
<li>
    <a href="{{ route('bank.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('bank.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- BANK ICON -->
        <svg xmlns="http://www.w3.org/2000/svg"
     class="h-5 w-5"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor">
    <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M8 10h.01M12 10h.01M16 10h.01
             M21 12c0 4.418-4.03 8-9 8
             a9.77 9.77 0 01-4-.8L3 20
             l1.3-3.9A7.77 7.77 0 013
             12c0-4.418 4.03-8 9-8
             s9 3.582 9 8z" />
</svg>

        <span x-show="!collapsed">Kontak</span>
    </a>
</li>

{{-- <li>
    <a href="{{ route('payment.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('payment.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- PAYMENT ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <rect x="2" y="5" width="20" height="14" rx="2" ry="2" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2 10h20" />
        </svg>
        <span x-show="!collapsed">Pembayaran</span>
    </a>
</li> --}}

<li>
    <a href="{{ route('orders.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('orders.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- CART ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.293 2.293A1 1 0 006.618 17h10.764a1 1 0 00.911-1.447L17 13M7 13V6m10 7V6" />
            <circle cx="9" cy="19" r="1" />
            <circle cx="17" cy="19" r="1" />
        </svg>
        <span x-show="!collapsed">Pesanan</span>
    </a>
</li>

<li>
    <a href="{{ route('user.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- USERS ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20v-2a4 4 0 00-3-3.87M7 20v-2a4 4 0 013-3.87m4-6a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span x-show="!collapsed">User</span>
    </a>
</li>

<li>
    <a href="{{ route('site.index') }}"
       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('site.*') ? 'bg-gray-300 hover:bg-gray-400 font-medium' : '' }}">
        <!-- GLOBE ICON -->
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4a8 8 0 110 16 8 8 0 010-16zm0 0a12 12 0 010 16m0-16a12 12 0 000 16m-6-8h12" />
        </svg>
        <span x-show="!collapsed">Situs</span>
    </a>
</li>

                <!-- Team (submenu) -->
                {{-- <li x-data="{ open: @json(request()->routeIs('dashboard.*')) }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-gray-100">

                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5V8H2v12h5M12 12v6" />
                            </svg>
                            <span x-show="!collapsed">Team</span>
                        </div>

                        <svg x-show="!collapsed"
                             class="h-4 w-4 transition-transform"
                             :class="open ? 'rotate-90' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <ul x-show="open && !collapsed"
                        x-transition
                        class="mt-1 space-y-1 pl-8">
                        <li>
                            <a href="{{ route('dashboard') }}"
                               class="block px-3 py-2 rounded hover:bg-gray-100">
                                Members
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}"
                               class="block px-3 py-2 rounded hover:bg-gray-100">
                                Settings
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <!-- Logout -->
                <li class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 w-full">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                            <span x-show="!collapsed">Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        @include('layouts.navigation')
        {{ $slot }}
    </div>
</div>
