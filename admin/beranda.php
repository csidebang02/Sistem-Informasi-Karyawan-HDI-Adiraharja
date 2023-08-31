<?php 
  session_start();
  if($_SESSION['status']!="login"){
    header("location:index.php?pesan=belum_login");
  }else {
    if ($_SESSION['level']!="admin"){
      echo "<script>alert('Maaf, anda tidak memiliki wewenang untuk mengakses halaman ini!');history.go(-1);</script>";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>SIK HDI</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  .scroll-y{
    display: block;
    overflow: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }

  .judul{
    height:50px:
  }

  .tabelkaryawan{
    height:550px;
  }
  
  .tabelakun{
    height:550px;
  }
  .akun{
    height:550px;
    background-color:white;
  }
  .tombol{
    padding-top:10px;
    height:120px;
    background-color:white;
  }
  .halaman{
    height:50px;
  }
  #section1 {padding-top:50px;height:700px;color:black; background-color: white;}

  #section2 {padding-top:50px;height:700px;color:black; background-color: pink;}

  </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="#">SIK HDI</a>

    </div>

    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#section1">Data Karyawan</a></li>
          <li><a href="#section2">Data Akun</a></li>
		</ul>

		<?php
            include '../function/db.php';
              if (@$_SESSION['logged']==true){
                $user_terlogin = @$_SESSION['username'];
              }

              $sql_user = mysqli_query($koneksi,"SELECT * FROM admin WHERE username = '$user_terlogin'") or die(mysqli_errno());
              $data_user = mysqli_fetch_array($sql_user);
        ?>

		<ul class="nav navbar-nav">
          <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Selamat Datang, <?php echo $data_user['username']; ?><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Edit Profile</a></li>
              <li><a href="logout.php">Keluar</a></li>
            </ul>
      	  </li>
      	</ul>

      </div>
    </div>
  </div>
</nav>    

<div id="section1">
  <div class="col-md-12 col-xs-12 judul"><h5><b>Data Karyawan</b></h5></div>
  <div class="col-md-12 col-xs-12 tabelkaryawan">
  <input class="form-control" id="myInput" type="text" placeholder="Cari..">

    <div class="scroll-y" style="max-height:500px;" >

    <table class="table table-striped" id="tabel-kar" style="overflow-y:scroll">
     <thead class="thead-inverse">
        <tr>
            <th>No.</th>      
            <th>NIA</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Tanggal Lahir</th>             
            <th>Alamat</th>
            <th>Kontak</th>
            <th>Email</th>
            <th>Kelola</th>      
        </tr>
     </thead>
     <tbody id="myTable">
        <?php 
        include '../function/db.php';
        $query = mysqli_query($koneksi, "SELECT * FROM karyawan");
        $no = 1;
        while($d = mysqli_fetch_assoc($query)){
        ?>
        <tr>
           <td><center><?php echo $no++; ?></center></td>
           <td><?php echo $d['nia_karyawan']; ?></td>
           <td><a href="profile.php?id=<?php echo $d['id_karyawan'];?>"><?php echo $d['nama_karyawan']; ?></a></td>

           <td><?php echo $d['jk_karyawan']; ?></td>
           <td><?php echo $d['jabatan_karyawan']; ?></td>
           <td><?php echo $d['tanggal_lahir_karyawan']; ?></td>
           <td><?php echo $d['alamat_karyawan']; ?></td>
           <td><?php echo $d['kontak_karyawan']; ?></td>
           <td><?php echo $d['email_karyawan']; ?></td>
           <td>
              <a href="#" data-toggle="modal" data-target="#modal-edit<?php echo $d['nia_karyawan'];?>" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-cog"></span></a>
              <a href="hapus_karyawan.php?nia=<?php echo $d['nia_karyawan'];?>"onclick="javascript: return confirm('Anda akan menghapus data ?')" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-remove "></span></a>
           </td>
        </tr>

<!-- modal edit-->
<div class="modal fade" id="modal-edit<?php echo $d['nia_karyawan'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<?php
  include '../function/db.php';
  $nia = $d['nia_karyawan'];
  $data = mysqli_query($koneksi, "SELECT * FROM karyawan where nia_karyawan='$nia'");
  $d = mysqli_fetch_array($data);
  ?>
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Edit data</h4>
		</div>
		<div class="modal-body">
            <form action="ubah_karyawan_aksi.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama</label>
					<input name="nama" type="text" class="form-control" value="<?php echo $d['nama_karyawan'];?>" required>
				</div>
                <div class="form-group">
					<label>NIA</label>
					<input name="nia" type="text" class="form-control" value="<?php echo $d['nia_karyawan'];?>" required>
				</div>
                <div class="form-group">
					<label>Jenis Kelamin</label>
                    <select class="form-control" name="jeniskelamin" value="<?php echo $d['jk_karyawan'];?>" required>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
				</div>
                <div class="form-group">
					<label>Jabatan</label>
					<input name="jabatan"type="text" class="form-control" value="<?php echo $d['jabatan_karyawan'];?>" required>
				</div>
                <div class="form-group">
					<label>Tanggal Lahir</label>
					<input name="tanggallahir" type="date" class="form-control" value="<?php echo $d['tanggal_lahir_karyawan'];?>" required>
				</div>
                <div class="form-group">
					<label>Alamat</label>
					<input name="alamat" type="text" class="form-control" value="<?php echo $d['alamat_karyawan'];?>" required>
				</div>
                <div class="form-group">
					<label>Kontak</label>
					<input name="kontak" type="text" class="form-control" value="<?php echo $d['kontak_karyawan'];?>" required>
				</div>
                <div class="form-group">
					<label>Email</label>
					<input name="email" type="email" class="form-control" value="<?php echo $d['email_karyawan'];?>" required>
				</div>

        <div class="form-group">
					<label>Foto</label>
            <input type="file" accept="image/*" onchange="tampilkanPreview(this,'preview')" name="foto" multiple id="uploadFoto" class="form-control"><br/>
				</div>
        <div class="form-group">
            <center>
              <img id="preview" src="../images/<?php echo $d['foto_karyawan']; ?>" alt="" width="320px">
            </center>
        </div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		</div>		
			</form>
    </div>
</div>
</div>


        <?php 
           }
        ?>
     </tbody>
  
    </table>
    </div>

  </div>

  <div class="col-md-12 col-xs-12 tombol">
  <div class="row">
    <div class="col-md-4 col-xs-4">
      <a href="tambah_karyawan.php" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-plus"></span> Tambah Karyawan</a>
    </div>
    <div class="col-md-4 col-xs-4">
      <a href="unggah_data.php" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-upload"></span> Unggah Data</a>
    </div>
    <div class="col-md-4 col-xs-4">
      <a target="_blank" href="unduh_data.php" class="btn btn-success btn-block"><span class="glyphicon glyphicon-download"></span> Unduh Data</a>
    </div>
  </div>
  </div> 
</div>

<div id="section2">
  <div class="col-md-12 col-xs-12 judul">
    <h5><b>Akun Karyawan</b></h5>
    <input class="form-control" id="myInput2" type="text" placeholder="Cari..">
    <br/>
  </div>

  <div class="row">

  <div class="col-md-6 col-xs-12 tabelakun">
    <div class="scroll-y" style="max-height:550px;">

    <table class="table table-striped" id="tabel-kar" style="overflow-y:scroll">
    <thead class="thead-inverse">
          <tr>
            <th>No.</th>      
            <th>NIA</th>
            <th>Nama Lengkap</th>
            <th>Akun</th>      
          </tr>
        </thead>
        <tbody id="myTable2">
          <?php 
          include '../function/db.php';
          $result = mysqli_query($koneksi, "SELECT * FROM karyawan");          
          $no =1; 

          while($d = mysqli_fetch_array($result)){
          ?>
        <tr>
           <td><?php echo $no++; ?></td>
           <td><?php echo $d['nia_karyawan']; ?></td>
           <td><?php echo $d['nama_karyawan']; ?></td>
           <td>
              <?php 
              $user = $d['nia_karyawan'];
              $akun = mysqli_query($koneksi, "SELECT * FROM akun WHERE nia_karyawan='$user'");
              if (mysqli_fetch_row($akun)>0){
                echo "ada";
              ?>
            </td>
            <td>
              <a href="#" data-toggle="modal" data-target="#modal-edit-akun1<?php echo $d['nia_karyawan']; ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-cog"></span></a>
            </td>
              <?php
              } else {
                echo "Tidak Ada";
              ?>
            </td>
            <td>
              <a href="#" data-toggle="modal" data-target="#modal-edit-akun2<?php echo $d['nia_karyawan']; ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-cog"></span></a>
            </td>
              <?php
              }
              ?>
        </tr>

<!-- modal edit akun1-->
<div class="modal fade" id="modal-edit-akun1<?php echo $d['nia_karyawan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<?php
  include '../function/db.php';
  $nia_akun = $d['nia_karyawan'];
  $data_akun = mysqli_query($koneksi, "SELECT * FROM `akun` where `nia_karyawan`='$nia_akun'");
  $d_a = mysqli_fetch_array($data_akun);
?>
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Ubah Akun</h4>
		</div>
		<div class="modal-body">
            <form action="ubah_akun_aksi.php?nia=<?php echo $d['nia_karyawan'];?>" method="post">
				<div class="form-group">
					<label>Ubah Nama Akun</label>
					<input name="nama_akun" type="text" class="form-control" placeholder="nama akun.." value="<?php echo $d_a['nama_akun'];?>" required>
				</div>
        <div class="form-group">
					<label>Ubah Password</label>
					<input id="pswd" name="password" type="password" class="form-control" required>
          <!--<input id="chk" type="checkbox"><label id="showhide">Show Password</label> -->
				</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Ubah</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		</div>		
			</form>
    </div>
</div>
</div>

<!-- modal edit akun2-->
<div class="modal fade" id="modal-edit-akun2<?php echo $d['nia_karyawan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<?php
  include '../function/db.php';
  $nia_akun = $d['nia_karyawan'];
?>
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Daftar Akun</h4>
		</div>
		<div class="modal-body">
            <form action="daftar_akun_aksi.php?nia=<?php echo $d['nia_karyawan'];?>" method="post">
				<div class="form-group">
					<label>Nama Akun</label>
					<input name="nama_akun" type="text" class="form-control" placeholder="nama akun.." required>
				</div>
        <div class="form-group">
					<label>Ubah Password</label>
					<input id="pswd" name="password" type="password" class="form-control" required>
          <!--<input id="chk" type="checkbox"><label id="showhide">Show Password</label>-->
				</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Daftar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		</div>		
			</form>
    </div>
</div>
</div>

        <?php 
           }
        ?>
        </tbody>
    </table>

    </div>
  </div>


  <div class="col-md-6 col-xs-12 akun">
  
  <div class="scroll-y" style="max-height:550px;">
  <?php 
        include '../function/db.php';
        $data = mysqli_query($koneksi,"SELECT * FROM karyawan");
        if ($data!="") {
        while($d = mysqli_fetch_array($data)){
        ?>
        <div class="col-xs-4 col-md-3" style="padding:5px; height:300px; ">
          <div class="thumbnail" style="height:250px; background:pink;">
            <img src="../images/<?php echo $d['foto_karyawan'];?>" alt="Foto tidak ada" style="height: 100px;" class="img-responsive">
              <div class="caption">
                <h5><a href="profile.php?id=<?php echo $d['id_karyawan'];?>"><?php echo $d['nama_karyawan']; ?></a></h5>
                <p><?php echo $d['jabatan_karyawan'];?></p>
              </div>
            </a>
          </div>
        </div>
        <?php 
           }
        }else {echo "Tidak ada data karyawan";}
        ?>
  </div>
  </div>
  </div>

</div>


<!--<script src="show.js"></script>-->

<script>
	function hapus(nia){
	if (confirm(Anda akan menghapus secara permanen!)) {
      header("hapus_karyawan.php?id=<?php echo $nia?>");
		} else {
			return false;
		}
	}
</script>

<script>
  function tampilkanPreview(gambar,idpreview){
//membuat objek gambar
  var gb = gambar.files;
                
//loop untuk merender gambar
  for (var i = 0; i < gb.length; i++){
//bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);            
    var reader = new FileReader();
                    
    if (gbPreview.type.match(imageType)) {
//jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element) { 
        return function(e) { 
          element.src = e.target.result; 
        }; 
      })(preview);
 
    //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }else{
//jika tipe data tidak sesuai
      alert("Type file tidak sesuai. Khusus image.");
    }
                   
  }    
  }
</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
$(document).ready(function(){
  $("#myInput2").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>

            
