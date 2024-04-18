<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function list()
{

    $userId = Session::get('user_id');
    $todocreate = Todo::where('user_id', $userId)->get();
    $todocategory = Category::where('user_id', $userId)->get();

    return view('todo.main.todolist', compact('todocreate', 'todocategory'));
}


    public function update(Request $request, $id)
    {

        $todo = Todo::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $todo->update([
            'title' => $request->input('title'),
            'category' => $request->input('category'),

        ]);
        return redirect()->back()->with('success', 'Todo updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
        ]);

        $userId = session('user_id');

        Todo::create([
            'title' => $request->title,
            'category' => $request->category,
            'user_id' => $userId,
        ]);

        return redirect()->back();
    }





public function delete($id)
{
    $tododelete = Todo::find($id);
    $tododelete->delete();
    return redirect()->back();
}

public function complete($id)
{
    $task = Todo::find($id);
    if ($task) {
        $task->completed = true;
        $task->save();
        return redirect()->back()->with('success', 'Task marked as completed successfully');
    } else {
        return redirect()->back()->with('error', 'Task not found');
    }
}


public function category(Request $request)
{
    $request->validate([
        'title' => 'required',
    ]);

    $userId = session('user_id');

    Category::create([
        'title' => $request->title,
        'user_id' => $userId,
    ]);

    return redirect()->back();
}

    


  }
