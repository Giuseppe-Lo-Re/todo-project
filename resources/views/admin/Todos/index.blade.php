@extends('layouts.dashboard')

@section('content')

    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card px-3">
                        <div class="card-body">
                            <div>
                                {{-- Alert confirm deleted message --}}
                                @if ($show_deleted_message === 'yes')
                                <div class="alert alert-success" role="alert">
                                    Todo eliminato con successo!
                                </div>
                                @endif

                                {{-- Foreach to print todos --}}
                                @foreach ($todos as $todo)
                                    
                                    {{-- Single Todo --}}
                                    <ul class="d-flex flex-column-reverse">
                                        <li>
                                            <div class="d-flex justify-content-between">

                                                {{-- Description --}}
                                                <div class="h5">
                                                    {{ $todo->description }}
                                                </div>

                                                {{-- Actions button --}}
                                                <a type="button" class="btn btn-outline-light" href="{{ route('admin.todos.show', ['todo' => $todo->id]) }}">⚙️</a>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection