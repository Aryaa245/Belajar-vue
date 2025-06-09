<?php
session_start();
include 'db.php';

$error = '';
$success = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Simpan data user ke session
        $_SESSION['user'] = $user;

        // Redirect ke Vue frontend, misal:
        header("Location:  http://localhost:5173/homepage");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login & Register</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
  <style>
    /* style mirip sebelumnya */
    body {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    #app {
      background: white;
      padding: 2rem 3rem;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      width: 360px;
      text-align: center;
    }
    h1 {
      margin-bottom: 1.5rem;
      color: #333;
    }
    input[type="text"], input[type="password"], input[type="email"] {
      width: 100%;
      padding: 0.8rem 1rem;
      margin-bottom: 1.2rem;
      border: 1.5px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }
    input:focus {
      outline: none;
      border-color: #2575fc;
      box-shadow: 0 0 5px #2575fc;
    }
    button {
      width: 100%;
      padding: 0.8rem 1rem;
      background: #2575fc;
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background: #1a52d1;
    }
    .error-msg {
      color: #d93025;
      margin-bottom: 1rem;
      font-weight: 600;
    }
    .success-msg {
      color: #188038;
      margin-bottom: 1rem;
      font-weight: 600;
    }
    .toggle-btns {
      margin-bottom: 1.5rem;
      display: flex;
      justify-content: center;
      gap: 1rem;
    }
    .toggle-btns button {
      width: auto;
      padding: 0.5rem 1rem;
      font-weight: 600;
      background: #eee;
      color: #555;
      border-radius: 8px;
      transition: background-color 0.3s ease;
      cursor: pointer;
      border: 1px solid #ccc;
    }
    .toggle-btns button.active {
      background: #2575fc;
      color: white;
      border-color: #2575fc;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="toggle-btns">
      <button :class="{active: mode === 'login'}" @click="mode = 'login'">Sudah Punya Akun</button>
      <button :class="{active: mode === 'register'}" @click="mode = 'register'">Belum Punya Akun</button>
    </div>

    <h1 v-if="mode === 'login'">Login Admin</h1>
    <h1 v-else>Daftar Akun Baru</h1>

    <?php if($error): ?>
      <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php elseif($success): ?>
      <div class="success-msg"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORM LOGIN -->
    <form v-if="mode === 'login'" method="POST" @submit="validateLogin">
      <input
        type="text"
        name="username"
        placeholder="Username"
        v-model="loginUsername"
        autocomplete="off"
      />
      <input
        type="password"
        name="password"
        placeholder="Password"
        v-model="loginPassword"
        autocomplete="off"
      />
      <button type="submit" name="login">Masuk</button>
    </form>

    <!-- FORM REGISTER -->
    <form v-else method="POST" @submit="validateRegister">
      <input
        type="text"
        name="username"
        placeholder="Username"
        v-model="regUsername"
        autocomplete="off"
      />
      <input
        type="password"
        name="password"
        placeholder="Password"
        v-model="regPassword"
        autocomplete="off"
      />
      <input
        type="text"
        name="nama_lengkap"
        placeholder="Nama Lengkap"
        v-model="regNama"
      />
      <input
        type="email"
        name="email"
        placeholder="Email"
        v-model="regEmail"
      />
      <button type="submit" name="register">Daftar</button>
    </form>
  </div>

  <script>
    Vue.createApp({
      data() {
        return {
          mode: 'login',
          loginUsername: '',
          loginPassword: '',
          regUsername: '',
          regPassword: '',
          regNama: '',
          regEmail: ''
        }
      },
      methods: {
        validateLogin(e) {
          if (!this.loginUsername || !this.loginPassword) {
            alert('Mohon isi username dan password untuk login');
            e.preventDefault();
          }
        },
        validateRegister(e) {
          if (!this.regUsername || !this.regPassword || !this.regNama || !this.regEmail) {
            alert('Mohon isi semua field untuk pendaftaran');
            e.preventDefault();
          }
        }
      }
    }).mount('#app')
  </script>
</body>
</html>
