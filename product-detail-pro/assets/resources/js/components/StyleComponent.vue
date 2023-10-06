<template>
    <div class="w-full flex justify-center pt-4">
        <button class="border border-gray-300 hover:border-gray-400 rounded-md text-sm w-[85%] flex justify-between py-5 font-light px-4">{{title}} <span class="text-gray-500 text-end">Bleecker</span></button>
    </div>
</template>

<script>
export default {
  name: 'StyleComponent',
  props: {
    title: String,
  },
  methods: {
    emitChangeOption: function (e) {
    //   this.$emit("emitChangeOption", this.branch);
    }
  }
}
</script>