<template>
  <body>
    <!-- slider -->
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/Lenovo LEGION 2.mp4" type="video/mp4" />
              <source src="../assets/video/Lenovo LEGION 2.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>

        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/Acer.mp4" type="video/mp4" />
              <source src="../assets/video/Acer.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>
        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/Macbook.mp4" type="video/mp4" />
              <source src="../assets/video/Macbook.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>
        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/MSI.mp4" type="video/mp4" />
              <source src="../assets/video/MSI.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span></button
      >         
    </div>

    <div class="header-center" id="about-us">
      <h2 class="reveal" style="padding-top: 8rem">About Us.</h2>
    </div>

    <section class="products" id="products" style="padding-top: 7rem">
      <div class="left-top">
        <div class="product reveal">
          <img src="../assets/Images/LENOVO.png" alt="Lenovo LEGION" />
          <h2><strong>About Us</strong></h2>
          <p>
            Selamat datang di Technologia, sumber terpercaya Anda untuk segala hal tentang laptop! Kami hadir untuk membantu Anda memahami dunia teknologi yang terus berkembang, khususnya dalam hal perangkat laptop. Di sini, Anda akan
            menemukan review mendalam, perbandingan produk, panduan pembelian, hingga tips dan trik yang berguna untuk menunjang produktivitas dan pengalaman komputasi Anda.
          </p>
        </div>
        <div class="product reveal">
          <img src="../assets/Images/Lenovo LEGION.png" alt="Apple AirPods Max" />
          <h2><strong>Our Team</strong></h2>
          <p>
            Tim kami terdiri dari para penggemar teknologi dan profesional IT yang berdedikasi untuk memberikan informasi yang akurat, terbaru, dan mudah dipahami. Kami percaya bahwa memilih laptop yang tepat bukan sekadar soal spesifikasi
            tinggi, tetapi juga soal kebutuhan dan kenyamanan pengguna.
          </p>
        </div>
      </div>
      <div class="left-bottom">
        <div class="product reveal">
          <img src="../assets/Images/Popular Product.png" alt="Apple Vision Pro" />
          <h2><strong>Basis Of Formation</strong></h2>
          <p>
            Pembuatan Website ini di dasarkan untuk menyelesaikan tugas project Mata Kuliah Pemrograman Web dengan menerapkan HTML,CSS,dan JavaScript kedalamnya. Dengan tujuan membuat sebuah website yang ditujukan kepada
            pelajar/mahasiswa/pekerja untuk mendapatkan sebuah informasi mengenai laptop.
          </p>
        </div>
      </div>
      <div class="right-large">
        <div class="product right-content reveal">
          <img src="../assets/Images/Asus Zenbook 14.png" alt="ZENBOOK" />
          <h2><strong>Vision and Mission</strong></h2>
          <p>
            Tujuan kami adalah menjadi panduan Anda dalam menjelajahi berbagai pilihan laptop yang tersedia di pasaran — mulai dari perangkat untuk pelajar, pekerja profesional, hingga gamer. Kami ingin memastikan Anda membuat keputusan
            yang tepat dan cerdas sebelum membeli.
          </p>
          <h5 style="margin-top: 2rem"><strong>Terima kasih telah mengunjungi website kami. Mari jelajahi teknologi bersama!</strong></h5>
        </div>
      </div>
    </section>

    <section class="categories" id="categories">
      <div class="header-center">
        <h2 class="reveal">Browse By Category</h2>
      </div>
      <div class="category-list">
        <div class="reveal">
          <a href="Workstastion" class="category-item">
            <div class="icon">🖥️</div>
            <span>Workstation</span>
          </a>
        </div>
        <div class="reveal">
          <a href="Business" class="category-item">
            <div class="icon">💼</div>
            <span>Business</span>
          </a>
        </div>
        <div class="reveal">
          <a href="Categories" class="category-item">
            <div class="icon">🎮</div>
            <span>Gaming</span>
          </a>
        </div>
        <div class="reveal">
          <a href="VideoEditing" class="category-item">
            <div class="icon">🎞️</div>
            <span>Video Editing</span>
          </a>
        </div>
        <div class="reveal">
          <a href="Students" class="category-item">
            <div class="icon">🎓</div>
            <span>Students</span>
          </a>
        </div>
      </div>
    </section>
    <!-- Navbar Product -->

    <nav class="navbar navbar-expand-lg gi">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item nav-underline" id="#NewArriv">
              <a class="nav-link active" aria-current="page" href="#NewArriv" data-tab="newArival-tab">New Arrival</a>
            </li>
            <li class="nav-item nav-underline">
              <a class="nav-link" href="#" data-tab="BestSeller-tab">Best Seller</a>
            </li>
            <li class="nav-item nav-underline">
              <a class="nav-link" href="#" data-tab="OnSale-tab">On Sale</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- New Arrival -->
    <div class="tab-content-container">
      <div class="tab-content active" id="newArival-tab">
        <!-- <div> -->
        <!-- Section: New Arrival -->
        <!-- <section class="categories" id="categories"> -->
        <div class="product-grid" id="all-products">
          <div class="product-card discount" v-for="(product, index) in products" :key="index">
            <a :href="`/product/${product.slug}`" style="text-decoration: none; color: inherit">
              <div class="image-slide-wrapper">
                <img :src="product.image_1" :alt="product.title" class="product-img first-img" style="height: 200px; width: 280px" />
                <img :src="product.image_2 || product.image_1" :alt="product.title" class="product-img second-img" style="height: 200px; width: 280px" />
              </div>
              <h3 class="product-title">{{ product.title }}</h3>
              <p>{{ product.specs }}</p>
              <div class="price-rating">
                <span class="price"> Rp{{ formatPrice(product.price) }} </span>
              </div>
            </a>
          </div>
        </div>
        <!-- </section> -->
        <!-- </div> -->
      </div>

      <!-- Best Seller -->
      <div class="tab-content" id="BestSeller-tab">
        <div class="product-grid" id="all-products">
          <!-- Asus ROG Zephyrus G14 -->

          <!-- Lenovo Ideapad Slim 5i -->
          <div class="product-card discount" v-for="(product, index) in bestSellers" :key="index">
            <a :href="`/product/${product.slug}`" style="text-decoration: none; color: inherit">
              <div class="image-slide-wrapper">
                <img :src="product.image_1" :alt="product.title" class="product-img first-img" style="height: 200px; width: 280px" />
                <img :src="product.image_2 || product.image_1" :alt="product.title" class="product-img second-img" style="height: 200px; width: 280px" />
              </div>
              <h3 class="product-title">{{ product.title }}</h3>
              <p>{{ product.specs }}</p>
              <div class="price-rating">
                <span class="price">Rp{{ formatPrice(product.price) }}</span>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- On Sale -->
      <div class="tab-content" id="OnSale-tab">
        <div class="product-grid" id="all-products">
          <!-- MSI VECTOR 16HX-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/MSI VECTOR 16HX 1.jpeg" alt="MSI VECTOR 16HX" class="product-img first-img" style="height: 230px; width: 300px" />
              <img src="../assets/Images/MSI VECTOR 16HX 2.png" alt="MSI VECTOR 16HX" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">MSI VECTOR 16HX</h3>
            <p>Intel Core Ultra 9 processor 275HX | RTX 5080 | 16″ QHD+ (2560×1600), 240Hz Refresh Rate | 16GB (8GB*2 DDR5-5600), Max 96GB</p>
            <div class="price-rating">
              <span class="price">
                Rp39.499.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp.47.399.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- Lenovo Yoga Slim 7 -->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/Lenovo Yoga Slim 7 14ILL10 0UID Aura Edition Core Ultra 5 226V 16GB.jpeg" alt="Lenovo Yoga Slim 7" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/Lenovo Yoga Slim 7 2.png" alt="Lenovo Yoga Slim 7" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">Lenovo Yoga Slim 7</h3>
            <p>Intel Core Ultra 5 226V | Intel Arc Graphics | 14″ OLED 2.8K Touch 120Hz | 16GB LPDDR5x | 512GB SSD PCIe 4.0</p>
            <div class="price-rating">
              <span class="price">
                Rp17.899.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp21.479.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- Asus ExpertBook P1 P1403CVA -->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/Asus ExpertBook P1 P1403CVA 1.png" alt="Asus ExpertBook P1 P1403CVA" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/Asus ExpertBook P1 P1403CVA 2.png" alt="Asus ExpertBook P1 P1403CVA" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">Asus ExpertBook P1 P1403CVA</h3>
            <p>Intel Core i5-13420H | Intel UHD Graphics | 14″ FHD Anti-glare | 8GB DDR5 | 512GB SSD | Win 11 + Office 2021</p>
            <div class="price-rating">
              <span class="price">
                Rp9.199.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp10.119.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 9% OFF </span>
              </span>
            </div>
          </div>

          <!-- Acer Nitro Lite NL16 71G -->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/Acer Nitro Lite NL16 71G 74MV 1.png" alt="Acer Nitro Lite NL16 71G 74MV" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/Acer Nitro Lite NL16 71G 74MV 2.png" alt="Acer Nitro Lite NL16 71G 74MV" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">Acer Nitro Lite NL16 71G</h3>
            <p>Intel Core i7-13620H | RTX 2050 4GB | 16″ WUXGA 180Hz IPS | 16GB DDR5 | 512GB SSD | Win 11 + Office 2024</p>
            <div class="price-rating">
              <span class="price">
                Rp12.999.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp15.599.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- HP OmniBook X 14 FE0333QU-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/HP OmniBook X 14 FE0333QU 1.png" alt="HP OmniBook X 14 FE0333QU" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/HP OmniBook X 14 FE0333QU  2.png" alt="HP OmniBook X 14 FE0333QU" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">HP OmniBook X 14</h3>
            <p>Snapdragon X Elite | Adreno GPU | 14″ 2.2K Touch IPS | 16GB LPDDR5x | 1TB SSD | Win 11 + Office 2021</p>
            <div class="price-rating">
              <span class="price">
                Rp18.999.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp22.799.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- MSI Prestige 16 B1VEG-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/MSI Prestige 16 B1VEG 1.jpg" alt="MSI Prestige 16 B1VEG 223ID" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/MSI Prestige 16 B1VEG 2.jpg" alt="MSI Prestige 16 B1VEG 223ID" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">MSI Prestige 16 B1VEG</h3>
            <p>Intel Core Ultra 7 155H | RTX 4050 6GB | 16″ QHD+ 100% DCI-P3 | 32GB LPDDR5 | 1TB SSD | Win 11 + Office</p>
            <div class="price-rating">
              <span class="price">
                Rp19.999.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp23.999.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- MSI Stealth 16 AI+ A3HVGG-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/MSI Stealth 16 AI+ A3HVGG 1.png" alt="MSI Stealth 16 AI+ A3HVGG" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/MSI Stealth 16 AI+ A3HVGG 2.png" alt="MSI Stealth 16 AI+ A3HVGG" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">MSI Stealth 16 AI+ A3HVGG</h3>
            <p>Ryzen AI 9 365 | RTX 4070 8GB | 16″ QHD+ 240Hz | 32GB LPDDR5x | 1TB SSD | Win 11 + Office 2021</p>
            <div class="price-rating">
              <span class="price">
                Rp27.999.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp33.599.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- Acer Aspire Lite 14 AL1-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/Acer Aspire Lite 14 AL1 14M 3MID 1.png" alt="Acer Aspire Lite 14 AL1" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/Acer Aspire Lite 14 AL1 14M 3MID 2.png" alt="Acer Aspire Lite 14 AL1" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">Acer Aspire Lite 14</h3>
            <p>Intel i3-1215U | Intel UHD | 14″ WUXGA IPS | 8GB DDR4 | 512GB SSD | Win 11 + Office + M365</p>
            <div class="price-rating">
              <span class="price">
                Rp6.249.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp6.874.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 9% OFF </span>
              </span>
            </div>
          </div>

          <!-- HP Victus 15 FA2717TX-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/HP Victus 15 FA2717TX 1.png" alt="HP Victus 15 FA2717TX" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/HP Victus 15 FA2717TX 2.png" alt="HP Victus 15 FA2717TX" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">HP Victus 15 FA2717TX</h3>
            <p>Intel i5-13420H | RTX 4050 6GB | 15.6″ FHD 144Hz | 16GB DDR4 | 512GB SSD | Win 11 + OHS + M365</p>
            <div class="price-rating">
              <span class="price">
                Rp14.899.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp17.879.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>

          <!-- Acer Aspire Lite 14 AL14-32P-C2SS-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/Acer Aspire Lite 14 AL14 1.png" alt="Acer Aspire Lite 14 AL14-32P-C2SS" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/Acer Aspire Lite 14 AL14 2.png" alt="Acer Aspire Lite 14 AL14-32P-C2SS" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3 class="product-title">Acer Aspire Lite 14 AL14</h3>
            <p>Intel N150 | Intel UHD | 14″ WUXGA IPS | 8GB LPDDR5 | 256GB SSD | Win 11 + OHS</p>
            <div class="price-rating">
              <span class="price">
                Rp4.949.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp5.197.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 5% OFF </span>
              </span>
            </div>
          </div>

          <!-- ASUS TUF F16 FX607VU-->
          <div class="product-card discount">
            <div class="image-slide-wrapper">
              <img src="../assets/Images/ASUS TUF F16 FX607VU 1.png" alt="ASUS TUF F16 FX607VU" class="product-img first-img" style="height: 200px; width: 280px" />
              <img src="../assets/Images/ASUS TUF F16 FX607VU 3.png" alt="ASUS TUF F16 FX607VU" class="product-img second-img" style="height: 180px; width: 250px" />
            </div>
            <h3 class="product-title">ASUS TUF F16 FX607VU</h3>
            <p>Intel i7-13620H | RTX 4050 6GB | 16″ FHD+ 165Hz | 16GB DDR5 | 512GB SSD | Win 11 + OHS 2024 + M365</p>
            <div class="price-rating">
              <span class="price">
                Rp18.699.000
                <span class="old-price" style="text-decoration: line-through; color: #888; margin-left: 10px"> Rp22.439.000 </span>
                <span class="discount-badge" style="background-color: red; color: white; font-size: 12px; padding: 2px 6px; border-radius: 5px; margin-left: 8px"> 17% OFF </span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Profil -->
    <section class="hero">
      <div class="container py-5">
        <div class="header-center">
          <h2 class="reveal">Profil Anggota</h2>
        </div>
        <div class="row g-4">
          <div class="profile-container">
            <div class="profile-card">
              <img src="../assets/Images/Danu.jpg" alt="Danu" class="profile-img" />
              <div class="profile-name">Rifky Danu Asmoro 23.11.5489</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
            </div>

            <div class="profile-card">
              <img src="../assets/Images/Baskara.jpg" alt="Baskara" class="profile-img" />
              <div class="profile-name">I Made Baskara Saccid Ananda 23.11.5466</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
            </div>

            <div class="profile-card">
              <img src="../assets/Images/Vianda.jpg" alt="Vianda" class="profile-img" />
              <div class="profile-name">Vianda Retnaningtiyas Purbandari Karetji 23.11.5445</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
            </div>

            <div class="profile-card">
              <img src="../assets/Images/Farhan.jpg" alt="Farhan" class="profile-img" />
              <div class="profile-name">Farhan Ardiansyah 23.11.5464</div>
              <div class="profile-desc">UI- Front End Developper</div>
            </div>

            <div class="profile-card">
              <img src="../assets/Images/Aryo.jpg" alt="Aryo" class="profile-img" />
              <div class="profile-name">Stefanus Arya Bayu Samudra Bataona 23.11.5477</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</template>

<script>
export default {
  name: "HomePage",
  data() {
    return {
      products: [],
      bestSellers: [],
    };
  },
  methods: {
    formatPrice(value) {
      return parseInt(value).toLocaleString("id-ID");
    },
  },
  async created() {
    try {
      const res = await fetch("http://localhost/technologia/Backend/products/get_all_products.php");
      const data = await res.json();
      if (!data.error) {
        this.products = data;
      } else {
        console.error(data.error);
      }
    } catch (err) {
      console.error("Gagal mengambil produk:", err);
    }
    try {
      const res = await fetch("http://localhost/technologia/Backend/products/get_best_seller.php");
      const data = await res.json();
      if (!data.error) {
        this.bestSellers = data;
      } else {
        console.error(data.error);
      }
    } catch (err) {
      console.error("Gagal mengambil produk:", err);
    }
  },

  mounted() {
    const tabLinks = document.querySelectorAll(".nav-link[data-tab]");
    const tabContents = document.querySelectorAll(".tab-content");

    tabLinks.forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();

        tabLinks.forEach((link) => link.classList.remove("active"));
        tabContents.forEach((content) => content.classList.remove("active"));

        this.classList.add("active");
        const tabId = this.getAttribute("data-tab");
        document.getElementById(tabId).classList.add("active");
      });
    });

    const revealElements = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const index = Array.from(revealElements).indexOf(entry.target);
            entry.target.style.transitionDelay = `${index * 80}ms`;
            entry.target.classList.add("active");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 }
    );

    revealElements.forEach((el) => {
      observer.observe(el);
    });
  },
};
</script>

<style>
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
  padding: 20px;
  margin-bottom: 0; /* tambahkan ini */
}

.image-slide-wrapper {
  position: relative;
  width: 280px;
  height: 200px;
  overflow: hidden;
  border-radius: 8px;
}

.product-card {
  width: 280px;
  height: auto;
  overflow: hidden;
}

.product-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease-in-out;
}

/* Saat hover, geser ke dalam container */
.first-img {
  z-index: 2;
}

.second-img {
  z-index: 1;
  transform: translateX(100%);
}

.product-card:hover .first-img {
  transform: translateX(-100%);
}

.product-card:hover .second-img {
  transform: translateX(0%);
}

.tab-content-container {
  padding-bottom: 0; /* hilangkan padding bawah jika ada */
  margin-bottom: 0;
}
</style>
