<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontrak - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
        /* Tailwind CSS base styles */
    </style>
    @endif
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-blue-600">{{ config('app.name', 'Laravel') }}</h1>
            </div>

            @include('sidebar')

            <div class="p-4 border-t border-gray-200">

            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            @include('layouts')

            <!-- Page Content -->
            <div class="flex-1 overflow-auto">
                <div class="max-w-8xl mx-auto px-8 py-8">
                    <!-- Success Message -->
                    @if ($message = Session::get('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-lg mb-6"
                        role="alert">
                        <p class="font-medium">{{ $message }}</p>
                    </div>
                    @endif

                    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <div class="max-w-5xl mx-auto">

                                <!-- Header -->
                                <div class="mt-9 mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900">Edit Kontrak</h2>
                                    <p class="text-sm text-gray-600">Ubah data kontrak sesuai kebutuhan</p>
                                </div>

                                <!-- Form -->
                                <div class="bg-white rounded-xl shadow border border-gray-200 p-8 mx-auto mb-20 ">
                                    <form action="{{ route('contract.update', $contract) }}" method="POST" class="space-y-6">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Satuan Kerja</label>
                                                <input type="text" name="satuan_kerja" value="{{ old('satuan_kerja', $contract->satuan_kerja) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('satuan_kerja') border-red-500 @enderror"
                                                    placeholder="Masukkan satuan kerja">
                                                @error('satuan_kerja')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal SP</label>
                                                <input type="date" name="tanggal_sp" value="{{ old('tanggal_sp', $contract->tanggal_sp?->format('Y-m-d')) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_sp') border-red-500 @enderror">
                                                @error('tanggal_sp')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pejabat Penandatangan</label>
                                                <input type="text" name="nama_pejabat_penandatangan" value="{{ old('nama_pejabat_penandatangan', $contract->nama_pejabat_penandatangan) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_pejabat_penandatangan') border-red-500 @enderror"
                                                    placeholder="Masukkan nama pejabat penandatangan">
                                                @error('nama_pejabat_penandatangan')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Penyedia</label>
                                                <input type="text" name="nama_penyedia" value="{{ old('nama_penyedia', $contract->nama_penyedia) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_penyedia') border-red-500 @enderror"
                                                    placeholder="Masukkan nama penyedia">
                                                @error('nama_penyedia')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Paket Pengadaan</label>
                                                <input type="text" name="nama_paket_pengadaan" value="{{ old('nama_paket_pengadaan', $contract->nama_paket_pengadaan) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_paket_pengadaan') border-red-500 @enderror"
                                                    placeholder="Masukkan nama paket pengadaan">
                                                @error('nama_paket_pengadaan')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Sumber Dana</label>
                                                <input type="text" name="sumber_dana" value="{{ old('sumber_dana', $contract->sumber_dana) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sumber_dana') border-red-500 @enderror"
                                                    placeholder="Masukkan sumber dana">
                                                @error('sumber_dana')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Pelaksanaan</label>
                                                <input type="date" name="waktu_pelaksanaan" value="{{ old('waktu_pelaksanaan', $contract->waktu_pelaksanaan?->format('Y-m-d')) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('waktu_pelaksanaan') border-red-500 @enderror">
                                                @error('waktu_pelaksanaan')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nilai Kontrak (Rp)</label>
                                                <input type="number" name="nilai_kontrak" value="{{ old('nilai_kontrak', $contract->nilai_kontrak) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nilai_kontrak') border-red-500 @enderror"
                                                    placeholder="Masukkan nilai kontrak" min="0" step="1">
                                                @error('nilai_kontrak')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                                            <a href="{{ route('contract.index') }}"
                                                class="px-5 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Batal</a>
                                            <button type="submit"
                                                class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow hover:from-blue-700 hover:to-indigo-700">Perbarui</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            const arrow = document.getElementById('dropdownArrow');

            menu.classList.toggle('hidden');
            arrow.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    </script>
</body>

</html>
