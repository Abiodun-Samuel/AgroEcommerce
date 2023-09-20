<template>
    <Head title="Products" />

    <GuestLayout>
        <BreadCrump
            v-if="route()?.params.subcategory"
            :step_one="step_one"
            :step_two="step_two"
        />
        <BreadCrump v-else :step_one="step_one" />

        <div id="product">
            <div class="container">
                <div class="row">
                    <!-- filter options  -->
                    <div class="col-lg-3 col-md-4 my-2">
                        <ProductPageSideBar
                            @filterByPriceRange="filterByPriceRange"
                            @filterResultFormat="filterResultFormat"
                            @filterTopProducts="filterTopProducts"
                            @clearFilter="clearFilter"
                        />
                    </div>
                    <div class="col-lg-9 col-md-8 my-2">
                        <div v-if="selectProducts.length" class="mb-2">
                            <button
                                @click="addAllToCart"
                                class="btn btn-outline-primary d-flex align-items-center shadow"
                            >
                                <span>Add Selected Products</span>
                                <span
                                    v-if="loading"
                                    class="spinner-border spinner-border-sm mx-1"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                                <Icon
                                    v-else
                                    height="18"
                                    icon="ic:outline-shopping-cart"
                                    class="mx-1"
                                />
                            </button>
                        </div>
                        <div class="row">
                            <template v-if="all_products?.length">
                                <div
                                    v-for="product in all_products"
                                    :key="product.id"
                                    class="col-lg-4 col-md-6"
                                >
                                    <ProductComponent
                                        :displaySelectAll="true"
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
                                    <p
                                        class="text-secondary fw-bolder my-0 py-0"
                                    >
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

                        <div v-if="products.links" class="row mt-1">
                            <Pagination :links="products.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { computed, ref } from "vue";
import { Link, usePage, Head, useForm, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import ProductPageSideBar from "@/Components/Common/ProductPageSideBar.vue";
import { unslugify, toast } from "@/utils/helper";
import moment from "moment";

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

const step_one = {
    slug: "Products",
    link: route()?.params?.subcategory ? true : false,
    route_name: route()?.params?.subcategory ? "product-page" : null,
};
const step_two = {
    slug: unslugify(route()?.params?.subcategory),
    link: false,
    route_name: null,
};
const props = defineProps({
    products: Array,
});
const categories = computed(() => usePage().props.data.categories);
const result_count = ref("default");
const result_format = ref("default");
const all_products = ref(props.products.data || props.products);

const unselectItems = () => {
    const items = document.querySelectorAll("#product_component input");
    for (let index = 0; index < items.length; index++) {
        console.log(items[index].value);
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

function dynamicSort(property, order) {
    if (order == "alpha" || order == "non_alpha") {
        var sortOrder = order == "alpha" ? 1 : -1;
        return function (a, b) {
            if (sortOrder == -1) {
                return b[property].localeCompare(a[property]);
            } else {
                return a[property].localeCompare(b[property]);
            }
        };
    }
}

const filterResultFormat = (data) => {
    if (data.result_format == "alpha" || data.result_format == "non_alpha") {
        all_products.value = all_products.value.sort(
            dynamicSort("title", data.result_format)
        );

        // if (props.products.data) {
        //   all_products.value = props.products.data.sort(
        //     dynamicSort("title", data.result_format)
        //   );
        // } else {
        //   all_products.value = props.products.sort(
        //     dynamicSort("title", data.result_format)
        //   );
        // }
    }
    if (data.result_format == "newest") {
        all_products.value = all_products.value.sort(function (a, b) {
            return moment(b.updated_at) - moment(a.updated_at);
        });
        // if (props.products.data) {
        //   all_products.value = props.products.data.sort(function (a, b) {
        //     return moment(b.updated_at) - moment(a.updated_at);
        //   });
        // } else {
        //   all_products.value = props.products.sort(function (a, b) {
        //     return moment(b.updated_at) - moment(a.updated_at);
        //   });
        // }
    }
    if (data.result_format == "oldest") {
        all_products.value = all_products.value.sort(function (a, b) {
            return moment(a.updated_at) - moment(b.updated_at);
        });
        // if (props.products.data) {
        //   all_products.value = props.products.data.sort(function (a, b) {
        //     return moment(a.updated_at) - moment(b.updated_at);
        //   });
        // } else {
        //   all_products.value = props.products.sort(function (a, b) {
        //     return moment(a.updated_at) - moment(b.updated_at);
        //   });
        // }
    }
};

const filterByPriceRange = (data) => {
    if (props.products.data) {
        all_products.value = props.products.data.filter((product) => {
            if (product.discount_price)
                return (
                    Number(product.discount_price) >= data.price_min &&
                    Number(product.discount_price) <= data.price_max
                );
            if (!product.discount_price)
                return (
                    Number(product.price) >= data.price_min &&
                    Number(product.price) <= data.price_max
                );
        });
    } else {
        all_products.value = props.products.filter((product) => {
            if (product.discount_price)
                return (
                    Number(product.discount_price) >= data.price_min &&
                    Number(product.discount_price) <= data.price_max
                );
            if (!product.discount_price)
                return (
                    Number(product.price) >= data.price_min &&
                    Number(product.price) <= data.price_max
                );
        });
    }
};
const filterTopProducts = (data) => {
    if (data.format == "top_selling") {
        all_products.value = all_products.value.sort(function (a, b) {
            return b.sales_count - a.sales_count;
        });

        // if (props.products.data) {
        //   all_products.value = props.products.data.sort(function (a, b) {
        //     return b.sales_count - a.sales_count;
        //   });
        // } else {
        //   all_products.value = props.products.sort(function (a, b) {
        //     return b.sales_count - a.sales_count;
        //   });
        // }
    }
    if (data.format == "top_rated") {
        all_products.value = all_products.value.sort(function (a, b) {
            return b.reviews_count - a.reviews_count;
        });

        // if (props.products.data) {
        //   all_products.value = props.products.data.sort(function (a, b) {
        //     return b.reviews_count - a.reviews_count;
        //   });
        // } else {
        //   all_products.value = props.products.sort(function (a, b) {
        //     return b.reviews_count - a.reviews_count;
        //   });
        // }
    }
    if (data.format == "with_discount") {
        if (props.products.data) {
            all_products.value = props.products.data.filter(function (product) {
                return product.discount_price;
            });
        } else {
            all_products.value = props.products.filter(function (product) {
                return product.discount_price;
            });
        }
    }
};
const clearFilter = () => {
    if (props.products.data) {
        all_products.value = props.products.data;
    } else {
        all_products.value = props.products;
    }
};
</script>

<style lang="css" scoped>
.dropdown-item:hover,
.dropdown:hover {
    background: #f0f0f0;
    color: var(--black);
}
.highlight {
    background: var(--green-0);
    border-radius: 50%;
    display: flex;
    height: 25px;
    width: 25px;
    justify-content: center;
    align-items: center;
    color: var(--black);
}
</style>
