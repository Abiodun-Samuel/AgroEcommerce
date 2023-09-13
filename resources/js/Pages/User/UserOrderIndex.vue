<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import FormError from "@/Components/Common/FormError.vue";
import NoResult from "@/Components/Common/NoResult.vue";
import category_img from "@/assets/images/icons/subcategory.png";
import Modal from "@/Components/Common/Modal.vue";
import { computed, ref } from "vue";
import { toast, formatTime } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import avatar from "@/assets/images/img/avatar.png";
import { Country, State } from "country-state-city";

const props = defineProps(["orders"]);

const user = computed(() => usePage().props.auth.user);
const form = useForm({
    //   avatar: fileSrc.value,
});
const step_one = {
    slug: "My Orders",
    link: false,
    route_name: null,
};
</script>

<template>
    <Head title="User" />

    <UserLayout>
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
                                    class="lead alert p-1"
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
                                    v-if="order.order_status == 'Delivered'"
                                    class="alert alert-success p-1 lead"
                                    role="alert"
                                >
                                    {{ formatTime(order.delivery_date) }}
                                </p>
                                <p v-else class="p-1 lead" role="alert">---</p>
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
                                    v-if="order.payment_status == 'Paid'"
                                    class="alert alert-success p-1"
                                    role="alert"
                                >
                                    Paid on {{ formatTime(order.payment_date) }}
                                </p>
                                <p v-else>---</p>
                            </td>
                            <td>
                                <Link
                                    :href="route('user.order.show', order.id)"
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
    </UserLayout>
</template>

<style scoped></style>
