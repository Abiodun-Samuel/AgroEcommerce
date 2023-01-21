<template>
  <GuestLayout>
    <BreadCrump :step_one="step_one" :step_two="step_two" />
    <div class="container">
      <div id="productdetials bg-white shadow-sm">
        <div class="row">
          <div class="col-lg-5 col-md-6 mt-3 mb-1">
            <div class="productdetials__image">
              <img
                :src="JSON.parse(product.image).img_url"
                :alt="product.title"
                class="img-fluid rounded shadow-sm"
              />
            </div>
          </div>
          <div class="col-lg-7 col-md-6 mt-3 mb-1">
            <div class="productdetials__text">
              <h3 class="fw-bolder" style="color: var(--green-5)">
                {{ firstLetterUpperCase(product.title) }}
              </h3>
              <p class="fw-light text-secondary" v-if="product.sub_title">
                {{ firstLetterUpperCase(product.sub_title) }}
              </p>
              <p class="my-0 py-0">
                <Rating
                  :value="averageRating"
                  :text="`${product.reviews.length} Review${
                    product.reviews.length > 1 ? 's' : ''
                  }`"
                />
              </p>
              <hr />
              <p>
                <span class="text-dark fw-normal">Brand: </span>
                <span class="text-secondary fw-light">{{
                  product.brands
                }}</span>
              </p>
              <p>
                <span class="text-dark fw-normal">Size: </span>
                <span class="text-secondary fw-light">{{
                  product.pack_size
                }}</span>
              </p>
              <p>
                <span class="text-dark fw-normal">Subcategory: </span>
                <span class="text-secondary fw-light">{{
                  product.subcategory.title
                }}</span>
              </p>
              <p>
                <span class="text-dark fw-normal">Category: </span>
                <span class="text-secondary fw-light">{{
                  product.subcategory.category.title
                }}</span>
              </p>
              <hr />
              <div class="d-flex gap-3 align-items-center">
                <h1 class="text-secondary fw-bolder">
                  &#8358;{{
                    !product.discount_price
                      ? formatCurrency(product.price)
                      : formatCurrency(product.discount_price)
                  }}
                </h1>
                <p
                  v-if="product.discount_price"
                  class="fw-normal text-danger text-decoration-line-through"
                >
                  &#8358; {{ formatCurrency(product.price) }}
                </p>
                <p
                  v-if="product.discount_price"
                  class="small bg-warning rounded text-light"
                  style="padding: 2px"
                >
                  {{
                    discountPercentage(product.price, product.discount_price)
                  }}
                </p>
              </div>
              <p>
                <span class="text-dark fw-normal">Stock: </span>
                <span class="text-secondary fw-light"
                  >{{
                    Number(product.stock) > 0
                      ? `${product.stock} (In Stock)`
                      : `${product.stock} (Out of Stock)`
                  }}
                </span>
              </p>
              <div class="d-flex align-items-stretch gap-1">
                <button
                  :disabled="quantity === 0"
                  @click="decreaseQuantity"
                  class="btn btn-sm btn-success"
                >
                  <Icon icon="ic:baseline-minus" width="20" />
                </button>
                <input
                  class="form-control w-25"
                  type="number"
                  id="quantity"
                  name="quantity"
                  min="1"
                  :max="product.stock"
                  v-model.number="quantity"
                  :disabled="
                    quantity === 0 ||
                    quantity === Number(product.stock) ||
                    Number(product.stock) === 0
                  "
                />
                <!-- <input
                  :disabled="
                    quantity === 0 ||
                    quantity === Number(product.stock) ||
                    Number(product.stock) === 0
                  "
                  type="number"
                  v-model.number="quantity"
                  class="form-control w-25"
                /> -->
                <button
                  @click="increaseQuantity"
                  :disabled="
                    quantity === Number(product.stock) ||
                    Number(product.stock) === 0
                  "
                  class="btn btn-sm btn-success"
                >
                  <Icon icon="material-symbols:add" width="20" />
                </button>
              </div>
              <hr />
              <div class="d-flex gap-3 align-items-center">
                <button
                  :disabled="Number(product.stock) === 0"
                  @click="addToCart"
                  class="btn btn-success d-flex align-items-center"
                >
                  <Icon
                    icon="ic:outline-shopping-cart"
                    height="19"
                    class="me-1"
                  />
                  <span>Add to Cart</span>
                </button>
                <button @click="addToWishList(product)" class="wish_btn">
                  <Icon icon="ph:heart" height="20" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div class="row">
        <div class="col-lg-12">
          <div class="product__details my-1 bg-white shadow-sm p-1">
            <div
              class="d-flex gap-1 justify-content-between align-items-center"
            >
              <div class="d-flex gap-1 align-items-center">
                <button
                  @click="productTab = 'product-details'"
                  :class="
                    productTab == 'product-details'
                      ? 'btn-success'
                      : 'btn-outline-success'
                  "
                  class="btn btn-md"
                >
                  Product Details
                </button>
                <button
                  @click="productTab = 'product-reviews'"
                  :class="
                    productTab == 'product-reviews'
                      ? 'btn-success'
                      : 'btn-outline-success'
                  "
                  class="btn btn-md"
                >
                  Product Reviews
                </button>
              </div>
              <div>
                <button
                  @click="openReviewModal = true"
                  class="btn btn-sm btn-outline-primary"
                  v-if="auth_user"
                >
                  Write a Review
                </button>
                <Link
                  v-else
                  class="btn btn-sm btn-outline-google"
                  :href="route('login')"
                  >Login to write a review</Link
                >
              </div>
            </div>
            <hr />
            <div data-aos="zoom-in" v-if="productTab == 'product-details'">
              <p class="text-dark fw-bolder">Ingredients</p>
              <p class="text-secondary fw-normal">{{ product.ingredients }}</p>
              <p class="text-dark fw-bolder">Description</p>
              <p class="text-secondary fw-normal">{{ product.description }}</p>
            </div>
            <div data-aos="zoom-in" v-if="productTab == 'product-reviews'">
              <p class="text-dark fw-bolder">
                Verified ratings and comments ({{ product.reviews.length }})
              </p>
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 my-1">
                  <div class="review__total rounded shadow-sm p-1">
                    <h2 class="text-warning">{{ averageRating }}/5</h2>
                    <p><Rating :value="averageRating" /></p>
                    <p class="text-dark">
                      {{ product.reviews.length }} Verified Rating{{
                        product.reviews.length > 1 ? "s" : ""
                      }}
                    </p>
                  </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 my-1 review__box">
                  <template v-if="sortReviews.length">
                    <div class="">
                      <div v-for="review in sortReviews" :key="review.id">
                        <p class="lead"><Rating :value="review.rating" /></p>
                        <p class="text-dark fw-normal">
                          {{ review.comment }}
                        </p>
                        <div
                          class="
                            d-flex
                            justify-content-between
                            align-items-center
                          "
                        >
                          <p class="text-secondary fw-light mb-0 pb-0">
                            <span>{{ formatTime(review.created_at) }} </span>
                            <span> by </span>
                            <span class="fw-normal">
                              {{ firstLetterUpperCase(review.user.first_name) }}
                              {{ firstLetterUpperCase(review.user.last_name) }}
                            </span>
                          </p>
                          <p
                            class="
                              d-flex
                              align-items-center
                              text-success
                              fw-normal
                              mb-0
                              pb-0
                            "
                          >
                            <Icon
                              height="15"
                              width="15"
                              icon="ic:baseline-verified-user"
                              style="margin-right: 4px"
                            />
                            <span>Verified</span>
                          </p>
                        </div>
                        <hr />
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <div class="bg-white text-center">
                      <h4 class="text-danger fw-bolder">No product reviews</h4>
                    </div>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="product__details my-1 bg-white shadow-sm p-1">
        <div class="row">
          <h4 class="fw-bolder">Related Products</h4>
          <hr />
        </div>

        <div v-if="relatedProducts.length" class="row">
          <div
            v-for="relatedProduct in relatedProducts"
            :key="relatedProduct.id"
            class="col-lg-3 col-md-6 col-sm-6 col-6"
          >
            <ProductComponent :product="relatedProduct" />
          </div>
        </div>
        <div v-else class="row">
          <div class="col-lg-12 text-center">
            <NoResult />
            <Link class="btn btn-sm btn-success" :href="route('product-page')"
              >Products</Link
            >
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>

  <Modal
    :show="openReviewModal"
    :size="'modal-md'"
    :footer="true"
    @close="openReviewModal = false"
  >
    <template #header>
      <h4
        class="
          modal-title
          text-primary
          d-flex
          align-items-center
          gap-1
          fw-bolder
        "
      >
        <Icon icon="jam:write-f" />
        Write a Review
      </h4>
    </template>

    <template #body>
      <FormError :errors="formReview.errors" />
      <div class="my-1">
        <label for="rating" class="form-label">Rating</label>
        <select
          v-model.number="formReview.rating"
          class="form-select"
          aria-label="Default select rating"
        >
          <option selected disabled>Select rating</option>
          <option value="1">1 (Poor)</option>
          <option value="2">2 (Fair)</option>
          <option value="3">3 (Good)</option>
          <option value="4">4 (Very Good)</option>
          <option value="5">5 (Excellent)</option>
        </select>
      </div>
      <div class="my-1">
        <label for="comment" class="form-label">Comment</label>
        <textarea
          id="comment"
          class="form-control"
          v-model="formReview.comment"
          rows="4"
        ></textarea>
      </div>
    </template>

    <template #footer>
      <div class="d-flex gap-1 align-items-center">
        <button @click="sendReview" class="btn btn-sm btn-success">
          <span>Send</span>
          <span
            v-if="formReview.processing"
            class="spinner-border spinner-border-sm mx-1"
            role="status"
            aria-hidden="true"
          ></span>
        </button>
        <button @click="openReviewModal = false" class="btn btn-sm btn-danger">
          No, Cancel
        </button>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import Rating from "@/Components/Common/Rating.vue";
import FormError from "@/Components/Common/FormError.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { computed, ref } from "vue";
import { Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { Icon } from "@iconify/vue";
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import NoResult from "@/Components/Common/NoResult.vue";
import Modal from "@/Components/Common/Modal.vue";
import moment from "moment";
import {
  firstLetterUpperCase,
  discountPercentage,
  formatCurrency,
  toast,
  formatTime,
} from "@/utils/helper.js";
import store from "@/store";

const auth_user = computed(() => usePage().props.value.auth.user);
const categories = computed(() => usePage().props.value.data.categories);
const props = defineProps({
  product: Object,
  relatedProducts: Array,
});
const step_one = {
  slug: "Products",
  link: true,
  route_name: "product-page",
};
const step_two = {
  slug: firstLetterUpperCase(props.product.title),
  link: false,
  route_name: null,
};
const formReview = useForm({
  rating: 5,
  comment: null,
  product_id: props.product.id,
  user_id: auth_user.value?.id,
});
const quantity = ref(1);
const openReviewModal = ref(false);
const productTab = ref("product-details");
const rating = ref(5);
const sortReviews = computed(() => {
  return props.product.reviews.sort(function (a, b) {
    return moment(b.updated_at) - moment(a.updated_at);
  });
});
const averageRating = computed(() => {
  if (!props.product.reviews.length) return 0;
  const totalRatings = props.product.reviews.reduce(
    (total, num) => total + num.rating,
    0
  );
  const calc = (totalRatings * 5) / (props.product.reviews.length * 5);
  return calc.toFixed(2);
});
const increaseQuantity = () => {
  if (quantity.value === Number(props.product.stock)) return null;
  quantity.value++;
};
const decreaseQuantity = () => {
  if (quantity.value === 0) return null;
  quantity.value--;
};
const addToCart = () => {
  if (quantity.value > Number(props.product.stock))
    return toast.error(
      "Product quantity is greater than the quantity in stock"
    );
  if (Number(props.product.stock) == 0)
    return toast.error("Product is out of stock");
};
const addToWishList = (params) => {
  const product = {
    id: params.id,
    title: params.title,
    sub_title: params.sub_title,
    image: params.image,
    price: params.discount_price ? params.discount_price : params.price,
    quantity: 1,
  };
  store.dispatch("wishlistStore/addToWishList", product);
};
const sendReview = () => {
  formReview.clearErrors();
  formReview.post(route("user.send-review", props.product.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Review has been sent successfully");
      formReview.reset();
      openReviewModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to send your review`);
    },
  });
};
</script>

<style lang="css" scoped>
.review__total {
  background: #f5f5f5;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.review__total p {
  margin: 5px 0;
}
.review__box {
  max-height: 100vh;
  overflow-y: scroll;
}
.review__box::-webkit-scrollbar {
  width: 8px;
}

.review__box::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 5px;
}

.review__box::-webkit-scrollbar-thumb {
  background: var(--green-5);
  border-radius: 5px;
}
.wish_btn {
  background: var(--green-0);
  border-radius: 50%;
  display: flex;
  height: 35px;
  width: 35px;
  justify-content: center;
  align-items: center;
  color: var(--black);
}
</style>