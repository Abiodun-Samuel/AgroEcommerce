<script setup>
import Header from "@/Components/Partial/Header.vue";
import Footer from "@/Components/Partial/Footer.vue";
</script>

<template>
  <Header />
  <div>
    <slot />
  </div>
  <Footer />
</template>
