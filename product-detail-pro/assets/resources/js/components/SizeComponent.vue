<template>
    <section>
                        <div>
                            <h3 class="text-center text-2xl font-medium mt-4">Select your Size </h3>
                            <p class="text-center text-gray-500 font-normal text-sm mt-2">Pick the size you usually wear.</p>
                        </div>
                        <div style="grid-template-columns: 28% repeat(3, 110px);" class="grid grid-cols-3 gap-3 px-4 text-center">
                            <div></div>
                            <div>
                                <p class="text-sm text-gray-500 mt-10">Short</p>
                                <p class="text-xs font-light text-gray-400"> &lt; 5.5"</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mt-10">Regular</p>
                                <p class="text-xs font-light text-gray-400">5.5 - 6.1"</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mt-10">Long</p>
                                <p class="text-xs font-light text-gray-400"> > 6.1"</p>
                            </div>
                            <div class="flex items-center">
                                <p class="text-gray-500 font-normal text-sm">XXXS</p>
                            </div>
                            <div></div>
                            <div>
                                <button class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">30</button>
                            </div>
                            <div></div>
                            <div class="flex items-center">
                                <p class="text-gray-500 font-normal text-sm">XXS</p>
                            </div>
                            <div>
                                <button @click="emitNumber(31)" class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">31</button>
                            </div>
                            <div>
                                <button @click="emitNumber(32)" class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">32</button>
                            </div>
                            <div>
                                <button @click="emitNumber(33)" class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">33</button>
                            </div>
                            <div class="flex items-center">
                                <p class="text-gray-500 font-normal text-sm">XS</p>
                            </div>
                            <div>
                                <button @click="emitNumber(34)" class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">34</button>
                            </div>
                            <div>
                                <button @click="emitNumber(35)" class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">35</button>
                            </div>
                            <div>
                                <button @click="emitNumber(36)" class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">36</button>
                            </div>
                            <div class="flex items-center">
                                <p class="text-gray-500 font-normal text-sm">S</p>
                            </div>
                            <div>
                                <button @click="emitNumber(37)"  class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">36</button>
                            </div>
                            <div>
                                <button @click="emitNumber(38)"  class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">37</button>
                            </div>
                            <div>
                                <button @click="emitNumber(39)"  class="border border-gray-300 hover:border-gray-400 text-gray-500 rounded-md px-12 py-2">38</button>
                            </div>

                        </div>
                    </section>
</template>

<script>
export default {
  name: 'SizeComponent',
  props: {
  },
  methods: {
    emitNumber: function (number) {
       this.$emit("sizeEmitted", number);
    }
  }
}
</script> 