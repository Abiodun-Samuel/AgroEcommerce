<template>
  <div class="rating">
    <span :style="`color:${color}`">
      <Icon v-if="value >= 1" icon="ic:sharp-star" />
      <Icon v-else-if="value >= 0.5" icon="ic:sharp-star-half" />
      <Icon v-else icon="ic:sharp-star-border" />
    </span>
    <span :style="`color:${color}`">
      <Icon v-if="value >= 2" icon="ic:sharp-star" />
      <Icon v-else-if="value >= 1.5" icon="ic:sharp-star-half" />
      <Icon v-else icon="ic:sharp-star-border" />
    </span>
    <span :style="`color:${color}`">
      <Icon v-if="value >= 3" icon="ic:sharp-star" />
      <Icon v-else-if="value >= 2.5" icon="ic:sharp-star-half" />
      <Icon v-else icon="ic:sharp-star-border" />
    </span>
    <span :style="`color:${color}`">
      <Icon v-if="value >= 4" icon="ic:sharp-star" />
      <Icon v-else-if="value >= 3.5" icon="ic:sharp-star-half" />
      <Icon v-else icon="ic:sharp-star-border" />
    </span>
    <span :style="`color:${color}`">
      <Icon v-if="value >= 5" icon="ic:sharp-star" />
      <Icon v-else-if="value >= 4.5" icon="ic:sharp-star-half" />
      <Icon v-else icon="ic:sharp-star-border" />
    </span>
    <p class="small py-0 my-0 ms-1 text-secondary" v-if="text">{{ text }}</p>
  </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
defineProps({
  value: { type: Number, default: 0, required: true },
  color: { type: String, default: "#E4811C", required: true },
  text: { type: String, default: "", required: false },
});
</script>

<style lang="css" scoped>
.rating {
  display: flex;
  align-items: center;
}
.rating span {
  font-size: 1.1rem;
  padding: 0;
}
</style>