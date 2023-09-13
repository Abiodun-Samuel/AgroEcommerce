<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, usePage, useForm } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import ImageConverter from "@/Components/Common/ImageConverter.vue";
import { toast, unslugifyTwo, amountToWords } from "@/utils/helper";
import { computed, ref } from "vue";
import { formatTime } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import html2pdf from "html2pdf.js";
import paystack from "vue3-paystack";

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

const publicKey = ref(import.meta.env.VITE_PAYSTACK_PUBLIC_KEY);
const email = ref(props.order.email);
const amount = Number(props.order.total_price) * 100;
const reference = props.order.id;

const updatePayment = (data) => {
    const formUpdate = useForm({
        // user_id: user.id,
        // order_id: props.order.id,
        message: data.message,
        reference: data.reference,
        status: data.status,
        trans: data.trans,
        transaction: data.transaction,
        trxref: data.trxref,
    });
    formUpdate.put(route("user.order.update-paid", props.order.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success(
                "Payment was successful, your order is been processed."
            );
            formUpdate.reset();
        },
        onError: () => {
            toast.error(`Error`);
        },
    });
};

const onSuccessfulPayment = (data) => {
    updatePayment(data);
};

const onCancelledPayment = () => {
    toast.success("Payment was not successful.");
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
            <div class="my-1 row bg-white shadow rounded">
                <div class="d-flex justify-content-between p-1">
                    <a
                        href="https://wa.link/20q7u6"
                        target="_blank"
                        class="btn btn-outline-primary rounded d-flex gap-1 align-items-center"
                    >
                        <Icon
                            icon="clarity:chat-bubble-outline-badged"
                            height="15"
                        />
                        Contact Us
                    </a>
                    <button
                        :disabled="isDownloading"
                        class="btn gap-1 btn-outline-primary d-flex align-items-center"
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
                            ><Icon
                                height="15"
                                icon="material-symbols:download-sharp"
                        /></span>
                    </button>
                </div>
                <div class="col-lg-12 p-1">
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
                            <p>{{ order.order_status }}</p>
                        </div>
                        <div
                            v-if="order.order_status == 'Delivered'"
                            class="alert alert-success p-1"
                            role="alert"
                        >
                            <p>
                                Delivered on
                                {{ formatTime(order.delivery_date) }}
                            </p>
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
                    <div v-if="order.payment_status !== 'Paid'" class="col-12">
                        <paystack
                            buttonClass="btn btn-primary"
                            buttonText="Pay Now"
                            :publicKey="publicKey"
                            :email="email"
                            :amount="amount"
                            :reference="reference"
                            :onSuccess="onSuccessfulPayment"
                            :onCanel="onCancelledPayment"
                        ></paystack>
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
                            {{ order.payment_option }}
                        </p>
                    </div>
                </div>
            </div>

            <div
                id="docContainer"
                class="row shadow bg-white mt-1 p-1 rounded justify-content-between"
            >
                <div
                    class="col-lg-12 my-1 d-flex justify-content-between align-items-start flex-wrap"
                >
                    <div class="mb-2">
                        <ImageConverter
                            url="https://res.cloudinary.com/psalmzie/image/upload/v1682227304/superoagrobase/other/xsh3wilse3i59nuh4ifm.jpg"
                            height="30"
                        />
                    </div>

                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-1">
                            <a
                                href="tel:+2348157037737"
                                class="my-0 py-0 d-flex align-items-center text-dark"
                            >
                                <Icon
                                    icon="fa6-solid:square-phone"
                                    height="18"
                                    class="inline-block"
                                    style="margin-right: 2px"
                                />
                                <span> 08157037737</span>
                            </a>
                            <a
                                target="_blank"
                                href="https://twitter.com/LimitedSupero"
                                class="my-0 py-0 d-flex align-items-center text-dark"
                            >
                                <Icon
                                    icon="fa6-brands:square-twitter"
                                    height="18"
                                    class="inline-block"
                                    style="margin-right: 2px"
                                />
                                <span> LimitedSupero</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <a
                                target="_blank"
                                href="https://www.facebook.com/superoagrobasedltd/"
                                class="my-0 py-0 d-flex align-items-center text-dark"
                            >
                                <Icon
                                    icon="entypo-social:facebook"
                                    height="18"
                                    class="inline-block"
                                    style="margin-right: 2px"
                                />
                                <span>Superoagrobasedltd</span>
                            </a>
                            <a
                                target="_blank"
                                href="https://www.instagram.com/superoagrobase/"
                                class="my-0 py-0 d-flex align-items-center text-dark"
                            >
                                <Icon
                                    icon="grommet-icons:instagram"
                                    height="18"
                                    class="inline-block"
                                    style="margin-right: 2px"
                                />
                                <span>Superoagrobasedltd</span>
                            </a>
                        </div>
                        <a
                            href="mailto:contact@superoagrobase.com"
                            class="my-0 py-0 d-flex align-items-center text-dark"
                        >
                            <Icon
                                icon="ic:outline-email"
                                height="18"
                                class="inline-block"
                                style="margin-right: 2px"
                            />
                            <span>contact@superoagrobase.com</span>
                        </a>
                        <a
                            target="_blank"
                            href="https://superoagrobase.com/"
                            class="my-0 py-0 d-flex align-items-center text-dark"
                        >
                            <Icon
                                icon="iconoir:internet"
                                height="18"
                                class="inline-block"
                                style="margin-right: 2px"
                            />
                            <span>www.superoagrobase.com</span>
                        </a>
                    </div>

                    <div class="mb-2">
                        <h1
                            class="bg-dark text-white p-1 fw-bolder fs-1 rounded"
                        >
                            Invoice
                        </h1>
                        <small><b>Ref:</b> {{ unslugifyTwo(order.id) }}</small>
                    </div>
                </div>
                <hr style="height: 2.5px" class="bg-secondary rounded" />

                <div class="row mt-2 mb-3">
                    <div class="col-lg-6 d-flex gap-1">
                        <div>
                            <h4 class="text-dark fs-2 fw-bolder">To:</h4>
                        </div>
                        <div class="">
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
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="">
                            <h4 class="text-dark fs-2 fw-bolder">Date:</h4>
                            <p class="lead fw-bold">
                                {{ formatTime(order.created_at) }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr style="height: 2.5px" class="bg-secondary rounded" />

                <div class="col-12 mt-2 mb-1">
                    <div
                        class="table-responsive"
                        v-if="JSON.parse(order.order_items)"
                    >
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">QYT</th>
                                    <th scope="col">DESCRIPTION OF GOODS</th>
                                    <th scope="col">RATE</th>
                                    <th scope="col">AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in JSON.parse(
                                        order.order_items
                                    )"
                                    :key="item.id"
                                >
                                    <td scope="row">
                                        {{ item.quantity }}
                                    </td>
                                    <td scope="row">
                                        <a
                                            target="_blank"
                                            :href="
                                                route(
                                                    'product-details-page',
                                                    item.slug
                                                )
                                            "
                                        >
                                            {{ item.title }}
                                        </a>
                                    </td>

                                    <td scope="row">
                                        <span>&#8358;</span>{{ item.price }} x
                                        {{ item.quantity }}
                                    </td>
                                    <td scope="row">
                                        <span>&#8358;</span
                                        >{{
                                            Number(item.quantity) *
                                            Number(item.price)
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-between">
                    <small class="text-secondary"
                        >Goods once sold and collected are not returnable.
                        Thanks, Please call again.</small
                    >
                    <h5 class="fw-bolder fs-4">
                        TOTAL: <span>&#8358;</span>{{ order.total_price }}
                    </h5>
                </div>

                <div class="col-12 my-2">
                    <h5
                        class="fw-bolder fs-4"
                        :class="
                            order.payment_status !== 'Paid'
                                ? 'text-danger'
                                : 'text-success'
                        "
                    >
                        {{
                            order.payment_status !== "Paid"
                                ? "BALANCE DUE"
                                : "PAID"
                        }}
                        : <span>&#8358;</span>{{ order.total_price }}
                    </h5>
                    <div class="d-flex amount__words align-items-center gap-1 my-2">
                        <h5>
                            Amount in Words:
                            <span class="text-center">{{
                                amountToWords(order.total_price)
                            }}</span>
                        </h5>
                    </div>
                </div>
                <!-- signatures  -->
                <div class="row text-center">
                    <div class="col-lg-6 my-3">
                        <p class="my-0 py-0">
                            --------------------------------
                        </p>
                        <p class="my-0 py-0">Customer's Signature</p>
                    </div>
                    <div class="col-lg-6 my-3">
                        <p class="my-0 py-0">
                            --------------------------------
                        </p>
                        <p class="my-0 py-0">SUPERO AGROBASE LTD</p>
                    </div>
                </div>
                <!-- bank info  -->
                <div class="col-12 my-2 text-center">
                    <p class="lead fw-bold my-0 py-0">FCMB</p>
                    <p class="lead my-0 py-0">
                        Acc Name: <b>SUPERO AGROBASE LIMITED</b>
                    </p>
                    <P class="lead my-0 py-0">Acc No: <b>2001628602</b></P>
                </div>
            </div>
        </div>
    </UserLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Marck+Script&display=swap');

.amount__words {
    position: relative;
}
.amount__words span {
    font-family: 'Marck Script', cursive;
    font-size: 1.8rem;
    margin-left: 15px;
}
.amount__words span::before {
    position: absolute;
    content: "";
    height: 2px;
    width: 50%;
    bottom: 0;
    background-color: rgb(70, 70, 70);
}
</style>
