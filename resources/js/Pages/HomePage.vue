<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import HeroComponent from "@/Components/Home/HeroComponent.vue";
import CategoryComponent from "@/Components/Home/CategoryComponent.vue";
import ProductsSectionComponent from "@/Components/Home/ProductsSectionComponent.vue";
import PromotionComponent from "@/Components/Home/PromotionComponent.vue";
import { computed } from "vue";
import { usePage, Head } from "@inertiajs/vue3";

defineProps(["products", "promotions"]);
const settings = computed(() => usePage().props.data.settings);
</script>

<template>
  <Head title="Home" />
  <GuestLayout>
    <HeroComponent />
    <CategoryComponent />
    <ProductsSectionComponent :products="products" />
    <PromotionComponent
      :promotions="promotions"
      v-if="settings.promotion == true"
    />
  </GuestLayout>
</template>
