<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman Ruang Rapat - {{ config('app.name', 'Laravel') }}</title>

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
                                    <h2 class="text-2xl font-bold text-gray-900">Tambah Peminjaman Ruang Rapat</h2>
                                    <p class="text-sm text-gray-600">Isi data peminjaman ruang rapat dengan lengkap dan benar</p>
                                </div>

                                <!-- Form -->
                                <div class="bg-white rounded-xl shadow border border-gray-200 p-8 mx-auto mb-20 ">
                                    <form action="{{ route('meeting-room-booking.store') }}" method="POST" class="space-y-6">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Peminjaman</label>
                                                <input type="date" name="booking_date" value="{{ old('booking_date') }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('booking_date') border-red-500 @enderror">
                                                @error('booking_date')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Peminjaman</label>
                                                <input type="time" name="booking_time" value="{{ old('booking_time') }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('booking_time') border-red-500 @enderror">
                                                @error('booking_time')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kegiatan</label>
                                                <textarea name="booking_purpose" rows="4"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('booking_purpose') border-red-500 @enderror"
                                                    placeholder="Masukkan nama kegiatan yang akan dilaksanakan">{{ old('booking_purpose') }}</textarea>
                                                @error('booking_purpose')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                                            <a href="{{ route('meeting-room-booking.index') }}"
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
