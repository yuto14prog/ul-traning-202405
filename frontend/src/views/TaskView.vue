<template>
    <div v-if="status === 'available'">
        <div v-if="task.status === 1" class="done">
            <p>このタスクは完了しました</p>
        </div>

        <h2 v-if="task.team">{{ task.team.name }} / {{ task.title }}</h2>
        <h3>内容</h3>
        <p>{{ task.body }}</p>

        <h2>コメント</h2>
        <div v-for="comment in comments" :key="comment.id" class="comment">
            <p>{{ comment.message }}</p>
            <p>{{ formatDate(comment.created_at) }} by {{ comment.user.name }}</p>
        </div>

        <span>本文</span>
        <form @submit.prevent>
            <textarea rows="5" v-model="message"></textarea>
            <span v-if="errorMessage" class="error">{{ errorMessage }}</span><br>
            <div v-if="task.status === 0">
                <label for="kind">完了報告とする</label>
                <input type="checkbox" id="kind" v-model="kind"><br>
            </div>
            <button type="submit" @click="submit">送信</button>
        </form>
    </div>

    <div v-else-if="status === 'loading'">
        <span>Loading...</span>
    </div>

    <div v-else>
        <h2>ログインしてください</h2>
    </div>
</template>

<style>
.comment + .comment {
    border-top: 2px solid gray;
}
textarea {
    width: 100%;
}
.error {
    color: red;
}
.done {
    margin-top: 1rem;
    border: 1px solid black;
}
</style>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router'

const route = useRoute()
const task = ref({})
const comments = ref({})
const message = ref('')
const kind = ref(0)
const errorMessage = ref()
const status = ref('loading')

onMounted(async function() {
    try {
        const [taskRes, CommentsRes] = await Promise.all([
            axios.get(`/api/tasks/${route.params.id}`),
            axios.get(`/api/tasks/${route.params.id}/comments`),
        ])
        task.value = taskRes.data[0]
        comments.value = CommentsRes.data
        status.value = 'available'
    } catch (err) {
        status.value = null
    }
})

const submit = async function() {
    try {
        const res = await axios.post(`/api/tasks/${route.params.id}/comments`, {
            message: message.value,
            kind: Number(kind.value),
        })
        comments.value.push(res.data);
        message.value = ''
        errorMessage.value = ''
        if (kind.value == 1) {
            task.value.status = 1
        }
    } catch (err) {
        if (axios.isAxiosError(err) && err.response.status == 422) {
            errorMessage.value = '本文は必須です'
        } else {
            errorMessage.value = '予期せぬエラーです'
        }
    }
}

const formatDate = function(created_at) {
    let date = new Date(created_at);
    let formatted = date.toLocaleString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' });
    return formatted
}
</script>
