<?php 
include 'function/db.php';

$nia = $_POST['nia'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi,"select * from akun where nia_karyawan='$nia' and kata_sandi='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$_SESSION['nia'] = $nia;
	$_SESSION['status'] = "login";
	$_SESSION['logged'] = true;
	$_SESSION['level'] = "karyawan";
	header("location:karyawan/index.php");
}else{
	header("location:index.php");	
}

?>