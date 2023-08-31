<!DOCTYPE html>
<html>
<head>
	<title>ADMIN HDI</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<script src="jquery/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<style>
		body {
  	background: orange;
  	font-family: sans-serif;
	}

	.login {
  	padding: 1em;
  	margin: 2em auto;
  	width: 17em;
  	background: black;
  	border-radius: 3px;
	}

	label {
  	font-size: 10pt;
  	color: white;
	}

	input[type="text"],
	input[type="password"],
	textarea {
  		padding: 8px;
  		width: 95%;
  		background: #efefef;
  		border: 0;
  		font-size: 10pt;
  		margin: 6px 0px;
	}

	.tombol {
  		background: orange;
  		color: black;
  		border: 0;
  		padding: 5px 8px;
  		margin: 20px 0px;
		}
	</style>
</head>
<body>
	<div class="container-responsive">
	<center>
		<h2>Selamat Datang Di</h2>
		<h2>Sistem Informasi Karyawan</h2>
		<h2>PT.HDI ADI RAHARJA</h2>
	</center>	
	<div class="login">
	<br/>
		<form action="login.php" method="post">
			<div>
				<label>Username:</label>
				<input type="text" name="username" id="username" required />
			</div>
			<div>
				<label>Password:</label>
				<input type="password" name="password" id="password" required />
			</div>			
			<div>
				<center><input type="submit" value="Login" class="tombol"></center>
			</div>
		</form>
	</div>
	</div>
</body>
</html>
