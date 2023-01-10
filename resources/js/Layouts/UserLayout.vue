<script setup>
import { ref, onMounted, computed } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { Icon } from "@iconify/vue";

const user = computed(() => usePage().props.value.auth.user);

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
          class="
            navbar-brand-wrapper
            d-flex
            align-items-center
            justify-content-start
          "
        >
          <!-- logo  -->
          <Link
            class="navbar-brand brand-logo"
            :href="route('admin.dashboard.index')"
          >
            <img src="@/assets/images/logo/logo.png" alt="logo" />
          </Link>
          <Link
            class="navbar-brand brand-logo-mini"
            :href="route('admin.dashboard.index')"
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

          <div class="ms-5 search-field d-none d-md-block">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="Search..."
                aria-label="Search..."
                aria-describedby="button-addon2"
              />
              <button class="btn btn-success" type="button" id="button-addon2">
                Search
              </button>
            </div>
          </div>
          <!-- nav dropdowns  -->
          <ul class="navbar-nav navbar-nav-right">
            <!--  notification  -->
            <li class="nav-item dropdown">
              <a
                class="nav-link count-indicator dropdown-toggle"
                id="messageDropdown"
                href="#"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <Icon class="navbar-icon" icon="zondicons:notification" />
                <div class="count-symbol bg-danger">
                  <p class="p-0 m-0 fw-bolder">9+</p>
                </div>
              </a>
              <div
                class="
                  dropdown-menu dropdown-menu-right
                  navbar-dropdown
                  preview-list
                "
                aria-labelledby="messageDropdown"
              >
                <h5 class="p-3 fw-bolder text-black">Notifications</h5>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <Icon icon="mdi:user-circle-outline" />
                  </div>
                  <div
                    class="
                      preview-item-content
                      d-flex
                      align-items-start
                      flex-column
                      justify-content-center
                    "
                  >
                    <h6
                      class="preview-subject ellipsis mb-1 font-weight-normal"
                    >
                      Mark send you a message
                    </h6>
                    <p class="text-gray mb-0">1 Minutes ago</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <Icon icon="mdi:user-circle-outline" />
                  </div>
                  <div
                    class="
                      preview-item-content
                      d-flex
                      align-items-start
                      flex-column
                      justify-content-center
                    "
                  >
                    <h6
                      class="preview-subject ellipsis mb-1 font-weight-normal"
                    >
                      Cregh send you a message
                    </h6>
                    <p class="text-gray mb-0">15 Minutes ago</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <Icon icon="mdi:user-circle-outline" />
                  </div>
                  <div
                    class="
                      preview-item-content
                      d-flex
                      align-items-start
                      flex-column
                      justify-content-center
                    "
                  >
                    <h6
                      class="preview-subject ellipsis mb-1 font-weight-normal"
                    >
                      Profile picture updated
                    </h6>
                    <p class="text-gray mb-0">18 Minutes ago</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
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
                  <Icon class="navbar-icon" icon="mdi:user-circle-outline" />
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
                  <p class="text-black m-0 p-0">{{ user.first_name }}</p>
                </div>
              </a>
              <div
                class="dropdown-menu navbar-dropdown"
                aria-labelledby="profileDropdown"
              >
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                </a>
              </div>
            </li>
          </ul>
          <button
            class="
              navbar-toggler navbar-toggler-right
              d-lg-none
              align-self-center
            "
            type="button"
            data-toggle="offcanvas"
          >
            <Icon icon="gg:menu-grid-r" />
          </button>
        </div>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile bg-light">
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
                <span class="fw-bolder mb-2">
                  {{ `${user.first_name} ${user.last_name.substring(0, 1)}.` }}
                </span>
                <span class="text-secondary text-small">{{ user.role }}</span>
              </div>
              <i
                class="mdi mdi-bookmark-check text-success nav-profile-badge"
              ></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              data-bs-toggle="collapse"
              href="#ui-basic"
              aria-expanded="false"
              aria-controls="ui-basic"
            >
              <span class="menu-title">Basic UI Elements</span>
              <Icon
                icon="material-symbols:keyboard-arrow-right"
                class="menu-arrow"
              />
              <!-- <i class="menu-arrow"></i> -->
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html"
                    >Buttons</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html"
                    >Typography</a
                  >
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <span class="menu-title">Icons</span>
              <i class="mdi mdi-contacts menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <span class="menu-title">Forms</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <span class="menu-title">Charts</span>
              <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <span class="menu-title">Tables</span>
              <i class="mdi mdi-table-large menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
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
          </li>
          <li class="nav-item sidebar-actions">
            <span class="nav-link">
              <div class="border-bottom">
                <h6 class="font-weight-normal mb-3">Projects</h6>
              </div>
              <button class="btn btn-block btn-lg btn-gradient-primary mt-4">
                + Add a project
              </button>
              <div class="mt-4">
                <div class="border-bottom">
                  <p class="text-secondary">Categories</p>
                </div>
              </div>
            </span>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span>
              Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview
                  <i
                    class="
                      mdi mdi-alert-circle-outline
                      icon-sm
                      text-primary
                      align-middle
                    "
                  ></i>
                </li>
              </ul>
            </nav>
          </div>

          <div class="container">
            <slot />
          </div>
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <span
              class="
                text-muted
                d-block
                text-center text-sm-start
                d-sm-inline-block
              "
              >Copyright © bootstrapdash.com 2021</span
            >
            <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">
              Free
              <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/"
                target="_blank"
                >Bootstrap admin template</a
              >
              from Bootstrapdash.com</span
            >
          </div>
        </footer>
      </div>
    </div>
  </div>
</template>

<style lang="css" scoped>
@import "@/assets/css/dashboard-core.css";
</style>
 