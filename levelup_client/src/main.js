import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import Toaster from '@meforma/vue-toaster'

const app = createApp(App)

app.use(router)

app.use(Toaster, {
  // Global/Default options
  position: 'top',
  timeout: 3000,
  pauseOnHover: true
})

app.provide('toast', app.config.globalProperties.$toast)

app.mount('#app')
