<template>
  <div class="product-detail-pro">
     <section>
    <div class="">
            <div class="md:_flex md:_h-[calc(100vh-49px)]">
                <div class="md:_flex _overflow-y-auto md:_h-[calc(100vh-49px)] md:_mt-0 _mt-10  _h-[calc(90vh-48px)] md:_w-full">
                    <div class="md:_w-4/6 _bg-[#efefef] _cursor-none md:_h-[calc(100vh-49px)] _h-[60vh] _relative _overflow-hidden" id="image-container">
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
                        </div>
                        <div id="hover-icon" class="_hidden _text-white _flex _justify-center _items-center _pt-[3px]">+</div>
                    </div>
                    <div class="md:_w-2/6 md:_h-[calc(100vh-49px)] _flex _flex-col ">
                        <div class="_text-center _flex _justify-between _text-sm _py-2 _transition-transform _duration-300 md:_static _fixed _top-0 _right-0 _left-0  _bg-white">
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
                                <div>
                                    <div v-for="(styleData, styleName) in styles" :key="styleName" @click.prevent="changeStyle(styleData, styleName)">
                                        <StyleComponent :title="styleData.Info.name" :selected="totalSelectedData.styles[styleName]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-size" class="_overflow-y-auto _h-auto tab-size" :class="activeTab === 'Size' ? '_block' : '_hidden'">
                            <div class="_w-[85%] _mx-auto _my-1">
                                <SizeComponent @sizeEmitted="handleSizeEmitted"></SizeComponent>

                            </div>
                        </div>

                        <div id="tab-summary" class="_overflow-y-auto _h-auto tab-summary" :class="activeTab === 'Summary' ? '_block' : '_hidden'">
                            <div>
                                <h3 class="_text-center _font-light _text-xl _text-gray-900 _pt-10 _py-2">Summary</h3>
                            </div>
                            <div class="_w-[85%] _mx-auto _my-1">
                                <StyleComponent v-if="totalSelectedData.keyFabric" title="Fabric" :selected="totalSelectedData.keyFabric" />
                                <StyleComponent v-if="totalSelectedData.size" title="Size" :selected="{ name:totalSelectedData.size}" />
                                <div v-for="(styleData, styleName) in styles" :key="styleName" @click.prevent="changeStyle(styleData, styleName)">
                                    <StyleComponent :title="styleData.Info.name" :selected="totalSelectedData.styles[styleName]" />
                                </div>

                            </div>
                        </div>
                        <div id="tab-styledetail" class="_overflow-y-auto _h-auto tab-style-detail" :class="activeTab === 'StyleDetail' ? '_block' : '_hidden'">
                            <div class="_w-[85%] _mx-auto _my-1">
                            <div v-for="(styleData, styleName ) in styleDataDetail" :key="styleName" @click.prevent="chooseStyleDetail(styleName, styleData)">
                            <StyleDetailComponent :title="styleData.name" :description="styleData.description"/>
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
                                    <button @click.prevent="nextChange()" class="_border md:_px-11 _px-5 md:_py-2.5 _py-2 _text-sm _bg-[#2d2d2c] _text-white _rounded-md _mx-1">Next</button>
                                </div>
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
        mainImages: [],
        totalSelectedData: {
            keyFabric: null,
            styles : {
            },
            size: null
        },
        styleDataDetail: null,
        currentStyleKey : null,
        zoomed: false
    }
  },
  components: {
    FabricComponent,
    TabItemHeading,
    StyleComponent,
    StyleDetailComponent,
    SizeComponent,
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
        if (this.zoomed) {
            // If already zoomed in, switch to minus icon
            hoverIcon.innerHTML = '<p>-</p>';
            gsap.to(mainImage, {
            scale: 1.5, // Zoom in
            duration: 0.3,
            });
        } else {
            // If not zoomed, switch to plus icon
            hoverIcon.innerHTML = '<p>+</p>';
            gsap.to(mainImage, {
            scale: 1, // Zoom out
            duration: 0.3,
            });
        }
        this.zoomed = !this.zoomed; // Toggle the zoom state
    });


  },
dropDown() {
    var dropdownbtn = document.querySelector("#dropdownbtn");
    dropdownbtn.addEventListener("click", function dropdown(){
        var dropdown = document.querySelector("#dropdown");
        if (dropdown.style.display === "none") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    });
    
},
  methods: {
    findImage() {
        const { keyFabric, styles } = this.totalSelectedData;

        const styleKeys = Object.values(styles)
            .map(style => style.key)
            .filter(key => key !== undefined);
        const keysToCompare = [keyFabric.key, ...styleKeys];
        
        const imageList = [];

        for (const key of keysToCompare) {
            if (this.mapping.hasOwnProperty(key)) {
            imageList.push(this.mapping[key]);
            }
        }
        this.mainImages = imageList;
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
      this.findImage();
      
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
<style scoped>

</style>
