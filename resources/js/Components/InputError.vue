<script setup>
defineProps(["message"]);
</script>

<template>
  <div v-if="message" class="alert alert-danger p-1" role="alert">
    {{ message }}
  </div>
</template>
