<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function getStarted()
    {
        return $this->redirect('/osce', navigate: true);
    }
}
