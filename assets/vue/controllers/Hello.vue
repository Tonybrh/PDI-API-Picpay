<script setup>
  import { ref } from 'vue';
  const message = ref('Hello Vue 3');

  const greet = () => {
    message.value = 'Hello Vue 3 from button click';
  }
</script>
<template>
  <div class="homeTitleDiv">
    <h1>Crie sua transação !</h1>
    <button @click="greet">Click me</button>
  </div>
</template>
<style scoped>
h1 {
  color: #42b983;
}
button {
  background-color: #42b983;
  color: white;
  padding: 10px;
  border: none;
  cursor: pointer;
}
</style>
