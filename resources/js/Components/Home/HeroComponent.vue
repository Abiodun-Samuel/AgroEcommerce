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
                We Provide Innovative Agricultural Solutions and Quality
                Services to Improve Crop Yields Optimally.
              </p>
              <div class="mt-2">
                <Link class="btn btn-gradient-success rounded-pill">
                  Contact Us
                </Link>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="hero__image shadow rounded-pill">
            <carousel
              :breakpoints="breakpoints"
              ref="myCarousel"
              autoplay="3000"
              snapAlign="start"
              wrapAround="true"
            >
              <slide v-for="(hero_img, index) in hero_imgs" :key="index">
                <img
                  loading="lazy"
                  :src="hero_img"
                  alt="hero_imgs"
                  class="bg-light"
                />
              </slide>
            </carousel>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Carousel, Slide } from "vue3-carousel";
import { breakpoints } from "@/utils/helper";
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
  border: 6px solid white;
  overflow: hidden !important;
}
.hero__text {
  background-position: center;
  background-size: cover;
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: start;
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