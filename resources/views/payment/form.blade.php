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

        <div class="space-y-3 mt-10">

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
                <span class="text-sm font-medium text-gray-700">Kontak</span>
                <select
                    id="kontak"
                    name="kontak"
                    required
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                        border-gray-300 focus:border-sky-500 focus:ring-sky-500">

                    <option value="">-- Pilih Kontak WhatsApp --</option>

                    @foreach ($bank as $item)
                        <option
                            value="{{ $item->uuid }}"
                            data-wa="{{ $item->nomor }}">
                            {{ $item->name }} - {{ $item->nomor }}
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
                    readonly
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                           border-gray-300 focus:border-sky-500 focus:ring-sky-500">
            </label>

            <label class="block">
                <span class="text-sm font-medium text-gray-700">Produk</span>
                <tr class="border-b hover:bg-gray-50 mt-1">
                <td class="px-0 py-2 border">
                <div class="grid grid-cols-2 gap-2">
                @foreach ($order->items as $item)
                <div class="flex flex-row  gap-4 w-full p-1">
                    @if ($item->product->gambar)
                        <img
                            src="{{ asset('storage/' . $item->product->gambar) }}"
                            alt="{{ $item->product->name }}"
                            class="h-14 w-14 object-cover rounded border"
                        >
                    @else
                        <span class="text-xs text-gray-400 italic">No Image</span>
                    @endif

                    <span class="text-sm font-medium flex flex-col gap-0.5">
                        {{ $item->product->name }}
                        <span class="text-sm font-light">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</span>
                        <span class="text-sm font-light">Qty: {{ $item->quantity}}</span>
                        <span class="text-sm font-light">Total - Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </span>
                </div>
                @endforeach
                </div>
                </td>
                </tr>
            </label>

            {{-- Catatan --}}
            <label class="block">
                <span class="text-sm font-medium text-gray-700">Catatan</span>
                <textarea
                    name="note"
                    rows="4"
                    class="mt-2 rounded-md block w-full text-sm text-gray-600
                           border-gray-300 focus:border-sky-500 focus:ring-sky-500" readonly>Saat ini pembayaran dilakukan melalui konfirmasi langsung via WhatsApp.
                    Untuk melanjutkan proses pemesanan dan pembayaran, silakan hubungi kami melalui WhatsApp dengan menekan tombol Lanjutkan ke WhatsApp di bawah ini.</textarea>
            </label>

            {{-- Action --}}
            <div class="flex items-center space-x-3">
               <a href="javascript:void(0)"
                id="btnWa"
                class="px-4 py-1 rounded-md bg-gray-400 text-white font-medium cursor-not-allowed">
                    Hubungi via WhatsApp
                </a>

                <a href="{{ route('pesanan.detail', $order->id) }}"
                   class="inline-flex items-center rounded-md bg-gray-200 px-4 py-1 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <script>
const kontakSelect = document.getElementById('kontak');
const btnWa = document.getElementById('btnWa');

kontakSelect.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const waNumber = selectedOption.getAttribute('data-wa');

    if (!waNumber) {
        btnWa.href = 'javascript:void(0)';
        btnWa.classList.remove('bg-sky-600', 'hover:bg-sky-700', 'cursor-pointer');
        btnWa.classList.add('bg-gray-400', 'cursor-not-allowed');
        return;
    }

    const message = encodeURIComponent(
        `Halo admin, saya ingin melanjutkan pesanan.\n\n` +
        `Order ID: {{ $order->code }}\n` +
        `Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}`
    );

    btnWa.href = `https://wa.me/${waNumber}?text=${message}`;
    btnWa.target = "_self"; // menimpa halaman

    btnWa.classList.remove('bg-gray-400', 'cursor-not-allowed');
    btnWa.classList.add('bg-sky-600', 'hover:bg-sky-700', 'cursor-pointer');
});
</script>

</x-app-layout>
