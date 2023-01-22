<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import FormError from "@/Components/Common/FormError.vue";
import NoResult from "@/Components/Common/NoResult.vue";
import category_img from "@/assets/images/icons/subcategory.png";
import Modal from "@/Components/Common/Modal.vue";
import { computed, ref } from "vue";
import { toast } from "@/utils/helper";
import moment from "moment";
import { Icon } from "@iconify/vue";
import avatar from "@/assets/images/img/avatar.png";
import { Country, State } from "country-state-city";

const user = computed(() => usePage().props.auth.user);
const form = useForm({
  //   avatar: fileSrc.value,
});
const step_one = {
  slug: "Orders",
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
      <hr />
    </div>
  </UserLayout>
</template>

<style scoped>
</style>
