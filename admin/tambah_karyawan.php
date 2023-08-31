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
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div>
    <a href="beranda.php"><button>Kembali</button></a>
  </div>
  <div id="judul">
    <h2>Tambah Data Karyawan</h2>
  </div>

 <div class="form-group">
  <div class="container">
    <form method="post" action="tambah_karyawan_aksi.php" enctype="multipart/form-data"> 
      <div class="row">
        <div class="col-25">
          <label>NIA</label>
        </div>
        <div class="col-75">
          <input type="number" id="nia" name="nia" required>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Nama Lengkap</label>
        </div>
        <div class="col-75">
          <input type="text" id="nama" name="nama" required>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Jenis Kelamin</label>
        </div>
        <div class="col-75">
          <select class="form-control" name="jeniskelamin" required>
              <option value="laki-laki">Laki-Laki</option>
              <option value="perempuan">Perempuan</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Jabatan</label>
        </div>
        <div class="col-75">
          <input type="text" name="jabatan" required>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Tanggal Lahir</label>
        </div>
        <div class="col-75">
          <input type="date" name="tanggallahir" required>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Alamat</label>
        </div>
        <div class="col-75">
          <input type="text" name="alamat"  required>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Kontak</label>
        </div>
        <div class="col-75">
          <input type="text" name="kontak"  required>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label>Email</label>
        </div>
        <div class="col-75">
          <input type="email" name="email"  required>
        </div>
      </div>

      <div class="form-group">
					<label>Foto</label>
            <input type="file" accept="image/*" onchange="tampilkanPreview(this,'preview')" name="foto" multiple id="uploadFoto" class="form-control"><br/>
			</div>
      <div class="form-group">
            <center>
              <img id="preview" src="../images/<?php echo $d['foto']; ?>" alt="" width="320px">
            </center>
      </div>

      <div class="row">
        <input type="submit" name="submit" value="SIMPAN">
      </div>
    </form>
    
  </div>
  </div>
</body>

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

</html>