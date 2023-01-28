<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";

const props = defineProps(["orders"]);
</script>

<template>
  <Head title="User" />

  <UserLayout>
    <DashboardBreadcrump />

    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Orders</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ orders?.length }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/orders.png"
                alt="users icon"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
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