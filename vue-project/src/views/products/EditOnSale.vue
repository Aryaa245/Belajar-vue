<template>
  <div class="container_edit">
    <h2>Edit Produk On Sale</h2>
    <router-link to="/dashboardproduct">← Kembali ke Daftar Produk</router-link>

    <div v-if="success" class="message success">
      <p>Produk berhasil diperbarui.</p>
    </div>
    <div v-if="errors.length" class="errors">
      <p v-for="(e, i) in errors" :key="i">{{ e }}</p>
    </div>

    <form @submit.prevent="handleSubmit">
      <label>Judul Produk:
        <input v-model="form.title" type="text" required>
      </label>
      <label>Spesifikasi Singkat:
        <input v-model="form.specs" type="text" required>
      </label>
      <label>Harga:
        <input v-model="form.price" type="number" required>
      </label>
      <label>Harga Lama:
        <input v-model="form.old_price" type="number">
      </label>
      <label>Status:
        <select v-model="form.status">
          <option>In Stock</option>
          <option>Out of Stock</option>
        </select>
      </label>
      <label>Kategori:
        <input v-model="form.category" type="text">
      </label>
      <label>Link Pembelian:
        <input v-model="form.buy_link" type="text">
      </label>
      <label>Deskripsi Panjang:
        <textarea v-model="form.description" rows="5"></textarea>
      </label>

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
    async fetchProduct() {
      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/products/get_on_sale_by_id_api/${this.$route.params.id}`, {
          credentials: 'include'
        })
        const data = await res.json()
        if (data.status === false) {
          this.errors.push(data.message)
        } else {
          this.form = data
        }
      } catch (e) {
        this.errors.push('Gagal mengambil data produk.')
      }
    },
    async handleSubmit() {
      this.errors = []
      this.success = false

      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/products/update_on_sale_api/${this.$route.params.id}`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify(this.form)
        })
        const result = await res.json()
        if (result.status) {
          this.success = true
          this.$router.push('/products/manage')
        } else {
          this.errors.push(result.message || 'Gagal memperbarui produk.')
        }
      } catch (e) {
        this.errors.push('Gagal terhubung ke server.')
      }
    }
  }
}
</script>


<style scoped>
.container_edit {
  max-width: 600px;
  margin: 40px auto;
}
label {
  display: block;
  margin-top: 10px;
}
input, textarea, select {
  width: 100%;
  margin-top: 4px;
  margin-bottom: 12px;
  padding: 8px;
}
button {
  padding: 10px;
  background-color: #007bff;
  border: none;
  color: white;
  border-radius: 4px;
}
.success {
  background-color: #d4edda;
  padding: 10px;
}
.errors {
  background-color: #f8d7da;
  padding: 10px;
}
</style>
