<div class="py-16">
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">EDIT KRITERIA</div>
    </header>
    <div class="mt-2 pb-3 mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
        <div class="pt-5 pb-1 px-5 text-gray-900 dark:text-gray-100">
            <form wire:submit.prevent="formKriteria">
                <div class="w-full mx-auto py-3 px-4">
                    <label class="mb-3 form-control w-full">
                        <div class="label">
                            <span class="label-text">Kompetensi</span>
                        </div>
                        <select wire:model="kompetensi_id" class="select @error('kompetensi_id') select-error @enderror select-bordered w-full lg:w-6/12">
                            <option hidden>Pilih kompetensi</option>
                            @forelse ($data_kompetensi as $item)
                                <option value="{{ $item['kompetensi_id'] }}">{{ $item['kompetensi'] }}</option>
                            @empty
                                <option value="">Data kosong</option>
                            @endforelse
                        </select>
                        @error('kompetensi_id')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="mb-3 form-control w-full">
                        <div class="label">
                            <span class="label-text">Kriteria Skor 0</span>
                        </div>
                        <x-input-tinymce wire:model="skor_0"></x-input-tinymce>
                        @error('skor_0')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="mb-3 form-control w-full">
                        <div class="label">
                            <span class="label-text">Kriteria Skor 1</span>
                        </div>
                        <x-input-tinymce wire:model="skor_1"></x-input-tinymce>
                        @error('skor_1')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="mb-3 form-control w-full">
                        <div class="label">
                            <span class="label-text">Kriteria Skor 2</span>
                        </div>
                        <x-input-tinymce wire:model="skor_2"></x-input-tinymce>
                        @error('skor_2')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="mb-3 form-control w-full">
                        <div class="label">
                            <span class="label-text">Kriteria Skor 3</span>
                        </div>
                        <x-input-tinymce wire:model="skor_3"></x-input-tinymce>
                        @error('skor_3')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="mb-10 form-control w-full">
                        <div class="label">
                            <span class="label-text">Bobot</span>
                        </div>
                        <input wire:model="bobot" class="input @error('bobot') input-error @enderror input-bordered w-full lg:w-2/12">
                        @error('bobot')
                            <div class="label">
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <div class="mt-5 flex justify-start gap-3">
                        <x-primary-button>Simpan</x-primary-button>
                        <x-warning-button wire:click="kembali">Kembali</x-warning-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
