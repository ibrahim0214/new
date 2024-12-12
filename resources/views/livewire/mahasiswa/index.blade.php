<div class="py-16">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DATA MAHASISWA</div>
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
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Mahasiswa" class="input input-bordered w-full max-w-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_mhs as $mhs)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $mhs->nik_mhs }}</td>
                                <td class="">{{ $mhs->nama_mhs }}</td>
                                <td class="text-center">
                                    <x-warning-button wire:click="edit({{ $mhs }})">
                                        <div class="lg:tooltip" data-tip="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </x-warning-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <x-modal name="modalEdit">
                    <div class="p-4">
                        <header class="font-semibold text-center mb-5">EDIT DATA MAHASISWA</header>
                        <form wire:submit.prevent="simpan">
                            <div class="flex mb-3">
                                <label class="label w-1/3">NIM Mahasiswa</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="nik_mhs" class="input input-bordered w-full">
                                </div>
                            </div>
                            <div class="flex mb-5">
                                <label class="label w-1/3">Nama Mahasiswa</label>
                                <div class="w-2/3">
                                    <input type="text" wire:model="nama_mhs" class="input input-bordered w-full">
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
                    @livewire('mahasiswa.form')
                </x-modal>

                <x-modal name="modalImport" :maxWidth=" 'md' ">
                    <div class="p-5">
                        <form wire:submit.prevent="importMhs">
                            <div class="w-full mx-auto py-3 px-4">
                                <div class="text-lg font-semibold text-center mb-5">Import Data Mahasiswa</div>
                                <div class="text-center mb-2">
                                    <input type="file" class="file-input @error('file_mhs') file-input-error @enderror file-input-bordered" wire:model="file_mhs" accept=".xlsx, .xls">
                                    <input type="text" wire:model="username" hidden>
                                    @error('file_mhs')
                                        <div>
                                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-5 flex justify-center gap-3">
                                    <x-warning-button x-on:click="$dispatch('close-modal', 'modalImport')">Batal</x-warning-button>
                                    <x-primary-button wire:loading.remove >Upload</x-primary-button>
                                    <div wire:loading wire:target="file_mhs" class="text-gray-500 text-sm italic">Preparing...</div>
                                    <span wire:loading wire:target="importMhs" class="ms-2 loading loading-spinner loading-md"></span>
                                </div>
                                <div class="text-lg text-center mt-3">
                                    <button wire:click="downloadTemplate" class="btn btn-ghost">Download template</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </x-modal>

                <div class="mt-5">
                    {{ $data_mhs->links() }}
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3 ms-5 flex gap-2">
            <x-app-info-button wire:click="tambah">Tambah Mahasiswa</x-app-info-button>
            <x-app-info-button wire:click="import">Import Excel</x-app-info-button>
        </div>
    </div>
</div>
