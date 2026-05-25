<x-layout>
    <x-slot name="title">Профиль</x-slot>

     @livewire('profile-show', ['user' => $user])
    
</x-layout>