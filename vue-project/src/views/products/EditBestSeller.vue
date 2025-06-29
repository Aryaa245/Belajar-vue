<template>
  <div class="container_edit">
    <h2>Edit Produk Best Seller</h2>
    <router-link to="/products/manage" class="btn">← Kembali ke Daftar Produk</router-link>

    <div v-if="errors.length" class="errors">
      <p v-for="(err, i) in errors" :key="i">{{ err }}</p>
    </div>
    <div v-if="success" class="success">Produk berhasil diperbarui.</div>

    <form @submit.prevent="updateProduct">
      <label>Judul Produk:</label>
      <input v-model="form.title" type="text" required />

      <label>Spesifikasi Singkat:</label>
      <input v-model="form.specs" type="text" required />

      <label>Harga:</label>
      <input v-model="form.price" type="number" required />

      <label>Harga Lama:</label>
      <input v-model="form.old_price" type="number" />

      <label>Status:</label>
      <select v-model="form.status">
        <option value="In Stock">In Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>

      <label>Kategori:</label>
      <input v-model="form.category" type="text" />

      <label>Link Pembelian:</label>
      <input v-model="form.buy_link" type="text" />

      <label>Deskripsi Panjang:</label>
      <textarea v-model="form.description" rows="5"></textarea>

      <button type="submit">Simpan Perubahan</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: '',
        specs: '',
        price: '',
        old_price: '',
        status: 'In Stock',
        category: '',
        buy_link: '',
        description: ''
      },
      errors: [],
      success: false
    }
  },
  created() {
    this.fetchProduct()
  },
  methods: {
    fetchProduct() {
      const id = this.$route.params.id
      fetch(`http://localhost/technologia/CI3/index.php/products/get_best_seller_by_id/${id}`, {
        credentials: 'include'
      })
        .then(res => res.json())
        .then(data => {
          if (data && data.id) {
            this.form = data
          } else {
            this.errors.push('Produk tidak ditemukan.')
          }
        })
        .catch(() => {
          this.errors.push('Gagal mengambil data produk.')
        })
    },
    updateProduct() {
      const id = this.$route.params.id
      fetch(`http://localhost/technologia/CI3/index.php/products/update_best_seller/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify(this.form)
      })
        .then(res => res.json())
        .then(result => {
          if (result.status) {
            this.success = true
            this.$router.push('/products/manage')
          } else {
            this.errors = [result.message || 'Gagal memperbarui produk.']
          }
        })
        .catch(() => {
          this.errors = ['Gagal menghubungi server.']
        })
    }
  }
}
</script>

<style scoped>
.container_edit {
  max-width: 700px;
  margin: 40px auto;
}
label {
  display: block;
  margin-top: 12px;
  font-weight: bold;
}
input, select, textarea {
  width: 100%;
  padding: 8px;
  margin-top: 4px;
}
button {
  margin-top: 20px;
  padding: 10px 16px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
}
.errors {
  background-color: #f8d7da;
  padding: 10px;
  margin-bottom: 15px;
}
.success {
  background-color: #d4edda;
  padding: 10px;
  margin-bottom: 15px;
}
</style>
