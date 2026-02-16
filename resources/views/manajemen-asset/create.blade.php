        <!DOCTYPE html>
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Manajemen Asset - {{ config('app.name', 'Laravel') }}</title>

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
                                            <h2 class="text-2xl font-bold text-gray-900">Tambah Asset</h2>
                                            <p class="text-sm text-gray-600">Isi data asset dengan lengkap dan benar</p>
                                        </div>

                                        <!-- Form -->
                                        <div class="bg-white rounded-xl shadow border border-gray-200 p-8 mx-auto mb-20 ">
                                            <form action="{{     route('manajemen-asset.store') }}" method="POST" class="space-y-6">
                                                @csrf
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Asset</label>
                                                        <input type="text" name="kode" value="{{ old('kode') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                        @error('kode')
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Asset</label>
                                                        <input type="text" name="nama" value="{{ old('nama') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                        @error('nama')
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">NUP</label>
                                                        <input type="text" name="nup" value="{{ old('nup') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Perolehan</label>
                                                        <input type="date" name="tgl_perolehan" value="{{ old('tgl_perolehan') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                                                        <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Satuan</label>
                                                        <input type="text" name="satuan" value="{{ old('satuan') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Merk / Tipe</label>
                                                        <input type="text" name="merk_tipe" value="{{ old('merk_tipe') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kondisi</label>
                                                        <select name="kondisi"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                            <option value="">-- Pilih Kondisi --</option>
                                                            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                                            <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                                            <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                                        </select>
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                                        <select name="status"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                        </select>
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Penanggung Jawab</label>
                                                        <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2     focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:bg-white">
                                                    </div>
                                                </div>

                                                <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                                                    <a href="{{ route('manajemen-asset.index') }}"
                                                        class="px-5 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Batal</a>
                                                    <button type="submit"
                                                        class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow hover:from-blue-700 hover:to-indigo-700">Simpan</button>
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