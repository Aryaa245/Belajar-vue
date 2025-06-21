<template>
  <div class="profile-vianda-container">
    <div class="profile-banner">
      <img src="../assets/Images/Vianda.jpg" alt="Vianda Retnaningtiyas Purbandari Karetji" class="profile-photo" />
      <div class="profile-name-section">
        <h1>Vianda Retnaningtiyas Purbandari Karetji</h1>
        <p class="nim">NIM: 23.11.5445</p>
        <p class="role">UI/UX Designer & Front End Developer</p>
      </div>
    </div>

    <div class="profile-content">
      <div class="section">
        <h2>✨ Tentang Saya</h2>
        <p>
          Hai! Saya Vianda, seorang mahasiswa yang tertarik dalam dunia desain dan pengembangan web. Saya percaya bahwa kombinasi antara estetika dan fungsi adalah kunci utama dalam menciptakan pengalaman pengguna yang menyenangkan.
        </p>
      </div>

      <div class="section">
        <h2>🛠️ Jobdesk</h2>
        <ul class="skills">
          <li>UI/UX Design</li>
          <li>HTML, CSS, JavaScript</li>
          <li>Figma & Prototyping</li>
          <li>Vue.js & Tailwind</li>
          <li>Design System</li>
        </ul>
      </div>

      <div class="section">
        <h2>📱 Social Media</h2>
        <div class="social-links">
          <a href="https://www.instagram.com/username" target="_blank" class="social-item">
            <div class="icon-circle">
              <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram" />
            </div>
            <span>@username</span>
          </a>
          <a href="https://www.tiktok.com/@username" target="_blank" class="social-item">
            <div class="icon-circle">
              <img src="https://cdn-icons-png.flaticon.com/512/3046/3046122.png" alt="TikTok" />
            </div>
            <span>@username</span>
          </a>
          <a href="https://github.com/username" target="_blank" class="social-item">
            <div class="icon-circle">
              <img src="https://cdn-icons-png.flaticon.com/512/733/733553.png" alt="GitHub" />
            </div>
            <span>github.com/username</span>
          </a>
        </div>
      </div>

      <div class="section">
        <h2>📸 Galeri Karya</h2>
        <div class="gallery">
          <img src="../assets/Images/ui1.jpg" alt="UI Design 1" />
          <img src="../assets/Images/ui2.jpg" alt="UI Design 2" />
          <img src="../assets/Images/ui3.jpg" alt="UI Design 3" />
        </div>
      </div>

      <router-link to="/" class="back-button">← Kembali ke Beranda</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProfilVianda",
};
</script>

<style scoped>
.profile-vianda-container {
  font-family: 'Segoe UI', sans-serif;
  color: #333;
  padding: 6rem;
  max-width: 900px;
  margin: auto;
  animation: fadeIn 1s ease-in-out;
}

.profile-banner {
  display: flex;
  align-items: center;
  gap: 2rem;
  margin-bottom: 2rem;
  background: linear-gradient(to right, #e0f7fa, #e1bee7);
  padding: 1.5rem;
  border-radius: 1rem;
}

.profile-photo {
  width: 180px;
  height: 180px;
  border-radius: 50%;
  object-fit: cover;
  border: 5px solid #fff;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.profile-name-section h1 {
  margin: 0;
  font-size: 2rem;
}

.profile-name-section p {
  margin: 0.3rem 0;
  font-size: 1.1rem;
}

.section {
  margin-bottom: 2rem;
}

.section h2 {
  color: #6a1b9a;
  margin-bottom: 0.5rem;
}

.skills {
  list-style: none;
  padding: 0;
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.skills li {
  background-color: #f3e5f5;
  padding: 0.5rem 1rem;
  border-radius: 1rem;
  font-weight: bold;
}

.gallery {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.gallery img {
  width: 200px;
  border-radius: 0.5rem;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.back-button {
  display: inline-block;
  margin-top: 2rem;
  text-decoration: none;
  background-color: #7b1fa2;
  color: white;
  padding: 0.5rem 1.2rem;
  border-radius: 8px;
  transition: background-color 0.3s;
}

.back-button:hover {
  background-color: #4a148c;
}

.social-links {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.social-item {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  color: inherit;
}

.icon-circle {
  width: 35px;
  height: 35px;
  background-color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.icon-circle img {
  width: 18px;
  height: 18px;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
