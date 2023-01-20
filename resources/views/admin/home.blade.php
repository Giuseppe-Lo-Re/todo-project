@extends('layouts.dashboard')

@section('content')

    {{-- Title --}}
    <div class="text-center">
        <h2>Bentornato {{ $user->name }}!</h2>
        
        {{-- Welcome text --}}
        <h3>Cosa facciamo oggi?</h3>
    </div>

@endsection