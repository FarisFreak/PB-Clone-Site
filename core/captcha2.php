<?php
session_start();
$_SESSION['captcha'] = '';
header("Content-type: image/jpeg");
// membuat gambar dengan menentukan ukuran
$gbr = imagecreate(70, 37);
 
//warna background captcha
imagecolorallocate($gbr, 69, 179, 157);
 
// pengaturan font captcha
$color = imagecolorallocate($gbr, 253, 252, 252);
$font = $_SERVER['DOCUMENT_ROOT']."/core/demo.ttf"; 
$ukuran_font = 20;
$posisi = 30;
// membuat nomor acak dan ditampilkan pada gambar
for($i=0;$i<=5;$i++) {
	// jumlah karakter
	$angka=rand(0, 9);
	
	$_SESSION['captcha'].=$angka;
	
	$kemiringan= rand(20, 20);
 	
	imagettftext($gbr, $ukuran_font, $kemiringan, 5+11.2*$i, $posisi, $color, $font, $angka);	
}
//untuk membuat gambar 
imagepng($gbr); 
imagedestroy($gbr);
?>