<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import HeroComponent from "@/Components/Home/HeroComponent.vue";
import CategoryComponent from "@/Components/Home/CategoryComponent.vue";
import ProductsSectionComponent from "@/Components/Home/ProductsSectionComponent.vue";
import PromotionComponent from "@/Components/Home/PromotionComponent.vue";

defineProps(["products"]);
</script>

<template>
  <Head title="Home" />
  <GuestLayout>
    <HeroComponent />
    <CategoryComponent />
    <ProductsSectionComponent :products="products" />
    <PromotionComponent />
  </GuestLayout>
</template>
