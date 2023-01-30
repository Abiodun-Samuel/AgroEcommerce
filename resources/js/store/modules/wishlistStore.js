import { toast } from "@/utils/helper";
// State
const state = () => ({
    wishListItems: [],
    wishlist_loader: false,
});

// getters
const getters = {
    wishListItems(state) {
        return state.wishListItems;
    },
    wishlist_loader(state) {
        return state.wishlist_loader;
    },
};

// actions
const actions = {
    addToWishList({ commit }, payload) {
        // commit("SET_WISHLIST_LOADER", true);
        commit("SET_WISHLIST_ITEMS", payload);
        // commit("SET_WISHLIST_LOADER", false);
    },
    clearWishList({ commit }) {
        // commit("SET_WISHLIST_LOADER", true);
        commit("CLEAR_WISHLIST");
        // commit("SET_WISHLIST_LOADER", false);
    },
    removeFromWishList({ commit }, productId) {
        commit("REMOVE_WISHLIST_ITEM", productId);
    },
};

// mutations
const mutations = {
    SET_WISHLIST_ITEMS(state, payload) {
        const existItem = state.wishListItems.filter(
            (item) => item.id == payload.id
        );
        if (existItem.length)
            return toast.error(
                "The selected product is already in your wishlist."
            );
        state.wishListItems.push(payload);
        toast.success("The product has been added to your wishlist.");
    },
    REMOVE_WISHLIST_ITEM(state, payload) {
        const filteredItem = state.wishListItems.filter(
            (item) => item.id != payload
        );
        state.wishListItems = filteredItem;
    },
    CLEAR_WISHLIST(state) {
        state.wishListItems = [];
    },
    SET_WISHLIST_LOADER(state, payload) {
        state.wishlist_loader = payload;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
