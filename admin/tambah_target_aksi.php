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

  $id_karyawan=$_GET['id_karyawan'];
  $judul      = $_POST['judul'];
  $batas_tanggal        = $_POST['tgl_target'];
  $keterangan    = $_POST['keterangan'];
  
  $insert = $koneksi->query("INSERT INTO `target`(`tanggal_target`, `judul_target`, `keterangan_target`, `id_karyawan`) VALUES ('$batas_tanggal', '$judul', '$keterangan', '$id_karyawan')");
      if($insert){ 
      echo '<div class="alert alert-warning">Target berhasil ditambah</div>';
      echo "<script>history.go(-1);</script>";
      }else{
        echo "<script>alert('Gagal menambah data!');history.go(-1);</script>";
        exit;
      }
?>