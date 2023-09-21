<template>
    <div class="container my-5">
      <div class="row rounded">
        <div class="productadvert p-3 shadow">
          <p class="lead">
           Do you have any enquiry about our products and services? You can contact us.
          </p>
          <Link :href="route('contact')" class="btn btn-success rounded-pill"
            >Contact Us</Link
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