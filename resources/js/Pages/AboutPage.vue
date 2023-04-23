<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BreadCrump from "@/Components/Partial/BreadCrump.vue";

const step_one = {
  slug: "About Us",
  link: false,
  route_name: "",
};
</script>

<template>
  <Head title="About Us" />
  <GuestLayout>
    <BreadCrump :step_one="step_one" />
    <section id="aboutus-page">
      <div class="container">
        <div class="row">
          <div data-aos="fade-up" class="col-12 mt-3">
            <div>
              <h2 class="text-success fw-bolder mb-2">
                SuperoAgrobase Limited
              </h2>
              <p class="lead">
                Supero Agrobase Limited is a fast-rising agribusiness enterprise
                that leverages in-depth research and development to provide
                farmers with high quality agricultural inputs, farm management,
                consultancy and agricultural laboratory services.
              </p>
            </div>
            <div class="about__services p-3 my-3">
              <h2 class="mb-1 text-success fw-bolder">Our services</h2>
              <p class="lead">
                Sales of Agro-Input Products (AgriCourt Ventures)
                <Link :href="route('agri-court')"> Read More. </Link>
              </p>
              <p class="lead">
                Agro-Input products claim(s), research and promotion
                <Link :href="route('agro-input')"> Read More. </Link>
              </p>
              <p class="lead">
                Production of Vegetable Crops (HarvestYield Farm)
                <Link :href="route('harvest-yield')"> Read More. </Link>
              </p>
              <p class="lead mt-2">
                Our Core Values are: Integrity Respect Transparency Excellence
                Team Work
              </p>
            </div>
          </div>
        </div>

        <!-- {{-- Team section --}} -->
        <div class="my-1">
          <h3 class="text-success fw-bolder">Meet our Team</h3>
          <p class="lead">
            We are a team of professionals; we also have a vast network, strong
            experiences in the sector and global exposure to offer high quality
            solutions to our clients.
          </p>
        </div>

        <div class="row">
          <div
            data-aos="fade-up"
            class="col-lg-3 col-md-4 col-sm-6 my-1 xs d-flex align-items-stretch"
          >
            <div class="card">
              <img
                loading="lazy"
                src="@/assets/images/team/member3.jpg"
                class="card-img-top"
                alt="team member"
              />

              <div class="card-body text-center">
                <p class="member-name">Adetola D. Taiwo</p>
                <p class="position font-italic">
                  (Technical Sales & General Manager)
                </p>
              </div>
            </div>
          </div>
          <div
            data-aos="fade-up"
            data-aos-delay="100"
            class="col-lg-3 col-md-4 col-sm-6 my-1 xs d-flex align-items-stretch"
          >
            <div class="card">
              <img
                loading="lazy"
                src="@/assets/images/team/member1.jpg"
                class="card-img-top"
                alt="team member"
              />

              <div class="card-body text-center">
                <p class="member-name">Adebowale Miracle</p>
                <p class="position font-italic">(Administrative Officer)</p>
              </div>
            </div>
          </div>
          <div
            data-aos="fade-up"
            data-aos-delay="200"
            class="col-lg-3 col-md-4 col-sm-6 my-1 xs d-flex align-items-stretch"
          >
            <div class="card">
              <img
                loading="lazy"
                src="@/assets/images/team/member2.jpg"
                class="card-img-top"
                alt="team member"
              />

              <div class="card-body text-center">
                <p class="member-name">Bankole Tomiwa</p>
                <p class="position font-italic">(Technical & Media Manager)</p>
              </div>
            </div>
          </div>
          <div
            data-aos="fade-up"
            data-aos-delay="300"
            class="col-lg-3 col-md-4 col-sm-6 my-1 xs d-flex align-items-stretch"
          >
            <div class="card">
              <img
                loading="lazy"
                src="@/assets/images/team/member4.jpg"
                class="card-img-top"
                alt="team member"
              />

              <div class="card-body text-center">
                <p class="member-name">Kolapo A. Olawunmi</p>
                <p class="position font-italic">
                  (Technical sales & Inventory Manager)
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<style lang='css'>
.about__services {
  background: url("@/assets/images/bg/product-bg.jpg");
  background-position: center;
  background-size: cover;
  text-align: center;
}
</style>