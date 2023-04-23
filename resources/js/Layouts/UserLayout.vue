<script setup>
import { ref, onMounted, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import Footer from "@/Components/Dashboard/Footer.vue";

const user = computed(() => usePage().props.auth.user);

onMounted(() => {
  var body = document.querySelector("body");
  document
    .querySelector('[data-toggle="minimize"]')
    .addEventListener("click", function () {
      if (
        body.classList.contains("sidebar-toggle-display") ||
        body.classList.contains("sidebar-absolute")
      ) {
        body.classList.toggle("sidebar-hidden");
      } else {
        body.classList.toggle("sidebar-icon-only");
      }
    });

  document
    .querySelector('[data-toggle="offcanvas"]')
    .addEventListener("click", function () {
      document.querySelector(".sidebar-offcanvas").classList.toggle("active");
    });
});
</script>

<template>
  <div class="container-scroller">
    <nav
      class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row shadow-sm"
    >
      <div class="container-fluid">
        <div
          class="navbar-brand-wrapper d-flex align-items-center justify-content-start"
        >
          <!-- logo  -->
          <Link
            class="navbar-brand brand-logo"
            :href="route('user.dashboard.index')"
          >
            <img src="@/assets/images/logo/logo.png" alt="logo" />
          </Link>
          <Link
            class="navbar-brand brand-logo-mini"
            :href="route('user.dashboard.index')"
          >
            <img src="@/assets/images/logo/logo.png" alt="logo" />
          </Link>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <!-- toggle icon  -->
          <button
            class="navbar-toggler align-self-center"
            type="button"
            data-toggle="minimize"
          >
            <Icon class="navbar-icon" icon="gg:menu-grid-r" />
          </button>

          <Link :href="route('home')">
            <Icon class="navbar-icon" icon="mdi:home-account" />
          </Link>

          <!-- nav dropdowns  -->
          <ul class="navbar-nav navbar-nav-right">
            <!--  notification  -->
            <!-- profile  -->
            <li class="nav-item nav-profile dropdown">
              <a
                class="nav-link dropdown-toggle d-flex align-items-center"
                id="profileDropdown"
                href="#"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <div class="nav-profile-img">
                  <Icon
                    height="25"
                    class="navbar-icon"
                    icon="mdi:user-circle-outline"
                  />
                  <span
                    :class="
                      user.status == 'online'
                        ? 'bg-success'
                        : user.status == 'offline'
                        ? 'bg-danger'
                        : 'bg-warning'
                    "
                  ></span>
                </div>
                <div class="nav-profile-text">
                  <p class="lead fw-bolder text-dark m-0 p-0 d-flex">
                    <span>user</span>
                    <Icon icon="gridicons:dropdown" />
                  </p>
                </div>
              </a>
              <div
                class="dropdown-menu navbar-dropdown p-1"
                aria-labelledby="profileDropdown"
              >
                <div class="dropdown-divider"></div>
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="dropdown-item btn btn-danger w-100 text-center"
                >
                  Logout
                </Link>
              </div>
            </li>
          </ul>
          <button
            class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button"
            data-toggle="offcanvas"
          >
            <Icon icon="gg:menu-grid-r" class="navbar-icon" />
          </button>
        </div>
      </div>
    </nav>
    <!-- sidebar  -->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas shadow" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img
                  v-if="user.avatar"
                  :src="user.avatar"
                  alt="profile image"
                  height="40"
                  width="40"
                />
                <Icon v-else icon="mdi:user-circle-outline" height="46" />
                <span
                  :class="
                    user.status == 'online'
                      ? 'bg-success'
                      : user.status == 'offline'
                      ? 'bg-danger'
                      : 'bg-warning'
                  "
                ></span>
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <p class="fw-bolder mb-2">
                  {{ `${user.first_name} ${user.last_name.substring(0, 1)}.` }}
                </p>
                <span class="text-secondary text-small">{{ user.role }}</span>
              </div>
            </a>
          </li>
          <!-- <li class="nav-item">
            <Link class="nav-link" :href="route('user.dashboard.index')">
              <Icon icon="carbon:dashboard" class="menu-icon" />
              <span class="menu-title">Dashboard</span>
            </Link>
          </li> -->
          <li class="nav-item">
            <Link class="nav-link" :href="route('user.profile.index')">
              <Icon icon="mdi:user-circle-outline" class="menu-icon" />
              <span class="menu-title">Profile</span>
            </Link>
          </li>
          <!-- <li class="nav-item">
            <Link class="nav-link" :href="route('user.category.index')">
              <Icon icon="tabler:category" class="menu-icon" />
              <span class="menu-title">Category</span>
            </Link>
          </li> -->
          <li class="nav-item">
            <Link class="nav-link" :href="route('user.order.index')">
              <Icon
                icon="icon-park-outline:transaction-order"
                class="menu-icon"
              />
              <span class="menu-title">My Orders</span>
            </Link>
          </li>

          <!-- <li class="nav-item">
            <Link class="nav-link" :href="route('user.product.index')">
              <Icon icon="fluent-mdl2:product-list" class="menu-icon" />
              <span class="menu-title">Products</span>
            </Link>
          </li> -->
          <!-- <li class="nav-item">
            <a
              class="nav-link"
              data-bs-toggle="collapse"
              href="#ui-basic"
              aria-expanded="false"
              aria-controls="ui-basic"
            >
              <Icon icon="fluent-mdl2:product-list" class="menu-icon" />
              <span class="menu-title">Products</span>
              <Icon
                icon="material-symbols:keyboard-arrow-right"
                class="menu-arrow"
              />
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <Link
                    class="nav-link small"
                    :href="route('user.product.index')"
                  >
                    <Icon icon="tabler:point" height="20" />
                    <span class="menu-title small">All Products</span>
                  </Link>
                </li>
                <li class="nav-item">
                  <Link
                    class="nav-link small"
                    :href="route('user.product.create')"
                  >
                    <Icon icon="tabler:point" height="20" />
                    <span class="menu-title small">New Product</span>
                  </Link>
                </li>
              </ul>
            </div>
          </li> -->

          <!-- <li class="nav-item">
            <Link class="nav-link" :href="route('user.subcategory.index')">
              <Icon icon="uiw:setting-o" class="menu-icon" />
              <span class="menu-title">Settings</span>
            </Link>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <span class="menu-title">Tables</span>
              <i class="mdi mdi-table-large menu-icon"></i>
            </a>
          </li> -->
          <!-- menu with dropdown -->
          <!-- <li class="nav-item">
            <a
              class="nav-link"
              data-bs-toggle="collapse"
              href="#general-pages"
              aria-expanded="false"
              aria-controls="general-pages"
            >
              <span class="menu-title">Sample Pages</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/blank-page.html">
                    Blank Page
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/login.html">
                    Login
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/register.html">
                    Register
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/error-404.html">
                    404
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/samples/error-500.html">
                    500
                  </a>
                </li>
              </ul>
            </div>
          </li> -->
          <!-- menu with dropdown -->
        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <slot />
        </div>

        <Footer />
      </div>
    </div>
  </div>
</template>

<style lang="css" scoped>
@import "@/assets/css/dashboard-core.css";
</style>
 