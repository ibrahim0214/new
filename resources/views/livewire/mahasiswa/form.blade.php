<div class="p-4">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="font-semibold text-center mb-5">TAMBAH DATA MAHASISWA</header>
    <form wire:submit.prevent="addMhsForm">
        <div class="flex mb-3">
            <label class="label w-1/3">NIM Mahasiswa</label>
            <div class="w-2/3">
                <input type="text" wire:model="nik_mhs" class="input @error('nik_mhs') input-error @enderror input-bordered w-full">
                @error('nik_mhs')
                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex mb-6">
            <label class="label w-1/3">Nama Mahasiswa</label>
            <div class="w-2/3">
                <input type="text" wire:model="nama_mhs" class="input @error('gelar_depan') @enderror input-bordered w-full">
                @error('nama_mhs')
                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex justify-center gap-2 mt-3 mb-5">
            <x-warning-button x-on:click="$dispatch('close-modal', 'modalTambah')">Tutup</x-warning-button>
            <x-primary-button>Simpan</x-primary-button>
        </div>
    </form>
</div>
