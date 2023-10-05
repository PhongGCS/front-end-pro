require('./bootstrap');


window.Vue = require("vue").default;

Vue.component('product-detail-pro', require('./components/ProductDetailPro.vue').default);

const app = new Vue(Vue.util.extend()).$mount('#app');
