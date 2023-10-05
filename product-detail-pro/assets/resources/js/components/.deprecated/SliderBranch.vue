<template>
  <div class="slider_branch">
    <h3 class="cs-title-branch">Hệ thống chi nhánh:</h3>
    <div class="cs-filter-list-branch">
      <CityFilterInput @emitCurrentActiveCity="currentActiveCity" :listCity="listCity"/>
      <DistrictFilterInput @emitCurrentActiveDistrict="currentActiveDistrict" :listDistrict="listDistrict" :key="districtComponentKey" />
    </div>
    <div class="cs-store-location-map">
      <StoreLocationMap :activeBranch="activeBranch" :key="sliderComponentKey" />
    </div>
    <div class="cs-slider-location" >
      <LocationSlider :key="sliderLocationKey" ref="childSliderComponent" @emitCurrentLocationActive="currentLocationActive" :listImage="listImage">
      </LocationSlider>
    </div>
  </div>
</template>

<script>
import CityFilterInput from './CityFilterInput.vue'
import DistrictFilterInput from './DistrictFilterInput.vue'
import StoreLocationMap from './StoreLocationMap.vue'
import LocationSlider from './LocationSlider.vue'
export default {
  name: 'SliderBranch',
  props: {
    listBranchData: []
  },
  data() {
    return {
      activeBranch: null,
      listImage: [],
      listCity: [],
      listDistrict: [],
      activeCity: null,
      activeDistrict: null,
      districtComponentKey: 0,
      sliderComponentKey: 0,
      cityComponentKey: 0,
      sliderLocationKey: 0,
      isFirstInitSlider: true,
    }
  },
  components: {
    CityFilterInput,
    DistrictFilterInput,
    StoreLocationMap,
    LocationSlider
  },
  beforeMount() {
    this.listCity = this.listBranchData.map(e => {
      return e.city
    });
    
    this.activeCity = this.listBranchData[0].city;
    this.mapListDisctrict()
    //console.log(this.listImage)
    //this.currentLocationActive(this.listImage[0]);
    
  },
  mounted() {

  },
  methods: {
    currentActiveDistrict: function (activeDistrict) {
      if(activeDistrict === 'Chọn quận/huyện') return;
      if(activeDistrict !== this.activeDistrict) {
        console.log("ACTIVE_DISTRICT");
        this.activeDistrict = activeDistrict;
        this.mapImageByCityAndDistrict();
      }
    },
    currentLocationActive: function (activeBranch) {
      console.log("ACTIVE_BRANCH");
      this.activeBranch = activeBranch;
    },
    currentActiveCity: function (activeCity) {
      if(activeCity != this.activeCity) {
        console.log("ACTIVE_CITY");
        this.activeCity = activeCity;
        this.mapListDisctrict();
      }
    },
    mapListDisctrict: function () {
      //console.log("mapListDisctrict")
      // Filter to get list disctrit
      let disctrit = this.listBranchData.filter(e => {
          return e.city === this.activeCity;
      }).map(e => {
          return e.district
      });
      if(disctrit) {
        this.listDistrict = Object.keys(disctrit[0]);
        //rebuild district component
        this.forceRerender();
        // Filter to get list all slide
        this.mapImageByCity(disctrit[0]);
      } else {
        console.log("LIST_DISCTRICT_NOT_FOUND");
      }
      
    },
    mapImageByCity: function (disctrits) {
      let lastDisctritsImage = [];
      for (var key in disctrits) {
        let obj = disctrits[key];
        lastDisctritsImage = lastDisctritsImage.concat(obj)
      }
      //console.log("mapImageByCity")
      this.listImage = lastDisctritsImage
      this.currentLocationActive(this.listImage[0]);
      setTimeout(() => {
        this.forceRerenderSlider();
      }, 100);
      
      
    },
    mapImageByCityAndDistrict: function async () {
      //console.log("Map new listImage")
      // this.listImage = this.listBranchData.filter(e => {
      //     return e.city === this.activeCity;
      // }).map(e => {
      //     return e.district[this.activeDistrict]
      // })[0];
      // if(this.listImage) {
      //   this.currentLocationActive(this.listImage[0]);
      // }
      let promise1 =  new Promise((resolve, reject) => {
        this.listImage = this.listBranchData.filter(e => {
          return e.city === this.activeCity;
        }).map(e => {
            return e.district[this.activeDistrict]
        })[0];
        resolve(this.listImage);
      });

      let promise2 =  new Promise((resolve, reject) => {
        this.currentLocationActive(this.listImage[0]);
      })

      let promise3 =  new Promise((resolve, reject) => {
        this.forceRerenderSlider();
      })
      promise1.then(promise2).then(promise3);
      //console.log("Rebuild Slider")
      
    },
    forceRerender: function () {
      this.districtComponentKey++;  
    },
    forceRerenderSlider: function () {
      this.sliderComponentKey++;  
      this.sliderLocationKey++;
    },
    sliderRebuild: function () {
      this.sliderLocationKey++;
      // if(!this.isFirstInitSlider) {
      //   this.$refs.childSliderComponent.sliderRebuild();
      // } else {
      //   this.isFirstInitSlider = false;
      // }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
