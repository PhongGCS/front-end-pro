<template>
  <div class="product-detail-pro">
     <section>
        <div class="pt-4 h-screen">
            <div class="flex h-[calc(100vh-48px)]">
                <div class="w-4/6 bg-[#efefef]">
                        <img class="h-[90vh] mx-auto" :src="mainImage" alt="">
                </div>
                <div class="w-2/6 flex flex-col ">
                    <div class="text-center flex justify-between text-sm pt-4 transition-transform duration-300">
                        <TabItemHeading
                            v-for="(tab, index) in tabs"
                            :key="index"
                            :tab-name="tab"
                            :active-tab="activeTab"
                            @tab-change="changeTab"
                            >
                            {{ tab }}
                        </TabItemHeading>
                    </div>
                    <div id="tab-fabric" class="overflow-y-auto h-auto tab-fabric" :class="activeTab === 'Fabric' ? 'block' : 'hidden'">
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Select your fabric</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                            <div>
                                <div v-if="fabric.Info.Style === 'FabricComponent'">
                                    <div v-for="(fabricData, fabricName) in fabric.Options" :key="fabricName" @click.prevent="changeFabric(fabricData, fabricName)">
                                        <FabricComponent :title="fabricData.name" :price="fabricData.price" :imageUrl="fabricData.image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-style" class="overflow-y-auto h-auto tab-style" :class="activeTab === 'Style' ? 'block' : 'hidden'">
                        
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Select your style</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                            <div>
                                <div v-for="(styleData, styleName) in styles" :key="styleName" @click.prevent="changeStyle(styleData, styleName)">
                                    <StyleComponent :title="styleData.Info.name" :selected="totalSelectedData.styles[styleName]" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-size" class="overflow-y-auto h-auto tab-size" :class="activeTab === 'Size' ? 'block' : 'hidden'">
                        <div class="w-[85%] mx-auto my-1">
                            <SizeComponent @sizeEmitted="handleSizeEmitted"></SizeComponent>

                        </div>
                    </div>

                    <div id="tab-summary" class="overflow-y-auto h-auto tab-summary" :class="activeTab === 'Summary' ? 'block' : 'hidden'">
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Summary</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                            <StyleComponent v-if="totalSelectedData.keyFabric" title="Fabric" :selected="totalSelectedData.keyFabric" />
                            <StyleComponent v-if="totalSelectedData.size" title="Size" :selected="{ name:totalSelectedData.size}" />
                            <div v-for="(styleData, styleName) in styles" :key="styleName" @click.prevent="changeStyle(styleData, styleName)">
                                <StyleComponent :title="styleData.Info.name" :selected="totalSelectedData.styles[styleName]" />
                            </div>

                        </div>
                    </div>
                    <div id="tab-styledetail" class="overflow-y-auto h-auto tab-style-detail" :class="activeTab === 'StyleDetail' ? 'block' : 'hidden'">
                        <div class="w-[85%] mx-auto my-1">
                        <div v-for="(styleData, styleName ) in styleDataDetail" :key="styleName" @click.prevent="chooseStyleDetail(styleName, styleData)">
                           <StyleDetailComponent :title="styleData.name" :description="styleData.description"/>
                         </div>
                         
                        </div>
                    </div>
                   
                    <div class="mt-auto border-t pt-4">
                        <div class="flex justify-between items-center w-[85%] mx-auto mt-auto mb-8">
                            <div>
                                <p class="text-xs text-gray-400"> {{productData.Delivery}}</p>
                                <h3 class="text-sm text-gray-800 font-light">{{productData.ProductName}} - {{productData.Price}}</h3>
                            </div>
                            <div class="flex">
                                <button @click.prevent="prevChange()" class="border px-11 py-2.5 text-sm rounded-md mx-1">Prev</button>
                                <button @click.prevent="nextChange()" class="border px-11 py-2.5 text-sm bg-[#2d2d2c] text-white rounded-md mx-1">Next</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script>
import TabItemHeading from './TabItemHeading.vue';
import FabricComponent from './FabricComponent.vue'
import StyleComponent from './StyleComponent.vue'
import StyleDetailComponent from './StyleDetailComponent.vue'
import SizeComponent from './SizeComponent.vue'
import gsap from 'gsap'

export default {
  name: 'ProductDetailPro',
  props: {
    productData: Object,
    fabric: Object,
    styles: Object,
    mapping: Object
  },
  data() {
    return {
        tabs: ['Fabric', 'Style', 'Size', 'Summary'],
        activeTab: 'Fabric',
        mainImage: null,
        totalSelectedData: {
            keyFabric: null,
            styles : {
            },
            size: null
        },
        styleDataDetail: null,
        currentStyleKey : null
    }
  },
  components: {
    FabricComponent,
    TabItemHeading,
    StyleComponent,
    StyleDetailComponent,
    SizeComponent
  },
  beforeMount() {
    this.mainImage = this.productData.Image
    // gsap.to("#tab-fabric", {rotation: 360, x: 100, duration: 1});

  },
  mounted() {
    gsap.fromTo('#tab-fabric', { x: `${1 * 100}%`, duration: 0.5 },{ x: 0 });

  },
  methods: {
    findImage() {
        const { keyFabric, styles } = this.totalSelectedData;

        const styleKeys = Object.values(styles)
            .map(style => style.key)
            .filter(key => key !== undefined);

        const mapping = this.mapping.find(item => {
            const keysToCompare = [keyFabric.key, ...styleKeys];
            return JSON.stringify(item.key) === JSON.stringify(keysToCompare);
        });

        return mapping ? mapping.image : null;
    },
    getMapperKey() {
        let key = "";
        if (this.totalSelectedData.keyFabric.key) {
            key+="Fabric" + ":" + this.totalSelectedData.keyFabric.key
        }
        //console.log(this.totalSelectedData.keyFabric && this.totalSelectedData.keyFabric.name);
        if(key === "") throw Error("Key not found");
        return key;
    },
    changeFabric(fabricData, keyFabric) {
      console.log("Get image match " + keyFabric);
      this.totalSelectedData.keyFabric = { key: keyFabric, name: fabricData.name};
    //   let mapperKey = this.getMapperKey();
    //   let mainImage = this.mapper[mapperKey];
      let mainImage = this.findImage();
      if (mainImage && mainImage != this.mainImage) {
        this.mainImage = mainImage;
      }
    },
    changeTab(tabName) {
      this.activeTab = tabName;
      gsap.fromTo(`#tab-${tabName.toLowerCase()}`, { x: `${1 * 100}%`, duration: 0.5 },{ x: 0 });
    },
    changeStyle(styleData, styleKey) {
        this.changeTab("StyleDetail");
        this.styleDataDetail = styleData.Options;
        this.totalSelectedData.styles[styleKey] = {};
        this.currentStyleKey = styleKey;
    },
    chooseStyleDetail(styleName, styleData) {
        this.changeTab("Style");
        if(this.currentStyleKey) {
            this.totalSelectedData.styles[this.currentStyleKey] = {key: styleName, name: styleData.name};
            let mainImage = this.findImage();
            if (mainImage != this.mainImage) {
                this.mainImage = mainImage;
            }
        } else {
          throw new Error("Incorrect currentStyleKey: " + currentStyleKey);  
        } 
    },
    prevChange() {
        let tab = ['Fabric', 'Style', 'Size', 'Summary'];
        let currentIndex = tab.indexOf(this.activeTab);

        if (currentIndex > 0) {
            this.changeTab(tab[currentIndex - 1]);
        } else {
            if (this.activeTab === 'StyleDetail') {
                this.changeTab("Style");
            }
        }
    },
    nextChange() {
        let tab = ['Fabric', 'Style', 'Size', 'Summary'];
        let currentIndex = tab.indexOf(this.activeTab);
        console.log(currentIndex +"__"+ this.activeTab);
        if (currentIndex >= 0 && currentIndex < tab.length - 1) {
            this.changeTab(tab[currentIndex + 1]);
        }
    },
    handleSizeEmitted(size) {
        this.totalSelectedData.size = size;
        this.changeTab("Summary");

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
