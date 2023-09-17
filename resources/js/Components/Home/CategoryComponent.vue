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
                                class="category__slider-button d-flex justify-content-end gap-2 my-1"
                            >
                                <button class="btn btn-sm" @click="prev">
                                    <Icon
                                        height="20"
                                        width="20"
                                        icon="ooui:arrow-next-rtl"
                                    />
                                </button>
                                <button class="btn btn-sm" @click="next">
                                    <Icon
                                        height="20"
                                        width="20"
                                        icon="ooui:arrow-next-ltr"
                                    />
                                </button>
                            </div>
                            <div class="my-1">
                                <carousel
                                    :breakpoints="breakpoints"
                                    ref="myCarousel"
                                    snapAlign="start"
                                    :wrapAround="true"
                                    :autoplay="2000"
                                >
                                    <!-- @click="subcategories = category.subcategory" -->
                                    <slide
                                        v-for="(category, index) in categories"
                                        :key="index"
                                    >
                                        <div
                                            @click="
                                                setSubcategories(
                                                    category.subcategory,
                                                    category.title
                                                )
                                            "
                                            class="rounded me-2 mb-2 category__slider-body"
                                        >
                                            <img
                                                v-if="category.banner_img"
                                                :src="
                                                    JSON.parse(
                                                        category.banner_img
                                                    )?.img_url
                                                "
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
        </div>
    </div>

    <Modal
        :show="openDisplayModal"
        :size="'modal-md'"
        :footer="true"
        @close="openDisplayModal = false"
    >
        <template #header>
            <h4
                class="modal-title d-flex align-items-center gap-1 fs-2 fw-bolder text-dark"
            >
                <Icon height="20" width="20" icon="bx:category" />
                {{ selectedCategory }} Category
            </h4>
        </template>

        <template #body>
            <div class="d-flex gap-1 flex-wrap align-items-center">
                <a
                    v-for="(item, index) in subcategories"
                    :key="index"
                    target="_blank"
                    class="btn btn-sm btn-outline-primary shadow-md d-flex align-items-center"
                    :href="route('product-page', item.slug)"
                >
                    <Icon
                        style="margin-right: 3px"
                        height="15"
                        width="15"
                        icon="bx:category"
                    />
                    <span> {{ item.title }}</span>
                </a>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { computed, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Carousel, Slide } from "vue3-carousel";
import Modal from "@/Components/Common/Modal.vue";

const categories = computed(() => usePage().props.data.categories);
const subcategories = ref([]);
const selectedCategory = ref("");
const openDisplayModal = ref(false);

const setSubcategories = (cat, data) => {
    openDisplayModal.value = true;
    selectedCategory.value = data;
    subcategories.value = cat;
    console.log(subcategories.value);
};

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
    padding: 2rem 0;
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
