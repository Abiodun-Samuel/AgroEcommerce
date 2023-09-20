<template>
    <Head title="Order Details" />

    <AdminLayout>
        <DashboardBreadcrump :step_one="step_one" :step_two="step_two" />
        <hr />

        <div class="container">
            <div class="row my-1 shadow bg-white rounded">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-1">
                    <div class="input-group">
                        <select
                            class="form-select"
                            id="inputGroupSelect04"
                            aria-label="Example select with button addon"
                            v-model="updateOrderStatus.order_status"
                        >
                            <option value="Pending">Pending</option>
                            <option value="Processing">Processing</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <button
                            :disabled="updateOrderStatus.processing"
                            @click="updateOrder"
                            class="btn btn-success"
                            type="button"
                        >
                            <span
                                v-if="updateOrderStatus.processing"
                                class="spinner-border spinner-border-sm mx-1"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            <span>Update</span>
                        </button>
                    </div>
                    <label for="inputGroupSelect04" class="lead"
                        >Update Order Status:
                        <span class="text-primary">{{
                            props.order.order_status
                        }}</span></label
                    >
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-6 my-1 d-flex flex-wrap gap-1">
                    <button
                        :disabled="downloadingInvoice"
                        class="btn btn-sm btn-outline-primary d-flex align-items-center"
                        @click="downloadInvoice"
                    >
                        <span
                            v-if="downloadingInvoice"
                            class="spinner-border spinner-border-sm mx-1"
                            role="status"
                            aria-hidden="true"
                        ></span>
                        <span>Download Invoice</span>
                        <span
                            ><Icon
                                height="20"
                                icon="material-symbols:download-sharp"
                        /></span>
                    </button>
                    <a
                        target="_blank"
                        :href="`https://wa.me/${whatsappNo}?text=${whatsappInvoiceText}`"
                        class="btn btn-sm btn-outline-secondary d-flex align-items-center"
                    >
                        <span>Send Invoice</span>
                        <span
                            ><Icon height="20" icon="mingcute:mail-send-line"
                        /></span>
                    </a>

                    <button
                        v-if="order.payment_status == 'Paid'"
                        :disabled="downloadingReceipt"
                        class="btn btn-sm btn-outline-warning d-flex align-items-center"
                        @click="downloadReceipt"
                    >
                        <span
                            v-if="downloadingReceipt"
                            class="spinner-border spinner-border-sm mx-1"
                            role="status"
                            aria-hidden="true"
                        ></span>
                        <span>Download Receipt</span>
                        <span
                            ><Icon
                                height="20"
                                icon="material-symbols:download-sharp"
                        /></span>
                    </button>
                    <a
                        :href="`https://wa.me/${whatsappNo}?text=${whatsappReceiptText}`"
                        target="_blank"
                        v-if="order.payment_status == 'Paid'"
                        class="btn btn-sm btn-outline-success d-flex align-items-center"
                    >
                        <span>Send Receipt</span>
                        <span
                            ><Icon height="20" icon="mingcute:mail-send-line"
                        /></span>
                    </a>
                </div>

                <div class="col-lg-12 p-1">
                    <hr />

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

            <!-- receipt container  -->
            <div
                v-if="order.payment_status == 'Paid'"
                id="receiptContainer"
                class="row shadow bg-white mt-1 p-1 rounded justify-content-between"
            >
                <div
                    class="col-lg-12 my-1 d-flex justify-content-between align-items-start flex-wrap"
                >
                    <div class="mb-2">
                        <ImageConverter
                            url="https://res.cloudinary.com/psalmzie/image/upload/v1682227304/superoagrobase/other/xsh3wilse3i59nuh4ifm.jpg"
                            height="40"
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
                        <h1 class="text-dark fw-bolder fs-1">Receipt</h1>
                        <p class="my-0 py-0 small">
                            <b>No:</b> {{ unslugifyTwo(order.id) }}
                        </p>
                        <p class="my-0 py-0 small">
                            <b>Date:</b> {{ formatTime(Date.now()) }}
                        </p>
                    </div>
                </div>

                <div class="row my-3">
                    <div>
                        <h4 class="a">
                            <span class="text-secondary"
                                >Received with thanks from:
                            </span>
                            <b>{{ order.name }}</b>
                        </h4>
                        <h4 class="a">
                            <span class="text-secondary">The sum of: </span>
                            <b
                                >&#8358;{{ order.total_price }} ||
                                {{ amountToWords(order.total_price) }}</b
                            >
                        </h4>
                    </div>
                    <div>
                        <h4 class="a">
                            <span class="text-secondary">No:</span>
                            <b>{{ order.id }}</b>
                        </h4>
                        <h4 class="a">
                            <span class="text-secondary">Dated:</span>
                            <span>{{ formatTime(order.payment_date) }}</span>
                        </h4>
                    </div>
                </div>

                <!-- signatures  -->
                <div class="row text-center">
                    <div class="col-lg-6 my-3">
                        <p class="my-0 py-0">
                            --------------------------------
                        </p>
                        <p class="my-0 py-0">REVENUE STAMP</p>
                    </div>
                    <div class="col-lg-6 my-3">
                        <p class="my-0 py-0">
                            --------------------------------
                        </p>
                        <p class="my-0 py-0">Signature</p>
                    </div>
                </div>
            </div>

            <div
                id="invoiceContainer"
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
                    <div
                        class="d-flex amount__words align-items-center gap-1 my-2"
                    >
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
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import ImageConverter from "@/Components/Common/ImageConverter.vue";
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import {
    toast,
    formatTime,
    unslugifyTwo,
    amountToWords,
    intlPhone,
} from "@/utils/helper";
import html2pdf from "html2pdf.js";
import { Country } from "country-state-city";

let countries = Country.getAllCountries();
countries = countries.find((item) => item.name == props.order.country);

const downloadingInvoice = ref(false);
const downloadingReceipt = ref(false);

const props = defineProps(["order"]);
let whatsappNo = intlPhone(props.order.phone, `+${countries?.phonecode}`);

const whatsappInvoiceText = ref(
    `SuperoAgrobase Ltd, Click this link to view your invoice. \n ${encodeURIComponent(
        route("user.order.show", props.order.id)
    )}`
);

const whatsappReceiptText = ref(
    `SuperoAgrobase Ltd, Click this link to view and download your receipt. \n ${encodeURIComponent(
        route("order.receipt", props.order.id)
    )}`
);

const step_one = {
    slug: "Order",
    link: true,
    route_name: "admin.order.index",
};
const step_two = {
    slug: "Order Details",
    link: false,
    route_name: null,
};

const updateOrderStatus = useForm({
    order_status: "",
});

const downloadInvoice = () => {
    downloadingInvoice.value = true;
    const docTarget = document.getElementById("invoiceContainer");
    html2pdf(docTarget, {
        margin: 1,
        image: { type: "jpeg", quality: 1 },
        filename: `invoice-${props.order.id}.pdf`,
    });
    setTimeout(() => {
        downloadingInvoice.value = false;
    }, 2000);
};

const downloadReceipt = () => {
    downloadingReceipt.value = true;
    const docTarget = document.getElementById("receiptContainer");
    html2pdf(docTarget, {
        margin: 1,
        image: { type: "jpeg", quality: 1 },
        filename: `receipt-${props.order.id}.pdf`,
    });
    setTimeout(() => {
        downloadingReceipt.value = false;
    }, 2000);
};

const updateOrder = () => {
    if (!updateOrderStatus.order_status.length)
        return toast.error("Please select from the dropdown");
    updateOrderStatus.put(route("admin.update.order", props.order.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Order Status has been updated successfully");
            updateOrderStatus.reset();
        },
        onError: () => {
            toast.error(`Unable to update order status`);
        },
    });
};
</script>

<style lang="css" scoped>
@import url("https://fonts.googleapis.com/css2?family=Marck+Script&display=swap");
.amount__words,
.a {
    position: relative;
}
.a {
    margin: 10px 0;
}
.amount__words span {
    font-family: "Marck Script", cursive;
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
h4.a::before {
    position: absolute;
    content: "";
    height: 1.5px;
    width: 100%;
    bottom: -5px;
    background-color: rgb(149, 148, 148);
}
.a b {
    font-family: "Marck Script", cursive;
    font-size: 2rem;
    margin-left: 15px;
}
</style>
