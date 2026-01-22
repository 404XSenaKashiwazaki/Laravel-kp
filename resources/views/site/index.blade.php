
<x-admin-layout>
      <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Situs') }}
        </h2>
    </x-slot>
<div class=" max-w-2xl overflow-hidden shadow-sm sm:rounded-lg">
       @if (session('success'))
            <div class="mb-4 p-3 mt-4 rounded bg-green-50 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

    @if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form
    action="{{ route('site.update', $site->uuid) }}"
    method="POST"
    enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if (isset($site))
            @method('PUT')
        @endif
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Nama</span>
            <input type="text" value="{{ old('name', $site->name ?? '') }}" name="name" value class="mt-2 rounded-md block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required>
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Pilih gambar</span>
            <input type="file"
            name="gambar"
            accept="image/*"
            {{ isset($site) ? '' : 'required' }}
            class="mt-2 rounded-md block w-full text-sm text-gray-600
                file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700
                hover:file:bg-gray-200">
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Deskripsi</span>
            <textarea name="deskripsi" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required cols="30" rows="2">{{ old('deskripsi', $site->deskripsi ?? '') }}</textarea>
        </label>
         <label class="block">
            <span class="text-sm font-medium text-gray-700">Tentang</span>
            <textarea name="tentang" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required cols="30" rows="4">{{ old('tentang', $site->tentang ?? '') }}</textarea>
        </label>
         <label class="block">
            <span class="text-sm font-medium text-gray-700">Alamat</span>
            <textarea name="alamat" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required cols="30" rows="7">{{ old('alamat', $site->alamat ?? '') }}</textarea>
        </label>
        <div class="flex items-center space-x-3">
        <button type="submit" class="px-4 py-1 rounded-md bg-sky-600 text-white font-medium hover:bg-sky-700">Update</button>

        </div>
    </form>
</div>
</x-admin-layout>
