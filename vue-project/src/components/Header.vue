<template>
  <header>
    <button class="btn list" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" 
    aria-controls="offcanvasWithBothOptions"><i class="bi bi-list fs-4"></i></button>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"> 
          <div class="logo-container">
            <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img">
            <span class="logo-text">Technologia</span>
          </div>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="menu-tabs">
        <div class="menu-tab active" @click="setTab('menu')">Menu</div>
        <div class="menu-tab" @click="setTab('categories')">Categories</div>
      </div>

      <!-- Menu Burger -->
      <div class="menu-list" id="menuTab">
        <a href="HomePage" class="menu-item">Home</a>
        <div class="menu-item">About Us</div>
        <div class="menu-item" onclick="toggleSubmenu('laptopkita')">Technologia<span>+</span></div>
        <div class="submenu" id="submenu-laptopkita">
          <div>- Lenovo</div>
          <div>- MacBook</div>
          <div>- DELL</div>
          <div>- MSI</div>
          <div>- HP</div>
        </div>
        <div class="menu-item highlight">Our Marketplace</div>
        <div class="menu-item">Update</div>
        <div class="menu-item">Pricelist</div>
        <div class="menu-item">All Promo</div>
        <div class="menu-item" onclick="toggleSubmenu('info')">More Info <span>+</span></div>
        <div class="submenu" id="submenu-info">
          <div>- FAQ</div>
          <div>- Contact</div>
        </div>
      </div>

      

      <!-- Kategori Baru -->
      <div class="menu-list" id="categoriesTab" style="display: none;">
        <a  href="Workstastion" class="menu-item">Workstation</a>
        <a href="Business" class="menu-item">Business</a>
        <a href="Categories" class="menu-item">Gaming</a>
        <a href="ViedoEditing" class="menu-item">Video Editing</a>
        <a href="Students" class="menu-item">Students</a>
      </div>
    </div>

    <div class="logo-container">
      <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img">
      <span class="logo-text">Technologia</span>
    </div>
    <div class="search-container">
      <i class="bi bi-search"></i>
      <input type="text" class="search" placeholder="Search" id="searchInput" onkeyup="filterMenu()"/>
    </div>
    <div class="navbare">
      <nav>
        <ul>
          <li><a href="../HomePage#carouselExample">Home</a></li>
          <li><a href="../HomePage#about-us">About</a></li>
          <li><a href="../HomePage#categories">Category</a></li>
          <li><a href="../HomePage#all-products">Products</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AppHeader',
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
    }
  }
};

window.addEventListener('scroll', function () {
  const header = document.querySelector('header');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

function filterMenu() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const items = document.querySelectorAll('#menuTab .menu-item');

  items.forEach(item => {
    const text = item.textContent.toLowerCase();
    item.style.display = text.includes(filter) ? '' : 'none';
  });
}
</script>

<style>
.product-title.highlight {
  background-color: yellow;
  padding: 5px;
  border-radius: 4px;
}
</style>