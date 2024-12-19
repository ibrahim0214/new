<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">UPDATE STATION</div>
    </header>

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
                            <input type="checkbox" wire:model="selectedStations" value="{{ $station->id }}">
                        </td>
                        <td>{{ $station->nama_station }}</td>
                        <td>{{ $station->judul }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-4">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md" type="submit">Show Selected</button>
        </div>
    </form>
</div>
