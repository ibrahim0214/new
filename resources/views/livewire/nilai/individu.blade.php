<div class="py-16">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">NILAI INDIVIDU MAHASISWA</div>
    </header>
    <div class="mt-1 mx-auto px-2 lg:px-14 py-2 bg-white dark:bg-gray-800">
        <div class="px-5 border border-gray-400 shadow-lg rounded-lg w-full">
            <div class="p-4">
                <h1 class="text-lg font-semibold">Filter Data</h1>
                <div class="mt-3">
                    <form wire:submit.prevent="filterData">
                        <div class="mb-5 lg:flex">
                            <label class="label w-full lg:w-2/12">Nama Mahasiswa</label>
                            <div class="w-7/12 relative">
                                <input
                                    class="input @error('query') input-error @enderror input-bordered w-full"
                                    type="text"
                                    wire:model.live.debounce.300ms="query"
                                    wire:keydown.escape="resetSearch"
                                    wire:keydown.up="decrementHighlight"
                                    wire:keydown.down="incrementHighlight"
                                    wire:keydown.enter="selectedMahasiswa({{ $mahasiswa[$highlightIndex]->id ?? null }})"
                                    placeholder="Cari mahasiswa.."
                                />
                                @if (!empty($search))
                                    @if(!empty($query))
                                        <div class="absolute w-full max-h-48 overflow-y-auto">
                                            @if($mahasiswa->isNotEmpty())
                                                @foreach ($mahasiswa as $i => $item)
                                                    <div class="px-3 py-2 border border-gray-300 bg-gray-100 hover:bg-gray-300 cursor-pointer dark:text-gray-800" wire:click="selectedMahasiswa({{ $item->id }})">{{ $item->nik_mhs .' - '. $item->nama_mhs }}</div>
                                                @endforeach
                                            @else
                                                <div class="px-3 py-2 border border-gray-300 bg-gray-100 dark:text-gray-800" style="cursor: default !important">Data tidak ditemukan..</div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="hidden">
                            <input type="text" wire:model="nik_mhs">
                        </div>
                        <div class="mb-5 lg:flex">
                            <label class="label w-full lg:w-2/12">Tahun Penilaian</label>
                            <div class="w-full lg:w-7/12">
                                <select wire:model="tahun_penilaian" class="select @error('tahun_penilaian') select-error @enderror select-bordered w-full">
                                    <option value="" hidden>Pilih Tahun</option>
                                    @foreach ($data_tahun as $tahun)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                                </select>
                                @error('tahun_penilaian')
                                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-5 lg:flex">
                            <label class="label w-full lg:w-2/12">Periode</label>
                            <div class="w-full lg:w-7/12">
                                <select wire:model="periode" class="select @error('tahun_penilaian') select-error @enderror select-bordered w-full">
                                    <option value="" hidden>Pilih Periode</option>
                                    @foreach ($data_periode as $periode)
                                        <option value="{{ $periode->slug_periode }}">{{ $periode->periode }}</option>
                                    @endforeach
                                </select>
                                @error('periode')
                                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-start gap-2">
                            <x-primary-button>Filter</x-primary-button>
                            @if ($resetBtn == true)
                                <x-warning-button>Hapus Filter</x-warning-button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @forelse ($data_penilaian as $data_mhs)
            <div class="mt-4 px-5 py-3 text-gray-900 dark:text-gray-100 border border-gray-400 shadow-lg rounded-lg w-full">
                <div class="max-w-2xl">
                    <table class="table w-full">
                        <tr class="bg-gray-200">
                            <td class="font-semibold" style="width: 25%">NIK Mahasiswa</td>
                            <td style="width: 3%">:</td>
                            <td class="font-semibold" style="width: 70%">{{ $data_mhs->nik_mhs }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold" style="width: 25%">Nama Mahasiswa</td>
                            <td style="width: 3%">:</td>
                            <td class="font-semibold" style="width: 70%">{{ $data_mhs->nama_mhs }}</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="font-semibold" style="width: 25%">Tahun Penilaian</td>
                            <td style="width: 3%">:</td>
                            <td class="font-semibold" style="width: 70%">{{ $data_mhs->daftarNilai[0]->tahun_penilaian ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold" style="width: 25%">Periode</td>
                            <td style="width: 3%">:</td>
                            <td class="font-semibold" style="width: 70%">{{ $data_mhs->daftarNilai[0]->periodeName->periode ?? '' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-4">
                    <div>
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th>No. Station</th>
                                    <th>Nama Station</th>
                                    <th>Nilai Akhir</th>
                                    <th>Global Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data_mhs->daftarNilai as $nilai)
                                    <tr>
                                        <td class="text-center">{{ $nilai->no_station }}</td>
                                        <td class="text-center">{{ $nilai->nama_station }}</td>
                                        <td class="text-center">{{ $nilai->nilai_akhir }}</td>
                                        <td class="text-center">{!! $nilai->performance_name !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="mt-4 px-5 py-3 text-gray-900 dark:text-gray-100 border border-gray-400 shadow-lg rounded-lg w-full">
                <div class="flex justify-center">
                    <div class="text-center">Tidak ada data</div>
                </div>
            </div>
        @endforelse
    </div>
</div>
