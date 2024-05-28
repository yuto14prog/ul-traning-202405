<template>
  <div class="home">
    <h2>アサインされているタスク</h2>
    <table>
        <th>チーム</th>
        <th>タスクID</th>
        <th>タイトル</th>
        <th>担当者</th>
        <th>作成日時</th>
        <th>操作</th>
        <tr v-for="(task, index) in tasks" :key="index">
            <td>{{ task.team_id }}</td>
            <td>{{ task.id }}</td>
            <td>{{ task.title }}</td>
            <td>{{ task.assignee_id }}</td>
            <td>{{ task.created_at }}</td>
            <td>dummy</td>
        </tr>
    </table>

    <h2>所属しているチーム</h2>
    <table>
        <th>チームID</th>
        <th>チーム名</th>
        <tr v-for="(team, index) in teams" :key="index">
            <td>{{ team.id }}</td>
            <td>{{ team.name }}</td>
        </tr>
    </table>
  </div>
</template>

<style scoped>
    table {
        width: 100%;
    }
    th {
        background-color: rgb(197, 197, 197);
    }
    td {
        text-align: center;
    }
</style>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
  name: 'HomeView',
  setup() {
    let tasks = ref({})
    let teams = ref({})

    onMounted(async function() {
        const tasksUrl = '/api/me/tasks'
        const tasksRes = await axios.get(tasksUrl)
        tasks.value = tasksRes.data

        const teamsUrl = '/api/me/teams'
        const teamsRes = await axios.get(teamsUrl)
        teams.value = teamsRes.data
    })

    return {
        tasks,
        teams,
    }
  }
}
</script>
