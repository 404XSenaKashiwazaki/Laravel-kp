<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
 <h1 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                Profile Kami
                            </h1>

                    <div class="grid grid-cols-2 gap-5 md:flex-row mt-2">
                        <div class="bg-gray-100 p-6 rounded-xl shadow-2xl hover:shadow-2xl transition flex flex-col items-center text-center">

                            {{-- Icon Legalitas --}}
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-12 w-12 text-blue-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 3l7 4v5c0 5-3.5 9-7 10
                                            -3.5-1-7-5-7-10V7l7-4z" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-semibold">Legalitas Perusahaan</h3>

                            <p class="mt-2 text-gray-600 text-sm">
                                Informasi dokumen resmi dan perizinan perusahaan kami.
                            </p>

                            <a href="{{ route('profiles.legalitas') }}"
                            class="mt-4 inline-block bg-blue-600 text-white px-5 py-1 rounded-lg hover:bg-blue-700">
                                Lihat Legalitas
                            </a>
                            </div>
                            <div class="bg-gray-100 p-6 rounded-xl shadow-2xl hover:shadow-2xl transition flex flex-col items-center text-center">

                            {{-- Icon Portofolio --}}
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-12 w-12 text-green-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 6V5a3 3 0 013-3
                                            h0a3 3 0 013 3v1m-9 0h9
                                            a2 2 0 012 2v10
                                            a2 2 0 01-2 2H7
                                            a2 2 0 01-2-2V8
                                            a2 2 0 012-2z" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-semibold">Portofolio</h3>

                            <p class="mt-2 text-gray-600 text-sm">
                                Kumpulan proyek dan hasil pekerjaan yang telah kami selesaikan.
                            </p>

                            <a href="{{ route('profiles.portofolio') }}"
                            class="mt-4 inline-block bg-green-600 text-white px-5 py-1 rounded-lg hover:bg-green-700">
                                Lihat Portofolio
                            </a>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



