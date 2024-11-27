<script setup>
defineProps({
  message: String,
  showModal: {
    type: Boolean,
    required: true
  }
})
</script>

<template>
  <transition name="modal-fade">
    <div v-if="showModal" class="modal-container">
      {{ message }}
    </div>
  </transition>
</template>

<style scoped>
.modal-container {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 10px;
  right: 10px;
  width: auto;
  height: 50px;
  padding: 0 10px;
  background-color: #5ca4a9;
  color: white;
  border-radius: 6px;
  z-index: 1000;
  transform: translateY(100%);
  transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
  opacity: 0;
}

.modal-fade-enter-active, .modal-fade-leave-active {
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.modal-fade-enter, .modal-fade-leave-to {
  opacity: 0;
  transform: translateY(100%);
}

.modal-fade-enter-to, .modal-fade-leave {
  opacity: 1;
  transform: translateY(0);
}
</style>