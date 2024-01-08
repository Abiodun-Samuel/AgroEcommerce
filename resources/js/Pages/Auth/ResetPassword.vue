<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import SideView from "@/Components/Common/SideView.vue";
import { useToast } from "vue-toastification";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

const type = ref("password");
const type_two = ref("password");

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
</script>

<template>
    <Head title="Reset Password" />

    <div id="auth" class="row">
        <div class="col-lg-6 d-flex justify-content-center align-items-center">
            <div class="container">
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
                                    disabled
                                    autofocus
                                    autocomplete="email"
                                />

                                <InputError
                                    class="mt-1"
                                    :message="form.errors.email"
                                />
                            </div>

                            <div class="my-2">
                                <InputLabel for="password" value="Password" />
                                <div class="position-relative">
                                    <input
                                        id="password"
                                        :type="type"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                        class="form-control w-100"
                                        placeholder="Password"
                                        v-model="form.password"
                                        autocomplete="new-password"
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

                                <InputError
                                    class="mt-1"
                                    :message="form.errors.password"
                                />
                            </div>

                            <div class="my-2">
                                <InputLabel
                                    for="password_confirmation"
                                    value="Confirm Password"
                                />
                                <div class="position-relative">
                                    <input
                                        :type="type_two"
                                        class="form-control w-100"
                                        placeholder="Confirm password"
                                        v-model="form.password_confirmation"
                                        required
                                        autocomplete="new-password"
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

                                <InputError
                                    class="mt-1"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>

                            <div class="mt-2">
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
                                    Reset Password
                                </button>
                            </div>
                        </form>
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
