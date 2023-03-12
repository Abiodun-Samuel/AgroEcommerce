<template>
  <div class="card shadow-sm rounded">
    <Link :href="route('blog-details', blog.slug)">
      <img
        :src="JSON.parse(blog.image)?.img_url"
        class="card-img-top"
        :alt="blog.title"
      />
      <div class="card-body p-1">
        <Link :href="route('blog-details', blog.slug)">
          <h6 class="card-title">{{ blog.title }}</h6>
        </Link>

        <div class="d-flex justify-content-between">
          <div
            class="d-flex align-items-center text-secondary gap-1"
            style="color: var(--grey-2) !important"
          >
            <small class="d-flex align-items-center">
              <Icon
                icon="material-symbols:nest-clock-farsight-analog-outline-rounded"
                height="18"
                style="margin-right: 2px"
              />
              {{ formatDate(blog.created_at) }}
            </small>
            <small class="d-flex align-items-center">
              <Icon
                icon="ic:sharp-remove-red-eye"
                height="18"
                style="margin-right: 2px"
              />
              {{ blog.views }}
            </small>
          </div>

          <Link
            :href="route('blog-details', blog.slug)"
            class="d-flex align-items-center btn btn-outline-success btn-sm"
          >
            <span>Read</span>
            <span>
              <Icon icon="ri:share-forward-line" height="15" />
            </span>
          </Link>
        </div>
      </div>
    </Link>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import moment from "moment";

defineProps(["blog"]);

const formatDate = (data) => {
  return moment(data).fromNow();
};
</script>

<style  scoped>
</style>