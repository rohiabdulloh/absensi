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

<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <!-- Logo -->
    <div class="mb-6">
        <img src="{{ asset('storage/setting/logo.png') }}" alt="Logo" class="w-80 mx-auto drop-shadow-md">
    </div>

    <!-- Card -->
    <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-8">
            <!-- Judul -->
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">
                Selamat Datang
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form wire:submit="login" class="space-y-4">
                <!-- Email -->
                <x-input label="Username/Email" model="form.email" inline="false" />

                <!-- Password -->
                <x-input type="password" label="Password" model="form.password" inline="false" />

                <!-- Remember Me -->
                <label class="inline-flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <input wire:model="form.remember" type="checkbox"
                        class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2">Ingat saya</span>
                </label>

                <!-- Submit -->
                <x-button-primary type="submit" class="w-full mt-4"                
                    wire:loading.attr="disabled"
                    wire:target="login"
                >
                    <x-fas-circle-notch wire:loading wire:target="login" class="w-4 h-4 mr-2 animate-spin"/>
                    Masuk
                </x-button-primary>
            </form>

        </div>
    </div>

    <!-- Footer (optional) -->
    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} SMAN 1 Kencong. Semua hak dilindungi.
    </div>
</div>
