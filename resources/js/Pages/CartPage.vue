<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { Icon } from "@iconify/vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import NoResult from "@/Components/Common/NoResult.vue";

const props = defineProps(["cartItems", "cartTotal", "cartCount"]);
const step_one = {
  slug: "Cart",
  link: false,
  route_name: "",
};
console.log(props.cartItems);
const formUpdate = useForm({
  id: "",
  type: "",
});
const formClear = useForm({});

const updateCart = (params, data) => {
  formUpdate.clearErrors();
  formUpdate.id = params.id;
  if (data == "inc") {
    formUpdate.type = "inc";
  }
  if (data == "dec") {
    formUpdate.type = "dec";
  }
  formUpdate.put(route("update-cart"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Cart item has been updated successfully.");
      formUpdate.reset();
    },
    onError: () => {
      toast.error(`Unable to update your cart item.`);
    },
  });
};
const removeFromCart = (params) => {
  formUpdate.clearErrors();
  formUpdate.id = params.id;
  formUpdate.put(route("remove-cart"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Cart item has been removed successfully.");
      formUpdate.reset();
    },
    onError: () => {
      toast.error(`Unable to remove cart item.`);
    },
  });
};
const clearCart = () => {
  formClear.delete(route("clear-cart"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Cart item has been removed successfully.");
      formClear.reset();
    },
    onError: () => {
      toast.error(`Unable to remove cart item.`);
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
            class="
              mb-1
              bg-white
              p-1
              shadow-sm
              d-flex
              justify-content-between
              align-items-center
            "
          >
            <div>
              <h5 class="my-0 py-0 fw-bold">Cart({{ cartCount }})</h5>
            </div>
            <div>
              <Link
                class="btn btn-sm mx-1 btn-outline-success"
                :href="route('product-page')"
              >
                Continue shopping
              </Link>
              <button
                @click="clearCart"
                :disabled="formClear.processing"
                class="btn btn-sm btn-outline-danger"
              >
                <span
                  v-if="formClear.processing"
                  class="spinner-border spinner-border-sm mx-1"
                  role="status"
                  aria-hidden="true"
                ></span>
                Clear Cart
              </button>
            </div>
          </div>
          <div class="cart">
            <div
              class="cart__box mb-1 rounded shadow-sm bg-white p-1"
              v-for="(cartItem, index) in cartItems"
              :key="cartItem + index"
            >
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <Link
                    :href="
                      route('product-details-page', cartItem.attributes.slug)
                    "
                  >
                    <img
                      width="55"
                      height="55"
                      class="rounded"
                      :src="JSON.parse(cartItem.attributes.image).img_url"
                      :alt="cartItem.name"
                    />
                  </Link>
                </div>
                <div>
                  <Link
                    :href="
                      route('product-details-page', cartItem.attributes.slug)
                    "
                  >
                    <h5 class="fw-bolder">{{ cartItem.name }}</h5>
                  </Link>
                  <p class="fw-light">
                    Quantity:
                    <span
                      class="fw-bold"
                      style="background: var(--green-0); padding: 2px"
                    >
                      {{ cartItem.quantity }}</span
                    >
                  </p>
                </div>
              </div>
              <hr />
              <div class="d-flex justify-content-between">
                <div>
                  <p class="fw-bold rounded my-0 py-0">
                    Price: {{ cartItem.price }} X {{ cartItem.quantity }} =
                    <span
                      class="fw-bolder"
                      style="background: var(--green-0); padding: 2px"
                      >&#8358; {{ cartItem.price * cartItem.quantity }}</span
                    >
                  </p>
                </div>
                <div class="d-flex align-items-center gap-1">
                  <button
                    @click="updateCart(cartItem, 'dec')"
                    :disabled="cartItem.quantity <= 1"
                    class="btn btn-sm btn-success shadow"
                  >
                    <Icon icon="ic:baseline-minus" />
                  </button>
                  <p class="my-0">{{ cartItem.quantity }}</p>
                  <button
                    :disabled="cartItem.quantity == cartItem.attributes.stock"
                    @click="updateCart(cartItem, 'inc')"
                    class="btn btn-sm btn-success"
                  >
                    <Icon icon="material-symbols:add" />
                  </button>
                  <button
                    @click="removeFromCart(cartItem)"
                    class="btn btn-sm btn-outline-danger"
                  >
                    <Icon icon="material-symbols:delete-outline-rounded" />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 my-2">
          <div class="cart__total p-1 bg-white shadow-sm rounded">
            <h5 class="fw-bolder">Cart Summary</h5>
            <hr />
            <p>
              <b>Subtotal: </b>
              <span
                class="fw-bolder rounded"
                style="background: var(--green-0); padding: 2px"
                >&#8358; {{ cartTotal }}</span
              >
            </p>
            <hr />
            <button class="btn btn-primary w-100">CheckOut</button>
          </div>
        </div>
      </div>
      <div v-else class="row">
        <div class="col-12 text-center">
          <NoResult text="Your cart is empty" />
          <Link
            class="btn rounded-pill btn-success mt-1"
            :href="route('product-page')"
            >Products</Link
          >
        </div>
      </div>
    </div>
  </GuestLayout>
</template>
