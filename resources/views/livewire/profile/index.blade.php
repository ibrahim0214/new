<div class="py-16">
    {{-- <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 bg-white opacity-60 justify-center items-center" style="z-index: 99">
        <div class="w-full flex justify-center mt-48">
            <img src="{{ asset('asset/images/animated/spin.gif') }}" alt="" width="80px">
        </div>
    </div> --}}
    <header class="bg-white dark:bg-gray-800 shadow text-center">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xl">PROFILE</div>
    </header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
        <div class="px-4 pt-4 bg-base dark:bg-gray-800">
            <div class="flex gap-4">
                <div class="hidden sm:block sm:w-4/12 lg:w-3/12">
                    <div class="p-5 bg-white rounded-lg shadow-md">
                        <figure class="px-5 pt-5 flex justify-center">
                            <img src="{{ asset('asset/'.Auth::user()->foto) }}" width="235px">
                        </figure>
                        <div class="justify-center text-center">
                            <div class="mt-3 font-semibold text-center">{{ Auth::user()->name }}</div>
                            <div class="mt-1 mb-1">{{ Auth::user()->userDetails->jabatan_akademik ?? '-' }}</div>
                            <div class="mt-6 flex justify-center">
                                <x-primary-button wire:click="uploadFoto">Ubah Foto</x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-8/12 lg:w-9/12">
                    <div class="px-4 py-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                        <form wire:submit.prevent="updateProfile">
                            <div class="px-5 py-4 mb-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Profile Information') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>
                            </div>
                            <div class="mb-3 px-4 flex w-full">
                                <label class="label w-4/12 lg:w-3/12">Username/NIDN</label>
                                <div class="w-8/12 lg:w-7/12">
                                    <input type="text" wire:model="username" class="input input-bordered w-full" readonly>
                                </div>
                            </div>
                            <div class="mb-3 px-4 flex w-full">
                                <label class="label w-4/12 lg:w-3/12">Nama Lengkap</label>
                                <div class="w-8/12 lg:w-7/12">
                                    <input type="text" wire:model="name" class="input input-bordered w-full">
                                </div>
                            </div>
                            <div class="mb-6 px-4 flex w-full">
                                <label class="label w-4/12 lg:w-3/12">Email</label>
                                <div class="w-8/12 lg:w-7/12">
                                    <input type="text" wire:model="email" class="input input-bordered w-full">
                                </div>
                            </div>
                            <div class="my-3 px-4 flex w-full">
                                <x-primary-button >Simpan</x-primary-button>
                                <span wire:loading wire:target="updateProfile" class="ms-2 loading loading-spinner loading-md"></span>
                                <x-action-message class="ms-3" on="profile-updated">
                                    {{ __('Saved.') }}
                                </x-action-message>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-2 bg-base dark:bg-gray-800">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <form wire:submit.prevent="updatePassword">
                    <div class="px-5 py-4 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Update Password') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Ensure your account is using a long, random password to stay secure. ") }}
                        </p>
                    </div>
                    <div class="mb-3 px-4 flex w-full">
                        <label class="label w-4/12 lg:w-3/12">Current Password</label>
                        <div class="w-8/12 lg:w-7/12">
                            <input type="password" wire:model="current_password" class="input input-bordered w-full">
                            @error('current_password')
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 px-4 flex w-full">
                        <label class="label w-4/12 lg:w-3/12">New Password</label>
                        <div class="w-8/12 lg:w-7/12">
                            <input type="password" wire:model="password" class="input input-bordered w-full">
                            @error('password')
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-6 px-4 flex w-full">
                        <label class="label w-4/12 lg:w-3/12">Confirm Password</label>
                        <div class="w-8/12 lg:w-7/12">
                            <input type="password" wire:model="password_confirmation" class="input input-bordered w-full">
                            @error('password_confirmation')
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="my-3 px-4 flex w-full">
                        <x-app-primary-button>Simpan</x-app-primary-button>
                        <span wire:loading wire:target="updatePassword" class="ms-2 loading loading-spinner loading-md"></span>
                        <x-action-message class="ms-3" on="password-updated">
                            {{ __('Saved.') }}
                        </x-action-message>
                    </div>
                </form>
            </div>
        </div>

        <x-modal name="modalUploadFoto" :maxWidth=" 'sm' ">
            <div class="p-5">
                <form wire:submit="simpanFoto">
                    <div class="w-full mx-auto py-3 px-4">
                        <div class="text-center">
                            <input type="file" class="file-input @error('foto') file-input-error @enderror file-input-bordered" wire:model="foto">
                            <input type="text" wire:model="username" hidden>
                            @error('foto')
                                <span class="label-text-alt text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-5 flex justify-center gap-3">
                            <x-warning-button x-on:click="$dispatch('close-modal', 'modalUploadFoto')">Batal</x-warning-button>
                            <x-primary-button wire:loading.remove >Upload</x-primary-button>
                            <div wire:loading wire:target="foto" class="text-gray-500 text-sm italic items-center">Preparing...</div>
                            <span wire:loading wire:target="simpanFoto" class="ms-2 loading loading-spinner loading-md"></span>
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>

    </div>
</div>
