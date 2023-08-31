<?php

include '../function/db.php';
session_start();

  if($_SESSION['status']!="login"){
    header("location:index.php?pesan=belum_login");
  }else {
    if ($_SESSION['level']!="admin"){
      echo "<script>alert('Maaf, anda tidak memiliki wewenang untuk mengakses halaman ini!');history.go(-1);</script>";
    }
  }

$id_target = $_GET['id_target'];

$delete = $koneksi->query("DELETE FROM `target` WHERE `id_target` ='$id_target'");
    if($delete){
      echo "<script>alert('Target berhasil dihapus');history.go(-1);</script>";
    }else{
      echo "<script>alert('Gagal menghapus data!');history.go(-1);</script>";
      exit;
    }

?>