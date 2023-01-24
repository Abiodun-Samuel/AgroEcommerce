<template>
  <GuestLayout>
    <bread-crump :step_one="sub_category.title" />
    <div style="height: 100vh"></div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";

const props = defineProps({
  sub_category: Array,
});

const data = computed(() => usePage().props);
const slug = route().params;
</script>

<style lang="css" scoped>
</style>