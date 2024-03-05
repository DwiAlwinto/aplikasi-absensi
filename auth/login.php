<?php
    session_start();
    require "../config.php";

    // cek tombol login di tekan atau tidak
    if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $result = mysqli_query($connection, "SELECT * FROM users JOIN pegawai ON users.id_pegawai = pegawai.id WHERE username = '$username' ");
      if (mysqli_num_rows($result) === 1) {
        //pengecekan password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
          if ($row['status'] == 'Aktif') {

              $_SESSION['login'] = true;
              $_SESSION['id'] = $row['id'];
              $_SESSION['role'] = $row['role'];
              $_SESSION['nip'] = $row['nip'];
              $_SESSION['jabatan'] = $row['jabatan'];
              $_SESSION['lokasi_presensi'] = $row['lokasi_presensi'];
              if ($row['role'] === 'admin') {
                header("Location: ../admin/home/home.php");
                exit();
              } else {
                header("Location: ../pegawai/home/home.php");
                exit();
              }




          } else {
            $_SESSION['gagal'] = "Akun Anda belum aktif";
          }
        } else {
          $_SESSION['gagal'] = "Password salah silahkan coba lagi";
        }
      } else {
        $_SESSION['gagal'] = "Username salah silahkan coba lagi";
        // echo "Username Salah !!";
      }
    }
?>
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign in with illustration - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
     <!-- CSS files -->
     <link href="<?= base_url('assets/css/tabler.min.css?1684106062') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/css/tabler-vendors.min.css?1684106062') ?>" rel="stylesheet"/> 
    <link href="<?= base_url('assets/css/demo.min.css?1684106062') ?>" rel="stylesheet"/>

    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">

            <!-- <?= password_hash('123', PASSWORD_DEFAULT); ?> -->
            <?php 
              if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "belum_login") {
                    $_SESSION['gagal'] = "Anda Belum Login";
                } else if ($_GET['pesan']  == "tolak_akses") {
                  $_SESSION['gagal'] = "Akses ke halaman ini di tolak!";
                }
              }
            ?>
              
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Login Sistem Absensi</h2>
                  <form action="" method="post" autocomplete="off" novalidate>
                    <div class="mb-3">
                      <label class="form-label">User Name</label>
                      <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="on" autofocus >
                    </div>
                    <div class="mb-2">
                      <label class="form-label">
                        Password
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" name="password" placeholder="Password"  autocomplete="on">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                          </a>
                        </span>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-check">
                        <input type="checkbox" class="form-check-input"/>
                        <span class="form-check-label">Remember me on this device</span>
                      </label>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="login" class="btn btn-primary w-100">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg d-none d-lg-block">
            <img src="../assets/img/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
     <!-- Libs JS -->
     <script src="<?= base_url('assets/libs/apexcharts/dist/apexcharts.min.js?1684106062')?>" defer></script>
    <script src="<?= base_url('assets/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062')?>" defer></script>
    <script src="<?= base_url('assets/libs/jsvectormap/dist/maps/world.js?1684106062')?>" defer></script>
    <script src="<?= base_url('assets/libs/jsvectormap/dist/maps/world-merc.js?1684106062')?>" defer></script>
    <!-- Tabler Core -->
    <script src="<?= base_url('assets/js/tabler.min.js?1684106062')?>" defer></script>
    <script src="<?= base_url('assets/js/demo.min.js?1684106062')?>" defer></script>
    
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- sweet alert gagal -->

    <?php if ($_SESSION['gagal']) { ?>
      <script>
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "<?= $_SESSION['gagal']?>",
        });
        </script>
      
      <?php unset($_SESSION['gagal']); ?>

     <?php } ?>
   

  </body>
</html>