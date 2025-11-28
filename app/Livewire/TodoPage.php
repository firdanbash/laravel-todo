<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TodoPage extends Component
{
    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('nullable|string')]
    public $description = '';

    public $is_done = false;
    public $deleteId;

    // Properties untuk edit
    public $editId;
    public $editTitle = '';
    public $editDescription = '';
    public $filter = '';
    public function mount()
    {
        $this->filter = request('filter', '');
    }
    public function openDeleteModal($id)
    {
        $this->deleteId = $id;
        $this->dispatch('open-delete-modal');
    }

    public function confirmDelete()
    {
        if ($this->deleteId) {
            Todo::where('id', $this->deleteId)
                ->where('user_id', auth()->id())
                ->delete();

            $this->deleteId = null;
            $this->dispatch('close-delete-modal');
            $this->dispatch('refresh-dropdowns');
        }
    }

    public function storeTodo()
    {
        $this->validate();

        Todo::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => auth()->id(),
            'is_done' => false,
        ]);

        $this->reset(['title', 'description']);
        $this->dispatch('close-modal');
        $this->dispatch('refresh-dropdowns');
        $this->dispatch('show-create-toast'); // Tambahkan ini
    }

    public function editTodo($id)
    {
        $todo = Todo::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $this->editId = $todo->id;
        $this->editTitle = $todo->title;
        $this->editDescription = $todo->description;

        $this->dispatch('open-edit-modal');
    }

    public function updateTodo()
    {
        $this->validate([
            'editTitle' => 'required|min:3',
            'editDescription' => 'nullable|string',
        ]);

        if ($this->editId) {
            Todo::where('id', $this->editId)
                ->where('user_id', auth()->id())
                ->update([
                    'title' => $this->editTitle,
                    'description' => $this->editDescription,
                ]);

            $this->reset(['editId', 'editTitle', 'editDescription']);
            $this->dispatch('close-edit-modal');
            $this->dispatch('refresh-dropdowns');
            $this->dispatch('show-update-toast'); // Tambahkan ini
        }
    }

    public function toggleDone($id)
    {
        $todo = Todo::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($todo) {
            $todo->update([
                'is_done' => !$todo->is_done
            ]);
            $this->dispatch('refresh-dropdowns');
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        $query = Todo::where('user_id', auth()->id());

        // Apply filters
        if ($this->filter === 'pending') {
            $query->where('is_done', false);
        } elseif ($this->filter === 'completed') {
            $query->where('is_done', true);
        }

        $todos = $query->latest()->get();

        return view('livewire.todo-page', [
            'todos' => $todos,
        ]);
    }

    public function getTodoCount()
    {
        return Todo::where('user_id', auth()->id())->count();
    }
}
