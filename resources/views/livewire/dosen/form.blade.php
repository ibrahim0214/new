<div class="p-4">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="font-semibold text-center mb-5">TAMBAH DOSEN</header>
    <form wire:submit.prevent="addDosenForm">
        <div class="flex mb-3">
            <label class="label w-1/3">NIDN Dosen</label>
            <div class="w-2/3">
                <input type="text" wire:model="nik_dosen" class="input @error('nik_dosen') input-error @enderror input-bordered w-full">
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
                <input type="text" wire:model="nama_dosen" class="input @error('gelar_depan') @enderror input-bordered w-full">
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
            <x-warning-button x-on:click="$dispatch('close-modal', 'modalTambah')">Tutup</x-warning-button>
            <x-primary-button>Simpan</x-primary-button>
        </div>
    </form>
</div>
