@extends('layouts.dashboard')

@section('content')

    {{-- Description --}}
    <h2>{{ $todo->description }}</h2>

    {{-- Created at --}}
    <div>Creato il: {{ $todo->created_at }}</div>

    {{-- Update at --}}
    <div>Aggiornato il: {{ $todo->updated_at }}</div>

    {{-- Edit button --}}
    <div class="d-flex justify-content-center">
        <a class="btn btn-warning mt-3" href="{{ route('admin.todos.edit', ['todo' => $todo->id]) }}">Modifica</a>
    </div>
@endsection