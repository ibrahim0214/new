<table>
    <thead>
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Station</th>
            <th rowspan="2">Tahun</th>
            <th rowspan="2">Periode</th>
            <th rowspan="2">Jenis Penilaian</th>
            <th rowspan="2">Nama Mahasiswa</th>
            <th rowspan="2">Nama Dosen</th>
            <th colspan="6">Skor</th>
            <th rowspan="2">Nilai Akhir</th>
            <th rowspan="2">Performance</th>
            <th rowspan="2">Performance Name</th>
            <th rowspan="2">Catatan</th>
        </tr>
        <tr>
            <th>Pengkajian</th>
            <th>Komunikasi</th>
            <th>Diagnosa</th>
            <th>Implementasi</th>
            <th>Evaluasi</th>
            <th>Profesional</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penilaian as $nilai)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $nilai->nama_station }}</td>
                <td>{{ $nilai->tahun_penilaian }}</td>
                <td>{{ $nilai->periode }}</td>
                <td>{{ $nilai->jenis_penilaian }}</td>
                <td>{{ $nilai->nama_mhs }}</td>
                <td>{{ $nilai->nama_dosen }}</td>
                <td>{{ $nilai->skor_s_pengkajian }}</td>
                <td>{{ $nilai->skor_s_komunikasi }}</td>
                <td>{{ $nilai->skor_s_diagnosa }}</td>
                <td>{{ $nilai->skor_s_implementasi }}</td>
                <td>{{ $nilai->skor_s_evaluasi }}</td>
                <td>{{ $nilai->skor_s_profesional }}</td>
                <td>{{ $nilai->nilai_akhir }}</td>
                <td>{{ $nilai->performance_id }}</td>
                <td>{{ $nilai->performance_name }}</td>
                <td>{{ $nilai->catatan }}</td>
            </tr>
            @endforeach
    </tbody>
</table>
