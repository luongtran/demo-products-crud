import Vue from 'vue'
import VueRouter from 'vue-router'

import indexProduct from '../components/products/index.vue'


Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: indexProduct
        }
    ]
})
