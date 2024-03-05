<!-- untuk header -->
<?php
session_start();
ob_start();


if (!isset($_SESSION['login'])) {
  // Jika pengguna belum login, alihkan dengan pesan kesalahan
  $pesan = urlencode("Anda belum login.");
  header("Location: ../../auth/login.php?pesan=$pesan");
  exit();
} else if ($_SESSION['role'] != 'admin') {
  // Jika pengguna bukan admin, alihkan dengan pesan kesalahan
  $pesan = urlencode("Anda tidak memiliki akses sebagai admin.");
  header("Location: ../../auth/login.php?pesan=$pesan");
  exit();
}

$judul = "Tambah Data Jabatan";

require "../layout/header.php";
require_once "../../config.php";

// query simpan data
    if (isset($_POST['submit'])) {
        $jabatan = htmlspecialchars($_POST['jabatan']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($jabatan)) {
                $pesan_kesalahan = "Nama Jabatan Wajib diisi";
            }
            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = $pesan_kesalahan;
            } else {
                $result = mysqli_query($connection, "INSERT INTO jabatan(jabatan) VALUES('$jabatan')");
                //session berhasil
                $_SESSION['berhasil'] = "Data Berhasil Disimpan";

                header("Location: jabatan.php");
                exit;
            }
        }
    }


?>
<!-- untuk header -->

<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
   <div class="card col-md-6">
    <div class="card-body">
        <form action="<?= base_url("admin/data_jabatan/tambah.php") ?>" method="post">
            
            <div class="mb-3">
                <label for="">Nama Jabatan</label>
                <input type="text" class="form-control" name="jabatan">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        </form>
    </div>
   </div>
  </div>
</div>

<!-- untuk footer -->
<?php
require "../layout/footer.php";
?>
<!-- untuk footer -->