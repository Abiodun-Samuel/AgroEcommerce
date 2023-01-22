<template>
  <div class="category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="category__header">
            <h2>Select your category</h2>
            <h3>Featured Categories</h3>
          </div>

          <div class="category__body">
            <div class="row">
              <div
                class="
                  category__slider-button
                  d-flex
                  justify-content-end
                  gap-2
                  my-1
                "
              >
                <button class="btn btn-sm" @click="prev">
                  <Icon height="20" width="20" icon="ooui:arrow-next-rtl" />
                </button>
                <button class="btn btn-sm" @click="next">
                  <Icon height="20" width="20" icon="ooui:arrow-next-ltr" />
                </button>
              </div>
              <div data-aos="fade-up" data-aos-delay="50" class="my-1">
                <carousel
                  :breakpoints="breakpoints"
                  ref="myCarousel"
                  snapAlign="start"
                  :wrapAround="true"
                >
                  <slide v-for="(category, index) in categories" :key="index">
                    <div
                      @click="subcategories = category.subcategory"
                      class="rounded me-2 mb-2 category__slider-body"
                    >
                      <img
                        v-if="category.banner_img"
                        :src="JSON.parse(category.banner_img)?.img_url"
                        alt="profile-img"
                        class="rounded img-fluid"
                      />
                      <img
                        v-else
                        src="../../../images/category/category_one.jpg"
                        alt="profile-img"
                        class="rounded img-fluid"
                      />
                      <div class="category__slider-text">
                        <p>{{ category.title }}</p>
                      </div>
                      <!-- <div class="dropdown-center my-1">
                        <button
                          class="dropdown-toggle btn"
                          type="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                         
                        </button>
                        <ul class="dropdown-menu border-0 shadow p-0 m-0">
                          <li
                            v-for="subcategory in category.sub_category"
                            :key="subcategory"
                          >
                            <Link
                              :href="
                                route('productsBySubcategory', [
                                  category.slug,
                                  subcategory.slug,
                                ])
                              "
                              data-aos="fade-up"
                              class="
                                dropdown-item
                                d-flex
                                justify-conten-start
                                align-items-center
                                ps-1
                              "
                            >
                              <Icon
                                icon="gg:edit-black-point"
                                width="20"
                                class="me-1"
                              />
                              <span>{{ subcategory.title }}</span>
                            </Link>
                          </li>
                        </ul>
                      </div> -->
                    </div>
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

      <div v-if="subcategories.length" class="row">
        <!-- <div class="col-lg-12"> -->
        <!-- -->
        <Link
          :href="route('product-page', subcategory.slug)"
          v-for="(subcategory, index) in subcategories"
          :key="subcategory.id + index"
          data-aos="fade-up"
          :data-aos-delay="index * 50"
          class="shadow-sm rounded col-lg-2 col-md-3 col-sm-4 col-4 mb-1"
          style="padding: 4px"
        >
          <!-- <div class="col-3"> -->
          <img
            :src="JSON.parse(subcategory.banner_img).img_url"
            :alt="subcategory.title"
            class="rounded"
          />
          <span>{{ subcategory.title }}</span>
          <!-- </div> -->
        </Link>
      </div>
      <!-- </div> -->
    </div>
  </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { computed, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Carousel, Slide } from "vue3-carousel";

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
    itemsToShow: 4.5,
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
  background: var(--green-0);
  border-radius: 50%;
  height: 40px;
  width: 40px;
  padding: 3px;
}
.category__slider-button button:hover {
  background: var(--green);
  color: #ffffff;
}
.category__slider-body {
  transition: 500ms ease;
}
.category__slider-body:hover {
  box-shadow: var(--shadow-1);
  cursor: pointer;
}
.category__slider-text p {
  color: var(--green-5);
  font-weight: 600;
  font-size: 1.1rem;
  padding: 10px 0;
  margin: 5px 0;
}
.category__slider-text {
  background: url("../../../images/bg/btn-brush-bg-2.png") no-repeat;
  background-position: center;
  background-size: contain;
}
a:hover {
  border: 1.4px solid var(--green-0);
}
</style>