import { createLogger, createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";

import wishlistStore from "@/store/modules/wishlistStore";

const ls = new SecureLS({ isCompression: true, encodingType: "aes" });
const debug = process.env.NODE_ENV !== "production";
const modules = {
    wishlistStore,
};
const persist = {
    paths: ["wishlistStore"],
    storage: {
        getItem: (key) => ls.get(key),
        setItem: (key, value) => ls.set(key, value),
        removeItem: (key) => ls.remove(key),
    },
};
const plugins = debug
    ? [createLogger(), createPersistedState(persist)]
    : [createPersistedState(persist)];

export default createStore({
    modules,
    plugins: plugins,
});
