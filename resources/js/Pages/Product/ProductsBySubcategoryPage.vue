<template>
  <GuestLayout>
    <BreadCrump :step_one="step_one" :step_two="step_two" />
    <div id="product">
      <div class="container">
        <div class="row">
          <!-- filter options  -->
          <div class="col-lg-3 col-md-4 my-2">
            <ProductPageSideBar />
          </div>
          <div class="col-lg-9 col-md-8 my-2">
            <div v-if="all_products.length" class="row mb-3">
              <div
                class="col-12 d-flex justify-content-between align-items-center"
              >
                <div class="filter_one">
                  <select
                    class="form-select"
                    aria-label="Default select example"
                    v-model="result_count"
                    @change="filterResultCount"
                  >
                    <option selected value="all_products">All Products</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                  </select>
                </div>
                <div class="filter_two">
                  <select
                    @change="filterResultFormat"
                    class="form-select"
                    v-model="result_format"
                    aria-label="Default select example"
                  >
                    <option value="default" selected>Default</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="alpha">Name: A-Z</option>
                    <option value="non_alpha">Name: Z-A</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <template v-if="all_products.length">
                <div
                  v-for="product in all_products"
                  :key="product.id"
                  class="col-lg-4 col-md-6 col-sm-6 col-6"
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

            <!-- <div class="row mt-1">
              <Pagination :links="all_products.links" />
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Icon } from "@iconify/vue";
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import ProductPageSideBar from "@/Components/Common/ProductPageSideBar.vue";

const props = defineProps({
  products: Array,
});

const result_count = ref("all_products");
const result_format = ref("default");
const all_products = ref(props.products);

function dynamicSort(property, order) {
  if (order == "alpha") var sortOrder = 1;

  // if (property[0] === "-") {
  //   sortOrder = -1;
  //   property = property.substr(1);
  // }

  return function (a, b) {
    if (sortOrder == -1) {
      return b[property].localeCompare(a[property]);
    } else {
      return a[property].localeCompare(b[property]);
    }
  };
}

const filterResultCount = () => {
  if (result_count.value == "all_products")
    return (all_products.value = props.products);
  all_products.value = props.products.slice(0, Number(result_count.value));
};

const filterResultFormat = () => {
  all_products.value.sort(dynamicSort("title", result_format.value));
};

const step_one = {
  slug: route().params.category_slug,
  link: false,
  route_name: null,
};
const step_two = {
  slug: route().params.subcategory_slug,
  link: false,
  route_name: null,
};
</script>