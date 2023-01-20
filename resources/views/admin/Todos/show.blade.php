@extends('layouts.dashboard')

@section('content')
    <h2>{{ $todo->description }}</h2>

    <div>Creato il: {{ $todo->created_at }}</div>
    <div>Aggiornato il: {{ $todo->updated_at }}</div>
@endsection