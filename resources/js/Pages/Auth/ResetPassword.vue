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
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => form.reset(),
    onSuccess: (value) => {
      form.reset();
      toast.success(value);
    },
    onError: (val) => {
      toast.error(val.email);
    },
  });
};
</script>

<template>
  <Head title="Reset Password" />

  <div id="auth" class="row">
    <div class="col-lg-6 my-3">
      <div
        class="container h-100 d-flex justify-content-center align-items-center"
      >
        <div class="shadow-lg p-2 rounded w-100 px-lg-3">
          <Link href="/">
            <img
              src="../../../images/logo/logo.png"
              alt="logo"
              class="m-auto d-block mb-2"
              width="98"
            />
          </Link>
          <div>
            <form @submit.prevent="submit">
              <div>
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

              <div class="my-2">
                <InputLabel for="password" value="Password" />

                <TextInput
                  id="password"
                  type="password"
                  class="form-control"
                  v-model="form.password"
                  required
                  autocomplete="new-password"
                />

                <InputError class="mt-1" :message="form.errors.password" />
              </div>

              <div class="my-2">
                <InputLabel
                  for="password_confirmation"
                  value="Confirm Password"
                />

                <TextInput
                  id="password_confirmation"
                  type="password"
                  class="form-control"
                  v-model="form.password_confirmation"
                  required
                  autocomplete="new-password"
                />

                <InputError
                  class="mt-1"
                  :message="form.errors.password_confirmation"
                />
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
                  Reset Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <SideView />
  </div>
</template>

<style lang="css">
@import url("../../../css/auth.css");
</style>