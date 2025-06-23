<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    // Ambil semua produk
    public function get_all_products()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('products')->result_array();
    }

    // Ambil 1 produk by slug
    public function get_product_by_slug($slug)
    {
        return $this->db->get_where('products', ['slug' => $slug])->row_array();
    }

    // Simpan produk baru
    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }

    // Update produk
    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    // Hapus produk
    public function delete_product($id)
    {
        return $this->db->delete('products', ['id' => $id]);
    }

    // Ambil semua best seller
    public function get_all_best_sellers()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('best_seller')->result_array();
    }

    // Ambil semua on sale
    public function get_all_on_sale()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('on_sale')->result_array();
    }


	public function get_product_by_id($id)
	{
		$query = $this->db->get_where('products', ['id' => $id]);
		return $query->row_array();
	}

	public function get_best_seller_by_id($id) {
    return $this->db->get_where('best_seller', ['id' => $id])->row_array();
}

public function update_best_seller($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('best_seller', $data);
}

public function delete_best_seller($id) {
    $this->db->where('id', $id);
    return $this->db->delete('best_seller');
}


}
