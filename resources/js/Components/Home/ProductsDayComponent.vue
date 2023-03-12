<template>
  <div class="category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="category__header">
            <!-- <h2>Products of the Week</h2> -->
            <h3>Products of the Week</h3>
          </div>

          <div class="category__body">
            <div class="row">
              <div
                class="category__slider-button d-flex justify-content-end gap-2 my-1"
              >
                <button class="btn btn-sm" @click="prev">
                  <Icon height="20" width="20" icon="ooui:arrow-next-rtl" />
                </button>
                <button class="btn btn-sm" @click="next">
                  <Icon height="20" width="20" icon="ooui:arrow-next-ltr" />
                </button>
              </div>
              <div class="my-1">
                <carousel
                  :breakpoints="breakpoints"
                  ref="myCarousel"
                  snapAlign="start"
                  :wrapAround="true"
                >
                  <!-- @click="subcategories = category.subcategory" -->
                  <slide v-for="(product, index) in products.data" :key="index">
                    <ProductComponent :product="product" />

                    <!-- <div class="rounded me-2 mb-2 category__slider-body">
                      <img
                        :src="JSON.parse(category.banner_img)?.img_url"
                        alt="profile-img"
                        class="rounded img-fluid"
                      />
                      <div class="category__slider-text">
                        <p>{{ category.title }}</p>
                      </div>
                    </div> -->
                  </slide>

                  <template #addons>
                    <pagination />
                  </template>
                </carousel>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div v-if="subcategories.length" class="row">
        <Link
          :href="route('product-page', subcategory.slug)"
          v-for="(subcategory, index) in subcategories"
          :key="subcategory.id + index"
          data-aos="fade-up"
          :data-aos-delay="index * 50"
          class="shadow-sm rounded col-lg-2 col-md-3 col-sm-4 col-4 mb-1"
          style="padding: 4px"
        >
          <img
            :src="JSON.parse(subcategory.banner_img).img_url"
            :alt="subcategory.title"
            class="rounded"
          />
          <span>{{ subcategory.title }}</span>
        </Link>
      </div> -->
    </div>
  </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { computed, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import ProductComponent from "@/Components/Common/ProductComponent.vue";
import { Carousel, Slide } from "vue3-carousel";

const props = defineProps(["products"]);
const categories = computed(() => usePage().props.data.categories);
const subcategories = ref([]);

const myCarousel = ref(null);
const breakpoints = {
  0: {
    itemsToShow: 1.5,
    snapAlign: "center",
  },
  700: {
    itemsToShow: 2.5,
    snapAlign: "center",
  },
  1024: {
    itemsToShow: 4,
    snapAlign: "start",
  },
};

const next = () => {
  myCarousel.value.next();
};
const prev = () => {
  myCarousel.value.prev();
};
</script>

<style lang="css" scoped>
.category {
  position: relative;
  padding: 4rem 0;
  background: url("@/assets/images/bg/product-bg.jpg") no-repeat;
  background-position: center;
  background-size: cover;
}
.category__header h2 {
  font-size: 1.3rem;
  font-weight: bolder;
  color: var(--green);
}
.category__header h3 {
  font-size: 2rem;
  font-weight: bolder;
}
.category__slider-button button {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  height: 40px;
  width: 40px;
  padding: 3px;
  background: var(--green);
  color: #ffffff;
}
.category__slider-button button:hover {
  background: var(--green-5);
}

.carousel__slide {
  padding: 10px;
}
</style>