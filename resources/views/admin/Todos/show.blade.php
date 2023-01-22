@extends('layouts.dashboard')

@section('content')
    <div class="text-center">

        {{-- Description --}}
        <h2>{{ $todo->description }}</h2>
    
        {{-- Created at --}}
        <div>
            Creato il: {{ $todo->created_at }}
        </div>
    
        {{-- Update at --}}
        <div>
            Aggiornato il: {{ $todo->updated_at }}
        </div>
    </div>

    {{-- Edit/Delete buttons --}}
    <div class="d-flex justify-content-center">

        {{-- Edit --}}
        <a class="btn btn-warning mt-3 m-3" href="{{ route('admin.todos.edit', ['todo' => $todo->id]) }}">🔧 Modifica</a>

        {{-- Delete --}}
        <form action=" {{ route('admin.todos.destroy', ['todo' => $todo->id]) }}" method="post">

            {{-- Cross-Site Request Forgery --}}
            @csrf

            {{-- Method --}}
            @method('DELETE')

            {{-- Input --}}
            <input class="btn btn-danger mt-3" type="submit" value="❌ Elimina" onClick="return confirm('Stai per eliminare il Todo...sei sicurə?')">
        </form>
    </div>
@endsection