import { createApp } from 'vue'
import App from './App.vue'
import router from './routes'
import './assets/main.css'
import Bootstrap from 'bootstrap/dist/js/bootstrap.js'
import 'bootstrap/dist/css/bootstrap.css'
import '@fortawesome/fontawesome-free/css/all.css';

createApp(App).use(router, Bootstrap).mount('#app')
