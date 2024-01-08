<script setup>
import SideView from "@/Components/Common/SideView.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { decodeCredential } from "vue3-google-login";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const type = ref("password");
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

const revealPassword = () => {
    type.value === "password"
        ? (type.value = "text")
        : (type.value = "password");
};

const loginWithGoogle = (response) => {
    const userData = decodeCredential(response.credential);
    router.post(route("google.login.callback"), userData);
};
</script>

<template>
    <Head title="Sign In" />

    <div id="auth" class="row">
        <div
            class="col-lg-6 d-flex justify-content-center align-items-center"
        >
            <div class="bg-white">
                <div class="container">
                    <Link href="/">
                        <img
                            src="../../../images/logo/logo.png"
                            alt="logo"
                            class="m-auto d-block mb-2"
                            width="98"
                        />
                    </Link>

                    <div class="my-2">
                        <h3 class="fw-bolder text-success">
                            Welcome to SuperoAgrobase Ltd.
                        </h3>
                        <p class="p">Login to your account. 👌</p>
                    </div>
                    <hr />

                    <div v-if="status" class="alert alert-success my-1 p-1">
                        {{ status }}
                    </div>

                    <InputError class="mt-1" :message="form.errors.email" />
                    <InputError class="mt-1" :message="form.errors.password" />

                    <form @submit.prevent="submit">
                        <div class="my-2">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="form-control"
                                v-model="form.email"
                                placeholder="Email address"
                                required
                                autofocus
                                pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                            />
                        </div>

                        <div class="my-2 position-relative">
                            <InputLabel for="password" value="Password" />
                            <div
                                class="position-relative d-flex align-items-center"
                            >
                                <input
                                    id="password"
                                    :type="type"
                                    class="form-control"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                />
                                <button
                                    type="button"
                                    class="position-absolute end-0 mx-1"
                                >
                                    <Icon
                                        class="text-success"
                                        :icon="
                                            type === 'password'
                                                ? 'ant-design:eye-filled'
                                                : type === 'text'
                                                ? 'ant-design:eye-invisible-filled'
                                                : 'ant-design:eye-filled'
                                        "
                                        :height="25"
                                        :width="25"
                                        @click="revealPassword"
                                    />
                                </button>
                            </div>
                        </div>

                        <div
                            class="block my-1 d-flex align-items-center justify-content-between"
                        >
                            <label class="d-flex align-items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ml-2 text-sm text-gray-600"
                                    >Remember me</span
                                >
                            </label>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="underline text-danger small text-gray-600 hover:text-gray-900 focus:outline-none"
                            >
                                Forgot your password?
                            </Link>
                        </div>

                        <div class="my-2">
                            <button
                                type="submit"
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

                    <hr />

                    <!-- <GoogleLogin :callback="loginWithGoogle" /> -->

                    <div class="my-1 text-center">
                        <Link
                            href="/register"
                            class="btn btn-sm btn-outline-danger small"
                            >Don't have account? SignUp</Link
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <SideView />
        </div>
    </div>
</template>

<style lang="css">
@import url("../../../css/auth.css");
</style>
