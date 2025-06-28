<template>
  <header>
    <!-- Tombol buka sidebar (pakai Vue method, BUKAN data-bs-toggle) -->
    <button class="btn list" type="button" @click="openOffcanvas">
      <i class="bi bi-list fs-4"></i>
    </button>

  <div class="offcanvas offcanvas-start" 
     data-bs-scroll="true" 
     tabindex="-1" 
     id="offcanvasWithBothOptions"
     aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
          <div class="logo-container">
            <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img" />
            <span class="logo-text">Technologia</span>
          </div>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="menu-tabs">
        <div class="menu-tab active" @click="setTab('menu')">Menu</div>
        <div class="menu-tab" @click="setTab('categories')">Categories</div>
      </div>

      <div class="menu-list" id="menuTab">
        <router-link to="/HomePage" class="menu-item" @click="closeOffcanvas">Home</router-link>

        <div class="menu-item" @click="toggleSubmenu('about')">Member Profil<span>+</span></div>
        <div class="submenu" v-show="activeSubmenu === 'about'">
          <div class="submenu-item" @click="goToProfile('danu')">Rifky Danu Asmoro</div>
          <div class="submenu-item" @click="goToProfile('baskara')">I Mada Baskara Saccid Ananda</div>
          <div class="submenu-item" @click="goToProfile('vianda')">Vianda Retnaningtiyas Purabandari Karetji</div>
          <div class="submenu-item" @click="goToProfile('farhan')">Farhan Ardiansyah</div>
          <div class="submenu-item" @click="goToProfile('arya')">Stefanus Arya Bayu Samudra Batona</div>
        </div>

        <router-link to="/contact" class="menu-item" @click="closeOffcanvas">About Us</router-link>
      </div>

      <div class="menu-list" id="categoriesTab" style="display: none;">
        <router-link to="/Workstastion" class="menu-item" @click="closeOffcanvas">Workstation</router-link>
        <router-link to="/Business" class="menu-item" @click="closeOffcanvas">Business</router-link>
        <router-link to="/Categories" class="menu-item" @click="closeOffcanvas">Gaming</router-link>
        <router-link to="/VideoEditing" class="menu-item" @click="closeOffcanvas">Video Editing</router-link>
        <router-link to="/Students" class="menu-item" @click="closeOffcanvas">Students</router-link>
      </div>
    </div>

    <div class="logo-container">
      <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img" />
      <span class="logo-text">Technologia</span>
    </div>

    <div class="search-container">
      <i class="bi bi-search"></i>
      <input type="text" class="search" placeholder="Search" id="searchInput" />
    </div>

    <div class="navbare">
      <nav>
        <ul>
          <li><router-link to="/HomePage#carouselExample">Home</router-link></li>
          <li><router-link to="/HomePage#about-us">About</router-link></li>
          <li><router-link to="/HomePage#categories">Category</router-link></li>
          <li><router-link to="/HomePage#all-products">Products</router-link></li>
          <li><router-link to="/HomePage#contact">Contact</router-link></li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AppHeader',
  data() {
    return {
      activeSubmenu: null,
      offcanvasInstance: null
    };
  },
  mounted() {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', () => {
      const query = searchInput.value.trim().toLowerCase();
      const productTitles = document.querySelectorAll('.product-title');
      let found = false;

      productTitles.forEach(title => {
        title.classList.remove('highlight');
        if (query && title.textContent.toLowerCase().includes(query)) {
          if (!found) {
            title.scrollIntoView({ behavior: 'smooth', block: 'center' });
            found = true;
          }
          title.classList.add('highlight');
        }
      });
    });

    window.addEventListener('scroll', function () {
      const header = document.querySelector('header');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Inisialisasi offcanvas instance
    const el = document.getElementById('offcanvasWithBothOptions');
    this.offcanvasInstance = new bootstrap.Offcanvas(el);
  },
  methods: {
    setTab(tab) {
      const menuTab = document.getElementById('menuTab');
      const categoriesTab = document.getElementById('categoriesTab');

      document.querySelectorAll('.menu-tab').forEach(el => el.classList.remove('active'));

      if (tab === 'menu') {
        menuTab.style.display = '';
        categoriesTab.style.display = 'none';
        document.querySelector('.menu-tab:nth-child(1)').classList.add('active');
      } else {
        menuTab.style.display = 'none';
        categoriesTab.style.display = '';
        document.querySelector('.menu-tab:nth-child(2)').classList.add('active');
      }
    },

    toggleSubmenu(menu) {
      this.activeSubmenu = this.activeSubmenu === menu ? null : menu;
    },

    goToProfile(name) {
      this.$router.push(`/Profil_${name}`);
      this.$nextTick(() => {
        this.closeOffcanvas();
      });
    },

    openOffcanvas() {
      if (this.offcanvasInstance) {
        this.offcanvasInstance.show();
      }
    },

    closeOffcanvas() {
      if (this.offcanvasInstance) {
        this.offcanvasInstance.hide();
      }
    }
  }
};
</script>

<style>
.product-title.highlight {
  background-color: yellow;
  padding: 5px;
  border-radius: 4px;
}
</style>

<style scoped>
.submenu {
  padding-left: 20px;
  display: flex;
  flex-direction: column;
}

.submenu-item {
  cursor: pointer;
  padding: 6px 15px;
}
</style>
