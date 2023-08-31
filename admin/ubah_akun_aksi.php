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

    $update = $koneksi->query("UPDATE `akun` SET `nama_akun`='$akun' , `kata_sandi`='$pass' WHERE `akun`.`nia_karyawan`='$nia'");
      if($update){
        echo "<script>alert('Akun berhasil diubah');</script>";
        echo "<script>history.go(-1);</script>";
      }else{
        echo "<script>alert('Gagal mengubah akun!');history.go(-1);</script>";
        exit;
      }

?>