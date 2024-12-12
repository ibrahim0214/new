<div class="p-4">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="font-semibold text-center mb-5">TAMBAH USER</header>
    <form wire:submit.prevent="addUserForm">
        <div class="flex mb-3">
            <label class="label w-1/3">NIDN/Username</label>
            <div class="w-2/3 relative">
                <div>
                    <input
                        wire:model.live.debounce.500ms="query"
                        wire:keydown.escape="resetSearch"
                        wire:keydown.up="decrementHighlight"
                        wire:keydown.down="incrementHighlight"
                        wire:keydown.enter="selectedDosen({{ $dosen[$highlightIndex]->id ?? null }})"
                        placeholder="Cari dosen.."
                        type="text"
                        class="input input-bordered w-full" />
                        @error('query')
                            <span class="label-text-alt text-pink-600">{{ $message }}</span>
                        @enderror
                </div>
                @if (!empty($search))
                    @if(!empty($query))
                        <div class="absolute w-full max-h-48 overflow-y-auto">
                            @if($dosen->isNotEmpty())
                                @foreach ($dosen as $item)
                                    <div wire:click="selectedDosen({{ $item->id }})" class="px-3 py-2 border border-gray-300 bg-gray-100 hover:bg-gray-300 cursor-pointer dark:text-gray-800">
                                        {{ $item->nik_dosen . ' - ' . $item->nama_dosen }}
                                    </div>
                                @endforeach
                            @else
                                <div class="px-3 py-2 border border-gray-300 bg-gray-100 dark:text-gray-800">Data tidak ditemukan..</div>
                            @endif
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="flex mb-3">
            <label class="label w-1/3">Nama Lengkap</label>
            <div class="w-2/3">
                <input type="text" wire:model="name" class="input input-bordered w-full" readonly>
            </div>
        </div>
        <div class="flex mb-3">
            <label class="label w-1/3">Email</label>
            <div class="w-2/3">
                <input type="text" wire:model="email" class="input @error('email') input-error @enderror input-bordered w-full">
                @error('email')
                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex mb-3">
            <label class="label w-1/3">Role</label>
            <div class="w-2/3">
                <select wire:model="role" class="select @error('role') select-error @enderror select-bordered w-full">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                @error('role')
                    <span class="label-text-alt text-pink-600">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex mb-5">
            <label class="label w-1/3">Password</label>
            <div class="w-2/3">
                <input type="password" wire:model="password" class="input @error('password') input-error @enderror input-bordered w-full">
                @error('password')
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
