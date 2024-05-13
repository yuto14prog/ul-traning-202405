<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name',];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function ownTasks()
    {
        return $this->hasMany(Task::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // 所属メンバー→users（←学習のため）
    public function users()
    {
        // 中間テーブル名を明記（デフォルトは'team_user'で探しちゃう）←学習のため
        return $this->belongsToMany(User::class, 'members');
    }
}
