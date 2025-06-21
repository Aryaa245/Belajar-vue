<template>
  <div class="profile-danu-container">
    <div class="profile-banner">
      <img src="../assets/Images/Danu.jpg" alt="Rifky Danu Asmoro" class="profile-photo" />
      <div class="profile-name-section">
        <h1>Rifky Danu Asmoro</h1>
        <p class="nim">NIM: 23.11.5489</p>
        <p class="role">UI/UX Designer & Front End Developer</p>
      </div>
    </div>

    <div class="profile-content">
      <div class="section">
        <h2>✨ Tentang Saya</h2>
        <p>
          Halo! Saya Rifky Danu Asmoro, seorang mahasiswa dengan ketertarikan besar pada dunia desain antarmuka dan
          pengembangan web. Saya senang menciptakan tampilan yang estetis sekaligus fungsional.
        </p>
      </div>

      <div class="section">
        <h2>🛠️ Jobdesk</h2>
        <ul class="skills">
          <li>Figma / Adobe XD</li>
          <li>HTML, CSS, JavaScript</li>
          <li>Vue.js & Tailwind CSS</li>
          <li>Responsive Web Design</li>
          <li>Prototyping & Wireframing</li>
        </ul>
      </div>

      <div class="section">
  <h2>📱 Social Media</h2>
  <div style="display: flex; flex-direction: column; gap: 15px;">
    <a href="https://www.instagram.com/username" target="_blank" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">
      <div style="width: 35px; height: 35px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram" width="18" />
      </div>
      <span>@username</span>
    </a>
    <a href="https://www.tiktok.com/@username" target="_blank" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">
      <div style="width: 35px; height: 35px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        <img src="https://cdn-icons-png.flaticon.com/512/3046/3046122.png" alt="TikTok" width="18" />
      </div>
      <span>@username</span>
    </a>
    <a href="https://github.com/username" target="_blank" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">
      <div style="width: 35px; height: 35px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733553.png" alt="GitHub" width="18" />
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
  name: "ProfilDanu",
};
</script>

<style scoped>
.profile-danu-container {
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
