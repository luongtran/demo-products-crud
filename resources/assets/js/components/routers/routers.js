import Vue from 'vue'
import VueRouter from 'vue-router'

import indexProduct from '../../components/products/index.vue'
import dashboard from '../../components/Dashboard.vue'
import addProduct from '../../components/products/add.vue'


Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: dashboard,
            children:[
			{
				path:'',
				redirect:'/products'
			},
			{
				path:'/products',
				component:indexProduct
			},
			{
				path:'/add',
				component:addProduct
			}
		]
        }
    ]
})
