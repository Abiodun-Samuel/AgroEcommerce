<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { ref } from "vue";
import { decodeCredential } from "vue3-google-login";
import { router } from "@inertiajs/vue3";
import SideView from "@/Components/Common/SideView.vue";
import InputError from "@/Components/InputError.vue";

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
    <!-- <GuestLayout> -->
    <Head title="Register" />
    <div id="auth">
        <div class="row">
            <div
                class="col-lg-6 d-flex justify-content-center align-items-center px-lg-5"
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

                        <h3 class="fw-bolder text-success">
                            Welcome to SuperoAgrobase Ltd.
                        </h3>
                        <p class="p">
                            Create an account to enjoy the best offer👌
                        </p>

                        <InputError class="mt-1" :message="form.errors.email" />
                        <InputError
                            class="mt-1"
                            :message="form.errors.password"
                        />
                        <InputError
                            class="mt-1"
                            :message="form.errors.first_name"
                        />
                        <InputError
                            class="mt-1"
                            :message="form.errors.last_name"
                        />

                        <form class="mt-2" @submit.prevent="submit">
                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="first_name" class="form-label">
                                        First name</label
                                    >
                                    <input
                                        id="first_name"
                                        type="text"
                                        class="form-control"
                                        required
                                        placeholder="First name"
                                        v-model="form.first_name"
                                        pattern="[a-zA-Z]{2,50}"
                                        title="Must contain at least two characters"
                                    />
                                </div>

                                <!-- last name  -->
                                <div class="col-6">
                                    <label for="last_name" class="form-label">
                                        Last name</label
                                    >

                                    <input
                                        id="last_name"
                                        type="text"
                                        class="form-control"
                                        required
                                        placeholder="Last name"
                                        v-model="form.last_name"
                                        pattern="[a-zA-Z]{2,50}"
                                        title="Must contain at least two characters"
                                    />
                                </div>
                            </div>

                            <div class="position-relative mb-2">
                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control w-100"
                                    placeholder="Email"
                                    v-model="form.email"
                                    autocomplete="off"
                                    required
                                    pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                                />
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label
                                        for="pasword"
                                        class="form-label d-flex align-items-center"
                                    >
                                        Password
                                    </label>
                                    <div class="position-relative mb-2">
                                        <div class="position-relative">
                                            <input
                                                id="password"
                                                :type="type"
                                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                                class="form-control w-100"
                                                placeholder="Password"
                                                v-model="form.password"
                                                autocomplete="off"
                                                required
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
                                    </div>
                                </div>
                                <!-- passwordConf -->
                                <div class="col-lg-6 col-md-6">
                                    <label
                                        for="email"
                                        class="form-label d-flex align-items-center"
                                    >
                                        Password Confirmation
                                    </label>

                                    <div class="position-relative mb-2">
                                        <div class="position-relative">
                                            <input
                                                :type="type_two"
                                                class="form-control w-100"
                                                placeholder="Confirm password"
                                                v-model="
                                                    form.password_confirmation
                                                "
                                                required
                                                autocomplete="off"
                                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
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
                                    </div>
                                </div>
                            </div>

                            <button
                                :disabled="form.processing"
                                type="submit"
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
                        <!-- <GoogleLogin :callback="loginWithGoogle" /> -->

                        <div class="my-1 text-center">
                            <Link
                                href="/login"
                                class="btn btn-sm btn-outline-danger small"
                                >Do you have an account already? SignIn</Link
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <SideView />
            </div>
        </div>
    </div>
</template>

<style lang="css">
@import url("../../../css/auth.css");
</style>
