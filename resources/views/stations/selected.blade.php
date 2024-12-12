<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Stations</title>
</head>
<body>
    <h1>Selected Stations</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stations as $station)
                <tr>
                    <td>{{ $station->nama_station }}</td>
                    <td>{{ $station->judul }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
