<template>
  <div v-if="errors" class="row">
    <div class="col-lg-12">
      <div class="alert alert-danger">
        <p
          class="mx-1"
          style="padding-top: 5px"
          v-for="val in errors"
          :key="val"
        >
          {{ val }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps(["errors"]);
</script>