<template>
  <div class="container">
    <div class="header-nav">
      <h2>Edit User</h2>
      <router-link to="/dashboard">← Kembali ke Manajemen User</router-link>
    </div>

    <div v-if="errors.length" class="errors">
      <p v-for="(err, i) in errors" :key="i">{{ err }}</p>
    </div>

    <div v-if="success" class="success">
      <p>Data user berhasil diperbarui.</p>
    </div>

    <form @submit.prevent="updateUser">
      <label>Username:</label>
      <input type="text" v-model="form.username" required />

      <label>Nama Lengkap:</label>
      <input type="text" v-model="form.nama_lengkap" required />

      <label>Email:</label>
      <input type="email" v-model="form.email" required />

      <label>Password (kosongkan jika tidak diubah):</label>
      <input type="password" v-model="form.password" />

      <label>Role:</label>
      <select v-model="form.role" required>
        <option value="admin">Admin</option>
      </select>

      <button type="submit">Simpan Perubahan</button>
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
    }
  },
  created() {
    const session = sessionStorage.getItem('user');
    if (!session) {
      this.$router.push('/login');
      return;
    }
    this.fetchUser();
  },
  methods: {
    async fetchUser() {
      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/users/get_user_by_id_api/${this.$route.params.id}`, {
          credentials: 'include'
        });
        if (!res.ok) throw new Error('Gagal ambil user');
        const userData = await res.json();
        this.form = { ...userData, password: '' }; // Kosongkan password
      } catch (err) {
        this.errors.push('Gagal mengambil data user.');
      }
    },

    async updateUser() {
      this.errors = [];
      this.success = false;

      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/users/update_user_api/${this.$route.params.id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          credentials: 'include',
          body: JSON.stringify(this.form)
        });


        const result = await res.json();
        if (result.status) {
          this.success = true;
          this.$router.push('/dashboard'); // ✅ redirect
        } else {
          this.errors.push(result.message || 'Gagal memperbarui user.');
        }
      } catch (err) {
        this.errors.push('Gagal terhubung ke server.');
      }
    }
  }
}
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
