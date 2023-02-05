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
import paystack from "vue3-paystack";

const props = defineProps(["cartItems", "cartTotal"]);
const step_one = {
  slug: "CheckOut",
  link: false,
  route_name: "",
};
const showUpdateModal = ref(false);
const delivery__option = ref(false);
const payment__option = ref(false);
const user = computed(() => usePage().props.auth.user);
const countries = ref(Country.getAllCountries());
const states = ref([]);
const getCountryCode = (value) => {
  states.value = State.getStatesOfCountry(value.isoCode);
};

const publicKey = ref(import.meta.env.VITE_PAYSTACK_PUBLIC_KEY);
const email = ref(user.value.email);
const amount = ref(props.cartTotal * 100);
const reference = ref("ndmjkn");

const onSuccessfulPayment = () => {
  console.log("object");
};
const onCancelledPayment = () => {
  console.log("object");
};

const formUpdate = useForm({
  first_name: user.value.first_name,
  last_name: user.value.last_name,
  phone: user.value.phone,
  address: user.value.address,
  city: user.value.city,
  state: user.value.state,
  country: user.value.country,
  gender: user.value.gender,
  email: user.value.email,
  dob: user.value.dob,
});

const orderForm = useForm({
  first_name: user.value.first_name,
  last_name: user.value.last_name,
  phone: user.value.phone,
  address: user.value.address,
  city: user.value.city,
  state: user.value.state,
  country: user.value.country,
  gender: user.value.gender,
  email: user.value.email,
  dob: user.value.dob,
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

const createOrder = () => {
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

const updateDetails = () => {
  formUpdate.clearErrors();
  formUpdate.post(route("user.update-profile", user.value.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Address details has been updated successfully");
      formUpdate.reset();
      showUpdateModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to update your address.`);
    },
  });
};
</script>

<template>
  <Head title="CheckOut" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <div class="container">
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
                  :class="delivery__option ? 'text-success' : ''"
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
                    v-model="delivery__option"
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
                    v-model="delivery__option"
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
                  :class="payment__option ? 'text-success' : ''"
                  height="20"
                  icon="mdi:checkbox-marked-circle"
                />
                <h5 class="fw-bolder my-0 py-0" style="color: var(--green-5)">
                  3. Payment Mode
                </h5>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-12 px-4 py-1">
                <h5 class="fw-light">How do you want to pay for your order?</h5>
                <div class="form-check my-1">
                  <input
                    v-model="payment__option"
                    value="pay_now"
                    class="form-check-input"
                    type="radio"
                    name="payment_method"
                    id="payment_method2"
                  />
                  <label class="form-check-label" for="payment_method2">
                    Pay with Cards, Bank Transfer or USSD
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
            <paystack
              buttonClass="'btn btn-primary'"
              buttonText="Pay Online"
              :publicKey="publicKey"
              :email="email"
              :amount="amount"
              :reference="reference"
              :onSuccess="onSuccessfulPayment"
              :onCanel="onCancelledPayment"
            ></paystack>

            <button
              @click="createOrder"
              :disabled="
                orderForm.processing ||
                !payment__option ||
                !delivery__option ||
                user.is_completed == false
              "
              class="
                btn btn-success
                w-100
                d-flex
                align-items-center
                justify-content-center
              "
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
              <span>Order Summary</span>
            </h5>
            <hr />
            <Link
              :href="route('cart')"
              class="
                btn btn-outline-primary
                rounded
                w-100
                d-flex
                gap-1
                align-items-center
                justify-content-center
              "
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
              <span>Need help?</span>
            </h5>
            <hr />
            <button
              class="
                btn btn-outline-primary
                rounded
                w-100
                d-flex
                gap-1
                align-items-center
                justify-content-center
              "
            >
              <Icon icon="clarity:chat-bubble-outline-badged" height="15" />
              Live Cart
            </button>
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
        class="
          modal-title
          text-warning
          d-flex
          align-items-center
          gap-1
          fw-bolder
        "
      >
        Update details
      </h4>
    </template>

    <template #body>
      <FormError :errors="formUpdate.errors" />
      <div class="row">
        <div class="col-lg-6 col-md-6 col-6 my-1">
          <label for="phone" class="form-label">Phone</label>
          <input
            type="tel"
            name="phone"
            id="phone"
            class="form-control"
            placeholder="Phone number"
            v-model="formUpdate.phone"
          />
        </div>
        <!-- country, state, city -->
        <div class="col-lg-6 col-md-6 col-6 my-1">
          <label for="country" class="form-label">Country</label>
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="formUpdate.country"
            @change="getCountryCode(formUpdate.country)"
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
            v-model="formUpdate.state"
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
            v-model="formUpdate.city"
          />
        </div>
        <!-- address  -->
        <div class="col-12 my-1">
          <label for="address" class="form-label">Address</label>
          <textarea
            id="address"
            rows="3"
            class="form-control"
            v-model="formUpdate.address"
          ></textarea>
        </div>
      </div>
    </template>

    <template #footer>
      <button
        @click="updateDetails"
        :disabled="formUpdate.processing"
        class="btn btn-success w-100"
      >
        <span
          v-show="formUpdate.processing"
          class="spinner-border spinner-border-sm mx-1"
        ></span>
        Update
      </button>
    </template>
  </Modal>
</template>
