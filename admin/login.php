<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include '../function/db.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"SELECT * FROM admin where username='$username' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	$_SESSION['logged'] = true;
	$_SESSION['level'] = "admin";
	header("location:beranda.php");
}else{
	$_SESSION['logged'] = false;
	header("location:index.php?pesan=gagal");
}

?>