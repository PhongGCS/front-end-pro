<template>
    <div class="cs-select-item _w-[85%] _mx-auto _flex _flex-col _justify-center _items-center _mt-4 _rounded-xl ">
      <div class=" _bg-[#f3f4f659]">
        <div @click.prevent="chooseStyleDetail(styleData)" class="_bg-white _w-full _border _border-gray-300 hover:_border-gray-400 focus:_border-black _rounded-xl _text-sm  _flex _justify-between _py-7 _font-light _px-6"><span class="_text-start _text-sm _font-light _w-2/3">
          <span class="_text-lg _font-bold">{{styleData.name}}</span> <br>{{styleData.description}}</span>
          <img v-if="styleData.image" class="_w-[75px] _h-[75px]" :src="styleData.image" alt="">
        </div>
        <div v-if="isShow" class="">
          <div @click.prevent="chooseStyleDetailChildren(styleName, styleDataChildren)" class="_rounded-b-xl _relative _group hover:_bg-gray-100  _flex _justify-center _pt-1" v-for="(styleDataChildren, styleName ) in children" :key="styleName">
            <div class="_text-sm w-[85%] _flex _justify-between _py-5 _font-light _px-4 _w-full">
              {{styleDataChildren.name}}
            </div>
            <HoverInfo v-if="styleDataChildren.description" :description="styleDataChildren.description" />
          </div>
        </div>
      </div>
    </div>
    
</template>

<script>
import HoverInfo from './HoverInfo.vue'
export default {
  name: 'StyleDetailComponent',
  props: {
    styleData: Object,
    styleKey: String,
    children: Object
  },
  components: {
    HoverInfo
  },
  data() {
    return {
      isShow: false
    }
  },
  methods: {
    chooseStyleDetailChildren: function (styleName, styleDataChildren) {
      this.isShow = false;
      this.$emit("emitChooseStyleDetailChildren", styleName, styleDataChildren, this.styleKey, this.styleData.name);
       
    },

    chooseStyleDetail: function (styleDataChildren) {
      if (!this.children) {
        this.$emit("emitChooseStyleDetail", this.styleKey, styleDataChildren);
      } else {
        this.isShow = !this.isShow;
      }
       
    }
  }
}
</script>