<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="fixed px-3 navbar text-white" style="z-index: 10; background:linear-gradient(135deg, #172a74, #21a9af);">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 text-black dark:text-white rounded-box z-[1] mt-3 w-52 p-2 shadow">
          <li><a wire:navigate href="{{ route('osce') }}">OSCE</a></li>
          <li>
            <a>Referensi</a>
            <ul class="p-2">
              <li><a wire:navigate href="{{ route('station') }}">Data Station</a></li>
              <li><a wire:navigate href="{{ route('dosen') }}">Data Dosen</a></li>
              <li><a wire:navigate href="{{ route('mahasiswa') }}">Data Mahasiswa</a></li>
            </ul>
          </li>
          <li>
            <a>Daftar Nilai</a>
            <ul class="p-2">
              <li><a wire:navigate href="{{ route('nilai') }}">Nilai Total</a></li>
              <li><a wire:navigate href="{{ route('nilai-individu') }}">Nilai Individu</a></li>
            </ul>
          </li>
          <li>
            <a>Fitur Baru</a>
            <ul class="p-2">
              <li><a wire:navigate href="{{ route('dashboard') }}">Pakta Integritas</a></li>
              <li><a wire:navigate href="{{ route('dashboard') }}">Lembar Umpan Balik</a></li>
            </ul>
          </li>
          @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
            <li><a href="{{ route('setup-user') }}">Setup User</a></li>
          @endif
        </ul>
      </div>
      <a class="btn btn-ghost text-xl">OSCE STIKES NOTOKUSUMO</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <a href="{{ route('dashboard') }}" wire:navigate tabindex="0" role="button" class="py-2 px-4 m-1 rounded-lg border-0  text-white hover:bg-sky-800 dark:text-white dark:hover:bg-slate-600">
            <span class="fa-solid fa-home"></span>
            <span>Beranda</span>
        </a>
        <a href="{{ route('osce') }}" wire:navigate tabindex="0" role="button" class="py-2 px-4 m-1 rounded-lg border-0  text-white hover:bg-sky-800 dark:text-white dark:hover:bg-slate-600">
            <span class="fa-solid fa-hospital-user"></span>
            <span>OSCE</span>
        </a>
        <div class="dropdown">
            <a tabindex="0" role="button" class="py-2 px-4 m-1 rounded-lg border-0  text-white hover:bg-sky-800 dark:text-white dark:hover:bg-slate-600">
                <span class="fa-solid fa-pen-to-square"></span>
                <span>Referensi</span>
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 text-black dark:text-white rounded-box z-[1] w-52 p-2 shadow">
              <li><a wire:navigate href="{{ route('station') }}">Data Station</a></li>
              <li><a wire:navigate href="{{ route('dosen') }}">Data Dosen</a></li>
              <li><a wire:navigate href="{{ route('mahasiswa') }}">Data Mahasiswa</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <a tabindex="0" role="button" class="py-2 px-4 m-1 rounded-lg border-0  text-white hover:bg-sky-800 dark:text-white dark:hover:bg-slate-600">
                <span class="fa-solid fa-file-lines"></span>
                <span>Daftar Nilai</span>
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 text-black dark:text-white rounded-box z-[1] w-52 p-2 shadow">
              <li><a wire:navigate href="{{ route('nilai') }}">Nilai Total</a></li>
              <li><a wire:navigate href="{{ route('nilai-individu') }}">Nilai Individu</a></li>
            </ul>
        </div>
        <div class="dropdown">
          <a tabindex="0" role="button" class="py-2 px-4 m-1 rounded-lg border-0  text-white hover:bg-sky-800 dark:text-white dark:hover:bg-slate-600">
              <span class="fa-solid fa-pen-to-square"></span>
              <span>Fitur Baru</span>
              <i class="fa-solid fa-caret-down"></i>
          </a>
          <ul tabindex="0" class="dropdown-content menu bg-base-100 text-black dark:text-white rounded-box z-[1] w-52 p-2 shadow">
            <li><a wire:navigate href="{{ route('dashboard') }}">Pakta Intgritas</a></li>
            <li><a wire:navigate href="{{ route('dashboard') }}">Lembar Umpan Balik</a></li>
          </ul>
        </div>
        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
        <a href="{{ route('setup-user') }}" wire:navigate tabindex="0" role="button" class="py-2 px-4 m-1 rounded-lg border-0  text-white hover:bg-sky-800 dark:text-white dark:hover:bg-slate-600">
            <span class="fa-solid fa-user-gear"></span>
            <span>Setup User</span>
        </a>
        @endif

    </div>
    <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
              <div class="w-10 border-2 border-white rounded-full">
                <img
                  alt="Tailwind CSS Navbar component"
                  src="{{ asset('asset/'.Auth::user()->foto) }}" />
                  {{-- src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" /> --}}
              </div>
            </div>
            @auth
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 text-black dark:text-white rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <div class="px-3 mb-2">
                        <span>Welcome,</span>
                        <span class="font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                    <hr>
                    <li class="mt-1">
                        <a href="/profile" class="justify-between" wire:navigate>
                        Profile
                        </a>
                    </li>
                    <li><a wire:click="logout">Logout</a></li>
                </ul>
            @else
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 text-black dark:text-white rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li><a wire:navigate href="{{ route('login') }}">Login</a></li>
                </ul>
            @endauth
        </div>
    </div>
</div>
