<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import FormError from "@/Components/Common/FormError.vue";
import NoResult from "@/Components/Common/NoResult.vue";
import category_img from "@/assets/images/icons/subcategory.png";
import Modal from "@/Components/Common/Modal.vue";
import Camera from "simple-vue-camera";
import { computed, ref } from "vue";
import { toast } from "@/utils/helper";
import moment from "moment";
import { Icon } from "@iconify/vue";
import avatar from "@/assets/images/img/avatar.png";
import { Country, State } from "country-state-city";

const user = computed(() => usePage().props.auth.user);
let fileSrc = ref(null);
const form = useForm({
  avatar: fileSrc.value,
});
const formUpdate = useForm({
  gender: user.value.gender,
  phone: user.value.phone,
  address: user.value.address,
  city: user.value.city,
  state: user.value.state,
  country: user.value.country,
  email: user.value.email,
  dob: user.value.dob,
});
const step_one = {
  slug: "Profile",
  link: false,
  route_name: null,
};
</script>

<template>
  <Head title="User" />

  <UserLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <FormError :errors="form.errors" />

      <div class="row my-1">
        <div class="col-lg-12">
          <div class="profile d-flex gap-2 align-items-center">
            <div class="profile__img position-relative">
              <img
                v-if="user.avatar"
                :src="user.avatar"
                alt="user image"
                width="150"
                height="150"
                class="rounded-circle"
              />
              <img
                v-else
                :src="avatar"
                alt="user image"
                width="150"
                height="150"
                class="rounded-circle"
              />
              <button class="text-danger" @click="showImageUploadModal = true">
                <Icon
                  color="text-danger"
                  icon="material-symbols:edit"
                  height="20"
                />
              </button>
            </div>
            <div class="profile__details">
              <p>
                <b>Name: </b>
                <span class="text-secondary"
                  >{{ user.first_name }} {{ user.last_name }}</span
                >
              </p>
              <p>
                <b>Email: </b
                ><span class="text-secondary"> {{ user.email }}</span>
              </p>
              <p>
                <b>Role:</b> <span class="text-secondary">{{ user.role }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <hr />

      <div class="bg-white shadow-sm p-1 mb-1 rounded">
        <FormError :errors="formUpdate.errors" />

        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              id="email"
              class="form-control"
              placeholder="Email address"
              v-model="formUpdate.email"
            />
          </div>
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="Gender" class="form-label">Gender</label>
            <select
              class="form-select"
              aria-label="Default select example"
              v-model="formUpdate.gender"
            >
              <option selected disabled>Select gender</option>
              <option :value="'Male'">Male</option>
              <option :value="'Female'">Female</option>
              <option :value="'Others'">Others</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 col-6 my-1">
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
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="address" class="form-label">Address</label>
            <input
              type="text"
              class="form-control"
              id="address"
              placeholder="Address"
              v-model="formUpdate.address"
            />
          </div>
        </div>
      </div>
      <div class="bg-white shadow-sm p-1 mb-1 rounded">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 my-1">
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
          <div class="col-lg-3 col-md-6 col-6 my-1">
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
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="city" class="form-label">City</label>
            <input
              type="text"
              class="form-control"
              id="city"
              placeholder="City"
              v-model="formUpdate.city"
            />
          </div>
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="date" class="form-label">Date of birth</label>
            <input
              type="date"
              class="form-control"
              id="date"
              placeholder="date"
              v-model="formUpdate.dob"
            />
            <span class="small text-danger fw-light fst-italic"
              >Must be greater than 18years old
            </span>
          </div>
        </div>
      </div>

      <div class="bg-white shadow-sm p-1 rounded">
        <div class="row">
          <div class="col-lg-12 text-end">
            <button
              @click="updateProfile"
              :disabled="formUpdate.processing"
              class="btn btn-success w-100"
            >
              <span>Edit</span>
              <span
                v-if="formUpdate.processing"
                class="spinner-border spinner-border-sm mx-1"
                role="status"
                aria-hidden="true"
              ></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
</template>

<style scoped>
.camera {
  width: 150px;
  height: 150px;
  margin: auto;
}
.profile__img {
  width: 150px;
  height: 150px;
}
.profile__img img {
  /* object-fit: cover; */
  width: 150px;
  height: 150px;
}
.profile__img button {
  position: absolute;
  top: -1px;
  left: 115px;
}
.profile__img button:hover {
  background: var(--light-1);
  padding: 1px;
  border-radius: 5px;
}
.profile__details p {
  padding: 5px 0;
  margin: 0;
}

.img_container {
  width: 100px;
  position: relative;
}
.img_container button {
  position: absolute;
  top: -5px;
  right: -11px;
  background: #f6f5f5;
  padding: 2px;
  border-radius: 3px;
  color: red;
}
.file-input {
  width: 150px;
  height: 150px;
  margin: 0 auto;
  /*  */
}
.file-input__input {
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}

.file-input__label {
  cursor: pointer;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-size: 1rem;
  color: var(--bs-gray-100);
}
.file-input__label p {
  margin: 5px;
  padding: 0;
}
</style>