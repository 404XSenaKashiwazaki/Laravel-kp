
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
    action="{{ isset($user) ?  route('user.update', $user->id) : route('user.store') }}"
    method="POST"
    enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Nama</span>
            <input type="text" value="{{ old('name', $user->name ?? '') }}" name="name" value class="mt-2 rounded-md block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required>
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Email</span>
            <input type="email" value="{{ old('email', $user->email ?? '') }}" name="email" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required>
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Password</span>
            <input type="password" value="{{ old('password', $user->password ?? '') }}" name="password" class=" mt-2  rounded-md block  w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" required>
        </label>
        <label class="block">
            <span class="text-sm font-medium text-gray-700">Role</span>
            <select name="role"
                class="mt-2 rounded-md block w-full text-sm text-gray-600 border-gray-300 focus:border-gray-400 focus:ring-gray-400"
                required>
                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </label>

        <div class="flex items-center space-x-3">
        <button type="submit" class="px-4 py-1 rounded-md bg-sky-600 text-white font-medium hover:bg-sky-700">{{ isset($user) ? "Update" : "Tambah" }}</button>
       <a href="{{ route('user.index') }}"
                       class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">
                        Kembali
                    </a>
        </div>
    </form>
</div>
</x-admin-layout>
