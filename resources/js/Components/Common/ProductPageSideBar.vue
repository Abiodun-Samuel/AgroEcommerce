<template>
  <div class="product__category bg-white shadow p-1 rounded">
    <h4 class="text-dark fw-bolder">Categories</h4>
    <hr />
    <div
      v-for="category in categories"
      :key="category.id"
      class="dropdown my-1 rounded"
      style="padding: 5px 0"
    >
      <div
        class="text-secondary d-flex align-items-center justify-content-between"
        href="#"
        role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <div class="d-flex align-items-center">
          <img
            style="height: 30px; width: 30px"
            src="@/assets/images/category_one.jpg"
            alt="category icon"
            class="rounded-circle me-1"
          />
          <span>{{ category.title }}</span>
        </div>
        <div class="highlight">
          <p class="m-0 p-0 d-flex justify-content-end">
            {{ category.sub_category.length }}
          </p>
        </div>
      </div>

      <ul class="dropdown-menu p-0 border-0 shadow">
        <li v-for="(subcategory, index) in category.sub_category" :key="index">
          <Link
            class="
              dropdown-item
              d-flex
              align-items-center
              justify-content-between
            "
            :href="
              route('productsBySubcategory', [category.slug, subcategory.slug])
            "
          >
            <div class="d-flex align-items-center">
              <Icon
                icon="gg:edit-black-point"
                width="18"
                style="margin-right: 5px"
              />
              <span>{{ subcategory.title }}</span>
            </div>
            <div class="highlight">
              <span>{{ subcategory.products.length }}</span>
            </div>
          </Link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
const categories = computed(() => usePage().props.value.data.categories);
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