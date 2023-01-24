<template>
  <div class="product__category bg-white shadow-sm p-1 rounded">
    <h4 class="text-dark fw-bolder">Categories</h4>
    <hr />
    <Dropdown v-for="category in categories" :key="category.id">
      <DropdownItem>
        <template #dropdown-trigger>
          <div class="d-flex align-items-center position-relative">
            <img
              style="height: 25px; width: 25px"
              :src="JSON.parse(category.banner_img).img_url"
              alt="category icon"
              class="rounded-circle"
            />
            <div class="position-relative d-flex">
              <span style="margin-left: 8px">{{ category.title }}</span>

              <span class="dropdown-trigger-highlight bg-danger rounded-circle">
                {{ category.subcategory.length }}
              </span>
            </div>
          </div>
        </template>
        <template #dropdown-content>
          <Link
            v-for="(subcategory, index) in category.subcategory"
            :key="index"
            class="d-flex align-items-center justify-content-between"
            :href="route('product-page', subcategory.slug)"
            style="margin: 7px 0px"
            preserve-scroll
          >
            <div class="d-flex align-items-center">
              <Icon
                icon="gg:edit-black-point"
                width="15"
                style="margin-right: 5px"
              />
              <span>{{ subcategory.title }}</span>
            </div>
            <div class="highlight">
              <span>{{ subcategory.products.length }}</span>
            </div>
          </Link>
        </template>
      </DropdownItem>
    </Dropdown>
  </div>

  <div class="product__category bg-white my-1 shadow-sm p-1 rounded">
    <h4 class="text-dark fw-bolder">Filter</h4>
    <hr />
    <Link
      preserve-scroll
      class="btn btn-sm btn-outline-primary w-100 rounded"
      :href="route('product-page', { all_products: true })"
    >
      All Products
    </Link>
    <hr />
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filterOrigin"
        id="filterProductsByPrice1"
        @input="
          emit('filterByPriceRange', {
            price_max: 500,
            price_min: 0,
          })
        "
      />
      <label
        class="form-check-label text-primary small"
        for="filterProductsByPrice1"
      >
        Price Range: &#8358; 0 - &#8358; 500
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filterOrigin"
        id="filterProductsByPrice2"
        @input="
          emit('filterByPriceRange', {
            price_max: 1000,
            price_min: 500,
          })
        "
      />
      <label
        class="form-check-label text-primary small"
        for="filterProductsByPrice2"
      >
        Price Range: &#8358; 500 - &#8358; 1000
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filterOrigin"
        id="filterProductsByPrice3"
        @input="
          emit('filterByPriceRange', {
            price_max: 10000,
            price_min: 1000,
          })
        "
      />
      <label
        class="form-check-label text-primary small"
        for="filterProductsByPrice3"
      >
        Price Range: Above &#8358; 1000
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filterOrigin"
        id="product_order_seven"
        @input="emit('filterTopProducts', { format: 'with_discount' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_seven"
      >
        Product: With discount
      </label>
    </div>

    <hr />
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filtercheckbox"
        id="product_order_one"
        @input="emit('filterResultFormat', { result_format: 'newest' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_one"
      >
        Product: Newest
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filtercheckbox"
        id="product_order_two"
        @input="emit('filterResultFormat', { result_format: 'oldest' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_two"
      >
        Product: Oldest
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        ref="checkboxes"
        class="form-check-input"
        type="radio"
        name="filtercheckbox"
        id="product_order_three"
        @input="emit('filterResultFormat', { result_format: 'alpha' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_three"
      >
        Product: A-Z
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        ref="checkboxes"
        name="filtercheckbox"
        id="product_order_four"
        @input="emit('filterResultFormat', { result_format: 'non_alpha' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_four"
      >
        Product: Z-A
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        name="filtercheckbox"
        id="product_order_five"
        @input="emit('filterTopProducts', { format: 'top_selling' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_five"
      >
        Product: Top Selling
      </label>
    </div>
    <div class="form-check" style="margin: 7px 0">
      <input
        class="form-check-input"
        type="radio"
        ref="checkboxes"
        name="filtercheckbox"
        id="product_order_six"
        @input="emit('filterTopProducts', { format: 'top_rated' })"
      />
      <label
        class="form-check-label text-primary small"
        for="product_order_six"
      >
        Product: Top Rated
      </label>
    </div>
    <hr />
    <div>
      <button
        @click="clearFilter"
        class="btn btn-sm btn-outline-danger w-100 rounded"
      >
        Clear
      </button>
    </div>
  </div>
</template>

<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import Dropdown from "@/Components/Common/Dropdown.vue";
import DropdownItem from "@/Components/Common/DropdownItem.vue";
import { Icon } from "@iconify/vue";

const emit = defineEmits(["filterByPriceRange"]);

const categories = computed(() => usePage().props.data.categories);

const clearFilter = () => {
  const checkboxes = document.querySelectorAll(".form-check-input");
  checkboxes.forEach((checkbox) => (checkbox.checked = false));
  emit("clearFilter");
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
.dropdown-trigger-highlight {
  padding: 3px;
  font-size: 9px;
  display: inline-block;
  height: 13px;
  width: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
}
</style>