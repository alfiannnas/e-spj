            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6">
                <!-- Home Menu -->
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 sidebar-active">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span class="font-medium">Home</span>
                </a>
                <!-- Belanja Redesain Menu -->
                <!-- <a href="{{ route('belanja-redesain.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 sidebar-active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M7.3 21q-.95 0-1.625-.687T5 18.675V9.4L3.175 5H1V3h3.525l1.65 4H20.95q.575 0 .875.475t.025.975L19 14.025q1.275.2 2.138 1.175T22 17.5q0 1.45-1.012 2.475T18.525 21q-1.475 0-2.487-1.025T15.025 17.5q0-.5.125-.925t.35-.825l-3.275-.3l-3 4.5q-.325.5-.837.775T7.3 21m.025-2.025q.05 0 .225-.125l2.425-3.6q-1.225-.125-1.925-.587T7 13.7v5q0 .125.1.2t.225.075M18.5 19q.65 0 1.075-.437T20 17.5q0-.65-.425-1.075T18.5 16q-.625 0-1.062.425T17 17.5q0 .625.438 1.063T18.5 19" />
                    </svg>
                    <span class="font-medium">Belanja Redesain</span>
                </a> -->
                <!-- Manajemen Asset Menu -->
                <a href="{{ route('manajemen-asset.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 sidebar-active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                        <path fill="currentColor" d="M2.226 2h20v9h-20zm6.002 3.5H6.224v2.004h2.004zM2.226 13h20v9h-20zm6.002 3.5H6.224v2.004h2.004z" />
                    </svg>
                    <span class="font-medium">Manajemen Asset</span>
                </a>

                <!-- Manajemen Kontrak Menu -->
                <a href="{{ route('contract.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 sidebar-active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-1.25 0-2.125-.875T3 19v-3h3V2h15v17q0 1.25-.875 2.125T18 22zm12-2q.425 0 .713-.288T19 19V4H8v12h9v3q0 .425.288.713T18 20M9 9V7h9v2zm0 3v-2h9v2z"/></svg>
                    <span class="font-medium">Manajemen Kontrak </span>
                </a>

                <!-- Monitoring SPJ Menu -->
                <a href="{{ route('monitoring-spj.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 sidebar-active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 21q-.425 0-.712-.288T3 20t.288-.712T4 19h10q.425 0 .713.288T15 20t-.288.713T14 21zm0-4q-.425 0-.712-.288T3 16t.288-.712T4 15h16q.425 0 .713.288T21 16t-.288.713T20 17zm1-4q-.825 0-1.412-.587T3 11V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v6q0 .825-.587 1.413T19 13zm0-2h14V5H5zm0 0V5z"/></svg>
                    <span class="font-medium">Monitoring SPJ</span>
                </a>

                <!-- Peminjaman Ruang Rapat Menu -->
                <a href="{{ route('meeting-room-booking.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 sidebar-active">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-2h2V5q0-.825.588-1.412T7 3h10q.825 0 1.413.588T19 5v14h2v2zm12-2h2V5h-4.5V3.9q1.1.2 1.8 1.025T15 6.85zm-3.287-6.287Q12 12.425 12 12t-.288-.712T11 11t-.712.288T10 12t.288.713T11 13t.713-.288"/></svg>
                    <span class="font-medium">Peminjaman Ruang Rapat</span>
                </a>

                <!-- Setting Menu with Dropdown -->
                {{-- <div class="mt-2">
                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200" onclick="toggleDropdown()">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium flex-1 text-left">Setting</span>
                        <svg class="w-4 h-4 transition-transform duration-200" id="dropdownArrow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Items -->
                    <div id="dropdownMenu" class="hidden pl-8 mt-2 space-y-2">
                        <a href="{{ route('program.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                            <span>Program</span>
                        </a>
                        <a href="{{ route('kro.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>KRO</span>
                        </a>
                        <a href="{{ route('ro.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
                            </svg>
                            <span>RO</span>
                        </a>
                        <a href="{{ route('komponen.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Komponen</span>
                        </a>
                        <a href="{{ route('akun.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Akun</span>
                        </a>
                    </div>
                </div> --}}
            </nav>