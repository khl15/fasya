<?php 
require_once('koneksi.php');
session_start();
$query = "UPDATE `mazawa` SET `code`=null WHERE `code`='".$_SESSION['codeId']."'";
mysqli_query($koneksi, $query);
session_unset();
session_destroy();
header("Location: system.php");
?>