<template>
  <div>
    <input v-model="email" /><button v-on:click="createUser">送信</button>
    <ul>
      <li v-for="user in users" :key="user.id">{{ user.name }}: {{ user.email }}</li>
    </ul>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios' // ①

export default {
  name: 'AjaxView',
  setup() {
    const users = ref([]) // ②
    onMounted(async function () {
      // ③
      const url = '/api/users'
      const res = await axios.get(url) // ④
      users.value = res.data // ⑤
    })

    const email = ref('')
    const createUser = async function () {
      const url = '/api/users'
      const res = await axios.post(url, {
        name: 'dummy',
        password: 'password',
        role: 0,
        email: email.value
      }) // ④
      users.value.push(res.data) // ⑤
    }

    return { users, email, createUser }
  }
}
</script>