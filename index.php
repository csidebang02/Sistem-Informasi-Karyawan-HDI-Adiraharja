<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="logo.png">
	<title>SIK HDI</title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
</head>
<body>	
	<center>
		<h2>Selamat Datang Di</h2>
		<h2>Sistem Informasi Karyawan</h2>
		<h2>PT.HDI ADI RAHARJA</h2>
	<div class="login col-lg-12 col-md-12 col-xs-12">
		<form action="login_aksi.php" method="post" onSubmit="return validasi()">
			<div>
				<label>Nomor Induk Anggota:</label>
				<input type="text" name="nia" id="nia" />
			</div>
			<div>
				<label>Kata Sandi:</label>
				<input type="password" name="password" id="password" />
			</div>			
			<div>
				<input type="submit" value="Masuk" class="tombol">
			</div>
		</form>
	</div>
	</center>
</body>

<script type="text/javascript">
	function validasi() {
		var nik = document.getElementById("nia").value;
		var password = document.getElementById("password").value;		
		if (nia != "" && password!="") {
			return true;
		}else{
			alert('NIA dan Kata Sandi harus di isi !');
			return false;
		}
	}
</script>
</html>
