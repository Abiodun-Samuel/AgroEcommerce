<script setup>
import SideView from "@/Components/Side.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Icon } from "@iconify/vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { decodeCredential } from "vue3-google-login";
import { Inertia } from "@inertiajs/inertia";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const type = ref("password");
const type_two = ref("password");
const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: (value) => {
      form.reset("password");
    },
    onSuccess: () => {
      toast.success("Login was successful");
      form.reset();
    },
    onError: (value) => {
      if (value.email) return toast.error(value.email);
      if (value.password) return toast.error(value.password);
    },
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
  <Head title="Sign In" />

  <div id="auth" class="row">
    <div class="col-lg-6 login__details mb-2">
      <div class="login__form">
        <Link href="/">
          <img
            src="../../../images/logo/logo.png"
            alt="logo"
            class="m-auto d-block mb-2"
            width="98"
          />
        </Link>

        <div class="my-2">
          <h3 class="fw-bolder text-success">Welcome to SuperoAgrobase Ltd.</h3>
          <p class="p">Login to your account. 👌</p>
        </div>
        <hr />

        <div v-if="status" class="alert alert-success my-1 p-1">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div class="my-2">
            <InputLabel for="email" value="Email" />
            <TextInput
              id="email"
              type="email"
              class="form-control"
              v-model="form.email"
              required
              autofocus
            />
            <!-- <InputError class="mt-1" :message="form.errors.email" /> -->
          </div>

          <div class="my-2">
            <InputLabel for="password" value="Password" />

            <TextInput
              id="password"
              type="password"
              class="form-control"
              v-model="form.password"
              required
              autocomplete="current-password"
            />

            <InputError class="mt-1" :message="form.errors.password" />
          </div>

          <div
            class="block my-1 d-flex align-items-center justify-content-between"
          >
            <label class="d-flex align-items-center">
              <Checkbox name="remember" v-model:checked="form.remember" />
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="
                underline
                text-danger
                small
                text-gray-600
                hover:text-gray-900
                focus:outline-none
              "
            >
              Forgot your password?
            </Link>
          </div>

          <div class="my-2">
            <button
              class="btn btn-gradient-success w-100"
              :disabled="form.processing"
            >
              <span
                v-if="form.processing"
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              Log in
            </button>
          </div>
        </form>

        <!-- <form class="my-2" @submit.prevent="LoginHandler">
            <div
              class="position-relative d-flex align-items-center small"
              :class="validEmail && emailFocus && 'text-success'"
            >
              <label for="email" class="small"> Email </label>
              <Icon
                v-if="validEmail && emailFocus"
                icon="codicon:pass-filled"
                :height="15"
                :width="15"
              />
            </div>
            <div class="position-relative mb-3">
              <input
                type="email"
                class="form-control w-100"
                :style="!validEmail && emailFocus && { borderColor: 'red' }"
                placeholder="Enter your email"
                v-model="email"
                @focus="emailFocus = true"
                @blur="emailFocus = false"
                autocomplete="off"
              />
              <div
                v-if="!validEmail && emailFocus"
                class="alert bg-black mt-0 px-1 position-absolute w-100"
              >
                <p class="d-flex align-items-center text-danger small">
                  <Icon icon="ci:error" :height="15" :width="15" /> Please enter
                  a valid email
                </p>
              </div>
            </div>

            <div
              class="
                position-relative
                d-flex
                align-items-center
                small
                justify-content-between
              "
              :class="validPassword && passwordFocus && 'text-success'"
            >
              <label for="email" class="small d-flex align-items-center">
                Password
                <Icon
                  v-if="validPassword && passwordFocus"
                  icon="codicon:pass-filled"
                  :height="15"
                  :width="15"
              /></label>

              <Link href="/forgot-password" class="text-danger small"
                >Reset Password</Link
              >
            </div>

            <div class="position-relative mb-2">
              <div class="position-relative">
                <input
                  :type="type"
                  class="form-control w-100"
                  :style="
                    !validPassword && passwordFocus && { borderColor: 'red' }
                  "
                  placeholder="Enter your password"
                  v-model="password"
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
                  class="d-flex align-items-center text-danger small my-0 py-0"
                >
                  <Icon icon="ci:error" :height="15" :width="15" />
                  At least 1 number
                </p>
                <p
                  class="d-flex align-items-center text-danger small my-0 py-0"
                >
                  <Icon icon="ci:error" :height="15" :width="15" />
                  At least 8 characters
                </p>
                <p
                  class="d-flex align-items-center text-danger small my-0 py-0"
                >
                  <Icon icon="ci:error" :height="15" :width="15" />
                  At least 1 capital letter
                </p>
                <p
                  class="d-flex align-items-center text-danger small my-0 py-0"
                >
                  <Icon icon="ci:error" :height="15" :width="15" />
                  At least 1 small letter
                </p>
                <p
                  class="d-flex align-items-center text-danger small my-0 py-0"
                >
                  <Icon icon="ci:error" :height="15" :width="15" />
                  At least 1 special character
                </p>
              </div>
            </div>

            <button
              :disabled="!validEmail || !validPassword"
              class="btn w-100 btn-gradient-success btn-success mt-1"
            >
              <span
                v-if="AuthLoader"
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              Login
            </button>
          </form> -->

        <hr />

        <GoogleLogin :callback="loginWithGoogle" />

        <div class="my-1 text-center">
          <Link href="/register" class="text-danger small"
            >Don't have account? SignUp</Link
          >
        </div>
      </div>
    </div>

    <SideView />
  </div>
</template>

<style lang="css">
@import url("../../../css/auth.css");
</style>