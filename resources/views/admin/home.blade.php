@extends('layouts.dashboard')

@section('content')

    {{-- Title --}}
    <div class="text-center">
        <h2>Bentornato 
            <span class="text-success">
                {{ $user->name }} 
            </span>!
        </h2>
        
        {{-- Welcome message --}}
        <h5>
            <em>
                Cosa facciamo oggi?
            </em>
        </h5>
    </div>
@endsection