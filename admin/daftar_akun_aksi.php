<?php 
  session_start();
  include '../function/db.php';

  if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
  }else {
    if ($_SESSION['level']!="admin"){
      echo "<script>alert('Maaf, anda tidak memiliki wewenang untuk mengakses halaman ini!');history.go(-1);</script>";
    }
  }

  $nia   = $_GET['nia'];
  $akun  = $_POST['nama_akun'];
  $pass    = md5($_POST['password']);

    $insert = $koneksi->query("INSERT INTO `akun`(`nama_akun`,`nia_karyawan`,`kata_sandi`) VALUES('$akun','$nia','$pass')");
      if($insert){
        echo "<script>alert('Akun berhasil ditambah');</script>";
        echo "<script>history.go(-1);</script>";
      }else{
        echo "<script>alert('Gagal menambah akun!');history.go(-1);</script>";
        exit;
      }

?>