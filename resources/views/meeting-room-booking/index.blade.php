<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Ruang Rapat - {{ config('app.name', 'Laravel') }}</title>

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

                    <!-- Header with Create Button -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Daftar Peminjaman Ruang Rapat</h3>
                        <a href="{{ route('meeting-room-booking.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-5v3.5m5.5-3.5v3.5M3.5 9.5h13M10 12v5.5m-2.5 0h5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" fill="none"></path>
                            </svg>
                            Tambah Peminjaman
                        </a>
                    </div>
                    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">No</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">User ID</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Tanggal Peminjaman</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Waktu Peminjaman</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Tujuan Peminjaman</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Status</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 uppercase">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-100">
                                    @forelse ($bookings as $index => $booking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $bookings->firstItem() + $index }}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                            {{ $booking->user_id ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $booking->booking_time ? \Carbon\Carbon::parse($booking->booking_time)->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $booking->booking_purpose ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $booking->booking_status == 'Disetujui' ? 'bg-green-100 text-green-800' : 
                                                   ($booking->booking_status == 'Ditolak' ? 'bg-red-100 text-red-800' : 
                                                   ($booking->booking_status == 'Menunggu' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-gray-100 text-gray-800')) }}">
                                                {{ $booking->booking_status ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center items-center gap-4">
                                                <!-- Edit -->
                                                <a href="{{ route('meeting-room-booking.edit', ['meeting_room_booking' => $booking->id]) }}"
                                                    class="text-gray-500 hover:text-blue-600 transition"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16.862 3.487a2.121 2.121 0 113 3L7.5 18.848
                         3 21l2.152-4.348L16.862 3.487z" />
                                                    </svg>
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('meeting-room-booking.destroy', ['meeting_room_booking' => $booking->id]) }}" method="POST"
                                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-gray-500 hover:text-red-600 transition"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                             a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                             M9 7h6m2 0H7m3-3h4a1 1 0 011 1v1H9V5
                             a1 1 0 011-1z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                            Data peminjaman ruang rapat belum tersedia
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between text-sm text-gray-600">
                        <div>
                            Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                        </div>
                        <div>
                            {{ $bookings->links('pagination::tailwind') }}
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
