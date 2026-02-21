<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Approval - {{ config('app.name', 'Laravel') }}</title>

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
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-lg mb-6" role="alert">
                        <p class="font-medium">{{ $message }}</p>
                    </div>
                    @endif

                    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <div class="max-w-5xl mx-auto">

                                <!-- Header -->
                                <div class="mt-9 mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900">Edit Approval Monitoring SPJ</h2>
                                    <p class="text-sm text-gray-600">Ubah tanggal approval untuk data berikut</p>
                                </div>

                                <!-- Info data -->
                                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-sm text-gray-600"><span class="font-semibold">Kegiatan:</span> {{ $monitoring_spj->activity_name ?? '-' }}</p>
                                    <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Divisi:</span> {{ $monitoring_spj->division ?? '-' }} &nbsp;|&nbsp; <span class="font-semibold">No MAK:</span> {{ $monitoring_spj->mak_number ?? '-' }}</p>
                                </div>

                                <!-- Form Approval -->
                                <div class="bg-white rounded-xl shadow border border-gray-200 p-8 mx-auto mb-20">
                                    <form action="{{ route('monitoring-spj.approval.update', ['monitoring_spj' => $monitoring_spj->id]) }}" method="POST" class="space-y-6">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tgl Approval Pelaksana</label>
                                                <input type="date" name="pelaksana_approved_at"
                                                    value="{{ old('pelaksana_approved_at', $monitoring_spj->pelaksana_approved_at?->format('Y-m-d')) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('pelaksana_approved_at') border-red-500 @enderror">
                                                @error('pelaksana_approved_at')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tgl Approval TU</label>
                                                <input type="date" name="tu_approved_at"
                                                    value="{{ old('tu_approved_at', $monitoring_spj->tu_approved_at?->format('Y-m-d')) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tu_approved_at') border-red-500 @enderror">
                                                @error('tu_approved_at')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tgl Approval PPK</label>
                                                <input type="date" name="ppk_approved_at"
                                                    value="{{ old('ppk_approved_at', $monitoring_spj->ppk_approved_at?->format('Y-m-d')) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('ppk_approved_at') border-red-500 @enderror">
                                                @error('ppk_approved_at')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tgl Approval Keuangan</label>
                                                <input type="date" name="finance_approved_at"
                                                    value="{{ old('finance_approved_at', $monitoring_spj->finance_approved_at?->format('Y-m-d')) }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('finance_approved_at') border-red-500 @enderror">
                                                @error('finance_approved_at')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-2">
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                                <select name="status"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Menunggu" {{ old('status', $monitoring_spj->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="Selesai" {{ old('status', $monitoring_spj->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                    <option value="Ditolak" {{ old('status', $monitoring_spj->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                                @error('status')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                                            <a href="{{ route('monitoring-spj.index') }}"
                                                class="px-5 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Batal</a>
                                            <button type="submit"
                                                class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow hover:from-blue-700 hover:to-indigo-700">Simpan Approval</button>
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
