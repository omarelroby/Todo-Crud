<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models;
use App\products;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


class TodosController extends Controller
{
    public function index()
    {
        $data['todos'] = Todo::all();
        return view('todos.todos', $data);
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Todo::create(['name'=>$request->name]);
        session()->flash('Add', 'تم اضافة بنجاح ');
        return redirect('/todos');
    }



    public function show(Todo $todo)
    {
        //
    }


    public function edit(Todo $todo)
    {
        $data['todo'] = $todo;
        return view('todos.edit_todos',$data);

    }



        public function update(Request $request, Todo $todo)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',

        ]);
        $todo->update(['name'=>$request->name]);
        return redirect()->route('todos.index')->with('success', 'تم تعديل المنتج بنجاح.');
    }

    public function destroy(Todo $todo)

    {
         $todo->delete();
         session()->flash('delete', 'تم حذف المنتج بنجاح');
         return redirect('products');
    }
}
