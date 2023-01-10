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
          data-aos="fade-up"
          data-aos-delay="0"
          class="col-lg-4 col-md-6 mb-1"
        >
          <div class="promotion__box">
            <img
              class="img-fluid shadow-sm rounded"
              loading="lazy"
              src="@/assets/images/offers/offer1.png"
              alt="amazing_offers"
            />
          </div>
        </div>
        <div
          data-aos="fade-up"
          data-aos-delay="50"
          class="col-lg-4 col-md-6 mb-1"
        >
          <div class="promotion__box">
            <img
              class="img-fluid shadow-sm rounded"
              loading="lazy"
              src="@/assets/images/offers/offers2.png"
              alt="amazing_offers"
            />
          </div>
        </div>
        <div
          data-aos="fade-up"
          data-aos-delay="100"
          class="col-lg-4 col-md-6 mb-1"
        >
          <div class="promotion__box">
            <img
              class="img-fluid shadow-sm rounded"
              loading="lazy"
              src="@/assets/images/offers/offer3.png"
              alt="amazing_offers"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
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