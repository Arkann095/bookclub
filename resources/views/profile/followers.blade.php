<x-layout>
    <x-slot name="title">Подписчики</x-slot>

     @livewire('profile-followers', ['user' => $user])
    
</x-layout>