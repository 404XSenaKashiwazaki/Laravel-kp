@php
    $role = auth()->user()?->role;
@endphp

@if ($role === 'admin')
    <x-admin-layout>
        {{ $slot }}
    </x-admin-layout>
@else
    <x-app-layout>
        {{ $slot }}
    </x-app-layout>
@endif
