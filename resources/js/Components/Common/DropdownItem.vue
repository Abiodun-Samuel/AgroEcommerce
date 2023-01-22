<template>
  <li class="dropdown__item">
    <div
      class="dropdown__trigger"
      :class="{ dropdown__trigger_active: visible }"
      @click="open"
    >
      <slot name="dropdown-trigger"></slot>
      <Icon
        style="color: var(--green)"
        icon="ic:sharp-arrow-circle-right"
        height="20"
        :class="visible ? 'rotate' : ''"
      />
    </div>

    <transition
      name="dropdown"
      @enter="start"
      @after-enter="end"
      @before-leave="start"
      @after-leave="end"
    >
      <div class="dropdown__content" style="padding: 10px" v-show="visible">
        <slot name="dropdown-content"></slot>
      </div>
    </transition>
  </li>
</template>


<script>
import { Icon } from "@iconify/vue";

export default {
  props: {},
  components: { Icon },
  inject: ["Dropdown"],
  data() {
    return {
      index: null,
    };
  },
  computed: {
    visible() {
      return this.index == this.Dropdown.active;
    },
  },
  methods: {
    open() {
      if (this.visible) {
        this.Dropdown.active = null;
      } else {
        this.Dropdown.active = this.index;
      }
    },
    start(el) {
      el.style.height = el.scrollHeight + "px";
    },
    end(el) {
      el.style.height = "";
    },
  },
  created() {
    this.index = this.Dropdown.count++;
  },
};
</script>

<style lang="css" scoped>
.dropdown__item {
  cursor: pointer;
  padding: 10px;
  border-bottom: 1px solid #ebebeb;
  position: relative;
}

.dropdown__trigger {
  display: flex;
  justify-content: space-between;
}
.rotate {
  transform: rotate(90deg);
  transition: 0.2s ease;
}

.dropdown-enter-active,
.dropdown-leave-active {
  will-change: height, opacity;
  transition: height 0.3s ease, opacity 0.3s ease;
  overflow: hidden;
}

.dropdown-enter,
.dropdown-leave-to {
  height: 0 !important;
  opacity: 0;
}
.dropdown__content a:hover {
  color: var(--black) !important;
}
</style>
