import { useToast } from "vue-toastification";
import moment from "moment";
import { numberToWords } from "amount-to-words";

export const amountToWords = (amount) => {
    let amountInWords = numberToWords(amount);
    amountInWords = amountInWords.replace("Lakh", "Hundred Thousand,");
    return `${amountInWords} Naira Only.`;
};
export const intlPhone = (phone, countryCode) => {
    if (phone[0] == 0) {
        let array = phone.substring(1);
        return countryCode + array;
    } else {
        return phone;
    }
};

export const toast = useToast();

export const breakpoints = {
    0: {
        itemsToShow: 1,
        snapAlign: "center",
    },
    // 700px and up
    700: {
        itemsToShow: 1,
        snapAlign: "center",
    },
    // 1024 and up
    1024: {
        itemsToShow: 1,
        snapAlign: "start",
    },
};

export const firstLetterUpperCase = (string) => {
    if (!string) return null;
    return string.charAt(0).toUpperCase() + string.slice(1);
};

export const discountPercentage = (inflatedPrice, price) => {
    let value = ((inflatedPrice - price) / inflatedPrice) * 100;
    return Math.round(value) <= 0.5
        ? `0${Math.round(value)}%`
        : Math.round(value) < 10
        ? `-0${Math.round(value)}%`
        : `-${Math.round(value)}%`;
};

export const formatProductName = (name) => {
    if (name.length < 16) {
        return `${name.substring(0, 16).toUpperCase()}`;
    } else {
        return `${name.substring(0, 16).toUpperCase()}...`;
    }
};

export const formatCurrency = (amount) => {
    if (amount) {
        return Number(amount)
            .toFixed(2)
            .replace(/\d(?=(\d{3})+\.)/g, "$&,");
    }
};

export const formatTime = (time) => {
    if (time) {
        let display = moment(time).utc(time).format("DD MMM YYYY hh:mma");
        return display;
    }
};

export const slugify = (string) => {
    if (!string) return null;
    return string
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
};

export const unslugify = (slug) => {
    if (!slug) return null;
    let words = slug.split("-");
    for (let i = 0; i < words.length; i++) {
        let word = words[i];
        words[i] = word.charAt(0).toUpperCase() + word.slice(1);
    }
    return words.join(" ");
};
export const unslugifyTwo = (slug) => {
    if (!slug) return null;
    let words = slug.split("-");
    return words.join("");
};
const filterResultCount = () => {
    if (result_count.value == "default")
        return (all_products.value = props.products.data
            ? props.products.data
            : props.products);
    if (props.products.data) {
        all_products.value = props.products.data.slice(
            0,
            Number(result_count.value)
        );
    } else {
        all_products.value = props.products.slice(
            0,
            Number(result_count.value)
        );
    }
};
export const randomId = (leng) => {
    if (!leng) {
        return;
    }
    let result = "";
    let characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let charactersLength = characters.length;
    for (let i = 0; i < leng; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }
    return result;
};
