<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import ProductAdvert from "@/Components/Partial/ProductAdvert.vue";

const step_one = {
  slug: "AgriCourt Ventures",
  link: false,
  route_name: "",
};
</script>

<template>
  <Head title="AgriCourt Ventures" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <section id="service-page">
      <div class="container">
        <div class="mt-3">
          <h3 class="my-1 text-success fw-bolder">AgriCourt Ventures</h3>
          <h4 class="my-1 fw-bold">Sales of Agro-Input Products</h4>
        </div>
        <p class="lead lh-base">
          Through in-depth research and development, we’ve focused on serving
          the needs of farmers through provision of quality inputs(AgriCourt
          Ventures) such as high quality seeds, granular and water soluble
          fertilizers, irrigation systems, Growing Media (Cocopeat, Peat moss,
          Worm compost), seedling trays, mulch film, grow bags, modern and
          locally adapted green houses and net houses, green house covers, shade
          nets, insect nets, high quality crop protection products and several
          other agricultural inputs.
        </p>

        <ProductAdvert />
      </div>
    </section>
  </GuestLayout>
</template>
