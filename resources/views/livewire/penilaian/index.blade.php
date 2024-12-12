<div class="py-16">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DATA PENILAIAN</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="pt-5 px-5">
            <div class="px-3 border border-gray-300 rounded-lg">
                <details class="collapse collapse-arrow">
                    <summary class="collapse-title text-xl font-medium"><h1 class="text-lg font-semibold">Filter Data Nilai</h1></summary>
                    <div class="collapse-content">
                        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-16">
                            <div class="p-2">
                                <div class="flex mb-4">
                                    <label class="label w-4/12">
                                        <span class="label-text">Tahun Penilaian</span>
                                    </label>
                                    <div class="w-8/12">
                                        <select wire:model="tahun_penilaian" class="select select-bordered w-full">
                                            <option value="" hidden>Pilih Tahun</option>
                                            @foreach ($data_tahun as $tahun)
                                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex">
                                    <label class="label w-4/12">
                                        <span class="label-text">Periode Penilaian</span>
                                    </label>
                                    <div class="w-8/12">
                                        <select wire:model="periode" class="select select-bordered w-full">
                                            <option value="" hidden>Pilih Periode</option>
                                            <option value="smt_ganjil">Semester Ganjil</option>
                                            <option value="smt_genap">Semester Genap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="flex mb-4">
                                    <label class="label w-4/12">
                                        <span class="label-text">Station</span>
                                    </label>
                                    <div class="w-8/12">
                                        <select wire:model="station_id" class="select select-bordered w-full">
                                            <option value="" hidden>Pilih Station</option>
                                            @foreach ($data_station as $station)
                                                <option value="{{ $station->id }}">{{ $station->nama_station }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex">
                                    <label class="label w-4/12">
                                        <span class="label-text">Global Performance</span>
                                    </label>
                                    <div class="w-8/12">
                                        <select wire:model="performance_id" class="select select-bordered w-full">
                                            <option value="" hidden>Pilih Performance</option>
                                            @foreach ($data_performance as $item)
                                                <option value="{{ $item->performance_id }}">{{ $item->getAttributes()['performance_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 flex my-5 gap-3">
                            <x-primary-button wire:click="applyFilter">Filter</x-primary-button>
                            @if ($clearFilter == false)
                                <x-warning-button wire:click="resetFilter">Clear Filter</x-warning-button>
                            @endif
                            <x-primary-button wire:click="downloadExcel">Download Excel</x-primary-button>
                        </div>
                    </div>
                </details>
            </div>
        </div>
        <div class="mt-4 pt-5 pb-1 px-5 text-gray-900 dark:text-gray-100">
            <div class="mb-3 flex justify-between">
                <div class="flex gap-2 items-center w-full">
                    <select wire:model.live="perPage" class="select select-bordered max-w-20">
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                    <div class="max-w-sm hidden md:block">
                        <label class="text-sm">Entries per page</label>
                    </div>
                </div>
                {{-- <input type="text" wire:model.live.debounce.500ms="search" placeholder="Ketikkan kata kunci..." class="input input-bordered w-full max-w-sm"> --}}
            </div>
            <div class="overflow-x-auto">
                <table class="table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama Station</th>
                            <th rowspan="2">Jenis Penilaian</th>
                            <th rowspan="2">Nama Mahasiswa</th>
                            <th rowspan="2">Penguji</th>
                            <th colspan="6">Skor Penilaian</th>
                            <th rowspan="2">Nilai Akhir</th>
                            <th rowspan="2">Global Performance</th>
                        </tr>
                        <tr>
                            <th>Kom.</th>
                            <th>Pengk.</th>
                            <th>Diag.</th>
                            <th>Impl.</th>
                            <th>Eval.</th>
                            <th>Prof.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_penilaian as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nama_station }}</td>
                                <td class="text-center">{{ $item->jenis_penilaian }}</td>
                                <td class="">{{ $item->nama_mhs }}</td>
                                <td class="">{{ $item->nama_dosen }}</td>
                                <td class="text-center">{{ $item->skor_s_komunikasi }}</td>
                                <td class="text-center">{{ $item->skor_s_pengkajian }}</td>
                                <td class="text-center">{{ $item->skor_s_diagnosa }}</td>
                                <td class="text-center">{{ $item->skor_s_implementasi }}</td>
                                <td class="text-center">{{ $item->skor_s_evaluasi }}</td>
                                <td class="text-center">{{ $item->skor_s_profesional }}</td>
                                <td class="text-center">{{ $item->nilai_akhir }}</td>
                                <td class="text-center">{!! $item->performance->performance_name !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-5">
                    {{ $data_penilaian->links() }}
                </div>
            </div>

            <div class="overflow-x-auto">
                {{-- <table class="table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2">Nama Mahasiswa</th>
                            @foreach ($station_penilaian as $item)
                                <th colspan="3">{{ $item }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($station_penilaian as $item)
                                <th>Nilai Akhir</th>
                                <th>Nilai Rubrik</th>
                                <th>Performance</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_penilaian as $data)
                            <tr>
                                <td class="">{{ $data->nama_mhs }}</td>
                                @foreach ($station_penilaian as $item)
                                    <td class="text-center">{{ $data->nilai_akhir ?? '-' }}</td>
                                    <td class="text-center">{{ $data->nilai_rubrik ?? '-' }}</td>
                                    <td class="text-center">{{ $data->performance_name ?? '-' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>
