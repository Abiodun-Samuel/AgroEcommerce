<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import ProductAdvert from "@/Components/Partial/ProductAdvert.vue";

const step_one = {
  slug: "HarvestYield Farm",
  link: false,
  route_name: "",
};
</script>

<template>
  <Head title="HarvestYield Farm" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <section id="service-page">
      <div class="container">
        <div class="mt-3">
          <h3 class="my-1 text-success fw-bolder">HarvestYield Farm</h3>
          <h4 class="my-1 fw-bold">Production of Vegetable Crops</h4>
        </div>
        <p class="lead">
          Through our 10Ha Farmland focused on vegetable crop production i,e
          Tomato, Cucumber, Sweetcorn, Special Watermelon and Pepper, we provide
          farm management and consultancy services and partner with other
          reputable companies to offer soil analysis, fertilizer and manure
          analysis and other laboratory services which are necessary for
          successful growing.
        </p>

        <ProductAdvert />
      </div>
    </section>
  </GuestLayout>
</template>
