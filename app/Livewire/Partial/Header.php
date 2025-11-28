<?php

namespace App\Livewire\Partial;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.partial.header');
    }
}
