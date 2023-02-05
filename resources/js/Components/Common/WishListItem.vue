<template>
  <div class="d-flex justify-content-between align-items-start">
    <div>
      <img
        :style="item.stock <= 0 ? 'filter: grayscale(100%)' : ''"
        width="55"
        height="55"
        class="rounded"
        :src="JSON.parse(item.image).img_url"
        :alt="item.title"
      />
      <small class="text-danger small">{{
        item.stock <= 0 ? "Out of Stock" : "In Stock"
      }}</small>
    </div>
    <div>
      <h5 class="fw-bolder">{{ item.title }}</h5>
      <p class="fw-light">{{ item.sub_title }}</p>
    </div>
  </div>
  <hr class="my-0 py-0" />
  <div class="d-flex gap-2 justify-content-between align-items-center">
    <h5
      style="background: var(--green-0); padding: 2px"
      class="fw-bolder rounded"
    >
      <span>&#8358;</span>{{ formatCurrency(item.price) }}
    </h5>
    <div class="d-flex gap-1 justify-content-between align-items-center">
      <button @click="removeFromWishList(item.id)" class="btn text-danger">
        <Icon height="15" icon="material-symbols:delete-outline-rounded" />
      </button>
      <button
        :disabled="product.processing || item.stock <= 0"
        @click="addToCart(item)"
        class="shadow btn-sm btn-success"
      >
        <span
          v-if="product.processing"
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
        ></span>
        <span v-else class="d-flex align-items-center justify-content-center">
          <Icon height="15" icon="ic:outline-shopping-cart" />
        </span>
      </button>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import store from "@/store";
import { firstLetterUpperCase, formatCurrency, toast } from "@/utils/helper.js";
import { Icon } from "@iconify/vue";

const props = defineProps(["item"]);
const product = useForm({
  id: props.item.id,
  name: props.item.title,
  image: props.item.image,
  slug: props.item.slug,
  stock: props.item.stock,
  price: Number(props.item.discount_price)
    ? Number(props.item.discount_price)
    : Number(props.item.price),
  quantity: 1,
});

const addToCart = (params) => {
  if (Number(props.item.stock) == 0)
    return toast.error(
      `${firstLetterUpperCase(params.title)} is out of stock.`
    );
  product.post(route("add-to-cart"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success(
        firstLetterUpperCase(params.title) + " has been added to your cart."
      );
      product.reset();
      store.dispatch("wishlistStore/removeFromWishList", params.id);
    },
    onError: () => {
      toast.error(
        `${firstLetterUpperCase(params.title)} is already in your cart.`
      );
    },
  });
};
const removeFromWishList = (productId) => {
  store.dispatch("wishlistStore/removeFromWishList", productId);
  toast.success("The product has been removed from your wishlist.");
};
</script>

<style lang="css" scoped>
</style>