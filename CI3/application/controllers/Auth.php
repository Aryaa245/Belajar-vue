<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        // CORS global (minimal support)
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
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
                        'user_id'      => $user->id,
                        'username'     => $user->username,
                        'nama_lengkap' => $user->nama_lengkap,
                        'role'         => $user->role
                    ]);

                    redirect(base_url('index.php/users/dashboard_user'));
                } else {
                    $errors[] = "Username atau password salah.";
                }
            }
        }

        $this->load->view('auth/login', [
            'errors'           => $errors,
            'username'         => $username,
            'success_message'  => $success_message
        ]);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('index.php/auth/login');
    }

    public function login_api() {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        exit(0); // preflight CORS
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $username = trim($data['username'] ?? '');
    $password = trim($data['password'] ?? '');

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => false, 'message' => 'Username dan password wajib diisi']);
        return;
    }

    $this->load->model('User_model');
    $user = $this->User_model->get_by_username($username);

    if ($user && password_verify($password, $user['password'])) {
        // Simpan ke session CI
        $this->session->set_userdata([
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role'         => $user['role']
        ]);

        // Kirim data user ke Vue agar bisa disimpan di sessionStorage
        echo json_encode([
            'status' => true,
            'message' => 'Login berhasil',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role' => $user['role']
            ]
        ]);
    } else {
        echo json_encode(['status' => false, 'message' => 'Username atau password salah']);
    }
}



    // public function logout_api() {
    //     header("Access-Control-Allow-Origin: http://localhost:5173");
    //     header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    //     header("Access-Control-Allow-Headers: Content-Type, Authorization");
    //     header("Content-Type: application/json");

    //     $this->session->sess_destroy();

    //     echo json_encode(['status' => true, 'message' => 'Logout berhasil']);
    // }

	public function logout_api() {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    $this->session->sess_destroy();

    echo json_encode([
        'status' => true,
        'message' => 'Logout berhasil'
    ]);
}


}
