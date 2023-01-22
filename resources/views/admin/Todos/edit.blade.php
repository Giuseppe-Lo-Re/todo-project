@extends('layouts.dashboard')

@section('content')

    {{-- Title --}}
    <h2 class="text-center p-3">Modifica un To-do</h2> 

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.todos.update', ['todo' => $todo->id]) }}" method="post">

        {{-- Cross-Site Request Forgery --}}
        @csrf

        {{-- Method --}}
        @method('PUT') 

        {{-- Description --}}
        <div class="add-items"> 
            <label for="description" class="form-label">Descrizione</label>
            <input type="text" class="form-control todo-list-input" placeholder="Cos'hai da fare?" id='description' name='description' value= "{{ old('description', $todo->description) }}"> 
        </div>
        
        {{-- Submit --}}
        <div class="d-flex justify-content-center">
            <input type="submit" value="Aggiorna" class="add btn btn-success font-weight-bold todo-list-add-btn mt-3">
        </div>
    </form>
@endsection