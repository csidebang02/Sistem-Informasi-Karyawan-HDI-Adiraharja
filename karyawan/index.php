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
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="../logo.png">  
  <title>SIK HDI</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap3.css">
  <link rel="stylesheet" href="css/jam.css">

  <style>  
  body {
      position: relative;
  }
  #section1 {height:650px;color:black; background-color: white;}
  #section2 {padding-top:50px;color:black; background-color: white;}


@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}

</style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="#">SIK HDI
      <?php date_default_timezone_set('Asia/jakarta');
      echo date('l, F d Y');?>
      </a>
    </div>

    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#section1">Beranda</a></li>
          <li><a href="#section2">Info Karyawan</a></li>
          <li><a href="../new/struktur.html">Struktur</a></li>
          <li><a href="filesharing.php">File Sharing</a></li>
		    </ul>
    <?php
            include '../function/db.php';
              if (@$_SESSION['logged']==true){
                $user_terlogin = @$_SESSION['nia'];
              }

              $sql_user = mysqli_query($koneksi,"SELECT * FROM akun WHERE nia_karyawan = '$user_terlogin'") or die(mysqli_errno());
              $data_user = mysqli_fetch_array($sql_user);
        ?>

		    <ul class="nav navbar-nav">
          <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Hai, <?php echo $data_user['nama_akun']; ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="profile.php?nia=<?php echo $data_user['nia_karyawan']; ?>">Profile</a></li>
              <li><a href="logout.php">Keluar</a></li>
            </ul>
      	  </li>
      	</ul>

      </div>
    </div>
  </div>
</nav>    

<div id="section1" background="cream">
  <div style="margin-top:60px;">
    <center>
      <h2>Selamat Datang di</h2>
      <h1>Sistem Informasi Karyawan</h1>
    </center>
  </div>

  
  <div class="container" style="margin-top:100px;">
    <div class="col-lg-12 col-md-12">
       <!--ULANG TAHUN-->
	<?php
		$hbd = date('m-d');
		$query = "SELECT * FROM karyawan WHERE tgl_lahir_karyawan='$hbd' ";
		$result = mysqli_query($koneksi,$query);
		$data = mysqli_num_rows($result);

		if ($data > 0) {
	?>
    <section id="hbd" class="py-5 text-center bg-light" style="margin-top:-100px;">
    <div id="kalendar" class="carousel slide" data-ride="carousel" data-interval="2000">
    <div class="carousel-inner">
        <div class="item active">
		      <div class="info-header mb-5">
		        <h1 class="text-primary pb-3">
		          Selamat Ulang Tahun,
		        </h1>
		        	<?php
		        		$query = "SELECT * FROM karyawan WHERE tgl_lahir_karyawan='$hbd' ";
		        		$result = mysqli_query($koneksi,$query);
		        		while ($data = mysqli_fetch_array($result)) {
		        	?>
				        	<h4 class="text-center"><?php echo $data['nama_karyawan'] ?></h4>
		        	<?php
		        		}
		        	?>
		      </div>
        </div>

        <div class="item">
  <?php
  include'../function/kalender.php'; ?>
  <center>
  <div class="jam">
    <div class="kotak">
        <p id="jam"></p>
    </div>
    <div class="kotak">
        <p id="menit"></p>
    </div>
    <div class="kotak">
        <p id="detik"></p>
    </div>
  </div>
  </center>
        </div>

    </div>
  </div>
  </section>
  
  <?php } else { ?>
  <div class="col-md-12 col-lg-12" style="margin-top:-90px;">
    <?php
  include'../function/kalender.php'; ?>
  <center>
  <div class="jam">
    <div class="kotak">
        <p id="jam"></p>
    </div>
    <div class="kotak">
        <p id="menit"></p>
    </div>
    <div class="kotak">
        <p id="detik"></p>
    </div>
  </div>
  </center>
  </div>
  <?php
  } ?>
  </div>
</div>

<div style="margin-top:20px;">
 <center>
    <h2><img src="img/logohdi.png" width="85" height="85">PT. HDI ADI RAHARJA</h2>
 </center>
</div>

  <div id="jadwal" class="carousel slide" data-ride="carousel" style="margin-top:15px;">
    <div class="carousel-inner">
        <div class="item active">
          <center>
            <h1>Timeline Kerja</h1>
            <h3>PT HDI SEMARANG</h3>
            <h2>Semangat</h2>
          </center>
        </div>
        <?php 
        include '../function/db.php';
        $lama = 0;
        $kueri = "DELETE FROM jadwal WHERE DATEDIFF(CURDATE(), tanggal_jadwal) > $lama";
        $hapus = mysqli_query($koneksi, $kueri);
        $query = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY tanggal_jadwal ASC");
        $no = 1;
        while($d = mysqli_fetch_assoc($query)){
          $date_end = new DateTime($d['tanggal_jadwal']);
          date_default_timezone_set('Asia/jakarta');
          $remain = $date_end->diff(new DateTime());
          $remain->d = $remain->d + 1;
        ?>
        <div class="item">
          <center>
            <h1><?php echo $d['kegiatan'];?></h1>
            <h3><?php echo $d['tanggal_jadwal'];?></h3>
            <?php if ($remain->m > 0) {
              echo "<h2 style='color:red;'>$remain->m bulan, $remain->d hari lagi</h2>";
            } elseif ($remain->d > 0) {
              echo "<h2 style='color:red;'>$remain->d hari lagi</h2>";
            } else {
              echo "<h2 style='color:red;'> Hari Ini </h2>";
            } ?>
          </center>
        </div>
        <?php }
        ?>
    </div>

    <a href="#jadwal" class="carousel-control left" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a href="#jadwal" class="carousel-control right" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<div class="row">
  <center>
    <a href="#" data-toggle="modal" data-target="#modal-tambah-jadwal" class="btn btn-success btn-block" style="width:150px;"><i class="fa fa-edit"></i> Tambah Jadwal</a>
  </center>
</div>

</div>

<!-- modal tambah timeline-->
<div class="modal fade" id="modal-tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Tambah Program Kerja</h4>
		</div>
		<div class="modal-body">
            <form action="tambah_timeline_aksi.php" method="post">
      <div class="form-group">
					<label>Kegiatan</label>
					<input name="kegiatan" type="text" class="form-control" placeholder="Kegiatan..." required>
		  </div>        
      <div class="form-group">
					<label>Tanggal Pelaksanaan</label>
          <input name="tanggal" type="date" class="form-control" placeholder="Pada tanggal.." required>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		</div>		
			</form>
    </div>
</div>
</div>

<div id="section2">
      <?php 
        include '../function/db.php';
        $karyawan = mysqli_query($koneksi,"SELECT * FROM karyawan");
        if ($karyawan!="") {
        while($k = mysqli_fetch_array($karyawan)){
        ?>
        <div class="col-xs-4 col-sm-2" style="padding-left: 5px">
          <div class="thumbnail" style="height:200px;">
              <img class="img-responsive" style="height:150px;" src="../images/<?php echo $k['foto_karyawan'];?>" >
            <caption>
              <center>
                  <a href="#" data-toggle="modal" data-target="#modal-karyawan<?php echo $k['nia_karyawan'];?>"><?php echo $k['nama_karyawan'];?></a>
              </center>
            </caption>
          </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="modal-karyawan<?php echo $k['nia_karyawan'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<?php 
    include '../function/db.php';
    $nia = $k['nia_karyawan'];
    $data = mysqli_query($koneksi,"SELECT * FROM karyawan where nia_karyawan='$nia'");
    $d = mysqli_fetch_array($data);
    ?>
  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?php echo $d['nama_karyawan']; ?></h4>
				</div>
				<div class="modal-body">
    
    <center>
    <div class="thumbnail" style="height:350px; width:300px;">
        <img  style="height:300px; width:300px;" alt="tidak ada foto" src="../images/<?php echo $d['foto_karyawan']; ?>">
    </div>
        <table class="table-striped">
          <tr>
            <td>Nama</td>
            <td> : </td>
            <td><?php echo $d['nama_karyawan']; ?></td>
          </tr>
        <tr>
          <td>NIA</td>
          <td> : </td>
          <td><?php echo $d['nia_karyawan']; ?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td> : </td>
          <td><?php echo $d['jk_karyawan']; ?></td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td> : </td>
          <td><?php echo $d['jabatan_karyawan']; ?></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td> : </td>
          <td><?php echo $d['tanggal_lahir_karyawan']; ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td> : </td>
          <td><?php echo $d['alamat_karyawan']; ?></td>
        </tr>
        <tr>
          <td>Kontak</td>
          <td> : </td>
          <td><?php echo $d['kontak_karyawan']; ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td> : </td>
          <td><?php echo $d['email_karyawan']; ?></td>
        </tr>
        </table>
    </center>
		    </div>
		</div>
	</div>
</div>

  <?php 
        }
  }else {echo "Tidak ada data karyawan";}
  ?>
  
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script>
	window.setTimeout("waktu()", 1000);
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}
</script>
</body>
</html>


