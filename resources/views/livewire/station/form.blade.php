<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">MEMBUAT MODEL STATION</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="pt-5 pb-1 px-5 text-gray-900 dark:text-gray-100">
            <form wire:submit.prevent="simpan">
                <div class="mb-2 grid grid-cols-2 gap-5">
                    <label class="form-control w-full">
                        <div class="label">
                          <span class="label-text">Nomor Station</span>
                        </div>
                        <input wire:model="no_station" type="text" placeholder="Nomor station" class="input @error('no_station') input-error @enderror input-bordered w-full" />
                        @error('no_station')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Nama Station</span>
                        </div>
                        <input wire:model="nama_station" type="text" placeholder="Nama station" class="input @error('nama_station') input-error @enderror input-bordered w-full" />
                        @error('nama_station')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                </div>
                <div class="mb-2 grid grid-cols-2 gap-5">
                    <label class="form-control w-full">
                        <div class="label">
                          <span class="label-text">Judul Station</span>
                        </div>
                        <input wire:model="judul" type="text" placeholder="Judul station" class="input @error('judul') input-error @enderror input-bordered w-full" />
                        @error('judul')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                          <span class="label-text">Waktu yang dibutuhkan</span>
                        </div>
                        <input wire:model="waktu" type="text" placeholder="misal: 10 menit" class="input @error('waktu') input-error @enderror input-bordered w-full" />
                        @error('waktu')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                </div>
                <label class="mb-2 form-control w-full">
                    <div class="label">
                      <span class="label-text">Tujuan</span>
                    </div>
                    <input wire:model="tujuan" type="text" placeholder="Tujuan" class="input @error('tujuan') input-error @enderror input-bordered w-full" />
                    @error('tujuan')
                        <div class="label">
                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <label class="mb-4 form-control">
                    <div class="label">
                      <span class="label-text">Kompetensi</span>
                    </div>
                    <x-input-tinymce wire:model="kompetensi" class="@error('kompetensi') textarea textarea-error @enderror"></x-input-tinymce>
                    @error('kompetensi')
                        <div class="label">
                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <label class="mb-4 form-control">
                    <div class="label">
                      <span class="label-text">Kategori Penilaian</span>
                    </div>
                    <x-input-tinymce wire:model="kategori"></x-input-tinymce>
                    @error('kategori')
                        <div class="label">
                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <label class="mb-4 form-control">
                    <div class="label">
                      <span class="label-text">Petunjuk/Instruksi Penguji</span>
                    </div>
                    <x-input-tinymce wire:model="instruksi_penguji"></x-input-tinymce>
                    @error('instruksi_penguji')
                        <div class="label">
                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <label class="mb-4 form-control">
                    <div class="label">
                      <span class="label-text">Petunjuk/Instruksi Peserta</span>
                    </div>
                    <x-input-tinymce wire:model="instruksi_peserta"></x-input-tinymce>
                    @error('instruksi_peserta')
                        <div class="label">
                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <div class="mt-5 mb-5 flex gap-3">
                    <x-app-info-button>Simpan</x-app-info-button>
                    <x-warning-button wire:click="kembali">Kembali</x-warning-button>
                </div>
            </form>
        </div>
    </div>
</div>
