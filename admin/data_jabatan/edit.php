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

$judul = "Edit Data Jabatan";

require "../layout/header.php";
require_once "../../config.php";



// query simpan data
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $jabatan = htmlspecialchars($_POST['jabatan']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($jabatan)) {
                $pesan_kesalahan = "Nama Jabatan Wajib diisi";
            }
            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = $pesan_kesalahan;
            } else {
                $result = mysqli_query($connection, "UPDATE jabatan SET jabatan='$jabatan' WHERE id=$id");
                //session berhasil
                $_SESSION['berhasil'] = "Data Berhasil Diupdate";

                header("Location: jabatan.php");
                exit;
            }
        }
    }

    //!ambil id ketika tombol edit diklik
    //$id = $_GET['id'];
    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id']; //ini untuk form edit kalau kosong
    $result = mysqli_query($connection, "SELECT * FROM jabatan where id=$id ");
    while($jabatan = mysqli_fetch_array($result)) {
        $nama_jabatan = $jabatan['jabatan'];
    }
    //!ambil id ketika tombol edit diklik


?>
<!-- untuk header -->

<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
   <div class="card col-md-6">
    <div class="card-body">
        <form action="<?= base_url("admin/data_jabatan/edit.php") ?>" method="post">
            
            <div class="mb-3">
                <label for="">Nama Jabatan</label>
                <input type="text" class="form-control" name="jabatan" value="<?= $nama_jabatan; ?>">
            </div>

            <input type="hidden" name="id" value="<?= $id; ?>" class="form-control mb-2">
            <button type="submit" class="btn btn-primary" name="update">Update</button>
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