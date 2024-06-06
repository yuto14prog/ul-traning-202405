1. 各チームのタスク数を求め、タスク数が2以上のチームのみを表示してください。
- SQL
    ```sql
    SELECT teams.*, count(tasks.id)
    FROM teams
    LEFT OUTER JOIN tasks ON teams.id = tasks.team_id
    GROUP BY teams.id
    HAVING count(tasks.id) >= 2;
    ```

2. 各チームのメンバー数を求め、メンバー数が5以上のチームのみを表示してください。
- SQL
    ```sql
    SELECT teams.*, count(members.id)
    FROM teams
    LEFT OUTER JOIN members ON teams.id = members.team_id
    GROUP BY teams.id
    HAVING count(members.id) >= 5;
    ```

3. 各ユーザーに割り当てられたタスク数を求め、タスク数が3以上のユーザーのみを表示してください。
- SQL
    ```sql
    SELECT users.*, count(tasks.id)
    FROM users
    LEFT OUTER JOIN tasks ON users.id = tasks.assignee_id
    GROUP BY users.id
    HAVING count(tasks.id) >= 3;
    ```

4. 各タスクのコメント数を求め、コメント数が5以上のタスクのみを表示してください。
- SQL
    ```sql
    SELECT tasks.*, count(comments.id)
    FROM tasks
    LEFT OUTER JOIN comments ON tasks.id = comments.task_id
    GROUP BY tasks.id
    HAVING count(comments.id) >= 5;
    ```