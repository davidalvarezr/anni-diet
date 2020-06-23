/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('bootstrap') // need for the dropdown menu to logout

import axios from 'axios'

import { BootstrapVue, IconsPlugin } from "bootstrap-vue"
import Vue from 'vue'
import MainMenu from "./components/MainMenu"
import WebSocketEmitter from "./components/WebSocketEmitter"
import WebSockerReceiver from "./components/WebSockerReceiver"

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-menu', MainMenu);
Vue.component('web-socket-emitter', WebSocketEmitter);
Vue.component('web-socket-receiver', WebSockerReceiver)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.prototype.$appName = 'Anni Diet'
axios.defaults.headers.common = {
    'Authorization': `Bearer ${localStorage.access_token}`,
    'Accept': 'application/json',
}
Vue.prototype.$axios = axios

const app = new Vue({
    el: '#app',
})

// console.log("app.js loaded")
// console.log(`access token is ${localStorage.access_token}`)

