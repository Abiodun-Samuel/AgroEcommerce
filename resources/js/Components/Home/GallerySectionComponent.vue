<template>
    <div id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gallery__header">
                        <h2>Check out our gallery</h2>
                        <h3>Featured Images</h3>
                    </div>
                </div>

                <main>
                    <div class="masonry-wrapper my-2">
                        <div class="masonry">
                            <div
                                class="block"
                                v-for="gallery in galleries"
                                :key="gallery.id"
                            >
                                <div class="image-mask">
                                    <img
                                        :src="
                                            JSON.parse(gallery.gallery_img)
                                                ?.img_url
                                        "
                                        :alt="gallery.title"
                                    />
                                    <p class="text-success lead">
                                        {{ gallery.title }}
                                    </p>
                                </div>
                                <div class="overlay">
                                    <div class="inner-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(["galleries"]);
</script>

<style scoped>
#blog {
    position: relative;
    padding: 2rem 0;
}
.gallery__header h2 {
    font-size: 1.3rem;
    font-weight: bolder;
    color: var(--green);
}
.gallery__header h3 {
    font-size: 2rem;
    font-weight: bolder;
}

@media only screen and (min-width: 1650px) {
    .masonry {
        column-count: 4 !important;
    }
}
@media only screen and (min-width: 2050px) {
    .masonry-wrapper {
        margin: 0 auto;
        max-width: 2000px;
    }
}
@media only screen and (min-width: 500px) and (max-width: 850px) {
    .masonry {
        column-count: 2 !important;
    }
}
@media only screen and (max-width: 500px) {
    .masonry {
        column-count: 1 !important;
    }
}

@media only screen and (max-width: 470px) {
    .masonry-wrapper {
        margin: 30px 0px;
    }
}
.masonry {
    column-count: 3;
    column-gap: 0;
    width: 100%;
    margin: 0 auto;
}
.block {
    break-inside: avoid;
    padding: 0;
    margin: 0;
}
.image-mask img {
    width: 100%;
    transition: 0.4s all ease;
}

.block {
    position: relative;
    overflow: hidden;
}
.overlay {
    top: 0;
    left: 0;
    z-index: 3;
    height: 0;
    background: #1f1f1faa;
    width: 100%;
    transition: 0.5s height ease-in;
    position: absolute;
}
.inner-overlay {
    width: 100%;
}
.block:hover > .overlay {
    height: 2000px;
}
</style>
