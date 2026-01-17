<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja Redesain - {{ config('app.name', 'Laravel') }}</title>

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
    <style>
        .tab-active {
            @apply bg-blue-600 text-white;
        }
        .tab-inactive {
            @apply bg-gray-200 text-gray-700 hover:bg-gray-300;
        }
        .sidebar-active {
            @apply bg-blue-50 text-blue-600 border-r-4 border-blue-600;
        }
        .table-header {
            @apply bg-blue-500 text-white font-semibold;
        }
    </style>
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
                    <button onclick="openProgramModal()" class="text-2xl font-bold text-gray-900 hover:text-blue-600 transition">Belanja Redesain</button>
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
                <div class="w-full px-8 py-8">
                    <!-- Tabs -->
                    <div class="flex gap-2 mb-6">
                        <button onclick="switchTab('komponen')" id="tab-komponen" class="tab-active px-6 py-2 rounded-t-lg font-medium transition duration-200">
                            1. Rekam Komponen
                        </button>
                        <button onclick="switchTab('sub-komponen')" id="tab-sub-komponen" class="tab-inactive px-6 py-2 rounded-t-lg font-medium transition duration-200">
                            2. Rekam Sub Komponen
                        </button>
                    </div>

                    <!-- Total Pagu -->
                    <div class="bg-white p-4 rounded-lg shadow mb-6 flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-700">Pagu Total :</span>
                        <span class="text-2xl font-bold text-blue-600">26.452.541.000</span>
                    </div>

                    <!-- Komponen Tab Content -->
                    <div id="komponen-content" class="tab-content">
                        <div class="bg-white rounded-lg shadow overflow-x-auto">
                            <table class="w-full border-collapse text-sm">
                                <thead>
                                    <tr class="table-header text-center cursor-pointer hover:bg-blue-600" onclick="openProgramModal()">
                                        <th class="border border-gray-300 px-4 py-3">KODE</th>
                                        <th class="border border-gray-300 px-4 py-3">URAIAN</th>
                                        <th class="border border-gray-300 px-4 py-3">VOL</th>
                                        <th class="border border-gray-300 px-4 py-3">SAT</th>
                                        <th class="border border-gray-300 px-4 py-3">HARGA</th>
                                        <th class="border border-gray-300 px-4 py-3">JUMLAH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($belanjaRedesains as $item)
                                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                                        <td class="border border-gray-300 px-4 py-3 font-medium">{{ optional($item->programs)->kode_kegiatan ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-3">{{ $item->nama_uraian }}</td>
                                        <td class="border border-gray-300 px-4 py-3 text-center">-</td>
                                        <td class="border border-gray-300 px-4 py-3 text-center">{{ $item->satuan }}</td>
                                        <td class="border border-gray-300 px-4 py-3 text-center">{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 px-4 py-3 text-right font-semibold">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                                        <td colspan="6" class="border border-gray-300 px-4 py-3 text-center text-gray-500">Belum ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sub Komponen Tab Content (Hidden by default) -->
                    <div id="sub-komponen-content" class="tab-content hidden">
                        <div class="bg-white rounded-lg shadow overflow-x-auto">
                            <table class="w-full border-collapse text-sm">
                                <thead>
                                    <tr class="table-header text-center cursor-pointer hover:bg-blue-600" onclick="openProgramModal()">
                                        <th class="border border-gray-300 px-4 py-3">KODE</th>
                                        <th class="border border-gray-300 px-4 py-3">URAIAN</th>
                                        <th class="border border-gray-300 px-4 py-3">VOL</th>
                                        <th class="border border-gray-300 px-4 py-3">SAT</th>
                                        <th class="border border-gray-300 px-4 py-3">HARGA</th>
                                        <th class="border border-gray-300 px-4 py-3">JUMLAH</th>
                                        <th class="border border-gray-300 px-2 py-3 w-8">T</th>
                                        <th class="border border-gray-300 px-2 py-3 w-8">SD</th>
                                        <th class="border border-gray-300 px-2 py-3 w-8">Q</th>
                                        <th class="border border-gray-300 px-2 py-3 w-8">S</th>
                                        <th class="border border-gray-300 px-2 py-3 w-8">U</th>
                                        <th class="border border-gray-300 px-2 py-3 w-8">D</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                                        <td class="border border-gray-300 px-4 py-3 text-center text-gray-500">Belum ada data</td>
                                        <td colspan="11" class="border border-gray-300 px-4 py-3 text-center text-gray-500"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rekam Belanja Redesain -->
    <div id="programModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4" style="max-height: 90vh; overflow-y: auto;">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
                <h3 class="text-lg font-semibold">Rekam Data Belanja</h3>
                <button onclick="closeProgramModal()" class="text-white hover:bg-blue-700 p-1 rounded">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form id="programForm" method="POST" onsubmit="submitProgram(event)" class="p-6">
                @csrf
                <div class="mb-4">
                    <label for="program_id" class="block text-sm font-medium text-gray-700 mb-2">Program Kegiatan <span class="text-red-600">*</span></label>
                    <select id="program_id" name="program_id" required onchange="autofillUraian()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Program --</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}" data-nama="{{ $program->nama_kegiatan }}">{{ $program->kode_kegiatan }} - {{ $program->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="nama_uraian" class="block text-sm font-medium text-gray-700 mb-2">Nama Uraian <span class="text-red-600">*</span></label>
                    <input type="text" id="nama_uraian" name="nama_uraian" disabled required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeProgramModal()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Simpan
                    </button>
                </div>

                <div id="formMessage" style="display: none;" class="mt-4 p-3 rounded-lg text-sm"></div>
            </form>
        </div>
    </div>

    <script>
        function autofillUraian() {
            const programSelect = document.getElementById('program_id');
            const selectedOption = programSelect.options[programSelect.selectedIndex];
            const namaUraianInput = document.getElementById('nama_uraian');
            
            if (selectedOption.value) {
                namaUraianInput.value = selectedOption.getAttribute('data-nama');
            } else {
                namaUraianInput.value = '';
            }
        }

        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            const arrow = document.getElementById('dropdownArrow');
            
            menu.classList.toggle('hidden');
            arrow.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Reset all tab buttons
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('tab-inactive');
            });

            // Show selected tab content
            const contentId = tabName + '-content';
            document.getElementById(contentId).classList.remove('hidden');

            // Activate selected tab button
            document.getElementById('tab-' + tabName).classList.remove('tab-inactive');
            document.getElementById('tab-' + tabName).classList.add('tab-active');
        }

        function openProgramModal() {
            const modal = document.getElementById('programModal');
            modal.style.display = 'flex';
        }

        function closeProgramModal() {
            const modal = document.getElementById('programModal');
            modal.style.display = 'none';
            document.getElementById('programForm').reset();
            document.getElementById('formMessage').style.display = 'none';
            document.getElementById('nama_uraian').value = '';
        }

        function submitProgram(event) {
            event.preventDefault();

            const programId = document.getElementById('program_id').value
            ;
            const namaUraian = document.getElementById('nama_uraian').value;
            const messageDiv = document.getElementById('formMessage');

            // Submit via AJAX
            fetch('{{ route("belanja-redesain.storeProgram") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    program_id: programId,
                    nama_uraian: namaUraian
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.style.display = 'block';
                    messageDiv.className = 'mt-4 p-3 rounded-lg text-sm bg-green-100 text-green-700';
                    messageDiv.textContent = '✓ Data berhasil disimpan!';
                    
                    setTimeout(() => {
                        closeProgramModal();
                        location.reload();
                    }, 1500);
                } else {
                    messageDiv.style.display = 'block';
                    messageDiv.className = 'mt-4 p-3 rounded-lg text-sm bg-red-100 text-red-700';
                    messageDiv.textContent = '✗ ' + (data.message || 'Gagal menyimpan data');
                }
            })
            .catch(error => {
                messageDiv.style.display = 'block';
                messageDiv.className = 'mt-4 p-3 rounded-lg text-sm bg-red-100 text-red-700';
                messageDiv.textContent = '✗ Error: ' + error.message;
            });
        }
    </script>
</body>
</html>