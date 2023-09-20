<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import NoResult from "@/Components/Common/NoResult.vue";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { Icon } from "@iconify/vue";
import { formatTime } from "@/utils/helper";
import { computed } from "vue";
import Pagination from "@/Components/Partial/Pagination.vue";

const auth_user = computed(() => usePage().props.auth.user);
const props = defineProps(["transactions"]);
console.log(props.transactions);
const transactions = computed(() => props.transactions);
const step_one = {
    slug: "Transactions",
    link: false,
    route_name: null,
};
</script>

<template>
    <Head title="Admin Transactions" />

    <AdminLayout>
        <DashboardBreadcrump :step_one="step_one" />

        <div class="">
            <div class="mt-2">
                <div class="">
                    <div class="user__table">
                        <div
                            class="table-responsive"
                            v-if="transactions.data.length"
                        >
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Order Details</th>
                                        <th scope="col">Transaction Date</th>
                                        <th scope="col">Reference | Trxref</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">User Details</th>
                                        <th scope="col">Trans | Transaction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(
                                            transaction, index
                                        ) in transactions.data"
                                        :key="transaction.id"
                                    >
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>
                                            <p class="lead">
                                                {{ transaction.order.id }}
                                            </p>
                                        </td>
                                        <td>
                                            <Link
                                                class="nav-link"
                                                :href="
                                                    route(
                                                        'admin.order.show',
                                                        transaction.order.id
                                                    )
                                                "
                                            >
                                                <span class="menu-title"
                                                    >View Order</span
                                                >
                                                <Icon
                                                    icon="material-symbols:order-approve-outline-rounded"
                                                    class="menu-icon"
                                                />
                                            </Link>
                                        </td>
                                        <td>
                                            <p class="lead">
                                                {{
                                                    formatTime(
                                                        transaction.created_at
                                                    )
                                                }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="small">
                                                <b>Reference:</b>
                                                {{ transaction.reference }}
                                            </p>
                                            <p class="small">
                                                <b>Trxref:</b>
                                                {{ transaction.trxref }}
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                &#8358;
                                                {{
                                                    transaction.order
                                                        .total_price
                                                }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                :class="
                                                    transaction.status ==
                                                    'success'
                                                        ? 'bg-success text-white'
                                                        : 'bg-danger text-white'
                                                "
                                                class="lead rounded"
                                                style="padding: 5px"
                                            >
                                                {{ transaction.status }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="lead d-flex gap-1">
                                                {{ transaction.message }}
                                                <Icon
                                                    v-if="
                                                        transaction.message ==
                                                        'Approved'
                                                    "
                                                    class="text-success"
                                                    icon="ci:check-all"
                                                    height="20"
                                                />
                                            </p>
                                        </td>
                                        <td>
                                            <p class="my-0">
                                                <b>Name:</b
                                                >{{
                                                    `${transaction.order.name} `
                                                }}
                                            </p>
                                            <p class="my-0">
                                                <b>Email:</b
                                                >{{ transaction.order.email }}
                                            </p>
                                            <p class="my-0">
                                                <b>Phone:</b
                                                >{{ transaction.order.phone }}
                                            </p>
                                            <p class="my-0">
                                                <b>Address:</b
                                                >{{
                                                    `${transaction.order.address}`
                                                }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="lead">
                                                <b>Trans:</b>
                                                {{ transaction.trans }}
                                            </p>
                                            <p class="lead">
                                                <b>Transaction:</b>
                                                {{ transaction.transaction }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="text-center">
                            <NoResult
                                text="No transactions yet"
                                :link="false"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <Pagination :links="transactions.links" />
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
