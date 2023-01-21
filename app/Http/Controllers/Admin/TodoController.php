<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Find user id from db
        $userId = auth()->id(); 

        // Print all todos from Model
        $todos = Todo::where('user_id', $userId)->get();

        // Collect all the requests 
        $request_info = $request->all();

        // $show_deleted_message will be equal to 'deleted' if present, otherwise it will be equal to 'null'
        $show_deleted_message = isset($request_info['deleted']) ? $request_info['deleted'] : null;
        
        // Pass data to the view
        $data = [
            'todos' => $todos,
            'show_deleted_message' => $show_deleted_message
        ];

        return view('admin.todos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Data validation
        $request->validate($this->getValidationRules());

        // Collect all data from form
        $form_data = $request->all();
        
        // Find user id from db
        $userId = auth()->id(); 

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

        // After save, redirect to the show page
        return redirect()->route('admin.todos.show', ['todo' => $new_todo->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find todo from id
        $todo = Todo::findOrFail($id);  

        // Pass data to the view
        $data = [
            'todo' => $todo
        ];
        
        return view('admin.todos.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find todo from id
        $todo = Todo::findOrFail($id); 

        // Pass data to the view
        $data = [
            'todo' => $todo
        ];

        return view('admin.todos.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Data validation
        $request->validate($this->getValidationRules());

        // Collect all data from form
        $form_data = $request->all();
        
        // Find the todo to update through id
        $todo_to_update = Todo::findOrFail($id);

        // Update the todo modified
        $todo_to_update->update($form_data);

        // After update, redirect to the show page
        return redirect()->route('admin.todos.show', ['todo' => $todo_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the todo to delete through id
        $post_to_delete = Todo::findOrFail($id);

        // Delete the todo to delete
        $post_to_delete->delete();

        // After Delete, redirect to the index page
        return redirect()->route('admin.todos.index', ['deleted' => 'yes']);
    }

    // Define validation rules
    protected function getValidationRules() {
        return [
            'description' => 'required|max:60000',
        ];
    }
}
