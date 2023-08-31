<?php
include "../function/koneksi.php";
if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  $nama_file_baru = 'data.xlsx';
  // Load librari PHPExcel nya
  require_once '../function/PHPExcel/PHPExcel.php';
  $excelreader = new PHPExcel_Reader_Excel2007();
  $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
  $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
  $numrow = 1;
  foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    $nia = $row['A']; // Ambil data NIA
    $nama = $row['B']; // Ambil data nama
    $jenis_kelamin = $row['C']; // Ambil data jenis kelamin
    $jabatan = $row['D']; // Ambil data jabatan
    $tanggal_lahir = $row['E']; // Ambil data tanggal lahir
    $alamat = $row['F']; // Ambil data alamat
    $kontak = $row['G']; // Ambil data kontak
    $email = $row['H']; // Ambil data email
    
    // Cek jika semua data tidak diisi
    if(empty($nia) && empty($nama) && empty($jenis_kelamin) && empty($jabatan) && empty($tanggal_lahir) && empty($alamat) && empty($kontak) && empty($email))
      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
    if($numrow > 1){
      // Proses simpan ke Database
      // Buat query Insert
      $sql = $pdo->prepare("INSERT INTO `karyawan` VALUES(:nia_karyawan,:nama_karyawan,:jk_karyawan,:jabatan_karyawan,:tanggal_lahir_karyawan,NULL,:alamat_karyawan,:kontak_karyawan,:email_karyawan,NULL)");
      $sql->bindParam(':nia_karyawan', $nia);
      $sql->bindParam(':nama_karyawan', $nama);
      $sql->bindParam(':jk_karyawan', $jenis_kelamin);
      $sql->bindParam(':jabatan_karyawan', $jabatan);
      $sql->bindParam(':tanggal_lahir_karyawan', $tanggal_lahir);
      $sql->bindParam(':alamat_karyawan', $alamat);
      $sql->bindParam(':kontak_karyawan', $kontak);
      $sql->bindParam(':email_karyawan', $email);
      
      $sql->execute(); // Eksekusi query insert
    }
    $numrow++; // Tambah 1 setiap kali looping
  }
}
header('location: beranda.php'); // Redirect ke halaman awal
?>