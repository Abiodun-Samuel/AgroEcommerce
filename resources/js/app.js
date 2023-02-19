import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import vue3GoogleLogin from "vue3-google-login";
import AOS from "aos";
import store from "@/store";

import "../css/app.css";
import "./bootstrap";
import "../css/vendors.min.css";
import "../css/bootstrap.min.css";
import "../css/bootstrap-extended.min.css";
import "../css/colors.min.css";
import "../css/components.min.css";
import "../css/index.css";
import "aos/dist/aos.css";

import "bootstrap/dist/js/bootstrap.js";

AOS.init({ duration: 500 });
const appName =
    window.document.getElementsByTagName("title")[0]?.innerText ||
    "SuperoAgrobase Ltd";

const options = {
    position: "top-center",
    timeout: 2000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: false,
};

createInertiaApp({
    progress: {
        color: "#28c76f",
        showSpinner: true,
    },
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: false });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, options)
            .use(store)
            .use(vue3GoogleLogin, {
                clientId: import.meta.env.VITE_GOOGLE_CLIENT_ID,
            })
            .mount(el);
    },
});
