<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";

defineProps([
  "users_count",
  "categories_count",
  "products_count",
  "orders_count",
]);

const step_one = {
  slug: "Promotions",
  link: false,
  route_name: null,
};
</script>

<template>
  <Head title="Promotions" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />

    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Users</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ users_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/users.png"
                alt="users icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Categories</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ categories_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/subcategory.png"
                alt="category icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Orders</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ orders_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/orders.png"
                alt="orders icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Products</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ products_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/product.png"
                alt="products icon"
              />
            </div>
          </div>
        </div>
      </div>

      <hr />
    </div>
  </AdminLayout>
</template>

<style scoped>
.counters {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1.5px solid var(--green);
}
.counters h6 {
  background: var(--green-0);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2px;
  border-radius: 50%;
  height: 30px;
  width: 30px;
}
</style>