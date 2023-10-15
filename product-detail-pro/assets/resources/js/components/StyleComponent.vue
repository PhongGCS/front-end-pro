<template>
    <div class="_w-full _flex _flex-col _justify-center _pt-4">
      <div class="_bg-[#b5b6b659] _rounded-xl">
        <div class="_bg-white _border _border-gray-300 hover:_border-gray-400 _rounded-xl _text-sm _flex _justify-between _py-5 _font-light _px-4 _w-full">{{title}} <span class="_text-gray-500 text-end">{{ selectedObject ? selectedObject.name : ''}}</span></div>
        <div v-if="children" class="">
          <div class="_w-full _rounded-b-xl _relative _group  _flex _justify-center _pt-1" v-for="(styleDataChildren, styleName ) in children" :key="styleName">
            <div class="_text-sm _flex _justify-between _py-5 _font-light _px-4 _w-full">
              <span class="_font-bold">{{styleDataChildren.parent}}</span>
              <span>{{styleDataChildren.name}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'StyleComponent',
  props: {
    title: String,
    selected: String
  },
  data() {
    return {
      children: {},
      selectedObject: {}
    }
  },
  beforeMount() {
    if(this.selected) {
      this.selectedObject = JSON.parse(this.selected);
    }
    if (this.selectedObject && this.selectedObject.children) {
      this.children = this.selectedObject.children;
    }
  },
  methods: {
    emitChangeOption: function (e) {
    //   this.$emit("emitChangeOption", this.branch);
    }
  },
  
}
</script>