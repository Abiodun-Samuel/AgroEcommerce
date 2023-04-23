<template>
  <Head title="All Orders" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <div v-if="orders.length" class="row">
        <div
          v-for="(order, index) in orders"
          :key="order + index"
          class="col-lg-6 col-md-6 col-12"
        >
          <div class="order__container my-1 shadow-sm rounded bg-white p-1">
            <h4 class="text-primary fw-bolder"><b>Order</b> - {{ ++index }}</h4>
            <hr />
            <p><b>Ref:</b> {{ order.id }}</p>
            <p><b>Date Ordered:</b> {{ formatTime(order.created_at) }}</p>
            <hr />
            <p><b>Order Status</b></p>
            <div class="d-flex gap-1 flex-wrap">
              <div
                class="alert p-1"
                :class="
                  order.order_status == 'Processing'
                    ? 'alert-primary'
                    : order.order_status == 'In Progress'
                    ? 'alert-info'
                    : order.order_status == 'Delivered'
                    ? 'alert-success'
                    : order.order_status == 'Cancelled'
                    ? 'alert-danger'
                    : 'alert-warning'
                "
                role="alert"
              >
                {{ order.order_status }}
              </div>
              <div
                v-if="order.order_status == 'Delivered'"
                class="alert alert-success p-1"
                role="alert"
              >
                Delivered on {{ formatTime(order.delivery_date) }}
              </div>
            </div>
            <div class="d-flex gap-1 flex-wrap">
              <div
                v-if="order.payment_status == 'Paid'"
                class="alert alert-success p-1"
                role="alert"
              >
                Paid
              </div>
              <div v-else class="alert alert-danger p-1" role="alert">
                Not Paid
              </div>

              <div
                v-if="order.payment_status == 'Paid'"
                class="alert alert-success p-1"
                role="alert"
              >
                Paid on {{ formatTime(order.payment_date) }}
              </div>
            </div>
            <hr />
            <Link
              :href="route('admin.order.show', order.id)"
              class="btn btn-primary w-100"
              >View Details</Link
            >
          </div>
        </div>
      </div>

      <div v-else class="row">
        <div class="text-center">
          <NoResult text="You have no orders" :link="false" />
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import NoResult from "@/Components/Common/NoResult.vue";
import Modal from "@/Components/Common/Modal.vue";
import { toast, formatTime } from "@/utils/helper";

const props = defineProps(["orders"]);
const showDeleteProductModal = ref(false);
const step_one = {
  slug: "Orders",
  link: false,
  route_name: null,
};
</script>