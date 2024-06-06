1. 特定のユーザーが書いた全てのコメントを取得するクエリを書いてください。
- SQL
    ```sql
    SELECT * FROM comments WHERE author_id = 1;
    ```
- Laravel
    ```php
    Comment::where('author_id', 1)->get();
    ```

2. 特定のチームに属する全てのタスクを取得するクエリを書いてください。
- SQL
    ```sql
    SELECT * FROM tasks WHERE team_id = 1;
    ```
- Laravel
    ```php
    Task::where('team_id', 1)->get();
    ```

3. 全てのタスクとそれに対するコメントの数を取得するクエリを書いてください。
- SQL
    ```sql
    SELECT tasks.*, count(comments.id) as comment_count
    FROM tasks
    LEFT OUTER JOIN comments ON comments.task_id = tasks.id
    GROUP BY tasks.id;
    ```
- Laravel
    ```php
    Task::withCount('comments')->get();
    ```

4. 特定のユーザーがアサインされているタスクの詳細と、そのタスクのコメントを取得するクエリを書いてください。
- SQL
    ```sql
    SELECT tasks.*, comments.message
    FROM tasks
    LEFT OUTER JOIN comments ON tasks.id = comments.task_id
    WHERE tasks.assignee_id = 1;
    ```
- Laravel
    ```php
    Task::with('comments')
        ->where('assignee_id', 1)
        ->get();
    ```

5. 特定のユーザーがオーナーである全てのチームと、そのチームに所属しているメンバーの情報を取得するクエリを書いてください。
- SQL
    ```sql
    SELECT teams.*, members.*
    FROM teams
    JOIN members ON teams.id = members.team_id
    WHERE teams.owner_id = 1;
    ```
- Laravel
    ```php
    Team::with('members')
        ->where('owner_id', 1)
        ->get();
    ```
