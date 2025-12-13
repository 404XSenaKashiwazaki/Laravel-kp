<x-admin-layout>

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-6">Detail Pembayaran</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Order ID -->
        <div>
            <label class="text-sm text-gray-500">Order ID</label>
            <p class="text-lg font-medium">{{ $payment->order->code }}</p>
        </div>

        <!-- Total -->
        <div>
            <label class="text-sm text-gray-500">Total Pembayaran</label>
            <p class="text-lg font-medium">
                Rp {{ number_format($payment->total, 0, ',', '.') }}
            </p>
        </div>

        <!-- Catatan -->
        <div class="md:col-span-2">
            <label class="text-sm text-gray-500">Catatan</label>
            <p class="text-gray-700">
                {{ $payment->note ?? '-' }}
            </p>
        </div>

        <!-- Gambar -->
        <div class="md:col-span-2">
            <label class="text-sm text-gray-500">Bukti Pembayaran</label>

            @if ($payment->gambar)
                <img src="{{ asset('storage/' . $payment->gambar) }}"
                     alt="Bukti Pembayaran"
                     class="mt-2 max-h-80 rounded border">
            @else
                <p class="text-gray-400 mt-2">Tidak ada gambar</p>
            @endif
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6 flex gap-3">
         @if ($payment->order->status != "dikirim")
<form action="{{ route('payment.confirm', $payment->order->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin?')">

                                    @csrf
                                    @method('PUT')

                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                        Konfirmasi
                                    </button>

                                </form>
         @endif
        <a href="{{ route('payment.index') }}"
           class="px-4 py-1 bg-gray-200 rounded hover:bg-gray-300">
            Kembali
        </a>


    </div>

</div>


</x-admin-layout>
