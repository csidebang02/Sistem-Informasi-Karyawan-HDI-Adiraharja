<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename= DataKaryawan.xls");
	?>
    <table border="1">
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
        </tr>

        <?php 
        include '../function/db.php';
        $query = mysqli_query($koneksi,"SELECT * FROM karyawan");
        $no = 1;
        while($d = mysqli_fetch_array($query)){
        ?>
        <tr>
           <td><?php echo $no++; ?></td>
           <td><?php echo $d['nia_karyawan']; ?></td>
           <td><?php echo $d['nama_karyawan']; ?></td>
           <td><?php echo $d['jk_karyawan']; ?></td>
           <td><?php echo $d['jabatan_karyawan']; ?></td>
           <td><?php echo $d['tanggal_lahir_karyawan']; ?></td>
           <td><?php echo $d['alamat_karyawan']; ?></td>
           <td><?php echo $d['kontak_karyawan']; ?></td>
           <td><?php echo $d['email_karyawan']; ?></td>
        </tr>
        <?php 
           }
        ?>
  </table>
</body>
</html>