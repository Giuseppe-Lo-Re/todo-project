@extends('layouts.dashboard')

@section('content')
    {{-- Title --}}
    <h2>Bentornato {{ $user->name }}!</h2>

    {{-- Welcome text --}}
    <h3>Cosa facciamo oggi?</h3>
@endsection