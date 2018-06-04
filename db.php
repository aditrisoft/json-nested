<?php
$hostname = "localhost";
$db = "desa"; //==> disesuaikan nama database
$user = "root";
$pass = "";


try{
	$koneksi = new PDO("mysql:host=$hostname;dbname=$db",$user,$pass);
}
// cek kesalahan koneksi
catch(PDOException $exception){
	echo "Koneksi Bermasalah. Keterangan error: ".$exception->getMessage();
}

?>
