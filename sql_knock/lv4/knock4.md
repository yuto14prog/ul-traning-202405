1. 特定のチームにおける全てのタスクと、それに対するコメントの数を取得するクエリを書いてください。
```sql
SELECT tasks.*, count(comments.task_id) as comment_count
FROM tasks
LEFT OUTER JOIN comments ON tasks.id = comments.task_id
WHERE tasks.team_id = 1
GROUP BY tasks.id;
```

2. 特定のユーザーがアサインされているタスクのタイトルと、各タスクに対するコメントの内容を取得するクエリを書いてください。
```sql
SELECT tasks.title, comments.message
FROM tasks
LEFT OUTER JOIN comments ON tasks.id = comments.task_id
WHERE tasks.assignee_id = 1;
```

3. 特定のタスクに対する全てのコメントの詳細と、そのコメントを書いたユーザーの名前を取得するクエリを書いてください。
```sql
```

4. 特定のユーザーがアサインされているタスクの数を取得するクエリを書いてください。
```sql
```

5. 全てのチームと、そのチームに所属しているメンバーの数を取得するクエリを書いてください。
```sql
```
