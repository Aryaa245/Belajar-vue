<template>
  <div class="container-createu">
    <h2>Tambah User Baru</h2>

    <div v-if="errors.length > 0" class="errors">
      <p v-for="(err, idx) in errors" :key="idx">{{ err }}</p>
    </div>

    <div v-if="success" class="success">
      <p>User berhasil ditambahkan.</p>
    </div>

    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label>Username:</label>
        <input type="text" v-model="form.username" required />
      </div>

      <div class="form-group">
        <label>Nama Lengkap:</label>
        <input type="text" v-model="form.nama_lengkap" required />
      </div>

      <div class="form-group">
        <label>Email:</label>
        <input type="email" v-model="form.email" required />
      </div>

      <div class="form-group">
        <label>Password:</label>
        <input type="password" v-model="form.password" required />
      </div>

      <div class="form-group">
        <label>Role:</label>
        <select v-model="form.role" required>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit">Simpan</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        username: '',
        nama_lengkap: '',
        email: '',
        password: '',
        role: 'admin'
      },
      errors: [],
      success: false
    };
  },
  mounted() {
    document.body.classList.add("login");
  },
  beforeUnmount() {
    document.body.classList.remove("login");
  },
  methods: {
    async handleSubmit() {
      this.errors = [];
      this.success = false;

      try {
        const res = await fetch('http://localhost/technologia/CI3/index.php/users/create_api', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify(this.form)
        });

        const result = await res.json();
        if (result.status) {
          this.success = true;
          this.form = { username: '', nama_lengkap: '', email: '', password: '', role: 'admin' };
          setTimeout(() => {
            this.$router.push('/dashboard');
          }, 1000);
        } else {
          this.errors.push(result.message || 'Gagal menambahkan user.');
        }
      } catch (err) {
        this.errors.push('Gagal terhubung ke server.');
      }
    }
  }
};
</script>

<style>
body.login {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4E71FF;
}

.container-createu {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 40px;
  max-width: 900px;
  width: 90%;
  box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
  animation: fadeIn 0.7s ease;
}

.container-createu h2 {
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

.form-group {
  margin-bottom: 1.2rem;
}

label {
  display: block;
  margin-bottom: 0.3rem;
  font-size: 0.9rem;
  color: #555;
}

input, select {
  padding: 0.7rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  width: 100%;
  font-size: 1rem;
  transition: border 0.2s ease;
}

input:focus, select:focus {
  border-color: #6c63ff;
  outline: none;
  box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
}

button {
  display: block;
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

button:hover {
  background: #584fe0;
}
</style>
