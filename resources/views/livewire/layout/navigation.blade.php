<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

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

    #[On('refresh')]
    public function refresh(){
        $this->dispatch('$refresh');
    }
}; ?>

 <x-dropdown contentClasses="p-2 bg-white dark:bg-gray-700">
    <x-slot name="trigger">
    {{-- Tombol menu user --}}
        <div class="flex items-center justify-between space-x-2">
            <div class="w-8 h-8 cursor-pointer rounded-full border overflow-hidden">
                @if(Auth::user()->photo != null)
                    <img src="/storage/user/{{Auth::user()->photo}}">
                @else
                    <img src="/storage/default/user_default.png">
                @endif
            </div>
        </div>
    </x-slot>

    {{-- Menu user --}}
    <x-slot name="content">
        <div class="border-b dark:border-gray-700 py-2 px-2 mb-1">            
            <div class="text-gray-500 dark:text-gray-200 text-md">{{Auth::user()->name}}</div>
            <div class="text-gray-400 dark:text-gray-300 text-sm">{{Auth::user()->email}}</div>
        </div>

        <x-menu link="/profil" class="dark:hover:bg-gray-600"> Profil Akun </x-menu>
        <button wire:click="logout" class="w-full text-start">
            <x-menu link="" class="dark:hover:bg-gray-600"> Logout </x-menu>
        </button>
    </x-slot>
</x-dropdown>
