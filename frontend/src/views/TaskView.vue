<template>
    <div>
        <h2 v-if="task.team">{{ task.team.name }} / {{ task.title }}</h2>
        <h3>内容</h3>
        <p>{{ task.body }}</p>

        <h2>コメント</h2>
        <div v-for="comment in comments" :key="comment.id" class="comment">
            <p>{{ comment.message }}</p>
            <p>{{ comment.created_at }} by {{ comment.user.name }}</p>
        </div>
    </div>
</template>

<style>
.comment + .comment {
    border-top: 2px solid gray;
}
</style>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router'

const route = useRoute()
const task = ref({})
const comments = ref({})

onMounted(async function() {
    try {
        const [taskRes, CommentsRes] = await Promise.all([
            axios.get(`/api/tasks/${route.params.id}`),
            axios.get(`/api/tasks/${route.params.id}/comments`),
        ])
        task.value = taskRes.data[0]
        comments.value = CommentsRes.data
    } catch (err) {
        console.log(err); // エラー処理、ページの状態管理は後で
    }
})
</script>
