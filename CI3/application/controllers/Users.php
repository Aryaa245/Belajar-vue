<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('auth_check'); // Load helper
        require_login(); // Wajib login
    }

    public function index() {
        // Redirect ke dashboard_user
        redirect('users/dashboard_user');
    }

    public function dashboard_user() {
        // Ambil semua user dari database
        $data['users'] = $this->User_model->get_all_users();

        // Cek apakah ada flash message
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type');

        // Load view
        $this->load->view('users/dashboard_user', $data);
    }

	public function create() {
    $errors = [];
    $success = false;

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$username = $this->input->post('username');
			$nama_lengkap = $this->input->post('nama_lengkap');
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$password = $this->input->post('password');

			if (empty($username)) $errors[] = 'Username wajib diisi.';
			if (empty($nama_lengkap)) $errors[] = 'Nama lengkap wajib diisi.';
			if (empty($email)) $errors[] = 'Email wajib diisi.';
			if (empty($password)) $errors[] = 'Password wajib diisi.';

			if (empty($errors)) {
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$data = [
					'username' => $username,
					'nama_lengkap' => $nama_lengkap,
					'email' => $email,
					'role' => $role,
					'password' => $hashed_password,
					'created_at' => date('Y-m-d H:i:s')
				];

				if ($this->User_model->insert_user($data)) {
					$success = true;
				} else {
					$errors[] = 'Gagal menambahkan admin.';
				}
			}
		}

		$this->load->view('users/create', [
			'errors' => $errors,
			'success' => $success
		]);
	}

	public function delete($id)
	{
		// Cegah user menghapus dirinya sendiri
		if ($this->session->userdata('user_id') == $id) {
			$this->session->set_flashdata('message', 'Anda tidak dapat menghapus akun Anda sendiri.');
			$this->session->set_flashdata('message_type', 'error');
			redirect('index.php/users/dashboard_user');
			return;
		}

		// Cek apakah user dengan ID tersebut ada
		$user = $this->User_model->get_user_by_id($id);

		if (!$user) {
			$this->session->set_flashdata('message', 'User tidak ditemukan.');
			$this->session->set_flashdata('message_type', 'error');
		} else {
			if ($this->User_model->delete_user($id)) {
				$this->session->set_flashdata('message', 'User berhasil dihapus.');
				$this->session->set_flashdata('message_type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Terjadi kesalahan saat menghapus user.');
				$this->session->set_flashdata('message_type', 'error');
			}
		}

		redirect('index.php/users/dashboard_user');
	}

	public function edit($id)
	{
		// Ambil data user
		$user = $this->User_model->get_user_by_id($id);

		if ( ! $user) {
			$this->session->set_flashdata('message', 'User tidak ditemukan.');
			$this->session->set_flashdata('message_type', 'error');
			redirect('index.php/users/dashboard_user');
			return;
		}

		$errors = [];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username      = trim($this->input->post('username'));
			$nama_lengkap  = trim($this->input->post('nama_lengkap'));
			$email         = trim($this->input->post('email'));
			$role          = $this->input->post('role');
			$password      = $this->input->post('password');

			// Validasi
			if (empty($username) || empty($nama_lengkap) || empty($email) || empty($role)) {
				$errors[] = "Semua field kecuali password wajib diisi.";
			}

			if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = "Format email tidak valid.";
			}

			if (empty($errors)) {
				// Cek username apakah dipakai oleh user lain
				if ($this->User_model->username_exists_other($username, $id)) {
					$errors[] = "Username sudah digunakan oleh user lain.";
				} else {
					// Update
					$update_data = [
						'username'      => $username,
						'nama_lengkap'  => $nama_lengkap,
						'email'         => $email,
						'role'          => $role
					];

					if ( ! empty($password)) {
						$update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
					}

					if ($this->User_model->update_user($id, $update_data)) {
						$this->session->set_flashdata('message', 'User berhasil diperbarui.');
						$this->session->set_flashdata('message_type', 'success');
						redirect('index.php/users/dashboard_user');
						return;
					} else {
						$errors[] = "Gagal memperbarui user.";
					}
				}
			}
		}

		// Load form edit
		$this->load->view('users/edit_user', [
			'user'    => $user,
			'errors'  => $errors
		]);
	}



}
