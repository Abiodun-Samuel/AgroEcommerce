<script setup>
import SideView from "@/Components/Side.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { PWD_REGEX, EMAIL_REGEX, NAME_REGEX } from "@/utils/constants";
import { Icon } from "@iconify/vue";
import { reactive, ref, watch } from "vue";
import { decodeCredential } from "vue3-google-login";
import { Inertia } from "@inertiajs/inertia";

const first_name = ref(null);
const first_nameFocus = ref(false);
const validFirst_name = ref(false);
const last_name = ref(null);
const last_nameFocus = ref(false);
const validLast_name = ref(false);
const email = ref(null);
const emailFocus = ref(false);
const validEmail = ref(false);
const password = ref(null);
const validPassword = ref(false);
const passwordFocus = ref(false);
const password_confirmation = ref(null);
const validPasswordConf = ref(false);
const passwordConfFocus = ref(false);
const AuthLoader = ref(false);
const type = ref("password");
const type_two = ref("password");

const form = useForm({
  first_name: "",
  last_name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

// watchers
watch(
  [
    () => form.email,
    () => form.password,
    () => form.first_name,
    () => form.last_name,
    () => form.password_confirmation,
  ],
  (newValue) => {
    if (EMAIL_REGEX.test(newValue[0])) {
      validEmail.value = true;
    } else {
      validEmail.value = false;
    }
    if (PWD_REGEX.test(newValue[1])) {
      validPassword.value = true;
    } else {
      validPassword.value = false;
    }
    if (NAME_REGEX.test(newValue[2])) {
      validFirst_name.value = true;
    } else {
      validFirst_name.value = false;
    }
    if (NAME_REGEX.test(newValue[3])) {
      validLast_name.value = true;
    } else {
      validLast_name.value = false;
    }
    if (newValue[1] === newValue[4]) {
      validPasswordConf.value = true;
    } else {
      validPasswordConf.value = false;
    }
  },
  {
    deep: true,
  }
);

const submit = () => {
  form.post(route("register"), {
    onStart: () => {},
    onSuccess: () => {
      form.reset();
    },
    onError: () => {},
  });
};

const RevealPassword_two = () => {
  type_two.value === "password"
    ? (type_two.value = "text")
    : (type_two.value = "password");
};
const RevealPassword = () => {
  type.value === "password" ? (type.value = "text") : (type.value = "password");
};
const loginWithGoogle = (response) => {
  const userData = decodeCredential(response.credential);
  Inertia.post(route("google.login.callback"), userData);
};
</script>

<template>
  <!-- <GuestLayout> -->
  <Head title="Register" />

  <div id="auth" class="row">
    <div class="col-lg-6 login__details my-3">
      <div class="login__form shadow rounded py-1 px-2">
        <Link href="/">
          <img
            src="../../../images/logo/logo.png"
            alt="logo"
            class="m-auto d-block mb-2"
            width="98"
          />
        </Link>

        <h3 class="fw-bolder text-success">Welcome to SuperoAgrobase Ltd.</h3>
        <p class="p">Create an account to enjoy the best offer👌</p>

        <form class="mt-2" @submit.prevent="submit">
          <div class="row my-2">
            <div class="col-6">
              <label for="first_name" class="form-label"> First name</label>

              <input
                id="first_name"
                type="text"
                class="form-control"
                required
                placeholder="Enter your first name"
                v-model="form.first_name"
                :style="
                  !validFirst_name && first_nameFocus && { borderColor: 'red' }
                "
                @focus="first_nameFocus = true"
                @blur="first_nameFocus = false"
              />
              <div
                v-if="!validFirst_name && first_nameFocus"
                class="alert bg-black px-1 position-absolute zindex-3"
              >
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> Must be at
                  least 3 letters
                </p>
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> No special
                  characters
                </p>
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> No numbers
                </p>
              </div>
            </div>

            <!-- last name  -->
            <div class="col-6">
              <label for="last_name" class="form-label"> Last name</label>

              <input
                id="first_name"
                type="text"
                class="form-control"
                required
                placeholder="Enter your last name"
                v-model="form.last_name"
                :style="
                  !validLast_name && last_nameFocus && { borderColor: 'red' }
                "
                @focus="last_nameFocus = true"
                @blur="last_nameFocus = false"
              />
              <div
                v-if="!validLast_name && last_nameFocus"
                class="alert bg-black mt-0 px-1 position-absolute zindex-3"
              >
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> Must be at
                  least 3 letters
                </p>
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> No special
                  characters
                </p>
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> No numbers
                </p>
              </div>
            </div>
          </div>

          <div class="position-relative mb-2">
            <label for="email" class="form-label"> Email </label>

            <input
              type="email"
              class="form-control w-100"
              :style="!validEmail && emailFocus && { borderColor: 'red' }"
              placeholder="Enter your email"
              v-model="form.email"
              @focus="emailFocus = true"
              @blur="emailFocus = false"
              autocomplete="off"
            />
            <!-- <div v-if="form.errors.email">{{ form.errors.email }}</div> -->
            <div
              v-if="!validEmail && emailFocus"
              class="alert bg-black px-1 position-absolute w-100 zindex-3"
            >
              <p class="d-flex align-items-center text-danger small">
                <Icon icon="ci:error" :height="15" :width="15" /> Please enter a
                valid email
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label for="pasword" class="form-label d-flex align-items-center">
                Password
              </label>
              <div class="position-relative mb-2">
                <div class="position-relative">
                  <input
                    id="password"
                    :type="type"
                    class="form-control w-100"
                    :style="
                      !validPassword && passwordFocus && { borderColor: 'red' }
                    "
                    placeholder="Enter your password"
                    v-model="form.password"
                    @focus="passwordFocus = true"
                    @blur="passwordFocus = false"
                    autocomplete="off"
                  />
                  <Icon
                    class="reveal__password"
                    :icon="
                      type === 'password'
                        ? 'ant-design:eye-filled'
                        : type === 'text'
                        ? 'ant-design:eye-invisible-filled'
                        : 'ant-design:eye-filled'
                    "
                    :height="25"
                    :width="25"
                    @click="RevealPassword"
                  />
                </div>
                <div
                  v-if="!validPassword && passwordFocus"
                  class="alert bg-black mt-0 p-1 position-absolute w-100"
                >
                  <p
                    class="
                      d-flex
                      align-items-center
                      text-danger
                      small
                      my-0
                      py-0
                    "
                  >
                    <Icon icon="ci:error" :height="15" :width="15" />
                    At least 1 number
                  </p>
                  <p
                    class="
                      d-flex
                      align-items-center
                      text-danger
                      small
                      my-0
                      py-0
                    "
                  >
                    <Icon icon="ci:error" :height="15" :width="15" />
                    At least 8 characters
                  </p>
                  <p
                    class="
                      d-flex
                      align-items-center
                      text-danger
                      small
                      my-0
                      py-0
                    "
                  >
                    <Icon icon="ci:error" :height="15" :width="15" />
                    At least 1 capital letter
                  </p>
                  <p
                    class="
                      d-flex
                      align-items-center
                      text-danger
                      small
                      my-0
                      py-0
                    "
                  >
                    <Icon icon="ci:error" :height="15" :width="15" />
                    At least 1 small letter
                  </p>
                  <p
                    class="
                      d-flex
                      align-items-center
                      text-danger
                      small
                      my-0
                      py-0
                    "
                  >
                    <Icon icon="ci:error" :height="15" :width="15" />
                    At least 1 special character
                  </p>
                </div>
              </div>
            </div>
            <!-- passwordConf -->
            <div class="col-6">
              <label for="email" class="form-label d-flex align-items-center">
                Password Confirmation
              </label>

              <div class="position-relative mb-2">
                <div class="position-relative">
                  <input
                    :type="type_two"
                    class="form-control w-100"
                    :style="
                      !validPasswordConf &&
                      passwordConfFocus && { borderColor: 'red' }
                    "
                    placeholder="Confirm password"
                    v-model="form.password_confirmation"
                    @focus="passwordConfFocus = true"
                    @blur="passwordConfFocus = false"
                    autocomplete="off"
                  />
                  <Icon
                    class="reveal__password"
                    :icon="
                      type_two === 'password'
                        ? 'ant-design:eye-filled'
                        : type_two === 'text'
                        ? 'ant-design:eye-invisible-filled'
                        : 'ant-design:eye-filled'
                    "
                    :height="25"
                    :width="25"
                    @click="RevealPassword_two"
                  />
                </div>
                <div
                  v-if="!validPasswordConf && passwordConfFocus"
                  class="alert bg-black mt-0 p-1 position-absolute w-100"
                >
                  <p
                    class="
                      d-flex
                      align-items-center
                      text-danger
                      small
                      my-0
                      py-0
                    "
                  >
                    <Icon icon="ci:error" :height="15" :width="15" />
                    Password does not match
                  </p>
                </div>
              </div>
            </div>
          </div>

          <button
            :disabled="
              !validEmail ||
              !validPassword ||
              !validFirst_name ||
              !validLast_name ||
              !validPasswordConf ||
              form.processing
            "
            class="btn w-100 btn-gradient-success btn-success mt-1"
          >
            <span
              v-if="form.processing"
              class="spinner-border spinner-border-sm"
              role="status"
              aria-hidden="true"
            ></span>
            Register
          </button>
        </form>

        <hr />
        <GoogleLogin :callback="loginWithGoogle" />

        <div class="my-1 text-center">
          <Link href="/login" class="text-danger small"
            >Do you have an account already? SignIn</Link
          >
        </div>
      </div>
    </div>

    <SideView />
  </div>

  <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form> -->
  <!-- </GuestLayout> -->
</template>

<style lang="css">
@import url("../../../css/auth.css");
</style>
