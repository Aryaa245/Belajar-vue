<template>
  <div id="app">
    <AppHeader />
    <main class="main-content">
      <router-view />
    </main>
    <!-- <router-link to="/categories">Categories</router-link>
    <router-view></router-view> tempat tampilan komponen -->
    <AppFooter />
  </div>
</template>

<script>
import AppHeader from '@/components/Header.vue'
import AppFooter from '@/components/Footer.vue'
export default {
  name: 'App',
  components: {
    AppHeader,
    AppFooter
  }
}

</script>



