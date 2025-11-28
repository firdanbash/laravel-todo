<?php

namespace App\Livewire\Partial;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function getTodoCount()
    {
        return Todo::where('user_id', auth()->id())->count();
    }

    public function getPendingCount()
    {
        return Todo::where('user_id', auth()->id())
            ->where('is_done', false)
            ->count();
    }

    public function getCompletedCount()
    {
        return Todo::where('user_id', auth()->id())
            ->where('is_done', true)
            ->count();
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.partial.sidebar');
    }
}
