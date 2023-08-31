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

  $kegiatan      = $_POST['kegiatan'];
  $tanggal        = $_POST['tanggal'];
  
  $insert = $koneksi->query("INSERT INTO `jadwal`(`tanggal_jadwal`, `kegiatan`) VALUES ('$tanggal', '$kegiatan')");
      if($insert){ 
      echo '<div class="alert alert-warning">Jadwal berhasil ditambah</div>';
      echo "<script>history.go(-1);</script>";
      }else{
        echo "<script>alert('Gagal menambah data!');history.go(-1);</script>";
        exit;
      }
?>