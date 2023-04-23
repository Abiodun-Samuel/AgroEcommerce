<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import ProductAdvert from "@/Components/Partial/ProductAdvert.vue";

const step_one = {
  slug: "Agro-Input",
  link: false,
  route_name: "",
};
</script>

<template>
  <Head title="Agro-Input" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <section id="service-page">
      <div class="container">
        <div class="mt-3">
          <h3 class="my-1 text-success fw-bolder">Agro-Input</h3>
          <h4 class="my-1 fw-bold">Products Claim(s), Research & Promotion</h4>
        </div>

        <p class="lead">
          The rate at which small-scale farmers and commercial farmers lose
          their farm produce to the negative impacts of adulterated and low
          quality input is enormous. We stand out and authenticate manufacturer
          claims on agro-input products approved by SON and NAFDAC with quality
          research on our 3ha research facility and promote to a network of over
          10,000 farmers in our database (as at December 2020).
        </p>

        <p class="lead">
          We identify problems in production, search for product(s) to solve the
          problem, conduct trial(s) to affirm manufacturer claims about such
          product, promote the product brand(s) to users (farmers) and make such
          product available through our Agro-input dealers' network nationwide.
        </p>

        <ProductAdvert />
      </div>
    </section>
  </GuestLayout>
</template>
