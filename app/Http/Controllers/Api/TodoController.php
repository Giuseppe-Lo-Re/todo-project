<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // --------------- INDEX --------------- //
    public function index() {
          
        // Retrieve the currently authenticated user's id
        $userId = 1;
        
        // Collect all todos from Model and order by ascendent order position 
        $todos = Todo::where('user_id', $userId)->orderBy('order_position', 'ASC')->get();
        
        $data = [
            'success' => true,
            'results' => $todos
        ];

        return response()->json($data);
    }

    // --------------- STORE --------------- //
    public function store(Request $request) {

        // Collect all data from form
        $form_data = $request->all();
        
        // Find user id from db 
        $userId = 1;

        // Retrieve all todos from Model
        $todos = Todo::where('user_id', $userId)->get();
        
        // Define next order position as least
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

    // --------------- EDIT --------------- //
    public function edit(Request $request) {

        // Save request input in a variable
        $description_to_update = $request->input('description');

        // Update Todo
        Todo::where('id', $todo_id)->update(['description' => $description_to_update]);
    }

    public function update(Request $request) {

        // Save request input in a variable
        $order_position = $request->input('order_position');

        //update order position Todo 
        $i = 1;
        foreach ($order_position as $todo_id) {

            // Update order_position with new order
            Todo::where('id', $todo_id)->update(['order_position' => $i]);
            $i++;
        }
    }

    // --------------- DESTROY --------------- //
    public function destroy($id) {

        // Find the todo to delete through id
        $post_to_delete = Todo::findOrFail($id);
        
        // Delete the todo to delete
        $post_to_delete->delete();
    }
}
