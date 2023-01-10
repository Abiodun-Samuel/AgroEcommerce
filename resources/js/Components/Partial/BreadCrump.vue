<template>
  <div class="breadcrump">
    <div class="container">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <Link
              :href="route('home')"
              class="d-flex align-items-center text-white"
            >
              Home
            </Link>
          </li>
          <li
            v-if="step_one"
            class="breadcrumb-item text-success"
            aria-current="page"
          >
            <Link
              v-if="step_one.link"
              :href="route(step_one.route_name)"
              class="d-flex align-items-center text-white"
            >
              {{ firstLetterUpperCase(step_one.slug) }}
            </Link>
            <span v-else>{{ firstLetterUpperCase(step_one.slug) }}</span>
          </li>
          <li
            v-if="step_two"
            class="breadcrumb-item text-success"
            aria-current="page"
          >
            <Link
              v-if="step_two.link"
              :href="route(step_two.route_name)"
              class="d-flex align-items-center text-white"
            >
              {{ firstLetterUpperCase(step_two.slug) }}
            </Link>
            <span v-else>{{ firstLetterUpperCase(step_two.slug) }}</span>
          </li>
          <li
            v-if="step_three"
            class="breadcrumb-item text-success"
            aria-current="page"
          >
            <Link
              v-if="step_three.link"
              :href="route(step_three.route_name)"
              class="d-flex align-items-center text-white"
            >
              {{ firstLetterUpperCase(step_three.slug) }}
            </Link>
            <span v-else>{{ firstLetterUpperCase(step_three) }}</span>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { firstLetterUpperCase } from "@/utils/helper";

defineProps(["step_one", "step_two", "step_three"]);
</script>

<style lang="css" scoped>
.breadcrump {
  padding: 10rem 0 1.5rem 0;
  background: url("@/assets/images/bg/breadcrump-bg.jpg") no-repeat,
    rgba(0, 0, 0, 0.6);
  background-blend-mode: overlay;
  background-position: center;
  background-size: center;
}
a:hover {
  color: #dddddd !important;
}
</style>