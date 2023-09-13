<template>
    <Head title="All Orders" />

    <AdminLayout>
        <DashboardBreadcrump :step_one="step_one" />
        <hr />

        <div class="">
            <div v-if="orders.length" class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Reference (Ref)</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Date Ordered</th>
                            <th scope="col">Delivery Date</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(order, index) in orders"
                            :key="order + index"
                        >
                            <th scope="row">{{ index + 1 }}</th>

                            <td>
                                <p class="lead"><b>Ref:</b> {{ order.id }}</p>
                            </td>
                            <td>
                                <p
                                    class="alert p-1"
                                    :class="
                                        order.order_status == 'Processing'
                                            ? 'alert-primary'
                                            : order.order_status ==
                                              'In Progress'
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
                                </p>
                            </td>
                            <td>
                                <p class="lead">
                                    {{ formatTime(order.created_at) }}
                                </p>
                            </td>
                            <td>
                                <p
                                    v-if="order.delivery_date"
                                    class="alert alert-success p-1"
                                    role="alert"
                                >
                                  Delivered on:  {{ formatTime(order.delivery_date) }}
                                </p>
                            </td>
                            <td>
                                <p
                                    v-if="order.payment_status == 'Paid'"
                                    class="alert alert-success p-1"
                                    role="alert"
                                >
                                    Paid
                                </p>
                                <p
                                    v-else
                                    class="alert alert-danger p-1"
                                    role="alert"
                                >
                                    Not Paid
                                </p>
                            </td>
                            <td>
                                <p
                                    v-if="order.payment_date"
                                    class="alert alert-success p-1"
                                    role="alert"
                                >
                                    Paid on: {{ formatTime(order.payment_date) }}
                                </p>
                            </td>
                            <td>
                                <Link
                                    :href="route('admin.order.show', order.id)"
                                    class="btn btn-sm btn-primary w-100"
                                    >View Details</Link
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
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
