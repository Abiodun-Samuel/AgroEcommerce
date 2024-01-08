<script setup>
import { computed } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import SideView from "@/Components/Common/SideView.vue";

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>

<template>
    <Head title="Email Verification" />

    <div id="auth" class="row">
        <div class="col-lg-6 d-flex justify-content-center align-items-center">
            <div class="login__form shadow-lg p-lg-3 p-2 rounded">
                <div class="container">
                    <Link href="/">
                        <img
                            src="../../../images/logo/logo.png"
                            alt="logo"
                            class="m-auto d-block mb-3"
                            width="98"
                        />
                    </Link>
                    <p class="p">
                        Before continuing, please verify your email address by
                        clicking on the link sent to the email address you
                        provided during registration.
                    </p>

                    <p class="p">
                        If you didn't receive the email, click the button bellow
                        to resend.
                    </p>

                    <div v-if="verificationLinkSent">
                        <p
                            class="bg-white text-danger small shadow p-1 rounded"
                        >
                            A new verification link has been sent to the email
                            address you provided during registration.
                        </p>
                    </div>

                    <form @submit.prevent="submit">
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
                                Resend Verification Email
                            </button>
                        </div>
                    </form>
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