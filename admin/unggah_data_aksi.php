<?php
// Load file koneksi.php
include "../function/db.php";

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
		
        $nia = $row['A']; // Ambil data NIS
		$nama = $row['B']; // Ambil data nama
		$jenis_kelamin = $row['C']; // Ambil data jenis kelamin
		$jabatan = $row['D']; // Ambil data telepon
        $tgl_lahir= $row['E']; // Ambil data alamat
        $alamat = $row['F'];
        $kontak=$row['G'];
        $email=$row['H'];

		// Cek jika semua data tidak diisi
		if(empty($nia) && empty($nama) && empty($jenis_kelamin) && empty($jabatan) && empty($tgl_lahir) && empty($alamat) && empty($kontak) && empty($email))
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
            // Buat query Insert
            $query = "INSERT INTO `karyawan`(`nia_karyawan`, `nama_karyawan`, `jk_karyawan`, `jabatan_karyawan`, `tanggal_lahir_karyawan`, `alamat_karyawan`, `kontak_karyawan`, `email_karyawan`,`foto_karyawan`) VALUES ('$nia', '$nama', '$jenis_kelamin', '$jabatan', '$tgl_lahir', '$alamat', '$kontak', '$email',NULL)";
            mysqli_query($koneksi, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: beranda.php'); // Redirect ke halaman awal
?>
