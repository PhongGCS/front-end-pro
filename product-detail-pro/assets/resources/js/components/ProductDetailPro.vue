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
                    <div class="overflow-y-auto h-auto tab-fabric" :class="activeTab === 'Fabric' ? 'block' : 'hidden'">
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Select your fabric</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                            <!-- <div class="w-full grid gap-2 grid-cols-2 mb-2">
                                <button class=" my-4 py-2 border border-gray-200 hover:border-gray-400 rounded-md ">Filter</button>
                                <button class=" my-4 py-2 border border-gray-200 hover:border-gray-400 rounded-md ">Search</button>
                            </div> -->
                            <div>
                                <div v-if="fabric.Info.Style === 'FabricComponent'">
                                    <div v-for="(fabricData, fabricName) in fabric.Options" :key="fabricName" @click.prevent="changeFabric(fabricName)">
                                        <FabricComponent :title="fabricData.name" :price="fabricData.price" :imageUrl="fabricData.image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-y-auto h-auto tab-style" :class="activeTab === 'Style' ? 'block' : 'hidden'">
                        
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Select your style</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                            <div>
                                <div v-for="(styleData, styleName) in styles" @click.prevent="changeStyle(styleData)">
                                <StyleComponent :title="styleName"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-y-auto h-auto tab-size" :class="activeTab === 'Size' ? 'block' : 'hidden'">
                        
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Select your size</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                        </div>
                    </div>

                    <div class="overflow-y-auto h-auto tab-summary" :class="activeTab === 'Summary' ? 'block' : 'hidden'">
                        <div>
                            <h3 class="text-center font-light text-xl text-gray-900 pt-10 py-2">Summary</h3>
                        </div>
                        <div class="w-[85%] mx-auto my-1">
                            <!-- <div class="w-full grid gap-2 grid-cols-2 mb-2">
                                <button class=" my-4 py-2 border border-gray-200 hover:border-gray-400 rounded-md ">Filter</button>
                                <button class=" my-4 py-2 border border-gray-200 hover:border-gray-400 rounded-md ">Search</button>
                            </div> -->
                            <div>
                                <div v-if="fabric.Info.Style === 'FabricComponent'">
                                    <div v-for="(fabricData, fabricName) in fabric.Options" :key="fabricName" @click.prevent="changeFabric(fabricName)">
                                        <FabricComponent :title="fabricData.name" :price="fabricData.price" :imageUrl="fabricData.image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-auto h-auto tab-style-detail" :class="activeTab === 'StyleDetail' ? 'block' : 'hidden'">
                        <div class="w-[85%] mx-auto my-1">
                        <div v-for="(styleData, styleName ) in styleDataDetail " @click.prevent="chooseStyleDetail(styleName)">
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
                                <button class="border px-11 py-2.5 text-sm rounded-md mx-1">Prev</button>
                                <button class="border px-11 py-2.5 text-sm bg-[#2d2d2c] text-white rounded-md mx-1">Next</button>
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

export default {
  name: 'ProductDetailPro',
  props: {
    productData: Object,
    fabric: Object,
    styles: Object,
    mapper: Object
  },
  data() {
    return {
        tabs: ['Fabric', 'Style', 'Size', 'Summary'],
        activeTab: 'Fabric',
        mainImage: null,
        totalSelectedData: {
            keyFabric: null
        },
        styleDataDetail: null
        
    }
  },
  components: {
    FabricComponent,
    TabItemHeading,
    StyleComponent,
    StyleDetailComponent
  },
  beforeMount() {
    this.mainImage = this.productData.Image
  },
  mounted() {
  },
  methods: {
    getMapperKey() {
        let key = "";
        if (this.totalSelectedData.keyFabric) {
            key+="Fabric" + ":" + this.totalSelectedData.keyFabric
        }
        if(!key) throw Error("Key not found");
        return key;
    },
    changeFabric(keyFabric) {
      console.log("Get image match " + keyFabric);
      this.totalSelectedData.keyFabric = keyFabric;
      let mapperKey = this.getMapperKey();
      let mainImage = this.mapper[mapperKey];
      if (mainImage != this.mainImage) {
        this.mainImage = mainImage;
      }
    },
    changeTab(tabName) {
      this.activeTab = tabName;
    },
    changeStyle(styleData) {
        console.log(styleData);
        this.activeTab = "StyleDetail";
        this.styleDataDetail = styleData.Options;
    },
    chooseStyleDetail(styleName)
    {
        this.activeTab = "Style";
    }

  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
