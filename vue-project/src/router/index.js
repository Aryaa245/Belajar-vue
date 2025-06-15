import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import Categories from '../views/Categories.vue'
import Product from '../views/Product.vue'
import Business from '../views/Business.vue'
import Workstastion from '../views/Workstastion.vue'
import ProductDetail from '@/views/ProductDetail.vue'
import Students from '@/views/Students.vue'
import VideoEditing from '@/views/VideoEditing.vue'

const routes = [
  // Redirect root path ke homepage
  { path: '/', redirect: '/homepage' },

  // Rute asli
  { path: '/homepage', name: 'HomePage', component: HomePage },
  { path: '/categories', name: 'Categories', component: Categories },
  { path: '/products', name: 'Product', component: Product },
  { path: '/business', name: 'Business', component: Business },
  { path: '/workstastion', name: 'Workstastion', component: Workstastion },
  { path: '/product/:id', name: 'ProductDetail', component: ProductDetail },
  { path: '/students', name: 'Students', component: Students},
  { path: '/videoediting', name: 'VideoEditing', component: VideoEditing}

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
