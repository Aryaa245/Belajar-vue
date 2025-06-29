<template>
  <div class="container_addP">
    <h2>Tambah Produk Laptop</h2>
    <router-link to="/products/manage">&larr; Kembali ke daftar produk</router-link>

    <div v-if="success" class="message success">
      <p>Produk berhasil ditambahkan.</p>
    </div>

    <div v-if="errors.length" class="errors">
      <p v-for="(err, idx) in errors" :key="idx">{{ err }}</p>
    </div>

    <form @submit.prevent="submitForm" class="form-container" enctype="multipart/form-data">
      <div class="form-group">
        <label>
          <input type="checkbox" v-model="form.is_best_seller" />
          Tambahkan ke Best Seller
        </label>
      </div>

      <div class="form-group">
        <label>
          <input type="checkbox" v-model="form.is_on_sale" />
          Tambahkan ke On Sale
        </label>
      </div>

      <div class="form-group" v-for="field in textFields" :key="field.name">
        <label>{{ field.label }}</label>
        <input :type="field.type" v-model="form[field.name]" :required="field.required" />
      </div>

      <div class="form-group">
        <label>Status:</label>
        <select v-model="form.status">
          <option value="In Stock">In Stock</option>
          <option value="Out of Stock">Out of Stock</option>
        </select>
      </div>

      <div class="form-group full-width">
        <label>Deskripsi Panjang/Detail (pisahkan pakai '|'):</label>
        <textarea v-model="form.description" rows="5"></textarea>
      </div>

      <div class="form-group" v-for="(label, key) in fileInputs" :key="key">
        <label>{{ label }}</label>
        <input type="file" @change="handleFileChange($event, key)" :required="key === 'image_1_file'" />
      </div>

      <button type="submit">Simpan Produk</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        is_best_seller: false,
        is_on_sale: false,
        slug: "",
        title: "",
        specs: "",
        price: "",
        old_price: "",
        status: "In Stock",
        category: "",
        buy_link: "",
        description: "",
      },
      files: {
        image_1_file: null,
        image_2_file: null,
        image_3_file: null,
        qr_code_file: null,
      },
      errors: [],
      success: false,
      textFields: [
        { name: "slug", label: "Slug/ID Produk:", type: "text", required: true },
        { name: "title", label: "Judul Produk:", type: "text", required: true },
        { name: "specs", label: "Spesifikasi Singkat:", type: "text", required: true },
        { name: "price", label: "Harga:", type: "number", required: true },
        { name: "old_price", label: "Harga Lama:", type: "number", required: false },
        { name: "category", label: "Kategori (dipisah koma):", type: "text", required: false },
        { name: "buy_link", label: "Link Pembelian:", type: "text", required: false },
      ],
      fileInputs: {
        image_1_file: "Gambar 1 (wajib):",
        image_2_file: "Gambar 2:",
        image_3_file: "Gambar 3:",
        qr_code_file: "QR Code:",
      },
    };
  },
  methods: {
    handleFileChange(event, name) {
      this.files[name] = event.target.files[0];
    },
    async submitForm() {
      this.errors = [];
      this.success = false;

      const formData = new FormData();

      // Tambahkan data teks
      for (const key in this.form) {
        let value = this.form[key];
        if (typeof value === "boolean") {
          value = value ? "1" : "";
        }
        formData.append(key, value);
      }

      // Tambahkan file
      for (const key in this.files) {
        if (this.files[key]) {
          formData.append(key, this.files[key]);
        }
      }

      try {
        const res = await fetch("http://localhost/technologia/CI3/index.php/products/create_form", {
          method: "POST",
          body: formData,
        });

        const data = await res.json();

        if (data.success) {
          this.success = true;
          this.resetForm();
        } else {
          this.errors = data.errors || ["Gagal menambahkan produk."];
        }
      } catch (err) {
        this.errors = ["Terjadi kesalahan saat mengirim data."];
      }
    },
    resetForm() {
      this.form = {
        is_best_seller: false,
        is_on_sale: false,
        slug: "",
        title: "",
        specs: "",
        price: "",
        old_price: "",
        status: "In Stock",
        category: "",
        buy_link: "",
        description: "",
      };
      this.files = {
        image_1_file: null,
        image_2_file: null,
        image_3_file: null,
        qr_code_file: null,
      };
    },
  },
};
</script>

<style scoped>
.container_addP {
  max-width: 800px;
  margin: auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}

h2 {
  margin-bottom: 20px;
}

a {
  display: inline-block;
  margin-bottom: 20px;
  text-decoration: none;
  color: #1976d2;
}

.form-group {
  margin-bottom: 15px;
}

input[type="text"],
input[type="number"],
input[type="file"],
select,
textarea {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

textarea {
  resize: vertical;
}

.errors {
  background-color: #fdd;
  padding: 10px;
  margin-bottom: 15px;
  color: #a00;
  border-radius: 4px;
}

.success {
  background-color: #dfd;
  padding: 10px;
  margin-bottom: 15px;
  color: #060;
  border-radius: 4px;
}

button {
  padding: 10px 20px;
  background-color: #1976d2;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

button:hover {
  background-color: #125ea2;
}
</style>
