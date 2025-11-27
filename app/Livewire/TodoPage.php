<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoPage extends Component
{
    public function logout(){
        Auth::logout();
        $this->redirect('/');
    }
    public function render()
    {
        return view('livewire.todo-page');
    }
}
