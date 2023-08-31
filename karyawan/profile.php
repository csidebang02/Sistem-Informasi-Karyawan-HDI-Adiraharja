<?php 
  session_start();
  
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIK HDI</title>
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <script src="../asset/jquery/jquery.min.js"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
  <style>
  .close{
  background : inherit;
}
.scroll-y{
    display: block;
    overflow: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
  }
.profile{
    height:700px;
    background:orange;
}
.target{
    height:700px;
}

* {
  box-sizing: border-box;
}

body {
  background-color: #474e5d;
  font-family: Helvetica, sans-serif;
}

/* The actual timeline (the vertical ruler) */
.timeline {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
}

/* The actual timeline (the vertical ruler) */
.timeline::after {
  content: '';
  position: absolute;
  width: 6px;
  background-color: orange;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.containerr {
  padding: 10px;
  position: relative;
  background-color: inherit;
  width: 50%;
}

/* The circles on the timeline */
.containerr::after {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  right: -17px;
  background-color: orange;
  border: 4px solid black;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the left */
.left {
  left: 0;
}

/* Place the container to the right */
.right {
  left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -16px;
}

/* The actual content */
.contentt {
  padding: 20px 30px;
  background-color: white;
  position: relative;
  border-radius: 6px;
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
  /* Place the timelime to the left */
  .timeline::after {
  left: 31px;
  }
  
  /* Full-width containers */
  .containerr {
  width: 100%;
  padding-left: 70px;
  padding-right: 25px;
  }
  
  /* Make sure that all arrows are pointing leftwards */
  .containerr::before {
  left: 60px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left::after, .right::after {
  left: 15px;
  }
  
  /* Make all right containers behave like the left ones */
  .right {
  left: 0%;
  }
}
  </style>
</head>
<body>
  <div class="row">
    <div class="col-sm-12 col-md-6">
    <div class="container-fluid" style="background-color: orange; height: 700px; border:1px,solid,black;">
      <center><h2>Profile</h2>
    <?php
    include '../function/db.php';

    $nia = $_GET['nia'];
    $data = mysqli_query($koneksi,"SELECT * FROM karyawan WHERE nia_karyawan='$nia'");
    $d = mysqli_fetch_array($data);
    ?>
    <div class="thumbnail" style="height:350px; width:300px; ">
        <a href="../images/<?php echo $d['foto_karyawan'];?>" target="_blank">
            <img style="height:340px; width:300px; alt="tidak ada foto" src="../images/<?php echo $d['foto_karyawan']; ?>">
        </a>
    </div>
        <table class="table-striped" >
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
      
        <br/>
        <a href="#" data-toggle="modal" data-target="#modal-edit"><button>Ubah Data</button></a>
        <a href="index.php"><button>Kembali</button></a> 
      </center>
    </div>
  </div>
    
    <div class="col-sm-12 col-md-6 target">
      <div class="scroll-y" style="max-height:650px;">
        <div class="timeline">
<?php
  $id=$d['id_karyawan'];
  $target = mysqli_query($koneksi,"SELECT * FROM `target` WHERE `id_karyawan`='$id'");
  while($t = mysqli_fetch_assoc($target)){
  $id_target = $t['id_target'];
  if ($id_target % 2 != 0){
  ?>
  <div class="containerr left">
    <div class="contentt">
      
      <h2><?php echo $t['tanggal_target']; ?></h2>
      <h3><?php echo $t['judul_target']; ?></h3>
      <p><?php echo $t['keterangan_target']; ?></p>
    </div>
  </div>
  <?php } else {?>
  <div class="containerr right">
    <div class="contentt">
    
      <h2><?php echo $t['tanggal_target']; ?></h2>
      <h3><?php echo $t['judul_target']; ?></h3>
      <p><?php echo $t['keterangan_target']; ?></p>  
    </div>
  </div>
  <?php } } ?>

        </div>
      </div>
    </div>
  </div>

  <!-- modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Edit data</h4>
		</div>
		<div class="modal-body">
            <form action="edit_data.php" method="post" enctype="multipart/form-data">
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
					<label>Foto</label>>
                    <input type="file" name="foto" class="form-control"><br/>
                    <img style="height:300px;width:200px;"src="../images/<?php echo $d['foto_karyawan']; ?>">
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

</body>
</html>