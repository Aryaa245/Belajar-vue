<template>
  <div class="container">
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
  methods: {
    async handleLogin() {
  this.errors = []
  try {
    const response = await fetch('http://localhost/technologia/CI3/index.php/auth/login_api', {
      method: 'POST',
      credentials: 'include',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        username: this.username,
        password: this.password
      })
    })

    const result = await response.json()
    if (result.status) {
      // ✅ Simpan ke sessionStorage
      sessionStorage.setItem('user', JSON.stringify(result.user))
      this.$router.push('/dashboard')
    } else {
      this.errors.push(result.message)
    }
  } catch (error) {
    this.errors.push('Gagal terhubung ke server.')
  }
}

  }
}
</script>


<style scoped>
.container {
  max-width: 400px;
  margin: 40px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 6px;
  background: #fff;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 4px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  border: none;
  color: white;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.errors {
  background-color: #f8d7da;
  padding: 10px;
  border-left: 6px solid #dc3545;
  margin-bottom: 20px;
}

.success {
  background-color: #d4edda;
  padding: 10px;
  border-left: 6px solid #28a745;
  margin-bottom: 20px;
}
</style>
