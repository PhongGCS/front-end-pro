<template>
  <a
    @click="changeTab"
    :class="['flex-grow', { 'border-b border-black': isActive }]"
    class="py-2 px-6 cursor-pointer"
  >
    <slot></slot>
  </a>
</template>

<script>
export default {
  props: {
    tabName: String,
    activeTab: String,
  },
  computed: {
    isActive() {
      return this.tabName === this.activeTab;
    },
  },
  methods: {
    changeTab() {
      this.$emit('tab-change', this.tabName);
    },
  },
};
</script>