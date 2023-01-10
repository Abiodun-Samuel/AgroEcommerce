import { useToast } from "vue-toastification";
import { Cloudinary } from "@cloudinary/url-gen";

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

export const cloud = new Cloudinary({
    cloud: {
        cloudName: import.meta.env.VITE_CLOUDNAME,
    },
});
