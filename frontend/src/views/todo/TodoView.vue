<template>
  <div class="margin-top">
    <input type="text" v-model="input">
    <button type="submit" @click="addTodo">登録</button>

    <div v-for="todo in todos" :key="todo.id">
        <input type="checkbox" @change="toggleDone(todo.id)" v-show="!todo.done" :checked="todo.done">
        <span :class="{'line': todo.done}" @click="toggleDone(todo.id)">{{ todo.text }}</span>
    </div>
  </div>
</template>
<style scoped>
    .margin-top {
        margin-top: 30px;
    }
    .line {
        text-decoration: line-through;
    }
</style>
<script>
import { reactive, ref } from 'vue'

export default {
  name: 'TodoView',
  setup() {
    const input = ref('')
    let todos = reactive([
        {id: 1, text: 'task1', done: false },
        {id: 2, text: 'task2', done: false },
        {id: 3, text: 'task3', done: false },
    ])

    const addTodo = function() {
        if (input.value === '') return

        todos.push({
            id: todos.length + 1,
            text: input.value,
            done: false,
        })

        input.value = ''
    }

    const toggleDone = function(id) {
        const todo = todos.find(todo => todo.id === id)
        todo.done = !todo.done
    }

    return {
      input,
      todos,
      addTodo,
      toggleDone,
    }
  }
}
</script>