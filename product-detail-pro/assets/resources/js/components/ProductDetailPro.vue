<template>
  <div class="product-detail-pro">
     <section>
    <div class="">
            <div class="md:_flex md:_h-[calc(100vh-102px)]">
                <div class="md:_flex _overflow-y-auto md:_h-[calc(100vh-102px)] md:_mt-0 _mt-10  _h-[calc(90vh-119px)] md:_w-full">
                    <div :class="{'fullscreen-container': zoomed}" class="md:_w-4/6 _bg-[#efefef] _cursor-none md:_h-[calc(100vh-102px)] _h-[60vh] _relative _overflow-hidden" id="image-container">
                        <div id="main-image">                            
                            <img
                                v-for="(image, index) in mainImages"
                                :key="index"
                                :src="image"
                                :class="'image-' + index + ' _absolute _cursor-none _inset-0 _opacity-100 _transition-opacity  _ease-in-out _duration-500'"
                                :style="{ zIndex: index }"
                                class="md:_h-[90vh] _h-[60vh] _pt-4 _mx-auto"
                                alt=""
                            />
                            <img
                                v-if="mainImages.length == 0"
                                :src="mainImage"
                                :class="' _absolute _cursor-none _inset-0 _opacity-100 _transition-opacity  _ease-in-out _duration-500'"
                                :style="{ zIndex: 1 }"
                                class="md:_h-[90vh] _h-[60vh] _pt-4 _mx-auto"
                                alt=""
                            />

                            
                        </div>
                        <div id="hover-icon" class="_hidden _text-white _flex _justify-center _items-center _pt-[3px]"><p>{{ (zoomed) ? '-' : '+'}}</p></div>
                    </div>
                    <div class="md:_w-2/6 md:_h-[calc(100vh-102px)] _flex _flex-col ">
                        <div class="_text-center _flex _justify-between _text-sm _py-2 _transition-transform _duration-300 md:_static _fixed _top-0 _right-0 _left-0  _bg-white">
                            <TabItemHeading
                                v-for="(tab, index) in tabs"
                                :key="index"
                                :tab-name="tab"
                                :active-tab="activeTab"
                                @tab-change="false"
                                >
                                {{ tab }}
                            </TabItemHeading>
                        </div>
                        <div id="tab-fabric" class="_overflow-y-auto _h-auto tab-fabric" :class="activeTab === 'Fabric' ? '_block' : '_hidden'">
                            <div>
                                <h3 class="_text-center _font-light _text-xl _text-gray-900 _pt-8 _py-2">Select your fabric</h3>
                            </div>
                            <div class="_w-[85%] _mx-auto _my-1">
                                <div>
                                    <div v-if="fabric.Info.Style === 'FabricComponent'">
                                        <div v-for="(fabricData, fabricName) in fabric.Options" :key="fabricName" @click.prevent="changeFabric(fabricData, fabricName)">
                                            <FabricComponent :title="fabricData.name" :price="fabricData.price" :imageUrl="fabricData.image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-style" class="_overflow-y-auto _h-auto tab-style" :class="activeTab === 'Style' ? '_block' : '_hidden'">
                            
                            <div>
                                <h3 class="_text-center _font-light _text-xl _text-gray-900 _pt-10 _py-2">Select your style</h3>
                            </div>
                            <div class="_w-[85%] _mx-auto _my-1">
                                <div v-if="isChangeStyle">
                                    <div v-for="(styleData, styleName) in styles" :key="styleName" @click.prevent="changeStyle(styleData, styleName)">
                                        <StyleComponent :title="styleData.Info.name" :selected="JSON.stringify(totalSelectedData.styles[styleName])" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-size" class="_overflow-y-auto _h-auto tab-size" :class="activeTab === 'Size' ? '_block' : '_hidden'">
                            <div class="_w-[85%] _mx-auto _my-1">
                                <SizeComponent @sizeEmitted="handleSizeEmitted"></SizeComponent>

                            </div>
                        </div>

                        <div  id="tab-summary" class="_overflow-y-auto _h-auto tab-summary" :class="activeTab === 'Summary' ? '_block' : '_hidden'">
                            <div>
                                <h3 class="_text-center _font-light _text-xl _text-gray-900 _pt-10 _py-2">Summary</h3>
                            </div>
                            <div v-if="activeTab === 'Summary'" class="_w-[85%] _mx-auto _my-1">
                                
                                <SummaryData v-for="(item, key) in summaryArray" :key="key" :summary-item="item" />
                            </div>
                        </div>
                        <div id="tab-styledetail" class="_overflow-y-auto _h-auto tab-style-detail" :class="activeTab === 'StyleDetail' ? '_block' : '_hidden'">
                            <div class="_w-[85%] _mx-auto _my-1">
                            <div v-for="(styleData, styleName ) in styleDataDetail" :key="styleName">
                                <StyleDetailComponent  styleDataDetail.options @emitChooseStyleDetailChildren="chooseStyleDetailChildren" @emitChooseStyleDetail="chooseStyleDetail" :style-data="styleData" :style-key="styleName" :children="styleData.children" />
                            </div>
                            
                            </div>
                        </div>
                    
                        <div class="_mt-auto _border-t _py-4 md:_static _fixed _bottom-0 _bg-white _w-full">
                            <div class="_flex _justify-between _items-center _w-[85%] _mx-auto _mt-auto md:_pb-0 _pb-4">
                                <div>
                                    <p class="_text-xs _text-gray-400"> {{productData.Delivery}}</p>
                                    <h3 class="_text-sm _text-gray-800 _font-light">{{productData.ProductName}} - {{productData.Price}}</h3>
                                </div>
                                <div class="_flex">
                                    <button @click.prevent="prevChange()" class="_border md:_px-11 _px-5 md:_py-2.5 _py-2 _text-sm _rounded-md _mx-1">Prev</button>
                                    <button v-if="activeTab !== 'Summary'" @click.prevent="nextChange()" class="_border md:_px-11 _px-5 md:_py-2.5 _py-2 _text-sm _bg-[#2d2d2c] _text-white _rounded-md _mx-1">Next</button>
                                    <button  v-if="activeTab === 'Summary'" class="_border md:_px-11 _px-5 md:_py-2.5 _py-2 _text-sm _bg-[#2d2d2c] _text-white _rounded-md _mx-1">Add to cart</button>
                                </div>
                                <div class="_hidden" id="json-add-to-cart" :json="JSON.stringify(jsonAddToCart)"></div>
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
import TabItemHeading from './TabItemHeading.vue'
import FabricComponent from './FabricComponent.vue'
import StyleComponent from './StyleComponent.vue'
import StyleDetailComponent from './StyleDetailComponent.vue'
import SizeComponent from './SizeComponent.vue'
import SummaryData from './SummaryData.vue'
import gsap from 'gsap'

export default {
  name: 'ProductDetailPro',
  props: {
    productData: Object,
    fabric: Object,
    styles: Object,
    mapping: Object,
    productId: Number
  },
  watch: {
    activeTab(newTab) {
      if (newTab === 'Summary') {
        this.getSummary();
        this.buildDataResultJSON();
      }
    },
  },
  data() {
    return {
        tabs: ['Fabric', 'Style', 'Size', 'Summary'],
        activeTab: 'Fabric',
        mainImage: null,
        mainImages: [],
        totalSelectedData: {
            keyFabric: null,
            styles : {
            },
            size: null
        },
        totalSelectedDisplay: {
           keyFabric: null,
            styles : {
            },
            size: null 
        },
        styleDataDetail: null,
        currentStyleKey : null,
        currentStyleName: null,
        zoomed: false,
        isChangeStyle: true,
        imageListKey : [],
        summaryArray: [],
        jsonAddToCart: {}
    }
  },
  components: {
    FabricComponent,
    TabItemHeading,
    StyleComponent,
    StyleDetailComponent,
    SizeComponent,
    SummaryData
},
  beforeMount() {
    this.mainImage = this.productData.Image
    // gsap.to("#tab-fabric", {rotation: 360, x: 100, duration: 1});

  },
  mounted() {
    gsap.fromTo('#tab-fabric', { x: `${1 * 100}%`, duration: 0.5 },{ x: 0 });


    const imageContainer = document.getElementById("image-container");
    const mainImage = document.getElementById("main-image");
    const hoverIcon = document.getElementById("hover-icon");

    // Add a mousemove event listener to the image
    imageContainer.addEventListener("mousemove", (event) => {
        hoverIcon.style.left = event.clientX + "px";
        hoverIcon.style.top = event.clientY + "px";
    });

    imageContainer.addEventListener("click", () => {
        this.zoomed = !this.zoomed; // Toggle the zoom state
    });

  },
  methods: {
    buildDataResultJSON() {
        this.jsonAddToCart =  {
            productId: this.productId,
            variation: this.summaryArray
        }
    },
    getSummary() {
        this.summaryArray = [];
        let fabric = this.totalSelectedData.keyFabric;
        if (fabric.key && fabric.name && fabric.parent) {
            this.summaryArray.push({
                "key": fabric.key,
                "name": fabric.name,
                "parent": fabric.parent
            });
        }
        let styles = this.totalSelectedData.styles;
        for (const key in styles) {
            if (styles[key].key && styles[key].name && styles[key].parent) {
                this.summaryArray.push({
                    "key": styles[key].key,
                    "name": styles[key].name,
                    "parent": styles[key].parent
                });
            }
            if (styles[key].children) {
                for (const childKey in styles[key].children) {
                const child = styles[key].children[childKey];
                this.summaryArray.push({
                    "key": child.key,
                    "name": child.name,
                    "parent": child.parent
                });
                }
            }
        }
    },
    // Function to traverse the JSON and collect values
    collectValues(jsonData) {
        if (typeof jsonData === 'object' && jsonData !== null) {
            for (const key in jsonData) {
            if (key === 'key') {
                this.imageListKey.push(jsonData[key]);
            }
            this.collectValues(jsonData[key]);
            }
        } else if (Array.isArray(jsonData)) {
            for (const item of jsonData) {
                this.collectValues(item);
            }
        }
    },
    findImage() {
        this.collectValues(this.totalSelectedData);
        let imageList = [];
        for (const key of this.imageListKey) {
            if (this.mapping.hasOwnProperty(key)) {
                imageList.push(this.mapping[key]);
            }
        }
        this.mainImages = imageList;
    },
    changeFabric(fabricData, keyFabric) {
      console.log("Get image match " + keyFabric);
      this.totalSelectedData.keyFabric = { key: keyFabric, name: fabricData.name, parent: "Fabric"};
      this.findImage();
      
    },
    changeTab(tabName) {
      this.activeTab = tabName;
      gsap.fromTo(`#tab-${tabName.toLowerCase()}`, { x: `${1 * 100}%`, duration: 0.5 },{ x: 0 });
    },
    changeStyle(styleData, styleKey) {
        this.changeTab("StyleDetail");
        this.isChangeStyle = false;
        this.styleDataDetail = styleData.Options;
        if(this.totalSelectedData.styles[styleKey] == null) {
            this.totalSelectedData.styles[styleKey] = {"children": {}}; 
        }
        this.currentStyleKey = styleKey;
        this.currentStyleName = styleData.Info.name;
    },
    chooseStyleDetail(styleName, styleData) {
        this.changeTab("Style");
        this.isChangeStyle = true;
        if(this.currentStyleKey) {
            this.totalSelectedData.styles[this.currentStyleKey] = {key: styleName, name: styleData.name, parent: this.currentStyleName};
            this.findImage();
        } else {
          throw new Error("Incorrect currentStyleKey: " + currentStyleKey);  
        } 
    },
    chooseStyleDetailChildren(styleName, styleData, parentKey, parentName) {
        this.changeTab("Style");
        this.isChangeStyle = true;
        if(this.currentStyleKey) {
            this.totalSelectedData.styles[this.currentStyleKey]['children'][parentKey] = {key: styleName, name: styleData.name, parent: parentName};
            this.findImage();
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
<style>
.fullscreen-container {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999; /* Adjust the z-index as needed */
  width: 100% !important;
  height: 100% !important;
}
</style>
