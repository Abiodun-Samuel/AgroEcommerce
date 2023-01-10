<template>
  <div class="card mb-3 rounded border-0 bg-white" id="product_component">
    <div class="discount_percentage">
      <p>{{ discountPercentage(product.price, product.discount_price) }}</p>
    </div>
    <Link>
      <img :src="product.image" class="img-fluid" alt="product image" />
    </Link>
    <div class="card-body">
      <Link>
        <h6 class="card-title product_name fw-bolder">
          {{ firstLetterUpperCase(product.title) }}
        </h6>
      </Link>

      <div class="discount d-flex justify-content-between my-1">
        <p class="price fw-bolder text-success">
          &#8358; {{ formatCurrency(product.discount_price) }}
        </p>
        <p class="inflatedprice text-danger">
          &#8358; {{ formatCurrency(product.price) }}
        </p>
      </div>

      <div class="my-1">
        <Rating :value="2.5" :text="'2 Reviews'" />
      </div>

      <div class="d-flex align-items-center">
        <button
          @click="addToCart(product)"
          class="shadow btn-sm btn-success w-100"
          :disabled="cart_loader"
        >
          <span
            v-if="cart_loader"
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          <span v-else class="d-flex align-items-center justify-content-center">
            <Icon height="18" icon="ic:outline-shopping-cart" class="mr-2" />
            Cart
          </span>
        </button>
        <div class="ms-2">
          <button class="wish_btn">
            <Icon icon="ph:heart" height="17" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { Icon } from "@iconify/vue";
import Rating from "@/Components/Common/Rating.vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import store from "@/store";

const addToCart = async (params) => {
  const product = {
    id: params.id,
    title: params.title,
    slug: params.slug,
    image: params.image,
    price: params.price,
    quantity: params.quantity,
  };
  const res = await store.dispatch("cart/addToCart", { product });
  toast.success(res);
};

import {
  firstLetterUpperCase,
  discountPercentage,
  formatProductName,
  formatCurrency,
} from "@/utils/helper.js";

defineProps(["product"]);

const rating = ref(6);
</script>

<style lang="css" scoped>
#product_component.card {
  transition: 500ms;
  box-shadow: none;
}
#product_component.card:hover {
  box-shadow: var(--shadow-1);
}
#product_component .discount_percentage {
  position: absolute;
  top: 3px;
  right: 3px;
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
  color: var(--black);
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