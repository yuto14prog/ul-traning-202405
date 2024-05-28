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
            <td>{{ dummy }}</td>
        </tr>
    </table>
  </div>
</template>

<style scoped>
    
</style>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
  name: 'HomeView',
  setup() {
    let tasks = ref({})

    onMounted(async function() {
        const url = '/api/me/tasks'
        const res = await axios.get(url)
        tasks.value = await res.data
    })

    return {
        tasks,
    }
  }
}
</script>
