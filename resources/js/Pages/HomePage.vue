<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import HeroComponent from "@/Components/Home/HeroComponent.vue";
import CategoryComponent from "@/Components/Home/CategoryComponent.vue";
import ProductsSectionComponent from "@/Components/Home/ProductsSectionComponent.vue";
import ProductsDayComponent from "@/Components/Home/ProductsDayComponent.vue";
import PromotionComponent from "@/Components/Home/PromotionComponent.vue";
import BlogSectionComponent from "@/Components/Home/BlogSectionComponent.vue";
import GallerySectionComponent from "@/Components/Home/GallerySectionComponent.vue";
import ContactComp from "@/Components/Common/ContactComp.vue";
import { computed } from "vue";
import { usePage, Head } from "@inertiajs/vue3";

defineProps(["products", "promotions", "blogs", 'galleries']);
const settings = computed(() => usePage().props.data.settings);
</script>

<template>
    <Head title="Home" />
    <GuestLayout>
        <HeroComponent />
        <CategoryComponent />
        <ProductsSectionComponent :products="products" />
        <GallerySectionComponent v-if="galleries.length" :galleries="galleries" />
        <ProductsDayComponent :products="products" />
        <PromotionComponent
            :promotions="promotions"
            v-if="settings.promotion == true"
        />
        <ContactComp />
        <BlogSectionComponent v-if="blogs.length" :blogs="blogs" />
    </GuestLayout>
</template>
