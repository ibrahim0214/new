<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">FORM PENILAIAN</div>
    </header>
    <div class="mt-2 py-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="text-gray-900 dark:text-gray-100 border border-gray-300 rounded-lg">
            <div class="ms-4 mt-2">
                <h5 class="font-semibold text-gray-600">{{ $data_station->nama_station }}</h5>
            </div>
            <details class="collapse collapse-arrow">
                <summary class="collapse-title text-xl font-medium"><h1 class="text-xl font-semibold">Kriteria Penilaian</h1></summary>
                <div class="collapse-content">
                    <div class="overflow-x-auto">
                        <table class="table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Kompetensi</th>
                                    <th colspan="4">Skor</th>
                                    <th rowspan="2">Bobot</th>
                                </tr>
                                <tr>
                                    <th class="text-center">0</th>
                                    <th class="text-center">1</th>
                                    <th class="text-center">2</th>
                                    <th class="text-center">3</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 10pt">
                                @foreach ($data_station->kriteria as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kompetensi }}</td>
                                    <td class="lead">{!! $item->skor_0 !!}</td>
                                    <td class="lead">{!! $item->skor_1 !!}</td>
                                    <td class="lead">{!! $item->skor_2 !!}</td>
                                    <td class="lead">{!! $item->skor_3 !!}</td>
                                    <td>{{ $item->bobot }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </details>
        </div>
        <form wire:submit.prevent="simpan">
            <div class="mt-5 pt-4 pb-3 px-5 text-gray-900 dark:text-gray-100 border border-gray-300 rounded-lg">
                <h1 class="text-xl font-semibold">Form Penilaian</h1>
                <div class="mt-5">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Tahun Penilaian</span>
                        </label>
                        <div class="lg:w-9/12">
                            <select wire:model="tahun_penilaian" class="select @error('tahun_penilaian') select-error @enderror select-bordered w-full lg:w-48">
                                @foreach ($data_tahun as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Periode Penilaian</span>
                        </label>
                        <div class="lg:w-6/12">
                            <select class="select @error('periode') select-error @enderror select-bordered w-full lg:w-48" wire:model.live="periode">
                                <option value="" hidden>Pilih periode</option>
                                @foreach ($data_periode as $periode)
                                    <option value="{{ $periode->slug_periode }}">{{ $periode->periode }}</option>
                                @endforeach
                            </select>
                            @error('periode')
                                <div class="label">
                                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Jenis Penilaian</span>
                        </label>
                        <div class="lg:w-6/12">
                            <select class="select @error('jenis_penilaian') select-error @enderror select-bordered w-full lg:w-48" wire:model.live="jenis_penilaian">
                                <option value="reguler">Reguler</option>
                                <option value="perbaikan">Perbaikan</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if($perlu_perbaikan == true)
                    <div class="mt-3">
                        <div class="lg:flex lg:w-full">
                            <label class="label lg:w-3/12">
                                <span class="label-text">Perbaikan ke</span>
                            </label>
                            <div class="lg:w-6/12">
                                <input class="input @error('jenis_penilaian') input-error @enderror input-bordered w-full lg:w-48" wire:model="perbaikan_ke" required/>
                                @error('perbaikan_ke')
                                    <div class="label">
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
                <div class="mt-3" hidden>
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Tanggal Penilaian</span>
                        </label>
                        <div class="lg:w-6/12">
                            <input type="date" class="input @error('tgl_penilaian') input-error @enderror input-bordered w-full lg:w-48 text-sm" wire:model="tgl_penilaian" />
                        </div>
                        @error('tgl_penilaian')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">NIM/Nama Mahasiswa</span>
                        </label>
                        <div class="flex gap-4 lg:w-6/12">
                            <div class="w-4/12">
                                <input type="text" class="input input-bordered w-full bg-gray-100" wire:model="nik_mhs" readonly/>
                                @error('query')
                                    <div class="label">
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="w-8/12 relative">
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
                    </div>

                </div>
                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Nama Dosen Penguji</span>
                        </label>
                        <div class="w-full lg:w-6/12 flex gap-6">
                            <input type="text" class="input input-bordered w-7/12" wire:model.live="nik_dosen" hidden/>
                            <input type="text" class="input input-bordered w-7/12 text-sm bg-gray-100" wire:model.live="nama_dosen" readonly/>
                            <input type="text" class="input input-bordered w-5/12 text-sm bg-gray-100" wire:model.live="gelar_belakang" readonly/>
                        </div>
                    </div>
                </div>

                @foreach ($data_station->kriteria as $kriteria)
                        <div class="mt-3">
                            <div class="lg:flex lg:w-full">
                                <label class="label lg:w-3/12">
                                    <span class="label-text">{{ $kriteria->daftarKompetensi->label }}</span>
                                </label>
                                <div class="w-full lg:w-4/12 flex gap-3">
                                    <select class="select select-bordered w-5/12 lg:w-4/12" wire:model.live="{{ $kriteria->daftarKompetensi->slug_kompetensi }}" required>
                                        <option value="" hidden>Pilih nilai</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <label class="label lg:w-2/12 flex justify-end">
                                        <span class="label-text">Bobot</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-5/12 lg:w-4/12 text-sm bg-gray-100" wire:model.live="{{ $kriteria->daftarKompetensi->slug_bobot }}" readonly/>
                                </div>
                            </div>
                        </div>
                @endforeach

                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Nilai Akhir</span>
                        </label>
                        <div class="flex w-full lg:w-4/12">
                            <input type="text" class="input input-bordered w-5/12 lg:w-4/12 bg-gray-100" wire:model="nilai_akhir" readonly/>
                            <div class="ms-2 label" wire:loading wire:target="skor_s_komunikasi, skor_s_pengkajian, skor_s_diagnosa, skor_s_implementasi, skor_s_evaluasi, skor_s_profesional">
                                <span class="loading loading-spinner loading-md"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Global Permormance</span>
                        </label>
                        <div class="w-full lg:w-6/12">
                            <select class="select @error('performance_id') select-error @enderror select-bordered w-full" wire:model="performance_id">
                                <option hidden>Pilih performance</option>
                                @foreach ($data_performance as $item)
                                    <option value="{{ $item->performance_id }}">{{ $item->getAttributes()['performance_name'] }}</option>
                                @endforeach
                            </select>
                            @error('performance_id')
                                <div class="label">
                                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="lg:flex lg:w-full">
                        <label class="label lg:w-3/12">
                            <span class="label-text">Catatan</span>
                        </label>
                        <div class="w-full lg:w-6/12">
                            <textarea wire:model="catatan" class="textarea textarea-bordered @error('catatan') textarea-error @enderror w-full h-24"></textarea>
                            @error('catatan')
                                <div class="label">
                                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="my-7">
                    <x-primary-button>Simpan</x-primary-button>
                    <x-warning-button wire:click="kembali">Kembali</x-warning-button>
                </div>
            </div>
        </form>

        <!-- Modal warning utk mahasiswa yang sudah dinilai -->
        <x-modal name="modalWarning" :maxWidth=" 'sm' ">
            <div class="p-5">
                <div class="w-full mx-auto py-3 px-4">
                    <div class="text-center">
                        <div class="text-2xl text-orange-600">Peringatan!!</div>
                        <div class="mt-4">Mahasiswa ini sudah pernah dinilai dengan nilai akhir <span class="font-semibold">{{ $hasil_penilaian ?? '' }}</span>. Apakah anda ingin melanjutkan dengan penilaian perbaikan?</div>
                    </div>
                    <div class="mt-5 flex justify-center gap-3">
                        <x-warning-button wire:click="konfirmasiPerbaikan">Ya</x-warning-button>
                    </div>
                </div>
            </div>
        </x-modal>
        <!-- Modal warning utk mahasiswa yang sudah dinilai -->

        <!-- Modal untuk konfirmasi nilai yg diinput -->
        <x-modal name="modalKonfirmasi" :maxWidth=" 'md' ">
            <div class="p-5">
                <div class="w-full mx-auto py-3 px-4">
                    <div class="text-center">
                        <div class="text-2xl text-orange-600">Konfirmasi!!</div>
                        <div class="mt-4">Apakah Anda yakin akan memberikan nilai ini kepada <span class="font-semibold">{{ $query ?? '' }}</span>?</div>
                    </div>
                    @foreach ($skorPenilaian as $key => $value)
                        <div class="mt-1 flex">
                            <label class="w-7/12">{{ $key }}</label>
                            <label class="w-1/12">:</label>
                            <div class="w-3/12 font-semibold">{{ $value }}</div>
                        </div>
                    @endforeach
                    <div class="mt-6 flex justify-center gap-3">
                        <x-warning-button x-on:click="$dispatch('close-modal', 'modalKonfirmasi')">Tutup</x-warning-button>
                        <x-primary-button wire:click="simpanNilai">Ya, simpan</x-primary-button>
                    </div>
                </div>
            </div>
        </x-modal>
        <!-- Modal untuk konfirmasi nilai yg diinput -->

    </div>
</div>

