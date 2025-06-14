import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import Categories from '../views/Categories.vue'
import Product from '../views/Product.vue'
import ProductDetail from '@/views/ProductDetail.vue'

const routes = [
  // Redirect root path ke homepage
  { path: '/', redirect: '/homepage' },

  // Rute asli
  { path: '/homepage', name: 'HomePage', component: HomePage },
  { path: '/categories', name: 'Categories', component: Categories },
  { path: '/products', name: 'Product', component: Product },
  { path: '/product/:id', name: 'ProductDetail', component: ProductDetail }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
