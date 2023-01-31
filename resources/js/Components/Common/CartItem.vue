<template>
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <Link
        :href="route('product-details-page', cartItem.associatedModel.slug)"
      >
        <img
          width="60"
          height="60"
          class="rounded"
          :src="JSON.parse(cartItem.associatedModel.image).img_url"
          :alt="cartItem.name"
        />
      </Link>
      <small class="my-0 py-0">{{
        cartItem.associatedModel.stock > 0
          ? `In Stock - ${cartItem.associatedModel.stock}`
          : "Out of Stock"
      }}</small>
    </div>
    <div>
      <Link
        :href="route('product-details-page', cartItem.associatedModel.slug)"
      >
        <h5 class="fw-bolder">{{ cartItem.name }}</h5>
      </Link>
      <p class="fw-light my-0 py-0 small">
        Quantity:
        <span class="fw-bolder"> {{ cartItem.quantity }}</span>
      </p>
      <p class="fw-light rounded my-0 py-0 small">
        Price: &#8358; {{ cartItem.price }} X {{ cartItem.quantity }} =
        <span
          class="fw-bold rounded"
          style="background: var(--green-0); padding: 2px"
          >&#8358; {{ cartItem.price * cartItem.quantity }}</span
        >
      </p>
    </div>
  </div>
  <hr />
  <div class="d-flex justify-content-between align-items-center">
    <button
      @click="removeFromCart(cartItem)"
      class="btn btn-sm btn-outline-danger"
      :disabled="formDelete.processing"
    >
      <span
        v-if="formDelete.processing"
        class="spinner-border spinner-border-sm"
        role="status"
        aria-hidden="true"
      ></span>
      <Icon v-else icon="material-symbols:delete-outline-rounded" />
    </button>

    <div class="d-flex align-items-center gap-1">
      <button
        @click="updateCart(cartItem, 'dec')"
        :disabled="cartItem.quantity <= 1 || loader_minus"
        class="btn btn-sm btn-success shadow"
      >
        <span
          v-if="loader_minus"
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
        ></span>
        <Icon v-else icon="ic:baseline-minus" />
      </button>
      <p class="my-0">{{ cartItem.quantity }}</p>
      <button
        :disabled="
          cartItem.quantity >= cartItem.associatedModel.stock || loader_add
        "
        @click="updateCart(cartItem, 'inc')"
        class="btn btn-sm btn-success"
      >
        <span
          v-if="loader_add"
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
        ></span>
        <Icon v-else icon="material-symbols:add" />
      </button>
    </div>
  </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { Link, useForm } from "@inertiajs/vue3";
import { toast } from "@/utils/helper";
import { ref } from "vue";

const loader_add = ref(false);
const loader_minus = ref(false);
const props = defineProps(["cartItem"]);
const formUpdate = useForm({
  id: "",
  type: "",
});

const formDelete = useForm({
  id: "",
});

const updateCart = (params, data) => {
  formUpdate.clearErrors();
  formUpdate.id = params.id;
  if (data == "inc") {
    formUpdate.type = "inc";
    loader_add.value = true;
  }
  if (data == "dec") {
    formUpdate.type = "dec";
    loader_minus.value = true;
  }
  formUpdate.put(route("update-cart"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Cart item has been updated successfully.");
      formUpdate.reset();
      loader_add.value = false;
      loader_minus.value = false;
    },
    onError: () => {
      toast.error(`Unable to update your cart item.`);
      loader_add.value = false;
      loader_minus.value = false;
    },
  });
};
const removeFromCart = (params) => {
  formDelete.clearErrors();
  formDelete.id = params.id;
  formDelete.put(route("remove-cart"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Cart item has been removed successfully.");
      formDelete.reset();
    },
    onError: () => {
      toast.error(`Unable to remove cart item.`);
    },
  });
};
</script>

<style lang="scss" scoped>
</style>