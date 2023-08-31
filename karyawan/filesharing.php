<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

require_once("settings.php");
$message = "";
//Has the user uploaded something?
if(isset($_FILES['file']))
{
$target_path = Settings::$uploadFolder;
$target_path = $target_path . time() . '_' . basename( $_FILES['file']['name']);
//Check the password to verify legal upload
if($_POST['password'] != Settings::$password)
{
    $message = "Invalid Password!";
}
else
{
    //Try to move the uploaded file into the designated folder
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $message = "The file ".  basename( $_FILES['file']['name']). 
        " has been uploaded";
    } else{
        $message = "There was an error uploading the file, please try again!";
    }
}
}
if(strlen($message) > 0)
{
    $message = '<p class="error">' . $message . '</p>';
}
/** LIST UPLOADED FILES **/
$uploaded_files = "";
 
//Open directory for reading
$dh = opendir(Settings::$uploadFolder);

//LOOP through the files
while (($file = readdir($dh)) !== false) 
{
    if($file != '.' && $file != '..')
{
$filename = Settings::$uploadFolder . $file;
$parts = explode("_", $file);
$size = formatBytes(filesize($filename));
$added = date("m/d/Y", $parts[0]);
$origName = $parts[1];
$filetype = getFileType(substr($file, strlen($file) - 3));
$uploaded_files .= "<li class=\"$filetype\"><a href=\"$filename\">$origName</a> $size - $added</li>\n";
}
}
closedir($dh);

if(strlen($uploaded_files) == 0)
{
    $uploaded_files = "<li><em>No files found</em></li>";
}

function getFileType($extension)
{
    $images = array('jpg', 'gif', 'png', 'bmp');
    $docs   = array('txt', 'rtf', 'doc', 'docx', 'pdf');
    $apps   = array('zip', 'rar', 'exe');
     
    if(in_array($extension, $images)) return "Images";
    if(in_array($extension, $docs)) return "Documents";
    if(in_array($extension, $apps)) return "Applications";
    return "";
}

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    
    $bytes /= pow(1024, $pow); 
    
    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style type="text/css" media="all"> 
    @import url("style/style.css");
</style>
<link rel="stylesheet" href="css/bootstrap3.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<title>File Sharing</title>
</head>
<body>
<div id="container">
  <h1>File Sharing</h1>
    <fieldset>
        <legend>Add a new file to the storage</legend>
        <form method="post" action="#" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
        <p><label for="name">Select file</label><br />
        <input type="file" name="file" /></p>
        <p><label for="password">Password for upload</label><br />
        <input type="password" name="password" /></p>
        <p><input type="submit" name="submit" value="Start upload" /></p>
        </form>   
    </fieldset>
    <fieldset>
    <legend>Previousely uploaded files</legend>
    <ul id="menu">
        <li><a href="">All files</a></li>
        <li><a href="">Documents</a></li>
        <li><a href="">Images</a></li>
        <li><a href="">Applications</a></li>
    </ul>
     
    <ul id="files">
    <?php echo $uploaded_files; ?>
    </ul>
</fieldset>
</div>
    <center>
    <a href="../karyawan/index.php" class="btn btn-warning btn-block" style="width:150px; margin-top: 10px;"><i class="fa fa-edit"></i>Kembali</a>
    </center>
<script src="js/filestorage.js"></script>
</body>
</html>