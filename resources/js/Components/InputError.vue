<script setup>
defineProps(["message"]);
</script>

<template>
    <div
        v-if="message"
        class="alert alert-danger px-1"
        style="padding-top: 5px; padding-bottom: 5px"
        role="alert"
    >
        <span>{{ message }}</span>
    </div>
</template>
