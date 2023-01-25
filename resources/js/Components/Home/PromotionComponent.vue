<template>
  <div class="promotion__section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="promotion__section__header">
            <h2>Check out our amazing offers</h2>
            <h3>Featured Offers</h3>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div
          v-for="(promotion, index) in promotions"
          :key="promotion.id + index"
          data-aos="fade-up"
          :data-aos-delay="50 * index"
          class="col-lg-3 col-md-6 mb-1"
        >
          <div class="promotion__box">
            <img
              class="img-fluid shadow-sm rounded"
              loading="lazy"
              :src="JSON.parse(promotion.banner_img).img_url"
              alt="amazing_offers"
            />
            <div class="promotion__details shadow-sm rounded">
              <h4 class="text-light fw-bolder">{{ promotion?.title }}</h4>
              <p class="text-secondary">{{ promotion?.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps(["promotions"]);
</script>

<style lang="css" scoped>
.promotion__section {
  position: relative;
  padding: 4rem 0;
}
.promotion__section__header h2 {
  font-size: 1.3rem;
  font-weight: bolder;
  color: var(--green);
}
.promotion__section__header h3 {
  font-size: 2rem;
  font-weight: bolder;
}
.promotion__box {
  position: relative;
  transition: 500ms ease;
}
.promotion__details {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: none;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: 500ms ease;
}
.promotion__box:hover .promotion__details {
  display: flex;
  background: rgba(0, 0, 0, 0.65);
  cursor: pointer;
}
</style>