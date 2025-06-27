<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(
            session('url.intended', '/'),
            navigate: true
        );
    }
}; ?>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100
        dark:bg-gray-900 dark:text-light">
    <div class="w-full sm:max-w-md mt-6 mb-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg
        dark:bg-gray-800">
        <div class="flex justify-center pb-8">            
            <img src="{{asset('storage/setting/logo.png')}}" width="200"/>
        </div>
    
<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="flex flex-col space-y-3">
            <x-input label="Email" model="form.email" inline="false"/>
            <x-input type="password" label="Password" model="form.password" inline="false"/>
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>
            <x-button-primary type="submit">Login</x-button-primary>
        </div>
    </form>
</div>

    </div>      
</div>      
