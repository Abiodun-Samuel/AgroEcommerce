<template>
  <img :src="b64" alt="image" :height="height" />
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useConvertToBase64Composable } from "@/Composables/useBase64";

const { toBase64 } = useConvertToBase64Composable();
const b64 = ref("");
const props = defineProps(["url", "height"]);

onMounted(() => {
  if (props.url != null) {
    toBase64(props.url, (dataUrl) => {
      if (dataUrl != "") b64.value = dataUrl;
    });
  }
});
</script>
