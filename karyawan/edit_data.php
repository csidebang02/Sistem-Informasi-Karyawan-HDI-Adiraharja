<?php 
  session_start();
  include '../function/db.php';

  if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
  }else {
    if ($_SESSION['level']!="karyawan"){
      echo "<script>alert('Maaf, anda tidak memiliki wewenang untuk mengakses halaman ini!');history.go(-1);</script>";
    }
  }

  $nia      = $_POST['nia'];
  $nama        = $_POST['nama'];
  $jk    = $_POST['jeniskelamin'];
  $jabatan        = $_POST['jabatan'];
  $tgl_lahir      = $_POST['tanggallahir'];
  $alamat = $_POST['alamat'];
  $kontak   = $_POST['kontak'];
  $email  = $_POST['email'];

  define("UPLOAD_DIR", "../images/");
  if(!empty($_FILES["foto"])){
    $foto = $_FILES["foto"];
    $ext    = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $size = $_FILES["foto"]["size"];

    if ($foto["error"] !== UPLOAD_ERR_OK) {
      $update = $koneksi->query("UPDATE `karyawan` SET `nia_karyawan`='$nia', `nama_karyawan`='$nama', `jk_karyawan`='$jk', `jabatan_karyawan`='$jabatan', `tanggal_lahir_karyawan`='$tgl_lahir', `alamat_karyawan`='$alamat', `kontak_karyawan`='$kontak', `email_karyawan`='$email'  WHERE `karyawan`.`nia_karyawan`='$nia'");
      if($update){ 
      echo '<div class="alert alert-warning">Data berhasil diubah. Foto gagal.</div>';
      echo "<script>location='index.php';</script>";
      }else{
        echo "<script>alert('Gagal memperbaharui data!');history.go(-1);</script>";
        exit;
      }
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $foto["name"]);

    // mencegah overwrite filename
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
      $i++;
      $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // upload file
    $success = move_uploaded_file($foto["tmp_name"],
      UPLOAD_DIR . $name);

    if (!$success) {
      $update = $koneksi->query("UPDATE `karyawan` SET `nia_karyawan`='$nia', `nama_karyawan`='$nama', `jk_karyawan`='$jk', `jabatan_karyawan`='$jabatan', `tanggal_lahir_karyawan`='$tgl_lahir', `alamat_karyawan`='$alamat', `kontak_karyawan`='$kontak', `email_karyawan`='$email',  WHERE `karyawan`.`nia_karyawan`='$nia'");
      if($update){ 
      echo '<div class="alert alert-warning">Berhasil update data</div>';
      echo "<script>location='index.php';</script>";
      }else{
        echo "<script>alert('Gagal memperbaharui data!');history.go(-1);</script>";
        exit;
      }
    }else{
      $update = $koneksi->query("UPDATE `karyawan` SET `nia_karyawan`='$nia', `nama_karyawan`='$nama', `jk_karyawan`='$jk', `jabatan_karyawan`='$jabatan', `tanggal_lahir_karyawan`='$tgl_lahir', `alamat_karyawan`='$alamat', `kontak_karyawan`='$kontak', `email_karyawan`='$email', `foto_karyawan`='$name'  WHERE `karyawan`.`nia_karyawan`='$nia'");
      if($update){
        echo "<script>alert('Data anggota berhasil di perbaharui');</script>";
        echo "<script>location='index.php';</script>";
      }else{
        echo "<script>alert('Gagal memperbaharui data!');history.go(-1);</script>";
        exit;
      }
    }

    // set permisi file
    chmod(UPLOAD_DIR . $name, 0644);

  } else{
    $update = $koneksi->query("UPDATE `karyawan` SET `nia_karyawan`='$nia', `nama_karyawan`='$nama', `jk_karyawan`='$jk', `jabatan_karyawan`='$jabatan', `tanggal_lahir_karyawan`='$tgl_lahir', `alamat_karyawan`='$alamat', `kontak_karyawan`='$kontak', `email_karyawan`='$email'  WHERE `karyawan`.`nia_karyawan`='$nia'");
      if($update){
        echo "<script>alert('Data anggota berhasil di perbaharui');</script>";
        echo "<script>location='beranda.php';</script>";
      }else{
        echo "<script>alert('Gagal memperbaharui data!');history.go(-1);</script>";
        exit;
      }
      
  }

?>