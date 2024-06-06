1. 全てのタスクとそれに対応するチーム名を取得するクエリを書いてください。
- SQL
    ```sql
    SELECT tasks.*, teams.name as team_name
    FROM tasks
    JOIN teams ON tasks.team_id = teams.id;
    ```
- Laravel
    ```php
    Task::select('tasks.*', 'teams.name as team_name')
        ->join('teams', 'tasks.team_id', '=', 'teams.id')
        ->get();
    ```

2. 特定のユーザーがアサインされているタスクを取得するクエリを書いてください。
- SQL
    ```sql
    SELECT tasks.*, users.name as username
    FROM tasks
    JOIN users ON tasks.assignee_id = users.id
    WHERE tasks.assignee_id = 1;
    ```
- Laravel
    ```php
    Task::with('assignee')
        ->where('assignee_id', 1)
        ->get();
    ```

3. 特定のチームに所属している全てのメンバーの情報を取得するクエリを書いてください。
- SQL
    ```sql
    SELECT members.team_id, users.*
    FROM members
    JOIN users ON members.user_id = users.id
    WHERE team_id = 1;
    ```
- Laravel
    ```php
    Member::with('user')
        ->where('team_id', 1)
        ->get();
    ```

4. 特定のユーザーが作成したチームの情報を取得するクエリを書いてください。
- SQL
    ```sql
    SELECT * FROM teams WHERE owner_id = 1;
    ```
- Laravel
    ```php
    Team::where('owner_id', 1)->get();
    ```

5. 特定のタスクのステータスを更新するクエリを書いてください。
- SQL
    ```sql
    UPDATE tasks SET status = 1 WHERE id = 1;
    ```
```php
    Task::where('id', 1)
        ->update(['status' => 0]);
    ```
