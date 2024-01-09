// resources/js/app.js
require('./bootstrap');

import Vue from 'vue';

Vue.component('taldea-component', require('./components/TaldeaComponent.html').default);

const app = new Vue({
    el: '#app',
});