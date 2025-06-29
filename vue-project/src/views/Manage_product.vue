<template>
  <div class="container-manage">
    <div class="header-nav">
      <h2>Manajemen Produk</h2>
      <div>
        <span>
          Halo, {{ user.nama_lengkap }} ({{ user.role }}) |
        </span>
        <a href="http://localhost:5173/">Halaman Utama</a>
      </div>
    </div>

    <router-link to="/products/create" class="btn">Tambah Produk Baru</router-link>

    <router-link to="/dashboard" class="btn btn-admin">Manajemen Admin</router-link>

    <!-- Produk New Arrival -->
    <h3>Produk New Arrival</h3>
    <div v-if="products.length === 0">Belum ada produk New Arrival.</div>
    <table v-else>
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Slug</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in products" :key="p.id">
          <td>{{ p.id }}</td>
          <td>{{ p.title }}</td>
          <td>{{ p.slug }}</td>
          <td>Rp{{ formatPrice(p.price) }}</td>
          <td>{{ p.status }}</td>
          <td>{{ p.created_at }}</td>
          <td>
            <router-link :to="`/products/edit/${p.id}?type=products`" class="btn-edit">Edit</router-link>
            <button class="btn-delete" @click="deleteProduct(p.id, 'products')">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Produk Best Seller -->
    <h3>Produk Best Seller</h3>
    <div v-if="bestSellers.length === 0">Belum ada produk Best Seller.</div>
    <table v-else>
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Slug</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in bestSellers" :key="p.id">
          <td>{{ p.id }}</td>
          <td>{{ p.title }}</td>
          <td>{{ p.slug }}</td>
          <td>Rp{{ formatPrice(p.price) }}</td>
          <td>{{ p.status }}</td>
          <td>{{ p.created_at }}</td>
          <td>
            <router-link :to="`/products/edit/${p.id}?type=best_seller`" class="btn-edit">Edit</router-link>
            <button class="btn-delete" @click="deleteProduct(p.id, 'best_seller')">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Produk On Sale -->
    <h3>Produk On Sale</h3>
    <div v-if="onSales.length === 0">Belum ada produk On Sale.</div>
    <table v-else>
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Slug</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in onSales" :key="p.id">
          <td>{{ p.id }}</td>
          <td>{{ p.title }}</td>
          <td>{{ p.slug }}</td>
          <td>Rp{{ formatPrice(p.price) }}</td>
          <td>{{ p.status }}</td>
          <td>{{ p.created_at }}</td>
          <td>
            <router-link :to="`/products/edit/${p.id}?type=on_sale`" class="btn-edit">Edit</router-link>
            <button class="btn-delete" @click="deleteProduct(p.id, 'on_sale')">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        nama_lengkap: '',
        role: ''
      },
      products: [],
      bestSellers: [],
      onSales: []
    };
  },
  created() {
    const userData = sessionStorage.getItem('user');
    if (userData) {
      this.user = JSON.parse(userData);
    }
    this.fetchAll();
  },
  methods: {
    fetchAll() {
      fetch('http://localhost/technologia/CI3/index.php/products/fetch_all')
        .then(res => res.json())
        .then(data => {
          this.products = data.products || [];
          this.bestSellers = data.best_sellers || [];
          this.onSales = data.on_sales || [];
        })
        .catch(() => alert('Gagal memuat data produk.'));
    },
    deleteProduct(id, type) {
      if (!confirm('Yakin ingin menghapus produk ini?')) return;

      // Sesuaikan untuk handle CI3 yang tidak mengenal DELETE method secara native
      fetch(`http://localhost/technologia/CI3/index.php/products/delete/${id}?type=${type}`, {
        method: 'POST', // Ganti ke POST karena CI3 biasanya tidak support DELETE langsung
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: '_method=DELETE', // Simulasikan method override
        credentials: 'include'
      })
        .then(res => res.json())
        .then(result => {
          if (result.status) {
            alert('Produk berhasil dihapus.');
            this.fetchAll();
          } else {
            alert(result.message || 'Gagal menghapus produk.');
          }
        })
        .catch(() => alert('Terjadi kesalahan saat menghapus produk.'));
    },
    formatPrice(price) {
      return Number(price).toLocaleString('id-ID');
    }
  }
};
</script>

<style scoped>
.container-manage {
  padding: 40px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #4E71FF;
  min-height: 100vh;
  color: #333;
}

/* Header Navigasi */
.header-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  flex-wrap: wrap;
  color: white;
}

.header-nav h2 {
  font-size: 26px;
  font-weight: bold;
}

.header-nav div span {
  font-size: 14px;
  margin-right: 10px;
}

.header-nav a {
  color: #ffffff;
  text-decoration: underline;
  font-weight: 500;
}

/* Tombol Tambah Produk */
.btn {
  background-color: #00b969;
  color: #fff;
  padding: 10px 18px;
  border-radius: 8px;
  font-weight: bold;
  transition: 0.3s ease;
  display: inline-block;
  margin-bottom: 30px;
  text-decoration: none;
}

.btn:hover {
  background-color: #17a589;
}

h3 {
  width: fit-content;
  margin-top: 60px;
  margin-bottom: 15px;
  font-size: 20px;
  color: rgb(0, 0, 0);
  padding: 8px 20px;
  border-radius: 6px;
  background-color: #ffffff;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}


/* Tabel Produk */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  background: white;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  table-layout: fixed;
}

th, td {
  border: 1px solid #dee2e6;
  padding: 14px;
  text-align: left;
  vertical-align: top;
  word-wrap: break-word;
  color: #333;
}

th {
  background-color: #e9f1ff;
  font-weight: 600;
}

/* Baris Hover */
tr:hover {
  background-color: #f3f9ff;
}

/* Tombol Edit dan Hapus */
.btn-edit,
.btn-delete {
  padding: 7px 14px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: 0.3s ease;
  text-transform: uppercase;
  text-decoration: none !important; /* Hilangkan underline */
  display: inline-block;
}

.btn-edit {
  background-color: #0d6efd;
  color: white;
  margin-right: 8px;
}

.btn-edit:hover {
  background-color: #084298;
}

.btn-delete {
  background-color: #dc3545;
  color: white;
}

.btn-delete:hover {
  background-color: #a71d2a;
}

/* Mobile Responsive */
@media screen and (max-width: 768px) {
  .header-nav {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  table {
    font-size: 14px;
  }

  th, td {
    padding: 10px;
  }

  .btn-edit, .btn-delete {
    padding: 6px 10px;
  }
}


.btn-admin {
  background-color: #00b969;
  margin-left: 
  12px; 
}

.header-nav a {
  background-color: #00b969;
  padding: 10px 18px;
  border-radius: 8px;
  font-weight: bold;
  color: #ffffff;
  text-decoration: none; 
  transition: 0.3s ease;
}

.header-nav a:hover {
  background-color: #17a589;
}



</style>

