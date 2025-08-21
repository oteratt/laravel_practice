<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'deadline_at', 'support_at', 'priority', 'status'];

    public function savePost(Request $request){

        $this->title = $request->input('title');
        $this->content = $request->input('content');
        $this->deadline_at = $request->input('deadline_at');
        //必須では無いので、無かった場合nullにしてある。
        $this->support_at = !empty($request->input('support_at')) ? $request->input('support_at') : null;
        $this->priority = $request->input('priority');
        $this->status = $request->input('status');

        $this->save();

    }
}
