<template>
  <div class="page-wrapper">
  <div class="container-login">
    <h2>Login User</h2>

    <!-- Pesan sukses -->
    <div v-if="successMessage" class="success">
      <p>{{ successMessage }}</p>
    </div>

    <!-- Pesan error -->
    <div v-if="errors.length > 0" class="errors">
      <p v-for="(error, index) in errors" :key="index">{{ error }}</p>
    </div>

    <form @submit.prevent="handleLogin">
      <div>
        <label for="username">Username:</label>
        <input 
        type="text" 
        v-model="username" 
        required
         />
      </div>

      <div>
        <label for="password">Password:</label>
        <input 
        type="password" 
        v-model="password" 
        required 
        />
      </div>

      <div>
        <button type="submit">Login</button>
      </div>
    </form>
  </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
      errors: [],
      successMessage: ''
    }
  },
  mounted() {
    document.body.classList.add("login");
  },
  beforeUnmount() {
    document.body.classList.remove("login");
  },
  methods: {
    async handleLogin() {
      this.errors = [];
      try {
        const response = await fetch('http://localhost/technologia/CI3/index.php/auth/login_api', {
          method: 'POST',
          credentials: 'include',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            username: this.username,
            password: this.password
          })
        });

        const result = await response.json();
        if (result.status) {
          sessionStorage.setItem('user', JSON.stringify(result.user));
          this.$router.push('/dashboard');
        } else {
          this.errors.push(result.message);
        }
      } catch (error) {
        this.errors.push('Gagal terhubung ke server.');
      }
    }
  }
}
</script>

<style scoped>
.page-wrapper {
  min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #4E71FF;
}

.container-login {
  background: #ffffff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 360px;
}

.container-login h2 {
  text-align: center;
  color: #333;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
}

.success, .errors {
  padding: 0.75rem;
  border-radius: 6px;
  margin-bottom: 1rem;
  font-size: 0.9rem;
}
.success {
  background: #e0f7e0;
  border: 1px solid #7fd47f;
  color: #2a7d2a;
}
.errors {
  background: #fde8e8;
  border: 1px solid #f1b8b8;
  color: #b22d2d;
}

.container-login label {
  margin-bottom: 0.3rem;
  font-size: 0.9rem;
  color: #555;
}
.container-login input {
  padding: 0.7rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  width: 100%;
  font-size: 1rem;
  margin-bottom: 1rem;
  transition: border 0.2s ease;
}
.container-login input:focus {
  border-color: #6c63ff;
  outline: none;
  box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
}

.container-login button {
  width: 100%;
  padding: 0.7rem;
  border: none;
  border-radius: 6px;
  background: #6c63ff;
  color: white;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.3s ease;
}
.container-login button:hover {
  background: #584fe0;
}
</style>
