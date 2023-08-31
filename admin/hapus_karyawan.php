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

  $nia = $_GET['nia'];

  $result = $koneksi->query("SELECT * FROM karyawan WHERE nia_karyawan='$nia'");

  $data = mysqli_fetch_array($result);
  $foto   = "../images/".$data['foto_karyawan'];
  if(file_exists($foto)){
    unlink($foto);
    $delete = $koneksi->query("DELETE FROM karyawan WHERE nia_karyawan='$nia'");
    if($delete){
      echo "<script>alert('Data anggota berhasil di hapus');</script>";
      echo "<script>location='beranda.php';</script>";
    }else{
      echo "<script>alert('Gagal menghapus data!');history.go(-1);</script>";
      exit;
    }
  } else {
    echo "<script>alert('Tidak ada foto terkait');history.go(-1);</script>";

    $delete = $koneksi->query("DELETE FROM karyawan WHERE nia_karyawan='$nia'");
    if($delete){
      echo "<script>alert('Data anggota berhasil di hapus');</script>";
      echo "<script>location='beranda.php';</script>";
    }else{
      echo "<script>alert('Gagal menghapus data!');history.go(-1);</script>";
      exit;
    }
  }

?>