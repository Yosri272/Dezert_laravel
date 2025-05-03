require('./bootstrap');
import '../css/app.css'; // ✅ أضف هذا السطر لتفعيل CSS

window.Vue = require('vue');

Vue.component('signup-form', require('./components/SignupForm.vue').default);

const app = new Vue({
    el: '#app',
});




