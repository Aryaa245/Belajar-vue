<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    // ✅ FINAL version of `manage()` (menggabungkan semua data)
    public function manage() {
        $error = '';
        try {
            $products     = $this->Product_model->get_all_products();
            $best_sellers = $this->Product_model->get_all_best_sellers();
            $on_sales     = $this->Product_model->get_all_on_sale();
        } catch (Exception $e) {
            $products     = [];
            $best_sellers = [];
            $on_sales     = [];
            $error = "Gagal mengambil data produk: " . $e->getMessage();
        }

        $this->load->view('products/manage_products', [
            'products'     => $products,
            'best_sellers' => $best_sellers,
            'on_sales'     => $on_sales,
            'error'        => $error
        ]);
    }

    // GET semua produk sebagai JSON
    public function index() {
        header('Content-Type: application/json');
        $products = $this->Product_model->get_all_products();
        echo json_encode($products);
    }

    public function list() {
        $products = $this->Product_model->get_all_products();
        $this->load->view('products_list', ['products' => $products]);
    }

    public function create_form() {
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug        = $this->input->post('slug');
            $title       = $this->input->post('title');
            $specs       = $this->input->post('specs');
            $price       = $this->input->post('price');
            $old_price   = $this->input->post('old_price');
            $status      = $this->input->post('status');
            $category    = $this->input->post('category');
            $buy_link    = $this->input->post('buy_link');
            $description = $this->input->post('description');
            $upload_dir  = realpath(dirname(APPPATH) . '/../vue-project/public/Images/') . '/';

            $image_1 = $this->_upload_file('image_1_file', $upload_dir, $errors, 'Gambar 1');
            $image_2 = $this->_upload_file('image_2_file', $upload_dir, $errors, 'Gambar 2');
            $image_3 = $this->_upload_file('image_3_file', $upload_dir, $errors, 'Gambar 3');
            $qr_code = $this->_upload_file('qr_code_file', $upload_dir, $errors, 'QR Code');

            if (empty($image_1)) $errors[] = "Gambar 1 wajib diupload.";

            if (empty($errors)) {
                $this->db->insert('products', [
                    'slug'        => $slug,
                    'title'       => $title,
                    'specs'       => $specs,
                    'price'       => $price,
                    'old_price'   => $old_price,
                    'status'      => $status,
                    'image_1'     => $image_1,
                    'image_2'     => $image_2,
                    'image_3'     => $image_3,
                    'category'    => $category,
                    'buy_link'    => $buy_link,
                    'description' => $description,
                    'qr_code'     => $qr_code
                ]);
                $success = true;
            }
        }

        $this->load->view('products/create_form', [
            'errors'  => $errors,
            'success' => $success
        ]);
    }

    public function delete($id) {
        if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) show_error('Produk tidak ditemukan.', 404);

        $basePath = realpath(dirname(APPPATH) . '/../vue-project/public');

        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) unlink($filePath);
            }
        }

        $this->Product_model->delete_product($id);
        redirect('index.php/products/manage?deleted=1');
    }

    public function detail($slug) {
        header('Content-Type: application/json');
        $product = $this->Product_model->get_product_by_slug($slug);
        echo json_encode($product ? $product : ['error' => 'Produk tidak ditemukan']);
    }

    public function detail_view($slug) {
        $product = $this->Product_model->get_product_by_slug($slug);
        if ($product) {
            $this->load->view('product_detail', ['product' => $product]);
        } else {
            show_404();
        }
    }

    public function edit($id) {
        if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) show_error('Produk tidak ditemukan.', 404);

        $errors = [];
        $success = false;

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $data_update = [
                'title'       => $this->input->post('title'),
                'specs'       => $this->input->post('specs'),
                'price'       => $this->input->post('price'),
                'old_price'   => $this->input->post('old_price'),
                'status'      => $this->input->post('status'),
                'category'    => $this->input->post('category'),
                'buy_link'    => $this->input->post('buy_link'),
                'description' => $this->input->post('description')
            ];

            try {
                $this->Product_model->update_product($id, $data_update);
                $success = true;
                $product = $this->Product_model->get_product_by_id($id);
            } catch (Exception $e) {
                $errors[] = "Gagal mengupdate produk: " . $e->getMessage();
            }
        }

        $this->load->view('products/edit_product', [
            'product' => $product,
            'errors'  => $errors,
            'success' => $success
        ]);
    }

    // Helper upload file
    private function _upload_file($field_name, $upload_path, &$errors, $label) {
        if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
            $filename = time() . '_' . basename($_FILES[$field_name]['name']);
            $target_path = $upload_path . $filename;
            if (move_uploaded_file($_FILES[$field_name]['tmp_name'], $target_path)) {
                return '/Images/' . $filename;
            } else {
                $errors[] = "Gagal mengupload $label.";
            }
        }
        return '';
    }

	// EDIT BEST SELLER
public function edit_best_seller($id) {
    $this->load->model('Product_model');
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_best_seller_by_id($id);
    if (!$product) show_error('Produk Best Seller tidak ditemukan.', 404);

    $errors = [];
    $success = false;

    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $data_update = [
            'title'       => $this->input->post('title'),
            'specs'       => $this->input->post('specs'),
            'price'       => $this->input->post('price'),
            'old_price'   => $this->input->post('old_price'),
            'status'      => $this->input->post('status'),
            'category'    => $this->input->post('category'),
            'buy_link'    => $this->input->post('buy_link'),
            'description' => $this->input->post('description')
        ];

        try {
            $this->Product_model->update_best_seller($id, $data_update);
            $success = true;
            $product = $this->Product_model->get_best_seller_by_id($id);
        } catch (Exception $e) {
            $errors[] = "Gagal mengupdate produk best seller: " . $e->getMessage();
        }
    }

    $this->load->view('products/edit_best_seller', [
        'product' => $product,
        'errors'  => $errors,
        'success' => $success
    ]);
}

// DELETE BEST SELLER
public function delete_best_seller($id) {
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_best_seller_by_id($id);
    if (!$product) show_error('Produk Best Seller tidak ditemukan.', 404);

    $this->Product_model->delete_best_seller($id);

    redirect('index.php/products/manage?deleted=1');
}

// EDIT ON SALE
public function edit_on_sale($id) {
    $this->load->model('Product_model');
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_on_sale_by_id($id);
    if (!$product) show_error('Produk On Sale tidak ditemukan.', 404);

    $errors = [];
    $success = false;

    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $data_update = [
            'title'       => $this->input->post('title'),
            'specs'       => $this->input->post('specs'),
            'price'       => $this->input->post('price'),
            'old_price'   => $this->input->post('old_price'),
            'status'      => $this->input->post('status'),
            'category'    => $this->input->post('category'),
            'buy_link'    => $this->input->post('buy_link'),
            'description' => $this->input->post('description')
        ];

        try {
            $this->Product_model->update_on_sale($id, $data_update);
            $success = true;
            $product = $this->Product_model->get_on_sale_by_id($id);
        } catch (Exception $e) {
            $errors[] = "Gagal mengupdate produk on sale: " . $e->getMessage();
        }
    }

    $this->load->view('products/edit_on_sale', [
        'product' => $product,
        'errors'  => $errors,
        'success' => $success
    ]);
}
public function delete_on_sale($id) {
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_on_sale_by_id($id);
    if (!$product) show_error('Produk On Sale tidak ditemukan.', 404);

    $this->Product_model->delete_on_sale($id);

    redirect('index.php/products/manage?deleted=1');
}
	
}
