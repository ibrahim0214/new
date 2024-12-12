<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $perPage = 10;
    public $search = '';

    #[Validate('required', message : 'Kolom Username harus diisi!')]
    public $username;

    #[Validate('required', message : 'Kolom Username harus diisi!')]
    public $name;

    #[Validate('required', message : 'Kolom Username harus diisi!')]
    public $role = 'user';

    #[Validate('nullable|email', message : 'Kolom Email harus diisi!')]
    public $email;

    #[Validate('nullable', message : 'Kolom Password harus diisi!')]
    #[Validate('min:8', message : 'Password minimal 8 karakter!')]
    public $password;

    public $selectedUser = [];

    #[On('refresh')]
    public function render()
    {
        $users = User::orderBy('role', 'desc')->orderBy('id', 'desc')
                        ->where(function($query){
                            $query->where('role', '!=', 'Superadmin')
                            ->where('username', 'like', '%'.$this->search.'%');
                        })->orWhere(function($query){
                            $query->where('role', '!=', 'Superadmin')
                            ->where('name', 'like', '%'.$this->search.'%');
                        })
                        ->paginate($this->perPage);
        return view('livewire.user.index', ['users' => $users]);
    }



    public function addUser()
    {
        $this->dispatch('open-modal', 'modalTambah');
    }



    public function mauHapus(User $user)
    {
        $this->selectedUser = $user;
        $this->dispatch('open-modal', 'modalHapus');
    }

    public function hapusUser()
    {
        if($this->selectedUser->role == 'admin'){
            $this->dispatch('error', ['message' => 'User Admin tidak dapat dihapus']);
            $this->dispatch('close-modal', 'modalHapus');
            return;
        }elseif($this->selectedUser->id == Auth::user()->id){
            $this->dispatch('error', ['message' => 'Anda tidak dapat menghapus diri sendiri']);
            $this->dispatch('close-modal', 'modalHapus');
            return;
        }else{
            $this->selectedUser->delete();
            $this->dispatch('close-modal', 'modalHapus');
            $this->dispatch('success', ['message' => 'Data User berhasil dihapus']);
            $this->dispatch('refresh');
        }
    }

    public function editUser(User $user)
    {
        $this->username = $user->username;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->selectedUser = $user;
        $this->dispatch('open-modal', 'modalEdit');
    }

    public function editUserForm()
    {
        $validated = $this->validate();

        //Edit role
        if($this->role == 'user'){
            $validated['role'] = 'user';
            $validated['is_admin'] = 'false';
        }else if($this->role == 'admin'){
            $validated['role'] = 'admin';
            $validated['is_admin'] = 'true';
        }

        //cek password
        if($this->password != null){
            $validated['password'] = bcrypt($this->password);
        }else{
            unset($validated['password']);
        }

        User::where('id', $this->selectedUser->id)->update($validated);
        $this->reset();
        $this->dispatch('close-modal', 'modalEdit');
        $this->dispatch('success', ['message' => 'Data User berhasil diubah']);
        $this->dispatch('refresh');
    }
}
