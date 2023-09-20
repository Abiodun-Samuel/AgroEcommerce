<template>
    <div class="products__section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="products__section__header">
                        <h2>Select product options</h2>
                        <h3>Featured Products</h3>
                    </div>
                </div>
                <div class="col-lg-12 my-2">
                    <div class="products__section__header-button">
                        <div class="d-flex gap-1 align-items-center">
                            <Link
                                :href="
                                    route('product-page', {
                                        all_products: true,
                                    })
                                "
                                class="btn btn-outline-success"
                                :class="
                                    selectProducts.length ? 'btn-sm' : 'btn-md'
                                "
                            >
                                All Products
                            </Link>
                            <Link
                                :href="
                                    route('product-page', {
                                        query: 'top_selling',
                                    })
                                "
                                class="btn btn-outline-success"
                                :class="
                                    selectProducts.length ? 'btn-sm' : 'btn-md'
                                "
                            >
                                Top Selling
                            </Link>
                        </div>
                        <!-- <Link
                            :href="
                                route('product-page', { query: 'top_rated' })
                            "
                            class="btn btn-md btn-outline-success"
                        >
                            Top Rated
                        </Link> -->

                        <button
                            v-if="selectProducts.length"
                            @click="addAllToCart"
                            class="btn btn-sm btn-outline-primary d-flex align-items-center shadow"
                        >
                            <span>Add to Cart</span>
                            <span
                                v-if="loading"
                                class="spinner-border spinner-border-sm ms-1"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            <Icon
                                v-else
                                height="18"
                                icon="ic:outline-shopping-cart"
                                class="ms-1"
                            />
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <template v-if="products.data.length">
                    <div
                        v-for="product in products.data"
                        :key="product.id"
                        class="col-lg-3 col-md-6"
                    >
                        <ProductComponent :displaySelectAll="true"
                            @selectProduct="updateselectProducts"
                            :product="product"
                        />
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 text-center">
                        <img
                            src="@/assets/images/img/no-result.svg"
                            alt="no product"
                            class="m-auto"
                            style="width: 300px"
                        />
                        <p class="text-secondary fw-bolder my-0 py-0">
                            Oops, No products found.
                        </p>
                        <Link
                            style="margin-top: 5px"
                            :href="route('product-page')"
                            class="btn btn-outline-success rounded-pill"
                            >Products</Link
                        >
                    </div>
                </template>
            </div>

            <div class="row mt-1">
                <Pagination :links="products.links" />
            </div>
        </div>
    </div>
</template>

<script setup>
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

defineProps(["products"]);


const selectProducts = ref([]);
const loading = ref(false);

const updateselectProducts = (data) => {
    if (data.selectedProduct) {
        selectProducts.value.push(data);
    } else {
        selectProducts.value = selectProducts.value.filter((item) => {
            return item.id !== data.id;
        });
    }
};
const addAllToCart = () => {
    loading.value = true;
    const product = useForm({
        isItemArray: true,
        products: selectProducts.value,
    });
    product.post(route("add-to-cart"), {
        preserveScroll: true,
        onSuccess: (val) => {
            toast.success(
                "All selected products have been added to your cart."
            );
            loading.value = false;
            for (let index = 0; index < selectProducts.value.length; index++) {
                const item = document.getElementById(
                    `${selectProducts.value[index].slug}`
                );
                item.checked = false;
            }
            selectProducts.value = [];
            router.visit(route("cart"));
        },
        onError: (err) => {
            loading.value = false;
            toast.error(`${err.status} already exists in your cart.`);
        },
    });
};
</script>

<style lang="css" scoped>
.products__section {
    position: relative;
    padding: 2rem 0;
}
.products__section__header h2 {
    font-size: 1.3rem;
    font-weight: bolder;
    color: var(--green);
}
.products__section__header h3 {
    font-size: 2rem;
    font-weight: bolder;
}
.products__section__header-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}
</style>
