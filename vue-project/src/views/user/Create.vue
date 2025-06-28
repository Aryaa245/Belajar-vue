<template>
  <div class="container">
    <h2>Tambah User Baru</h2>
    <div class="header-nav">
    </div>

    <div v-if="errors.length > 0" class="errors">
      <p v-for="(err, idx) in errors" :key="idx">{{ err }}</p>
    </div>

    <div v-if="success" class="success">
      <p>User berhasil ditambahkan.</p>
    </div>

    <form @submit.prevent="handleSubmit">
      <label>Username:</label>
      <input type="text" v-model="form.username" required />

      <label>Nama Lengkap:</label>
      <input type="text" v-model="form.nama_lengkap" required />

      <label>Email:</label>
      <input type="email" v-model="form.email" required />

      <label>Password:</label>
      <input type="password" v-model="form.password" required />

      <label>Role:</label>
      <select v-model="form.role" required>
        <option value="admin">Admin</option>
      </select>

      <button type="submit">Simpan</button>
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

<style scoped>
.container {
  max-width: 600px;
  margin: 40px auto;
}
label {
  font-weight: bold;
  display: block;
  margin-top: 12px;
}
input, select {
  width: 100%;
  padding: 8px;
  margin-top: 4px;
  margin-bottom: 12px;
}
button {
  padding: 10px;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
}
.success {
  background-color: #d4edda;
  padding: 10px;
  margin-bottom: 15px;
}
.errors {
  background-color: #f8d7da;
  padding: 10px;
  margin-bottom: 15px;
}
</style>
