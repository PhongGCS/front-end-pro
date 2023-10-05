<template>
  <div class="full-branch-filter-select">
        <input type="hidden" name="branch" v-if="activeBranch" :value="`${activeBranch.name} - ${activeBranch.address}`">
        <div :class="{'cs_select_options': true, 'opened' : tempListBranch.length }" id="full-branch-select">
          <div class="cs-hide_select_option cs_select_option" id="hide-cs_select_option" @click="onCreateOption">
            <OptionSelect :branch="activeBranch" />
            <i class="fa fa-caret-down"></i>
          </div>
          <div class="cs_select_option" v-for="(item, index) in tempListBranch" :key="index" >
            <OptionSelect :branch="item" @emitChangeOption="changeOption" />
          </div>
        </div>
  </div>
</template>

<script>
import OptionSelect from './OptionSelect.vue'
export default {
  name: 'SelectListBranch',
  components: {
    OptionSelect
  },
  props: {
    listBranch: []
  },
  mounted() {
    this.tempListBranch = [];
    this.activeBranch =  this.listBranch[0];
  
  },
  data() {
    return {
      options: null,
      isOpen:false,
      activeBranch: null,
      tempListBranch: []
    }
  },
  methods: {
    onChange : function() {
      //this.$emit("emitCurrentActiveCity",this.activeCity);
    },
    onCreateOption: function () {
      this.tempListBranch = this.listBranch;
    },
    changeOption: function (branch) {
      this.activeBranch = branch;
      this.tempListBranch = [];
    }
  }
}
</script>

<style>

</style>