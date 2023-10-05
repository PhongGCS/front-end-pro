<template>
  <div class="district-filter-input cs_custom_select">
        <label for="">Quận / Huyện</label>
        <div :class="{'cs_options': true, 'opened' : isOpen }" id="cs_options_district">
          <div class="cs-hide_option cs_option" id="hide-cs_option">Chọn quận/huyện</div>
        </div>
  </div>
</template>

<script>
export default {
  name: 'DistrictFilterInput',
  props: {
    listDistrict: []
  },
  mounted() {
    this.activeDistrict = "";
    this.buildOption();
  },
  data() {
    return {
      options: null,
      isOpen:false,
      activeCity: null
    }
  },
  methods: {
    onChange : function() {
      this.$emit("emitCurrentActiveDistrict",this.activeDistrict);
    },
        buildOption : function () {
      //debugger;
        this.options = document.getElementById("cs_options_district");
        this.options.addEventListener("click", (e) => {
          this.addToUIOptions(e);
        });
    },
    addToUIOptions : function(e) {
      if (e.target.classList.contains("hide-cs_option")) {
          controlOptions(e);
      } else {
          const pickedOption = e.target;
          this.activeDistrict = pickedOption.textContent;
          this.onChange();
          if (this.options.firstElementChild.classList.contains("hide-cs_option")) {
              this.options.removeChild(this.options.firstElementChild);
          }
          this.options.insertAdjacentElement("afterbegin", pickedOption);

          this.deleteOptions();
          this.controlOptions(e);
      }
    },
    controlOptions : function(e) {
      if (this.isOpen === false) {
          this.createOptions();
          this.isOpen = true;
      } else {
          this.deleteOptions();
          this.isOpen = false;
      }
    },
    deleteOptions : function() {
      while (this.options.childElementCount > 1) {
          this.options.removeChild(this.options.lastElementChild);
      }
    },
    createOptions : function() {
      this.listDistrict.forEach(element => {
          if (this.options.firstElementChild.textContent !== element) {
              let option = document.createElement("div");
              option.className = "cs_option";
              option.textContent = element;
              this.options.firstElementChild.insertAdjacentElement("afterend", option);
          }
      });
    }
  } 
}
</script>
