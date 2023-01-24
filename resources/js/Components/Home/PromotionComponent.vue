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
</style>