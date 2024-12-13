<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DASHBOARD OSCE</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="py-4 px-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse ($data as $item)
                <div wire:click="penilaian({{ $item->id }})"
                    class="border border-gray-400 bg-sky-600 items-center text-center py-2 px-2 text-white rounded-md hover:bg-sky-700 cursor-pointer">
                    <h4 class="font-semibold">{{ $item->nama_station }}</h4>
                    <div>
                        <span>{{ $item->judul }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center text-md text-gray-700">
                    <span>Data masih kosong</span>
                </div>
            @endforelse
        </div>
        <div class="text-center text-md text-gray-700">
            {{-- ini classnya ku samain sama yg di primary-button.blade.php --}}
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                href="{{ route('update-station') }}">Update Station</a>

        </div>
    </div>
</div>
