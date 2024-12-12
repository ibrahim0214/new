<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Dosen;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class Index extends Component
{
    use WithFileUploads;

    public $username;
    public $name;
    public $email;
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    #[Validate('required|image|mimes:png,jpg|max:2048')]
    public $foto;

    #[On('foto-updated2')]
    public function render()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->name = $user->name;
        $this->email = $user->email;
        return view('livewire.profile.index');
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
        ]);

        Auth::user()->update($validated);
        if(Dosen::where('nik_dosen', Auth::user()->username)->exists()){
            Dosen::where('nik_dosen', Auth::user()->username)->update(['nama_dosen' => $validated['name']]);
        }
        $this->dispatch('profile-updated');
    }

    public function updatePassword()
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }

    public function uploadFoto()
    {
        $this->username = Auth::user()->username;
        $this->dispatch('open-modal','modalUploadFoto');
    }

    public function simpanFoto()
    {
        $validated = $this->validate();
        User::where('username', $this->username)->update([
            'foto' => Storage::disk('public_folder')->put('images/user', $validated['foto'])
        ]);
        $this->dispatch('close-modal','modalUploadFoto');
        return redirect()->route('profile');
    }
}

