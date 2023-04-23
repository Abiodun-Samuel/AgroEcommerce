<template>
  <div class="container mt-2">
    <div class="row rounded">
      <div class="productadvert p-3 shadow-sm">
        <p class="lead">
          We have fresh Agricultural Products for you, Check them out
        </p>
        <Link :href="route('product-page')" class="btn btn-success rounded-pill"
          >Products</Link
        >
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<style lang="css" scoped>
.productadvert {
  background: url("@/assets/images/bg/product-bg.jpg");
  background-position: center;
  background-size: cover;
  text-align: center;
}
</style>