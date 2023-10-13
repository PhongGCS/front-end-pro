<template>
  <a
    @click="changeTab"
    :class="['_flex-grow', { '_border-b _border-black': isActive }]"
    class="_py-2 _px-6 _cursor-pointer"
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