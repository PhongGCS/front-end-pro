<template>
  <div class="slider-location-map">
    <div class="big-image" v-if='listImage[currentIndex]'>
        <img :src="listImage[currentIndex].src" alt="">
    </div>
    <div class="wsu-slider">
      <div v-for="(item, index) in listImage" :key="index" @click.prevent="handleSlideChange(index)">
          <img :class="{'active' : currentIndex == index}" :src="item.thumb" id='' alt="">
          <p :class="{'wsu-slider-name': true, 'active': currentIndex == index }">{{item.title}}</p>
      </div>
    </div>
    <ul class="controls" id="customize-controls" aria-label="Carousel Navigation" tabindex="0">
          <li class="prev" data-controls="prev" aria-controls="customize" tabindex="-1">
              <i class="fas fa-angle-left fa-5x"></i>
          </li>
          <li class="next" data-controls="next" aria-controls="customize" tabindex="-1">
              <i class="fas fa-angle-right fa-5x"></i>          
          </li>
      </ul>
</div>
</template>
<script>
import { tns } from 'tiny-slider/src/tiny-slider'
export default {
  name: 'StoreLocationMap',
  props: {
    listImage: Array
  },
  data() {
        return {
          currentIndex: 0,
          slider: undefined,
          activeBranch: this.listImage[0]
      }
  },
  mounted() {
    const initSlider = new Promise( (resolve, rejext) => {
        setTimeout(() => {
            this.slider = tns({
                container: '.wsu-slider',
                items: 3,
                autoplay: true,
                loop: false,
                gutter: 15,
                slideBy: 1,
                mouseDrag: true,
                controlsPosition: "bottom",
                navPosition: "bottom",
                nav: true,
                animateIn: "scale",
                autoplayButtonOutput: false,
                controlsContainer: '#customize-controls',
                controls: false,
                mode: 'carousel',
                responsive: {
                    640: {
                        items: 3
                    },
                    768: {
                        items: 3
                    },
                    900: {
                        items: 6
                    }
                }
            });
        }, 0);
        
        resolve(this.slider);
    });

    initSlider.then(() => {
        //this.slider.events.on('indexChanged', customizedFunction);
    }) 
    
    let customizedFunction = function (info) {
        document.getElementsByClassName(`wsu-${info.index}`);
        let indexCurrent = info.index;
        for (let item of info.slideItems) {
            item.classList.remove('active');
        }
        info.slideItems[indexCurrent].classList.add('active');
    }
    
  },
  methods: {
    handleSlideChange(index) {
        if (index !== this.currentIndex){
            this.currentIndex = index;
            this.activeBranch = this.listImage[this.currentIndex];
            this.$emit('emitCurrentLocationActive', this.activeBranch);
        }
    },
    sliderRebuild: function() {
        if (this.slider) {
            console.log("slider rebuild");
            setTimeout(() => {
                this.slider.rebuild();
            }, 0);
            this.currentIndex  = 0;
            
        }
    }
  }
}
</script>
