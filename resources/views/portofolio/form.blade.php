
<x-admin-layout>
<div class=" max-w-2xl overflow-hidden shadow-sm sm:rounded-lg">
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
    action="{{ isset($portofolio) ?  route('portofolio.update', $portofolio->uuid) : route('portofolio.store') }}"
    method="POST"
    enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if (isset($portofolio))
            @method('PUT')
        @endif
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Judul</span>
            <input type="text" value="{{ old('title', $portofolio->title ?? '') }}" name="title" value class="mt-2 rounded-md block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required>
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Pilih gambar</span>
            <input type="file"
            name="gambar"
            accept="image/*"
            {{ isset($portofolio) ? '' : 'required' }}
            class="mt-2 rounded-md block w-full text-sm text-gray-600
                file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700
                hover:file:bg-gray-200">
        </label>

        <label class="block">
            <span class="text-sm font-medium text-gray-700">Deskripsi</span>
            <textarea name="deskripsi" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required cols="10" rows="2">{{ old('deskripsi', $portofolio->deskripsi ?? '') }}</textarea>
        </label>
         <label class="block">
            <span class="text-sm font-medium text-gray-700">Pilih file pdf</span>
            <input
            type="file"
            name="pdf"
            accept="application/pdf"
            {{ isset($portofolio) ? '' : 'required' }}
            class="mt-2 rounded-md block w-full text-sm text-gray-600
                file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700
                hover:file:bg-gray-200">
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Konten</span>
            <textarea name="isi" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required cols="30" rows="10">{{ old('isi', $portofolio->isi ?? '') }}</textarea>
        </label>
        <div class="flex items-center space-x-3">
        <button type="submit" class="px-4 py-1 rounded-md bg-sky-600 text-white font-medium hover:bg-sky-700">{{ isset($portofolio) ? "Update" : "Tambah" }}</button>
       <a href="{{ route('portofolio.index') }}"
                       class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">
                        Kembali
                    </a>
        </div>
    </form>
</div>
</x-admin-layout>
