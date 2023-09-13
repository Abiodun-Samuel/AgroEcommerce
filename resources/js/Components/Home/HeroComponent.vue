<template>
    <div class="py-lg-5 py-3"></div>
    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero__text">
                        <div>
                            <h1 class="fw-bolder">
                                Best Agricultural <br />
                                Product & Services
                            </h1>
                            <p class="my-2 lead">
                                We Provide Innovative Agricultural Solutions and
                                Quality Services to Improve Crop Yields
                                Optimally.
                            </p>
                            <div class="mt-2">
                                <Link
                                    href="/contact"
                                    class="btn btn-gradient-success rounded-pill"
                                >
                                    Contact Us
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero__image">
                        <img
                            loading="lazy"
                            :src="hero_img1"
                            alt="hero_imgs"
                            class="img-fluid"
                        />
                        <!-- <carousel
              :breakpoints="breakpoints"
              ref="myCarousel"
              autoplay="3000"
              snapAlign="start"
              wrapAround="true"
            >
              <slide v-for="(hero_img, index) in hero_imgs" :key="index">
                <img
                  loading="lazy"
                  :src="hero_img2"
                  alt="hero_imgs"
                  class="bg-light"
                />
              </slide>
            </carousel> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-2">
                <div class="sub_service rounded p-2 bg-white shadow-sm position-relative">
                    <h4 class="text-success">AgriCourt Ventures</h4>
                    <p class="fw-normal">
                      Through in-depth research and development, we’ve focused on serving the needs of farmers through provision of quality inputs such as high quality seeds...
                    </p>
                    <Link
                        class="btn-success btn btn-sm"
                        :href="route('agri-court')"
                    >
                        Read more
                    </Link>
                    <svg class="position-absolute top-0 start-0 end-0"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 1440 320"
                    >
                        <path
                            fill="#28c76f"
                            fill-opacity="0.1"
                            d="M0,32L0,256L36.9,256L36.9,192L73.8,192L73.8,96L110.8,96L110.8,128L147.7,128L147.7,64L184.6,64L184.6,256L221.5,256L221.5,224L258.5,224L258.5,256L295.4,256L295.4,64L332.3,64L332.3,32L369.2,32L369.2,288L406.2,288L406.2,192L443.1,192L443.1,192L480,192L480,288L516.9,288L516.9,96L553.8,96L553.8,224L590.8,224L590.8,224L627.7,224L627.7,320L664.6,320L664.6,192L701.5,192L701.5,256L738.5,256L738.5,128L775.4,128L775.4,160L812.3,160L812.3,256L849.2,256L849.2,256L886.2,256L886.2,256L923.1,256L923.1,288L960,288L960,256L996.9,256L996.9,128L1033.8,128L1033.8,256L1070.8,256L1070.8,96L1107.7,96L1107.7,256L1144.6,256L1144.6,224L1181.5,224L1181.5,160L1218.5,160L1218.5,0L1255.4,0L1255.4,96L1292.3,96L1292.3,288L1329.2,288L1329.2,192L1366.2,192L1366.2,224L1403.1,224L1403.1,32L1440,32L1440,0L1403.1,0L1403.1,0L1366.2,0L1366.2,0L1329.2,0L1329.2,0L1292.3,0L1292.3,0L1255.4,0L1255.4,0L1218.5,0L1218.5,0L1181.5,0L1181.5,0L1144.6,0L1144.6,0L1107.7,0L1107.7,0L1070.8,0L1070.8,0L1033.8,0L1033.8,0L996.9,0L996.9,0L960,0L960,0L923.1,0L923.1,0L886.2,0L886.2,0L849.2,0L849.2,0L812.3,0L812.3,0L775.4,0L775.4,0L738.5,0L738.5,0L701.5,0L701.5,0L664.6,0L664.6,0L627.7,0L627.7,0L590.8,0L590.8,0L553.8,0L553.8,0L516.9,0L516.9,0L480,0L480,0L443.1,0L443.1,0L406.2,0L406.2,0L369.2,0L369.2,0L332.3,0L332.3,0L295.4,0L295.4,0L258.5,0L258.5,0L221.5,0L221.5,0L184.6,0L184.6,0L147.7,0L147.7,0L110.8,0L110.8,0L73.8,0L73.8,0L36.9,0L36.9,0L0,0L0,0Z"
                        ></path>
                    </svg>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-2">
                <div class="sub_service rounded p-2 bg-white shadow-sm position-relative">
                    <h4 class="text-success">HarvestYield Farm</h4>
                    <p class="fw-normal">
                      Through our 10Ha Farmland focused on vegetable crop production i.e Tomato, Cucumber, Sweetcorn, Special Watermelon and Pepper, we provide farm management...
                    </p>
                    <Link
                        class="btn-success btn btn-sm"
                        :href="route('harvest-yield')"
                    >
                        Read more
                    </Link>
                    <svg class="position-absolute top-0 start-0 end-0"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 1440 320"
                    >
                        <path
                            fill="#28c76f"
                            fill-opacity="0.1"
                            d="M0,32L0,256L36.9,256L36.9,192L73.8,192L73.8,96L110.8,96L110.8,128L147.7,128L147.7,64L184.6,64L184.6,256L221.5,256L221.5,224L258.5,224L258.5,256L295.4,256L295.4,64L332.3,64L332.3,32L369.2,32L369.2,288L406.2,288L406.2,192L443.1,192L443.1,192L480,192L480,288L516.9,288L516.9,96L553.8,96L553.8,224L590.8,224L590.8,224L627.7,224L627.7,320L664.6,320L664.6,192L701.5,192L701.5,256L738.5,256L738.5,128L775.4,128L775.4,160L812.3,160L812.3,256L849.2,256L849.2,256L886.2,256L886.2,256L923.1,256L923.1,288L960,288L960,256L996.9,256L996.9,128L1033.8,128L1033.8,256L1070.8,256L1070.8,96L1107.7,96L1107.7,256L1144.6,256L1144.6,224L1181.5,224L1181.5,160L1218.5,160L1218.5,0L1255.4,0L1255.4,96L1292.3,96L1292.3,288L1329.2,288L1329.2,192L1366.2,192L1366.2,224L1403.1,224L1403.1,32L1440,32L1440,0L1403.1,0L1403.1,0L1366.2,0L1366.2,0L1329.2,0L1329.2,0L1292.3,0L1292.3,0L1255.4,0L1255.4,0L1218.5,0L1218.5,0L1181.5,0L1181.5,0L1144.6,0L1144.6,0L1107.7,0L1107.7,0L1070.8,0L1070.8,0L1033.8,0L1033.8,0L996.9,0L996.9,0L960,0L960,0L923.1,0L923.1,0L886.2,0L886.2,0L849.2,0L849.2,0L812.3,0L812.3,0L775.4,0L775.4,0L738.5,0L738.5,0L701.5,0L701.5,0L664.6,0L664.6,0L627.7,0L627.7,0L590.8,0L590.8,0L553.8,0L553.8,0L516.9,0L516.9,0L480,0L480,0L443.1,0L443.1,0L406.2,0L406.2,0L369.2,0L369.2,0L332.3,0L332.3,0L295.4,0L295.4,0L258.5,0L258.5,0L221.5,0L221.5,0L184.6,0L184.6,0L147.7,0L147.7,0L110.8,0L110.8,0L73.8,0L73.8,0L36.9,0L36.9,0L0,0L0,0Z"
                        ></path>
                </svg>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-2">
                <div class="sub_service rounded p-2 bg-white shadow-sm position-relative">
                    <h4 class="text-success">Agro-Input Claims</h4>
                    <p class="fw-normal">
                      The rate at which small-scale farmers and commercial farmers lose their farm produce to the negative impacts of adulterated and low quality input is enormous...
                    </p>
                    <Link
                        class="btn-success btn btn-sm"
                        :href="route('agro-input')"
                    >
                        Read more
                    </Link>
                    <svg class="position-absolute top-0 start-0 end-0"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 1440 320"
                    >
                        <path
                            fill="#28c76f"
                            fill-opacity="0.1"
                            d="M0,32L0,256L36.9,256L36.9,192L73.8,192L73.8,96L110.8,96L110.8,128L147.7,128L147.7,64L184.6,64L184.6,256L221.5,256L221.5,224L258.5,224L258.5,256L295.4,256L295.4,64L332.3,64L332.3,32L369.2,32L369.2,288L406.2,288L406.2,192L443.1,192L443.1,192L480,192L480,288L516.9,288L516.9,96L553.8,96L553.8,224L590.8,224L590.8,224L627.7,224L627.7,320L664.6,320L664.6,192L701.5,192L701.5,256L738.5,256L738.5,128L775.4,128L775.4,160L812.3,160L812.3,256L849.2,256L849.2,256L886.2,256L886.2,256L923.1,256L923.1,288L960,288L960,256L996.9,256L996.9,128L1033.8,128L1033.8,256L1070.8,256L1070.8,96L1107.7,96L1107.7,256L1144.6,256L1144.6,224L1181.5,224L1181.5,160L1218.5,160L1218.5,0L1255.4,0L1255.4,96L1292.3,96L1292.3,288L1329.2,288L1329.2,192L1366.2,192L1366.2,224L1403.1,224L1403.1,32L1440,32L1440,0L1403.1,0L1403.1,0L1366.2,0L1366.2,0L1329.2,0L1329.2,0L1292.3,0L1292.3,0L1255.4,0L1255.4,0L1218.5,0L1218.5,0L1181.5,0L1181.5,0L1144.6,0L1144.6,0L1107.7,0L1107.7,0L1070.8,0L1070.8,0L1033.8,0L1033.8,0L996.9,0L996.9,0L960,0L960,0L923.1,0L923.1,0L886.2,0L886.2,0L849.2,0L849.2,0L812.3,0L812.3,0L775.4,0L775.4,0L738.5,0L738.5,0L701.5,0L701.5,0L664.6,0L664.6,0L627.7,0L627.7,0L590.8,0L590.8,0L553.8,0L553.8,0L516.9,0L516.9,0L480,0L480,0L443.1,0L443.1,0L406.2,0L406.2,0L369.2,0L369.2,0L332.3,0L332.3,0L295.4,0L295.4,0L258.5,0L258.5,0L221.5,0L221.5,0L184.6,0L184.6,0L147.7,0L147.7,0L110.8,0L110.8,0L73.8,0L73.8,0L36.9,0L36.9,0L0,0L0,0Z"
                        ></path>
                    </svg>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script setup>
import { Carousel, Slide } from "vue3-carousel";
import { breakpoints } from "@/utils/helper";
import { Link } from "@inertiajs/vue3";
import hero_img1 from "../../../images/img/hero-img1.png";
import hero_img2 from "../../../images/img/hero-img2.png";
import "vue3-carousel/dist/carousel.css";

const hero_imgs = [hero_img1, hero_img2];
</script>

<style lang="css" scoped>
.hero {
    position: relative;
    background: url("../../../images/bg/bg.png");
}
.hero__image {
    margin-top: 4rem;
    /* border: 6px solid white; */
    overflow: hidden !important;
}
.hero__text {
    background-position: center;
    background-size: cover;
    height: 500px;
    display: flex;
    align-items: center;
    /* justify-content: start; */
}
.hero__text h1 {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    color: var(--green-5);
    font-size: 3.5rem;
    font-weight: 900;
    letter-spacing: 1.3;
    margin: 0;
    padding: 0;
}
.hero__text p {
    font-size: 1.25rem;
    font-weight: normal;
    line-height: 1.55;
}

@media screen and (max-width: 576px) {
    .hero__text h1 {
        font-size: 2.4rem;
        line-height: 1.4;
    }
}
/* @media screen and (min-width: 576px) and (max-width: 768px) {
}
@media screen and (min-width: 768px) and (max-width: 992px) {
}
@media screen and (min-width: 992px) and (max-width: 1200px) {
}
@media screen and (min-width: 1200px) {
} */
</style>
