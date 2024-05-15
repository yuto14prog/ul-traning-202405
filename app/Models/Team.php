<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function isManager(User $user)
    {
        // 受け取ったUserがマネージャーをしているチームかどうか判定（←学習のため）
        // Membersにレコードが存在するかチェック
        return $user->members()
            ->where('role', 1)
            ->where('team_id', $this->id)
            ->exists();
    }

    public static function createWithOwner(User $user, $validated)
    {
        // DB操作を２つするのでトランザクション（←学習のため）
        return DB::transaction(function () use ($user, $validated) 
        {
            $team = new Team($validated);
            $team->owner_id = $user->id;
            $team->save();

            $member = new Member();
            $member->team_id = $team->id;
            $member->user_id = $user->id;
            $member->role = 1;
            $member->save();

            return $team;
        });
    }
}
