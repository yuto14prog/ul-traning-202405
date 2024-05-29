<template>
    <h2></h2>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router'

export default {
    name: 'TaskView',
    setup() {
        const route = useRoute()
        let task = ref([])

        onMounted(async function() {
            const url = `/api/tasks/${route.params.id}`
            const taskRes = await axios.get(url)
            task.value = taskRes.data
        })

        return {
            task,
        }
    },
}
</script>
