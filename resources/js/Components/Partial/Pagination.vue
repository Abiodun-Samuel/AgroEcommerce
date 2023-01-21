<template>
  <div v-if="links.length > 3">
    <div class="d-flex justify-content-end">
      <template v-for="(link, p) in links" :key="p">
        <div
          v-if="link.url === null"
          class="
            btn btn-sm
            border
            rounded
            bg-transparent
            text-secondary
            not-allowed
          "
          v-html="link.label"
        />
        <Link
          v-else
          class="btn btn-sm border rounded"
          :class="{ 'bg-success text-light': link.active }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps(["links"]);
</script>

<style lang='css' scoped>
a:hover {
  background: var(--green-0);
  color: var(--black);
}
.not-allowed {
  cursor: not-allowed;
}
</style>