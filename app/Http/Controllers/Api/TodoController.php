<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index() {

        // Retrieve the currently authenticated user's id
        $userId = 1;

        // Print all todos from Model
        $todos = Todo::where('user_id', $userId)->orderBy('order_position', 'ASC')->get();
        
        $data = [
            'success' => true,
            'results' => $todos
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        // Collect all data from form
        $form_data = $request->all();
        
        // Find user id from db
        $userId = 1; 

        // Print all todos from Model
        $todos = Todo::where('user_id', $userId)->get();
        
        // Retrieve next order position
        $new_order_position = count($todos) + 1;
    
        // Create a new istance of todo with values from request
        $new_todo = new Todo([
            'order_position' => $new_order_position,
            'description' => $request->description,
            'user_id' => $userId
        ]);

        // Save new todo
        $new_todo->save();
    }

    public function update(Request $request) {

        // Find user id from db
        $userId = auth()->id(); 

        // Print all todos from Model
        $todos = Todo::where('user_id', $userId)->get();

        // Delete all old todos
        $todos->delete();
        
        // Collect all data from form
        $form_data = $request->all();

        // Create a new istance of todo with values from request
        $new_todo = new Todo([
            'order_position' => $request->order_position,
            'description' => $request->description,
            'user_id' => $userId
        ]);

        // Save new todo
        $new_todo->save();
    }
}
