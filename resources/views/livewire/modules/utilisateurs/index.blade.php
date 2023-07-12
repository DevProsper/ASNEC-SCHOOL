@extends("layouts.master")

@section("contenu")
<div>
    <h1>Mon Composant Livewire</h1>
    <p>{{ $message }}</p>
    <input type="text">
    <button wire:click="updateMessage">Mettre à jour le message</button>
</div>
@endsection