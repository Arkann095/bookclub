<x-layout>
    <x-slot name="title">Профиль</x-slot>

     @livewire('profile', ['user' => $user])
    
</x-layout>