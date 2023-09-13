<template>
    <Head title="Receipt" />
    <div class="container">
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
                    <p class="my-0 py-0">--------------------------------</p>
                    <p class="my-0 py-0">REVENUE STAMP</p>
                </div>
                <div class="col-lg-6 my-3">
                    <p class="my-0 py-0">--------------------------------</p>
                    <p class="my-0 py-0">Signature</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center my-1 gap-2">
            <button
                :disabled="downloadingInvoice"
                class="btn btn-sm btn-outline-primary d-flex align-items-center"
                @click="downloadReceipt"
            >
                <span
                    v-if="downloadingInvoice"
                    class="spinner-border spinner-border-sm mx-1"
                    role="status"
                    aria-hidden="true"
                ></span>
                <span>Download Invoice</span>
                <span
                    ><Icon height="25" icon="material-symbols:download-sharp"
                /></span>
            </button>
            <a
                class="btn btn-sm btn-outline-primary d-flex align-items-center"
                target="_blank"
                :href="route('home')"
            >
                <span>Homepage</span>
                <span><Icon height="25" icon="tabler:home-2" /></span>
            </a>
        </div>
    </div>
</template>

<script setup>
import ImageConverter from "@/Components/Common/ImageConverter.vue";
import { Icon } from "@iconify/vue";
import { Head, Link } from "@inertiajs/vue3";
import { formatTime, unslugifyTwo, amountToWords } from "@/utils/helper";
import html2pdf from "html2pdf.js";
import { ref } from "vue";

const downloadingReceipt = ref(false);

const props = defineProps(["order"]);
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
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Marck+Script&display=swap");
.a {
    position: relative;
}
.a b {
    font-family: "Marck Script", cursive;
    font-size: 2rem;
    margin-left: 15px;
}
h4.a::before {
    position: absolute;
    content: "";
    height: 1.5px;
    width: 100%;
    bottom: -5px;
    background-color: rgb(149, 148, 148);
}
</style>
