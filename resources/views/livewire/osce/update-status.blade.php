<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">STATION LIST</div>
    </header>

    <!-- Form untuk memilih station -->
    <form wire:submit.prevent="showSelected">
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stations as $station)
                    <tr>
                        <td>
                            <!-- Checkbox akan otomatis ter-check jika statusnya 'show' -->
                            <input type="checkbox" wire:model="selectedStations" value="{{ $station->id }}" {{ $station->status === 'show' ? 'checked' : '' }}>
                        </td>
                        <td>{{ $station->nama_station }}</td>
                        <td>{{ $station->judul }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center text-md text-gray-700">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" type="submit">Show Selected</button>
        </div>
    </form>
</div>