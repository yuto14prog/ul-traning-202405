1. 全てのタスクとそれに対応するチーム名を取得するクエリを書いてください。
```sql
SELECT tasks.*, teams.name as team_name FROM tasks JOIN teams ON tasks.team_id = teams.id;
```

2. 特定のユーザーがアサインされているタスクを取得するクエリを書いてください。
```sql
SELECT tasks.*, users.name as username
FROM tasks
JOIN users ON tasks.assignee_id = users.id
WHERE tasks.assignee_id = 1;
```

3. 特定のチームに所属している全てのメンバーの情報を取得するクエリを書いてください。
```sql
SELECT members.team_id, users.* FROM members
JOIN users ON members.user_id = users.id
WHERE team_id = 1;
```

4. 特定のユーザーが作成したチームの情報を取得するクエリを書いてください。
```sql
SELECT * FROM teams WHERE owner_id = 1;
```

5. 特定のタスクのステータスを更新するクエリを書いてください。
```sql
UPDATE tasks SET status = 1 WHERE id = 1;
```
