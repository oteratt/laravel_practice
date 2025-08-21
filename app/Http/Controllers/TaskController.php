<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){  //一覧

        $tasks = Task::all();
        $status = config('const.task.status');
        $priority = config('const.task.priority');
        return view('admin.tasks.index', compact('tasks','status', 'priority'));

    }

    public function show($id){  //詳細

        $task = Task::findOrFail($id);
        $status = config('const.task.status');
        $priority = config('const.task.priority');
        return view('admin.tasks.show', compact('task', 'status', 'priority'));
    }

    public function create(){  //作成

        $status = config('const.task.status');
        $priority = config('const.task.priority');

        return view('admin.tasks.create', compact('status', 'priority'));
    }


    public function store(Request $request){   //登録のバリデーションと登録

        $validator = $this->validatePost($request);

        if($validator->fails()){
            return redirect(route('admin.tasks.create')) 
                ->withErrors($validator) 
                ->withInput(); 
        }
    

    $task = new Task();
    $task->savePost($request);

    return redirect(route('admin.tasks.index'))->with('success', '正常に投稿されました');
    }

    public function edit($id){  //編集
        $task = Task::findOrFail($id);
        $status = config('const.task.status');
        $priority = config('const.task.priority');

        return view('admin.tasks.create', compact('task', 'status', 'priority'));
    }

    public function update(Request $request, $id){  //編集のバリデーションと更新

        $validator = $this->validatePost($request);

        if($validator->fails()){
            return redirect(route('admin.tasks.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        $task = Task::findOrFail($id);
        $task->savePost($request);

        return redirect(route('admin.tasks.index'))->with('success', '正常に編集されました。');
    }

    public function destroy($id){
        $task = Task::findOrFail($id);

        $task->delete();
        return redirect(route('admin.tasks.index'))->with('success', '正常に削除できました。');
    }

    protected function validatePost(Request $request){ 

        $rules = [
            'title' => 'required|max:100',
            'content' =>'required|max:1000',
            'deadline_at' => 'required|date_format:Y-m-d\TH:i',
            'support_at' => 'date_format:Y-m-d\TH:i',
            'priority' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'required' => ':attributeは必須項目です。',
            'max' => ':attributeは:max以内で入力してください。',
            'date_format' => ':attributeは正しい日時形式で入力してください。',
        ];

        $attributes = [
            'title' => 'タイトル',
            'content' => '内容',
            'deadline_at' => '対応期限',
            'support_at' => '対応日時',
            'priority' => '優先度',
            'status' => 'ステータス',
        ];

        return Validator::make($request->all(), $rules, $messages, $attributes);

    }
}

