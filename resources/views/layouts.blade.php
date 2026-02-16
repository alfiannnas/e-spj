<div class="bg-white shadow-sm border-b border-gray-200 px-8 py-4">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h2>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">{{ auth()->user()->email ?? 'User' }}</span>
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                <span class="text-white font-bold">{{ substr(auth()->user()->email ?? 'U', 0, 1) }}</span>
            </div>
        </div>
    </div>
</div>