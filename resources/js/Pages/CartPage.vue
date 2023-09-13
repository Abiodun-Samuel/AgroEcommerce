<script setup>
import CartItem from "@/Components/Common/CartItem.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { toast, formatCurrency } from "@/utils/helper";
import NoResult from "@/Components/Common/NoResult.vue";

const props = defineProps(["cartItems", "cartTotal", "cartCount"]);
const step_one = {
    slug: "Cart",
    link: false,
    route_name: "",
};

const formClear = useForm({});

const clearCart = () => {
    formClear.delete(route("clear-cart"), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Cart has been cleared successfully.");
            formClear.reset();
        },
        onError: () => {
            toast.error(`Unable to clear your cart.`);
        },
    });
};
</script>

<template>
    <Head title="Cart" />
    <GuestLayout>
        <BreadCrump :step_one="step_one" />
        <div class="container">
            <div class="row" v-if="cartCount != 0">
                <div class="col-lg-9 col-md-8 col-sm-8 my-2">
                    <div
                        class="mb-1 bg-white p-1 shadow-sm d-flex justify-content-between align-items-center"
                    >
                        <div>
                            <h5 class="my-0 py-0 fw-bold">
                                Cart({{ cartCount }})
                            </h5>
                        </div>
                        <div>
                            <button
                                @click="clearCart"
                                :disabled="formClear.processing"
                                class="btn btn-sm btn-outline-danger"
                            >
                                <span
                                    v-if="formClear.processing"
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                <span v-else>Clear Cart</span>
                            </button>
                        </div>
                    </div>
                    <div class="cart">
                        <div
                            class="cart__box mb-1 rounded shadow-sm bg-white p-1"
                            v-for="(cartItem, index) in cartItems"
                            :key="cartItem + index"
                        >
                            <CartItem :cartItem="cartItem" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 my-2">
                    <div class="cart__total p-1 bg-white shadow-sm rounded">
                        <h5 class="fw-bolder">Cart Summary</h5>
                        <hr />
                        <p>
                            <b>Total: </b>
                            <span
                                class="fw-bolder rounded"
                                style="background: var(--green-0); padding: 2px"
                                >&#8358; {{ formatCurrency(cartTotal) }}</span
                            >
                        </p>
                        <hr />
                        <Link
                            class="btn btn-outline-success w-100"
                            :href="route('product-page')"
                        >
                            Continue Shopping
                        </Link>
                        <hr />
                        <Link
                            :href="route('user.check-out')"
                            class="btn btn-primary w-100"
                            >CheckOut (&#8358;
                            {{ formatCurrency(cartTotal) }})</Link
                        >
                    </div>
                </div>
            </div>
            <div v-else class="row">
                <div class="col-12 text-center">
                    <NoResult text="Your cart is empty" />
                    <Link
                        class="btn rounded-pill btn-success mt-1"
                        :href="route('product-page', { all_products: true })"
                        >Products</Link
                    >
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
