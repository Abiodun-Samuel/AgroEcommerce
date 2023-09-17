<template>
    <div
        class="position-relative card mb-2 rounded border-1 bg-white shadow-sm"
        id="product_component"
    >
        <div class="form-check select_multiple">
            <input
                class="form-check-input border-2 border-primary"
                type="checkbox"
                @change="selectedProductEvent(selectedProduct, product)"
                v-model="selectedProduct"
                :id="product.slug"
            />
        </div>
        <div v-if="product.discount_price" class="discount_percentage">
            <p>
                {{ discountPercentage(product.price, product.discount_price) }}
            </p>
        </div>
        <!-- <Link :href="route('product-details-page', product.slug)"> -->
        <label :for="product.slug">
            <img
                :src="JSON.parse(product.image)?.img_url"
                class="img-fluid rounded"
                alt="product image"
            />
        </label>

        <!-- </Link> -->
        <div class="card-body">
            <Link :href="route('product-details-page', product.slug)">
                <h6 class="card-title product_name fw-bolder text-truncate">
                    {{ firstLetterUpperCase(product.title) }}
                    <span class="fw-normal"> ({{ product.pack_size }})</span>
                </h6>
            </Link>

            <div class="discount d-flex justify-content-between my-1">
                <p class="price fw-bolder text-success">
                    &#8358;
                    {{
                        !product.discount_price
                            ? formatCurrency(product.price)
                            : formatCurrency(product.discount_price)
                    }}
                </p>
                <p
                    v-if="product.discount_price"
                    class="inflatedprice text-danger"
                >
                    &#8358; {{ formatCurrency(product.price) }}
                </p>
            </div>

            <div
                class="my-1 d-flex gap-1 justify-content-between align-items-center"
            >
                <div
                    class="d-flex gap-1 justify-content-between align-items-center"
                >
                    <Rating :value="averageRating" />
                    <small
                        :class="
                            product.stock <= 0 ? 'text-danger' : 'text-dark'
                        "
                    >
                        {{
                            product.stock <= 0 ? "(Out of Stock)" : "(In Stock)"
                        }}
                    </small>
                </div>

                <!-- :text="`${product.reviews.length} review${
            product.reviews.length > 1 ? 's' : ''
          }`" -->
                <div class="ms-2">
                    <button @click="addToWishList(product)" class="wish_btn">
                        <Icon icon="ph:heart" height="17" />
                    </button>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <!-- <button
          @click="addToCart(product)"
          class="shadow btn-sm btn-success w-100"
          :disabled="loading || product.stock <= 0"
        >
          <span
            v-if="loading"
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          <span v-else class="d-flex align-items-center justify-content-center">
            <Icon height="18" icon="ic:outline-shopping-cart" class="mr-2" />
            Cart
          </span>
        </button> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import Rating from "@/Components/Common/Rating.vue";
import { ref, computed } from "vue";
import store from "@/store";
import {
    toast,
    firstLetterUpperCase,
    discountPercentage,
    formatCurrency,
} from "@/utils/helper.js";

const props = defineProps(["product", "addAllToCartDone"]);
const emit = defineEmits(["selectProduct"]);
const selectedProduct = ref(false);

const selectedProductEvent = (data, product) => {
    const _product = {
        selectedProduct: data,
        id: product.id,
        name: product.title,
        image: product.image,
        slug: product.slug,
        stock: product.stock,
        price: Number(product.discount_price)
            ? Number(product.discount_price)
            : Number(product.price),
        quantity: 1,
    };
    emit("selectProduct", _product);
};

const loading = ref(false);
const averageRating = computed(() => {
    if (!props.product.reviews.length) return 0;
    const totalRatings = props.product.reviews.reduce(
        (total, num) => total + num.rating,
        0
    );
    const calc = (totalRatings * 5) / (props.product.reviews.length * 5);
    return calc.toFixed(2);
});

const addToWishList = (params) => {
    const product = {
        id: params.id,
        title: params.title,
        sub_title: params.sub_title,
        image: params.image,
        stock: params.stock,
        price: params.discount_price ? params.discount_price : params.price,
        quantity: 1,
    };
    store.dispatch("wishlistStore/addToWishList", product);
};
const addToCart = (params) => {
    loading.value = true;
    const product = useForm({
        id: params.id,
        name: params.title,
        image: params.image,
        slug: params.slug,
        stock: params.stock,
        price: Number(params.discount_price)
            ? Number(params.discount_price)
            : Number(params.price),
        quantity: 1,
    });
    product.post(route("add-to-cart"), {
        preserveScroll: true,
        onSuccess: (val) => {
            toast.success(
                firstLetterUpperCase(props.product.title) +
                    " has been added to your cart."
            );
            loading.value = false;
            product.reset();
        },
        onError: (err) => {
            loading.value = false;
            toast.error(
                `${firstLetterUpperCase(
                    props.product.title
                )} is already in your cart.`
            );
        },
    });
};
</script>

<style lang="css" scoped>
#product_component.card {
    transition: 500ms;
    box-shadow: none;
}
#product_component.card:hover {
    /* box-shadow: var(--shadow-3); */
}
#product_component .discount_percentage {
    position: absolute;
    top: 3px;
    right: 3px;
}
#product_component .select_multiple {
    position: absolute;
    top: 3px;
    left: 3px;
}
#product_component .select_multiple input {
    height: 25px;
    width: 25px;
    cursor: pointer;
}
#product_component .discount_percentage p {
    background-color: var(--red-1);
    color: var(--white);
    border-radius: 2px;
    padding: 3px;
    font-weight: 500;
    font-size: 0.7rem;
}

#product_component .card-body {
    padding: 10px;
}
#product_component a .product_name {
    font-weight: 500;
    font-size: 1rem;
    margin: 2px 0;
    color: var(--primary);
}
#product_component a .card-title.product_name:hover {
    text-decoration: underline;
}
#product_component .discount .price {
    font-size: 0.85rem;
    padding: 0;
    margin: 2px 0;
}
#product_component .discount .inflatedprice {
    font-size: 0.85rem;
    padding: 0;
    margin: 2px 0;
    text-decoration: line-through;
}
#product_component .wish_btn {
    background: var(--green-0);
    border-radius: 50%;
    display: flex;
    height: 25px;
    width: 25px;
    justify-content: center;
    align-items: center;
    color: var(--black);
}
@media screen and (max-width: 576px) {
    #product_component a .product_name {
        font-size: 0.9rem;
    }
}
</style>
