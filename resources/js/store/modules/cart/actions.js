/* eslint-disable no-unused-vars */
// import Session from "@/api/Session";
import SecureLS from "secure-ls";
let ls = new SecureLS({ encodingType: "aes" });

ls.set("key1", { data: "test" });
// console.log(ls.get("key1"));

export const addToCart = ({ commit }, product) => {
    commit("SET_CART_LOADER", true);
    return axios
        .post(route("add-to-cart", product))
        .then((res) => {
            commit("SET_CART_ITEMS", res.data.cart);
            commit("SET_CART_LOADER", false);
            return res.data.message;
        })
        .catch((error) => {
            if (error) {
                commit("SET_CART_ITEMS", []);
                commit("SET_CART_LOADER", false);
            }
            return false;
        });
};

export const getCart = ({ commit }, token) => {
    axios
        .get(route("cart"))
        .then((res) => {
            commit("SET_CART_ITEMS", res.data);
        })
        .catch((error) => {
            if (error) {
                commit("SET_CART_ITEMS", []);
            }
        });
};
