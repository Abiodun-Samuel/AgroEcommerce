<template>
    <AdvancedImage
        :plugins="plugins"
        :cldImg="cldImg"
        class="rounded img-fluid shadow-sm"
        :width="600"
        :height="400"
    />
</template>

<script setup>
import {
    AdvancedImage,
    lazyload,
    responsive,
    placeholder,
} from "@cloudinary/vue";
import { Cloudinary } from "@cloudinary/url-gen";
import { computed } from "vue";

const props = defineProps(["imgData"]);

const plugins = [
    placeholder({ mode: "predominant-color" }),
    responsive(),
    lazyload(),
];

const cld = new Cloudinary({
    cloud: {
        cloudName: import.meta.env.VITE_CLOUDNAME,
    },
});

const cldImg = computed(() => {
    let publicId = JSON.parse(props.imgData)?.img_id;
    const imgSource = cld.image(publicId).format("auto").quality("auto");
    return imgSource;
});
</script>
