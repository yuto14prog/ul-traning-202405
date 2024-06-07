1. タスク完了率が70%を超えるチームをリストアップしてください。
- SQL
    ```sql
    SELECT teams.*,
	    (SELECT sum(status) / count(id)  FROM tasks WHERE team_id = teams.id) as taskdonerate
    FROM teams
    GROUP BY teams.id
    HAVING taskdonerate >= 0.7

    SELECT
        teams.*,
	    sum(tasks.status) / count(tasks.id) as taskdonerate
    FROM teams
    JOIN tasks ON teams.id = tasks.team_id
    GROUP BY teams.id
    HAVING taskdonerate >= 0.7
    ```

2. 各ユーザーに割り当てられたタスクの平均期間を計算し、平均タスク期間が7日を超えるユーザーのみを含めてください。「タスクの期間」は「taskのupdated_atとcreated_atの差」で計算します。
- SQL
    ```sql
    SELECT users.*,
        AVG(DATEDIFF(
        	tasks.updated_at,
            tasks.created_at
        )) as average
    FROM users
    JOIN tasks ON users.id = tasks.assignee_id
    GROUP BY users.id
    HAVING average > 7
    ```

3. チームごとに各タスクに対する平均コメント数を計算し、平均コメント数が2を超えるチームのみを表示してください。
- SQL
    ```sql
    SELECT
        t.id AS team_id,
        AVG(c.comment_count) AS avg_comments
    FROM
        teams t
    JOIN
        tasks ts ON t.id = ts.team_id
    JOIN
        (
            SELECT
                task_id,
                COUNT(*) AS comment_count
            FROM
                comments
            GROUP BY
                task_id
        ) c ON ts.id = c.task_id
    GROUP BY
        t.id
    HAVING
        AVG(c.comment_count) > 2;
    ```
