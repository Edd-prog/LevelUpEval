import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
//import Vue from 'vue'
import Toaster from '@meforma/vue-toaster'
//import { BootstrapVue } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const app = createApp(App)

app.use(router)

app.use(Toaster, {
  // Global/Default options
  position: 'top',
  timeout: 3000,
  pauseOnHover: true
})

//Vue.use(BootstrapVue)

app.provide('toast', app.config.globalProperties.$toast)

app.mount('#app')
