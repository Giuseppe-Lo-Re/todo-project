@extends('layouts.dashboard')

@section('content')

<h2>Crea un nuovo To Do</h2>

<div class="add-items d-flex"> 
    <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> 
    <button class="add btn btn-success font-weight-bold todo-list-add-btn">Aggiungi</button> 
</div>

@endsection