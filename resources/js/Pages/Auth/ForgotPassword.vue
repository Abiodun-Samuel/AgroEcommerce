<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import SideView from "@/Components/Side.vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"), {
    onSuccess: (value) => {
      form.reset();
      toast.success(props.status);
    },
    onError: (val) => {
      toast.error(val.email);
    },
  });
};
</script>

<template>
  <Head title="Forgot Password" />

  <div id="auth" class="row">
    <div class="col-lg-6 my-3">
      <div
        class="container h-100 d-flex justify-content-center align-items-center"
      >
        <div class="shadow-lg p-2 rounded">
          <Link href="/">
            <img
              src="../../../images/logo/logo.png"
              alt="logo"
              class="m-auto d-block mb-2"
              width="98"
            />
          </Link>

          <div class="my-1">
            <p>
              Forgot your password? Enter your email address and we will email
              you a password reset link that will allow you to choose a new one.
            </p>
          </div>

          <div v-if="status" class="alert alert-success p-1" role="alert">
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
                autocomplete="username"
              />

              <InputError class="mt-1" :message="form.errors.email" />
            </div>

            <div class="mt-2">
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
                Email Password Reset Link
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <SideView />
  </div>
</template>

<style lang="css">
@import url("../../../css/auth.css");
</style>