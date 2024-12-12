<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Dosen;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    #[Validate('required', as: 'nama_mhs', message : 'Kolom ini harus diisi!')]
    public $query; //nama_mhs

    public $username;

    #[Validate('required', message : 'Kolom Username harus diisi!')]
    public $name;

    #[Validate('required', message : 'Kolom Username harus diisi!')]
    public $role = 'user';

    #[Validate('nullable|email', message : 'Kolom Email harus diisi!')]
    public $email;

    #[Validate('required', message : 'Kolom Password harus diisi!')]
    #[Validate('min:8', message : 'Password minimal 8 karakter!')]
    public $password;

    public $highlightIndex;
    public $search = [];
    public $dosen;

    public function render()
    {
        return view('livewire.user.form');
    }

    public function updatedQuery()
    {
        $this->dosen = Dosen::where(function($query) {
                        $query->whereNotIn('nik_dosen', function($query) {
                            $query->select('username')->from('users');
                        })->where('nik_dosen', 'like', '%' . $this->query . '%');
                    })->orWhere(function($query) {
                        $query->whereNotIn('nama_dosen', function($query) {
                            $query->select('name')->from('users');
                        })->where('nama_dosen', 'like', '%' . $this->query . '%');
                    })
                    ->get()
                    ->take(10);
        $this->search = $this->dosen;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->dosen) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->dosen) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectedDosen($id)
    {
        $data = Dosen::find($id);
        $this->query = $data->nik_dosen;
        $this->name = $data->nama_dosen;
        $this->search = [];
    }

    public function resetSearch()
    {
        $this->query = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }



    public function addUserForm()
    {
        $validated = $this->validate();
        $validated['username'] = $this->query;

        //menambahkan role
        if($this->role == 'user'){
            $validated['role'] = 'user';
            $validated['is_admin'] = 'false';
        }else if($this->role == 'admin'){
            $validated['role'] = 'admin';
            $validated['is_admin'] = 'true';
        }

        User::create(Arr::except($validated, ['query']));
        $this->dispatch('close-modal', 'modalTambah');
        $this->reset();
        $this->dispatch('success', ['message' => 'Data User berhasil ditambahkan']);
        $this->dispatch('refresh');
    }
}
