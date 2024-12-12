<div class="py-16">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DATA DOSEN</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="pt-5 pb-1 px-5 text-gray-900 dark:text-gray-100">
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
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Dosen" class="input input-bordered w-full max-w-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIDN</th>
                            <th>Gelar Depan</th>
                            <th>Nama Dosen</th>
                            <th>Gelar Belakang</th>
                            <th>Jabatan</th>
                            <th>Pendidikan</th>
                            <th>Perguruan Tinggi</th>
                            <th>Program Studi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $dosen)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $dosen->nik_dosen }}</td>
                                <td class="text-center">{{ $dosen->gelar_depan }}</td>
                                <td class="">{{ $dosen->nama_dosen }}</td>
                                <td class="text-center">{{ $dosen->gelar_belakang }}</td>
                                <td class="text-center">{{ $dosen->jabatan_akademik }}</td>
                                <td class="text-justify">{{ $dosen->pendidikan }}</td>
                                <td class="text-justify">{!! $dosen->perguruan_tinggi !!}</td>
                                <td class="text-justify">{!! $dosen->program_studi !!}</td>
                                <td class="text-center">
                                    <x-warning-button wire:click="edit({{ $dosen }})">
                                        <div class="lg:tooltip" data-tip="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </x-warning-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <x-modal name="modalEdit">
                    <div class="p-4">
                        <header class="font-semibold text-center mb-5">EDIT DATA DOSEN</header>
                        <form wire:submit.prevent="update">
                            <div class="flex mb-3">
                                <label class="label w-1/3">NIDN Dosen</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="nik_dosen" class="input input-bordered w-full">
                                    @error('nik_dosen')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-3">
                                <label class="label w-1/3">Gelar Depan</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="gelar_depan" class="input @error('gelar_depan') input-error @enderror input-bordered w-full">
                                    @error('gelar_depan')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-3">
                                <label class="label w-1/3">Nama Dosen</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="nama_dosen" class="input @error('nama_dosen') input-error @enderror input-bordered w-full">
                                    @error('nama_dosen')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-3">
                                <label class="label w-1/3">Gelar Belakang</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="gelar_belakang" class="input @error('gelar_belakang') input-error @enderror input-bordered w-full">
                                    @error('gelar_belakang')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-3">
                                <label class="label w-1/3">Jabatan Akademik</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="jabatan_akademik" class="input @error('jabatan_akademik') input-error @enderror input-bordered w-full">
                                    @error('jabatan_akademik')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-3">
                                <label class="label w-1/3">Pendidikan Terakhir</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="pendidikan" class="input @error('pendidikan') input-error @enderror input-bordered w-full">
                                    @error('pendidikan')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-3">
                                <label class="label w-1/3">Perguruan Tinggi</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="perguruan_tinggi" class="input @error('perguruan_tinggi') input-error @enderror input-bordered w-full">
                                    @error('perguruan_tinggi')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex mb-5">
                                <label class="label w-1/3">Program Studi</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="program_studi" class="input @error('program_studi') input-error @enderror input-bordered w-full">
                                    @error('program_studi')
                                        <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-center gap-2 mt-3 mb-5">
                                <x-warning-button x-on:click="$dispatch('close-modal', 'modalEdit')">Tutup</x-warning-button>
                                <x-primary-button>Simpan</x-primary-button>
                            </div>
                        </form>
                    </div>
                </x-modal>

                <x-modal name="modalTambah">
                    @livewire('dosen.form')
                </x-modal>

                <div class="mt-5">
                    {{ $data->links() }}
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3 ms-5">
            <x-app-info-button wire:click="tambah">Tambah Dosen</x-app-info-button>
        </div>
    </div>
</div>
