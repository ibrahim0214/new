<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DETAIL STATION</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="w-full p-7 text-gray-900 dark:text-gray-100">
            <table class="table-striped" style="font-size: 11pt">
                <tr>
                    <td class="w-8 lg:w-2">1</td>
                    <td class="w-36 lg:w-5">No. Station</td>
                    <td class="w-80">{{ $data_station->no_station }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama Station</td>
                    <td>{{ $data_station->nama_station }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Judul</td>
                    <td>{{ $data_station->judul }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Durasi/Waktu</td>
                    <td>{{ $data_station->waktu }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Tujuan</td>
                    <td>{{ $data_station->tujuan }}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Kompetensi</td>
                    <td>{!! $data_station->kompetensi !!}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Kategori</td>
                    <td>{!! $data_station->kategori !!}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Instruksi Penguji</td>
                    <td>{!! $data_station->instruksi_penguji !!}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Instruksi Peserta</td>
                    <td>{!! $data_station->instruksi_peserta !!}</td>
                </tr>
            </table>
            <div class="mt-4 flex gap-2">
                <x-app-primary-button wire:click="edit({{ $data_station->no_station }})">Edit</x-app-primary-button>
                <x-warning-button wire:click="kembali">Kembali</x-warning-button>
            </div>
        </div>
        <div class="mt-5 w-full p-4 border border-gray-300 rounded-lg">
            <h1 class="text-xl font-semibold">Kriteria Penilaian</h1>
            <table class="mt-4 table-hover">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Kompetensi</th>
                        <th colspan="4">Skor</th>
                        <th rowspan="2">Bobot</th>
                        <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th class="text-center ">0</th>
                        <th class="text-center">1</th>
                        <th class="text-center">2</th>
                        <th class="text-center">3</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11pt">
                    @forelse ($data_kriteria as $kriteria)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kriteria->kompetensi }}</td>
                            <td class="lead">{!! $kriteria->skor_0 !!}</td>
                            <td class="lead">{!! $kriteria->skor_1 !!}</td>
                            <td class="lead">{!! $kriteria->skor_2 !!}</td>
                            <td class="lead">{!! $kriteria->skor_3 !!}</td>
                            <td>{{ $kriteria->bobot }}</td>
                            <td>
                                <x-warning-button wire:click="editKriteria({{ $kriteria }})">
                                    <div class="lg:tooltip" data-tip="Edit">
                                        <span class="fa-regular fa-pen-to-square"></span>
                                    </div>
                                </x-warning-button>
                                <x-danger-button wire:click="mauDihapus({{ $kriteria }})">
                                    <div class="lg:tooltip" data-tip="Hapus">
                                        <span class="fa-regular fa-trash-can"></span>
                                    </div>
                                </x-danger-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <x-modal name="modalHapus" :maxWidth=" 'sm' ">
                <div class="p-5">
                    <form wire:submit="hapusKriteria">
                        <div class="w-full mx-auto py-3 px-4">
                            <div class="text-center">
                                <span>Yakin ingin menghapus data ini?</span><br>
                                <span class="text-lg font-semibold">{{ $kriteriaSelected->kompetensi ?? '' }}</span>
                            </div>
                            <div class="mt-5 flex justify-center gap-3">
                                <x-warning-button x-on:click="$dispatch('close-modal', 'modalHapus')">Batal</x-warning-button>
                                <x-danger-button>Hapus</x-danger-button>
                            </div>
                        </div>
                    </form>
                </div>
            </x-modal>

            <div class="mt-5 flex gap-2">
                <x-app-primary-button wire:click="tambahKriteria">Tambah Kriteria</x-app-primary-button>
            </div>
        </div>
    </div>
</div>
