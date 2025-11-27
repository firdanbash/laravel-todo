<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AuthPage extends Component
{
    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('required|email')]
    public $email = '';
    #[Validate('required|min:3')]
    public $password = '';

    public $mode = 'login';

    public function switchToLogin()
    {
        $this->mode = 'login';
    }
    public function switchToRegister()
    {
        $this->mode = 'register';
    }

    public function login()
    {
        $this->validateOnly('email');
        $this->validateOnly('password');
        $user = User::where('email', $this->email)->first();
        if (! $user || ! Hash::check($this->password, $user->password)) {
            throw ValidationException::withMessages([
                'auth' => 'Email or Password is wrong!',
            ]);
        }
        Auth::login($user);
        $this->redirect('/todo');
    }
    public function register()
    {
        $this->validate();
        if (User::where('email', $this->email)->exists()) {
            throw ValidationException::withMessages([
                'auth' => 'Email have been taken!',
            ]);
        }
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        Auth::login($user);
        $this->redirect('/todo');
    }


    public function render()
    {
        return view('livewire.auth-page');
    }
}
