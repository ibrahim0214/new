<div class="py-16">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DATA STATION</div>
    </header>
    <div class="pt-3 mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="mt-3 mb-1 ms-5">
            <x-app-info-button wire:click="tambah">Tambah Station</x-app-info-button>
        </div>
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
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Station" class="input input-bordered w-full max-w-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="table-hover">
                    <thead>
                        <tr>
                            <th>No. Station</th>
                            <th>Nama Station</th>
                            <th>Judul Station</th>
                            <th>Durasi Waktu</th>
                            <th>Tujuan</th>
                            <th>Kompetensi</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 11pt">
                        @forelse ($stations as $station)
                            <tr wire:key="{{ $station->id }}">
                                <td class="text-center">{{ $station->no_station }}</td>
                                <td class="">{{ $station->nama_station }}</td>
                                <td class="text-center">{{ $station->judul }}</td>
                                <td class="text-center">{{ $station->waktu }}</td>
                                <td class="lead">{{ $station->tujuan }}</td>
                                <td class="lead">{!! $station->kompetensi !!}</td>
                                <td class="lead">{!! $station->kategori !!}</td>
                                <td class="text-center">
                                    {{-- <x-warning-button wire:click="edit({{ $station->id }})" title="Edit"><i class="fa-regular fa-pen-to-square"></i></x-warning-button> --}}
                                    <x-primary-button wire:click="detail({{ $station->no_station }})">
                                        <div class="lg:tooltip" data-tip="Detail">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </x-primary-button>
                                    <x-danger-button wire:click="mauDihapus({{ $station }})" title="Hapus">
                                        <div class="lg:tooltip" data-tip="Hapus">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </div>
                                    </x-danger-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <x-modal name="modalHapus" :maxWidth=" 'sm' ">
                    <div class="p-5">
                        <form wire:submit="hapusData">
                            <div class="w-full mx-auto py-3 px-4">
                                <div class="text-center">
                                    <span>Yakin ingin menghapus data ini?</span><br>
                                    <span class="text-3xl">{{ $stationSelected->nama_station ?? '' }}</span>
                                </div>
                                <div class="mt-5 flex justify-center gap-3">
                                    <x-warning-button x-on:click="$dispatch('close-modal', 'modalHapus')">Batal</x-warning-button>
                                    <x-danger-button>Hapus</x-danger-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </x-modal>

                <x-modal name="modalGagalHapus" :maxWidth=" 'sm' ">
                    <div class="p-5">
                        <div class="w-full mx-auto py-3 px-4">
                            <div class="text-center">
                                <span>Anda tidak dapat menghapus Station yang sudah ada data nilainya..</span><br>
                            </div>
                            <div class="mt-5 flex justify-center gap-3">
                                <x-warning-button x-on:click="$dispatch('close-modal', 'modalGagalHapus')">Tutup</x-warning-button>
                            </div>
                        </div>
                    </div>
                </x-modal>

                <div class="mt-5">
                    {{ $stations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
