<template>
  <GuestLayout>
    <BreadCrump
      v-if="route().params.subcategory"
      :step_one="step_one"
      :step_two="step_two"
    />
    <BreadCrump v-else :step_one="step_one" />

    <div id="product">
      <div class="container">
        <div class="row">
          <!-- filter options  -->
          <div class="col-lg-3 col-md-4 my-2">
            <ProductPageSideBar />
          </div>
          <div class="col-lg-9 col-md-8 my-2">
            <div class="row mb-3">
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
                    <option selected value="default">All Products</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
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

            <div class="row mt-1">
              <Pagination :links="products.links" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { computed, ref } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { Icon } from "@iconify/vue";
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import ProductPageSideBar from "@/Components/Common/ProductPageSideBar.vue";
import { unslugify } from "@/utils/helper";
import moment from "moment";

const step_one = {
  slug: "Products",
  link: route().params?.subcategory ? true : false,
  route_name: route().params?.subcategory ? "product-page" : null,
};
const step_two = {
  slug: unslugify(route()?.params?.subcategory),
  link: false,
  route_name: null,
};
const props = defineProps({
  products: Array,
});
const categories = computed(() => usePage().props.value.data.categories);

const result_count = ref("default");
const result_format = ref("default");
const all_products = ref(props.products.data);
function dynamicSort(property, order) {
  if (order == "alpha" || order == "non_alpha") {
    var sortOrder = order == "alpha" ? 1 : -1;
    return function (a, b) {
      if (sortOrder == -1) {
        return b[property].localeCompare(a[property]);
      } else {
        return a[property].localeCompare(b[property]);
      }
    };
  }
}

const filterResultCount = () => {
  // if (result_count.value == "default")
  //   return (all_products.value = props.products.data);
  // all_products.value = props.products.data.slice(0, Number(result_count.value));
};

const filterResultFormat = () => {
  if (result_format.value == "default") {
    all_products.value = props.products.data;
    return all_products.value.sort(function (a, b) {
      return moment(b.updated_at) - moment(a.updated_at);
    });
  }
  if (result_format.value == "alpha" || result_format.value == "non_alpha") {
    all_products.value.sort(dynamicSort("title", result_format.value));
  }
  if (result_format.value == "newest") {
    return all_products.value.sort(function (a, b) {
      return moment(b.updated_at) - moment(a.updated_at);
    });
  }
  if (result_format.value == "oldest") {
    return all_products.value.sort(function (a, b) {
      return moment(a.updated_at) - moment(b.updated_at);
    });
  }
};
</script>

<style lang="css" scoped>
.dropdown-item:hover,
.dropdown:hover {
  background: #f0f0f0;
  color: var(--black);
}
.highlight {
  background: var(--green-0);
  border-radius: 50%;
  display: flex;
  height: 25px;
  width: 25px;
  justify-content: center;
  align-items: center;
  color: var(--black);
}
</style>