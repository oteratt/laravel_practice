<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){

       $tasks = Task::all();
       return view('admin.tasks.index', compact('tasks'));

    }

    public function show($id){

        $task = Task::findOrFail($id);
        return view('admin.tasks.show', compact('task'));
    }

    public function create(){

        return view('admin.tasks.create');
    }

    public function store(Request $request){

        $valdator = $this->validatePost($request);

        if($validator->fails()){
            return redirect(route('admin.tasks.create')) 
                ->withErrors($validator) 
                ->withInput(); 
        }
    

    $task = new Task();
    $task->savePost($request);

    return redirect(route('admin.tasks.index'))->with('success', '正常に投稿されました');
    }

    protected function validatePost(Request $request){

        $rule = [
            'title' => 'required|max:100',
            'content' =>'required|max:1000',
            ''
        ]

    }
}

