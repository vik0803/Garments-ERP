require('./bootstrap');

window.Vue = require('vue');
Vue.config.productionTip = false;

import moment from 'moment';
import gate from './Gate';
Vue.prototype.$gate=new gate(window.user);
import VueProgressBar from 'vue-progressbar';
import Swal from 'sweetalert2';
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

Vue.filter('upText',function (text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
});
// For Momentjs
Vue.filter('myDate',function (created) {
  return moment(created).format('MMMM Do YYYY');
});

// For Vue-Progress-Bar
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
});

// For sweetalert2
window.Swal=Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.Toast=Toast;

window.Fire=new Vue();


const router = new VueRouter({
  mode: 'history',
  routes
})

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


 const app = new Vue({
     el: '#app',
     router
 });
