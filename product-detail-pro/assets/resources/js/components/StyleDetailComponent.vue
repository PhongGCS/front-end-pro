<template>
    <div class="_w-full _flex _justify-center _items-center _pt-4">
        <div class="_border _border-gray-300 hover:_border-gray-400 focus:_border-black _rounded-md _text-sm _w-[85%] _flex _justify-between _py-7 _font-light _px-6"><span class="_text-start _text-sm _font-light _w-2/3"><span class="_text-lg _font-bold">{{title}}</span> <br>{{description}}</span><img class="_w-1/4" src="https://cdn.suitsupply.com/image/upload/b_rgb:ffffff,c_fit,f_auto,h_800,q_auto:good,w_800/custommade/thumbs2/fits/coat/vicenza" alt=""></div>
    </div>
</template>

<script>
export default {
  name: 'StyleDetailComponent',
  props: {
    title: String,
    description: String,
  },
  methods: {
    emitChangeOption: function (e) {
    //   this.$emit("emitChangeOption", this.branch);
    }
  }
}
</script>