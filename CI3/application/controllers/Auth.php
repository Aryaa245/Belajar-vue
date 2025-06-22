<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); // Ini cukup, tidak perlu session_start
    }

    public function login() {
        $errors = [];
        $username = "";
        $success_message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($this->input->post('username'));
            $password = $this->input->post('password');

            if (empty($username)) { $errors[] = "Username wajib diisi."; }
            if (empty($password)) { $errors[] = "Password wajib diisi."; }

            if (empty($errors)) {
                $query = $this->db->query("SELECT * FROM users WHERE username = ?", [$username]);
                $user = $query->row();

                if ($user && password_verify($password, $user->password)) {
                    $this->session->set_userdata([
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'nama_lengkap' => $user->nama_lengkap,
                        'role' => $user->role
                    ]);

                    redirect(base_url('index.php/users/dashboard_user'));

                } else {
                    $errors[] = "Username atau password salah.";
                }
            }
        }

        $this->load->view('auth/login', [
            'errors' => $errors,
            'username' => $username,
            'success_message' => $success_message
        ]);
    }

	 public function logout()
    {
        // Mulai session (jika belum)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Hapus semua data session
        session_unset();
        session_destroy();

        // Redirect ke halaman login
        redirect('index.php/auth/login');
    }
}
