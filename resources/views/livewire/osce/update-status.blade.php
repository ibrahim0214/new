<div>
    <h1>Station List</h1>

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
                @foreach($stations as $station)
                    <tr>
                        <td>
                            <input 
                                type="checkbox" 
                                wire:model="selectedStations" 
                                value="{{ $station->id }}" 
                            >
                        </td>
                        <td>{{ $station->nama_station }}</td>
                        <td>{{ $station->judul }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit">Show Selected</button>
    </form>
</div>
