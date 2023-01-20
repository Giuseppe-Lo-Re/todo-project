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
    public function index()
    {
        // Print all todos from Model
        $todos = Todo::all();
        
        // Pass data to the view
        $data = [
            'todos' => $todos
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

        // Create a new todo 
        $new_todo = new Todo();

        // Fill all data together from form(added fillable in Todo Model)
        $new_todo->fill($form_data);

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
        //
    }

    // Define validation rules
    protected function getValidationRules() {
        return [
            'position_order' => 'required|max:50',
            'description' => 'required|max:60000',
        ];
    }
}
