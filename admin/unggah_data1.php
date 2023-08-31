<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unggah Data</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            //sembunyikan alert validasi kosong
            $("#kosong").hide();
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#" style="color: white;"><b>Unggah Data Karyawan</b></a>
        </div>
      </div>
    </nav>

    <!--konten-->
    <div style="padding: 0 15px;">
        <a href="beranda.php" class="btn btn-danger pull-right">
            <span class="glyphicon glyphicon-remove"></span>
            Batal
        </a>
        <h3>Menggunggah Data Karyawan</h3>
        <p>Import data karyawan dari file excel</p>
        <hr>

        <form action="" method="post" enctype="multipart/form-data">
            <a href="../FormatExcel.xlsx" class="btn btn-default">
                <span class="glyphicon glyphicon-download"></span>
                Unduh format Excel
            </a><br><br>
            <input type="file" name="file" class="pull-left">
            <button type="submit" name="preview" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-eye-open"></span>
                Pratinjau
            </button>
        </form>
        <hr>

    <?php
      // Jika user telah mengklik tombol Preview
      if(isset($_POST['preview'])){
        $nama_file_baru = 'data.xlsx';
        
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
          unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
        
        $tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
        $tmp_file = $_FILES['file']['tmp_name'];
        
        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
          // Upload file yang dipilih ke folder tmp
          move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
          
          // Load librari PHPExcel nya
          require_once '../function/PHPExcel/PHPExcel.php';
          
          $excelreader = new PHPExcel_Reader_Excel2007();
          $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
          $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
          
          // Buat sebuah tag form untuk proses import data ke database
          echo "<form method='post' action='unggah_data_aksi.php'>";
          
          // Buat sebuah div untuk alert validasi kosong
          echo "<div class='alert alert-danger' id='kosong'>
          Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
          </div>";
          
          echo "<table class='table table-bordered'>
          <tr>
            <th colspan='5' class='text-center'>Preview Data</th>
          </tr>
          <tr>
            <th>NIA</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Kontak</th>
            <th>Email</th>
          </tr>";
          
          $numrow = 1;
          $kosong = 0;
          foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
            // Ambil data pada excel sesuai Kolom
            $nia = $row['A']; // Ambil data NIS
            $nama = $row['B']; // Ambil data nama
            $jenis_kelamin = $row['C']; // Ambil data jenis kelamin
            $jabatan = $row['D']; // Ambil data telepon
            $tanggal_lahir = $row['E']; // Ambil data alamat
            $alamat = $row['F'];
            $kontak = $row['G'];
            $email = $row['H'];

            // Cek jika semua data tidak diisi
            if(empty($nia) && empty($nama) && empty($jenis_kelamin) && empty($jabatan) && empty($tanggal_lahir) && empty($alamat) && empty($kontak) && empty($email))
              continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1){
              // Validasi apakah semua data telah diisi
              $nia_td = ( ! empty($nia))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
              $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
              $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
              $jb_td = ( ! empty($jabatan))? "" : " style='background: #E07171;'"; // Jika Jabatan kosong, beri warna merah
              $tgl_lahir_td = ( ! empty($tanggal_lahir))? "" : " style='background: #E07171;'"; // Jika Tanggal Lahir kosong, beri warna merah
              $alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
              $kontak_td = ( ! empty($kontak))? "" : " style='background: #E07171;'"; // Jika Kontak kosong, beri warna merah
              $email_td = ( ! empty($email))? "" : " style='background: #E07171;'"; // Jika Email kosong, beri warna merah
              
              // Jika salah satu data ada yang kosong
              if(empty($nia) or empty($nama) or empty($jenis_kelamin) or empty($jabatan) or empty($tanggal_lahir) or empty($alamat) or empty($kontak) or empty($email)){
                $kosong++; // Tambah 1 variabel $kosong
              }
              
              echo "<tr>";
              echo "<td".$nia_td.">".$nia."</td>";
              echo "<td".$nama_td.">".$nama."</td>";
              echo "<td".$jk_td.">".$jenis_kelamin."</td>";
              echo "<td".$jb_td.">".$jabatan."</td>";
              echo "<td".$tgl_lahir_td.">".$tanggal_lahir."</td>";
              echo "<td".$alamat_td.">".$alamat."</td>";
              echo "<td".$kontak_td.">".$kontak."</td>";
              echo "<td".$email_td.">".$email."</td>";
              
              echo "</tr>";
            }
            
            $numrow++; // Tambah 1 setiap kali looping
          }
          
          echo "</table>";
          
          // Cek apakah variabel kosong lebih dari 0
          // Jika lebih dari 0, berarti ada data yang masih kosong
          if($kosong > 0){
          ?>  
            <script>
            $(document).ready(function(){
              // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
              $("#jumlah_kosong").html('<?php echo $kosong; ?>');
              
              $("#kosong").show(); // Munculkan alert validasi kosong
            });
            </script>
          <?php
          }else{ // Jika semua data sudah diisi
            echo "<hr>";
            
            // Buat sebuah tombol untuk mengimport data ke database
            echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span>Unggah</button>";
          }
          
          echo "</form>";
        }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
          // Munculkan pesan validasi
          echo "<div class='alert alert-danger'>
          Hanya File Excel 2007 (.xlsx) yang diperbolehkan
          </div>";
        }
      }
      ?>
    </div>
</body>
</html>