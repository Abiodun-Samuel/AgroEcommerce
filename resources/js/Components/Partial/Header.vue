<template>
    <div
        @click="mobileNavHandler"
        v-if="body__overlay"
        class="body__overlay"
    ></div>

    <div class="fixed-top">
        <div class="header__one bg-white shadow">
            <div class="container">
                <div class="row header__box">
                    <!-- logo  -->
                    <div class="col-lg-2 col-3 d-flex align-items-center">
                        <Link
                            :href="route('home')"
                            class="d-flex align-items-center"
                        >
                            <img
                                src="../../../images/logo/logo.png"
                                alt="logo"
                                width="100"
                            />
                        </Link>
                    </div>
                    <!-- seacrh box  class="" -->
                    <div class="col-lg-5 header__searchbox d-none d-lg-flex">
                        <div class="dropdown w-100">
                            <div class="input-group">
                                <input
                                    type="text"
                                    aria-describedby="button-addon2"
                                    class="px-1 form-control"
                                    aria-label="Search for Products"
                                    @change="search"
                                    placeholder="Search for products..."
                                    v-model="searchForm.search"
                                />
                                <button
                                    class="btn btn-success d-flex align-items-center fw-bolder"
                                    type="button"
                                    @click="search"
                                    id="button-addon2"
                                    :disabled="searchForm.processing"
                                >
                                    <span
                                        v-if="searchForm.processing"
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>
                                    <Icon
                                        v-else
                                        icon="ic:twotone-search"
                                        height="20"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- cart and wish list  -->
                    <div
                        class="col-6 col-lg-5 header__cart d-flex align-items-center gap-2 justify-content-end"
                    >
                        <div class="box">
                            <button
                                @click="wishlistShow = !wishlistShow"
                                class="d-flex align-items-center"
                                as="button"
                                type="button"
                                href="#"
                            >
                                <div class="icon">
                                    <p class="count">
                                        {{ wishList.length }}
                                    </p>
                                    <Icon icon="ph:heart" height="25" />
                                </div>
                                <span class="d-none d-lg-flex">Wishlist</span>
                            </button>
                        </div>

                        <div class="box">
                            <Link
                                :href="route('cart')"
                                class="d-flex align-items-center"
                            >
                                <div class="icon">
                                    <p class="count">
                                        {{ cartCount }}
                                    </p>
                                    <Icon
                                        icon="ic:outline-shopping-cart"
                                        height="25"
                                    />
                                </div>
                                <span class="d-none d-lg-flex">Cart</span>
                            </Link>
                        </div>

                        <!-- <div v-if="auth_user" class="box">
                            <Link
                                :href="route('user.order.index')"
                                class="d-flex align-items-center"
                            >
                                <div class="icon">
                                    <Icon
                                        icon="material-symbols:order-approve-outline-sharp"
                                        height="25"
                                    />
                                </div>
                                <span class="d-none d-lg-flex">Orders</span>
                            </Link>
                        </div> -->
                        <!-- auth data  -->
                        <div class="dropdown box">
                            <Link
                                class="dropdown-toggle d-flex align-items-center"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <img
                                    v-if="auth_user?.avatar"
                                    height="25"
                                    width="25"
                                    :src="auth_user.avatar"
                                    :alt="auth_user.first_name"
                                    class="rounded-circle"
                                    referrerpolicy="no-referrer"
                                    style="margin-right: 5px"
                                />
                                <Icon
                                    style="margin-right: 5px"
                                    v-else
                                    height="30"
                                    width="30"
                                    icon="healthicons:ui-user-profile"
                                />
                                <span class="d-none d-lg-flex">
                                    {{
                                        auth_user
                                            ? auth_user.first_name
                                            : "Account"
                                    }}</span
                                >
                                <Icon
                                    height="20"
                                    width="20"
                                    icon="material-symbols:keyboard-arrow-down-rounded"
                                />
                            </Link>

                            <ul class="dropdown-menu shadow p-1">
                                <template v-if="!auth_user">
                                    <li class="mb-1 rounded">
                                        <Link
                                            :href="route('login')"
                                            class="btn btn-success dropdown-item w-100 dropdown-item d-flex align-items-center"
                                        >
                                            <Icon
                                                class="me-1"
                                                icon="mdi:logout"
                                            />
                                            <span>Login</span></Link
                                        >
                                    </li>
                                    <li class="rounded">
                                        <Link
                                            :href="route('register')"
                                            class="btn btn-success dropdown-item w-100 dropdown-item d-flex align-items-center"
                                        >
                                            <Icon
                                                class="me-1"
                                                icon="mdi:register-outline"
                                            />
                                            <span>Register</span></Link
                                        >
                                    </li>
                                </template>
                                <template v-else>
                                    <li class="rounded">
                                        <Link
                                            style="margin-bottom: 7px"
                                            :class="
                                                auth_user.email_verified_at
                                                    ? 'alert-success'
                                                    : 'alert-danger'
                                            "
                                            class="dropdown-item d-flex align-items-center rounded"
                                            :href="
                                                auth_user.email_verified_at
                                                    ? '#'
                                                    : route(
                                                          'verification.notice'
                                                      )
                                            "
                                        >
                                            <Icon
                                                height="20"
                                                width="20"
                                                class="me-1"
                                                icon="ic:baseline-verified-user"
                                            />
                                            <span class="fw-bolder">{{
                                                auth_user.email_verified_at
                                                    ? "Verified"
                                                    : "Not Verified"
                                            }}</span>
                                        </Link>
                                    </li>
                                    <li class="rounded">
                                        <Link
                                            style="margin-bottom: 7px"
                                            class="dropdown-item d-flex align-items-center rounded"
                                            :href="
                                                auth_user.is_admin ||
                                                auth_user.role === 'Admin' ||
                                                auth_user.role === 'Super Admin'
                                                    ? route(
                                                          'admin.dashboard.index'
                                                      )
                                                    : route(
                                                          'user.profile.index'
                                                      )
                                            "
                                        >
                                            <Icon
                                                height="20"
                                                width="20"
                                                icon="healthicons:ui-user-profile"
                                                class="me-1"
                                            />
                                            <span
                                                >{{
                                                    auth_user.role ===
                                                        "Admin" ||
                                                    auth_user.role ===
                                                        "Super Admin" ||
                                                    auth_user.is_admin
                                                        ? "Admin"
                                                        : "Dashboard"
                                                }}
                                            </span>
                                        </Link>
                                    </li>
                                    <li class="rounded">
                                        <Link
                                            style="margin-bottom: 7px"
                                            :href="
                                                auth_user.is_admin ||
                                                auth_user.role === 'Admin' ||
                                                auth_user.role === 'Super Admin'
                                                    ? route('admin.order.index')
                                                    : route('user.order.index')
                                            "
                                            class="dropdown-item d-flex align-items-center rounded"
                                        >
                                            <Icon
                                                height="20"
                                                width="20"
                                                class="me-1"
                                                icon="mdi:order-bool-ascending-variant"
                                            />
                                            <span>My Orders</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                            class="btn btn-danger dropdown-item w-100 dropdown-item d-flex align-items-center"
                                        >
                                            <Icon
                                                height="20"
                                                width="20"
                                                class="me-1"
                                                icon="mdi:logout"
                                            />
                                            <span>Log Out</span></Link
                                        >
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <!-- <div @click="mobileNavHandler" class="box d-lg-none d-md-flex">
              <button class="me-2 border-0 btn p-0 m-0">
                <Icon height="30" icon="gg:menu-grid-r" />
              </button>
            </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="header__two bg-success d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav
                            class="header__links d-flex justify-content-between align-items-center"
                        >
                            <Link
                                :href="route('home')"
                                class="d-flex align-items-center"
                            >
                                <Icon height="14" icon="carbon:home" />
                                <span style="margin-left: 5px">Home</span>
                            </Link>
                            <Link
                                :href="route('about')"
                                class="d-none d-lg-flex align-items-center"
                            >
                                <Icon icon="mdi:about-circle-outline" />
                                <span style="margin-left: 5px">About</span>
                            </Link>

                            <div class="d-none d-lg-flex dropdown box">
                                <Link
                                    class="dropdown-toggle d-flex align-items-center"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <Icon icon="icons8:services" />
                                    <span style="margin-left: 5px"
                                        >Services</span
                                    >
                                </Link>

                                <ul class="dropdown-menu shadow p-1 bg-white">
                                    <li class="mb-1 rounded">
                                        <Link
                                            :href="route('agro-input')"
                                            class="text-black dropdown-item w-100 dropdown-item d-flex align-items-center"
                                        >
                                            <Icon icon="mdi:button-pointer" />
                                            <span style="margin-left: 5px"
                                                >Agro-Input</span
                                            >
                                        </Link>
                                    </li>
                                    <li class="mb-1 rounded">
                                        <Link
                                            :href="route('agri-court')"
                                            class="text-black dropdown-item w-100 dropdown-item d-flex align-items-center"
                                        >
                                            <Icon icon="mdi:button-pointer" />
                                            <span style="margin-left: 5px"
                                                >AgriCourt Ventures</span
                                            >
                                        </Link>
                                    </li>
                                    <li class="mb-1 rounded">
                                        <Link
                                            :href="route('harvest-yield')"
                                            class="text-black dropdown-item w-100 dropdown-item d-flex align-items-center"
                                        >
                                            <Icon icon="mdi:button-pointer" />
                                            <span style="margin-left: 5px"
                                                >HarvestYield Farm</span
                                            >
                                        </Link>
                                    </li>
                                </ul>
                            </div>

                            <Link
                                :href="route('blog-page')"
                                class="d-none d-lg-flex align-items-center"
                            >
                                <Icon icon="cib:blogger-b" />
                                <span style="margin-left: 5px">Blog</span>
                            </Link>
                            <Link
                                :href="route('contact')"
                                class="d-none d-lg-flex align-items-center"
                            >
                                <Icon icon="fluent-mdl2:contact-list" />
                                <span style="margin-left: 5px">Contact</span>
                            </Link>

                            <Link
                                :href="route('product-page')"
                                class="d-none d-lg-flex align-items-center"
                            >
                                <Icon icon="ri:shopping-basket-2-line" />
                                <span style="margin-left: 5px">Products</span>
                            </Link>

                            <div @click="mobileNavHandler" class="d-lg-none">
                                <button class="me-2 border-0 btn p-0 m-0">
                                    <Icon
                                        class="text-white hamburger"
                                        height="30"
                                        icon="gg:menu-grid-r"
                                    />
                                </button>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- mobile__nav  -->
    <div class="mobile__nav shadow-lg bg-light">
        <div class="container">
            <div
                class="mobile__top d-flex justify-content-between align-items-start"
            >
                <Link :href="route('home')" class="d-flex align-items-center">
                    <img
                        src="../../../images/logo/logo.png"
                        alt="logo"
                        width="100"
                    />
                </Link>

                <div @click="mobileNavHandler">
                    <button class="border-0 btn p-0 m-0">
                        <Icon
                            class="text-danger"
                            height="30"
                            icon="carbon:close-filled"
                        />
                    </button>
                </div>
            </div>
            <hr />

            <div class="my-2 mobile__search d-flex align-items-stretch">
                <input
                    type="text"
                    style="margin-right: 5px"
                    class="form-control"
                    aria-label="Search for Products"
                    placeholder="Search for products..."
                    @change="search"
                    v-model="searchForm.search"
                />
                <button
                    @click="search"
                    :disabled="searchForm.processing"
                    class="btn btn-success d-flex align-items-center py-0 px-1"
                    type="button"
                >
                    <span
                        v-if="searchForm.processing"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                    ></span>
                    <Icon v-else icon="ic:twotone-search" height="20" />
                </button>
            </div>

            <hr />

            <div class="mobile_nav_links">
                <nav class="d-flex justify-content-start gap-1 flex-column">
                    <Link
                        :href="route('home')"
                        class="d-flex align-items-center"
                    >
                        <Icon height="14" icon="carbon:home" />
                        <span style="margin-left: 5px">Home</span>
                    </Link>
                    <Link
                        :href="route('about')"
                        class="d-flex align-items-center"
                    >
                        <Icon icon="mdi:about-circle-outline" />
                        <span style="margin-left: 5px">About</span>
                    </Link>
                    <div class="dropdown box">
                        <Link
                            class="dropdown-toggle d-flex align-items-center"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <Icon icon="icons8:services" />
                            <span style="margin-left: 5px">Services</span>
                        </Link>

                        <ul class="dropdown-menu shadow p-1 bg-white">
                            <li class="mb-1 rounded">
                                <Link
                                    :href="route('agro-input')"
                                    class="text-black dropdown-item w-100 dropdown-item d-flex align-items-center"
                                >
                                    <Icon icon="mdi:button-pointer" />
                                    <span style="margin-left: 5px"
                                        >Agro-Input</span
                                    >
                                </Link>
                            </li>
                            <li class="mb-1 rounded">
                                <Link
                                    :href="route('agri-court')"
                                    class="text-black dropdown-item w-100 dropdown-item d-flex align-items-center"
                                >
                                    <Icon icon="mdi:button-pointer" />
                                    <span style="margin-left: 5px"
                                        >AgriCourt Ventures</span
                                    >
                                </Link>
                            </li>
                            <li class="mb-1 rounded">
                                <Link
                                    :href="route('harvest-yield')"
                                    class="text-black dropdown-item w-100 dropdown-item d-flex align-items-center"
                                >
                                    <Icon icon="mdi:button-pointer" />
                                    <span style="margin-left: 5px"
                                        >HarvestYield Farm</span
                                    >
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <Link
                        :href="route('blog-page')"
                        class="d-flex align-items-center"
                    >
                        <Icon icon="cib:blogger-b" />
                        <span style="margin-left: 5px">Blog</span>
                    </Link>
                    <Link
                        :href="route('product-page')"
                        class="d-flex align-items-center"
                    >
                        <Icon icon="ri:shopping-basket-2-line" />
                        <span style="margin-left: 5px">Products</span>
                    </Link>
                    <Link
                        :href="route('contact')"
                        class="d-flex align-items-center"
                    >
                        <Icon icon="fluent-mdl2:contact-list" />
                        <span style="margin-left: 5px">Contact</span>
                    </Link>
                </nav>
            </div>

            <hr />

            <div class="d-flex justify-content-between align-items-center">
                <div class="contact-icons my-1">
                    <a
                        target="_blank"
                        href="https://wa.me/message/KK2QPDR6KTLBK1"
                    >
                        <i>
                            <svg
                                width="1.3em"
                                height="1.3em"
                                viewBox="0 0 464 488"
                            >
                                <path
                                    d="M462 228q0 93-66 159t-160 66q-56 0-109-28L2 464l40-120q-32-54-32-116q0-93 66-158.5T236 4t160 65.5T462 228zM236 39q-79 0-134.5 55.5T46 228q0 62 36 111l-24 70l74-23q49 31 104 31q79 0 134.5-55.5T426 228T370.5 94.5T236 39zm114 241q-1-1-10-7q-3-1-19-8.5t-19-8.5q-9-3-13 2q-1 3-4.5 7.5t-7.5 9t-5 5.5q-4 6-12 1q-34-17-45-27q-7-7-13.5-15t-12-15t-5.5-8q-3-7 3-11q4-6 8-10l6-9q2-5-1-10q-4-13-17-41q-3-9-12-9h-11q-9 0-15 7q-19 19-19 45q0 24 22 57l2 3q2 3 4.5 6.5t7 9t9 10.5t10.5 11.5t13 12.5t14.5 11.5t16.5 10t18 8.5q16 6 27.5 10t18 5t9.5 1t7-1t5-1q9-1 21.5-9t15.5-17q8-21 3-26z"
                                    fill="#25D366"
                                />
                            </svg>
                        </i>
                    </a>
                    <a
                        target="_blank"
                        href="https://www.facebook.com/superoagrobasedltd/"
                    >
                        <i>
                            <svg
                                width="1.3em"
                                height="1.3em"
                                viewBox="0 0 486.037 1000"
                            >
                                <path
                                    d="M124.074 1000V530.771H0V361.826h124.074V217.525C124.074 104.132 197.365 0 366.243 0C434.619 0 485.18 6.555 485.18 6.555l-3.984 157.766s-51.564-.502-107.833-.502c-60.9 0-70.657 28.065-70.657 74.646v123.361h183.331l-7.977 168.945H302.706V1000H124.074"
                                    fill="#4267B2"
                                />
                            </svg>
                        </i>
                    </a>
                    <a
                        target="_blank"
                        href="https://www.instagram.com/superoagrobase/"
                    >
                        <i>
                            <svg
                                width="1.3em"
                                height="1.3em"
                                viewBox="0 0 256 256"
                            >
                                <path
                                    d="M128 80a48 48 0 1 0 48 48a48.054 48.054 0 0 0-48-48zm0 80a32 32 0 1 1 32-32a32.036 32.036 0 0 1-32 32zm44-132H84a56.064 56.064 0 0 0-56 56v88a56.064 56.064 0 0 0 56 56h88a56.064 56.064 0 0 0 56-56V84a56.064 56.064 0 0 0-56-56zm40 144a40.045 40.045 0 0 1-40 40H84a40.045 40.045 0 0 1-40-40V84a40.045 40.045 0 0 1 40-40h88a40.045 40.045 0 0 1 40 40zm-20-96a12 12 0 1 1-12-12a12 12 0 0 1 12 12z"
                                    fill="#E1306C"
                                />
                            </svg>
                        </i>
                    </a>
                    <a target="_blank" href="https://twitter.com/LimitedSupero">
                        <i>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                focusable="false"
                                width="1.5em"
                                height="1.5em"
                                viewBox="0 0 24 24"
                            >
                                <g fill="none">
                                    <path
                                        d="M23.643 4.937c-.835.37-1.732.62-2.675.733a4.67 4.67 0 0 0 2.048-2.578a9.3 9.3 0 0 1-2.958 1.13a4.66 4.66 0 0 0-7.938 4.25a13.229 13.229 0 0 1-9.602-4.868c-.4.69-.63 1.49-.63 2.342A4.66 4.66 0 0 0 3.96 9.824a4.647 4.647 0 0 1-2.11-.583v.06a4.66 4.66 0 0 0 3.737 4.568a4.692 4.692 0 0 1-2.104.08a4.661 4.661 0 0 0 4.352 3.234a9.348 9.348 0 0 1-5.786 1.995a9.5 9.5 0 0 1-1.112-.065a13.175 13.175 0 0 0 7.14 2.093c8.57 0 13.255-7.098 13.255-13.254c0-.2-.005-.402-.014-.602a9.47 9.47 0 0 0 2.323-2.41l.002-.003z"
                                        fill="#1DA1F2"
                                    />
                                </g>
                            </svg>
                        </i>
                    </a>
                    <a target="_blank" href="mailto:contact@superoagrobase.com">
                        <i>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                focusable="false"
                                width="1.5em"
                                height="1.5em"
                                viewBox="0 0 32 32"
                            >
                                <g
                                    fill="none"
                                    stroke="#626262"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="3"
                                >
                                    <path d="M2 26h28V6H2zM2 6l14 10L30 6" />
                                </g>
                            </svg>
                        </i>
                    </a>
                    <a target="_blank" href="tel:+2348157037737">
                        <i>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="1.5em"
                                height="1.5em"
                                viewBox=" 0 0 24 24"
                            >
                                <path
                                    d="M20 10.999h2C22 5.869 18.127 2 12.99 2v2C17.052 4 20 6.943 20 10.999z"
                                    fill="white"
                                />
                                <path
                                    d="M13 8c2.103 0 3 .897 3 3h2c0-3.225-1.775-5-5-5v2zm3.422 5.443a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66c-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a1 1 0 0 0-.086-1.391l-4.064-3.696z"
                                    fill="#212121"
                                />
                            </svg>
                        </i>
                    </a>
                </div>
            </div>

            <hr />

            <div class="d-flex justify-content-between mt-1">
                <template v-if="!auth_user">
                    <Link
                        :href="route('login')"
                        class="btn btn-outline-success me-1 d-flex align-items-center"
                    >
                        <Icon class="me-1" icon="mdi:logout" />
                        <span>Login</span></Link
                    >
                    <Link
                        :href="route('register')"
                        class="btn btn-outline-success d-flex align-items-center"
                    >
                        <Icon class="me-1" icon="mdi:register-outline" />
                        <span>Register</span></Link
                    >
                </template>
                <template v-else>
                    <!-- <Link
            class="
              btn btn-sm btn-outline-success
              d-flex
              align-items-center
              rounded
            "
            :href="route('dashboard.index')"
          >
            <Icon
              height="20"
              width="20"
              icon="healthicons:ui-user-profile"
              class="me-1"
            />
            <span>Profile</span>
          </Link> -->

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="btn btn-danger justify-content-center d-flex align-items-center w-100"
                    >
                        <Icon
                            height="20"
                            width="20"
                            icon="mdi:logout"
                            class="me-1"
                        />
                        <span>Log Out</span></Link
                    >
                </template>
            </div>
        </div>
    </div>

    <!-- wishlist  -->
    <div
        v-if="wishlistShow"
        class="wishlist__box shadow-lg bg-light"
        data-aos="fade-left"
    >
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bolder my-0 py-0">My Wishlist</h3>
                <button
                    @click="wishlistShow = !wishlistShow"
                    class="border-0 btn p-0 m-0"
                >
                    <Icon
                        class="text-danger"
                        height="25"
                        icon="carbon:close-filled"
                    />
                </button>
            </div>
            <hr />
            <div
                v-if="wishList.length"
                class="d-flex justify-content-between align-items-center"
            >
                <button @click="clearWishList" class="btn btn-sm btn-danger">
                    Clear All
                </button>
            </div>

            <template v-if="wishList.length">
                <hr />
                <div
                    style="padding: 10px"
                    v-for="item in wishList"
                    :key="item"
                    class="my-1 shadow-sm bg-white rounded"
                >
                    <WishListItem :item="item" />
                </div>
            </template>
            <template v-else>
                <div class="text-center">
                    <NoResult text="No products in your wishlist" />
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import WishListItem from "@/Components/Common/WishListItem.vue";
import { Icon } from "@iconify/vue";
import { computed, onMounted, reactive, ref } from "vue";
import { Link, usePage, useForm } from "@inertiajs/vue3";
import store from "@/store";
import NoResult from "@/Components/Common/NoResult.vue";
import { toast } from "@/utils/helper.js";

const wishList = computed(() => store.getters["wishlistStore/wishListItems"]);
const auth_user = computed(() => usePage().props.auth.user);
const cartCount = computed(() => usePage().props.data.cartCount);

const mobileNavShow = ref(false);
const wishlistShow = ref(false);
const body__overlay = ref(false);

const searchForm = useForm({
    search: "",
});

const clearWishList = (params) => {
    store.dispatch("wishlistStore/clearWishList");
    toast.success("Your wishlist has been cleared.");
};

const mobileNavHandler = () => {
    const mobileNav = document.querySelector(".mobile__nav");
    mobileNavShow.value = !mobileNavShow.value;
    if (mobileNavShow.value) {
        mobileNav.classList.add("nav__show");
        body__overlay.value = true;
    } else {
        mobileNav.classList.remove("nav__show");
        body__overlay.value = false;
    }
};
const add_searchbox = () => {
    document.getElementById("myDropdown").classList.add("show");
};
const remove_searchbox = () => {
    document.getElementById("myDropdown").classList.remove("show");
};

const search = () => {
    if (!searchForm.search.length) return null;
    searchForm.get(route("product.search"), {
        preserveScroll: false,
    });
};

onMounted(() => {
    let e, o, n;
    o = 0;
    n = document.querySelector(".header__two");
    window.addEventListener("scroll", function (t) {
        e = window.scrollY;
        o < e && e > 80
            ? (n.classList.remove("slideDown"), n.classList.add("slideUp"))
            : o > e &&
              (n.classList.remove("slideUp"), n.classList.add("slideDown")),
            (o = e);
    });
});
</script>

<style scoped>
.hamburger:hover {
    color: var(--light);
}
.search__icon {
    position: absolute;
    right: 7px;
}
.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-content {
    margin-top: 5px;
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    width: 365px;
    /* width: 465px; */
    border: 1px solid #ddd;
    z-index: 100000;
}
.dropdown-content a {
    color: var(--grey-3);
    padding: 12px 16px;
    margin: 3px 0;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover {
    background-color: var(--green-0);
    color: var(--green-5);
}
.show {
    display: block;
}
/* Slide transitions */
.slideUp {
    transform: translateY(-200px);
    transition: transform 1s ease-out;
}

.slideDown {
    transform: translateY(0);
    transition: transform 1s ease-out;
}
/* second header */
.header__box {
    padding: 5px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.box .icon {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-right: 8px;
    transition: 500ms ease;
}
.box a,
.box button {
    color: var(--black);
    font-weight: normal;
    font-size: 1.07rem;
}
.box a:hover,
.box button:hover {
    color: var(--green);
}
.box .icon p {
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 12px;
    background: var(--green);
    color: #fff;
    border-radius: 50%;
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: normal;
}

.header__two {
    height: 50px;
    z-index: 100000;
}
.header__links {
    height: 50px;
}
.header__links a {
    color: var(--white);
    border-radius: 5px;
    padding: 5px 10px;
}
.header__links a:hover {
    color: var(--black);
    background: var(--green-0);
}

/* mobile nav   */
.mobile__nav {
    position: fixed;
    height: 100vh;
    width: 80vw;
    top: 0;
    left: -100%;
    padding: 1rem 1rem;
    z-index: 2100;
    transition: left 500ms ease;
}
.nav__show {
    left: 0;
}
.body__overlay {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    height: 100vh;
    width: 100vw;
    background: linear-gradient(
        rgba(0, 0, 0, 0.5),
        rgba(0, 0, 0, 0.5)
    ) !important;
    z-index: 1100;
}
.mobile__search {
    position: relative;
    display: flex;
    align-items: center;
}
.mobile_nav_links a {
    color: var(--black);
    border-radius: 5px;
    padding: 5px 10px;
}
.mobile_nav_links a:hover {
    color: var(--green);
    background: var(--green-0);
}
.contact-icons {
    align-items: center;
    display: flex;
    justify-content: space-between;
    gap: 0.6rem;
}
.contact-icons a {
    align-items: center;
    background-color: var(--light-0);
    border-radius: 5px;
    box-shadow: 4px 4px 8px -1px rgba(0, 0, 0, 0.25),
        -4px -4px 8px -1px hsla(0, 0%, 100%, 0.11);
    display: flex;
    height: 35px;
    justify-content: center;
    width: 35px;
}
.contact-icons a:hover {
    box-shadow: inset 4px 4px 8px -1px rgba(0, 0, 0, 0.25),
        inset -4px -4px 8px -1px hsla(0, 0%, 100%, 0);
    transform: scale(0.95);
}

.wishlist__box {
    position: fixed;
    min-height: 100vh;
    width: 50%;
    top: 0;
    right: 0;
    bottom: 0;
    padding: 1rem 1rem;
    z-index: 2100;
    transition: left 500ms ease;
    overflow-y: scroll;
}
@media screen and (max-width: 991.5px) {
    .wishlist__box {
        width: 90%;
    }
}
</style>
