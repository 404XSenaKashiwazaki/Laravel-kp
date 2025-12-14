<x-app-layout>

    <div class="max-w-2xl mx-auto overflow-hidden shadow-sm sm:rounded-lg bg-white p-6">
        {{-- Error Validation --}}
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
            action="{{ route('pembayaran.store', $order->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf

            {{-- Order --}}
            <label class="block">
                <span class="text-sm font-medium text-gray-700">Order ID</span>
               <input
                    type="text"
                    value="{{ $order->code }}"
                    required
                    readonly
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                           border-gray-300 focus:border-sky-500 focus:ring-sky-500">
            </label>

            <label class="block">
                <span class="text-sm font-medium text-gray-700">Bank</span>
                <select
                    name="bank_id"
                    required
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                        border-gray-300 focus:border-sky-500 focus:ring-sky-500">

                    <option value="">-- Pilih Bank --</option>

                    @foreach ($bank as $item)
                        <option
                            value="{{ $item->uuid }}"
                            >
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            {{-- Total --}}
            <label class="block">
                <span class="text-sm font-medium text-gray-700">Total Pembayaran</span>
                <input
                    type="number"
                    name="total"
                    value="{{ old('total', $order->total_amount ?? '') }}"
                    required
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                           border-gray-300 focus:border-sky-500 focus:ring-sky-500">
            </label>

            {{-- Bukti Pembayaran --}}
            <label class="block">
                <span class="text-sm font-medium text-gray-700">Bukti Pembayaran</span>
                <input
                    type="file"
                    name="gambar"
                    accept="image/*"
                    {{ isset($payment) ? '' : 'required' }}
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                           file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                           file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700
                           hover:file:bg-gray-200">

                @isset($payment->gambar)
                    <img src="{{ asset('storage/' . $payment->gambar) }}"
                         class="mt-2 h-32 rounded border"
                         alt="Bukti pembayaran">
                @endisset
            </label>

            {{-- Catatan --}}
            <label class="block">
                <span class="text-sm font-medium text-gray-700">Catatan</span>
                <textarea
                    name="note"
                    rows="4"
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                           border-gray-300 focus:border-sky-500 focus:ring-sky-500">{{ old('note', $payment->note ?? '') }}</textarea>
            </label>

            {{-- Action --}}
            <div class="flex items-center space-x-3">
                <button
                    type="submit"
                    class="px-4 py-1 rounded-md bg-sky-600 text-white font-medium hover:bg-sky-700">
                    {{ isset($payment) ? 'Update' : 'Simpan' }}
                </button>

                <a href="{{ route('pesanan.detail', $order->id) }}"
                   class="inline-flex items-center rounded-md bg-gray-200 px-4 py-1 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
