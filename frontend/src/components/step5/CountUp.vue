<template>
  <div>
    <p>{{ count }}</p>
    <button v-on:click="countUp">カウントアップ</button>
  </div>
</template>
<script>
import { ref } from 'vue'

export default {
  name: 'CountUp',
  setup() {
    const count = ref(0)
    const countUp = function() {
      count.value += 1
    }

    return {
      count,
      countUp
    }
  }
}
</script>