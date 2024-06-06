1. タスク完了率が70%を超えるチームをリストアップしてください。
- SQL
    ```sql
    SELECT teams.*
    FROM teams
    WHERE
        (SELECT count(*) FROM tasks WHERE status = 1 GROUP BY team_id)
        /
        (SELECT count(*) FROM tasks GROUP BY team_id)
        >= 0.7
    GROUP BY id
    ```

2. 各ユーザーに割り当てられたタスクの平均期間を計算し、平均タスク期間が7日を超えるユーザーのみを含めてください。「タスクの期間」は「taskのupdated_atとcreated_atの差」で計算します。
- SQL
    ```sql
    ```

3. チームごとに各タスクに対する平均コメント数を計算し、平均コメント数が2を超えるタスクのみを表示してください。
- SQL
    ```sql
    ```
