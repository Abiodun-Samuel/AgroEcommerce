<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { Icon } from "@iconify/vue";
import { ref, computed } from "vue";
import { toast, formatCurrency } from "@/utils/helper";
import NoResult from "@/Components/Common/NoResult.vue";
import { Country, State } from "country-state-city";
import Modal from "@/Components/Common/Modal.vue";
import FormError from "@/Components/Common/FormError.vue";
// import paystack from "vue3-paystack";

const props = defineProps(["cartItems", "cartTotal"]);
const step_one = {
  slug: "CheckOut",
  link: false,
  route_name: "",
};

const showUpdateModal = ref(false);
const cartItemsLength = ref([]);
const user = computed(() => usePage().props.auth.user);
const countries = ref(Country.getAllCountries());
const states = ref([]);
const getCountryCode = (value) => {
  states.value = State.getStatesOfCountry(value?.isoCode);
};
const publicKey = ref(import.meta.env.VITE_PAYSTACK_PUBLIC_KEY);
const email = ref(user.value.email);
// const amount = ref(props.cartTotal * 100);
// const reference = ref("ndmjkn");

// const onSuccessfulPayment = () => {
//   console.log("object");
// };
// const onCancelledPayment = () => {
//   console.log("object");
// };

const orderForm = useForm({
  name: user.value.first_name + " " + user.value.last_name,
  phone: user.value.phone,
  email: user.value.email,
  address: `${user.value.address}, ${user.value.city}, ${user.value.state}, ${user.value.country}.`,
  payment_option: "",
  delivery_option: "",
  order_status: "Pending",
  payment_status: "Not Paid",
});

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

const userProfileUpdate = useForm({
  phone: user.value.phone,
  address: user.value.address,
  city: user.value.city,
  state: user.value.state,
  country: user.value.country,
});

const updateUserProfile = () => {
  userProfileUpdate.clearErrors();
  userProfileUpdate.post(route("user.update-user", user.value.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Profile has been updated successfully");
      showUpdateModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to update profile.`);
    },
  });
};

const createOrder = () => {
  if (Number(props.cartTotal) <= 0) return;
  orderForm.clearErrors();
  orderForm.post(route("user.order.create", user.value.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Your order has been created successfully");
      orderForm.reset();
    },
    onError: () => {
      toast.error(`Error, unable to create your order`);
    },
  });
};
</script>

<template>
  <Head title="CheckOut" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <div v-if="Number(cartTotal) > 0" class="container">
      <div class="row">
        <div class="col-lg-8 col-md-7 my-2">
          <!-- address  -->
          <div class="bg-white rounded shadow-sm p-1 mb-1">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-1">
                <Icon
                  :class="user.is_completed == true ? 'text-success' : ''"
                  height="20"
                  icon="mdi:checkbox-marked-circle"
                />
                <h5 class="fw-bolder my-0 py-0" style="color: var(--green-5)">
                  1. Address Details
                </h5>
              </div>
              <button
                @click="showUpdateModal = true"
                class="text-warning alert alert-warning m-0 p-0"
              >
                <span style="padding: 3px">Change</span>
              </button>
            </div>

            <hr />
            <div class="row">
              <template v-if="user.is_completed == true">
                <div class="col-12 px-4 py-1">
                  <h5>{{ user.first_name }} {{ user.last_name }}</h5>
                  <p class="fw-light my-0 py-0">
                    {{ user.email }}
                  </p>
                  <p class="fw-light my-0 py-0">
                    {{ user.phone }}
                  </p>
                  <p class="fw-light my-0 py-0">
                    {{ user.address }}, {{ user.city }}, {{ user.state }},
                    {{ user.country }}.
                  </p>
                </div>
              </template>
              <template v-else>
                <div class="col-12 px-4 py-1">
                  <p class="text-danger fw-bold">
                    Please enter your delivery address
                  </p>
                </div>
              </template>
            </div>
          </div>
          <!-- delivery  -->
          <div class="bg-white rounded shadow-sm p-1 mb-1">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-1">
                <Icon
                  :class="orderForm.delivery_option ? 'text-success' : ''"
                  height="20"
                  icon="mdi:checkbox-marked-circle"
                />
                <h5 class="fw-bolder my-0 py-0" style="color: var(--green-5)">
                  2. Delivery Option
                </h5>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-12 px-4 py-1">
                <h5 class="text-secondary fw-light">
                  How do you want your order delivered?
                </h5>
                <div class="form-check my-1">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault1"
                    v-model="orderForm.delivery_option"
                    value="office_pickup"
                  />
                  <label class="form-check-label" for="flexRadioDefault1">
                    Office Pickup
                    <span class="small"
                      >(Pick up your order at out office address)</span
                    >
                  </label>
                  <div class="border-1 p-1 rounded mt-1">
                    <p class="fw-light">
                      Monday - Friday: 9am - 5pm <br />
                      Saturday: 9am - 1pm
                    </p>
                    <p class="fw-light mb-0">
                      Address: 10, Jimoh Odu Street, Opp Benson B/S, Ikorodu
                      Garage, Ikorodu, Lagos.
                    </p>
                  </div>
                </div>
                <div class="form-check my-1">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
                    v-model="orderForm.delivery_option"
                    value="door_delivery"
                  />
                  <label class="form-check-label" for="flexRadioDefault2">
                    Door Delivery
                  </label>
                  <div class="border-1 p-1 rounded mt-1">
                    <p class="fw-light mb-0 small text-danger">
                      Please note that the checkout total amount (&#8358;
                      {{ formatCurrency(cartTotal) }}) <b>does not</b>
                      include the delivery fee.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- payment  -->
          <div class="bg-white rounded shadow-sm p-1 mb-1">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-1">
                <Icon
                  :class="orderForm.payment_option ? 'text-success' : ''"
                  height="20"
                  icon="mdi:checkbox-marked-circle"
                />
                <h5 class="fw-bolder my-0 py-0" style="color: var(--green-5)">
                  3. Payment Options
                </h5>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-12 px-4 py-1">
                <h5 class="fw-light">How do you want to pay for your order?</h5>
                <div class="form-check my-1">
                  <input
                    v-model="orderForm.payment_option"
                    value="Bank"
                    class="form-check-input"
                    type="radio"
                    name="payment_method"
                    id="payment_method1"
                  />
                  <label class="form-check-label" for="payment_method1">
                    Pay with Cards or Bank Transfer
                  </label>
                </div>
                <div class="form-check my-1">
                  <input
                    v-model="orderForm.payment_option"
                    value="Cash"
                    class="form-check-input"
                    type="radio"
                    name="payment_method"
                    id="payment_method2"
                  />
                  <label class="form-check-label" for="payment_method2">
                    Pay with Cash
                  </label>
                </div>
                <small class="text-danger fst-italic"
                  >(Payment validates order)</small
                >
              </div>
            </div>
          </div>
          <!-- place order  -->
          <div class="bg-white rounded shadow-sm p-1 mb-1">
            <!-- <paystack
              buttonClass="'btn btn-primary'"
              buttonText="Pay Online"
              :publicKey="publicKey"
              :email="email"
              :amount="amount"
              :reference="reference"
              :onSuccess="onSuccessfulPayment"
              :onCanel="onCancelledPayment"
            ></paystack> -->

            <button
              @click="createOrder"
              :disabled="
                orderForm.processing ||
                !orderForm.payment_option ||
                !orderForm.delivery_option ||
                user.is_completed == false ||
                Number(cartTotal) <= 0
              "
              class="btn btn-success w-100 d-flex align-items-center justify-content-center"
            >
              <span
                v-if="orderForm.processing"
                class="spinner-border spinner-border-sm mx-1"
                role="status"
                aria-hidden="true"
              ></span>
              <Icon
                v-else
                height="18"
                icon="icon-park-outline:shopping-cart-one"
                class="mx-1"
              />
              <span>Place Order</span>
            </button>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 my-2">
          <div class="order__summary bg-white rounded p-1 shadow-sm mb-1">
            <h5
              class="fw-bolder my-0 py-0 d-flex gap-1"
              style="color: var(--green-5)"
            >
              <Icon
                height="20"
                icon="material-symbols:order-approve-outline-sharp"
              />
              <span>Edit Cart</span>
            </h5>
            <hr />
            <Link
              :href="route('cart')"
              class="btn btn-success rounded w-100 d-flex gap-1 align-items-center justify-content-center"
            >
              <Icon icon="ic:outline-shopping-cart" height="15" /> Modify Cart
            </Link>
          </div>
          <div class="order__summary bg-white rounded p-1 shadow-sm mb-1">
            <h5
              class="fw-bolder my-0 py-0 d-flex gap-1"
              style="color: var(--green-5)"
            >
              <Icon height="20" icon="mdi:account-help" />
              <span>Need help? </span>
            </h5>
            <hr />
            <a
              href="https://wa.link/20q7u6"
              target="_blank"
              class="btn btn-primary rounded w-100 d-flex gap-1 align-items-center justify-content-center"
            >
              <Icon icon="clarity:chat-bubble-outline-badged" height="15" />
              Live Chat
            </a>
            <small class="text-danger small italics mt-1"
              >You can also send a message after placing your order</small
            >
          </div>
        </div>
      </div>
    </div>
    <div v-else class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="alert alert-danger p-2 text-center mt-4">
            You have no items in your cart <br />
            <Link :href="route('product-page')" class="btn btn-danger mt-1"
              >Products</Link
            >
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
  <Modal
    :show="showUpdateModal"
    :size="'modal-md'"
    :footer="true"
    @close="showUpdateModal = false"
  >
    <template #header>
      <h4
        class="modal-title text-warning d-flex align-items-center gap-1 fw-bolder"
      >
        Address Details
      </h4>
    </template>

    <template #body>
      <FormError :errors="userProfileUpdate.errors" />
      <div class="row">
        <div class="col-lg-6 col-md-6 col-6 mb-1">
          <label for="phone" class="form-label">Phone</label>
          <input
            type="tel"
            name="phone"
            id="phone"
            class="form-control"
            placeholder="Phone number"
            v-model="userProfileUpdate.phone"
          />
        </div>
        <!-- country, state, city -->
        <div class="col-lg-6 col-md-6 col-6 mb-1">
          <label for="country" class="form-label">Country</label>
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="userProfileUpdate.country"
            @change="getCountryCode(userProfileUpdate.country)"
          >
            <option
              v-for="country in countries"
              :key="country"
              :value="country"
            >
              {{ country.name }}
            </option>
          </select>
        </div>
        <div class="col-lg-6 col-md-6 col-6 my-1">
          <label for="state" class="form-label">State</label>
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="userProfileUpdate.state"
          >
            <option v-for="state in states" :key="state" :value="state.name">
              {{ state.name }}
            </option>
          </select>
        </div>
        <div class="col-lg-6 col-md-6 col-6 my-1">
          <label for="city" class="form-label">City</label>
          <input
            type="text"
            class="form-control"
            id="city"
            placeholder="City"
            v-model="userProfileUpdate.city"
          />
        </div>
        <!-- address  -->
        <div class="col-12 my-1">
          <label for="address" class="form-label">Address</label>
          <input
            id="address"
            rows="3"
            class="form-control"
            v-model="userProfileUpdate.address"
          />
        </div>
        <!-- save as adress  -->
        <!-- <div class="col-12">
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              v-model="userProfileUpdate.save_as_my_address"
              id="saveasmyaddress"
            />
            <label class="form-check-label small" for="saveasmyaddress">
              Save as my address
            </label>
          </div>
        </div> -->
      </div>
    </template>

    <template #footer>
      <button
        @click="updateUserProfile"
        :disabled="userProfileUpdate.processing"
        class="btn btn-success w-100"
      >
        <span
          v-show="userProfileUpdate.processing"
          class="spinner-border spinner-border-sm mx-1"
        ></span>
        Save
      </button>
    </template>
  </Modal>
</template>
