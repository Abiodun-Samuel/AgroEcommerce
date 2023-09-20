<template>
  <div id="blog">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section__header">
            <h2>Check out our blogs</h2>
            <h3>Featured Blogs</h3>
          </div>
        </div>
      </div>

      <div class="row mt-2">
        <div
          v-for="blog in blogs"
          :key="blog.id"
          class="col-lg-3 col-md-6 col-12 d-flex align-items-stretch"
        >
          <BlogComponent :blog="blog" />
        </div>
      </div>

      <!-- <div class="row mt-1">
        <Pagination :links="blogs.links" />
      </div> -->
    </div>
  </div>
</template>

<script setup>
// import Pagination from "@/Components/Partial/Pagination.vue";
import BlogComponent from "@/Components/Common/BlogComponent.vue";

defineProps(["blogs"]);
</script>

<style scoped>
#blog {
  position: relative;
  padding: 4rem 0;
  background: url("@/assets/images/bg/product-bg.jpg") no-repeat;
  background-position: center;
  background-size: cover;
}
.section__header h2 {
  font-size: 1.3rem;
  font-weight: bolder;
  color: var(--green);
}
.section__header h3 {
  font-size: 2rem;
  font-weight: bolder;
}
</style>