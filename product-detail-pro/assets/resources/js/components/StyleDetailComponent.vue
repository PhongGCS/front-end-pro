<template>
    <div class="w-full flex justify-center items-center pt-4">
        <button class="border border-gray-300 hover:border-gray-400 focus:border-black rounded-md text-sm w-[85%] flex justify-between py-7 font-light px-6"><span class="text-start text-sm font-light w-2/3"><span class="text-lg font-bold">{{title}}</span> <br>A single-breasted tailored overcoat with a notch lapel and mid-thigh length.</span><img class="w-1/4" src="https://cdn.suitsupply.com/image/upload/b_rgb:ffffff,c_fit,f_auto,h_800,q_auto:good,w_800/custommade/thumbs2/fits/coat/vicenza" alt=""></button>
    </div>
</template>

<script>
export default {
  name: 'StyleDetailComponent',
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