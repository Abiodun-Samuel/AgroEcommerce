<template>
  <div class="pt-4">
    <!-- newsletter  -->
    <div class="container">
      <!-- subscribe to newsletter -->
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-md-10 col-10">
          <div class="footer__newsletter rounded p-2 shadow">
            <div class="footer__newslettter-content text-center p-2 shadow">
              <h2 class="fw-bolder text-white">Subscribe our newsletter</h2>
              <p class="lead text-light">
                Subscribe to the mailing list to receive updates on special
                discount offers, new product and promotions.
              </p>
              <div class="input-group">
                <input
                  type="text"
                  class="form-control p-1"
                  placeholder="Email address"
                  aria-label="Email address"
                  v-model="email"
                  aria-describedby="button-addon2"
                />
                <button
                  :disabled="!email || form_loading"
                  @click="subscribeToNewsletter"
                  class="btn btn-success p-1"
                  type="button"
                  id="button-addon2"
                >
                  <span
                    v-show="form_loading"
                    class="spinner-border spinner-border-sm mx-1"
                  ></span>
                  Subscribe
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer  -->
    <footer id="footer">
      <div class="container pt-5">
        <div class="row pt-4">
          <div class="col-lg-4 col-md-6 mb-2">
            <div class="footer-box shadow">
              <h5 class="text-secondary">SuperoAgrobase Ltd</h5>
              <hr class="text-black" />
              <p class="small text-secondary">
                Supero Incorporation Limited is a fast-rising agribusiness
                enterprise that leverages in-depth research and development to
                provide farmers with high quality agricultural inputs, farm
                management, consultancy and agricultural laboratory services.
              </p>
              <hr class="text-black" />
              <div class="footer-box-cont d-flex justify-content-between">
                <a target="_blank" href="">
                  <Icon icon="tabler:brand-whatsapp" height="23" />
                </a>
                <a target="_blank" href="">
                  <Icon icon="ic:baseline-facebook" height="23" />
                </a>
                <a target="_blank" href="">
                  <Icon icon="mdi:instagram" height="23" />
                </a>
                <a target="_blank" href="">
                  <Icon icon="ant-design:twitter-circle-filled" height="23" />
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-2 footer-box">
            <h5 class="text-secondary">Services</h5>
            <hr class="text-black" />
            <ul class="list-unstyled">
              <li class="my-1">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('agro-input')"
                >
                  <Icon icon="carbon:condition-wait-point" height="18" />
                  Agro-Input
                </Link>
              </li>
              <li class="my-1">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('agri-court')"
                >
                  <Icon icon="carbon:condition-wait-point" height="18" />
                  AgriCourt Ventures</Link
                >
              </li>
              <li class="my-1">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('harvest-yield')"
                >
                  <Icon icon="carbon:condition-wait-point" height="18" />
                  HarvestYield Farm
                </Link>
              </li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 mb-2 footer-box">
            <h5 class="text-secondary">Quick links</h5>
            <hr class="text-black" />
            <ul class="list-unstyled">
              <li style="margin: 7px 0">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('home')"
                >
                  <Icon height="18" icon="carbon:home" />
                  Home
                </Link>
              </li>
              <li style="margin: 7px 0">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('product-page')"
                >
                  <Icon icon="ri:shopping-basket-2-line" height="18" />
                  Products
                </Link>
              </li>
              <li style="margin: 7px 0">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('contact')"
                >
                  <Icon icon="fluent-mdl2:contact-list" height="18" />
                  Contact
                </Link>
              </li>
              <li style="margin: 7px 0">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('blogs')"
                >
                  <Icon height="18" icon="cib:blogger-b" /> Blog
                </Link>
              </li>
              <li style="margin: 7px 0">
                <Link
                  class="d-flex align-items-center gap-1"
                  :href="route('about')"
                >
                  <Icon height="18" icon="mdi:about-circle-outline" /> About
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="footer-foot">
        <div class="container p-1">
          <small>
            &copy; Copyright {{ new Date().getFullYear() }}, SuperoAgrobase
            Limited. All Rights Reserved.
            <br />
            Designed and Developed by
            <a target="_blank" href="https://abiodunsamuel.com/">
              Abiodun Digital Hub
            </a>
          </small>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";

const email = ref("");
const form_loading = ref(false);

const subscribeToNewsletter = () => {
  form_loading.value = true;
  axios
    .post(route("subscribe-to-newsletter"), { email: email.value })
    .then((res) => {
      form_loading.value = false;
      email.value = null;
      toast.success("Your email has been added to our mailing list.");
    })
    .catch((err) => {
      form_loading.value = false;
      toast.error(err.response.data.message);
    });
};
</script>

<style scoped>
.footer__newsletter {
  position: relative;
  background: url("@/assets/images/bg/newsletter.jpg") no-repeat;
  background-position: center;
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: -5rem;
  z-index: 2;
}
.footer__newslettter-content {
  padding: 0.5rem;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
  border-radius: 10px;
}

#footer {
  position: relative;
  background: url("@/assets/images/bg/bg.svg") no-repeat;
  background-position: center;
  background-size: cover;
  z-index: 1;
}
.footer-box a,
.footer-box-cont a {
  color: #717171;
}
.footer-box a:hover,
.footer-box-cont a:hover {
  color: var(--green);
}

#footer .footer-foot {
  background-color: rgba(0, 0, 0, 0.5);
  color: #757575;
  text-align: center;
}
#footer .footer-foot .container a {
  color: #bdbdbd;
  text-decoration: none;
}
</style>