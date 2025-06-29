<!-- src/views/EditProduct.vue -->
<template>
  <div class="container_edit">
    <h2>Edit Produk</h2>
    <router-link to="/products/manage">&larr; Kembali ke daftar produk</router-link>

    <div v-if="success" class="message success">
      <p>Produk berhasil diperbarui.</p>
    </div>

    <div v-if="errors.length" class="errors">
      <p v-for="(err, i) in errors" :key="i">{{ err }}</p>
    </div>

    <form @submit.prevent="handleSubmit">
      <label>Judul Produk:
        <input type="text" v-model="form.title" required />
      </label>
      <label>Spesifikasi Singkat:
        <input type="text" v-model="form.specs" required />
      </label>
      <label>Harga:
        <input type="number" v-model="form.price" required />
      </label>
      <label>Harga Lama:
        <input type="number" v-model="form.old_price" />
      </label>
      <label>Status:
        <select v-model="form.status">
          <option value="In Stock">In Stock</option>
          <option value="Out of Stock">Out of Stock</option>
        </select>
      </label>
      <label>Kategori:
        <input type="text" v-model="form.category" />
      </label>
      <label>Link Pembelian:
        <input type="text" v-model="form.buy_link" />
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
      success: false,
      errors: []
    };
  },
  created() {
    this.fetchProduct();
  },
  methods: {
    async fetchProduct() {
      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/products/get_by_id/${this.$route.params.id}`, {
          credentials: 'include'
        });
        const data = await res.json();
        if (data) {
          this.form = data;
        } else {
          this.errors.push('Produk tidak ditemukan.');
        }
      } catch (err) {
        this.errors.push('Gagal mengambil data produk.');
      }
    },
    async handleSubmit() {
      this.errors = [];
      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/products/update/${this.$route.params.id}`, {
          method: 'POST',
          credentials: 'include',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        });

        const result = await res.json();
        if (result.status) {
          this.success = true;
        } else {
          this.errors.push(result.message || 'Gagal memperbarui produk.');
        }
      } catch (err) {
        this.errors.push('Gagal terhubung ke server.');
      }
    }
  }
};
</script>

<style scoped>
.container_edit {
  max-width: 700px;
  margin: 40px auto;
  padding: 20px;
  background: #fff;
}
label {
  display: block;
  margin-top: 12px;
  font-weight: bold;
}
input, textarea, select {
  width: 100%;
  padding: 8px;
  margin-top: 4px;
  margin-bottom: 12px;
}
button {
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
}
.message.success {
  background-color: #d4edda;
  padding: 10px;
  border-left: 6px solid #28a745;
}
.errors {
  background-color: #f8d7da;
  padding: 10px;
  border-left: 6px solid #dc3545;
}
</style>
