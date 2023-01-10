<template>
  <div class="col-12 text-center">
    <img
      src="@/assets/images/img/no-result.svg"
      alt="no product"
      class="m-auto"
      style="width: 250px"
      loading="lazy"
    />
    <h5 class="text-secondary fw-bolder my-0 py-0">{{ text }}</h5>
    <Link
      v-if="link"
      style="margin-top: 5px"
      :href="route(route_name)"
      class="btn btn-outline-success rounded-pill"
      >{{ route_text }}</Link
    >
  </div>
</template>

<script setup>
defineProps(["text", "link", "route_name", "route_text"]);
</script>

<style lang="css" scoped>
</style>