<?php
session_start();


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

$judul = "Data Lokasi Presensi";

require "../layout/header.php";
require_once "../../config.php";
$result = mysqli_query($connection, "SELECT * FROM lokasi_presensi ORDER BY id DESC");

?>

<div class="page-body">
  <div class="container-xl">
  <a href="<?= base_url("admin/data_lokasi_presensi/tambah.php") ?>" class="btn btn-primary"><span class="text"><i class="fa-solid fa-square-plus"></i> Tambah Data</span></a>

    <table class="table table-bordered mt-3">
        <tr class="text-center">
            <th>No.</th>
            <th>Nama Lokasi</th>
            <th>Tipe Lokasi</th>
            <th>Latutide/Langitude</th>
            <th>Radius</th>
            <th>Action</th>
        </tr>

        <!-- looping datanya  -->
        <?php if(mysqli_num_rows($result) === 0) { ?>
            <tr>
                <td colspan="6" class="text-center">Data Kosong, Silahkan Tambah data Baru.</td>
            </tr>
            <?php } else { ?>
                <?php 
                    $no= 1;
                    while($lokasi = mysqli_fetch_array($result)) : ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $lokasi['nama_lokasi'] ?></td>
                            <td><?= $lokasi['tipe_lokasi'] ?></td>
                            <td><?= $lokasi['latitude'] . '/' . $lokasi['longitude'] ?></td>
                            <td><?= $lokasi['radius'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/data_lokasi_presensi/detail.php?id='. $lokasi['id']) ?>" class="badge badge-pill bg-primary">Detail</a>

                                <a href="<?= base_url('admin/data_lokasi_presensi/edit.php?id='. $lokasi['id']) ?>" class="badge badge-pill bg-warning">Edit</a>

                                <a href="<?= base_url('admin/data_lokasi_presensi/hapus.php?id='. $lokasi['id']) ?>" class="badge badge-pill bg-danger tombol-hapus">Hapus</a>

                                
                            </td>



                        </tr>
                    <?php endwhile; ?>

            <?php } ?>
                
    </table>

  </div>
</div>

<!-- untuk footer -->
<?php
require "../layout/footer.php";
?>
<!-- untuk footer -->