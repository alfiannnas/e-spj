<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit KRO - {{ config('app.name', 'Laravel') }}</title>

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
                <form method="POST" action="" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition duration-200 font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M19.543 9.543a.75.75 0 00-1.06-1.061l-3.141 3.14V7a.75.75 0 00-1.5 0v4.75H10a.75.75 0 000 1.5h4.75v1.06a.75.75 0 001.5 0v-4.75l3.043 3.043z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">Edit KRO</h2>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">{{ auth()->user()->email ?? 'User' }}</span>
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">{{ substr(auth()->user()->email ?? 'U', 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="flex-1 overflow-auto">
                <div class="max-w-2xl mx-auto px-8 py-8">
                    <!-- Back Button -->
                    <a href="{{ route('kro.index') }}" class="flex items-center gap-2 text-blue-600 hover:text-blue-900 mb-6">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Kembali ke Daftar KRO
                    </a>

                    <!-- Form Card -->
                    <div class="bg-white rounded-lg shadow p-8">
                        <form action="{{ route('kro.update', $kro->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Kode KRO -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-medium mb-2" for="kode_kro">
                                    Kode KRO
                                </label>
                                <input
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kode_kro') border-red-500 @enderror"
                                    id="kode_kro"
                                    type="text"
                                    name="kode_kro"
                                    value="{{ old('kode_kro', $kro->kode_kro) }}"
                                    placeholder="Masukkan kode KRO (mis: KRO001)"
                                    required
                                />
                                @error('kode_kro')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama KRO -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-medium mb-2" for="nama_kro">
                                    Nama KRO
                                </label>
                                <input
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_kro') border-red-500 @enderror"
                                    id="nama_kro"
                                    type="text"
                                    name="nama_kro"
                                    value="{{ old('nama_kro', $kro->nama_kro) }}"
                                    placeholder="Masukkan nama KRO"
                                    required
                                />
                                @error('nama_kro')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Program -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-medium mb-2" for="program_id">
                                    Program (Opsional)
                                </label>
                                <select
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('program_id') border-red-500 @enderror"
                                    id="program_id"
                                    name="program_id"
                                >
                                    <option value="">-- Pilih Program --</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}" {{ old('program_id', $kro->program_id) == $program->id ? 'selected' : '' }}>
                                            {{ $program->kode_kegiatan }} - {{ $program->nama_kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-4">
                                <button
                                    type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200 flex items-center gap-2"
                                >
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('kro.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-lg transition duration-200">
                                    Batal
                                </a>
                            </div>
                        </form>
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
