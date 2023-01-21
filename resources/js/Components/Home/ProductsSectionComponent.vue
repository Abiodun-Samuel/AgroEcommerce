<template>
  <div class="products__section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="products__section__header">
            <h2>Select product options</h2>
            <h3>Featured Products</h3>
          </div>
        </div>
        <div class="col-lg-12 my-2">
          <div class="products__section__header-button">
            <Link
              :href="route('product-page')"
              class="btn btn-md btn-outline-success rounded-pill"
            >
              All Products
            </Link>
            <Link
              :href="route('product-page', { query: 'top_rated' })"
              class="btn btn-md btn-outline-success rounded-pill"
            >
              Top Rated
            </Link>
            <Link
              :href="route('product-page', { query: 'top_selling' })"
              class="btn btn-md btn-outline-success rounded-pill"
            >
              Top Selling
            </Link>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <template v-if="products.data.length">
          <div
            v-for="(product, index) in products.data"
            :key="product.id"
            data-aos="fade-up"
            :data-aos-delay="index * 50"
            class="col-lg-3 col-md-6 col-sm-6 col-6 d-flex align-items-stretch"
          >
            <ProductComponent :product="product" />
          </div>
        </template>
        <template v-else>
          <div class="col-12 text-center">
            <img
              src="@/assets/images/img/no-result.svg"
              alt="no product"
              class="m-auto"
              style="width: 300px"
            />
            <p class="text-secondary fw-bolder my-0 py-0">
              Oops, No products found.
            </p>
            <Link
              style="margin-top: 5px"
              :href="route('product-page')"
              class="btn btn-outline-success rounded-pill"
              >Products</Link
            >
          </div>
        </template>
      </div>

      <div class="row mt-1">
        <Pagination :links="products.links" />
      </div>
    </div>
  </div>
</template>

<script setup>
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps(["products"]);
</script>

<style lang="css" scoped>
.products__section {
  position: relative;
  padding: 4rem 0;
}
.products__section__header h2 {
  font-size: 1.3rem;
  font-weight: bolder;
  color: var(--green);
}
.products__section__header h3 {
  font-size: 2rem;
  font-weight: bolder;
}
.products__section__header-button {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}
</style>