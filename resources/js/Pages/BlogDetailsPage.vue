<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";
import { Icon } from "@iconify/vue";
import moment from "moment";

const props = defineProps(["blog"]);
const step_one = {
  slug: "Blogs",
  link: true,
  route_name: "blog-page",
};
const step_two = {
  slug: props.blog.title,
  link: false,
  route_name: "",
};
const formatDate = (data) => {
  return moment(data).format("MMMM Do YYYY, h:mm:ss a");
};
</script>

<template>
  <Head :title="blog.title" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" :step_two="step_two" />
    <div id="blogdetails">
      <div class="container">
        <div class="row mt-2">
          <div class="col-lg-5 my-1">
            <div class="blog__img">
              <img
                :src="JSON.parse(blog.image)?.img_url"
                :alt="blog.title"
                class="img-fluid"
              />
            </div>
          </div>
          <div class="col-lg-7 my-1">
            <div class="blog__details">
              <h1 class="fw-bolder text-success">{{ blog.title }}</h1>
              <div class="d-flex justify-content-between">
                <div
                  class="d-flex align-items-center text-secondary gap-2 my-2"
                  style="color: var(--grey-2) !important"
                >
                  <span class="d-flex align-items-center">
                    <img
                      v-if="blog.user.avatar"
                      :src="blog.user.avatar"
                      :alt="blog.user.first_name"
                      height="30"
                      width="30"
                      class="rounded-circle"
                    />
                    <Icon v-else height="30" icon="mdi:user-circle-outline" />
                    <p class="my-0 py-0">Author: {{ blog.user.first_name }}</p>
                  </span>
                  <span class="d-flex align-items-center">
                    <Icon
                      icon="material-symbols:nest-clock-farsight-analog-outline-rounded"
                      height="18"
                      style="margin-right: 2px"
                    />
                    <p class="my-0 py-0">{{ formatDate(blog.created_at) }}</p>
                  </span>
                  <span class="d-flex align-items-center">
                    <Icon
                      icon="ic:sharp-remove-red-eye"
                      height="18"
                      style="margin-right: 2px"
                    />
                    <p class="my-0 py-0">{{ blog.views }}</p>
                  </span>
                </div>

                <!-- <Link
                  :href="route('blog-details', blog.slug)"
                  class="d-flex align-items-center btn btn-outline-success btn-sm"
                >
                  <span>Read</span>
                  <span>
                    <Icon icon="ri:share-forward-line" height="15" />
                  </span>
                </Link> -->
              </div>
              <p class="lead my-1">{{ blog.description }}</p>

              <Link
                :href="route('blog-page')"
                class="btn btn-outline-success mt-4"
                >Back to blog page</Link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>
