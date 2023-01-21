<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index() {

        $todos = Todo::all();
        
        $data = [
            'success' => true,
            'results' => $todos
        ];

        return response()->json($data);
    }
}
