/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('./script');

window.Vue = require('vue');

// import Vuetify from '../plugins/vuetify';
import store from './store';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-container', require('./components/AppContainer.vue').default);

Vue.component('FollowButton', require('./components/FollowButton.vue').default);
Vue.component('LikeButton', require('./components/LikeButton.vue').default);
Vue.component('Comment', require('./components/Comment.vue').default);
Vue.component('ValidationErrors', require('./components/ValidationErrors.vue').default);


// Pages
Vue.component('Index', require('./components/Pages/Index.vue').default);
Vue.component('Post', require('./components/Pages/Post.vue').default);

Vue.component('LoginForm', require('./components/Auth/LoginForm.vue').default);
Vue.component('RegisterForm', require('./components/Auth/RegisterForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    // vuetify: Vuetify,
    el: '#app',
    store,
});
