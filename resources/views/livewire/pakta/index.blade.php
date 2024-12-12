<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DASHBOARD OSCE</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="py-4 px-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse ($data as $item)
                <div wire:click="penilaian({{ $item->no_station }})" class="border border-gray-400 bg-sky-600 items-center text-center py-2 px-2 text-white rounded-md hover:bg-sky-700 cursor-pointer">
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
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
</div>
