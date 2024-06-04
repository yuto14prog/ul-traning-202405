<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'kind',];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public static function saveComment(Task $task, $validated)
    {
        return DB::transaction(function () use ($task, $validated)
        {
            $comment = new Comment($validated);
            $comment->task_id = $task->id;
            $comment->author_id = Auth::user()->id;
            $comment->save();

            if ($comment->kind === 1) {
                $task->status = 1;
                $task->save();
            }

            return $comment->with('user')->orderBy('id', 'desc')->first();
        });
    }
}
