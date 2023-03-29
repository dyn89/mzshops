import Vue from 'vue';
import Antd from 'ant-design-vue'
import router from './routes.js'
import store from './store'
import 'ant-design-vue/dist/antd.css'

import VueStorage from 'vue-ls'

import './permission'
import VueParticles from 'vue-particles'

Vue.use(VueParticles)

Vue.use(Antd)
Vue.use(VueStorage)

new Vue({
    router,
    store
}).$mount('#app');