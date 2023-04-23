<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { computed, ref } from "vue";
import { formatTime } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import html2pdf from "html2pdf.js";
import ImageConverter from "@/Components/Common/ImageConverter.vue";

const props = defineProps(["order"]);

const user = computed(() => usePage().props.auth.user);
const isDownloading = ref(false);
const step_one = {
  slug: "Order",
  link: true,
  route_name: "user.order.index",
};
const step_two = {
  slug: "Order Details",
  link: false,
  route_name: null,
};
const exportToPDF = () => {
  isDownloading.value = true;
  const docTarget = document.getElementById("docContainer");
  html2pdf(docTarget, {
    margin: 1,
    image: { type: "jpeg", quality: 1 },
    filename: `${props.order.id}.pdf`,
  });
  setTimeout(() => {
    isDownloading.value = false;
  }, 2000);
};
</script>

<template>
  <Head title="Order Details" />

  <UserLayout>
    <DashboardBreadcrump :step_one="step_one" :step_two="step_two" />
    <hr />

    <div class="container">
      <div class="my-1 d-flex justify-content-between align-items-center">
        <a
          href="https://wa.link/20q7u6"
          target="_blank"
          class="btn btn-primary rounded d-flex gap-1 align-items-center justify-content-center"
        >
          <Icon icon="clarity:chat-bubble-outline-badged" height="15" />
          Contact Us
        </a>

        <button
          :disabled="isDownloading"
          class="btn btn-sm btn-primary d-flex align-items-center"
          @click="exportToPDF"
        >
          <span
            v-if="isDownloading"
            class="spinner-border spinner-border-sm mx-1"
            role="status"
            aria-hidden="true"
          ></span>
          <span>Download</span>
          <span
            ><Icon height="25" icon="material-symbols:download-sharp"
          /></span>
        </button>
      </div>

      <div
        id="docContainer"
        class="row shadow-sm bg-white mt-1 p-1 rounded justify-content-between"
      >
        <div class="col-lg-6 col-md-6 my-1 company_logo">
          <div class="mb-1">
            <ImageConverter
              url="https://res.cloudinary.com/psalmzie/image/upload/v1682227304/superoagrobase/other/xsh3wilse3i59nuh4ifm.jpg"
              height="30"
            />
          </div>
          <p><b>Ref:</b> {{ order.id }}</p>
          <p><b>Date Ordered:</b> {{ formatTime(order.created_at) }}</p>
        </div>
        <div class="col-lg-4 col-md-6 my-1 company_desc">
          <h4 class="fw-bolder text-success">SuperoAgrobase Inc.</h4>
          <p class="my-0 py-0">
            10, Jimoh Odu Street, Opp Benson B/S, <br />
            Ikorodu Garage, Ikorodu, Lagos.
          </p>
          <p class="my-0 py-0">contact@superoagrobase.com</p>
          <p class="my-0 py-0">+2348157037737</p>
        </div>
        <hr />
        <div class="col-12">
          <h4 class="text-success fw-bolder">User Details</h4>
          <p class="my-0 py-0" style="margin: 3px 0">
            <b>Name:</b> {{ order.name }}
          </p>
          <p class="my-0 py-0" style="margin: 3px 0">
            <b>Email:</b> {{ order.email }}
          </p>
          <p class="my-0 py-0" style="margin: 3px 0">
            <b>Phone:</b> {{ order.phone }}
          </p>
          <p class="my-0 py-0" style="margin: 3px 0">
            <b>Address:</b> {{ order.address }}
          </p>
          <hr />
        </div>
        <div class="col-12">
          <h4 class="text-success fw-bolder">Order Status</h4>
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
          <div class="d-flex gap-3 align-items-center">
            <p>
              <b class="text-success">Delivery Option</b>:
              {{
                order.delivery_option == "office_pickup"
                  ? "Office Pickup"
                  : "Door Delivery"
              }}
            </p>
            <p>
              <b class="text-success">Payment Option</b>:
              {{ order.payment_option == "bank" ? "Bank" : "Cash" }}
            </p>
          </div>
        </div>
        <hr />
        <div class="col-12 my-1">
          <div class="table-responsive" v-if="JSON.parse(order.order_items)">
            <table class="table table-hover table-bordered">
              <thead class="table-dark">
                <tr>
                  <th scope="col">S/N</th>
                  <th scope="col">Title</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                  <th scope="col">Total</th>
                  <th scope="col">View</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(item, index) in JSON.parse(order.order_items)"
                  :key="item.id"
                >
                  <th>{{ index + 1 }}</th>
                  <td scope="row">
                    {{ item.title }}
                  </td>
                  <td scope="row">
                    {{ item.quantity }}
                  </td>
                  <td scope="row"><span>&#8358;</span>{{ item.price }}</td>
                  <td scope="row">
                    <span>&#8358;</span
                    >{{ Number(item.quantity) * Number(item.price) }}
                  </td>
                  <td scope="row">
                    <a
                      target="_blank"
                      class="btn btn-sm btn-primary"
                      :href="route('product-details-page', item.slug)"
                    >
                      <Icon icon="ic:round-remove-red-eye" />
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-6 my-1">
          <h5 class="fw-bolder">
            SUBTOTAL: <span>&#8358;</span>{{ order.total_price }}
          </h5>
          <hr />
          <h5 class="fw-bolder">
            TOTAL: <span>&#8358;</span>{{ order.total_price }}
          </h5>
          <hr />
          <h5 class="fw-bolder text-success">
            BALANCE DUE: <span>&#8358;</span>{{ order.total_price }}
          </h5>
          <hr />
        </div>
      </div>
    </div>
  </UserLayout>
</template>

<style scoped>
</style>
