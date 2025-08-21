<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //一覧画面
    public function index(){  

        //DBから全て取得
        $tasks = Task::all();  

        //優先度とステータスを日本語で表示させたいので、index.bladeに値を持ってくるために記入。
        $status = config('const.task.status');
        $priority = config('const.task.priority');

        //viewで書かれているURLで表示。'admin.tasks.index'はルートファイルの時に名前指定したもの。
        return view('admin.tasks.index', compact('tasks','status', 'priority'));

    }

    //詳細画面
    public function show($id){  

        //DBから選択したidの一件分だけ取得
        $task = Task::findOrFail($id);

        //優先度とステータスを日本語で表示させたいので、show.bladeに値を持ってくるために記入。
        $status = config('const.task.status');
        $priority = config('const.task.priority');
        return view('admin.tasks.show', compact('task', 'status', 'priority'));
    }

    //登録画面
    public function create(){  

        //優先度とステータスを選んで登録するために、create.bladeに値を持ってくるために記入。
        $status = config('const.task.status');
        $priority = config('const.task.priority');

        return view('admin.tasks.create', compact('status', 'priority'));
    }

    //登録画面のバリデーションと登録
    public function store(Request $request){   

        //バリデーション
        $validator = $this->validatePost($request);

        //失敗したとき、'admin.tasks.create'のurlにリダイレクト。
        if($validator->fails()){
            return redirect(route('admin.tasks.create')) 
                //バリデーション引っかかった部分をセッションに保存されて、bladeの$errorsに値が入るイメージ。。？
                ->withErrors($validator) 
                //入力した値全てがセッションに保存されて、bladeでoldを使うことによって値保持。
                ->withInput(); 
        }
    
    //Taskモデルのカスタムメソッドを使用して保存、今は殻の状態。
    $task = new Task();

    //ここでsavePostメソッドでデータを保存。
    $task->savePost($request);

    //成功したらroute('admin.tasks.index'のurlにリダイレクトにwithの第二引数の中身が表示。第一引数の値がセッションに保存されてbladeで呼ぶ。
    return redirect(route('admin.tasks.index'))->with('success', '正常に投稿されました');
    }

    //編集画面
    public function edit($id){  

        //DBに保存してある選択したidの部分を取得
        $task = Task::findOrFail($id);

        //優先度とステータスを表示して編集するために、create.bladeに値を持ってくるため記入。
        $status = config('const.task.status');
        $priority = config('const.task.priority');

        return view('admin.tasks.create', compact('task', 'status', 'priority'));
    }

    //編集画面のバリデーションと更新
    public function update(Request $request, $id){  

        //バリデーション
        $validator = $this->validatePost($request);

        //失敗したとき、'admin.tasks.edit'のurlの選択してたid番号の部分にリダイレクト
        if($validator->fails()){
            return redirect(route('admin.tasks.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        //すでにあるデータを編集して登録するのでfindOrFailで選択した一件だけのデータだけ取得
        $task = Task::findOrFail($id);

        //上書き保存
        $task->savePost($request);

        return redirect(route('admin.tasks.index'))->with('success', '正常に編集されました。');
    }

    //削除処理
    public function destroy($id){

        //選択した部分一件を取得
        $task = Task::findOrFail($id);

        //論理削除を実行
        $task->delete();

        return redirect(route('admin.tasks.index'))->with('success', '正常に削除できました。');
    }

    //バリデーションルール
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
            'required' => ':attributeは必須項目です。',  //:attributeは$attributesの値が入るようになっている。
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

        //Validator::makeの中身が返されて上記にある$validatorに入る。
        return Validator::make($request->all(), $rules, $messages, $attributes);

    }
}

