import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/css/style.css'
import './assets/css/header.css'
import './assets/css/dashboard.css'

createApp(App).use(store).use(router).mount('#app')
