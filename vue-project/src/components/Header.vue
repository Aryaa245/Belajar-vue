<template>
    <header>
      <button class="btn list" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" 
      aria-controls="offcanvasWithBothOptions"><i class="bi bi-list fs-4"></i></button>

      <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"> <div class="logo-container">
            <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img">
            <span class="logo-text">Technologia</span>
          </div></h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
          <div class="menu-tabs">
            <div class="menu-tab active" onclick="setTab('menu')">Menu</div>
            <div class="menu-tab" onclick="setTab('categories')">Categories</div>
          </div>
        <!-- Menu Burger -->
          <div class="menu-list" id="menuTab">
            <div class="menu-item">Home</div>
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
        
          <div class="menu-list" id="categoriesTab" style="display: none;">
            <div class="menu-item">Laptop</div>
            <div class="menu-item">Accessories</div>
            <div class="menu-item">Networking</div>
          </div>
        </div>

        <div class="logo-container">
          <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img">
          <span class="logo-text">Technologia</span>
        </div>
      <div class="search-container">
        <i class="bi bi-search"></i>
        <input type="text" class="search" placeholder="Search"/>
      </div>
      <div class="navbare">
        <nav>
          <ul>
            <li><a href="HomePage#carouselExample">Home</a></li>
            <li><a href="HomePage#about-us">About</a></li>
            <li><a href="HomePage#categories">Category</a></li>
            <li><a href="#all-products">Products</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </nav>
      </div>
    </header>
</template>

<script>
  export default {
    name: 'AppHeader'
  }

  window.addEventListener('scroll', function () {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {  // jika scroll lebih dari 50px
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
  
</script>