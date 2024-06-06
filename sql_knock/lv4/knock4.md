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
SELECT comments.*, users.name
FROM comments
JOIN users ON comments.author_id = users.id
WHERE comments.task_id = 1;
```

4. 特定のユーザーがアサインされているタスクの数を取得するクエリを書いてください。
```sql
SELECT count(tasks.id) as tasks_count
FROM tasks
JOIN users ON tasks.assignee_id = users.id
WHERE users.id = 1;
```

5. 全てのチームと、そのチームに所属しているメンバーの数を取得するクエリを書いてください。
```sql
SELECT teams.*, count(members.id) as member_count
FROM teams
JOIN members ON teams.id = members.team_id
GROUP BY teams.id;
```
