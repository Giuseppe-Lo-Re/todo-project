@extends('layouts.dashboard')

@section('content')
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card px-3">
                        <div class="card-body">
                            <h4 class="card-title text-center">Todo list</h4>
                            <div class="list-wrapper">
                                @foreach ($todos as $todo)
                                    {{-- Single To do --}}
                                    <ul class="d-flex flex-column-reverse todo-list">
                                        <li>
                                            <div class="d-flex justify-content-between">

                                                {{-- To do description --}}
                                                <div class="form-check"> <label class="form-check-label">
                                                    {{ $todo->description }}
                                                </div>

                                                {{-- Action button --}}
                                                <a type="button" class="btn btn-primary" href="{{ route('admin.todos.show', ['todo' => $todo->id]) }}">Details</a>
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