@extends('layouts.dashboard')

@section('content')
    <h1> ciao sono la dashboard privata</h1>

    <div>Benvenuto {{ $user->name }}!</div>
@endsection