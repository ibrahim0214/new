<div class="py-16">
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div>
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">DATA USER</div>
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
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari User" class="input input-bordered w-full max-w-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username/NIDN</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $user->username }}</td>
                                <td class="">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->role }}</td>
                                <td class="text-center">
                                    <x-warning-button wire:click="editUser({{ $user }})">
                                        <div class="lg:tooltip" data-tip="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </x-warning-button>
                                    <x-danger-button wire:click="mauHapus({{ $user }})">
                                        <div class="lg:tooltip" data-tip="Hapus">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </div>
                                    </x-danger-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <x-modal name="modalHapus" :maxWidth=" 'sm' ">
                    <div class="p-5">
                        <form wire:submit="hapusUser">
                            <div class="w-full mx-auto py-3 px-4">
                                <div class="text-center">
                                    <span>Yakin ingin menghapus user ini?</span><br>
                                    <span class="text-3xl">{{ $selectedUser->name ?? '' }}</span>
                                </div>
                                <div class="mt-5 flex justify-center gap-3">
                                    <x-warning-button x-on:click="$dispatch('close-modal', 'modalHapus')">Batal</x-warning-button>
                                    <x-danger-button>Hapus</x-danger-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </x-modal>

                <x-modal name="modalEdit">
                    <div class="p-4">
                        <header class="font-semibold text-center mb-5">EDIT DATA USER</header>
                        <form wire:submit.prevent="editUserForm">
                            <div class="flex mb-3">
                                <label class="label w-1/3">NIDN/Username</label>
                                <div class="w-2/3 relative">
                                    <input type="text" wire:model="username" class="input input-bordered w-full" readonly>
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
                                    <input type="password" wire:model="password" class="input @error('password') input-error @enderror input-bordered w-full" placeholder="Kosongkan jika tidak ingin mengganti password">
                                    @error('password')
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
                    @livewire('user.form')
                </x-modal>

                <div class="mt-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3 ms-5">
            <x-app-info-button wire:click="addUser">Tambah User</x-app-info-button>
        </div>
    </div>
</div>
