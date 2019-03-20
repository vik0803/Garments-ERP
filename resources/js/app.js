require('./bootstrap');

window.Vue = require('vue');
Vue.config.productionTip = false;

import VueRouter from 'vue-router';

Vue.use(VueRouter);

let Users =require('./components/Users.vue').default;
let Purchase =require('./components/Purchase.vue').default;
let Quotation =require('./components/Quotation.vue').default ;
let Gate =require('./components/Gate.vue').default;
let Yarn =require('./components/Yarn.vue').default;
let Grey =require('./components/Grey.vue').default;
let Finish =require('./components/Finish.vue').default;

const routes = [
  { path: '/users', component: Users},
  { path: '/purchase-requisition', component: Purchase },
  { path: '/quotation-evaluation', component: Quotation },
  { path: '/gate-entry', component: Gate },
  { path: '/yarn-store', component: Yarn },
  { path: '/grey-fabric-store', component: Grey },
  { path: '/finish-fabric-store', component: Finish }
]
const router = new VueRouter({
  mode: 'history',
  routes
})

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


 const app = new Vue({
     el: '#app',
     router
 });
