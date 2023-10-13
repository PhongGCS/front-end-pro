<template>
  <div class="product-detail-pro">
    <header>
    <div class="flex items-center py-2 w-full">
        <button class="my-auto ml-3 w-1/3 ">
            <div class="w-[20px] m-1.5 h-[1.5px] bg-gray-700"></div>
            <div class="w-[20px] m-1.5 h-[1.5px] bg-gray-700"></div>
        </button>
        <div class=" w-1/3 flex justify-center">
            <p class="text-xl font-medium text-black-300">SUITSUPLLY</p>
        </div>
        <div class="my-auto flex justify-end items-center w-1/3 mr-3">
            <div class="m-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="gray" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                </svg>
            </div>
            <div class="m-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" fill="gray" class="bi bi-bookmark" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                </svg>
            </div>
            <div class="m-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="gray" class="bi bi-bag" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                </svg>
            </div>
        </div>
    </div>

    </header> 
     <section>
    <div class="">
            <div class="md:flex md:h-[calc(100vh-49px)]">
                <div class="md:flex overflow-y-auto md:h-[calc(100vh-49px)] md:mt-0 mt-10  h-[calc(90vh-48px)] md:w-full">
                    <div class="md:w-4/6 bg-[#efefef] cursor-none md:h-[calc(100vh-49px)] h-[60vh] relative overflow-hidden" id="image-container">
                        <div id="main-image">
                            <img
                                v-for="(image, index) in mainImages"
                                :key="index"
                                :src="image"
                                :class="'image-' + index + ' absolute cursor-none inset-0 opacity-100 transition-opacity  ease-in-out duration-500'"
                                :style="{ zIndex: index }"
                                class="md:h-[90vh] h-[60vh] pt-4 mx-auto"
                                alt=""
                            />
                        </div>
                        <div id="hover-icon" class="hidden text-white flex justify-center items-center pt-[3px]">+</div>
                    </div>
                    <div class="md:w-2/6 md:h-[calc(100vh-49px)] flex flex-col ">
                        <div class="text-center flex justify-between text-sm py-2 transition-transform duration-300 md:static fixed top-0 right-0 left-0  bg-white">
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
                                <h3 class="text-center font-light text-xl text-gray-900 pt-8 py-2">Select your fabric</h3>
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
                    
                        <div class="mt-auto border-t py-4 md:static fixed bottom-0 bg-white w-full">
                            <div class="flex justify-between items-center w-[85%] mx-auto mt-auto md:pb-0 pb-4">
                                <div>
                                    <p class="text-xs text-gray-400"> {{productData.Delivery}}</p>
                                    <h3 class="text-sm text-gray-800 font-light">{{productData.ProductName}} - {{productData.Price}}</h3>
                                </div>
                                <div class="flex">
                                    <button @click.prevent="prevChange()" class="border md:px-11 px-5 md:py-2.5 py-2 text-sm rounded-md mx-1">Prev</button>
                                    <button @click.prevent="nextChange()" class="border md:px-11 px-5 md:py-2.5 py-2 text-sm bg-[#2d2d2c] text-white rounded-md mx-1">Next</button>
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
