<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import NoResult from "@/Components/Common/NoResult.vue";
import BlogComponent from "@/Components/Common/BlogComponent.vue";

const props = defineProps(["blogs"]);
const step_one = {
  slug: "Blogs",
  link: false,
  route_name: "",
};
</script>

<template>
  <Head title="Blogs" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <img src="@/assets/images/bg/coming-soon.jpg" class='img-fluid mt-2' alt="" />
        </div>
      </div>
      <!-- <div class="row mt-1" v-if="blogs.length">
        <div
          v-for="blog in blogs"
          :key="blog.id"
          class="col-lg-4 col-md-6 col-12 my-1"
        >
          <BlogComponent :blog="blog" />
        </div>
      </div>
      <div v-else class="row">
        <div class="col-12 text-center">
          <NoResult text="No blogs" />
          <Link class="btn rounded-pill btn-success mt-1" :href="route('home')"
            >Home</Link
          >
        </div>
      </div> -->
    </div>
  </GuestLayout>
</template>
