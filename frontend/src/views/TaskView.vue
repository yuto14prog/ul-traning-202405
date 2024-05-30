<template>
    <div>
        <h2>{{ task.team.name }} / {{ task.title }}</h2>
        <h3>内容</h3>
        <p>{{ task.body }}</p>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router'

export default {
    name: 'TaskView',
    setup() {
        const route = useRoute()
        let task = ref({
            team: {
                name: ''
            }
        })

        onMounted(async function() {
            const url = `/api/tasks/${route.params.id}`
            const taskRes = await axios.get(url)
            task.value = taskRes.data[0]
            console.log(taskRes.data[0]);
        })

        return {
            task,
        }
    },
}
</script>
