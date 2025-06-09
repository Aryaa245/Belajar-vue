import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import Categories from '../views/Categories.vue'
import Product from '../views/Product.vue'

const routes = [
  // Redirect root path ke homepage
  { path: '/', redirect: '/homepage' },

  // Rute asli
  { path: '/homepage', name: 'HomePage', component: HomePage },
  { path: '/categories', name: 'Categories', component: Categories },
  { path: '/product', name: 'Product', component: Product }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
