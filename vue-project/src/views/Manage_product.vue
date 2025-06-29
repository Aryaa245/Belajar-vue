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
            <router-link :to="`/products/edit_on_sale/${p.id}?type=on_sale`" class="btn-edit">Edit</router-link>
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
  padding: 20px;
}
.header-nav {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.btn {
  background-color: green;
  color: white;
  padding: 8px 16px;
  text-decoration: none;
  margin-bottom: 20px;
  display: inline-block;
}
.btn-edit {
  background-color: #007bff;
  color: white;
  padding: 4px 8px;
  margin-right: 5px;
  text-decoration: none;
}
.btn-delete {
  background-color: #dc3545;
  color: white;
  padding: 4px 8px;
  border: none;
  cursor: pointer;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}
th, td {
  padding: 8px;
  border: 1px solid #ccc;
}
</style>
