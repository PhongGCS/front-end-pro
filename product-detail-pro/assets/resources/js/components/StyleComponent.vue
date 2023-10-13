<template>
    <div class="_w-full _flex _justify-center _pt-4">
        <button class="_border _border-gray-300 hover:_border-gray-400 _rounded-md _text-sm w-[85%] _flex _justify-between _py-5 _font-light _px-4 _w-full">{{title}} <span class="_text-gray-500 text-end">{{selected ? selected.name : ''}}</span></button>
    </div>
</template>

<script>
export default {
  name: 'StyleComponent',
  props: {
    title: String,
    selected: Object
  },
  methods: {
    emitChangeOption: function (e) {
    //   this.$emit("emitChangeOption", this.branch);
    }
  }
}
</script>