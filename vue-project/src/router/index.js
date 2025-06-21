import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import Categories from '../views/Categories.vue'
import Product from '../views/Product.vue'
import Business from '../views/Business.vue'
import Workstastion from '../views/Workstastion.vue'
import ProductDetail from '@/views/ProductDetail.vue'
import Students from '@/views/Students.vue'
import VideoEditing from '@/views/VideoEditing.vue'
import Profil_danu from '../views/Profil_danu.vue'
import Profil_baskara from '../views/Profil_baskara.vue'
import Profil_vianda from '../views/Profil_vianda.vue'
import Profil_farhan from '../views/Profil_farhan.vue'
import Profil_arya from '../views/Profil_arya.vue'

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
  { path: '/videoediting', name: 'VideoEditing', component: VideoEditing},
  { path: '/profil_danu', name: 'Profil_danu', component: Profil_danu},
  { path: '/profil_baskara', name: 'Profil_baskara', component: Profil_baskara},
  { path: '/profil_vianda', name: 'Profil_vianda', component: Profil_vianda},
  { path: '/profil_farhan', name: 'Profil_farhan', component: Profil_farhan},
  { path: '/profil_arya', name: 'Profil_arya', component: Profil_arya}

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router