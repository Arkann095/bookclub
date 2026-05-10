<x-layout>
    <x-slot name="title">Выбранная книга</x-slot>

    @livewire('current-book', ['book' => $book])
    
</x-layout>