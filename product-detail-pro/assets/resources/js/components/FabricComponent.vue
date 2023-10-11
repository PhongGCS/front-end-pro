<template>
    <div class=" group w-full border pt-1.5 rounded-md focus:border-black hover:border-gray-300 my-2">
        <div class=" mx-auto flex justify-center relative">
            <img class="h-[90px] w-[97%] rounded-md" :src="imageUrl" alt="">
            <div class="absolute hidden group-hover:block group-focus:block  top-2 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </svg>
            </div>
        </div>
        <div class="flex justify-between px-4 py-2 text-sm ">
            <h3 class=" group-focus:font-medium ">{{title}}</h3>
            <h3 v-if="price"><span class=" group-focus:font-medium ">${{price}}</span> USD</h3>
        </div>
    </div>
</template>

<script>
export default {
  name: 'FabricComponent',
  props: {
    imageUrl: String,
    title: String,
    price: Number
  },
  methods: {
    emitChangeOption: function (e) {
    //   this.$emit("emitChangeOption", this.branch);
    }
  }
}
</script>