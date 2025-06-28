<template>
  <div class="container">
    <h2>Dashboard Admin</h2>
    <div class="header-nav">
      <div>
        <span>Halo, {{ user.nama_lengkap }} ({{ user.role }}) | </span>
        <router-link to="/products/manage">Manajemen Produk</router-link> |
        <router-link to="/">Halaman Utama</router-link> |
        <a href="#" @click.prevent="logout">Logout</a>
      </div>
    </div>

    <p><router-link to="/users/create" class="btn">Tambah Admin Baru</router-link></p>


    <table v-if="users.length > 0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Nama Lengkap</th>
          <th>Email</th>
          <th>Role</th>
          <th>Tanggal Daftar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="u in users" :key="u.id">
          <td>{{ u.id }}</td>
          <td>{{ u.username }}</td>
          <td>{{ u.nama_lengkap }}</td>
          <td>{{ u.email }}</td>
          <td>{{ u.role }}</td>
          <td>{{ formatDate(u.created_at) }}</td>
          <td>
            <router-link :to="'/users/edit/' + u.id" class="btn-edit">Edit</router-link>
            <a href="#" @click.prevent="deleteUser(u.id)" class="btn-delete">Hapus</a>
          </td>
        </tr>
      </tbody>
    </table>

    <p v-else>Belum ada user terdaftar.</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      user: {
        nama_lengkap: 'Admin', // nanti ambil dari sessionStorage
        role: 'admin'
      }
    };
  },
  // created() {
  //   this.fetchUsers();
  //   const sessionData = JSON.parse(sessionStorage.getItem('user'));
  //   if (sessionData) {
  //     this.user = sessionData;
  //   }
  // },
     created() {
  const userData = sessionStorage.getItem('user')
  if (!userData) {
    this.$router.push('/login') // tidak ada session → redirect
    return
  }

  this.user = JSON.parse(userData)
  this.fetchUsers()
},


    
  methods: {
    fetchUsers() {
      fetch('http://localhost/technologia/CI3/index.php/users/list_api', {
        credentials: 'include'
      })
        .then(res => res.json())
        .then(data => {
          this.users = data;
        })
        .catch(err => {
          console.error('Gagal ambil data user:', err);
        });
    },
  deleteUser(id) {
  if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
    fetch(`http://localhost/technologia/CI3/index.php/users/delete_user_api/${id}`, {
      method: 'DELETE',
      credentials: 'include'
    })
      .then(res => res.json())
      .then(result => {
        if (result.status) {
          alert('User berhasil dihapus.');
          this.fetchUsers(); // refresh daftar user
        } else {
          alert('Gagal menghapus user: ' + result.message);
        }
      })
      .catch(err => {
        console.error('Gagal hapus user:', err);
        alert('Terjadi kesalahan saat menghubungi server.');
      });
  }
},


    formatDate(dateStr) {
      const d = new Date(dateStr);
      return d.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      });
    },
    logout() {
  fetch('http://localhost/technologia/CI3/index.php/auth/logout_api', {
    credentials: 'include'
  })
    .then(res => res.json())
    .then(result => {
      if (result.status) {
        sessionStorage.removeItem('user') // 🚫 hapus session user
        this.$router.push('/login') // arahkan ke login
      } else {
        alert('Logout gagal: ' + result.message)
      }
    })
    .catch(() => {
      alert('Gagal logout.')
    })
},


     async handleLogout() {
      try {
        const response = await fetch('http://localhost/technologia/CI3/index.php/auth/logout_api', {
          method: 'POST',
          credentials: 'include'
        })

        const result = await response.json()
        if (result.status) {
          localStorage.removeItem('user_token')
          this.$router.push('/login')
        } else {
          alert('Logout gagal: ' + result.message)
        }
      } catch (error) {
        alert('Gagal terhubung ke server saat logout.')
      }
    }
  }
};
</script>

<style scoped>
.container {
  max-width: 960px;
  margin: 20px auto;
}
.header-nav {
  margin-bottom: 20px;
}
.btn {
  padding: 8px 14px;
  background-color: #007bff;
  color: white;
  border-radius: 4px;
  text-decoration: none;
}
.btn-edit {
  padding: 6px 12px;
  background-color: #28a745;
  color: white;
  border-radius: 4px;
  text-decoration: none;
  margin-right: 5px;
}
.btn-delete {
  padding: 6px 12px;
  background-color: #dc3545;
  color: white;
  border-radius: 4px;
  text-decoration: none;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}
table th, table td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: left;
}
table th {
  background-color: #f4f4f4;
}
</style>
