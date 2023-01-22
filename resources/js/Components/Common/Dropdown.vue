<template>
  <ul class="dropdown rounded">
    <slot></slot>
  </ul>
</template>

<script>
export default {
  props: {},
  data() {
    return {
      Dropdown: {
        count: 0,
        active: null,
      },
    };
  },
  provide() {
    return { Dropdown: this.Dropdown };
  },
};
</script>

<style lang="css" scoped>
.dropdown {
  list-style: none;
  margin: 0;
  padding: 0;
}
.dropdown__item:last-child {
  border-bottom: none;
}
</style>
