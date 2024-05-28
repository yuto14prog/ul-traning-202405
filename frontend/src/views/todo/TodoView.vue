<template>
  <div class="margin-top">
    <input type="text" v-model="input">
    <button type="submit" :on-click="addTodo">登録</button>

    <div v-for="todo in todos" :key="todo.id">
        <input type="checkbox" :id="'checkbox_' + todo.id" @change="toggleDone(todo.id)">
        <label :for="'checkbox_' + todo.id" :class="{'line': todo.done}">{{ todo.text }}</label>
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

    }

    const toggleDone = function(id) {
        todos.map((todo) => {
            if(todo.id === id) todo.done = !todo.done
        })
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