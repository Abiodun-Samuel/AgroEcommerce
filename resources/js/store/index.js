import { createLogger, createStore } from "vuex";

import cart from "@/store/modules/cart";

const debug = process.env.NODE_ENV !== "production";

const modules = {
    cart,
};

export default createStore({
    modules,
    plugins: debug ? [createLogger()] : [],
});
