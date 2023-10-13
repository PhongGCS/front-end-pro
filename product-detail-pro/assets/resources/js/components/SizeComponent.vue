<template>
    <section>
                        <div>
                            <h3 class="_text-center _text-2xl _font-medium _mt-4">Select your Size </h3>
                            <p class="_text-center _text-gray-500 _font-normal _text-sm _mt-2">Pick the size you usually wear.</p>
                        </div>
                        <div style="grid-template-columns: 28% repeat(3, 110px);" class="_grid _grid-cols-3 _gap-3 _px-4 _text-center">
                            <div></div>
                            <div>
                                <p class="_text-sm _text-gray-500 _mt-10">Short</p>
                                <p class="_text-xs _font-light _text-gray-400"> &lt; 5.5"</p>
                            </div>
                            <div>
                                <p class="_text-sm _text-gray-500 _mt-10">Regular</p>
                                <p class="_text-xs _font-light _text-gray-400">5.5 - 6.1"</p>
                            </div>
                            <div>
                                <p class="_text-sm _text-gray-500 _mt-10">Long</p>
                                <p class="_text-xs _font-light _text-gray-400"> > 6.1"</p>
                            </div>
                            <div class="_flex _items-center">
                                <p class="_text-gray-500 _font-normal _text-sm">XXXS</p>
                            </div>
                            <div></div>
                            <div>
                                <div class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">30</div>
                            </div>
                            <div></div>
                            <div class="_flex _items-center">
                                <p class="_text-gray-500 _font-normal _text-sm">XXS</p>
                            </div>
                            <div>
                                <div @click="emitNumber(31)" class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">31</div>
                            </div>
                            <div>
                                <div @click="emitNumber(32)" class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">32</div>
                            </div>
                            <div>
                                <div @click="emitNumber(33)" class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">33</div>
                            </div>
                            <div class="_flex _items-center">
                                <p class="_text-gray-500 _font-normal _text-sm">XS</p>
                            </div>
                            <div>
                                <div @click="emitNumber(34)" class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">34</div>
                            </div>
                            <div>
                                <div @click="emitNumber(35)" class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">35</div>
                            </div>
                            <div>
                                <div @click="emitNumber(36)" class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">36</div>
                            </div>
                            <div class="_flex _items-center">
                                <p class="_text-gray-500 _font-normal _text-sm">S</p>
                            </div>
                            <div>
                                <div @click="emitNumber(37)"  class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">36</div>
                            </div>
                            <div>
                                <div @click="emitNumber(38)"  class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">37</div>
                            </div>
                            <div>
                                <div @click="emitNumber(39)"  class="_border _border-gray-300 hover:_border-gray-400 _text-gray-500 _rounded-md _px-12 _py-2">38</div>
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